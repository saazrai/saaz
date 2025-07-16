<?php

namespace Database\Seeders\Diagnostics;

use App\Models\DiagnosticItem;
use App\Models\DiagnosticTopic;


use Illuminate\Database\Seeder;

class D17PhysicalEnvironmentalSecuritySeeder extends Seeder
{
    public function run(): void
    {
        // Get reference data
        $topics = DiagnosticTopic::whereHas('domain', function($query) {
            $query->where('name', 'Physical & Environmental Security');
        })->pluck('id', 'name');
        
        
        $items = [
            // Human Safety & Emergency Procedures - Item 1
            [
                'topic_id' => $topics['Human Safety & Emergency Procedures'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'During a fire alarm in a secure data center, which action takes the highest priority?',
                'options' => [
                    'Secure all classified documents',
                    'Lock all server room doors',
                    'Evacuate all personnel immediately',
                    'Shut down critical systems properly'
                ],
                'correct_options' => ['Evacuate all personnel immediately'],
                'justifications' => [
                    'Documents are less important than human life',
                    'Locking doors could trap people inside',
                    'Correct - Human safety always takes precedence over all other concerns',
                    'System shutdown is secondary to human safety'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 1,
                'status' => 'published'
            ],

            // Human Safety & Emergency Procedures - Item 2
            [
                'topic_id' => $topics['Human Safety & Emergency Procedures'] ?? 1,
                'type_id' => 2,
                'dimension' => 'Managerial',
                'content' => '**True or False:** Emergency exits in secure facilities should remain locked at all times to prevent unauthorized access.',
                'options' => [
                    'True',
                    'False'
                ],
                'correct_options' => ['False'],
                'justifications' => [
                    'explanation' => 'Emergency exits must never be locked in a way that prevents egress. They should use panic bars or other mechanisms that allow exit from inside while preventing entry from outside. Human safety always takes precedence over security concerns.'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 2,
                'status' => 'published'
            ],

            // Human Safety & Emergency Procedures - Item 3
            [
                'topic_id' => $topics['Human Safety & Emergency Procedures'] ?? 1,
                'type_id' => 3,
                'dimension' => 'Managerial',
                'content' => 'Drag the essential components of an emergency response plan to the drop zone:',
                'options' => [
                    'Evacuation routes and assembly points',
                    'Password reset procedures',
                    'Emergency contact lists',
                    'Server backup schedules',
                    'First aid station locations',
                    'Encryption key storage',
                    'Fire extinguisher locations',
                    'Network topology diagrams'
                ],
                'correct_options' => [
                    'Evacuation routes and assembly points',
                    'Emergency contact lists',
                    'First aid station locations',
                    'Fire extinguisher locations'
                ],
                'justifications' => [
                    'Essential for safe evacuation during emergencies',
                    'Not related to emergency response',
                    'Critical for contacting emergency services and key personnel',
                    'Not emergency-related',
                    'Important for medical emergencies',
                    'Not relevant to emergency response',
                    'Essential for initial fire response',
                    'Technical documentation not needed for emergencies'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],

            // Crime Prevention Through Environmental Design (CPTED) - Item 4
            [
                'topic_id' => $topics['Crime Prevention Through Environmental Design (CPTED)'] ?? 2,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Which CPTED principle is demonstrated by using low hedges and transparent fencing around a facility?',
                'options' => [
                    'Natural surveillance',
                    'Natural access control',
                    'Territorial reinforcement',
                    'Target hardening'
                ],
                'correct_options' => ['Natural surveillance'],
                'justifications' => [
                    'Correct - Low hedges and transparent fencing allow clear sight lines for observation',
                    'This relates to directing flow, not visibility',
                    'This relates to ownership boundaries, not visibility',
                    'This relates to physical barriers, not visibility design'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],

            // Crime Prevention Through Environmental Design (CPTED) - Item 5
            [
                'topic_id' => $topics['Crime Prevention Through Environmental Design (CPTED)'] ?? 2,
                'type_id' => 5,
                'dimension' => 'Managerial',
                'content' => 'Match each CPTED strategy with its implementation example:',
                'options' => [
                    'items' => [
                        'Clear sight lines and lighting',
                        'Single entry point with reception',
                        'Company logos and maintained landscaping',
                        'Security cameras and alarms'
                    ],
                    'responses' => [
                        'Natural surveillance',
                        'Natural access control',
                        'Territorial reinforcement',
                        'Target hardening'
                    ]
                ],
                'correct_options' => [
                    'Clear sight lines and lighting' => 'Natural surveillance',
                    'Single entry point with reception' => 'Natural access control',
                    'Company logos and maintained landscaping' => 'Territorial reinforcement',
                    'Security cameras and alarms' => 'Target hardening'
                ],
                'justifications' => [
                    'Clear sight lines and lighting' => 'Visibility enables natural monitoring',
                    'Single entry point with reception' => 'Controls and directs visitor flow naturally',
                    'Company logos and maintained landscaping' => 'Shows ownership and care of space',
                    'Security cameras and alarms' => 'Physical security measures that harden the target'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],

            // Site Selection & Security Considerations - Item 6
            [
                'topic_id' => $topics['Site Selection & Security Considerations'] ?? 3,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'When selecting a site for a new data center, which factors should be considered? (Select all that apply)',
                'options' => [
                    'Proximity to flood zones',
                    'Distance from emergency services',
                    'Local crime statistics',
                    'Proximity to chemical plants',
                    'Available parking spaces',
                    'Seismic activity history'
                ],
                'correct_options' => [
                    'Proximity to flood zones',
                    'Distance from emergency services',
                    'Local crime statistics',
                    'Proximity to chemical plants',
                    'Seismic activity history'
                ],
                'justifications' => [
                    'Correct - Flood risk affects facility availability',
                    'Correct - Emergency response time is critical',
                    'Correct - Crime rates affect physical security needs',
                    'Correct - Chemical accidents pose environmental risks',
                    'While convenient, not a security consideration',
                    'Correct - Earthquake risk affects facility design needs'
                ],
                'settings' => ['isMultiSelect' => true],
                'difficulty_level' => 2,
                'bloom_level' => 4,
                'status' => 'published'
            ],

            // Perimeter Security Controls - Item 7
            [
                'topic_id' => $topics['Perimeter Security Controls'] ?? 4,
                'type_id' => 4,
                'dimension' => 'Managerial',
                'content' => 'Arrange these perimeter security controls from outermost to innermost layer:',
                'options' => [
                    'Building entrance',
                    'Property fence',
                    'Parking lot barriers',
                    'Landscaping features',
                    'Lobby security desk'
                ],
                'correct_options' => [
                    'Landscaping features',
                    'Property fence',
                    'Parking lot barriers',
                    'Building entrance',
                    'Lobby security desk'
                ],
                'justifications' => ['Defense in depth starts with landscaping (natural barriers), then fence (property line), parking barriers (vehicle control), building entrance (facility access), and finally lobby desk (internal checkpoint).'],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],

            // Facility Layout & Security Zones - Item 8
            [
                'topic_id' => $topics['Facility Layout & Security Zones'] ?? 5,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Which areas should be located in the most secure zone of a facility?',
                'options' => [
                    'Reception and lobby areas',
                    'Employee break rooms',
                    'Server rooms and network operations centers',
                    'Conference rooms for client meetings'
                ],
                'correct_options' => ['Server rooms and network operations centers'],
                'justifications' => [
                    'Reception areas are public-facing, lowest security',
                    'Break rooms need employee access but not high security',
                    'Correct - Critical infrastructure requires the highest security zone',
                    'Meeting rooms often need visitor access, moderate security'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 2,
                'status' => 'published'
            ],

            // Physical Access Control Systems (PACS) - Item 9
            [
                'topic_id' => $topics['Physical Access Control Systems (PACS)'] ?? 6,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'What is the primary advantage of using proximity cards over traditional keys for physical access control?',
                'options' => [
                    'Proximity cards are cheaper to produce',
                    'Cards can be quickly deactivated if lost or stolen',
                    'Cards are more difficult to lose',
                    'Cards provide better physical security'
                ],
                'correct_options' => ['Cards can be quickly deactivated if lost or stolen'],
                'justifications' => [
                    'Cards are typically more expensive than keys',
                    'Correct - Electronic deactivation prevents unauthorized use immediately',
                    'Cards are equally easy to lose as keys',
                    'The security level depends on implementation, not the medium'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 2,
                'status' => 'published'
            ],

            // Physical Access Control Systems (PACS) - Item 10
            [
                'topic_id' => $topics['Physical Access Control Systems (PACS)'] ?? 6,
                'type_id' => 3,
                'dimension' => 'Managerial',
                'content' => 'Drag the authentication factors that can be integrated into modern PACS to the drop zone:',
                'options' => [
                    'Biometric scanners',
                    'Social media profiles',
                    'PIN codes',
                    'Smart cards',
                    'IP addresses',
                    'Facial recognition',
                    'Email addresses',
                    'Mobile credentials'
                ],
                'correct_options' => [
                    'Biometric scanners',
                    'PIN codes',
                    'Smart cards',
                    'Facial recognition',
                    'Mobile credentials'
                ],
                'justifications' => [
                    'Biometrics provide strong authentication',
                    'Not used for physical access control',
                    'Knowledge factor for multi-factor authentication',
                    'Common possession factor for PACS',
                    'Used for network, not physical access',
                    'Advanced biometric authentication method',
                    'Used for logical, not physical access',
                    'Modern NFC/Bluetooth-based credentials'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],

            // Tailgating and Piggybacking Prevention - Item 11
            [
                'topic_id' => $topics['Tailgating and Piggybacking Prevention'] ?? 7,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Which physical control is MOST effective at preventing tailgating?',
                'options' => [
                    'Security cameras at entrances',
                    'Mantrap or security vestibule',
                    'Proximity card readers',
                    'Security awareness training'
                ],
                'correct_options' => ['Mantrap or security vestibule'],
                'justifications' => [
                    'Cameras detect but do not prevent tailgating',
                    'Correct - Mantraps physically prevent multiple people from entering on one credential',
                    'Card readers alone do not prevent tailgating',
                    'Training helps but is not a physical control'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 4,
                'status' => 'published'
            ],

            // Security Guards & Visitor Management - Item 12
            [
                'topic_id' => $topics['Security Guards & Visitor Management'] ?? 8,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Which security guard responsibilities are essential for maintaining perimeter security? (Select all that apply)',
                'options' => [
                    'Conducting regular patrols on randomized schedules',
                    'Monitoring all social media for threats',
                    'Verifying credentials at access points',
                    'Responding to security alarms and incidents',
                    'Personally escorting all employees',
                    'Maintaining detailed activity logs',
                    'Performing employee background checks',
                    'Inspecting vehicles entering the premises'
                ],
                'correct_options' => [
                    'Conducting regular patrols on randomized schedules',
                    'Verifying credentials at access points',
                    'Responding to security alarms and incidents',
                    'Maintaining detailed activity logs',
                    'Inspecting vehicles entering the premises'
                ],
                'justifications' => [
                    'Correct - Randomized patrols prevent predictable security gaps',
                    'Typically handled by cybersecurity teams, not physical guards',
                    'Correct - Essential gatekeeping function',
                    'Correct - Primary response capability for physical incidents',
                    'Impractical and unnecessary for all employees',
                    'Correct - Creates accountability and incident documentation',
                    'HR function, not guard responsibility',
                    'Correct - Critical for preventing unauthorized vehicle access'
                ],
                'settings' => ['isMultiSelect' => true],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],

            // Surveillance Systems (CCTV) - Item 13
            [
                'topic_id' => $topics['Surveillance Systems (CCTV)'] ?? 9,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'What are the primary purposes of CCTV systems in physical security? (Select all that apply)',
                'options' => [
                    'Deterrence of criminal activity',
                    'Real-time incident detection',
                    'Evidence collection for investigations',
                    'Employee productivity monitoring',
                    'Access control enforcement',
                    'Insurance premium reduction'
                ],
                'correct_options' => [
                    'Deterrence of criminal activity',
                    'Real-time incident detection',
                    'Evidence collection for investigations'
                ],
                'justifications' => [
                    'Correct - Visible cameras deter criminal behavior',
                    'Correct - Monitored cameras enable immediate response',
                    'Correct - Recorded footage provides forensic evidence',
                    'Not a security purpose, raises privacy concerns',
                    'CCTV observes but does not enforce access control',
                    'While possible, not a primary security purpose'
                ],
                'settings' => ['isMultiSelect' => true],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],

            // Surveillance Systems (CCTV) - Item 14
            [
                'topic_id' => $topics['Surveillance Systems (CCTV)'] ?? 9,
                'type_id' => 2,
                'dimension' => 'Managerial',
                'content' => '**True or False:** CCTV cameras should be hidden to maximize their effectiveness in catching security violations.',
                'options' => [
                    'True',
                    'False'
                ],
                'correct_options' => ['False'],
                'justifications' => [
                    'explanation' => 'Visible CCTV cameras provide deterrence value, which is often more valuable than catching violations after they occur. A mix of visible and discrete cameras provides both deterrence and comprehensive coverage. Hidden cameras may also raise legal and privacy concerns.'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 4,
                'status' => 'published'
            ],

            // Lighting & Deterrence Principles - Item 15
            [
                'topic_id' => $topics['Lighting & Deterrence Principles'] ?? 10,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Which type of lighting provides the best security coverage for parking lots?',
                'options' => [
                    'Continuous bright lighting at maximum intensity',
                    'Motion-activated lighting only',
                    'Continuous lighting with overlapping coverage and no dark spots',
                    'Intermittent lighting that cycles on and off'
                ],
                'correct_options' => ['Continuous lighting with overlapping coverage and no dark spots'],
                'justifications' => [
                    'Excessive brightness can create harsh shadows and glare',
                    'Motion-only lighting leaves areas dark until triggered',
                    'Correct - Consistent, overlapping coverage eliminates hiding spots',
                    'Cycling creates predictable dark periods for intruders'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],

            // Environmental Controls - Item 16
            [
                'topic_id' => $topics['Environmental Controls'] ?? 11,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'What is the recommended temperature range for a data center to balance equipment reliability and energy efficiency?',
                'options' => [
                    '55-65°F (13-18°C)',
                    '65-75°F (18-24°C)',
                    '75-85°F (24-29°C)',
                    '85-95°F (29-35°C)'
                ],
                'correct_options' => ['65-75°F (18-24°C)'],
                'justifications' => [
                    'Too cold, wastes energy and may cause condensation',
                    'Correct - ASHRAE recommended range for optimal balance',
                    'Upper limit of acceptable range, may stress some equipment',
                    'Too hot, significantly increases equipment failure risk'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 1,
                'status' => 'published'
            ],

            // Environmental Controls - Item 17
            [
                'topic_id' => $topics['Environmental Controls'] ?? 11,
                'type_id' => 3,
                'dimension' => 'Managerial',
                'content' => 'Drag the environmental threats that HVAC systems help mitigate to the drop zone:',
                'options' => [
                    'Excessive humidity',
                    'Power surges',
                    'Airborne contaminants',
                    'Electromagnetic interference',
                    'Temperature fluctuations',
                    'Physical intrusion',
                    'Static electricity buildup',
                    'Network attacks'
                ],
                'correct_options' => [
                    'Excessive humidity',
                    'Airborne contaminants',
                    'Temperature fluctuations',
                    'Static electricity buildup'
                ],
                'justifications' => [
                    'HVAC controls humidity levels',
                    'Electrical issue, not HVAC-related',
                    'HVAC filters remove dust and particles',
                    'EMI requires different shielding',
                    'HVAC maintains stable temperatures',
                    'Physical security issue, not environmental',
                    'Proper humidity control reduces static',
                    'Cybersecurity issue, not environmental'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],

            // Fire Prevention, Detection & Suppression - Item 18
            [
                'topic_id' => $topics['Fire Prevention, Detection & Suppression'] ?? 12,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Which fire suppression system is MOST appropriate for a data center?',
                'options' => [
                    'Water-based sprinkler system',
                    'Clean agent gas system (FM-200)',
                    'Foam-based system',
                    'Dry powder system'
                ],
                'correct_options' => ['Clean agent gas system (FM-200)'],
                'justifications' => [
                    'Water damages electronic equipment',
                    'Correct - Clean agents suppress fire without damaging equipment',
                    'Foam can damage electronics and leave residue',
                    'Powder is corrosive to electronic components'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],

            // Fire Prevention, Detection & Suppression - Item 19
            [
                'topic_id' => $topics['Fire Prevention, Detection & Suppression'] ?? 12,
                'type_id' => 4,
                'dimension' => 'Managerial',
                'content' => 'Arrange these fire safety components in the order they typically activate during a fire event:',
                'options' => [
                    'Suppression system activation',
                    'Smoke detection',
                    'Fire alarm notification',
                    'HVAC shutdown',
                    'Pre-action system armed'
                ],
                'correct_options' => [
                    'Smoke detection',
                    'Fire alarm notification',
                    'HVAC shutdown',
                    'Pre-action system armed',
                    'Suppression system activation'
                ],
                'justifications' => ['Detection occurs first, triggering alarms, then HVAC shuts down to prevent smoke spread, pre-action systems arm to prepare for suppression, and finally suppression activates if the fire continues.'],
                'difficulty_level' => 3,
                'bloom_level' => 4,
                'status' => 'published'
            ],

            // Power Management & Redundancy - Item 20
            [
                'topic_id' => $topics['Power Management & Redundancy'] ?? 13,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'What is the primary purpose of an Uninterruptible Power Supply (UPS) in a data center?',
                'options' => [
                    'Provide long-term backup power during extended outages',
                    'Bridge power during the transition to generator power',
                    'Reduce electricity costs through load balancing',
                    'Protect against electromagnetic interference'
                ],
                'correct_options' => ['Bridge power during the transition to generator power'],
                'justifications' => [
                    'UPS batteries typically last minutes to hours, not long-term',
                    'Correct - UPS provides immediate power until generators start',
                    'UPS systems do not reduce costs, they ensure availability',
                    'EMI protection requires different equipment'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],

            // Power Management & Redundancy - Item 21
            [
                'topic_id' => $topics['Power Management & Redundancy'] ?? 13,
                'type_id' => 5,
                'dimension' => 'Managerial',
                'content' => 'Match each power redundancy component with its primary function:',
                'options' => [
                    'items' => [
                        'Automatic Transfer Switch (ATS)',
                        'Power Distribution Unit (PDU)',
                        'Generator',
                        'Surge protector'
                    ],
                    'responses' => [
                        'Long-term backup power',
                        'Switches between power sources',
                        'Distributes power to equipment',
                        'Protects against voltage spikes'
                    ]
                ],
                'correct_options' => [
                    'Automatic Transfer Switch (ATS)' => 'Switches between power sources',
                    'Power Distribution Unit (PDU)' => 'Distributes power to equipment',
                    'Generator' => 'Long-term backup power',
                    'Surge protector' => 'Protects against voltage spikes'
                ],
                'justifications' => [
                    'Automatic Transfer Switch (ATS)' => 'ATS automatically switches between utility and backup power',
                    'Power Distribution Unit (PDU)' => 'PDUs distribute power from source to multiple devices',
                    'Generator' => 'Generators provide extended backup power during outages',
                    'Surge protector' => 'Surge protectors prevent damage from power spikes'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 1,
                'status' => 'published'
            ],

            // Mixed Topics - Advanced Items

            // Human Safety & Emergency Procedures - Item 22
            [
                'topic_id' => $topics['Human Safety & Emergency Procedures'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'A security audit reveals that emergency exits are chained shut during business hours to prevent theft. What should be the immediate recommendation?',
                'options' => [
                    'Install CCTV cameras to monitor the exits',
                    'Replace chains with electromagnetic locks that release during emergencies',
                    'Assign security guards to monitor each exit',
                    'Keep the chains but provide keys to floor wardens'
                ],
                'correct_options' => ['Replace chains with electromagnetic locks that release during emergencies'],
                'justifications' => [
                    'Cameras do not solve the safety hazard',
                    'Correct - Electromagnetic locks provide security while ensuring safe egress',
                    'Guards are expensive and may not always be present',
                    'Keys may not be accessible during panic situations'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 5,
                'status' => 'published'
            ],

            // Crime Prevention Through Environmental Design (CPTED) - Item 23
            [
                'topic_id' => $topics['Crime Prevention Through Environmental Design (CPTED)'] ?? 2,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'A company wants to improve security in their parking garage using CPTED principles. Which combination of measures would be MOST effective?',
                'options' => [
                    'Dark tinted windows on stairwells and maximum height walls',
                    'Bright lighting, convex mirrors, and glass-enclosed stairwells',
                    'Reduced lighting to save energy and hidden cameras',
                    'Tall hedges around the perimeter and narrow walkways'
                ],
                'correct_options' => ['Bright lighting, convex mirrors, and glass-enclosed stairwells'],
                'justifications' => [
                    'Reduces visibility, violates natural surveillance',
                    'Correct - Maximizes visibility and natural surveillance throughout',
                    'Dark areas create hiding spots, hidden cameras do not deter',
                    'Tall hedges and narrow paths create ambush points'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 4,
                'status' => 'published'
            ],

            // Site Selection & Security Considerations - Item 24
            [
                'topic_id' => $topics['Site Selection & Security Considerations'] ?? 3,
                'type_id' => 2,
                'dimension' => 'Managerial',
                'content' => '**True or False:** The primary consideration for data center site selection should always be the lowest cost location available.',
                'options' => [
                    'True',
                    'False'
                ],
                'correct_options' => ['False'],
                'justifications' => [
                    'explanation' => 'While cost is important, site selection must prioritize multiple factors including natural disaster risks, proximity to emergency services, utility reliability, network connectivity, and security considerations. A cheap location prone to flooding or far from emergency services could result in much higher costs from downtime and damage.'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 5,
                'status' => 'published'
            ],

            // Perimeter Security Controls - Item 25
            [
                'topic_id' => $topics['Perimeter Security Controls'] ?? 4,
                'type_id' => 3,
                'dimension' => 'Managerial',
                'content' => 'Drag the perimeter controls that can effectively stop or slow vehicle-borne threats to the drop zone:',
                'options' => [
                    'Bollards',
                    'Chain-link fence',
                    'Jersey barriers',
                    'Security cameras',
                    'Hydraulic wedge barriers',
                    'Motion sensors',
                    'Decorative planters (reinforced)',
                    'Warning signs'
                ],
                'correct_options' => [
                    'Bollards',
                    'Jersey barriers',
                    'Hydraulic wedge barriers',
                    'Decorative planters (reinforced)'
                ],
                'justifications' => [
                    'Designed to stop vehicle impacts',
                    'Cannot stop vehicles',
                    'Concrete barriers effective against vehicles',
                    'Detect but do not stop vehicles',
                    'Specifically designed to stop vehicles',
                    'Detect but do not stop vehicles',
                    'When properly reinforced, can stop vehicles aesthetically',
                    'Provide warning but no physical barrier'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],

            // Physical Access Control Systems (PACS) - Item 26
            [
                'topic_id' => $topics['Physical Access Control Systems (PACS)'] ?? 6,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Which combination provides the strongest physical access control for a high-security area?',
                'options' => [
                    'Proximity card only',
                    'Proximity card + PIN',
                    'Proximity card + PIN + biometric',
                    'Biometric only'
                ],
                'correct_options' => ['Proximity card + PIN + biometric'],
                'justifications' => [
                    'Single factor authentication is weakest',
                    'Two-factor is better but not maximum security',
                    'Correct - Three factors (something you have, know, and are) provides maximum security',
                    'Single factor, and lacks backup if biometric fails'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 3,
                'status' => 'published'
            ],

            // Tailgating and Piggybacking Prevention - Item 27
            [
                'topic_id' => $topics['Tailgating and Piggybacking Prevention'] ?? 7,
                'type_id' => 2,
                'dimension' => 'Managerial',
                'content' => '**True or False:** Security awareness training alone is sufficient to prevent tailgating in high-security facilities.',
                'options' => [
                    'True',
                    'False'
                ],
                'correct_options' => ['False'],
                'justifications' => [
                    'explanation' => 'While security awareness training is important, it relies on human behavior which can be influenced by social engineering or simple politeness. High-security facilities require physical controls like mantraps, turnstiles, or security vestibules that physically prevent tailgating regardless of human factors.'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 4,
                'status' => 'published'
            ],

            // Security Guards & Visitor Management - Item 28
            [
                'topic_id' => $topics['Security Guards & Visitor Management'] ?? 8,
                'type_id' => 2,
                'dimension' => 'Managerial',
                'content' => '**True or False:** Security guards should always follow the same patrol routes and timing to ensure all areas are consistently covered.',
                'options' => [
                    'True',
                    'False'
                ],
                'correct_options' => ['False'],
                'justifications' => [
                    'explanation' => 'Security patrols should use randomized routes and timing to prevent potential intruders from learning patterns and exploiting predictable gaps in coverage. Predictable patrol schedules create vulnerabilities that can be observed and exploited. While all areas must be covered, the unpredictability of when and how they are patrolled is a key security principle.'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 2,
                'status' => 'published'
            ],

            // Surveillance Systems (CCTV) - Item 29
            [
                'topic_id' => $topics['Surveillance Systems (CCTV)'] ?? 9,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'How long should CCTV footage typically be retained for a standard commercial facility?',
                'options' => [
                    '24 hours',
                    '7-14 days',
                    '30-90 days',
                    '1 year minimum'
                ],
                'correct_options' => ['30-90 days'],
                'justifications' => [
                    'Too short to discover and investigate most incidents',
                    'May be insufficient for some investigations',
                    'Correct - Balances storage costs with investigation needs',
                    'Excessive for most facilities unless regulatory requirement'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 1,
                'status' => 'published'
            ],

            // Lighting & Deterrence Principles - Item 30
            [
                'topic_id' => $topics['Lighting & Deterrence Principles'] ?? 10,
                'type_id' => 3,
                'dimension' => 'Managerial',
                'content' => 'For effective security lighting design, drag the appropriate lighting types to their best use cases:',
                'options' => [
                    'Continuous lighting - Parking lots',
                    'Motion-activated - Building perimeters',
                    'Continuous lighting - Rarely used areas',
                    'Motion-activated - Storage areas',
                    'Emergency lighting - All areas',
                    'Glare lighting - Property boundaries',
                    'Motion-activated - Main walkways',
                    'Continuous lighting - Entry points'
                ],
                'correct_options' => [
                    'Continuous lighting - Parking lots',
                    'Motion-activated - Storage areas',
                    'Emergency lighting - All areas',
                    'Continuous lighting - Entry points'
                ],
                'justifications' => [
                    'Parking lots need constant illumination for safety',
                    'Building perimeters typically need continuous coverage',
                    'Wastes energy in rarely used areas',
                    'Motion activation appropriate for occasional access',
                    'Emergency lighting required throughout for evacuation',
                    'Glare lighting can blind legitimate users',
                    'Main walkways need continuous lighting for safety',
                    'Entry points require constant visibility'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3,
                'status' => 'published'
            ],

            // Environmental Controls - Item 31
            [
                'topic_id' => $topics['Environmental Controls'] ?? 11,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'What is the ideal relative humidity range for a data center environment?',
                'options' => [
                    '20-30%',
                    '40-60%',
                    '70-80%',
                    '80-90%'
                ],
                'correct_options' => ['40-60%'],
                'justifications' => [
                    'Too low - increases static electricity risk',
                    'Correct - Optimal range preventing both static and condensation',
                    'Too high - risk of condensation and corrosion',
                    'Excessive humidity causing equipment damage'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 1,
                'status' => 'published'
            ],

            // Fire Prevention, Detection & Suppression - Item 32
            [
                'topic_id' => $topics['Fire Prevention, Detection & Suppression'] ?? 12,
                'type_id' => 5,
                'dimension' => 'Managerial',
                'content' => 'Match each fire detection type with its primary detection method:',
                'options' => [
                    'items' => [
                        'Ionization detector',
                        'Photoelectric detector',
                        'Heat detector',
                        'VESDA system'
                    ],
                    'responses' => [
                        'Detects rapid temperature rise',
                        'Detects smoke particles via light beam',
                        'Detects combustion particles via radiation',
                        'Detects very early smoke via air sampling'
                    ]
                ],
                'correct_options' => [
                    'Ionization detector' => 'Detects combustion particles via radiation',
                    'Photoelectric detector' => 'Detects smoke particles via light beam',
                    'Heat detector' => 'Detects rapid temperature rise',
                    'VESDA system' => 'Detects very early smoke via air sampling'
                ],
                'justifications' => [
                    'Ionization detector' => 'Uses radioactive material to detect small particles',
                    'Photoelectric detector' => 'Light beam interrupted by smoke particles',
                    'Heat detector' => 'Triggers on temperature change, not smoke',
                    'VESDA system' => 'Very Early Smoke Detection Apparatus samples air continuously'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 1,
                'status' => 'published'
            ],

            // Power Management & Redundancy - Item 33
            [
                'topic_id' => $topics['Power Management & Redundancy'] ?? 13,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'What does "N+1 redundancy" mean in power system design?',
                'options' => [
                    'One backup system for the entire facility',
                    'The capacity to handle normal load plus one additional unit for redundancy',
                    'One hour of battery backup time',
                    'One generator for every critical system'
                ],
                'correct_options' => ['The capacity to handle normal load plus one additional unit for redundancy'],
                'justifications' => [
                    'N+1 refers to capacity, not just having one backup',
                    'Correct - N units for normal operation plus 1 for redundancy',
                    'N+1 refers to equipment quantity, not time',
                    'N+1 is about total capacity, not individual system backup'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],

            // Mixed Topics - Complex Scenarios

            // Comprehensive Physical Security - Item 34
            [
                'topic_id' => $topics['Physical Access Control Systems (PACS)'] ?? 6,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'A financial services company is designing security for their new headquarters. Which combination of controls provides defense in depth? (Select all that apply)',
                'options' => [
                    'Perimeter fence with CCTV coverage',
                    'Single entry point with no emergency exits',
                    'Mantrap at data center entrance',
                    'All-glass exterior walls for aesthetics',
                    'Visitor escort requirements',
                    'Security guards at reception',
                    'Parking garage beneath the building with open access',
                    'Badge readers on all interior doors'
                ],
                'correct_options' => [
                    'Perimeter fence with CCTV coverage',
                    'Mantrap at data center entrance',
                    'Visitor escort requirements',
                    'Security guards at reception',
                    'Badge readers on all interior doors'
                ],
                'justifications' => [
                    'Correct - Provides perimeter security layer',
                    'Violates safety requirements',
                    'Correct - Prevents tailgating to critical areas',
                    'Reduces physical security for aesthetics',
                    'Correct - Controls visitor movement',
                    'Correct - Human verification layer',
                    'Creates vulnerability for vehicle-borne threats',
                    'Correct - Controls internal movement'
                ],
                'settings' => ['isMultiSelect' => true],
                'difficulty_level' => 3,
                'bloom_level' => 5,
                'status' => 'published'
            ],

            // Environmental and Power Integration - Item 35
            [
                'topic_id' => $topics['Environmental Controls'] ?? 11,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'During a data center power failure, which sequence of events should occur to protect equipment?',
                'options' => [
                    'UPS activates → Generator starts → HVAC continues → Transfer to generator',
                    'Everything shuts down → Generator starts → Systems restart → HVAC restarts',
                    'Generator starts immediately → UPS as backup → Normal operations continue',
                    'HVAC shuts down → UPS activates → Non-critical systems shutdown → Generator starts'
                ],
                'correct_options' => ['UPS activates → Generator starts → HVAC continues → Transfer to generator'],
                'justifications' => [
                    'Correct - UPS provides immediate power while generator starts, HVAC must continue',
                    'Shutdown would cause data loss and equipment damage',
                    'Generators take time to start; UPS must activate first',
                    'HVAC must continue to prevent overheating'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 4,
                'status' => 'published'
            ],

            // Safety vs Security Balance - Item 36
            [
                'topic_id' => $topics['Human Safety & Emergency Procedures'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'A high-security facility wants to prevent unauthorized access while ensuring emergency egress. What is the BEST solution?',
                'options' => [
                    'Keep all doors locked at all times with no override',
                    'Install magnetic locks that fail-open during power loss or fire alarm',
                    'Use mechanical locks with keys distributed to security staff',
                    'Remove locks from emergency exits'
                ],
                'correct_options' => ['Install magnetic locks that fail-open during power loss or fire alarm'],
                'justifications' => [
                    'Prevents emergency egress, violates life safety codes',
                    'Correct - Provides security during normal operations but ensures safe egress',
                    'Keys may not be available during emergencies',
                    'Compromises security excessively'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 5,
                'status' => 'published'
            ],

            // CPTED and Surveillance Integration - Item 37
            [
                'topic_id' => $topics['Crime Prevention Through Environmental Design (CPTED)'] ?? 2,
                'type_id' => 3,
                'dimension' => 'Managerial',
                'content' => 'In designing a secure corporate campus using CPTED principles, drag the features that support natural surveillance to the drop zone:',
                'options' => [
                    'Low landscaping near walkways',
                    'Solid 8-foot walls',
                    'Large windows in stairwells',
                    'Underground tunnels between buildings',
                    'Open-design bike racks',
                    'Dense tree coverage',
                    'Transparent bus shelters',
                    'Enclosed dumpster areas'
                ],
                'correct_options' => [
                    'Low landscaping near walkways',
                    'Large windows in stairwells',
                    'Open-design bike racks',
                    'Transparent bus shelters'
                ],
                'justifications' => [
                    'Maintains clear sight lines',
                    'Blocks visibility',
                    'Allows observation of stairwell activity',
                    'Reduces visibility between buildings',
                    'Prevents hiding while maintaining function',
                    'Creates concealment opportunities',
                    'Maintains visibility while providing shelter',
                    'Creates hidden areas'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3,
                'status' => 'published'
            ],

            // Security Guards & Visitor Management - Item 38
            [
                'topic_id' => $topics['Security Guards & Visitor Management'] ?? 8,
                'type_id' => 4,
                'dimension' => 'Managerial',
                'content' => 'Your organization is implementing a new visitor management system. Arrange these implementation steps in the correct order:',
                'options' => [
                    'Train security guards and reception staff on new procedures',
                    'Define visitor categories and access requirements',
                    'Deploy visitor management software and badge printing system',
                    'Conduct risk assessment of current visitor processes',
                    'Test system with pilot group and gather feedback',
                    'Develop visitor security policies and procedures'
                ],
                'correct_options' => [
                    'Conduct risk assessment of current visitor processes',
                    'Define visitor categories and access requirements',
                    'Develop visitor security policies and procedures',
                    'Deploy visitor management software and badge printing system',
                    'Train security guards and reception staff on new procedures',
                    'Test system with pilot group and gather feedback'
                ],
                'justifications' => [
                    'explanation' => 'The correct order follows a logical implementation flow: First assess current risks and gaps, then define requirements based on findings, develop policies to address needs, deploy the technical solution, train staff on procedures, and finally test with a pilot group before full rollout. This ensures each step builds on the previous one for successful implementation.'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 4,
                'status' => 'published'
            ],

            // Fire Suppression and Environmental Controls - Item 39
            [
                'topic_id' => $topics['Fire Prevention, Detection & Suppression'] ?? 12,
                'type_id' => 2,
                'dimension' => 'Managerial',
                'content' => '**True or False:** In a data center, water-based sprinkler systems should never be used under any circumstances.',
                'options' => [
                    'True',
                    'False'
                ],
                'correct_options' => ['False'],
                'justifications' => [
                    'explanation' => 'While clean agent systems are preferred for data centers, pre-action water sprinkler systems can be appropriate as a last resort or in specific areas. Pre-action systems require both detection and sprinkler activation, reducing false discharge risk. They may be required by code and can be used with proper planning for equipment protection.'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 4,
                'status' => 'published'
            ],

            // Comprehensive Power Redundancy - Item 40
            [
                'topic_id' => $topics['Power Management & Redundancy'] ?? 13,
                'type_id' => 4,
                'dimension' => 'Managerial',
                'content' => 'Arrange these power redundancy strategies from LEAST to MOST resilient:',
                'options' => [
                    'Single utility feed with UPS',
                    'Dual utility feeds from different substations',
                    'Single utility feed only',
                    'Dual feeds + UPS + N+1 generators',
                    'Single feed + generator backup'
                ],
                'correct_options' => [
                    'Single utility feed only',
                    'Single utility feed with UPS',
                    'Single feed + generator backup',
                    'Dual utility feeds from different substations',
                    'Dual feeds + UPS + N+1 generators'
                ],
                'justifications' => ['Progression from no redundancy, to battery backup, to generator backup, to redundant utility sources, and finally to full redundancy with multiple utility feeds, UPS, and redundant generators providing maximum resilience.'],
                'difficulty_level' => 3,
                'bloom_level' => 5,
                'status' => 'published'
            ],

            // Physical Security Metrics - Item 41
            [
                'topic_id' => $topics['Surveillance Systems (CCTV)'] ?? 9,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Which metrics are most useful for evaluating physical security effectiveness? (Select all that apply)',
                'options' => [
                    'Number of tailgating incidents detected',
                    'Average response time to alarms',
                    'Percentage of cameras operational',
                    'Number of security guards on duty',
                    'Time to issue visitor badges',
                    'False alarm rate',
                    'Number of doors in facility',
                    'Security training completion rate'
                ],
                'correct_options' => [
                    'Number of tailgating incidents detected',
                    'Average response time to alarms',
                    'Percentage of cameras operational',
                    'False alarm rate',
                    'Security training completion rate'
                ],
                'justifications' => [
                    'Correct - Indicates access control effectiveness',
                    'Correct - Critical for incident response',
                    'Correct - System availability metric',
                    'Quantity alone does not indicate effectiveness',
                    'Efficiency metric, not security effectiveness',
                    'Correct - High false alarms reduce response effectiveness',
                    'Facility characteristic, not effectiveness measure',
                    'Correct - Indicates security awareness level'
                ],
                'settings' => ['isMultiSelect' => true],
                'difficulty_level' => 3,
                'bloom_level' => 5,
                'status' => 'published'
            ],

            // Integrated Physical Security Design - Item 42
            [
                'topic_id' => $topics['Facility Layout & Security Zones'] ?? 5,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'When designing security zones in a facility, which principle should guide the layout?',
                'options' => [
                    'Place the most valuable assets nearest to the entrance for quick access',
                    'Create concentric layers with increasing security toward critical assets',
                    'Randomly distribute critical assets to confuse potential intruders',
                    'Concentrate all critical assets in one highly secure area'
                ],
                'correct_options' => ['Create concentric layers with increasing security toward critical assets'],
                'justifications' => [
                    'Violates defense in depth principles',
                    'Correct - Progressive security layers provide multiple barriers',
                    'Random distribution complicates legitimate access and emergency response',
                    'Single point of failure if that area is compromised'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],

            // Environmental Monitoring - Item 43
            [
                'topic_id' => $topics['Environmental Controls'] ?? 11,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Which environmental conditions should be continuously monitored in a data center? (Select all that apply)',
                'options' => [
                    'Temperature',
                    'Humidity',
                    'Airflow',
                    'Smoke/fire',
                    'Water/flooding',
                    'Sound levels',
                    'Light levels',
                    'Power quality'
                ],
                'correct_options' => [
                    'Temperature',
                    'Humidity',
                    'Airflow',
                    'Smoke/fire',
                    'Water/flooding',
                    'Power quality'
                ],
                'justifications' => [
                    'Correct - Critical for equipment operation',
                    'Correct - Prevents condensation and static',
                    'Correct - Ensures proper cooling',
                    'Correct - Early fire detection',
                    'Correct - Prevents water damage',
                    'Not critical for equipment operation',
                    'Not critical for equipment operation',
                    'Correct - Voltage fluctuations can damage equipment'
                ],
                'settings' => ['isMultiSelect' => true],
                'difficulty_level' => 2,
                'bloom_level' => 1,
                'status' => 'published'
            ],

            // Physical Access Control Systems (PACS) - Item 44 (Level 2)
            [
                'topic_id' => $topics['Physical Access Control Systems (PACS)'] ?? 6,
                'type_id' => 2,
                'dimension' => 'Managerial',
                'content' => '**True or False:** Anti-passback features in access control systems prevent individuals from lending their credentials to others.',
                'options' => [
                    'True',
                    'False'
                ],
                'correct_options' => ['False'],
                'justifications' => [
                    'explanation' => 'Anti-passback prevents someone from using their credential multiple times without properly exiting the area first. It does not prevent credential sharing - someone can still hand their card to another person to use. Anti-passback detects when someone enters an area without first properly exiting it, preventing people from "passing back" their credentials through doors or windows.'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],

            // Perimeter Security Controls - Item 45 (Level 2)
            [
                'topic_id' => $topics['Perimeter Security Controls'] ?? 4,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'What is the primary purpose of standoff distance in perimeter security design?',
                'options' => [
                    'To provide space for landscaping and aesthetics',
                    'To reduce the blast effect of vehicle-borne explosive devices',
                    'To create parking areas for employees',
                    'To allow room for emergency vehicle access'
                ],
                'correct_options' => ['To reduce the blast effect of vehicle-borne explosive devices'],
                'justifications' => [
                    'Landscaping is a secondary benefit, not the primary purpose',
                    'Correct - Standoff distance reduces blast damage by increasing distance from potential vehicle bombs',
                    'Parking placement is not the primary security purpose',
                    'Emergency access is important but not the primary purpose of standoff distance'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],

            // Lighting & Deterrence Principles - Item 46 (Level 3)
            [
                'topic_id' => $topics['Lighting & Deterrence Principles'] ?? 10,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'A security assessment reveals blind spots in CCTV coverage near the loading dock. Which lighting strategy would best address this vulnerability?',
                'options' => [
                    'Install high-intensity flood lights throughout the area',
                    'Add infrared illuminators for night vision cameras',
                    'Install motion-activated strobe lights',
                    'Use colored lighting to mark the security zone'
                ],
                'correct_options' => ['Add infrared illuminators for night vision cameras'],
                'justifications' => [
                    'Flood lights may create glare and harsh shadows, potentially making some areas darker',
                    'Correct - IR illuminators enhance camera visibility in blind spots without visible light pollution',
                    'Strobe lights disorient but do not improve continuous surveillance',
                    'Colored lighting does not improve visibility for security purposes'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],

            // Fire Prevention, Detection & Suppression - Item 47 (Level 3)
            [
                'topic_id' => $topics['Fire Prevention, Detection & Suppression'] ?? 12,
                'type_id' => 3,
                'dimension' => 'Managerial',
                'content' => 'A data center is implementing a pre-action fire suppression system. Drag the correct sequence of events that must occur before water is released:',
                'options' => [
                    'Manual fire alarm activation',
                    'Smoke detector activation',
                    'Heat detector confirmation',
                    'Sprinkler head thermal activation',
                    'Water flows immediately',
                    'System supervisor override',
                    'Pneumatic pressure loss in pipes',
                    'Automatic valve opens'
                ],
                'correct_options' => [
                    'Smoke detector activation',
                    'Heat detector confirmation',
                    'Pneumatic pressure loss in pipes',
                    'Sprinkler head thermal activation'
                ],
                'justifications' => [
                    'Not required for automatic pre-action system operation',
                    'First detection event required',
                    'Second confirmation detection required',
                    'Final step - individual sprinkler activates',
                    'Pre-action systems require two events, not immediate flow',
                    'Not part of automatic sequence',
                    'Occurs when sprinkler head activates',
                    'Occurs automatically after confirmations'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3,
                'status' => 'published'
            ],

            // Site Selection & Security Considerations - Item 48 (Level 3)
            [
                'topic_id' => $topics['Site Selection & Security Considerations'] ?? 3,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'When evaluating a potential data center location, you discover it is 2 miles from a major airport. What security considerations does this present?',
                'options' => [
                    'Aircraft noise may interfere with alarm systems',
                    'Flight restrictions may limit helicopter emergency access',
                    'Potential aircraft impact risk and flight path restrictions',
                    'Airport security may conflict with facility access'
                ],
                'correct_options' => ['Potential aircraft impact risk and flight path restrictions'],
                'justifications' => [
                    'Modern alarm systems are not typically affected by aircraft noise',
                    'Helicopter access is rarely restricted near airports for emergency services',
                    'Correct - Aircraft pose direct impact risk and may restrict building height/equipment',
                    'Airport security operates independently of private facility security'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3,
                'status' => 'published'
            ],

            // Security Guards & Visitor Management - Item 49 (Level 4)
            [
                'topic_id' => $topics['Security Guards & Visitor Management'] ?? 8,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Your facility experiences a significant increase in tailgating incidents despite having security guards at entry points. What factors should you analyze to address this issue? (Select all that apply)',
                'options' => [
                    'Guard positioning and sight lines to entry points',
                    'Guard training on tailgating recognition',
                    'Peak traffic times and guard staffing levels',
                    'Employee attitudes toward security procedures',
                    'Door closure timing and entry point design',
                    'Guard shift schedules and fatigue levels',
                    'Cost of implementing mantrap systems',
                    'Visitor badge color coding system'
                ],
                'correct_options' => [
                    'Guard positioning and sight lines to entry points',
                    'Guard training on tailgating recognition',
                    'Peak traffic times and guard staffing levels',
                    'Employee attitudes toward security procedures',
                    'Door closure timing and entry point design',
                    'Guard shift schedules and fatigue levels'
                ],
                'justifications' => [
                    'Correct - Poor positioning may prevent guards from seeing tailgating',
                    'Correct - Guards need specific training to identify tailgating behaviors',
                    'Correct - Understaffing during peak times creates vulnerabilities',
                    'Correct - Employee resistance undermines security effectiveness',
                    'Correct - Physical design affects tailgating opportunities',
                    'Correct - Fatigue reduces guard vigilance and effectiveness',
                    'Cost analysis is not part of incident root cause analysis',
                    'Badge colors do not prevent tailgating incidents'
                ],
                'settings' => ['isMultiSelect' => true],
                'difficulty_level' => 3,
                'bloom_level' => 4,
                'status' => 'published'
            ],

            // Comprehensive Physical Security Assessment - Item 50 (Level 5)
            [
                'topic_id' => $topics['Facility Layout & Security Zones'] ?? 5,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'You are conducting a comprehensive physical security assessment for a critical infrastructure facility. Which assessment methodology would provide the most reliable evaluation of overall security effectiveness?',
                'options' => [
                    'Review all security policies and procedures documentation',
                    'Conduct penetration testing of all electronic access controls',
                    'Perform a combination of document review, physical testing, and red team exercises',
                    'Interview security personnel and observe daily operations'
                ],
                'correct_options' => ['Perform a combination of document review, physical testing, and red team exercises'],
                'justifications' => [
                    'Documentation review alone does not test implementation effectiveness',
                    'Electronic testing alone misses human factors and physical vulnerabilities',
                    'Correct - Multi-faceted approach tests policies, systems, and human responses comprehensively',
                    'Interviews and observation provide limited testing of actual security response'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 5,
                'status' => 'published'
            ]
        ];
        
        // Insert all items
        foreach ($items as $item) {
            DiagnosticItem::create($item);
        }
        
        $this->command->info('Domain 17 (Physical & Environmental Security) diagnostic items seeded successfully!');
    }
}