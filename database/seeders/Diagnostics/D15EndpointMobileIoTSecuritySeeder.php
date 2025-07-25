<?php

namespace Database\Seeders\Diagnostics;

class D15EndpointMobileIoTSecuritySeeder extends BaseDiagnosticSeeder
{
    protected string $domainName = 'Endpoint, Mobile & IoT Security';
    
    protected function getQuestions(): array
    {
        return [
            // Topic 1: Endpoint Protection (10 questions)
            // Bloom Distribution: L1:1, L2:2, L3:3, L4:2, L5:2
            
            // Item 1 - L1 - Remember
            [
                'subtopic' => 'Endpoint Security',
                'question' => 'What is the primary difference between traditional antivirus and modern Endpoint Detection and Response (EDR) solutions?',
                'options' => [
                    'EDR is less expensive than traditional antivirus',
                    'EDR provides behavioral analysis and threat hunting capabilities beyond signature-based detection',
                    'Traditional antivirus works faster than EDR solutions',
                    'EDR only works on mobile devices while antivirus works on computers'
                ],
                'correct_options' => ['EDR provides behavioral analysis and threat hunting capabilities beyond signature-based detection'],
                'justifications' => [
                    'EDR typically has higher initial costs than traditional antivirus solutions',
                    'Correct - EDR provides behavioral analysis and threat hunting capabilities beyond signature-based detection',
                    'EDR solutions often require more processing power than traditional antivirus',
                    'EDR works on all types of endpoints, not just mobile devices'
                ],
                'bloom_level' => 1,
                'difficulty_level' => 1,
                'type_id' => 1,
                'irt_a' => 0.8,
                'irt_b' => -1.5,
                'irt_c' => 0.25,
                'type_id' => 1,
                'status' => 'published'
            ],
            
            // Item 2 - L2 - Understand
            [
                'subtopic' => 'Endpoint Security',
                'question' => 'How does Zero Trust endpoint security differ from traditional perimeter-based security?',
                'options' => [
                    'Zero Trust is faster than perimeter-based security',
                    'Zero Trust assumes no implicit trust and verifies every endpoint connection',
                    'Zero Trust only applies to cloud environments',
                    'Zero Trust eliminates the need for endpoint security software'
                ],
                'correct_options' => ['Zero Trust assumes no implicit trust and verifies every endpoint connection'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Zero Trust assumes no implicit trust and verifies every endpoint connection',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'type_id' => 1,
                'irt_a' => 1.2,
                'irt_b' => -0.5,
                'irt_c' => 0.25,
                'type_id' => 1,
                'status' => 'published'
            ],
            
            // Item 3 - L2 - Understand
            [
                'subtopic' => 'Endpoint Security',
                'question' => 'Why is application whitelisting more secure than blacklisting for endpoint protection?',
                'options' => [
                    'Whitelisting is easier to manage than blacklisting',
                    'Whitelisting prevents execution of unknown threats by default',
                    'Whitelisting is faster than blacklisting',
                    'Whitelisting works better with older operating systems'
                ],
                'correct_options' => ['Whitelisting prevents execution of unknown threats by default'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Whitelisting prevents execution of unknown threats by default',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'type_id' => 1,
                'irt_a' => 1.3,
                'irt_b' => -0.2,
                'irt_c' => 0.25,
                'type_id' => 1,
                'status' => 'published'
            ],
            
            // Item 4 - L3 - Apply
            [
                'subtopic' => 'Endpoint Security',
                'question' => 'A financial services company needs to secure laptops for remote workers accessing sensitive customer data. What endpoint security approach would be most comprehensive?',
                'options' => [
                    'Install only traditional antivirus software',
                    'Deploy EDR with full disk encryption, VPN, and application controls',
                    'Rely on built-in operating system security features only',
                    'Use only network-based security controls'
                ],
                'correct_options' => ['Deploy EDR with full disk encryption, VPN, and application controls'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Deploy EDR with full disk encryption, VPN, and application controls',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'type_id' => 1,
                'irt_a' => 1.4,
                'irt_b' => 0.1,
                'irt_c' => 0.25,
                'type_id' => 1,
                'status' => 'published'
            ],
            
            // Item 5 - L3 - Apply
            [
                'subtopic' => 'Endpoint Security',
                'question' => 'How should an organization implement endpoint security for a mixed environment of Windows, macOS, and Linux systems?',
                'options' => [
                    'Use different security vendors for each operating system',
                    'Implement unified endpoint management with cross-platform capabilities',
                    'Only secure Windows systems as they are most vulnerable',
                    'Rely on each operating system\'s built-in security'
                ],
                'correct_options' => ['Implement unified endpoint management with cross-platform capabilities'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Implement unified endpoint management with cross-platform capabilities',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'type_id' => 1,
                'irt_a' => 1.5,
                'irt_b' => 0.3,
                'irt_c' => 0.25,
                'type_id' => 1,
                'status' => 'published'
            ],
            
            // Item 6 - L3 - Apply
            [
                'subtopic' => 'Endpoint Security',
                'question' => 'What is the most effective approach for protecting endpoints against fileless malware attacks?',
                'options' => [
                    'Increase signature database update frequency',
                    'Implement behavior-based detection and memory protection controls',
                    'Disable all PowerShell and scripting capabilities',
                    'Use only hardware-based security solutions'
                ],
                'correct_options' => ['Implement behavior-based detection and memory protection controls'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Implement behavior-based detection and memory protection controls',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'type_id' => 1,
                'irt_a' => 1.4,
                'irt_b' => 0.5,
                'irt_c' => 0.25,
                'type_id' => 1,
                'status' => 'published'
            ],
            
            // Item 7 - L4 - Analyze
            [
                'subtopic' => 'Endpoint Security',
                'question' => 'Analyze why cloud-based endpoint security solutions may be more effective than on-premises solutions for detecting advanced threats.',
                'options' => [
                    'Cloud solutions are always faster than on-premises solutions',
                    'Cloud solutions leverage global threat intelligence and machine learning at scale',
                    'Cloud solutions are less expensive than on-premises solutions',
                    'Cloud solutions eliminate the need for local endpoint agents'
                ],
                'correct_options' => ['Cloud solutions leverage global threat intelligence and machine learning at scale'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Cloud solutions leverage global threat intelligence and machine learning at scale',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'type_id' => 1,
                'irt_a' => 1.7,
                'irt_b' => 0.8,
                'irt_c' => 0.20,
                'type_id' => 1,
                'status' => 'published'
            ],
            
            // Item 8 - L4 - Analyze
            [
                'subtopic' => 'Endpoint Security',
                'question' => 'What is the fundamental challenge in securing endpoints in a BYOD (Bring Your Own Device) environment?',
                'options' => [
                    'BYOD devices are inherently less secure than corporate devices',
                    'Balancing employee privacy with corporate security requirements',
                    'BYOD devices cannot run enterprise security software',
                    'BYOD environments are too expensive to secure properly'
                ],
                'correct_options' => ['Balancing employee privacy with corporate security requirements'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Balancing employee privacy with corporate security requirements',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'type_id' => 1,
                'irt_a' => 1.8,
                'irt_b' => 1.0,
                'irt_c' => 0.20,
                'type_id' => 1,
                'status' => 'published'
            ],
            
            // Item 9 - L5 - Evaluate
            [
                'subtopic' => 'Endpoint Security',
                'question' => 'A company implements AI-powered endpoint protection that automatically isolates suspicious endpoints. Evaluate the security benefits and operational risks.',
                'options' => [
                    'AI-powered isolation is always beneficial with no risks',
                    'Can improve threat response time but may cause business disruption from false positives',
                    'AI-powered systems should never make automatic isolation decisions',
                    'Automatic isolation eliminates the need for security analysts'
                ],
                'correct_options' => ['Can improve threat response time but may cause business disruption from false positives'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Can improve threat response time but may cause business disruption from false positives',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'bloom_level' => 5,
                'difficulty_level' => 5,
                'type_id' => 1,
                'irt_a' => 1.9,
                'irt_b' => 1.3,
                'irt_c' => 0.15,
                'type_id' => 1,
                'status' => 'published'
            ],
            
            // Item 10 - L5 - Evaluate
            [
                'subtopic' => 'Endpoint Security',
                'question' => 'Assess the effectiveness of using endpoint security as the primary defense strategy for an organization.',
                'options' => [
                    'Endpoint security alone provides complete protection',
                    'Endpoint security is critical but must be part of a layered defense strategy',
                    'Endpoint security is unnecessary with proper network security',
                    'Endpoint security is only effective for known threats'
                ],
                'correct_options' => ['Endpoint security is critical but must be part of a layered defense strategy'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Endpoint security is critical but must be part of a layered defense strategy',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'bloom_level' => 5,
                'difficulty_level' => 5,
                'type_id' => 1,
                'irt_a' => 2.0,
                'irt_b' => 1.5,
                'irt_c' => 0.15,
                'type_id' => 1,
                'status' => 'published'
            ],
            
            // Topic 2: Mobile Device Management (10 questions)
            // Bloom Distribution: L1:1, L2:2, L3:3, L4:2, L5:2
            
            // Item 11 - L1 - Remember
            [
                'subtopic' => 'Mobile Security',
                'question' => 'What is the primary difference between MDM (Mobile Device Management) and MAM (Mobile Application Management)?',
                'options' => [
                    'MDM manages entire devices while MAM manages specific applications',
                    'MDM is for iOS while MAM is for Android',
                    'MDM is cheaper while MAM is more expensive',
                    'MDM and MAM are identical technologies'
                ],
                'correct_options' => ['MDM manages entire devices while MAM manages specific applications'],
                'justifications' => [
                    'Correct - MDM manages entire devices while MAM manages specific applications',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'bloom_level' => 1,
                'difficulty_level' => 1,
                'type_id' => 1,
                'irt_a' => 0.9,
                'irt_b' => -1.3,
                'irt_c' => 0.25,
                'type_id' => 1,
                'status' => 'published'
            ],
            
            // Item 12 - L2 - Understand
            [
                'subtopic' => 'Mobile Security',
                'question' => 'How does containerization improve mobile security in enterprise environments?',
                'options' => [
                    'Containerization increases device performance',
                    'Containerization separates corporate and personal data with distinct security policies',
                    'Containerization reduces battery consumption',
                    'Containerization only works on corporate-owned devices'
                ],
                'correct_options' => ['Containerization separates corporate and personal data with distinct security policies'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Containerization separates corporate and personal data with distinct security policies',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'type_id' => 1,
                'irt_a' => 1.2,
                'irt_b' => -0.4,
                'irt_c' => 0.25,
                'type_id' => 1,
                'status' => 'published'
            ],
            
            // Item 13 - L2 - Understand
            [
                'subtopic' => 'Mobile Security',
                'question' => 'Why is remote wipe capability important in mobile device management?',
                'options' => [
                    'Remote wipe improves device performance',
                    'Remote wipe protects corporate data when devices are lost or stolen',
                    'Remote wipe is required for app store compliance',
                    'Remote wipe reduces mobile data usage'
                ],
                'correct_options' => ['Remote wipe protects corporate data when devices are lost or stolen'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Remote wipe protects corporate data when devices are lost or stolen',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'type_id' => 1,
                'irt_a' => 1.4,
                'irt_b' => -0.1,
                'irt_c' => 0.25,
                'type_id' => 1,
                'status' => 'published'
            ],
            
            // Item 14 - L3 - Apply
            [
                'subtopic' => 'Mobile Security',
                'question' => 'A healthcare organization needs to enable staff to access patient records on personal mobile devices. What MDM approach should they implement?',
                'options' => [
                    'Allow unrestricted access from any personal device',
                    'Implement MAM with app-based encryption and conditional access policies',
                    'Prohibit all personal device access to maintain security',
                    'Only allow access through web browsers without any controls'
                ],
                'correct_options' => ['Implement MAM with app-based encryption and conditional access policies'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Implement MAM with app-based encryption and conditional access policies',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'type_id' => 1,
                'irt_a' => 1.5,
                'irt_b' => 0.2,
                'irt_c' => 0.25,
                'type_id' => 1,
                'status' => 'published'
            ],
            
            // Item 15 - L3 - Apply
            [
                'subtopic' => 'Mobile Security',
                'question' => 'How should an organization handle mobile device compliance for devices in different countries with varying privacy regulations?',
                'options' => [
                    'Apply the same MDM policies globally without consideration of local laws',
                    'Customize MDM policies to respect local privacy requirements while maintaining security',
                    'Only deploy MDM in countries with minimal privacy regulations',
                    'Avoid international mobile device deployment entirely'
                ],
                'correct_options' => ['Customize MDM policies to respect local privacy requirements while maintaining security'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Customize MDM policies to respect local privacy requirements while maintaining security',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'type_id' => 1,
                'irt_a' => 1.4,
                'irt_b' => 0.4,
                'irt_c' => 0.25,
                'type_id' => 1,
                'status' => 'published'
            ],
            
            // Item 16 - L3 - Apply
            [
                'subtopic' => 'Mobile Security',
                'question' => 'What is the most secure approach for implementing mobile device authentication in a high-security environment?',
                'options' => [
                    'Use only device PIN or password',
                    'Implement multi-factor authentication with biometrics and device certificates',
                    'Rely on network-based authentication only',
                    'Use shared device credentials for simplicity'
                ],
                'correct_options' => ['Implement multi-factor authentication with biometrics and device certificates'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Implement multi-factor authentication with biometrics and device certificates',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'type_id' => 1,
                'irt_a' => 1.6,
                'irt_b' => 0.6,
                'irt_c' => 0.25,
                'type_id' => 1,
                'status' => 'published'
            ],
            
            // Item 17 - L4 - Analyze
            [
                'subtopic' => 'Mobile Security',
                'question' => 'Analyze the privacy implications of implementing comprehensive MDM policies on employee personal devices.',
                'options' => [
                    'MDM policies have no privacy implications for personal devices',
                    'Comprehensive MDM can create privacy concerns requiring careful policy balance',
                    'Privacy concerns are irrelevant when devices access corporate data',
                    'MDM only affects corporate applications and data'
                ],
                'correct_options' => ['Comprehensive MDM can create privacy concerns requiring careful policy balance'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Comprehensive MDM can create privacy concerns requiring careful policy balance',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'type_id' => 1,
                'irt_a' => 1.7,
                'irt_b' => 0.9,
                'irt_c' => 0.20,
                'type_id' => 1,
                'status' => 'published'
            ],
            
            // Item 18 - L4 - Analyze
            [
                'subtopic' => 'Mobile Security',
                'question' => 'What is the fundamental challenge in managing mobile devices across different operating systems and versions?',
                'options' => [
                    'All mobile operating systems have identical security features',
                    'Fragmented OS capabilities and security model differences require platform-specific approaches',
                    'Mobile device management is only possible on the latest OS versions',
                    'Cross-platform management has no technical challenges'
                ],
                'correct_options' => ['Fragmented OS capabilities and security model differences require platform-specific approaches'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Fragmented OS capabilities and security model differences require platform-specific approaches',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'type_id' => 1,
                'irt_a' => 1.8,
                'irt_b' => 1.1,
                'irt_c' => 0.20,
                'type_id' => 1,
                'status' => 'published'
            ],
            
            // Item 19 - L5 - Evaluate
            [
                'subtopic' => 'Mobile Security',
                'question' => 'A company adopts a "mobile-first" work strategy with minimal device restrictions to improve employee satisfaction. Evaluate this approach from a security perspective.',
                'options' => [
                    'Mobile-first strategies with minimal restrictions are always secure',
                    'May improve productivity but increases security risk requiring compensating controls',
                    'Security is not relevant in mobile-first environments',
                    'Minimal restrictions eliminate all mobile security concerns'
                ],
                'correct_options' => ['May improve productivity but increases security risk requiring compensating controls'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - May improve productivity but increases security risk requiring compensating controls',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'bloom_level' => 5,
                'difficulty_level' => 5,
                'type_id' => 1,
                'irt_a' => 1.9,
                'irt_b' => 1.4,
                'irt_c' => 0.15,
                'type_id' => 1,
                'status' => 'published'
            ],
            
            // Item 20 - L5 - Evaluate
            [
                'subtopic' => 'Mobile Security',
                'question' => 'Assess the long-term sustainability of traditional MDM approaches as mobile operating systems become more privacy-focused.',
                'options' => [
                    'Traditional MDM will remain unchanged regardless of OS evolution',
                    'Privacy-focused OS changes require evolution toward zero-trust and application-centric security',
                    'Privacy improvements eliminate the need for mobile device management',
                    'Traditional MDM approaches are incompatible with privacy requirements'
                ],
                'correct_options' => ['Privacy-focused OS changes require evolution toward zero-trust and application-centric security'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Privacy-focused OS changes require evolution toward zero-trust and application-centric security',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'bloom_level' => 5,
                'difficulty_level' => 5,
                'type_id' => 1,
                'irt_a' => 2.0,
                'irt_b' => 1.3,
                'irt_c' => 0.15,
                'type_id' => 1,
                'status' => 'published'
            ],
            
            // Topic 3: IoT Device Security (10 questions)
            // Bloom Distribution: L1:2, L2:2, L3:3, L4:2, L5:1
            
            // Item 21 - L1 - Remember
            [
                'subtopic' => 'IoT Security',
                'question' => 'What is the primary security challenge with IoT devices?',
                'options' => [
                    'IoT devices consume too much power',
                    'Many IoT devices have weak authentication and are difficult to update',
                    'IoT devices are too expensive to secure properly',
                    'IoT devices only work with wireless networks'
                ],
                'correct_options' => ['Many IoT devices have weak authentication and are difficult to update'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Many IoT devices have weak authentication and are difficult to update',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'bloom_level' => 1,
                'difficulty_level' => 1,
                'type_id' => 1,
                'irt_a' => 0.8,
                'irt_b' => -1.4,
                'irt_c' => 0.25,
                'type_id' => 1,
                'status' => 'published'
            ],
            
            // Item 22 - L1 - Remember
            [
                'subtopic' => 'IoT Security',
                'question' => 'What does "device shadowing" or "shadow IoT" refer to?',
                'options' => [
                    'IoT devices that operate in dark environments',
                    'Unauthorized IoT devices connected to corporate networks without IT approval',
                    'IoT devices that create backups of other devices',
                    'IoT devices that are more expensive than budgeted'
                ],
                'correct_options' => ['Unauthorized IoT devices connected to corporate networks without IT approval'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Unauthorized IoT devices connected to corporate networks without IT approval',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'bloom_level' => 1,
                'difficulty_level' => 1,
                'type_id' => 1,
                'irt_a' => 0.9,
                'irt_b' => -1.2,
                'irt_c' => 0.25,
                'type_id' => 1,
                'status' => 'published'
            ],
            
            // Item 23 - L2 - Understand
            [
                'subtopic' => 'IoT Security',
                'question' => 'How does network segmentation improve IoT security?',
                'options' => [
                    'Segmentation improves IoT device performance',
                    'Segmentation isolates IoT devices and limits potential attack spread',
                    'Segmentation reduces the cost of IoT deployment',
                    'Segmentation is only useful for wireless IoT devices'
                ],
                'correct_options' => ['Segmentation isolates IoT devices and limits potential attack spread'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Segmentation isolates IoT devices and limits potential attack spread',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'type_id' => 1,
                'irt_a' => 1.2,
                'irt_b' => -0.5,
                'irt_c' => 0.25,
                'type_id' => 1,
                'status' => 'published'
            ],
            
            // Item 24 - L2 - Understand
            [
                'subtopic' => 'IoT Security',
                'question' => 'Why is certificate-based authentication particularly important for IoT devices?',
                'options' => [
                    'Certificates improve IoT device battery life',
                    'Certificates provide device identity and secure communication without user interaction',
                    'Certificates are required by IoT device manufacturers',
                    'Certificates reduce IoT device manufacturing costs'
                ],
                'correct_options' => ['Certificates provide device identity and secure communication without user interaction'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Certificates provide device identity and secure communication without user interaction',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'type_id' => 1,
                'irt_a' => 1.3,
                'irt_b' => -0.2,
                'irt_c' => 0.25,
                'type_id' => 1,
                'status' => 'published'
            ],
            
            // Item 25 - L3 - Apply
            [
                'subtopic' => 'IoT Security',
                'question' => 'A manufacturing company wants to deploy IoT sensors for equipment monitoring. What security approach should they implement?',
                'options' => [
                    'Connect all IoT devices directly to the corporate network',
                    'Create isolated network segments with monitoring and access controls',
                    'Use only wireless IoT devices to avoid network security issues',
                    'Implement IoT devices without any security controls for simplicity'
                ],
                'correct_options' => ['Create isolated network segments with monitoring and access controls'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Create isolated network segments with monitoring and access controls',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.4,
                'irt_b' => 0.2,
                'irt_c' => 0.25,
                'type_id' => 1,
                'status' => 'published'
            ],
            
            // Item 26 - L3 - Apply
            [
                'subtopic' => 'IoT Security',
                'question' => 'How should an organization handle firmware updates for critical IoT devices in production environments?',
                'options' => [
                    'Never update firmware to maintain stability',
                    'Implement staged rollouts with testing and rollback capabilities',
                    'Update all devices simultaneously to ensure consistency',
                    'Only update firmware when devices fail'
                ],
                'correct_options' => ['Implement staged rollouts with testing and rollback capabilities'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Implement staged rollouts with testing and rollback capabilities',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.5,
                'irt_b' => 0.4,
                'irt_c' => 0.25,
                'type_id' => 1,
                'status' => 'published'
            ],
            
            // Item 27 - L3 - Apply
            [
                'subtopic' => 'IoT Security',
                'question' => 'What is the most effective approach for monitoring IoT device security in a large deployment?',
                'options' => [
                    'Manually check each device periodically',
                    'Implement automated network monitoring with anomaly detection',
                    'Rely on device manufacturers to monitor security',
                    'Only monitor devices when security incidents occur'
                ],
                'correct_options' => ['Implement automated network monitoring with anomaly detection'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Implement automated network monitoring with anomaly detection',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'type_id' => 1,
                'irt_a' => 1.6,
                'irt_b' => 0.6,
                'irt_c' => 0.25,
                'type_id' => 1,
                'status' => 'published'
            ],
            
            // Item 28 - L4 - Analyze
            [
                'subtopic' => 'IoT Security',
                'question' => 'Analyze why traditional IT security approaches may be inadequate for IoT environments.',
                'options' => [
                    'IoT devices are inherently more secure than traditional IT systems',
                    'IoT devices have resource constraints and different threat models than traditional IT',
                    'Traditional IT security is always superior to IoT security approaches',
                    'IoT and traditional IT have identical security requirements'
                ],
                'correct_options' => ['IoT devices have resource constraints and different threat models than traditional IT'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - IoT devices have resource constraints and different threat models than traditional IT',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'type_id' => 1,
                'irt_a' => 1.7,
                'irt_b' => 0.8,
                'irt_c' => 0.20,
                'type_id' => 1,
                'status' => 'published'
            ],
            
            // Item 29 - L4 - Analyze
            [
                'subtopic' => 'IoT Security',
                'question' => 'What is the fundamental challenge in implementing end-to-end encryption for IoT communications?',
                'options' => [
                    'IoT devices do not support any form of encryption',
                    'Limited processing power and battery life of many IoT devices',
                    'Encryption is illegal for IoT devices in most countries',
                    'End-to-end encryption eliminates IoT device functionality'
                ],
                'correct_options' => ['Limited processing power and battery life of many IoT devices'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Limited processing power and battery life of many IoT devices',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'type_id' => 1,
                'irt_a' => 1.8,
                'irt_b' => 1.0,
                'irt_c' => 0.20,
                'type_id' => 1,
                'status' => 'published'
            ],
            
            // Item 30 - L5 - Evaluate
            [
                'subtopic' => 'IoT Security',
                'question' => 'A smart city initiative deploys thousands of IoT sensors with 10-year expected lifespans. Evaluate the long-term security implications.',
                'options' => [
                    'Long-term deployments eliminate security concerns',
                    'Requires sustainable security update mechanisms and lifecycle management strategies',
                    'Security is only important during initial deployment',
                    'Long-term IoT deployments are inherently secure'
                ],
                'correct_options' => ['Requires sustainable security update mechanisms and lifecycle management strategies'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Requires sustainable security update mechanisms and lifecycle management strategies',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'bloom_level' => 5,
                'difficulty_level' => 5,
                'irt_a' => 1.9,
                'irt_b' => 1.5,
                'irt_c' => 0.15,
                'type_id' => 1,
                'status' => 'published'
            ],
            
            // Topic 4: Industrial Control Systems Security (10 questions)
            // Bloom Distribution: L1:2, L2:2, L3:3, L4:2, L5:1
            
            // Item 31 - L1 - Remember
            [
                'subtopic' => 'OT Security',
                'question' => 'What does SCADA stand for in industrial control systems?',
                'options' => [
                    'Supervisory Control and Data Acquisition',
                    'Secure Communication and Data Analysis',
                    'System Control and Database Administration',
                    'Standard Compliance and Data Assessment'
                ],
                'correct_options' => ['Supervisory Control and Data Acquisition'],
                'justifications' => [
                    'Correct - Supervisory Control and Data Acquisition',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'bloom_level' => 1,
                'difficulty_level' => 1,
                'type_id' => 1,
                'irt_a' => 0.8,
                'irt_b' => -1.5,
                'irt_c' => 0.25,
                'type_id' => 1,
                'status' => 'published'
            ],
            
            // Item 32 - L1 - Remember
            [
                'subtopic' => 'OT Security',
                'question' => 'What is the primary difference between IT and OT (Operational Technology) networks?',
                'options' => [
                    'IT focuses on data processing while OT focuses on physical process control',
                    'IT is more expensive than OT',
                    'IT uses wireless while OT uses wired connections',
                    'IT and OT networks are identical in function'
                ],
                'correct_options' => ['IT focuses on data processing while OT focuses on physical process control'],
                'justifications' => [
                    'Correct - IT focuses on data processing while OT focuses on physical process control',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'bloom_level' => 1,
                'difficulty_level' => 1,
                'type_id' => 1,
                'irt_a' => 0.9,
                'irt_b' => -1.3,
                'irt_c' => 0.25,
                'type_id' => 1,
                'status' => 'published'
            ],
            
            // Item 33 - L2 - Understand
            [
                'subtopic' => 'OT Security',
                'question' => 'Why is network segmentation particularly critical for industrial control systems?',
                'options' => [
                    'Segmentation improves system performance',
                    'Segmentation protects critical industrial processes from cyber attacks',
                    'Segmentation reduces power consumption',
                    'Segmentation is only required for new industrial systems'
                ],
                'correct_options' => ['Segmentation protects critical industrial processes from cyber attacks'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Segmentation protects critical industrial processes from cyber attacks',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'type_id' => 1,
                'irt_a' => 1.2,
                'irt_b' => -0.4,
                'irt_c' => 0.25,
                'type_id' => 1,
                'status' => 'published'
            ],
            
            // Item 34 - L2 - Understand
            [
                'subtopic' => 'OT Security',
                'question' => 'How do safety systems interact with security systems in industrial environments?',
                'options' => [
                    'Safety and security systems are completely independent',
                    'Security controls must not interfere with safety system operations',
                    'Safety systems are not important when security is implemented',
                    'Security systems always override safety systems'
                ],
                'correct_options' => ['Security controls must not interfere with safety system operations'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Security controls must not interfere with safety system operations',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'type_id' => 1,
                'irt_a' => 1.4,
                'irt_b' => -0.1,
                'irt_c' => 0.25,
                'type_id' => 1,
                'status' => 'published'
            ],
            
            // Item 35 - L3 - Apply
            [
                'subtopic' => 'OT Security',
                'question' => 'A power plant needs to upgrade its control systems while maintaining operational continuity. What security approach should they implement?',
                'options' => [
                    'Upgrade all systems simultaneously during a planned outage',
                    'Implement phased upgrades with parallel security monitoring and backup systems',
                    'Avoid upgrades to maintain system stability',
                    'Only upgrade systems that have already experienced security incidents'
                ],
                'correct_options' => ['Implement phased upgrades with parallel security monitoring and backup systems'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Implement phased upgrades with parallel security monitoring and backup systems',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'type_id' => 1,
                'irt_a' => 1.5,
                'irt_b' => 0.2,
                'irt_c' => 0.25,
                'type_id' => 1,
                'status' => 'published'
            ],
            
            // Item 36 - L3 - Apply
            [
                'subtopic' => 'OT Security',
                'question' => 'How should remote access to industrial control systems be implemented securely?',
                'options' => [
                    'Allow direct internet access to control systems for convenience',
                    'Implement VPN with multi-factor authentication and session monitoring',
                    'Use standard Windows Remote Desktop without additional security',
                    'Prohibit all remote access to maintain security'
                ],
                'correct_options' => ['Implement VPN with multi-factor authentication and session monitoring'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Implement VPN with multi-factor authentication and session monitoring',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'type_id' => 1,
                'irt_a' => 1.4,
                'irt_b' => 0.4,
                'irt_c' => 0.25,
                'type_id' => 1,
                'status' => 'published'
            ],
            
            // Item 37 - L3 - Apply
            [
                'subtopic' => 'OT Security',
                'question' => 'What is the most appropriate approach for implementing security monitoring in industrial environments?',
                'options' => [
                    'Use standard IT security tools without modification',
                    'Deploy specialized industrial security monitoring that understands OT protocols',
                    'Only monitor network perimeter security',
                    'Avoid security monitoring to prevent interference with operations'
                ],
                'correct_options' => ['Deploy specialized industrial security monitoring that understands OT protocols'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Deploy specialized industrial security monitoring that understands OT protocols',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'type_id' => 1,
                'irt_a' => 1.6,
                'irt_b' => 0.6,
                'irt_c' => 0.25,
                'type_id' => 1,
                'status' => 'published'
            ],
            
            // Item 38 - L4 - Analyze
            [
                'subtopic' => 'OT Security',
                'question' => 'Analyze why traditional IT security patching practices may be inappropriate for industrial control systems.',
                'options' => [
                    'Industrial systems never require security patches',
                    'Industrial systems require high availability and extensive testing before patches',
                    'IT patches always improve industrial system performance',
                    'Industrial systems use different operating systems that cannot be patched'
                ],
                'correct_options' => ['Industrial systems require high availability and extensive testing before patches'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Industrial systems require high availability and extensive testing before patches',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'type_id' => 1,
                'irt_a' => 1.7,
                'irt_b' => 0.9,
                'irt_c' => 0.20,
                'type_id' => 1,
                'status' => 'published'
            ],
            
            // Item 39 - L4 - Analyze
            [
                'subtopic' => 'OT Security',
                'question' => 'What is the fundamental challenge in applying zero trust principles to industrial control networks?',
                'options' => [
                    'Zero trust is not applicable to industrial environments',
                    'Legacy systems and real-time requirements complicate identity verification and micro-segmentation',
                    'Industrial systems are inherently more trustworthy than IT systems',
                    'Zero trust eliminates the need for industrial safety systems'
                ],
                'correct_options' => ['Legacy systems and real-time requirements complicate identity verification and micro-segmentation'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Legacy systems and real-time requirements complicate identity verification and micro-segmentation',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'type_id' => 1,
                'irt_a' => 1.8,
                'irt_b' => 1.1,
                'irt_c' => 0.20,
                'type_id' => 1,
                'status' => 'published'
            ],
            
            // Item 40 - L5 - Evaluate
            [
                'subtopic' => 'OT Security',
                'question' => 'A manufacturing company wants to connect their production systems to cloud-based analytics platforms. Evaluate the security implications.',
                'options' => [
                    'Cloud connectivity eliminates all industrial security risks',
                    'Requires careful architecture to maintain operational integrity while enabling data analytics',
                    'Industrial systems should never connect to external networks',
                    'Cloud analytics platforms automatically secure industrial connections'
                ],
                'correct_options' => ['Requires careful architecture to maintain operational integrity while enabling data analytics'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Requires careful architecture to maintain operational integrity while enabling data analytics',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'bloom_level' => 5,
                'difficulty_level' => 5,
                'type_id' => 1,
                'irt_a' => 1.9,
                'irt_b' => 1.4,
                'irt_c' => 0.15,
                'type_id' => 1,
                'status' => 'published'
            ],
            
            // Topic 5: Device Lifecycle Management (10 questions)
            // Bloom Distribution: L1:2, L2:2, L3:3, L4:2, L5:1
            
            // Item 41 - L1 - Remember
            [
                'subtopic' => 'Device Security',
                'question' => 'What are the main phases of device lifecycle management?',
                'options' => [
                    'Procurement, deployment, maintenance, and disposal',
                    'Planning, purchasing, and installation only',
                    'Manufacturing, selling, and supporting',
                    'Development, testing, and production'
                ],
                'correct_options' => ['Procurement, deployment, maintenance, and disposal'],
                'justifications' => [
                    'Correct - Procurement, deployment, maintenance, and disposal',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'bloom_level' => 1,
                'difficulty_level' => 1,
                'type_id' => 1,
                'irt_a' => 0.8,
                'irt_b' => -1.4,
                'irt_c' => 0.25,
                'type_id' => 1,
                'status' => 'published'
            ],
            
            // Item 42 - L3 - Apply
            [
                'subtopic' => 'Device Security',
                'question' => 'How should an enterprise implement secure device provisioning for a large-scale laptop deployment with diverse user roles?',
                'options' => [
                    'Use identical configurations for all devices to ensure consistency',
                    'Implement automated provisioning with role-based configurations and security baselines',
                    'Allow users to configure their own devices after receiving them',
                    'Only provision devices manually to ensure maximum security'
                ],
                'correct_options' => ['Implement automated provisioning with role-based configurations and security baselines'],
                'justifications' => [
                    'Incorrect - Identical configurations don\'t address varying security and functional requirements',
                    'Correct - Automated role-based provisioning ensures appropriate security while scaling efficiently',
                    'Incorrect - User configuration introduces security risks and inconsistencies',
                    'Incorrect - Manual provisioning doesn\'t scale and increases error risk'
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.4,
                'irt_b' => 0.3,
                'irt_c' => 0.25,
                'type_id' => 1,
                'status' => 'published'
            ],
            
            // Item 43 - L2 - Understand
            [
                'subtopic' => 'Device Security',
                'question' => 'Why is asset inventory critical for device lifecycle management?',
                'options' => [
                    'Asset inventory reduces device costs',
                    'Asset inventory enables security monitoring and compliance throughout device lifecycles',
                    'Asset inventory is only needed for expensive devices',
                    'Asset inventory improves device performance'
                ],
                'correct_options' => ['Asset inventory enables security monitoring and compliance throughout device lifecycles'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Asset inventory enables security monitoring and compliance throughout device lifecycles',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'irt_a' => 1.2,
                'irt_b' => -0.3,
                'irt_c' => 0.25,
                'type_id' => 1,
                'status' => 'published'
            ],
            
            // Item 44 - L2 - Understand
            [
                'subtopic' => 'Device Security',
                'question' => 'How does secure device disposal protect organizational data?',
                'options' => [
                    'Disposal procedures only affect physical device security',
                    'Proper data wiping and destruction prevent data recovery from discarded devices',
                    'Device disposal has no impact on data security',
                    'Only damaged devices require secure disposal'
                ],
                'correct_options' => ['Proper data wiping and destruction prevent data recovery from discarded devices'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Proper data wiping and destruction prevent data recovery from discarded devices',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'irt_a' => 1.3,
                'irt_b' => -0.1,
                'irt_c' => 0.25,
                'type_id' => 1,
                'status' => 'published'
            ],
            
            // Item 45 - L3 - Apply
            [
                'subtopic' => 'Device Security',
                'question' => 'A financial services company needs to replace 1000 workstations while maintaining data security. What approach should they implement?',
                'options' => [
                    'Replace all devices simultaneously without data migration',
                    'Implement phased replacement with secure data migration and disposal procedures',
                    'Keep old devices as backups without any security controls',
                    'Allow employees to dispose of old devices independently'
                ],
                'correct_options' => ['Implement phased replacement with secure data migration and disposal procedures'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Implement phased replacement with secure data migration and disposal procedures',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.4,
                'irt_b' => 0.3,
                'irt_c' => 0.25,
                'type_id' => 1,
                'status' => 'published'
            ],
            
            // Item 46 - L3 - Apply
            [
                'subtopic' => 'Device Security',
                'question' => 'How should an organization handle end-of-life devices that cannot be securely updated?',
                'options' => [
                    'Continue using devices until they fail completely',
                    'Isolate devices from networks and plan replacement with enhanced monitoring',
                    'Only update devices that show signs of security compromise',
                    'Transfer end-of-life devices to less critical functions'
                ],
                'correct_options' => ['Isolate devices from networks and plan replacement with enhanced monitoring'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Isolate devices from networks and plan replacement with enhanced monitoring',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.5,
                'irt_b' => 0.4,
                'irt_c' => 0.25,
                'type_id' => 1,
                'status' => 'published'
            ],
            
            // Item 47 - L3 - Apply
            [
                'subtopic' => 'Device Security',
                'question' => 'What is the most effective approach for managing device certificates and keys throughout their lifecycle?',
                'options' => [
                    'Use permanent certificates that never expire',
                    'Implement automated certificate lifecycle management with rotation and revocation',
                    'Only manage certificates manually when problems occur',
                    'Use the same certificate for all devices of the same type'
                ],
                'correct_options' => ['Implement automated certificate lifecycle management with rotation and revocation'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Implement automated certificate lifecycle management with rotation and revocation',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'type_id' => 1,
                'irt_a' => 1.6,
                'irt_b' => 0.6,
                'irt_c' => 0.25,
                'type_id' => 1,
                'status' => 'published'
            ],
            
            // Item 48 - L4 - Analyze
            [
                'subtopic' => 'Device Security',
                'question' => 'Analyze the security implications of extending device lifecycles beyond manufacturer support periods.',
                'options' => [
                    'Extended lifecycles always improve security through stability',
                    'Extended lifecycles increase security risk due to lack of updates and support',
                    'Manufacturer support has no impact on device security',
                    'Extended lifecycles reduce costs without affecting security'
                ],
                'correct_options' => ['Extended lifecycles increase security risk due to lack of updates and support'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Extended lifecycles increase security risk due to lack of updates and support',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'type_id' => 1,
                'irt_a' => 1.7,
                'irt_b' => 0.8,
                'irt_c' => 0.20,
                'type_id' => 1,
                'status' => 'published'
            ],
            
            // Item 49 - L4 - Analyze
            [
                'subtopic' => 'Device Security',
                'question' => 'What is the fundamental challenge in managing device lifecycles in hybrid cloud environments?',
                'options' => [
                    'Cloud devices never require lifecycle management',
                    'Hybrid environments complicate visibility and control across on-premises and cloud resources',
                    'Device lifecycles are identical in cloud and on-premises environments',
                    'Cloud providers handle all device lifecycle management automatically'
                ],
                'correct_options' => ['Hybrid environments complicate visibility and control across on-premises and cloud resources'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Hybrid environments complicate visibility and control across on-premises and cloud resources',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'type_id' => 1,
                'irt_a' => 1.8,
                'irt_b' => 1.0,
                'irt_c' => 0.20,
                'type_id' => 1,
                'status' => 'published'
            ],
            
            // Item 50 - L5 - Evaluate
            [
                'subtopic' => 'Device Security',
                'question' => 'An organization implements AI-driven predictive analytics to optimize device replacement timing. Evaluate this approach.',
                'options' => [
                    'AI-driven optimization eliminates all device lifecycle risks',
                    'Can improve efficiency and security posture but requires validation and human oversight',
                    'Predictive analytics should never be used for device lifecycle decisions',
                    'AI optimization eliminates the need for traditional lifecycle management'
                ],
                'correct_options' => ['Can improve efficiency and security posture but requires validation and human oversight'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Can improve efficiency and security posture but requires validation and human oversight',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'bloom_level' => 5,
                'difficulty_level' => 5,
                'irt_a' => 1.9,
                'irt_b' => 1.5,
                'irt_c' => 0.15,
                'type_id' => 1,
                'status' => 'published'
            ]
        ];
    }
}