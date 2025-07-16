<?php

namespace Database\Seeders\Diagnostics;

use App\Models\DiagnosticItem;
use App\Models\DiagnosticTopic;


use Illuminate\Database\Seeder;

class D13CloudSecuritySeeder extends Seeder
{
    public function run(): void
    {
        // Get reference data
        $topics = DiagnosticTopic::whereHas('domain', function($query) {
            $query->where('name', 'Cloud Security');
        })->pluck('id', 'name');
        
        
        $items = [
            // Cloud Service Models - 5 items
            [
                'topic_id' => $topics['Cloud Service Models'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'In which cloud service model does the customer have the MOST security responsibility?',
                'options' => [
                    'Software as a Service (SaaS)',
                    'Platform as a Service (PaaS)',
                    'Infrastructure as a Service (IaaS)',
                    'Function as a Service (FaaS)'
                ],
                'correct_options' => ['Infrastructure as a Service (IaaS)'],
                'justifications' => [
                    'SaaS - provider manages most security aspects',
                    'PaaS - provider manages infrastructure security',
                    'Correct - IaaS customers manage OS, apps, and data security',
                    'FaaS - provider manages most infrastructure'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Cloud Service Models'] ?? 1,
                'type_id' => 5,
                'dimension' => 'Technical',
                'content' => 'Match each cloud service with its typical use case:',
                'options' => [
                    'items' => [
                        'IaaS',
                        'PaaS',
                        'SaaS',
                        'FaaS'
                    ],
                    'responses' => [
                        'Virtual machines and storage',
                        'Application development platform',
                        'Ready-to-use applications',
                        'Event-driven serverless computing'
                    ]
                ],
                'correct_options' => [
                    'IaaS' => 'Virtual machines and storage',
                    'PaaS' => 'Application development platform',
                    'SaaS' => 'Ready-to-use applications',
                    'FaaS' => 'Event-driven serverless computing'
                ],
                'justifications' => [
                    'IaaS' => 'Provides fundamental compute, storage, and networking',
                    'PaaS' => 'Offers development and deployment environments',
                    'SaaS' => 'Delivers complete applications to end users',
                    'FaaS' => 'Executes code in response to events'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Cloud Service Models'] ?? 1,
                'type_id' => 3,
                'dimension' => 'Technical',
                'content' => 'In a PaaS environment, drag the security responsibilities that belong to the **customer** to the drop zone:',
                'options' => [
                    'Application code security',
                    'Operating system patching',
                    'Data classification',
                    'Physical security',
                    'Identity and access management',
                    'Network infrastructure'
                ],
                'correct_options' => ['Application code security', 'Data classification', 'Identity and access management'],
                'justifications' => [
                    'Customers must secure their application code',
                    'OS patching is provider responsibility in PaaS',
                    'Customers must classify and protect their data',
                    'Physical security is always provider responsibility',
                    'Customer manages their users and access',
                    'Network infrastructure is provider managed in PaaS'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Cloud Service Models'] ?? 1,
                'type_id' => 2,
                'dimension' => 'Technical',
                'content' => '**True or False:** In SaaS, the customer is responsible for configuring the underlying database security.',
                'options' => [
                    'True',
                    'False'
                ],
                'correct_options' => ['False'],
                'justifications' => [
                    'explanation' => 'In SaaS, the provider manages all underlying infrastructure including databases. Customers are only responsible for their data, user access management, and application-level configurations.'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Cloud Service Models'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Which cloud service model provides the greatest flexibility but requires the most security expertise from customers?',
                'options' => [
                    'Desktop as a Service (DaaS)',
                    'Software as a Service (SaaS)',
                    'Infrastructure as a Service (IaaS)',
                    'Backup as a Service (BaaS)'
                ],
                'correct_options' => ['Infrastructure as a Service (IaaS)'],
                'justifications' => [
                    'DaaS is a specific service with limited flexibility',
                    'SaaS provides least flexibility and requires minimal expertise',
                    'Correct - IaaS offers maximum control but requires extensive security knowledge',
                    'BaaS is a specialized service with limited scope'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 4,
                'status' => 'published'
            ],

            // Cloud Deployment Models - 5 items
            [
                'topic_id' => $topics['Cloud Deployment Models'] ?? 2,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Which cloud deployment model provides dedicated resources to a single organization?',
                'options' => [
                    'Public cloud',
                    'Private cloud',
                    'Community cloud',
                    'Distributed cloud'
                ],
                'correct_options' => ['Private cloud'],
                'justifications' => [
                    'Public cloud shares resources among multiple tenants',
                    'Correct - Private cloud dedicates resources to one organization',
                    'Community cloud serves multiple organizations with shared concerns',
                    'Distributed cloud is about geographic distribution'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Cloud Deployment Models'] ?? 2,
                'type_id' => 4,
                'dimension' => 'Technical',
                'content' => 'Arrange these cloud deployment models from LEAST to MOST control over security:',
                'options' => [
                    'Public cloud',
                    'Private cloud',
                    'On-premises',
                    'Hybrid cloud'
                ],
                'correct_options' => [
                    'Public cloud',
                    'Hybrid cloud',
                    'Private cloud',
                    'On-premises'
                ],
                'justifications' => ['Public cloud offers least control as resources are shared. Hybrid cloud provides partial control. Private cloud offers dedicated resources with more control. On-premises provides complete control over all security aspects.'],
                'difficulty_level' => 2,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Cloud Deployment Models'] ?? 2,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What is the primary security advantage of a hybrid cloud model?',
                'options' => [
                    'Lower costs than private cloud',
                    'Ability to keep sensitive data on-premises',
                    'Faster deployment times',
                    'Simplified management'
                ],
                'correct_options' => ['Ability to keep sensitive data on-premises'],
                'justifications' => [
                    'Cost is not a security advantage',
                    'Correct - Hybrid allows sensitive data to remain in controlled environment',
                    'Speed is not a security benefit',
                    'Hybrid cloud actually complicates management'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Cloud Deployment Models'] ?? 2,
                'type_id' => 5,
                'dimension' => 'Technical',
                'content' => 'Match each deployment model with its primary characteristic:',
                'options' => [
                    'items' => [
                        'Public cloud',
                        'Private cloud',
                        'Community cloud',
                        'Hybrid cloud'
                    ],
                    'responses' => [
                        'Multi-tenant shared resources',
                        'Single-tenant dedicated resources',
                        'Shared by organizations with common requirements',
                        'Combination of public and private'
                    ]
                ],
                'correct_options' => [
                    'Public cloud' => 'Multi-tenant shared resources',
                    'Private cloud' => 'Single-tenant dedicated resources',
                    'Community cloud' => 'Shared by organizations with common requirements',
                    'Hybrid cloud' => 'Combination of public and private'
                ],
                'justifications' => [
                    'Public cloud' => 'Resources shared among many customers',
                    'Private cloud' => 'Dedicated to single organization',
                    'Community cloud' => 'Shared by specific community (e.g., healthcare)',
                    'Hybrid cloud' => 'Integrates both deployment models'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Cloud Deployment Models'] ?? 2,
                'type_id' => 3,
                'dimension' => 'Technical',
                'content' => 'Drag the scenarios that are best suited for a **private cloud** deployment to the drop zone:',
                'options' => [
                    'Highly regulated financial data',
                    'Public website hosting',
                    'Medical records system',
                    'E-commerce platform',
                    'Government classified systems',
                    'Social media application'
                ],
                'correct_options' => ['Highly regulated financial data', 'Medical records system', 'Government classified systems'],
                'justifications' => [
                    'Financial data requires strict control and compliance',
                    'Public websites can use public cloud',
                    'Medical records need HIPAA compliance and control',
                    'E-commerce can leverage public cloud scalability',
                    'Classified systems require dedicated secure infrastructure',
                    'Social media benefits from public cloud scale'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 1,
                'status' => 'published'
            ],

            // Shared Responsibility Model - 6 items
            [
                'topic_id' => $topics['Shared Responsibility Model'] ?? 3,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'In the shared responsibility model, what is ALWAYS the cloud provider\'s responsibility?',
                'options' => [
                    'Data encryption',
                    'Physical security of data centers',
                    'Identity and access management',
                    'Application security'
                ],
                'correct_options' => ['Physical security of data centers'],
                'justifications' => [
                    'Data encryption responsibility varies by service model',
                    'Correct - Physical security is always provider responsibility',
                    'IAM responsibility is often shared',
                    'Application security is typically customer responsibility'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Shared Responsibility Model'] ?? 3,
                'type_id' => 7,
                'dimension' => 'Technical',
                'content' => 'Based on this cloud configuration audit, identify who is responsible for the security misconfiguration:',
                'options' => [
                    'Cloud provider',
                    'Customer',
                    'Both (shared responsibility)',
                    'Third-party vendor'
                ],
                'correct_options' => ['Customer'],
                'justifications' => [
                    'Provider ensures S3 service security, not bucket configuration',
                    'Correct - Customer is responsible for configuring bucket permissions',
                    'Bucket configuration is solely customer responsibility',
                    'No third-party vendor involved in basic S3 configuration'
                ],
                'settings' => [
                    'shell' => 'cloud-audit',
                    'commands' => [
                        [
                            'pattern' => '^audit s3-bucket$',
                            'response' => "Auditing S3 bucket configuration...\n[CRITICAL] Bucket 'company-data' is publicly readable\n[WARNING] No encryption enabled\n[INFO] Versioning: Disabled\n[WARNING] No access logging configured\n[ISSUE] Bucket policy allows s3:GetObject from principal: *",
                            'isError' => false
                        ]
                    ]
                ],
                'difficulty_level' => 2,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Shared Responsibility Model'] ?? 3,
                'type_id' => 5,
                'dimension' => 'Technical',
                'content' => 'In an IaaS model, match each security control with the responsible party:',
                'options' => [
                    'items' => [
                        'Hypervisor security',
                        'Operating system patches',
                        'Network infrastructure',
                        'Application firewall rules'
                    ],
                    'responses' => [
                        'Cloud provider',
                        'Customer',
                        'Shared responsibility'
                    ]
                ],
                'correct_options' => [
                    'Hypervisor security' => 'Cloud provider',
                    'Operating system patches' => 'Customer',
                    'Network infrastructure' => 'Cloud provider',
                    'Application firewall rules' => 'Customer'
                ],
                'justifications' => [
                    'Hypervisor security' => 'Provider manages virtualization layer',
                    'Operating system patches' => 'Customer manages OS in IaaS',
                    'Network infrastructure' => 'Provider manages physical network',
                    'Application firewall rules' => 'Customer configures security groups'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Shared Responsibility Model'] ?? 3,
                'type_id' => 2,
                'dimension' => 'Technical',
                'content' => '**True or False:** In a PaaS environment, the customer is responsible for patching the underlying operating system.',
                'options' => [
                    'True',
                    'False'
                ],
                'correct_options' => ['False'],
                'justifications' => [
                    'explanation' => 'In PaaS, the cloud provider manages and patches the operating system. Customers are responsible for their applications and data, but not the underlying platform components.'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Shared Responsibility Model'] ?? 3,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'A data breach occurs due to an unpatched vulnerability in a customer\'s web application running on IaaS. Who is responsible?',
                'options' => [
                    'Cloud provider for not detecting the vulnerability',
                    'Customer for not patching their application',
                    'Both share equal responsibility',
                    'Neither, it\'s a zero-day vulnerability'
                ],
                'correct_options' => ['Customer for not patching their application'],
                'justifications' => [
                    'Provider secures infrastructure, not customer applications',
                    'Correct - Customers must secure and patch their applications',
                    'Application security is solely customer responsibility in IaaS',
                    'Even zero-days require customer response in their applications'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Shared Responsibility Model'] ?? 3,
                'type_id' => 3,
                'dimension' => 'Technical',
                'content' => 'Drag the security tasks that are **customer responsibilities** in ALL cloud service models to the drop zone:',
                'options' => [
                    'Data classification',
                    'Physical server maintenance',
                    'Identity management for users',
                    'Hypervisor patching',
                    'Data encryption at rest',
                    'Datacenter access controls'
                ],
                'correct_options' => ['Data classification', 'Identity management for users'],
                'justifications' => [
                    'Customers always own data classification',
                    'Physical maintenance is always provider responsibility',
                    'Customer always manages their own users',
                    'Hypervisor is always provider responsibility',
                    'Encryption responsibility varies by service model',
                    'Physical access is always provider controlled'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 4,
                'status' => 'published'
            ],

            // Virtual Private Cloud (VPC) - 5 items
            [
                'topic_id' => $topics['Virtual Private Cloud (VPC)'] ?? 4,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What is the primary purpose of a VPC in cloud computing?',
                'options' => [
                    'Increase internet bandwidth',
                    'Provide network isolation in the cloud',
                    'Reduce cloud costs',
                    'Improve application performance'
                ],
                'correct_options' => ['Provide network isolation in the cloud'],
                'justifications' => [
                    'VPC is about security, not bandwidth',
                    'Correct - VPC creates isolated network environments',
                    'VPC may actually increase costs slightly',
                    'VPC is for security, not performance'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Virtual Private Cloud (VPC)'] ?? 4,
                'type_id' => 3,
                'dimension' => 'Technical',
                'content' => 'Drag the components that are part of a typical VPC architecture to the drop zone:',
                'options' => [
                    'Subnets',
                    'Physical routers',
                    'Security groups',
                    'Hardware firewalls',
                    'Network ACLs',
                    'Internet gateway'
                ],
                'correct_options' => ['Subnets', 'Security groups', 'Network ACLs', 'Internet gateway'],
                'justifications' => [
                    'Subnets segment the VPC address space',
                    'Physical routers are provider infrastructure',
                    'Security groups provide instance-level firewalls',
                    'Hardware firewalls are physical devices',
                    'NACLs provide subnet-level access control',
                    'Internet gateway enables internet connectivity'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Virtual Private Cloud (VPC)'] ?? 4,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What is the key difference between security groups and network ACLs in a VPC?',
                'options' => [
                    'Security groups are stateless, NACLs are stateful',
                    'Security groups are stateful, NACLs are stateless',
                    'Both are stateful',
                    'Both are stateless'
                ],
                'correct_options' => ['Security groups are stateful, NACLs are stateless'],
                'justifications' => [
                    'This is backwards - opposite is true',
                    'Correct - Security groups track connection state, NACLs do not',
                    'Only security groups are stateful',
                    'Only NACLs are stateless'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Virtual Private Cloud (VPC)'] ?? 4,
                'type_id' => 2,
                'dimension' => 'Technical',
                'content' => '**True or False:** VPC peering connections allow transitive routing between VPCs.',
                'options' => [
                    'True',
                    'False'
                ],
                'correct_options' => ['False'],
                'justifications' => [
                    'explanation' => 'VPC peering connections are not transitive. If VPC A is peered with VPC B, and VPC B is peered with VPC C, VPC A cannot communicate with VPC C through VPC B. Direct peering between A and C would be required.'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Virtual Private Cloud (VPC)'] ?? 4,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Which subnet type should be used for resources that need direct internet access in a VPC?',
                'options' => [
                    'Private subnet with NAT gateway',
                    'Public subnet with internet gateway',
                    'Isolated subnet',
                    'Management subnet'
                ],
                'correct_options' => ['Public subnet with internet gateway'],
                'justifications' => [
                    'Private subnets don\'t allow direct inbound internet access',
                    'Correct - Public subnets route through internet gateway for direct access',
                    'Isolated subnets have no internet access',
                    'Management subnet is not a standard subnet type'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 3,
                'status' => 'published'
            ],

            // Cloud Access Security Broker (CASB) - 5 items
            [
                'topic_id' => $topics['Cloud Access Security Broker (CASB)'] ?? 5,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What are the four pillars of CASB functionality?',
                'options' => [
                    'Visibility, Compliance, Data Security, Threat Protection',
                    'Authentication, Authorization, Accounting, Auditing',
                    'Prevent, Detect, Respond, Recover',
                    'People, Process, Technology, Governance'
                ],
                'correct_options' => ['Visibility, Compliance, Data Security, Threat Protection'],
                'justifications' => [
                    'Correct - These are the four core CASB pillars',
                    'These are AAA+ principles, not CASB pillars',
                    'These are incident response phases',
                    'These are general security framework elements'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Cloud Access Security Broker (CASB)'] ?? 5,
                'type_id' => 5,
                'dimension' => 'Technical',
                'content' => 'Match each CASB deployment mode with its characteristic:',
                'options' => [
                    'items' => [
                        'Forward proxy',
                        'Reverse proxy',
                        'API-based',
                        'Log collection'
                    ],
                    'responses' => [
                        'Inline traffic inspection',
                        'Protects specific apps',
                        'Out-of-band monitoring',
                        'Retrospective analysis'
                    ]
                ],
                'correct_options' => [
                    'Forward proxy' => 'Inline traffic inspection',
                    'Reverse proxy' => 'Protects specific apps',
                    'API-based' => 'Out-of-band monitoring',
                    'Log collection' => 'Retrospective analysis'
                ],
                'justifications' => [
                    'Forward proxy' => 'Inspects all outbound traffic in real-time',
                    'Reverse proxy' => 'Sits in front of specific cloud applications',
                    'API-based' => 'Uses cloud provider APIs for visibility',
                    'Log collection' => 'Analyzes logs after events occur'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 5,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Cloud Access Security Broker (CASB)'] ?? 5,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Which CASB capability helps prevent sensitive data from being uploaded to unauthorized cloud services?',
                'options' => [
                    'Shadow IT discovery',
                    'Data loss prevention (DLP)',
                    'User behavior analytics',
                    'Compliance reporting'
                ],
                'correct_options' => ['Data loss prevention (DLP)'],
                'justifications' => [
                    'Shadow IT discovers services but doesn\'t prevent uploads',
                    'Correct - DLP policies block sensitive data transfers',
                    'UBA detects anomalies but doesn\'t block transfers',
                    'Compliance reporting is after-the-fact'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Cloud Access Security Broker (CASB)'] ?? 5,
                'type_id' => 3,
                'dimension' => 'Technical',
                'content' => 'Drag the use cases that are **best addressed by CASB** to the drop zone:',
                'options' => [
                    'Discovering shadow IT usage',
                    'Patching cloud infrastructure',
                    'Enforcing DLP in cloud apps',
                    'Managing cloud costs',
                    'Detecting abnormal user behavior',
                    'Provisioning cloud resources'
                ],
                'correct_options' => ['Discovering shadow IT usage', 'Enforcing DLP in cloud apps', 'Detecting abnormal user behavior'],
                'justifications' => [
                    'CASB excels at discovering unauthorized cloud usage',
                    'Infrastructure patching is provider/customer responsibility',
                    'CASB provides DLP across cloud services',
                    'Cost management requires different tools',
                    'CASB includes user behavior analytics',
                    'Resource provisioning uses cloud native tools'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Cloud Access Security Broker (CASB)'] ?? 5,
                'type_id' => 2,
                'dimension' => 'Technical',
                'content' => '**True or False:** CASB solutions can only protect sanctioned cloud applications.',
                'options' => [
                    'True',
                    'False'
                ],
                'correct_options' => ['False'],
                'justifications' => [
                    'explanation' => 'CASB solutions protect both sanctioned and unsanctioned cloud applications. They can discover shadow IT, block access to risky apps, and apply policies to any cloud service accessed by users.'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 2,
                'status' => 'published'
            ],

            // Secure Access Service Edge (SASE) - 4 items
            [
                'topic_id' => $topics['Secure Access Service Edge (SASE)'] ?? 6,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What does SASE converge into a single service?',
                'options' => [
                    'Storage and compute',
                    'Network and security',
                    'Development and operations',
                    'Mobile and desktop'
                ],
                'correct_options' => ['Network and security'],
                'justifications' => [
                    'SASE is not about infrastructure resources',
                    'Correct - SASE combines networking and security services',
                    'SASE is not about DevOps',
                    'SASE is not device-specific'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Secure Access Service Edge (SASE)'] ?? 6,
                'type_id' => 3,
                'dimension' => 'Technical',
                'content' => 'Drag the components that are typically included in a SASE architecture to the drop zone:',
                'options' => [
                    'SD-WAN',
                    'Physical firewalls',
                    'Cloud-based SWG',
                    'On-premises SIEM',
                    'Zero Trust Network Access',
                    'Traditional VPN appliances'
                ],
                'correct_options' => ['SD-WAN', 'Cloud-based SWG', 'Zero Trust Network Access'],
                'justifications' => [
                    'SD-WAN provides the network foundation for SASE',
                    'SASE uses cloud-native security, not physical appliances',
                    'Secure Web Gateway is a core SASE component',
                    'SIEM might integrate but isn\'t part of SASE',
                    'ZTNA is a fundamental SASE principle',
                    'SASE replaces traditional VPN with cloud-native access'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Secure Access Service Edge (SASE)'] ?? 6,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What is the primary benefit of SASE for distributed organizations?',
                'options' => [
                    'Reduced hardware costs',
                    'Consistent security regardless of location',
                    'Faster internet speeds',
                    'Simplified billing'
                ],
                'correct_options' => ['Consistent security regardless of location'],
                'justifications' => [
                    'Cost reduction is secondary benefit',
                    'Correct - SASE provides uniform security everywhere',
                    'SASE optimizes routing but doesn\'t increase bandwidth',
                    'Billing complexity depends on implementation'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Secure Access Service Edge (SASE)'] ?? 6,
                'type_id' => 2,
                'dimension' => 'Technical',
                'content' => '**True or False:** SASE requires all security functions to be moved to the cloud immediately.',
                'options' => [
                    'True',
                    'False'
                ],
                'correct_options' => ['False'],
                'justifications' => [
                    'explanation' => 'SASE adoption is typically gradual. Organizations can migrate services over time, maintaining hybrid architectures during transition. The goal is cloud-delivered security, but immediate wholesale migration is not required.'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],

            // Container & Serverless Security - 6 items
            [
                'topic_id' => $topics['Container & Serverless Security'] ?? 7,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What is the most critical security concern with container images?',
                'options' => [
                    'Image size',
                    'Vulnerabilities in base images and dependencies',
                    'Container names',
                    'Resource limits'
                ],
                'correct_options' => ['Vulnerabilities in base images and dependencies'],
                'justifications' => [
                    'Size affects performance, not security',
                    'Correct - Vulnerable base images affect all containers using them',
                    'Names are organizational, not security concerns',
                    'Resource limits prevent DoS but aren\'t the most critical'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Container & Serverless Security'] ?? 7,
                'type_id' => 3,
                'dimension' => 'Technical',
                'content' => 'Drag the security best practices for containerized applications to the drop zone:',
                'options' => [
                    'Run containers as root user',
                    'Use minimal base images',
                    'Scan images for vulnerabilities',
                    'Share namespaces between containers',
                    'Implement least privilege',
                    'Disable all logging'
                ],
                'correct_options' => ['Use minimal base images', 'Scan images for vulnerabilities', 'Implement least privilege'],
                'justifications' => [
                    'Running as root violates least privilege',
                    'Minimal images reduce attack surface',
                    'Scanning identifies vulnerabilities before deployment',
                    'Namespace sharing reduces isolation',
                    'Least privilege limits potential damage',
                    'Logging is essential for security monitoring'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Container & Serverless Security'] ?? 7,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Which unique security challenge does serverless computing introduce?',
                'options' => [
                    'Physical server security',
                    'Operating system patching',
                    'Limited visibility into runtime environment',
                    'Network cable management'
                ],
                'correct_options' => ['Limited visibility into runtime environment'],
                'justifications' => [
                    'Serverless abstracts physical infrastructure',
                    'Provider handles OS patching in serverless',
                    'Correct - Customers have minimal visibility into execution environment',
                    'No physical infrastructure in serverless'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Container & Serverless Security'] ?? 7,
                'type_id' => 7,
                'dimension' => 'Technical',
                'content' => 'Analyze this container configuration and identify the security issue:',
                'options' => [
                    'Missing health checks',
                    'Running as root user',
                    'No resource limits',
                    'Exposed sensitive data'
                ],
                'correct_options' => ['Running as root user'],
                'justifications' => [
                    'Health checks affect availability, not security',
                    'Correct - Running as root violates least privilege principle',
                    'Resource limits are set appropriately',
                    'Environment variables don\'t show sensitive data'
                ],
                'settings' => [
                    'shell' => 'container-scan',
                    'commands' => [
                        [
                            'pattern' => '^scan dockerfile$',
                            'response' => "FROM ubuntu:latest\nRUN apt-get update && apt-get install -y nginx\nUSER root\nCOPY app /app\nEXPOSE 80\nCMD [\"nginx\", \"-g\", \"daemon off;\"]\n\n[WARNING] Container runs as root user\n[OK] Resource limits configured\n[OK] No hardcoded secrets detected",
                            'isError' => false
                        ]
                    ]
                ],
                'difficulty_level' => 1,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Container & Serverless Security'] ?? 7,
                'type_id' => 2,
                'dimension' => 'Technical',
                'content' => '**True or False:** Serverless functions are immune to injection attacks.',
                'options' => [
                    'True',
                    'False'
                ],
                'correct_options' => ['False'],
                'justifications' => [
                    'explanation' => 'Serverless functions are still vulnerable to injection attacks like SQL injection, command injection, and others. The serverless model changes the infrastructure but application-level vulnerabilities remain.'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 5,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Container & Serverless Security'] ?? 7,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What is the primary purpose of admission controllers in Kubernetes security?',
                'options' => [
                    'Monitor running containers',
                    'Enforce policies before objects are created',
                    'Manage network traffic',
                    'Store security logs'
                ],
                'correct_options' => ['Enforce policies before objects are created'],
                'justifications' => [
                    'Admission controllers work at creation, not runtime',
                    'Correct - They validate/mutate objects before persistence',
                    'Network policies handle traffic management',
                    'Logging is handled by other components'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3,
                'status' => 'published'
            ],

            // Cloud Security Frameworks - 4 items
            [
                'topic_id' => $topics['Cloud Security Frameworks'] ?? 8,
                'type_id' => 5,
                'dimension' => 'Technical',
                'content' => 'Match each cloud security framework with its primary focus:',
                'options' => [
                    'items' => [
                        'CSA CCM',
                        'ISO 27017',
                        'NIST Cybersecurity Framework',
                        'CIS Controls'
                    ],
                    'responses' => [
                        'Cloud-specific security controls',
                        'Cloud service guidelines for ISO 27001',
                        'General cybersecurity risk management',
                        'Prioritized security actions'
                    ]
                ],
                'correct_options' => [
                    'CSA CCM' => 'Cloud-specific security controls',
                    'ISO 27017' => 'Cloud service guidelines for ISO 27001',
                    'NIST Cybersecurity Framework' => 'General cybersecurity risk management',
                    'CIS Controls' => 'Prioritized security actions'
                ],
                'justifications' => [
                    'CSA CCM' => 'Cloud Controls Matrix specifically for cloud security',
                    'ISO 27017' => 'Provides cloud guidance for ISO 27001/27002',
                    'NIST Cybersecurity Framework' => 'Broad framework applicable beyond cloud',
                    'CIS Controls' => 'Top 20 controls prioritized by effectiveness'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Cloud Security Frameworks'] ?? 8,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'How many control domains does the CSA Cloud Controls Matrix (CCM) v4 contain?',
                'options' => [
                    '11 domains',
                    '17 domains',
                    '23 domains',
                    '35 domains'
                ],
                'correct_options' => ['17 domains'],
                'justifications' => [
                    'CCM v3 had fewer domains',
                    'Correct - CCM v4 contains 17 control domains',
                    'This exceeds the actual number',
                    'Too many domains for practical use'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 5,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Cloud Security Frameworks'] ?? 8,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Which framework provides a cloud security reference architecture?',
                'options' => [
                    'PCI DSS',
                    'CSA Enterprise Architecture',
                    'GDPR',
                    'SOC 2'
                ],
                'correct_options' => ['CSA Enterprise Architecture'],
                'justifications' => [
                    'PCI DSS is for payment card security',
                    'Correct - CSA provides reference architecture for cloud security',
                    'GDPR is privacy regulation, not architecture',
                    'SOC 2 is an audit framework'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 5,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Cloud Security Frameworks'] ?? 8,
                'type_id' => 2,
                'dimension' => 'Technical',
                'content' => '**True or False:** Cloud security frameworks replace the need for traditional security frameworks.',
                'options' => [
                    'True',
                    'False'
                ],
                'correct_options' => ['False'],
                'justifications' => [
                    'explanation' => 'Cloud security frameworks complement, not replace, traditional frameworks. They address cloud-specific concerns while building upon established security principles. Organizations often use both types together.'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],

            // Key Management Service vs Cloud HSM - 5 items
            [
                'topic_id' => $topics['Key Management Service (KMS) vs Cloud HSM'] ?? 9,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What is the primary difference between KMS and Cloud HSM?',
                'options' => [
                    'KMS is cheaper than Cloud HSM',
                    'KMS is multi-tenant, Cloud HSM is single-tenant',
                    'KMS is faster than Cloud HSM',
                    'KMS supports more algorithms'
                ],
                'correct_options' => ['KMS is multi-tenant, Cloud HSM is single-tenant'],
                'justifications' => [
                    'Cost is a factor but not the primary difference',
                    'Correct - KMS shares infrastructure, Cloud HSM provides dedicated hardware',
                    'Performance varies by use case',
                    'Cloud HSM typically supports more algorithms'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Key Management Service (KMS) vs Cloud HSM'] ?? 9,
                'type_id' => 5,
                'dimension' => 'Technical',
                'content' => 'Match each use case with the appropriate service:',
                'options' => [
                    'items' => [
                        'FIPS 140-2 Level 3 requirement',
                        'Envelope encryption for S3',
                        'High-volume TLS certificates',
                        'Regulatory key custody requirements'
                    ],
                    'responses' => [
                        'KMS',
                        'Cloud HSM',
                        'Either KMS or Cloud HSM'
                    ]
                ],
                'correct_options' => [
                    'FIPS 140-2 Level 3 requirement' => 'Cloud HSM',
                    'Envelope encryption for S3' => 'KMS',
                    'High-volume TLS certificates' => 'Cloud HSM',
                    'Regulatory key custody requirements' => 'Cloud HSM'
                ],
                'justifications' => [
                    'FIPS 140-2 Level 3 requirement' => 'Only Cloud HSM meets Level 3',
                    'Envelope encryption for S3' => 'KMS integrates natively with S3',
                    'High-volume TLS certificates' => 'Cloud HSM better for high-performance crypto',
                    'Regulatory key custody requirements' => 'Cloud HSM provides full key control'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Key Management Service (KMS) vs Cloud HSM'] ?? 9,
                'type_id' => 3,
                'dimension' => 'Technical',
                'content' => 'Drag the characteristics that apply to **Cloud HSM** to the drop zone:',
                'options' => [
                    'Dedicated hardware',
                    'Automatic key rotation',
                    'FIPS 140-2 Level 3',
                    'Fully managed service',
                    'Customer-controlled keys',
                    'Integrated with all cloud services'
                ],
                'correct_options' => ['Dedicated hardware', 'FIPS 140-2 Level 3', 'Customer-controlled keys'],
                'justifications' => [
                    'Cloud HSM provides dedicated hardware security modules',
                    'KMS handles automatic rotation, not Cloud HSM',
                    'Cloud HSM achieves FIPS 140-2 Level 3 certification',
                    'Cloud HSM requires more customer management',
                    'Customers have full control over Cloud HSM keys',
                    'KMS has broader service integration'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Key Management Service (KMS) vs Cloud HSM'] ?? 9,
                'type_id' => 2,
                'dimension' => 'Technical',
                'content' => '**True or False:** KMS customer master keys (CMKs) can be exported for use outside the cloud.',
                'options' => [
                    'True',
                    'False'
                ],
                'correct_options' => ['False'],
                'justifications' => [
                    'explanation' => 'KMS CMKs cannot be exported from the service. They remain within KMS boundaries for security. If you need exportable keys, you must use Cloud HSM or manage your own key material.'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Key Management Service (KMS) vs Cloud HSM'] ?? 9,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'When should an organization choose Cloud HSM over KMS?',
                'options' => [
                    'For all encryption needs',
                    'When contractual or regulatory requirements demand it',
                    'To reduce costs',
                    'For better cloud service integration'
                ],
                'correct_options' => ['When contractual or regulatory requirements demand it'],
                'justifications' => [
                    'Cloud HSM is overkill for many use cases',
                    'Correct - Compliance often requires HSM-level key control',
                    'Cloud HSM is more expensive than KMS',
                    'KMS has better native integration'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 5,
                'status' => 'published'
            ],

            // Virtualization Security - 5 items (2 new + 3 existing)
            [
                'topic_id' => $topics['Virtualisation & Hypervisor Security'] ?? 10,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What is the primary security concern with VM escape attacks?',
                'options' => [
                    'Loss of VM data',
                    'Access to the hypervisor and other VMs',
                    'Network bandwidth consumption',
                    'CPU overconsumption'
                ],
                'correct_options' => ['Access to the hypervisor and other VMs'],
                'justifications' => [
                    'VM escape goes beyond single VM compromise',
                    'Correct - Escaping allows access to hypervisor and all VMs',
                    'This is a performance, not security concern',
                    'Resource consumption is a different attack type'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Virtualisation & Hypervisor Security'] ?? 10,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Which type of hypervisor is generally considered more secure?',
                'options' => [
                    'Type 1 (bare metal)',
                    'Type 2 (hosted)',
                    'Both are equally secure',
                    'Security depends on the vendor'
                ],
                'correct_options' => ['Type 1 (bare metal)'],
                'justifications' => [
                    'Correct - Type 1 has smaller attack surface without host OS',
                    'Type 2 includes host OS vulnerabilities',
                    'Type 1 is generally more secure',
                    'While vendor matters, Type 1 is architecturally more secure'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Virtualisation & Hypervisor Security'] ?? 10,
                'type_id' => 2,
                'dimension' => 'Technical',
                'content' => '**True or False:** Virtual machine isolation guarantees that malware in one VM cannot affect other VMs on the same host.',
                'options' => [
                    'True',
                    'False'
                ],
                'correct_options' => ['False'],
                'justifications' => [
                    'explanation' => 'While VMs provide strong isolation, it\'s not absolute. VM escape vulnerabilities, shared resource attacks, and hypervisor bugs can potentially allow cross-VM attacks. Defense in depth is still necessary.'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 5,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Virtualisation & Hypervisor Security'] ?? 10,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Evaluate the security implications of implementing nested virtualization in a cloud environment. What is the primary concern?',
                'options' => [
                    'Increased licensing costs',
                    'Reduced performance overhead',
                    'Expanded attack surface and complexity',
                    'Simplified backup procedures'
                ],
                'correct_options' => ['Expanded attack surface and complexity'],
                'justifications' => [
                    'Licensing is an operational, not security concern',
                    'Performance reduction is not a security issue',
                    'Correct - Nested virtualization adds multiple hypervisor layers, increasing attack vectors and complexity',
                    'Backup complexity is not a primary security concern'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Virtualisation & Hypervisor Security'] ?? 10,
                'type_id' => 3,
                'dimension' => 'Technical',
                'content' => 'Drag the virtualization security controls that should be implemented to protect against **side-channel attacks** to the drop zone:',
                'options' => [
                    'CPU resource isolation',
                    'Memory deduplication',
                    'Cache partitioning',
                    'VM snapshots',
                    'Hypervisor randomization',
                    'Network load balancing'
                ],
                'correct_options' => ['CPU resource isolation', 'Cache partitioning', 'Hypervisor randomization'],
                'justifications' => [
                    'CPU isolation prevents timing attacks through shared processors',
                    'Memory deduplication can actually create side-channel risks',
                    'Cache partitioning prevents cache-based side-channel attacks',
                    'Snapshots are for backup, not side-channel protection',
                    'Randomization makes timing attacks more difficult',
                    'Network load balancing is unrelated to side-channel attacks'
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
        
        $this->command->info('Domain 13 (Cloud Security) diagnostic items seeded successfully!');
    }
}