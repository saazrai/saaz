<?php

namespace Database\Seeders\Diagnostics;

class D10IdentityandAccessManagementIAMSeeder extends BaseDiagnosticSeeder
{
    protected string $domainName = 'Identity and Access Management (IAM)';
    
    protected function getQuestions(): array
    {
        return [
            // BLOOM LEVEL 1 (Remember) - 7 questions
            // Item 1
            [
                'topic' => 'Identification',
                'subtopic' => 'Identification',
                'question' => 'The IAAA framework represents the four fundamental components of identity and access management. Drag & drop the components in their typical implementation order from first to last in the identity lifecycle.',
                'question_type' => 'ordering',
                'type_id' => 4,
                'options' => ['Authorization', 'Accounting', 'Identification', 'Authentication'], // Shuffled
                'correct_options' => ['Identification', 'Authentication', 'Authorization', 'Accounting'],
                'justifications' => [
                    'Identification comes first - This is the process of claiming an identity (e.g., providing a username). Before any security checks can occur, a user must first present their claimed identity to the system.',
                    'Authentication comes second - After identification, the system verifies that the user is who they claim to be through credentials (passwords, biometrics, tokens). Authentication validates the claimed identity.',
                    'Authorization comes third - Once identity is proven through authentication, the system determines what the authenticated user is permitted to do. This involves checking permissions, roles, and access rights.',
                    'Accounting (Auditing) comes last - Throughout and after the access session, the system logs and tracks what the authenticated and authorized user actually does. This provides audit trails for compliance and security monitoring.'
                ],
                'bloom_level' => 1,
                'difficulty_level' => 1,
                'status' => 'published',
                'irt_a' => 1.2,
                'irt_b' => -0.8,
                'irt_c' => 0.2
            ],
            // Item 2
            [
                'topic' => 'Identification',
                'subtopic' => 'Identification',
                'question' => 'Which authentication factor is "something you know"?',
                'type_id' => 1,
                'options' => [
                    'Fingerprint',
                    'Smart card',
                    'Password',
                    'Security token'
                ],
                'correct_options' => ['Password'],
                'justifications' => [
                    'Incorrect - Fingerprint is "something you are" (biometric)',
                    'Incorrect - Smart card is "something you have"',
                    'Correct - Password is "something you know" (knowledge factor)',
                    'Incorrect - Security token is "something you have"'
                ],
                'bloom_level' => 1,
                'difficulty_level' => 1,
                'status' => 'published',
                'irt_a' => 1.3,
                'irt_b' => -1.1,
                'irt_c' => 0.2
            ],
            // Item 3
            [
                'topic' => 'Identification',
                'subtopic' => 'Identification',
                'question' => 'What does LDAP stand for?',
                'type_id' => 1,
                'options' => [
                    'Lightweight Directory Access Protocol',
                    'Local Directory Authentication Platform',
                    'Limited Data Access Procedure',
                    'Logical Directory Application Protocol'
                ],
                'correct_options' => ['Lightweight Directory Access Protocol'],
                'justifications' => [
                    'Correct - LDAP stands for Lightweight Directory Access Protocol',
                    'Incorrect - This is not the correct expansion of LDAP',
                    'Incorrect - This is not the correct expansion of LDAP',
                    'Incorrect - This is not the correct expansion of LDAP'
                ],
                'bloom_level' => 1,
                'difficulty_level' => 1,
                'status' => 'published',
                'irt_a' => 1,
                'irt_b' => -0.9,
                'irt_c' => 0.2
            ],
            // Item 4
            [
                'topic' => 'Authentication',
                'subtopic' => 'Authentication',
                'question' => 'What does MFA stand for in identity management?',
                'type_id' => 1,
                'options' => [
                    'Multi-Factor Authentication',
                    'Master File Access',
                    'Managed Function Authorization',
                    'Multiple Firewall Architecture'
                ],
                'correct_options' => ['Multi-Factor Authentication'],
                'justifications' => [
                    'Correct - MFA stands for Multi-Factor Authentication',
                    'Incorrect - This is not the correct expansion of MFA',
                    'Incorrect - This is not the correct expansion of MFA',
                    'Incorrect - This is not the correct expansion of MFA'
                ],
                'bloom_level' => 1,
                'difficulty_level' => 1,
                'status' => 'published',
                'irt_a' => 1,
                'irt_b' => -0.5,
                'irt_c' => 0.2
            ],
            // Item 5
            [
                'topic' => 'Authentication',
                'subtopic' => 'Authentication',
                'question' => 'Which protocol is commonly used for single sign-on (SSO)?',
                'type_id' => 1,
                'options' => [
                    'HTTP',
                    'SAML',
                    'FTP',
                    'SMTP'
                ],
                'correct_options' => ['SAML'],
                'justifications' => [
                    'Incorrect - HTTP is a web protocol, not specifically for SSO',
                    'Correct - SAML (Security Assertion Markup Language) is commonly used for SSO',
                    'Incorrect - FTP is a file transfer protocol, not for SSO',
                    'Incorrect - SMTP is an email protocol, not for SSO'
                ],
                'bloom_level' => 1,
                'difficulty_level' => 1,
                'status' => 'published',
                'irt_a' => 1.7,
                'irt_b' => -0.8,
                'irt_c' => 0.2
            ],
            // Item 6
            [
                'topic' => 'Authorization',
                'subtopic' => 'Authorization',
                'question' => 'What does RBAC stand for?',
                'type_id' => 1,
                'options' => [
                    'Role-Based Access Control',
                    'Rule-Based Authentication Control',
                    'Remote Backup Access Control',
                    'Restricted Bandwidth Access Control'
                ],
                'correct_options' => ['Role-Based Access Control'],
                'justifications' => [
                    'Correct - RBAC stands for Role-Based Access Control',
                    'Incorrect - This is not the correct expansion of RBAC',
                    'Incorrect - This is not the correct expansion of RBAC',
                    'Incorrect - This is not the correct expansion of RBAC'
                ],
                'bloom_level' => 1,
                'difficulty_level' => 1,
                'status' => 'published',
                'irt_a' => 0.8,
                'irt_b' => -1.3,
                'irt_c' => 0.2
            ],
            // Item 7
            [
                'topic' => 'Authorization',
                'subtopic' => 'Authorization',
                'question' => 'What is the principle of least privilege?',
                'type_id' => 1,
                'options' => [
                    'Users should have maximum access to perform their jobs',
                    'Users should have minimum necessary access to perform their jobs',
                    'All users should have the same level of access',
                    'Access should be granted based on seniority'
                ],
                'correct_options' => ['Users should have minimum necessary access to perform their jobs'],
                'justifications' => [
                    'Incorrect - This violates the principle of least privilege',
                    'Correct - The principle of least privilege grants minimum necessary access',
                    'Incorrect - This does not follow the principle of least privilege',
                    'Incorrect - Access should be based on job function, not seniority'
                ],
                'bloom_level' => 1,
                'difficulty_level' => 1,
                'status' => 'published',
                'irt_a' => 1.2,
                'irt_b' => -1.6,
                'irt_c' => 0.2
            ],

            // BLOOM LEVEL 2 (Understand) - 10 questions
            // Item 8
            [
                'topic' => 'Identification',
                'subtopic' => 'Identification',
                'question' => 'A new employee joins a large organization. To grant them access to various internal systems, a unique user account is created in the Active Directory, and an employee ID card is issued. Which phase of the identity lifecycle does the creation of the user account and issuance of the ID card primarily represent?',
                'type_id' => 1,
                'options' => [
                    'Identity Verification',
                    'Identity Proofing',
                    'Provisioning',
                    'De-provisioning'
                ],
                'correct_options' => ['Provisioning'],
                'justifications' => [
                    'Incorrect - Identity verification typically occurs during authentication when the user presents credentials to prove they are who they claim to be. This happens after the account has been created.',
                    'Incorrect - Identity proofing occurs before account creation and involves verifying that the person requesting an account is who they claim to be (background checks, document verification, etc.). The scenario describes activities after this verification.',
                    'Correct - Provisioning is the identity lifecycle phase where accounts are created, credentials are issued, and initial access rights are granted. Creating the Active Directory account and issuing the ID card are classic provisioning activities that establish the digital identity.',
                    'Incorrect - De-provisioning is the opposite process that occurs when an employee leaves the organization, involving account deletion, credential revocation, and access removal.'
                ],
                'bloom_level' => 2,
                'difficulty_level' => 2,
                'status' => 'published',
                'irt_a' => 1.2,
                'irt_b' => -0.4,
                'irt_c' => 0.25
            ],
            // Item 9
            [
                'topic' => 'Identification',
                'subtopic' => 'Identification',
                'question' => 'An employee resigns from a company. Immediately upon their departure, their network access, email account, and access to internal applications are disabled. Which phase of the identity lifecycle is being executed in this scenario?',
                'type_id' => 1,
                'options' => [
                    'Identity Proofing',
                    'Provisioning',
                    'Re-verification',
                    'De-provisioning'
                ],
                'correct_options' => ['De-provisioning'],
                'justifications' => [
                    'Incorrect - Identity proofing occurs at the beginning of the identity lifecycle when verifying a person\'s identity before creating accounts. This scenario describes the end of the lifecycle.',
                    'Incorrect - Provisioning is the process of creating accounts and granting initial access when someone joins the organization. This scenario describes the opposite process.',
                    'Incorrect - Re-verification is an ongoing process where existing users must periodically confirm their identity or update their credentials. This scenario describes permanent access removal.',
                    'Correct - De-provisioning is the identity lifecycle phase where accounts are disabled or deleted, credentials are revoked, and all access is removed when an individual leaves the organization or no longer requires access.'
                ],
                'bloom_level' => 2,
                'difficulty_level' => 2,
                'status' => 'published',
                'irt_a' => 1.1,
                'irt_b' => -0.5,
                'irt_c' => 0.25
            ],
            // Item 10
            [
                'topic' => 'Identification',
                'subtopic' => 'Identification',
                'question' => 'Which of the following is the primary goal of "identity proofing"?',
                'type_id' => 1,
                'options' => [
                    'To assign unique identifiers to new users',
                    'To verify that an individual is who they claim to be',
                    'To manage user permissions within a system',
                    'To remove user accounts after a period of inactivity'
                ],
                'correct_options' => ['To verify that an individual is who they claim to be'],
                'justifications' => [
                    'Incorrect - Assigning unique identifiers occurs during the provisioning phase after identity has been proven. Identity proofing must occur first to establish the person\'s legitimacy.',
                    'Correct - Identity proofing is the process of verifying and validating that an individual is who they claim to be before creating accounts or granting access. This typically involves checking credentials, documents, or other evidence of identity.',
                    'Incorrect - Managing user permissions is part of authorization and access control, which occurs after identity has been established and proven. Identity proofing is a prerequisite step.',
                    'Incorrect - Removing inactive accounts is part of de-provisioning or account lifecycle management. Identity proofing occurs at the beginning of the identity lifecycle, not at the end.'
                ],
                'bloom_level' => 2,
                'difficulty_level' => 2,
                'status' => 'published',
                'irt_a' => 1.3,
                'irt_b' => -0.6,
                'irt_c' => 0.25
            ],
            // Item 11
            [
                'topic' => 'Authorization',
                'subtopic' => 'Authorization',
                'question' => 'What is the difference between authentication and authorization?',
                'type_id' => 1,
                'options' => [
                    'There is no difference; they are the same process',
                    'Authentication verifies identity; authorization determines access permissions',
                    'Authorization verifies identity; authentication determines access permissions',
                    'Both processes only deal with password verification'
                ],
                'correct_options' => ['Authentication verifies identity; authorization determines access permissions'],
                'justifications' => [
                    'Incorrect - Authentication and authorization are distinct processes',
                    'Correct - Authentication verifies who you are; authorization determines what you can do',
                    'Incorrect - This reverses the definitions of authentication and authorization',
                    'Incorrect - Both processes involve more than just passwords'
                ],
                'bloom_level' => 2,
                'difficulty_level' => 1,
                'status' => 'published',
                'irt_a' => 1.8,
                'irt_b' => -1.9,
                'irt_c' => 0.2
            ],
            // Item 12
            [
                'topic' => 'Authorization',
                'subtopic' => 'Authorization',
                'question' => 'Why is role-based access control (RBAC) preferred over individual user permissions in large organizations?',
                'type_id' => 1,
                'options' => [
                    'It is less secure than individual permissions',
                    'It simplifies administration and reduces errors',
                    'It eliminates the need for authentication',
                    'It automatically grants all users full access'
                ],
                'correct_options' => ['It simplifies administration and reduces errors'],
                'justifications' => [
                    'Incorrect - RBAC can be more secure when properly implemented',
                    'Correct - RBAC simplifies management by grouping similar permissions into roles',
                    'Incorrect - RBAC still requires authentication',
                    'Incorrect - RBAC restricts access based on roles, not grants full access'
                ],
                'bloom_level' => 2,
                'difficulty_level' => 1,
                'status' => 'published',
                'irt_a' => 1.6,
                'irt_b' => -2,
                'irt_c' => 0.2
            ],
            // Item 13
            [
                'topic' => 'Accounting (Auditing)',
                'subtopic' => 'Accounting (Auditing)',
                'question' => 'What is the purpose of access logging in identity management?',
                'type_id' => 1,
                'options' => [
                    'To slow down system performance',
                    'To provide accountability and compliance tracking',
                    'To increase storage costs',
                    'To prevent users from logging in'
                ],
                'correct_options' => ['To provide accountability and compliance tracking'],
                'justifications' => [
                    'Incorrect - Access logging should not significantly impact performance',
                    'Correct - Access logs provide audit trails for accountability and compliance',
                    'Incorrect - While logs require storage, this is not their purpose',
                    'Incorrect - Logs track access, they do not prevent login'
                ],
                'bloom_level' => 2,
                'difficulty_level' => 1,
                'status' => 'published',
                'irt_a' => 1.2,
                'irt_b' => -1.8,
                'irt_c' => 0.2
            ],
            // Item 14
            [
                'topic' => 'Federation & Advanced IAM',
                'subtopic' => 'Federation & Advanced IAM',
                'question' => 'What is identity federation?',
                'type_id' => 1,
                'options' => [
                    'Creating multiple identities for one user',
                    'Sharing identity information between trusted organizations',
                    'Deleting user accounts across systems',
                    'Encrypting all identity data'
                ],
                'correct_options' => ['Sharing identity information between trusted organizations'],
                'justifications' => [
                    'Incorrect - Federation does not create multiple identities',
                    'Correct - Identity federation enables sharing of identity information between trusted domains',
                    'Incorrect - Federation is about sharing, not deleting accounts',
                    'Incorrect - While encryption may be used, federation is about sharing identity information'
                ],
                'bloom_level' => 2,
                'difficulty_level' => 1,
                'status' => 'published',
                'irt_a' => 1.6,
                'irt_b' => -0.5,
                'irt_c' => 0.2
            ],
            // Item 15
            [
                'topic' => 'Authentication',
                'subtopic' => 'Authentication',
                'question' => 'What is the main advantage of biometric authentication over password-based authentication?',
                'type_id' => 1,
                'options' => [
                    'Biometrics are easier to reset when compromised',
                    'Biometric traits are unique and difficult to replicate',
                    'Biometrics never fail or produce errors',
                    'Biometric systems are always less expensive'
                ],
                'correct_options' => ['Biometric traits are unique and difficult to replicate'],
                'justifications' => [
                    'Incorrect - Biometrics cannot be easily reset like passwords',
                    'Correct - Biometric traits are unique to individuals and hard to forge',
                    'Incorrect - Biometric systems can have false positives and negatives',
                    'Incorrect - Biometric systems are often more expensive than password systems'
                ],
                'bloom_level' => 2,
                'difficulty_level' => 1,
                'status' => 'published',
                'irt_a' => 1.3,
                'irt_b' => -0.8,
                'irt_c' => 0.2
            ],
            // Item 16
            [
                'topic' => 'Authorization',
                'subtopic' => 'Authorization',
                'question' => 'What is attribute-based access control (ABAC)?',
                'type_id' => 1,
                'options' => [
                    'Access control based only on user roles',
                    'Access control based on multiple attributes like user, resource, and environment',
                    'Access control that uses only passwords',
                    'Access control that never changes'
                ],
                'correct_options' => ['Access control based on multiple attributes like user, resource, and environment'],
                'justifications' => [
                    'Incorrect - This describes RBAC, not ABAC',
                    'Correct - ABAC uses multiple attributes to make access decisions',
                    'Incorrect - ABAC is not limited to password-based authentication',
                    'Incorrect - ABAC policies can be dynamic and change based on context'
                ],
                'bloom_level' => 2,
                'difficulty_level' => 2,
                'status' => 'published',
                'irt_a' => 1.1,
                'irt_b' => -0.3,
                'irt_c' => 0.2
            ],
            // Item 17
            [
                'topic' => 'Identification',
                'subtopic' => 'Identification',
                'question' => 'Why is identity proofing important in identity management?',
                'type_id' => 1,
                'options' => [
                    'To make the system run faster',
                    'To verify that a person is who they claim to be before creating an account',
                    'To reduce the cost of the system',
                    'To eliminate the need for passwords'
                ],
                'correct_options' => ['To verify that a person is who they claim to be before creating an account'],
                'justifications' => [
                    'Incorrect - Identity proofing is not about system performance',
                    'Correct - Identity proofing ensures the person requesting an account is legitimate',
                    'Incorrect - Cost reduction is not the primary purpose of identity proofing',
                    'Incorrect - Identity proofing is separate from authentication methods'
                ],
                'bloom_level' => 2,
                'difficulty_level' => 2,
                'status' => 'published',
                'irt_a' => 1.4,
                'irt_b' => -1.2,
                'irt_c' => 0.25
            ],

            // BLOOM LEVEL 3 (Apply) - 16 questions
            // Item 18
            [
                'topic' => 'Identification',
                'subtopic' => 'Identification',
                'question' => 'A university is struggling with orphaned accounts (accounts belonging to individuals no longer affiliated) in its alumni portal, posing a security risk. They want to implement a process to address this. Which identity lifecycle process, if implemented effectively, would directly mitigate the issue of orphaned accounts?',
                'type_id' => 1,
                'options' => [
                    'Automated provisioning based on enrollment data',
                    'Regular identity proofing of existing users',
                    'Automated de-provisioning triggered by alumni status changes',
                    'Multi-factor authentication implementation'
                ],
                'correct_options' => ['Automated de-provisioning triggered by alumni status changes'],
                'justifications' => [
                    'Incorrect - Automated provisioning helps create accounts for new users but does not address existing orphaned accounts. This process occurs at the beginning of the identity lifecycle when users first need access, not when they should lose access.',
                    'Incorrect - Identity proofing verifies that users are who they claim to be during initial registration or authentication, but it does not remove accounts that should no longer exist. Regular identity proofing might identify some orphaned accounts but is not the primary solution.',
                    'Correct - Automated de-provisioning triggered by alumni status changes directly addresses orphaned accounts by systematically removing access when individuals are no longer affiliated with the university. This process monitors status changes and automatically disables or removes accounts when someone\'s affiliation ends.',
                    'Incorrect - Multi-factor authentication strengthens security by requiring additional verification factors, but it does not remove orphaned accounts. MFA may make it harder for unauthorized users to access orphaned accounts, but the accounts would still exist as a security risk.'
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'status' => 'published',
                'irt_a' => 1.4,
                'irt_b' => 0.2,
                'irt_c' => 0.25
            ],
            // Item 19
            [
                'topic' => 'Identification',
                'subtopic' => 'Identification',
                'question' => 'An organization extensively utilizes contractors and temporary staff, who often require time-limited access to various internal systems. To mitigate security risks, ensuring timely removal of their access when it\'s no longer needed is critical. Which of the following controls, integrated within the broader user provisioning process, is MOST EFFECTIVE at ensuring the prompt and complete revocation of system access for contractors and temporary users?',
                'type_id' => 1,
                'options' => [
                    'Implementing regular, manual audits of contractor accounts by IT staff',
                    'Basing contractor access on specific project end dates, with automated de-provisioning triggers',
                    'Requiring contractors to sign an agreement acknowledging their access will be terminated upon project completion',
                    'Using multi-factor authentication (MFA) for all contractor logins'
                ],
                'correct_options' => ['Basing contractor access on specific project end dates, with automated de-provisioning triggers'],
                'justifications' => [
                    'Incorrect - Manual audits are reactive and depend on human processes that can be delayed, inconsistent, or missed entirely. While useful as a secondary control, they cannot ensure "prompt" revocation as required for effective security. Manual processes are also resource-intensive and prone to human error.',
                    'Correct - Automated de-provisioning based on specific project end dates provides the most effective control for ensuring prompt and complete access revocation. This approach integrates directly into the provisioning process, uses predetermined criteria (project end dates), and executes automatically without relying on human intervention, ensuring consistent and timely access removal.',
                    'Incorrect - While agreements establish expectations and provide legal documentation, they are administrative controls that do not technically enforce access revocation. Contractors could theoretically retain access after project completion until manual action is taken, making this insufficient for ensuring prompt revocation.',
                    'Incorrect - MFA strengthens authentication security but does not address the core issue of access revocation timing. It makes unauthorized access more difficult but does not remove access when it\'s no longer needed. Contractors would still maintain their authenticated access beyond project completion.'
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'status' => 'published',
                'irt_a' => 1.3,
                'irt_b' => 0.1,
                'irt_c' => 0.25
            ],
            // Item 20
            [
                'topic' => 'Authentication',
                'subtopic' => 'Authentication',
                'question' => 'An organization is considering implementing a self-service password reset portal for its employees. This would reduce IT helpdesk calls but introduces a security risk if an unauthorized person attempts to reset an account. Which security measure would be most crucial to implement for the self-service password reset portal to minimize this security risk?',
                'type_id' => 1,
                'options' => [
                    'Requiring employees to provide their manager\'s email for approval',
                    'Implementing multi-factor authentication (MFA) for the password reset process itself',
                    'Limiting the number of password resets an employee can perform per day',
                    'Allowing only employees with specific IP addresses to access the portal'
                ],
                'correct_options' => ['Implementing multi-factor authentication (MFA) for the password reset process itself'],
                'justifications' => [
                    'Incorrect - Manager approval introduces delays and complexity while not providing strong technical verification of identity. It relies on human processes that can be circumvented through social engineering or compromised email accounts, and defeats the purpose of self-service by requiring third-party involvement.',
                    'Correct - MFA for the password reset process provides the strongest security control by requiring the user to authenticate using multiple factors (such as SMS, email verification, security questions, or authenticator apps) before allowing the password reset. This ensures that only the legitimate account owner can initiate the reset, directly addressing the core security risk.',
                    'Incorrect - Rate limiting helps prevent brute force attacks and reduces system abuse but does not address the fundamental security risk of unauthorized users successfully resetting passwords. An attacker who gains access to an employee\'s personal information could still perform a successful reset within the daily limits.',
                    'Incorrect - IP address restrictions are easily circumvented and impractical for modern workforces that include remote workers, mobile users, and employees traveling. This approach also provides weak security since IP addresses can be spoofed or legitimately shared, and doesn\'t verify the actual identity of the person making the request.'
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'status' => 'published',
                'irt_a' => 1.2,
                'irt_b' => 0.0,
                'irt_c' => 0.25
            ],
            // Item 21
            [
                'topic' => 'Identification',
                'subtopic' => 'Identification',
                'question' => 'Which of the following is the MOST critical when establishing a digital identity for a remote employee?',
                'type_id' => 1,
                'options' => [
                    'Assigning access rights',
                    'Conducting background verification',
                    'Verifying the identity using trusted sources',
                    'Creating an email account'
                ],
                'correct_options' => ['Verifying the identity using trusted sources'],
                'justifications' => [
                    'Incorrect - Assigning access rights is important but comes after establishing and verifying the digital identity. You cannot properly assign rights until you have confirmed who the person actually is. This is a subsequent step in the identity lifecycle process.',
                    'Incorrect - Background verification is typically part of the hiring process and occurs before digital identity establishment. While important for employment decisions, it does not directly establish the digital identity itself, which requires technical verification of the person\'s claimed identity.',
                    'Correct - Identity verification using trusted sources (such as government-issued documents, official HR records, or established identity proofing processes) is the foundational step in establishing a digital identity. Without proper identity verification, all subsequent steps lack legitimacy and security. This ensures the digital identity corresponds to a real, verified individual.',
                    'Incorrect - Creating an email account is a technical implementation step that comes after identity establishment and verification. An email account is a component of the digital identity infrastructure, but creating it without first verifying who should receive it would be a significant security risk.'
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'status' => 'published',
                'irt_a' => 1.5,
                'irt_b' => -0.2,
                'irt_c' => 0.25
            ],
            // Item 22
            [
                'topic' => 'Authorization',
                'subtopic' => 'Authorization',
                'question' => 'In which situation would role-based access control (RBAC) be more effective than discretionary access control (DAC)?',
                'type_id' => 1,
                'options' => [
                    'When employees share the same system credentials',
                    'When consistent access permissions are required across departments',
                    'When users need full control over resources they own',
                    'When access rights need to change frequently'
                ],
                'correct_options' => ['When consistent access permissions are required across departments'],
                'justifications' => [
                    'Incorrect - Sharing system credentials is a security violation and neither RBAC nor DAC should be designed to accommodate this practice. Both access control models assume individual accountability through unique user identities. This scenario indicates a fundamental security flaw that needs to be addressed before implementing any access control model.',
                    'Correct - RBAC excels when organizations need consistent, standardized access permissions across departments. RBAC defines roles based on job functions and organizational requirements, ensuring that users with similar responsibilities have identical access rights regardless of their department. This provides better administrative control, compliance, and security consistency compared to DAC\'s user-discretionary approach.',
                    'Incorrect - This scenario favors DAC over RBAC. Discretionary Access Control allows resource owners to determine who can access their resources and what level of access to grant. DAC is specifically designed for situations where users need flexibility and control over resources they create or own, while RBAC is more restrictive and centrally managed.',
                    'Incorrect - Frequent access changes typically favor DAC over RBAC. In DAC, resource owners can quickly modify access permissions without requiring administrative intervention. RBAC requires role modifications or role assignments to be changed, which usually involves administrative processes and may be slower for frequent, dynamic access changes.'
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'status' => 'published',
                'irt_a' => 1.6,
                'irt_b' => 0.1,
                'irt_c' => 0.2
            ],
            // Item 23
            [
                'topic' => 'Authorization',
                'subtopic' => 'Authorization',
                'question' => 'Which process BEST aligns with the principle of least privilege?',
                'type_id' => 1,
                'options' => [
                    'Assigning all new employees admin rights',
                    'Creating a single shared account per team',
                    'Assigning access based on job function and removing unused entitlements',
                    'Allowing access to all business applications by default'
                ],
                'correct_options' => ['Assigning access based on job function and removing unused entitlements'],
                'justifications' => [
                    'Incorrect - Assigning admin rights to all new employees violates the principle of least privilege by providing excessive permissions that most employees do not need for their job functions. This creates unnecessary security risks and potential for accidental or malicious misuse of administrative capabilities.',
                    'Incorrect - Shared accounts eliminate individual accountability and typically require broader permissions to accommodate multiple users\' needs, violating least privilege. Additionally, shared accounts make it impossible to track individual actions and prevent proper access control based on specific job requirements.',
                    'Correct - This approach perfectly embodies the principle of least privilege by providing users with only the minimum access necessary for their specific job functions, while actively removing unused entitlements to prevent privilege creep. This dual approach of precise initial provisioning and ongoing entitlement cleanup ensures users maintain only necessary access.',
                    'Incorrect - Default access to all business applications directly contradicts the principle of least privilege by providing broad access regardless of job requirements. This approach grants far more permissions than necessary and creates significant security risks from overprovisioning of access rights.'
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'status' => 'published',
                'irt_a' => 1.4,
                'irt_b' => -0.3,
                'irt_c' => 0.2
            ],
            // Item 24
            [
                'topic' => 'Authorization',
                'subtopic' => 'Authorization',
                'question' => 'A financial services company is implementing Just-In-Time (JIT) access across critical systems. What is the primary purpose of JIT access?',
                'type_id' => 1,
                'options' => [
                    'Provide constant, unrestricted access to improve response times',
                    'Grant immediate access upon request, reducing administrative delays',
                    'Limit access duration and scope to minimize unauthorized actions',
                    'Permanently revoke access after a specified period to enforce least privilege'
                ],
                'correct_options' => ['Limit access duration and scope to minimize unauthorized actions'],
                'justifications' => [
                    'Incorrect - Constant, unrestricted access directly contradicts the fundamental principle of JIT access. JIT is specifically designed to eliminate persistent access rights and instead provide temporary, controlled access only when needed. This option describes the opposite of what JIT access aims to achieve.',
                    'Incorrect - While JIT access does provide timely access when needed, its primary purpose is not speed or convenience but security. The focus on "immediate access" and "reducing delays" misses the core security objective of limiting exposure time and reducing the attack surface through time-bounded access controls.',
                    'Correct - This captures the essential purpose of JIT access: providing time-limited, scope-restricted access that minimizes the window of opportunity for unauthorized actions. JIT access implements temporal access controls that automatically expire, reducing persistent privileges and the associated security risks from standing access rights.',
                    'Incorrect - While JIT access does involve automatic revocation, "permanently revoke" is misleading since JIT access can be requested again when needed. The focus should be on temporary, time-bounded access rather than permanent revocation. Additionally, this option doesn\'t capture the time-limited nature that is central to JIT.'
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'status' => 'published',
                'irt_a' => 1.3,
                'irt_b' => 0.0,
                'irt_c' => 0.25
            ],
            // Item 25
            [
                'topic' => 'Identification',
                'subtopic' => 'Identification',
                'question' => 'Within an organization, multiple staff members are permitted to use a single, generic account (e.g., "shared_data_entry," "support_desk") to access a critical system. Which of the following represents the MAIN security concern arising from this practice?',
                'type_id' => 1,
                'options' => [
                    'Easily guessable password due to generic naming',
                    'Repudiation - inability to deny performed actions',
                    'Inability to trace account activities to specific individuals',
                    'Increased risk of account lockout from multiple users'
                ],
                'correct_options' => ['Inability to trace account activities to specific individuals'],
                'justifications' => [
                    'Incorrect - While generic account names might suggest predictable passwords, this is not the primary security concern. Password strength is a separate issue that can be addressed through password policies, and the main problem with shared accounts exists even with strong passwords.',
                    'Incorrect - Repudiation refers to denying that an action was performed. The main issue with shared accounts is not that users can deny actions, but that organizations cannot determine who performed specific actions in the first place. This confuses the concept of non-repudiation with accountability.',
                    'Correct - The fundamental security flaw of shared accounts is the complete loss of individual accountability and audit trails. When multiple people use the same account, it becomes impossible to determine which specific individual performed any given action, making investigation, compliance, and security monitoring extremely difficult or impossible.',
                    'Incorrect - Account lockout is an operational inconvenience rather than a security concern. While multiple users sharing credentials might lead to lockout issues, this does not represent the primary security risk associated with shared accounts, which is the loss of individual accountability.'
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'status' => 'published',
                'irt_a' => 1.4,
                'irt_b' => -0.1,
                'irt_c' => 0.25
            ],
            // Item 26
            [
                'topic' => 'Accounting (Auditing)',
                'subtopic' => 'Accounting (Auditing)',
                'question' => 'The PRIMARY purpose of audit trails is to:',
                'type_id' => 1,
                'options' => [
                    'Enforce user access restrictions in real-time',
                    'Track system performance and resource utilization',
                    'Enable accountability and support incident investigation',
                    'Prevent unauthorized access through proactive alerts'
                ],
                'correct_options' => ['Enable accountability and support incident investigation'],
                'justifications' => [
                    'Incorrect - Real-time access enforcement is the function of access control systems and authorization mechanisms, not audit trails. Audit trails are passive logging mechanisms that record what has already happened, rather than actively preventing or controlling actions as they occur.',
                    'Incorrect - While audit logs may contain some performance-related information, tracking system performance and resource utilization is primarily the function of monitoring and performance management systems. Audit trails focus on security-relevant events and user actions rather than system metrics.',
                    'Correct - The primary purpose of audit trails is to provide a detailed, chronological record of user activities and system events that enables accountability (determining who did what and when) and supports incident investigation by providing forensic evidence of actions taken within the system.',
                    'Incorrect - Proactive alerts and prevention of unauthorized access are functions of intrusion detection systems, access control mechanisms, and real-time monitoring systems. Audit trails are reactive logging systems that document events after they occur, not preventive security controls.'
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'status' => 'published',
                'irt_a' => 1.3,
                'irt_b' => -0.2,
                'irt_c' => 0.2
            ],
            // Item 27
            [
                'topic' => 'Authorization',
                'subtopic' => 'Authorization',
                'question' => 'An attacker successfully compromises an administrator account through credential theft. Which of the following controls would be MOST effective in limiting the damage from this breach?',
                'type_id' => 1,
                'options' => [
                    'Multifactor authentication',
                    'Audit logging',
                    'Least privilege',
                    'Password policy'
                ],
                'correct_options' => ['Least privilege'],
                'justifications' => [
                    'Incorrect - While MFA would have helped prevent the initial compromise, once the attacker has successfully compromised the administrator account (as stated in the scenario), MFA is no longer effective at limiting damage. The attacker has already bypassed the authentication controls.',
                    'Incorrect - Audit logging is important for detection and forensic analysis after the fact, but it does not actively limit or reduce the damage that an attacker can cause during the breach. It provides visibility but not prevention of malicious actions.',
                    'Correct - Least privilege is the most effective control for limiting damage once an account is compromised. If the administrator account only has the minimum permissions necessary for its functions rather than broad administrative access, the attacker\'s ability to cause damage is significantly constrained by the limited scope of available actions.',
                    'Incorrect - Password policy would have been relevant for preventing the initial credential theft, but once the account is already compromised (as stated in the scenario), password policy requirements do not limit the damage the attacker can cause with the stolen credentials.'
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'status' => 'published',
                'irt_a' => 1.5,
                'irt_b' => 0.1,
                'irt_c' => 0.25
            ],
            // Item 28
            [
                'topic' => 'Authentication',
                'subtopic' => 'Authentication',
                'question' => 'A user logs in with a username/password and then enters a code from an app on their phone. What type of authentication is this?',
                'type_id' => 1,
                'options' => [
                    'Two-factor authentication (2FA)',
                    'Single sign-on',
                    'Role-based access control',
                    'Knowledge-based authentication'
                ],
                'correct_options' => ['Two-factor authentication (2FA)'],
                'justifications' => [
                    'Correct - This scenario demonstrates two-factor authentication by combining something the user knows (username/password) with something the user has (phone app generating codes). These represent two different authentication factors: knowledge factor and possession factor, which is the defining characteristic of 2FA.',
                    'Incorrect - Single sign-on (SSO) refers to the ability to access multiple applications with one set of credentials, not the use of multiple authentication factors. SSO is about convenience and centralized authentication, while this scenario is about using multiple factors for stronger security.',
                    'Incorrect - Role-based access control (RBAC) is an authorization mechanism that determines what users can do after they are authenticated, not an authentication method. RBAC assigns permissions based on user roles, while this scenario describes the authentication process itself.',
                    'Incorrect - Knowledge-based authentication relies solely on something the user knows (passwords, security questions, PINs). This scenario includes both knowledge (password) and possession (phone app) factors, making it multi-factor rather than purely knowledge-based authentication.'
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'status' => 'published',
                'irt_a' => 1.2,
                'irt_b' => -0.4,
                'irt_c' => 0.2
            ],
            // Item 29
            [
                'topic' => 'Authentication',
                'subtopic' => 'Authentication',
                'question' => 'What is the PRIMARY security benefit of passwordless authentication?',
                'type_id' => 1,
                'options' => [
                    'Easier account recovery',
                    'Elimination of phishing risks',
                    'Increased password complexity',
                    'Compatibility with legacy systems'
                ],
                'correct_options' => ['Elimination of phishing risks'],
                'justifications' => [
                    'Incorrect - While passwordless authentication may simplify some aspects of account recovery, this is primarily an operational benefit rather than a security benefit. The primary security advantage lies in eliminating credential-based attacks, not improving recovery processes.',
                    'Correct - Passwordless authentication eliminates phishing risks because there are no passwords or shared secrets that can be stolen through deceptive techniques. Since users authenticate using cryptographic keys, biometrics, or hardware tokens rather than knowledge-based credentials, traditional phishing attacks that trick users into revealing passwords become ineffective.',
                    'Incorrect - This option is contradictory since passwordless authentication eliminates passwords entirely rather than making them more complex. Increased password complexity is a security measure for password-based systems, not a benefit of removing passwords altogether.',
                    'Incorrect - Passwordless authentication typically requires modern systems and protocols, and often has limited compatibility with legacy systems that were designed around password-based authentication. This represents a potential drawback rather than a security benefit of passwordless authentication.'
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'status' => 'published',
                'irt_a' => 1.4,
                'irt_b' => 0.0,
                'irt_c' => 0.25
            ],
            // Item 30
            [
                'topic' => 'Authentication',
                'subtopic' => 'Authentication',
                'question' => 'In the context of multi-factor authentication, what does "something you are" refer to?',
                'type_id' => 1,
                'options' => [
                    'A secret question or phrase',
                    'A physical token or smart card',
                    'A biometric characteristic',
                    'A specific location or IP address'
                ],
                'correct_options' => ['A biometric characteristic'],
                'justifications' => [
                    'Incorrect - A secret question or phrase represents "something you know" (knowledge factor), not "something you are." This is information that the user has memorized or learned, which falls into the knowledge-based authentication category.',
                    'Incorrect - A physical token or smart card represents "something you have" (possession factor), not "something you are." These are physical objects that the user possesses and can be lost, stolen, or transferred to others.',
                    'Correct - "Something you are" refers to inherence factors, which are biometric characteristics unique to an individual such as fingerprints, facial recognition, iris scans, voice patterns, or other biological or behavioral traits that are inherent to the person and cannot be easily transferred or replicated.',
                    'Incorrect - A specific location or IP address represents "somewhere you are" (location factor), which is sometimes considered a fourth authentication factor. This is contextual information about the user\'s physical or network location, not an inherent characteristic of the person themselves.'
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'status' => 'published',
                'irt_a' => 1.1,
                'irt_b' => -0.5,
                'irt_c' => 0.2
            ],
            // Item 31
            [
                'topic' => 'Authorization',
                'subtopic' => 'Authorization',
                'question' => 'Which access control model allows the resource owner to decide who can access data?',
                'type_id' => 1,
                'options' => [
                    'Mandatory Access Control',
                    'Discretionary Access Control',
                    'Role-Based Access Control',
                    'Attribute-Based Access Control'
                ],
                'correct_options' => ['Discretionary Access Control'],
                'justifications' => [
                    'Incorrect - Mandatory Access Control (MAC) uses system-enforced policies based on security labels and classifications, where access decisions are made by the system according to predefined rules, not by individual resource owners. Users cannot override or modify these centrally-controlled access policies.',
                    'Correct - Discretionary Access Control (DAC) specifically allows resource owners (typically the creators or designated owners of data/resources) to determine who can access their resources and what level of access to grant. This "discretionary" nature gives owners the flexibility to make access decisions based on their judgment.',
                    'Incorrect - Role-Based Access Control (RBAC) grants access based on predefined organizational roles and job functions, with access decisions made by administrators who assign users to roles and define role permissions. Individual resource owners do not control access decisions in RBAC systems.',
                    'Incorrect - Attribute-Based Access Control (ABAC) uses policies that evaluate multiple attributes (user, resource, environment, action) to make access decisions through centralized policy engines. While more flexible than RBAC, access decisions are still made by the system based on predefined policies, not by individual resource owners.'
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'status' => 'published',
                'irt_a' => 1.3,
                'irt_b' => -0.2,
                'irt_c' => 0.2
            ],
            // Item 32
            [
                'topic' => 'Authorization',
                'subtopic' => 'Authorization',
                'question' => 'What is the key benefit of Just-In-Time (JIT) privileged access?',
                'type_id' => 1,
                'options' => [
                    'Simplifies identity provisioning',
                    'Minimizes standing access to sensitive systems',
                    'Eliminates the need for role reviews',
                    'Ensures permanent admin credentials'
                ],
                'correct_options' => ['Minimizes standing access to sensitive systems'],
                'justifications' => [
                    'Incorrect - JIT privileged access primarily focuses on temporal access control rather than simplifying identity provisioning. While it may have some impact on provisioning processes, its main value is in reducing persistent privileges, not streamlining user account creation.',
                    'Correct - The key benefit of JIT privileged access is minimizing standing (persistent) access to sensitive systems by providing temporary, time-limited elevated privileges only when needed. This reduces the attack surface and limits the window of opportunity for credential compromise or insider threats.',
                    'Incorrect - JIT does not eliminate the need for role reviews. Regular access reviews remain necessary to ensure that users should have the ability to request JIT access and that the scope of JIT permissions remains appropriate for their roles and responsibilities.',
                    'Incorrect - This directly contradicts the purpose of JIT access. JIT specifically eliminates permanent admin credentials by providing temporary, time-bounded access instead of persistent administrative privileges.'
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'status' => 'published',
                'irt_a' => 1.3,
                'irt_b' => 0.1,
                'irt_c' => 0.25
            ],
            // Item 33
            [
                'topic' => 'Authorization',
                'subtopic' => 'Authorization',
                'question' => 'A PAM solution helps reduce insider threats by:',
                'type_id' => 1,
                'options' => [
                    'Granting permanent root access',
                    'Logging and monitoring admin sessions',
                    'Removing multifactor authentication',
                    'Encrypting all user communications'
                ],
                'correct_options' => ['Logging and monitoring admin sessions'],
                'justifications' => [
                    'Incorrect - Granting permanent root access would increase insider threat risks, not reduce them. PAM solutions specifically work to eliminate standing privileges and provide temporary, controlled access instead of permanent elevated permissions.',
                    'Correct - Privileged Access Management (PAM) solutions reduce insider threats primarily through comprehensive logging and real-time monitoring of administrative sessions. This provides visibility into privileged user activities, enables detection of suspicious behavior, and creates audit trails for forensic analysis.',
                    'Incorrect - Removing MFA would weaken security and increase insider threat risks. PAM solutions typically enhance authentication requirements for privileged access, often requiring additional verification steps beyond standard user authentication.',
                    'Incorrect - While encryption may be a component of PAM solutions, encrypting user communications is not the primary mechanism for reducing insider threats. The key value is in monitoring and controlling privileged access, not general communication encryption.'
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'status' => 'published',
                'irt_a' => 1.4,
                'irt_b' => -0.1,
                'irt_c' => 0.2
            ],

            // BLOOM LEVEL 4 (Analyze) - 10 questions
            // Item 34
            [
                'topic' => 'Authorization',
                'subtopic' => 'Authorization',
                'question' => 'A security audit finds that users in the Sales department have access to developer systems. This is a violation of:',
                'type_id' => 1,
                'options' => [
                    'Role inheritance',
                    'Mandatory access enforcement',
                    'Least privilege',
                    'RBAC granularity'
                ],
                'correct_options' => ['Least privilege'],
                'justifications' => [
                    'Incorrect - Role inheritance refers to roles automatically gaining permissions from parent roles in a hierarchy. While poor role design might contribute to this issue, the fundamental problem is that users have more access than needed for their job functions, not a role hierarchy issue.',
                    'Incorrect - Mandatory access enforcement relates to system-controlled access policies based on security labels and classifications. This scenario describes users having inappropriate functional access, not a failure of mandatory access controls based on security classifications.',
                    'Correct - This is a clear violation of the least privilege principle, which states that users should only have the minimum access necessary to perform their job functions. Sales department users do not need access to developer systems to perform their sales-related duties.',
                    'Incorrect - RBAC granularity refers to how finely permissions are divided within role-based access control. While better role granularity might help address this issue, the core problem is a violation of least privilege rather than insufficient role granularity.'
                ],
                'bloom_level' => 4,
                'difficulty_level' => 3,
                'status' => 'published',
                'irt_a' => 1.2,
                'irt_b' => -0.3,
                'irt_c' => 0.2
            ],
            // Item 35
            [
                'topic' => 'Authorization',
                'subtopic' => 'Authorization',
                'question' => 'A file server is configured such that the owner of a document can grant or revoke access permissions to other users at their discretion. For example, a user who creates a document can decide who can read, write, or delete it. Which access control model is primarily being demonstrated in this scenario?',
                'type_id' => 1,
                'options' => [
                    'Mandatory Access Control (MAC)',
                    'Discretionary Access Control (DAC)',
                    'Role-Based Access Control (RBAC)',
                    'Attribute-Based Access Control (ABAC)'
                ],
                'correct_options' => ['Discretionary Access Control (DAC)'],
                'justifications' => [
                    'Incorrect - Mandatory Access Control uses system-enforced policies based on security labels and classifications. In MAC, individual users cannot make discretionary decisions about who can access their files; access is determined by comparing security labels and clearances according to predefined system policies.',
                    'Correct - Discretionary Access Control allows resource owners to make access control decisions at their discretion. The key characteristic described in the scenario - where document owners can grant or revoke permissions to other users based on their own judgment - is the defining feature of DAC.',
                    'Incorrect - Role-Based Access Control grants access based on predefined organizational roles and job functions. In RBAC, access decisions are made by administrators who assign users to roles, not by individual resource owners making discretionary choices about their specific documents.',
                    'Incorrect - Attribute-Based Access Control uses policies that evaluate multiple attributes (user, resource, environment, action) through centralized policy engines. While ABAC is flexible, access decisions are made by the system based on predefined policies, not by individual resource owners exercising discretion.'
                ],
                'bloom_level' => 4,
                'difficulty_level' => 3,
                'status' => 'published',
                'irt_a' => 1.4,
                'irt_b' => -0.2,
                'irt_c' => 0.2
            ],
            // Item 36
            [
                'topic' => 'Authorization',
                'subtopic' => 'Authorization',
                'question' => 'Discretionary Access Control (DAC) is based on:',
                'type_id' => 1,
                'options' => [
                    'Security labels and classifications assigned by the system',
                    'Decisions made by the object owner regarding permissions',
                    'Predefined roles assigned to users',
                    'Attributes of the subject, object, and environment'
                ],
                'correct_options' => ['Decisions made by the object owner regarding permissions'],
                'justifications' => [
                    'Incorrect - Security labels and classifications assigned by the system are the foundation of Mandatory Access Control (MAC), not DAC. In MAC, the system enforces access policies based on comparing security clearances and classifications, without allowing individual discretionary decisions.',
                    'Correct - Discretionary Access Control is fundamentally based on decisions made by the object owner (resource owner) regarding who can access their resources and what permissions to grant. This discretionary decision-making by owners is the defining characteristic that distinguishes DAC from other access control models.',
                    'Incorrect - Predefined roles assigned to users are the basis of Role-Based Access Control (RBAC), not DAC. In RBAC, access is determined by the roles users are assigned to, and permissions are grouped by organizational functions rather than individual owner discretion.',
                    'Incorrect - Attributes of the subject, object, and environment are the foundation of Attribute-Based Access Control (ABAC), not DAC. ABAC uses policy engines that evaluate multiple attributes to make access decisions, rather than relying on individual owner discretion.'
                ],
                'bloom_level' => 4,
                'difficulty_level' => 3,
                'status' => 'published',
                'irt_a' => 1.3,
                'irt_b' => -0.3,
                'irt_c' => 0.2
            ],
            // Item 37
            [
                'topic' => 'Authorization',
                'subtopic' => 'Authorization',
                'question' => 'Rule Based Access Control (RuBAC) is based on:',
                'type_id' => 1,
                'options' => [
                    'Labels and clearances',
                    'The discretion of the object owner',
                    'The role of the subject',
                    'IF/THEN statements'
                ],
                'correct_options' => ['IF/THEN statements'],
                'justifications' => [
                    'Incorrect - Labels and clearances are the foundation of Mandatory Access Control (MAC), where access decisions are based on comparing security classifications and user clearances. RuBAC does not rely on security labels or clearance levels.',
                    'Incorrect - The discretion of the object owner is the defining characteristic of Discretionary Access Control (DAC), where resource owners decide who can access their resources. RuBAC follows predefined rules rather than individual discretionary decisions.',
                    'Incorrect - The role of the subject is the basis for Role-Based Access Control (RBAC), where access is determined by organizational roles and job functions. While RuBAC may incorporate role information, it is not fundamentally based on roles.',
                    'Correct - Rule Based Access Control (RuBAC) is fundamentally based on IF/THEN conditional statements that define specific rules for access decisions. These rules specify conditions (IF) and resulting actions (THEN), creating automated, policy-driven access control based on predefined logical conditions.'
                ],
                'bloom_level' => 4,
                'difficulty_level' => 3,
                'status' => 'published',
                'irt_a' => 1.2,
                'irt_b' => -0.4,
                'irt_c' => 0.2
            ],
            // Item 38
            [
                'topic' => 'Authorization',
                'subtopic' => 'Authorization',
                'question' => 'Lisa, a software engineer, creates a confidential design document and stores it on the company\'s shared drive. She manually grants read access to her team members but restricts edits to herself. Later, she decides to revoke access from one colleague who no longer needs it. Which access control model is being used in this scenario?',
                'type_id' => 1,
                'options' => [
                    'Role-Based Access Control (RBAC)',
                    'Mandatory Access Control (MAC)',
                    'Discretionary Access Control (DAC)',
                    'Attribute-Based Access Control (ABAC)'
                ],
                'correct_options' => ['Discretionary Access Control (DAC)'],
                'justifications' => [
                    'Incorrect - RBAC would grant access based on predefined organizational roles (e.g., "Software Engineer" role), with administrators managing role assignments. In this scenario, Lisa is making individual, discretionary decisions about specific colleagues, not relying on role-based permissions.',
                    'Incorrect - MAC uses system-enforced policies based on security labels and clearances, where individual users cannot make access decisions. The system would determine access based on comparing security classifications, not allowing Lisa to manually grant or revoke permissions.',
                    'Correct - This scenario demonstrates DAC because Lisa, as the document owner, is making discretionary decisions about who can access her document. She manually grants read access to specific team members, restricts editing to herself, and later revokes access from a colleague - all key characteristics of discretionary access control.',
                    'Incorrect - ABAC uses policy engines that evaluate multiple attributes (user, resource, environment, action) to make access decisions automatically. Lisa\'s manual, discretionary permission management does not involve automated policy evaluation based on attributes.'
                ],
                'bloom_level' => 4,
                'difficulty_level' => 3,
                'status' => 'published',
                'irt_a' => 1.3,
                'irt_b' => -0.1,
                'irt_c' => 0.2
            ],
            // Item 39
            [
                'topic' => 'Authorization',
                'subtopic' => 'Authorization',
                'question' => 'Alex, a military intelligence analyst with Top Secret clearance, tries to access a classified cyber-warfare strategy document stored on a system enforcing Mandatory Access Control (MAC) with Multi-Level Security (MLS). Despite having the correct clearance, Alex receives an "Access Denied" error. Other Top Secret users working on the same project can access the file. What is the most likely reason for the denial?',
                'type_id' => 1,
                'options' => [
                    'Alex\'s job role does not grant access to classified documents',
                    'Alex does not have a need-to-know for this specific document',
                    'The document is classified at a lower security level than Top Secret',
                    'Alex requires additional system privileges to open the file'
                ],
                'correct_options' => ['Alex does not have a need-to-know for this specific document'],
                'justifications' => [
                    'Incorrect - The scenario states Alex is a military intelligence analyst with Top Secret clearance, indicating their job role does involve classified document access. Having Top Secret clearance demonstrates that their role has been approved for classified work.',
                    'Correct - In MAC/MLS systems, having the appropriate security clearance is necessary but not sufficient for access. The principle of "need-to-know" requires that users must also have a legitimate business requirement to access specific classified information. Other Top Secret users can access it because they are working on the same project and have established need-to-know.',
                    'Incorrect - If the document were classified at a lower level than Top Secret, Alex would have access since higher clearances typically allow access to lower-classified materials. The access denial suggests additional restrictions beyond just clearance level.',
                    'Incorrect - System privileges are separate from security clearances and classification-based access controls. MAC/MLS systems enforce access based on security labels and clearances, not system-level administrative privileges.'
                ],
                'bloom_level' => 4,
                'difficulty_level' => 3,
                'status' => 'published',
                'irt_a' => 1.5,
                'irt_b' => 0.2,
                'irt_c' => 0.25
            ],
            // Item 40
            [
                'topic' => 'Accounting (Auditing)',
                'subtopic' => 'Accounting (Auditing)',
                'question' => 'A security analyst is reviewing logs from a web server. They notice a sudden surge in failed login attempts for a specific user account originating from multiple, geographically diverse IP addresses within a short period. Which type of activity is this log entry most indicative of?',
                'type_id' => 1,
                'options' => [
                    'Normal user activity from a traveling employee',
                    'A distributed denial-of-service (DDoS) attack',
                    'A credential stuffing or brute-force attack',
                    'A successful phishing attempt'
                ],
                'correct_options' => ['A credential stuffing or brute-force attack'],
                'justifications' => [
                    'Incorrect - Normal user activity from a traveling employee would typically show successful logins eventually, and would not involve simultaneous attempts from multiple geographically diverse locations within a short time period. Legitimate travel patterns also don\'t generate surges of failed login attempts.',
                    'Incorrect - A DDoS attack targets system availability by overwhelming resources with traffic, not targeting specific user accounts with login attempts. DDoS attacks focus on service disruption rather than credential compromise, and the pattern described is too targeted for a typical DDoS.',
                    'Correct - The pattern of multiple failed login attempts for a specific user account from geographically diverse IP addresses within a short time period is characteristic of credential stuffing (using lists of compromised credentials) or distributed brute-force attacks attempting to guess the user\'s password.',
                    'Incorrect - A successful phishing attempt would result in successful logins using legitimate credentials, not failed login attempts. Phishing involves tricking users into providing credentials, which would then be used successfully rather than generating failed attempts.'
                ],
                'bloom_level' => 4,
                'difficulty_level' => 3,
                'status' => 'published',
                'irt_a' => 1.3,
                'irt_b' => 0.0,
                'irt_c' => 0.2
            ],
            // Item 41
            [
                'topic' => 'Authorization',
                'subtopic' => 'Authorization',
                'question' => 'Elevation of Privilege threats typically involve:',
                'type_id' => 1,
                'options' => [
                    'An attacker posing as another user',
                    'Unauthorized access to sensitive information',
                    'Gaining higher-level permissions than those originally granted',
                    'Overloading the system to cause it to crash'
                ],
                'correct_options' => ['Gaining higher-level permissions than those originally granted'],
                'justifications' => [
                    'Incorrect - An attacker posing as another user describes spoofing or impersonation attacks, not elevation of privilege. While impersonation might be used as a technique within a broader attack, it is not the defining characteristic of privilege escalation.',
                    'Incorrect - Unauthorized access to sensitive information describes information disclosure threats, not elevation of privilege. While elevated privileges might lead to information disclosure, the core threat of privilege escalation is about gaining unauthorized permissions, not accessing specific data.',
                    'Correct - Elevation of Privilege (EoP) threats specifically involve an attacker gaining higher-level permissions or access rights than they were originally authorized to have. This could include escalating from user-level to administrator privileges, or gaining access to restricted functions or resources beyond their intended scope.',
                    'Incorrect - Overloading the system to cause crashes describes denial of service (DoS) attacks, not elevation of privilege. While privilege escalation might be used to launch DoS attacks, the fundamental threat of EoP is about unauthorized permission acquisition, not system availability.'
                ],
                'bloom_level' => 4,
                'difficulty_level' => 3,
                'status' => 'published',
                'irt_a' => 1.2,
                'irt_b' => -0.3,
                'irt_c' => 0.2
            ],
            // Item 42
            [
                'topic' => 'Authorization',
                'subtopic' => 'Authorization',
                'question' => 'Compare these two access control models for a healthcare system: 1) Role-based with "Doctor," "Nurse," "Administrator" roles, 2) Attribute-based considering role, department, patient relationship, and time. Which is more appropriate and why?',
                'type_id' => 1,
                'options' => [
                    'RBAC is always sufficient for healthcare environments',
                    'ABAC provides better compliance with healthcare privacy regulations like HIPAA',
                    'Both models provide identical security outcomes',
                    'Access control models don\'t matter in healthcare'
                ],
                'correct_options' => ['ABAC provides better compliance with healthcare privacy regulations like HIPAA'],
                'justifications' => [
                    'Incorrect - Healthcare has complex access requirements that may exceed simple role-based controls',
                    'Correct - ABAC can enforce "need to know" and patient-provider relationships required by healthcare regulations',
                    'Incorrect - RBAC and ABAC have different capabilities and granularity levels',
                    'Incorrect - Healthcare requires strict access controls due to regulatory requirements'
                ],
                'bloom_level' => 4,
                'difficulty_level' => 3,
                'status' => 'published',
                'irt_a' => 1.4,
                'irt_b' => 0.2,
                'irt_c' => 0.2
            ],
            // Item 43
            [
                'topic' => 'Accounting (Auditing)',
                'subtopic' => 'Accounting (Auditing)',
                'question' => 'Analyze this scenario: Audit logs show 500 failed login attempts for user "admin" in 1 hour, then 1 successful login. What does this pattern suggest and what should be investigated?',
                'type_id' => 1,
                'options' => [
                    'The admin user simply forgot their password multiple times',
                    'This indicates a likely brute force attack followed by compromise',
                    'Failed login attempts are normal and don\'t require investigation',
                    'The successful login proves the account is secure'
                ],
                'correct_options' => ['This indicates a likely brute force attack followed by compromise'],
                'justifications' => [
                    'Incorrect - 500 attempts in one hour exceeds normal user behavior',
                    'Correct - This pattern strongly suggests automated attack followed by successful compromise',
                    'Incorrect - High-volume failed attempts require immediate investigation',
                    'Incorrect - The successful login after many failures suggests the attack succeeded'
                ],
                'bloom_level' => 4,
                'difficulty_level' => 3,
                'status' => 'published',
                'irt_a' => 1.4,
                'irt_b' => 0.2,
                'irt_c' => 0.2
            ],

            // BLOOM LEVEL 5 (Evaluate) - 7 questions
            // Item 44
            [
                'topic' => 'Federation & Advanced IAM',
                'subtopic' => 'Federation & Advanced IAM',
                'question' => 'Evaluate the trade-offs between implementing Zero Trust Architecture vs. traditional perimeter-based security for identity management. Which approach better addresses modern threats?',
                'type_id' => 1,
                'options' => [
                    'Traditional perimeter security is always more cost-effective and secure',
                    'Zero Trust better addresses insider threats, cloud adoption, and remote work realities',
                    'Both approaches are identical in security outcomes',
                    'Security architecture choice doesn\'t impact identity management'
                ],
                'correct_options' => ['Zero Trust better addresses insider threats, cloud adoption, and remote work realities'],
                'justifications' => [
                    'Incorrect - Traditional perimeter security has proven inadequate against modern threats',
                    'Correct - Zero Trust\'s "never trust, always verify" approach addresses current threat landscape',
                    'Incorrect - These architectures have fundamentally different security assumptions',
                    'Incorrect - Architecture choices significantly impact identity management requirements'
                ],
                'bloom_level' => 5,
                'difficulty_level' => 4,
                'status' => 'published',
                'irt_a' => 1.8,
                'irt_b' => 1,
                'irt_c' => 0.2
            ],
            // Item 45
            [
                'topic' => 'Authorization',
                'subtopic' => 'Authorization',
                'question' => 'Critique this access control strategy: "We use AI/ML to automatically grant and revoke access based on user behavior patterns." What are the potential benefits and risks?',
                'type_id' => 1,
                'options' => [
                    'AI/ML access control is always perfect and should replace all human oversight',
                    'Benefits include adaptability and efficiency; risks include bias, false positives, and lack of explainability',
                    'AI/ML should never be used in security decisions',
                    'The technology doesn\'t matter, only policies matter'
                ],
                'correct_options' => ['Benefits include adaptability and efficiency; risks include bias, false positives, and lack of explainability'],
                'justifications' => [
                    'Incorrect - AI/ML systems have limitations and require human oversight',
                    'Correct - AI/ML offers benefits but requires careful implementation and monitoring for risks',
                    'Incorrect - AI/ML can enhance security when properly implemented with appropriate controls',
                    'Incorrect - Technology implementation significantly impacts security effectiveness'
                ],
                'bloom_level' => 5,
                'difficulty_level' => 4,
                'status' => 'published',
                'irt_a' => 1.8,
                'irt_b' => 0.9,
                'irt_c' => 0.2
            ],
            // Item 46
            [
                'topic' => 'Authentication',
                'subtopic' => 'Authentication',
                'question' => 'Assess the long-term viability of password-based authentication vs. passwordless authentication. Which direction should organizations move toward and why?',
                'type_id' => 1,
                'options' => [
                    'Passwords will always be necessary and sufficient for security',
                    'Passwordless authentication offers better security and user experience but requires careful implementation',
                    'Authentication methods don\'t affect security outcomes',
                    'Organizations should never change authentication methods'
                ],
                'correct_options' => ['Passwordless authentication offers better security and user experience but requires careful implementation'],
                'justifications' => [
                    'Incorrect - Passwords have well-documented security and usability limitations',
                    'Correct - Passwordless authentication addresses many current authentication challenges',
                    'Incorrect - Authentication methods significantly impact both security and user experience',
                    'Incorrect - Organizations must evolve their authentication to address changing threats'
                ],
                'bloom_level' => 5,
                'difficulty_level' => 4,
                'status' => 'published',
                'irt_a' => 1.1,
                'irt_b' => 1,
                'irt_c' => 0.2
            ],
            // Item 47
            [
                'topic' => 'Identification',
                'subtopic' => 'Identification',
                'question' => 'Evaluate the privacy implications of comprehensive identity management systems that collect and correlate user behavior across all applications. How should organizations balance security monitoring with privacy rights?',
                'type_id' => 1,
                'options' => [
                    'Security always takes priority over privacy concerns',
                    'Privacy always takes priority over security monitoring',
                    'Implement privacy-preserving monitoring with data minimization, consent, and purpose limitation',
                    'Identity management systems should not collect any user data'
                ],
                'correct_options' => ['Implement privacy-preserving monitoring with data minimization, consent, and purpose limitation'],
                'justifications' => [
                    'Incorrect - Privacy rights must be balanced with security requirements',
                    'Incorrect - Security monitoring is necessary but must respect privacy principles',
                    'Correct - Privacy-by-design approaches can balance security needs with privacy rights',
                    'Incorrect - Some data collection is necessary for security and functionality'
                ],
                'bloom_level' => 5,
                'difficulty_level' => 4,
                'status' => 'published',
                'irt_a' => 1.4,
                'irt_b' => 1.3,
                'irt_c' => 0.2
            ],
            // Item 48
            [
                'topic' => 'Accounting (Auditing)',
                'subtopic' => 'Accounting (Auditing)',
                'question' => 'Judge the effectiveness of this audit approach: "We review 100% of privileged account access monthly, 10% of standard user access quarterly, and investigate all anomalies." Is this sufficient for a 10,000-user organization?',
                'type_id' => 1,
                'options' => [
                    'This approach is excessive and wastes resources',
                    'The approach is reasonable but should include risk-based sampling and automated analysis',
                    'Only privileged accounts need monitoring',
                    'Manual review is always better than automated analysis'
                ],
                'correct_options' => ['The approach is reasonable but should include risk-based sampling and automated analysis'],
                'justifications' => [
                    'Incorrect - Comprehensive monitoring is necessary for large organizations',
                    'Correct - The approach is good but needs enhancement with automation and risk-based priorities',
                    'Incorrect - Standard user accounts can also pose risks and need monitoring',
                    'Incorrect - Automated analysis is necessary for scalability and consistency'
                ],
                'bloom_level' => 5,
                'difficulty_level' => 4,
                'status' => 'published',
                'irt_a' => 1.7,
                'irt_b' => 1.5,
                'irt_c' => 0.2
            ],
            // Item 49
            [
                'topic' => 'Federation & Advanced IAM',
                'subtopic' => 'Federation & Advanced IAM',
                'question' => 'Critically evaluate this identity architecture decision: "We will use a single cloud identity provider for all applications instead of maintaining on-premises identity infrastructure." What factors should influence this decision?',
                'type_id' => 1,
                'options' => [
                    'Cloud identity providers are always more secure than on-premises solutions',
                    'On-premises solutions are always more secure than cloud providers',
                    'Evaluate based on security requirements, compliance needs, integration capabilities, and risk tolerance',
                    'The choice between cloud and on-premises doesn\'t affect security'
                ],
                'correct_options' => ['Evaluate based on security requirements, compliance needs, integration capabilities, and risk tolerance'],
                'justifications' => [
                    'Incorrect - Security depends on implementation quality, not just deployment model',
                    'Incorrect - Cloud providers often have better security resources than individual organizations',
                    'Correct - The decision should be based on comprehensive evaluation of multiple factors',
                    'Incorrect - Deployment architecture significantly impacts security, compliance, and functionality'
                ],
                'bloom_level' => 5,
                'difficulty_level' => 4,
                'status' => 'published',
                'irt_a' => 0.9,
                'irt_b' => 1.7,
                'irt_c' => 0.2
            ],
            // Item 50
            [
                'topic' => 'Authorization',
                'subtopic' => 'Authorization',
                'question' => 'Assess this proposed access control model: "Dynamic risk-based access that adjusts permissions in real-time based on user behavior, device security posture, network location, and data sensitivity." What are the implementation challenges and benefits?',
                'type_id' => 1,
                'options' => [
                    'This model is too complex and should not be implemented',
                    'This model offers optimal security but requires sophisticated infrastructure, clear policies, and user education',
                    'Static access controls are always more secure than dynamic ones',
                    'Risk-based access control doesn\'t provide any security benefits'
                ],
                'correct_options' => ['This model offers optimal security but requires sophisticated infrastructure, clear policies, and user education'],
                'justifications' => [
                    'Incorrect - Complexity is manageable with proper planning and implementation',
                    'Correct - Dynamic risk-based access provides better security but has significant implementation requirements',
                    'Incorrect - Dynamic controls can provide better security by adapting to changing conditions',
                    'Incorrect - Risk-based access control can significantly improve security posture'
                ],
                'bloom_level' => 5,
                'difficulty_level' => 4,
                'status' => 'published',
                'irt_a' => 1,
                'irt_b' => 1.6,
                'irt_c' => 0.2
            ]
        ];
    }
}