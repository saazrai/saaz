<?php

namespace Database\Seeders\Diagnostics;

use App\Models\DiagnosticItem;
use App\Models\DiagnosticTopic;


use Illuminate\Database\Seeder;

class D10AccessControlSeeder extends Seeder
{
    public function run(): void
    {
        // Get reference data
        $topics = DiagnosticTopic::whereHas('domain', function($query) {
            $query->where('name', 'Access Control');
        })->pluck('id', 'name');
        
        
        $items = [
            // Authentication Methods - Item 1
            [
                'topic_id' => $topics['Authentication & MFA'] ?? 200,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Which authentication factor is considered the most secure when used alone?',
                'options' => [
                    'Something you know (password)',
                    'Something you have (token)',
                    'Something you are (biometric)',
                    'All are equally secure'
                ],
                'correct_options' => ['Something you are (biometric)'],
                'justifications' => [
                    'Passwords can be guessed, shared, or stolen',
                    'Tokens can be lost, stolen, or cloned',
                    'Correct - Biometrics are unique to individuals and harder to forge or steal',
                    'Different factors have different security strengths'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            
            // Multi-Factor Authentication - Item 2
            [
                'topic_id' => $topics['Authentication & MFA'] ?? 200,
                'type_id' => 3,
                'dimension' => 'Technical',
                'content' => 'Select valid examples of multi-factor authentication:',
                'options' => [
                    'Password + PIN code',
                    'Password + SMS code',
                    'Fingerprint + facial recognition',
                    'Smart card + PIN',
                    'Username + password',
                    'Retina scan + voice recognition'
                ],
                'correct_options' => ['Password + SMS code', 'Smart card + PIN'],
                'justifications' => [
                    'Both are knowledge factors (something you know)',
                    'Combines knowledge and possession factors',
                    'Both are biometric factors (something you are)',
                    'Combines possession and knowledge factors',
                    'Only single factor (knowledge)',
                    'Both are biometric factors (something you are)'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Authorization Models - Item 3
            [
                'topic_id' => $topics['Access-Control Models'] ?? 201,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'In Role-Based Access Control (RBAC), permissions are assigned to:',
                'options' => [
                    'Individual users directly',
                    'Roles, which are then assigned to users',
                    'Resources directly',
                    'Applications only'
                ],
                'correct_options' => ['Roles, which are then assigned to users'],
                'justifications' => [
                    'That would be discretionary access control',
                    'Correct - RBAC assigns permissions to roles, users are assigned to roles',
                    'Resources receive permissions, not assign them',
                    'RBAC applies to all access, not just applications'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            
            // Access Control Models - Item 4
            [
                'topic_id' => $topics['Access-Control Models'] ?? 201,
                'type_id' => 5,
                'dimension' => 'Technical',
                'content' => 'Match each access control model with its primary characteristic:',
                'options' => [
                    'items' => [
                        'Mandatory Access Control (MAC)',
                        'Discretionary Access Control (DAC)',
                        'Attribute-Based Access Control (ABAC)',
                        'Rule-Based Access Control'
                    ],
                    'targets' => [
                        'Uses labels and clearance levels',
                        'Resource owners control access',
                        'Uses attributes of users, resources, and environment',
                        'Access determined by predefined rules'
                    ]
                ],
                'correct_options' => [
                    'Mandatory Access Control (MAC)' => 'Uses labels and clearance levels',
                    'Discretionary Access Control (DAC)' => 'Resource owners control access',
                    'Attribute-Based Access Control (ABAC)' => 'Uses attributes of users, resources, and environment',
                    'Rule-Based Access Control' => 'Access determined by predefined rules'
                ],
                'justifications' => [
                    'Mandatory Access Control (MAC)' => 'MAC uses security labels and clearance levels for access decisions',
                    'Discretionary Access Control (DAC)' => 'DAC allows resource owners to grant access at their discretion',
                    'Attribute-Based Access Control (ABAC)' => 'ABAC evaluates multiple attributes for fine-grained control',
                    'Rule-Based Access Control' => 'Uses specific rules like time-of-day or location'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            
            // Single Sign-On - Item 5
            [
                'topic_id' => $topics['Single Sign-On (SSO) & Kerberos'] ?? 202,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What is the primary security risk of Single Sign-On (SSO)?',
                'options' => [
                    'Increased password complexity',
                    'Single point of failure',
                    'Too many authentication attempts',
                    'Decreased user productivity'
                ],
                'correct_options' => ['Single point of failure'],
                'justifications' => [
                    'SSO typically reduces password complexity needs',
                    'Correct - If SSO is compromised, all connected systems are at risk',
                    'SSO reduces authentication attempts',
                    'SSO improves productivity by reducing logins'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            
            // Federation - Item 6
            [
                'topic_id' => $topics['Federation & Identity Protocols'] ?? 203,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'SAML is commonly used for:',
                'options' => [
                    'Database encryption',
                    'Federated identity management',
                    'Network segmentation',
                    'Malware detection'
                ],
                'correct_options' => ['Federated identity management'],
                'justifications' => [
                    'SAML is not an encryption protocol',
                    'Correct - Security Assertion Markup Language enables federated SSO',
                    'SAML is for authentication, not networking',
                    'SAML is not a security monitoring tool'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // OAuth vs SAML - Item 7
            [
                'topic_id' => $topics['Federation & Identity Protocols'] ?? 203,
                'type_id' => 2,
                'dimension' => 'Technical',
                'content' => '**True or False:** OAuth is primarily an authentication protocol, while SAML is primarily an authorization protocol.',
                'options' => [
                    'True',
                    'False'
                ],
                'correct_options' => ['False'],
                'justifications' => [
                    'explanation' => 'False. OAuth is primarily an authorization protocol that grants access to resources without sharing credentials. SAML is primarily an authentication protocol used for Single Sign-On. This is a common misconception.'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            
            // Privileged Access Management - Item 8
            [
                'topic_id' => $topics['Privileged Access Management (PAM)'] ?? 204,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What is the primary purpose of a Privileged Access Management (PAM) solution?',
                'options' => [
                    'Managing regular user passwords',
                    'Controlling and monitoring administrative access',
                    'Encrypting network traffic',
                    'Detecting malware on endpoints'
                ],
                'correct_options' => ['Controlling and monitoring administrative access'],
                'justifications' => [
                    'PAM focuses on privileged accounts, not regular users',
                    'Correct - PAM solutions manage, monitor, and secure privileged account access',
                    'PAM is not a network encryption solution',
                    'PAM is not an endpoint security solution'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            
            // Just-in-Time Access - Item 9
            [
                'topic_id' => $topics['Privileged Access Management (PAM)'] ?? 204,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Just-in-Time (JIT) access helps reduce security risks by:',
                'options' => [
                    'Permanently elevating user privileges',
                    'Granting temporary access only when needed',
                    'Removing all access controls',
                    'Increasing password complexity'
                ],
                'correct_options' => ['Granting temporary access only when needed'],
                'justifications' => [
                    'JIT reduces permanent privileges',
                    'Correct - JIT provides time-limited access, reducing the window of exposure',
                    'JIT enhances access controls, not removes them',
                    'JIT is about access duration, not password strength'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Identity Lifecycle - Item 10
            [
                'topic_id' => $topics['Identity Provisioning & De-provisioning'] ?? 205,
                'type_id' => 4,
                'dimension' => 'Technical',
                'content' => 'Arrange the identity lifecycle stages in the correct order:',
                'options' => [
                    'Deprovisioning',
                    'Access review',
                    'Provisioning',
                    'Modification',
                    'Initial creation'
                ],
                'correct_options' => [
                    'Initial creation',
                    'Provisioning',
                    'Modification',
                    'Access review',
                    'Deprovisioning'
                ],
                'justifications' => ['The identity lifecycle starts with account creation, followed by provisioning access, modifications as needed, periodic reviews, and finally deprovisioning when no longer needed.'],
                'difficulty_level' => 2,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            
            // Access Control Lists - Item 11
            [
                'topic_id' => $topics['Authorization & Least-Privilege Policy'] ?? 206,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'In an Access Control List (ACL), what does an explicit "deny" rule do when it conflicts with an "allow" rule?',
                'options' => [
                    'Allow takes precedence',
                    'Deny takes precedence',
                    'The most recent rule wins',
                    'The system prompts for clarification'
                ],
                'correct_options' => ['Deny takes precedence'],
                'justifications' => [
                    'Security principle: deny overrides allow',
                    'Correct - In most systems, explicit deny rules override allow rules for security',
                    'Order matters, but deny typically wins regardless',
                    'Systems follow predetermined rules, not user prompts'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Zero Trust - Item 12
            [
                'topic_id' => $topics['Just-in-Time (JIT) / Just-Enough-Access'] ?? 207,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'The core principle of Zero Trust architecture is:',
                'options' => [
                    'Trust all internal network traffic',
                    'Never trust, always verify',
                    'Trust but verify occasionally',
                    'Trust based on network location'
                ],
                'correct_options' => ['Never trust, always verify'],
                'justifications' => [
                    'Zero Trust assumes no implicit trust',
                    'Correct - Zero Trust requires continuous verification regardless of location',
                    'Continuous verification is required',
                    'Zero Trust eliminates location-based trust'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Biometric Errors - Item 13
            [
                'topic_id' => $topics['Authentication & MFA'] ?? 200,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'In biometric systems, False Rejection Rate (FRR) refers to:',
                'options' => [
                    'Accepting unauthorized users',
                    'Rejecting authorized users',
                    'System failure rate',
                    'Password reset frequency'
                ],
                'correct_options' => ['Rejecting authorized users'],
                'justifications' => [
                    'That would be False Acceptance Rate (FAR)',
                    'Correct - FRR is when legitimate users are incorrectly denied access',
                    'FRR is about authentication accuracy, not system uptime',
                    'Not related to password management'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            
            // Directory Services - Item 14
            [
                'topic_id' => $topics['Single Sign-On (SSO) & Kerberos'] ?? 208,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Which protocol is commonly used for querying and modifying directory services?',
                'options' => [
                    'HTTP',
                    'LDAP',
                    'FTP',
                    'SNMP'
                ],
                'correct_options' => ['LDAP'],
                'justifications' => [
                    'HTTP is for web traffic',
                    'Correct - Lightweight Directory Access Protocol is designed for directory services',
                    'FTP is for file transfer',
                    'SNMP is for network management'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Kerberos - Item 15
            [
                'topic_id' => $topics['Federation & Identity Protocols'] ?? 209,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'In Kerberos authentication, what is the role of the Ticket Granting Ticket (TGT)?',
                'options' => [
                    'Directly access resources',
                    'Obtain service tickets',
                    'Encrypt user passwords',
                    'Monitor user activity'
                ],
                'correct_options' => ['Obtain service tickets'],
                'justifications' => [
                    'TGT is used to get service tickets, not direct access',
                    'Correct - TGT is presented to get service-specific tickets',
                    'Kerberos uses keys, not password encryption',
                    'TGT is for authentication, not monitoring'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            
            // Password Policies - Item 16
            [
                'topic_id' => $topics['Authentication & MFA'] ?? 200,
                'type_id' => 3,
                'dimension' => 'Technical',
                'content' => 'Select password policy elements that enhance security:',
                'options' => [
                    'Minimum length requirements',
                    'Password hints',
                    'Complexity requirements',
                    'Password sharing for teams',
                    'Regular password changes',
                    'Using dictionary words'
                ],
                'correct_options' => ['Minimum length requirements', 'Complexity requirements', 'Regular password changes'],
                'justifications' => [
                    'Longer passwords are harder to crack',
                    'Hints can help attackers guess passwords',
                    'Complexity makes passwords harder to guess',
                    'Sharing passwords violates individual accountability',
                    'Regular changes limit exposure window',
                    'Dictionary words are easily cracked'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            
            // Session Management - Item 17
            [
                'topic_id' => $topics['Accounting / Auditing'] ?? 210,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What security measure prevents session hijacking through network sniffing?',
                'options' => [
                    'Long session timeouts',
                    'Session ID encryption in transit',
                    'Simple session IDs',
                    'Storing sessions in URL parameters'
                ],
                'correct_options' => ['Session ID encryption in transit'],
                'justifications' => [
                    'Long timeouts increase hijacking window',
                    'Correct - Encryption prevents attackers from capturing session IDs',
                    'Simple IDs are easier to guess or hijack',
                    'URL parameters expose session IDs'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // OAuth 2.0 - Item 18
            [
                'topic_id' => $topics['Federation & Identity Protocols'] ?? 203,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'In OAuth 2.0, what does the authorization server issue after successful authentication?',
                'options' => [
                    'User password',
                    'Access token',
                    'SSL certificate',
                    'Public key'
                ],
                'correct_options' => ['Access token'],
                'justifications' => [
                    'OAuth avoids sharing passwords',
                    'Correct - Access tokens grant access to protected resources',
                    'OAuth is not about SSL certificates',
                    'OAuth uses tokens, not public key exchange'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Least Privilege - Item 19
            [
                'topic_id' => $topics['Authorization & Least-Privilege Policy'] ?? 211,
                'type_id' => 2,
                'dimension' => 'Technical',
                'content' => '**True or False:** The principle of least privilege means users should have the minimum access rights needed to perform their job functions.',
                'options' => [
                    'True',
                    'False'
                ],
                'correct_options' => ['True'],
                'justifications' => [
                    'explanation' => 'True. Least privilege is a fundamental security principle that limits user access rights to only what is necessary for their role, reducing the potential impact of compromised accounts or insider threats.'
                ],
                'difficulty_level' => $difficulties['Very Easy'] ?? 1,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            
            // Separation of Duties - Item 20
            [
                'topic_id' => $topics['Authorization & Least-Privilege Policy'] ?? 211,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Separation of duties helps prevent fraud by:',
                'options' => [
                    'Giving one person all necessary access',
                    'Requiring multiple people to complete critical tasks',
                    'Eliminating all access controls',
                    'Increasing password complexity'
                ],
                'correct_options' => ['Requiring multiple people to complete critical tasks'],
                'justifications' => [
                    'This violates separation of duties',
                    'Correct - No single person can complete a fraudulent transaction alone',
                    'This would increase fraud risk',
                    'Not related to separation of duties'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            
            // Identity Federation Standards - Item 21
            [
                'topic_id' => $topics['Federation & Identity Protocols'] ?? 203,
                'type_id' => 5,
                'dimension' => 'Technical',
                'content' => 'Match each federation standard with its primary use case:',
                'options' => [
                    'items' => [
                        'SAML 2.0',
                        'OAuth 2.0',
                        'OpenID Connect',
                        'WS-Federation'
                    ],
                    'targets' => [
                        'Enterprise SSO',
                        'API authorization',
                        'Consumer authentication',
                        'Microsoft environments'
                    ]
                ],
                'correct_options' => [
                    'SAML 2.0' => 'Enterprise SSO',
                    'OAuth 2.0' => 'API authorization',
                    'OpenID Connect' => 'Consumer authentication',
                    'WS-Federation' => 'Microsoft environments'
                ],
                'justifications' => [
                    'SAML 2.0' => 'Widely used for enterprise Single Sign-On scenarios',
                    'OAuth 2.0' => 'Designed for delegated authorization to APIs',
                    'OpenID Connect' => 'Built on OAuth 2.0 for consumer authentication',
                    'WS-Federation' => 'Common in Microsoft Active Directory environments'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            
            // Conditional Access - Item 22
            [
                'topic_id' => $topics['Just-in-Time (JIT) / Just-Enough-Access'] ?? 207,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Conditional access policies typically evaluate which factors?',
                'options' => [
                    'User favorite color',
                    'Device compliance, location, and risk level',
                    'Time since last vacation',
                    'Number of emails sent'
                ],
                'correct_options' => ['Device compliance, location, and risk level'],
                'justifications' => [
                    'Not a security-relevant factor',
                    'Correct - These factors determine access in modern zero trust systems',
                    'Not relevant to access decisions',
                    'Email volume doesn\'t determine access rights'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            
            // Access Reviews - Item 23
            [
                'topic_id' => $topics['Identity Provisioning & De-provisioning'] ?? 205,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'How often should privileged access rights typically be reviewed?',
                'options' => [
                    'Never - set once and forget',
                    'Quarterly or more frequently',
                    'Every 5 years',
                    'Only when problems occur'
                ],
                'correct_options' => ['Quarterly or more frequently'],
                'justifications' => [
                    'Access rights need regular review',
                    'Correct - Privileged access requires frequent review due to high risk',
                    'Far too infrequent for privileged access',
                    'Reactive approach is insufficient'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // RADIUS vs TACACS+ - Item 24
            [
                'topic_id' => $topics['Federation & Identity Protocols'] ?? 209,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What is a key advantage of TACACS+ over RADIUS?',
                'options' => [
                    'Uses UDP for better performance',
                    'Separates authentication, authorization, and accounting',
                    'Simpler to implement',
                    'Works only with Cisco devices'
                ],
                'correct_options' => ['Separates authentication, authorization, and accounting'],
                'justifications' => [
                    'TACACS+ uses TCP, not UDP',
                    'Correct - TACACS+ allows granular control by separating AAA functions',
                    'TACACS+ is more complex than RADIUS',
                    'TACACS+ works with multiple vendors'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            
            // Passwordless Authentication - Item 25
            [
                'topic_id' => $topics['Authentication & MFA'] ?? 200,
                'type_id' => 3,
                'dimension' => 'Technical',
                'content' => 'Select valid passwordless authentication methods:',
                'options' => [
                    'FIDO2 security keys',
                    'SMS codes',
                    'Windows Hello',
                    'Security questions',
                    'Magic links via email',
                    'Mother\'s maiden name'
                ],
                'correct_options' => ['FIDO2 security keys', 'Windows Hello', 'Magic links via email'],
                'justifications' => [
                    'Hardware-based passwordless authentication',
                    'SMS is a second factor, not passwordless',
                    'Biometric-based passwordless solution',
                    'Knowledge-based, not passwordless',
                    'Time-limited links replace passwords',
                    'Knowledge-based authentication'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 5,
                'status' => 'published'
            ],
            
            // Service Accounts - Item 26
            [
                'topic_id' => $topics['Privileged Access Management (PAM)'] ?? 204,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What is a major security risk with service accounts?',
                'options' => [
                    'They change passwords too frequently',
                    'Passwords rarely change and are often shared',
                    'They have insufficient privileges',
                    'They require MFA'
                ],
                'correct_options' => ['Passwords rarely change and are often shared'],
                'justifications' => [
                    'Service accounts often have static passwords',
                    'Correct - Static, shared passwords create significant security risks',
                    'Service accounts often have excessive privileges',
                    'Service accounts typically can\'t use MFA'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            
            // Break Glass Procedures - Item 27
            [
                'topic_id' => $topics['Privileged Access Management (PAM)'] ?? 204,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Break glass accounts are used for:',
                'options' => [
                    'Daily administrative tasks',
                    'Emergency access when normal methods fail',
                    'Testing new features',
                    'Training new employees'
                ],
                'correct_options' => ['Emergency access when normal methods fail'],
                'justifications' => [
                    'Break glass is for emergencies only',
                    'Correct - Provides emergency access with full audit trail',
                    'Not for routine testing',
                    'Not for training purposes'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            
            // Identity Proofing - Item 28
            [
                'topic_id' => $topics['Identity Provisioning & De-provisioning'] ?? 205,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Identity proofing is the process of:',
                'options' => [
                    'Creating strong passwords',
                    'Verifying a person is who they claim to be',
                    'Encrypting identity data',
                    'Deleting old accounts'
                ],
                'correct_options' => ['Verifying a person is who they claim to be'],
                'justifications' => [
                    'Identity proofing occurs before account creation',
                    'Correct - Validates identity before granting system access',
                    'Proofing is about verification, not encryption',
                    'That\'s deprovisioning, not proofing'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Access Control Matrix - Item 29
            [
                'topic_id' => $topics['Authorization & Least-Privilege Policy'] ?? 206,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'In an access control matrix, rows typically represent:',
                'options' => [
                    'Permissions',
                    'Subjects (users)',
                    'Objects (resources)',
                    'Time periods'
                ],
                'correct_options' => ['Subjects (users)'],
                'justifications' => [
                    'Permissions are shown in cell intersections',
                    'Correct - Rows represent subjects, columns represent objects',
                    'Objects are typically represented by columns',
                    'Time is not a standard matrix dimension'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 5,
                'status' => 'published'
            ],
            
            // Context-Aware Access - Item 30
            [
                'topic_id' => $topics['Just-in-Time (JIT) / Just-Enough-Access'] ?? 207,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Context-aware access control might deny access based on:',
                'options' => [
                    'User\'s favorite sports team',
                    'Unusual login location or time',
                    'User\'s age',
                    'Desktop wallpaper'
                ],
                'correct_options' => ['Unusual login location or time'],
                'justifications' => [
                    'Not a security-relevant context',
                    'Correct - Anomalous behavior triggers additional verification',
                    'Age discrimination is typically illegal',
                    'Desktop preferences aren\'t security context'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Credential Stuffing - Item 31
            [
                'topic_id' => $topics['Authentication & MFA'] ?? 200,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Credential stuffing attacks exploit:',
                'options' => [
                    'Weak encryption algorithms',
                    'Password reuse across multiple sites',
                    'Unpatched vulnerabilities',
                    'Social engineering'
                ],
                'correct_options' => ['Password reuse across multiple sites'],
                'justifications' => [
                    'Not related to encryption',
                    'Correct - Attackers use breached credentials on other sites',
                    'Credential stuffing uses valid credentials',
                    'No social engineering required'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            
            // Directory Service Replication - Item 32
            [
                'topic_id' => $topics['Single Sign-On (SSO) & Kerberos'] ?? 208,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Why is directory service replication important for security?',
                'options' => [
                    'It makes passwords stronger',
                    'Ensures authentication availability and consistency',
                    'Reduces storage requirements',
                    'Simplifies user interfaces'
                ],
                'correct_options' => ['Ensures authentication availability and consistency'],
                'justifications' => [
                    'Replication doesn\'t affect password strength',
                    'Correct - Replication prevents single points of failure and ensures consistent access control',
                    'Replication increases storage needs',
                    'UI is unrelated to replication'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            
            // ABAC Implementation - Item 33
            [
                'topic_id' => $topics['Access-Control Models'] ?? 201,
                'type_id' => 7,
                'dimension' => 'Technical',
                'content' => 'Write a simple ABAC policy rule that grants read access to financial reports only to managers in the finance department during business hours:',
                'options' => [
                    'IF user.role == "manager" AND user.department == "finance" AND time.hour >= 8 AND time.hour <= 18 THEN PERMIT read financial_reports',
                    'PERMIT read ON financial_reports IF subject.role = "manager" AND subject.dept = "finance" AND env.time BETWEEN 08:00 AND 18:00',
                    'allow(read, financial_reports) :- role(user, manager), department(user, finance), business_hours(current_time)',
                    'DENY ALL EXCEPT user.role == "admin"'
                ],
                'correct_options' => [
                    'IF user.role == "manager" AND user.department == "finance" AND time.hour >= 8 AND time.hour <= 18 THEN PERMIT read financial_reports',
                    'PERMIT read ON financial_reports IF subject.role = "manager" AND subject.dept = "finance" AND env.time BETWEEN 08:00 AND 18:00',
                    'allow(read, financial_reports) :- role(user, manager), department(user, finance), business_hours(current_time)'
                ],
                'justifications' => [
                    'Basic ABAC rule syntax',
                    'Alternative XACML-style syntax',
                    'Logic programming style rule'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Biometric Crossover Error Rate - Item 34
            [
                'topic_id' => $topics['Authentication & MFA'] ?? 200,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'The Crossover Error Rate (CER) in biometric systems is:',
                'options' => [
                    'When false acceptance equals false rejection rate',
                    'The total number of errors',
                    'When the system fails completely',
                    'The cost of implementation'
                ],
                'correct_options' => ['When false acceptance equals false rejection rate'],
                'justifications' => [
                    'Correct - CER is where FAR and FRR intersect, indicating system accuracy',
                    'CER is a specific balance point, not total errors',
                    'CER is about accuracy, not system failure',
                    'CER is a technical metric, not financial'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            
            // OAuth Flows - Item 35
            [
                'topic_id' => $topics['Federation & Identity Protocols'] ?? 203,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Which OAuth 2.0 flow is MOST appropriate for a server-side web application that needs to access user data?',
                'options' => [
                    'Authorization Code flow',
                    'Implicit flow',
                    'Client Credentials flow',
                    'Resource Owner Password Credentials flow'
                ],
                'correct_options' => ['Authorization Code flow'],
                'justifications' => [
                    'Correct - Most secure flow for web applications with backend servers that can securely store client secrets',
                    'Implicit flow is deprecated due to security vulnerabilities and was designed for client-side apps',
                    'Client Credentials flow is for machine-to-machine authentication without user involvement',
                    'Resource Owner Password flow is only for highly trusted first-party applications'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Privilege Escalation - Item 36
            [
                'topic_id' => $topics['Authorization & Least-Privilege Policy'] ?? 206,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Vertical privilege escalation involves:',
                'options' => [
                    'Moving between accounts at the same level',
                    'Gaining higher privileges than authorized',
                    'Reducing user privileges',
                    'Sharing privileges with peers'
                ],
                'correct_options' => ['Gaining higher privileges than authorized'],
                'justifications' => [
                    'That\'s horizontal privilege escalation',
                    'Correct - Vertical escalation moves up to higher privilege levels',
                    'That\'s privilege reduction, not escalation',
                    'Not a form of privilege escalation'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            
            // Identity Governance - Item 37
            [
                'topic_id' => $topics['Identity Provisioning & De-provisioning'] ?? 205,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Identity governance platforms typically provide:',
                'options' => [
                    'Network firewall rules',
                    'Access certification and policy enforcement',
                    'Antivirus scanning',
                    'Data encryption'
                ],
                'correct_options' => ['Access certification and policy enforcement'],
                'justifications' => [
                    'Identity governance focuses on access, not network security',
                    'Correct - Ensures access rights comply with policies through reviews and enforcement',
                    'Not related to identity governance',
                    'Identity governance manages access, not encryption'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Adaptive Authentication - Item 38
            [
                'topic_id' => $topics['Authentication & MFA'] ?? 200,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Adaptive authentication adjusts security requirements based on:',
                'options' => [
                    'User preferences',
                    'Risk assessment of the login attempt',
                    'Time of year',
                    'System load'
                ],
                'correct_options' => ['Risk assessment of the login attempt'],
                'justifications' => [
                    'Security shouldn\'t be based on preferences',
                    'Correct - Higher risk triggers stronger authentication requirements',
                    'Season doesn\'t determine authentication needs',
                    'Performance doesn\'t drive authentication requirements'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            
            // PAM Session Recording - Item 39
            [
                'topic_id' => $topics['Privileged Access Management (PAM)'] ?? 204,
                'type_id' => 2,
                'dimension' => 'Technical',
                'content' => '**True or False:** PAM solutions often record privileged sessions for forensic analysis and compliance.',
                'options' => [
                    'True',
                    'False'
                ],
                'correct_options' => ['True'],
                'justifications' => [
                    'explanation' => 'True. Session recording is a key feature of PAM solutions, capturing all actions taken during privileged sessions for security monitoring, forensic investigation, and compliance auditing.'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Zero Trust Principles - Item 40
            [
                'topic_id' => $topics['Just-in-Time (JIT) / Just-Enough-Access'] ?? 207,
                'type_id' => 3,
                'dimension' => 'Technical',
                'content' => 'Select core principles of Zero Trust Architecture:',
                'options' => [
                    'Verify explicitly',
                    'Trust the internal network',
                    'Use least privilege access',
                    'Grant permanent access',
                    'Assume breach',
                    'Disable all monitoring'
                ],
                'correct_options' => ['Verify explicitly', 'Use least privilege access', 'Assume breach'],
                'justifications' => [
                    'Always authenticate and authorize',
                    'Zero Trust eliminates implicit trust',
                    'Limit access to minimum necessary',
                    'Zero Trust uses dynamic, not permanent access',
                    'Design assuming compromise has occurred',
                    'Zero Trust requires extensive monitoring'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            
            // Certificate-Based Authentication - Item 41
            [
                'topic_id' => $topics['Authentication & MFA'] ?? 200,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Digital certificates for authentication contain:',
                'options' => [
                    'User passwords',
                    'Public key and identity information',
                    'Private keys only',
                    'Biometric data'
                ],
                'correct_options' => ['Public key and identity information'],
                'justifications' => [
                    'Certificates don\'t contain passwords',
                    'Correct - Certificates bind public keys to identities',
                    'Private keys must remain secret',
                    'Certificates don\'t store biometrics'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Delegation vs Impersonation - Item 42
            [
                'topic_id' => $topics['Access-Control Models'] ?? 201,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'In access control, delegation differs from impersonation in that:',
                'options' => [
                    'They are the same thing',
                    'Delegation maintains original identity audit trail',
                    'Impersonation is more secure',
                    'Delegation requires no authentication'
                ],
                'correct_options' => ['Delegation maintains original identity audit trail'],
                'justifications' => [
                    'They have different security implications',
                    'Correct - Delegation tracks both delegator and delegate, impersonation assumes full identity',
                    'Impersonation can hide accountability',
                    'Both require proper authentication'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            
            // Account Lockout Policies - Item 43
            [
                'topic_id' => $topics['Authentication & MFA'] ?? 200,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Account lockout policies must balance:',
                'options' => [
                    'User convenience and IT workload',
                    'Security and availability',
                    'Cost and complexity',
                    'Speed and accuracy'
                ],
                'correct_options' => ['Security and availability'],
                'justifications' => [
                    'Not the primary concern',
                    'Correct - Too strict causes DoS, too lenient enables attacks',
                    'Not the main balance consideration',
                    'Not relevant to lockout policies'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 5,
                'status' => 'published'
            ],
            
            // LDAP Injection - Item 44
            [
                'topic_id' => $topics['Single Sign-On (SSO) & Kerberos'] ?? 208,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What is the PRIMARY vulnerability in this LDAP query: (&(uid=" . $username . ")(objectClass=person))?',
                'options' => [
                    'The query searches for the wrong object class',
                    'Direct string concatenation allows LDAP injection',
                    'The query uses an inefficient search filter',
                    'The uid attribute is not properly indexed'
                ],
                'correct_options' => ['Direct string concatenation allows LDAP injection'],
                'justifications' => [
                    'Object class selection is correct for user searches',
                    'Correct - Concatenating unsanitized input allows attackers to inject malicious LDAP filter syntax',
                    'Performance is not the security concern here',
                    'Indexing affects performance, not security vulnerability'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            
            // Modern Authentication Protocols - Item 45
            [
                'topic_id' => $topics['Federation & Identity Protocols'] ?? 209,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What makes WebAuthn more secure than traditional password-based authentication?',
                'options' => [
                    'It encrypts passwords with stronger algorithms',
                    'It uses public key cryptography and origin binding',
                    'It requires longer and more complex passwords',
                    'It automatically generates one-time passwords'
                ],
                'correct_options' => ['It uses public key cryptography and origin binding'],
                'justifications' => [
                    'WebAuthn does not use passwords at all, so encryption is irrelevant',
                    'Correct - WebAuthn uses asymmetric cryptography and binds authentication to specific origins, preventing phishing',
                    'WebAuthn eliminates passwords entirely rather than making them more complex',
                    'WebAuthn uses cryptographic keys, not time-based tokens like TOTP'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            
            // Risk-Based Authentication - Item 46
            [
                'topic_id' => $topics['Authentication & MFA'] ?? 200,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Which scenario would MOST likely trigger step-up authentication in a risk-based system?',
                'options' => [
                    'User logging in from their usual office computer',
                    'User accessing email during normal work hours',
                    'User attempting high-value transaction from new device',
                    'User changing their profile picture'
                ],
                'correct_options' => ['User attempting high-value transaction from new device'],
                'justifications' => [
                    'Familiar location and device present low risk',
                    'Normal work activities present minimal risk',
                    'Correct - High-value actions from unfamiliar devices trigger additional verification',
                    'Low-risk activity requiring no additional authentication'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            
            // Access Control Effectiveness - Item 47
            [
                'topic_id' => $topics['Authorization & Least-Privilege Policy'] ?? 206,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'When evaluating the effectiveness of an access control system, what metric is MOST important?',
                'options' => [
                    'Number of users in the system',
                    'Speed of authentication responses',
                    'Percentage of inappropriate access attempts blocked',
                    'Total cost of implementation'
                ],
                'correct_options' => ['Percentage of inappropriate access attempts blocked'],
                'justifications' => [
                    'User count doesn\'t measure security effectiveness',
                    'Speed is important but secondary to security',
                    'Correct - The primary measure of access control effectiveness is its ability to prevent unauthorized access',
                    'Cost is a business consideration, not a security metric'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 5,
                'status' => 'published'
            ],
            
            // Identity Standards Comparison - Item 48
            [
                'topic_id' => $topics['Federation & Identity Protocols'] ?? 203,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Which identity standard would you recommend for a startup building a modern SaaS application that needs to integrate with enterprise customers?',
                'options' => [
                    'LDAP only',
                    'SAML 2.0 with OAuth 2.0/OpenID Connect support',
                    'Proprietary authentication system',
                    'Simple username/password with email verification'
                ],
                'correct_options' => ['SAML 2.0 with OAuth 2.0/OpenID Connect support'],
                'justifications' => [
                    'LDAP alone lacks federation capabilities for external integration',
                    'Correct - Provides enterprise SSO compatibility while supporting modern authentication patterns',
                    'Proprietary systems create integration barriers and security risks',
                    'Basic authentication doesn\'t meet enterprise integration requirements'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 5,
                'status' => 'published'
            ],
            
            // Access Control Design Principles - Item 49
            [
                'topic_id' => $topics['Access-Control Models'] ?? 201,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'When designing an access control system for a healthcare organization, which approach BEST balances security and operational efficiency?',
                'options' => [
                    'Grant all users administrative access for flexibility',
                    'Implement role-based access with emergency override procedures',
                    'Use only discretionary access control',
                    'Require approval for every access request'
                ],
                'correct_options' => ['Implement role-based access with emergency override procedures'],
                'justifications' => [
                    'Administrative access for all violates least privilege and creates massive security risks',
                    'Correct - RBAC provides structured access while emergency procedures ensure patient care isn\'t compromised',
                    'DAC alone lacks the structure needed for healthcare compliance and security',
                    'Approval for every request would severely impact emergency patient care'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 5,
                'status' => 'published'
            ],
            
            // PAM Strategy Evaluation - Item 50
            [
                'topic_id' => $topics['Privileged Access Management (PAM)'] ?? 204,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'A company discovers that 30% of their privileged accounts haven\'t been used in 6 months. What should be the FIRST priority action?',
                'options' => [
                    'Immediately delete all unused accounts',
                    'Conduct business impact analysis and disable non-essential accounts',
                    'Reset passwords on all accounts',
                    'Ignore the finding as accounts may be needed later'
                ],
                'correct_options' => ['Conduct business impact analysis and disable non-essential accounts'],
                'justifications' => [
                    'Immediate deletion without analysis could disrupt critical business processes',
                    'Correct - Systematic evaluation prevents business disruption while reducing attack surface',
                    'Password resets don\'t address the fundamental issue of unused privileged access',
                    'Unused privileged accounts represent significant security risks and should be addressed'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 5,
                'status' => 'published'
            ]
        ];
        
        // Insert all items
        foreach ($items as $item) {
            DiagnosticItem::create($item);
        }
        
        $this->command->info('Domain 10 (Access Control) diagnostic items seeded successfully!');
    }
}