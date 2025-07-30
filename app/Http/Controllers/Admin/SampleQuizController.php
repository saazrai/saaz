<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SampleQuizQuestion;
use App\Models\DiagnosticItem; 
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Inertia\Inertia;
use Inertia\Response;

class SampleQuizController extends Controller
{
    /**
     * Display the sample quiz questions management interface
     */
    public function index(): Response
    {
        // Get all sample quiz questions with diagnostic item details
        $sampleQuestions = SampleQuizQuestion::with([
                'diagnosticItem.subtopic.topic.domain',
                'diagnosticItem.type'
            ])
            ->orderBy('display_order')
            ->get()
            ->map(function ($sq) {
                return [
                    'id' => $sq->id,
                    'diagnostic_item_id' => $sq->diagnostic_item_id,
                    'display_order' => $sq->display_order,
                    'question' => [
                        'id' => $sq->diagnosticItem->id,
                        'content' => $sq->diagnosticItem->content,
                        'type' => $sq->diagnosticItem->type->name ?? 'Unknown',
                        'domain' => $sq->diagnosticItem->subtopic->topic->domain->name ?? 'Unknown',
                        'topic' => $sq->diagnosticItem->subtopic->topic->name ?? 'Unknown',
                        'difficulty_level' => $sq->diagnosticItem->difficulty_level,
                        'bloom_level' => $sq->diagnosticItem->bloom_level,
                        'status' => $sq->diagnosticItem->status,
                    ],
                ];
            });

        // Get total diagnostic items count for context
        $totalDiagnosticItems = DiagnosticItem::where('status', 'published')->count();

        return Inertia::render('Admin/SampleQuiz/Index', [
            'sample_questions' => $sampleQuestions,
            'total_diagnostic_items' => $totalDiagnosticItems,
            'stats' => [
                'total_sample_questions' => $sampleQuestions->count(),
                'max_recommended' => 10, // Business rule
            ],
        ]);
    }

    /**
     * Reorder sample quiz questions via drag and drop
     */
    public function reorder(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'questions' => 'required|array',
                'questions.*.id' => 'required|exists:sample_quiz_questions,id',
                'questions.*.display_order' => 'required|integer|min:1',
            ]);

            // Update all display orders in a transaction
            \DB::transaction(function () use ($validated) {
                foreach ($validated['questions'] as $questionData) {
                    SampleQuizQuestion::where('id', $questionData['id'])
                        ->update(['display_order' => $questionData['display_order']]);
                }
            });

            return response()->json([
                'success' => true,
                'message' => 'Sample quiz questions reordered successfully.',
            ]);

        } catch (\Exception $e) {
            \Log::error('Sample quiz reorder failed: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to reorder sample quiz questions.',
            ], 500);
        }
    }

    /**
     * Remove question from sample quiz (drag to trash)
     */
    public function destroy(SampleQuizQuestion $sampleQuestion): JsonResponse
    {
        try {
            $deletedOrder = $sampleQuestion->display_order;
            $sampleQuestion->delete();

            // Reorder remaining questions to fill the gap
            SampleQuizQuestion::where('display_order', '>', $deletedOrder)
                ->decrement('display_order');

            return response()->json([
                'success' => true,
                'message' => 'Question removed from sample quiz successfully.',
                'remaining_count' => SampleQuizQuestion::count(),
            ]);

        } catch (\Exception $e) {
            \Log::error('Sample quiz deletion failed: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to remove question from sample quiz.',
            ], 500);
        }
    }

    /**
     * Add new question to sample quiz
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'diagnostic_item_id' => 'required|exists:diagnostic_items,id',
            ]);

            // Check if already in sample quiz
            if (SampleQuizQuestion::where('diagnostic_item_id', $validated['diagnostic_item_id'])->exists()) {
                return response()->json([
                    'success' => false,
                    'message' => 'This question is already in the sample quiz.',
                ], 400);
            }

            // Add at the end
            $nextOrder = SampleQuizQuestion::max('display_order') + 1 ?? 1;
            
            $sampleQuestion = SampleQuizQuestion::create([
                'diagnostic_item_id' => $validated['diagnostic_item_id'],
                'display_order' => $nextOrder,
            ]);

            // Load the full question data for response
            $sampleQuestion->load([
                'diagnosticItem.subtopic.topic.domain',
                'diagnosticItem.type'
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Question added to sample quiz successfully.',
                'question' => [
                    'id' => $sampleQuestion->id,
                    'diagnostic_item_id' => $sampleQuestion->diagnostic_item_id,
                    'display_order' => $sampleQuestion->display_order,
                    'question' => [
                        'id' => $sampleQuestion->diagnosticItem->id,
                        'content' => $sampleQuestion->diagnosticItem->content,
                        'type' => $sampleQuestion->diagnosticItem->type->name ?? 'Unknown',
                        'domain' => $sampleQuestion->diagnosticItem->subtopic->topic->domain->name ?? 'Unknown',
                        'topic' => $sampleQuestion->diagnosticItem->subtopic->topic->name ?? 'Unknown',
                        'difficulty_level' => $sampleQuestion->diagnosticItem->difficulty_level,
                        'bloom_level' => $sampleQuestion->diagnosticItem->bloom_level,
                        'status' => $sampleQuestion->diagnosticItem->status,
                    ],
                ],
            ]);

        } catch (\Exception $e) {
            \Log::error('Sample quiz addition failed: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to add question to sample quiz.',
            ], 500);
        }
    }

    /**
     * Search diagnostic items to add to sample quiz
     */
    public function searchItems(Request $request): JsonResponse
    {
        $query = DiagnosticItem::with([
                'subtopic.topic.domain',
                'type'
            ])
            ->where('status', 'published')
            ->whereNotIn('id', SampleQuizQuestion::pluck('diagnostic_item_id'));

        // Search by content
        if ($request->search) {
            $query->where('content', 'ilike', '%' . $request->search . '%');
        }

        // Filter by domain
        if ($request->domain_id) {
            $query->whereHas('subtopic.topic.domain', function ($q) use ($request) {
                $q->where('id', $request->domain_id);
            });
        }

        // Filter by difficulty
        if ($request->difficulty_level) {
            $query->where('difficulty_level', $request->difficulty_level);
        }

        $items = $query->limit(20)->get()->map(function ($item) {
            return [
                'id' => $item->id,
                'content' => substr($item->content, 0, 100) . (strlen($item->content) > 100 ? '...' : ''),
                'type' => $item->type->name ?? 'Unknown',
                'domain' => $item->subtopic->topic->domain->name ?? 'Unknown',
                'difficulty_level' => $item->difficulty_level,
                'bloom_level' => $item->bloom_level,
            ];
        });

        return response()->json($items);
    }
}