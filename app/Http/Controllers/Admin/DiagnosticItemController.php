<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DiagnosticItem;
use App\Models\DiagnosticSubtopic;
use App\Models\DiagnosticDomain;
use App\Models\QuestionType;
use App\Models\SampleQuizQuestion;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Rule;

class DiagnosticItemController extends Controller
{
    /**
     * Display listing of diagnostic items.
     */
    public function index(Request $request): Response
    {
        $query = DiagnosticItem::with([
            'subtopic.topic.domain',
            'type'
        ])->latest();

        // Search filter
        if ($request->search) {
            $query->where('content', 'like', "%{$request->search}%");
        }

        // Domain filter
        if ($request->domain_id) {
            $query->whereHas('subtopic.topic.domain', function ($q) use ($request) {
                $q->where('id', $request->domain_id);
            });
        }

        // Difficulty filter
        if ($request->difficulty_level) {
            $query->where('difficulty_level', $request->difficulty_level);
        }

        // Bloom level filter
        if ($request->bloom_level) {
            $query->where('bloom_level', $request->bloom_level);
        }

        // Status filter
        if ($request->status) {
            $query->where('status', $request->status);
        }

        // Type filter
        if ($request->type_id) {
            $query->where('type_id', $request->type_id);
        }

        $items = $query->paginate(20);

        // Get filter options
        $domains = DiagnosticDomain::select('id', 'name')->orderBy('name')->get();
        $types = QuestionType::select('id', 'name', 'code')->orderBy('name')->get();
        
        $difficultyLevels = [
            ['value' => 1, 'label' => 'Very Easy'],
            ['value' => 2, 'label' => 'Easy'],
            ['value' => 3, 'label' => 'Medium'],
            ['value' => 4, 'label' => 'Hard'],
            ['value' => 5, 'label' => 'Very Hard'],
            ['value' => 6, 'label' => 'Expert'],
        ];

        $bloomLevels = [
            ['value' => 1, 'label' => 'Remember'],
            ['value' => 2, 'label' => 'Understand'],
            ['value' => 3, 'label' => 'Apply'],
            ['value' => 4, 'label' => 'Analyze'],
            ['value' => 5, 'label' => 'Evaluate'],
            ['value' => 6, 'label' => 'Create'],
        ];

        $statuses = [
            ['value' => 'draft', 'label' => 'Draft'],
            ['value' => 'published', 'label' => 'Published'],
            ['value' => 'retired', 'label' => 'Retired'],
        ];

        return Inertia::render('Admin/Diagnostics/Items/Index', [
            'items' => $items,
            'filters' => $request->only(['search', 'domain_id', 'difficulty_level', 'bloom_level', 'status', 'type_id']),
            'filterOptions' => [
                'domains' => $domains,
                'types' => $types,
                'difficultyLevels' => $difficultyLevels,
                'bloomLevels' => $bloomLevels,
                'statuses' => $statuses,
            ],
        ]);
    }

    /**
     * Show form for creating new item.
     */
    public function create(): Response
    {
        $subtopics = DiagnosticSubtopic::with('topic.domain')
            ->get()
            ->map(function ($subtopic) {
                return [
                    'id' => $subtopic->id,
                    'name' => $subtopic->name,
                    'topic_name' => $subtopic->topic->name,
                    'domain_name' => $subtopic->topic->domain->name,
                    'full_name' => "{$subtopic->topic->domain->name} > {$subtopic->topic->name} > {$subtopic->name}",
                ];
            });

        $types = QuestionType::select('id', 'name', 'code')->get();

        return Inertia::render('Admin/Diagnostics/Items/Create', [
            'subtopics' => $subtopics,
            'types' => $types,
        ]);
    }

