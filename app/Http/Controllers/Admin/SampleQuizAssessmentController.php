<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SampleQuizAssessment;
use App\Models\SampleQuizResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Carbon\Carbon;

class SampleQuizAssessmentController extends Controller
{
    /**
     * Display a listing of sample quiz assessments.
     */
    public function index(Request $request)
    {
        // Calculate statistics
        $stats = [
            'total_assessments' => SampleQuizAssessment::count(),
            'completed_assessments' => SampleQuizAssessment::where('status', 'completed')->count(),
            'in_progress_assessments' => SampleQuizAssessment::where('status', 'in_progress')->count(),
            'average_score' => SampleQuizAssessment::where('status', 'completed')->avg('score') ?? 0,
            'total_responses' => SampleQuizResponse::count(),
            'today_assessments' => SampleQuizAssessment::whereDate('created_at', Carbon::today())->count(),
            'this_week_assessments' => SampleQuizAssessment::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count(),
            'this_month_assessments' => SampleQuizAssessment::whereMonth('created_at', Carbon::now()->month)->whereYear('created_at', Carbon::now()->year)->count(),
        ];

        // Round average score
        $stats['average_score'] = round($stats['average_score'], 1);

        // Get assessments with pagination
        $assessments = SampleQuizAssessment::with(['responses.diagnosticItem'])
            ->when($request->search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('session_id', 'ILIKE', '%' . $search . '%')
                      ->orWhere('user_agent', 'ILIKE', '%' . $search . '%')
                      ->orWhere('ip_address', 'ILIKE', '%' . $search . '%');
                });
            })
            ->when($request->status && $request->status !== 'all', function ($query, $status) use ($request) {
                $query->where('status', $request->status);
            })
            ->when($request->date_from, function ($query, $date) {
                $query->whereDate('created_at', '>=', $date);
            })
            ->when($request->date_to, function ($query, $date) {
                $query->whereDate('created_at', '<=', $date);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(20)
            ->withQueryString();

        // Transform assessments for display
        $assessments->through(function ($assessment) {
            return [
                'id' => $assessment->id,
                'session_id' => $assessment->session_id,
                'status' => $assessment->status,
                'score' => $assessment->score,
                'total_questions' => $assessment->total_questions,
                'responses_count' => $assessment->responses->count(),
                'completion_time_seconds' => $assessment->completion_time_seconds,
                'completion_time_formatted' => $assessment->completion_time_seconds 
                    ? gmdate('i:s', $assessment->completion_time_seconds) 
                    : null,
                'user_agent' => $assessment->user_agent,
                'ip_address' => $assessment->ip_address,
                'started_at' => $assessment->started_at,
                'completed_at' => $assessment->completed_at,
                'created_at' => $assessment->created_at,
                'created_at_formatted' => $assessment->created_at->format('M d, Y g:i A'),
                'duration' => $assessment->completed_at && $assessment->started_at
                    ? $assessment->completed_at->diffForHumans($assessment->started_at, true)
                    : null,
            ];
        });

        return Inertia::render('Admin/SampleQuiz/Assessments', [
            'assessments' => $assessments,
            'stats' => $stats,
            'filters' => $request->only(['search', 'status', 'date_preset', 'date_from', 'date_to']),
        ]);
    }

    /**
     * Display the specified assessment details.
     */
    public function show(SampleQuizAssessment $assessment)
    {
        $assessment->load(['responses.diagnosticItem.type', 'responses.diagnosticItem.subtopic.topic.domain']);

        // Calculate domain-wise performance
        $domainStats = [];
        foreach ($assessment->responses as $response) {
            $domain = $response->diagnosticItem->subtopic->topic->domain->name ?? 'Unknown';
            
            if (!isset($domainStats[$domain])) {
                $domainStats[$domain] = [
                    'name' => $domain,
                    'total' => 0,
                    'correct' => 0,
                    'score' => 0,
                ];
            }
            
            $domainStats[$domain]['total']++;
            if ($response->is_correct) {
                $domainStats[$domain]['correct']++;
            }
        }

        // Calculate percentages
        foreach ($domainStats as &$stat) {
            $stat['score'] = $stat['total'] > 0 
                ? round(($stat['correct'] / $stat['total']) * 100, 1) 
                : 0;
        }

        // Sort by score descending
        uasort($domainStats, fn($a, $b) => $b['score'] <=> $a['score']);

        // Transform responses for display
        $responses = $assessment->responses->map(function ($response) {
            $item = $response->diagnosticItem;
            
            return [
                'id' => $response->id,
                'question_id' => $response->diagnostic_item_id,
                'question_sequence' => $response->question_sequence,
                'question_content' => $item->content,
                'question_type' => $item->type->name ?? 'Unknown',
                'domain' => $item->subtopic->topic->domain->name ?? 'Unknown',
                'topic' => $item->subtopic->topic->name ?? 'Unknown',
                'difficulty' => $this->mapDifficultyLevel($item->difficulty_level),
                'user_answer' => $response->user_answer,
                'correct_answer' => $item->correct_options,
                'is_correct' => $response->is_correct,
                'response_time_seconds' => $response->response_time_seconds,
                'response_time_formatted' => $response->response_time_seconds 
                    ? gmdate('i:s', $response->response_time_seconds) 
                    : null,
            ];
        })->sortBy('question_sequence')->values();

        return Inertia::render('Admin/SampleQuiz/AssessmentDetail', [
            'assessment' => [
                'id' => $assessment->id,
                'session_id' => $assessment->session_id,
                'status' => $assessment->status,
                'score' => $assessment->score,
                'total_questions' => $assessment->total_questions,
                'responses_count' => $assessment->responses->count(),
                'completion_time_seconds' => $assessment->completion_time_seconds,
                'completion_time_formatted' => $assessment->completion_time_seconds 
                    ? gmdate('i:s', $assessment->completion_time_seconds) 
                    : null,
                'user_agent' => $assessment->user_agent,
                'ip_address' => $assessment->ip_address,
                'started_at' => $assessment->started_at,
                'completed_at' => $assessment->completed_at,
                'created_at' => $assessment->created_at,
                'created_at_formatted' => $assessment->created_at->format('M d, Y g:i A'),
                'duration' => $assessment->completed_at && $assessment->started_at
                    ? $assessment->completed_at->diffForHumans($assessment->started_at, true)
                    : null,
            ],
            'responses' => $responses,
            'domainStats' => array_values($domainStats),
        ]);
    }

    /**
     * Remove the specified assessment.
     */
    public function destroy(SampleQuizAssessment $assessment)
    {
        try {
            $assessment->delete();
            
            return redirect()->route('admin.sample-quiz.assessments.index')
                ->with('success', 'Assessment deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('admin.sample-quiz.assessments.index')
                ->with('error', 'Failed to delete assessment.');
        }
    }

    /**
     * Map difficulty level number to string
     */
    private function mapDifficultyLevel(int $level): string
    {
        return match($level) {
            1 => 'Easy',
            2 => 'Easy',
            3 => 'Medium', 
            4 => 'Medium',
            5 => 'Hard',
            6 => 'Expert',
            default => 'Medium'
        };
    }
}