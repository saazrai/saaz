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
        
        // Get topic references
        $topics = DiagnosticTopic::whereHas('domain', function($query) {
            $query->where('name', 'Endpoint, Mobile & IoT Security');
        })->pluck('id', 'name');
        
        $items = [
            // Topic 1: Endpoint Security - Questions 1-10 (Bloom: 2-2-3-2-1)
            
            // Item 1 - Endpoint Security - L1 Knowledge
            [
                'topic_id' => $topics['Endpoint Security'] ?? 1,
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
                'difficulty_level' => 1,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            
            // Item 2 - Endpoint Security - L1 Knowledge
            [
                'topic_id' => $topics['Endpoint Security'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What does XDR extend beyond traditional EDR capabilities?',
                'options' => [
                    'Only email security',
                    'Network, cloud, and email telemetry correlation',
                    'Only cloud workload protection',
                    'Only network traffic analysis'
                ],
                'correct_options' => ['Network, cloud, and email telemetry correlation'],
                'justifications' => [
                    'XDR includes email but extends beyond it',
                    'Correct - XDR correlates data across multiple security layers',
                    'XDR includes cloud but is not limited to it',
                    'XDR includes network but extends beyond it'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            
            // Item 3 - Endpoint Security - L2 Comprehension
            [
                'topic_id' => $topics['Endpoint Security'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Which application control method allows only pre-approved software to execute?',
                'options' => [
                    'Blacklisting',
                    'Whitelisting',
                    'Graylisting',
                    'Sandboxing'
                ],
                'correct_options' => ['Whitelisting'],
                'justifications' => [
                    'Blacklisting blocks known bad software but allows unknown',
                    'Correct - Whitelisting only permits approved applications',
                    'Graylisting is for email, not application control',
                    'Sandboxing isolates but doesn\'t control execution'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            
            // Item 4 - Endpoint Security - L2 Comprehension
            [
                'topic_id' => $topics['Endpoint Security'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What is the primary purpose of security baselines in endpoint management?',
                'options' => [
                    'To create backup images',
                    'To establish minimum security configuration standards',
                    'To monitor network traffic',
                    'To encrypt hard drives'
                ],
                'correct_options' => ['To establish minimum security configuration standards'],
                'justifications' => [
                    'Baselines are configuration standards, not backup solutions',
                    'Correct - Baselines define minimum security configuration requirements',
                    'Baselines are about configuration, not network monitoring',
                    'Baselines cover broader configuration, not just encryption'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            
            // Item 5 - Endpoint Security - L3 Application
            [
                'topic_id' => $topics['Endpoint Security'] ?? 1,
                'type_id' => 2,
                'dimension' => 'Technical',
                'content' => 'Select all components typically included in endpoint configuration management:',
                'options' => [
                    'Patch management',
                    'Software inventory',
                    'Network firewall rules',
                    'Registry settings',
                    'User account provisioning',
                    'Hardware asset tracking'
                ],
                'correct_options' => ['Patch management', 'Software inventory', 'Registry settings', 'Hardware asset tracking'],
                'justifications' => [
                    'Patch management is core to endpoint configuration',
                    'Software inventory tracks installed applications',
                    'Network firewall rules are network-level, not endpoint configuration',
                    'Registry settings are part of endpoint configuration',
                    'User account provisioning is identity management, not endpoint configuration',
                    'Hardware asset tracking is part of endpoint management'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Item 6 - Endpoint Security - L3 Application
            [
                'topic_id' => $topics['Endpoint Security'] ?? 1,
                'type_id' => 5,
                'dimension' => 'Technical',
                'content' => 'Match each capability with the appropriate technology:',
                'options' => [
                    'items' => [
                        'Signature-based malware detection',
                        'Behavioral threat hunting',
                        'Cross-platform telemetry correlation',
                        'Real-time file blocking'
                    ],
                    'responses' => [
                        'EPP',
                        'EDR',
                        'XDR',
                        'EPP'
                    ]
                ],
                'correct_options' => [
                    'Signature-based malware detection' => 'EPP',
                    'Behavioral threat hunting' => 'EDR',
                    'Cross-platform telemetry correlation' => 'XDR',
                    'Real-time file blocking' => 'EPP'
                ],
                'justifications' => [
                    'Signature-based malware detection' => 'Traditional EPP capability for known threats',
                    'Behavioral threat hunting' => 'EDR analyzes behavior patterns for threats',
                    'Cross-platform telemetry correlation' => 'XDR extends beyond endpoints to correlate data',
                    'Real-time file blocking' => 'EPP prevents execution of malicious files'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Item 7 - Endpoint Security - L3 Application
            [
                'topic_id' => $topics['Endpoint Security'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'In an XDR implementation, which data source provides the most comprehensive view of lateral movement?',
                'options' => [
                    'Endpoint process telemetry only',
                    'Network traffic logs only',
                    'Correlated endpoint and network telemetry',
                    'Email security logs only'
                ],
                'correct_options' => ['Correlated endpoint and network telemetry'],
                'justifications' => [
                    'Endpoint telemetry alone misses network-based movement',
                    'Network logs alone miss endpoint-based activities',
                    'Correct - Correlation shows complete lateral movement patterns',
                    'Email logs don\'t track lateral movement within networks'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Item 8 - Endpoint Security - L4 Analysis
            [
                'topic_id' => $topics['Endpoint Security'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Why might an organization choose application whitelisting over blacklisting for critical systems?',
                'options' => [
                    'Whitelisting requires less maintenance',
                    'Whitelisting provides better protection against unknown threats',
                    'Whitelisting has lower performance impact',
                    'Whitelisting is easier to implement'
                ],
                'correct_options' => ['Whitelisting provides better protection against unknown threats'],
                'justifications' => [
                    'Whitelisting actually requires more maintenance than blacklisting',
                    'Correct - Whitelisting blocks unknown/zero-day threats by default',
                    'Whitelisting can have higher performance impact due to constant checking',
                    'Whitelisting is typically more complex to implement'
                ],
                'difficulty_level' => 4,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            
            // Item 9 - Endpoint Security - L4 Analysis
            [
                'topic_id' => $topics['Endpoint Security'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What is the primary advantage of XDR over traditional SIEM for incident response?',
                'options' => [
                    'XDR replaces all security tools',
                    'XDR provides automated response capabilities with context',
                    'XDR only focuses on endpoints',
                    'XDR is less expensive than SIEM'
                ],
                'correct_options' => ['XDR provides automated response capabilities with context'],
                'justifications' => [
                    'XDR complements rather than replaces all security tools',
                    'Correct - XDR combines detection, investigation, and response with rich context',
                    'XDR extends beyond endpoints to multiple security layers',
                    'Cost comparison varies by implementation and vendor'
                ],
                'difficulty_level' => 4,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            
            // Item 10 - Endpoint Security - L5 Synthesis
            [
                'topic_id' => $topics['Endpoint Security'] ?? 1,
                'type_id' => 4,
                'dimension' => 'Technical',
                'content' => 'Design an endpoint security strategy for a financial institution with 5,000 endpoints. Rank these components in order of implementation priority:',
                'options' => [
                    'XDR deployment',
                    'EPP with real-time protection',
                    'Security baseline enforcement',
                    'EDR implementation',
                    'Application whitelisting for critical systems'
                ],
                'correct_options' => ['EPP with real-time protection', 'Security baseline enforcement', 'EDR implementation', 'Application whitelisting for critical systems', 'XDR deployment'],
                'justifications' => [
                    'XDR deployment' => 'Advanced capability built on foundation of other tools',
                    'EPP with real-time protection' => 'Foundation - must prevent known threats first',
                    'Security baseline enforcement' => 'Essential configuration security foundation',
                    'EDR implementation' => 'Detection and response capabilities for advanced threats',
                    'Application whitelisting for critical systems' => 'High-value protection for most critical assets'
                ],
                'difficulty_level' => 5,
                'bloom_level' => 5,
                'status' => 'published'
            ],
            
            // Topic 2: Device Security - Questions 11-20 (Bloom: 1-2-3-2-2)
            
            // Item 11 - Device Security - L1 Knowledge
            [
                'topic_id' => $topics['Device Security'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What is the primary purpose of a Trusted Platform Module (TPM)?',
                'options' => [
                    'To encrypt network traffic',
                    'To provide hardware-based cryptographic functions',
                    'To manage user passwords',
                    'To scan for malware'
                ],
                'correct_options' => ['To provide hardware-based cryptographic functions'],
                'justifications' => [
                    'TPM is not for network encryption specifically',
                    'Correct - TPM provides secure key storage and cryptographic operations',
                    'TPM is not primarily for password management',
                    'TPM is not a malware scanning tool'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            
            // Item 12 - Device Security - L2 Comprehension
            [
                'topic_id' => $topics['Device Security'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What happens during the secure boot process?',
                'options' => [
                    'The operating system encrypts all files',
                    'Digital signatures of boot components are verified',
                    'User credentials are authenticated',
                    'Network connections are established'
                ],
                'correct_options' => ['Digital signatures of boot components are verified'],
                'justifications' => [
                    'File encryption occurs after boot, not during secure boot',
                    'Correct - Secure boot verifies integrity of boot components',
                    'User authentication happens after system boot',
                    'Network establishment is not part of secure boot process'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            
            // Item 13 - Device Security - L2 Comprehension
            [
                'topic_id' => $topics['Device Security'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Which type of encryption protects data if a device is stolen?',
                'options' => [
                    'File-level encryption only',
                    'Full disk encryption',
                    'Network encryption only',
                    'Database encryption only'
                ],
                'correct_options' => ['Full disk encryption'],
                'justifications' => [
                    'File-level encryption only protects specific files',
                    'Correct - Full disk encryption protects all data if device is stolen',
                    'Network encryption protects data in transit, not at rest',
                    'Database encryption only protects database files'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            
            // Item 14 - Device Security - L3 Application
            [
                'topic_id' => $topics['Device Security'] ?? 1,
                'type_id' => 2,
                'dimension' => 'Technical',
                'content' => 'Select all components involved in maintaining firmware integrity:',
                'options' => [
                    'Digital signatures',
                    'Hash verification',
                    'Password complexity',
                    'Measured boot',
                    'Network firewalls',
                    'Secure update channels'
                ],
                'correct_options' => ['Digital signatures', 'Hash verification', 'Measured boot', 'Secure update channels'],
                'justifications' => [
                    'Digital signatures verify firmware authenticity',
                    'Hash verification ensures firmware hasn\'t been modified',
                    'Password complexity is not related to firmware integrity',
                    'Measured boot verifies system state during startup',
                    'Network firewalls don\'t directly maintain firmware integrity',
                    'Secure update channels prevent tampering during firmware updates'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Item 15 - Device Security - L3 Application
            [
                'topic_id' => $topics['Device Security'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'In a UEFI secure boot implementation, what happens if a boot component fails signature verification?',
                'options' => [
                    'The system boots normally with a warning',
                    'The boot process is halted',
                    'The component is automatically updated',
                    'The system boots in safe mode'
                ],
                'correct_options' => ['The boot process is halted'],
                'justifications' => [
                    'Secure boot prevents normal operation with invalid signatures',
                    'Correct - Boot process stops to prevent potentially compromised components',
                    'Secure boot doesn\'t automatically update components',
                    'Secure boot doesn\'t fall back to safe mode'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Item 16 - Device Security - L3 Application
            [
                'topic_id' => $topics['Device Security'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Which hardware security feature provides isolated execution environment for sensitive operations?',
                'options' => [
                    'TPM only',
                    'Secure enclave/TEE',
                    'Standard CPU cache',
                    'Regular system memory'
                ],
                'correct_options' => ['Secure enclave/TEE'],
                'justifications' => [
                    'TPM stores keys but doesn\'t provide execution environment',
                    'Correct - Secure enclave/TEE provides isolated execution',
                    'Standard CPU cache is not secure or isolated',
                    'Regular system memory is accessible to the OS'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Item 17 - Device Security - L4 Analysis
            [
                'topic_id' => $topics['Device Security'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Why is TPM-backed encryption preferred over software-only encryption for enterprise devices?',
                'options' => [
                    'TPM encryption is faster',
                    'TPM provides hardware-based key protection',
                    'TPM encryption uses less disk space',
                    'TPM encryption is easier to recover'
                ],
                'correct_options' => ['TPM provides hardware-based key protection'],
                'justifications' => [
                    'TPM may not be faster than software encryption',
                    'Correct - TPM protects encryption keys in hardware, harder to extract',
                    'TPM doesn\'t affect disk space usage',
                    'TPM-backed encryption is actually harder to recover without proper auth'
                ],
                'difficulty_level' => 4,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            
            // Item 18 - Device Security - L4 Analysis
            [
                'topic_id' => $topics['Device Security'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What is the security advantage of measured boot over secure boot?',
                'options' => [
                    'Measured boot is faster',
                    'Measured boot prevents all malware',
                    'Measured boot provides attestation of system state',
                    'Measured boot requires no hardware support'
                ],
                'correct_options' => ['Measured boot provides attestation of system state'],
                'justifications' => [
                    'Speed is not the primary security advantage',
                    'Measured boot detects but doesn\'t prevent all malware',
                    'Correct - Measured boot creates verifiable system state measurements',
                    'Measured boot typically requires TPM or similar hardware'
                ],
                'difficulty_level' => 4,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            
            // Item 19 - Device Security - L5 Synthesis
            [
                'topic_id' => $topics['Device Security'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'For a high-security environment, which combination provides the strongest device protection?',
                'options' => [
                    'Full disk encryption + antivirus only',
                    'TPM + secure boot + measured boot + full disk encryption',
                    'File-level encryption + firewall only',
                    'Password protection + software encryption only'
                ],
                'correct_options' => ['TPM + secure boot + measured boot + full disk encryption'],
                'justifications' => [
                    'Missing hardware-based security and boot integrity',
                    'Correct - Comprehensive hardware and software protection layers',
                    'Missing boot protection and hardware security',
                    'Missing hardware-based security and boot integrity'
                ],
                'difficulty_level' => 5,
                'bloom_level' => 5,
                'status' => 'published'
            ],
            
            // Item 20 - Device Security - L5 Synthesis
            [
                'topic_id' => $topics['Device Security'] ?? 1,
                'type_id' => 4,
                'dimension' => 'Technical',
                'content' => 'Design a device security strategy for executive laptops. Rank these controls by effectiveness against sophisticated attacks:',
                'options' => [
                    'Password complexity requirements',
                    'TPM-backed full disk encryption',
                    'Secure boot with trusted certificates',
                    'Regular antivirus updates',
                    'Hardware-based authentication'
                ],
                'correct_options' => ['TPM-backed full disk encryption', 'Secure boot with trusted certificates', 'Hardware-based authentication', 'Regular antivirus updates', 'Password complexity requirements'],
                'justifications' => [
                    'Password complexity requirements' => 'Important but weakest against sophisticated attacks',
                    'TPM-backed full disk encryption' => 'Most effective - protects data even if device compromised',
                    'Secure boot with trusted certificates' => 'Prevents boot-level attacks and rootkits',
                    'Regular antivirus updates' => 'Helpful but sophisticated attacks often bypass AV',
                    'Hardware-based authentication' => 'Strong protection against credential theft'
                ],
                'difficulty_level' => 5,
                'bloom_level' => 5,
                'status' => 'published'
            ],
            
            // Topic 3: Mobile Security - Questions 21-30 (Bloom: 2-2-3-2-1)
            
            // Item 21 - Mobile Security - L1 Knowledge
            [
                'topic_id' => $topics['Mobile Security'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What does MDM stand for in mobile security?',
                'options' => [
                    'Mobile Data Management',
                    'Mobile Device Management',
                    'Mobile Detection Management',
                    'Mobile Defense Management'
                ],
                'correct_options' => ['Mobile Device Management'],
                'justifications' => [
                    'Data management is part of MDM but not the full scope',
                    'Correct - Mobile Device Management is the full term',
                    'Detection is not the primary focus of MDM',
                    'Defense is too narrow for MDM capabilities'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            
            // Item 22 - Mobile Security - L1 Knowledge
            [
                'topic_id' => $topics['Mobile Security'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What does BYOD stand for?',
                'options' => [
                    'Bring Your Own Data',
                    'Bring Your Own Device',
                    'Build Your Own Defense',
                    'Buy Your Own Device'
                ],
                'correct_options' => ['Bring Your Own Device'],
                'justifications' => [
                    'BYOD is about devices, not just data',
                    'Correct - Bring Your Own Device policy',
                    'BYOD is not about building defenses',
                    'BYOD is about bringing, not buying devices'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            
            // Item 23 - Mobile Security - L2 Comprehension
            [
                'topic_id' => $topics['Mobile Security'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What is the primary difference between MDM and EMM?',
                'options' => [
                    'MDM is for iOS, EMM is for Android',
                    'EMM includes broader enterprise mobility capabilities beyond device management',
                    'MDM is cloud-based, EMM is on-premises',
                    'There is no difference between MDM and EMM'
                ],
                'correct_options' => ['EMM includes broader enterprise mobility capabilities beyond device management'],
                'justifications' => [
                    'Both MDM and EMM work across mobile platforms',
                    'Correct - EMM includes apps, content, and identity management',
                    'Both can be cloud-based or on-premises',
                    'EMM is an evolution and expansion of MDM capabilities'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            
            // Item 24 - Mobile Security - L2 Comprehension
            [
                'topic_id' => $topics['Mobile Security'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'In a COPE (Corporate Owned, Personally Enabled) model, who owns the device?',
                'options' => [
                    'The employee',
                    'The corporation',
                    'Shared ownership',
                    'The mobile carrier'
                ],
                'correct_options' => ['The corporation'],
                'justifications' => [
                    'In COPE, corporation owns but allows personal use',
                    'Correct - Corporate Owned means company owns the device',
                    'COPE specifically means corporate ownership',
                    'Carrier is not involved in COPE ownership model'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            
            // Item 25 - Mobile Security - L3 Application
            [
                'topic_id' => $topics['Mobile Security'] ?? 1,
                'type_id' => 2,
                'dimension' => 'Technical',
                'content' => 'Select all capabilities typically provided by modern MDM solutions:',
                'options' => [
                    'Remote device wipe',
                    'App installation control',
                    'Network firewall management',
                    'Device encryption enforcement',
                    'Email server configuration',
                    'Compliance policy enforcement'
                ],
                'correct_options' => ['Remote device wipe', 'App installation control', 'Device encryption enforcement', 'Compliance policy enforcement'],
                'justifications' => [
                    'Remote device wipe is core MDM functionality',
                    'App installation control is key MDM capability',
                    'Network firewall management is typically separate from MDM',
                    'Device encryption enforcement is standard MDM feature',
                    'Email server configuration is typically handled by email security solutions',
                    'Compliance policy enforcement is essential MDM function'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Item 26 - Mobile Security - L3 Application
            [
                'topic_id' => $topics['Mobile Security'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Which mobile threat protection technique is most effective against malicious apps?',
                'options' => [
                    'Network-based filtering only',
                    'App store vetting and sandboxing',
                    'Device encryption only',
                    'Password complexity only'
                ],
                'correct_options' => ['App store vetting and sandboxing'],
                'justifications' => [
                    'Network filtering misses locally installed malicious apps',
                    'Correct - App store vetting and sandboxing prevent malicious app execution',
                    'Encryption protects data but doesn\'t prevent malicious app installation',
                    'Password complexity doesn\'t address malicious apps'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Item 27 - Mobile Security - L3 Application
            [
                'topic_id' => $topics['Mobile Security'] ?? 1,
                'type_id' => 5,
                'dimension' => 'Technical',
                'content' => 'Match each mobile security model with its primary characteristic:',
                'options' => [
                    'items' => [
                        'Employee owns and uses personal device for work',
                        'Company provides device for business and personal use',
                        'Company provides device for business use only',
                        'Employee chooses from company-approved devices'
                    ],
                    'responses' => [
                        'BYOD',
                        'COPE',
                        'Corporate-owned',
                        'Choose Your Own Device (CYOD)'
                    ]
                ],
                'correct_options' => [
                    'Employee owns and uses personal device for work' => 'BYOD',
                    'Company provides device for business and personal use' => 'COPE',
                    'Company provides device for business use only' => 'Corporate-owned',
                    'Employee chooses from company-approved devices' => 'Choose Your Own Device (CYOD)'
                ],
                'justifications' => [
                    'Employee owns and uses personal device for work' => 'Classic BYOD model',
                    'Company provides device for business and personal use' => 'COPE allows personal use of corporate devices',
                    'Company provides device for business use only' => 'Traditional corporate-owned model',
                    'Employee chooses from company-approved devices' => 'CYOD provides controlled choice'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Item 28 - Mobile Security - L4 Analysis
            [
                'topic_id' => $topics['Mobile Security'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Why might an organization prefer COPE over BYOD for security-sensitive roles?',
                'options' => [
                    'COPE is less expensive',
                    'COPE provides greater control over device security and compliance',
                    'COPE is easier to manage',
                    'COPE supports more applications'
                ],
                'correct_options' => ['COPE provides greater control over device security and compliance'],
                'justifications' => [
                    'COPE typically has higher upfront costs than BYOD',
                    'Correct - COPE allows full control over device security configuration',
                    'COPE can be more complex due to personal use considerations',
                    'App support depends on platform, not ownership model'
                ],
                'difficulty_level' => 4,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            
            // Item 29 - Mobile Security - L4 Analysis
            [
                'topic_id' => $topics['Mobile Security'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What is the primary security challenge with BYOD implementations?',
                'options' => [
                    'Higher device costs',
                    'Limited app availability',
                    'Balancing security control with user privacy',
                    'Poor network performance'
                ],
                'correct_options' => ['Balancing security control with user privacy'],
                'justifications' => [
                    'BYOD typically reduces device costs for organizations',
                    'App availability is not the primary security concern',
                    'Correct - BYOD creates tension between security needs and privacy rights',
                    'Network performance is not the primary BYOD security challenge'
                ],
                'difficulty_level' => 4,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            
            // Item 30 - Mobile Security - L5 Synthesis
            [
                'topic_id' => $topics['Mobile Security'] ?? 1,
                'type_id' => 4,
                'dimension' => 'Technical',
                'content' => 'Design a mobile security strategy for a healthcare organization. Rank these components by implementation priority:',
                'options' => [
                    'Mobile threat protection deployment',
                    'HIPAA-compliant MDM selection and deployment',
                    'Device encryption enforcement',
                    'App whitelisting for medical applications',
                    'Mobile device policy development'
                ],
                'correct_options' => ['Mobile device policy development', 'HIPAA-compliant MDM selection and deployment', 'Device encryption enforcement', 'App whitelisting for medical applications', 'Mobile threat protection deployment'],
                'justifications' => [
                    'Mobile threat protection deployment' => 'Advanced protection after basic controls established',
                    'HIPAA-compliant MDM selection and deployment' => 'Core platform for enforcing security controls',
                    'Device encryption enforcement' => 'Essential for protecting PHI on mobile devices',
                    'App whitelisting for medical applications' => 'Critical for protecting sensitive medical apps',
                    'Mobile device policy development' => 'Foundation - must establish requirements first'
                ],
                'difficulty_level' => 5,
                'bloom_level' => 5,
                'status' => 'published'
            ],
            
            // Topic 4: IoT Security - Questions 31-40 (Bloom: 2-2-3-2-1)
            
            // Item 31 - IoT Security - L1 Knowledge
            [
                'topic_id' => $topics['IoT Security'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What is a primary security challenge with IoT devices?',
                'options' => [
                    'High processing power',
                    'Limited resources for security controls',
                    'Too much memory',
                    'Excessive network bandwidth'
                ],
                'correct_options' => ['Limited resources for security controls'],
                'justifications' => [
                    'IoT devices typically have limited, not high processing power',
                    'Correct - Constrained resources limit security implementation',
                    'IoT devices typically have limited memory',
                    'IoT devices typically have limited bandwidth'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            
            // Item 32 - IoT Security - L1 Knowledge
            [
                'topic_id' => $topics['IoT Security'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What does "constrained environment" mean in IoT context?',
                'options' => [
                    'Physically small devices only',
                    'Devices with limited processing, memory, or power',
                    'Devices that require internet connection',
                    'Devices that cost less than $100'
                ],
                'correct_options' => ['Devices with limited processing, memory, or power'],
                'justifications' => [
                    'Size is not the defining factor of constrained environments',
                    'Correct - Constrained refers to limited computational resources',
                    'Internet connectivity is not related to constraint level',
                    'Cost is not the primary factor in constraint definition'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            
            // Item 33 - IoT Security - L2 Comprehension
            [
                'topic_id' => $topics['IoT Security'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Why is network segmentation particularly important for IoT devices?',
                'options' => [
                    'To improve device performance',
                    'To isolate potentially vulnerable devices from critical networks',
                    'To reduce network costs',
                    'To increase internet speed'
                ],
                'correct_options' => ['To isolate potentially vulnerable devices from critical networks'],
                'justifications' => [
                    'Segmentation is for security, not performance optimization',
                    'Correct - Segmentation limits blast radius of compromised IoT devices',
                    'Segmentation is for security, not cost reduction',
                    'Segmentation doesn\'t directly increase internet speed'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            
            // Item 34 - IoT Security - L2 Comprehension
            [
                'topic_id' => $topics['IoT Security'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What is a common security problem with IoT device lifecycle management?',
                'options' => [
                    'Devices are too expensive to replace',
                    'Devices are deployed without security updates or patch management',
                    'Devices use too much electricity',
                    'Devices are too difficult to install'
                ],
                'correct_options' => ['Devices are deployed without security updates or patch management'],
                'justifications' => [
                    'Cost is not the primary security lifecycle issue',
                    'Correct - Many IoT devices lack proper update mechanisms',
                    'Power consumption is not a security lifecycle issue',
                    'Installation difficulty is not a security lifecycle issue'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            
            // Item 35 - IoT Security - L3 Application
            [
                'topic_id' => $topics['IoT Security'] ?? 1,
                'type_id' => 2,
                'dimension' => 'Technical',
                'content' => 'Select all security challenges specific to embedded systems in IoT:',
                'options' => [
                    'Limited cryptographic capabilities',
                    'Unlimited storage space',
                    'Difficulty implementing security updates',
                    'High processing power',
                    'Physical tampering risks',
                    'Long operational lifespans without updates'
                ],
                'correct_options' => ['Limited cryptographic capabilities', 'Difficulty implementing security updates', 'Physical tampering risks', 'Long operational lifespans without updates'],
                'justifications' => [
                    'Limited cryptographic capabilities are common in constrained devices',
                    'Embedded systems typically have limited, not unlimited storage',
                    'Update mechanisms are often limited or absent in embedded systems',
                    'Embedded systems typically have limited, not high processing power',
                    'Physical access risks are higher for deployed embedded systems',
                    'Many embedded systems operate for years without updates'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Item 36 - IoT Security - L3 Application
            [
                'topic_id' => $topics['IoT Security'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Which approach is most effective for securing IoT devices with limited update capabilities?',
                'options' => [
                    'Rely on device encryption only',
                    'Implement network-based security controls and segmentation',
                    'Use only strong passwords',
                    'Deploy antivirus on each device'
                ],
                'correct_options' => ['Implement network-based security controls and segmentation'],
                'justifications' => [
                    'Device encryption alone is insufficient without other controls',
                    'Correct - Network controls compensate for device limitations',
                    'Passwords alone don\'t address all IoT security challenges',
                    'Antivirus typically not feasible on constrained IoT devices'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Item 37 - IoT Security - L3 Application
            [
                'topic_id' => $topics['IoT Security'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What is the primary security benefit of implementing IoT device discovery and inventory?',
                'options' => [
                    'Improving device performance',
                    'Identifying and managing security risks of unknown devices',
                    'Reducing network bandwidth usage',
                    'Increasing device battery life'
                ],
                'correct_options' => ['Identifying and managing security risks of unknown devices'],
                'justifications' => [
                    'Discovery and inventory are for security, not performance',
                    'Correct - Visibility is essential for managing IoT security risks',
                    'Discovery is for security visibility, not bandwidth optimization',
                    'Discovery doesn\'t directly affect device battery life'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Item 38 - IoT Security - L4 Analysis
            [
                'topic_id' => $topics['IoT Security'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Why is the "security by obscurity" approach particularly problematic for IoT devices?',
                'options' => [
                    'IoT devices are always visible on networks',
                    'Many IoT devices use common, discoverable protocols and default configurations',
                    'IoT devices are expensive to secure properly',
                    'IoT devices require constant internet connectivity'
                ],
                'correct_options' => ['Many IoT devices use common, discoverable protocols and default configurations'],
                'justifications' => [
                    'Network visibility alone doesn\'t make security by obscurity problematic',
                    'Correct - Common protocols and defaults make IoT devices easily discoverable',
                    'Cost is not the reason security by obscurity fails',
                    'Connectivity requirements don\'t directly relate to obscurity problems'
                ],
                'difficulty_level' => 4,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            
            // Item 39 - IoT Security - L4 Analysis
            [
                'topic_id' => $topics['IoT Security'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What makes IoT botnets particularly dangerous compared to traditional PC botnets?',
                'options' => [
                    'IoT devices have more processing power',
                    'IoT devices are harder to detect and clean',
                    'IoT devices cost more to replace',
                    'IoT devices use more bandwidth'
                ],
                'correct_options' => ['IoT devices are harder to detect and clean'],
                'justifications' => [
                    'IoT devices typically have less processing power than PCs',
                    'Correct - Limited interfaces and update mechanisms make IoT cleanup difficult',
                    'Cost is not what makes IoT botnets more dangerous',
                    'Individual IoT devices typically use less bandwidth than PCs'
                ],
                'difficulty_level' => 4,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            
            // Item 40 - IoT Security - L5 Synthesis
            [
                'topic_id' => $topics['IoT Security'] ?? 1,
                'type_id' => 4,
                'dimension' => 'Technical',
                'content' => 'Design an IoT security strategy for a smart building. Rank these controls by effectiveness:',
                'options' => [
                    'Individual device passwords',
                    'Network segmentation and micro-segmentation',
                    'IoT device discovery and asset management',
                    'Certificate-based device authentication',
                    'Anomaly detection for IoT traffic'
                ],
                'correct_options' => ['Network segmentation and micro-segmentation', 'IoT device discovery and asset management', 'Certificate-based device authentication', 'Anomaly detection for IoT traffic', 'Individual device passwords'],
                'justifications' => [
                    'Individual device passwords' => 'Weakest - often default/weak passwords, hard to manage',
                    'Network segmentation and micro-segmentation' => 'Most effective - limits blast radius and provides fundamental isolation',
                    'IoT device discovery and asset management' => 'Essential foundation - can\'t secure what you don\'t know',
                    'Certificate-based device authentication' => 'Strong authentication mechanism for device identity',
                    'Anomaly detection for IoT traffic' => 'Advanced capability for detecting compromised devices'
                ],
                'difficulty_level' => 5,
                'bloom_level' => 5,
                'status' => 'published'
            ],
            
            // Topic 5: Operational Technology (OT) - Questions 41-50 (Bloom: 2-2-3-2-1)
            
            // Item 41 - Operational Technology (OT) - L1 Knowledge
            [
                'topic_id' => $topics['Operational Technology (OT)'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What does ICS stand for in industrial security?',
                'options' => [
                    'Internet Communication System',
                    'Industrial Control System',
                    'Information Control Standard',
                    'Integrated Computing System'
                ],
                'correct_options' => ['Industrial Control System'],
                'justifications' => [
                    'ICS is not related to internet communication',
                    'Correct - Industrial Control System',
                    'ICS is not about information control standards',
                    'ICS is not about integrated computing'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            
            // Item 42 - Operational Technology (OT) - L1 Knowledge
            [
                'topic_id' => $topics['Operational Technology (OT)'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What does SCADA stand for?',
                'options' => [
                    'System Control and Data Analysis',
                    'Supervisory Control and Data Acquisition',
                    'Secure Communication and Data Access',
                    'Software Control and Device Automation'
                ],
                'correct_options' => ['Supervisory Control and Data Acquisition'],
                'justifications' => [
                    'SCADA is not about system control and analysis',
                    'Correct - Supervisory Control and Data Acquisition',
                    'SCADA is not primarily about secure communication',
                    'SCADA is not about software control and device automation'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            
            // Item 43 - Operational Technology (OT) - L2 Comprehension
            [
                'topic_id' => $topics['Operational Technology (OT)'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'In OT environments, why is availability typically prioritized over confidentiality?',
                'options' => [
                    'OT data is not sensitive',
                    'System downtime can cause safety hazards and production losses',
                    'OT systems are harder to hack',
                    'Confidentiality is not important in industrial settings'
                ],
                'correct_options' => ['System downtime can cause safety hazards and production losses'],
                'justifications' => [
                    'OT data can be very sensitive (trade secrets, safety data)',
                    'Correct - Availability directly impacts safety and operations',
                    'OT systems can be vulnerable to attacks',
                    'Confidentiality is important but secondary to safety'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            
            // Item 44 - Operational Technology (OT) - L2 Comprehension
            [
                'topic_id' => $topics['Operational Technology (OT)'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What is the primary purpose of air-gapping in OT networks?',
                'options' => [
                    'To improve network performance',
                    'To physically isolate critical systems from external networks',
                    'To reduce network costs',
                    'To comply with environmental regulations'
                ],
                'correct_options' => ['To physically isolate critical systems from external networks'],
                'justifications' => [
                    'Air-gapping is for security, not performance optimization',
                    'Correct - Physical isolation prevents network-based attacks',
                    'Air-gapping is for security, not cost reduction',
                    'Air-gapping is for security, not environmental compliance'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            
            // Item 45 - Operational Technology (OT) - L3 Application
            [
                'topic_id' => $topics['Operational Technology (OT)'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What is the primary function of a PLC in industrial control systems?',
                'options' => [
                    'To provide network connectivity',
                    'To control and automate industrial processes',
                    'To store data backups',
                    'To generate reports'
                ],
                'correct_options' => ['To control and automate industrial processes'],
                'justifications' => [
                    'PLCs may have network connectivity but that\'s not their primary function',
                    'Correct - PLCs control machinery and industrial processes',
                    'Data backup is not the primary PLC function',
                    'Report generation is not the primary PLC function'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Item 46 - Operational Technology (OT) - L3 Application
            [
                'topic_id' => $topics['Operational Technology (OT)'] ?? 1,
                'type_id' => 2,
                'dimension' => 'Technical',
                'content' => 'Select all security challenges specific to OT environments:',
                'options' => [
                    'Legacy systems without security updates',
                    'Real-time operational requirements',
                    'Unlimited computational resources',
                    'Safety-critical operations',
                    'High network bandwidth',
                    'Long system lifecycles (10-20 years)'
                ],
                'correct_options' => ['Legacy systems without security updates', 'Real-time operational requirements', 'Safety-critical operations', 'Long system lifecycles (10-20 years)'],
                'justifications' => [
                    'Legacy systems in OT often lack security update mechanisms',
                    'OT typically has limited, not unlimited computational resources',
                    'Real-time requirements limit security control implementation',
                    'OT typically has limited, not high network bandwidth',
                    'Safety-critical nature requires careful security implementation',
                    'Long lifecycles mean systems operate with outdated security'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Item 47 - Operational Technology (OT) - L3 Application
            [
                'topic_id' => $topics['Operational Technology (OT)'] ?? 1,
                'type_id' => 5,
                'dimension' => 'Technical',
                'content' => 'Match each OT component with its primary function:',
                'options' => [
                    'items' => [
                        'Monitors and controls distributed systems remotely',
                        'Interfaces between operators and control systems',
                        'Controls machinery and processes directly',
                        'Connects field devices to control networks'
                    ],
                    'responses' => [
                        'SCADA',
                        'HMI',
                        'PLC',
                        'RTU'
                    ]
                ],
                'correct_options' => [
                    'Monitors and controls distributed systems remotely' => 'SCADA',
                    'Interfaces between operators and control systems' => 'HMI',
                    'Controls machinery and processes directly' => 'PLC',
                    'Connects field devices to control networks' => 'RTU'
                ],
                'justifications' => [
                    'Monitors and controls distributed systems remotely' => 'SCADA provides supervisory control over distributed systems',
                    'Interfaces between operators and control systems' => 'HMI (Human Machine Interface) provides operator interaction',
                    'Controls machinery and processes directly' => 'PLC (Programmable Logic Controller) provides direct process control',
                    'Connects field devices to control networks' => 'RTU (Remote Terminal Unit) interfaces field devices'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Item 48 - Operational Technology (OT) - L4 Analysis
            [
                'topic_id' => $topics['Operational Technology (OT)'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Why is patching particularly challenging in OT environments compared to IT environments?',
                'options' => [
                    'OT patches are more expensive',
                    'Downtime for patching can affect safety and production',
                    'OT systems have faster processors',
                    'OT patches are released more frequently'
                ],
                'correct_options' => ['Downtime for patching can affect safety and production'],
                'justifications' => [
                    'Cost is not the primary patching challenge in OT',
                    'Correct - OT systems often cannot be taken offline for routine maintenance',
                    'Processing power is not related to patching challenges',
                    'OT patches are typically released less frequently than IT patches'
                ],
                'difficulty_level' => 4,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            
            // Item 49 - Operational Technology (OT) - L4 Analysis
            [
                'topic_id' => $topics['Operational Technology (OT)'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What is the primary security concern when connecting OT systems to corporate IT networks?',
                'options' => [
                    'Increased bandwidth usage',
                    'Introduction of IT-based attack vectors to OT environment',
                    'Higher licensing costs',
                    'Reduced system performance'
                ],
                'correct_options' => ['Introduction of IT-based attack vectors to OT environment'],
                'justifications' => [
                    'Bandwidth is not the primary security concern',
                    'Correct - IT connectivity exposes OT to malware and IT-based attacks',
                    'Licensing costs are not a security concern',
                    'Performance impact is not the primary security concern'
                ],
                'difficulty_level' => 4,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            
            // Item 50 - Operational Technology (OT) - L5 Synthesis
            [
                'topic_id' => $topics['Operational Technology (OT)'] ?? 1,
                'type_id' => 4,
                'dimension' => 'Technical',
                'content' => 'Design a security strategy for connecting an OT network to corporate IT. Rank these controls by implementation priority:',
                'options' => [
                    'OT network monitoring and anomaly detection',
                    'Industrial DMZ with firewalls',
                    'Asset inventory and network mapping',
                    'OT-specific incident response procedures',
                    'Air-gap assessment and risk analysis'
                ],
                'correct_options' => ['Air-gap assessment and risk analysis', 'Asset inventory and network mapping', 'Industrial DMZ with firewalls', 'OT network monitoring and anomaly detection', 'OT-specific incident response procedures'],
                'justifications' => [
                    'OT network monitoring and anomaly detection' => 'Important ongoing capability once basic protections established',
                    'Industrial DMZ with firewalls' => 'Core network protection for IT-OT connectivity',
                    'Asset inventory and network mapping' => 'Essential foundation - must understand what needs protection',
                    'OT-specific incident response procedures' => 'Critical but built on foundation of other controls',
                    'Air-gap assessment and risk analysis' => 'First step - understand current state and risks before connecting'
                ],
                'difficulty_level' => 5,
                'bloom_level' => 5,
                'status' => 'published'
            ]
        ];
        
        // Insert all items
        foreach ($items as $item) {
            DiagnosticItem::create($item);
        }
        
        $this->command->info('D15 Endpoint, Mobile & IoT Security questions seeded successfully! Total: 50 questions across 5 topics');
    }
}