<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use App\Models\Bloom;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class BloomController extends Controller
{
    /**
     * Display a listing of bloom levels.
     */
    public function index(Request $request): Response
    {
        $query = Bloom::query();

        // Apply search filter
        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'ILIKE', '%' . $request->search . '%')
                  ->orWhere('code', 'ILIKE', '%' . $request->search . '%')
                  ->orWhere('description', 'ILIKE', '%' . $request->search . '%');
            });
        }

        // Apply status filter
        if ($request->status && $request->status !== 'all') {
            $isActive = $request->status === 'active';
            $query->where('is_active', $isActive);
        }

        // Get results and transform for Vue
        $blooms = $query->orderBy('id')->get();
        
        $blooms->transform(function ($bloom) {
            return [
                'id' => $bloom->id,
                'level' => $bloom->id, // ID serves as level
                'code' => $bloom->code,
                'name' => $bloom->name,
                'description' => $bloom->description,
                'status' => $bloom->is_active ? 'active' : 'inactive',
                'is_active' => $bloom->is_active,
                'created_at' => $bloom->created_at,
                'updated_at' => $bloom->updated_at,
            ];
        });

        return Inertia::render('Admin/Master/Blooms/Index', [
            'blooms' => ['data' => $blooms],
            'filters' => $request->only(['search', 'status']),
        ]);
    }

    /**
     * Update the specified bloom level.
     */
    public function update(Request $request, string $id)
    {
        $bloom = Bloom::findOrFail($id);
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]);

        // Update bloom (code and level cannot be changed)
        $bloom->update([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'is_active' => $validated['status'] === 'active',
        ]);

        return redirect()->route('admin.master.blooms.index')
            ->with('success', 'Bloom level updated successfully.');
    }

    /**
     * Toggle bloom level active status.
     */
    public function toggleStatus(Request $request, string $id)
    {
        $bloom = Bloom::findOrFail($id);
        
        $bloom->update([
            'is_active' => !$bloom->is_active
        ]);

        return redirect()->route('admin.master.blooms.index')
            ->with('success', 'Bloom level status updated successfully.');
    }
}
