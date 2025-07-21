<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class DiagnosticsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $domains = [
            [
                'name' => 'General Security Concepts',
                'code' => 'GSC',
                'priority_order' => 1,
                'category' => 'foundational',
                'weight_percentage' => 12,
                'color' => '#3B82F6', // Blue
                'icon' => 'shield-check',
                'description' => 'Fundamental security principles that form the foundation of all cybersecurity practices. Covers the CIA Triad, security controls, and core concepts essential for understanding more advanced topics.',
                'learning_objectives' => 'Understand and apply fundamental security principles including confidentiality, integrity, and availability. Identify different types of security controls and their applications.',
                'topics' => [
                    '5 Pillars of Information Security', // Confidentiality, integrity, availability, authenticity, nonrepudiation
                    'Professional Ethics', // Organizational code of ethics
                    'Security Controls', // Administrative, Technical, Physical, Deterrent, Preventative, Detective, Corrective, Compensating
                    'Security Principles', // Least Privilege, Need-to-Know, Separation of Duties, Dual Control, Split Knowledge
                    'Cybersecurity Frameworks', // NIST CSF, ISO/IEC 27001, COBIT, CIS Controls
                ],
            ],
            [
                'name' => 'Information Security Governance',
                'code' => 'ISG',
                'priority_order' => 2,
                'category' => 'foundational',
                'weight_percentage' => 10,
                'color' => '#10B981', // Green
                'icon' => 'office-building',
                'description' => 'Organizational frameworks and policies that establish security management structure. Essential for aligning security with business objectives and ensuring proper oversight.',
                'learning_objectives' => 'Understand governance frameworks, security roles and responsibilities, and how to establish effective security policies and procedures.',
                'topics' => [
                    'Security Roles & Responsibilities', // Board, CISO, Data Owner, Custodian
                    'Policy, Standard, Procedure, Guideline', // Policy hierarchy
                    'Security Frameworks', // NIST CSF, COBIT, ISO 27001
                    'IT Governance vs IT Management', // Strategic vs operational focus
                    'Three Lines of Defense', // Operational, Risk/Compliance, Audit
                    'Key Performance / Risk / Control Indicators (KPI/KRI/KCI)', // Security metrics and thresholds
                    'Due Care & Due Diligence', // Legal expectations and proactive behavior
                    'Security Culture & Tone at the Top', // Leadership-driven security values
                ],
            ],
            [
                'name' => 'Legal, Regulatory & Compliance',
                'code' => 'LRC',
                'priority_order' => 3,
                'category' => 'managerial',
                'weight_percentage' => 8,
                'color' => '#8B5CF6', // Purple
                'icon' => 'scale',
                'description' => 'Legal frameworks, regulations, and compliance requirements that organizations must follow. Critical for avoiding legal liabilities and maintaining regulatory compliance.',
                'learning_objectives' => 'Identify key regulations and compliance requirements. Understand legal implications of security decisions and contractual obligations.',
                'topics' => [
                    'Compliance Requirements', // Regulatory, contractual, internal
                    'General Data Protection Regulation (GDPR)', // Privacy law
                    'Health Insurance Portability & Accountability Act (HIPAA)', // Health data protection
                    'Payment Card Industry Data Security Standard (PCI DSS)', // Payment security
                    'Criminal Law & Civil Law', // Legal systems and remedies
                    'Contractual Obligations & Liability Clauses', // Legal risk from agreements
                    'Intellectual Property', // Copyright, Trademark, Patent, Trade Secret
                ],
            ],
            [
                'name' => 'Privacy',
                'code' => 'PRV',
                'priority_order' => 4,
                'category' => 'managerial',
                'weight_percentage' => 7,
                'color' => '#EC4899', // Pink
                'icon' => 'eye-off',
                'description' => 'Privacy principles and data protection requirements. Focuses on protecting personal information and ensuring compliance with privacy regulations like GDPR.',
                'learning_objectives' => 'Apply privacy principles to protect personal data. Understand data subject rights and implement privacy by design.',
                'topics' => [
                    'Personally Identifiable Information (PII)', // Data subject identity
                    'Electronic Protected Health Information (ePHI)', // Sensitive health data
                    'Collection Limitation', // Minimal and lawful data gathering
                    'Purpose Limitation', // Use only for declared purposes
                    'Data Minimisation', // Limit data to what is necessary
                    'Storage Limitation', // Retention period enforcement
                    'Security Safeguards', // Protect privacy data from breaches
                    'Data Subject Rights & Data Portability', // GDPR rights (access, rectification, portability)
                    'Privacy by Design & by Default', // Embed privacy in development
                    'Data Sovereignty & Cross-Border Transfer (SCC, BCR, DPF)', // Jurisdiction compliance
                    'Roles: Data Controller & Data Processor', // GDPR-defined roles
                    'Privacy Impact Assessment (PIA) / DPIA', // Risk assessment for privacy impacts
                ],
            ],
            [
                'name' => 'Risk Management',
                'code' => 'RSK',
                'priority_order' => 5,
                'category' => 'foundational',
                'weight_percentage' => 15,
                'color' => '#F59E0B', // Amber
                'icon' => 'chart-bar',
                'description' => 'Comprehensive risk management processes from identification to monitoring. Core competency for security professionals to assess and manage organizational risks.',
                'learning_objectives' => 'Perform risk assessments, implement risk treatment strategies, and maintain risk registers. Understand quantitative and qualitative risk analysis.',
                'topics' => [
                    'IT Risk Management Lifecycle', // Identify → Assess → Treat → Monitor
                    'Risk Identification', // Threats, vulnerabilities, asset value
                    'Risk Assessment', // Qualitative, Quantitative
                    'Risk Response & Treatment', // Avoid, Accept, Transfer, Mitigate
                    'Risk Monitoring & Reporting', // Track effectiveness of controls
                    'Risk Appetite, Tolerance & Capacity', // Risk strategy thresholds
                    'Risk/Control Owner', // Responsibility assignment
                    'Risk Register', // Central record of risks and treatment plans
                    'Inherent & Residual Risk', // Before and after controls
                    'Third-Party & Supply-Chain Risk', // Vendor exposure management
                    'Risk Management Frameworks', // NIST RMF, ISO 31000
                ],
            ],
            [
                'name' => 'Security Audits & Assessments',
                'code' => 'SAA',
                'priority_order' => 6,
                'category' => 'managerial',
                'weight_percentage' => 6,
                'color' => '#6366F1', // Indigo
                'icon' => 'clipboard-check',
                'description' => 'Audit methodologies and assessment techniques to evaluate security effectiveness. Essential for maintaining compliance and identifying security gaps.',
                'learning_objectives' => 'Conduct security audits and assessments. Understand different audit types and testing methodologies.',
                'topics' => [
                    'Audit Life-Cycle Phases', // Planning, Fieldwork, Reporting, Follow-up
                    'Security Audits (Internal, External)', // Independent vs in-house
                    'Compliance vs Substantive Testing', // Nature of evidence
                    'Evidence-Gathering Techniques', // Interview, Observation, Re-performance, CAAT
                    'Sampling Methods & Sampling Risk', // Attribute, Stop-or-Go, Discovery
                    'Gap Analysis', // Identify control weaknesses
                    'Control Design & Operating-Effectiveness Testing', // Process assurance
                    'Continuous Control Monitoring (CCM)', // Ongoing assurance with automation
                    'Vulnerability Assessment & Management', // Weakness discovery
                    'Penetration Testing & Red/Purple Teaming', // Simulated attacks
                    'Service Organization Control (SOC) Reports', // SOC 1/2/3 assurance
                    'ISO 27001 Certification Audits', // ISO compliance verification
                ],
            ],
            [
                'name' => 'Threat & Vulnerability Management',
                'code' => 'TVM',
                'priority_order' => 7,
                'category' => 'technical',
                'weight_percentage' => 8,
                'color' => '#EF4444', // Red
                'icon' => 'exclamation-triangle',
                'description' => 'Identification and management of threats and vulnerabilities. Covers threat actors, attack vectors, and vulnerability lifecycle management.',
                'learning_objectives' => 'Identify threats and vulnerabilities. Implement vulnerability management processes and understand threat intelligence.',
                'topics' => [
                    'Threats & Threat Actors', // Nation-state, hacktivist, insider
                    'Threat Vectors', // Email, web, supply chain
                    'Attack Surface & Enumeration', // Exposure identification
                    'Malware Families', // Virus, Worm, Ransomware, Rootkit
                    'MITRE ATT&CK Framework', // TTP classification
                    'Cyber Kill Chain', // Recon → Weaponize → Exploit ...
                    'Threat Indicators', // IOA, IOC, Precursors
                    'Vulnerability Management Lifecycle', // Discovery to remediation
                    'Common Vulnerabilities & Exposures (CVE)', // Known flaws
                    'Common Vulnerability Scoring System (CVSS)', // Severity scale
                    'Common Weakness Enumeration (CWE)', // Underlying software flaws
                    'National Vulnerability Database (NVD)', // US-CERT repository
                    'Zero-Day Vulnerabilities', // Unpatched and unknown
                    'End-of-Life / End-of-Support (EOL/EOS)', // Unsupported tech risk
                    'System & Application Hardening', // Secure configurations
                ],
            ],
            [
                'name' => 'Cryptography & Key Management',
                'code' => 'CKM',
                'priority_order' => 8,
                'category' => 'technical',
                'weight_percentage' => 5,
                'color' => '#14B8A6', // Teal
                'icon' => 'key',
                'description' => 'Cryptographic principles and key management practices. Essential for protecting data confidentiality and integrity.',
                'learning_objectives' => 'Apply cryptographic concepts and implement secure key management. Understand encryption algorithms and PKI.',
                'topics' => [
                    'Symmetric & Asymmetric Encryption', // AES, RSA
                    'Hashing', // SHA-256, MD5
                    'Digital Signatures', // Integrity and authenticity
                    'Public Key Infrastructure (PKI)', // Certificate-based trust
                    'Key Management Lifecycle', // Generation to destruction
                    'Hardware Security Module (HSM)', // Secure key storage
                    'Trusted Platform Module (TPM) & Secure Enclave', // Device-based crypto
                    'Cryptographic Attacks', // Collision, Replay, Downgrade, Side-channel
                    'Quantum-Resistant Cryptography (PQC)', // Post-quantum crypto algorithms
                ],
            ],
            [
                'name' => 'Data Governance',
                'code' => 'DGV',
                'priority_order' => 9,
                'category' => 'managerial',
                'weight_percentage' => 4,
                'color' => '#0EA5E9', // Sky
                'icon' => 'database',
                'description' => 'Data lifecycle management and governance practices. Covers classification, retention, and protection of organizational data.',
                'learning_objectives' => 'Implement data classification schemes and manage data throughout its lifecycle. Apply data protection techniques.',
                'topics' => [
                    'Data Classification & Categorisation', // Public, Internal, Confidential
                    'Data Owner / Custodian / Steward', // Roles and responsibilities
                    'Data Retention', // Legal, regulatory, business policy
                    'Data Sanitisation & Destruction', // Clearing, purging, destruction
                    'Anonymisation & Pseudonymisation / Tokenisation', // Data masking techniques
                    'Data Loss Prevention (DLP)', // Prevent exfiltration of data
                    'Information Rights Management (IRM)', // Access enforcement on shared data
                ],
            ],
            [
                'name' => 'Access Control',
                'code' => 'IAM',
                'priority_order' => 10,
                'category' => 'foundational',
                'weight_percentage' => 13,
                'color' => '#84CC16', // Lime
                'icon' => 'lock-closed',
                'description' => 'Identity and access management principles. Critical for ensuring only authorized users access resources.',
                'learning_objectives' => 'Implement authentication and authorization controls. Design access control systems using various models.',
                'topics' => [
                    'Authentication & MFA', // Passwords, biometrics, OTP
                    'Authorization & Least-Privilege Policy', // Access enforcement
                    'Accounting / Auditing', // Logging and monitoring
                    'Single Sign-On (SSO) & Kerberos', // Federated credentials
                    'Federation & Identity Protocols', // SAML, OAuth, OpenID Connect
                    'Password Policy & Hygiene', // Length, complexity, rotation
                    'Password Attacks & Salting / Peppering', // Brute force, dictionary, rainbow tables
                    'Access-Control Models', // DAC, MAC, RBAC, ABAC, RuleBAC
                    'Privileged Access Management (PAM)', // Admin access security
                    'Just-in-Time (JIT) / Just-Enough-Access', // Temporary elevated privileges
                    'Identity Provisioning & De-provisioning', // Onboarding and offboarding
                ],
            ],
            [
                'name' => 'Network Concepts',
                'code' => 'NET',
                'priority_order' => 11,
                'category' => 'technical',
                'weight_percentage' => 6,
                'color' => '#06B6D4', // Cyan
                'icon' => 'globe',
                'description' => 'Fundamental networking concepts and protocols. Essential foundation for understanding network security.',
                'learning_objectives' => 'Understand network protocols, architectures, and communication models.',
                'topics' => [
                    'Network Standards (IEEE 802)', // LAN/Wi-Fi protocols
                    'OSI & TCP/IP Models', // Layered communication models
                    'Common Ports & Protocols', // HTTP, FTP, SSH, DNS
                    'Network Architecture', // LAN, WAN, topology
                    'Routing & Switching', // Basic networking concepts
                ],
            ],
            [
                'name' => 'Network Security',
                'code' => 'NETS',
                'priority_order' => 12,
                'category' => 'technical',
                'weight_percentage' => 7,
                'color' => '#0891B2', // Cyan-600
                'icon' => 'shield',
                'description' => 'Network security fundamentals including defense mechanisms and attack vectors. Essential for protecting data in transit.',
                'learning_objectives' => 'Design secure network architectures and implement network security controls. Understand network attacks and defenses.',
                'topics' => [
                    'DNS Security', // DNSSEC, zone transfer, poisoning
                    'Firewall & Proxy Types', // NGFW, WAF, UTM
                    'Network Segmentation', // VLAN, DMZ, air-gap
                    'Virtual Private Network (VPN)', // IPsec, SSL VPN
                    'Wi-Fi Security', // WPA2, WPA3
                    'Network Attacks', // DDoS, sniffing, spoofing
                    'Network Scanning & Recon Tools', // nmap, dig, traceroute
                ],
            ],
            [
                'name' => 'Application Security',
                'code' => 'APP',
                'priority_order' => 13,
                'category' => 'technical',
                'weight_percentage' => 11,
                'color' => '#7C3AED', // Violet
                'icon' => 'code',
                'description' => 'Secure software development practices and application security. Integrates security throughout the development lifecycle.',
                'learning_objectives' => 'Implement secure coding practices and integrate security into CI/CD pipelines. Identify and mitigate application vulnerabilities.',
                'topics' => [
                    'Secure Software Development Lifecycle (SSDLC)', // SDLC Security Integration, Gates, Threat Modeling, Requirements
                    'Development Models', // Waterfall, Agile, CI/CD, DevSecOps practices
                    'Application Vulnerabilities', // SQLi, XSS, CSRF, Buffer Overflow, SSRF, Path Traversal
                    'Security Testing', // Functional, QA, Security testing methods
                    'Secure Coding', // Input validation, output encoding, session management
                ],
            ],
            [
                'name' => 'Cloud Security',
                'code' => 'CLD',
                'priority_order' => 14,
                'category' => 'technical',
                'weight_percentage' => 6,
                'color' => '#2563EB', // Blue-600
                'icon' => 'cloud',
                'description' => 'Cloud computing security across different service and deployment models. Understanding shared responsibility is crucial.',
                'learning_objectives' => 'Apply cloud security principles across IaaS, PaaS, and SaaS. Implement cloud-native security controls.',
                'topics' => [
                    'Cloud Service Models', // SaaS, PaaS, IaaS
                    'Cloud Deployment Models', // Public, Private, Hybrid
                    'Shared Responsibility Model', // CSP vs Customer duties
                    'Virtual Private Cloud (VPC)', // Isolated cloud networks
                    'Cloud Access Security Broker (CASB)', // Visibility/control
                    'Secure Access Service Edge (SASE)', // Edge-based enforcement
                    'Virtualisation & Hypervisor Security', // Type 1, Type 2
                    'Container & Serverless Security', // Isolation, image control
                    'Key Management Service (KMS) vs Cloud HSM', // Cloud crypto options
                    'Cloud Security Frameworks', // CSA CCM, ISO 27017
                ],
            ],
            [
                'name' => 'Endpoint, Mobile & IoT Security',
                'code' => 'EPT',
                'priority_order' => 15,
                'category' => 'technical',
                'weight_percentage' => 5,
                'color' => '#DC2626', // Red-600
                'icon' => 'device-mobile',
                'description' => 'Security for endpoints including desktops, mobile devices, and IoT. Critical as attack surfaces expand.',
                'learning_objectives' => 'Secure various endpoint types and implement mobile device management. Address IoT security challenges.',
                'topics' => [
                    'Endpoint Security', // EPP, EDR, whitelisting, baselines, configuration
                    'Device Security', // Encryption, secure boot, TPM, firmware integrity
                    'Mobile Security', // MDM, EMM, BYOD, COPE strategies, mobile threats
                    'IoT Security', // IoT devices, embedded systems, constrained environments, OT/ICS
                ],
            ],
            [
                'name' => 'Security Architecture & Design',
                'code' => 'SAD',
                'priority_order' => 16,
                'category' => 'technical',
                'weight_percentage' => 13,
                'color' => '#059669', // Emerald-600
                'icon' => 'template',
                'description' => 'Security design principles and architecture frameworks. Foundation for building secure systems from the ground up.',
                'learning_objectives' => 'Apply security design principles and create secure architectures. Understand security models and frameworks.',
                'topics' => [
                    'Security by Design', // Embedded security from planning
                    'Secure Defaults', // Least privilege by default
                    'Least Privilege & Need to Know', // Access restriction principles
                    'Separation of Duties (SoD)', // Multi-person control
                    'Defense in Depth', // Layered security
                    'Zero Trust', // Trust no device/user by default
                    'Threat Modeling', // STRIDE, PASTA
                    'Economy of Mechanism', // Design simplicity
                    'Fail Secure', // Secure failure state
                    'Complete Mediation', // Revalidate every access
                    'Security Through Obscurity', // Weak if sole control
                    'Security Models', // Bell-LaPadula, Biba, Clark-Wilson
                    'Trusted Computing Base (TCB) & Protection Rings', // Kernel vs user mode
                    'Common Criteria & Evaluation Assurance Levels (EAL)', // Product trust levels
                    'Security Architecture Frameworks', // SABSA, TOGAF
                ],
            ],
            [
                'name' => 'Security Awareness & Human Factors',
                'code' => 'SAH',
                'priority_order' => 17,
                'category' => 'managerial',
                'weight_percentage' => 4,
                'color' => '#F97316', // Orange-500
                'icon' => 'users',
                'description' => 'Human aspects of security including awareness training and social engineering defense. People are often the weakest link.',
                'learning_objectives' => 'Design security awareness programs and mitigate human-factor risks. Implement policies for secure behavior.',
                'topics' => [
                    'Social Engineering', // Phishing, vishing, tailgating
                    'Insider Threats', // Negligent or malicious insiders
                    'Security Awareness & Training Lifecycle', // Plan → Deliver → Reinforce → Measure
                    'Phishing Simulation Metrics & Gamification', // Learning reinforcement
                    'Behavioral Analytics & User Risk Scoring', // Detect unsafe behavior
                    'Acceptable Use Policy (AUP)', // Rules for systems usage
                    'Bring Your Own Device (BYOD) Policy', // Personal device security guidelines
                    'Clear Desk / Clear Screen Policy', // Prevent visual data leakage
                    'Non-Disclosure Agreement (NDA)', // Legal confidentiality
                    'Candidate Screening & Background Checks', // Pre-employment risk vetting
                    'On-Boarding & Security Briefings', // Initial training
                    'Job Rotation & Mandatory Vacation', // Fraud detection mechanism
                    'Termination / Exit Process', // Timely revocation of access
                ],
            ],
            [
                'name' => 'Physical & Environmental Security',
                'code' => 'PHY',
                'priority_order' => 18,
                'category' => 'managerial',
                'weight_percentage' => 3,
                'color' => '#64748B', // Slate-500
                'icon' => 'office-building',
                'description' => 'Physical security controls and environmental protection. Often overlooked but critical for comprehensive security.',
                'learning_objectives' => 'Design physical security controls and implement environmental safeguards. Understand facility security requirements.',
                'topics' => [
                    'Human Safety & Emergency Procedures', // Evacuation, first aid, drills
                    'Crime Prevention Through Environmental Design (CPTED)', // Natural surveillance, territoriality
                    'Site Selection & Security Considerations', // Location risk analysis
                    'Perimeter Security Controls', // Fences, gates, barriers
                    'Facility Layout & Security Zones', // Reception, restricted areas
                    'Physical Access Control Systems (PACS)', // Smart cards, biometrics
                    'Tailgating and Piggybacking Prevention', // Turnstiles, mantraps
                    'Security Guards & Visitor Management', // Screening and escorting
                    'Surveillance Systems (CCTV)', // Deterrence, monitoring
                    'Lighting & Deterrence Principles', // Illumination for visibility
                    'Environmental Controls', // HVAC, temperature, humidity
                    'Fire Prevention, Detection & Suppression', // Alarms, extinguishers, sprinklers
                    'Power Management & Redundancy', // UPS, generators
                ],
            ],
            [
                'name' => 'Security Operations & Monitoring',
                'code' => 'OPS',
                'priority_order' => 19,
                'category' => 'technical',
                'weight_percentage' => 13,
                'color' => '#0891B2', // Cyan-600
                'icon' => 'desktop-computer',
                'description' => 'Day-to-day security operations including monitoring, detection, and response. The front line of security defense.',
                'learning_objectives' => 'Implement security monitoring and manage security operations centers. Use SIEM and other operational tools effectively.',
                'topics' => [
                    'Security Operations Center (SOC)', // Centralized monitoring
                    'Operational Metrics', // MTTD, MTTR
                    'Log & Event Management', // Collection, retention, analysis
                    'Patch & Configuration Management', // Vulnerability remediation
                    'Change Management', // Risk-aware change implementation
                    'Intrusion Detection & Prevention (IDS/IPS)', // Network and host-based
                    'Security Alerts & Tuning', // False positive/negative reduction
                    'Security Information & Event Management (SIEM)', // Log aggregation & analysis
                    'User & Entity Behavior Analytics (UEBA)', // Anomaly detection
                    'Security Orchestration, Automation & Response (SOAR)', // Workflow automation
                    'Continuous Monitoring & Threat Hunting', // Proactive detection
                ],
            ],
            [
                'name' => 'Incident Management & Forensics',
                'code' => 'INC',
                'priority_order' => 20,
                'category' => 'managerial',
                'weight_percentage' => 5,
                'color' => '#BE123C', // Rose-700
                'icon' => 'search-circle',
                'description' => 'Incident response procedures and digital forensics. Critical for minimizing damage and learning from security events.',
                'learning_objectives' => 'Execute incident response plans and conduct forensic investigations. Preserve evidence and perform root cause analysis.',
                'topics' => [
                    'Incident Response Phases', // Prep → Detect → Analyze → Contain → Eradicate → Recover → Lessons
                    'Playbooks & Runbooks', // Standardized response procedures
                    'Reporting & Communication (Breach Notice)', // Stakeholder & regulator notification
                    'Forensic Investigation', // Evidence gathering
                    'Evidence Handling & Chain of Custody', // Integrity & admissibility
                    'Root-Cause & Post-Incident Analysis', // Lessons learned
                    'Digital Forensics Tools & Order of Volatility', // Tool usage and memory-first rule
                ],
            ],
            [
                'name' => 'Business Continuity & Disaster Recovery',
                'code' => 'BCP',
                'priority_order' => 21,
                'category' => 'managerial',
                'weight_percentage' => 4,
                'color' => '#0F766E', // Teal-700
                'icon' => 'refresh',
                'description' => 'Ensuring business resilience through continuity planning and disaster recovery. Essential for organizational survival.',
                'learning_objectives' => 'Develop business continuity and disaster recovery plans. Conduct BIA and establish recovery objectives.',
                'topics' => [
                    'Business Impact Analysis (BIA)', // Determine critical assets/functions
                    'Maximum Tolerable Downtime (MTD)', // Max duration business can survive outage
                    'Recovery Time & Recovery Point Objectives (RTO/RPO)', // Timeliness and data loss tolerance
                    'Business Continuity Plan (BCP)', // Continuity framework
                    'Disaster Recovery Plan (DRP)', // IT recovery playbook
                    'BCP/DRP Testing Methods', // Table-top, Parallel, Full-interruption
                    'Alternate Sites', // Hot, Warm, Cold
                    'Backup Strategies', // 3-2-1 rule, online/offsite retention
                ],
            ],
        ];

        foreach ($domains as $domain) {
            $domainId = DB::table('diagnostic_domains')->insertGetId([
                'name' => $domain['name'],
                'code' => $domain['code'],
                'description' => $domain['description'],
                'priority_order' => $domain['priority_order'],
                'category' => $domain['category'],
                'weight_percentage' => $domain['weight_percentage'],
                'color' => $domain['color'],
                'icon' => $domain['icon'],
                'learning_objectives' => $domain['learning_objectives'],
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            foreach ($domain['topics'] as $topic) {
                DB::table('diagnostic_topics')->insert([
                    'domain_id' => $domainId,
                    'name' => $topic,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
