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
            // Physical Access Control - Physical Barriers (10 items)
            [
                'topic_id' => $topics['Physical Access Control'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'What is the primary purpose of bollards in perimeter security?',
                'options' => [
                    'Provide lighting for walkways',
                    'Prevent vehicle-borne attacks',
                    'Support security cameras',
                    'Mark property boundaries'
                ],
                'correct_options' => ['Prevent vehicle-borne attacks'],
                'justifications' => [
                    'Bollards don\'t typically provide lighting',
                    'Correct - Bollards are designed to stop or slow vehicles',
                    'Camera mounting is not the primary purpose',
                    'Boundary marking is secondary to vehicle protection'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Physical Access Control'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Which physical barrier provides the strongest deterrent against unauthorized vehicle access?',
                'options' => [
                    'Chain-link fence',
                    'Concrete jersey barriers',
                    'Decorative hedges',
                    'Warning signs'
                ],
                'correct_options' => ['Concrete jersey barriers'],
                'justifications' => [
                    'Chain-link fences can be cut and don\'t stop vehicles',
                    'Correct - Concrete barriers physically stop vehicle impacts',
                    'Hedges provide minimal physical resistance',
                    'Signs provide warning but no physical barrier'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Physical Access Control'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'What is the primary advantage of a mantrap over standard door access?',
                'options' => [
                    'Faster employee throughput',
                    'Lower installation costs',
                    'Prevents tailgating completely',
                    'Requires no maintenance'
                ],
                'correct_options' => ['Prevents tailgating completely'],
                'justifications' => [
                    'Mantraps actually slow throughput by design',
                    'Mantraps are more expensive than standard doors',
                    'Correct - Only one person can pass through at a time',
                    'Mantraps require more maintenance than standard doors'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Physical Access Control'] ?? 1,
                'type_id' => 5,
                'dimension' => 'Managerial',
                'content' => 'Match each physical barrier with its primary security function:',
                'options' => [
                    'items' => [
                        'Chain-link fence',
                        'Turnstiles',
                        'Walls',
                        'Gates'
                    ],
                    'responses' => [
                        'Perimeter boundary definition',
                        'Controlled pedestrian access',
                        'Solid visual barrier',
                        'Authorized vehicle entry'
                    ]
                ],
                'correct_options' => [
                    'Chain-link fence' => 'Perimeter boundary definition',
                    'Turnstiles' => 'Controlled pedestrian access',
                    'Walls' => 'Solid visual barrier',
                    'Gates' => 'Authorized vehicle entry'
                ],
                'justifications' => [
                    'Chain-link fence' => 'Defines property boundaries and deters casual intrusion',
                    'Turnstiles' => 'Allow one-person-at-a-time pedestrian access control',
                    'Walls' => 'Provide privacy and block sight lines',
                    'Gates' => 'Control vehicle access while allowing authorized entry'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Physical Access Control'] ?? 1,
                'type_id' => 2,
                'dimension' => 'Managerial',
                'content' => '**True or False:** Physical barriers should be designed to completely prevent all unauthorized access.',
                'options' => [
                    'True',
                    'False'
                ],
                'correct_options' => ['False'],
                'justifications' => [
                    'explanation' => 'Physical barriers are designed to delay, deter, and detect intrusion attempts, not completely prevent them. A determined attacker with enough time and resources can eventually overcome any physical barrier. The goal is to create enough delay for detection and response systems to be effective.'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Physical Access Control'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'What is the primary security responsibility of security guards at entry points?',
                'options' => [
                    'Check employee productivity levels',
                    'Verify credentials and control access',
                    'Provide customer service information',
                    'Monitor social media activity'
                ],
                'correct_options' => ['Verify credentials and control access'],
                'justifications' => [
                    'Productivity monitoring is not a security function',
                    'Correct - Guards verify authorization and control facility access',
                    'Customer service is secondary to security functions',
                    'Social media monitoring is typically a cybersecurity function'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Physical Access Control'] ?? 1,
                'type_id' => 3,
                'dimension' => 'Managerial',
                'content' => 'Drag essential security guard responsibilities to the drop zone:',
                'options' => [
                    'Patrol designated areas',
                    'Approve employee vacations',
                    'Verify visitor identification',
                    'Conduct performance reviews',
                    'Respond to security alarms',
                    'Process payroll',
                    'Maintain activity logs',
                    'Schedule meetings'
                ],
                'correct_options' => ['Patrol designated areas', 'Verify visitor identification', 'Respond to security alarms', 'Maintain activity logs'],
                'justifications' => [
                    'Essential security function for area monitoring',
                    'HR function, not security responsibility',
                    'Critical access control function',
                    'Management function, not security duty',
                    'Primary emergency response responsibility',
                    'Administrative function, not security related',
                    'Required for security accountability and incident tracking',
                    'Administrative function, not security related'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Physical Access Control'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Why should security guard patrols follow randomized routes and timing?',
                'options' => [
                    'To ensure all guards get equal exercise',
                    'To prevent predictable patterns that can be exploited',
                    'To reduce guard boredom during shifts',
                    'To comply with labor regulations'
                ],
                'correct_options' => ['To prevent predictable patterns that can be exploited'],
                'justifications' => [
                    'Exercise is not a security consideration',
                    'Correct - Predictable patterns allow intruders to time their activities',
                    'While reducing boredom is beneficial, security effectiveness is primary',
                    'Randomization is not a labor law requirement'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Physical Access Control'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Which combination provides the strongest multi-factor physical access control?',
                'options' => [
                    'Card reader only',
                    'Card reader + PIN code',
                    'Card reader + PIN + biometric scanner',
                    'Biometric scanner only'
                ],
                'correct_options' => ['Card reader + PIN + biometric scanner'],
                'justifications' => [
                    'Single factor is weakest authentication',
                    'Two factors are better but not maximum security',
                    'Correct - Three factors (have, know, are) provide strongest authentication',
                    'Single factor with no backup if biometric fails'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Physical Access Control'] ?? 1,
                'type_id' => 4,
                'dimension' => 'Managerial',
                'content' => 'Arrange these perimeter security layers from outermost to innermost:',
                'options' => [
                    'Building entrance',
                    'Property fence',
                    'Parking barriers',
                    'Reception desk',
                    'Landscaping'
                ],
                'correct_options' => [
                    'Landscaping',
                    'Property fence',
                    'Parking barriers',
                    'Building entrance',
                    'Reception desk'
                ],
                'justifications' => ['Defense in depth starts with natural barriers (landscaping), then property boundary (fence), vehicle control (parking barriers), facility access (building entrance), and finally internal checkpoint (reception desk).'],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],

            // Fire Protection - Prevention, Detection, Suppression (10 items)
            [
                'topic_id' => $topics['Fire'] ?? 2,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Which fire-resistant material property is most important for data center construction?',
                'options' => [
                    'Low cost and easy installation',
                    'Attractive appearance',
                    'High fire rating and low smoke production',
                    'Sound dampening qualities'
                ],
                'correct_options' => ['High fire rating and low smoke production'],
                'justifications' => [
                    'Cost is secondary to fire safety requirements',
                    'Appearance is not a safety consideration',
                    'Correct - Fire rating prevents spread, low smoke protects occupants and equipment',
                    'Sound dampening is not a fire safety requirement'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Fire'] ?? 2,
                'type_id' => 5,
                'dimension' => 'Managerial',
                'content' => 'Match each fire detection method with what it primarily detects:',
                'options' => [
                    'items' => [
                        'Heat detectors',
                        'Smoke detectors (photoelectric)',
                        'Smoke detectors (ionization)',
                        'Flame detectors'
                    ],
                    'responses' => [
                        'Temperature rise',
                        'Visible smoke particles',
                        'Combustion particles',
                        'Infrared/ultraviolet radiation'
                    ]
                ],
                'correct_options' => [
                    'Heat detectors' => 'Temperature rise',
                    'Smoke detectors (photoelectric)' => 'Visible smoke particles',
                    'Smoke detectors (ionization)' => 'Combustion particles',
                    'Flame detectors' => 'Infrared/ultraviolet radiation'
                ],
                'justifications' => [
                    'Heat detectors' => 'Respond to rapid temperature increase or fixed temperature',
                    'Smoke detectors (photoelectric)' => 'Light beam detects smoke particles',
                    'Smoke detectors (ionization)' => 'Radioactive source detects ion changes from combustion',
                    'Flame detectors' => 'Detect specific wavelengths emitted by flames'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Fire'] ?? 2,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Which type of fire detector provides the earliest warning in most situations?',
                'options' => [
                    'Heat detectors',
                    'Smoke detectors',
                    'Flame detectors',
                    'Carbon monoxide detectors'
                ],
                'correct_options' => ['Smoke detectors'],
                'justifications' => [
                    'Heat detectors respond after significant temperature rise',
                    'Correct - Smoke is usually produced before significant heat or visible flames',
                    'Flame detectors require visible fire to be present',
                    'CO detectors are for gas detection, not general fire detection'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Fire'] ?? 2,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'What is the most appropriate fire suppression system for a data center?',
                'options' => [
                    'Water sprinkler system',
                    'Clean agent gas system',
                    'Foam suppression system',
                    'Dry powder system'
                ],
                'correct_options' => ['Clean agent gas system'],
                'justifications' => [
                    'Water damages electronic equipment',
                    'Correct - Clean agents suppress fire without damaging equipment',
                    'Foam can damage electronics and leave residue',
                    'Powder is corrosive and damages electronic components'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Fire'] ?? 2,
                'type_id' => 3,
                'dimension' => 'Managerial',
                'content' => 'Drag appropriate fire suppression agents for different fire types:',
                'options' => [
                    'Water - Class A fires',
                    'CO2 - Class B fires',
                    'Water - Electrical fires',
                    'Foam - Class C fires',
                    'Clean agent - Electronic equipment',
                    'Powder - Class D fires'
                ],
                'correct_options' => ['Water - Class A fires', 'CO2 - Class B fires', 'Clean agent - Electronic equipment', 'Powder - Class D fires'],
                'justifications' => [
                    'Water effective for ordinary combustibles',
                    'CO2 displaces oxygen for flammable liquids',
                    'Water conducts electricity - dangerous for electrical fires',
                    'Foam not appropriate for electrical (Class C) fires',
                    'Clean agents safe for sensitive electronic equipment',
                    'Special powder needed for metal fires'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Fire'] ?? 2,
                'type_id' => 4,
                'dimension' => 'Managerial',
                'content' => 'Arrange the fire suppression system activation sequence in correct order:',
                'options' => [
                    'Suppression agent release',
                    'Fire detection',
                    'Alarm notification',
                    'HVAC shutdown',
                    'Pre-discharge delay'
                ],
                'correct_options' => [
                    'Fire detection',
                    'Alarm notification',
                    'HVAC shutdown',
                    'Pre-discharge delay',
                    'Suppression agent release'
                ],
                'justifications' => ['Detection triggers the sequence, followed by alarm notification, HVAC shutdown to prevent smoke spread, pre-discharge delay for evacuation, and finally agent release.'],
                'difficulty_level' => 3,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Fire'] ?? 2,
                'type_id' => 2,
                'dimension' => 'Managerial',
                'content' => '**True or False:** Pre-action fire suppression systems release water immediately when smoke is detected.',
                'options' => [
                    'True',
                    'False'
                ],
                'correct_options' => ['False'],
                'justifications' => [
                    'explanation' => 'Pre-action systems require two separate events before water is released: first a detection system activation (smoke/heat), and second, individual sprinkler head activation. This prevents accidental water discharge from single-point failures and is especially important in areas with sensitive equipment.'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Fire'] ?? 2,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'What is the primary purpose of fire-retardant materials in construction?',
                'options' => [
                    'Completely prevent fires from starting',
                    'Slow fire spread and reduce flame propagation',
                    'Make materials completely fireproof',
                    'Reduce construction costs'
                ],
                'correct_options' => ['Slow fire spread and reduce flame propagation'],
                'justifications' => [
                    'No material can completely prevent fires',
                    'Correct - Fire-retardant materials slow combustion and limit fire spread',
                    'No material is completely fireproof under all conditions',
                    'Fire-retardant materials typically increase costs'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Fire'] ?? 2,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Which fire detection system provides the earliest possible warning?',
                'options' => [
                    'Standard smoke detectors',
                    'Heat detectors',
                    'VESDA (Very Early Smoke Detection Apparatus)',
                    'Flame detectors'
                ],
                'correct_options' => ['VESDA (Very Early Smoke Detection Apparatus)'],
                'justifications' => [
                    'Standard detectors wait for smoke to reach the detector',
                    'Heat detection is slower than smoke detection',
                    'Correct - VESDA actively samples air and detects trace amounts of smoke',
                    'Flame detection requires visible fire'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Fire'] ?? 2,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'During a fire emergency in a secure facility, what takes absolute priority?',
                'options' => [
                    'Protecting classified documents',
                    'Securing valuable equipment',
                    'Ensuring human safety and evacuation',
                    'Shutting down computer systems properly'
                ],
                'correct_options' => ['Ensuring human safety and evacuation'],
                'justifications' => [
                    'Documents can be replaced or recovered',
                    'Equipment can be replaced',
                    'Correct - Human life always takes absolute priority over all other concerns',
                    'System shutdown is important but secondary to life safety'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 1,
                'status' => 'published'
            ],

            // Power Systems - Anomalies & Protection (10 items)
            [
                'topic_id' => $topics['Power'] ?? 3,
                'type_id' => 5,
                'dimension' => 'Managerial',
                'content' => 'Match each power anomaly with its description:',
                'options' => [
                    'items' => [
                        'Surge/Spike',
                        'Brownout/Sag',
                        'Blackout/Fault',
                        'Inrush'
                    ],
                    'responses' => [
                        'Complete loss of power',
                        'Temporary high voltage',
                        'Sustained low voltage',
                        'Initial high current draw'
                    ]
                ],
                'correct_options' => [
                    'Surge/Spike' => 'Temporary high voltage',
                    'Brownout/Sag' => 'Sustained low voltage',
                    'Blackout/Fault' => 'Complete loss of power',
                    'Inrush' => 'Initial high current draw'
                ],
                'justifications' => [
                    'Surge/Spike' => 'Brief voltage increase above normal levels',
                    'Brownout/Sag' => 'Voltage drops below normal operating levels',
                    'Blackout/Fault' => 'Total loss of electrical power supply',
                    'Inrush' => 'High current when equipment first starts up'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Power'] ?? 3,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Which power protection device is most effective against voltage surges?',
                'options' => [
                    'UPS (Uninterruptible Power Supply)',
                    'Generator',
                    'Surge protector',
                    'Power strip'
                ],
                'correct_options' => ['Surge protector'],
                'justifications' => [
                    'UPS provides backup power but may not handle all surges',
                    'Generators provide backup power, not surge protection',
                    'Correct - Surge protectors are specifically designed to block voltage spikes',
                    'Basic power strips provide no surge protection'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Power'] ?? 3,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'What is the primary purpose of a UPS in a data center?',
                'options' => [
                    'Provide long-term power during extended outages',
                    'Bridge power during generator startup',
                    'Reduce electricity costs',
                    'Improve power quality'
                ],
                'correct_options' => ['Bridge power during generator startup'],
                'justifications' => [
                    'UPS batteries typically last minutes to hours, not long-term',
                    'Correct - UPS provides immediate power while generators start up',
                    'UPS systems increase costs, don\'t reduce them',
                    'While UPS may improve power quality, the primary purpose is backup power'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Power'] ?? 3,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'What does "N+1 redundancy" mean in power system design?',
                'options' => [
                    'One backup system for the entire facility',
                    'Normal capacity plus one additional unit for redundancy',
                    'One generator for every UPS unit',
                    'One hour of battery backup'
                ],
                'correct_options' => ['Normal capacity plus one additional unit for redundancy'],
                'justifications' => [
                    'N+1 refers to capacity redundancy, not just having one backup',
                    'Correct - N units handle normal load, +1 provides redundancy if any unit fails',
                    'N+1 applies to total system capacity, not one-to-one ratios',
                    'N+1 refers to equipment redundancy, not time duration'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Power'] ?? 3,
                'type_id' => 3,
                'dimension' => 'Managerial',
                'content' => 'Drag the power protection systems that address specific power problems:',
                'options' => [
                    'Surge protector - Voltage spikes',
                    'UPS - Power outages',
                    'Generator - Extended outages',
                    'Voltage regulator - Brownouts',
                    'Surge protector - Blackouts',
                    'UPS - Voltage regulation',
                    'Generator - Surge protection',
                    'Line conditioner - Power quality'
                ],
                'correct_options' => ['Surge protector - Voltage spikes', 'UPS - Power outages', 'Generator - Extended outages', 'Voltage regulator - Brownouts', 'Line conditioner - Power quality'],
                'justifications' => [
                    'Surge protectors designed for voltage spikes',
                    'UPS provides immediate backup during outages',
                    'Generators provide long-term backup power',
                    'Voltage regulators maintain steady voltage levels',
                    'Surge protectors don\'t address power loss',
                    'UPS primary function is backup power, not voltage regulation',
                    'Generators don\'t provide surge protection',
                    'Line conditioners filter and clean power'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Power'] ?? 3,
                'type_id' => 4,
                'dimension' => 'Managerial',
                'content' => 'Arrange these power systems from least to most resilient:',
                'options' => [
                    'Single utility feed + UPS',
                    'Dual utility feeds + UPS + generators',
                    'Single utility feed only',
                    'Single feed + generator',
                    'Dual utility feeds only'
                ],
                'correct_options' => [
                    'Single utility feed only',
                    'Single utility feed + UPS',
                    'Single feed + generator',
                    'Dual utility feeds only',
                    'Dual utility feeds + UPS + generators'
                ],
                'justifications' => ['Progression from no backup (least resilient) to battery backup, generator backup, redundant utility feeds, and finally full redundancy with multiple feeds, UPS, and generators (most resilient).'],
                'difficulty_level' => 3,
                'bloom_level' => 5,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Power'] ?? 3,
                'type_id' => 2,
                'dimension' => 'Managerial',
                'content' => '**True or False:** Brownouts are more damaging to computer equipment than complete power outages.',
                'options' => [
                    'True',
                    'False'
                ],
                'correct_options' => ['True'],
                'justifications' => [
                    'explanation' => 'Brownouts (sustained low voltage) can be more damaging than blackouts because equipment may continue to operate under insufficient voltage, causing components to overheat and fail. During blackouts, equipment simply shuts down cleanly or switches to backup power. Brownouts can cause gradual component degradation and premature failure.'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Power'] ?? 3,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'What is the primary function of an Automatic Transfer Switch (ATS)?',
                'options' => [
                    'Convert AC power to DC power',
                    'Regulate voltage levels',
                    'Switch between power sources automatically',
                    'Protect against power surges'
                ],
                'correct_options' => ['Switch between power sources automatically'],
                'justifications' => [
                    'Power conversion is done by different equipment',
                    'Voltage regulation is a separate function',
                    'Correct - ATS automatically switches from utility to backup power',
                    'Surge protection is handled by surge protectors'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Power'] ?? 3,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Which alternate power source provides the fastest response time during a power outage?',
                'options' => [
                    'Diesel generator',
                    'UPS battery system',
                    'Solar panels',
                    'Fuel cells'
                ],
                'correct_options' => ['UPS battery system'],
                'justifications' => [
                    'Generators take seconds to minutes to start',
                    'Correct - UPS provides instantaneous power switching',
                    'Solar panels depend on sunlight and weather',
                    'Fuel cells take time to reach full output'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Power'] ?? 3,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'During a data center power failure, what sequence should occur to protect equipment?',
                'options' => [
                    'Everything shuts down immediately',
                    'UPS activates → Generator starts → Transfer to generator power',
                    'Generator starts → UPS activates → Normal operations',
                    'HVAC shuts down → All systems restart'
                ],
                'correct_options' => ['UPS activates → Generator starts → Transfer to generator power'],
                'justifications' => [
                    'Immediate shutdown causes data loss and service interruption',
                    'Correct - UPS provides immediate power while generator starts, then transfer occurs',
                    'Generators take time to start; UPS must provide immediate power',
                    'HVAC should continue operating to prevent equipment overheating'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],

            // Site Design - Selection, CPTED, Layout (10 items)
            [
                'topic_id' => $topics['Site Design'] ?? 4,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Which factors are most critical when selecting a site for a data center? (Select all that apply)',
                'options' => [
                    'Proximity to flood zones',
                    'Available parking spaces',
                    'Seismic activity history',
                    'Distance from emergency services',
                    'Local crime statistics',
                    'Proximity to chemical plants'
                ],
                'correct_options' => [
                    'Proximity to flood zones',
                    'Seismic activity history',
                    'Distance from emergency services',
                    'Local crime statistics',
                    'Proximity to chemical plants'
                ],
                'justifications' => [
                    'Correct - Flood risk affects facility availability and equipment',
                    'Convenient but not critical for security',
                    'Correct - Earthquake risk affects structural integrity',
                    'Correct - Emergency response time is critical for incidents',
                    'Correct - Crime rates affect physical security requirements',
                    'Correct - Chemical accidents pose environmental contamination risks'
                ],
                'settings' => ['isMultiSelect' => true],
                'difficulty_level' => 2,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Site Design'] ?? 4,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'What is the primary CPTED principle demonstrated by using low hedges and transparent fencing?',
                'options' => [
                    'Natural access control',
                    'Natural surveillance',
                    'Territorial reinforcement',
                    'Target hardening'
                ],
                'correct_options' => ['Natural surveillance'],
                'justifications' => [
                    'Access control relates to directing movement, not visibility',
                    'Correct - Low hedges and transparent barriers allow clear sight lines for observation',
                    'Territorial reinforcement shows ownership but doesn\'t improve visibility',
                    'Target hardening involves physical barriers, not visibility design'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Site Design'] ?? 4,
                'type_id' => 5,
                'dimension' => 'Managerial',
                'content' => 'Match each CPTED principle with its implementation example:',
                'options' => [
                    'items' => [
                        'Natural surveillance',
                        'Natural access control',
                        'Territorial reinforcement',
                        'Target hardening'
                    ],
                    'responses' => [
                        'Company logos and maintained landscaping',
                        'Clear sight lines and proper lighting',
                        'Single entry point with reception desk',
                        'Security cameras and alarm systems'
                    ]
                ],
                'correct_options' => [
                    'Natural surveillance' => 'Clear sight lines and proper lighting',
                    'Natural access control' => 'Single entry point with reception desk',
                    'Territorial reinforcement' => 'Company logos and maintained landscaping',
                    'Target hardening' => 'Security cameras and alarm systems'
                ],
                'justifications' => [
                    'Natural surveillance' => 'Design enables visibility and observation of activities',
                    'Natural access control' => 'Design directs people through controlled entry points',
                    'Territorial reinforcement' => 'Clear ownership and maintenance of space',
                    'Target hardening' => 'Physical security devices that harden the target'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Site Design'] ?? 4,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'When designing security zones in a facility, which principle should guide the layout?',
                'options' => [
                    'Place critical assets nearest to the entrance for quick access',
                    'Create concentric layers with increasing security toward core assets',
                    'Randomly distribute critical assets to confuse intruders',
                    'Concentrate all critical assets in one area'
                ],
                'correct_options' => ['Create concentric layers with increasing security toward core assets'],
                'justifications' => [
                    'Placing critical assets near entrances violates defense-in-depth',
                    'Correct - Progressive security layers provide multiple barriers (defense in depth)',
                    'Random distribution complicates legitimate access and emergency response',
                    'Single concentration creates a single point of failure'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Site Design'] ?? 4,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Which areas should be located in the highest security zone of a facility?',
                'options' => [
                    'Employee break rooms and cafeteria',
                    'Conference rooms for client meetings',
                    'Server rooms and network operations centers',
                    'Reception and lobby areas'
                ],
                'correct_options' => ['Server rooms and network operations centers'],
                'justifications' => [
                    'Break rooms need employee access but minimal security',
                    'Meeting rooms often require visitor access, moderate security only',
                    'Correct - Critical infrastructure requires maximum protection',
                    'Reception areas are public-facing, requiring lowest security restrictions'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Site Design'] ?? 4,
                'type_id' => 3,
                'dimension' => 'Managerial',
                'content' => 'Drag features that support natural surveillance in site design:',
                'options' => [
                    'Low landscaping near walkways',
                    'Solid 8-foot walls',
                    'Large windows in stairwells',
                    'Dense tree coverage',
                    'Open-design structures',
                    'Underground tunnels',
                    'Transparent bus shelters',
                    'Enclosed dumpster areas'
                ],
                'correct_options' => ['Low landscaping near walkways', 'Large windows in stairwells', 'Open-design structures', 'Transparent bus shelters'],
                'justifications' => [
                    'Maintains clear sight lines for observation',
                    'Blocks visibility and surveillance',
                    'Allows observation of vertical circulation',
                    'Creates concealment and reduces visibility',
                    'Enables visual monitoring of activities',
                    'Reduces visibility between areas',
                    'Maintains visibility while providing weather protection',
                    'Creates hidden areas that reduce surveillance'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Site Design'] ?? 4,
                'type_id' => 2,
                'dimension' => 'Managerial',
                'content' => '**True or False:** The primary consideration for data center site selection should always be the lowest cost location.',
                'options' => [
                    'True',
                    'False'
                ],
                'correct_options' => ['False'],
                'justifications' => [
                    'explanation' => 'While cost is important, site selection must prioritize multiple critical factors including natural disaster risks, utility reliability, proximity to emergency services, network connectivity, and environmental hazards. A cheap location prone to flooding, earthquakes, or far from emergency services could result in much higher costs from downtime, equipment damage, and service disruptions.'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 5,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Site Design'] ?? 4,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'What is the primary purpose of standoff distance in facility security design?',
                'options' => [
                    'Provide space for employee parking',
                    'Create attractive landscaping areas',
                    'Reduce blast effects from vehicle-borne threats',
                    'Allow room for emergency vehicle access'
                ],
                'correct_options' => ['Reduce blast effects from vehicle-borne threats'],
                'justifications' => [
                    'Parking is a secondary use, not the primary security purpose',
                    'Landscaping is aesthetic, not the security function',
                    'Correct - Distance reduces blast damage and fragments from vehicle bombs',
                    'Emergency access is important but not the primary purpose of standoff'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Site Design'] ?? 4,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'A potential data center site is located 2 miles from a major airport. What security considerations does this present?',
                'options' => [
                    'Aircraft noise may interfere with alarm systems',
                    'Airport security may conflict with facility operations',
                    'Potential aircraft impact risk and flight path restrictions',
                    'Electromagnetic interference from aircraft'
                ],
                'correct_options' => ['Potential aircraft impact risk and flight path restrictions'],
                'justifications' => [
                    'Modern alarm systems are not affected by aircraft noise',
                    'Airport security operates independently of private facilities',
                    'Correct - Aircraft pose direct impact risk and may restrict building height/equipment',
                    'Aircraft do not typically cause significant EMI problems'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Site Design'] ?? 4,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Which approach provides the most comprehensive physical security assessment?',
                'options' => [
                    'Review security policies and procedures only',
                    'Conduct penetration testing of access controls only',
                    'Combine document review, physical testing, and red team exercises',
                    'Interview security personnel and observe operations only'
                ],
                'correct_options' => ['Combine document review, physical testing, and red team exercises'],
                'justifications' => [
                    'Documentation alone doesn\'t test actual implementation',
                    'Technical testing alone misses human factors and physical vulnerabilities',
                    'Correct - Multi-faceted approach tests policies, systems, and responses comprehensively',
                    'Interviews and observation provide limited testing of actual security effectiveness'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 5,
                'status' => 'published'
            ],

            // Environmental Controls - HVAC, Lighting, Monitoring (10 items)
            [
                'topic_id' => $topics['Environmental Controls'] ?? 5,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'What is the recommended temperature range for optimal data center operations?',
                'options' => [
                    '55-65°F (13-18°C)',
                    '65-75°F (18-24°C)',
                    '75-85°F (24-29°C)',
                    '85-95°F (29-35°C)'
                ],
                'correct_options' => ['65-75°F (18-24°C)'],
                'justifications' => [
                    'Too cold - wastes energy and may cause condensation',
                    'Correct - ASHRAE recommended range balancing efficiency and equipment reliability',
                    'Upper acceptable limit but may stress some equipment',
                    'Too hot - significantly increases equipment failure risk'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Environmental Controls'] ?? 5,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'What is the ideal relative humidity range for data center environments?',
                'options' => [
                    '20-30%',
                    '40-60%',
                    '70-80%',
                    '80-90%'
                ],
                'correct_options' => ['40-60%'],
                'justifications' => [
                    'Too low - increases static electricity and component damage risk',
                    'Correct - Optimal range preventing both static buildup and condensation',
                    'Too high - risk of condensation and corrosion',
                    'Excessive humidity causing equipment damage and mold growth'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Environmental Controls'] ?? 5,
                'type_id' => 3,
                'dimension' => 'Managerial',
                'content' => 'Drag environmental threats that HVAC systems help mitigate:',
                'options' => [
                    'Temperature fluctuations',
                    'Power surges',
                    'Excessive humidity',
                    'Network attacks',
                    'Airborne contaminants',
                    'Physical intrusion',
                    'Static electricity buildup',
                    'Electromagnetic interference'
                ],
                'correct_options' => ['Temperature fluctuations', 'Excessive humidity', 'Airborne contaminants', 'Static electricity buildup'],
                'justifications' => [
                    'HVAC maintains stable temperatures',
                    'Electrical protection issue, not HVAC function',
                    'HVAC controls humidity levels',
                    'Cybersecurity issue, not environmental',
                    'HVAC filters remove dust and particles',
                    'Physical security issue, not environmental control',
                    'Proper humidity control reduces static electricity',
                    'EMI requires shielding, not HVAC systems'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Environmental Controls'] ?? 5,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Which type of lighting provides the best security coverage for parking areas?',
                'options' => [
                    'Maximum intensity flood lighting everywhere',
                    'Motion-activated lighting only',
                    'Continuous lighting with overlapping coverage eliminating dark spots',
                    'Intermittent lighting that cycles on and off'
                ],
                'correct_options' => ['Continuous lighting with overlapping coverage eliminating dark spots'],
                'justifications' => [
                    'Excessive brightness creates harsh shadows and glare problems',
                    'Motion-only lighting leaves areas dark until activated',
                    'Correct - Consistent, overlapping coverage eliminates hiding spots',
                    'Cycling creates predictable dark periods for exploitation'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Environmental Controls'] ?? 5,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'What lighting solution best addresses CCTV blind spots near loading docks?',
                'options' => [
                    'High-intensity flood lights throughout the area',
                    'Infrared illuminators for night vision cameras',
                    'Motion-activated strobe lights',
                    'Colored lighting to mark security zones'
                ],
                'correct_options' => ['Infrared illuminators for night vision cameras'],
                'justifications' => [
                    'Flood lights may create glare and new shadow blind spots',
                    'Correct - IR illuminators enhance camera visibility without light pollution',
                    'Strobe lights disorient but don\'t improve continuous surveillance',
                    'Colored lighting doesn\'t improve visibility for security'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Environmental Controls'] ?? 5,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Which environmental conditions should be continuously monitored in data centers? (Select all that apply)',
                'options' => [
                    'Temperature',
                    'Humidity',
                    'Sound levels',
                    'Water/flooding detection',
                    'Air quality and particulates',
                    'Light levels',
                    'Power quality',
                    'Vibration levels'
                ],
                'correct_options' => [
                    'Temperature',
                    'Humidity',
                    'Water/flooding detection',
                    'Air quality and particulates',
                    'Power quality'
                ],
                'justifications' => [
                    'Correct - Critical for equipment operation and longevity',
                    'Correct - Prevents condensation, corrosion, and static electricity',
                    'Not critical for data center equipment operation',
                    'Correct - Early warning prevents catastrophic water damage',
                    'Correct - Dust and contaminants damage sensitive equipment',
                    'Not critical for equipment operation in server areas',
                    'Correct - Voltage fluctuations damage electronic equipment',
                    'Important in some cases but not universally critical'
                ],
                'settings' => ['isMultiSelect' => true],
                'difficulty_level' => 2,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Environmental Controls'] ?? 5,
                'type_id' => 2,
                'dimension' => 'Managerial',
                'content' => '**True or False:** CCTV cameras should always be hidden to maximize effectiveness in catching security violations.',
                'options' => [
                    'True',
                    'False'
                ],
                'correct_options' => ['False'],
                'justifications' => [
                    'explanation' => 'Visible CCTV cameras provide valuable deterrence, often more effective than catching violations after they occur. A combination of visible (deterrent) and discrete (detection) cameras provides optimal coverage. Visible cameras also meet legal notification requirements in many jurisdictions.'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Environmental Controls'] ?? 5,
                'type_id' => 5,
                'dimension' => 'Managerial',
                'content' => 'Match each environmental monitoring system with its primary purpose:',
                'options' => [
                    'items' => [
                        'Temperature sensors',
                        'Humidity sensors',
                        'Water detection cables',
                        'Air quality monitors'
                    ],
                    'responses' => [
                        'Prevent equipment overheating',
                        'Detect flooding and leaks',
                        'Monitor particulate contamination',
                        'Prevent condensation and static'
                    ]
                ],
                'correct_options' => [
                    'Temperature sensors' => 'Prevent equipment overheating',
                    'Humidity sensors' => 'Prevent condensation and static',
                    'Water detection cables' => 'Detect flooding and leaks',
                    'Air quality monitors' => 'Monitor particulate contamination'
                ],
                'justifications' => [
                    'Temperature sensors' => 'Ensure equipment operates within safe temperature ranges',
                    'Humidity sensors' => 'Maintain optimal humidity to prevent condensation and static electricity',
                    'Water detection cables' => 'Provide early warning of water intrusion from leaks or flooding',
                    'Air quality monitors' => 'Detect dust, chemicals, and contaminants that damage equipment'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Environmental Controls'] ?? 5,
                'type_id' => 4,
                'dimension' => 'Managerial',
                'content' => 'Arrange lighting types by their best security application from general to specialized:',
                'options' => [
                    'Infrared illuminators',
                    'Continuous area lighting',
                    'Emergency lighting',
                    'Motion-activated lighting'
                ],
                'correct_options' => [
                    'Emergency lighting',
                    'Continuous area lighting',
                    'Motion-activated lighting',
                    'Infrared illuminators'
                ],
                'justifications' => ['Emergency lighting is most general (required everywhere), continuous area lighting for general security, motion-activated for specific areas, and infrared illuminators for specialized camera applications.'],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Environmental Controls'] ?? 5,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'How long should CCTV footage typically be retained for a standard commercial facility?',
                'options' => [
                    '24-48 hours',
                    '7-14 days',
                    '30-90 days',
                    '1 year minimum'
                ],
                'correct_options' => ['30-90 days'],
                'justifications' => [
                    'Too short to discover and investigate most incidents',
                    'May be insufficient for thorough investigations',
                    'Correct - Balances storage costs with investigation and legal requirements',
                    'Excessive for most facilities unless specific regulatory requirement'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 1,
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