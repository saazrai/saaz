<?php

namespace Database\Seeders\Diagnostics;

class D13ApplicationSecuritySeeder extends BaseDiagnosticSeeder
{
    protected string $domainName = 'Application Security';

    protected function getQuestions(): array
    {
        return [
            // Topic 1: Secure Development Fundamentals (10 questions)
            // Bloom Distribution: L1:1, L2:2, L3:3, L4:2, L5:2

            // Item 1 - L1 - Remember
            [
                'topic' => 'Secure Development Fundamentals',
                'subtopic' => 'Secure Software Development Lifecycle (SSDLC)',
                'question' => 'What is the primary goal of implementing a Secure Software Development Lifecycle (SSDLC)?',
                'options' => [
                    'Reducing development costs and time to market',
                    'Integrating security practices throughout the development process',
                    'Improving application performance and scalability',
                    'Simplifying testing and deployment procedures',
                ],
                'correct_options' => ['Integrating security practices throughout the development process'],
                'justifications' => [
                    'Incorrect - Reducing development costs and time to market',
                    'Correct - Integrating security practices throughout the development process',
                    'Incorrect - Improving application performance and scalability',
                    'Incorrect - Simplifying testing and deployment procedures',
                ],
                'bloom_level' => 1,
                'difficulty_level' => 1,
                'status' => 'published',
                'type_id' => 1,
                'irt_a' => 0.8,
                'irt_b' => -1.5,
                'irt_c' => 0.25,
            ],

            // Item 2 - L2 - Understand
            [
                'topic' => 'Secure Development Fundamentals',
                'subtopic' => 'Secure Software Development Lifecycle (SSDLC)',
                'question' => 'At which SDLC phase should security requirements be gathered to ensure secure design?',
                'options' => [
                    'Implementation',
                    'Requirements gathering',
                    'Testing',
                    'Maintenance',
                ],
                'correct_options' => ['Requirements gathering'],
                'justifications' => [
                    'Incorrect - Implementation phase is too late to gather security requirements. At this stage, developers are already coding based on established requirements and design decisions. Introducing security requirements during implementation leads to costly retrofitting, architectural compromises, and may result in security controls that are poorly integrated with the overall system design.',
                    'Correct - Requirements gathering is the optimal phase to collect security requirements because it enables security to be built into the foundation of the application architecture. During this phase, security requirements can be analyzed alongside functional requirements, ensuring that security considerations influence design decisions from the beginning. This approach supports security-by-design principles and prevents costly security retrofitting later in the development cycle.',
                    'Incorrect - Testing phase is far too late to gather security requirements. By this stage, the application design and implementation are largely complete, making it extremely expensive and technically challenging to implement fundamental security requirements. Testing should validate that previously established security requirements have been properly implemented, not discover what those requirements should be.',
                    'Incorrect - Maintenance phase occurs after the application is deployed and operational. Gathering security requirements during maintenance means that security was not considered during initial development, resulting in a system that may have fundamental security flaws. While security requirements may evolve during maintenance, the core security foundation should be established much earlier in the SDLC.',
                ],
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'status' => 'published',
                'type_id' => 1,
                'irt_a' => 1.3,
                'irt_b' => -0.3,
                'irt_c' => 0.25,
            ],

            // Item 3 - L2 - Understand
            [
                'topic' => 'Secure Development Fundamentals',
                'subtopic' => 'Secure Software Development Lifecycle (SSDLC)',
                'question' => 'What is a key benefit of shifting security left in the SDLC?',
                'options' => [
                    'Increased cost of fixing vulnerabilities.',
                    'Reduced developer productivity.',
                    'Earlier detection and remediation of security defects.',
                    'Elimination of the need for penetration testing.',
                ],
                'correct_options' => ['Earlier detection and remediation of security defects.'],
                'justifications' => [
                    'Incorrect - Shifting security left actually decreases the cost of fixing vulnerabilities, not increases it. The "shift left" approach moves security activities earlier in the development lifecycle when changes are less expensive to implement. Fixing security issues during requirements or design phases costs significantly less than addressing them after deployment or during production.',
                    'Incorrect - While there may be an initial learning curve, shifting security left ultimately improves developer productivity by reducing rework, minimizing security-related delays in later phases, and preventing costly security incidents. Developers become more efficient at writing secure code, and early security feedback prevents the need for extensive retrofitting.',
                    'Correct - The primary benefit of shifting security left is the early detection and remediation of security defects. By integrating security practices throughout the development lifecycle - from requirements gathering through design, coding, and testing - security issues are identified when they are easier, faster, and less expensive to fix. This proactive approach prevents security vulnerabilities from propagating through later development phases.',
                    'Incorrect - Shifting security left complements rather than eliminates penetration testing. While early security practices reduce the number of vulnerabilities that reach later testing phases, penetration testing remains valuable for validating security controls, identifying business logic flaws, and testing the application from an attacker\'s perspective. The shift left approach makes penetration testing more effective by ensuring a more secure baseline.',
                ],
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'status' => 'published',
                'type_id' => 1,
                'irt_a' => 1.4,
                'irt_b' => -0.1,
                'irt_c' => 0.25,
            ],

            // Item 4 - L3 - Apply
            [
                'topic' => 'Secure Development Fundamentals',
                'subtopic' => 'Secure Software Development Lifecycle (SSDLC)',
                'question' => 'During the "coding" phase of an SSDLC, a common security checkpoint might involve:',
                'options' => [
                    'Reviewing user stories for security implications.',
                    'Performing dynamic application security testing (DAST).',
                    'Conducting peer code reviews with a focus on security best practices.',
                    'Obtaining sign-off for deployment to production.',
                ],
                'correct_options' => ['Conducting peer code reviews with a focus on security best practices.'],
                'justifications' => [
                    'Incorrect - Reviewing user stories for security implications typically occurs during the requirements gathering and design phases, not during coding. User stories are analyzed for security requirements before development begins to ensure that security considerations are incorporated into the development plan and architecture design.',
                    'Incorrect - Dynamic Application Security Testing (DAST) requires a running application to test, making it appropriate for testing phases rather than the coding phase. DAST analyzes applications from the outside by simulating attacks against running applications, which is not possible during active code development when the application may not be fully functional.',
                    'Correct - Peer code reviews with a focus on security best practices are a fundamental security checkpoint during the coding phase. These reviews involve developers examining each other\'s code for security vulnerabilities, adherence to secure coding standards, proper input validation, authentication controls, and other security-related issues. This practice helps identify security defects early when they are easier and less expensive to fix.',
                    'Incorrect - Obtaining sign-off for deployment to production occurs during the deployment or release phase, well after coding is complete. This checkpoint involves final approvals after all development, testing, and security validation activities have been completed and the application is ready for production release.',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'status' => 'published',
                'type_id' => 1,
                'irt_a' => 1.5,
                'irt_b' => 0.2,
                'irt_c' => 0.25,
            ],

            // Item 5 - L3 - Apply
            [
                'topic' => 'Secure Development Fundamentals',
                'subtopic' => 'Secure Software Development Lifecycle (SSDLC)',
                'question' => 'Which of the following BEST describes the purpose of a security gate in SSDLC?',
                'options' => [
                    'Automate security controls during runtime',
                    'Block deployment until security criteria are met',
                    'Replace QA checks with penetration testing',
                    'Deploy software to staging',
                ],
                'correct_options' => ['Block deployment until security criteria are met'],
                'justifications' => [
                    'Incorrect - Automating security controls during runtime refers to operational security measures like runtime application self-protection (RASP) or security monitoring, not security gates. Security gates are checkpoints in the development process that enforce security criteria before allowing progression to the next phase, rather than runtime automation.',
                    'Correct - Security gates are checkpoints in the SSDLC that prevent software from advancing to the next development phase or deployment stage until predefined security criteria are satisfied. These gates ensure that security requirements are met before proceeding, such as passing security tests, completing code reviews, or resolving critical vulnerabilities. This "fail-safe" mechanism maintains security standards throughout the development lifecycle.',
                    'Incorrect - Security gates complement rather than replace QA checks and penetration testing. Security gates incorporate various security validation activities, which may include penetration testing results, but they don\'t eliminate the need for comprehensive quality assurance processes. Both security gates and QA checks serve important but different purposes in ensuring software quality and security.',
                    'Incorrect - Deploying software to staging is an operational activity, not the purpose of a security gate. While a security gate might control whether software can be deployed to staging by enforcing security criteria, the gate itself is a control mechanism rather than a deployment action. Security gates evaluate security posture before allowing deployment activities to proceed.',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'status' => 'published',
                'type_id' => 1,
                'irt_a' => 1.6,
                'irt_b' => 0.4,
                'irt_c' => 0.25,
            ],

            // Item 6 - L3 - Apply
            [
                'topic' => 'Secure Development Fundamentals',
                'subtopic' => 'Secure Software Development Lifecycle (SSDLC)',
                'question' => 'The concept of "security champions" within development teams is an example of:',
                'options' => [
                    'Outsourcing all security responsibilities.',
                    'Centralizing all security decisions within a single security team.',
                    'Decentralizing security knowledge and promoting a security-first culture.',
                    'Automating all security testing.',
                ],
                'correct_options' => ['Decentralizing security knowledge and promoting a security-first culture.'],
                'justifications' => [
                    'Incorrect - Security champions represent the opposite of outsourcing security responsibilities. Instead of transferring security obligations to external parties, the security champion model brings security expertise directly into development teams. Champions maintain their primary development roles while also serving as security advocates and knowledge resources within their teams.',
                    'Incorrect - Security champions actually decentralize security decision-making rather than centralizing it. While a central security team may coordinate the champion program, the champions themselves distribute security knowledge and decision-making capability throughout the organization. This approach empowers development teams to make informed security decisions locally rather than depending solely on a central security team.',
                    'Correct - Security champions embody the principle of decentralizing security knowledge by embedding security expertise within development teams. These individuals, typically developers who receive additional security training, serve as security advocates, mentors, and knowledge resources for their teams. This approach promotes a security-first culture by making security everyone\'s responsibility rather than relegating it to a separate security team, fostering better security awareness and practices throughout the development organization.',
                    'Incorrect - Security champions are people, not automation tools. While champions may advocate for and help implement automated security testing, the champion model is fundamentally about human expertise, mentorship, and cultural change. Champions provide security knowledge, conduct reviews, offer guidance, and promote security awareness - activities that require human judgment and interpersonal skills rather than automation.',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'status' => 'published',
                'type_id' => 1,
                'irt_a' => 1.5,
                'irt_b' => 0.3,
                'irt_c' => 0.25,
            ],

            // Item 7 - L4 - Analyze
            [
                'topic' => 'Secure Development Fundamentals',
                'subtopic' => 'Secure Software Development Lifecycle (SSDLC)',
                'question' => 'What is the primary benefit of including security professionals in the initial "requirements gathering" phase of a project?',
                'options' => [
                    'To provide feedback on the user interface design.',
                    'To ensure security considerations are baked into the core design from the outset.',
                    'To conduct penetration testing early in the cycle.',
                    'To manage the project budget.',
                ],
                'correct_options' => ['To ensure security considerations are baked into the core design from the outset.'],
                'justifications' => [
                    'Incorrect - While security professionals may have opinions about user interface design, particularly regarding security-related UI elements like authentication flows, their primary contribution during requirements gathering is not UI feedback. User interface design typically occurs during later design phases, and UI-specific security considerations (like secure display of sensitive data) are addressed after core security requirements are established.',
                    'Correct - The primary benefit of including security professionals during requirements gathering is to ensure security considerations are integrated into the fundamental project design from the beginning. Security professionals can identify security requirements, assess potential threats, evaluate regulatory compliance needs, and ensure that security is not an afterthought. This "security by design" approach prevents costly retrofitting of security controls and ensures that the architecture can support necessary security measures effectively.',
                    'Incorrect - Penetration testing requires a functional application or system to test against, making it impossible to conduct during the requirements gathering phase when no code or systems have been built yet. Penetration testing is typically performed much later in the SDLC, during testing phases or after deployment. During requirements gathering, security professionals focus on threat modeling and defining security requirements rather than testing implementations.',
                    'Incorrect - Project budget management is typically the responsibility of project managers, not security professionals. While security professionals may provide input on the costs of implementing various security controls and may help prioritize security requirements based on budget constraints, their primary role during requirements gathering is technical and risk-focused rather than financial management.',
                ],
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'status' => 'published',
                'type_id' => 1,
                'irt_a' => 1.6,
                'irt_b' => 0.6,
                'irt_c' => 0.20,
            ],

            // Item 8 - L4 - Analyze
            [
                'topic' => 'Secure Development Fundamentals',
                'subtopic' => 'Secure Software Development Lifecycle (SSDLC)',
                'question' => 'During which phase of SDLC is threat modeling most effectively conducted?',
                'options' => [
                    'Coding',
                    'Design',
                    'Testing',
                    'Deployment',
                ],
                'correct_options' => ['Design'],
                'justifications' => [
                    'Incorrect - The coding phase is too late for effective threat modeling because architectural and design decisions have already been made. During coding, developers are implementing pre-determined designs, making it difficult and expensive to address fundamental security issues that threat modeling might reveal. While code-level security reviews are important during coding, they cannot substitute for architectural threat analysis.',
                    'Correct - The design phase is optimal for threat modeling because it occurs after requirements are gathered but before implementation begins. During this phase, system architecture, data flows, trust boundaries, and component interactions are being defined. Threat modeling at this stage allows security considerations to influence architectural decisions, helps identify potential attack vectors early, and enables the design of appropriate security controls before code is written.',
                    'Incorrect - Testing phase is too late for effective threat modeling because the system architecture and implementation are largely complete. While security testing can validate that identified threats have been properly mitigated, conducting threat modeling during testing means that fundamental architectural security issues may be expensive or impossible to address without significant rework.',
                    'Incorrect - Deployment phase is far too late for threat modeling as the application is already built and ready for production. At this stage, any significant security threats identified through modeling would require major architectural changes or could result in deployment delays. Threat modeling should inform design decisions, not discover problems when it\'s too late to address them cost-effectively.',
                ],
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'status' => 'published',
                'type_id' => 1,
                'irt_a' => 1.7,
                'irt_b' => 0.7,
                'irt_c' => 0.20,
            ],

            // Item 9 - L5 - Evaluate
            [
                'topic' => 'Secure Development Fundamentals',
                'subtopic' => 'Secure Software Development Lifecycle (SSDLC)',
                'question' => '"Shift left" in SSDLC refers to:',
                'options' => [
                    'Automating deployment to the left of the release pipeline',
                    'Adding more testing in the post-deployment phase',
                    'Introducing security and testing earlier in SDLC',
                    'Shifting requirements to developers',
                ],
                'correct_options' => ['Introducing security and testing earlier in SDLC'],
                'justifications' => [
                    'Incorrect - "Shift left" is not about the physical or logical positioning of deployment automation in release pipelines. While deployment automation is important for DevOps practices, "shift left" specifically refers to moving security and quality activities earlier in the development timeline, not about pipeline organization or automation placement.',
                    'Incorrect - "Shift left" is the opposite of adding more activities in post-deployment phases. The concept specifically advocates for moving testing and security activities earlier (to the left) in the development timeline rather than later (to the right). Post-deployment testing contradicts the fundamental principle of shift left, which aims to identify and fix issues before they reach production.',
                    'Correct - "Shift left" refers to the practice of introducing security and testing activities earlier in the Software Development Life Cycle. The term "left" represents earlier phases in the traditional SDLC timeline (requirements, design, coding) while "right" represents later phases (testing, deployment, production). This approach helps identify and remediate security issues when they are less expensive to fix and prevents vulnerabilities from propagating through later development phases.',
                    'Incorrect - Shifting requirements to developers is not what "shift left" means in SSDLC context. While developer involvement in requirements is beneficial, "shift left" specifically refers to moving security and testing activities earlier in the development process. Requirements gathering typically already occurs early in the SDLC, so this option doesn\'t capture the essence of moving traditionally late-stage activities (like security testing) to earlier phases.',
                ],
                'bloom_level' => 5,
                'difficulty_level' => 5,
                'status' => 'published',
                'type_id' => 1,
                'irt_a' => 1.8,
                'irt_b' => 1.1,
                'irt_c' => 0.15,
            ],

            // Item 10 - L5 - Evaluate
            [
                'topic' => 'Secure Development Fundamentals',
                'subtopic' => 'Secure Software Development Lifecycle (SSDLC)',
                'question' => 'In Agile, when should security tasks be addressed?',
                'options' => [
                    'After sprint completion',
                    'Only in hardening sprints',
                    'Continuously during each sprint',
                    'Before product backlog is defined',
                ],
                'correct_options' => ['Continuously during each sprint'],
                'justifications' => [
                    'Incorrect - Addressing security tasks after sprint completion contradicts Agile principles and creates security debt. This approach treats security as an afterthought rather than an integral part of development. Waiting until after sprint completion to address security can lead to discovered vulnerabilities that require significant rework, potentially affecting subsequent sprints and creating delays in the development timeline.',
                    'Incorrect - Relegating security to dedicated hardening sprints is an anti-pattern that goes against both Agile principles and security best practices. This approach creates a "security waterfall" within Agile development, where security becomes a bottleneck at the end of development cycles. Hardening sprints often result in rushed security fixes, incomplete security testing, and the potential for missing security requirements that should have been addressed during feature development.',
                    'Correct - Security tasks should be addressed continuously during each sprint as part of the regular development workflow. This approach integrates security into the Definition of Done, ensures security requirements are considered during story planning, includes security testing in sprint activities, and makes security everyone\'s responsibility rather than a separate concern. Continuous security integration prevents security debt accumulation and maintains development velocity.',
                    'Incorrect - While some high-level security requirements might be considered during initial product backlog definition, addressing all security tasks before the backlog is defined is not practical in Agile environments. Security requirements often emerge and evolve as the product develops, user stories are refined, and new threats are identified. This approach would create an inflexible security framework that cannot adapt to changing requirements and discovered security needs.',
                ],
                'bloom_level' => 5,
                'difficulty_level' => 5,
                'status' => 'published',
                'type_id' => 1,
                'irt_a' => 1.9,
                'irt_b' => 1.2,
                'irt_c' => 0.15,
            ],

            // Topic 2: Web Application Security (10 questions)
            // Bloom Distribution: L1:1, L2:2, L3:3, L4:2, L5:2

            // Item 11 - L1 - Remember
            [
                'topic' => 'Web Application Security',
                'subtopic' => 'Application Vulnerabilities',
                'question' => 'During the "build" phase of an SSDLC, a nightly build fails the automated Static Application Security Testing (SAST) scan due to a newly introduced critical vulnerability. Which of the following is the most effective immediate action according to robust security gate principles?',
                'options' => [
                    'Proceed with the build, but log the vulnerability for later review.',
                    'Disable the SAST scan temporarily to unblock the build process.',
                    'Halt the build, flag the vulnerability, and prevent progression until the issue is remediated.',
                    'Assign the vulnerability to a different team to handle in the next sprint.',
                ],
                'correct_options' => ['Halt the build, flag the vulnerability, and prevent progression until the issue is remediated.'],
                'justifications' => [
                    'Incorrect - Proceeding with the build despite a critical vulnerability fundamentally defeats the purpose of security gates and SAST implementation. This approach creates security debt, allows vulnerable code to progress through the pipeline, and potentially introduces critical security flaws into production. Security gates are specifically designed to prevent such progression when security criteria are not met.',
                    'Incorrect - Disabling security controls to unblock development processes is a dangerous anti-pattern that undermines the entire security gate philosophy. This approach prioritizes development velocity over security and sets a precedent that security controls can be bypassed when convenient. Temporarily disabling SAST scans defeats the purpose of implementing automated security testing in the first place.',
                    'Correct - Halting the build and preventing progression until remediation is the correct implementation of security gate principles. This approach ensures that critical vulnerabilities are addressed immediately, prevents vulnerable code from advancing through the development pipeline, maintains security standards, and reinforces the importance of security in the development process. The build should only proceed once the vulnerability is properly fixed and verified.',
                    'Incorrect - Assigning the vulnerability to a different team while allowing the build to continue violates security gate principles and creates organizational silos around security responsibility. This approach delays remediation, may result in the vulnerability being deprioritized, and allows potentially vulnerable code to progress. Security gates require immediate action, not delegation and deferral to future sprints.',
                ],
                'bloom_level' => 1,
                'difficulty_level' => 1,
                'status' => 'published',
                'type_id' => 1,
                'irt_a' => 1.2,
                'irt_b' => -0.8,
                'irt_c' => 0.25,
            ],

            // Item 12 - L2 - Understand
            [
                'topic' => 'Web Application Security',
                'subtopic' => 'Application Vulnerabilities',
                'question' => 'Which of the following log entries is most indicative of a potential Cross-Site Request Forgery (CSRF) attack?',
                'options' => [
                    'POST /transfer_funds.php HTTP/1.1 Content: amount=1000&to_account=1234567890 Cookie: sessionID=abc123',
                    'POST /change_email.php HTTP/1.1 Content: new_email=victim@example.com Cookie: sessionID=xyz789 Referer: https://malicious-website.com',
                    'POST /login.php HTTP/1.1 Content: username=admin&password=12345 Cookie: sessionID=lmn456',
                    'POST /upload.php HTTP/1.1 Content: file=profile.jpg Cookie: sessionID=pqr321',
                ],
                'correct_options' => ['POST /change_email.php HTTP/1.1 Content: new_email=victim@example.com Cookie: sessionID=xyz789 Referer: https://malicious-website.com'],
                'justifications' => [
                    'Incorrect - While this shows a sensitive financial transaction (fund transfer), the log entry lacks the key indicator of CSRF: an external referer. The request appears to originate from the legitimate application context without suspicious cross-origin characteristics. A CSRF attack would typically show evidence of the request originating from an external, potentially malicious website.',
                    'Correct - This log entry exhibits the classic indicators of a CSRF attack. The key evidence is the "Referer: https://malicious-website.com" header, which shows that a POST request to change sensitive account information (email address) originated from an external, potentially malicious website. The presence of a valid session cookie indicates the victim is authenticated, but the external referer suggests the request was initiated from a malicious site, which is the hallmark of CSRF attacks.',
                    'Incorrect - This represents a standard login attempt and does not exhibit CSRF characteristics. Login forms are typically accessed directly from the application and do not involve cross-site request forgery. Additionally, login endpoints are usually protected against CSRF through various mechanisms, and this log shows no external referer indicating cross-origin request initiation.',
                    'Incorrect - This appears to be a normal file upload request without any indicators of cross-site origin. The request contains standard file upload content and a session cookie, but lacks the external referer that would indicate a CSRF attack. File uploads initiated from within the legitimate application context are expected behavior.',
                ],
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'status' => 'published',
                'type_id' => 1,
                'irt_a' => 1.4,
                'irt_b' => -0.2,
                'irt_c' => 0.25,
            ],

            // Item 13 - L2 - Understand
            [
                'topic' => 'Web Application Security',
                'subtopic' => 'Application Vulnerabilities',
                'question' => 'Why are Cross-Site Scripting (XSS) attacks particularly dangerous for web applications?',
                'options' => [
                    'They only affect web server performance',
                    'They can execute malicious scripts in user browsers and steal sensitive data',
                    'They require physical access to web servers',
                    'They only work against older web browsers',
                ],
                'correct_options' => ['They can execute malicious scripts in user browsers and steal sensitive data'],
                'justifications' => [
                    'Incorrect - They only affect web server performance',
                    'Correct - They can execute malicious scripts in user browsers and steal sensitive data',
                    'Incorrect - They require physical access to web servers',
                    'Incorrect - They only work against older web browsers',
                ],
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'status' => 'published',
                'type_id' => 1,
                'irt_a' => 1.4,
                'irt_b' => -0.1,
                'irt_c' => 0.25,
            ],

            // Item 14 - L3 - Apply
            [
                'topic' => 'Web Application Security',
                'subtopic' => 'Application Vulnerabilities',
                'question' => 'A web application accepts user profile information including a bio field. How should the application handle this input to prevent XSS attacks?',
                'options' => [
                    'Store the bio field without any validation or encoding',
                    'Validate input format and encode output when displaying to users',
                    'Only allow numeric characters in bio fields',
                    'Disable the bio field feature entirely',
                ],
                'correct_options' => ['Validate input format and encode output when displaying to users'],
                'justifications' => [
                    'Incorrect - Store the bio field without any validation or encoding',
                    'Correct - Validate input format and encode output when displaying to users',
                    'Incorrect - Only allow numeric characters in bio fields',
                    'Incorrect - Disable the bio field feature entirely',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'status' => 'published',
                'type_id' => 1,
                'irt_a' => 1.5,
                'irt_b' => 0.2,
                'irt_c' => 0.25,
            ],

            // Item 15 - L3 - Apply
            [
                'topic' => 'Web Application Security',
                'subtopic' => 'Application Vulnerabilities',
                'question' => 'Which of the following log entries is most indicative of a potential directory traversal attack?',
                'options' => [
                    'GET /images/photo.jpg HTTP/1.1',
                    'GET /download.php?file=../../../../etc/passwd HTTP/1.1',
                    'POST /login.php HTTP/1.1 Content: username=admin&password=12345',
                    'GET /home.php?page=index.html HTTP/1.1',
                ],
                'correct_options' => ['GET /download.php?file=../../../../etc/passwd HTTP/1.1'],
                'justifications' => [
                    'Incorrect - This represents a legitimate request for an image file within the expected web directory structure. The request path "/images/photo.jpg" follows normal web application patterns and does not contain any directory traversal sequences (../) or attempts to access files outside the web directory. This is standard user behavior for accessing web resources.',
                    'Correct - This log entry clearly shows a directory traversal attack attempt. The malicious payload "../../../../etc/passwd" uses multiple "../" sequences to navigate up the directory tree from the web directory to the system root, attempting to access the Unix/Linux password file (/etc/passwd). The "../" sequences are the signature pattern of directory traversal attacks, designed to bypass access controls and read sensitive system files outside the intended web directory scope.',
                    'Incorrect - This shows a standard login attempt with username and password credentials submitted via POST request. While the credentials may be weak (admin/12345), this represents normal authentication functionality rather than a directory traversal attack. Directory traversal attacks specifically involve manipulating file paths to access unauthorized files, not credential-based authentication attempts.',
                    'Incorrect - This appears to be a normal request for a web page parameter, where the application is being asked to load "index.html" through a page parameter. While this could potentially be vulnerable to directory traversal if not properly validated, the current request shows a legitimate filename without any directory traversal sequences (../) or attempts to access system files outside the web directory.',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'status' => 'published',
                'type_id' => 1,
                'irt_a' => 1.5,
                'irt_b' => 0.2,
                'irt_c' => 0.25,
            ],

            // Item 16 - L3 - Apply
            [
                'topic' => 'Web Application Security',
                'subtopic' => 'Application Vulnerabilities',
                'question' => 'Which of the following log entries is most indicative of a potential Server-Side Request Forgery (SSRF) attack?',
                'options' => [
                    'POST /api/fetch_data.php HTTP/1.1 Content: url=http://localhost/admin HTTP/1.1',
                    'GET /user_profile.php?profile=12345 HTTP/1.1',
                    'POST /upload.php HTTP/1.1 Content: file=profile.jpg',
                    'GET /api/fetch_data.php?url=file:///etc/passwd HTTP/1.1',
                ],
                'correct_options' => ['POST /api/fetch_data.php HTTP/1.1 Content: url=http://localhost/admin HTTP/1.1'],
                'justifications' => [
                    'Correct - This log entry demonstrates a classic SSRF attack pattern. The request contains a URL parameter pointing to "http://localhost/admin", which indicates an attempt to make the server perform an internal request to access administrative interfaces that should not be accessible externally. SSRF attacks exploit server-side functionality that accepts URLs to make the server send requests to unintended locations, often targeting internal services, cloud metadata endpoints, or administrative interfaces accessible only from localhost.',
                    'Incorrect - This represents a normal user profile request with a numeric profile ID parameter. There are no indicators of SSRF attack patterns such as URL parameters, attempts to access internal services, or manipulation of server-side request functionality. This appears to be standard application behavior for retrieving user profile information.',
                    'Incorrect - This shows a standard file upload request without any URL parameters or indications of server-side request manipulation. File uploads, while potentially vulnerable to various attacks, do not typically involve SSRF unless the upload process includes URL fetching functionality. This log entry shows no evidence of attempting to make the server perform unauthorized requests.',
                    'Incorrect - While this request does contain a URL parameter with a suspicious file:// protocol attempting to access /etc/passwd, this represents more of a local file inclusion (LFI) attack rather than SSRF. The file:// protocol is used to access local files directly rather than making HTTP requests to internal services, which is the primary characteristic of SSRF attacks. However, this could be considered a variant of SSRF if the application processes the URL to fetch file contents server-side.',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'status' => 'published',
                'type_id' => 1,
                'irt_a' => 1.5,
                'irt_b' => 0.4,
                'irt_c' => 0.25,
            ],

            // Item 17 - L4 - Analyze
            [
                'topic' => 'Web Application Security',
                'subtopic' => 'Application Vulnerabilities',
                'question' => 'A product owner is writing user stories for a new feature involving user authentication. To ensure security is properly addressed, which of the following security requirements should be integrated into the user stories?',
                'options' => [
                    '"As a user, I want to authenticate securely." (Too vague)',
                    '"The system shall prevent brute-force attacks by locking an account after 5 failed login attempts within 10 minutes."',
                    '"The development team should try to implement strong encryption." (Not specific)',
                    '"The application must be compliant with general security standards." (Not measurable)',
                ],
                'correct_options' => ['"The system shall prevent brute-force attacks by locking an account after 5 failed login attempts within 10 minutes."'],
                'justifications' => [
                    'Incorrect - This user story is too vague and provides no actionable guidance for developers. "Authenticate securely" lacks specific implementation details, acceptance criteria, and measurable outcomes. User stories need to be specific enough that developers understand exactly what security controls to implement and how success will be measured.',
                    'Correct - This requirement is specific, measurable, and actionable. It provides clear implementation guidance (account lockout mechanism), specific thresholds (5 failed attempts, 10-minute window), and testable criteria. This level of detail enables developers to implement the exact security control needed and allows for proper testing and validation of the security feature.',
                    'Incorrect - This requirement lacks specificity and actionable detail. "Strong encryption" is subjective and doesn\'t specify which encryption algorithms, key lengths, or implementation methods should be used. The word "try" suggests the requirement is optional rather than mandatory, which undermines the security objective.',
                    'Incorrect - This requirement is too general and not measurable. "General security standards" doesn\'t specify which standards (OWASP, NIST, ISO 27001, etc.) or which specific controls from those standards should be implemented. Without specific compliance criteria, this requirement cannot be properly implemented or validated.',
                ],
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'status' => 'published',
                'type_id' => 1,
                'irt_a' => 1.8,
                'irt_b' => 0.7,
                'irt_c' => 0.20,
            ],

            // Item 18 - L4 - Analyze
            [
                'topic' => 'Web Application Security',
                'subtopic' => 'Application Vulnerabilities',
                'question' => 'A security team is designing security gates for a Continuous Integration/Continuous Delivery (CI/CD) pipeline. Which of the following approaches represents the most robust and proactive security gate strategy?',
                'options' => [
                    'Manual penetration testing performed once a quarter on the production environment.',
                    'Automated SAST and DAST scans integrated into every commit and build, with critical findings blocking deployment.',
                    'Relying solely on a final security audit before deployment to production.',
                    'Implementing a "bug bounty" program as the only security validation.',
                ],
                'correct_options' => ['Automated SAST and DAST scans integrated into every commit and build, with critical findings blocking deployment.'],
                'justifications' => [
                    'Incorrect - Manual penetration testing once a quarter is too infrequent for modern CI/CD environments where code changes occur daily or multiple times per day. This approach introduces significant security gaps between testing cycles and fails to provide timely feedback to developers. Quarterly testing also occurs too late to prevent vulnerable code from reaching production.',
                    'Correct - Automated SAST and DAST scans integrated into every commit and build represent the most robust approach because they provide continuous security validation, immediate feedback to developers, and prevent vulnerable code from progressing through the pipeline. The blocking mechanism ensures critical vulnerabilities are addressed before deployment, maintaining security standards without significantly impacting development velocity.',
                    'Incorrect - Relying solely on a final security audit creates a security bottleneck at the end of the development process and violates "shift left" principles. This approach delays security feedback until after development is complete, making vulnerability remediation expensive and potentially causing deployment delays. Final audits should complement, not replace, continuous security validation.',
                    'Incorrect - Bug bounty programs are valuable for discovering vulnerabilities in production systems but cannot serve as the primary security validation mechanism for CI/CD pipelines. Bug bounties are reactive rather than proactive, occur after deployment, and may not provide timely feedback for development teams. They should supplement, not replace, automated security testing in development pipelines.',
                ],
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'status' => 'published',
                'type_id' => 1,
                'irt_a' => 1.9,
                'irt_b' => 0.9,
                'irt_c' => 0.20,
            ],

            // Item 19 - L5 - Evaluate
            [
                'topic' => 'Web Application Security',
                'subtopic' => 'Application Vulnerabilities',
                'question' => 'During which phase of the SDLC is a "security architecture review" most effectively performed?',
                'options' => [
                    'Requirements Phase (too early for architecture)',
                    'Design Phase',
                    'Testing Phase (too late for architectural changes)',
                    'Deployment Phase',
                ],
                'correct_options' => ['Design Phase'],
                'justifications' => [
                    'Incorrect - The requirements phase is too early for a comprehensive security architecture review because the system architecture has not yet been defined. During requirements gathering, security requirements are identified, but the actual architectural components, data flows, trust boundaries, and technical design decisions that need security review are not yet established.',
                    'Correct - The design phase is the optimal time for security architecture review because this is when system architecture, component relationships, data flows, trust boundaries, and security controls are being defined. A security architecture review during this phase can influence fundamental design decisions, identify potential security weaknesses in the proposed architecture, and ensure security is built into the system foundation before implementation begins.',
                    'Incorrect - The testing phase is too late for effective security architecture review because the system architecture has already been implemented. At this stage, fundamental architectural changes would be extremely expensive and time-consuming. While security testing validates that implemented security controls work correctly, it cannot easily address fundamental architectural security flaws.',
                    'Incorrect - The deployment phase is far too late for security architecture review as the system is already built and ready for production. Any significant architectural security issues discovered at this stage would require major rework, potentially delaying deployment and incurring substantial costs. Architecture reviews should inform design decisions, not discover problems when implementation is complete.',
                ],
                'bloom_level' => 5,
                'difficulty_level' => 5,
                'status' => 'published',
                'type_id' => 1,
                'irt_a' => 1.8,
                'irt_b' => 1.2,
                'irt_c' => 0.15,
            ],

            // Item 20 - L5 - Evaluate
            [
                'topic' => 'Web Application Security',
                'subtopic' => 'Application Vulnerabilities',
                'question' => 'A CI/CD pipeline includes a security gate that automatically runs DAST on pre-production environments. If the DAST scan reports a medium-severity cross-site scripting (XSS) vulnerability, and the team\'s policy is to block deployments for all high and critical findings, what is the most appropriate action the gate should take?',
                'options' => [
                    'Block the deployment.',
                    'Allow the deployment but raise an alert.',
                    'Automatically fix the vulnerability and then deploy.',
                    'Ignore the finding as it\'s not critical.',
                ],
                'correct_options' => ['Allow the deployment but raise an alert.'],
                'justifications' => [
                    'Incorrect - Blocking the deployment for a medium-severity finding would violate the established policy that only blocks deployments for high and critical findings. This approach would create inconsistent gate behavior and potentially slow development velocity unnecessarily. While medium-severity vulnerabilities should be addressed, blocking deployment may not be proportionate to the risk level.',
                    'Correct - According to the established policy, the security gate should only block deployments for high and critical findings. A medium-severity XSS vulnerability, while important to address, falls below the blocking threshold. Allowing deployment while raising an alert ensures policy compliance, maintains development velocity, and ensures the vulnerability is tracked for remediation in upcoming releases.',
                    'Incorrect - Automatically fixing vulnerabilities is not a realistic capability for security gates, especially for XSS vulnerabilities that often require understanding application logic and business context. Automated fixes could introduce new bugs or break application functionality. Security gates should identify and report vulnerabilities, not attempt to remediate them automatically.',
                    'Incorrect - Ignoring any security finding is inappropriate, regardless of severity level. While the policy doesn\'t require blocking deployment for medium-severity findings, the vulnerability should still be documented, tracked, and scheduled for remediation. Ignoring findings creates security debt and may allow vulnerabilities to accumulate over time.',
                ],
                'bloom_level' => 5,
                'difficulty_level' => 5,
                'status' => 'published',
                'type_id' => 1,
                'irt_a' => 1.9,
                'irt_b' => 1.1,
                'irt_c' => 0.15,
            ],

            // Topic 3: Mobile Application Security (10 questions)
            // Bloom Distribution: L1:2, L2:2, L3:3, L4:2, L5:1

            // Item 21 - L1 - Remember
            [
                'topic' => 'Mobile Application Security',
                'subtopic' => 'Development Models',
                'question' => 'A critical security requirement states that "All user passwords must be hashed using a strong, salted, adaptive hashing algorithm." During which phase of the SDLC would the implementation of this requirement be primarily addressed?',
                'options' => [
                    'Requirements Analysis',
                    'Design & Implementation',
                    'Testing',
                    'Deployment',
                ],
                'correct_options' => ['Design & Implementation'],
                'justifications' => [
                    'Incorrect - Requirements Analysis is when this security requirement would be identified and documented, but not implemented. During this phase, the need for secure password hashing would be recognized and specified, but the actual technical implementation (choosing specific algorithms, salt generation methods, etc.) would not occur.',
                    'Correct - Design & Implementation is when this security requirement would be primarily addressed. During the design phase, specific hashing algorithms (like bcrypt, scrypt, or Argon2) would be selected, and implementation details (salt generation, iteration counts, etc.) would be determined. The actual coding of the password hashing functionality would occur during the implementation phase.',
                    'Incorrect - Testing phase is when the implementation of the password hashing requirement would be validated and verified, not when it would be primarily addressed. Testing would ensure the hashing is working correctly, that salts are properly generated, and that the chosen algorithm meets security standards, but the core implementation work would already be complete.',
                    'Incorrect - Deployment phase focuses on releasing the application to production environments. While deployment considerations might include environment-specific configuration of hashing parameters, the primary implementation of the password hashing requirement would have been completed in earlier phases. Deployment is about making the implemented solution available, not creating it.',
                ],
                'bloom_level' => 1,
                'difficulty_level' => 1,
                'status' => 'published',
                'type_id' => 1,
                'irt_a' => 1.1,
                'irt_b' => -1.0,
                'irt_c' => 0.25,
            ],

            // Item 22 - L1 - Remember
            [
                'topic' => 'Mobile Application Security',
                'subtopic' => 'Development Models',
                'question' => 'Who is primarily responsible for ensuring that security requirements are met in the development lifecycle?',
                'options' => [
                    'Business analyst',
                    'Security architect',
                    'Product marketing lead',
                    'Procurement officer',
                ],
                'correct_options' => ['Security architect'],
                'justifications' => [
                    'Incorrect - While business analysts may identify some security requirements during requirements gathering, they are not primarily responsible for ensuring all security requirements are met throughout the development lifecycle. Business analysts focus on functional requirements and business processes rather than technical security implementation and validation.',
                    'Correct - Security architects are primarily responsible for ensuring security requirements are met throughout the development lifecycle. They define security requirements, design security controls, review architectural decisions for security implications, validate security implementations, and ensure security standards are maintained from requirements through deployment. Security architects have the technical expertise and organizational authority to enforce security requirements.',
                    'Incorrect - Product marketing leads focus on market positioning, competitive analysis, and product messaging rather than technical security requirements. While they may influence security features from a market perspective, they are not responsible for ensuring technical security requirements are properly implemented and validated throughout the development process.',
                    'Incorrect - Procurement officers handle vendor selection, contract negotiations, and supply chain management. While they may be involved in security-related procurement decisions (like security tools or services), they are not responsible for ensuring security requirements are met in the software development lifecycle itself.',
                ],
                'bloom_level' => 1,
                'difficulty_level' => 1,
                'status' => 'published',
                'type_id' => 1,
                'irt_a' => 1.0,
                'irt_b' => -1.1,
                'irt_c' => 0.25,
            ],

            // Item 23 - L2 - Understand
            [
                'topic' => 'Mobile Application Security',
                'subtopic' => 'Development Models',
                'question' => 'Which of the following is a valid non-functional security requirement?',
                'options' => [
                    'User must be able to reset password',
                    'Admin can disable user account',
                    'Session timeout after 10 minutes of inactivity',
                    'User can download reports',
                ],
                'correct_options' => ['Session timeout after 10 minutes of inactivity'],
                'justifications' => [
                    'Incorrect - "User must be able to reset password" is a functional requirement because it describes what the system should do - provide password reset functionality. Functional requirements specify features, capabilities, or behaviors that the system must perform. This requirement defines a specific user action and system response.',
                    'Incorrect - "Admin can disable user account" is a functional requirement that describes a capability the system must provide to administrators. It specifies what the system should do (allow account disabling) rather than how it should perform or behave under certain conditions. This defines a specific administrative function.',
                    'Correct - "Session timeout after 10 minutes of inactivity" is a non-functional security requirement because it specifies how the system should behave rather than what it should do. Non-functional requirements define quality attributes, performance criteria, or constraints. This requirement establishes a security constraint on session management behavior, specifying the system\'s security performance characteristic.',
                    'Incorrect - "User can download reports" is a functional requirement that describes a specific capability the system must provide. It defines what users should be able to do (download reports) rather than specifying quality attributes or performance criteria. This describes a feature or function of the system.',
                ],
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'status' => 'published',
                'type_id' => 1,
                'irt_a' => 1.3,
                'irt_b' => -0.3,
                'irt_c' => 0.25,
            ],

            // Item 24 - L2 - Understand
            [
                'topic' => 'Mobile Application Security',
                'subtopic' => 'Development Models',
                'question' => 'A project fails the security checkpoint due to unresolved SQL injection vulnerabilities. What should happen next?',
                'options' => [
                    'Release the software with an exception',
                    'Proceed to the next sprint',
                    'Remediate the issues before progressing',
                    'Disable input validation',
                ],
                'correct_options' => ['Remediate the issues before progressing'],
                'justifications' => [
                    'Incorrect - Releasing software with unresolved SQL injection vulnerabilities creates significant security risks and defeats the purpose of security checkpoints. SQL injection is a critical vulnerability that can lead to data breaches, unauthorized access, and system compromise. Granting exceptions for such serious vulnerabilities undermines security standards and creates dangerous precedents.',
                    'Incorrect - Proceeding to the next sprint without addressing SQL injection vulnerabilities violates security gate principles and allows critical security flaws to persist. This approach prioritizes development velocity over security and may result in vulnerable code reaching production. Security checkpoints exist specifically to prevent this type of progression with unresolved critical issues.',
                    'Correct - Remediating SQL injection vulnerabilities before progressing is the correct action when a project fails a security checkpoint. Security checkpoints are designed to halt progression until critical security issues are resolved. SQL injection vulnerabilities pose significant risks and must be fixed through proper input validation, parameterized queries, and secure coding practices before development can continue.',
                    'Incorrect - Disabling input validation would worsen the security situation by removing a critical security control. Input validation is essential for preventing SQL injection and other injection attacks. This approach would increase vulnerabilities rather than resolve them and directly contradicts security best practices.',
                ],
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'status' => 'published',
                'type_id' => 1,
                'irt_a' => 1.4,
                'irt_b' => -0.1,
                'irt_c' => 0.25,
            ],

            // Item 25 - L3 - Apply
            [
                'topic' => 'Mobile Application Security',
                'subtopic' => 'Development Models',
                'question' => 'Which of the following inputs would MOST likely indicate a SQL Injection attempt?',
                'options' => [
                    'john.doe@example.com',
                    'Robert\'); DROP TABLE students;--',
                    '<script>alert(\'XSS\')</script>',
                    '../../etc/passwd',
                ],
                'correct_options' => ['Robert\'); DROP TABLE students;--'],
                'justifications' => [
                    'Incorrect - "john.doe@example.com" is a legitimate email address format with no malicious SQL syntax. This input follows standard email formatting conventions and contains no SQL injection indicators such as quotes, semicolons, SQL keywords, or comment markers.',
                    'Correct - "Robert\'); DROP TABLE students;--" is a classic SQL injection payload. It contains a single quote to break out of the expected string parameter, a semicolon to terminate the current SQL statement, the DROP TABLE command to delete data, and double dashes (--) to comment out the rest of the original query. This pattern is designed to manipulate SQL queries and execute unauthorized database operations.',
                    'Incorrect - "<script>alert(\'XSS\')</script>" is a Cross-Site Scripting (XSS) payload, not SQL injection. This input contains HTML/JavaScript tags designed to execute client-side scripts in web browsers, but it has no SQL syntax or database manipulation commands that would indicate SQL injection.',
                    'Incorrect - "../../etc/passwd" is a path traversal payload, not SQL injection. This input uses directory traversal sequences (../) to navigate file systems and access unauthorized files, but contains no SQL syntax, quotes, or database commands that would indicate SQL injection attempts.',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'status' => 'published',
                'type_id' => 1,
                'irt_a' => 1.5,
                'irt_b' => 0.1,
                'irt_c' => 0.25,
            ],

            // Item 26 - L3 - Apply
            [
                'topic' => 'Mobile Application Security',
                'subtopic' => 'Development Models',
                'question' => 'Which control MOST effectively prevents SQL Injection?',
                'options' => [
                    'Input trimming',
                    'Using HTML escape characters',
                    'Parameterized queries (prepared statements)',
                    'User input logging',
                ],
                'correct_options' => ['Parameterized queries (prepared statements)'],
                'justifications' => [
                    'Incorrect - Input trimming removes leading and trailing whitespace but does not prevent SQL injection. Malicious SQL code can exist within the trimmed content and will still be executed by the database. Trimming is a data formatting technique, not a security control against code injection.',
                    'Incorrect - HTML escape characters are used to prevent Cross-Site Scripting (XSS) attacks by encoding characters like <, >, and & for safe display in web browsers. However, HTML escaping does not protect against SQL injection because the escaped characters are still interpreted as SQL syntax when the query reaches the database server.',
                    'Correct - Parameterized queries (prepared statements) are the most effective defense against SQL injection. They separate SQL code from user data by using placeholders for user input, ensuring that user input is always treated as data rather than executable SQL code. The database engine handles parameter binding securely, preventing malicious SQL from being executed regardless of input content.',
                    'Incorrect - User input logging records what users submit but does not prevent SQL injection attacks. While logging is valuable for security monitoring and incident response, it is a detective control that identifies attacks after they occur, not a preventive control that stops the attacks from succeeding.',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'status' => 'published',
                'type_id' => 1,
                'irt_a' => 1.6,
                'irt_b' => 0.3,
                'irt_c' => 0.25,
            ],

            // Item 27 - L3 - Apply
            [
                'topic' => 'Mobile Application Security',
                'subtopic' => 'Development Models',
                'question' => 'Which mitigation BEST prevents XSS vulnerabilities?',
                'options' => [
                    'Using regular expressions on inputs',
                    'Setting SameSite cookies',
                    'Contextual output encoding',
                    'Disabling browser autocomplete',
                ],
                'correct_options' => ['Contextual output encoding'],
                'justifications' => [
                    'Incorrect - Regular expressions on inputs provide limited protection against XSS and can be easily bypassed. XSS payloads can take many forms and use various encoding techniques, making it difficult to create comprehensive regex patterns that catch all attack vectors while avoiding false positives. Input validation alone is insufficient as XSS occurs during output, not input.',
                    'Incorrect - SameSite cookies help prevent Cross-Site Request Forgery (CSRF) attacks by controlling when cookies are sent with cross-site requests, but they do not prevent XSS attacks. SameSite is a cookie attribute that controls cookie transmission behavior, not content encoding or script execution prevention.',
                    'Correct - Contextual output encoding is the most effective defense against XSS vulnerabilities. It encodes user data differently based on the context where it will be displayed (HTML, JavaScript, CSS, URL, etc.). For example, HTML encoding converts < to &lt; and > to &gt;, preventing browsers from interpreting user input as executable code. This approach neutralizes XSS payloads at the point of output where the vulnerability occurs.',
                    'Incorrect - Disabling browser autocomplete is a privacy feature that prevents browsers from storing and auto-filling form data, but it has no impact on XSS prevention. Autocomplete settings do not affect how browsers parse and execute potentially malicious scripts embedded in web page content.',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'status' => 'published',
                'type_id' => 1,
                'irt_a' => 1.7,
                'irt_b' => 0.4,
                'irt_c' => 0.25,
            ],

            // Item 28 - L2 - Understand
            [
                'topic' => 'Mobile Application Security',
                'subtopic' => 'Cookie Security',
                'question' => 'To prevent session cookies from being intercepted over unsecured network connections, the __ flag should be set on the cookie.',
                'options' => [
                    'HttpOnly',
                    'SameSite',
                    'Secure',
                    'Expires',
                ],
                'correct_options' => ['Secure'],
                'justifications' => [
                    'Incorrect - HttpOnly flag prevents client-side JavaScript access to cookies (XSS protection) but does not ensure encrypted transmission',
                    'Incorrect - SameSite flag controls cross-site cookie transmission for CSRF protection but does not ensure encrypted transmission',
                    'Correct - The Secure flag ensures cookies are only transmitted over HTTPS connections, preventing interception over unsecured HTTP connections',
                    'Incorrect - Expires flag sets cookie expiration time but does not control transmission security',
                ],
                'bloom_level' => 2,
                'difficulty_level' => 2,
                'status' => 'published',
                'type_id' => 1,
                'irt_a' => 1.0,
                'irt_b' => -0.8,
                'irt_c' => 0.25,
            ],

            // Item 29 - L3 - Apply
            [
                'topic' => 'Mobile Application Security',
                'subtopic' => 'Error Handling',
                'question' => 'A "fail-safe" or "fail-secure" approach in error handling dictates that upon an unexpected error, the system should:',
                'options' => [
                    'Continue operating as best as it can, even if in a degraded state',
                    'Gracefully terminate the process, blocking further access or operation in a secure manner until the issue is resolved',
                    'Roll back to the previous stable state and notify the user to try again',
                    'Log the error and immediately restart the service',
                ],
                'correct_options' => ['Gracefully terminate the process, blocking further access or operation in a secure manner until the issue is resolved'],
                'justifications' => [
                    'Incorrect - Continuing in degraded state may compromise security by operating with unknown conditions or bypassed security controls',
                    'Correct - Fail-secure approach prioritizes security over availability by safely stopping operations when unexpected errors occur, preventing potential security compromises',
                    'Incorrect - Rolling back may not address the underlying error condition and could allow repeated exploitation attempts',
                    'Incorrect - Immediate restart without addressing the error may recreate the same vulnerable condition',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'status' => 'published',
                'type_id' => 1,
                'irt_a' => 1.4,
                'irt_b' => 0.1,
                'irt_c' => 0.25,
            ],

            // Item 30 - L2 - Understand
            [
                'topic' => 'Mobile Application Security',
                'subtopic' => 'Cookie Security',
                'question' => 'The SameSite attribute for cookies, when set to Strict or Lax, primarily helps to mitigate which type of attack?',
                'options' => [
                    'SQL Injection',
                    'Cross-Site Request Forgery (CSRF)',
                    'Buffer Overflow',
                    'Denial of Service (DoS)',
                ],
                'correct_options' => ['Cross-Site Request Forgery (CSRF)'],
                'justifications' => [
                    'Incorrect - SQL Injection involves malicious database queries and is not related to cookie transmission behavior',
                    'Correct - SameSite attribute controls when cookies are sent with cross-site requests, preventing CSRF attacks by restricting cookie transmission to same-site contexts',
                    'Incorrect - Buffer Overflow involves memory corruption and is not related to cookie security attributes',
                    'Incorrect - DoS attacks aim to overwhelm system resources and are not mitigated by cookie attributes',
                ],
                'bloom_level' => 2,
                'difficulty_level' => 2,
                'status' => 'published',
                'type_id' => 1,
                'irt_a' => 1.2,
                'irt_b' => -0.5,
                'irt_c' => 0.25,
            ],

            // Topic 4: API Security (10 questions)
            // Bloom Distribution: L1:2, L2:2, L3:3, L4:2, L5:1

            // Item 31 - L3 - Apply
            [
                'topic' => 'API Security',
                'subtopic' => 'Error Handling',
                'question' => 'What is a secure practice when handling application errors?',
                'options' => [
                    'Show database error details to authenticated users',
                    'Display exact error messages to help users troubleshoot',
                    'Log errors internally while showing generic messages externally',
                    'Allow application to crash for visibility',
                ],
                'correct_options' => ['Log errors internally while showing generic messages externally'],
                'justifications' => [
                    'Incorrect - Database error details can expose sensitive information like table names, schema structure, and system paths to potential attackers',
                    'Incorrect - Exact error messages may reveal system internals, file paths, or technical details that could aid attackers in exploitation',
                    'Correct - Internal logging captures detailed error information for debugging while generic external messages prevent information disclosure to potential attackers',
                    'Incorrect - Allowing crashes creates poor user experience and may indicate system vulnerabilities to attackers',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'status' => 'published',
                'type_id' => 1,
                'irt_a' => 1.3,
                'irt_b' => 0.0,
                'irt_c' => 0.25,
            ],

            // Item 32 - L3 - Apply
            [
                'topic' => 'API Security',
                'subtopic' => 'Security Testing',
                'question' => 'What is the BEST mitigation for CSRF?',
                'options' => [
                    'Use CAPTCHA for login',
                    'Escape all user input',
                    'Implement anti-CSRF tokens',
                    'Require HTTPS for all sessions',
                ],
                'correct_options' => ['Implement anti-CSRF tokens'],
                'justifications' => [
                    'Incorrect - CAPTCHA for login provides protection against automated attacks during authentication but does not prevent CSRF attacks after the user is authenticated. CSRF attacks occur during normal user sessions and exploit the browser\'s automatic credential inclusion. CAPTCHA would not prevent malicious cross-site requests from being processed with the user\'s authenticated session.',
                    'Incorrect - Escaping user input is a defense against Cross-Site Scripting (XSS) attacks, not CSRF. Input escaping prevents malicious scripts from executing in browsers but does not address the core CSRF vulnerability, which is the server\'s inability to distinguish between legitimate and malicious requests from authenticated users.',
                    'Correct - Anti-CSRF tokens (also called synchronizer tokens) are the most effective defense against CSRF attacks. These unpredictable, unique tokens are embedded in forms and verified by the server before processing requests. Since attackers cannot predict or access these tokens from cross-site contexts due to same-origin policy, they cannot craft valid malicious requests. This approach directly addresses the core CSRF vulnerability.',
                    'Incorrect - While HTTPS is important for overall security and prevents token interception, it does not prevent CSRF attacks. HTTPS encrypts communication but does not help the server distinguish between legitimate user requests and malicious cross-site requests. CSRF attacks can occur over HTTPS connections just as easily as over HTTP.',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'status' => 'published',
                'type_id' => 1,
                'irt_a' => 1.6,
                'irt_b' => 0.2,
                'irt_c' => 0.25,
            ],

            // Item 33 - L2 - Understand
            [
                'topic' => 'API Security',
                'subtopic' => 'Security Testing',
                'question' => 'Which input is MOST likely to exploit a path traversal vulnerability?',
                'options' => [
                    'search=report1',
                    'file=../../etc/shadow',
                    'user=<script>alert(1)</script>',
                    'id=123; DROP TABLE users',
                ],
                'correct_options' => ['file=../../etc/shadow'],
                'justifications' => [
                    'Incorrect - "search=report1" is a benign search parameter with a simple alphanumeric value. This input contains no directory traversal sequences (../) or attempts to access files outside the intended directory structure. It represents normal application functionality for searching content.',
                    'Correct - "file=../../etc/shadow" is a classic path traversal payload that uses directory traversal sequences (../) to navigate up the directory tree and attempt to access the /etc/shadow file, which contains password hashes on Unix/Linux systems. The "../" sequences are designed to break out of the intended file directory and access sensitive system files outside the application\'s intended scope.',
                    'Incorrect - "user=<script>alert(1)</script>" is a Cross-Site Scripting (XSS) payload designed to execute JavaScript in web browsers, not a path traversal attack. This input contains HTML/JavaScript tags rather than file path manipulation sequences, making it unsuitable for exploiting path traversal vulnerabilities.',
                    'Incorrect - "id=123; DROP TABLE users" is a SQL injection payload designed to manipulate database queries, not file system paths. This input contains SQL syntax (semicolon, DROP TABLE command) rather than directory traversal sequences, making it ineffective against path traversal vulnerabilities.',
                ],
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'status' => 'published',
                'type_id' => 1,
                'irt_a' => 1.3,
                'irt_b' => -0.2,
                'irt_c' => 0.25,
            ],

            // Item 34 - L2 - Understand
            [
                'topic' => 'API Security',
                'subtopic' => 'Security Testing',
                'question' => 'A web application displays user-submitted comments directly on a webpage without proper encoding. An attacker submits a comment containing <script>alert(\'XSSed!\');</script>. When other users view this comment, they see a pop-up alert. This is an example of what type of XSS?',
                'options' => [
                    'Reflected XSS',
                    'Stored XSS',
                    'DOM-based XSS',
                    'Self-XSS',
                ],
                'correct_options' => ['Stored XSS'],
                'justifications' => [
                    'Incorrect - Reflected XSS occurs when malicious scripts are immediately reflected back to users in the response, typically through URL parameters or form submissions processed in the same request. In reflected XSS, the malicious payload is not permanently stored on the server and only affects users who click on specially crafted links or submit malicious forms.',
                    'Correct - This is Stored XSS (also called Persistent XSS) because the malicious script is permanently stored on the server (in this case, as a comment in the database) and executed whenever any user views the affected page. The attack payload persists on the server and automatically affects all users who visit the page, making it particularly dangerous as it requires no user interaction with malicious links.',
                    'Incorrect - DOM-based XSS occurs when client-side JavaScript modifies the DOM using untrusted data, without the malicious payload being sent to or processed by the server. The vulnerability exists entirely in client-side code manipulation. In this scenario, the script is stored on the server and served to users, not manipulated client-side through DOM operations.',
                    'Incorrect - Self-XSS requires the victim to manually execute malicious code themselves, typically by copying and pasting malicious scripts into browser developer tools or address bars. In this scenario, the attacker submits the malicious comment, and other users are automatically affected when viewing the page - no manual execution by victims is required.',
                ],
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'status' => 'published',
                'type_id' => 1,
                'irt_a' => 1.5,
                'irt_b' => 0.0,
                'irt_c' => 0.25,
            ],

            // Item 35 - L3 - Apply
            [
                'topic' => 'API Security',
                'subtopic' => 'Security Testing',
                'question' => 'A C program allocates a fixed-size buffer of 100 bytes for user input. An attacker provides input of 200 bytes, causing the excess data to overwrite adjacent memory locations, potentially altering the program\'s execution flow. This is a classic example of:',
                'options' => [
                    'SQL Injection',
                    'Cross-Site Scripting',
                    'Buffer Overflow',
                    'Path Traversal',
                ],
                'correct_options' => ['Buffer Overflow'],
                'justifications' => [
                    'Incorrect - SQL Injection is a vulnerability that occurs in database-driven applications where malicious SQL code is inserted through user input to manipulate database queries. The scenario describes memory corruption in a C program, not database query manipulation. SQL injection affects database operations, not memory management.',
                    'Incorrect - Cross-Site Scripting (XSS) is a web application vulnerability where malicious scripts are executed in user browsers. XSS affects web applications and browser-based content, not low-level memory management in C programs. The described scenario involves memory corruption, not script execution in browsers.',
                    'Correct - This is a classic Buffer Overflow vulnerability. The program allocates a fixed 100-byte buffer but accepts 200 bytes of input, causing the excess 100 bytes to overwrite adjacent memory locations. This memory corruption can alter program execution flow, potentially allowing attackers to execute arbitrary code or cause crashes. Buffer overflows are common in languages like C that don\'t perform automatic bounds checking.',
                    'Incorrect - Path Traversal (Directory Traversal) is a vulnerability where attackers use "../" sequences to access files outside the intended directory structure. This scenario describes memory corruption through excessive input length, not file system path manipulation. Path traversal affects file access permissions, not memory management.',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'status' => 'published',
                'type_id' => 1,
                'irt_a' => 1.4,
                'irt_b' => 0.1,
                'irt_c' => 0.25,
            ],

            // Item 36 - L3 - Apply
            [
                'topic' => 'API Security',
                'subtopic' => 'Security Testing',
                'question' => 'A web application allows users to submit a URL for image processing. An attacker submits a URL like http://localhost/admin_panel or http://169.254.169.254/latest/meta-data/ to retrieve sensitive internal server information. This attack is known as:',
                'options' => [
                    'SQL Injection',
                    'Cross-Site Request Forgery (CSRF)',
                    'Server-Side Request Forgery (SSRF)',
                    'XML External Entity (XXE) Injection',
                ],
                'correct_options' => ['Server-Side Request Forgery (SSRF)'],
                'justifications' => [
                    'Incorrect - SQL Injection involves inserting malicious SQL code through user input to manipulate database queries. The scenario describes URL-based attacks targeting internal services, not database manipulation. SQL injection affects database operations through malicious query construction, not server-side HTTP requests to internal resources.',
                    'Incorrect - Cross-Site Request Forgery (CSRF) tricks authenticated users into making unintended requests to web applications where they have active sessions. CSRF exploits user authentication credentials, not server-side URL processing. The described attack involves the server making requests to internal resources, not leveraging user authentication for cross-site requests.',
                    'Correct - This is a Server-Side Request Forgery (SSRF) attack where the attacker exploits the server\'s ability to make HTTP requests by providing malicious URLs. The server processes these URLs and makes requests to internal services (localhost/admin_panel) or cloud metadata services (169.254.169.254), potentially exposing sensitive information. SSRF attacks abuse server-side functionality that accepts URLs as input.',
                    'Incorrect - XML External Entity (XXE) Injection exploits XML parsers that process external entity references, potentially accessing local files or internal network resources. While XXE can sometimes achieve similar outcomes, the scenario specifically describes URL submission for image processing, not XML document processing with external entity references.',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'status' => 'published',
                'type_id' => 1,
                'irt_a' => 1.6,
                'irt_b' => 0.3,
                'irt_c' => 0.25,
            ],

            // Item 37 - L3 - Apply
            [
                'topic' => 'API Security',
                'subtopic' => 'Security Testing',
                'question' => 'An attacker discovers a reflected XSS vulnerability on a search page. They also know the application is likely using a vulnerable SQL database. Could the XSS be used to facilitate a direct SQL Injection?',
                'options' => [
                    'Yes - XSS can directly execute SQL commands on the server',
                    'No - XSS executes in the browser and cannot directly perform SQL injection on the server',
                    'Yes - but only if the XSS payload contains SQL syntax',
                    'No - unless the attacker has database credentials',
                ],
                'correct_options' => ['No - XSS executes in the browser and cannot directly perform SQL injection on the server'],
                'justifications' => [
                    'Incorrect - XSS vulnerabilities execute malicious scripts in user browsers (client-side) and cannot directly execute SQL commands on the server (server-side). XSS affects the presentation layer where user browsers render content, while SQL injection affects the data layer where the server processes database queries. These are fundamentally different execution contexts with different attack vectors.',
                    'Correct - XSS and SQL injection are distinct vulnerability types that operate in different contexts. XSS executes JavaScript in user browsers (client-side), while SQL injection manipulates database queries on the server (server-side). XSS cannot directly cause SQL injection because the malicious script runs in the browser environment, not in the server\'s database processing context. However, XSS could potentially be used indirectly to steal credentials or session tokens that might later facilitate other attacks.',
                    'Incorrect - The presence of SQL syntax in an XSS payload does not enable direct SQL injection. Even if XSS payload contains SQL commands, they would be executed as JavaScript in the browser, not as SQL queries on the server. The execution context determines how code is interpreted - browser JavaScript engines cannot directly execute SQL commands against server databases.',
                    'Incorrect - Database credentials are not the determining factor for whether XSS can perform SQL injection. Even with database credentials, XSS still executes in the browser context and cannot directly connect to or query server databases. The fundamental issue is the separation between client-side script execution (XSS) and server-side database operations (SQL injection).',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'status' => 'published',
                'type_id' => 1,
                'irt_a' => 1.7,
                'irt_b' => 0.4,
                'irt_c' => 0.25,
            ],

            // Item 38 - L4 - Analyze
            [
                'topic' => 'API Security',
                'subtopic' => 'Security Testing',
                'question' => 'Analyze the security implications of using GraphQL versus REST APIs for enterprise applications.',
                'options' => [
                    'GraphQL is always more secure than REST APIs',
                    'GraphQL offers flexibility but requires careful query complexity and depth limiting',
                    'REST APIs cannot implement proper security controls',
                    'GraphQL and REST have identical security characteristics',
                ],
                'correct_options' => ['GraphQL offers flexibility but requires careful query complexity and depth limiting'],
                'justifications' => [
                    'Incorrect - GraphQL is always more secure than REST APIs',
                    'Correct - GraphQL offers flexibility but requires careful query complexity and depth limiting',
                    'Incorrect - REST APIs cannot implement proper security controls',
                    'Incorrect - GraphQL and REST have identical security characteristics',
                ],
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'status' => 'published',
                'type_id' => 1,
                'irt_a' => 1.7,
                'irt_b' => 0.9,
                'irt_c' => 0.20,
            ],

            // Item 39 - L4 - Analyze
            [
                'topic' => 'API Security',
                'subtopic' => 'Security Testing',
                'question' => 'What is the fundamental security risk with exposing internal APIs directly to external consumers?',
                'options' => [
                    'External APIs are slower than internal APIs',
                    'Internal APIs may expose sensitive data and lack external threat considerations',
                    'External consumers cannot understand internal API documentation',
                    'Internal APIs cost more to maintain than external APIs',
                ],
                'correct_options' => ['Internal APIs may expose sensitive data and lack external threat considerations'],
                'justifications' => [
                    'Incorrect - External APIs are slower than internal APIs',
                    'Correct - Internal APIs may expose sensitive data and lack external threat considerations',
                    'Incorrect - External consumers cannot understand internal API documentation',
                    'Incorrect - Internal APIs cost more to maintain than external APIs',
                ],
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'status' => 'published',
                'type_id' => 1,
                'irt_a' => 1.8,
                'irt_b' => 1.1,
                'irt_c' => 0.20,
            ],

            // Item 40 - L5 - Evaluate
            [
                'topic' => 'API Security',
                'subtopic' => 'Security Testing',
                'question' => 'A microservices architecture implements service-to-service communication using mutual TLS. Evaluate the security benefits and operational challenges.',
                'options' => [
                    'mTLS provides perfect security with no operational overhead',
                    'mTLS enhances security but requires certificate management and performance considerations',
                    'mTLS is only useful for external API communications',
                    'Service-to-service communication never requires security',
                ],
                'correct_options' => ['mTLS enhances security but requires certificate management and performance considerations'],
                'justifications' => [
                    'Incorrect - mTLS provides perfect security with no operational overhead',
                    'Correct - mTLS enhances security but requires certificate management and performance considerations',
                    'Incorrect - mTLS is only useful for external API communications',
                    'Incorrect - Service-to-service communication never requires security',
                ],
                'bloom_level' => 5,
                'difficulty_level' => 5,
                'status' => 'published',
                'type_id' => 1,
                'irt_a' => 1.9,
                'irt_b' => 1.4,
                'irt_c' => 0.15,
            ],

            // Topic 5: Application Testing & Validation (10 questions)
            // Bloom Distribution: L1:2, L2:2, L3:3, L4:2, L5:1

            // Item 41 - L2 - Understand
            [
                'topic' => 'Application Testing & Validation',
                'subtopic' => 'Testing Methodologies',
                'question' => 'Which term refers to the process of ensuring that the product was built correctly according to specifications?',
                'options' => [
                    'Validation',
                    'Verification',
                    'Regression',
                    'Acceptance',
                ],
                'correct_options' => ['Verification'],
                'justifications' => [
                    'Incorrect - Validation confirms we built the right product (meets user needs and requirements)',
                    'Correct - Verification ensures we built the product right (according to specifications and design)',
                    'Incorrect - Regression testing ensures existing functionality still works after changes',
                    'Incorrect - Acceptance testing validates the system meets business requirements from user perspective',
                ],
                'bloom_level' => 2,
                'difficulty_level' => 2,
                'status' => 'published',
                'type_id' => 1,
                'irt_a' => 1.0,
                'irt_b' => -0.5,
                'irt_c' => 0.25,
            ],

            // Item 42 - L3 - Apply
            [
                'topic' => 'Application Testing & Validation',
                'subtopic' => 'Testing Methodologies',
                'question' => 'Your team fixes a defect in the login module. Which testing type is MOST appropriate to ensure no other functionality is broken?',
                'options' => [
                    'Unit testing',
                    'Integration testing',
                    'Regression testing',
                    'User acceptance testing',
                ],
                'correct_options' => ['Regression testing'],
                'justifications' => [
                    'Incorrect - Unit testing focuses on individual components but may not catch system-wide impacts',
                    'Incorrect - Integration testing validates component interactions but is not specifically designed for change impact',
                    'Correct - Regression testing specifically ensures existing functionality remains intact after code changes',
                    'Incorrect - User acceptance testing validates business requirements, not technical change impacts',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'status' => 'published',
                'type_id' => 1,
                'irt_a' => 1.3,
                'irt_b' => 0.2,
                'irt_c' => 0.25,
            ],

            // Item 43 - L2 - Understand
            [
                'topic' => 'Application Testing & Validation',
                'subtopic' => 'Security Testing',
                'question' => 'Which of the following BEST describes IAST (Interactive Application Security Testing)?',
                'options' => [
                    'Static analysis performed on source code without execution',
                    'Dynamic testing that analyzes applications during runtime with instrumentation',
                    'Manual penetration testing conducted by security experts',
                    'Automated vulnerability scanning of network infrastructure',
                ],
                'correct_options' => ['Dynamic testing that analyzes applications during runtime with instrumentation'],
                'justifications' => [
                    'Incorrect - This describes SAST (Static Application Security Testing), not IAST',
                    'Correct - IAST combines static and dynamic analysis by instrumenting applications during runtime for real-time security analysis',
                    'Incorrect - This describes manual penetration testing, which is a different testing approach',
                    'Incorrect - This describes network vulnerability scanning, not application security testing',
                ],
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'status' => 'published',
                'type_id' => 1,
                'irt_a' => 1.2,
                'irt_b' => -0.1,
                'irt_c' => 0.25,
            ],

            // Item 44 - L3 - Apply
            [
                'topic' => 'Application Testing & Validation',
                'subtopic' => 'Risk Assessment',
                'question' => 'Risk assessments are MOST effective in a software development enterprise when they are performed:',
                'options' => [
                    'during system deployment',
                    'before developing a business case',
                    'before system development begins',
                    'during each stage of the system development life cycle',
                ],
                'correct_options' => ['during each stage of the system development life cycle'],
                'justifications' => [
                    'Incorrect - Performing risk assessments only during deployment is too late to address critical security issues cost-effectively',
                    'Incorrect - While early assessment is valuable, this is too early and lacks technical implementation details',
                    'Incorrect - Single-point assessment before development misses evolving risks and changing requirements throughout the lifecycle',
                    'Correct - Continuous risk assessment throughout each SDLC stage ensures risks are identified, managed, and mitigated at the most appropriate and cost-effective points',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'status' => 'published',
                'type_id' => 1,
                'irt_a' => 1.4,
                'irt_b' => 0.2,
                'irt_c' => 0.25,
            ],

            // Item 45 - L4 - Analyze
            [
                'topic' => 'Application Testing & Validation',
                'subtopic' => 'Security Testing',
                'question' => 'During functional testing of a web application, a security tool is actively monitoring how the application processes user input. It identifies SQL injection vulnerabilities by analyzing both the source code and the actual data flow in real-time, providing immediate feedback without generating a large number of false positives. What type of security testing is being used?',
                'options' => [
                    'SAST (Static Application Security Testing)',
                    'DAST (Dynamic Application Security Testing)',
                    'RASP (Runtime Application Self-Protection)',
                    'IAST (Interactive Application Security Testing)',
                ],
                'correct_options' => ['IAST (Interactive Application Security Testing)'],
                'justifications' => [
                    'Incorrect - SAST analyzes source code without execution and cannot monitor real-time data flow during functional testing',
                    'Incorrect - DAST only analyzes running applications from the outside without access to source code or internal data flow',
                    'Incorrect - RASP is a runtime protection technology that blocks attacks rather than a testing methodology',
                    'Correct - IAST combines static and dynamic analysis by instrumenting applications during runtime, monitoring both source code and data flow for accurate vulnerability detection with fewer false positives',
                ],
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'status' => 'published',
                'type_id' => 1,
                'irt_a' => 1.6,
                'irt_b' => 0.7,
                'irt_c' => 0.20,
            ],

            // Item 46 - L4 - Analyze
            [
                'topic' => 'Application Testing & Validation',
                'subtopic' => 'Testing Strategy',
                'question' => 'When developing test scenarios for an enterprise, which of the following is the BEST approach?',
                'options' => [
                    'Use SAST to detect security flaws early in the development lifecycle',
                    'Use DAST to identify real-world vulnerabilities in a running application',
                    'Use DAST to better assess the impact of system outages',
                    'Use both SAST and DAST as they provide complementary security insights',
                ],
                'correct_options' => ['Use both SAST and DAST as they provide complementary security insights'],
                'justifications' => [
                    'Incorrect - While SAST is valuable for early detection, using only SAST misses runtime vulnerabilities and configuration issues',
                    'Incorrect - While DAST identifies runtime vulnerabilities, using only DAST misses early-stage code issues and is more expensive to fix later',
                    'Incorrect - DAST is not designed for system outage impact assessment; it focuses on security vulnerability detection',
                    'Correct - SAST and DAST provide complementary coverage: SAST finds code-level issues early and cost-effectively, while DAST identifies runtime, configuration, and environmental vulnerabilities that SAST cannot detect',
                ],
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'status' => 'published',
                'type_id' => 1,
                'irt_a' => 1.7,
                'irt_b' => 0.8,
                'irt_c' => 0.20,
            ],

            // Item 47 - L2 - Understand
            [
                'topic' => 'Application Testing & Validation',
                'subtopic' => 'Session Management',
                'question' => 'Which of the following practices is essential for securing session IDs in a web application?',
                'options' => [
                    'Transmitting session IDs over HTTP only',
                    'Storing session IDs in URL parameters',
                    'Setting the HttpOnly and Secure flags on session cookies',
                    'Using predictable session ID generation algorithms',
                ],
                'correct_options' => ['Setting the HttpOnly and Secure flags on session cookies'],
                'justifications' => [
                    'Incorrect - Transmitting session IDs over HTTP exposes them to interception and man-in-the-middle attacks',
                    'Incorrect - Storing session IDs in URL parameters exposes them in browser history, server logs, and referrer headers',
                    'Correct - HttpOnly flag prevents client-side JavaScript access (XSS protection) and Secure flag ensures transmission only over HTTPS',
                    'Incorrect - Predictable session IDs enable session hijacking through ID guessing or brute force attacks',
                ],
                'bloom_level' => 2,
                'difficulty_level' => 2,
                'status' => 'published',
                'type_id' => 1,
                'irt_a' => 1.1,
                'irt_b' => -0.3,
                'irt_c' => 0.25,
            ],

            // Item 48 - L3 - Apply
            [
                'topic' => 'Application Testing & Validation',
                'subtopic' => 'Error Handling',
                'question' => 'When an unexpected error occurs in a production web application, what is the most secure way to present error information to the end-user?',
                'options' => [
                    'Displaying the full technical stack trace and database error messages',
                    'Redirecting the user to a generic error page with a unique error reference ID for support',
                    'Printing the error details directly into the browser console',
                    'Simply crashing the application without any message',
                ],
                'correct_options' => ['Redirecting the user to a generic error page with a unique error reference ID for support'],
                'justifications' => [
                    'Incorrect - Full stack traces expose sensitive system information, file paths, and database details that attackers can exploit',
                    'Correct - Generic error pages prevent information disclosure while unique reference IDs allow support teams to locate specific errors in logs',
                    'Incorrect - Browser console errors are still visible to users and may expose sensitive technical details',
                    'Incorrect - Crashing without feedback creates poor user experience and may indicate system instability to attackers',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'status' => 'published',
                'type_id' => 1,
                'irt_a' => 1.3,
                'irt_b' => 0.1,
                'irt_c' => 0.25,
            ],

            // Item 49 - L3 - Apply
            [
                'topic' => 'Application Testing & Validation',
                'subtopic' => 'Session Management',
                'question' => 'What risk is primarily mitigated by regenerating a new session ID after a user successfully authenticates (e.g., from an unauthenticated session to an authenticated one)?',
                'options' => [
                    'SQL Injection',
                    'Cross-Site Scripting (XSS)',
                    'Session Fixation',
                    'Brute-force attacks',
                ],
                'correct_options' => ['Session Fixation'],
                'justifications' => [
                    'Incorrect - SQL Injection involves malicious database queries and is not related to session ID management',
                    'Incorrect - XSS involves script injection in web pages and is not directly addressed by session ID regeneration',
                    'Correct - Session Fixation occurs when an attacker sets a user\'s session ID before authentication. Regenerating the session ID after successful authentication prevents the attacker from using the pre-set session ID to hijack the authenticated session',
                    'Incorrect - Brute-force attacks involve trying multiple passwords and are not prevented by session ID regeneration',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'status' => 'published',
                'type_id' => 1,
                'irt_a' => 1.4,
                'irt_b' => 0.2,
                'irt_c' => 0.25,
            ],

            // Item 50 - L3 - Apply
            [
                'topic' => 'Application Testing & Validation',
                'subtopic' => 'Input Validation',
                'question' => 'When validating numerical input (e.g., an age), besides checking if it\'s a number, what other validation is often critical from a security and functional perspective?',
                'options' => [
                    'Character encoding validation',
                    'Range validation',
                    'Length validation',
                    'Format validation',
                ],
                'correct_options' => ['Range validation'],
                'justifications' => [
                    'Incorrect - Character encoding validation applies to text input but is not the primary concern for numerical values',
                    'Correct - Range validation ensures numbers fall within acceptable bounds (e.g., age 0-150), preventing logical errors and potential security issues like integer overflow or business logic bypass',
                    'Incorrect - Length validation is more relevant for strings rather than numerical values',
                    'Incorrect - Format validation is already implied by checking if the input is a number',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'status' => 'published',
                'type_id' => 1,
                'irt_a' => 1.2,
                'irt_b' => 0.0,
                'irt_c' => 0.25,
            ],
        ];
    }
}
