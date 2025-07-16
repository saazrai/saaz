<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DiagnosticItemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * 
     * This seeder orchestrates the execution of all 20 domain-specific seeders
     * Each domain seeder creates 50 questions with proper Bloom taxonomy distribution:
     * - Level 1 (Remember): 7 questions (14%)
     * - Level 2 (Understand): 10 questions (20%)
     * - Level 3 (Apply): 16 questions (32%)
     * - Level 4 (Analyze): 10 questions (20%)
     * - Level 5 (Evaluate): 7 questions (14%)
     * 
     * Total: 1000 questions (50 per domain × 20 domains)
     */
    public function run(): void
    {
        $this->command->info('Seeding diagnostic questions for all 20 domains...');
        
        // Call all domain-specific seeders
        $this->call([
            // Domain 1: General Security Concepts
            Diagnostics\D1GeneralSecurityConceptsSeeder::class,
            
            // Domain 2: Information Security Governance
            Diagnostics\D2InformationSecurityGovernanceSeeder::class,
            
            // Domain 3: Legal, Regulatory & Compliance
            Diagnostics\D3LegalRegulatoryComplianceSeeder::class,
            
            // Domain 4: Privacy
            Diagnostics\D4PrivacySeeder::class,
            
            // Domain 5: Risk Management
            Diagnostics\D5RiskManagementSeeder::class,
            
            // Domain 6: Security Audits & Assessments
            Diagnostics\D6SecurityAuditsAssessmentsSeeder::class,
            
            // Domain 7: Threat & Vulnerability Management
            Diagnostics\D7ThreatVulnerabilityManagementSeeder::class,
            
            // Domain 8: Cryptography & Key Management
            Diagnostics\D8CryptographyKeyManagementSeeder::class,
            
            // Domain 9: Data Governance
            Diagnostics\D9DataGovernanceSeeder::class,
            
            // Domain 10: Access Control
            Diagnostics\D10AccessControlSeeder::class,
            
            // Domain 11: Network & Communication Security
            Diagnostics\D11NetworkCommunicationSecuritySeeder::class,
            
            // Domain 12: Application Security & DevSecOps
            Diagnostics\D12ApplicationSecurityDevSecOpsSeeder::class,
            
            // Domain 13: Cloud Security
            Diagnostics\D13CloudSecuritySeeder::class,
            
            // Domain 14: Endpoint, Mobile & IoT Security
            Diagnostics\D14EndpointMobileIoTSecuritySeeder::class,
            
            // Domain 15: Security Architecture & Design
            Diagnostics\D15SecurityArchitectureDesignSeeder::class,
            
            // Domain 16: Security Awareness & Human Factors
            Diagnostics\D16SecurityAwarenessHumanFactorsSeeder::class,
            
            // Domain 17: Physical & Environmental Security
            Diagnostics\D17PhysicalEnvironmentalSecuritySeeder::class,
            
            // Domain 18: Security Operations & Monitoring
            Diagnostics\D18SecurityOperationsMonitoringSeeder::class,
            
            // Domain 19: Incident Management & Forensics
            Diagnostics\D19IncidentManagementForensicsSeeder::class,
            
            // Domain 20: Business Continuity & Disaster Recovery
            Diagnostics\D20BusinessContinuityDisasterRecoverySeeder::class,
        ]);
        
        $this->command->info('✓ All diagnostic questions seeded successfully!');
    }
}