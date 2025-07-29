<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use OwenIt\Auditing\Models\Audit;

class AuditController extends Controller
{
    /**
     * Display audit logs
     */
    public function index(Request $request): Response
    {
        $query = Audit::with('user')
            ->latest()
            ->when($request->search, function ($query, $search) {
                $query->where(function ($query) use ($search) {
                    $query->where('auditable_type', 'like', "%{$search}%")
                        ->orWhere('event', 'like', "%{$search}%")
                        ->orWhere('ip_address', 'like', "%{$search}%");
                });
            })
            ->when($request->event, function ($query, $event) {
                $query->where('event', $event);
            })
            ->when($request->model, function ($query, $model) {
                $query->where('auditable_type', $model);
            })
            ->when($request->date_from, function ($query, $dateFrom) {
                $query->whereDate('created_at', '>=', $dateFrom);
            })
            ->when($request->date_to, function ($query, $dateTo) {
                $query->whereDate('created_at', '<=', $dateTo);
            });

        $audits = $query->paginate(50);

        // Calculate statistics
        $stats = [
            'total_audits' => Audit::count(),
            'audits_today' => Audit::whereDate('created_at', today())->count(),
            'audits_this_week' => Audit::whereBetween('created_at', [
                now()->startOfWeek(),
                now()->endOfWeek()
            ])->count(),
            'audits_this_month' => Audit::whereMonth('created_at', now()->month)
                ->whereYear('created_at', now()->year)
                ->count(),
        ];

        return Inertia::render('Admin/Audits/Index', [
            'audits' => $audits,
            'stats' => $stats,
            'filters' => $request->only(['search', 'event', 'model', 'date_from', 'date_to']),
            'filterOptions' => [
                'events' => array_keys($this->getAvailableEvents()),
                'models' => collect($this->getAvailableModels())->map(function ($label, $value) {
                    return ['value' => $value, 'label' => $label];
                })->values(),
            ],
        ]);
    }

    /**
     * Show specific audit details
     */
    public function show(Audit $audit): Response
    {
        $audit->load('user');

        return Inertia::render('Admin/Audits/Show', [
            'audit' => [
                'id' => $audit->id,
                'event' => $audit->event,
                'auditable_type' => $audit->auditable_type,
                'auditable_id' => $audit->auditable_id,
                'user_id' => $audit->user_id,
                'user' => $audit->user,
                'ip_address' => $audit->ip_address,
                'user_agent' => $audit->user_agent,
                'url' => $audit->url,
                'old_values' => $audit->old_values,
                'new_values' => $audit->new_values,
                'created_at' => $audit->created_at,
                'updated_at' => $audit->updated_at,
            ],
        ]);
    }

    /**
     * Get available audit events
     */
    protected function getAvailableEvents(): array
    {
        return [
            'created' => 'Created',
            'updated' => 'Updated',
            'deleted' => 'Deleted',
            'restored' => 'Restored',
        ];
    }

    /**
     * Get available models that are auditable
     */
    protected function getAvailableModels(): array
    {
        return [
            'App\Models\User' => 'Users',
            'App\Models\Diagnostic' => 'Diagnostics',
            'App\Models\DiagnosticProfile' => 'Diagnostic Profiles',
            'App\Models\DiagnosticResponse' => 'Diagnostic Responses',
        ];
    }
}
