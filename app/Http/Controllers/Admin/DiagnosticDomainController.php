<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DiagnosticDomain;
use App\Models\DiagnosticTopic;
use App\Models\DiagnosticSubtopic;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DiagnosticDomainController extends Controller
{
    /**
     * Display the domain management interface
     */
    public function index()
    {
        // Get all domains with their topics and subtopics
        $hierarchy = DiagnosticDomain::with([
            'topics' => function ($query) {
                $query->with(['subtopics' => function ($query) {
                    $query->withCount('diagnosticItems')
                        ->orderBy('sort_order');
                }]);
            }
        ])
        ->withCount(['topics'])
        ->orderBy('priority_order')
        ->orderBy('id')
        ->get()
        ->map(function ($domain) {
            return [
                'id' => $domain->id,
                'name' => $domain->name,
                'description' => $domain->description,
                'code' => $domain->code,
                'category' => $domain->category,
                'color' => $domain->color,
                'icon' => $domain->icon,
                'is_active' => $domain->is_active,
                'priority_order' => $domain->priority_order,
                'topics_count' => $domain->topics_count,
                'total_questions' => $domain->topics->sum(function ($topic) {
                    return $topic->subtopics->sum('diagnostic_items_count');
                }),
                'topics' => $domain->topics->map(function ($topic) {
                    return [
                        'id' => $topic->id,
                        'name' => $topic->name,
                        'description' => $topic->description,
                        'subtopics_count' => $topic->subtopics->count(),
                        'total_questions' => $topic->subtopics->sum('diagnostic_items_count'),
                        'subtopics' => $topic->subtopics->map(function ($subtopic) {
                            return [
                                'id' => $subtopic->id,
                                'name' => $subtopic->name,
                                'description' => $subtopic->description,
                                'sort_order' => $subtopic->sort_order,
                                'questions_count' => $subtopic->diagnostic_items_count,
                            ];
                        }),
                    ];
                }),
            ];
        });

        return Inertia::render('Admin/Diagnostics/Domains/Index', [
            'domains' => $hierarchy,
        ]);
    }

    /**
     * Store a new domain
     */
    public function storeDomain(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'code' => 'nullable|string|max:20|unique:diagnostic_domains,code',
            'category' => 'nullable|in:foundational,technical,managerial',
            'color' => 'nullable|string|max:20',
            'icon' => 'nullable|string|max:50',
            'is_active' => 'boolean',
            'priority_order' => 'nullable|integer|min:0',
        ]);

        $validated['is_active'] = $validated['is_active'] ?? true;
        
        // Auto-set priority order if not provided
        if (!isset($validated['priority_order'])) {
            $validated['priority_order'] = DiagnosticDomain::max('priority_order') + 1;
        }

        DiagnosticDomain::create($validated);

        return redirect()->route('admin.diagnostics.domains.index')
            ->with('success', 'Domain created successfully.');
    }

    /**
     * Update a domain
     */
    public function updateDomain(Request $request, DiagnosticDomain $domain)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'code' => 'nullable|string|max:20|unique:diagnostic_domains,code,' . $domain->id,
            'category' => 'nullable|in:foundational,technical,managerial',
            'color' => 'nullable|string|max:20',
            'icon' => 'nullable|string|max:50',
            'is_active' => 'boolean',
            'priority_order' => 'nullable|integer|min:0',
        ]);

        $domain->update($validated);

        return redirect()->route('admin.diagnostics.domains.index')
            ->with('success', 'Domain updated successfully.');
    }

    /**
     * Delete a domain
     */
    public function destroyDomain(DiagnosticDomain $domain)
    {
        // Check if domain has topics
        if ($domain->topics()->exists()) {
            return redirect()->route('admin.diagnostics.domains.index')
                ->with('error', 'Cannot delete domain with existing topics.');
        }

        $domain->delete();

        return redirect()->route('admin.diagnostics.domains.index')
            ->with('success', 'Domain deleted successfully.');
    }

    /**
     * Store a new topic
     */
    public function storeTopic(Request $request)
    {
        $validated = $request->validate([
            'domain_id' => 'required|exists:diagnostic_domains,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        DiagnosticTopic::create($validated);

        return redirect()->route('admin.diagnostics.domains.index')
            ->with('success', 'Topic created successfully.');
    }

    /**
     * Update a topic
     */
    public function updateTopic(Request $request, DiagnosticTopic $topic)
    {
        $validated = $request->validate([
            'domain_id' => 'required|exists:diagnostic_domains,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $topic->update($validated);

        return redirect()->route('admin.diagnostics.domains.index')
            ->with('success', 'Topic updated successfully.');
    }

    /**
     * Delete a topic
     */
    public function destroyTopic(DiagnosticTopic $topic)
    {
        // Check if topic has subtopics
        if ($topic->subtopics()->exists()) {
            return redirect()->route('admin.diagnostics.domains.index')
                ->with('error', 'Cannot delete topic with existing subtopics.');
        }

        // Check if topic has questions through subtopics
        $hasQuestions = $topic->subtopics()->whereHas('diagnosticItems')->exists();
        if ($hasQuestions) {
            return redirect()->route('admin.diagnostics.domains.index')
                ->with('error', 'Cannot delete topic with existing questions.');
        }

        $topic->delete();

        return redirect()->route('admin.diagnostics.domains.index')
            ->with('success', 'Topic deleted successfully.');
    }

    /**
     * Store a new subtopic
     */
    public function storeSubtopic(Request $request)
    {
        $validated = $request->validate([
            'topic_id' => 'required|exists:diagnostic_topics,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        // Auto-set order sequence if not provided
        if (!isset($validated['sort_order'])) {
            $validated['sort_order'] = DiagnosticSubtopic::where('topic_id', $validated['topic_id'])
                ->max('sort_order') + 1;
        }

        DiagnosticSubtopic::create($validated);

        return redirect()->route('admin.diagnostics.domains.index')
            ->with('success', 'Subtopic created successfully.');
    }

    /**
     * Update a subtopic
     */
    public function updateSubtopic(Request $request, DiagnosticSubtopic $subtopic)
    {
        $validated = $request->validate([
            'topic_id' => 'required|exists:diagnostic_topics,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $subtopic->update($validated);

        return redirect()->route('admin.diagnostics.domains.index')
            ->with('success', 'Subtopic updated successfully.');
    }

    /**
     * Delete a subtopic
     */
    public function destroySubtopic(DiagnosticSubtopic $subtopic)
    {
        // Check if subtopic has items
        if ($subtopic->diagnosticItems()->exists()) {
            return redirect()->route('admin.diagnostics.domains.index')
                ->with('error', 'Cannot delete subtopic with existing questions.');
        }

        $subtopic->delete();

        return redirect()->route('admin.diagnostics.domains.index')
            ->with('success', 'Subtopic deleted successfully.');
    }

    /**
     * Reorder items (domains, topics, or subtopics)
     */
    public function reorder(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|in:domain,topic,subtopic',
            'items' => 'required|array',
            'items.*.id' => 'required|integer',
            'items.*.order' => 'required|integer|min:0',
        ]);

        switch ($validated['type']) {
            case 'domain':
                foreach ($validated['items'] as $item) {
                    DiagnosticDomain::where('id', $item['id'])
                        ->update(['priority_order' => $item['order']]);
                }
                break;
            
            case 'subtopic':
                foreach ($validated['items'] as $item) {
                    DiagnosticSubtopic::where('id', $item['id'])
                        ->update(['sort_order' => $item['order']]);
                }
                break;
        }

        return response()->json(['success' => true]);
    }
}