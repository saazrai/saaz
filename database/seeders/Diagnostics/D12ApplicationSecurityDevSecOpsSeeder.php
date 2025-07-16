<?php

namespace Database\Seeders\Diagnostics;

use App\Models\DiagnosticItem;
use App\Models\DiagnosticTopic;


use Illuminate\Database\Seeder;

class D12ApplicationSecurityDevSecOpsSeeder extends Seeder
{
    public function run(): void
    {
        // Get reference data
        $topics = DiagnosticTopic::whereHas('domain', function($query) {
            $query->where('name', 'Application Security & DevSecOps');
        })->pluck('id', 'name');
        
        
        $items = [
            // Secure SDLC & Security Gates - 6 items
            [
                'topic_id' => $topics['Secure SDLC & Security Gates'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'At which phase of the SDLC should threat modeling be performed?',
                'options' => [
                    'Requirements phase',
                    'Design phase',
                    'Implementation phase',
                    'Testing phase'
                ],
                'correct_options' => ['Design phase'],
                'justifications' => [
                    'Requirements phase is too early, design not yet defined',
                    'Correct - Design phase allows threats to be addressed before coding',
                    'Implementation phase is too late, design already fixed',
                    'Testing phase is reactive, not proactive'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Secure SDLC & Security Gates'] ?? 1,
                'type_id' => 3,
                'dimension' => 'Technical',
                'content' => 'Drag the security activities that should occur during the **Requirements phase** to the drop zone:',
                'options' => [
                    'Security requirements gathering',
                    'Threat modeling',
                    'Risk assessment',
                    'Code review',
                    'Compliance requirements identification',
                    'Penetration testing'
                ],
                'correct_options' => ['Security requirements gathering', 'Risk assessment', 'Compliance requirements identification'],
                'justifications' => [
                    'Security requirements must be defined early',
                    'Threat modeling happens during design phase',
                    'Risk assessment helps prioritize security requirements',
                    'Code review happens during implementation',
                    'Compliance requirements drive security needs',
                    'Penetration testing occurs during testing phase'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Secure SDLC & Security Gates'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What is a security gate in the context of Secure SDLC?',
                'options' => [
                    'A firewall protecting development environments',
                    'A checkpoint requiring security approval before proceeding',
                    'An authentication mechanism for developers',
                    'A tool for scanning source code'
                ],
                'correct_options' => ['A checkpoint requiring security approval before proceeding'],
                'justifications' => [
                    'Gates are process controls, not network controls',
                    'Correct - Gates ensure security criteria are met between phases',
                    'Gates are process checkpoints, not access controls',
                    'Gates are decision points, not scanning tools'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Secure SDLC & Security Gates'] ?? 1,
                'type_id' => 4,
                'dimension' => 'Technical',
                'content' => 'Arrange these Secure SDLC activities in their typical chronological order:',
                'options' => [
                    'Security testing',
                    'Security requirements',
                    'Secure coding',
                    'Threat modeling',
                    'Security training'
                ],
                'correct_options' => [
                    'Security training',
                    'Security requirements',
                    'Threat modeling',
                    'Secure coding',
                    'Security testing'
                ],
                'justifications' => ['Training prepares the team, requirements define needs, threat modeling identifies risks during design, secure coding implements controls, and testing validates security.'],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Secure SDLC & Security Gates'] ?? 1,
                'type_id' => 2,
                'dimension' => 'Technical',
                'content' => '**True or False:** Security activities in SDLC should only occur during the testing phase to avoid slowing down development.',
                'options' => [
                    'True',
                    'False'
                ],
                'correct_options' => ['False'],
                'justifications' => [
                    'explanation' => 'Security must be integrated throughout all SDLC phases. Waiting until testing is too late and more expensive to fix vulnerabilities. The "shift left" approach integrates security early and continuously.'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Secure SDLC & Security Gates'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Which metric best measures the effectiveness of Secure SDLC implementation?',
                'options' => [
                    'Number of security tools deployed',
                    'Reduction in vulnerabilities found in production',
                    'Lines of code reviewed',
                    'Number of security gates passed'
                ],
                'correct_options' => ['Reduction in vulnerabilities found in production'],
                'justifications' => [
                    'Tool count doesn\'t indicate effectiveness',
                    'Correct - Fewer production vulnerabilities shows SDLC success',
                    'Code review volume doesn\'t measure quality',
                    'Gate passage doesn\'t guarantee security improvement'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 5,
                'status' => 'published'
            ],

            // DevSecOps & CI/CD Pipeline Security - 7 items
            [
                'topic_id' => $topics['DevSecOps & CI/CD Pipeline Security'] ?? 2,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What is the primary principle of DevSecOps?',
                'options' => [
                    'Security team controls all deployments',
                    'Developers handle all security tasks',
                    'Security is everyone\'s responsibility',
                    'Operations team manages security'
                ],
                'correct_options' => ['Security is everyone\'s responsibility'],
                'justifications' => [
                    'DevSecOps breaks down silos, not creates them',
                    'Security is shared, not solely developer responsibility',
                    'Correct - DevSecOps makes security a shared responsibility',
                    'Operations is part of the team, not sole owner'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['DevSecOps & CI/CD Pipeline Security'] ?? 2,
                'type_id' => 3,
                'dimension' => 'Technical',
                'content' => 'Drag the security controls that should be integrated into a CI/CD pipeline to the drop zone:',
                'options' => [
                    'Static code analysis (SAST)',
                    'Manual code review only',
                    'Dependency vulnerability scanning',
                    'Annual penetration testing',
                    'Container image scanning',
                    'Infrastructure as Code scanning'
                ],
                'correct_options' => ['Static code analysis (SAST)', 'Dependency vulnerability scanning', 'Container image scanning', 'Infrastructure as Code scanning'],
                'justifications' => [
                    'SAST can be automated in pipelines',
                    'Manual-only reviews can\'t scale in CI/CD',
                    'Dependencies should be scanned automatically',
                    'Annual testing is too infrequent for CI/CD',
                    'Container scanning is essential for containerized apps',
                    'IaC scanning prevents infrastructure misconfigurations'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['DevSecOps & CI/CD Pipeline Security'] ?? 2,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Where should secrets (API keys, passwords) be stored in a CI/CD pipeline?',
                'options' => [
                    'In the source code repository',
                    'In environment variables',
                    'In a dedicated secrets management system',
                    'In configuration files'
                ],
                'correct_options' => ['In a dedicated secrets management system'],
                'justifications' => [
                    'Never store secrets in source control',
                    'Environment variables can be exposed in logs',
                    'Correct - Secrets managers provide secure storage and rotation',
                    'Config files can be accidentally exposed'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['DevSecOps & CI/CD Pipeline Security'] ?? 2,
                'type_id' => 7,
                'dimension' => 'Technical',
                'content' => 'Using the pipeline security scanner, identify the security issue in this CI/CD configuration:',
                'options' => [
                    'No code signing configured',
                    'Hardcoded credentials detected',
                    'Missing dependency scanning',
                    'Outdated build tools'
                ],
                'correct_options' => ['Hardcoded credentials detected'],
                'justifications' => [
                    'Code signing is important but not critical',
                    'Correct - Hardcoded credentials are a critical security risk',
                    'Dependency scanning is important but not shown as issue',
                    'Outdated tools are concerning but not immediate risk'
                ],
                'settings' => [
                    'shell' => 'pipeline-scan',
                    'commands' => [
                        [
                            'pattern' => '^scan --config$',
                            'response' => "Scanning CI/CD pipeline configuration...\n[OK] Build stage configured\n[CRITICAL] Hardcoded AWS credentials found in deploy.sh\n  AWS_ACCESS_KEY=AKIAIOSFODNN7EXAMPLE\n  AWS_SECRET_KEY=wJalrXUtnFEMI/K7MDENG/bPxRfiCYEXAMPLEKEY\n[OK] Test stage includes unit tests\n[WARNING] No artifact signing configured",
                            'isError' => false
                        ]
                    ]
                ],
                'difficulty_level' => 2,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['DevSecOps & CI/CD Pipeline Security'] ?? 2,
                'type_id' => 2,
                'dimension' => 'Technical',
                'content' => '**True or False:** In DevSecOps, security testing should only occur after code is merged to the main branch.',
                'options' => [
                    'True',
                    'False'
                ],
                'correct_options' => ['False'],
                'justifications' => [
                    'explanation' => 'Security testing should occur as early as possible, including on feature branches and pull requests before merging. This "shift left" approach catches vulnerabilities early when they are easier and cheaper to fix.'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['DevSecOps & CI/CD Pipeline Security'] ?? 2,
                'type_id' => 5,
                'dimension' => 'Technical',
                'content' => 'Match each DevSecOps practice with its primary benefit:',
                'options' => [
                    'items' => [
                        'Infrastructure as Code',
                        'Automated security testing',
                        'Immutable infrastructure',
                        'Continuous monitoring'
                    ],
                    'responses' => [
                        'Consistent, auditable configurations',
                        'Early vulnerability detection',
                        'Reduced configuration drift',
                        'Real-time threat detection'
                    ]
                ],
                'correct_options' => [
                    'Infrastructure as Code' => 'Consistent, auditable configurations',
                    'Automated security testing' => 'Early vulnerability detection',
                    'Immutable infrastructure' => 'Reduced configuration drift',
                    'Continuous monitoring' => 'Real-time threat detection'
                ],
                'justifications' => [
                    'Infrastructure as Code' => 'IaC provides version-controlled, repeatable infrastructure',
                    'Automated security testing' => 'Automation catches issues early in development',
                    'Immutable infrastructure' => 'Replacing rather than patching prevents drift',
                    'Continuous monitoring' => 'Constant monitoring enables quick response'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['DevSecOps & CI/CD Pipeline Security'] ?? 2,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What is the "shift left" approach in DevSecOps?',
                'options' => [
                    'Moving servers to the left side of the data center',
                    'Performing security activities earlier in development',
                    'Shifting security responsibility to developers only',
                    'Using left-aligned code formatting'
                ],
                'correct_options' => ['Performing security activities earlier in development'],
                'justifications' => [
                    'This has nothing to do with physical placement',
                    'Correct - "Shift left" means moving security earlier in SDLC',
                    'It\'s about timing, not shifting all responsibility',
                    'This has nothing to do with code formatting'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 3,
                'status' => 'published'
            ],

            // Agile & Security User Stories - 5 items
            [
                'topic_id' => $topics['Agile & Security User Stories'] ?? 3,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'How should security requirements be incorporated into Agile development?',
                'options' => [
                    'As a separate security sprint at the end',
                    'As security user stories in the backlog',
                    'Only during hardening phases',
                    'Through annual security reviews'
                ],
                'correct_options' => ['As security user stories in the backlog'],
                'justifications' => [
                    'Separate security sprints create silos',
                    'Correct - Security stories integrate naturally into Agile flow',
                    'Hardening phases are anti-patterns in Agile',
                    'Annual reviews are too infrequent for Agile'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Agile & Security User Stories'] ?? 3,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Which format is recommended for security user stories?',
                'options' => [
                    'As technical specifications only',
                    'As a [role], I want [feature] so that [benefit]',
                    'As a list of security controls',
                    'As compliance checkboxes'
                ],
                'correct_options' => ['As a [role], I want [feature] so that [benefit]'],
                'justifications' => [
                    'Technical specs don\'t capture user value',
                    'Correct - Standard user story format works for security too',
                    'Control lists don\'t explain the "why"',
                    'Compliance checkboxes lack context and value'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Agile & Security User Stories'] ?? 3,
                'type_id' => 3,
                'dimension' => 'Technical',
                'content' => 'Drag the characteristics of good security user stories to the drop zone:',
                'options' => [
                    'Specific acceptance criteria',
                    'Technical implementation details',
                    'Clear business value',
                    'Compliance requirements only',
                    'Testable security outcomes',
                    'Vague security goals'
                ],
                'correct_options' => ['Specific acceptance criteria', 'Clear business value', 'Testable security outcomes'],
                'justifications' => [
                    'Acceptance criteria make stories verifiable',
                    'Implementation details belong in tasks, not stories',
                    'Business value justifies the security work',
                    'Compliance alone doesn\'t convey value',
                    'Testability ensures stories can be completed',
                    'Vague goals cannot be implemented or tested'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Agile & Security User Stories'] ?? 3,
                'type_id' => 2,
                'dimension' => 'Technical',
                'content' => '**True or False:** Security champions should write all security user stories for the development team.',
                'options' => [
                    'True',
                    'False'
                ],
                'correct_options' => ['False'],
                'justifications' => [
                    'explanation' => 'Security user stories should be collaborative efforts between security champions, developers, and product owners. This ensures stories are both secure and implementable while maintaining team ownership.'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Agile & Security User Stories'] ?? 3,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'When should security acceptance criteria be defined for user stories?',
                'options' => [
                    'After development is complete',
                    'During sprint planning',
                    'During story creation/refinement',
                    'During testing phase'
                ],
                'correct_options' => ['During story creation/refinement'],
                'justifications' => [
                    'Too late to influence development',
                    'Sprint planning is for estimation, not definition',
                    'Correct - Define criteria when creating/refining stories',
                    'Testing phase is too late for criteria definition'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],

            // OWASP Top 10 - 8 items
            [
                'topic_id' => $topics['OWASP Top 10'] ?? 4,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Which vulnerability has consistently been #1 on the OWASP Top 10?',
                'options' => [
                    'Cross-Site Scripting (XSS)',
                    'Injection',
                    'Broken Authentication',
                    'Security Misconfiguration'
                ],
                'correct_options' => ['Injection'],
                'justifications' => [
                    'XSS is common but not consistently #1',
                    'Correct - Injection (especially SQL injection) has been #1 for years',
                    'Authentication issues are serious but not #1',
                    'Misconfiguration is common but not the top risk'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['OWASP Top 10'] ?? 4,
                'type_id' => 5,
                'dimension' => 'Technical',
                'content' => 'Match each attack with its OWASP Top 10 category:',
                'options' => [
                    'items' => [
                        'SQL Injection',
                        'Session hijacking',
                        'Directory traversal',
                        'Outdated libraries'
                    ],
                    'responses' => [
                        'A01:2021 - Broken Access Control',
                        'A03:2021 - Injection',
                        'A07:2021 - Identification and Authentication Failures',
                        'A06:2021 - Vulnerable and Outdated Components'
                    ]
                ],
                'correct_options' => [
                    'SQL Injection' => 'A03:2021 - Injection',
                    'Session hijacking' => 'A07:2021 - Identification and Authentication Failures',
                    'Directory traversal' => 'A01:2021 - Broken Access Control',
                    'Outdated libraries' => 'A06:2021 - Vulnerable and Outdated Components'
                ],
                'justifications' => [
                    'SQL Injection' => 'SQL injection is the classic injection attack',
                    'Session hijacking' => 'Session attacks are authentication failures',
                    'Directory traversal' => 'Path traversal is an access control failure',
                    'Outdated libraries' => 'Old libraries have known vulnerabilities'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['OWASP Top 10'] ?? 4,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What is the primary defense against Cross-Site Scripting (XSS)?',
                'options' => [
                    'Using HTTPS',
                    'Input validation and output encoding',
                    'Strong passwords',
                    'Firewall rules'
                ],
                'correct_options' => ['Input validation and output encoding'],
                'justifications' => [
                    'HTTPS doesn\'t prevent XSS attacks',
                    'Correct - Validate input and encode output prevents script injection',
                    'Passwords don\'t relate to XSS',
                    'Firewalls don\'t stop XSS attacks'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['OWASP Top 10'] ?? 4,
                'type_id' => 7,
                'dimension' => 'Technical',
                'content' => 'Using the vulnerability scanner, identify which OWASP Top 10 vulnerability is present:',
                'options' => [
                    'A01: Broken Access Control',
                    'A02: Cryptographic Failures',
                    'A03: Injection',
                    'A04: Insecure Design'
                ],
                'correct_options' => ['A03: Injection'],
                'justifications' => [
                    'No access control issues shown',
                    'No cryptographic problems indicated',
                    'Correct - User input directly in SQL query indicates injection vulnerability',
                    'This is implementation, not design issue'
                ],
                'settings' => [
                    'shell' => 'vuln-scanner',
                    'commands' => [
                        [
                            'pattern' => '^scan --code$',
                            'response' => "Scanning application code...\n[CRITICAL] SQL Injection vulnerability detected\nFile: user_auth.php, Line 42\nCode: \$query = \"SELECT * FROM users WHERE username = '\" . \$_POST['username'] . \"'\";\n[WARNING] User input directly concatenated into SQL query\n[RISK] Attacker can manipulate query to bypass authentication",
                            'isError' => false
                        ]
                    ]
                ],
                'difficulty_level' => 1,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['OWASP Top 10'] ?? 4,
                'type_id' => 3,
                'dimension' => 'Technical',
                'content' => 'Drag the vulnerabilities that involve **injection** attacks to the drop zone:',
                'options' => [
                    'SQL Injection',
                    'Broken Authentication',
                    'Command Injection',
                    'Insecure Deserialization',
                    'LDAP Injection',
                    'Missing Security Headers'
                ],
                'correct_options' => ['SQL Injection', 'Command Injection', 'LDAP Injection'],
                'justifications' => [
                    'SQL injection injects malicious SQL code',
                    'Authentication is about identity, not injection',
                    'Command injection executes system commands',
                    'Deserialization is object manipulation, not injection',
                    'LDAP injection manipulates directory queries',
                    'Headers are configuration, not injection'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['OWASP Top 10'] ?? 4,
                'type_id' => 2,
                'dimension' => 'Technical',
                'content' => '**True or False:** CSRF (Cross-Site Request Forgery) attacks can be prevented using only client-side validation.',
                'options' => [
                    'True',
                    'False'
                ],
                'correct_options' => ['False'],
                'justifications' => [
                    'explanation' => 'CSRF attacks bypass client-side controls by tricking the browser into making requests. Prevention requires server-side controls like CSRF tokens, SameSite cookies, or checking referrer headers.'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['OWASP Top 10'] ?? 4,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Which security header helps prevent XSS attacks by controlling script execution?',
                'options' => [
                    'X-Frame-Options',
                    'Content-Security-Policy',
                    'Strict-Transport-Security',
                    'X-Content-Type-Options'
                ],
                'correct_options' => ['Content-Security-Policy'],
                'justifications' => [
                    'X-Frame-Options prevents clickjacking, not XSS',
                    'Correct - CSP controls which scripts can execute',
                    'HSTS enforces HTTPS, doesn\'t prevent XSS',
                    'This prevents MIME sniffing, not XSS'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['OWASP Top 10'] ?? 4,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'An application stores passwords using MD5 hashing. Which OWASP Top 10 category does this violate?',
                'options' => [
                    'A01: Broken Access Control',
                    'A02: Cryptographic Failures',
                    'A04: Insecure Design',
                    'A05: Security Misconfiguration'
                ],
                'correct_options' => ['A02: Cryptographic Failures'],
                'justifications' => [
                    'This is a cryptography issue, not access control',
                    'Correct - Using weak hashing (MD5) is a cryptographic failure',
                    'This is implementation, not design',
                    'This is a cryptographic choice, not configuration'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 5,
                'status' => 'published'
            ],

            // Application Security Testing - 7 items
            [
                'topic_id' => $topics['Application Security Testing'] ?? 5,
                'type_id' => 5,
                'dimension' => 'Technical',
                'content' => 'Match each testing type with its characteristic:',
                'options' => [
                    'items' => [
                        'SAST',
                        'DAST',
                        'IAST',
                        'RASP'
                    ],
                    'responses' => [
                        'Analyzes source code without execution',
                        'Tests running application from outside',
                        'Monitors application during testing',
                        'Protects application at runtime'
                    ]
                ],
                'correct_options' => [
                    'SAST' => 'Analyzes source code without execution',
                    'DAST' => 'Tests running application from outside',
                    'IAST' => 'Monitors application during testing',
                    'RASP' => 'Protects application at runtime'
                ],
                'justifications' => [
                    'SAST' => 'Static testing examines code without running it',
                    'DAST' => 'Dynamic testing probes running application',
                    'IAST' => 'Interactive testing combines static and dynamic',
                    'RASP' => 'Runtime protection blocks attacks in production'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Application Security Testing'] ?? 5,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What is a key advantage of SAST over DAST?',
                'options' => [
                    'Tests the actual runtime behavior',
                    'Finds vulnerabilities early in development',
                    'No false positives',
                    'Requires no source code access'
                ],
                'correct_options' => ['Finds vulnerabilities early in development'],
                'justifications' => [
                    'DAST tests runtime, not SAST',
                    'Correct - SAST can run on code before deployment',
                    'SAST often has more false positives than DAST',
                    'SAST requires source code access'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Application Security Testing'] ?? 5,
                'type_id' => 3,
                'dimension' => 'Technical',
                'content' => 'Drag the testing types that require **source code access** to the drop zone:',
                'options' => [
                    'Static Application Security Testing (SAST)',
                    'Dynamic Application Security Testing (DAST)',
                    'Software Composition Analysis (SCA)',
                    'Penetration Testing',
                    'Code Review',
                    'Fuzzing'
                ],
                'correct_options' => ['Static Application Security Testing (SAST)', 'Software Composition Analysis (SCA)', 'Code Review'],
                'justifications' => [
                    'SAST analyzes source code directly',
                    'DAST tests running app without source',
                    'SCA examines code dependencies',
                    'Pen testing typically black-box',
                    'Code review requires reading source',
                    'Fuzzing tests inputs, not source'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Application Security Testing'] ?? 5,
                'type_id' => 2,
                'dimension' => 'Technical',
                'content' => '**True or False:** IAST (Interactive Application Security Testing) can replace both SAST and DAST completely.',
                'options' => [
                    'True',
                    'False'
                ],
                'correct_options' => ['False'],
                'justifications' => [
                    'explanation' => 'While IAST combines elements of both SAST and DAST, it cannot completely replace them. SAST can find issues in dead code that might not execute during testing, and DAST can test from an attacker\'s perspective. Each method has unique strengths.'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 5,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Application Security Testing'] ?? 5,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'When should Software Composition Analysis (SCA) be performed?',
                'options' => [
                    'Only before major releases',
                    'Continuously as part of CI/CD',
                    'Only when adding new dependencies',
                    'Annually during audits'
                ],
                'correct_options' => ['Continuously as part of CI/CD'],
                'justifications' => [
                    'Vulnerabilities can be discovered anytime',
                    'Correct - Continuous scanning catches new vulnerabilities quickly',
                    'Existing dependencies can develop vulnerabilities',
                    'Annual checks miss critical windows'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Application Security Testing'] ?? 5,
                'type_id' => 4,
                'dimension' => 'Technical',
                'content' => 'Arrange these testing activities from earliest to latest in the SDLC:',
                'options' => [
                    'Penetration testing',
                    'Threat modeling',
                    'SAST scanning',
                    'DAST scanning',
                    'Security requirements review'
                ],
                'correct_options' => [
                    'Security requirements review',
                    'Threat modeling',
                    'SAST scanning',
                    'DAST scanning',
                    'Penetration testing'
                ],
                'justifications' => ['Requirements come first, then design-phase threat modeling, followed by SAST during coding, DAST on deployed app, and finally penetration testing on complete system.'],
                'difficulty_level' => 3,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Application Security Testing'] ?? 5,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What type of vulnerabilities is RASP (Runtime Application Self-Protection) best suited to prevent?',
                'options' => [
                    'Hardcoded credentials',
                    'Zero-day exploits in production',
                    'Missing security headers',
                    'Outdated dependencies'
                ],
                'correct_options' => ['Zero-day exploits in production'],
                'justifications' => [
                    'Hardcoded credentials need code fixes',
                    'Correct - RASP can block unknown attacks at runtime',
                    'Headers are configuration, not runtime attacks',
                    'Dependencies need updating, not runtime protection'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 2,
                'status' => 'published'
            ],

            // Secure Coding Standards - 6 items
            [
                'topic_id' => $topics['Secure Coding Standards'] ?? 6,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What is the most important principle for preventing injection attacks?',
                'options' => [
                    'Input validation only',
                    'Output encoding only',
                    'Parameterized queries and input validation',
                    'Encryption of all data'
                ],
                'correct_options' => ['Parameterized queries and input validation'],
                'justifications' => [
                    'Input validation alone can be bypassed',
                    'Output encoding prevents XSS, not SQL injection',
                    'Correct - Parameterized queries prevent injection, validation adds defense',
                    'Encryption doesn\'t prevent injection'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Secure Coding Standards'] ?? 6,
                'type_id' => 3,
                'dimension' => 'Technical',
                'content' => 'Drag the secure coding practices that help prevent **buffer overflow** attacks to the drop zone:',
                'options' => [
                    'Bounds checking',
                    'Using managed languages',
                    'Input encoding',
                    'Safe string functions',
                    'HTTPS only',
                    'Stack canaries'
                ],
                'correct_options' => ['Bounds checking', 'Using managed languages', 'Safe string functions', 'Stack canaries'],
                'justifications' => [
                    'Bounds checking prevents writing beyond buffers',
                    'Managed languages handle memory automatically',
                    'Encoding is for XSS, not buffer overflows',
                    'Safe functions prevent overflows (strncpy vs strcpy)',
                    'HTTPS is transport security, not memory safety',
                    'Stack canaries detect buffer overflow attempts'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Secure Coding Standards'] ?? 6,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Which error handling practice can lead to information disclosure?',
                'options' => [
                    'Logging errors to a file',
                    'Displaying stack traces to users',
                    'Using generic error messages',
                    'Catching all exceptions'
                ],
                'correct_options' => ['Displaying stack traces to users'],
                'justifications' => [
                    'Logging is internal, not user-facing',
                    'Correct - Stack traces reveal system internals to attackers',
                    'Generic messages hide sensitive details',
                    'Catching exceptions is good practice'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Secure Coding Standards'] ?? 6,
                'type_id' => 2,
                'dimension' => 'Technical',
                'content' => '**True or False:** Client-side input validation is sufficient to prevent malicious input.',
                'options' => [
                    'True',
                    'False'
                ],
                'correct_options' => ['False'],
                'justifications' => [
                    'explanation' => 'Client-side validation can be easily bypassed by attackers using proxy tools or by disabling JavaScript. Server-side validation is essential for security, while client-side validation improves user experience.'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Secure Coding Standards'] ?? 6,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What is the principle of "fail securely" in error handling?',
                'options' => [
                    'Always grant access on error',
                    'Default to denying access on error',
                    'Ignore all errors',
                    'Retry operations indefinitely'
                ],
                'correct_options' => ['Default to denying access on error'],
                'justifications' => [
                    'Granting access on error is fail open (insecure)',
                    'Correct - Fail secure means deny by default when errors occur',
                    'Ignoring errors leads to unpredictable behavior',
                    'Infinite retries can cause DoS'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Secure Coding Standards'] ?? 6,
                'type_id' => 7,
                'dimension' => 'Technical',
                'content' => 'Review this code and identify the secure coding violation:',
                'options' => [
                    'Hardcoded credentials',
                    'SQL injection vulnerability',
                    'Missing input validation',
                    'Insecure random number generation'
                ],
                'correct_options' => ['Insecure random number generation'],
                'justifications' => [
                    'No credentials shown in the code',
                    'No SQL queries present',
                    'This is about randomness, not validation',
                    'Correct - Math.random() is not cryptographically secure for tokens'
                ],
                'settings' => [
                    'shell' => 'code-review',
                    'commands' => [
                        [
                            'pattern' => '^analyze$',
                            'response' => "function generateSessionToken() {\n    let token = '';\n    for (let i = 0; i < 32; i++) {\n        token += Math.floor(Math.random() * 16).toString(16);\n    }\n    return token;\n}\n\n[WARNING] Using Math.random() for security-sensitive operations\n[ISSUE] Predictable random values can be exploited",
                            'isError' => false
                        ]
                    ]
                ],
                'difficulty_level' => 3,
                'bloom_level' => 4,
                'status' => 'published'
            ],

            // API Security - 6 items
            [
                'topic_id' => $topics['API Security'] ?? 7,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Which authentication method is recommended for RESTful APIs?',
                'options' => [
                    'Basic authentication over HTTP',
                    'API keys in URL parameters',
                    'OAuth 2.0 with JWT tokens',
                    'Session cookies'
                ],
                'correct_options' => ['OAuth 2.0 with JWT tokens'],
                'justifications' => [
                    'Basic auth over HTTP exposes credentials',
                    'API keys in URLs get logged and cached',
                    'Correct - OAuth 2.0 with JWT provides secure, stateless auth',
                    'Sessions don\'t work well for stateless APIs'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['API Security'] ?? 7,
                'type_id' => 3,
                'dimension' => 'Technical',
                'content' => 'Drag the security controls that should be implemented for API protection to the drop zone:',
                'options' => [
                    'Rate limiting',
                    'Unlimited access for authenticated users',
                    'Input validation',
                    'API versioning',
                    'CORS configuration',
                    'Exposing all database fields'
                ],
                'correct_options' => ['Rate limiting', 'Input validation', 'API versioning', 'CORS configuration'],
                'justifications' => [
                    'Rate limiting prevents abuse and DoS',
                    'Even authenticated users need limits',
                    'Input validation prevents injection attacks',
                    'Versioning allows secure API evolution',
                    'CORS controls cross-origin access',
                    'Never expose all fields (information disclosure)'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['API Security'] ?? 7,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What is the primary purpose of API rate limiting?',
                'options' => [
                    'Improve API performance',
                    'Prevent abuse and ensure availability',
                    'Reduce server costs',
                    'Simplify API design'
                ],
                'correct_options' => ['Prevent abuse and ensure availability'],
                'justifications' => [
                    'Rate limiting may reduce performance for individual users',
                    'Correct - Prevents DoS and ensures fair resource usage',
                    'Cost reduction is a side benefit, not primary purpose',
                    'Rate limiting adds complexity, doesn\'t simplify'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['API Security'] ?? 7,
                'type_id' => 2,
                'dimension' => 'Technical',
                'content' => '**True or False:** GraphQL APIs are inherently more secure than REST APIs.',
                'options' => [
                    'True',
                    'False'
                ],
                'correct_options' => ['False'],
                'justifications' => [
                    'explanation' => 'Neither GraphQL nor REST is inherently more secure. GraphQL can introduce unique risks like query depth attacks and information disclosure through introspection. Security depends on implementation, not the API style.'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 5,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['API Security'] ?? 7,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Which HTTP header should be used to prevent MIME type sniffing in API responses?',
                'options' => [
                    'X-Content-Type-Options: nosniff',
                    'X-Frame-Options: DENY',
                    'Content-Security-Policy: default-src',
                    'Strict-Transport-Security: max-age'
                ],
                'correct_options' => ['X-Content-Type-Options: nosniff'],
                'justifications' => [
                    'Correct - This header prevents MIME type sniffing',
                    'X-Frame-Options prevents clickjacking',
                    'CSP controls resource loading',
                    'HSTS enforces HTTPS usage'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['API Security'] ?? 7,
                'type_id' => 5,
                'dimension' => 'Technical',
                'content' => 'Match each API security threat with its mitigation:',
                'options' => [
                    'items' => [
                        'Broken object level authorization',
                        'Excessive data exposure',
                        'Lack of resources & rate limiting',
                        'Mass assignment'
                    ],
                    'responses' => [
                        'Implement proper access controls',
                        'Filter response data',
                        'Implement rate limiting',
                        'Whitelist allowed properties'
                    ]
                ],
                'correct_options' => [
                    'Broken object level authorization' => 'Implement proper access controls',
                    'Excessive data exposure' => 'Filter response data',
                    'Lack of resources & rate limiting' => 'Implement rate limiting',
                    'Mass assignment' => 'Whitelist allowed properties'
                ],
                'justifications' => [
                    'Broken object level authorization' => 'Check user permissions for each object access',
                    'Excessive data exposure' => 'Only return necessary fields in responses',
                    'Lack of resources & rate limiting' => 'Rate limiting prevents resource exhaustion',
                    'Mass assignment' => 'Only allow specific fields to be updated'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],

            // Additional questions to reach 50 total and balance Bloom levels
            [
                'topic_id' => $topics['DevSecOps & CI/CD Pipeline Security'] ?? 2,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Compare the security implications of implementing secrets management in containers versus traditional servers. Which statement best evaluates the key differences?',
                'options' => [
                    'Containers have no security advantages for secrets management',
                    'Container secrets are automatically more secure due to isolation',
                    'Container environments require different approaches due to ephemeral nature and orchestration complexity',
                    'Traditional servers always provide better secrets security'
                ],
                'correct_options' => ['Container environments require different approaches due to ephemeral nature and orchestration complexity'],
                'justifications' => [
                    'Containers can provide security advantages when properly configured',
                    'Container isolation alone doesn\'t guarantee secrets security',
                    'Correct - Container ephemeral nature and orchestration require specialized secrets management approaches',
                    'Security depends on implementation, not the platform type'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 5,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['OWASP Top 10'] ?? 4,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Analyze this security scenario: An application validates input on the client side and uses parameterized queries, but still suffers from XSS attacks. What is the most likely root cause?',
                'options' => [
                    'Parameterized queries are ineffective against XSS',
                    'Client-side validation was bypassed and output encoding is missing',
                    'The application needs stronger input validation rules',
                    'XSS attacks cannot be prevented with current technology'
                ],
                'correct_options' => ['Client-side validation was bypassed and output encoding is missing'],
                'justifications' => [
                    'Parameterized queries prevent SQL injection, not XSS',
                    'Correct - XSS occurs when user input is displayed without proper output encoding',
                    'Input validation alone is insufficient for XSS prevention',
                    'XSS is preventable with proper output encoding and CSP'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Application Security Testing'] ?? 5,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Evaluate the effectiveness of different testing strategies: A team uses only SAST tools and claims 100% security coverage. What is the primary limitation of this approach?',
                'options' => [
                    'SAST provides complete security testing coverage',
                    'SAST cannot detect runtime vulnerabilities and configuration issues',
                    'SAST is too expensive to justify the coverage',
                    'SAST tools have no false positives'
                ],
                'correct_options' => ['SAST cannot detect runtime vulnerabilities and configuration issues'],
                'justifications' => [
                    'No single testing method provides 100% coverage',
                    'Correct - SAST misses runtime issues, environment configs, and deployment vulnerabilities',
                    'Cost is not the primary limitation here',
                    'SAST tools typically generate false positives'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 5,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Secure Coding Standards'] ?? 6,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'A developer claims that using HTTPS makes input validation unnecessary since data is encrypted in transit. Analyze this reasoning and identify the flaw.',
                'options' => [
                    'The reasoning is correct - HTTPS provides complete input security',
                    'HTTPS only protects data in transit, not against malicious input processing',
                    'HTTPS and input validation serve the same security purpose',
                    'Input validation is only needed for HTTP connections'
                ],
                'correct_options' => ['HTTPS only protects data in transit, not against malicious input processing'],
                'justifications' => [
                    'HTTPS doesn\'t validate or sanitize input content',
                    'Correct - HTTPS protects transport, but malicious input still needs validation/sanitization',
                    'HTTPS and input validation address different threat vectors',
                    'Input validation is needed regardless of transport security'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['API Security'] ?? 7,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Evaluate this API security architecture: An API uses OAuth 2.0 for authentication, but implements custom authorization logic in each endpoint. What security risk does this create?',
                'options' => [
                    'OAuth 2.0 handles both authentication and authorization completely',
                    'Custom authorization increases inconsistency and bypass risk',
                    'This is the recommended approach for API security',
                    'Authorization logic should never be centralized'
                ],
                'correct_options' => ['Custom authorization increases inconsistency and bypass risk'],
                'justifications' => [
                    'OAuth 2.0 handles authentication; authorization is separate',
                    'Correct - Distributed custom logic leads to inconsistencies and security gaps',
                    'Centralized authorization policies are preferred for consistency',
                    'Centralized authorization reduces errors and improves maintainability'
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
        
        $this->command->info('Domain 12 (Application Security & DevSecOps) diagnostic items seeded successfully!');
    }
}