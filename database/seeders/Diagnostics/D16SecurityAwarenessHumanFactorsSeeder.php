<?php

namespace Database\Seeders\Diagnostics;

class D16SecurityAwarenessHumanFactorsSeeder extends BaseDiagnosticSeeder
{
    protected string $domainName = 'Security Awareness & Human Factors';

    protected function getQuestions(): array
    {
        return [
            // Topic 1: Social Engineering (10 questions)
            // Bloom Distribution: L1:0, L2:2, L3:4, L4:2, L5:2

            // Item 1 - L3 - Apply
            [
                'subtopic' => 'Social Engineering',
                'question' => 'You receive multiple unusual events at your company: (1) An employee gets a call from "IT" asking for password reset, (2) USB drives are found in the parking lot, (3) A "delivery person" tries to enter without credentials. What social engineering objective ties these incidents together?',
                'options' => [
                    'Testing the company\'s technical security systems and firewalls',
                    'Attempting to manipulate people to bypass security controls and gain unauthorized access',
                    'Conducting penetration testing of network infrastructure',
                    'Performing routine security compliance audits',
                ],
                'correct_options' => ['Attempting to manipulate people to bypass security controls and gain unauthorized access'],
                'justifications' => [
                    'Incorrect - These incidents target human behavior, not technical systems',
                    'Correct - All three scenarios manipulate people to circumvent security controls through deception',
                    'Incorrect - This is social manipulation, not network penetration testing',
                    'Incorrect - These are attack attempts, not legitimate audit activities',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.3,
                'irt_b' => 0.0,
                'irt_c' => 0.25,
                'type_id' => 1,
                'status' => 'published',
            ],

            // Item 2 - L2 - Understand
            [
                'subtopic' => 'Social Engineering',
                'question' => 'How does pretexting differ from other social engineering techniques?',
                'options' => [
                    'Pretexting uses only electronic communication methods',
                    'Pretexting involves creating a fabricated scenario to engage victims',
                    'Pretexting requires physical access to target facilities',
                    'Pretexting only targets high-level executives',
                ],
                'correct_options' => ['Pretexting involves creating a fabricated scenario to engage victims'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Pretexting involves creating a fabricated scenario to engage victims',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'irt_a' => 1.2,
                'irt_b' => -0.5,
                'irt_c' => 0.25,
                'type_id' => 1,
                'status' => 'published',
            ],

            // Item 3 - L2 - Understand
            [
                'subtopic' => 'Social Engineering',
                'question' => 'Why do baiting attacks often use removable media like USB devices?',
                'options' => [
                    'USB devices are expensive and appear valuable',
                    'People\'s curiosity and desire for free items make them likely to use unknown devices',
                    'USB devices can only target Windows operating systems',
                    'Removable media is required for all malware installations',
                ],
                'correct_options' => ['People\'s curiosity and desire for free items make them likely to use unknown devices'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - People\'s curiosity and desire for free items make them likely to use unknown devices',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'irt_a' => 1.3,
                'irt_b' => -0.2,
                'irt_c' => 0.25,
                'type_id' => 1,
                'status' => 'published',
            ],

            // Item 4 - L3 - Apply
            [
                'subtopic' => 'Social Engineering',
                'question' => 'An employee receives a call from someone claiming to be from IT support requesting their password to "fix a system issue." What should the employee do?',
                'options' => [
                    'Provide the password immediately to resolve the system issue',
                    'Refuse to give the password and verify the request through official channels',
                    'Give a partial password to help while maintaining some security',
                    'Ask the caller to prove their identity by telling them their current password',
                ],
                'correct_options' => ['Refuse to give the password and verify the request through official channels'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Refuse to give the password and verify the request through official channels',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.4,
                'irt_b' => 0.1,
                'irt_c' => 0.25,
                'type_id' => 1,
                'status' => 'published',
            ],

            // Item 5 - L3 - Apply
            [
                'subtopic' => 'Social Engineering',
                'question' => 'How should an organization respond to employees who fall victim to social engineering attacks?',
                'options' => [
                    'Immediately terminate employees who fail security tests',
                    'Use incidents as learning opportunities and provide additional training',
                    'Ignore the incidents to avoid embarrassing employees',
                    'Reduce the affected employees\' access privileges permanently',
                ],
                'correct_options' => ['Use incidents as learning opportunities and provide additional training'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Use incidents as learning opportunities and provide additional training',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.5,
                'irt_b' => 0.3,
                'irt_c' => 0.25,
                'type_id' => 1,
                'status' => 'published',
            ],

            // Item 6 - L3 - Apply
            [
                'subtopic' => 'Social Engineering',
                'question' => 'What is the most effective approach for training employees to recognize phishing emails?',
                'options' => [
                    'Send monthly newsletters about phishing threats',
                    'Conduct simulated phishing exercises with immediate feedback and training',
                    'Require employees to read security policies annually',
                    'Block all external emails to prevent phishing attempts',
                ],
                'correct_options' => ['Conduct simulated phishing exercises with immediate feedback and training'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Conduct simulated phishing exercises with immediate feedback and training',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.4,
                'irt_b' => 0.5,
                'irt_c' => 0.25,
                'type_id' => 1,
                'status' => 'published',
            ],

            // Item 7 - L4 - Analyze
            [
                'subtopic' => 'Social Engineering',
                'question' => 'Analyze why social engineering attacks are often more successful than technical attacks against well-secured systems.',
                'options' => [
                    'Social engineering attacks are faster than technical attacks',
                    'Humans are often the weakest link and bypass technical security controls',
                    'Social engineering requires less skill than technical attacks',
                    'Technical security controls are always ineffective against any attack',
                ],
                'correct_options' => ['Humans are often the weakest link and bypass technical security controls'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Humans are often the weakest link and bypass technical security controls',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'irt_a' => 1.7,
                'irt_b' => 0.8,
                'irt_c' => 0.20,
                'type_id' => 1,
                'status' => 'published',
            ],

            // Item 8 - L4 - Analyze
            [
                'subtopic' => 'Social Engineering',
                'question' => 'What is the fundamental challenge in defending against social engineering attacks that target human psychology?',
                'options' => [
                    'Technology cannot prevent social engineering attacks',
                    'Human cognitive biases and trust tendencies are difficult to override completely',
                    'Social engineering attacks are too sophisticated for most people',
                    'Security awareness training is too expensive for most organizations',
                ],
                'correct_options' => ['Human cognitive biases and trust tendencies are difficult to override completely'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Human cognitive biases and trust tendencies are difficult to override completely',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'irt_a' => 1.8,
                'irt_b' => 1.0,
                'irt_c' => 0.20,
                'type_id' => 1,
                'status' => 'published',
            ],

            // Item 9 - L5 - Evaluate
            [
                'subtopic' => 'Social Engineering',
                'question' => 'A company implements a "security culture" program emphasizing that anyone can be a security hero by reporting suspicious activities. Evaluate this approach.',
                'options' => [
                    'Ineffective approach that creates paranoia among employees',
                    'Effective strategy that empowers employees and creates collective security responsibility',
                    'Only works for technical employees who understand security',
                    'Creates too much overhead and slows business operations',
                ],
                'correct_options' => ['Effective strategy that empowers employees and creates collective security responsibility'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Effective strategy that empowers employees and creates collective security responsibility',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'bloom_level' => 5,
                'difficulty_level' => 5,
                'irt_a' => 1.9,
                'irt_b' => 1.3,
                'irt_c' => 0.15,
                'type_id' => 1,
                'status' => 'published',
            ],

            // Item 10 - L5 - Evaluate
            [
                'subtopic' => 'Social Engineering',
                'question' => 'Assess the effectiveness of using "security champions" within business units to promote security awareness versus centralized security training.',
                'options' => [
                    'Centralized training is always more effective and consistent',
                    'Security champions can provide peer influence and contextual training but need proper support',
                    'Security champions create security risks by distributing responsibility',
                    'Both approaches are equally effective in all organizational contexts',
                ],
                'correct_options' => ['Security champions can provide peer influence and contextual training but need proper support'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Security champions can provide peer influence and contextual training but need proper support',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'bloom_level' => 5,
                'difficulty_level' => 5,
                'irt_a' => 2.0,
                'irt_b' => 1.5,
                'irt_c' => 0.15,
                'type_id' => 1,
                'status' => 'published',
            ],

            // Topic 2: Security Awareness & Training (10 questions)
            // Bloom Distribution: L1:1, L2:2, L3:3, L4:2, L5:2

            // Item 11 - L1 - Remember
            [
                'subtopic' => 'Security Awareness & Training',
                'question' => 'What is the primary goal of security awareness training programs?',
                'options' => [
                    'Teaching employees advanced cybersecurity technical skills',
                    'Changing employee behavior and building security-conscious culture',
                    'Replacing the need for technical security controls',
                    'Ensuring legal compliance with training requirements only',
                ],
                'correct_options' => ['Changing employee behavior and building security-conscious culture'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Changing employee behavior and building security-conscious culture',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'bloom_level' => 1,
                'difficulty_level' => 1,
                'irt_a' => 0.9,
                'irt_b' => -1.3,
                'irt_c' => 0.25,
                'type_id' => 1,
                'status' => 'published',
            ],

            // Item 12 - L2 - Understand
            [
                'subtopic' => 'Security Awareness & Training',
                'question' => 'Why is role-specific security training more effective than generic security awareness programs?',
                'options' => [
                    'Role-specific training is less expensive to implement',
                    'Employees can relate training content to their actual job responsibilities and risks',
                    'Generic training covers more security topics comprehensively',
                    'Role-specific training requires less time from employees',
                ],
                'correct_options' => ['Employees can relate training content to their actual job responsibilities and risks'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Employees can relate training content to their actual job responsibilities and risks',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'irt_a' => 1.2,
                'irt_b' => -0.4,
                'irt_c' => 0.25,
                'type_id' => 1,
                'status' => 'published',
            ],

            // Item 13 - L2 - Understand
            [
                'subtopic' => 'Security Awareness & Training',
                'question' => 'How does continuous security awareness training compare to annual security training sessions?',
                'options' => [
                    'Annual training is more comprehensive and effective',
                    'Continuous training maintains awareness and adapts to emerging threats',
                    'Both approaches are equally effective for all organizations',
                    'Training frequency has no impact on security behavior',
                ],
                'correct_options' => ['Continuous training maintains awareness and adapts to emerging threats'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Continuous training maintains awareness and adapts to emerging threats',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'irt_a' => 1.4,
                'irt_b' => -0.1,
                'irt_c' => 0.25,
                'type_id' => 1,
                'status' => 'published',
            ],

            // Item 14 - L3 - Apply
            [
                'subtopic' => 'Security Awareness & Training',
                'question' => 'A healthcare organization needs to train diverse staff including doctors, nurses, and administrative personnel. What training approach would be most effective?',
                'options' => [
                    'Provide identical security training to all staff members',
                    'Develop role-specific training that addresses each group\'s unique security risks and workflows',
                    'Only train administrative staff since they handle most data',
                    'Focus exclusively on compliance requirements and regulations',
                ],
                'correct_options' => ['Develop role-specific training that addresses each group\'s unique security risks and workflows'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Develop role-specific training that addresses each group\'s unique security risks and workflows',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.5,
                'irt_b' => 0.2,
                'irt_c' => 0.25,
                'type_id' => 1,
                'status' => 'published',
            ],

            // Item 15 - L3 - Apply
            [
                'subtopic' => 'Security Awareness & Training',
                'question' => 'How should an organization measure the effectiveness of its security awareness training program?',
                'options' => [
                    'Count the number of employees who attended training sessions',
                    'Use metrics like phishing simulation results, security incident reduction, and behavioral assessments',
                    'Measure only the cost savings from reduced security incidents',
                    'Rely solely on employee satisfaction surveys about training content',
                ],
                'correct_options' => ['Use metrics like phishing simulation results, security incident reduction, and behavioral assessments'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Use metrics like phishing simulation results, security incident reduction, and behavioral assessments',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.4,
                'irt_b' => 0.4,
                'irt_c' => 0.25,
                'type_id' => 1,
                'status' => 'published',
            ],

            // Item 16 - L3 - Apply
            [
                'subtopic' => 'Security Awareness & Training',
                'question' => 'What is the most effective approach for delivering security training to remote and distributed workforces?',
                'options' => [
                    'Wait until employees can attend in-person training sessions',
                    'Use interactive online platforms with tracking and personalized learning paths',
                    'Send security policies via email and require acknowledgment',
                    'Conduct one-time virtual meetings with all remote employees',
                ],
                'correct_options' => ['Use interactive online platforms with tracking and personalized learning paths'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Use interactive online platforms with tracking and personalized learning paths',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.6,
                'irt_b' => 0.6,
                'irt_c' => 0.25,
                'type_id' => 1,
                'status' => 'published',
            ],

            // Item 17 - L4 - Analyze
            [
                'subtopic' => 'Security Awareness & Training',
                'question' => 'Which of the following factors is MOST important for ensuring the effectiveness of security training within an organization?',
                'options' => [
                    'The overall duration of the training sessions',
                    'The number of times the training is repeated annually',
                    'The qualifications and certifications of the training instructors',
                    'The content being tailored to the target audience',
                ],
                'correct_options' => ['The content being tailored to the target audience'],
                'justifications' => [
                    'Incorrect - Training duration alone does not ensure effectiveness; overly long sessions can reduce engagement while very short sessions may lack depth',
                    'Incorrect - Frequency is important but not the most critical factor; poorly designed training repeated frequently is still ineffective',
                    'Incorrect - While instructor qualifications matter, the most qualified instructor cannot make irrelevant content effective for the specific audience',
                    'Correct - Tailoring content to the target audience is most important because relevant, role-specific training that addresses actual job responsibilities and risks ensures higher engagement and practical application',
                ],
                'bloom_level' => 4,
                'difficulty_level' => 3,
                'irt_a' => 1.3,
                'irt_b' => 0.2,
                'irt_c' => 0.20,
                'type_id' => 1,
                'status' => 'published',
            ],

            // Item 18 - L4 - Analyze
            [
                'subtopic' => 'Security Awareness & Training',
                'question' => 'What is the fundamental challenge in creating security awareness training that balances comprehensiveness with employee engagement?',
                'options' => [
                    'Comprehensive training is always more engaging for employees',
                    'Detailed content can overwhelm employees while brief content may miss critical topics',
                    'Employee engagement is not important for security training effectiveness',
                    'Security training should focus only on compliance requirements',
                ],
                'correct_options' => ['Detailed content can overwhelm employees while brief content may miss critical topics'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Detailed content can overwhelm employees while brief content may miss critical topics',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'irt_a' => 1.8,
                'irt_b' => 1.1,
                'irt_c' => 0.20,
                'type_id' => 1,
                'status' => 'published',
            ],

            // Item 19 - L5 - Evaluate
            [
                'subtopic' => 'Security Awareness & Training',
                'question' => 'A company adopts gamification in security training, using points, badges, and leaderboards to motivate participation. Evaluate this approach.',
                'options' => [
                    'Gamification always reduces the seriousness of security training',
                    'Can increase engagement and retention but must balance fun with learning objectives',
                    'Gamification is only effective for younger employees',
                    'Competition elements create security risks through oversharing',
                ],
                'correct_options' => ['Can increase engagement and retention but must balance fun with learning objectives'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Can increase engagement and retention but must balance fun with learning objectives',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'bloom_level' => 5,
                'difficulty_level' => 5,
                'irt_a' => 1.9,
                'irt_b' => 1.4,
                'irt_c' => 0.15,
                'type_id' => 1,
                'status' => 'published',
            ],

            // Item 20 - L5 - Evaluate
            [
                'subtopic' => 'Security Awareness & Training',
                'question' => 'Assess the effectiveness of using real security incidents from the organization as case studies in security awareness training.',
                'options' => [
                    'Using real incidents creates fear and reduces employee morale',
                    'Real incidents provide relevant context but require careful presentation to avoid blame',
                    'Generic examples are always more effective than organization-specific cases',
                    'Security incidents should never be discussed in training programs',
                ],
                'correct_options' => ['Real incidents provide relevant context but require careful presentation to avoid blame'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Real incidents provide relevant context but require careful presentation to avoid blame',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'bloom_level' => 5,
                'difficulty_level' => 5,
                'irt_a' => 2.0,
                'irt_b' => 1.3,
                'irt_c' => 0.15,
                'type_id' => 1,
                'status' => 'published',
            ],

            // Topic 3: Human Resource Security (10 questions)
            // Bloom Distribution: L1:2, L2:2, L3:3, L4:2, L5:1

            // Item 21 - L2 - Understand
            [
                'subtopic' => 'Human Resource Security',
                'question' => 'What is the primary purpose of pre-employment background checks from a security perspective?',
                'options' => [
                    'To determine an applicant\'s technical skills',
                    'To verify credentials, identify potential risks and assess trustworthiness',
                    'To predict future job performance',
                    'To evaluate cultural fit within the organization',
                ],
                'correct_options' => ['To verify credentials, identify potential risks and assess trustworthiness'],
                'justifications' => [
                    'Incorrect - Technical skills assessment is typically handled through interviews, testing, and portfolio reviews rather than background checks',
                    'Correct - Background checks verify credentials, identify potential security risks (criminal history, financial issues, references), and assess overall trustworthiness for access to organizational assets',
                    'Incorrect - Job performance prediction relies on interviews, references, and past performance evaluations rather than security-focused background investigations',
                    'Incorrect - Cultural fit evaluation is primarily addressed through interviews and team interactions, not through background security screening processes',
                ],
                'bloom_level' => 2,
                'difficulty_level' => 2,
                'irt_a' => 1.0,
                'irt_b' => -0.6,
                'irt_c' => 0.25,
                'type_id' => 1,
                'status' => 'published',
            ],

            // Item 22 - L1 - Remember
            [
                'subtopic' => 'Human Resource Security',
                'question' => 'What should be included in security-focused job descriptions?',
                'options' => [
                    'Only technical security requirements for IT positions',
                    'Security responsibilities and requirements relevant to the specific role',
                    'Generic security policies that apply to all employees',
                    'Legal disclaimers about security monitoring',
                ],
                'correct_options' => ['Security responsibilities and requirements relevant to the specific role'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Security responsibilities and requirements relevant to the specific role',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'bloom_level' => 1,
                'difficulty_level' => 1,
                'irt_a' => 0.9,
                'irt_b' => -1.2,
                'irt_c' => 0.25,
                'type_id' => 1,
                'status' => 'published',
            ],

            // Item 23 - L2 - Understand
            [
                'subtopic' => 'Human Resource Security',
                'question' => 'Why is security screening more extensive for positions with privileged access to sensitive information?',
                'options' => [
                    'Privileged positions require higher salaries and compensation',
                    'Higher access levels create greater potential security risks requiring additional verification',
                    'Privileged employees work in more secure physical locations',
                    'Security screening is identical for all positions regardless of access level',
                ],
                'correct_options' => ['Higher access levels create greater potential security risks requiring additional verification'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Higher access levels create greater potential security risks requiring additional verification',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'irt_a' => 1.2,
                'irt_b' => -0.5,
                'irt_c' => 0.25,
                'type_id' => 1,
                'status' => 'published',
            ],

            // Item 24 - L2 - Understand
            [
                'subtopic' => 'Human Resource Security',
                'question' => 'How do security clauses in employment contracts protect organizational assets?',
                'options' => [
                    'They eliminate all insider threats from employees',
                    'They establish legal obligations for confidentiality and acceptable behavior',
                    'They replace the need for technical security controls',
                    'They only apply to senior management positions',
                ],
                'correct_options' => ['They establish legal obligations for confidentiality and acceptable behavior'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - They establish legal obligations for confidentiality and acceptable behavior',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'irt_a' => 1.3,
                'irt_b' => -0.2,
                'irt_c' => 0.25,
                'type_id' => 1,
                'status' => 'published',
            ],

            // Item 25 - L3 - Apply
            [
                'subtopic' => 'Human Resource Security',
                'question' => 'A financial services firm is hiring for a database administrator position with access to customer financial records. What security screening approach should they implement?',
                'options' => [
                    'Use the same basic screening process for all technical positions',
                    'Implement enhanced background checks including financial history and reference verification',
                    'Only require technical certifications and skip background screening',
                    'Rely on the candidate\'s previous employer recommendations only',
                ],
                'correct_options' => ['Implement enhanced background checks including financial history and reference verification'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Implement enhanced background checks including financial history and reference verification',
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
                'subtopic' => 'Human Resource Security',
                'question' => 'During onboarding, which of the following is most crucial for a new employee\'s access management?',
                'options' => [
                    'Granting them the maximum possible access for flexibility',
                    'Provisioning access based on the principle of least privilege',
                    'Allowing them to self-provision all necessary accounts',
                    'Using shared generic accounts',
                ],
                'correct_options' => ['Provisioning access based on the principle of least privilege'],
                'justifications' => [
                    'Incorrect - Maximum access creates unnecessary security risks and violates the principle of least privilege; employees should only receive access needed for their specific role',
                    'Correct - Provisioning access based on the principle of least privilege ensures new employees receive only the minimum access necessary to perform their job functions, reducing security risks and maintaining proper access controls',
                    'Incorrect - Self-provisioning allows employees to grant themselves inappropriate access levels and bypasses proper authorization controls and approval processes',
                    'Incorrect - Shared generic accounts eliminate accountability, make auditing impossible, and create security vulnerabilities as multiple people use the same credentials',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 2,
                'irt_a' => 1.1,
                'irt_b' => -0.2,
                'irt_c' => 0.25,
                'type_id' => 1,
                'status' => 'published',
            ],

            // Item 27 - L3 - Apply
            [
                'subtopic' => 'Human Resource Security',
                'question' => 'What is the most effective approach for conducting security re-screening of existing employees in sensitive positions?',
                'options' => [
                    'Re-screen all employees annually regardless of role or risk',
                    'Implement risk-based re-screening based on position sensitivity and time intervals',
                    'Only re-screen employees after security incidents occur',
                    'Never re-screen employees after initial hiring',
                ],
                'correct_options' => ['Implement risk-based re-screening based on position sensitivity and time intervals'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Implement risk-based re-screening based on position sensitivity and time intervals',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.6,
                'irt_b' => 0.6,
                'irt_c' => 0.25,
                'type_id' => 1,
                'status' => 'published',
            ],

            // Item 28 - L4 - Analyze
            [
                'subtopic' => 'Human Resource Security',
                'question' => 'Analyze the security implications of remote work arrangements on traditional human resource security controls.',
                'options' => [
                    'Remote work eliminates all human resource security risks',
                    'Remote work requires adaptation of screening, monitoring, and access controls',
                    'Traditional HR security controls work identically for remote employees',
                    'Remote employees require less security oversight than office workers',
                ],
                'correct_options' => ['Remote work requires adaptation of screening, monitoring, and access controls'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Remote work requires adaptation of screening, monitoring, and access controls',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'irt_a' => 1.7,
                'irt_b' => 0.8,
                'irt_c' => 0.20,
                'type_id' => 1,
                'status' => 'published',
            ],

            // Item 29 - L4 - Analyze
            [
                'subtopic' => 'Human Resource Security',
                'question' => 'What is the fundamental challenge in balancing employee privacy rights with security screening requirements?',
                'options' => [
                    'Privacy rights are not relevant in employment security screening',
                    'Organizations must comply with privacy laws while obtaining necessary security information',
                    'Security screening always takes precedence over privacy considerations',
                    'Employee privacy and security screening never conflict',
                ],
                'correct_options' => ['Organizations must comply with privacy laws while obtaining necessary security information'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Organizations must comply with privacy laws while obtaining necessary security information',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'irt_a' => 1.8,
                'irt_b' => 1.0,
                'irt_c' => 0.20,
                'type_id' => 1,
                'status' => 'published',
            ],

            // Item 30 - L5 - Evaluate
            [
                'subtopic' => 'Human Resource Security',
                'question' => 'A company implements continuous monitoring of employee social media and online activities to identify potential security risks. Evaluate this approach.',
                'options' => [
                    'Continuous monitoring is necessary for all employees in all industries',
                    'Must balance legitimate security needs with privacy rights and legal compliance',
                    'Social media monitoring eliminates all insider threat risks',
                    'Online monitoring should never be implemented by organizations',
                ],
                'correct_options' => ['Must balance legitimate security needs with privacy rights and legal compliance'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Must balance legitimate security needs with privacy rights and legal compliance',
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

            // Topic 4: Personnel Safety (10 questions)
            // Bloom Distribution: L1:2, L2:2, L3:3, L4:2, L5:1

            // Item 31 - L2 - Understand
            [
                'subtopic' => 'Personnel Safety',
                'question' => 'Which of the following BEST describes the concept of duress in the context of addressing personnel safety and security concerns?',
                'options' => [
                    'A physical security measure designed to protect personnel from external threats',
                    'A legal defense that can be invoked when an individual is forced to engage in unlawful activities under coercion',
                    'A risk management technique used to assess and mitigate potential threats to personnel safety',
                    'A psychological evaluation process to identify individuals susceptible to manipulation or coercion',
                ],
                'correct_options' => ['A legal defense that can be invoked when an individual is forced to engage in unlawful activities under coercion'],
                'justifications' => [
                    'Incorrect - Physical security measures protect against threats but duress specifically refers to psychological pressure or coercion forcing someone to act against their will',
                    'Correct - Duress is a legal concept where an individual is compelled to commit an act (including potentially unlawful activities) due to immediate threat of harm, coercion, or pressure from another party',
                    'Incorrect - While duress situations may be considered in risk management, duress itself is not a risk management technique but rather a condition of coercion',
                    'Incorrect - Psychological evaluations may identify vulnerability to coercion, but duress refers to the actual state of being under coercive pressure, not the evaluation process',
                ],
                'bloom_level' => 2,
                'difficulty_level' => 2,
                'irt_a' => 1.0,
                'irt_b' => -0.6,
                'irt_c' => 0.25,
                'type_id' => 1,
                'status' => 'published',
            ],

            // Item 32 - L1 - Remember
            [
                'subtopic' => 'Personnel Safety',
                'question' => 'What should employees do if they feel threatened or unsafe at work?',
                'options' => [
                    'Handle the situation independently without involving others',
                    'Report concerns immediately to security, management, or designated safety personnel',
                    'Wait to see if the threat escalates before taking action',
                    'Only report threats if they involve physical violence',
                ],
                'correct_options' => ['Report concerns immediately to security, management, or designated safety personnel'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Report concerns immediately to security, management, or designated safety personnel',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'bloom_level' => 1,
                'difficulty_level' => 1,
                'irt_a' => 0.9,
                'irt_b' => -1.3,
                'irt_c' => 0.25,
                'type_id' => 1,
                'status' => 'published',
            ],

            // Item 33 - L2 - Understand
            [
                'subtopic' => 'Personnel Safety',
                'question' => 'Why is situational awareness important for personnel safety?',
                'options' => [
                    'It improves job performance and productivity metrics',
                    'It helps individuals recognize and respond to potential threats or dangerous situations',
                    'It reduces the need for physical security measures',
                    'It eliminates all workplace safety risks',
                ],
                'correct_options' => ['It helps individuals recognize and respond to potential threats or dangerous situations'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - It helps individuals recognize and respond to potential threats or dangerous situations',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'irt_a' => 1.2,
                'irt_b' => -0.4,
                'irt_c' => 0.25,
                'type_id' => 1,
                'status' => 'published',
            ],

            // Item 34 - L2 - Understand
            [
                'subtopic' => 'Personnel Safety',
                'question' => 'How do workplace violence prevention programs contribute to overall security?',
                'options' => [
                    'They focus only on external threats to the organization',
                    'They address both prevention and response to internal and external violence threats',
                    'They replace the need for physical security controls',
                    'They only apply to high-risk industries like healthcare',
                ],
                'correct_options' => ['They address both prevention and response to internal and external violence threats'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - They address both prevention and response to internal and external violence threats',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'irt_a' => 1.4,
                'irt_b' => -0.1,
                'irt_c' => 0.25,
                'type_id' => 1,
                'status' => 'published',
            ],

            // Item 35 - L3 - Apply
            [
                'subtopic' => 'Personnel Safety',
                'question' => 'A company with international operations needs to ensure personnel safety for employees traveling to high-risk locations. What approach should they implement?',
                'options' => [
                    'Prohibit all travel to any international locations',
                    'Develop comprehensive travel security protocols including threat assessments and emergency procedures',
                    'Only allow senior executives to travel internationally',
                    'Rely on hotel security and local law enforcement only',
                ],
                'correct_options' => ['Develop comprehensive travel security protocols including threat assessments and emergency procedures'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Develop comprehensive travel security protocols including threat assessments and emergency procedures',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.5,
                'irt_b' => 0.2,
                'irt_c' => 0.25,
                'type_id' => 1,
                'status' => 'published',
            ],

            // Item 36 - L3 - Apply
            [
                'subtopic' => 'Personnel Safety',
                'question' => 'How should an organization respond to concerning behavioral changes in an employee that might indicate potential workplace violence?',
                'options' => [
                    'Ignore the behavior unless violence actually occurs',
                    'Address concerns through appropriate channels like HR, employee assistance programs, or security',
                    'Immediately terminate the employee to eliminate risk',
                    'Assign other employees to monitor the individual continuously',
                ],
                'correct_options' => ['Address concerns through appropriate channels like HR, employee assistance programs, or security'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Address concerns through appropriate channels like HR, employee assistance programs, or security',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.4,
                'irt_b' => 0.4,
                'irt_c' => 0.25,
                'type_id' => 1,
                'status' => 'published',
            ],

            // Item 37 - L2 - Understand
            [
                'subtopic' => 'Personnel Safety',
                'question' => 'In an emergency response protocol, the first priority is typically:',
                'options' => [
                    'Restoring systems to full functionality',
                    'Containing the incident and preventing further damage',
                    'Protecting human life and safety',
                    'Notifying external regulators',
                ],
                'correct_options' => ['Protecting human life and safety'],
                'justifications' => [
                    'Incorrect - System restoration is important but comes after ensuring human safety; systems can be rebuilt but lives cannot be replaced',
                    'Incorrect - Incident containment is critical but secondary to life safety; containment efforts should not endanger personnel',
                    'Correct - Protecting human life and safety is always the first priority in emergency response protocols, as human life is irreplaceable and takes precedence over all other considerations',
                    'Incorrect - Regulatory notifications are important for compliance but come much later in the response process after life safety and immediate threats are addressed',
                ],
                'bloom_level' => 2,
                'difficulty_level' => 1,
                'irt_a' => 0.8,
                'irt_b' => -1.0,
                'irt_c' => 0.25,
                'type_id' => 1,
                'status' => 'published',
            ],

            // Item 38 - L4 - Analyze
            [
                'subtopic' => 'Personnel Safety',
                'question' => 'Analyze why personnel safety programs must address both physical and psychological safety concerns.',
                'options' => [
                    'Physical and psychological safety are completely separate issues',
                    'Both types of safety affect employee well-being and can impact security risks',
                    'Psychological safety is not relevant to security programs',
                    'Physical safety measures automatically address psychological concerns',
                ],
                'correct_options' => ['Both types of safety affect employee well-being and can impact security risks'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Both types of safety affect employee well-being and can impact security risks',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'irt_a' => 1.7,
                'irt_b' => 0.9,
                'irt_c' => 0.20,
                'type_id' => 1,
                'status' => 'published',
            ],

            // Item 39 - L4 - Analyze
            [
                'subtopic' => 'Personnel Safety',
                'question' => 'What is the fundamental challenge in creating personnel safety programs that balance security needs with maintaining a positive work environment?',
                'options' => [
                    'Security measures always improve work environments',
                    'Excessive security can create fear while insufficient security creates risk',
                    'Work environment quality is not related to personnel safety',
                    'Personnel safety programs focus only on compliance requirements',
                ],
                'correct_options' => ['Excessive security can create fear while insufficient security creates risk'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Excessive security can create fear while insufficient security creates risk',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'irt_a' => 1.8,
                'irt_b' => 1.1,
                'irt_c' => 0.20,
                'type_id' => 1,
                'status' => 'published',
            ],

            // Item 40 - L5 - Evaluate
            [
                'subtopic' => 'Personnel Safety',
                'question' => 'A company implements anonymous reporting systems for safety concerns but experiences low utilization rates. Evaluate potential causes and solutions.',
                'options' => [
                    'Anonymous reporting systems are always ineffective and should be eliminated',
                    'Low utilization may indicate trust issues, lack of awareness, or fear of retaliation requiring cultural changes',
                    'Employees prefer to handle all safety issues independently',
                    'Anonymous systems work only in certain industries',
                ],
                'correct_options' => ['Low utilization may indicate trust issues, lack of awareness, or fear of retaliation requiring cultural changes'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Low utilization may indicate trust issues, lack of awareness, or fear of retaliation requiring cultural changes',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'bloom_level' => 5,
                'difficulty_level' => 5,
                'irt_a' => 1.9,
                'irt_b' => 1.4,
                'irt_c' => 0.15,
                'type_id' => 1,
                'status' => 'published',
            ],

            // Topic 5: Personnel Security Controls (10 questions)
            // Bloom Distribution: L1:2, L2:2, L3:3, L4:2, L5:1

            // Item 41 - L1 - Remember
            [
                'subtopic' => 'Personnel Security Controls',
                'question' => 'What is the principle of least privilege in personnel security controls?',
                'options' => [
                    'Giving employees the minimum salary and benefits',
                    'Granting individuals only the minimum access necessary to perform their job functions',
                    'Hiring the smallest number of employees possible',
                    'Providing the least expensive security training',
                ],
                'correct_options' => ['Granting individuals only the minimum access necessary to perform their job functions'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Granting individuals only the minimum access necessary to perform their job functions',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'bloom_level' => 1,
                'difficulty_level' => 1,
                'irt_a' => 0.8,
                'irt_b' => -1.4,
                'irt_c' => 0.25,
                'type_id' => 1,
                'status' => 'published',
            ],

            // Item 42 - L1 - Remember
            [
                'subtopic' => 'Personnel Security Controls',
                'question' => 'What should happen to an employee\'s access rights when they change roles within an organization?',
                'options' => [
                    'Access rights should remain unchanged to avoid disruption',
                    'Access should be reviewed and adjusted to match new role requirements',
                    'All access should be removed and the employee should reapply',
                    'Access changes should only be made during annual reviews',
                ],
                'correct_options' => ['Access should be reviewed and adjusted to match new role requirements'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Access should be reviewed and adjusted to match new role requirements',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'bloom_level' => 1,
                'difficulty_level' => 1,
                'irt_a' => 0.9,
                'irt_b' => -1.2,
                'irt_c' => 0.25,
                'type_id' => 1,
                'status' => 'published',
            ],

            // Item 43 - L3 - Apply
            [
                'subtopic' => 'Personnel Security Controls',
                'question' => 'Which of these scenarios best exemplifies the violation of Separation of Duties?',
                'options' => [
                    'A developer writes code and then tests their own code for quality assurance',
                    'A user creates a report based on data they did not enter',
                    'An accountant prepares financial statements and a different accountant reviews them',
                    'A network engineer configures a firewall, and a different engineer audits the configuration',
                ],
                'correct_options' => ['A developer writes code and then tests their own code for quality assurance'],
                'justifications' => [
                    'Correct - This violates separation of duties as the same person both creates and validates the work, eliminating independent verification and increasing risk of undetected errors or malicious code',
                    'Incorrect - This demonstrates proper separation of duties where the person creating reports is different from those entering the underlying data, providing independent verification',
                    'Incorrect - This exemplifies proper separation of duties with different individuals handling preparation and review functions, ensuring independent oversight',
                    'Incorrect - This shows correct separation of duties implementation where configuration and audit functions are performed by different engineers, maintaining independent verification',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 2,
                'irt_a' => 1.1,
                'irt_b' => -0.3,
                'irt_c' => 0.25,
                'type_id' => 1,
                'status' => 'published',
            ],

            // Item 44 - L2 - Understand
            [
                'subtopic' => 'Personnel Security Controls',
                'question' => 'What is the PRIMARY reason for implementing segregation of duties (SoD) controls in an enterprise?',
                'options' => [
                    'To prevent the risk of collusion among employees',
                    'To limit user access to only the information necessary for their tasks',
                    'To restrict users to the minimum level of access required for their roles',
                    'To prevent errors or fraudulent activities in high-risk transactions',
                ],
                'correct_options' => ['To prevent errors or fraudulent activities in high-risk transactions'],
                'justifications' => [
                    'Incorrect - While SoD may reduce some collusion risks, it actually requires multiple people to be involved, and the primary purpose is preventing single-person control over critical processes',
                    'Incorrect - This describes data access controls and need-to-know principles, not separation of duties which focuses on dividing critical process steps among different individuals',
                    'Incorrect - This describes the principle of least privilege, which limits access rights, whereas SoD divides workflow responsibilities among multiple people',
                    'Correct - The primary purpose of segregation of duties is to prevent errors and fraudulent activities by ensuring no single individual has complete control over high-risk transactions or critical processes',
                ],
                'bloom_level' => 2,
                'difficulty_level' => 2,
                'irt_a' => 1.0,
                'irt_b' => -0.5,
                'irt_c' => 0.25,
                'type_id' => 1,
                'status' => 'published',
            ],

            // Item 45 - L3 - Apply
            [
                'subtopic' => 'Personnel Security Controls',
                'question' => 'A financial institution needs to implement controls for employees who process wire transfers. What combination of personnel security controls would be most effective?',
                'options' => [
                    'Allow any trained employee to process transfers independently',
                    'Implement dual authorization, transaction limits, and mandatory vacation policies',
                    'Only require additional training for wire transfer processing',
                    'Use only technical controls like software restrictions',
                ],
                'correct_options' => ['Implement dual authorization, transaction limits, and mandatory vacation policies'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Implement dual authorization, transaction limits, and mandatory vacation policies',
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

            // Item 46 - L3 - Apply
            [
                'subtopic' => 'Personnel Security Controls',
                'question' => 'How should an organization handle personnel security controls for employees who work in multiple departments or have matrix reporting relationships?',
                'options' => [
                    'Give these employees access to all systems they might need',
                    'Carefully define access based on specific job functions and implement clear approval processes',
                    'Restrict these employees to single-department access only',
                    'Allow department managers to grant access without coordination',
                ],
                'correct_options' => ['Carefully define access based on specific job functions and implement clear approval processes'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Carefully define access based on specific job functions and implement clear approval processes',
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

            // Item 47 - L2 - Understand
            [
                'subtopic' => 'Personnel Security Controls',
                'question' => 'What control focuses directly on preventing the risk of collusion?',
                'options' => [
                    'Mandatory access control',
                    'Principle of least privilege',
                    'Discretionary access control',
                    'Mandatory job rotation',
                ],
                'correct_options' => ['Mandatory job rotation'],
                'justifications' => [
                    'Incorrect - Mandatory access control (MAC) restricts access based on security classifications but does not specifically address collusion between authorized users',
                    'Incorrect - Principle of least privilege limits access to minimum necessary permissions but does not prevent authorized users from colluding within their granted access',
                    'Incorrect - Discretionary access control allows data owners to control access but does not address collusion risks between authorized users',
                    'Correct - Mandatory job rotation specifically prevents collusion by regularly moving personnel between positions, disrupting long-term relationships and schemes that require sustained cooperation',
                ],
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'irt_a' => 1.2,
                'irt_b' => -0.1,
                'irt_c' => 0.25,
                'type_id' => 1,
                'status' => 'published',
            ],

            // Item 48 - L2 - Understand
            [
                'subtopic' => 'Personnel Security Controls',
                'question' => 'The PRIMARY control purpose of required vacations or job rotations is to:',
                'options' => [
                    'allow cross-training for development',
                    'help preserve employee morale',
                    'detect improper or illegal employee acts',
                    'provide a competitive employee benefit',
                ],
                'correct_options' => ['detect improper or illegal employee acts'],
                'justifications' => [
                    'Incorrect - While cross-training may be a secondary benefit, the primary security control purpose is detection of unauthorized activities that require continuous presence to conceal',
                    'Incorrect - Employee morale improvement is a potential side benefit but not the primary security control objective of mandatory vacations and rotations',
                    'Correct - The primary control purpose is to detect improper or illegal activities by forcing employees away from their positions, revealing unauthorized acts that require their continuous presence to conceal',
                    'Incorrect - Competitive benefits are HR considerations, not the primary security control purpose of mandatory vacations and job rotations',
                ],
                'bloom_level' => 2,
                'difficulty_level' => 2,
                'irt_a' => 1.0,
                'irt_b' => -0.4,
                'irt_c' => 0.25,
                'type_id' => 1,
                'status' => 'published',
            ],

            // Item 49 - L4 - Analyze
            [
                'subtopic' => 'Personnel Security Controls',
                'question' => 'What is the fundamental challenge in implementing personnel security controls that maintain both security and operational efficiency?',
                'options' => [
                    'Security controls always improve operational efficiency',
                    'Extensive controls can impede productivity while insufficient controls create risks',
                    'Operational efficiency is not important for security programs',
                    'Personnel controls have no impact on business operations',
                ],
                'correct_options' => ['Extensive controls can impede productivity while insufficient controls create risks'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Extensive controls can impede productivity while insufficient controls create risks',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'irt_a' => 1.8,
                'irt_b' => 1.0,
                'irt_c' => 0.20,
                'type_id' => 1,
                'status' => 'published',
            ],

            // Item 50 - L5 - Evaluate
            [
                'subtopic' => 'Personnel Security Controls',
                'question' => 'A technology company implements extensive monitoring of employee activities to enforce personnel security controls, but faces pushback about privacy and trust. Evaluate this situation.',
                'options' => [
                    'Extensive monitoring is always necessary regardless of employee concerns',
                    'Must balance legitimate security needs with privacy rights and maintain employee trust',
                    'Employee privacy should never be considered in security programs',
                    'Monitoring technology eliminates the need for other personnel controls',
                ],
                'correct_options' => ['Must balance legitimate security needs with privacy rights and maintain employee trust'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Must balance legitimate security needs with privacy rights and maintain employee trust',
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
