<?php

namespace Database\Seeders\Diagnostics;

class D14CloudSecuritySeeder extends BaseDiagnosticSeeder
{
    protected string $domainName = 'Cloud Security';
    
    protected function getQuestions(): array
    {
        return [
            // Topic 1: Cloud Service Models & Deployment (10 questions)
            // Bloom Distribution: L1:1, L2:2, L3:3, L4:2, L5:2
            
            // Item 1 - L1 - Remember
            [
                'subtopic' => 'Cloud Models',
                'question' => 'Which of the following is a fundamental characteristic of cloud computing that allows users to increase or decrease computing resources rapidly and elastically without manual intervention?',
                'options' => [
                    'Resource Pooling',
                    'Broad Network Access',
                    'Rapid Elasticity',
                    'Measured Service'
                ],
                'correct_options' => ['Rapid Elasticity'],
                'justifications' => [
                    'Incorrect - Resource Pooling refers to the cloud provider\'s computing resources being pooled to serve multiple consumers using a multi-tenant model',
                    'Incorrect - Broad Network Access means cloud capabilities are available over the network through standard mechanisms',
                    'Correct - Rapid Elasticity is the fundamental characteristic that allows users to automatically scale computing resources up or down based on demand without manual intervention',
                    'Incorrect - Measured Service provides transparency for both provider and consumer by monitoring, controlling, and reporting resource usage'
                ],
                'bloom_level' => 1,
                'difficulty_level' => 1,
                'type_id' => 1,
                'status' => 'published',
                'irt_a' => 0.8,
                'irt_b' => -1.5,
                'irt_c' => 0.25
            ],
            
            // Item 2 - L2 - Understand
            [
                'subtopic' => 'Cloud Models',
                'question' => 'Which of the following is a benefit of cloud computing from a cost perspective?',
                'options' => [
                    'High initial capital expenditure (CapEx)',
                    'Shift from operational expenditure (OpEx) to capital expenditure (CapEx)',
                    'Elimination of all IT costs',
                    'Shift from capital expenditure (CapEx) to operational expenditure (OpEx)'
                ],
                'correct_options' => ['Shift from capital expenditure (CapEx) to operational expenditure (OpEx)'],
                'justifications' => [
                    'Incorrect - High initial capital expenditure is a traditional on-premises characteristic that cloud computing helps to avoid',
                    'Incorrect - This describes the opposite of cloud computing\'s cost benefit; cloud actually shifts away from CapEx to OpEx',
                    'Incorrect - Cloud computing does not eliminate IT costs but rather changes how they are structured and often reduces total cost of ownership',
                    'Correct - Cloud computing shifts costs from large upfront capital investments (CapEx) to pay-as-you-go operational expenses (OpEx), improving cash flow and reducing financial risk'
                ],
                'bloom_level' => 2,
                'difficulty_level' => 2,
                'type_id' => 1,
                'status' => 'published',
                'irt_a' => 1.0,
                'irt_b' => -0.8,
                'irt_c' => 0.25
            ],
            
            // Item 3 - L1 - Remember
            [
                'subtopic' => 'Cloud Models',
                'question' => 'Who is responsible for defining cloud SLAs and service terms?',
                'options' => [
                    'Cloud broker',
                    'Cloud auditor',
                    'Cloud consumer',
                    'Cloud provider'
                ],
                'correct_options' => ['Cloud provider'],
                'justifications' => [
                    'Incorrect - Cloud brokers act as intermediaries but do not define the original SLAs and service terms',
                    'Incorrect - Cloud auditors assess and verify compliance but do not define service terms',
                    'Incorrect - Cloud consumers accept and use services under the terms but do not define them',
                    'Correct - Cloud providers are responsible for defining SLAs and service terms as they own and operate the cloud services'
                ],
                'bloom_level' => 1,
                'difficulty_level' => 1,
                'type_id' => 1,
                'status' => 'published',
                'irt_a' => 0.9,
                'irt_b' => -1.0,
                'irt_c' => 0.25
            ],
            
            // Item 4 - L2 - Understand
            [
                'subtopic' => 'Cloud Models',
                'question' => 'A cloud model that promotes rapid elasticity primarily benefits which of the following?',
                'options' => [
                    'Cost reduction',
                    'Availability zones',
                    'Static workloads',
                    'Manual deployments'
                ],
                'correct_options' => ['Cost reduction'],
                'justifications' => [
                    'Correct - Rapid elasticity enables automatic scaling based on demand, allowing organizations to pay only for resources actually used, resulting in significant cost reduction',
                    'Incorrect - Availability zones are about geographic distribution and fault tolerance, not directly related to elasticity benefits',
                    'Incorrect - Static workloads have consistent resource requirements and do not benefit from elasticity',
                    'Incorrect - Manual deployments are the opposite of what elasticity enables; elasticity automates resource provisioning'
                ],
                'bloom_level' => 2,
                'difficulty_level' => 2,
                'type_id' => 1,
                'status' => 'published',
                'irt_a' => 1.1,
                'irt_b' => -0.3,
                'irt_c' => 0.25
            ],
            
            // Item 5 - L1 - Remember
            [
                'subtopic' => 'Cloud Models',
                'question' => 'Which cloud service model gives the customer the most control over the underlying infrastructure?',
                'options' => [
                    'SaaS',
                    'IaaS',
                    'PaaS',
                    'DaaS'
                ],
                'correct_options' => ['IaaS'],
                'justifications' => [
                    'Incorrect - SaaS (Software as a Service) provides the least control as customers only access the application',
                    'Correct - IaaS (Infrastructure as a Service) provides the most control, allowing customers to manage operating systems, applications, and middleware while the provider manages the physical infrastructure',
                    'Incorrect - PaaS (Platform as a Service) provides moderate control, managing the platform but not the underlying infrastructure',
                    'Incorrect - DaaS (Desktop as a Service) provides virtual desktops but limited infrastructure control'
                ],
                'bloom_level' => 1,
                'difficulty_level' => 1,
                'type_id' => 1,
                'status' => 'published',
                'irt_a' => 0.8,
                'irt_b' => -1.2,
                'irt_c' => 0.25
            ],
            
            // Item 6 - L1 - Remember
            [
                'subtopic' => 'Cloud Models',
                'question' => 'Which cloud actor acts as an intermediary, providing value-added services such as arbitrage or aggregation for cloud consumers?',
                'options' => [
                    'Cloud Carrier',
                    'Cloud Auditor',
                    'Cloud Broker',
                    'Cloud Provider'
                ],
                'correct_options' => ['Cloud Broker'],
                'justifications' => [
                    'Incorrect - Cloud Carrier provides connectivity and transport services between cloud providers and consumers',
                    'Incorrect - Cloud Auditor conducts independent assessments of cloud services and implementations',
                    'Correct - Cloud Broker acts as an intermediary that provides value-added services like service arbitrage, aggregation, and intermediation to cloud consumers',
                    'Incorrect - Cloud Provider delivers cloud services directly to consumers, not as an intermediary'
                ],
                'bloom_level' => 1,
                'difficulty_level' => 1,
                'type_id' => 1,
                'status' => 'published',
                'irt_a' => 0.9,
                'irt_b' => -1.1,
                'irt_c' => 0.25
            ],
            
            // Item 7 - L2 - Understand
            [
                'subtopic' => 'Cloud Models',
                'question' => 'The concept of "resource pooling" in cloud computing implies:',
                'options' => [
                    'Resources are isolated for each tenant',
                    'Computing resources are dynamically assigned to consumers from a shared pool',
                    'Each consumer owns dedicated hardware',
                    'Resources are only available during specific hours'
                ],
                'correct_options' => ['Computing resources are dynamically assigned to consumers from a shared pool'],
                'justifications' => [
                    'Incorrect - Resource pooling involves sharing resources across multiple tenants, not isolation',
                    'Correct - Resource pooling means computing resources are shared among multiple consumers and dynamically assigned based on demand from a common pool',
                    'Incorrect - Resource pooling is the opposite of dedicated hardware ownership; it involves shared resources',
                    'Incorrect - Resource availability timing is not related to resource pooling; it refers to the sharing and dynamic allocation of resources'
                ],
                'bloom_level' => 2,
                'difficulty_level' => 2,
                'type_id' => 1,
                'status' => 'published',
                'irt_a' => 1.0,
                'irt_b' => -0.5,
                'irt_c' => 0.25
            ],
            
            // Item 8 - L2 - Understand
            [
                'subtopic' => 'Cloud Models',
                'question' => 'When securing a cloud environment, what is the role of "immutable infrastructure"?',
                'options' => [
                    'Servers are manually configured and updated in place',
                    'Servers are never changed after deployment; instead, new versions are deployed, and old ones are replaced',
                    'Data stored on servers cannot be modified',
                    'Network configurations are static and cannot be altered'
                ],
                'correct_options' => ['Servers are never changed after deployment; instead, new versions are deployed, and old ones are replaced'],
                'justifications' => [
                    'Incorrect - Manual in-place updates are the opposite of immutable infrastructure; they represent mutable infrastructure',
                    'Correct - Immutable infrastructure means servers are never modified after deployment; changes require deploying new instances and replacing old ones, reducing configuration drift and security risks',
                    'Incorrect - Immutable infrastructure refers to server/infrastructure immutability, not data immutability',
                    'Incorrect - Network configuration mutability is separate from infrastructure immutability; immutable infrastructure focuses on server instances'
                ],
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'type_id' => 1,
                'status' => 'published',
                'irt_a' => 1.2,
                'irt_b' => -0.2,
                'irt_c' => 0.25
            ],
            
            // Item 9 - L3 - Apply
            [
                'subtopic' => 'Cloud Models',
                'question' => 'Once a year, a company\'s private cloud experiences increased activity. The company has a disaster recovery site that is hosted in a public cloud. To avoid investment in additional hardware, which of the following actions would BEST address this issue?',
                'options' => [
                    'Configure cloud bursting to spin up new VMs automatically and terminate them when usage is back to normal',
                    'Activate the disaster recovery site, and deactivate it when usage is back to normal',
                    'Create a new backup site and decommission it when usage is back to normal',
                    'Manually add memory and CPU to existing VMs, and remove them when usage is back to normal'
                ],
                'correct_options' => ['Configure cloud bursting to spin up new VMs automatically and terminate them when usage is back to normal'],
                'justifications' => [
                    'Correct - Cloud bursting allows automatic scaling from private cloud to public cloud during demand spikes, providing cost-effective capacity without permanent hardware investment',
                    'Incorrect - Using the disaster recovery site for capacity management is inappropriate as it should remain available for actual disaster scenarios',
                    'Incorrect - Creating a new backup site doesn\'t address the capacity issue and adds unnecessary complexity and cost',
                    'Incorrect - Manual scaling is inefficient, doesn\'t avoid hardware investment, and may not provide sufficient capacity for significant demand spikes'
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'type_id' => 1,
                'status' => 'published',
                'irt_a' => 1.4,
                'irt_b' => 0.2,
                'irt_c' => 0.25
            ],
            
            // Item 10 - L4 - Analyze
            [
                'subtopic' => 'Cloud Models',
                'question' => 'A marketing team is using a SaaS-based service to send emails to large groups of potential customers. Last week, the first email campaign sent emails successfully to 3,000 potential customers. This week, the email campaign attempted to send out 50,000 emails, but only 10,000 were sent. Which of the following is the MOST likely reason for not sending all the emails?',
                'options' => [
                    'API request limit',
                    'Incorrect billing account',
                    'Misconfigured auto-scaling',
                    'Bandwidth limitation'
                ],
                'correct_options' => ['API request limit'],
                'justifications' => [
                    'Correct - SaaS email services typically impose API rate limits or daily/hourly sending quotas to prevent spam and manage resource usage. The dramatic increase from 3,000 to 50,000 emails likely exceeded the service\'s allowed limits',
                    'Incorrect - Billing issues would typically prevent service access entirely, not allow partial email sending',
                    'Incorrect - Auto-scaling applies to infrastructure services, not SaaS email services that handle scaling automatically',
                    'Incorrect - Bandwidth limitations would affect all network operations, not specifically limit email sending to a precise number'
                ],
                'bloom_level' => 4,
                'difficulty_level' => 3,
                'type_id' => 1,
                'status' => 'published',
                'irt_a' => 1.5,
                'irt_b' => 0.3,
                'irt_c' => 0.20
            ],
            
            // Topic 2: Cloud Identity & Access Management (10 questions)
            // Bloom Distribution: L1:1, L2:2, L3:3, L4:2, L5:2
            
            // Item 11 - L4 - Analyze
            [
                'subtopic' => 'Cloud Fundamentals',
                'question' => 'A developer is no longer able to access a public cloud API deployment, which was working ten minutes prior. Which of the following is MOST likely the cause?',
                'options' => [
                    'API provider rate limiting',
                    'Invalid API token',
                    'Depleted network bandwidth',
                    'Invalid API request'
                ],
                'correct_options' => ['API provider rate limiting'],
                'justifications' => [
                    'Correct - API rate limiting is the most likely cause for sudden access loss after working normally, as it temporarily blocks requests when usage thresholds are exceeded',
                    'Incorrect - Invalid API tokens would prevent access from the beginning, not after working for some time',
                    'Incorrect - Network bandwidth depletion would affect all network operations, not specifically API access',
                    'Incorrect - Invalid API requests would return error responses rather than prevent access entirely'
                ],
                'bloom_level' => 4,
                'difficulty_level' => 3,
                'type_id' => 1,
                'status' => 'published',
                'irt_a' => 1.6,
                'irt_b' => 0.4,
                'irt_c' => 0.20
            ],
            
            // Item 12 - L3 - Apply
            [
                'subtopic' => 'Cloud Fundamentals',
                'question' => 'A cloud administrator is reviewing the annual contracts for all hosted solutions. Upon review of the contract for the hosted mail solution, the administrator notes the monthly subscription rate has increased every year. The provider has been in place for ten years, and there is a large amount of data being hosted. Which of the following is a barrier to switching providers?',
                'options' => [
                    'Service-level agreement',
                    'Vendor lock-in',
                    'Memorandum of understanding',
                    'Encrypted data'
                ],
                'correct_options' => ['Vendor lock-in'],
                'justifications' => [
                    'Incorrect - Service-level agreements define performance standards but are not barriers to switching providers',
                    'Correct - Vendor lock-in occurs when switching costs become prohibitive due to data migration complexity, proprietary formats, or integration dependencies built over ten years',
                    'Incorrect - Memorandum of understanding is a preliminary agreement and not a switching barrier',
                    'Incorrect - Encrypted data can be migrated; encryption itself is not a switching barrier'
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'type_id' => 1,
                'status' => 'published',
                'irt_a' => 1.3,
                'irt_b' => 0.1,
                'irt_c' => 0.25
            ],
            
            // Item 13 - L2 - Understand
            [
                'subtopic' => 'Cloud Fundamentals',
                'question' => 'A systems administrator is creating a VM and wants to ensure disk space is not allocated to the VM until it is needed. Which of the following techniques should the administrator use to ensure this?',
                'options' => [
                    'Deduplication',
                    'Thin provisioning',
                    'Software-defined storage',
                    'iSCSI storage'
                ],
                'correct_options' => ['Thin provisioning'],
                'justifications' => [
                    'Incorrect - Deduplication eliminates duplicate data to save space but does not control initial allocation timing',
                    'Correct - Thin provisioning allocates storage space on-demand as data is written, rather than pre-allocating the full disk capacity upfront',
                    'Incorrect - Software-defined storage is an architecture approach but does not specifically address allocation timing',
                    'Incorrect - iSCSI is a storage protocol and does not control space allocation behavior'
                ],
                'bloom_level' => 2,
                'difficulty_level' => 2,
                'type_id' => 1,
                'status' => 'published',
                'irt_a' => 1.1,
                'irt_b' => -0.6,
                'irt_c' => 0.25
            ],
            
            // Item 14 - L3 - Apply
            [
                'subtopic' => 'Cloud Fundamentals',
                'question' => 'After accidentally uploading a password for an IAM user in plain text, which of the following should a cloud administrator do FIRST? (Choose two.)',
                'options' => [
                    'Identify the resources that are accessible to the affected IAM user',
                    'Remove the published plain-text password',
                    'Notify users that a data breach has occurred',
                    'Change the affected IAM user\'s password'
                ],
                'correct_options' => ['Remove the published plain-text password', 'Change the affected IAM user\'s password'],
                'justifications' => [
                    'Correct - Identifying accessible resources is important but secondary to immediate containment actions',
                    'Correct - Removing the exposed password immediately prevents further unauthorized access attempts',
                    'Incorrect - Breach notification comes after containment and impact assessment are complete',
                    'Correct - Changing the password immediately invalidates the exposed credential, preventing unauthorized access'
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'type_id' => 1,
                'status' => 'published',
                'irt_a' => 1.4,
                'irt_b' => 0.3,
                'irt_c' => 0.25
            ],
            
            // Item 15 - L4 - Analyze
            [
                'subtopic' => 'Cloud Fundamentals',
                'question' => 'A cloud administrator has finished setting up an application that will use RDP to connect. During testing, users experience a connection timeout error. Which of the following will MOST likely solve the issue?',
                'options' => [
                    'Checking user passwords',
                    'Configuring QoS rules',
                    'Enforcing TLS authentication',
                    'Opening TCP port 3389'
                ],
                'correct_options' => ['Opening TCP port 3389'],
                'justifications' => [
                    'Incorrect - Password issues would result in authentication failures, not connection timeouts',
                    'Incorrect - QoS rules affect performance and prioritization, not basic connectivity',
                    'Incorrect - TLS authentication issues would cause certificate or handshake errors, not timeouts',
                    'Correct - RDP uses TCP port 3389; connection timeouts typically indicate firewall or network access control blocking the required port'
                ],
                'bloom_level' => 4,
                'difficulty_level' => 3,
                'type_id' => 1,
                'status' => 'published',
                'irt_a' => 1.5,
                'irt_b' => 0.2,
                'irt_c' => 0.20
            ],
            
            // Item 16 - L3 - Apply
            [
                'subtopic' => 'Cloud Fundamentals',
                'question' => 'A cloud administrator set up a link between the private and public cloud through a VPN tunnel. As part of the migration, a large set of files will be copied. Which of the following network ports are required from a security perspective?',
                'options' => [
                    '22, 53, 445',
                    '22, 443, 445',
                    '25, 123, 443',
                    '137, 139, 445'
                ],
                'correct_options' => ['22, 443, 445'],
                'justifications' => [
                    'Incorrect - Port 53 (DNS) is not typically required for secure file transfers over VPN',
                    'Correct - Port 22 (SSH/SCP/SFTP), 443 (HTTPS/SSL), and 445 (SMB over IP) are commonly used for secure file transfers in hybrid cloud scenarios',
                    'Incorrect - Port 25 (SMTP) is for email and 123 (NTP) is for time synchronization, not file transfers',
                    'Incorrect - Ports 137 and 139 are legacy NetBIOS ports that are less secure than modern alternatives'
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'type_id' => 1,
                'status' => 'published',
                'irt_a' => 1.5,
                'irt_b' => 0.4,
                'irt_c' => 0.25
            ],
            
            // Item 17 - L3 - Apply
            [
                'subtopic' => 'Cloud Fundamentals',
                'question' => 'A company is preparing a hypervisor environment to implement a database cluster. One of the requirements is to share the disks between the nodes of the cluster to access the same LUN. Which of the following protocols should the company use? (Choose two.)',
                'options' => [
                    'iSCSI',
                    'FC',
                    'CIFS',
                    'NFS'
                ],
                'correct_options' => ['iSCSI', 'FC'],
                'justifications' => [
                    'Correct - iSCSI (Internet Small Computer Systems Interface) provides block-level access to shared storage over IP networks, allowing multiple nodes to access the same LUN',
                    'Correct - FC (Fibre Channel) provides high-performance block-level access to shared storage, commonly used in enterprise database clusters for shared disk access',
                    'Incorrect - CIFS (Common Internet File System) is a file-level protocol, not suitable for shared block-level database storage',
                    'Incorrect - NFS (Network File System) provides file-level sharing but not the block-level access required for database cluster shared storage'
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'type_id' => 1,
                'status' => 'published',
                'irt_a' => 1.4,
                'irt_b' => 0.3,
                'irt_c' => 0.25
            ],
            
            // Item 18 - L3 - Apply
            [
                'subtopic' => 'Cloud Fundamentals',
                'question' => 'A DevOps administrator is designing a new machine-learning platform. The application needs to be portable between public and private clouds and should be kept as small as possible. Which of the following approaches would BEST meet these requirements?',
                'options' => [
                    'Virtual machines',
                    'Software as a service',
                    'Serverless computing',
                    'Containers'
                ],
                'correct_options' => ['Containers'],
                'justifications' => [
                    'Incorrect - Virtual machines have large overhead and are less portable due to hypervisor dependencies',
                    'Incorrect - SaaS eliminates portability as the application becomes dependent on a specific provider\'s platform',
                    'Incorrect - Serverless computing lacks portability between cloud providers due to vendor-specific implementations',
                    'Correct - Containers provide maximum portability across cloud environments, minimal overhead, and consistent runtime behavior regardless of the underlying infrastructure'
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'type_id' => 1,
                'status' => 'published',
                'irt_a' => 1.3,
                'irt_b' => 0.2,
                'irt_c' => 0.25
            ],
            
            // Item 19 - L2 - Understand
            [
                'subtopic' => 'Cloud Fundamentals',
                'question' => 'Which of the following definitions of serverless computing BEST explains how it is different from using VMs?',
                'options' => [
                    'Serverless computing is a cloud-hosting service that utilizes infrastructure that is fully managed by the CSP',
                    'Serverless computing uses predictable billing and offers lower costs than VM compute services',
                    'Serverless computing is a scalable, highly available cloud service that uses SDN technologies',
                    'Serverless computing allows developers to focus on writing code and organizations to focus on business'
                ],
                'correct_options' => ['Serverless computing allows developers to focus on writing code and organizations to focus on business'],
                'justifications' => [
                    'Incorrect - While infrastructure is managed by CSP, this doesn\'t distinguish serverless from managed VM services',
                    'Incorrect - Serverless billing is event-driven and can be unpredictable; cost comparison varies by use case',
                    'Incorrect - Scalability and SDN technologies are available in both serverless and VM environments',
                    'Correct - The key differentiator is that serverless abstracts away infrastructure management, allowing developers to focus solely on application logic rather than server provisioning, scaling, and maintenance'
                ],
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'type_id' => 1,
                'status' => 'published',
                'irt_a' => 1.2,
                'irt_b' => -0.2,
                'irt_c' => 0.25
            ],
            
            // Item 20 - L1 - Remember
            [
                'subtopic' => 'Cloud Fundamentals',
                'question' => 'A technician needs to deploy two virtual machines in preparation for the configuration of a financial application next week. Which of the following cloud deployment models should the technician use?',
                'options' => [
                    'XaaS',
                    'IaaS',
                    'PaaS',
                    'SaaS'
                ],
                'correct_options' => ['IaaS'],
                'justifications' => [
                    'Incorrect - XaaS (Everything as a Service) is a general term, not a specific deployment model for VMs',
                    'Correct - IaaS (Infrastructure as a Service) provides virtual machines and computing infrastructure, which is exactly what\'s needed to deploy VMs',
                    'Incorrect - PaaS (Platform as a Service) provides application platforms, not direct VM access',
                    'Incorrect - SaaS (Software as a Service) provides ready-to-use applications, not infrastructure for VM deployment'
                ],
                'bloom_level' => 1,
                'difficulty_level' => 1,
                'type_id' => 1,
                'status' => 'published',
                'irt_a' => 0.8,
                'irt_b' => -1.3,
                'irt_c' => 0.25
            ],
            
            // Topic 3: Cloud Data Protection (10 questions)
            // Bloom Distribution: L1:2, L2:2, L3:3, L4:2, L5:1
            
            // Item 21 - L2 - Understand
            [
                'subtopic' => 'Cloud Governance',
                'question' => 'Which of the following is relevant to capacity planning in a SaaS environment?',
                'options' => [
                    'Licensing',
                    'A hypervisor',
                    'Clustering',
                    'Scalability'
                ],
                'correct_options' => ['Licensing'],
                'justifications' => [
                    'Correct - In SaaS environments, capacity planning primarily involves licensing considerations such as user seats, feature tiers, and usage limits rather than infrastructure components',
                    'Incorrect - Hypervisors are infrastructure components managed by the SaaS provider, not the customer',
                    'Incorrect - Clustering is an infrastructure concern handled by the SaaS provider, not relevant to customer capacity planning',
                    'Incorrect - While scalability is important, in SaaS it\'s automatically handled by the provider; customers plan for licensing needs'
                ],
                'bloom_level' => 2,
                'difficulty_level' => 2,
                'type_id' => 1,
                'status' => 'published',
                'irt_a' => 1.1,
                'irt_b' => -0.6,
                'irt_c' => 0.25
            ],
            
            // Item 22 - L4 - Analyze
            [
                'subtopic' => 'Cloud Governance',
                'question' => 'A cloud administrator is setting up a new coworker for API access to a public cloud environment. The administrator creates a new user and gives the coworker access to a collection of automation scripts. When the coworker attempts to use a deployment script, a 403 error is returned. Which of the following is the MOST likely cause of the error?',
                'options' => [
                    'Connectivity to the public cloud is down',
                    'User permissions are not correct',
                    'The script has a configuration error',
                    'Oversubscription limits have been exceeded'
                ],
                'correct_options' => ['User permissions are not correct'],
                'justifications' => [
                    'Incorrect - Connectivity issues would result in connection timeouts or network errors, not HTTP 403',
                    'Correct - HTTP 403 Forbidden specifically indicates insufficient permissions; the user can authenticate but lacks authorization for the requested operation',
                    'Incorrect - Script configuration errors would typically result in different error codes or application-specific errors',
                    'Incorrect - Oversubscription limits would typically return HTTP 429 (Too Many Requests) or 503 (Service Unavailable)'
                ],
                'bloom_level' => 4,
                'difficulty_level' => 3,
                'type_id' => 1,
                'status' => 'published',
                'irt_a' => 1.5,
                'irt_b' => 0.2,
                'irt_c' => 0.20
            ],
            
            // Item 23 - L4 - Analyze
            [
                'subtopic' => 'Cloud Governance',
                'question' => 'A systems administrator is troubleshooting a performance issue with a virtual database server. The administrator has identified the issue as being disk related and believes the cause is a lack of IOPS on the existing spinning disk storage. Which of the following should the administrator do NEXT to resolve this issue?',
                'options' => [
                    'Upgrade the virtual database server',
                    'Move the virtual machine to flash storage and test again',
                    'Check if other machines on the same storage are having issues',
                    'Document the findings and place them in a shared knowledge base'
                ],
                'correct_options' => ['Check if other machines on the same storage are having issues'],
                'justifications' => [
                    'Incorrect - Upgrading the VM won\'t address the underlying storage IOPS limitation',
                    'Incorrect - Moving to flash storage should be done after confirming the root cause and considering cost implications',
                    'Correct - Before making changes, the administrator should verify if this is a systemic storage issue affecting other VMs to understand the scope and avoid unnecessary actions',
                    'Incorrect - Documentation is important but premature before completing the troubleshooting process'
                ],
                'bloom_level' => 4,
                'difficulty_level' => 3,
                'type_id' => 1,
                'status' => 'published',
                'irt_a' => 1.6,
                'irt_b' => 0.4,
                'irt_c' => 0.20
            ],
            
            // Item 24 - L3 - Apply
            [
                'subtopic' => 'Cloud Governance',
                'question' => 'An organization is using multiple SaaS-based business applications, and the systems administrator is unable to monitor and control the use of these subscriptions. The administrator needs to implement a solution that will help the organization apply security policies and monitor each individual SaaS subscription. Which of the following should be deployed to achieve these requirements?',
                'options' => [
                    'DLP',
                    'CASB',
                    'IPS',
                    'HIDS'
                ],
                'correct_options' => ['CASB'],
                'justifications' => [
                    'Incorrect - DLP (Data Loss Prevention) focuses on preventing data exfiltration but doesn\'t provide comprehensive SaaS monitoring and control',
                    'Correct - CASB (Cloud Access Security Broker) is specifically designed to provide visibility, compliance, security, and threat protection for cloud services and SaaS applications',
                    'Incorrect - IPS (Intrusion Prevention System) focuses on network-based threat prevention, not SaaS application governance',
                    'Incorrect - HIDS (Host-based Intrusion Detection System) monitors individual hosts, not cloud-based SaaS applications'
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'type_id' => 1,
                'status' => 'published',
                'irt_a' => 1.4,
                'irt_b' => 0.1,
                'irt_c' => 0.25
            ],
            
            // Item 25 - L2 - Understand
            [
                'subtopic' => 'Cloud Governance',
                'question' => 'Which of the following is NOT a feature of a Cloud Access Security Broker (CASB)?',
                'options' => [
                    'Data Loss Prevention (DLP)',
                    'Shadow IT Discovery',
                    'Intrusion Detection System (IDS)',
                    'Cloud Application Visibility'
                ],
                'correct_options' => ['Intrusion Detection System (IDS)'],
                'justifications' => [
                    'Incorrect - DLP is a core CASB feature that monitors and controls data movement to prevent unauthorized data exfiltration from cloud services',
                    'Incorrect - Shadow IT Discovery is a fundamental CASB capability that identifies unauthorized cloud applications being used within the organization',
                    'Correct - IDS is a network-based security technology that monitors network traffic for malicious activity, which is not a primary function of CASB solutions that focus on cloud application security',
                    'Incorrect - Cloud Application Visibility is a primary CASB feature that provides insight into which cloud applications are being used and how'
                ],
                'bloom_level' => 2,
                'difficulty_level' => 2,
                'type_id' => 1,
                'status' => 'published',
                'irt_a' => 1.1,
                'irt_b' => -0.4,
                'irt_c' => 0.25
            ],
            
            // Item 26 - L2 - Understand
            [
                'subtopic' => 'Cloud Governance',
                'question' => 'What is the PRIMARY purpose of using a Cloud Access Security Broker (CASB) solution?',
                'options' => [
                    'To secure cloud access for remote users',
                    'To expand an organization\'s security policy to the cloud',
                    'To replace traditional security devices with virtual appliances',
                    'To manage network traffic between on-premises and cloud environments'
                ],
                'correct_options' => ['To expand an organization\'s security policy to the cloud'],
                'justifications' => [
                    'Incorrect - While CASB can help secure remote access, its primary purpose is broader policy enforcement across cloud services',
                    'Correct - The primary purpose of CASB is to extend and enforce an organization\'s existing security policies and governance to cloud services and applications',
                    'Incorrect - CASB complements rather than replaces traditional security devices and operates as a policy enforcement point',
                    'Incorrect - Network traffic management is typically handled by other solutions like SD-WAN or cloud gateways, not CASB'
                ],
                'bloom_level' => 2,
                'difficulty_level' => 2,
                'type_id' => 1,
                'status' => 'published',
                'irt_a' => 1.2,
                'irt_b' => -0.3,
                'irt_c' => 0.25
            ],
            
            // Item 27 - L3 - Apply
            [
                'subtopic' => 'Cloud Governance',
                'question' => 'What is the most effective approach for backup and disaster recovery in multi-cloud environments?',
                'options' => [
                    'Store all backups with the same cloud provider as primary data',
                    'Implement cross-cloud backup with geographically distributed recovery sites',
                    'Only backup data locally on-premises',
                    'Rely on cloud provider built-in backup without additional measures'
                ],
                'correct_options' => ['Implement cross-cloud backup with geographically distributed recovery sites'],
                'justifications' => [
                    'Incorrect - Store all backups with the same cloud provider as primary data',
                    'Correct - Implement cross-cloud backup with geographically distributed recovery sites',
                    'Incorrect - Only backup data locally on-premises',
                    'Incorrect - Rely on cloud provider built-in backup without additional measures'
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'type_id' => 1,
                'status' => 'published'
                'irt_a' => 1.6,
                'irt_b' => 0.6,
                'irt_c' => 0.25
            ],
            
            // Item 28 - L4 - Analyze
            [
                'subtopic' => 'Cloud Governance',
                'question' => 'Analyze the privacy implications of using cloud services for personal data processing under GDPR.',
                'options' => [
                    'Cloud processing is prohibited under GDPR',
                    'Cloud processing requires data processing agreements and appropriate safeguards',
                    'GDPR does not apply to cloud environments',
                    'Cloud providers automatically ensure GDPR compliance'
                ],
                'correct_options' => ['Cloud processing requires data processing agreements and appropriate safeguards'],
                'justifications' => [
                    'Incorrect - Cloud processing is prohibited under GDPR',
                    'Correct - Cloud processing requires data processing agreements and appropriate safeguards',
                    'Incorrect - GDPR does not apply to cloud environments',
                    'Incorrect - Cloud providers automatically ensure GDPR compliance'
                ],
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'type_id' => 1,
                'status' => 'published'
                'irt_a' => 1.7,
                'irt_b' => 0.8,
                'irt_c' => 0.20
            ],
            
            // Item 29 - L4 - Analyze
            [
                'subtopic' => 'Cloud Governance',
                'question' => 'What is the fundamental challenge in achieving data portability while maintaining security in cloud environments?',
                'options' => [
                    'Data portability has no security implications',
                    'Balancing data accessibility for migration with protection against unauthorized access',
                    'Data portability is technically impossible in cloud environments',
                    'Security and portability are mutually exclusive'
                ],
                'correct_options' => ['Balancing data accessibility for migration with protection against unauthorized access'],
                'justifications' => [
                    'Incorrect - Data portability has no security implications',
                    'Correct - Balancing data accessibility for migration with protection against unauthorized access',
                    'Incorrect - Data portability is technically impossible in cloud environments',
                    'Incorrect - Security and portability are mutually exclusive'
                ],
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'type_id' => 1,
                'status' => 'published'
                'irt_a' => 1.8,
                'irt_b' => 1.0,
                'irt_c' => 0.20
            ],
            
            // Item 30 - L5 - Evaluate
            [
                'subtopic' => 'Cloud Governance',
                'question' => 'A company implements confidential computing for sensitive data processing in the cloud. Evaluate the security benefits and limitations.',
                'options' => [
                    'Confidential computing eliminates all cloud security risks',
                    'Provides strong data protection during processing but has performance and complexity trade-offs',
                    'Confidential computing is unnecessary for cloud security',
                    'Traditional encryption provides identical protection to confidential computing'
                ],
                'correct_options' => ['Provides strong data protection during processing but has performance and complexity trade-offs'],
                'justifications' => [
                    'Incorrect - Confidential computing eliminates all cloud security risks',
                    'Correct - Provides strong data protection during processing but has performance and complexity trade-offs',
                    'Incorrect - Confidential computing is unnecessary for cloud security',
                    'Incorrect - Traditional encryption provides identical protection to confidential computing'
                ],
                'bloom_level' => 5,
                'difficulty_level' => 5,
                'type_id' => 1,
                'status' => 'published'
                'irt_a' => 1.9,
                'irt_b' => 1.5,
                'irt_c' => 0.15
            ],
            
            // Topic 4: Cloud Infrastructure Security (10 questions)
            // Bloom Distribution: L1:2, L2:2, L3:3, L4:2, L5:1
            
            // Item 31 - L1 - Remember
            [
                'subtopic' => 'Cloud Infrastructure Security',
                'question' => 'What is the primary purpose of a Virtual Private Cloud (VPC)?',
                'options' => [
                    'Improving application performance',
                    'Creating isolated network environments within cloud infrastructure',
                    'Reducing cloud computing costs',
                    'Automatically scaling compute resources'
                ],
                'correct_options' => ['Creating isolated network environments within cloud infrastructure'],
                'justifications' => [
                    'Incorrect - Improving application performance',
                    'Correct - Creating isolated network environments within cloud infrastructure',
                    'Incorrect - Reducing cloud computing costs',
                    'Incorrect - Automatically scaling compute resources'
                ],
                'bloom_level' => 1,
                'difficulty_level' => 1,
                'type_id' => 1,
                'status' => 'published'
                'irt_a' => 0.8,
                'irt_b' => -1.5,
                'irt_c' => 0.25
            ],
            
            // Item 32 - L1 - Remember
            [
                'subtopic' => 'Cloud Infrastructure Security',
                'question' => 'What does Infrastructure as Code (IaC) enable in cloud environments?',
                'options' => [
                    'Manual configuration of all cloud resources',
                    'Automated, consistent, and repeatable infrastructure provisioning',
                    'Elimination of all security controls',
                    'Direct hardware access in cloud datacenters'
                ],
                'correct_options' => ['Automated, consistent, and repeatable infrastructure provisioning'],
                'justifications' => [
                    'Incorrect - Manual configuration of all cloud resources',
                    'Correct - Automated, consistent, and repeatable infrastructure provisioning',
                    'Incorrect - Elimination of all security controls',
                    'Incorrect - Direct hardware access in cloud datacenters'
                ],
                'bloom_level' => 1,
                'difficulty_level' => 1,
                'type_id' => 1,
                'status' => 'published'
                'irt_a' => 0.9,
                'irt_b' => -1.3,
                'irt_c' => 0.25
            ],
            
            // Item 33 - L2 - Understand
            [
                'subtopic' => 'Cloud Infrastructure Security',
                'question' => 'How do security groups and network ACLs differ in cloud network security?',
                'options' => [
                    'They are identical security mechanisms',
                    'Security groups are instance-level firewalls while NACLs are subnet-level',
                    'Security groups are faster than NACLs',
                    'NACLs are only for physical security'
                ],
                'correct_options' => ['Security groups are instance-level firewalls while NACLs are subnet-level'],
                'justifications' => [
                    'Incorrect - They are identical security mechanisms',
                    'Correct - Security groups are instance-level firewalls while NACLs are subnet-level',
                    'Incorrect - Security groups are faster than NACLs',
                    'Incorrect - NACLs are only for physical security'
                ],
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'type_id' => 1,
                'status' => 'published'
                'irt_a' => 1.2,
                'irt_b' => -0.4,
                'irt_c' => 0.25
            ],
            
            // Item 34 - L2 - Understand
            [
                'subtopic' => 'Cloud Infrastructure Security',
                'question' => 'Why is container security different from traditional virtual machine security?',
                'options' => [
                    'Containers are inherently more secure than VMs',
                    'Containers share the host OS kernel and require image and runtime security',
                    'Container security is identical to VM security',
                    'Containers cannot be secured effectively'
                ],
                'correct_options' => ['Containers share the host OS kernel and require image and runtime security'],
                'justifications' => [
                    'Incorrect - Containers are inherently more secure than VMs',
                    'Correct - Containers share the host OS kernel and require image and runtime security',
                    'Incorrect - Container security is identical to VM security',
                    'Incorrect - Containers cannot be secured effectively'
                ],
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'type_id' => 1,
                'status' => 'published'
                'irt_a' => 1.4,
                'irt_b' => -0.1,
                'irt_c' => 0.25
            ],
            
            // Item 35 - L3 - Apply
            [
                'subtopic' => 'Cloud Infrastructure Security',
                'question' => 'A microservices application needs secure service-to-service communication in a cloud environment. What approach should be implemented?',
                'options' => [
                    'Allow all internal communication without encryption',
                    'Implement service mesh with mutual TLS and identity-based policies',
                    'Use only network-level firewalls',
                    'Rely on cloud provider network security alone'
                ],
                'correct_options' => ['Implement service mesh with mutual TLS and identity-based policies'],
                'justifications' => [
                    'Incorrect - Allow all internal communication without encryption',
                    'Correct - Implement service mesh with mutual TLS and identity-based policies',
                    'Incorrect - Use only network-level firewalls',
                    'Incorrect - Rely on cloud provider network security alone'
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'type_id' => 1,
                'status' => 'published'
                'irt_a' => 1.5,
                'irt_b' => 0.2,
                'irt_c' => 0.25
            ],
            
            // Item 36 - L3 - Apply
            [
                'subtopic' => 'Cloud Infrastructure Security',
                'question' => 'How should an organization implement security for serverless functions?',
                'options' => [
                    'Serverless functions require no security considerations',
                    'Apply least privilege access, input validation, and secure secrets management',
                    'Only focus on network-level security',
                    'Use the same security controls as traditional servers'
                ],
                'correct_options' => ['Apply least privilege access, input validation, and secure secrets management'],
                'justifications' => [
                    'Incorrect - Serverless functions require no security considerations',
                    'Correct - Apply least privilege access, input validation, and secure secrets management',
                    'Incorrect - Only focus on network-level security',
                    'Incorrect - Use the same security controls as traditional servers'
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'type_id' => 1,
                'status' => 'published'
                'irt_a' => 1.4,
                'irt_b' => 0.4,
                'irt_c' => 0.25
            ],
            
            // Item 37 - L3 - Apply
            [
                'subtopic' => 'Cloud Infrastructure Security',
                'question' => 'What is the most effective approach for securing Infrastructure as Code templates?',
                'options' => [
                    'Store all templates in public repositories',
                    'Implement version control, security scanning, and policy as code',
                    'Only review templates manually before deployment',
                    'Use templates without any validation'
                ],
                'correct_options' => ['Implement version control, security scanning, and policy as code'],
                'justifications' => [
                    'Incorrect - Store all templates in public repositories',
                    'Correct - Implement version control, security scanning, and policy as code',
                    'Incorrect - Only review templates manually before deployment',
                    'Incorrect - Use templates without any validation'
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'type_id' => 1,
                'status' => 'published'
                'irt_a' => 1.6,
                'irt_b' => 0.6,
                'irt_c' => 0.25
            ],
            
            // Item 38 - L4 - Analyze
            [
                'subtopic' => 'Cloud Infrastructure Security',
                'question' => 'Analyze the security implications of using immutable infrastructure versus mutable infrastructure in cloud environments.',
                'options' => [
                    'Mutable infrastructure is always more secure',
                    'Immutable infrastructure reduces drift and attack surface but requires robust deployment processes',
                    'There are no security differences between the approaches',
                    'Immutable infrastructure is impossible to implement securely'
                ],
                'correct_options' => ['Immutable infrastructure reduces drift and attack surface but requires robust deployment processes'],
                'justifications' => [
                    'Incorrect - Mutable infrastructure is always more secure',
                    'Correct - Immutable infrastructure reduces drift and attack surface but requires robust deployment processes',
                    'Incorrect - There are no security differences between the approaches',
                    'Incorrect - Immutable infrastructure is impossible to implement securely'
                ],
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'type_id' => 1,
                'status' => 'published'
                'irt_a' => 1.7,
                'irt_b' => 0.9,
                'irt_c' => 0.20
            ],
            
            // Item 39 - L4 - Analyze
            [
                'subtopic' => 'Cloud Infrastructure Security',
                'question' => 'What is the fundamental security challenge in managing ephemeral cloud resources?',
                'options' => [
                    'Ephemeral resources are inherently insecure',
                    'Traditional security models assume persistent resources for monitoring and control',
                    'Ephemeral resources cannot be protected',
                    'Cloud providers do not support ephemeral resource security'
                ],
                'correct_options' => ['Traditional security models assume persistent resources for monitoring and control'],
                'justifications' => [
                    'Incorrect - Ephemeral resources are inherently insecure',
                    'Correct - Traditional security models assume persistent resources for monitoring and control',
                    'Incorrect - Ephemeral resources cannot be protected',
                    'Incorrect - Cloud providers do not support ephemeral resource security'
                ],
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'type_id' => 1,
                'status' => 'published'
                'irt_a' => 1.8,
                'irt_b' => 1.1,
                'irt_c' => 0.20
            ],
            
            // Item 40 - L5 - Evaluate
            [
                'subtopic' => 'Cloud Infrastructure Security',
                'question' => 'An organization implements auto-scaling infrastructure that spins up resources based on demand. Evaluate the security considerations for this approach.',
                'options' => [
                    'Auto-scaling eliminates all security risks',
                    'Auto-scaling can improve resilience but requires security automation and baseline hardening',
                    'Auto-scaling should never be used for security reasons',
                    'Security is not relevant for auto-scaled resources'
                ],
                'correct_options' => ['Auto-scaling can improve resilience but requires security automation and baseline hardening'],
                'justifications' => [
                    'Incorrect - Auto-scaling eliminates all security risks',
                    'Correct - Auto-scaling can improve resilience but requires security automation and baseline hardening',
                    'Incorrect - Auto-scaling should never be used for security reasons',
                    'Incorrect - Security is not relevant for auto-scaled resources'
                ],
                'bloom_level' => 5,
                'difficulty_level' => 5,
                'type_id' => 1,
                'status' => 'published'
                'irt_a' => 1.9,
                'irt_b' => 1.4,
                'irt_c' => 0.15
            ],
            
            // Topic 5: Cloud Compliance & Governance (10 questions)
            // Bloom Distribution: L1:2, L2:2, L3:3, L4:2, L5:1
            
            // Item 41 - L1 - Remember
            [
                'subtopic' => 'Cloud Security Controls',
                'question' => 'What is the primary purpose of cloud security frameworks like CSA CCM or NIST?',
                'options' => [
                    'Providing standardized security controls and guidance for cloud environments',
                    'Replacing the need for cloud security policies',
                    'Guaranteeing cloud security compliance',
                    'Eliminating cloud security risks'
                ],
                'correct_options' => ['Providing standardized security controls and guidance for cloud environments'],
                'justifications' => [
                    'Correct - Providing standardized security controls and guidance for cloud environments',
                    'Incorrect - Replacing the need for cloud security policies',
                    'Incorrect - Guaranteeing cloud security compliance',
                    'Incorrect - Eliminating cloud security risks'
                ],
                'bloom_level' => 1,
                'difficulty_level' => 1,
                'type_id' => 1,
                'status' => 'published'
                'irt_a' => 0.8,
                'irt_b' => -1.4,
                'irt_c' => 0.25
            ],
            
            // Item 42 - L3 - Apply
            [
                'subtopic' => 'Cloud Security Controls',
                'question' => 'How should an organization use SOC 2 Type II reports when evaluating cloud service providers for sensitive data processing?',
                'options' => [
                    'Accept the report as sufficient evidence without additional verification',
                    'Review the report scope, exceptions, and conduct supplementary due diligence',
                    'Only consider the overall opinion without examining detailed findings',
                    'Focus solely on the compliance status and ignore operational details'
                ],
                'correct_options' => ['Review the report scope, exceptions, and conduct supplementary due diligence'],
                'justifications' => [
                    'Incorrect - SOC 2 reports should be part of broader evaluation, not sole evidence',
                    'Correct - Thorough review of scope, exceptions, and additional verification ensures comprehensive assessment',
                    'Incorrect - Detailed findings provide crucial context for risk assessment',
                    'Incorrect - Operational details are essential for understanding actual security posture'
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'type_id' => 1,
                'status' => 'published'
                'irt_a' => 1.4,
                'irt_b' => 0.4,
                'irt_c' => 0.25
            ],
            
            // Item 43 - L2 - Understand
            [
                'subtopic' => 'Cloud Security Controls',
                'question' => 'How does data residency affect cloud compliance strategies?',
                'options' => [
                    'Data residency has no impact on compliance',
                    'Data location requirements may restrict cloud provider and region selection',
                    'All cloud providers store data in the same locations',
                    'Data residency only affects performance, not compliance'
                ],
                'correct_options' => ['Data location requirements may restrict cloud provider and region selection'],
                'justifications' => [
                    'Incorrect - Data residency has no impact on compliance',
                    'Correct - Data location requirements may restrict cloud provider and region selection',
                    'Incorrect - All cloud providers store data in the same locations',
                    'Incorrect - Data residency only affects performance, not compliance'
                ],
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'type_id' => 1,
                'status' => 'published'
                'irt_a' => 1.2,
                'irt_b' => -0.3,
                'irt_c' => 0.25
            ],
            
            // Item 44 - L2 - Understand
            [
                'subtopic' => 'Cloud Security Controls',
                'question' => 'Why is continuous compliance monitoring important in cloud environments?',
                'options' => [
                    'Cloud environments never change once deployed',
                     'Dynamic cloud environments require ongoing validation of security controls',
                    'Compliance monitoring is only needed during audits',
                    'Cloud providers guarantee continuous compliance'
                ],
                'correct_options' => ['Dynamic cloud environments require ongoing validation of security controls'],
                'justifications' => [
                    'Incorrect - Cloud environments never change once deployed',
                    'Correct - Dynamic cloud environments require ongoing validation of security controls',
                    'Incorrect - Compliance monitoring is only needed during audits',
                    'Incorrect - Cloud providers guarantee continuous compliance'
                ],
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'type_id' => 1,
                'status' => 'published'
                'irt_a' => 1.3,
                'irt_b' => -0.1,
                'irt_c' => 0.25
            ],
            
            // Item 45 - L3 - Apply
            [
                'subtopic' => 'Cloud Security Controls',
                'question' => 'A financial services company needs to demonstrate PCI DSS compliance for their cloud-based payment processing. What approach should they take?',
                'options' => [
                    'Assume cloud provider compliance covers all requirements',
                    'Implement comprehensive controls covering both infrastructure and application layers',
                    'Only focus on network security controls',
                    'Disable security monitoring to avoid compliance complexity'
                ],
                'correct_options' => ['Implement comprehensive controls covering both infrastructure and application layers'],
                'justifications' => [
                    'Incorrect - Assume cloud provider compliance covers all requirements',
                    'Correct - Implement comprehensive controls covering both infrastructure and application layers',
                    'Incorrect - Only focus on network security controls',
                    'Incorrect - Disable security monitoring to avoid compliance complexity'
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'type_id' => 1,
                'status' => 'published'
                'irt_a' => 1.4,
                'irt_b' => 0.3,
                'irt_c' => 0.25
            ],
            
            // Item 46 - L3 - Apply
            [
                'subtopic' => 'Cloud Security Controls',
                'question' => 'How should an organization implement cloud governance across multiple business units and cloud providers?',
                'options' => [
                    'Let each business unit manage cloud governance independently',
                    'Establish centralized policies with automated enforcement and monitoring',
                    'Only implement governance for public cloud services',
                    'Avoid governance to maintain development velocity'
                ],
                'correct_options' => ['Establish centralized policies with automated enforcement and monitoring'],
                'justifications' => [
                    'Incorrect - Let each business unit manage cloud governance independently',
                    'Correct - Establish centralized policies with automated enforcement and monitoring',
                    'Incorrect - Only implement governance for public cloud services',
                    'Incorrect - Avoid governance to maintain development velocity'
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'type_id' => 1,
                'status' => 'published'
                'irt_a' => 1.5,
                'irt_b' => 0.4,
                'irt_c' => 0.25
            ],
            
            // Item 47 - L3 - Apply
            [
                'subtopic' => 'Cloud Security Controls',
                'question' => 'What is the most effective approach for managing cloud vendor risk assessment?',
                'options' => [
                    'Accept all vendor-provided security certifications without review',
                    'Conduct comprehensive risk assessments including security controls and business continuity',
                    'Only assess vendors during initial selection',
                    'Focus solely on cost and performance metrics'
                ],
                'correct_options' => ['Conduct comprehensive risk assessments including security controls and business continuity'],
                'justifications' => [
                    'Incorrect - Accept all vendor-provided security certifications without review',
                    'Correct - Conduct comprehensive risk assessments including security controls and business continuity',
                    'Incorrect - Only assess vendors during initial selection',
                    'Incorrect - Focus solely on cost and performance metrics'
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'type_id' => 1,
                'status' => 'published'
                'irt_a' => 1.6,
                'irt_b' => 0.6,
                'irt_c' => 0.25
            ],
            
            // Item 48 - L4 - Analyze
            [
                'subtopic' => 'Cloud Security Controls',
                'question' => 'Analyze the challenges of maintaining compliance across hybrid cloud environments with different regulatory requirements.',
                'options' => [
                    'Hybrid cloud environments simplify compliance management',
                    'Different platforms and jurisdictions create complexity requiring unified governance frameworks',
                    'Compliance is not relevant in hybrid cloud environments',
                    'Each platform can be managed independently without coordination'
                ],
                'correct_options' => ['Different platforms and jurisdictions create complexity requiring unified governance frameworks'],
                'justifications' => [
                    'Incorrect - Hybrid cloud environments simplify compliance management',
                    'Correct - Different platforms and jurisdictions create complexity requiring unified governance frameworks',
                    'Incorrect - Compliance is not relevant in hybrid cloud environments',
                    'Incorrect - Each platform can be managed independently without coordination'
                ],
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'type_id' => 1,
                'status' => 'published'
                'irt_a' => 1.7,
                'irt_b' => 0.8,
                'irt_c' => 0.20
            ],
            
            // Item 49 - L4 - Analyze
            [
                'subtopic' => 'Cloud Security Controls',
                'question' => 'What is the fundamental challenge in demonstrating data lineage and audit trails in complex multi-cloud architectures?',
                'options' => [
                    'Audit trails are not required in cloud environments',
                    'Data flows across multiple systems and providers complicate comprehensive tracking',
                    'Cloud providers automatically provide complete audit trails',
                    'Data lineage is only relevant for on-premises systems'
                ],
                'correct_options' => ['Data flows across multiple systems and providers complicate comprehensive tracking'],
                'justifications' => [
                    'Incorrect - Audit trails are not required in cloud environments',
                    'Correct - Data flows across multiple systems and providers complicate comprehensive tracking',
                    'Incorrect - Cloud providers automatically provide complete audit trails',
                    'Incorrect - Data lineage is only relevant for on-premises systems'
                ],
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'type_id' => 1,
                'status' => 'published'
                'irt_a' => 1.8,
                'irt_b' => 1.0,
                'irt_c' => 0.20
            ],
            
            // Item 50 - L5 - Evaluate
            [
                'subtopic' => 'Cloud Security Controls',
                'question' => 'A company adopts a "compliance as code" approach where regulatory requirements are automated into cloud deployment pipelines. Evaluate this strategy.',
                'options' => [
                    'Compliance as code eliminates all regulatory risks',
                    'Can improve consistency and speed but requires careful validation and exception handling',
                    'Automated compliance is inappropriate for regulated industries',
                    'Compliance as code replaces the need for compliance teams'
                ],
                'correct_options' => ['Can improve consistency and speed but requires careful validation and exception handling'],
                'justifications' => [
                    'Incorrect - Compliance as code eliminates all regulatory risks',
                    'Correct - Can improve consistency and speed but requires careful validation and exception handling',
                    'Incorrect - Automated compliance is inappropriate for regulated industries',
                    'Incorrect - Compliance as code replaces the need for compliance teams'
                ],
                'bloom_level' => 5,
                'difficulty_level' => 5,
                'type_id' => 1,
                'status' => 'published'
                'irt_a' => 1.9,
                'irt_b' => 1.5,
                'irt_c' => 0.15
            ]
        ];
    }
}