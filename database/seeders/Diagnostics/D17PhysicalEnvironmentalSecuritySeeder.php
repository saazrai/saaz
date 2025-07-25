<?php

namespace Database\Seeders\Diagnostics;

class D17PhysicalEnvironmentalSecuritySeeder extends BaseDiagnosticSeeder
{
    protected string $domainName = 'Physical & Environmental Security';

    protected function getQuestions(): array
    {
        return [
            // Topic 1: Physical Access Control (10 questions)
            // Bloom Distribution: L1:0, L2:2, L3:4, L4:2, L5:2

            // Item 1 - L3 - Apply
            [
                'subtopic' => 'Physical Access Control',
                'question' => 'Your company\'s data center has experienced: (1) A cleaner was found in the server room without authorization, (2) An ex-employee used their old badge to enter, (3) A vendor tailgated through an open door. Which physical access control measures should you prioritize to address these incidents?',
                'options' => [
                    'Install better lighting and surveillance cameras throughout the facility',
                    'Implement multi-factor authentication with regular access reviews and anti-tailgating controls',
                    'Hire additional security guards and reception staff',
                    'Upgrade the HVAC system and fire suppression equipment',
                ],
                'correct_options' => ['Implement multi-factor authentication with regular access reviews and anti-tailgating controls'],
                'justifications' => [
                    'Incorrect - Surveillance helps with monitoring but doesn\'t prevent these specific access issues',
                    'Correct - These controls directly address unauthorized access, outdated credentials, and tailgating vulnerabilities',
                    'Incorrect - More staff helps but doesn\'t systematically prevent these technical access control failures',
                    'Incorrect - Environmental controls don\'t address the core access authorization problems',
                ],
                'type_id' => 1,
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.4,
                'irt_b' => 0.1,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 2 - L2 - Understand
            [
                'subtopic' => 'Physical Access Control',
                'question' => 'How do biometric access controls provide stronger security than traditional key-based systems?',
                'options' => [
                    'Biometric systems are less expensive to maintain',
                    'Biometric identifiers are unique to individuals and cannot be easily duplicated or shared',
                    'Biometric systems work faster than key-based systems',
                    'Biometric systems do not require any maintenance or updates',
                ],
                'correct_options' => ['Biometric identifiers are unique to individuals and cannot be easily duplicated or shared'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Biometric identifiers are unique to individuals and cannot be easily duplicated or shared',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'type_id' => 1,
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'irt_a' => 1.2,
                'irt_b' => -0.5,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 3 - L2 - Understand
            [
                'subtopic' => 'Physical Access Control',
                'question' => 'Why is the principle of "defense in depth" important for physical access control?',
                'options' => [
                    'It reduces the cost of security systems',
                    'Multiple layers of security controls provide redundancy if one layer fails',
                    'It simplifies security management and administration',
                    'It eliminates the need for security guards and monitoring',
                ],
                'correct_options' => ['Multiple layers of security controls provide redundancy if one layer fails'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Multiple layers of security controls provide redundancy if one layer fails',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'type_id' => 1,
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'irt_a' => 1.3,
                'irt_b' => -0.2,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 4 - L3 - Apply
            [
                'subtopic' => 'Physical Access Control',
                'question' => 'A data center needs to implement access control for areas with different security requirements. What approach should they use?',
                'options' => [
                    'Use the same access level for all areas to simplify management',
                    'Implement zone-based access control with increasing security levels toward critical areas',
                    'Only control access to the main entrance',
                    'Allow unrestricted internal access once someone enters the building',
                ],
                'correct_options' => ['Implement zone-based access control with increasing security levels toward critical areas'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Implement zone-based access control with increasing security levels toward critical areas',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'type_id' => 1,
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.4,
                'irt_b' => 0.1,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 5 - L3 - Apply
            [
                'subtopic' => 'Physical Access Control',
                'question' => 'How should an organization handle physical access control for temporary visitors and contractors?',
                'options' => [
                    'Grant the same access as permanent employees',
                    'Implement escort requirements and time-limited access badges with visitor logging',
                    'Allow unrestricted access during business hours only',
                    'Prohibit all visitor access to maintain security',
                ],
                'correct_options' => ['Implement escort requirements and time-limited access badges with visitor logging'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Implement escort requirements and time-limited access badges with visitor logging',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'type_id' => 1,
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.5,
                'irt_b' => 0.3,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 6 - L3 - Apply
            [
                'subtopic' => 'Physical Access Control',
                'question' => 'What is the most effective approach for preventing tailgating in high-security facilities?',
                'options' => [
                    'Post signs asking people not to tailgate',
                    'Install mantrap entry systems and security awareness training',
                    'Use only card readers without additional controls',
                    'Rely on security cameras to detect tailgating after it occurs',
                ],
                'correct_options' => ['Install mantrap entry systems and security awareness training'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Install mantrap entry systems and security awareness training',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'type_id' => 1,
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.4,
                'irt_b' => 0.5,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 7 - L4 - Analyze
            [
                'subtopic' => 'Physical Access Control',
                'question' => 'Analyze why card-based access systems require additional security measures to be effective.',
                'options' => [
                    'Cards are too expensive to replace when lost',
                    'Cards can be lost, stolen, shared, or cloned, requiring authentication and monitoring',
                    'Card readers are unreliable and frequently malfunction',
                    'Cards work too slowly for high-traffic areas',
                ],
                'correct_options' => ['Cards can be lost, stolen, shared, or cloned, requiring authentication and monitoring'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Cards can be lost, stolen, shared, or cloned, requiring authentication and monitoring',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'type_id' => 1,
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'irt_a' => 1.7,
                'irt_b' => 0.8,
                'irt_c' => 0.20,
                'status' => 'published',
            ],

            // Item 8 - L4 - Analyze
            [
                'subtopic' => 'Physical Access Control',
                'question' => 'What is the fundamental security challenge with emergency egress requirements in physical access control?',
                'options' => [
                    'Emergency exits are too expensive to secure properly',
                    'Fire codes require immediate exit capability that can conflict with access control security',
                    'Emergency exits are only needed in certain types of buildings',
                    'Security systems are not required to consider emergency egress',
                ],
                'correct_options' => ['Fire codes require immediate exit capability that can conflict with access control security'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Fire codes require immediate exit capability that can conflict with access control security',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'type_id' => 1,
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'irt_a' => 1.8,
                'irt_b' => 1.0,
                'irt_c' => 0.20,
                'status' => 'published',
            ],

            // Item 9 - L5 - Evaluate
            [
                'subtopic' => 'Physical Access Control',
                'question' => 'A company implements facial recognition for access control but employees complain about privacy concerns. Evaluate this situation.',
                'options' => [
                    'Facial recognition should always be implemented regardless of employee concerns',
                    'Must balance security benefits with privacy rights and consider alternative biometric options',
                    'Employee privacy is not relevant for workplace security measures',
                    'Facial recognition is inappropriate for all workplace applications',
                ],
                'correct_options' => ['Must balance security benefits with privacy rights and consider alternative biometric options'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Must balance security benefits with privacy rights and consider alternative biometric options',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'type_id' => 1,
                'bloom_level' => 5,
                'difficulty_level' => 5,
                'irt_a' => 1.9,
                'irt_b' => 1.3,
                'irt_c' => 0.15,
                'status' => 'published',
            ],

            // Item 10 - L5 - Evaluate
            [
                'subtopic' => 'Physical Access Control',
                'question' => 'Assess the effectiveness of implementing physical access control that requires two-person integrity for critical areas.',
                'options' => [
                    'Two-person integrity is unnecessary overhead that slows operations',
                    'Provides strong security for critical areas but requires careful implementation to avoid operational issues',
                    'Two-person requirements eliminate all security risks',
                    'Single-person access is always more secure than two-person systems',
                ],
                'correct_options' => ['Provides strong security for critical areas but requires careful implementation to avoid operational issues'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Provides strong security for critical areas but requires careful implementation to avoid operational issues',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'type_id' => 1,
                'bloom_level' => 5,
                'difficulty_level' => 5,
                'irt_a' => 2.0,
                'irt_b' => 1.5,
                'irt_c' => 0.15,
                'status' => 'published',
            ],

            // Topic 2: Fire Protection & Safety (10 questions)
            // Bloom Distribution: L1:1, L2:2, L3:3, L4:2, L5:2

            // Item 11 - L1 - Remember
            [
                'subtopic' => 'Fire',
                'question' => 'What are the three elements of the fire triangle that must be present for combustion?',
                'options' => [
                    'Heat, fuel, and oxygen',
                    'Smoke, flame, and heat',
                    'Fuel, water, and air',
                    'Ignition, combustion, and extinction',
                ],
                'correct_options' => ['Heat, fuel, and oxygen'],
                'justifications' => [
                    'Correct - Heat, fuel, and oxygen',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'type_id' => 1,
                'bloom_level' => 1,
                'difficulty_level' => 1,
                'irt_a' => 0.9,
                'irt_b' => -1.3,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 12 - L2 - Understand
            [
                'subtopic' => 'Fire',
                'question' => 'Why are clean agent fire suppression systems preferred over water sprinklers in data centers?',
                'options' => [
                    'Clean agents are less expensive than water systems',
                    'Clean agents suppress fire without damaging electronic equipment',
                    'Clean agents work faster than water in all situations',
                    'Clean agents require less maintenance than water systems',
                ],
                'correct_options' => ['Clean agents suppress fire without damaging electronic equipment'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Clean agents suppress fire without damaging electronic equipment',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'type_id' => 1,
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'irt_a' => 1.2,
                'irt_b' => -0.4,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 13 - L2 - Understand
            [
                'subtopic' => 'Fire',
                'question' => 'How do early warning fire detection systems improve facility safety?',
                'options' => [
                    'They eliminate the need for fire suppression systems',
                    'They provide faster response time allowing for evacuation and fire suppression before major damage',
                    'They are less expensive than traditional fire alarms',
                    'They prevent all fires from starting',
                ],
                'correct_options' => ['They provide faster response time allowing for evacuation and fire suppression before major damage'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - They provide faster response time allowing for evacuation and fire suppression before major damage',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'type_id' => 1,
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'irt_a' => 1.4,
                'irt_b' => -0.1,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 14 - L3 - Apply
            [
                'subtopic' => 'Fire',
                'question' => 'A server room contains critical IT equipment that cannot tolerate water damage. What fire suppression approach should be implemented?',
                'options' => [
                    'Standard water sprinkler systems for cost effectiveness',
                    'Clean agent gas suppression systems with early detection and pre-action controls',
                    'No fire suppression to avoid accidental discharge',
                    'Portable fire extinguishers only',
                ],
                'correct_options' => ['Clean agent gas suppression systems with early detection and pre-action controls'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Clean agent gas suppression systems with early detection and pre-action controls',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'type_id' => 1,
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.5,
                'irt_b' => 0.2,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 15 - L3 - Apply
            [
                'subtopic' => 'Fire',
                'question' => 'How should an organization design fire evacuation procedures for a high-rise office building?',
                'options' => [
                    'Rely on elevators for fast evacuation',
                    'Designate stairwells, assembly points, and train floor wardens with regular drills',
                    'Assume all employees know how to evacuate without training',
                    'Focus only on ground floor evacuation procedures',
                ],
                'correct_options' => ['Designate stairwells, assembly points, and train floor wardens with regular drills'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Designate stairwells, assembly points, and train floor wardens with regular drills',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'type_id' => 1,
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.4,
                'irt_b' => 0.4,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 16 - L3 - Apply
            [
                'subtopic' => 'Fire',
                'question' => 'What is the most effective approach for protecting irreplaceable documents and records from fire damage?',
                'options' => [
                    'Store everything in regular filing cabinets',
                    'Use fire-rated safes and vaults with climate control and backup copies in separate locations',
                    'Keep digital copies on the same premises only',
                    'Rely on standard building fire suppression systems only',
                ],
                'correct_options' => ['Use fire-rated safes and vaults with climate control and backup copies in separate locations'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Use fire-rated safes and vaults with climate control and backup copies in separate locations',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'type_id' => 1,
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.6,
                'irt_b' => 0.6,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 17 - L4 - Analyze
            [
                'subtopic' => 'Fire',
                'question' => 'Analyze why pre-action fire suppression systems are often used in environments with sensitive equipment.',
                'options' => [
                    'Pre-action systems are less expensive than other suppression methods',
                    'They require multiple triggers before discharging, reducing accidental activation while maintaining protection',
                    'Pre-action systems extinguish fires faster than other methods',
                    'They work without any detection systems or manual intervention',
                ],
                'correct_options' => ['They require multiple triggers before discharging, reducing accidental activation while maintaining protection'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - They require multiple triggers before discharging, reducing accidental activation while maintaining protection',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'type_id' => 1,
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'irt_a' => 1.7,
                'irt_b' => 0.9,
                'irt_c' => 0.20,
                'status' => 'published',
            ],

            // Item 18 - L4 - Analyze
            [
                'subtopic' => 'Fire',
                'question' => 'What is the fundamental challenge in balancing fire safety with security in high-security facilities?',
                'options' => [
                    'Fire safety and security requirements never conflict',
                    'Fire codes require immediate exit access while security requires controlled access',
                    'Fire safety is always more important than security considerations',
                    'Security systems are not affected by fire safety requirements',
                ],
                'correct_options' => ['Fire codes require immediate exit access while security requires controlled access'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Fire codes require immediate exit access while security requires controlled access',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'type_id' => 1,
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'irt_a' => 1.8,
                'irt_b' => 1.1,
                'irt_c' => 0.20,
                'status' => 'published',
            ],

            // Item 19 - L5 - Evaluate
            [
                'subtopic' => 'Fire',
                'question' => 'A company installs a very early smoke detection aspirating (VESDA) system but experiences frequent false alarms. Evaluate this situation.',
                'options' => [
                    'VESDA systems should be removed due to false alarm issues',
                    'Requires system calibration and environmental assessment while maintaining early detection benefits',
                    'False alarms indicate the system is working too well',
                    'VESDA systems should never be used in office environments',
                ],
                'correct_options' => ['Requires system calibration and environmental assessment while maintaining early detection benefits'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Requires system calibration and environmental assessment while maintaining early detection benefits',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'type_id' => 1,
                'bloom_level' => 5,
                'difficulty_level' => 5,
                'irt_a' => 1.9,
                'irt_b' => 1.4,
                'irt_c' => 0.15,
                'status' => 'published',
            ],

            // Item 20 - L5 - Evaluate
            [
                'subtopic' => 'Fire',
                'question' => 'Assess the effectiveness of combining multiple fire detection technologies (smoke, heat, flame) in a single facility.',
                'options' => [
                    'Multiple detection types create too much complexity and false alarms',
                    'Provides comprehensive coverage and faster detection but requires careful integration and testing',
                    'Only one detection type should ever be used per facility',
                    'Multiple detection systems interfere with each other',
                ],
                'correct_options' => ['Provides comprehensive coverage and faster detection but requires careful integration and testing'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Provides comprehensive coverage and faster detection but requires careful integration and testing',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'type_id' => 1,
                'bloom_level' => 5,
                'difficulty_level' => 5,
                'irt_a' => 2.0,
                'irt_b' => 1.3,
                'irt_c' => 0.15,
                'status' => 'published',
            ],

            // Topic 3: Power & Utility Systems (10 questions)
            // Bloom Distribution: L1:2, L2:2, L3:3, L4:2, L5:1

            // Item 21 - L1 - Remember
            [
                'subtopic' => 'Power',
                'question' => 'What is the primary purpose of an Uninterruptible Power Supply (UPS) in critical facilities?',
                'options' => [
                    'Reducing electricity costs during peak usage times',
                    'Providing temporary power during electrical outages to prevent system disruption',
                    'Improving overall power efficiency and performance',
                    'Eliminating the need for backup generators',
                ],
                'correct_options' => ['Providing temporary power during electrical outages to prevent system disruption'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Providing temporary power during electrical outages to prevent system disruption',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'type_id' => 1,
                'bloom_level' => 1,
                'difficulty_level' => 1,
                'irt_a' => 0.8,
                'irt_b' => -1.4,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 22 - L1 - Remember
            [
                'subtopic' => 'Power',
                'question' => 'What does power redundancy mean in facility design?',
                'options' => [
                    'Using excessive power beyond what is needed',
                    'Having backup power systems that can take over if primary power fails',
                    'Reducing power consumption to save costs',
                    'Eliminating all electrical systems for security',
                ],
                'correct_options' => ['Having backup power systems that can take over if primary power fails'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Having backup power systems that can take over if primary power fails',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'type_id' => 1,
                'bloom_level' => 1,
                'difficulty_level' => 1,
                'irt_a' => 0.9,
                'irt_b' => -1.2,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 23 - L2 - Understand
            [
                'subtopic' => 'Power',
                'question' => 'Why is clean power (power conditioning) important for sensitive electronic equipment?',
                'options' => [
                    'Clean power reduces electricity costs significantly',
                    'Power fluctuations and electrical noise can damage equipment or cause data corruption',
                    'Clean power eliminates the need for UPS systems',
                    'Clean power systems require less maintenance',
                ],
                'correct_options' => ['Power fluctuations and electrical noise can damage equipment or cause data corruption'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Power fluctuations and electrical noise can damage equipment or cause data corruption',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'type_id' => 1,
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'irt_a' => 1.2,
                'irt_b' => -0.5,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 24 - L2 - Understand
            [
                'subtopic' => 'Power',
                'question' => 'How do emergency generators differ from UPS systems in backup power strategies?',
                'options' => [
                    'Generators are faster to start than UPS systems',
                    'UPS provides immediate power while generators offer longer-term backup power',
                    'Generators are less expensive than UPS systems',
                    'UPS systems work better outdoors than generators',
                ],
                'correct_options' => ['UPS provides immediate power while generators offer longer-term backup power'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - UPS provides immediate power while generators offer longer-term backup power',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'type_id' => 1,
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'irt_a' => 1.3,
                'irt_b' => -0.2,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 25 - L3 - Apply
            [
                'subtopic' => 'Power',
                'question' => 'A financial trading firm requires 99.99% uptime for their critical systems. What power architecture should they implement?',
                'options' => [
                    'Single UPS system connected to utility power',
                    'Redundant power feeds, multiple UPS systems, and backup generators with automatic transfer',
                    'Only backup generators without UPS systems',
                    'Standard office power systems with surge protectors',
                ],
                'correct_options' => ['Redundant power feeds, multiple UPS systems, and backup generators with automatic transfer'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Redundant power feeds, multiple UPS systems, and backup generators with automatic transfer',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'type_id' => 1,
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.4,
                'irt_b' => 0.2,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 26 - L3 - Apply
            [
                'subtopic' => 'Power',
                'question' => 'How should power distribution be designed in a data center to minimize single points of failure?',
                'options' => [
                    'Use a single large UPS for the entire facility',
                    'Implement A and B power distribution paths with separate UPS and generator systems',
                    'Connect all equipment to standard office power outlets',
                    'Use only battery backup systems without generators',
                ],
                'correct_options' => ['Implement A and B power distribution paths with separate UPS and generator systems'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Implement A and B power distribution paths with separate UPS and generator systems',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'type_id' => 1,
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.5,
                'irt_b' => 0.4,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 27 - L3 - Apply
            [
                'subtopic' => 'Power',
                'question' => 'What is the most critical factor when sizing backup generators for emergency power?',
                'options' => [
                    'Choose the least expensive generator available',
                    'Calculate actual power requirements plus growth capacity with proper load testing',
                    'Always buy the largest generator possible',
                    'Use the same size as the building\'s main electrical service',
                ],
                'correct_options' => ['Calculate actual power requirements plus growth capacity with proper load testing'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Calculate actual power requirements plus growth capacity with proper load testing',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'type_id' => 1,
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.6,
                'irt_b' => 0.6,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 28 - L4 - Analyze
            [
                'subtopic' => 'Power',
                'question' => 'Analyze why battery-based UPS systems require environmental controls and monitoring.',
                'options' => [
                    'Batteries work better in any environmental condition',
                    'Temperature and humidity affect battery performance and lifespan, requiring monitoring for reliability',
                    'Environmental controls are only needed for aesthetic purposes',
                    'Batteries never fail and do not require monitoring',
                ],
                'correct_options' => ['Temperature and humidity affect battery performance and lifespan, requiring monitoring for reliability'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Temperature and humidity affect battery performance and lifespan, requiring monitoring for reliability',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'type_id' => 1,
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'irt_a' => 1.7,
                'irt_b' => 0.8,
                'irt_c' => 0.20,
                'status' => 'published',
            ],

            // Item 29 - L4 - Analyze
            [
                'subtopic' => 'Power',
                'question' => 'What is the fundamental challenge in maintaining power systems during natural disasters?',
                'options' => [
                    'Natural disasters never affect power systems',
                    'External utility infrastructure may be damaged while fuel supplies and maintenance access are limited',
                    'Backup systems always work perfectly during disasters',
                    'Natural disasters only affect power during business hours',
                ],
                'correct_options' => ['External utility infrastructure may be damaged while fuel supplies and maintenance access are limited'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - External utility infrastructure may be damaged while fuel supplies and maintenance access are limited',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'type_id' => 1,
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'irt_a' => 1.8,
                'irt_b' => 1.0,
                'irt_c' => 0.20,
                'status' => 'published',
            ],

            // Item 30 - L5 - Evaluate
            [
                'subtopic' => 'Power',
                'question' => 'A company implements a microgrid system with renewable energy and storage to improve resilience. Evaluate this approach.',
                'options' => [
                    'Microgrids are always more expensive and provide no benefits',
                    'Can improve resilience and sustainability but requires careful design and higher initial investment',
                    'Microgrids eliminate all power reliability issues',
                    'Renewable energy systems are inappropriate for critical facilities',
                ],
                'correct_options' => ['Can improve resilience and sustainability but requires careful design and higher initial investment'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Can improve resilience and sustainability but requires careful design and higher initial investment',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'type_id' => 1,
                'bloom_level' => 5,
                'difficulty_level' => 5,
                'irt_a' => 1.9,
                'irt_b' => 1.5,
                'irt_c' => 0.15,
                'status' => 'published',
            ],

            // Topic 4: Site Design & Construction (10 questions)
            // Bloom Distribution: L1:2, L2:2, L3:3, L4:2, L5:1

            // Item 31 - L1 - Remember
            [
                'subtopic' => 'Site Design',
                'question' => 'What is the primary security benefit of implementing a secure perimeter around a facility?',
                'options' => [
                    'Improving the aesthetic appearance of the property',
                    'Creating the first line of defense against unauthorized access',
                    'Reducing property insurance costs',
                    'Increasing the property value for resale',
                ],
                'correct_options' => ['Creating the first line of defense against unauthorized access'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Creating the first line of defense against unauthorized access',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'type_id' => 1,
                'bloom_level' => 1,
                'difficulty_level' => 1,
                'irt_a' => 0.8,
                'irt_b' => -1.5,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 32 - L1 - Remember
            [
                'subtopic' => 'Site Design',
                'question' => 'What does CPTED stand for in security design?',
                'options' => [
                    'Crime Prevention Through Environmental Design',
                    'Critical Protection Through Enhanced Defense',
                    'Comprehensive Physical Threat Evaluation and Defense',
                    'Centralized Perimeter Threat Detection',
                ],
                'correct_options' => ['Crime Prevention Through Environmental Design'],
                'justifications' => [
                    'Correct - Crime Prevention Through Environmental Design',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'type_id' => 1,
                'bloom_level' => 1,
                'difficulty_level' => 1,
                'irt_a' => 0.9,
                'irt_b' => -1.3,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 33 - L2 - Understand
            [
                'subtopic' => 'Site Design',
                'question' => 'How does natural surveillance contribute to facility security?',
                'options' => [
                    'It eliminates the need for security cameras',
                    'Clear sightlines and good lighting enable observation of activities and deter criminal behavior',
                    'Natural surveillance only works during daylight hours',
                    'It reduces the need for security guards',
                ],
                'correct_options' => ['Clear sightlines and good lighting enable observation of activities and deter criminal behavior'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Clear sightlines and good lighting enable observation of activities and deter criminal behavior',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'type_id' => 1,
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'irt_a' => 1.2,
                'irt_b' => -0.4,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 34 - L2 - Understand
            [
                'subtopic' => 'Site Design',
                'question' => 'Why is setback distance important in secure facility design?',
                'options' => [
                    'Setback distance improves property aesthetics',
                    'It provides buffer space against vehicle-borne threats and enables detection zones',
                    'Setback distance reduces construction costs',
                    'It eliminates the need for perimeter fencing',
                ],
                'correct_options' => ['It provides buffer space against vehicle-borne threats and enables detection zones'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - It provides buffer space against vehicle-borne threats and enables detection zones',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'type_id' => 1,
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'irt_a' => 1.4,
                'irt_b' => -0.1,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 35 - L3 - Apply
            [
                'subtopic' => 'Site Design',
                'question' => 'A government facility needs protection against vehicle-borne improvised explosive devices (VBIEDs). What design measures should be implemented?',
                'options' => [
                    'Standard decorative landscaping around the building',
                    'Anti-ram barriers, standoff distance, and hardened construction with progressive collapse resistance',
                    'Only security cameras and lighting',
                    'Standard commercial building construction',
                ],
                'correct_options' => ['Anti-ram barriers, standoff distance, and hardened construction with progressive collapse resistance'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Anti-ram barriers, standoff distance, and hardened construction with progressive collapse resistance',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'type_id' => 1,
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.5,
                'irt_b' => 0.2,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 36 - L3 - Apply
            [
                'subtopic' => 'Site Design',
                'question' => 'How should visitor parking be positioned relative to a high-security facility?',
                'options' => [
                    'Directly adjacent to the main building entrance',
                    'At a safe distance from the building with controlled access and screening areas',
                    'Mixed with employee parking throughout the property',
                    'Visitor parking is not needed for secure facilities',
                ],
                'correct_options' => ['At a safe distance from the building with controlled access and screening areas'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - At a safe distance from the building with controlled access and screening areas',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'type_id' => 1,
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.4,
                'irt_b' => 0.4,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 37 - L3 - Apply
            [
                'subtopic' => 'Site Design',
                'question' => 'What is the most effective approach for integrating blast-resistant design with normal building operations?',
                'options' => [
                    'Make blast resistance obvious to deter attackers',
                    'Integrate protective features into normal architectural elements while maintaining functionality',
                    'Only protect selected areas and leave others vulnerable',
                    'Sacrifice all normal operations for maximum protection',
                ],
                'correct_options' => ['Integrate protective features into normal architectural elements while maintaining functionality'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Integrate protective features into normal architectural elements while maintaining functionality',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'type_id' => 1,
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.6,
                'irt_b' => 0.6,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 38 - L4 - Analyze
            [
                'subtopic' => 'Site Design',
                'question' => 'Analyze why balancing security requirements with accessibility compliance (ADA) can be challenging in facility design.',
                'options' => [
                    'Security and accessibility requirements never conflict',
                    'Security measures may impede accessibility while ADA requires barrier-free access',
                    'Accessibility requirements eliminate all security options',
                    'Security is always more important than accessibility',
                ],
                'correct_options' => ['Security measures may impede accessibility while ADA requires barrier-free access'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Security measures may impede accessibility while ADA requires barrier-free access',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'type_id' => 1,
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'irt_a' => 1.7,
                'irt_b' => 0.9,
                'irt_c' => 0.20,
                'status' => 'published',
            ],

            // Item 39 - L4 - Analyze
            [
                'subtopic' => 'Site Design',
                'question' => 'What is the fundamental challenge in designing security for mixed-use facilities with both public and restricted areas?',
                'options' => [
                    'Mixed-use facilities cannot be secured effectively',
                    'Must clearly define and control transitions between public and restricted zones while maintaining user experience',
                    'All areas should have identical security levels',
                    'Public areas eliminate the need for any security measures',
                ],
                'correct_options' => ['Must clearly define and control transitions between public and restricted zones while maintaining user experience'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Must clearly define and control transitions between public and restricted zones while maintaining user experience',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'type_id' => 1,
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'irt_a' => 1.8,
                'irt_b' => 1.1,
                'irt_c' => 0.20,
                'status' => 'published',
            ],

            // Item 40 - L5 - Evaluate
            [
                'subtopic' => 'Site Design',
                'question' => 'A company builds an open-plan office with extensive glass walls to promote collaboration but faces security concerns. Evaluate this design choice.',
                'options' => [
                    'Open designs are always incompatible with security requirements',
                    'Requires balancing collaboration benefits with security controls like smart glass and zone-based access',
                    'Glass walls provide better security than solid walls',
                    'Open plans eliminate all security and privacy concerns',
                ],
                'correct_options' => ['Requires balancing collaboration benefits with security controls like smart glass and zone-based access'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Requires balancing collaboration benefits with security controls like smart glass and zone-based access',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'type_id' => 1,
                'bloom_level' => 5,
                'difficulty_level' => 5,
                'irt_a' => 1.9,
                'irt_b' => 1.4,
                'irt_c' => 0.15,
                'status' => 'published',
            ],

            // Topic 5: Environmental Controls (10 questions)
            // Bloom Distribution: L1:2, L2:2, L3:3, L4:2, L5:1

            // Item 41 - L1 - Remember
            [
                'subtopic' => 'Environmental Controls',
                'question' => 'What is the primary purpose of HVAC systems in data centers and server rooms?',
                'options' => [
                    'Providing comfortable working conditions for employees only',
                    'Maintaining proper temperature and humidity to ensure equipment reliability',
                    'Reducing energy costs and consumption',
                    'Meeting building code requirements only',
                ],
                'correct_options' => ['Maintaining proper temperature and humidity to ensure equipment reliability'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Maintaining proper temperature and humidity to ensure equipment reliability',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'type_id' => 1,
                'bloom_level' => 1,
                'difficulty_level' => 1,
                'irt_a' => 0.8,
                'irt_b' => -1.4,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 42 - L1 - Remember
            [
                'subtopic' => 'Environmental Controls',
                'question' => 'What environmental factors can damage sensitive electronic equipment?',
                'options' => [
                    'Only temperature variations',
                    'Temperature, humidity, dust, vibration, and electromagnetic interference',
                    'Only high humidity levels',
                    'Environmental factors do not affect electronic equipment',
                ],
                'correct_options' => ['Temperature, humidity, dust, vibration, and electromagnetic interference'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Temperature, humidity, dust, vibration, and electromagnetic interference',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'type_id' => 1,
                'bloom_level' => 1,
                'difficulty_level' => 1,
                'irt_a' => 0.9,
                'irt_b' => -1.2,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 43 - L2 - Understand
            [
                'subtopic' => 'Environmental Controls',
                'question' => 'Why is humidity control critical in environments with electronic equipment?',
                'options' => [
                    'Humidity only affects human comfort',
                    'Low humidity causes static electricity while high humidity enables corrosion and condensation',
                    'Humidity control reduces energy costs',
                    'Electronic equipment works better in high humidity',
                ],
                'correct_options' => ['Low humidity causes static electricity while high humidity enables corrosion and condensation'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Low humidity causes static electricity while high humidity enables corrosion and condensation',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'type_id' => 1,
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'irt_a' => 1.2,
                'irt_b' => -0.5,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 44 - L2 - Understand
            [
                'subtopic' => 'Environmental Controls',
                'question' => 'How do positive pressure systems contribute to environmental security?',
                'options' => [
                    'They reduce heating and cooling costs',
                    'They prevent infiltration of outside air, dust, and contaminants',
                    'They eliminate the need for air filtration systems',
                    'Positive pressure has no security benefits',
                ],
                'correct_options' => ['They prevent infiltration of outside air, dust, and contaminants'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - They prevent infiltration of outside air, dust, and contaminants',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'type_id' => 1,
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'irt_a' => 1.3,
                'irt_b' => -0.2,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 45 - L3 - Apply
            [
                'subtopic' => 'Environmental Controls',
                'question' => 'A pharmaceutical research lab handles sensitive compounds that could be harmful if airborne. What environmental controls should be implemented?',
                'options' => [
                    'Standard office HVAC with basic filtration',
                    'Negative pressure containment with HEPA filtration and emergency shutdown capabilities',
                    'No special environmental controls are needed',
                    'Only temperature control without air handling considerations',
                ],
                'correct_options' => ['Negative pressure containment with HEPA filtration and emergency shutdown capabilities'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Negative pressure containment with HEPA filtration and emergency shutdown capabilities',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'type_id' => 1,
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.4,
                'irt_b' => 0.2,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 46 - L3 - Apply
            [
                'subtopic' => 'Environmental Controls',
                'question' => 'How should environmental monitoring be implemented in a critical facility?',
                'options' => [
                    'Manual checks once per day are sufficient',
                    'Continuous automated monitoring with alarms and redundant sensors',
                    'Environmental monitoring is not necessary',
                    'Only monitor during business hours',
                ],
                'correct_options' => ['Continuous automated monitoring with alarms and redundant sensors'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Continuous automated monitoring with alarms and redundant sensors',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'type_id' => 1,
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.5,
                'irt_b' => 0.4,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 47 - L3 - Apply
            [
                'subtopic' => 'Environmental Controls',
                'question' => 'What is the most effective approach for environmental controls in a clean room manufacturing facility?',
                'options' => [
                    'Use standard commercial HVAC systems',
                    'Implement classified clean room standards with appropriate filtration, air changes, and contamination control',
                    'Only control temperature without considering air quality',
                    'Environmental controls are not needed in manufacturing',
                ],
                'correct_options' => ['Implement classified clean room standards with appropriate filtration, air changes, and contamination control'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Implement classified clean room standards with appropriate filtration, air changes, and contamination control',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'type_id' => 1,
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.6,
                'irt_b' => 0.6,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 48 - L4 - Analyze
            [
                'subtopic' => 'Environmental Controls',
                'question' => 'Analyze why environmental control systems require redundancy and backup power in critical facilities.',
                'options' => [
                    'Redundancy is only needed for cost savings',
                    'Environmental system failures can cause equipment damage and data loss within minutes',
                    'Environmental controls never fail',
                    'Backup power is only needed for lighting systems',
                ],
                'correct_options' => ['Environmental system failures can cause equipment damage and data loss within minutes'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Environmental system failures can cause equipment damage and data loss within minutes',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'type_id' => 1,
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'irt_a' => 1.7,
                'irt_b' => 0.8,
                'irt_c' => 0.20,
                'status' => 'published',
            ],

            // Item 49 - L4 - Analyze
            [
                'subtopic' => 'Environmental Controls',
                'question' => 'What is the fundamental challenge in designing environmental controls for facilities with mixed requirements (offices and data centers)?',
                'options' => [
                    'Mixed facilities cannot have environmental controls',
                    'Human comfort and equipment requirements differ significantly requiring zoned systems',
                    'All areas should have identical environmental conditions',
                    'Environmental controls are only needed in one type of area',
                ],
                'correct_options' => ['Human comfort and equipment requirements differ significantly requiring zoned systems'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Human comfort and equipment requirements differ significantly requiring zoned systems',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'type_id' => 1,
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'irt_a' => 1.8,
                'irt_b' => 1.0,
                'irt_c' => 0.20,
                'status' => 'published',
            ],

            // Item 50 - L5 - Evaluate
            [
                'subtopic' => 'Environmental Controls',
                'question' => 'A data center implements free cooling (using outside air) to reduce energy costs but faces concerns about air quality and security. Evaluate this approach.',
                'options' => [
                    'Free cooling should never be used in data centers',
                    'Can provide energy savings but requires careful filtration and contamination monitoring',
                    'Outside air always improves data center operations',
                    'Energy costs are not important for data center operations',
                ],
                'correct_options' => ['Can provide energy savings but requires careful filtration and contamination monitoring'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Can provide energy savings but requires careful filtration and contamination monitoring',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'type_id' => 1,
                'bloom_level' => 5,
                'difficulty_level' => 5,
                'irt_a' => 1.9,
                'irt_b' => 1.5,
                'irt_c' => 0.15,
                'status' => 'published',
            ],
        ];
    }
}
