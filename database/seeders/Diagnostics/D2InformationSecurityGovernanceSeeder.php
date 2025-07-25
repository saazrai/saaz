<?php

namespace Database\Seeders\Diagnostics;

class D2InformationSecurityGovernanceSeeder extends BaseDiagnosticSeeder
{
    protected string $domainName = 'Information Security Governance';
    
    protected function getQuestions(): array
    {
        return [
            // Topic 1: Information Security Program (10 questions)
            // Bloom Distribution: L1:2, L2:3, L3:4, L4:2, L5:1
            
            // Item 1 - Information Security Program - L1 Knowledge
            [
                'topic' => 'Information Security Program',
                'subtopic' => 'Security Program Establishment',
                'question' => 'What is the primary purpose of an information security program charter?',
                'type_id' => 1,
                'options' => [
                    'To define security tools and technologies',
                    'To establish authority, scope, and responsibilities',
                    'To document security incidents',
                    'To manage security budgets'
                ],
                'correct_options' => ['To establish authority, scope, and responsibilities'],
                'justifications' => [
                    'Security tools and technologies are implemented later, not defined in the charter',
                    'Correct - The charter establishes the program\'s authority, scope, and responsibilities',
                    'Incident documentation is an operational activity, not a charter purpose',
                    'Budget management is a function enabled by the charter, not its primary purpose'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 1, // Remember
                'status' => 'published',
                'irt_a' => 0.8,
                'irt_b' => -1.5,
                'irt_c' => 0.2
            ],
            
            // Item 2 - Information Security Program - L2 Comprehension
            [
                'topic' => 'Information Security Program',
                'subtopic' => 'Program Governance Structure',
                'question' => 'Which governance body typically provides strategic oversight for the information security program?',
                'type_id' => 1,
                'options' => [
                    'Help desk team',
                    'Security operations center',
                    'Information security steering committee',
                    'Network administrators'
                ],
                'correct_options' => ['Information security steering committee'],
                'justifications' => [
                    'Help desk teams provide operational support, not strategic oversight',
                    'SOCs handle tactical security operations, not governance',
                    'Correct - Steering committees provide strategic oversight and governance',
                    'Network administrators focus on technical implementation, not strategy'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2, // Understand
                'status' => 'published',
                'irt_a' => 1.0,
                'irt_b' => -0.5,
                'irt_c' => 0.2
            ],
            
            // Item 3 - Information Security Program - L3 Application
            [
                'topic' => 'Information Security Program',
                'subtopic' => 'Gap Analysis',
                'question' => 'You are conducting a gap analysis for your security program. Which approach would be most effective?',
                'type_id' => 1,
                'options' => [
                    'Compare current state against industry framework requirements',
                    'Review recent security incidents',
                    'Focus on technical vulnerabilities',
                    'Examine competitor security programs'
                ],
                'correct_options' => ['Compare current state against industry framework requirements'],
                'justifications' => [
                    'Correct - Gap analysis requires comparing current state to established frameworks',
                    'Incident review provides limited scope, not comprehensive gap analysis',
                    'Technical vulnerabilities are only one aspect of security program maturity',
                    'Competitor analysis doesn\'t reveal internal program gaps'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3, // Apply
                'status' => 'published',
                'irt_a' => 1.2,
                'irt_b' => 0.2,
                'irt_c' => 0.2
            ],
            
            // Item 4 - Information Security Program - L2 Comprehension
            [
                'topic' => 'Information Security Program',
                'subtopic' => 'Maturity Models',
                'question' => 'What is the primary purpose of using maturity models in information security programs?',
                'type_id' => 1,
                'options' => [
                    'To compare security budgets across organizations',
                    'To assess current capabilities and identify improvement paths',
                    'To eliminate all security risks immediately',
                    'To standardize security tools across industries'
                ],
                'correct_options' => ['To assess current capabilities and identify improvement paths'],
                'justifications' => [
                    'Maturity models focus on capability assessment, not budget comparisons',
                    'Correct - Maturity models help organizations understand their current state and plan systematic improvements',
                    'Maturity models guide gradual improvement, not immediate risk elimination',
                    'Maturity models assess processes and capabilities, not tool standardization'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2, // Understand
                'status' => 'published',
                'irt_a' => 1.1,
                'irt_b' => -0.5,
                'irt_c' => 0.2
            ],
            
            // Item 5 - Information Security Program - L4 Analysis
            [
                'topic' => 'Information Security Program',
                'subtopic' => 'Program Improvement Planning',
                'question' => 'When developing a security program improvement roadmap, which factor should receive the highest priority?',
                'type_id' => 1,
                'options' => [
                    'Most expensive initiatives',
                    'Risk reduction impact',
                    'Easiest to implement',
                    'Vendor recommendations'
                ],
                'correct_options' => ['Risk reduction impact'],
                'justifications' => [
                    'Cost alone shouldn\'t drive prioritization without risk consideration',
                    'Correct - Risk reduction impact ensures resources address highest threats',
                    'Ease of implementation may not address critical risks',
                    'Vendor recommendations may not align with organizational risks'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 4, // Analyze
                'status' => 'published',
                'irt_a' => 1.3,
                'irt_b' => 0.5,
                'irt_c' => 0.2
            ],
            
            // Item 6 - Information Security Program - L4 Analysis
            [
                'topic' => 'Information Security Program',
                'subtopic' => 'Program Effectiveness Measurement',
                'question' => 'Which metric best indicates the effectiveness of security governance implementation?',
                'type_id' => 1,
                'options' => [
                    'Number of policies published',
                    'Alignment between security initiatives and business objectives',
                    'Security budget size relative to IT budget',
                    'Frequency of board security briefings'
                ],
                'correct_options' => ['Alignment between security initiatives and business objectives'],
                'justifications' => [
                    'Policy count doesn\'t measure governance effectiveness',
                    'Correct - Business-security alignment demonstrates effective governance implementation',
                    'Budget size alone doesn\'t indicate governance quality',
                    'Meeting frequency doesn\'t guarantee effective governance'
                ],
                'difficulty_level' => 4,
                'bloom_level' => 4, // Analyze
                'status' => 'published',
                'irt_a' => 1.4,
                'irt_b' => 0.8,
                'irt_c' => 0.2
            ],
            
            // Item 7 - Information Security Program - L3 Application
            [
                'topic' => 'Information Security Program',
                'subtopic' => 'Security Program Establishment',
                'question' => 'A newly appointed CISO needs to establish a security program. What should be their first step?',
                'type_id' => 1,
                'options' => [
                    'Purchase security tools',
                    'Hire security staff',
                    'Obtain executive mandate and charter',
                    'Implement security controls'
                ],
                'correct_options' => ['Obtain executive mandate and charter'],
                'justifications' => [
                    'Tools come after strategy and governance are established',
                    'Staff hiring follows program establishment and strategy',
                    'Correct - Executive mandate and charter provide necessary authority',
                    'Controls implementation requires established program structure'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3, // Apply
                'status' => 'published',
                'irt_a' => 1.2,
                'irt_b' => 0.0,
                'irt_c' => 0.2
            ],
            
            // Item 8 - Information Security Program - L5 Evaluation
            [
                'topic' => 'Information Security Program',
                'subtopic' => 'Program Governance Structure',
                'question' => 'Evaluate the effectiveness of quarterly security steering committee meetings that consistently lack executive attendance.',
                'type_id' => 1,
                'options' => [
                    'Highly effective due to regular schedule',
                    'Ineffective due to lack of decision-making authority',
                    'Effective if detailed minutes are taken',
                    'Neutral impact on governance'
                ],
                'correct_options' => ['Ineffective due to lack of decision-making authority'],
                'justifications' => [
                    'Regular schedule alone doesn\'t ensure effectiveness',
                    'Correct - Without executives, committees lack decision authority',
                    'Minutes cannot replace executive participation and decisions',
                    'Governance requires active executive involvement, not neutrality'
                ],
                'difficulty_level' => 4,
                'bloom_level' => 5, // Evaluate
                'status' => 'published',
                'irt_a' => 1.5,
                'irt_b' => 1.0,
                'irt_c' => 0.2
            ],
            
            // Item 9 - Information Security Program - L2 Comprehension
            [
                'topic' => 'Information Security Program',
                'subtopic' => 'Gap Analysis',
                'question' => 'What is the primary benefit of using a recognized framework for gap analysis?',
                'type_id' => 1,
                'options' => [
                    'Reduces assessment costs',
                    'Provides comprehensive and industry-accepted baseline',
                    'Eliminates need for customization',
                    'Guarantees regulatory compliance'
                ],
                'correct_options' => ['Provides comprehensive and industry-accepted baseline'],
                'justifications' => [
                    'Cost reduction is a benefit but not the primary one',
                    'Correct - Frameworks provide comprehensive, validated baselines',
                    'Frameworks require customization for organizational context',
                    'Frameworks guide but don\'t guarantee compliance'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2, // Understand
                'status' => 'published',
                'irt_a' => 1.0,
                'irt_b' => -0.3,
                'irt_c' => 0.2
            ],
            
            // Item 10 - Information Security Program - L3 Application
            [
                'topic' => 'Information Security Program',
                'subtopic' => 'Program Effectiveness Measurement',
                'question' => 'You need to implement a security program effectiveness measurement system. Which approach would be most appropriate?',
                'type_id' => 1,
                'options' => [
                    'Focus only on counting security incidents',
                    'Measure only technical vulnerability metrics',
                    'Combine leading and lagging indicators across people, process, and technology',
                    'Track only compliance audit findings'
                ],
                'correct_options' => ['Combine leading and lagging indicators across people, process, and technology'],
                'justifications' => [
                    'Incident counts alone are reactive, not comprehensive',
                    'Technical metrics miss people and process dimensions',
                    'Correct - Balanced metrics across all dimensions provide complete view',
                    'Compliance findings are point-in-time, not continuous'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3, // Apply
                'status' => 'published',
                'irt_a' => 1.3,
                'irt_b' => 0.4,
                'irt_c' => 0.2
            ],
            
            // Topic 2: Strategic Alignment (10 questions)
            // Bloom Distribution: L1:1, L2:1, L3:4, L4:2, L5:2
            
            // Item 11 - Strategic Alignment - L2 Comprehension
            [
                'topic' => 'Strategic Alignment',
                'subtopic' => 'Business-Security Alignment',
                'question' => 'How does information security best support business objectives?',
                'type_id' => 1,
                'options' => [
                    'By preventing all risks',
                    'By enabling secure business operations',
                    'By maximizing security spending',
                    'By restricting business activities'
                ],
                'correct_options' => ['By enabling secure business operations'],
                'justifications' => [
                    'Preventing all risks is impossible and would halt business',
                    'Correct - Security enables business operations to function securely',
                    'Maximizing spending doesn\'t equate to effective support',
                    'Restrictions should enable, not hinder business objectives'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 2, // Understand
                'status' => 'published',
                'irt_a' => 0.9,
                'irt_b' => -1.0,
                'irt_c' => 0.2
            ],
            
            // Item 12 - Strategic Alignment - L3 Application
            [
                'topic' => 'Strategic Alignment',
                'subtopic' => 'Security Strategy Development',
                'question' => 'What should drive the development of an information security strategy?',
                'type_id' => 1,
                'options' => [
                    'Latest security technologies',
                    'Business strategy and risk appetite',
                    'Industry best practices only',
                    'Regulatory requirements alone'
                ],
                'correct_options' => ['Business strategy and risk appetite'],
                'justifications' => [
                    'Technology should support strategy, not drive it',
                    'Correct - Security strategy must align with business strategy and risk tolerance',
                    'Best practices should be adapted to organizational context',
                    'Regulations are one input, not the sole driver'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3, // Apply
                'status' => 'published',
                'irt_a' => 1.2,
                'irt_b' => 0.2,
                'irt_c' => 0.2
            ],
            
            // Item 13 - Strategic Alignment - L3 Application
            [
                'topic' => 'Strategic Alignment',
                'subtopic' => 'Business Case Development',
                'question' => 'When building a business case for a new security initiative, what is the most important element to ensure stakeholder buy-in?',
                'type_id' => 1,
                'options' => [
                    'Projected timeline for implementation',
                    'Technical specifications of the proposed solution',
                    'Alignment with business objectives and risk reduction',
                    'Number of security incidents in the last fiscal year'
                ],
                'correct_options' => ['Alignment with business objectives and risk reduction'],
                'justifications' => [
                    'Important but not the most critical. Timeline affects delivery planning but not the strategic justification',
                    'Too detailed for early stakeholder decisions. Business cases must speak in business value and risk, not tech jargon',
                    'Correct - Security initiatives must clearly demonstrate how they support business goals and mitigate risk to gain executive and board-level approval',
                    'May support the case, but historical data alone does not justify new investment unless linked to business impact or risk'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3, // Apply
                'status' => 'published',
                'irt_a' => 1.2,
                'irt_b' => 0.3,
                'irt_c' => 0.2
            ],
            
            // Item 14 - Strategic Alignment - L3 Application
            [
                'topic' => 'Strategic Alignment',
                'subtopic' => 'Strategic Planning',
                'question' => 'A 3-year security strategic plan should be reviewed and updated:',
                'type_id' => 1,
                'options' => [
                    'Only at the end of 3 years',
                    'Annually or when significant changes occur',
                    'Monthly',
                    'Only when requested by executives'
                ],
                'correct_options' => ['Annually or when significant changes occur'],
                'justifications' => [
                    'Waiting 3 years risks the plan becoming obsolete',
                    'Correct - Annual reviews with updates for significant changes maintain relevance',
                    'Monthly reviews are excessive for strategic planning',
                    'Reviews should be scheduled, not reactive to executive requests'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3, // Apply
                'status' => 'published',
                'irt_a' => 1.0,
                'irt_b' => -0.2,
                'irt_c' => 0.2
            ],
            
            // Item 15 - Strategic Alignment - L4 Analysis
            [
                'topic' => 'Strategic Alignment',
                'subtopic' => 'Business-Security Integration',
                'question' => 'Which of the following is the MOST important prerequisite for establishing information security management within an enterprise?',
                'type_id' => 1,
                'options' => [
                    'Procurement of security tools and technologies',
                    'Appointment of a Chief Information Security Officer (CISO)',
                    'Alignment of security initiatives with business objectives',
                    'Classification of information assets'
                ],
                'correct_options' => ['Alignment of security initiatives with business objectives'],
                'justifications' => [
                    'Tools and technologies are implementation details that come after strategy is established',
                    'CISO appointment is important but ineffective without business alignment',
                    'Correct - Security must align with business objectives to gain support and deliver value',
                    'Asset classification is a tactical activity that follows strategic alignment'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 4, // Analyze
                'status' => 'published',
                'irt_a' => 1.3,
                'irt_b' => 0.5,
                'irt_c' => 0.2
            ],
            
            // Item 16 - Strategic Alignment - L4 Analysis
            [
                'topic' => 'Strategic Alignment',
                'subtopic' => 'Business-Security Alignment',
                'question' => 'Analyze why a technically excellent security program might fail to gain business support.',
                'type_id' => 1,
                'options' => [
                    'Insufficient security controls',
                    'Lack of alignment with business priorities',
                    'Too few security personnel',
                    'Outdated technology'
                ],
                'correct_options' => ['Lack of alignment with business priorities'],
                'justifications' => [
                    'Technical excellence doesn\'t lack controls',
                    'Correct - Without business alignment, technical excellence is irrelevant',
                    'Personnel count doesn\'t determine business support',
                    'Technical excellence implies current technology'
                ],
                'difficulty_level' => 4,
                'bloom_level' => 4, // Analyze
                'status' => 'published',
                'irt_a' => 1.4,
                'irt_b' => 0.8,
                'irt_c' => 0.2
            ],
            
            // Item 17 - Strategic Alignment - L5 Evaluation
            [
                'topic' => 'Strategic Alignment',
                'subtopic' => 'Security Strategy Development',
                'question' => 'Evaluate a security strategy that prioritizes compliance over risk reduction for a fast-growing technology company.',
                'type_id' => 1,
                'options' => [
                    'Excellent approach ensuring legal protection',
                    'Misaligned strategy that may not address actual business risks',
                    'Best practice for all technology companies',
                    'Optimal for maximizing security effectiveness'
                ],
                'correct_options' => ['Misaligned strategy that may not address actual business risks'],
                'justifications' => [
                    'Compliance doesn\'t guarantee protection from all risks',
                    'Correct - Fast-growing tech companies need risk-based, not compliance-driven security',
                    'No single approach is best practice for all companies',
                    'Compliance focus may miss critical business risks'
                ],
                'difficulty_level' => 4,
                'bloom_level' => 5, // Evaluate
                'status' => 'published',
                'irt_a' => 1.5,
                'irt_b' => 1.1,
                'irt_c' => 0.2
            ],
            
            // Item 18 - Strategic Alignment - L1 Knowledge
            [
                'topic' => 'Strategic Alignment',
                'subtopic' => 'Business-Security Integration',
                'question' => 'Effective governance of enterprise IT requires that:',
                'type_id' => 1,
                'options' => [
                    'IT strategy be an extension of enterprise strategy',
                    'Enterprise strategy be an extension of IT strategy',
                    'IT operations managed independently',
                    'IT department drives organizational strategy'
                ],
                'correct_options' => ['IT strategy be an extension of enterprise strategy'],
                'justifications' => [
                    'Correct - IT must align with and support business objectives',
                    'Business drives IT, not the reverse',
                    'Independent IT management creates misalignment',
                    'IT supports business strategy, not drives it'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 1, // Remember
                'status' => 'published',
                'irt_a' => 0.8,
                'irt_b' => -1.2,
                'irt_c' => 0.2
            ],
            
            // Item 19 - Strategic Alignment - L5 Evaluation
            [
                'topic' => 'Strategic Alignment',
                'subtopic' => 'Strategic Planning',
                'question' => 'Value delivery from IT to the business is MOST effectively achieved by:',
                'type_id' => 1,
                'options' => [
                    'Aligning the IT strategy with the enterprise strategy',
                    'Ensuring the IT department is responsible for all technology purchases',
                    'Implementing best-of-breed technical solutions across departments',
                    'Increasing the IT budget to expand infrastructure capacity'
                ],
                'correct_options' => ['Aligning the IT strategy with the enterprise strategy'],
                'justifications' => [
                    'Correct - Value delivery is maximized when IT initiatives directly support business goals. Alignment ensures IT resources are focused on what matters most to the enterprise',
                    'Centralizing procurement alone does not ensure value delivery unless purchases align with strategic needs',
                    'Using top-tier solutions may increase cost or complexity if they don\'t align with enterprise priorities',
                    'Budget increases alone do not ensure value unless aligned with targeted outcomes and business strategy'
                ],
                'difficulty_level' => 4,
                'bloom_level' => 5, // Evaluate
                'status' => 'published',
                'irt_a' => 1.5,
                'irt_b' => 1.0,
                'irt_c' => 0.2
            ],
            
            // Item 20 - Strategic Alignment - L3 Application
            [
                'topic' => 'Strategic Alignment',
                'subtopic' => 'Business Case Development',
                'question' => 'The MOST likely effect of a lack of senior management commitment to IT strategic planning is:',
                'type_id' => 1,
                'options' => [
                    'Lack of investment in technology',
                    'Delays in technology implementation projects',
                    'Technology not aligning with organizational objectives',
                    'Increased demand for technical staff'
                ],
                'correct_options' => ['Technology not aligning with organizational objectives'],
                'justifications' => [
                    'Investment may still occur but without strategic direction',
                    'Project delays are possible but not the primary concern',
                    'Correct - Without senior management commitment, IT initiatives lack business context and fail to support organizational goals',
                    'Staff demand is unrelated to management commitment to planning'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3, // Apply
                'status' => 'published',
                'irt_a' => 1.2,
                'irt_b' => 0.2,
                'irt_c' => 0.2
            ],
            
            // Topic 3: Leadership & Accountability (10 questions)
            // Bloom Distribution: L1:2, L2:1, L3:3, L4:2, L5:2
            
            // Item 21 - Leadership & Accountability - L1 Knowledge
            [
                'topic' => 'Leadership & Accountability',
                'subtopic' => 'Board and Senior Management',
                'question' => 'What is the board of directors\' primary security responsibility?',
                'type_id' => 1,
                'options' => [
                    'Implementing security controls',
                    'Oversight and risk governance',
                    'Managing security operations',
                    'Selecting security technologies'
                ],
                'correct_options' => ['Oversight and risk governance'],
                'justifications' => [
                    'Implementation is management\'s responsibility, not the board\'s',
                    'Correct - Boards provide oversight and govern enterprise risk',
                    'Operations are handled by security teams, not board members',
                    'Technology selection is a tactical decision below board level'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 1, // Remember
                'status' => 'published',
                'irt_a' => 0.9,
                'irt_b' => -1.0,
                'irt_c' => 0.2
            ],
            
            // Item 22 - Leadership & Accountability - L1 Knowledge
            [
                'topic' => 'Leadership & Accountability',
                'subtopic' => 'C-Suite Responsibilities',
                'question' => 'Who is ultimately responsible for the protection and proper management of an enterprise\'s information?',
                'type_id' => 1,
                'options' => [
                    'Chief Information Security Officer (CISO)',
                    'Data Owner',
                    'Chief Executive Officer (CEO)',
                    'System Administrator'
                ],
                'correct_options' => ['Chief Executive Officer (CEO)'],
                'justifications' => [
                    'The CISO is responsible for developing and managing the security program but is not ultimately accountable for all enterprise information',
                    'Data owners are accountable for specific sets of data, but not at the enterprise level',
                    'Correct - The CEO holds ultimate accountability for the organization, including its information and associated risks, even if responsibilities are delegated',
                    'System admins implement technical controls but are not accountable for business-level risk or information governance'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 1, // Remember
                'status' => 'published',
                'irt_a' => 0.8,
                'irt_b' => -1.3,
                'irt_c' => 0.2
            ],
            
            // Item 23 - Leadership & Accountability - L5 Evaluation
            [
                'topic' => 'Leadership & Accountability',
                'subtopic' => 'Governance Bodies',
                'question' => 'Evaluate the effectiveness of a security steering committee composed only of IT leaders without business representation.',
                'type_id' => 1,
                'options' => [
                    'Highly effective due to technical expertise',
                    'Ineffective due to lack of business perspective and buy-in',
                    'Optimal for rapid decision making',
                    'Best practice for technical organizations'
                ],
                'correct_options' => ['Ineffective due to lack of business perspective and buy-in'],
                'justifications' => [
                    'Technical expertise alone misses business context',
                    'Correct - Business representation is essential for effective governance',
                    'Rapid decisions without business input create risk',
                    'Even technical organizations need business perspective'
                ],
                'difficulty_level' => 4,
                'bloom_level' => 5, // Evaluate
                'status' => 'published',
                'irt_a' => 1.5,
                'irt_b' => 1.0,
                'irt_c' => 0.2
            ],
            
            // Item 24 - Leadership & Accountability - L2 Comprehension
            [
                'topic' => 'Leadership & Accountability',
                'subtopic' => 'Board and Senior Management',
                'question' => 'An enterprise suffered a significant loss due to a weakness in a general information systems (IS) control. The IT process in question was designed by the IT manager and approved by the Chief Information Officer (CIO). Who is ULTIMATELY accountable for ensuring that corrective measures are completed?',
                'type_id' => 1,
                'options' => [
                    'Chief Information Officer (CIO)',
                    'IT Manager',
                    'Chief Executive Officer (CEO)',
                    'Board of Directors'
                ],
                'correct_options' => ['Board of Directors'],
                'justifications' => [
                    'While the CIO is responsible for IT operations and strategy, accountability for enterprise-level risk ultimately resides higher',
                    'The IT manager is operationally responsible for implementing the process but does not hold executive accountability',
                    'The CEO is accountable for overall performance, but governance and assurance responsibilities are formally assigned to the board',
                    'Correct - The board has ultimate accountability for ensuring the enterprise addresses material risks, including those related to IS controls, as part of governance oversight. They must ensure corrective actions are implemented and effective'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2, // Understand
                'status' => 'published',
                'irt_a' => 1.0,
                'irt_b' => -0.2,
                'irt_c' => 0.2
            ],
            
            // Item 25 - Leadership & Accountability - L3 Application
            [
                'topic' => 'Leadership & Accountability',
                'subtopic' => 'Governance Bodies',
                'question' => 'Which of the following benefits is the MOST important for senior management to understand the value of governance of enterprise IT?',
                'type_id' => 1,
                'options' => [
                    'It allows senior management to make key IT-related decisions',
                    'It enables IT to operate independently from business functions',
                    'It ensures IT investments are selected by the CIO and IT department',
                    'It reduces the need for senior management involvement in day-to-day IT operations'
                ],
                'correct_options' => ['It allows senior management to make key IT-related decisions'],
                'justifications' => [
                    'Correct - Effective IT governance provides senior management with decision-making authority and visibility to ensure IT strategies support business goals and manage risk effectively',
                    'IT governance emphasizes business-IT alignment, not IT independence. IT must operate in partnership with business functions',
                    'IT governance promotes business-driven IT decisions, not decisions made solely by the CIO or IT department',
                    'Governance does not eliminate the need for oversight — it ensures appropriate involvement at the strategic level, not operational micromanagement'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3, // Apply
                'status' => 'published',
                'irt_a' => 1.2,
                'irt_b' => 0.2,
                'irt_c' => 0.2
            ],
            
            // Item 26 - Leadership & Accountability - L3 Application
            [
                'topic' => 'Leadership & Accountability',
                'subtopic' => 'Security Culture Leadership',
                'question' => 'How can executive leadership best demonstrate commitment to security culture?',
                'type_id' => 1,
                'options' => [
                    'Delegating all security decisions to IT',
                    'Active participation and visible support',
                    'Increasing security budget only',
                    'Hiring more security staff'
                ],
                'correct_options' => ['Active participation and visible support'],
                'justifications' => [
                    'Delegation without involvement shows lack of commitment',
                    'Correct - Visible leadership participation drives cultural change',
                    'Budget increases alone don\'t demonstrate personal commitment',
                    'Staffing changes without leadership involvement are insufficient'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3, // Apply
                'status' => 'published',
                'irt_a' => 1.1,
                'irt_b' => -0.1,
                'irt_c' => 0.2
            ],
            
            // Item 27 - Leadership & Accountability - L4 Analysis
            [
                'topic' => 'Leadership & Accountability',
                'subtopic' => 'Board and Senior Management',
                'question' => 'Analyze the risks when board members lack cybersecurity expertise.',
                'type_id' => 1,
                'options' => [
                    'No significant impact on governance',
                    'Inadequate risk oversight and poor decision-making',
                    'Improved delegation to management',
                    'Reduced compliance costs'
                ],
                'correct_options' => ['Inadequate risk oversight and poor decision-making'],
                'justifications' => [
                    'Cyber risks are too significant to ignore at board level',
                    'Correct - Lack of expertise impairs oversight and strategic decisions',
                    'Uninformed delegation increases rather than reduces risk',
                    'Lack of expertise typically increases compliance costs'
                ],
                'difficulty_level' => 4,
                'bloom_level' => 4, // Analyze
                'status' => 'published',
                'irt_a' => 1.4,
                'irt_b' => 0.8,
                'irt_c' => 0.2
            ],
            
            // Item 28 - Leadership & Accountability - L3 Application
            [
                'topic' => 'Leadership & Accountability',
                'subtopic' => 'Security Culture Leadership',
                'question' => 'How should you implement tone at the top for security culture in a large organization?',
                'type_id' => 1,
                'options' => [
                    'Send annual email from CEO about security',
                    'Regular executive communications and visible security behaviors',
                    'Delegate all communications to security team',
                    'Focus only on technical security training'
                ],
                'correct_options' => ['Regular executive communications and visible security behaviors'],
                'justifications' => [
                    'Annual emails are too infrequent to establish culture',
                    'Correct - Consistent communication and modeling behaviors shape culture',
                    'Delegation undermines the "tone at the top" concept',
                    'Technical training alone doesn\'t address cultural aspects'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3, // Apply
                'status' => 'published',
                'irt_a' => 1.2,
                'irt_b' => 0.3,
                'irt_c' => 0.2
            ],
            
            // Item 29 - Leadership & Accountability - L5 Evaluation
            [
                'topic' => 'Leadership & Accountability',
                'subtopic' => 'CISO Role',
                'question' => 'The involvement of senior management is MOST important in the development of:',
                'type_id' => 1,
                'options' => [
                    'System configuration standards',
                    'Audit plan',
                    'Information security strategy',
                    'IT procedures'
                ],
                'correct_options' => ['Information security strategy'],
                'justifications' => [
                    'Configuration standards are technical details best left to IT specialists',
                    'While audit planning benefits from management input, it\'s not the most critical area for their involvement',
                    'Correct - Security strategy requires senior management involvement to ensure alignment with business objectives and appropriate risk appetite',
                    'IT procedures are operational details that don\'t require senior management involvement'
                ],
                'difficulty_level' => 4,
                'bloom_level' => 5, // Evaluate
                'status' => 'published',
                'irt_a' => 1.5,
                'irt_b' => 1.0,
                'irt_c' => 0.2
            ],
            
            // Item 30 - Leadership & Accountability - L4 Analysis - Type 5 Matching
            [
                'topic' => 'Leadership & Accountability',
                'subtopic' => 'Accountability Frameworks',
                'question' => 'Match each RACI responsibility with the appropriate role in the context of rolling out a data classification policy.',
                'type_id' => 5,
                'options' => [
                    'items' => ['Accountable', 'Responsible', 'Consulted', 'Informed'],
                    'responses' => ['CISO', 'Data Owner', 'Compliance Officer', 'End Users']
                ],
                'correct_options' => [
                    'Accountable' => 'CISO',
                    'Responsible' => 'Data Owner',
                    'Consulted' => 'Compliance Officer',
                    'Informed' => 'End Users'
                ],
                'justifications' => [
                    'Accountable' => 'The CISO holds ultimate accountability as the senior executive responsible for information security strategy and policy implementation success',
                    'Responsible' => 'Data Owners are responsible for implementing classification requirements for their specific data sets',
                    'Consulted' => 'Compliance Officer is consulted to ensure policy meets regulatory requirements and standards',
                    'Informed' => 'End Users are informed about the policy and their obligations but are not decision-makers in the rollout'
                ],
                'difficulty_level' => 4,
                'bloom_level' => 4, // Analyze
                'status' => 'published',
                'irt_a' => 1.3,
                'irt_b' => 0.5,
                'irt_c' => 0.2
            ],
            
            // Topic 4: Security Policy Framework (10 questions)
            // Bloom Distribution: L1:1, L2:3, L3:3, L4:2, L5:1
            
            // Item 31 - Security Policy Framework - L1 Knowledge
            [
                'topic' => 'Security Policy Framework',
                'subtopic' => 'Policy Hierarchy',
                'question' => 'What is the correct hierarchical order of security documentation?',
                'type_id' => 1,
                'options' => [
                    'Guideline → Policy → Standard → Procedure',
                    'Policy → Standard → Procedure → Guideline',
                    'Procedure → Standard → Policy → Guideline',
                    'Standard → Policy → Guideline → Procedure'
                ],
                'correct_options' => ['Policy → Standard → Procedure → Guideline'],
                'justifications' => [
                    'Guidelines are recommendations, not the top of hierarchy',
                    'Correct - Policies set direction, standards specify requirements, procedures detail steps, guidelines advise',
                    'Procedures are tactical, not strategic documents',
                    'Standards derive from policies, not vice versa'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 1, // Remember
                'status' => 'published',
                'irt_a' => 0.8,
                'irt_b' => -1.2,
                'irt_c' => 0.2
            ],
            
            // Item 32 - Security Policy Framework - L2 Comprehension
            [
                'topic' => 'Security Policy Framework',
                'subtopic' => 'Policy Types',
                'question' => 'Which statement best describes the difference between mandatory and advisory policies?',
                'type_id' => 1,
                'options' => [
                    'Mandatory policies are suggestions, advisory are requirements',
                    'Mandatory policies must be followed, advisory provide guidance',
                    'Both types are equally enforceable',
                    'Advisory policies override mandatory ones'
                ],
                'correct_options' => ['Mandatory policies must be followed, advisory provide guidance'],
                'justifications' => [
                    'This reverses the actual definitions',
                    'Correct - Mandatory policies require compliance, advisory policies recommend',
                    'Only mandatory policies are enforceable',
                    'Mandatory policies take precedence over advisory'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 2, // Understand
                'status' => 'published',
                'irt_a' => 0.9,
                'irt_b' => -0.8,
                'irt_c' => 0.2
            ],
            
            // Item 33 - Security Policy Framework - L2 Comprehension
            [
                'topic' => 'Security Policy Framework',
                'subtopic' => 'Documentation Standards',
                'question' => 'What elements must be included in a well-structured security policy?',
                'type_id' => 1,
                'options' => [
                    'Technical specifications only',
                    'Purpose, scope, roles, and requirements',
                    'Vendor contact information',
                    'Budget details'
                ],
                'correct_options' => ['Purpose, scope, roles, and requirements'],
                'justifications' => [
                    'Technical specifications belong in standards or procedures',
                    'Correct - These core elements define what, why, who, and how',
                    'Vendor information is operational, not policy content',
                    'Budget details are separate from policy requirements'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2, // Understand
                'status' => 'published',
                'irt_a' => 1.0,
                'irt_b' => -0.3,
                'irt_c' => 0.2
            ],
            
            // Item 34 - Security Policy Framework - L2 Comprehension
            [
                'topic' => 'Security Policy Framework',
                'subtopic' => 'Policy Templates',
                'question' => 'Why are standardized policy templates important?',
                'type_id' => 1,
                'options' => [
                    'They reduce writing effort only',
                    'They ensure consistency and completeness',
                    'They are required by law',
                    'They eliminate need for reviews'
                ],
                'correct_options' => ['They ensure consistency and completeness'],
                'justifications' => [
                    'Effort reduction is a benefit, not the primary purpose',
                    'Correct - Templates ensure all policies contain required elements consistently',
                    'Templates are best practice, not legal requirements',
                    'All policies require review regardless of template use'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2, // Understand
                'status' => 'published',
                'irt_a' => 1.0,
                'irt_b' => -0.2,
                'irt_c' => 0.2
            ],
            
            // Item 35 - Security Policy Framework - L3 Application
            [
                'topic' => 'Security Policy Framework',
                'subtopic' => 'Regulatory Mapping',
                'question' => 'You need to map security policies to multiple regulatory requirements. What approach is most effective?',
                'type_id' => 1,
                'options' => [
                    'Create separate policies for each regulation',
                    'Use a unified control framework with regulatory mapping',
                    'Ignore overlapping requirements',
                    'Focus on the strictest regulation only'
                ],
                'correct_options' => ['Use a unified control framework with regulatory mapping'],
                'justifications' => [
                    'Separate policies create duplication and conflicts',
                    'Correct - Unified frameworks prevent redundancy while ensuring compliance',
                    'Ignoring requirements creates compliance gaps',
                    'Other regulations may have unique requirements not covered'
                ],
                'difficulty_level' => 4,
                'bloom_level' => 3, // Apply
                'status' => 'published',
                'irt_a' => 1.4,
                'irt_b' => 0.8,
                'irt_c' => 0.2
            ],
            
            // Item 36 - Security Policy Framework - L3 Application
            [
                'topic' => 'Security Policy Framework',
                'subtopic' => 'Policy Hierarchy',
                'question' => 'An employee asks for specific steps to encrypt a laptop. Which document type should they consult?',
                'type_id' => 1,
                'options' => [
                    'Policy',
                    'Standard',
                    'Procedure',
                    'Guideline'
                ],
                'correct_options' => ['Procedure'],
                'justifications' => [
                    'Policies state requirements but not implementation steps',
                    'Standards specify what to use, not how to use it',
                    'Correct - Procedures provide step-by-step instructions',
                    'Guidelines offer recommendations, not specific steps'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3, // Apply
                'status' => 'published',
                'irt_a' => 1.2,
                'irt_b' => 0.2,
                'irt_c' => 0.2
            ],
            
            // Item 37 - Security Policy Framework - L4 Analysis
            [
                'topic' => 'Security Policy Framework',
                'subtopic' => 'Policy Types',
                'question' => 'Analyze the impact of having only advisory security policies in a regulated industry.',
                'type_id' => 1,
                'options' => [
                    'Provides maximum flexibility',
                    'Creates compliance risks and enforcement challenges',
                    'Improves employee satisfaction',
                    'Reduces documentation needs'
                ],
                'correct_options' => ['Creates compliance risks and enforcement challenges'],
                'justifications' => [
                    'Flexibility cannot justify non-compliance in regulated industries',
                    'Correct - Regulations require enforceable policies, not recommendations',
                    'Employee satisfaction doesn\'t outweigh compliance requirements',
                    'Advisory policies still require documentation'
                ],
                'difficulty_level' => 4,
                'bloom_level' => 4, // Analyze
                'status' => 'published',
                'irt_a' => 1.4,
                'irt_b' => 0.9,
                'irt_c' => 0.2
            ],
            
            // Item 38 - Security Policy Framework - L4 Analysis
            [
                'topic' => 'Security Policy Framework',
                'subtopic' => 'Regulatory Mapping',
                'question' => 'Analyze the impact of conflicting security policies between global and regional requirements.',
                'type_id' => 1,
                'options' => [
                    'No significant impact on operations',
                    'Creates compliance risks and operational confusion',
                    'Improves security through redundancy',
                    'Automatically resolves through hierarchy'
                ],
                'correct_options' => ['Creates compliance risks and operational confusion'],
                'justifications' => [
                    'Conflicts significantly impact operations and compliance',
                    'Correct - Conflicting policies create confusion and potential violations',
                    'Conflicts don\'t improve security, they create gaps',
                    'Conflicts require active resolution, not automatic hierarchy'
                ],
                'difficulty_level' => 4,
                'bloom_level' => 4, // Analyze
                'status' => 'published',
                'irt_a' => 1.4,
                'irt_b' => 0.9,
                'irt_c' => 0.2
            ],
            
            // Item 39 - Security Policy Framework - L5 Evaluation
            [
                'topic' => 'Security Policy Framework',
                'subtopic' => 'Documentation Standards',
                'question' => 'A multinational organization is implementing a unified data retention policy across all its global offices. While the head office is in the United States, it also operates in the European Union, Brazil, and the Middle East. Each region has distinct data protection regulations (e.g., GDPR, LGPD, local data localization laws). The Chief Risk Officer (CRO) is leading the initiative and wants to ensure that the policy is enforceable globally while remaining compliant with local laws. Which of the following is the MOST appropriate approach to implementing the corporate policy?',
                'type_id' => 1,
                'options' => [
                    'Enforce a single, global data retention period based on U.S. standards for consistency across all regions',
                    'Allow each regional office to draft its own retention policy based solely on local regulatory requirements, without central oversight',
                    'Develop a centralized data retention policy framework that sets minimum standards while allowing regional customization based on applicable legal requirements',
                    'Defer implementation of the policy until global regulatory alignment is achieved to avoid legal conflicts'
                ],
                'correct_options' => ['Develop a centralized data retention policy framework that sets minimum standards while allowing regional customization based on applicable legal requirements'],
                'justifications' => [
                    'U.S. standards may violate stricter regulations in other regions like the EU under GDPR',
                    'Lack of central oversight creates inconsistency and governance gaps across the organization',
                    'Correct - A framework approach balances global consistency with local compliance requirements, ensuring both governance and legal adherence',
                    'Global regulatory alignment is unlikely to occur, and deferring implementation leaves the organization exposed to compliance risks'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 5, // Evaluate
                'status' => 'published',
                'irt_a' => 1.3,
                'irt_b' => 0.4,
                'irt_c' => 0.2
            ],
            
            // Item 40 - Security Policy Framework - L3 Application - Type 5 Matching
            [
                'topic' => 'Security Policy Framework',
                'subtopic' => 'Policy Templates',
                'question' => 'An organization decides to replace its aging firewall with another vendor. Match each document type with the expected level of change.',
                'type_id' => 5,
                'options' => [
                    'items' => ['Policy', 'Standard', 'Procedures'],
                    'responses' => ['No changes', 'Major changes', 'Maximum changes']
                ],
                'correct_options' => [
                    'Policy' => 'No changes',
                    'Standard' => 'Major changes',
                    'Procedures' => 'Maximum changes'
                ],
                'justifications' => [
                    'Policy' => 'Policies define high-level requirements (e.g., "perimeter security must be implemented") and are vendor-agnostic, so they remain unchanged',
                    'Standard' => 'Standards specify technical requirements (e.g., firewall capabilities, logging standards) that may need significant updates for the new vendor',
                    'Procedures' => 'Procedures contain step-by-step instructions specific to the firewall model and interface, requiring complete rewriting for the new vendor'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3, // Apply
                'status' => 'published',
                'irt_a' => 1.2,
                'irt_b' => 0.3,
                'irt_c' => 0.2
            ],
            
            // Topic 5: Policy Governance and Management (10 questions)
            // Bloom Distribution: L1:2, L2:2, L3:3, L4:2, L5:1
            
            // Item 41 - Policy Governance and Management - L1 Knowledge
            [
                'topic' => 'Policy Governance and Management',
                'subtopic' => 'Policy Lifecycle Management',
                'question' => 'What is the recommended review cycle for security policies?',
                'type_id' => 1,
                'options' => [
                    'Every 5 years',
                    'Annually or upon significant changes',
                    'Only when regulations change',
                    'Never, if well-written initially'
                ],
                'correct_options' => ['Annually or upon significant changes'],
                'justifications' => [
                    'Five years is too long given changing threats and technology',
                    'Correct - Annual reviews with updates for significant changes maintain relevance',
                    'Business and technology changes also require policy updates',
                    'Even well-written policies need updates as environments change'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 1, // Remember
                'status' => 'published',
                'irt_a' => 0.8,
                'irt_b' => -1.0,
                'irt_c' => 0.2
            ],
            
            // Item 42 - Policy Governance and Management - L2 Comprehension
            [
                'topic' => 'Policy Governance and Management',
                'subtopic' => 'Policy Approval Workflows',
                'question' => 'Who should have final approval authority for enterprise security policies?',
                'type_id' => 1,
                'options' => [
                    'Security analyst',
                    'Senior management or board',
                    'IT help desk',
                    'Any employee'
                ],
                'correct_options' => ['Senior management or board'],
                'justifications' => [
                    'Analysts lack organizational authority for policy approval',
                    'Correct - Senior leadership ensures policies align with business objectives',
                    'Help desk is operational, not strategic',
                    'Policy approval requires appropriate authority levels'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 2, // Understand
                'status' => 'published',
                'irt_a' => 0.9,
                'irt_b' => -0.8,
                'irt_c' => 0.2
            ],
            
            // Item 43 - Policy Governance and Management - L3 Application
            [
                'topic' => 'Policy Governance and Management',
                'subtopic' => 'Policy Governance',
                'question' => 'What is the most effective method to monitor policy compliance?',
                'type_id' => 1,
                'options' => [
                    'Annual self-attestation only',
                    'Combination of automated controls and periodic audits',
                    'Trust-based system',
                    'Complaints-driven review'
                ],
                'correct_options' => ['Combination of automated controls and periodic audits'],
                'justifications' => [
                    'Self-attestation alone is insufficient for verification',
                    'Correct - Automated controls provide continuous monitoring, audits verify effectiveness',
                    'Trust without verification creates compliance gaps',
                    'Reactive approaches miss proactive compliance issues'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3, // Apply
                'status' => 'published',
                'irt_a' => 1.2,
                'irt_b' => 0.3,
                'irt_c' => 0.2
            ],
            
            // Item 44 - Policy Governance and Management - L3 Application
            [
                'topic' => 'Policy Governance and Management',
                'subtopic' => 'Policy Enforcement',
                'question' => 'How should policy exceptions be managed?',
                'type_id' => 1,
                'options' => [
                    'Deny all exceptions',
                    'Document, approve, and time-limit exceptions',
                    'Allow informal exceptions',
                    'Grant permanent exceptions freely'
                ],
                'correct_options' => ['Document, approve, and time-limit exceptions'],
                'justifications' => [
                    'Absolute denial ignores legitimate business needs',
                    'Correct - Formal process ensures exceptions are justified and reviewed',
                    'Informal exceptions create unmanaged risks',
                    'Permanent exceptions undermine policy effectiveness'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3, // Apply
                'status' => 'published',
                'irt_a' => 1.1,
                'irt_b' => 0.1,
                'irt_c' => 0.2
            ],
            
            // Item 45 - Policy Governance and Management - L4 Analysis
            [
                'topic' => 'Policy Governance and Management',
                'subtopic' => 'Policy Effectiveness Measurement',
                'question' => 'Which metric best indicates policy effectiveness?',
                'type_id' => 1,
                'options' => [
                    'Number of policies published',
                    'Reduction in policy-related incidents',
                    'Policy page views',
                    'Policy word count'
                ],
                'correct_options' => ['Reduction in policy-related incidents'],
                'justifications' => [
                    'Quantity doesn\'t indicate quality or effectiveness',
                    'Correct - Fewer incidents show policies are preventing problems',
                    'Views don\'t indicate understanding or compliance',
                    'Length has no correlation with effectiveness'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 4, // Analyze
                'status' => 'published',
                'irt_a' => 1.3,
                'irt_b' => 0.5,
                'irt_c' => 0.2
            ],
            
            // Item 46 - Policy Governance and Management - L3 Application
            [
                'topic' => 'Policy Governance and Management',
                'subtopic' => 'Policy Effectiveness Measurement',
                'question' => 'Which of the following is the BEST objective method to measure the effectiveness of a newly implemented security policy?',
                'type_id' => 1,
                'options' => [
                    'Tracking the number of users who acknowledged reading the policy',
                    'Comparing the number of detected policy violations before and after implementation',
                    'Sharing compliance reports with senior management',
                    'Ensuring the policy aligns with industry standards and frameworks'
                ],
                'correct_options' => ['Comparing the number of detected policy violations before and after implementation'],
                'justifications' => [
                    'Acknowledgment only confirms receipt, not understanding or compliance',
                    'Correct - Violation metrics provide quantifiable evidence of behavioral change and policy effectiveness',
                    'Sharing reports is a communication activity, not a measurement method',
                    'Alignment with standards indicates quality but not actual effectiveness in practice'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3, // Apply
                'status' => 'published',
                'irt_a' => 1.3,
                'irt_b' => 0.2,
                'irt_c' => 0.2
            ],
            
            // Item 47 - Policy Governance and Management - L4 Analysis
            [
                'topic' => 'Policy Governance and Management',
                'subtopic' => 'Policy Enforcement',
                'question' => 'In which of the following situations is it MOST appropriate to grant a formal exception to an established security policy?',
                'type_id' => 1,
                'options' => [
                    'When the policy is technically difficult to implement',
                    'When the business benefit of the exception clearly outweighs the associated risk',
                    'When end-users complain that the policy hinders productivity',
                    'When end-users have not read and understood the policy'
                ],
                'correct_options' => ['When the business benefit of the exception clearly outweighs the associated risk'],
                'justifications' => [
                    'Technical difficulty alone doesn\'t justify exceptions; solutions should be sought',
                    'Correct - Risk-based decisions that consider business value are the appropriate basis for formal exceptions, provided risks are documented and accepted',
                    'User complaints without risk analysis don\'t justify exceptions',
                    'Lack of user understanding requires training, not exceptions'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 4, // Analyze
                'status' => 'published',
                'irt_a' => 1.2,
                'irt_b' => 0.4,
                'irt_c' => 0.2
            ],
            
            // Item 48 - Policy Governance and Management - L5 Evaluation - Type 4 Ordering
            [
                'topic' => 'Policy Governance and Management',
                'subtopic' => 'Policy Lifecycle Management',
                'question' => 'Arrange the following policy lifecycle steps in the correct order from first to last:',
                'type_id' => 4,
                'options' => [
                    'Monitoring and Compliance',
                    'Review and Approval',
                    'Communication and Training',
                    'Development/Drafting',
                    'Implementation and Enforcement',
                    'Initiation/Identify Need',
                    'Periodic Review and Update',
                    'Retirement/Decommissioning'
                ],
                'correct_options' => [
                    'Initiation/Identify Need',
                    'Development/Drafting',
                    'Review and Approval',
                    'Communication and Training',
                    'Implementation and Enforcement',
                    'Monitoring and Compliance',
                    'Periodic Review and Update',
                    'Retirement/Decommissioning'
                ],
                'justifications' => [
                    'The policy lifecycle begins with identifying the need for a new or updated policy',
                    'Once the need is identified, the policy is drafted with stakeholder input',
                    'The draft policy must be reviewed and approved by appropriate authorities',
                    'After approval, the policy is communicated to all affected parties with training',
                    'Implementation puts the policy into practice with supporting procedures',
                    'Ongoing monitoring ensures compliance and identifies violations',
                    'Periodic reviews keep the policy current with changing requirements',
                    'Eventually, obsolete policies are retired and archived'
                ],
                'difficulty_level' => 4,
                'bloom_level' => 5, // Evaluate
                'status' => 'published',
                'irt_a' => 1.5,
                'irt_b' => 1.0,
                'irt_c' => 0.2
            ],
            
            // Item 49 - Policy Governance and Management - L2 Comprehension
            [
                'topic' => 'Policy Governance and Management',
                'subtopic' => 'Policy Approval Workflows',
                'question' => 'Which of the following issues represents the HIGHEST potential risk to an organization\'s security governance framework?',
                'type_id' => 1,
                'options' => [
                    'The security policy is approved by the Security Administrator',
                    'The policy is distributed to staff only via email without confirmation of receipt',
                    'The policy omits references to regulatory compliance requirements',
                    'The policy has not been reviewed in over 12 months'
                ],
                'correct_options' => ['The security policy is approved by the Security Administrator'],
                'justifications' => [
                    'Correct - Security administrators lack the organizational authority to approve enterprise policies. This creates a fundamental governance flaw where policies lack business alignment and executive endorsement',
                    'While distribution tracking is important, it\'s a procedural issue that can be remedied',
                    'Missing regulatory references is concerning but can be addressed through policy updates',
                    'Annual reviews are recommended but a 12-month gap doesn\'t invalidate the governance structure itself'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2, // Understand
                'status' => 'published',
                'irt_a' => 1.0,
                'irt_b' => 0.0,
                'irt_c' => 0.2
            ],
            
            // Item 50 - Policy Governance and Management - L1 Knowledge
            [
                'topic' => 'Policy Governance and Management',
                'subtopic' => 'Policy Communication',
                'question' => 'What is the purpose of a policy exception process?',
                'type_id' => 1,
                'options' => [
                    'To bypass all security controls',
                    'To provide controlled flexibility when business needs conflict with policy',
                    'To eliminate the need for policies',
                    'To allow unlimited policy violations'
                ],
                'correct_options' => ['To provide controlled flexibility when business needs conflict with policy'],
                'justifications' => [
                    'Exceptions don\'t bypass controls, they manage risks',
                    'Correct - Exception processes balance security with business needs',
                    'Exceptions complement policies, not replace them',
                    'Exceptions must be controlled and limited'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 1, // Remember
                'status' => 'published',
                'irt_a' => 0.9,
                'irt_b' => -1.1,
                'irt_c' => 0.2
            ]
        ];
    }
}