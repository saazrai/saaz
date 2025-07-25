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

        return Inertia::render('Admin/Audits/Index', [
            'audits' => $audits,
            'filters' => $request->only(['search', 'event', 'model', 'date_from', 'date_to']),
            'available_events' => $this->getAvailableEvents(),
            'available_models' => $this->getAvailableModels(),
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

    /**
     * Export audit logs (for compliance)
     */
    public function export(Request $request)
    {
        $request->validate([
            'format' => 'required|in:csv,json',
            'date_from' => 'nullable|date',
            'date_to' => 'nullable|date|after_or_equal:date_from',
        ]);

        $query = Audit::with('user')
            ->when($request->date_from, function ($query, $dateFrom) {
                $query->whereDate('created_at', '>=', $dateFrom);
            })
            ->when($request->date_to, function ($query, $dateTo) {
                $query->whereDate('created_at', '<=', $dateTo);
            })
            ->orderBy('created_at', 'desc');

        $audits = $query->get();

        if ($request->format === 'csv') {
            return $this->exportCsv($audits);
        }

        return $this->exportJson($audits);
    }

    /**
     * Export audits as CSV
     */
    protected function exportCsv($audits)
    {
        $filename = 'audit_logs_'.now()->format('Y-m-d_H-i-s').'.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $callback = function () use ($audits) {
            $file = fopen('php://output', 'w');

            // CSV Headers
            fputcsv($file, [
                'ID',
                'Event',
                'Model',
                'Model ID',
                'User ID',
                'User Email',
                'IP Address',
                'Created At',
                'Changes',
            ]);

            foreach ($audits as $audit) {
                $changes = '';
                if ($audit->old_values || $audit->new_values) {
                    $changes = json_encode([
                        'old' => $audit->old_values,
                        'new' => $audit->new_values,
                    ]);
                }

                fputcsv($file, [
                    $audit->id,
                    $audit->event,
                    $audit->auditable_type,
                    $audit->auditable_id,
                    $audit->user_id,
                    $audit->user?->email,
                    $audit->ip_address,
                    $audit->created_at,
                    $changes,
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Export audits as JSON
     */
    protected function exportJson($audits)
    {
        $filename = 'audit_logs_'.now()->format('Y-m-d_H-i-s').'.json';

        $headers = [
            'Content-Type' => 'application/json',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $data = [
            'exported_at' => now()->toISOString(),
            'total_records' => $audits->count(),
            'audits' => $audits->map(function ($audit) {
                return [
                    'id' => $audit->id,
                    'event' => $audit->event,
                    'auditable_type' => $audit->auditable_type,
                    'auditable_id' => $audit->auditable_id,
                    'user_id' => $audit->user_id,
                    'user_email' => $audit->user?->email,
                    'ip_address' => $audit->ip_address,
                    'user_agent' => $audit->user_agent,
                    'url' => $audit->url,
                    'old_values' => $audit->old_values,
                    'new_values' => $audit->new_values,
                    'created_at' => $audit->created_at,
                ];
            }),
        ];

        return response()->json($data, 200, $headers);
    }
}
