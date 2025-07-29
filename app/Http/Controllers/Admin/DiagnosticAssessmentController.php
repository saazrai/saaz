<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Diagnostic;
use App\Models\User;
use App\Models\DiagnosticPhase;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class DiagnosticAssessmentController extends Controller
{
    /**
     * Display listing of diagnostic assessments.
     */
    public function index(Request $request): Response
    {
        $query = Diagnostic::with(['user', 'phase'])
            ->latest();

        // Search filter
        if ($request->search) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('name', 'like', "%{$request->search}%")
                  ->orWhere('email', 'like', "%{$request->search}%");
            });
        }

        // Status filter
        if ($request->status) {
            $query->where('status', $request->status);
        }

        // Phase filter
        if ($request->phase_id) {
            $query->where('phase_id', $request->phase_id);
        }

        // Date range filter
        if ($request->date_from) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->date_to) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $assessments = $query->paginate(20);

        // Get filter options
        $phases = DiagnosticPhase::select('id', 'name')->ordered()->get();
        $statuses = [
            ['value' => 'in_progress', 'label' => 'In Progress'],
            ['value' => 'paused', 'label' => 'Paused'],
            ['value' => 'completed', 'label' => 'Completed'],
        ];

        return Inertia::render('Admin/Diagnostics/Assessments/Index', [
            'assessments' => $assessments,
            'filters' => $request->only(['search', 'status', 'phase_id', 'date_from', 'date_to']),
            'filterOptions' => [
                'phases' => $phases,
                'statuses' => $statuses,
            ],
        ]);
    }

    /**
     * Display specific assessment details.
     */
    public function show(Diagnostic $diagnostic): Response
    {
        $diagnostic->load([
            'user',
            'phase',
            'responses' => function ($query) {
                $query->with(['diagnosticItem' => function ($q) {
                    $q->with(['subtopic.topic.domain']);
                }])
                ->orderBy('created_at');
            }
        ]);

        // Calculate statistics
        $stats = [
            'total_questions' => $diagnostic->responses()->count(),
            'correct_answers' => $diagnostic->responses()->where('is_correct', true)->count(),
            'incorrect_answers' => $diagnostic->responses()->where('is_correct', false)->count(),
            'average_response_time' => $diagnostic->responses()->avg('response_time_seconds'),
            'domains_assessed' => $diagnostic->responses()
                ->with('diagnosticItem.subtopic.topic.domain')
                ->get()
                ->pluck('diagnosticItem.subtopic.topic.domain')
                ->filter()
                ->unique('id')
                ->count(),
        ];

        return Inertia::render('Admin/Diagnostics/Assessments/Show', [
            'assessment' => $diagnostic,
            'stats' => $stats,
        ]);
    }

    /**
     * Export assessment data.
     */
    public function export(Request $request)
    {
        $request->validate([
            'format' => 'required|in:csv,json',
            'assessment_ids' => 'array',
            'assessment_ids.*' => 'exists:diagnostics,id',
        ]);

        $query = Diagnostic::with(['user', 'phase']);

        if (!empty($request->assessment_ids)) {
            $query->whereIn('id', $request->assessment_ids);
        }

        $assessments = $query->get();

        if ($request->format === 'csv') {
            return $this->exportCsv($assessments);
        }

        return $this->exportJson($assessments);
    }

    /**
     * Export assessments as CSV.
     */
    protected function exportCsv($assessments)
    {
        $filename = 'diagnostic_assessments_' . now()->format('Y-m-d_H-i-s') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $callback = function () use ($assessments) {
            $file = fopen('php://output', 'w');

            // CSV Headers
            fputcsv($file, [
                'ID',
                'User Name',
                'User Email',
                'Status',
                'Score',
                'Duration (minutes)',
                'Phase',
                'Started At',
                'Completed At',
            ]);

            foreach ($assessments as $assessment) {
                fputcsv($file, [
                    $assessment->id,
                    $assessment->user?->name,
                    $assessment->user?->email,
                    $assessment->status,
                    $assessment->score,
                    $assessment->duration_minutes,
                    $assessment->phase?->name,
                    $assessment->created_at,
                    $assessment->completed_at,
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Export assessments as JSON.
     */
    protected function exportJson($assessments)
    {
        $filename = 'diagnostic_assessments_' . now()->format('Y-m-d_H-i-s') . '.json';

        $headers = [
            'Content-Type' => 'application/json',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $data = [
            'exported_at' => now()->toISOString(),
            'total_records' => $assessments->count(),
            'assessments' => $assessments->map(function ($assessment) {
                return [
                    'id' => $assessment->id,
                    'user' => [
                        'id' => $assessment->user?->id,
                        'name' => $assessment->user?->name,
                        'email' => $assessment->user?->email,
                    ],
                    'status' => $assessment->status,
                    'score' => $assessment->score,
                    'duration_seconds' => $assessment->total_duration_seconds,
                    'duration_minutes' => $assessment->duration_minutes,
                    'phase' => [
                        'id' => $assessment->phase?->id,
                        'name' => $assessment->phase?->name,
                    ],
                    'ability' => $assessment->ability,
                    'standard_error' => $assessment->standard_error,
                    'started_at' => $assessment->created_at,
                    'completed_at' => $assessment->completed_at,
                ];
            }),
        ];

        return response()->json($data, 200, $headers);
    }
}