    /**
     * Store newly created item.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'subtopic_id' => 'required|exists:diagnostic_subtopics,id',
            'type_id' => 'required|exists:question_types,id',
            'dimension' => 'required|in:Technical,Managerial',
            'content' => 'required|string',
            'options' => 'nullable|array',
            'correct_options' => 'required|array',
            'justifications' => 'nullable|array',
            'settings' => 'nullable|array',
            'difficulty_level' => 'required|integer|min:1|max:6',
            'bloom_level' => 'required|integer|min:1|max:6',
            'irt_a' => 'nullable|numeric|min:0.5|max:3.0',
            'irt_b' => 'nullable|numeric|min:-3.0|max:3.0',
            'irt_c' => 'nullable|numeric|min:0.0|max:0.25',
            'status' => 'required|in:draft,published,retired',
        ]);

        DiagnosticItem::create($validated);

        return redirect()->route('admin.diagnostics.items.index')
            ->with('success', 'Diagnostic item created successfully.');
    }

    /**
     * Display specified item.
     */
    public function show(DiagnosticItem $item): Response
    {
        $item->load([
            'subtopic.topic.domain',
            'type',
            'sampleQuizQuestion'
        ]);

        // Get navigation info
        $previousItem = DiagnosticItem::where('id', '<', $item->id)
            ->orderBy('id', 'desc')
            ->first();
        $nextItem = DiagnosticItem::where('id', '>', $item->id)
            ->orderBy('id', 'asc')
            ->first();

        // Get sample quiz context
        $sampleQuizInfo = [
            'is_in_sample' => $item->isInSampleQuiz(),
            'display_order' => $item->sampleQuizQuestion?->display_order,
            'total_sample_questions' => SampleQuizQuestion::count(),
            'sample_questions' => SampleQuizQuestion::with('diagnosticItem')
                ->orderBy('display_order')
                ->get()
                ->map(function ($sq) {
                    return [
                        'id' => $sq->id,
                        'diagnostic_item_id' => $sq->diagnostic_item_id,
                        'display_order' => $sq->display_order,
                        'question_preview' => substr($sq->diagnosticItem->content, 0, 80) . '...',
                    ];
                }),
        ];

        return Inertia::render('Admin/Diagnostics/Items/Show', [
            'item' => $item,
            'navigation' => [
                'previous_id' => $previousItem?->id,
                'next_id' => $nextItem?->id,
                'total_count' => DiagnosticItem::count(),
            ],
            'sample_quiz' => $sampleQuizInfo,
        ]);
    }

    /**
     * Test specified item (like taking a quiz).
     */
    public function test(DiagnosticItem $item): Response
    {
        $item->load([
            'subtopic.topic.domain',
            'type'
        ]);

        return Inertia::render('Admin/Diagnostics/Items/Test', [
            'item' => $item,
        ]);
    }

    /**
     * Review test answer for specified item.
     */
    public function review(DiagnosticItem $item, Request $request): Response
    {
        $request->validate([
            'user_answer' => 'required',
        ]);

        $item->load([
            'subtopic.topic.domain',
            'type'
        ]);

        // Determine if answer is correct
        $userAnswer = $request->user_answer;
        $correctOptions = $item->correct_options;
        
        $isCorrect = false;
        if (is_array($userAnswer) && is_array($correctOptions)) {
            // Multi-select comparison
            $isCorrect = count(array_diff($userAnswer, $correctOptions)) === 0 && 
                        count(array_diff($correctOptions, $userAnswer)) === 0;
        } else {
            // Single answer comparison
            $isCorrect = in_array($userAnswer, (array)$correctOptions);
        }

        return Inertia::render('Admin/Diagnostics/Items/Review', [
            'item' => $item,
            'userAnswer' => $userAnswer,
            'isCorrect' => $isCorrect,
        ]);
    }

    /**
     * Show form for editing item.
     */
    public function edit(DiagnosticItem $item): Response
    {
        $item->load([
            'subtopic.topic.domain',
            'type'
        ]);

        $subtopics = DiagnosticSubtopic::with('topic.domain')
            ->get()
            ->map(function ($subtopic) {
                return [
                    'id' => $subtopic->id,
                    'name' => $subtopic->name,
                    'topic_name' => $subtopic->topic->name,
                    'domain_name' => $subtopic->topic->domain->name,
                    'full_name' => "{$subtopic->topic->domain->name} > {$subtopic->topic->name} > {$subtopic->name}",
                ];
            });

        $types = QuestionType::select('id', 'name', 'code')->get();

        return Inertia::render('Admin/Diagnostics/Items/Edit', [
            'item' => $item,
            'subtopics' => $subtopics,
            'types' => $types,
        ]);
    }

