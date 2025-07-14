<?php

namespace Database\Seeders;

use App\Models\DiagnosticDomain;
use App\Models\DiagnosticPhase;
use Illuminate\Database\Seeder;

class UpdateDomainPhaseMapping extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all domains ordered by priority_order or id
        $domains = DiagnosticDomain::orderBy('priority_order')->orderBy('id')->get();
        
        // Get all phases
        $phases = DiagnosticPhase::orderBy('order_sequence')->get();
        
        // Map domains to phases (5 domains per phase)
        $domainsPerPhase = 5;
        
        $domains->each(function ($domain, $index) use ($phases, $domainsPerPhase) {
            // Calculate which phase this domain belongs to (0-based index)
            $phaseIndex = floor($index / $domainsPerPhase);
            
            // Calculate order within the phase (1-based)
            $phaseOrder = ($index % $domainsPerPhase) + 1;
            
            if (isset($phases[$phaseIndex])) {
                $domain->update([
                    'phase_id' => $phases[$phaseIndex]->id,
                    'phase_order' => $phaseOrder,
                ]);
                
                echo "Domain {$domain->id} ({$domain->name}) -> Phase {$phases[$phaseIndex]->order_sequence}, Order {$phaseOrder}\n";
            }
        });
        
        echo "\nDomain-Phase Mapping Complete:\n";
        echo "- Phase 1: Domains 1-5\n";
        echo "- Phase 2: Domains 6-10\n";
        echo "- Phase 3: Domains 11-15\n";
        echo "- Phase 4: Domains 16-20\n";
    }
}
