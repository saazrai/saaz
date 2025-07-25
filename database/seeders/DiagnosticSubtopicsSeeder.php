<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class DiagnosticSubtopicsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing subtopics to ensure clean state
        DB::table('diagnostic_subtopics')->truncate();

        // Define all subtopics for all domains in one place
        $subtopicDefinitions = [
            // Domain 1: General Security Concepts
            'General Security Concepts' => [
                '5 Pillars of Information Security' => [
                    ['name' => 'Confidentiality', 'description' => 'Preventing unauthorized disclosure'],
                    ['name' => 'Integrity', 'description' => 'Ensuring data accuracy and completeness'],
                    ['name' => 'Availability', 'description' => 'Ensuring systems and data are accessible'],
                    ['name' => 'Authenticity', 'description' => 'Verifying identity and origin'],
                    ['name' => 'Non-repudiation', 'description' => 'Preventing denial of actions'],
                ],
                'Professional Ethics' => [
                    ['name' => 'Organizational Code of Ethics', 'description' => 'Company-specific ethical guidelines'],
                    ['name' => 'Professional Standards and Conduct', 'description' => 'Industry ethics'],
                ],
                'Security Controls' => [
                    ['name' => 'Control Categories', 'description' => 'Administrative, Technical, Physical'],
                    ['name' => 'Control Functions', 'description' => 'Directive, Deterrent, Preventive, Detective, Corrective, Recovery, Compensating'],
                ],
                'Security Principles' => [
                    ['name' => 'Access Control Principles', 'description' => 'Least Privilege, Need-to-Know'],
                    ['name' => 'Design Principles', 'description' => 'Security By Design, Open Design, Economy of Mechanism, Fail Securely, Psychological Acceptability'],
                ],
                'Cybersecurity Frameworks' => [
                    ['name' => 'Risk Management Frameworks', 'description' => 'NIST CSF, ISO/IEC 27001'],
                    ['name' => 'Governance Frameworks', 'description' => 'COBIT, TOGAF'],
                    ['name' => 'Control Frameworks', 'description' => 'CIS Controls, NIST 800-53'],
                ],
            ],

            // Domain 2: Information Security Governance
            'Information Security Governance' => [
                'Information Security Program' => [
                    ['name' => 'Security Program Establishment', 'description' => 'Security program establishment and charter'],
                    ['name' => 'Program Governance Structure', 'description' => 'Program governance structure and oversight'],
                    ['name' => 'Gap Analysis', 'description' => 'Gap analysis and current state assessment'],
                    ['name' => 'Maturity Models', 'description' => 'Maturity models and maturity assessment'],
                    ['name' => 'Program Improvement Planning', 'description' => 'Program improvement planning and roadmaps'],
                    ['name' => 'Program Effectiveness Measurement', 'description' => 'Program effectiveness measurement and reporting'],
                ],
                'Strategic Alignment' => [
                    ['name' => 'Business-Security Alignment', 'description' => 'Aligning InfoSec with business goals and objectives'],
                    ['name' => 'Security Strategy Development', 'description' => 'Security strategy development and implementation'],
                    ['name' => 'Business Case Development', 'description' => 'Business case development for security investments'],
                    ['name' => 'Strategic Planning', 'description' => 'Strategic planning and roadmap development'],
                    ['name' => 'Business-Security Integration', 'description' => 'Business-security integration and collaboration'],
                ],
                'Leadership & Accountability' => [
                    ['name' => 'Board and Senior Management', 'description' => 'Board of Directors and senior management accountability'],
                    ['name' => 'C-Suite Responsibilities', 'description' => 'C-suite security responsibilities (CEO, CFO, CRO)'],
                    ['name' => 'Governance Bodies', 'description' => 'Steering committees and governance bodies'],
                    ['name' => 'CISO Role', 'description' => 'CISO role, responsibilities, and reporting structure'],
                    ['name' => 'Accountability Frameworks', 'description' => 'RACI Matrix and accountability frameworks'],
                    ['name' => 'Security Culture Leadership', 'description' => 'Tone at the top and security culture leadership'],
                ],
                'Security Policy Framework' => [
                    ['name' => 'Policy Hierarchy', 'description' => 'Policy hierarchy (Policy → Standard → Procedure → Guideline)'],
                    ['name' => 'Policy Types', 'description' => 'Policy types and classification (mandatory vs advisory)'],
                    ['name' => 'Documentation Standards', 'description' => 'Documentation standards and requirements'],
                    ['name' => 'Policy Templates', 'description' => 'Policy templates and standardization'],
                    ['name' => 'Regulatory Mapping', 'description' => 'Regulatory and compliance mapping'],
                ],
                'Policy Governance and Management' => [
                    ['name' => 'Policy Lifecycle Management', 'description' => 'Policy lifecycle management (development, approval, review)'],
                    ['name' => 'Policy Approval Workflows', 'description' => 'Policy approval workflows and authority levels'],
                    ['name' => 'Policy Governance', 'description' => 'Policy governance and compliance monitoring'],
                    ['name' => 'Policy Enforcement', 'description' => 'Policy enforcement and exception management'],
                    ['name' => 'Policy Effectiveness Measurement', 'description' => 'Policy effectiveness measurement and metrics'],
                    ['name' => 'Policy Communication', 'description' => 'Policy communication and awareness programs'],
                ],
            ],

            // Domain 3: Legal, Regulatory & Compliance
            'Legal, Regulatory & Compliance' => [
                'Compliance Requirements' => [
                    ['name' => 'Compliance Framework', 'description' => 'Framework and process for meeting obligations'],
                    ['name' => 'Cross-Border Considerations', 'description' => 'Cross-border/jurisdictional considerations'],
                    ['name' => 'Data Localization', 'description' => 'Data localization and residency requirements'],
                    ['name' => 'Digital Sovereignty', 'description' => 'Digital sovereignty and data embassy concepts'],
                    ['name' => 'Compliance Program Establishment', 'description' => 'Compliance program establishment'],
                    ['name' => 'Requirements Hierarchy', 'description' => 'Legal vs regulatory vs contractual requirements hierarchy'],
                ],
                'Contracts' => [
                    ['name' => 'Vendor Security Requirements', 'description' => 'Vendor Security Requirements'],
                    ['name' => 'Service Level Agreements', 'description' => 'Service Level Agreements (SLAs)'],
                    ['name' => 'Liability & Indemnification', 'description' => 'Liability & Indemnification'],
                    ['name' => 'Data Processing Agreements', 'description' => 'Data Processing Agreements (DPAs)'],
                    ['name' => 'Breach Notification Clauses', 'description' => 'Breach Notification Clauses'],
                    ['name' => 'Fourth-Party Risk', 'description' => 'Subcontracts & Fourth-party Risk'],
                    ['name' => 'Source Code Escrow', 'description' => 'Source Code Escrow'],
                    ['name' => 'Audit Clauses', 'description' => 'Right to Audit Clauses'],
                    ['name' => 'Insurance Requirements', 'description' => 'Insurance & Bonding Requirements'],
                    ['name' => 'Termination & Data Return', 'description' => 'Termination & Data Return'],
                ],
                'Industry Specific Regulations' => [
                    ['name' => 'Healthcare Regulations', 'description' => 'HIPAA and healthcare-specific compliance'],
                    ['name' => 'Financial Regulations', 'description' => 'SOX, GLBA and financial industry compliance'],
                    ['name' => 'Educational Regulations', 'description' => 'FERPA and educational data protection'],
                    ['name' => 'Government Regulations', 'description' => 'FedRAMP, ITAR and government compliance'],
                    ['name' => 'Industry-Specific Obligations', 'description' => 'Other industry-specific compliance requirements'],
                ],
                'Intellectual Property' => [
                    ['name' => 'Patents', 'description' => 'Patent protection and management'],
                    ['name' => 'Trademarks', 'description' => 'Trademark protection and enforcement'],
                    ['name' => 'Copyrights', 'description' => 'Copyright law and digital rights'],
                    ['name' => 'Trade Secrets', 'description' => 'Trade secret protection and confidentiality'],
                ],
                'Investigation Types' => [
                    ['name' => 'Administrative Investigations', 'description' => 'Administrative investigations and procedures'],
                    ['name' => 'Criminal Investigations', 'description' => 'Criminal investigations and law enforcement'],
                    ['name' => 'Civil Investigations', 'description' => 'Civil litigation and discovery'],
                    ['name' => 'Regulatory Investigations', 'description' => 'Regulatory compliance investigations'],
                    ['name' => 'Evidence Standards', 'description' => 'Evidence standards and burden of proof'],
                    ['name' => 'Digital Forensics', 'description' => 'Digital forensic investigation procedures and methodologies'],
                    ['name' => 'Chain of Custody', 'description' => 'Chain of custody procedures for evidence handling'],
                    ['name' => 'Order of Volatility', 'description' => 'Priority sequence for collecting digital evidence based on data persistence'],
                    ['name' => 'Violation Penalties', 'description' => 'Penalties for violations'],
                ],
            ],

            // Domain 4: Privacy
            'Privacy' => [
                'Personal Information' => [
                    ['name' => 'Personal Data Definitions', 'description' => 'Definition of Personal Data, PII, PHI, SPI (Sensitive Personal Information)'],
                    ['name' => 'Contextual Identifiers', 'description' => 'Contextual identifiers (direct vs indirect)'],
                    ['name' => 'Sector Examples', 'description' => 'Examples across sectors (health, financial, biometrics)'],
                    ['name' => 'Global Definitions', 'description' => 'Global definitions across laws (GDPR, CCPA, PIPL)'],
                ],
                'Privacy Principles' => [
                    ['name' => 'GDPR Principles', 'description' => 'GDPR principles (lawfulness, fairness, transparency, purpose limitation, data minimization, accuracy, storage limitation, accountability)'],
                    ['name' => 'Legal Bases for Processing', 'description' => 'Legal bases for processing (consent, contract, legal obligation, vital interests, public task, legitimate interests)'],
                ],
                'Data Subject Rights' => [
                    ['name' => 'Access Rights', 'description' => 'Right of access, rectification, erasure (right to be forgotten)'],
                    ['name' => 'Processing Rights', 'description' => 'Right to restrict processing, data portability'],
                    ['name' => 'Objection Rights', 'description' => 'Right to object, rights related to automated decision-making'],
                    ['name' => 'Consent Rights', 'description' => 'Right to withdraw consent'],
                ],
                'Privacy Governance' => [
                    ['name' => 'Controller vs Processor', 'description' => 'Data controllers vs processors responsibilities'],
                    ['name' => 'Data Protection Officer', 'description' => 'Data Protection Officer (DPO) requirements'],
                    ['name' => 'Privacy Impact Assessment', 'description' => 'Privacy Impact Assessment (DPIA) / Privacy by Design'],
                    ['name' => 'Processing Records', 'description' => 'Records of processing activities'],
                ],
                'Privacy Protection' => [
                    ['name' => 'International Data Transfers', 'description' => 'International data transfers (adequacy decisions, SCCs, BCRs)'],
                    ['name' => 'Technical Safeguards', 'description' => 'Technical safeguards (masking, anonymization, pseudonymization, encryption, tokenization)'],
                ],
            ],

            // Domain 5: Risk Management
            'Risk Management' => [
                'Risk Management Fundamentals' => [
                    ['name' => 'Risk Management Lifecycle', 'description' => 'Risk management lifecycle (Identify → Assess → Treat → Monitor)'],
                    ['name' => 'Risk Management Frameworks', 'description' => 'Risk management frameworks (NIST RMF, ISO 31000, COSO ERM)'],
                    ['name' => 'Risk Appetite and Tolerance', 'description' => 'Risk appetite, tolerance, and capacity definitions'],
                    ['name' => 'Inherent Risk', 'description' => 'Inherent risk (risk before controls)'],
                    ['name' => 'Risk Governance Structure', 'description' => 'Risk governance structure and committees'],
                    ['name' => 'Risk Management Program', 'description' => 'Risk management program establishment'],
                ],
                'Risk Identification' => [
                    ['name' => 'Threat Identification', 'description' => 'Threat identification and analysis'],
                    ['name' => 'Threat Modeling', 'description' => 'Threat modeling (STRIDE)'],
                    ['name' => 'Vulnerability Identification', 'description' => 'Vulnerability identification and assessment'],
                    ['name' => 'Risk Scenario Development', 'description' => 'Risk scenario development'],
                    ['name' => 'Risk Owner Assignment', 'description' => 'Risk owner assignment'],
                ],
                'Risk Assessment' => [
                    ['name' => 'Qualitative Risk Assessment', 'description' => 'Qualitative risk assessment methods'],
                    ['name' => 'Quantitative Risk Assessment', 'description' => 'Quantitative risk assessment techniques'],
                    ['name' => 'Impact and Likelihood', 'description' => 'Impact and likelihood determination'],
                    ['name' => 'Risk Scoring', 'description' => 'Risk scoring and prioritization'],
                    ['name' => 'Risk Analysis Methodologies', 'description' => 'Risk analysis methodologies'],
                ],
                'Risk Response & Treatment' => [
                    ['name' => 'Risk Response Strategies', 'description' => 'Risk response strategies (Avoid, Accept, Transfer, Mitigate)'],
                    ['name' => 'Control Selection', 'description' => 'Control selection and implementation'],
                    ['name' => 'Residual Risk', 'description' => 'Residual risk calculation (risk after controls)'],
                    ['name' => 'Control Owner Assignment', 'description' => 'Control owner assignment'],
                    ['name' => 'Cost-Benefit Analysis', 'description' => 'Cost-benefit analysis for controls'],
                    ['name' => 'Risk Treatment Planning', 'description' => 'Risk treatment planning'],
                ],
                'Risk Monitoring & Reporting' => [
                    ['name' => 'Continuous Risk Monitoring', 'description' => 'Continuous risk monitoring processes'],
                    ['name' => 'Key Risk Indicators', 'description' => 'Key Risk Indicators (KRIs) and metrics'],
                    ['name' => 'Risk Reporting', 'description' => 'Risk reporting to stakeholders'],
                ],
            ],

            // Domain 6: Security Audits & Assessments
            'Security Audits & Assessments' => [
                'Audit Fundamentals' => [
                    ['name' => 'Audit Lifecycle', 'description' => 'Audit lifecycle phases (Planning → Fieldwork → Reporting → Follow-up)'],
                    ['name' => 'Audit Types', 'description' => 'Audit types (Internal vs External, Compliance vs Operational)'],
                    ['name' => 'Audit Planning', 'description' => 'Audit planning and scoping methodologies'],
                    ['name' => 'Risk-Based Audit Approaches', 'description' => 'Risk-based audit approaches and audit universe development'],
                    ['name' => 'Professional Standards', 'description' => 'Professional standards and ethics (ISACA, IIA guidelines)'],
                ],
                'Evidence Gathering' => [
                    ['name' => 'Evidence-Gathering Techniques', 'description' => 'Evidence-gathering techniques (Interview, Observation, Re-performance, CAAT)'],
                    ['name' => 'Sampling Methods', 'description' => 'Sampling methods and sampling risk (Attribute, Stop-or-Go, Discovery)'],
                    ['name' => 'Documentation Standards', 'description' => 'Documentation standards and audit trails'],
                ],
                'Control Assessment' => [
                    ['name' => 'Control Testing', 'description' => 'Control design vs operating effectiveness testing'],
                    ['name' => 'Gap Analysis', 'description' => 'Gap analysis and control weakness identification'],
                    ['name' => 'Testing Approaches', 'description' => 'Compliance vs substantive testing approaches'],
                    ['name' => 'Control Testing Procedures', 'description' => 'Control testing procedures and documentation'],
                    ['name' => 'Remediation Tracking', 'description' => 'Remediation tracking and validation'],
                ],
                'Testing Methodologies & Approaches' => [
                    ['name' => 'Black-Box Testing', 'description' => 'Black-box testing - External perspective, no internal knowledge'],
                    ['name' => 'White-Box Testing', 'description' => 'White-box testing - Full internal knowledge and access'],
                    ['name' => 'Gray-Box Testing', 'description' => 'Gray-box testing - Limited internal knowledge/hybrid approach'],
                    ['name' => 'Static vs Dynamic Analysis', 'description' => 'Static vs Dynamic analysis techniques'],
                    ['name' => 'Testing Approaches', 'description' => 'Manual vs Automated testing approaches'],
                    ['name' => 'Risk-Based Testing', 'description' => 'Risk-based testing strategies'],
                ],
                'Security Testing' => [
                    ['name' => 'Penetration Testing', 'description' => 'Penetration testing methodologies'],
                    ['name' => 'Red Team Exercises', 'description' => 'Red team vs Purple team exercises'],
                    ['name' => 'Security Assessments', 'description' => 'Security assessment techniques'],
                    ['name' => 'Security Code Review', 'description' => 'Security code review and configuration assessment'],
                    ['name' => 'Specialized Testing', 'description' => 'Specialized testing (web apps, networks, wireless, mobile)'],
                ],
            ],

            // Domain 7: Threat & Vulnerability Management
            'Threat & Vulnerability Management' => [
                'Threat Actors' => [
                    ['name' => 'Threat Actor Types', 'description' => 'Threat actor types (APT, hacktivist, organized crime, nation-state, script kiddie)'],
                    ['name' => 'Insider Threat Categories', 'description' => 'Insider threat categories (intentional vs unintentional)'],
                ],
                'TTPs' => [
                    ['name' => 'Tactics, Techniques, Procedures', 'description' => 'What are Tactics, Techniques, Procedures?'],
                    ['name' => 'MITRE ATT&CK Framework', 'description' => 'MITRE ATT&CK framework structure and navigation'],
                    ['name' => 'Cyber Kill Chain', 'description' => 'Cyber Kill Chain methodology'],
                    ['name' => 'TTP Attribution', 'description' => 'TTP attribution and threat actor analysis'],
                ],
                'Vulnerability Management' => [
                    ['name' => 'Vulnerability Lifecycle', 'description' => 'Vulnerability lifecycle phases (discovery → assessment → remediation → verification)'],
                    ['name' => 'Asset Inventory', 'description' => 'Asset inventory and vulnerability scanning basics'],
                    ['name' => 'Remediation Strategies', 'description' => 'Remediation strategies (patching, workarounds, compensating controls)'],
                ],
                'Vulnerability Assessment' => [
                    ['name' => 'CVSS Scoring', 'description' => 'CVSS scoring fundamentals (base metrics, severity ratings)'],
                    ['name' => 'Vulnerability Prioritization', 'description' => 'Vulnerability prioritization methods (business impact, asset criticality)'],
                    ['name' => 'CVE, CWE, NVD Systems', 'description' => 'CVE, CWE, and NVD systems'],
                    ['name' => 'Zero-Day vs N-Day', 'description' => 'Zero-day vs N-day vulnerabilities'],
                    ['name' => 'Risk-Based Ranking', 'description' => 'Risk-based vulnerability ranking approaches'],
                ],
                'Malware' => [
                    ['name' => 'Malware Types', 'description' => 'Malware family types (virus, worm, trojan, ransomware, rootkit, spyware, adware)'],
                    ['name' => 'Malware Delivery', 'description' => 'Malware delivery mechanisms (email attachments, drive-by downloads, USB, supply chain)'],
                    ['name' => 'Malware Behavior', 'description' => 'Malware behavior patterns (persistence, lateral movement, data exfiltration)'],
                    ['name' => 'Analysis Techniques', 'description' => 'Static vs dynamic analysis fundamentals'],
                    ['name' => 'Malware Indicators', 'description' => 'Malware indicators and signatures'],
                ],
            ],

            // Domain 8: Cryptography & Key Management
            'Cryptography & Key Management' => [
                'Cryptography Algorithms' => [
                    ['name' => 'Symmetric Encryption', 'description' => 'Symmetric encryption algorithms'],
                    ['name' => 'Algorithm Selection', 'description' => 'Algorithm selection criteria'],
                    ['name' => 'Cipher Types', 'description' => 'Block ciphers vs stream ciphers'],
                ],
                'Cryptographic Applications' => [
                    ['name' => 'Cryptographic Applications', 'description' => 'Digital signatures, MAC, HMAC, non-repudiation'],
                    ['name' => 'Message Authentication Codes', 'description' => 'Message Authentication Codes'],
                    ['name' => 'Authentication vs Integrity', 'description' => 'Authentication vs integrity distinctions'],
                    ['name' => 'Cryptographic Protocols', 'description' => 'Cryptographic protocols and standards'],
                ],
                'Public Key Infrastructure (PKI)' => [
                    ['name' => 'Public Key Infrastructure (PKI)', 'description' => 'PKI concepts and implementation'],
                ],
                'Key Management' => [
                    ['name' => 'Key Management', 'description' => 'Key lifecycle management'],
                ],
                'Cryptanalysis' => [
                    ['name' => 'Cryptanalysis', 'description' => 'Cryptographic attacks and vulnerabilities'],
                ],
            ],

            // Domain 9: Data Governance
            'Data Governance' => [
                'Data Classification & Categorization' => [
                    ['name' => 'Data Classification & Categorization', 'description' => 'Defining sensitivity levels, data types, regulatory categories, classification processes, and roles responsible for data governance'],
                ],
                'Data Lifecycle Management' => [
                    ['name' => 'Data Lifecycle Management', 'description' => 'Managing data through all phases: Create, Store, Use, Share, Archive, and Destroy, ensuring security at each stage'],
                ],
                'Data Retention & Archival' => [
                    ['name' => 'Data Retention & Archival', 'description' => 'Establishing retention policies, archival strategies, long-term storage solutions, and retrieval procedures'],
                ],
                'Data Sanitization' => [
                    ['name' => 'Data Sanitization', 'description' => 'Implementing data sanitization techniques and understanding categories: clearing, purging, and destroying data securely'],
                ],
                'Data Security Controls' => [
                    ['name' => 'Data Security Controls', 'description' => 'Protecting data states (at rest, in transit, in use), implementing rights management, DLP solutions, and encryption strategies'],
                ],
            ],

            // Domain 10: Identity and Access Management (IAM)
            'Identity and Access Management (IAM)' => [
                'Identification' => [
                    ['name' => 'Identification', 'description' => 'Identity establishment, proofing, verification processes, and complete identity lifecycle management'],
                ],
                'Authentication' => [
                    ['name' => 'Authentication', 'description' => 'Password fundamentals, multi-factor authentication (MFA), biometrics, tokens, certificates, and passwordless authentication methods'],
                ],
                'Authorization' => [
                    ['name' => 'Authorization', 'description' => 'Access control models (DAC, MAC, RBAC, ABAC), privileged access management (PAM), just-in-time access, and least privilege principles'],
                ],
                'Accounting (Auditing)' => [
                    ['name' => 'Accounting (Auditing)', 'description' => 'Access logging, audit trail management, compliance monitoring, and session management for accountability'],
                ],
                'Federation & Advanced IAM' => [
                    ['name' => 'Federation & Advanced IAM', 'description' => 'Single Sign-On (SSO), Kerberos authentication, identity federation protocols (SAML, OAuth, OpenID Connect)'],
                ],
            ],

            // Domain 11: Network Concepts
            'Network Concepts' => [
                'OSI Model' => [
                    ['name' => 'OSI Model', 'description' => 'Understanding the seven layers of the OSI model, their functions, and data encapsulation principles'],
                ],
                'TCP/IP Protocols' => [
                    ['name' => 'TCP/IP Protocols', 'description' => 'IP addressing, subnetting, routing concepts, and core protocols including TCP, UDP, and ICMP'],
                ],
                'Network Appliances' => [
                    ['name' => 'Network Appliances', 'description' => 'Switches, routers, infrastructure devices, and physical media used in network communications'],
                ],
                'Network Services' => [
                    ['name' => 'Network Services', 'description' => 'DNS, DHCP, NTP, directory services, load balancing, and other essential network services'],
                ],
                'Communication Protocols' => [
                    ['name' => 'Communication Protocols', 'description' => 'HTTP/HTTPS, FTP, SMTP, POP3, IMAP, and routing protocols for data transmission'],
                ],
            ],

            // Domain 12: Network Security
            'Network Security' => [
                'Security Protocols' => [
                    ['name' => 'Security Protocols', 'description' => 'IPSec, TLS/SSL, VPN technologies, and secure communication protocols for network protection'],
                ],
                'Network Attacks' => [
                    ['name' => 'Network Attacks', 'description' => 'DDoS attacks, man-in-the-middle attacks, spoofing, network reconnaissance, and threat vectors'],
                ],
                'Network Segmentation' => [
                    ['name' => 'Network Segmentation', 'description' => 'VLANs, DMZ design, microsegmentation strategies, access control implementation, and firewall configuration'],
                ],
                'Wireless Security' => [
                    ['name' => 'Wireless Security', 'description' => 'Enterprise WiFi security (WPA3, 802.1X), wireless threats, and enterprise wireless architecture design'],
                ],
                'Network Diagnostic Tools' => [
                    ['name' => 'Network Diagnostic Tools', 'description' => 'Using ping, traceroute, nslookup, tcpdump, dig, netstat, ip/ifconfig, arp, and nmap for network troubleshooting'],
                ],
            ],

            // Domain 13: Application Security
            'Application Security' => [
                'Secure Software Development Lifecycle (SSDLC)' => [
                    ['name' => 'Secure Software Development Lifecycle (SSDLC)', 'description' => 'Integrating security throughout SDLC phases, security gates, threat modeling, and security requirements management'],
                ],
                'Development Models' => [
                    ['name' => 'Development Models', 'description' => 'Security considerations in waterfall, agile, DevSecOps, and other development methodologies'],
                ],
                'Application Vulnerabilities' => [
                    ['name' => 'Application Vulnerabilities', 'description' => 'SQL injection, XSS, CSRF, buffer overflow, SSRF, path traversal, and other common application vulnerabilities'],
                ],
                'Security Testing' => [
                    ['name' => 'Security Testing', 'description' => 'Static (SAST), dynamic (DAST), and interactive (IAST) application security testing methodologies'],
                ],
                'Secure Coding' => [
                    ['name' => 'Secure Coding', 'description' => 'Input validation, output encoding, session management, error handling, and secure coding best practices'],
                ],
            ],

            // Domain 14: Cloud Security
            'Cloud Security' => [
                'Cloud Fundamentals' => [
                    ['name' => 'Cloud Fundamentals', 'description' => 'Essential cloud service characteristics, cloud actors and roles, benefits and risks of cloud computing'],
                ],
                'Cloud Models' => [
                    ['name' => 'Cloud Models', 'description' => 'Service models (IaaS, PaaS, SaaS), deployment models (public, private, hybrid, community), and service categories'],
                ],
                'Cloud Governance' => [
                    ['name' => 'Cloud Governance', 'description' => 'Shared responsibility model, cloud contracts and SLAs, risk management in cloud environments, and cloud auditing'],
                ],
                'Cloud Security Controls' => [
                    ['name' => 'Cloud Security Controls', 'description' => 'CASB implementation, SASE architecture, cloud IAM, and data protection controls for cloud environments'],
                ],
                'Cloud Infrastructure Security' => [
                    ['name' => 'Cloud Infrastructure Security', 'description' => 'Multi-cloud strategies, VPC design, virtualization security, and cloud key management services'],
                ],
            ],

            // Domain 15: Endpoint, Mobile & IoT Security
            'Endpoint, Mobile & IoT Security' => [
                'Endpoint Security' => [
                    ['name' => 'Endpoint Security', 'description' => 'Endpoint Protection Platforms (EPP), EDR, XDR solutions, application whitelisting, baseline configuration management'],
                ],
                'Device Security' => [
                    ['name' => 'Device Security', 'description' => 'Full disk encryption, secure boot processes, TPM usage, firmware integrity verification, and hardware security features'],
                ],
                'Mobile Security' => [
                    ['name' => 'Mobile Security', 'description' => 'Mobile Device Management (MDM), Enterprise Mobility Management (EMM), BYOD policies, COPE strategies, and mobile threat protection'],
                ],
                'IoT Security' => [
                    ['name' => 'IoT Security', 'description' => 'IoT device security challenges, embedded systems protection, constrained environment security, and IoT network segmentation'],
                ],
                'OT Security' => [
                    ['name' => 'OT Security', 'description' => 'Industrial Control Systems (ICS), SCADA security, PLC protection, air-gapping strategies, and balancing safety with security priorities'],
                ],
            ],

            // Domain 16: Security Awareness & Human Factors
            'Security Awareness & Human Factors' => [
                'Social Engineering' => [
                    ['name' => 'Social Engineering', 'description' => 'Phishing, vishing, smishing attacks, tailgating, pretexting, baiting techniques, and social engineering defense strategies'],
                ],
                'Security Awareness & Training' => [
                    ['name' => 'Security Awareness & Training', 'description' => 'Security training lifecycle, delivery methods, program design, effectiveness measurement, and continuous awareness initiatives'],
                ],
                'Human Resource Security' => [
                    ['name' => 'Human Resource Security', 'description' => 'Personnel screening processes, secure onboarding procedures, role-based training, and termination security protocols'],
                ],
                'Personnel Safety' => [
                    ['name' => 'Personnel Safety', 'description' => 'Duress codes implementation, emergency response procedures, travel security guidelines, and social media security awareness'],
                ],
                'Personnel Security Controls' => [
                    ['name' => 'Personnel Security Controls', 'description' => 'Separation of duties (SoD), dual control mechanisms, job rotation policies, clean desk policies, and insider threat mitigation'],
                ],
            ],

            // Domain 17: Physical & Environmental Security
            'Physical & Environmental Security' => [
                'Physical Access Control' => [
                    ['name' => 'Physical Access Control', 'description' => 'Physical barriers, security personnel deployment, access control systems, visitor management procedures, and perimeter security'],
                ],
                'Fire' => [
                    ['name' => 'Fire', 'description' => 'Fire prevention strategies, detection systems, suppression systems (wet pipe, dry pipe, pre-action), and emergency response procedures'],
                ],
                'Power' => [
                    ['name' => 'Power', 'description' => 'Power issues identification, preventive measures, backup power systems (UPS, generators), and power conditioning solutions'],
                ],
                'Site Design' => [
                    ['name' => 'Site Design', 'description' => 'Site selection criteria, CPTED (Crime Prevention Through Environmental Design) principles, facility layout, and security zones'],
                ],
                'Environmental Controls' => [
                    ['name' => 'Environmental Controls', 'description' => 'HVAC systems, environmental monitoring, lighting design, surveillance systems, and environmental threat mitigation'],
                ],
            ],

            // Domain 18: Security Operations & Monitoring
            'Security Operations & Monitoring' => [
                'Security Operations Center (SOC)' => [
                    ['name' => 'Security Operations Center (SOC)', 'description' => 'SOC structure and organization, governance models, roles and responsibilities, operational workflows, and 24/7 operations management'],
                ],
                'Log Management' => [
                    ['name' => 'Log Management', 'description' => 'Log collection strategies, aggregation techniques, correlation analysis, log analysis tools, and retention policies'],
                ],
                'Detection' => [
                    ['name' => 'Detection', 'description' => 'Intrusion Detection/Prevention Systems (IDS/IPS), SIEM implementation, User and Entity Behavior Analytics (UEBA), and threat detection'],
                ],
                'Response' => [
                    ['name' => 'Response', 'description' => 'Security Orchestration, Automation and Response (SOAR), incident response procedures, threat containment, and automated response workflows'],
                ],
                'Monitoring' => [
                    ['name' => 'Monitoring', 'description' => 'Real-time monitoring strategies, alerting mechanisms, security metrics and KPIs, performance measurement, and continuous improvement'],
                ],
            ],

            // Domain 19: Incident Management
            'Incident Management' => [
                'Preparation' => [
                    ['name' => 'Preparation', 'description' => 'Incident response plan development, tools and resources preparation, team training, communication procedures, and stakeholder engagement'],
                ],
                'Detection, Triage & Analysis' => [
                    ['name' => 'Detection, Triage & Analysis', 'description' => 'Event identification and classification, incident severity assessment, technical analysis techniques, and evidence collection'],
                ],
                'Containment' => [
                    ['name' => 'Containment', 'description' => 'Short-term containment strategies, long-term containment planning, isolation techniques, and preventing incident spread'],
                ],
                'Eradication & Recovery' => [
                    ['name' => 'Eradication & Recovery', 'description' => 'System restoration procedures, vulnerability remediation, malware removal, validation testing, and return to normal operations'],
                ],
                'Post-Incident Activity' => [
                    ['name' => 'Post-Incident Activity', 'description' => 'Lessons learned sessions, incident documentation, root cause analysis, process improvement, and updating response procedures'],
                ],
            ],

            // Domain 20: Business Continuity & Disaster Recovery
            'Business Continuity & Disaster Recovery' => [
                'Business Impact Analysis (BIA)' => [
                    ['name' => 'Business Impact Analysis (BIA)', 'description' => 'Critical function identification, impact quantification, recovery objectives (RTO/RPO/MTD), and dependency mapping'],
                ],
                'Business Continuity Planning' => [
                    ['name' => 'Business Continuity Planning', 'description' => 'Emergency response procedures, alternate work arrangements, process continuity strategies, and crisis communications planning'],
                ],
                'Disaster Recovery' => [
                    ['name' => 'Disaster Recovery', 'description' => 'DR site types (hot/warm/cold), site selection criteria, cloud DR solutions, and reciprocal agreements'],
                ],
                'Recovery Strategy' => [
                    ['name' => 'Recovery Strategy', 'description' => '3-2-1 backup rule implementation, GFS rotation schemes, backup types (full/incremental/differential), and verification testing'],
                ],
                'Testing' => [
                    ['name' => 'Testing', 'description' => 'Testing methods (tabletop/walkthrough/simulation/full-scale), test documentation, continuous improvement, and lessons learned integration'],
                ],
            ],
        ];

        $createdCount = 0;

        // Process each domain
        foreach ($subtopicDefinitions as $domainName => $topicSubtopics) {
            $domain = DB::table('diagnostic_domains')
                ->where('name', $domainName)
                ->first();

            if (! $domain) {
                $this->command->warn("Domain not found: {$domainName}");

                continue;
            }

            // Get topics for this domain
            $topics = DB::table('diagnostic_topics')
                ->where('domain_id', $domain->id)
                ->get()
                ->keyBy('name');

            // Process each topic and its subtopics
            foreach ($topicSubtopics as $topicName => $subtopicList) {
                if (! isset($topics[$topicName])) {
                    $this->command->warn("Topic not found: {$topicName} in domain {$domainName}");

                    continue;
                }

                $topicId = $topics[$topicName]->id;

                // Insert subtopics for this topic
                foreach ($subtopicList as $index => $subtopicData) {
                    // Handle both array format (with description) and string format
                    if (is_array($subtopicData)) {
                        $subtopicName = $subtopicData['name'];
                        $subtopicDescription = $subtopicData['description'] ?? null;
                    } else {
                        // Legacy string format
                        $subtopicName = $subtopicData;
                        $subtopicDescription = null;
                    }

                    DB::table('diagnostic_subtopics')->insert([
                        'topic_id' => $topicId,
                        'name' => $subtopicName,
                        'description' => $subtopicDescription,
                        'sort_order' => $index + 1,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    $createdCount++;
                }
            }
        }

        $this->command->info("Diagnostic subtopics seeded successfully! Created {$createdCount} subtopics.");
    }
}
