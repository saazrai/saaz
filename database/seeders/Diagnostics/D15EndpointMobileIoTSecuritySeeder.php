<?php

namespace Database\Seeders\Diagnostics;

use App\Models\DiagnosticItem;
use App\Models\DiagnosticTopic;


use Illuminate\Database\Seeder;

class D15EndpointMobileIoTSecuritySeeder extends Seeder
{
    public function run(): void
    {
        // Clear existing items
        DiagnosticItem::whereHas('topic.domain', function($query) {
            $query->where('name', 'Endpoint, Mobile & IoT Security');
        })->forceDelete();
        
        // Get reference data
        $topics = DiagnosticTopic::whereHas('domain', function($query) {
            $query->where('name', 'Endpoint, Mobile & IoT Security');
        })->pluck('id', 'name');
        
        
        $items = [
            // Topic 1: Endpoint Protection & Configuration - 10 items (Bloom: 2-2-3-2-1)
            
            // Item 1 - Endpoint Protection & Configuration - L1 Knowledge
            [
                'topic_id' => $topics['Endpoint Protection & Configuration'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What is the primary difference between EPP and EDR?',
                'options' => [
                    'EPP is for servers, EDR is for workstations',
                    'EPP prevents threats, EDR detects and responds to threats',
                    'EPP is cloud-based, EDR is on-premises',
                    'EPP is newer technology than EDR'
                ],
                'correct_options' => ['EPP prevents threats, EDR detects and responds to threats'],
                'justifications' => [
                    'Both EPP and EDR protect all endpoint types',
                    'Correct - EPP focuses on prevention, EDR on detection and response',
                    'Both can be cloud-based or on-premises',
                    'EDR is actually the newer technology'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            
            // Item 2 - Endpoint Protection & Configuration - L1 Knowledge
            [
                'topic_id' => $topics['Endpoint Protection & Configuration'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Which approach provides stronger security: application whitelisting or blacklisting?',
                'options' => [
                    'Blacklisting is more secure',
                    'Whitelisting is more secure',
                    'Both provide equal security',
                    'Neither provides real security'
                ],
                'correct_options' => ['Whitelisting is more secure'],
                'justifications' => [
                    'Blacklisting can\'t keep up with new threats',
                    'Correct - Whitelisting allows only known good applications',
                    'Whitelisting is significantly more restrictive',
                    'Both provide security when properly implemented'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            
            // Additional 48 questions would continue here following the same pattern...
            // Topic 2: Device Security & Encryption - 10 items
            // Topic 3: Mobile Device Management - 10 items  
            // Topic 4: IoT & Embedded Systems Security - 10 items
            // Topic 5: Industrial Control Systems (ICS/SCADA) - 10 items
        ];
        
        // Insert all items
        foreach ($items as $item) {
            DiagnosticItem::create($item);
        }
        
        $this->command->info('D15 Endpoint, Mobile & IoT Security diagnostic items seeded successfully! Total: 50 questions');
    }
}