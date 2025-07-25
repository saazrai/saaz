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
                'question' => 'Which of the following best describes the core function of an Endpoint Detection and Response (EDR) solution?',
                'options' => [
                    'Blocks all incoming network traffic',
                    'Provides automated patching of operating systems',
                    'Monitors endpoint activity and enables threat hunting',
                    'Encrypts endpoint storage at rest',
                ],
                'correct_options' => ['Monitors endpoint activity and enables threat hunting'],
                'justifications' => [
                    'Incorrect - Blocking network traffic is the function of firewalls, not EDR solutions',
                    'Incorrect - Automated patching is typically handled by patch management systems, not EDR',
                    'Correct - EDR solutions continuously monitor endpoint activity, collect telemetry data, and provide threat hunting capabilities to detect and respond to advanced threats',
                    'Incorrect - Storage encryption is typically handled by full disk encryption solutions, not EDR',
                ],
                'bloom_level' => 1,
                'difficulty_level' => 1,
                'type_id' => 1,
                'irt_a' => 0.8,
                'irt_b' => -1.5,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 2 - L2 - Understand
            [
                'subtopic' => 'Mobile Security',
                'question' => 'In a BYOD (Bring Your Own Device) policy, who is typically responsible for purchasing and maintaining the mobile device itself?',
                'options' => [
                    'The organization',
                    'The end-user',
                    'A third-party vendor',
                    'The mobile network provider',
                ],
                'correct_options' => ['The end-user'],
                'justifications' => [
                    'Incorrect - In BYOD policies, the organization does not purchase devices since employees bring their own personal devices',
                    'Correct - BYOD (Bring Your Own Device) policies require employees to purchase and maintain their own personal devices for work use, shifting device ownership and maintenance responsibility to the end-user',
                    'Incorrect - Third-party vendors are not responsible for device procurement in BYOD scenarios; they may provide services but not device ownership',
                    'Incorrect - Mobile network providers offer connectivity services but are not responsible for device purchase or maintenance in BYOD policies',
                ],
                'bloom_level' => 2,
                'difficulty_level' => 1,
                'type_id' => 1,
                'irt_a' => 0.9,
                'irt_b' => -1.0,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 3 - L2 - Understand
            [
                'subtopic' => 'Mobile Security',
                'question' => 'Which solution focuses primarily on managing and securing mobile devices, including device configuration, security policies, and application deployment?',
                'options' => [
                    'Enterprise Mobility Management (EMM)',
                    'Mobile Device Management (MDM)',
                    'Mobile Application Management (MAM)',
                    'Identity and Access Management (IAM)',
                ],
                'correct_options' => ['Mobile Device Management (MDM)'],
                'justifications' => [
                    'Incorrect - EMM is a broader platform that includes MDM, MAM, and additional enterprise mobility components, but MDM specifically focuses on device management',
                    'Correct - Mobile Device Management (MDM) specifically focuses on managing and securing mobile devices, including device configuration, security policy enforcement, and application deployment capabilities',
                    'Incorrect - MAM (Mobile Application Management) focuses specifically on applications rather than overall device management and configuration',
                    'Incorrect - IAM manages user identities and access permissions but does not handle device configuration or mobile-specific security policies',
                ],
                'bloom_level' => 2,
                'difficulty_level' => 2,
                'type_id' => 1,
                'irt_a' => 1.0,
                'irt_b' => -0.8,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 4 - L3 - Apply
            [
                'subtopic' => 'Device Security',
                'question' => 'When a device is lost or stolen, what is the most effective measure for preventing unauthorized access to the data on its internal storage?',
                'options' => [
                    'Setting a strong login password',
                    'Full Disk Encryption',
                    'Remotely wiping the device (if pre-configured)',
                    'Using a screen lock',
                ],
                'correct_options' => ['Full Disk Encryption'],
                'justifications' => [
                    'Incorrect - Strong passwords can be bypassed through physical access methods or by removing the storage device and accessing it directly',
                    'Correct - Full Disk Encryption ensures that even if the device is physically compromised, the data remains unreadable without the encryption keys, providing the strongest protection for data at rest',
                    'Incorrect - Remote wiping is effective but requires network connectivity and pre-configuration; if the device is offline or the thief acts quickly, wiping may not occur in time',
                    'Incorrect - Screen locks provide basic protection but can be bypassed through various methods when an attacker has physical access to the device',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 2,
                'type_id' => 1,
                'irt_a' => 1.1,
                'irt_b' => -0.3,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 5 - L2 - Understand
            [
                'subtopic' => 'Endpoint Security',
                'question' => 'What security posture does application whitelisting enforce by default?',
                'options' => [
                    'Deny by default, permit by exception',
                    'Permit by default, deny by exception',
                    'Allow all applications for administrators',
                    'Block only malicious websites',
                ],
                'correct_options' => ['Deny by default, permit by exception'],
                'justifications' => [
                    'Correct - Application whitelisting enforces a "deny by default, permit by exception" security posture, where only explicitly approved applications are allowed to execute, blocking all others by default',
                    'Incorrect - This describes blacklisting, where most applications are allowed by default and only known bad applications are blocked',
                    'Incorrect - Application whitelisting applies to all users regardless of privilege level; administrative users must also use approved applications',
                    'Incorrect - Application whitelisting controls application execution, not website access; web filtering handles malicious website blocking',
                ],
                'bloom_level' => 2,
                'difficulty_level' => 2,
                'type_id' => 1,
                'irt_a' => 1.0,
                'irt_b' => -0.5,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 6 - L3 - Apply
            [
                'subtopic' => 'Endpoint Security',
                'question' => 'How should an organization implement endpoint security for a mixed environment of Windows, macOS, and Linux systems?',
                'options' => [
                    'Use different security vendors for each operating system',
                    'Implement unified endpoint management with cross-platform capabilities',
                    'Only secure Windows systems as they are most vulnerable',
                    'Rely on each operating system\'s built-in security',
                ],
                'correct_options' => ['Implement unified endpoint management with cross-platform capabilities'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Implement unified endpoint management with cross-platform capabilities',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'type_id' => 1,
                'irt_a' => 1.5,
                'irt_b' => 0.3,
                'irt_c' => 0.25,
                'type_id' => 1,
                'status' => 'published',
            ],

            // Item 6 - L2 - Understand
            [
                'subtopic' => 'Endpoint Security',
                'question' => 'What is a key limitation of application blacklisting compared to whitelisting?',
                'options' => [
                    'It prevents legitimate applications from running',
                    'It allows all applications to run by default unless explicitly forbidden',
                    'It is simpler to manage in large environments',
                    'It is effective against zero-day malware',
                ],
                'correct_options' => ['It allows all applications to run by default unless explicitly forbidden'],
                'justifications' => [
                    'Incorrect - Blacklisting typically allows legitimate applications to run; the issue is that it also allows unknown malicious applications',
                    'Correct - Application blacklisting uses a "permit by default, deny by exception" approach, allowing all applications to execute unless specifically blocked, which means new or unknown malware can run freely',
                    'Incorrect - Blacklisting is actually more complex to manage as it requires constant updates to block new threats, while whitelisting has a more stable approved application list',
                    'Incorrect - Blacklisting is particularly ineffective against zero-day malware since these threats are unknown and not yet in the blacklist database',
                ],
                'bloom_level' => 2,
                'difficulty_level' => 2,
                'type_id' => 1,
                'irt_a' => 1.0,
                'irt_b' => -0.4,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 7 - L3 - Apply
            [
                'subtopic' => 'Endpoint Security',
                'question' => 'A company establishes a set of secure configurations for all its workstations and servers, including disabled unnecessary services, strong password policies, and firewall rules. This process is known as:',
                'options' => [
                    'Patch Management',
                    'Incident Response Planning',
                    'Security Baselines and Hardening',
                    'Vulnerability Scanning',
                ],
                'correct_options' => ['Security Baselines and Hardening'],
                'justifications' => [
                    'Incorrect - Patch management focuses on updating software to fix vulnerabilities, not establishing secure configurations',
                    'Incorrect - Incident response planning involves preparing for and responding to security incidents, not setting secure configurations',
                    'Correct - Security baselines and hardening involve establishing secure configurations for systems, including disabling unnecessary services, implementing strong policies, and configuring security controls',
                    'Incorrect - Vulnerability scanning identifies security weaknesses in systems but does not involve establishing secure configurations',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 2,
                'type_id' => 1,
                'irt_a' => 1.1,
                'irt_b' => -0.2,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 8 - L4 - Analyze
            [
                'subtopic' => 'Endpoint Security',
                'question' => 'Which security approach aims to unify and correlate security data across multiple security layers (endpoint, network, cloud, identity, email) to provide broader visibility and faster response?',
                'options' => [
                    'Endpoint Protection Platform (EPP)',
                    'Endpoint Detection and Response (EDR)',
                    'Extended Detection and Response (XDR)',
                    'Security Information and Event Management (SIEM)',
                ],
                'correct_options' => ['Extended Detection and Response (XDR)'],
                'justifications' => [
                    'Incorrect - EPP provides traditional endpoint protection (antivirus, firewall, etc.) but is limited to endpoint security only',
                    'Incorrect - EDR focuses specifically on endpoint detection and response capabilities, not cross-platform correlation',
                    'Correct - Extended Detection and Response (XDR) unifies and correlates security data across multiple security layers including endpoints, networks, cloud, identity, and email to provide comprehensive visibility and coordinated response',
                    'Incorrect - While SIEM collects and analyzes security events from multiple sources, XDR goes further by providing automated correlation and response capabilities across platforms',
                ],
                'bloom_level' => 4,
                'difficulty_level' => 3,
                'type_id' => 1,
                'irt_a' => 1.3,
                'irt_b' => 0.5,
                'irt_c' => 0.20,
                'status' => 'published',
            ],

            // Item 9 - L5 - Evaluate
            [
                'subtopic' => 'Endpoint Security',
                'question' => 'A company implements AI-powered endpoint protection that automatically isolates suspicious endpoints. Evaluate the security benefits and operational risks.',
                'options' => [
                    'AI-powered isolation is always beneficial with no risks',
                    'Can improve threat response time but may cause business disruption from false positives',
                    'AI-powered systems should never make automatic isolation decisions',
                    'Automatic isolation eliminates the need for security analysts',
                ],
                'correct_options' => ['Can improve threat response time but may cause business disruption from false positives'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Can improve threat response time but may cause business disruption from false positives',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'bloom_level' => 5,
                'difficulty_level' => 5,
                'type_id' => 1,
                'irt_a' => 1.9,
                'irt_b' => 1.3,
                'irt_c' => 0.15,
                'type_id' => 1,
                'status' => 'published',
            ],

            // Item 10 - L5 - Evaluate
            [
                'subtopic' => 'Endpoint Security',
                'question' => 'Assess the effectiveness of using endpoint security as the primary defense strategy for an organization.',
                'options' => [
                    'Endpoint security alone provides complete protection',
                    'Endpoint security is critical but must be part of a layered defense strategy',
                    'Endpoint security is unnecessary with proper network security',
                    'Endpoint security is only effective for known threats',
                ],
                'correct_options' => ['Endpoint security is critical but must be part of a layered defense strategy'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Endpoint security is critical but must be part of a layered defense strategy',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'bloom_level' => 5,
                'difficulty_level' => 5,
                'type_id' => 1,
                'irt_a' => 2.0,
                'irt_b' => 1.5,
                'irt_c' => 0.15,
                'type_id' => 1,
                'status' => 'published',
            ],

            // Topic 2: Mobile Device Management (10 questions)
            // Bloom Distribution: L1:1, L2:2, L3:3, L4:2, L5:2

            // Item 11 - L2 - Understand
            [
                'subtopic' => 'Mobile Security',
                'question' => 'What is the primary method MDM solutions use to enforce security policies (e.g., password complexity, device encryption) on enrolled devices?',
                'options' => [
                    'Physical device inspection',
                    'Agent-based software and management profiles',
                    'Direct access to the device\'s operating system kernel',
                    'Network firewall rules',
                ],
                'correct_options' => ['Agent-based software and management profiles'],
                'justifications' => [
                    'Incorrect - Physical inspection cannot enforce real-time security policies or automated compliance',
                    'Correct - MDM solutions deploy agent software and configuration profiles that integrate with the device OS to enforce security policies, monitor compliance, and manage device settings',
                    'Incorrect - MDM solutions work through documented APIs and management frameworks, not direct kernel access',
                    'Incorrect - Network firewall rules control network traffic but cannot enforce device-level policies like password complexity or encryption',
                ],
                'bloom_level' => 2,
                'difficulty_level' => 2,
                'type_id' => 1,
                'irt_a' => 1.1,
                'irt_b' => -0.5,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 12 - L2 - Understand
            [
                'subtopic' => 'Mobile Security',
                'question' => 'How does containerization improve mobile security in enterprise environments?',
                'options' => [
                    'Containerization increases device performance',
                    'Containerization separates corporate and personal data with distinct security policies',
                    'Containerization reduces battery consumption',
                    'Containerization only works on corporate-owned devices',
                ],
                'correct_options' => ['Containerization separates corporate and personal data with distinct security policies'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Containerization separates corporate and personal data with distinct security policies',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'type_id' => 1,
                'irt_a' => 1.2,
                'irt_b' => -0.4,
                'irt_c' => 0.25,
                'type_id' => 1,
                'status' => 'published',
            ],

            // Item 13 - L2 - Understand
            [
                'subtopic' => 'Mobile Security',
                'question' => 'Why is remote wipe capability important in mobile device management?',
                'options' => [
                    'Remote wipe improves device performance',
                    'Remote wipe protects corporate data when devices are lost or stolen',
                    'Remote wipe is required for app store compliance',
                    'Remote wipe reduces mobile data usage',
                ],
                'correct_options' => ['Remote wipe protects corporate data when devices are lost or stolen'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Remote wipe protects corporate data when devices are lost or stolen',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'type_id' => 1,
                'irt_a' => 1.4,
                'irt_b' => -0.1,
                'irt_c' => 0.25,
                'type_id' => 1,
                'status' => 'published',
            ],

            // Item 14 - L3 - Apply
            [
                'subtopic' => 'Mobile Security',
                'question' => 'A healthcare organization needs to enable staff to access patient records on personal mobile devices. What MDM approach should they implement?',
                'options' => [
                    'Allow unrestricted access from any personal device',
                    'Implement MAM with app-based encryption and conditional access policies',
                    'Prohibit all personal device access to maintain security',
                    'Only allow access through web browsers without any controls',
                ],
                'correct_options' => ['Implement MAM with app-based encryption and conditional access policies'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Implement MAM with app-based encryption and conditional access policies',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'type_id' => 1,
                'irt_a' => 1.5,
                'irt_b' => 0.2,
                'irt_c' => 0.25,
                'type_id' => 1,
                'status' => 'published',
            ],

            // Item 15 - L3 - Apply
            [
                'subtopic' => 'Mobile Security',
                'question' => 'How should an organization handle mobile device compliance for devices in different countries with varying privacy regulations?',
                'options' => [
                    'Apply the same MDM policies globally without consideration of local laws',
                    'Customize MDM policies to respect local privacy requirements while maintaining security',
                    'Only deploy MDM in countries with minimal privacy regulations',
                    'Avoid international mobile device deployment entirely',
                ],
                'correct_options' => ['Customize MDM policies to respect local privacy requirements while maintaining security'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Customize MDM policies to respect local privacy requirements while maintaining security',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'type_id' => 1,
                'irt_a' => 1.4,
                'irt_b' => 0.4,
                'irt_c' => 0.25,
                'type_id' => 1,
                'status' => 'published',
            ],

            // Item 16 - L3 - Apply
            [
                'subtopic' => 'Mobile Security',
                'question' => 'What is the most secure approach for implementing mobile device authentication in a high-security environment?',
                'options' => [
                    'Use only device PIN or password',
                    'Implement multi-factor authentication with biometrics and device certificates',
                    'Rely on network-based authentication only',
                    'Use shared device credentials for simplicity',
                ],
                'correct_options' => ['Implement multi-factor authentication with biometrics and device certificates'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Implement multi-factor authentication with biometrics and device certificates',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'type_id' => 1,
                'irt_a' => 1.6,
                'irt_b' => 0.6,
                'irt_c' => 0.25,
                'type_id' => 1,
                'status' => 'published',
            ],

            // Item 17 - L4 - Analyze
            [
                'subtopic' => 'Mobile Security',
                'question' => 'Analyze the privacy implications of implementing comprehensive MDM policies on employee personal devices.',
                'options' => [
                    'MDM policies have no privacy implications for personal devices',
                    'Comprehensive MDM can create privacy concerns requiring careful policy balance',
                    'Privacy concerns are irrelevant when devices access corporate data',
                    'MDM only affects corporate applications and data',
                ],
                'correct_options' => ['Comprehensive MDM can create privacy concerns requiring careful policy balance'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Comprehensive MDM can create privacy concerns requiring careful policy balance',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'type_id' => 1,
                'irt_a' => 1.7,
                'irt_b' => 0.9,
                'irt_c' => 0.20,
                'type_id' => 1,
                'status' => 'published',
            ],

            // Item 18 - L4 - Analyze
            [
                'subtopic' => 'Mobile Security',
                'question' => 'What is the fundamental challenge in managing mobile devices across different operating systems and versions?',
                'options' => [
                    'All mobile operating systems have identical security features',
                    'Fragmented OS capabilities and security model differences require platform-specific approaches',
                    'Mobile device management is only possible on the latest OS versions',
                    'Cross-platform management has no technical challenges',
                ],
                'correct_options' => ['Fragmented OS capabilities and security model differences require platform-specific approaches'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Fragmented OS capabilities and security model differences require platform-specific approaches',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'type_id' => 1,
                'irt_a' => 1.8,
                'irt_b' => 1.1,
                'irt_c' => 0.20,
                'type_id' => 1,
                'status' => 'published',
            ],

            // Item 19 - L5 - Evaluate
            [
                'subtopic' => 'Mobile Security',
                'question' => 'A company adopts a "mobile-first" work strategy with minimal device restrictions to improve employee satisfaction. Evaluate this approach from a security perspective.',
                'options' => [
                    'Mobile-first strategies with minimal restrictions are always secure',
                    'May improve productivity but increases security risk requiring compensating controls',
                    'Security is not relevant in mobile-first environments',
                    'Minimal restrictions eliminate all mobile security concerns',
                ],
                'correct_options' => ['May improve productivity but increases security risk requiring compensating controls'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - May improve productivity but increases security risk requiring compensating controls',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'bloom_level' => 5,
                'difficulty_level' => 5,
                'type_id' => 1,
                'irt_a' => 1.9,
                'irt_b' => 1.4,
                'irt_c' => 0.15,
                'type_id' => 1,
                'status' => 'published',
            ],

            // Item 20 - L5 - Evaluate
            [
                'subtopic' => 'Mobile Security',
                'question' => 'Assess the long-term sustainability of traditional MDM approaches as mobile operating systems become more privacy-focused.',
                'options' => [
                    'Traditional MDM will remain unchanged regardless of OS evolution',
                    'Privacy-focused OS changes require evolution toward zero-trust and application-centric security',
                    'Privacy improvements eliminate the need for mobile device management',
                    'Traditional MDM approaches are incompatible with privacy requirements',
                ],
                'correct_options' => ['Privacy-focused OS changes require evolution toward zero-trust and application-centric security'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Privacy-focused OS changes require evolution toward zero-trust and application-centric security',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'bloom_level' => 5,
                'difficulty_level' => 5,
                'type_id' => 1,
                'irt_a' => 2.0,
                'irt_b' => 1.3,
                'irt_c' => 0.15,
                'type_id' => 1,
                'status' => 'published',
            ],

            // Topic 3: IoT Device Security (10 questions)
            // Bloom Distribution: L1:2, L2:2, L3:3, L4:2, L5:1

            // Item 21 - L3 - Apply
            [
                'subtopic' => 'IoT Security',
                'question' => 'When decommissioning an IoT device that stored sensitive data, what is a crucial security step?',
                'options' => [
                    'Simply unplugging the device',
                    'Securely erasing or sanitizing any stored data',
                    'Giving the device to a new user',
                    'Factory resetting without data erasure',
                ],
                'correct_options' => ['Securely erasing or sanitizing any stored data'],
                'justifications' => [
                    'Incorrect - Simply unplugging leaves sensitive data intact and recoverable on the device storage',
                    'Correct - Secure data erasure or sanitization ensures that sensitive information cannot be recovered from the device after decommissioning, preventing data breaches',
                    'Incorrect - Transferring the device without proper data erasure exposes sensitive data to unauthorized parties',
                    'Incorrect - Factory resets often do not completely erase data and can leave recoverable information on the storage media',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 2,
                'type_id' => 1,
                'irt_a' => 1.2,
                'irt_b' => -0.4,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 22 - L1 - Remember
            [
                'subtopic' => 'IoT Security',
                'question' => 'What does "device shadowing" or "shadow IoT" refer to?',
                'options' => [
                    'IoT devices that operate in dark environments',
                    'Unauthorized IoT devices connected to corporate networks without IT approval',
                    'IoT devices that create backups of other devices',
                    'IoT devices that are more expensive than budgeted',
                ],
                'correct_options' => ['Unauthorized IoT devices connected to corporate networks without IT approval'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Unauthorized IoT devices connected to corporate networks without IT approval',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'bloom_level' => 1,
                'difficulty_level' => 1,
                'type_id' => 1,
                'irt_a' => 0.9,
                'irt_b' => -1.2,
                'irt_c' => 0.25,
                'type_id' => 1,
                'status' => 'published',
            ],

            // Item 23 - L3 - Apply
            [
                'subtopic' => 'IoT Security',
                'question' => 'A manufacturing plant installs numerous IoT sensors on its production line. To minimize the impact if one sensor is compromised, what network strategy should be employed?',
                'options' => [
                    'Connect all sensors directly to the internet',
                    'Place all sensors on the same flat network as critical corporate servers',
                    'Implement strict network segmentation and micro-segmentation for IoT devices',
                    'Use a single Wi-Fi network for all devices',
                ],
                'correct_options' => ['Implement strict network segmentation and micro-segmentation for IoT devices'],
                'justifications' => [
                    'Incorrect - Direct internet connectivity exposes sensors to external threats and eliminates network controls',
                    'Incorrect - Flat networks allow compromised IoT devices to potentially access critical corporate systems',
                    'Correct - Network segmentation and micro-segmentation isolate IoT devices, limit lateral movement if compromised, and contain potential security breaches',
                    'Incorrect - Single Wi-Fi networks create a flat topology that allows unrestricted communication between all connected devices',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'type_id' => 1,
                'irt_a' => 1.4,
                'irt_b' => 0.1,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 24 - L2 - Understand
            [
                'subtopic' => 'IoT Security',
                'question' => 'A common vulnerability in IoT devices due to constrained environments is:',
                'options' => [
                    'Over-provisioned memory',
                    'Use of default or hardcoded credentials',
                    'Excessive computing power',
                    'Automated and frequent security updates',
                ],
                'correct_options' => ['Use of default or hardcoded credentials'],
                'justifications' => [
                    'Incorrect - IoT devices typically have limited memory, not over-provisioned memory',
                    'Correct - Resource-constrained IoT devices often ship with default passwords or hardcoded credentials that are rarely changed, creating significant security vulnerabilities',
                    'Incorrect - IoT devices are characterized by limited computing power, not excessive power',
                    'Incorrect - IoT devices typically lack automated update mechanisms due to resource constraints and operational requirements',
                ],
                'bloom_level' => 2,
                'difficulty_level' => 2,
                'type_id' => 1,
                'irt_a' => 1.1,
                'irt_b' => -0.6,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 25 - L3 - Apply
            [
                'subtopic' => 'IoT Security',
                'question' => 'A manufacturing company wants to deploy IoT sensors for equipment monitoring. What security approach should they implement?',
                'options' => [
                    'Connect all IoT devices directly to the corporate network',
                    'Create isolated network segments with monitoring and access controls',
                    'Use only wireless IoT devices to avoid network security issues',
                    'Implement IoT devices without any security controls for simplicity',
                ],
                'correct_options' => ['Create isolated network segments with monitoring and access controls'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Create isolated network segments with monitoring and access controls',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.4,
                'irt_b' => 0.2,
                'irt_c' => 0.25,
                'type_id' => 1,
                'status' => 'published',
            ],

            // Item 26 - L3 - Apply
            [
                'subtopic' => 'IoT Security',
                'question' => 'How should an organization handle firmware updates for critical IoT devices in production environments?',
                'options' => [
                    'Never update firmware to maintain stability',
                    'Implement staged rollouts with testing and rollback capabilities',
                    'Update all devices simultaneously to ensure consistency',
                    'Only update firmware when devices fail',
                ],
                'correct_options' => ['Implement staged rollouts with testing and rollback capabilities'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Implement staged rollouts with testing and rollback capabilities',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.5,
                'irt_b' => 0.4,
                'irt_c' => 0.25,
                'type_id' => 1,
                'status' => 'published',
            ],

            // Item 27 - L3 - Apply
            [
                'subtopic' => 'IoT Security',
                'question' => 'What is the most effective approach for monitoring IoT device security in a large deployment?',
                'options' => [
                    'Manually check each device periodically',
                    'Implement automated network monitoring with anomaly detection',
                    'Rely on device manufacturers to monitor security',
                    'Only monitor devices when security incidents occur',
                ],
                'correct_options' => ['Implement automated network monitoring with anomaly detection'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Implement automated network monitoring with anomaly detection',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'type_id' => 1,
                'irt_a' => 1.6,
                'irt_b' => 0.6,
                'irt_c' => 0.25,
                'type_id' => 1,
                'status' => 'published',
            ],

            // Item 28 - L4 - Analyze
            [
                'subtopic' => 'IoT Security',
                'question' => 'Analyze why traditional IT security approaches may be inadequate for IoT environments.',
                'options' => [
                    'IoT devices are inherently more secure than traditional IT systems',
                    'IoT devices have resource constraints and different threat models than traditional IT',
                    'Traditional IT security is always superior to IoT security approaches',
                    'IoT and traditional IT have identical security requirements',
                ],
                'correct_options' => ['IoT devices have resource constraints and different threat models than traditional IT'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - IoT devices have resource constraints and different threat models than traditional IT',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'type_id' => 1,
                'irt_a' => 1.7,
                'irt_b' => 0.8,
                'irt_c' => 0.20,
                'type_id' => 1,
                'status' => 'published',
            ],

            // Item 29 - L4 - Analyze
            [
                'subtopic' => 'IoT Security',
                'question' => 'What is the fundamental challenge in implementing end-to-end encryption for IoT communications?',
                'options' => [
                    'IoT devices do not support any form of encryption',
                    'Limited processing power and battery life of many IoT devices',
                    'Encryption is illegal for IoT devices in most countries',
                    'End-to-end encryption eliminates IoT device functionality',
                ],
                'correct_options' => ['Limited processing power and battery life of many IoT devices'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Limited processing power and battery life of many IoT devices',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'type_id' => 1,
                'irt_a' => 1.8,
                'irt_b' => 1.0,
                'irt_c' => 0.20,
                'type_id' => 1,
                'status' => 'published',
            ],

            // Item 30 - L5 - Evaluate
            [
                'subtopic' => 'IoT Security',
                'question' => 'A smart city initiative deploys thousands of IoT sensors with 10-year expected lifespans. Evaluate the long-term security implications.',
                'options' => [
                    'Long-term deployments eliminate security concerns',
                    'Requires sustainable security update mechanisms and lifecycle management strategies',
                    'Security is only important during initial deployment',
                    'Long-term IoT deployments are inherently secure',
                ],
                'correct_options' => ['Requires sustainable security update mechanisms and lifecycle management strategies'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Requires sustainable security update mechanisms and lifecycle management strategies',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'bloom_level' => 5,
                'difficulty_level' => 5,
                'irt_a' => 1.9,
                'irt_b' => 1.5,
                'irt_c' => 0.15,
                'type_id' => 1,
                'status' => 'published',
            ],

            // Topic 4: Industrial Control Systems Security (10 questions)
            // Bloom Distribution: L1:2, L2:2, L3:3, L4:2, L5:1

            // Item 31 - L1 - Remember
            [
                'subtopic' => 'OT Security',
                'question' => 'What does ICS stand for in the context of OT security?',
                'options' => [
                    'Internet Computing Systems',
                    'Industrial Control Systems',
                    'Internal Communication Standards',
                    'Integrated Computer Solutions',
                ],
                'correct_options' => ['Industrial Control Systems'],
                'justifications' => [
                    'Incorrect - Internet Computing Systems is not a standard term in OT security contexts',
                    'Correct - ICS stands for Industrial Control Systems, which are computer-based systems that monitor and control industrial processes in sectors like manufacturing, energy, and utilities',
                    'Incorrect - Internal Communication Standards is not what ICS represents in OT security',
                    'Incorrect - Integrated Computer Solutions is not the correct definition of ICS in operational technology',
                ],
                'bloom_level' => 1,
                'difficulty_level' => 1,
                'type_id' => 1,
                'irt_a' => 0.8,
                'irt_b' => -1.5,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 32 - L1 - Remember
            [
                'subtopic' => 'OT Security',
                'question' => 'What is the primary difference between IT and OT (Operational Technology) networks?',
                'options' => [
                    'IT focuses on data processing while OT focuses on physical process control',
                    'IT is more expensive than OT',
                    'IT uses wireless while OT uses wired connections',
                    'IT and OT networks are identical in function',
                ],
                'correct_options' => ['IT focuses on data processing while OT focuses on physical process control'],
                'justifications' => [
                    'Correct - IT focuses on data processing while OT focuses on physical process control',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'bloom_level' => 1,
                'difficulty_level' => 1,
                'type_id' => 1,
                'irt_a' => 0.9,
                'irt_b' => -1.3,
                'irt_c' => 0.25,
                'type_id' => 1,
                'status' => 'published',
            ],

            // Item 33 - L2 - Understand
            [
                'subtopic' => 'OT Security',
                'question' => 'Why is "safety" often prioritized over "security" in critical OT environments like nuclear power plants?',
                'options' => [
                    'Security vulnerabilities are rare in OT',
                    'A security breach could directly lead to physical harm',
                    'OT systems do not store sensitive data',
                    'Security is too expensive to implement',
                ],
                'correct_options' => ['A security breach could directly lead to physical harm'],
                'justifications' => [
                    'Incorrect - Security vulnerabilities are actually common in OT environments due to legacy systems and operational constraints',
                    'Correct - In critical infrastructure like nuclear plants, safety is prioritized because a security breach could cause catastrophic physical harm, environmental damage, or loss of life, making immediate safety the paramount concern',
                    'Incorrect - OT systems often control processes that involve sensitive operational data and critical infrastructure information',
                    'Incorrect - Cost is not the primary factor; the life-safety implications of OT systems make safety the top priority regardless of security implementation costs',
                ],
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'type_id' => 1,
                'irt_a' => 1.2,
                'irt_b' => -0.4,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 34 - L3 - Apply
            [
                'subtopic' => 'OT Security',
                'question' => 'A common attack vector for sophisticated threats targeting air-gapped OT networks is:',
                'options' => [
                    'Direct internet access',
                    'Removable media',
                    'Wi-Fi hotspots',
                    'Public cloud connections',
                ],
                'correct_options' => ['Removable media'],
                'justifications' => [
                    'Incorrect - Air-gapped networks are specifically isolated from direct internet access, making this vector impossible',
                    'Correct - Removable media (USB drives, CDs, etc.) is the primary attack vector for air-gapped systems, as demonstrated by attacks like Stuxnet which used infected USB drives to bridge the air gap',
                    'Incorrect - While Wi-Fi could be a concern, air-gapped networks typically disable all wireless communications',
                    'Incorrect - Air-gapped networks are specifically designed to have no cloud connections or external network access',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'type_id' => 1,
                'irt_a' => 1.4,
                'irt_b' => 0.1,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 35 - L2 - Understand
            [
                'subtopic' => 'OT Security',
                'question' => 'In OT environments, there is often a tension between "safety" and "security." Which of the following statements best describes this priority?',
                'options' => [
                    'Security always takes precedence over safety',
                    'Safety is generally the highest priority',
                    'Security and safety are always perfectly aligned',
                    'Neither safety nor security is a significant concern in OT',
                ],
                'correct_options' => ['Safety is generally the highest priority'],
                'justifications' => [
                    'Incorrect - Security measures that could interfere with safety operations are typically subordinated to safety requirements',
                    'Correct - Safety is generally the highest priority in OT environments because the primary function is to protect human life and prevent physical harm, even if this means accepting some security risks',
                    'Incorrect - There is often tension between safety and security requirements, as security measures may impact operational safety or response times',
                    'Incorrect - Both safety and security are critical concerns in OT, but safety typically takes precedence when they conflict',
                ],
                'bloom_level' => 2,
                'difficulty_level' => 2,
                'type_id' => 1,
                'irt_a' => 1.1,
                'irt_b' => -0.6,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 36 - L3 - Apply
            [
                'subtopic' => 'OT Security',
                'question' => 'How should remote access to industrial control systems be implemented securely?',
                'options' => [
                    'Allow direct internet access to control systems for convenience',
                    'Implement VPN with multi-factor authentication and session monitoring',
                    'Use standard Windows Remote Desktop without additional security',
                    'Prohibit all remote access to maintain security',
                ],
                'correct_options' => ['Implement VPN with multi-factor authentication and session monitoring'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Implement VPN with multi-factor authentication and session monitoring',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'type_id' => 1,
                'irt_a' => 1.4,
                'irt_b' => 0.4,
                'irt_c' => 0.25,
                'type_id' => 1,
                'status' => 'published',
            ],

            // Item 37 - L3 - Apply
            [
                'subtopic' => 'OT Security',
                'question' => 'What is the most appropriate approach for implementing security monitoring in industrial environments?',
                'options' => [
                    'Use standard IT security tools without modification',
                    'Deploy specialized industrial security monitoring that understands OT protocols',
                    'Only monitor network perimeter security',
                    'Avoid security monitoring to prevent interference with operations',
                ],
                'correct_options' => ['Deploy specialized industrial security monitoring that understands OT protocols'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Deploy specialized industrial security monitoring that understands OT protocols',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'type_id' => 1,
                'irt_a' => 1.6,
                'irt_b' => 0.6,
                'irt_c' => 0.25,
                'type_id' => 1,
                'status' => 'published',
            ],

            // Item 38 - L4 - Analyze
            [
                'subtopic' => 'OT Security',
                'question' => 'Analyze why traditional IT security patching practices may be inappropriate for industrial control systems.',
                'options' => [
                    'Industrial systems never require security patches',
                    'Industrial systems require high availability and extensive testing before patches',
                    'IT patches always improve industrial system performance',
                    'Industrial systems use different operating systems that cannot be patched',
                ],
                'correct_options' => ['Industrial systems require high availability and extensive testing before patches'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Industrial systems require high availability and extensive testing before patches',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'type_id' => 1,
                'irt_a' => 1.7,
                'irt_b' => 0.9,
                'irt_c' => 0.20,
                'type_id' => 1,
                'status' => 'published',
            ],

            // Item 39 - L4 - Analyze
            [
                'subtopic' => 'OT Security',
                'question' => 'What is the fundamental challenge in applying zero trust principles to industrial control networks?',
                'options' => [
                    'Zero trust is not applicable to industrial environments',
                    'Legacy systems and real-time requirements complicate identity verification and micro-segmentation',
                    'Industrial systems are inherently more trustworthy than IT systems',
                    'Zero trust eliminates the need for industrial safety systems',
                ],
                'correct_options' => ['Legacy systems and real-time requirements complicate identity verification and micro-segmentation'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Legacy systems and real-time requirements complicate identity verification and micro-segmentation',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'type_id' => 1,
                'irt_a' => 1.8,
                'irt_b' => 1.1,
                'irt_c' => 0.20,
                'type_id' => 1,
                'status' => 'published',
            ],

            // Item 40 - L5 - Evaluate
            [
                'subtopic' => 'OT Security',
                'question' => 'A manufacturing company wants to connect their production systems to cloud-based analytics platforms. Evaluate the security implications.',
                'options' => [
                    'Cloud connectivity eliminates all industrial security risks',
                    'Requires careful architecture to maintain operational integrity while enabling data analytics',
                    'Industrial systems should never connect to external networks',
                    'Cloud analytics platforms automatically secure industrial connections',
                ],
                'correct_options' => ['Requires careful architecture to maintain operational integrity while enabling data analytics'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Requires careful architecture to maintain operational integrity while enabling data analytics',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'bloom_level' => 5,
                'difficulty_level' => 5,
                'type_id' => 1,
                'irt_a' => 1.9,
                'irt_b' => 1.4,
                'irt_c' => 0.15,
                'type_id' => 1,
                'status' => 'published',
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
                    'Development, testing, and production',
                ],
                'correct_options' => ['Procurement, deployment, maintenance, and disposal'],
                'justifications' => [
                    'Correct - Procurement, deployment, maintenance, and disposal',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'bloom_level' => 1,
                'difficulty_level' => 1,
                'type_id' => 1,
                'irt_a' => 0.8,
                'irt_b' => -1.4,
                'irt_c' => 0.25,
                'type_id' => 1,
                'status' => 'published',
            ],

            // Item 42 - L3 - Apply
            [
                'subtopic' => 'Device Security',
                'question' => 'How should an enterprise implement secure device provisioning for a large-scale laptop deployment with diverse user roles?',
                'options' => [
                    'Use identical configurations for all devices to ensure consistency',
                    'Implement automated provisioning with role-based configurations and security baselines',
                    'Allow users to configure their own devices after receiving them',
                    'Only provision devices manually to ensure maximum security',
                ],
                'correct_options' => ['Implement automated provisioning with role-based configurations and security baselines'],
                'justifications' => [
                    'Incorrect - Identical configurations don\'t address varying security and functional requirements',
                    'Correct - Automated role-based provisioning ensures appropriate security while scaling efficiently',
                    'Incorrect - User configuration introduces security risks and inconsistencies',
                    'Incorrect - Manual provisioning doesn\'t scale and increases error risk',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.4,
                'irt_b' => 0.3,
                'irt_c' => 0.25,
                'type_id' => 1,
                'status' => 'published',
            ],

            // Item 43 - L2 - Understand
            [
                'subtopic' => 'Device Security',
                'question' => 'Why is asset inventory critical for device lifecycle management?',
                'options' => [
                    'Asset inventory reduces device costs',
                    'Asset inventory enables security monitoring and compliance throughout device lifecycles',
                    'Asset inventory is only needed for expensive devices',
                    'Asset inventory improves device performance',
                ],
                'correct_options' => ['Asset inventory enables security monitoring and compliance throughout device lifecycles'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Asset inventory enables security monitoring and compliance throughout device lifecycles',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'irt_a' => 1.2,
                'irt_b' => -0.3,
                'irt_c' => 0.25,
                'type_id' => 1,
                'status' => 'published',
            ],

            // Item 44 - L2 - Understand
            [
                'subtopic' => 'Device Security',
                'question' => 'How does secure device disposal protect organizational data?',
                'options' => [
                    'Disposal procedures only affect physical device security',
                    'Proper data wiping and destruction prevent data recovery from discarded devices',
                    'Device disposal has no impact on data security',
                    'Only damaged devices require secure disposal',
                ],
                'correct_options' => ['Proper data wiping and destruction prevent data recovery from discarded devices'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Proper data wiping and destruction prevent data recovery from discarded devices',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'irt_a' => 1.3,
                'irt_b' => -0.1,
                'irt_c' => 0.25,
                'type_id' => 1,
                'status' => 'published',
            ],

            // Item 45 - L3 - Apply
            [
                'subtopic' => 'Device Security',
                'question' => 'A financial services company needs to replace 1000 workstations while maintaining data security. What approach should they implement?',
                'options' => [
                    'Replace all devices simultaneously without data migration',
                    'Implement phased replacement with secure data migration and disposal procedures',
                    'Keep old devices as backups without any security controls',
                    'Allow employees to dispose of old devices independently',
                ],
                'correct_options' => ['Implement phased replacement with secure data migration and disposal procedures'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Implement phased replacement with secure data migration and disposal procedures',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.4,
                'irt_b' => 0.3,
                'irt_c' => 0.25,
                'type_id' => 1,
                'status' => 'published',
            ],

            // Item 46 - L3 - Apply
            [
                'subtopic' => 'Device Security',
                'question' => 'How should an organization handle end-of-life devices that cannot be securely updated?',
                'options' => [
                    'Continue using devices until they fail completely',
                    'Isolate devices from networks and plan replacement with enhanced monitoring',
                    'Only update devices that show signs of security compromise',
                    'Transfer end-of-life devices to less critical functions',
                ],
                'correct_options' => ['Isolate devices from networks and plan replacement with enhanced monitoring'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Isolate devices from networks and plan replacement with enhanced monitoring',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.5,
                'irt_b' => 0.4,
                'irt_c' => 0.25,
                'type_id' => 1,
                'status' => 'published',
            ],

            // Item 47 - L3 - Apply
            [
                'subtopic' => 'Device Security',
                'question' => 'What is the most effective approach for managing device certificates and keys throughout their lifecycle?',
                'options' => [
                    'Use permanent certificates that never expire',
                    'Implement automated certificate lifecycle management with rotation and revocation',
                    'Only manage certificates manually when problems occur',
                    'Use the same certificate for all devices of the same type',
                ],
                'correct_options' => ['Implement automated certificate lifecycle management with rotation and revocation'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Implement automated certificate lifecycle management with rotation and revocation',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'type_id' => 1,
                'irt_a' => 1.6,
                'irt_b' => 0.6,
                'irt_c' => 0.25,
                'type_id' => 1,
                'status' => 'published',
            ],

            // Item 48 - L4 - Analyze
            [
                'subtopic' => 'Device Security',
                'question' => 'Analyze the security implications of extending device lifecycles beyond manufacturer support periods.',
                'options' => [
                    'Extended lifecycles always improve security through stability',
                    'Extended lifecycles increase security risk due to lack of updates and support',
                    'Manufacturer support has no impact on device security',
                    'Extended lifecycles reduce costs without affecting security',
                ],
                'correct_options' => ['Extended lifecycles increase security risk due to lack of updates and support'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Extended lifecycles increase security risk due to lack of updates and support',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'type_id' => 1,
                'irt_a' => 1.7,
                'irt_b' => 0.8,
                'irt_c' => 0.20,
                'type_id' => 1,
                'status' => 'published',
            ],

            // Item 49 - L4 - Analyze
            [
                'subtopic' => 'Device Security',
                'question' => 'What is the fundamental challenge in managing device lifecycles in hybrid cloud environments?',
                'options' => [
                    'Cloud devices never require lifecycle management',
                    'Hybrid environments complicate visibility and control across on-premises and cloud resources',
                    'Device lifecycles are identical in cloud and on-premises environments',
                    'Cloud providers handle all device lifecycle management automatically',
                ],
                'correct_options' => ['Hybrid environments complicate visibility and control across on-premises and cloud resources'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Hybrid environments complicate visibility and control across on-premises and cloud resources',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'type_id' => 1,
                'irt_a' => 1.8,
                'irt_b' => 1.0,
                'irt_c' => 0.20,
                'type_id' => 1,
                'status' => 'published',
            ],

            // Item 50 - L5 - Evaluate
            [
                'subtopic' => 'Device Security',
                'question' => 'An organization implements AI-driven predictive analytics to optimize device replacement timing. Evaluate this approach.',
                'options' => [
                    'AI-driven optimization eliminates all device lifecycle risks',
                    'Can improve efficiency and security posture but requires validation and human oversight',
                    'Predictive analytics should never be used for device lifecycle decisions',
                    'AI optimization eliminates the need for traditional lifecycle management',
                ],
                'correct_options' => ['Can improve efficiency and security posture but requires validation and human oversight'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Can improve efficiency and security posture but requires validation and human oversight',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'bloom_level' => 5,
                'difficulty_level' => 5,
                'irt_a' => 1.9,
                'irt_b' => 1.5,
                'irt_c' => 0.15,
                'type_id' => 1,
                'status' => 'published',
            ],
        ];
    }
}
