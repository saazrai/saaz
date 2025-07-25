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
                'color' => '#3B82F6', // Blue
                'icon' => 'shield-check',
                'description' => 'Fundamental security principles that form the foundation of all cybersecurity practices. Covers the CIA Triad, security controls, and core concepts essential for understanding more advanced topics.',
                'learning_objectives' => 'Understand and apply fundamental security principles including confidentiality, integrity, and availability. Identify different types of security controls and their applications.',
                'topics' => [
                    '5 Pillars of Information Security', // Confidentiality, Integrity, Availability, Authenticity, Non-repudiation
                    'Professional Ethics', // Organizational Code of Ethics, Professional Standards and Conduct
                    'Security Controls', // Control Categories, Control Functions
                    'Security Principles', // Access Control Principles, Design Principles
                    'Cybersecurity Frameworks', // Risk Management Frameworks, Governance Frameworks, Control Frameworks
                ],
            ],
            [
                'name' => 'Information Security Governance',
                'code' => 'ISG',
                'priority_order' => 2,
                'category' => 'foundational',
                'color' => '#10B981', // Green
                'icon' => 'office-building',
                'description' => 'Organizational frameworks and policies that establish security management structure. Essential for aligning security with business objectives and ensuring proper oversight.',
                'learning_objectives' => 'Understand governance frameworks, security roles and responsibilities, and how to establish effective security policies and procedures.',
                'topics' => [
                    'Information Security Program', // Security program establishment and charter, Program governance structure and oversight, Gap analysis and current state assessment, Maturity models and maturity assessment, Program improvement planning and roadmaps, Program effectiveness measurement and reporting
                    'Strategic Alignment', // Aligning InfoSec with business goals and objectives, Security strategy development and implementation, Business case development for security investments, Strategic planning and roadmap development, Business-security integration and collaboration
                    'Leadership & Accountability', // Board of Directors and senior management accountability, C-suite security responsibilities (CEO, CFO, CRO), Steering committees and governance bodies, CISO role, responsibilities, and reporting structure, RACI Matrix and accountability frameworks, Tone at the top and security culture leadership
                    'Security Policy Framework', // Policy hierarchy (Policy → Standard → Procedure → Guideline), Policy types and classification (mandatory vs advisory), Documentation standards and requirements, Policy templates and standardization, Regulatory and compliance mapping
                    'Policy Governance and Management', // Policy lifecycle management (development, approval, review), Policy approval workflows and authority levels, Policy governance and compliance monitoring, Policy enforcement and exception management, Policy effectiveness measurement and metrics, Policy communication and awareness programs
                ],
            ],
            [
                'name' => 'Legal, Regulatory & Compliance',
                'code' => 'LRC',
                'priority_order' => 3,
                'category' => 'managerial',
                'color' => '#8B5CF6', // Purple
                'icon' => 'scale',
                'description' => 'Legal frameworks, regulations, and compliance requirements that organizations must follow. Critical for avoiding legal liabilities and maintaining regulatory compliance.',
                'learning_objectives' => 'Identify key regulations and compliance requirements. Understand legal implications of security decisions and contractual obligations.',
                'topics' => [
                    'Compliance Requirements', // Framework and process for meeting obligation, Cross-border/jurisdictional considerations, Data localization and residency requirements, Digital sovereignty and data embassy concepts, Compliance program establishment, Legal vs regulatory vs contractual requirements hierarchy
                    'Contracts', // Vendor Security Requirements, Service Level Agreements (SLAs), Liability & Indemnification, Data Processing Agreements (DPAs), Breach Notification Clauses, Subcontracts & Fourth-party Risk, Source Code Escrow, Right to Audit Clauses, Insurance & Bonding Requirements, Termination & Data Return
                    'Industry Specific Regulations', // Specific regulatory content and requirements - HIPAA, SOX, GLBA, FERPA, FedRAMP, ITAR details, Industry-specific compliance obligations
                    'Intellectual Property', // Patent, Trademark, Copyright, Trade secret
                    'Investigation Types', // Administrative, criminal, civil, regulatory, industry standards, Evidence standards and burden of proof, penalties for violations
                ],
            ],
            [
                'name' => 'Privacy',
                'code' => 'PRV',
                'priority_order' => 4,
                'category' => 'managerial',
                'color' => '#EC4899', // Pink
                'icon' => 'eye-off',
                'description' => 'Privacy principles and data protection requirements. Focuses on protecting personal information and ensuring compliance with privacy regulations like GDPR.',
                'learning_objectives' => 'Apply privacy principles to protect personal data. Understand data subject rights and implement privacy by design.',
                'topics' => [
                    'Personal Information', // Definition of Personal Data, PII, PHI, SPI (Sensitive Personal Information), Contextual identifiers (direct vs indirect), Examples across sectors (health, financial, biometrics), Global definitions across laws (GDPR, CCPA, PIPL)
                    'Privacy Principles', // GDPR principles (lawfulness, fairness, transparency, purpose limitation, data minimization, accuracy, storage limitation, accountability), Legal bases for processing (consent, contract, legal obligation, vital interests, public task, legitimate interests)
                    'Data Subject Rights', // Right of access, rectification, erasure (right to be forgotten), Right to restrict processing, data portability, Right to object, rights related to automated decision-making, Right to withdraw consent
                    'Privacy Governance', // Data controllers vs processors responsibilities, Data Protection Officer (DPO) requirements, Privacy Impact Assessment (DPIA) / Privacy by Design, Records of processing activities
                    'Privacy Protection', // International data transfers (adequacy decisions, SCCs, BCRs), Technical safeguards (masking, anonymization, pseudonymization, encryption, tokenization)
                ],
            ],
            [
                'name' => 'Risk Management',
                'code' => 'RSK',
                'priority_order' => 5,
                'category' => 'foundational',
                'color' => '#F59E0B', // Amber
                'icon' => 'chart-bar',
                'description' => 'Comprehensive risk management processes from identification to monitoring. Core competency for security professionals to assess and manage organizational risks.',
                'learning_objectives' => 'Perform risk assessments, implement risk treatment strategies, and maintain risk registers. Understand quantitative and qualitative risk analysis.',
                'topics' => [
                    'Risk Management Fundamentals', // Risk management lifecycle (Identify → Assess → Treat → Monitor), Risk management frameworks (NIST RMF, ISO 31000, COSO ERM), Risk appetite, tolerance, and capacity definitions, Inherent risk (risk before controls), Risk governance structure and committees, Risk management program establishment
                    'Risk Identification', // Threat, Threat modeling (STRIDE), Vulnerability, Risk scenario development, Risk owner assignment
                    'Risk Assessment', // Qualitative risk assessment methods, Quantitative risk assessment techniques, Impact and likelihood determination, Risk scoring and prioritization, Risk analysis methodologies
                    'Risk Response & Treatment', // Risk response strategies (Avoid, Accept, Transfer, Mitigate), Control selection and implementation, Residual risk calculation (risk after controls), Control owner assignment, Cost-benefit analysis for controls, Risk treatment planning
                    'Risk Monitoring & Reporting', // Continuous risk monitoring processes, Key Risk Indicators (KRIs) and metrics, Risk reporting to stakeholders
                ],
            ],
            [
                'name' => 'Security Audits & Assessments',
                'code' => 'SAA',
                'priority_order' => 6,
                'category' => 'managerial',
                'color' => '#6366F1', // Indigo
                'icon' => 'clipboard-check',
                'description' => 'Audit methodologies and assessment techniques to evaluate security effectiveness. Essential for maintaining compliance and identifying security gaps.',
                'learning_objectives' => 'Conduct security audits and assessments. Understand different audit types and testing methodologies.',
                'topics' => [
                    'Audit Fundamentals', // Audit lifecycle phases (Planning → Fieldwork → Reporting → Follow-up), Audit types (Internal vs External, Compliance vs Operational), Audit planning and scoping methodologies, Risk-based audit approaches and audit universe development, Professional standards and ethics (ISACA, IIA guidelines)
                    'Evidence Gathering', // Evidence-gathering techniques (Interview, Observation, Re-performance, CAAT), Sampling methods and sampling risk (Attribute, Stop-or-Go, Discovery), Documentation standards and audit trails
                    'Control Assessment', // Control design vs operating effectiveness testing, Gap analysis and control weakness identification, Compliance vs substantive testing approaches, Control testing procedures and documentation, Remediation tracking and validation
                    'Testing Methodologies & Approaches', // Black-box testing - External perspective, no internal knowledge, White-box testing - Full internal knowledge and access, Gray-box testing - Limited internal knowledge/hybrid approach, Static vs Dynamic analysis techniques, Manual vs Automated testing approaches, Risk-based testing strategies
                    'Security Testing', // Penetration testing methodologies, Red team vs Purple team exercises, Security assessment techniques, Security code review and configuration assessment, Specialized testing (web apps, networks, wireless, mobile)
                ],
            ],
            [
                'name' => 'Threat & Vulnerability Management',
                'code' => 'TVM',
                'priority_order' => 7,
                'category' => 'technical',
                'color' => '#EF4444', // Red
                'icon' => 'exclamation-triangle',
                'description' => 'Identification and management of threats and vulnerabilities. Covers threat actors, attack vectors, and vulnerability lifecycle management.',
                'learning_objectives' => 'Identify threats and vulnerabilities. Implement vulnerability management processes and understand threat intelligence.',
                'topics' => [
                    'Threat Actors', // Items 1-10: APT, hacktivist, organized crime, nation-state, script kiddie, insider threats
                    'TTPs', // Items 11-20: Tactics, Techniques, Procedures, MITRE ATT&CK, Cyber Kill Chain, attribution
                    'Vulnerability Management', // Items 21-30: Lifecycle phases, asset inventory, scanning, remediation strategies
                    'Vulnerability Assessment', // Items 31-40: CVSS scoring, prioritization, CVE/CWE/NVD, zero-day vs N-day
                    'Malware', // Items 41-50: Family types, delivery mechanisms, behavior patterns, analysis, indicators
                ],
            ],
            [
                'name' => 'Cryptography & Key Management',
                'code' => 'CKM',
                'priority_order' => 8,
                'category' => 'technical',
                'color' => '#14B8A6', // Teal
                'icon' => 'key',
                'description' => 'Cryptographic principles and key management practices. Essential for protecting data confidentiality and integrity.',
                'learning_objectives' => 'Apply cryptographic concepts and implement secure key management. Understand encryption algorithms and PKI.',
                'topics' => [
                    'Cryptography Algorithms', // Items 1-10: Symmetric, asymmetric, hashing algorithms, selection criteria
                    'Cryptographic Applications', // Items 11-20: Digital signatures, MAC, HMAC, non-repudiation, protocols
                    'Public Key Infrastructure (PKI)', // Items 21-30: CA hierarchies, certificates, lifecycle, CRL, OCSP, trust models
                    'Key Management', // Items 31-40: Lifecycle management, HSM, TPM, storage, escrow, exchange protocols
                    'Cryptanalysis', // Items 41-50: Cryptographic attacks, vulnerabilities, quantum threats, post-quantum crypto
                ],
            ],
            [
                'name' => 'Data Governance',
                'code' => 'DGV',
                'priority_order' => 9,
                'category' => 'managerial',
                'color' => '#0EA5E9', // Sky
                'icon' => 'database',
                'description' => 'Data lifecycle management and governance practices. Covers classification, retention, and protection of organizational data.',
                'learning_objectives' => 'Implement data classification schemes and manage data throughout its lifecycle. Apply data protection techniques.',
                'topics' => [
                    'Data Classification & Categorization', // Items 1-10: Sensitivity levels, data types, regulatory categories, processes, roles
                    'Data Lifecycle Management', // Items 11-20: Create, Store, Use, Share, Archive, Destroy phases
                    'Data Retention & Archival', // Items 21-30: Retention policies, archival, long-term storage, retrieval
                    'Data Sanitization', // Items 31-40: Sanitization techniques, categories (clearing, purging, destroy)
                    'Data Security Controls', // Items 41-50: Data states, rights management, DLP, encryption
                ],
            ],
            [
                'name' => 'Identity and Access Management (IAM)',
                'code' => 'IAM',
                'priority_order' => 10,
                'category' => 'foundational',
                'color' => '#84CC16', // Lime
                'icon' => 'lock-closed',
                'description' => 'Identity and access management principles. Critical for ensuring only authorized users access resources.',
                'learning_objectives' => 'Implement authentication and authorization controls. Design access control systems using various models.',
                'topics' => [
                    'Identification', // Items 1-10: Identity establishment, proofing, verification, lifecycle management
                    'Authentication', // Items 11-20: Password fundamentals, MFA, biometrics, tokens, certificates, passwordless
                    'Authorization', // Items 21-30: Access control models (DAC, MAC, RBAC, ABAC), PAM, JIT, least privilege
                    'Accounting (Auditing)', // Items 31-40: Access logging, audit trails, compliance, session management
                    'Federation & Advanced IAM', // Items 41-50: SSO, Kerberos, identity federation (SAML, OAuth, OpenID Connect)
                ],
            ],
            [
                'name' => 'Network Concepts',
                'code' => 'NET',
                'priority_order' => 11,
                'category' => 'technical',
                'color' => '#06B6D4', // Cyan
                'icon' => 'globe',
                'description' => 'Fundamental networking concepts and protocols. Essential foundation for understanding network security.',
                'learning_objectives' => 'Understand network protocols, architectures, and communication models.',
                'topics' => [
                    'OSI Model', // Items 1-10: Layer functions, encapsulation
                    'TCP/IP Protocols', // Items 11-20: Addressing, subnetting, routing, core protocols (TCP, UDP, ICMP)
                    'Network Appliances', // Items 21-30: Switches, routers, infrastructure devices, physical media
                    'Network Services', // Items 31-40: DNS, DHCP, NTP, directory services, load balancing
                    'Communication Protocols', // Items 41-50: HTTP/HTTPS, FTP, SMTP, POP3, IMAP, routing protocols
                ],
            ],
            [
                'name' => 'Network Security',
                'code' => 'NETS',
                'priority_order' => 12,
                'category' => 'technical',
                'color' => '#0891B2', // Cyan-600
                'icon' => 'shield',
                'description' => 'Network security fundamentals including defense mechanisms and attack vectors. Essential for protecting data in transit.',
                'learning_objectives' => 'Design secure network architectures and implement network security controls. Understand network attacks and defenses.',
                'topics' => [
                    'Security Protocols', // Items 1-10: IPSec, TLS/SSL, VPN technologies, secure communications
                    'Network Attacks', // Items 11-20: DDoS, MITM, spoofing, network reconnaissance, threat vectors
                    'Network Segmentation', // Items 21-30: VLANs, DMZ, microsegmentation, access control, firewalls
                    'Wireless Security', // Items 31-40: Enterprise WiFi (WPA3, 802.1X), wireless threats, enterprise architecture
                    'Network Diagnostic Tools', // Items 41-50: ping, traceroute, nslookup, tcpdump, dig, netstat, ip/ifconfig, arp, nmap
                ],
            ],
            [
                'name' => 'Application Security',
                'code' => 'APP',
                'priority_order' => 13,
                'category' => 'technical',
                'color' => '#7C3AED', // Violet
                'icon' => 'code',
                'description' => 'Secure software development practices and application security. Integrates security throughout the development lifecycle.',
                'learning_objectives' => 'Implement secure coding practices and integrate security into CI/CD pipelines. Identify and mitigate application vulnerabilities.',
                'topics' => [
                    'Secure Software Development Lifecycle (SSDLC)', // Items 1-10: SDLC security integration, gates, threat modeling, requirements
                    'Development Models', // Items 11-20: SDLC security, gates, threat modeling, requirements management
                    'Application Vulnerabilities', // Items 21-30: SQLi, XSS, CSRF, buffer overflow, SSRF, path traversal
                    'Security Testing', // Items 31-40: Functional, QA, security testing methods (SAST, DAST, IAST)
                    'Secure Coding', // Items 41-50: Input validation, output encoding, session management, error handling
                ],
            ],
            [
                'name' => 'Cloud Security',
                'code' => 'CLD',
                'priority_order' => 14,
                'category' => 'technical',
                'color' => '#2563EB', // Blue-600
                'icon' => 'cloud',
                'description' => 'Cloud computing security across different service and deployment models. Understanding shared responsibility is crucial.',
                'learning_objectives' => 'Apply cloud security principles across IaaS, PaaS, and SaaS. Implement cloud-native security controls.',
                'topics' => [
                    'Cloud Fundamentals', // Items 1-10: Service characteristics, cloud actors, benefits & risks
                    'Cloud Models', // Items 11-20: Service models (IaaS, PaaS, SaaS), deployment models, service categories
                    'Cloud Governance', // Items 21-30: Shared responsibility model, contracts, risk management, audits
                    'Cloud Security Controls', // Items 31-40: CASB, SASE, IAM, data protection controls
                    'Cloud Infrastructure Security', // Items 41-50: Multi-cloud, VPC, virtualization, key management
                ],
            ],
            [
                'name' => 'Endpoint, Mobile & IoT Security',
                'code' => 'EPT',
                'priority_order' => 15,
                'category' => 'technical',
                'color' => '#DC2626', // Red-600
                'icon' => 'device-mobile',
                'description' => 'Security for endpoints including desktops, mobile devices, and IoT. Critical as attack surfaces expand.',
                'learning_objectives' => 'Secure various endpoint types and implement mobile device management. Address IoT security challenges.',
                'topics' => [
                    'Endpoint Security', // Items 1-10: EPP, EDR, XDR, whitelisting, baselines, configuration management
                    'Device Security', // Items 11-20: Encryption, secure boot, TPM, firmware integrity, hardware features
                    'Mobile Security', // Items 21-30: MDM, EMM, BYOD, COPE, mobile threat protection
                    'IoT Security', // Items 31-40: Device challenges, embedded systems, constrained environments, segmentation
                    'OT Security', // Items 41-50: ICS, SCADA, PLCs, air-gapping, safety vs security priorities
                ],
            ],
            [
                'name' => 'Security Awareness & Human Factors',
                'code' => 'SAH',
                'priority_order' => 16,
                'category' => 'managerial',
                'color' => '#F97316', // Orange-500
                'icon' => 'users',
                'description' => 'Human aspects of security including awareness training and social engineering defense. People are often the weakest link.',
                'learning_objectives' => 'Design security awareness programs and mitigate human-factor risks. Implement policies for secure behavior.',
                'topics' => [
                    'Social Engineering', // Items 1-10: Phishing, vishing, smishing, tailgating, pretexting, baiting techniques
                    'Security Awareness & Training', // Items 11-20: Training lifecycle, delivery methods, program design
                    'Human Resource Security', // Items 21-30: Screening, onboarding, termination procedures
                    'Personnel Safety', // Items 31-40: Duress codes, emergency response, travel security, social media guidelines
                    'Personnel Security Controls', // Items 41-50: SoD, dual control, job rotation, clear desk policies
                ],
            ],
            [
                'name' => 'Physical & Environmental Security',
                'code' => 'PHY',
                'priority_order' => 17,
                'category' => 'managerial',
                'color' => '#64748B', // Slate-500
                'icon' => 'office-building',
                'description' => 'Physical security controls and environmental protection. Often overlooked but critical for comprehensive security.',
                'learning_objectives' => 'Design physical security controls and implement environmental safeguards. Understand facility security requirements.',
                'topics' => [
                    'Physical Access Control', // Items 1-10: Physical barriers, security personnel, procedures
                    'Fire', // Items 11-20: Prevention, detection, suppression systems
                    'Power', // Items 21-30: Power issues, preventive measures, backup systems
                    'Site Design', // Items 31-40: Site selection, CPTED principles, facility layout
                    'Environmental Controls', // Items 41-50: HVAC, monitoring, lighting, surveillance
                ],
            ],
            [
                'name' => 'Security Operations & Monitoring',
                'code' => 'OPS',
                'priority_order' => 18,
                'category' => 'technical',
                'color' => '#0891B2', // Cyan-600
                'icon' => 'desktop-computer',
                'description' => 'Day-to-day security operations including monitoring, detection, and response. The front line of security defense.',
                'learning_objectives' => 'Implement security monitoring and manage security operations centers. Use SIEM and other operational tools effectively.',
                'topics' => [
                    'Security Operations Center (SOC)', // Items 1-10: SOC structure, governance, roles, responsibilities, workflows
                    'Log Management', // Items 11-20: Collection, aggregation, correlation, analysis, retention
                    'Detection', // Items 21-30: IDS/IPS, SIEM, UEBA systems and technologies
                    'Response', // Items 31-40: SOAR, incident response procedures, threat containment
                    'Monitoring', // Items 41-50: Real-time monitoring, alerting, metrics, performance measurement
                ],
            ],
            [
                'name' => 'Incident Management',
                'code' => 'INC',
                'priority_order' => 19,
                'category' => 'managerial',
                'color' => '#BE123C', // Rose-700
                'icon' => 'search-circle',
                'description' => 'Incident response procedures and digital forensics. Critical for minimizing damage and learning from security events.',
                'learning_objectives' => 'Execute incident response plans and conduct forensic investigations. Preserve evidence and perform root cause analysis.',
                'topics' => [
                    'Preparation', // Items 1-10: IR plans, tools, training, communication procedures
                    'Detection, Triage & Analysis', // Items 11-20: Event identification, classification, technical analysis
                    'Containment', // Items 21-30: Short-term & long-term containment strategies
                    'Eradication & Recovery', // Items 31-40: System restoration and vulnerability remediation
                    'Post-Incident Activity', // Items 41-50: Lessons learned, documentation, process improvement
                ],
            ],
            [
                'name' => 'Business Continuity & Disaster Recovery',
                'code' => 'BCP',
                'priority_order' => 20,
                'category' => 'managerial',
                'color' => '#0F766E', // Teal-700
                'icon' => 'refresh',
                'description' => 'Ensuring business resilience through continuity planning and disaster recovery. Essential for organizational survival.',
                'learning_objectives' => 'Develop business continuity and disaster recovery plans. Conduct BIA and establish recovery objectives.',
                'topics' => [
                    'Business Impact Analysis (BIA)', // Critical functions identification, impact quantification, recovery objectives (RTO/RPO/MTD), dependency mapping
                    'Business Continuity Planning', // Emergency response procedures, alternate work arrangements, process continuity, crisis communications
                    'Disaster Recovery', // DR sites (hot/warm/cold), site selection criteria, cloud DR, reciprocal agreements
                    'Recovery Strategy', // 3-2-1 backup rule, GFS rotation, backup types (full/incremental/differential), verification & testing
                    'Testing', // Testing methods (tabletop/walkthrough/simulation/full-scale), documentation, continuous improvement
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
