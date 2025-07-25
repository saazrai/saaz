<?php

namespace Database\Seeders;

use App\Models\DiagnosticDomain;
use App\Models\DiagnosticPhase;
use Illuminate\Database\Seeder;

class DiagnosticPhasesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create the 4 diagnostic phases
        $phases = [
            [
                'name' => 'Foundation & Governance',
                'description' => 'Foundational security concepts and organizational governance frameworks',
                'order_sequence' => 1,
                'min_questions_per_domain' => 5,
                'target_domains' => 5,
                'completion_criteria' => [
                    'min_domains_completed' => 4,
                    'min_questions_per_domain' => 3,
                    'min_overall_score' => 60,
                ],
                'color' => 'blue',
                'icon' => 'shield',
                'is_active' => true,
            ],
            [
                'name' => 'Technical Controls',
                'description' => 'Technical security controls and assessment methodologies',
                'order_sequence' => 2,
                'min_questions_per_domain' => 5,
                'target_domains' => 5,
                'completion_criteria' => [
                    'min_domains_completed' => 4,
                    'min_questions_per_domain' => 3,
                    'min_overall_score' => 65,
                ],
                'color' => 'purple',
                'icon' => 'cog',
                'is_active' => true,
            ],
            [
                'name' => 'Infrastructure & Applications',
                'description' => 'Infrastructure, applications, and system security architecture',
                'order_sequence' => 3,
                'min_questions_per_domain' => 5,
                'target_domains' => 5,
                'completion_criteria' => [
                    'min_domains_completed' => 4,
                    'min_questions_per_domain' => 3,
                    'min_overall_score' => 70,
                ],
                'color' => 'green',
                'icon' => 'server',
                'is_active' => true,
            ],
            [
                'name' => 'Operations & Response',
                'description' => 'Security operations, incident response, and business continuity',
                'order_sequence' => 4,
                'min_questions_per_domain' => 5,
                'target_domains' => 5,
                'completion_criteria' => [
                    'min_domains_completed' => 4,
                    'min_questions_per_domain' => 3,
                    'min_overall_score' => 75,
                ],
                'color' => 'orange',
                'icon' => 'bell',
                'is_active' => true,
            ],
        ];

        foreach ($phases as $phaseData) {
            DiagnosticPhase::create($phaseData);
        }

        // Map domains to phases based on their current structure
        $domainPhaseMapping = [
            // Phase 1: Foundation & Governance (D1-D5)
            1 => [
                'General Security Concepts',
                'Information Security Governance',
                'Legal, Regulatory & Compliance',
                'Privacy',
                'Risk Management',
            ],
            // Phase 2: Technical Controls (D6-D10)
            2 => [
                'Security Audits & Assessments',
                'Threat & Vulnerability Management',
                'Cryptography & Key Management',
                'Data Governance',
                'Identity and Access Management (IAM)',
            ],
            // Phase 3: Infrastructure & Applications (D11-D15)
            3 => [
                'Network Concepts',
                'Network Security',
                'Application Security',
                'Cloud Security',
                'Endpoint, Mobile & IoT Security',
            ],
            // Phase 4: Operations & Response (D16-D20)
            4 => [
                'Security Awareness & Human Factors',
                'Physical & Environmental Security',
                'Security Operations & Monitoring',
                'Incident Management',
                'Business Continuity & Disaster Recovery',
            ],
        ];

        // Update domains with phase assignments
        $phases = DiagnosticPhase::all()->keyBy('order_sequence');

        foreach ($domainPhaseMapping as $phaseOrder => $domainNames) {
            $phase = $phases[$phaseOrder];

            foreach ($domainNames as $order => $domainName) {
                $domain = DiagnosticDomain::where('name', $domainName)->first();

                if ($domain) {
                    $domain->update([
                        'phase_id' => $phase->id,
                        'phase_order' => $order + 1, // 1-based ordering
                    ]);
                }
            }
        }
    }
}
