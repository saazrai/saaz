<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DiagnosticPhase;
use App\Models\DiagnosticDomain;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class DiagnosticPhaseController extends Controller
{
    /**
     * Display listing of diagnostic phases.
     */
    public function index(): Response
    {
        $phases = DiagnosticPhase::with(['domains' => function ($query) {
            $query->select('id', 'phase_id', 'name', 'code', 'color', 'is_active');
        }])
            ->withCount('domains')
            ->withCount(['diagnostics' => function ($query) {
                $query->whereColumn('diagnostics.phase_id', 'diagnostic_phases.id');
            }])
            ->ordered()
            ->get();

        return Inertia::render('Admin/Diagnostics/Phases/Index', [
            'phases' => $phases,
        ]);
    }

    /**
     * Show form for editing phase.
     */
    public function edit(DiagnosticPhase $diagnosticPhase): Response
    {
        $diagnosticPhase->load('domains:id,phase_id,name,code,description,color,phase_order');

        $availableDomains = DiagnosticDomain::where(function ($query) use ($diagnosticPhase) {
            $query->whereNull('phase_id')
                ->orWhere('phase_id', $diagnosticPhase->id);
        })
            ->select('id', 'phase_id', 'name', 'code', 'description', 'color', 'phase_order')
            ->orderBy('name')
            ->get();

        return Inertia::render('Admin/Diagnostics/Phases/Edit', [
            'phase' => $diagnosticPhase,
            'availableDomains' => $availableDomains,
        ]);
    }

    /**
     * Update specified phase.
     */
    public function update(Request $request, DiagnosticPhase $diagnosticPhase)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('diagnostic_phases')->ignore($diagnosticPhase)],
            'description' => 'nullable|string',
            'order_sequence' => ['required', 'integer', 'min:1', Rule::unique('diagnostic_phases')->ignore($diagnosticPhase)],
            'min_questions_per_domain' => 'required|integer|min:1|max:50',
            'target_domains' => 'required|integer|min:1|max:10',
            'color' => 'nullable|string|max:20',
            'icon' => 'nullable|string|max:50',
            'is_active' => 'boolean',
            'domain_ids' => 'array',
            'domain_ids.*' => 'exists:diagnostic_domains,id',
        ]);

        DB::transaction(function () use ($validated, $diagnosticPhase) {
            $diagnosticPhase->update($validated);

            // Update domain assignments
            if (isset($validated['domain_ids'])) {
                // Remove domains no longer assigned
                DiagnosticDomain::where('phase_id', $diagnosticPhase->id)
                    ->whereNotIn('id', $validated['domain_ids'])
                    ->update(['phase_id' => null, 'phase_order' => null]);

                // Assign new domains
                $sequence = 1;
                foreach ($validated['domain_ids'] as $domainId) {
                    DiagnosticDomain::where('id', $domainId)
                        ->update([
                            'phase_id' => $diagnosticPhase->id,
                            'phase_order' => $sequence++
                        ]);
                }
            }
        });

        return redirect()->route('admin.diagnostics.phases.index')
            ->with('success', 'Diagnostic phase updated successfully.');
    }



    /**
     * Toggle phase active status.
     */
    public function toggleActive(DiagnosticPhase $diagnosticPhase)
    {
        $diagnosticPhase->update([
            'is_active' => !$diagnosticPhase->is_active
        ]);

        $status = $diagnosticPhase->is_active ? 'activated' : 'deactivated';

        return back()->with('success', "Phase {$status} successfully.");
    }

    /**
     * Get domains available for assignment.
     */
    public function availableDomains(Request $request)
    {
        $excludePhaseId = $request->get('exclude_phase_id');

        $domains = DiagnosticDomain::where(function ($query) use ($excludePhaseId) {
            $query->whereNull('phase_id');
            if ($excludePhaseId) {
                $query->orWhere('phase_id', $excludePhaseId);
            }
        })
            ->select('id', 'name', 'code', 'description', 'color', 'phase_id', 'phase_order')
            ->orderBy('name')
            ->get();

        return response()->json($domains);
    }

    /**
     * Assign domains to phase.
     */
    public function assignDomains(Request $request, DiagnosticPhase $diagnosticPhase)
    {
        $validated = $request->validate([
            'domain_ids' => 'required|array',
            'domain_ids.*' => 'exists:diagnostic_domains,id',
        ]);

        DB::transaction(function () use ($validated, $diagnosticPhase) {
            $sequence = DiagnosticDomain::where('phase_id', $diagnosticPhase->id)
                ->max('phase_order') ?? 0;

            foreach ($validated['domain_ids'] as $domainId) {
                DiagnosticDomain::where('id', $domainId)
                    ->update([
                        'phase_id' => $diagnosticPhase->id,
                        'phase_order' => ++$sequence
                    ]);
            }
        });

        return response()->json([
            'message' => 'Domains assigned successfully.',
            'phase' => $diagnosticPhase->load('domains')
        ]);
    }
}