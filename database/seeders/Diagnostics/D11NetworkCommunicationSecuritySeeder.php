<?php

namespace Database\Seeders\Diagnostics;

use App\Models\DiagnosticItem;
use App\Models\DiagnosticTopic;


use Illuminate\Database\Seeder;

class D11NetworkCommunicationSecuritySeeder extends Seeder
{
    public function run(): void
    {
        // Get reference data
        $topics = DiagnosticTopic::whereHas('domain', function($query) {
            $query->where('name', 'Network & Communication Security');
        })->pluck('id', 'name');
        
        
        $items = [
            // OSI & TCP/IP Models - Item 2
            [
                'topic_id' => $topics['OSI & TCP/IP Models'] ?? null,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'At which OSI layer does SSL/TLS operate?',
                'options' => [
                    'Transport Layer (Layer 4)',
                    'Session Layer (Layer 5)',
                    'Presentation Layer (Layer 6)',
                    'Application Layer (Layer 7)'
                ],
                'correct_options' => ['Presentation Layer (Layer 6)'],
                'justifications' => [
                    'SSL/TLS operates between transport and application layers',
                    'Session layer manages dialog control',
                    'Correct - SSL/TLS provides encryption services at the presentation layer',
                    'Application layer is where user applications operate'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            
            // Common Ports & Protocols - Item 3
            [
                'topic_id' => $topics['Common Ports & Protocols'] ?? null,
                'type_id' => 3,
                'dimension' => 'Technical',
                'content' => 'Select all secure protocol alternatives and their corresponding ports:',
                'options' => [
                    'HTTPS - 443',
                    'HTTP - 80',
                    'SSH - 22',
                    'Telnet - 23',
                    'SFTP - 22',
                    'FTP - 21',
                    'LDAPS - 636',
                    'LDAP - 389'
                ],
                'correct_options' => [
                    'HTTPS - 443',
                    'SSH - 22',
                    'SFTP - 22',
                    'LDAPS - 636'
                ],
                'justifications' => [
                    'HTTPS is the secure version of HTTP',
                    'HTTP is unencrypted',
                    'SSH provides secure remote access',
                    'Telnet is unencrypted',
                    'SFTP uses SSH for secure file transfer',
                    'FTP transmits in cleartext',
                    'LDAPS is LDAP over SSL/TLS',
                    'LDAP transmits in cleartext by default'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // DNS Security - Item 4
            [
                'topic_id' => $topics['DNS Security'] ?? null,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What is the primary purpose of DNSSEC?',
                'options' => [
                    'To encrypt DNS queries',
                    'To authenticate DNS responses',
                    'To prevent DNS tunneling',
                    'To cache DNS records'
                ],
                'correct_options' => ['To authenticate DNS responses'],
                'justifications' => [
                    'DNSSEC does not encrypt queries (DNS over HTTPS/TLS does)',
                    'Correct - DNSSEC provides origin authentication and data integrity',
                    'DNSSEC does not specifically prevent tunneling',
                    'Caching is a standard DNS function, not DNSSEC-specific'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Firewall & Proxy Types - Item 5
            [
                'topic_id' => $topics['Firewall & Proxy Types'] ?? null,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Which type of firewall can inspect encrypted HTTPS traffic?',
                'options' => [
                    'Packet filtering firewall',
                    'Stateful inspection firewall',
                    'Next-generation firewall (NGFW) with SSL inspection',
                    'Circuit-level gateway'
                ],
                'correct_options' => ['Next-generation firewall (NGFW) with SSL inspection'],
                'justifications' => [
                    'Packet filters only examine headers',
                    'Stateful firewalls track connections but cannot decrypt',
                    'Correct - NGFWs with SSL inspection can decrypt and inspect HTTPS',
                    'Circuit-level gateways work at session layer without content inspection'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            
            // Network Segmentation - Item 6
            [
                'topic_id' => $topics['Network Segmentation'] ?? null,
                'type_id' => 2,
                'dimension' => 'Technical',
                'content' => '**True or False:** A DMZ should be placed between two firewalls for optimal security.',
                'options' => [
                    'True',
                    'False'
                ],
                'correct_options' => ['True'],
                'justifications' => [
                    'explanation' => 'True - A DMZ is ideally placed between an external firewall (facing the internet) and an internal firewall (protecting the internal network), creating a screened subnet architecture that provides defense in depth.'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Wi-Fi Security - Item 8
            [
                'topic_id' => $topics['Wi-Fi Security'] ?? null,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What is the main security improvement of WPA3 over WPA2?',
                'options' => [
                    'Faster encryption algorithms',
                    'Simultaneous Authentication of Equals (SAE)',
                    'Support for more devices',
                    'Backward compatibility with WEP'
                ],
                'correct_options' => ['Simultaneous Authentication of Equals (SAE)'],
                'justifications' => [
                    'WPA3 does not necessarily use faster algorithms',
                    'Correct - SAE replaces PSK and protects against offline dictionary attacks',
                    'Device support is not the main security improvement',
                    'WPA3 does not support WEP for security reasons'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            
            // Network Attacks - Item 9
            [
                'topic_id' => $topics['Network Attacks'] ?? null,
                'type_id' => 3,
                'dimension' => 'Technical',
                'content' => 'Which of the following are examples of Layer 2 attacks?',
                'options' => [
                    'ARP spoofing',
                    'SQL injection',
                    'MAC flooding',
                    'DNS poisoning',
                    'VLAN hopping',
                    'SYN flood',
                    'DHCP starvation'
                ],
                'correct_options' => [
                    'ARP spoofing',
                    'MAC flooding',
                    'VLAN hopping',
                    'DHCP starvation'
                ],
                'justifications' => [
                    'ARP operates at Layer 2',
                    'SQL injection is an application layer attack',
                    'MAC flooding targets switch CAM tables',
                    'DNS operates at the application layer',
                    'VLAN hopping exploits Layer 2 VLAN configurations',
                    'SYN flood is a Layer 4 (TCP) attack',
                    'DHCP starvation attacks Layer 2 DHCP services'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            
            // Network Scanning & Recon Tools - Item 10
            [
                'topic_id' => $topics['Network Scanning & Recon Tools'] ?? null,
                'type_id' => 7,
                'dimension' => 'Technical',
                'content' => 'Write an nmap command to perform a SYN scan on ports 80 and 443 of the 192.168.1.0/24 network:',
                'options' => [
                    'nmap -sS -p 80,443 192.168.1.0/24',
                    'nmap -sT -p 80,443 192.168.1.0/24',
                    'nmap -sS -p80,443 192.168.1.0/24',
                    'nmap -p 80,443 192.168.1.0/24'
                ],
                'correct_options' => [
                    'nmap -sS -p 80,443 192.168.1.0/24',
                    'nmap -sS -p80,443 192.168.1.0/24',
                    'nmap -sS --ports 80,443 192.168.1.0/24'
                ],
                'justifications' => [
                    'Correct syntax with proper spacing',
                    'Also correct - no space after -p is acceptable',
                    'Alternative syntax using --ports'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            
            // DNS Security - Item 12
            [
                'topic_id' => $topics['DNS Security'] ?? null,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Which DNS record type is commonly exploited for DDoS amplification attacks?',
                'options' => [
                    'A record',
                    'MX record',
                    'ANY record',
                    'CNAME record'
                ],
                'correct_options' => ['ANY record'],
                'justifications' => [
                    'A records return single IP addresses',
                    'MX records return mail server information',
                    'Correct - ANY queries return all records, creating large responses for amplification',
                    'CNAME records return canonical names'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            
            // Firewall & Proxy Types - Item 13
            [
                'topic_id' => $topics['Firewall & Proxy Types'] ?? null,
                'type_id' => 3,
                'dimension' => 'Technical',
                'content' => 'Select the characteristics of a Web Application Firewall (WAF):',
                'options' => [
                    'Protects against OWASP Top 10 vulnerabilities',
                    'Operates at Layer 7',
                    'Can block based on packet headers only',
                    'Inspects HTTP/HTTPS traffic content',
                    'Replaces the need for network firewalls',
                    'Can detect SQL injection attempts',
                    'Provides DDoS protection at all layers'
                ],
                'correct_options' => [
                    'Protects against OWASP Top 10 vulnerabilities',
                    'Operates at Layer 7',
                    'Inspects HTTP/HTTPS traffic content',
                    'Can detect SQL injection attempts'
                ],
                'justifications' => [
                    'WAFs are designed to protect against web application attacks',
                    'WAFs operate at the application layer',
                    'WAFs inspect content, not just headers',
                    'WAFs analyze HTTP/HTTPS payloads',
                    'WAFs complement but do not replace network firewalls',
                    'SQL injection detection is a core WAF capability',
                    'WAFs primarily provide Layer 7 DDoS protection'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Network Segmentation - Item 14
            [
                'topic_id' => $topics['Network Segmentation'] ?? null,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What is the primary security benefit of implementing VLANs?',
                'options' => [
                    'Increased network speed',
                    'Logical separation of network segments',
                    'Encryption of network traffic',
                    'Automatic malware detection'
                ],
                'correct_options' => ['Logical separation of network segments'],
                'justifications' => [
                    'VLANs may reduce broadcast traffic but speed is not the primary security benefit',
                    'Correct - VLANs provide logical segmentation to isolate different network segments',
                    'VLANs do not provide encryption',
                    'VLANs do not detect malware'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            
            // Virtual Private Network (VPN) - Item 15
            [
                'topic_id' => $topics['Virtual Private Network (VPN)'] ?? null,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'In IPsec, what does ESP provide that AH does not?',
                'options' => [
                    'Authentication',
                    'Integrity',
                    'Confidentiality',
                    'Non-repudiation'
                ],
                'correct_options' => ['Confidentiality'],
                'justifications' => [
                    'Both AH and ESP provide authentication',
                    'Both provide integrity checking',
                    'Correct - ESP encrypts payload for confidentiality, AH does not',
                    'Neither provides true non-repudiation'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Common Ports & Protocols - Item 16
            [
                'topic_id' => $topics['Common Ports & Protocols'] ?? null,
                'type_id' => 7,
                'dimension' => 'Technical',
                'content' => 'Write a tcpdump command to capture only HTTPS traffic on interface eth0:',
                'options' => [
                    'tcpdump -i eth0 port 443',
                    'tcpdump -i eth0 port 80',
                    'tcpdump -i eth0 tcp port 443',
                    'tcpdump eth0 port 443'
                ],
                'correct_options' => [
                    'tcpdump -i eth0 port 443',
                    'tcpdump -i eth0 tcp port 443',
                    'tcpdump -i eth0 \'tcp port 443\''
                ],
                'justifications' => [
                    'Basic syntax capturing port 443',
                    'More specific, capturing only TCP traffic on port 443',
                    'With quotes for shell compatibility'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            
            // DNS Security - Item 19
            [
                'topic_id' => $topics['DNS Security'] ?? null,
                'type_id' => 2,
                'dimension' => 'Technical',
                'content' => '**True or False:** DNS over HTTPS (DoH) prevents ISPs from seeing which websites you visit.',
                'options' => [
                    'True',
                    'False'
                ],
                'correct_options' => ['False'],
                'justifications' => [
                    'explanation' => 'False - While DoH encrypts DNS queries, ISPs can still see the destination IP addresses and SNI (Server Name Indication) in TLS handshakes, which reveal the websites being visited. DoH only prevents ISPs from seeing DNS queries themselves.'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 5,
                'status' => 'published'
            ],
            
            // Firewall & Proxy Types - Item 20
            [
                'topic_id' => $topics['Firewall & Proxy Types'] ?? null,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What is the main advantage of a reverse proxy over a forward proxy?',
                'options' => [
                    'Hides internal clients from the internet',
                    'Provides load balancing for backend servers',
                    'Filters outbound traffic',
                    'Caches frequently accessed websites'
                ],
                'correct_options' => ['Provides load balancing for backend servers'],
                'justifications' => [
                    'Forward proxies hide internal clients',
                    'Correct - Reverse proxies can distribute load across multiple backend servers',
                    'Forward proxies filter outbound traffic',
                    'Forward proxies typically cache content for clients'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            
            // OSI & TCP/IP Models - Item 22
            [
                'topic_id' => $topics['OSI & TCP/IP Models'] ?? null,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Which layer is responsible for end-to-end error recovery and flow control?',
                'options' => [
                    'Network Layer',
                    'Transport Layer',
                    'Session Layer',
                    'Data Link Layer'
                ],
                'correct_options' => ['Transport Layer'],
                'justifications' => [
                    'Network layer handles routing and addressing',
                    'Correct - Transport layer (Layer 4) provides end-to-end error recovery and flow control',
                    'Session layer manages dialog control',
                    'Data link layer provides node-to-node error detection'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Virtual Private Network (VPN) - Item 23
            [
                'topic_id' => $topics['Virtual Private Network (VPN)'] ?? null,
                'type_id' => 3,
                'dimension' => 'Technical',
                'content' => 'Select the components required for an IPsec VPN connection:',
                'options' => [
                    'Security Association (SA)',
                    'Internet Key Exchange (IKE)',
                    'Public key certificate',
                    'Pre-shared key or certificates',
                    'SSL certificate',
                    'Security Parameter Index (SPI)',
                    'RADIUS server'
                ],
                'correct_options' => [
                    'Security Association (SA)',
                    'Internet Key Exchange (IKE)',
                    'Pre-shared key or certificates',
                    'Security Parameter Index (SPI)'
                ],
                'justifications' => [
                    'SA defines the security parameters for the connection',
                    'IKE negotiates the security associations',
                    'Not specifically required for IPsec',
                    'Authentication requires either PSK or certificates',
                    'SSL certificates are for SSL/TLS VPNs',
                    'SPI identifies specific security associations',
                    'RADIUS is optional for user authentication'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            
            // Network Segmentation - Item 24
            [
                'topic_id' => $topics['Network Segmentation'] ?? null,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What is the primary purpose of a bastion host?',
                'options' => [
                    'To provide redundant network connectivity',
                    'To serve as a hardened gateway for external access',
                    'To perform network address translation',
                    'To cache frequently accessed content'
                ],
                'correct_options' => ['To serve as a hardened gateway for external access'],
                'justifications' => [
                    'Bastion hosts are not for redundancy',
                    'Correct - Bastion hosts are hardened systems that provide controlled access from untrusted networks',
                    'NAT is typically a firewall function',
                    'Content caching is a proxy function'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Wi-Fi Security - Item 25
            [
                'topic_id' => $topics['Wi-Fi Security'] ?? null,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Which attack exploits the four-way handshake in WPA2?',
                'options' => [
                    'Evil twin attack',
                    'KRACK attack',
                    'Fragmentation attack',
                    'Deauthentication attack'
                ],
                'correct_options' => ['KRACK attack'],
                'justifications' => [
                    'Evil twin is a rogue access point attack',
                    'Correct - Key Reinstallation Attack (KRACK) exploits the WPA2 four-way handshake',
                    'Fragmentation attacks target WEP',
                    'Deauth attacks force disconnection but do not exploit the handshake'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            
            // Network Attacks - Item 26
            [
                'topic_id' => $topics['Network Attacks'] ?? null,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Which type of DDoS attack exhausts server resources by opening many half-open connections?',
                'options' => [
                    'UDP flood',
                    'SYN flood',
                    'HTTP flood',
                    'Amplification attack'
                ],
                'correct_options' => ['SYN flood'],
                'justifications' => [
                    'UDP floods overwhelm with UDP packets',
                    'Correct - SYN flood attacks leave many half-open TCP connections',
                    'HTTP floods use complete HTTP requests',
                    'Amplification attacks use response size differences'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // DNS Security - Item 27
            [
                'topic_id' => $topics['DNS Security'] ?? null,
                'type_id' => 3,
                'dimension' => 'Technical',
                'content' => 'Which DNS security measures help prevent cache poisoning?',
                'options' => [
                    'DNSSEC validation',
                    'DNS over HTTPS',
                    'Source port randomization',
                    'Limiting zone transfers',
                    'Transaction ID randomization',
                    'Reverse DNS lookups',
                    'Response rate limiting'
                ],
                'correct_options' => [
                    'DNSSEC validation',
                    'Source port randomization',
                    'Transaction ID randomization'
                ],
                'justifications' => [
                    'DNSSEC provides cryptographic validation of responses',
                    'DoH encrypts queries but does not prevent poisoning',
                    'Port randomization makes spoofing harder',
                    'Zone transfer limits prevent data exposure, not poisoning',
                    'Random transaction IDs prevent predictable spoofing',
                    'Reverse lookups do not prevent poisoning',
                    'Rate limiting prevents DoS, not poisoning'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            
            // Common Ports & Protocols - Item 28
            [
                'topic_id' => $topics['Common Ports & Protocols'] ?? null,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Which protocol uses UDP port 514 by default?',
                'options' => [
                    'SNMP',
                    'Syslog',
                    'TFTP',
                    'NTP'
                ],
                'correct_options' => ['Syslog'],
                'justifications' => [
                    'SNMP uses UDP 161/162',
                    'Correct - Traditional syslog uses UDP 514',
                    'TFTP uses UDP 69',
                    'NTP uses UDP 123'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            
            // Firewall & Proxy Types - Item 29
            [
                'topic_id' => $topics['Firewall & Proxy Types'] ?? null,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What distinguishes a Unified Threat Management (UTM) device from a traditional firewall?',
                'options' => [
                    'Higher throughput',
                    'Integration of multiple security functions',
                    'Lower cost',
                    'Cloud-based management only'
                ],
                'correct_options' => ['Integration of multiple security functions'],
                'justifications' => [
                    'UTMs may have lower throughput due to multiple functions',
                    'Correct - UTMs combine firewall, IPS, antivirus, content filtering, etc.',
                    'UTMs are typically more expensive than basic firewalls',
                    'UTMs can be managed on-premises or in the cloud'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Network Scanning & Recon Tools - Item 30
            [
                'topic_id' => $topics['Network Scanning & Recon Tools'] ?? null,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Which nmap scan type is most likely to evade basic firewall detection?',
                'options' => [
                    'TCP connect scan (-sT)',
                    'SYN stealth scan (-sS)',
                    'UDP scan (-sU)',
                    'FIN scan (-sF)'
                ],
                'correct_options' => ['FIN scan (-sF)'],
                'justifications' => [
                    'TCP connect completes the handshake and is easily detected',
                    'SYN scans are common and often logged',
                    'UDP scans are slow and often detected',
                    'Correct - FIN scans send only FIN packets which may bypass simple firewalls'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 5,
                'status' => 'published'
            ],
            
            // Virtual Private Network (VPN) - Item 32
            [
                'topic_id' => $topics['Virtual Private Network (VPN)'] ?? null,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What is Perfect Forward Secrecy (PFS) in VPN connections?',
                'options' => [
                    'Encryption that cannot be broken',
                    'New encryption keys for each session',
                    'Automatic failover to backup VPN',
                    'Prevention of man-in-the-middle attacks'
                ],
                'correct_options' => ['New encryption keys for each session'],
                'justifications' => [
                    'No encryption is perfect or unbreakable',
                    'Correct - PFS ensures compromise of one session key does not affect others',
                    'PFS is not about failover',
                    'PFS does not specifically prevent MITM attacks'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            
            // Network Segmentation - Item 33
            [
                'topic_id' => $topics['Network Segmentation'] ?? null,
                'type_id' => 2,
                'dimension' => 'Technical',
                'content' => '**True or False:** Microsegmentation requires physical network separation.',
                'options' => [
                    'True',
                    'False'
                ],
                'correct_options' => ['False'],
                'justifications' => [
                    'explanation' => 'False - Microsegmentation uses software-defined networking (SDN) and virtual firewalls to create granular security zones without requiring physical separation. It can be implemented entirely through logical controls.'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            
            // Wi-Fi Security - Item 34
            [
                'topic_id' => $topics['Wi-Fi Security'] ?? null,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What is the purpose of Protected Management Frames (PMF) in wireless security?',
                'options' => [
                    'Encrypt user data',
                    'Prevent deauthentication attacks',
                    'Increase wireless range',
                    'Enable faster roaming'
                ],
                'correct_options' => ['Prevent deauthentication attacks'],
                'justifications' => [
                    'Regular encryption handles user data',
                    'Correct - PMF protects management frames from spoofing and injection',
                    'PMF does not affect range',
                    'PMF is not related to roaming speed'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Network Attacks - Item 35
            [
                'topic_id' => $topics['Network Attacks'] ?? null,
                'type_id' => 3,
                'dimension' => 'Technical',
                'content' => 'Which techniques can be used to mitigate DDoS attacks?',
                'options' => [
                    'Rate limiting',
                    'Blackhole routing',
                    'Increasing MTU size',
                    'Anycast networking',
                    'Disabling all logging',
                    'SYN cookies',
                    'Reducing TTL values'
                ],
                'correct_options' => [
                    'Rate limiting',
                    'Blackhole routing',
                    'Anycast networking',
                    'SYN cookies'
                ],
                'justifications' => [
                    'Rate limiting prevents resource exhaustion',
                    'Blackhole routing diverts attack traffic',
                    'Larger MTU does not help with DDoS',
                    'Anycast distributes traffic across multiple servers',
                    'Logging helps identify attacks',
                    'SYN cookies prevent SYN flood attacks',
                    'TTL changes do not mitigate DDoS'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // DNS Security - Item 36
            [
                'topic_id' => $topics['DNS Security'] ?? null,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What type of DNS query receives the full answer from each DNS server in the resolution chain?',
                'options' => [
                    'Recursive query',
                    'Iterative query',
                    'Inverse query',
                    'Zone transfer query'
                ],
                'correct_options' => ['Recursive query'],
                'justifications' => [
                    'Correct - Recursive queries require the DNS server to provide a complete answer',
                    'Iterative queries return referrals to other DNS servers',
                    'Inverse queries map IP addresses to names',
                    'Zone transfers replicate entire DNS zones'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            
            // Common Ports & Protocols - Item 37
            [
                'topic_id' => $topics['Common Ports & Protocols'] ?? null,
                'type_id' => 5,
                'dimension' => 'Technical',
                'content' => 'Match the protocols with their default ports:',
                'options' => [
                    'RDP' => '3389',
                    'SMTP' => '25',
                    'IMAP' => '143',
                    'SNMP' => '161'
                ],
                'correct_options' => [
                    'RDP' => '3389',
                    'SMTP' => '25',
                    'IMAP' => '143',
                    'SNMP' => '161'
                ],
                'justifications' => ['Each protocol uses its standard assigned port for default communications'],
                'difficulty_level' => 1,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            
            // Firewall & Proxy Types - Item 38
            [
                'topic_id' => $topics['Firewall & Proxy Types'] ?? null,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Which firewall type maintains a state table of active connections?',
                'options' => [
                    'Packet filtering firewall',
                    'Stateful inspection firewall',
                    'Application proxy firewall',
                    'Circuit-level gateway'
                ],
                'correct_options' => ['Stateful inspection firewall'],
                'justifications' => [
                    'Packet filters examine packets independently',
                    'Correct - Stateful firewalls track connection states',
                    'Application proxies work at Layer 7',
                    'Circuit gateways work at session layer'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            
            // Network Scanning & Recon Tools - Item 39
            [
                'topic_id' => $topics['Network Scanning & Recon Tools'] ?? null,
                'type_id' => 7,
                'dimension' => 'Technical',
                'content' => 'Write a dig command to query the MX records for example.com using Google\'s DNS server:',
                'options' => [
                    'dig @8.8.8.8 example.com MX',
                    'dig @8.8.8.8 example.com',
                    'dig example.com MX @8.8.8.8',
                    'dig MX example.com @8.8.8.8'
                ],
                'correct_options' => [
                    'dig @8.8.8.8 example.com MX',
                    'dig @8.8.8.8 MX example.com',
                    'dig example.com MX @8.8.8.8'
                ],
                'justifications' => [
                    'Standard format: server, domain, record type',
                    'Alternative format with record type before domain',
                    'Server specification can come at the end'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            
            // OSI & TCP/IP Models - Item 40
            [
                'topic_id' => $topics['OSI & TCP/IP Models'] ?? null,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'At which layer does ARP (Address Resolution Protocol) operate?',
                'options' => [
                    'Physical Layer',
                    'Data Link Layer',
                    'Network Layer',
                    'Transport Layer'
                ],
                'correct_options' => ['Data Link Layer'],
                'justifications' => [
                    'Physical layer deals with bits and signals',
                    'Correct - ARP operates at Layer 2 to map IP addresses to MAC addresses',
                    'Network layer uses the ARP results but ARP itself is Layer 2',
                    'Transport layer is too high for address resolution'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            
            // Network Segmentation - Item 42
            [
                'topic_id' => $topics['Network Segmentation'] ?? null,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What is the recommended practice for VLAN 1 in network security?',
                'options' => [
                    'Use it for all management traffic',
                    'Assign all ports to VLAN 1',
                    'Avoid using VLAN 1 for any traffic',
                    'Use it only for guest access'
                ],
                'correct_options' => ['Avoid using VLAN 1 for any traffic'],
                'justifications' => [
                    'Management traffic should use a dedicated VLAN',
                    'All ports in VLAN 1 is a security risk',
                    'Correct - VLAN 1 is the default and should be avoided for security',
                    'Guest access should use an isolated VLAN'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            
            // Wi-Fi Security - Item 43
            [
                'topic_id' => $topics['Wi-Fi Security'] ?? null,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Which EAP method provides mutual authentication without requiring client certificates?',
                'options' => [
                    'EAP-TLS',
                    'EAP-TTLS',
                    'EAP-MD5',
                    'LEAP'
                ],
                'correct_options' => ['EAP-TTLS'],
                'justifications' => [
                    'EAP-TLS requires client certificates',
                    'Correct - EAP-TTLS only requires server certificates',
                    'EAP-MD5 provides no mutual authentication',
                    'LEAP is proprietary and has known vulnerabilities'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            
            // Network Attacks - Item 44
            [
                'topic_id' => $topics['Network Attacks'] ?? null,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What is a "slow loris" attack designed to do?',
                'options' => [
                    'Slowly exfiltrate data to avoid detection',
                    'Keep server connections open with minimal data',
                    'Gradually increase CPU usage',
                    'Slowly scan ports to evade IDS'
                ],
                'correct_options' => ['Keep server connections open with minimal data'],
                'justifications' => [
                    'Slow loris is not about data exfiltration',
                    'Correct - Slow loris exhausts server connections by keeping them open',
                    'It targets connections, not CPU',
                    'It is an attack, not a scanning technique'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // DNS Security - Item 45
            [
                'topic_id' => $topics['DNS Security'] ?? null,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Which DNS record type is used to prevent email spoofing?',
                'options' => [
                    'A record',
                    'PTR record',
                    'SPF record',
                    'NS record'
                ],
                'correct_options' => ['SPF record'],
                'justifications' => [
                    'A records map names to IP addresses',
                    'PTR records provide reverse DNS lookup',
                    'Correct - SPF (Sender Policy Framework) records specify authorized mail servers',
                    'NS records identify name servers'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            
            // Network Protocol Analysis - Item 46 (Bloom 3)
            [
                'topic_id' => $topics['Network Scanning & Recon Tools'] ?? null,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'When analyzing network traffic, what does a high volume of ICMP Type 3 messages typically indicate?',
                'options' => [
                    'Normal network connectivity',
                    'Port scanning or filtering activity',
                    'DNS resolution issues',
                    'Time synchronization problems'
                ],
                'correct_options' => ['Port scanning or filtering activity'],
                'justifications' => [
                    'High ICMP Type 3 volumes are unusual',
                    'Correct - ICMP Type 3 (Destination Unreachable) often indicates blocked connections',
                    'DNS issues produce different error patterns',
                    'Time sync uses NTP, not ICMP Type 3'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Advanced VPN Configuration - Item 47 (Bloom 3)
            [
                'topic_id' => $topics['Virtual Private Network (VPN)'] ?? null,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'In a site-to-site VPN implementation, which configuration prevents split tunneling?',
                'options' => [
                    'Enabling NAT traversal',
                    'Forcing all traffic through the VPN tunnel',
                    'Using dynamic IP addresses',
                    'Implementing IKE version 2'
                ],
                'correct_options' => ['Forcing all traffic through the VPN tunnel'],
                'justifications' => [
                    'NAT traversal helps with connectivity, not split tunneling',
                    'Correct - Forcing all traffic through the tunnel prevents local internet access',
                    'IP addressing does not affect split tunneling',
                    'IKE version affects key exchange, not split tunneling'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Firewall Rule Optimization - Item 48 (Bloom 3)
            [
                'topic_id' => $topics['Firewall & Proxy Types'] ?? null,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'How should firewall rules be ordered for optimal performance and security?',
                'options' => [
                    'Most specific rules first, then general rules',
                    'Allow rules first, then deny rules',
                    'Alphabetically by rule name',
                    'By port number in ascending order'
                ],
                'correct_options' => ['Most specific rules first, then general rules'],
                'justifications' => [
                    'Correct - Specific rules should be processed before general ones',
                    'Rule type ordering is less important than specificity',
                    'Alphabetical ordering provides no optimization',
                    'Port number ordering is not optimal'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            
            // Network Security Monitoring - Item 49 (Bloom 3)
            [
                'topic_id' => $topics['Network Attacks'] ?? null,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What network behavior pattern suggests a potential data exfiltration attempt?',
                'options' => [
                    'High inbound traffic during business hours',
                    'Large outbound transfers during off-hours',
                    'Frequent DNS queries',
                    'Multiple failed login attempts'
                ],
                'correct_options' => ['Large outbound transfers during off-hours'],
                'justifications' => [
                    'Inbound traffic is normal during business hours',
                    'Correct - Unusual outbound traffic patterns may indicate data theft',
                    'DNS queries are normal network activity',
                    'Failed logins suggest authentication attacks, not exfiltration'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            
            // Wi-Fi Attack Vectors - Item 50 (Bloom 3)
            [
                'topic_id' => $topics['Wi-Fi Security'] ?? null,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What makes a WPS PIN attack effective against wireless networks?',
                'options' => [
                    'WPS PINs are transmitted in plaintext',
                    'WPS PINs have limited entropy and poor randomization',
                    'WPS PINs never change',
                    'WPS PINs are based on MAC addresses'
                ],
                'correct_options' => ['WPS PINs have limited entropy and poor randomization'],
                'justifications' => [
                    'WPS PINs are not transmitted in plaintext',
                    'Correct - 8-digit PINs with checksum effectively become 7-digit brute force',
                    'Some WPS implementations do change PINs',
                    'PINs are not directly based on MAC addresses'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Network Forensics - Item 51 (Bloom 4)
            [
                'topic_id' => $topics['Network Scanning & Recon Tools'] ?? null,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'When investigating a security incident, what TCP flag combination indicates a possible port scan?',
                'options' => [
                    'SYN flag only',
                    'FIN, URG, and PSH flags set',
                    'All flags set (XMAS scan)',
                    'RST and ACK flags set'
                ],
                'correct_options' => ['All flags set (XMAS scan)'],
                'justifications' => [
                    'SYN only is normal connection establishment',
                    'FIN+URG+PSH is unusual but not a common scan type',
                    'Correct - XMAS scan sets all flags and is clearly abnormal',
                    'RST+ACK is a normal response to invalid connections'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            
            // Advanced Network Segmentation - Item 52 (Bloom 4)
            [
                'topic_id' => $topics['Network Segmentation'] ?? null,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Which segmentation approach provides the strongest isolation for critical systems?',
                'options' => [
                    'VLAN separation with ACLs',
                    'Physical network separation',
                    'Software-defined perimeter (SDP)',
                    'Virtual routing and forwarding (VRF)'
                ],
                'correct_options' => ['Physical network separation'],
                'justifications' => [
                    'VLANs provide logical separation but share infrastructure',
                    'Correct - Physical separation provides complete isolation',
                    'SDP provides strong isolation but shares some infrastructure',
                    'VRF provides logical separation within routing infrastructure'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            
            // Security Architecture Evaluation - Item 53 (Bloom 5)
            [
                'topic_id' => $topics['Network Segmentation'] ?? null,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Evaluate this network design: "Place all servers in a DMZ with a single firewall." What is the primary weakness?',
                'options' => [
                    'Insufficient encryption',
                    'Lack of defense in depth',
                    'Poor access control',
                    'Inadequate monitoring'
                ],
                'correct_options' => ['Lack of defense in depth'],
                'justifications' => [
                    'Encryption is application-level, not network design',
                    'Correct - Single firewall creates single point of failure',
                    'Access control is implemented at application level',
                    'Monitoring is operational, not architectural'
                ],
                'difficulty_level' => 4,
                'bloom_level' => 5,
                'status' => 'published'
            ],
            
            // Network Protocol Security Analysis - Item 54 (Bloom 5)
            [
                'topic_id' => $topics['Common Ports & Protocols'] ?? null,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Assess the security implications of implementing IPv6 dual-stack in an enterprise environment:',
                'options' => [
                    'IPv6 is inherently more secure than IPv4',
                    'Dual-stack increases attack surface and complexity',
                    'IPv6 eliminates the need for NAT security',
                    'Dual-stack provides redundancy with no security impact'
                ],
                'correct_options' => ['Dual-stack increases attack surface and complexity'],
                'justifications' => [
                    'IPv6 has different but not inherently better security',
                    'Correct - Two protocol stacks mean more potential vulnerabilities',
                    'IPv6 end-to-end connectivity can reduce NAT security benefits',
                    'Security complexity increases with dual implementation'
                ],
                'difficulty_level' => 4,
                'bloom_level' => 5,
                'status' => 'published'
            ],
            
            // VPN Security Architecture - Item 55 (Bloom 5)
            [
                'topic_id' => $topics['Virtual Private Network (VPN)'] ?? null,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Evaluate the trade-offs between SSL VPN and IPsec VPN for remote workforce security:',
                'options' => [
                    'SSL VPN is always more secure than IPsec',
                    'IPsec provides better performance but SSL VPN offers easier deployment',
                    'Both provide equivalent security when properly configured',
                    'SSL VPN eliminates the need for endpoint security'
                ],
                'correct_options' => ['IPsec provides better performance but SSL VPN offers easier deployment'],
                'justifications' => [
                    'Security depends on implementation, not protocol choice',
                    'Correct - IPsec is more efficient but SSL VPN is more accessible',
                    'While both can be secure, they have different characteristics',
                    'SSL VPN still requires endpoint security measures'
                ],
                'difficulty_level' => 4,
                'bloom_level' => 5,
                'status' => 'published'
            ],
            
            // DNS Security Strategy - Item 56 (Bloom 5)
            [
                'topic_id' => $topics['DNS Security'] ?? null,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Assess the most effective DNS security strategy for preventing data exfiltration via DNS tunneling:',
                'options' => [
                    'Implement DNS over HTTPS exclusively',
                    'Monitor DNS query patterns and payload sizes',
                    'Use only internal DNS servers',
                    'Block all DNS queries except A and AAAA records'
                ],
                'correct_options' => ['Monitor DNS query patterns and payload sizes'],
                'justifications' => [
                    'DoH can actually facilitate tunneling by encrypting queries',
                    'Correct - Anomalous patterns indicate potential tunneling',
                    'Internal DNS still requires external resolution',
                    'Blocking record types may break legitimate functionality'
                ],
                'difficulty_level' => 4,
                'bloom_level' => 5,
                'status' => 'published'
            ],
            
            // Network Attack Attribution - Item 57 (Bloom 5)
            [
                'topic_id' => $topics['Network Attacks'] ?? null,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'When analyzing a sophisticated network attack, which factor is most reliable for attribution?',
                'options' => [
                    'Source IP addresses',
                    'Attack timing patterns',
                    'Unique attack signatures and TTPs',
                    'Geographic location of traffic'
                ],
                'correct_options' => ['Unique attack signatures and TTPs'],
                'justifications' => [
                    'IP addresses are easily spoofed or compromised',
                    'Timing can be manipulated or coincidental',
                    'Correct - Tactics, Techniques, and Procedures are harder to fake',
                    'Geographic data can be misleading due to proxies/VPNs'
                ],
                'difficulty_level' => 4,
                'bloom_level' => 5,
                'status' => 'published'
            ],
            
            // Wireless Security Implementation - Item 58 (Bloom 5)
            [
                'topic_id' => $topics['Wi-Fi Security'] ?? null,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Evaluate the best approach for securing IoT devices on a corporate wireless network:',
                'options' => [
                    'Use WPA3-Personal for all IoT devices',
                    'Implement device certificates with EAP-TLS',
                    'Create an isolated VLAN with 802.1X device authentication',
                    'Use MAC address filtering exclusively'
                ],
                'correct_options' => ['Create an isolated VLAN with 802.1X device authentication'],
                'justifications' => [
                    'WPA3-Personal uses shared keys, not ideal for enterprise',
                    'Device certificates are complex for resource-constrained IoT',
                    'Correct - Isolation plus device authentication provides best balance',
                    'MAC filtering is easily bypassed and not scalable'
                ],
                'difficulty_level' => 4,
                'bloom_level' => 3,
                'status' => 'published'
            ]
        ];

        // Insert items
        foreach ($items as $item) {
            if ($item['topic_id']) {
                DiagnosticItem::create($item);
            }
        }
        
        $this->command->info('Domain 11 (Network & Communication Security) diagnostic items seeded successfully!');
    }
}