    /**
     * Update specified item.
     */
    public function update(Request $request, DiagnosticItem $item)
    {
        $validated = $request->validate([
            'subtopic_id' => 'required|exists:diagnostic_subtopics,id',
            'type_id' => 'required|exists:question_types,id',
            'dimension' => 'required|in:Technical,Managerial',
            'content' => 'required|string',
            'options' => 'nullable|array',
            'correct_options' => 'required|array',
            'justifications' => 'nullable|array',
            'settings' => 'nullable|array',
            'difficulty_level' => 'required|integer|min:1|max:6',
            'bloom_level' => 'required|integer|min:1|max:6',
            'irt_a' => 'nullable|numeric|min:0.5|max:3.0',
            'irt_b' => 'nullable|numeric|min:-3.0|max:3.0',
            'irt_c' => 'nullable|numeric|min:0.0|max:0.25',
            'status' => 'required|in:draft,published,retired',
        ]);

        $item->update($validated);

        return redirect()->route('admin.diagnostics.items.show', $item)
            ->with('success', 'Diagnostic item updated successfully.');
    }

    /**
     * Delete specified item.
     */
    public function destroy(DiagnosticItem $item)
    {
        $item->delete();

        return redirect()->route('admin.diagnostics.items.index')
            ->with('success', 'Diagnostic item deleted successfully.');
    }

    /**
     * Bulk operations on items.
     */
    public function bulkAction(Request $request)
    {
        $request->validate([
            'action' => 'required|in:delete,publish,draft,retire',
            'item_ids' => 'required|array',
            'item_ids.*' => 'exists:diagnostic_items,id',
        ]);

        $items = DiagnosticItem::whereIn('id', $request->item_ids);

        switch ($request->action) {
            case 'delete':
                $items->delete();
                $message = 'Items deleted successfully.';
                break;
            case 'publish':
                $items->update(['status' => 'published']);
                $message = 'Items published successfully.';
                break;
            case 'draft':
                $items->update(['status' => 'draft']);
                $message = 'Items set to draft successfully.';
                break;
            case 'retire':
                $items->update(['status' => 'retired']);
                $message = 'Items retired successfully.';
                break;
        }

        return back()->with('success', $message);
    }

    /**
     * Add diagnostic item to sample quiz
     */
    public function addToSampleQuiz(DiagnosticItem $item): JsonResponse
    {
        try {
            // Check if already in sample quiz
            if ($item->isInSampleQuiz()) {
                return response()->json([
                    'success' => false,
                    'message' => 'This question is already in the sample quiz.',
                ], 400);
            }

            // Add to sample quiz at next available position
            $nextOrder = SampleQuizQuestion::getNextDisplayOrder();
            
            SampleQuizQuestion::create([
                'diagnostic_item_id' => $item->id,
                'display_order' => $nextOrder,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Question added to sample quiz successfully.',
                'display_order' => $nextOrder,
                'total_questions' => SampleQuizQuestion::count(),
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to add question to sample quiz.',
            ], 500);
        }
    }

    /**
     * Remove diagnostic item from sample quiz
     */
    public function removeFromSampleQuiz(DiagnosticItem $item): JsonResponse
    {
        try {
            $sampleQuestion = $item->sampleQuizQuestion;
            
            if (!$sampleQuestion) {
                return response()->json([
                    'success' => false,
                    'message' => 'This question is not in the sample quiz.',
                ], 400);
            }

            $deletedOrder = $sampleQuestion->display_order;
            $sampleQuestion->delete();

            // Reorder remaining questions
            SampleQuizQuestion::reorderAfterDeletion($deletedOrder);

            return response()->json([
                'success' => true,
                'message' => 'Question removed from sample quiz successfully.',
                'total_questions' => SampleQuizQuestion::count(),
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to remove question from sample quiz.',
            ], 500);
        }
    }

    /**
     * Reorder sample quiz questions
     */
    public function reorderSampleQuiz(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'questions' => 'required|array',
                'questions.*.id' => 'required|exists:sample_quiz_questions,id',
                'questions.*.display_order' => 'required|integer|min:1',
            ]);

            foreach ($validated['questions'] as $questionData) {
                SampleQuizQuestion::where('id', $questionData['id'])
                    ->update(['display_order' => $questionData['display_order']]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Sample quiz questions reordered successfully.',
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to reorder sample quiz questions.',
            ], 500);
        }
    }
}