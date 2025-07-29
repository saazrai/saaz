<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use App\Models\QuestionType;
use Illuminate\Http\Request;
use Inertia\Inertia;

class QuestionTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorize('manage master data');
        
        $query = QuestionType::query();

        // Apply filters
        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'LIKE', '%' . $request->search . '%')
                  ->orWhere('code', 'LIKE', '%' . $request->search . '%')
                  ->orWhere('description', 'LIKE', '%' . $request->search . '%');
            });
        }

        if ($request->status && $request->status !== 'all') {
            $isActive = $request->status === 'active';
            $query->where('is_active', $isActive);
        }


        // Get results and transform data for Vue components
        $questionTypes = $query->orderBy('id')->get();
        
        $questionTypes->transform(function ($item) {
            return [
                'id' => $item->id,
                'code' => $item->code,
                'name' => $item->name,
                'description' => $item->description,
                'status' => $item->is_active ? 'active' : 'inactive',
                'created_at' => $item->created_at,
                'updated_at' => $item->updated_at,
            ];
        });

        return Inertia::render('Admin/Master/QuestionTypes/Index', [
            'questionTypes' => ['data' => $questionTypes],
            'filters' => $request->only(['search', 'status']),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return redirect()->route('admin.master.question-types.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|string|max:10|unique:question_types,code',
            'name' => 'required|string|max:255|unique:question_types,name',
            'description' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]);

        // Map to original table structure
        QuestionType::create([
            'code' => $validated['code'],
            'name' => $validated['name'],
            'description' => $validated['description'],
            'is_active' => $validated['status'] === 'active',
        ]);

        return redirect()->route('admin.master.question-types.index')
            ->with('success', 'Question type created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $questionType = QuestionType::findOrFail($id);
        
        return Inertia::render('Admin/Master/QuestionTypes/Show', [
            'questionType' => [
                'id' => $questionType->id,
                'code' => $questionType->code,
                'name' => $questionType->name,
                'description' => $questionType->description,
                'status' => $questionType->is_active ? 'active' : 'inactive',
                'created_at' => $questionType->created_at,
                'updated_at' => $questionType->updated_at,
            ]
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return redirect()->route('admin.master.question-types.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $questionType = QuestionType::findOrFail($id);
        
        $validated = $request->validate([
            'code' => 'required|string|max:10|unique:question_types,code,' . $id,
            'name' => 'required|string|max:255|unique:question_types,name,' . $id,
            'description' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]);

        // Map to original table structure
        $questionType->update([
            'code' => $validated['code'],
            'name' => $validated['name'],
            'description' => $validated['description'],
            'is_active' => $validated['status'] === 'active',
        ]);

        return redirect()->route('admin.master.question-types.index')
            ->with('success', 'Question type updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $questionType = QuestionType::findOrFail($id);
        $questionType->delete();

        return redirect()->route('admin.master.question-types.index')
            ->with('success', 'Question type deleted successfully.');
    }

}