<?php

namespace Database\Seeders\Diagnostics;

use App\Models\DiagnosticItem;
use App\Models\DiagnosticTopic;


use Illuminate\Database\Seeder;

class D14EndpointMobileIoTSecuritySeeder extends Seeder
{
    public function run(): void
    {
        // Get reference data
        $topics = DiagnosticTopic::whereHas('domain', function($query) {
            $query->where('name', 'Endpoint, Mobile & IoT Security');
        })->pluck('id', 'name');
        
        
        $items = [
            // Endpoint Protection Platform (EPP) & EDR - 6 items
            [
                'topic_id' => $topics['Endpoint Protection Platform (EPP) & EDR'] ?? 1,
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
                'bloom_level' => 2,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Endpoint Protection Platform (EPP) & EDR'] ?? 1,
                'type_id' => 5,
                'dimension' => 'Technical',
                'content' => 'Match each capability with the appropriate solution:',
                'options' => [
                    'items' => [
                        'Signature-based malware detection',
                        'Behavioral threat hunting',
                        'Real-time file blocking',
                        'Forensic investigation'
                    ],
                    'responses' => [
                        'EPP',
                        'EDR',
                        'EPP', 
                        'EDR'
                    ]
                ],
                'correct_options' => [
                    'Signature-based malware detection' => 'EPP',
                    'Behavioral threat hunting' => 'EDR',
                    'Real-time file blocking' => 'EPP',
                    'Forensic investigation' => 'EDR'
                ],
                'justifications' => [
                    'Signature-based malware detection' => 'Traditional EPP capability for known threats',
                    'Behavioral threat hunting' => 'EDR analyzes behavior patterns',
                    'Real-time file blocking' => 'EPP prevents execution of malicious files',
                    'Forensic investigation' => 'EDR provides detailed incident analysis'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Endpoint Protection Platform (EPP) & EDR'] ?? 1,
                'type_id' => 3,
                'dimension' => 'Technical',
                'content' => 'Drag the features that are typically found in modern EDR solutions to the drop zone:',
                'options' => [
                    'Continuous endpoint monitoring',
                    'Antivirus signatures only',
                    'Threat timeline visualization',
                    'Basic firewall rules',
                    'Automated threat response',
                    'Patch management'
                ],
                'correct_options' => ['Continuous endpoint monitoring', 'Threat timeline visualization', 'Automated threat response'],
                'justifications' => [
                    'EDR continuously monitors endpoint activity',
                    'EDR goes beyond signatures to behavioral analysis',
                    'EDR shows attack progression over time',
                    'Basic firewall is EPP, not EDR functionality',
                    'EDR can automatically contain threats',
                    'Patch management is separate from EDR'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Endpoint Protection Platform (EPP) & EDR'] ?? 1,
                'type_id' => 2,
                'dimension' => 'Technical',
                'content' => '**True or False:** EDR solutions can detect fileless malware attacks that traditional antivirus might miss.',
                'options' => [
                    'True',
                    'False'
                ],
                'correct_options' => ['True'],
                'justifications' => [
                    'explanation' => 'EDR solutions monitor system behavior and memory, allowing them to detect fileless attacks that operate in memory without dropping files. Traditional antivirus relies on file signatures and would miss these attacks.'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Endpoint Protection Platform (EPP) & EDR'] ?? 1,
                'type_id' => 7,
                'dimension' => 'Technical',
                'content' => 'Analyze this EDR alert and identify the attack technique being used:',
                'options' => [
                    'Credential dumping',
                    'Process injection',
                    'Persistence mechanism',
                    'Lateral movement'
                ],
                'correct_options' => ['Process injection'],
                'justifications' => [
                    'No credential access tools shown',
                    'Correct - PowerShell injecting into svchost indicates process injection',
                    'No registry or startup modifications shown',
                    'Activity is on single host, not moving between systems'
                ],
                'settings' => [
                    'shell' => 'edr-console',
                    'commands' => [
                        [
                            'pattern' => '^investigate alert-1234$',
                            'response' => "Alert Details:\n[HIGH] Suspicious Process Behavior Detected\nHost: WORKSTATION-01\nProcess: powershell.exe (PID: 4532)\nAction: Memory write to svchost.exe (PID: 1244)\nTechnique: Remote thread creation\nCommand Line: powershell.exe -enc [base64_encoded_script]\nRisk Score: 85/100",
                            'isError' => false
                        ]
                    ]
                ],
                'difficulty_level' => 3,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Endpoint Protection Platform (EPP) & EDR'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What is the benefit of combining EPP and EDR into an XDR (Extended Detection and Response) platform?',
                'options' => [
                    'Lower cost only',
                    'Unified visibility across security stack',
                    'Eliminates need for other security tools',
                    'Automatic patching capability'
                ],
                'correct_options' => ['Unified visibility across security stack'],
                'justifications' => [
                    'Cost may not be lower with advanced XDR',
                    'Correct - XDR correlates data across endpoints, network, and cloud',
                    'XDR complements but doesn\'t replace all security tools',
                    'Patching remains a separate function'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 5,
                'status' => 'published'
            ],

            // Application Whitelisting / Blacklisting - 5 items
            [
                'topic_id' => $topics['Application Whitelisting / Blacklisting'] ?? 2,
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
                'bloom_level' => 2,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Application Whitelisting / Blacklisting'] ?? 2,
                'type_id' => 3,
                'dimension' => 'Technical',
                'content' => 'Drag the challenges associated with **application whitelisting** to the drop zone:',
                'options' => [
                    'Administrative overhead',
                    'Cannot stop zero-day malware',
                    'User flexibility restrictions',
                    'Signature updates required',
                    'Initial inventory effort',
                    'High false positive rate'
                ],
                'correct_options' => ['Administrative overhead', 'User flexibility restrictions', 'Initial inventory effort'],
                'justifications' => [
                    'Whitelisting requires ongoing management',
                    'Whitelisting can stop zero-days by default-deny',
                    'Users cannot run unapproved applications',
                    'Whitelisting doesn\'t use signatures',
                    'Creating initial whitelist is resource-intensive',
                    'Whitelisting has low false positives'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Application Whitelisting / Blacklisting'] ?? 2,
                'type_id' => 5,
                'dimension' => 'Technical',
                'content' => 'Match each whitelisting method with its characteristic:',
                'options' => [
                    'items' => [
                        'Path-based',
                        'Hash-based',
                        'Certificate-based',
                        'Publisher-based'
                    ],
                    'responses' => [
                        'Allows any file in specific directories',
                        'Most secure but high maintenance',
                        'Trusts digitally signed applications',
                        'Allows all software from specific vendors'
                    ]
                ],
                'correct_options' => [
                    'Path-based' => 'Allows any file in specific directories',
                    'Hash-based' => 'Most secure but high maintenance',
                    'Certificate-based' => 'Trusts digitally signed applications',
                    'Publisher-based' => 'Allows all software from specific vendors'
                ],
                'justifications' => [
                    'Path-based' => 'Trusts location, vulnerable if attacker gains write access',
                    'Hash-based' => 'Each file version needs new hash',
                    'Certificate-based' => 'Balances security with maintainability',
                    'Publisher-based' => 'Broad trust based on software publisher'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Application Whitelisting / Blacklisting'] ?? 2,
                'type_id' => 2,
                'dimension' => 'Technical',
                'content' => '**True or False:** Application whitelisting is only suitable for servers and not practical for user workstations.',
                'options' => [
                    'True',
                    'False'
                ],
                'correct_options' => ['False'],
                'justifications' => [
                    'explanation' => 'While whitelisting requires more management on workstations, modern solutions make it practical through publisher certificates, automatic learning modes, and cloud-based management. Many organizations successfully implement whitelisting on user workstations.'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Application Whitelisting / Blacklisting'] ?? 2,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'In which environment is application whitelisting MOST appropriate?',
                'options' => [
                    'Development workstations',
                    'Fixed-function systems (kiosks, ATMs)',
                    'BYOD mobile devices',
                    'Home computers'
                ],
                'correct_options' => ['Fixed-function systems (kiosks, ATMs)'],
                'justifications' => [
                    'Developers need flexibility to run various tools',
                    'Correct - Fixed-function systems have predictable software needs',
                    'BYOD devices have too much variation',
                    'Home users need flexibility for personal use'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],

            // Secure Configuration Baselines - 5 items
            [
                'topic_id' => $topics['Secure Configuration Baselines'] ?? 3,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What is the primary source for security configuration baselines?',
                'options' => [
                    'Vendor default settings',
                    'CIS Benchmarks',
                    'User preferences',
                    'Previous configurations'
                ],
                'correct_options' => ['CIS Benchmarks'],
                'justifications' => [
                    'Vendor defaults prioritize functionality over security',
                    'Correct - CIS provides industry-standard security baselines',
                    'User preferences don\'t consider security',
                    'Previous configs may contain vulnerabilities'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Secure Configuration Baselines'] ?? 3,
                'type_id' => 3,
                'dimension' => 'Technical',
                'content' => 'Drag the components that should be included in a secure baseline configuration to the drop zone:',
                'options' => [
                    'Disabled unnecessary services',
                    'Default administrator passwords',
                    'Audit logging enabled',
                    'All ports open for convenience',
                    'Strong password policies',
                    'Auto-login enabled'
                ],
                'correct_options' => ['Disabled unnecessary services', 'Audit logging enabled', 'Strong password policies'],
                'justifications' => [
                    'Reducing attack surface by disabling unused services',
                    'Default passwords are major security risk',
                    'Logging essential for security monitoring',
                    'Open ports increase attack surface',
                    'Strong passwords prevent unauthorized access',
                    'Auto-login bypasses authentication'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Secure Configuration Baselines'] ?? 3,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'How often should security baselines be reviewed and updated?',
                'options' => [
                    'Only when systems are first deployed',
                    'Annually at minimum',
                    'Every 5 years',
                    'Never - baselines should remain static'
                ],
                'correct_options' => ['Annually at minimum'],
                'justifications' => [
                    'Threats evolve after deployment',
                    'Correct - Regular reviews ensure baselines remain effective',
                    'Five years is too long given threat evolution',
                    'Static baselines become outdated quickly'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Secure Configuration Baselines'] ?? 3,
                'type_id' => 4,
                'dimension' => 'Technical',
                'content' => 'Arrange these configuration hardening tasks in order of priority (highest to lowest):',
                'options' => [
                    'Change default credentials',
                    'Enable screensaver locks',
                    'Disable unnecessary services',
                    'Configure audit logging',
                    'Install security updates'
                ],
                'correct_options' => [
                    'Change default credentials',
                    'Install security updates',
                    'Disable unnecessary services',
                    'Configure audit logging',
                    'Enable screensaver locks'
                ],
                'justifications' => ['Default credentials are immediately exploitable. Security updates fix known vulnerabilities. Unnecessary services expand attack surface. Audit logging enables detection. Screensaver locks are important but lower priority.'],
                'difficulty_level' => 3,
                'bloom_level' => 5,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Secure Configuration Baselines'] ?? 3,
                'type_id' => 2,
                'dimension' => 'Technical',
                'content' => '**True or False:** Gold images should be updated with patches before deployment to maintain the baseline.',
                'options' => [
                    'True',
                    'False'
                ],
                'correct_options' => ['True'],
                'justifications' => [
                    'explanation' => 'Gold images should be regularly updated with the latest patches before deployment. This ensures new systems start with current security updates rather than requiring immediate patching after deployment.'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],

            // Device Encryption & Secure Boot - 5 items
            [
                'topic_id' => $topics['Device Encryption & Secure Boot'] ?? 4,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What does Secure Boot protect against?',
                'options' => [
                    'Data theft from stolen devices',
                    'Rootkits and boot-level malware',
                    'Network-based attacks',
                    'Application vulnerabilities'
                ],
                'correct_options' => ['Rootkits and boot-level malware'],
                'justifications' => [
                    'Device encryption protects stolen device data',
                    'Correct - Secure Boot ensures only trusted OS/bootloader runs',
                    'Secure Boot doesn\'t protect network layer',
                    'Secure Boot operates before applications load'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Device Encryption & Secure Boot'] ?? 4,
                'type_id' => 5,
                'dimension' => 'Technical',
                'content' => 'Match each technology with its primary function:',
                'options' => [
                    'items' => [
                        'TPM',
                        'BitLocker',
                        'Secure Boot',
                        'UEFI'
                    ],
                    'responses' => [
                        'Stores encryption keys securely',
                        'Full disk encryption',
                        'Verifies boot process integrity',
                        'Modern firmware interface'
                    ]
                ],
                'correct_options' => [
                    'TPM' => 'Stores encryption keys securely',
                    'BitLocker' => 'Full disk encryption',
                    'Secure Boot' => 'Verifies boot process integrity',
                    'UEFI' => 'Modern firmware interface'
                ],
                'justifications' => [
                    'TPM' => 'Trusted Platform Module secures cryptographic keys',
                    'BitLocker' => 'Microsoft\'s full disk encryption solution',
                    'Secure Boot' => 'Ensures only signed OS components load',
                    'UEFI' => 'Replaced BIOS, enables Secure Boot'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Device Encryption & Secure Boot'] ?? 4,
                'type_id' => 7,
                'dimension' => 'Technical',
                'content' => 'Analyze this system configuration and identify the security issue:',
                'options' => [
                    'Weak encryption algorithm',
                    'No TPM protection for encryption keys',
                    'Secure Boot disabled',
                    'Outdated UEFI firmware'
                ],
                'correct_options' => ['No TPM protection for encryption keys'],
                'justifications' => [
                    'AES-256 is strong encryption',
                    'Correct - BitLocker without TPM is vulnerable to offline attacks',
                    'Secure Boot is shown as enabled',
                    'Firmware version not indicated as outdated'
                ],
                'settings' => [
                    'shell' => 'sysconfig',
                    'commands' => [
                        [
                            'pattern' => '^check security$',
                            'response' => "System Security Configuration:\n[OK] Secure Boot: Enabled\n[OK] BitLocker: Enabled (AES-256)\n[WARNING] TPM: Not detected\n[INFO] BitLocker using password-only mode\n[OK] UEFI Firmware: Version 2.7\n[WARNING] Encryption keys stored in clear text on disk",
                            'isError' => false
                        ]
                    ]
                ],
                'difficulty_level' => 2,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Device Encryption & Secure Boot'] ?? 4,
                'type_id' => 2,
                'dimension' => 'Technical',
                'content' => '**True or False:** Full disk encryption protects data while the system is powered on and unlocked.',
                'options' => [
                    'True',
                    'False'
                ],
                'correct_options' => ['False'],
                'justifications' => [
                    'explanation' => 'Full disk encryption only protects data when the system is powered off or locked. When the system is running and unlocked, the encryption keys are in memory and data is accessible. Additional controls are needed for runtime protection.'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Device Encryption & Secure Boot'] ?? 4,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What happens if Secure Boot detects an unsigned or modified bootloader?',
                'options' => [
                    'It logs the event and continues booting',
                    'It automatically repairs the bootloader',
                    'It prevents the system from booting',
                    'It boots in safe mode'
                ],
                'correct_options' => ['It prevents the system from booting'],
                'justifications' => [
                    'Secure Boot blocks untrusted code execution',
                    'Secure Boot doesn\'t perform repairs',
                    'Correct - System won\'t boot with untrusted bootloader',
                    'Safe mode still requires trusted bootloader'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 3,
                'status' => 'published'
            ],

            // Mobile Device Management (MDM / EMM) - 6 items
            [
                'topic_id' => $topics['Mobile Device Management (MDM / EMM)'] ?? 5,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What is the key difference between MDM and EMM?',
                'options' => [
                    'MDM is for iOS, EMM is for Android',
                    'EMM includes application and content management beyond MDM',
                    'MDM is cloud-based, EMM is on-premises',
                    'There is no difference'
                ],
                'correct_options' => ['EMM includes application and content management beyond MDM'],
                'justifications' => [
                    'Both support all major platforms',
                    'Correct - EMM (Enterprise Mobility Management) extends MDM capabilities',
                    'Both can be cloud or on-premises',
                    'EMM is more comprehensive than MDM'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Mobile Device Management (MDM / EMM)'] ?? 5,
                'type_id' => 3,
                'dimension' => 'Technical',
                'content' => 'Drag the capabilities that MDM solutions typically provide to the drop zone:',
                'options' => [
                    'Remote device wipe',
                    'Source code scanning',
                    'Password policy enforcement',
                    'Network packet inspection',
                    'App distribution control',
                    'Database management'
                ],
                'correct_options' => ['Remote device wipe', 'Password policy enforcement', 'App distribution control'],
                'justifications' => [
                    'MDM can remotely wipe lost/stolen devices',
                    'Source code scanning is development, not MDM',
                    'MDM enforces device password requirements',
                    'Packet inspection requires network tools',
                    'MDM controls which apps can be installed',
                    'Database management is not MDM function'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Mobile Device Management (MDM / EMM)'] ?? 5,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Which MDM enrollment method provides the highest level of control?',
                'options' => [
                    'User-initiated enrollment',
                    'Device Enrollment Program (DEP/ADE)',
                    'Email-based enrollment',
                    'QR code enrollment'
                ],
                'correct_options' => ['Device Enrollment Program (DEP/ADE)'],
                'justifications' => [
                    'Users can skip or remove MDM profiles',
                    'Correct - DEP/ADE enforces MDM that users cannot remove',
                    'Email enrollment can be bypassed',
                    'QR codes simplify but don\'t enforce enrollment'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Mobile Device Management (MDM / EMM)'] ?? 5,
                'type_id' => 2,
                'dimension' => 'Technical',
                'content' => '**True or False:** MDM can separate personal and corporate data on BYOD devices.',
                'options' => [
                    'True',
                    'False'
                ],
                'correct_options' => ['True'],
                'justifications' => [
                    'explanation' => 'Modern MDM solutions support containerization or work profiles that separate corporate and personal data. This allows selective wipe of corporate data while preserving personal information on BYOD devices.'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Mobile Device Management (MDM / EMM)'] ?? 5,
                'type_id' => 5,
                'dimension' => 'Technical',
                'content' => 'Match each MDM policy with its primary purpose:',
                'options' => [
                    'items' => [
                        'Geofencing',
                        'Compliance rules',
                        'App wrapping',
                        'Certificate deployment'
                    ],
                    'responses' => [
                        'Restrict device use by location',
                        'Automatic remediation actions',
                        'Add security to existing apps',
                        'Enable secure email/Wi-Fi'
                    ]
                ],
                'correct_options' => [
                    'Geofencing' => 'Restrict device use by location',
                    'Compliance rules' => 'Automatic remediation actions',
                    'App wrapping' => 'Add security to existing apps',
                    'Certificate deployment' => 'Enable secure email/Wi-Fi'
                ],
                'justifications' => [
                    'Geofencing' => 'Enforces policies based on geographic location',
                    'Compliance rules' => 'Takes action when devices violate policies',
                    'App wrapping' => 'Adds security layer without modifying app code',
                    'Certificate deployment' => 'Enables authentication for corporate resources'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Mobile Device Management (MDM / EMM)'] ?? 5,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What is the primary challenge with MDM in a BYOD environment?',
                'options' => [
                    'Technical compatibility',
                    'Network bandwidth',
                    'User privacy concerns',
                    'License costs'
                ],
                'correct_options' => ['User privacy concerns'],
                'justifications' => [
                    'Modern MDM supports all major platforms',
                    'MDM requires minimal bandwidth',
                    'Correct - Users worry about employer accessing personal data',
                    'Cost is a factor but not the primary challenge'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 4,
                'status' => 'published'
            ],

            // BYOD & COPE - 5 items
            [
                'topic_id' => $topics['Bring Your Own Device (BYOD) & COPE'] ?? 6,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What does COPE stand for in mobile device strategies?',
                'options' => [
                    'Company Owned, Privately Enabled',
                    'Corporate Owned, Personally Enabled',
                    'Centrally Operated, Privately Executed',
                    'Corporate Operations, Personal Execution'
                ],
                'correct_options' => ['Corporate Owned, Personally Enabled'],
                'justifications' => [
                    'Close but incorrect terminology',
                    'Correct - Company owns device but allows personal use',
                    'Not a real mobile strategy term',
                    'Not the correct expansion'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Bring Your Own Device (BYOD) & COPE'] ?? 6,
                'type_id' => 5,
                'dimension' => 'Technical',
                'content' => 'Match each mobile strategy with its primary characteristic:',
                'options' => [
                    'items' => [
                        'BYOD',
                        'COPE',
                        'CYOD',
                        'COBO'
                    ],
                    'responses' => [
                        'Employee owns and chooses device',
                        'Company owns, personal use allowed',
                        'Choose from approved device list',
                        'Company owned, business only'
                    ]
                ],
                'correct_options' => [
                    'BYOD' => 'Employee owns and chooses device',
                    'COPE' => 'Company owns, personal use allowed',
                    'CYOD' => 'Choose from approved device list',
                    'COBO' => 'Company owned, business only'
                ],
                'justifications' => [
                    'BYOD' => 'Bring Your Own Device - full employee choice',
                    'COPE' => 'Corporate Owned, Personally Enabled',
                    'CYOD' => 'Choose Your Own Device from company options',
                    'COBO' => 'Corporate Owned, Business Only - no personal use'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Bring Your Own Device (BYOD) & COPE'] ?? 6,
                'type_id' => 3,
                'dimension' => 'Technical',
                'content' => 'Drag the security advantages of COPE over BYOD to the drop zone:',
                'options' => [
                    'Lower device costs',
                    'Standardized device models',
                    'Full device control',
                    'Employee satisfaction',
                    'Easier compliance',
                    'No privacy concerns'
                ],
                'correct_options' => ['Standardized device models', 'Full device control', 'Easier compliance'],
                'justifications' => [
                    'COPE has higher costs than BYOD',
                    'Standardization simplifies support and security',
                    'Company ownership enables complete control',
                    'BYOD often has higher satisfaction',
                    'Corporate ownership simplifies compliance',
                    'Privacy concerns exist even with COPE'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Bring Your Own Device (BYOD) & COPE'] ?? 6,
                'type_id' => 2,
                'dimension' => 'Technical',
                'content' => '**True or False:** BYOD programs always reduce IT costs for organizations.',
                'options' => [
                    'True',
                    'False'
                ],
                'correct_options' => ['False'],
                'justifications' => [
                    'explanation' => 'While BYOD eliminates device purchase costs, it often increases other costs including support for diverse devices, security tools, increased help desk calls, and potential data breach risks. Total cost of ownership may actually increase.'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 5,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Bring Your Own Device (BYOD) & COPE'] ?? 6,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Which legal consideration is MOST important for BYOD programs?',
                'options' => [
                    'Device color preferences',
                    'Clear acceptable use and privacy policies',
                    'Minimum device screen size',
                    'Preferred mobile carriers'
                ],
                'correct_options' => ['Clear acceptable use and privacy policies'],
                'justifications' => [
                    'Color has no legal implications',
                    'Correct - Must define data access and privacy boundaries',
                    'Screen size is usability, not legal issue',
                    'Carrier choice is operational, not legal'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 5,
                'status' => 'published'
            ],

            // IoT Security - 5 items
            [
                'topic_id' => $topics['IoT Security'] ?? 7,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What is the most common security weakness in IoT devices?',
                'options' => [
                    'Slow processors',
                    'Default or weak credentials',
                    'Small form factor',
                    'Battery limitations'
                ],
                'correct_options' => ['Default or weak credentials'],
                'justifications' => [
                    'Processing power is a constraint, not vulnerability',
                    'Correct - Many IoT devices ship with default passwords',
                    'Physical size doesn\'t impact security',
                    'Battery life affects functionality, not security'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['IoT Security'] ?? 7,
                'type_id' => 3,
                'dimension' => 'Technical',
                'content' => 'Drag the security challenges specific to IoT devices to the drop zone:',
                'options' => [
                    'Limited computational resources',
                    'High-resolution displays',
                    'Lack of security update mechanisms',
                    'Advanced user interfaces',
                    'Long deployment lifecycles',
                    'Frequent user interaction'
                ],
                'correct_options' => ['Limited computational resources', 'Lack of security update mechanisms', 'Long deployment lifecycles'],
                'justifications' => [
                    'IoT devices often can\'t run full security software',
                    'Most IoT devices have minimal or no displays',
                    'Many IoT devices cannot be easily updated',
                    'IoT devices typically have simple interfaces',
                    'IoT devices may run for years without replacement',
                    'Many IoT devices operate autonomously'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['IoT Security'] ?? 7,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Which protocol is specifically designed for secure IoT communications?',
                'options' => [
                    'HTTP',
                    'FTP',
                    'MQTT with TLS',
                    'Telnet'
                ],
                'correct_options' => ['MQTT with TLS'],
                'justifications' => [
                    'HTTP is too heavy for many IoT devices',
                    'FTP is for file transfer, not IoT',
                    'Correct - MQTT is lightweight, TLS adds security',
                    'Telnet is insecure and inappropriate'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['IoT Security'] ?? 7,
                'type_id' => 7,
                'dimension' => 'Technical',
                'content' => 'Analyze this IoT device scan and identify the critical security issue:',
                'options' => [
                    'Outdated firmware',
                    'Open telnet port with default credentials',
                    'No encryption support',
                    'IPv4 only support'
                ],
                'correct_options' => ['Open telnet port with default credentials'],
                'justifications' => [
                    'Firmware version not shown as outdated',
                    'Correct - Telnet with admin/admin is critical vulnerability',
                    'Device shows TLS support',
                    'IPv4 only is limitation, not critical security issue'
                ],
                'settings' => [
                    'shell' => 'iot-scanner',
                    'commands' => [
                        [
                            'pattern' => '^scan 192.168.1.50$',
                            'response' => "Scanning IoT device at 192.168.1.50...\nDevice: Smart Thermostat v2.1\nOpen Ports:\n  80/tcp - HTTP (Web Interface)\n  23/tcp - Telnet (OPEN)\n  8883/tcp - MQTT-TLS\n\nTelnet banner: Login: admin\nDefault credentials test: SUCCESS (admin/admin)\n[CRITICAL] Default telnet credentials active",
                            'isError' => false
                        ]
                    ]
                ],
                'difficulty_level' => 1,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['IoT Security'] ?? 7,
                'type_id' => 2,
                'dimension' => 'Technical',
                'content' => '**True or False:** IoT devices should be placed on the same network segment as critical business systems for easier management.',
                'options' => [
                    'True',
                    'False'
                ],
                'correct_options' => ['False'],
                'justifications' => [
                    'explanation' => 'IoT devices should be segmented on separate networks from critical systems. Their often-weak security makes them attractive targets for lateral movement. Network segmentation limits the impact of compromised IoT devices.'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 3,
                'status' => 'published'
            ],

            // Hardware Root of Trust & Firmware Integrity - 4 items
            [
                'topic_id' => $topics['Hardware Root of Trust & Firmware Integrity'] ?? 8,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What is a hardware root of trust?',
                'options' => [
                    'The computer case lock',
                    'Cryptographic keys embedded in hardware',
                    'The power supply unit',
                    'The primary hard drive'
                ],
                'correct_options' => ['Cryptographic keys embedded in hardware'],
                'justifications' => [
                    'Physical locks are not cryptographic roots of trust',
                    'Correct - Hardware-based keys provide tamper-resistant security foundation',
                    'Power supply provides electricity, not trust',
                    'Hard drives can be modified, not trustworthy roots'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Hardware Root of Trust & Firmware Integrity'] ?? 8,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'How does measured boot differ from secure boot?',
                'options' => [
                    'Measured boot is faster',
                    'Measured boot records integrity measurements without blocking',
                    'Measured boot only works on Linux',
                    'They are the same thing'
                ],
                'correct_options' => ['Measured boot records integrity measurements without blocking'],
                'justifications' => [
                    'Speed is not the differentiator',
                    'Correct - Measured boot logs but doesn\'t prevent booting',
                    'Both work on multiple operating systems',
                    'They serve different security purposes'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Hardware Root of Trust & Firmware Integrity'] ?? 8,
                'type_id' => 2,
                'dimension' => 'Technical',
                'content' => '**True or False:** Firmware updates should always be applied immediately when available to maintain security.',
                'options' => [
                    'True',
                    'False'
                ],
                'correct_options' => ['False'],
                'justifications' => [
                    'explanation' => 'Firmware updates should be tested before deployment as they can cause system instability or incompatibility. Unlike regular patches, firmware updates are harder to rollback and can brick devices if they fail.'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 5,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Hardware Root of Trust & Firmware Integrity'] ?? 8,
                'type_id' => 3,
                'dimension' => 'Technical',
                'content' => 'Drag the components that contribute to establishing hardware root of trust to the drop zone:',
                'options' => [
                    'TPM chip',
                    'USB ports',
                    'Secure boot keys in firmware',
                    'Monitor cable',
                    'Hardware security module',
                    'Keyboard'
                ],
                'correct_options' => ['TPM chip', 'Secure boot keys in firmware', 'Hardware security module'],
                'justifications' => [
                    'TPM provides hardware-based key storage and crypto',
                    'USB ports are interfaces, not trust components',
                    'Firmware keys establish boot trust chain',
                    'Monitor cables don\'t provide security functions',
                    'HSMs provide hardware-based cryptographic services',
                    'Keyboards are input devices, not trust anchors'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],

            // Industrial Control Systems (ICS) / SCADA Security - 4 items
            [
                'topic_id' => $topics['Industrial Control Systems (ICS) / SCADA Security'] ?? 9,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What is the primary difference between IT and OT security priorities?',
                'options' => [
                    'OT prioritizes confidentiality over availability',
                    'OT prioritizes availability and safety over confidentiality',
                    'IT and OT have identical priorities',
                    'OT does not require security'
                ],
                'correct_options' => ['OT prioritizes availability and safety over confidentiality'],
                'justifications' => [
                    'OT systems must remain available for safety',
                    'Correct - Industrial systems prioritize uptime and safety',
                    'IT typically prioritizes confidentiality first',
                    'OT requires security but with different priorities'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Industrial Control Systems (ICS) / SCADA Security'] ?? 9,
                'type_id' => 3,
                'dimension' => 'Technical',
                'content' => 'Drag the security practices that are appropriate for ICS/SCADA environments to the drop zone:',
                'options' => [
                    'Air-gapping critical systems',
                    'Automatic daily reboots',
                    'Network segmentation',
                    'Aggressive automated patching',
                    'Extensive testing before changes',
                    'Continuous vulnerability scanning'
                ],
                'correct_options' => ['Air-gapping critical systems', 'Network segmentation', 'Extensive testing before changes'],
                'justifications' => [
                    'Air gaps protect critical control systems',
                    'Reboots disrupt continuous processes',
                    'Segmentation limits attack propagation',
                    'Automated patching can destabilize OT systems',
                    'Changes must be thoroughly tested in OT',
                    'Active scanning can disrupt sensitive OT devices'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Industrial Control Systems (ICS) / SCADA Security'] ?? 9,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Which attack specifically targeted industrial control systems?',
                'options' => [
                    'WannaCry',
                    'Stuxnet',
                    'Heartbleed',
                    'Shellshock'
                ],
                'correct_options' => ['Stuxnet'],
                'justifications' => [
                    'WannaCry was ransomware targeting IT systems',
                    'Correct - Stuxnet specifically targeted industrial centrifuges',
                    'Heartbleed was an OpenSSL vulnerability',
                    'Shellshock was a bash shell vulnerability'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Industrial Control Systems (ICS) / SCADA Security'] ?? 9,
                'type_id' => 2,
                'dimension' => 'Technical',
                'content' => '**True or False:** Legacy ICS systems should be immediately replaced with modern IT systems for better security.',
                'options' => [
                    'True',
                    'False'
                ],
                'correct_options' => ['False'],
                'justifications' => [
                    'explanation' => 'Legacy ICS systems often run critical infrastructure and cannot be simply replaced. They may have 20-30 year lifecycles and specialized functionality. Security must be added through compensating controls like network segmentation rather than replacement.'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 5,
                'status' => 'published'
            ],

            // Additional questions to reach 50 total - 5 items
            [
                'topic_id' => $topics['Endpoint Protection Platform (EPP) & EDR'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'How should an organization implement EPP and EDR in a layered security approach?',
                'options' => [
                    'Replace all other security controls with EPP/EDR',
                    'Deploy EPP and EDR as complementary layers with other controls',
                    'Use only EPP for prevention, avoid EDR',
                    'Implement EDR only after removing EPP'
                ],
                'correct_options' => ['Deploy EPP and EDR as complementary layers with other controls'],
                'justifications' => [
                    'EPP/EDR cannot replace all security controls',
                    'Correct - Layered defense combines multiple complementary technologies',
                    'Both EPP and EDR provide valuable protection',
                    'EPP and EDR work better together than separately'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Application Whitelisting / Blacklisting'] ?? 2,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'When implementing application whitelisting, what approach minimizes business disruption?',
                'options' => [
                    'Block all applications immediately',
                    'Start with audit mode to understand application usage',
                    'Only whitelist operating system files',
                    'Disable all security monitoring during rollout'
                ],
                'correct_options' => ['Start with audit mode to understand application usage'],
                'justifications' => [
                    'Immediate blocking causes significant disruption',
                    'Correct - Audit mode identifies legitimate applications before enforcement',
                    'OS-only whitelisting blocks essential business applications',
                    'Security monitoring should continue during implementation'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Mobile Device Management (MDM / EMM)'] ?? 5,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'How should organizations balance security and user privacy in MDM deployments?',
                'options' => [
                    'Monitor all user activity for maximum security',
                    'Implement work profiles to separate corporate and personal data',
                    'Allow unlimited personal use without monitoring',
                    'Require users to carry separate devices'
                ],
                'correct_options' => ['Implement work profiles to separate corporate and personal data'],
                'justifications' => [
                    'Total monitoring violates privacy and may be illegal',
                    'Correct - Work profiles provide security while respecting privacy',
                    'No monitoring creates security risks',
                    'Separate devices increase costs and complexity'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['IoT Security'] ?? 7,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What security strategy works best for IoT devices that cannot be updated?',
                'options' => [
                    'Deploy them with default security only',
                    'Implement network segmentation and monitoring',
                    'Connect them directly to the internet',
                    'Ignore security since they cannot be patched'
                ],
                'correct_options' => ['Implement network segmentation and monitoring'],
                'justifications' => [
                    'Default security is often inadequate',
                    'Correct - Compensating controls protect unpatched devices',
                    'Direct internet connection increases attack surface',
                    'Security is still needed even without patching'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 5,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Hardware Root of Trust & Firmware Integrity'] ?? 8,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'How can organizations verify firmware integrity in their endpoint devices?',
                'options' => [
                    'Trust vendor assurances only',
                    'Use TPM-based attestation and measured boot',
                    'Manually inspect all firmware files',
                    'Disable firmware security features'
                ],
                'correct_options' => ['Use TPM-based attestation and measured boot'],
                'justifications' => [
                    'Vendor assurances alone are insufficient',
                    'Correct - TPM and measured boot provide cryptographic verification',
                    'Manual inspection is not scalable or reliable',
                    'Disabling security features increases vulnerability'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3,
                'status' => 'published'
            ]
        ];
        
        // Insert all items
        foreach ($items as $item) {
            DiagnosticItem::create($item);
        }
        
        $this->command->info('Domain 14 (Endpoint, Mobile & IoT Security) diagnostic items seeded successfully!');
    }
}