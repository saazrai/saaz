<?php

namespace Database\Seeders\Diagnostics;

class D12NetworkSecuritySeeder extends BaseDiagnosticSeeder
{
    protected string $domainName = 'Network Security';

    protected function getQuestions(): array
    {
        return [
            // Topic 1: Network Security Protocols (10 questions)
            // Bloom Distribution: L1:1, L2:2, L3:3, L4:2, L5:2

            // Item 1 - L1 - Remember
            [
                'topic' => 'Network Security Protocols',
                'subtopic' => 'Security Protocols',
                'question' => 'Which component of TLS ensures the confidentiality of transmitted data?',
                'options' => [
                    'Session Key',
                    'Digital Certificate',
                    'Message Digest',
                    'Public Key',
                ],
                'correct_options' => ['Session Key'],
                'justifications' => [
                    'Correct - The session key (also called symmetric key) is generated during the TLS handshake and is used to encrypt and decrypt the actual data transmitted between client and server. This symmetric encryption using the session key provides confidentiality by ensuring that intercepted data cannot be read without the key. The session key is unique for each TLS session and provides efficient encryption/decryption of large amounts of data.',
                    'Incorrect - Digital certificates are used for authentication and establishing trust between parties during the TLS handshake. While certificates contain public keys and verify identity, they do not directly encrypt the transmitted data. Certificates help establish secure communication but the actual data confidentiality is provided by symmetric encryption using session keys.',
                    'Incorrect - Message digests (hashes) are used to ensure data integrity, not confidentiality. They create a fixed-size fingerprint of data that can detect if information has been modified during transmission. While important for security, message digests do not encrypt data or provide confidentiality - they only verify that data has not been tampered with.',
                    'Incorrect - Public keys are used during the initial TLS handshake for key exchange and authentication, but not for encrypting the actual transmitted data. Public key cryptography is computationally expensive and unsuitable for encrypting large amounts of data. Instead, public keys help securely exchange the session keys that will be used for symmetric encryption of the transmitted data.',
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
                'topic' => 'Network Security Protocols',
                'subtopic' => 'Security Protocols',
                'question' => 'In transport mode, the use of the Encapsulating Security Payload (ESP) protocol is advantageous over the Authentication Header (AH) protocol because it provides:',
                'options' => [
                    'data integrity.',
                    'data origin authentication.',
                    'anti-replay service.',
                    'confidentiality.',
                ],
                'correct_options' => ['confidentiality.'],
                'justifications' => [
                    'Incorrect - Both ESP and AH protocols provide data integrity through cryptographic checksums and hash functions. This is not a distinguishing advantage of ESP over AH, as AH also ensures that data has not been modified in transit through integrity verification mechanisms.',
                    'Incorrect - Both ESP and AH protocols provide data origin authentication, which verifies that the data actually came from the claimed sender. This authentication capability is available in both protocols and is not unique to ESP, so it does not represent an advantage of ESP over AH.',
                    'Incorrect - Both ESP and AH protocols provide anti-replay service through sequence numbers that prevent attackers from capturing and replaying packets. This protection against replay attacks is a standard feature of both protocols and does not distinguish ESP from AH.',
                    'Correct - Confidentiality (encryption) is the key advantage that ESP provides over AH. While AH only provides authentication and integrity without encrypting the actual data payload, ESP encrypts the data payload to ensure confidentiality. This means that even if packets are intercepted, the actual data content remains protected and unreadable to unauthorized parties, which is a critical security benefit that AH cannot provide.',
                ],
                'bloom_level' => 1,
                'difficulty_level' => 3,
                'status' => 'published',
                'type_id' => 1,
                'irt_a' => 1.2,
                'irt_b' => -0.5,
                'irt_c' => 0.25,
            ],

            // Item 3 - L2 - Understand
            [
                'topic' => 'Network Security Protocols',
                'subtopic' => 'Security Protocols',
                'question' => 'Why is TLS preferred over SSL in modern secure communications?',
                'options' => [
                    'TLS is compatible with UDP',
                    'TLS uses symmetric-only encryption',
                    'SSL is deprecated due to known vulnerabilities',
                    'SSL supports perfect forward secrecy',
                ],
                'correct_options' => ['SSL is deprecated due to known vulnerabilities'],
                'justifications' => [
                    'Incorrect - TLS compatibility with UDP is not the primary reason for its preference over SSL. While some TLS implementations can work with UDP (like DTLS - Datagram TLS), both TLS and SSL were originally designed for TCP-based connections. The transportation protocol compatibility is not the key differentiator that makes TLS preferred.',
                    'Incorrect - TLS does not use symmetric-only encryption. Like SSL, TLS uses a hybrid approach combining both asymmetric (public key) cryptography for initial key exchange and authentication, and symmetric encryption for bulk data encryption. This hybrid approach is actually a strength, not a limitation, and is used by both SSL and TLS.',
                    'Correct - SSL versions (SSLv2, SSLv3) are deprecated due to numerous known security vulnerabilities including protocol design flaws, weak cipher suites, and susceptibility to attacks like POODLE, BEAST, and others. TLS was developed as a more secure successor to SSL, with improved cryptographic algorithms, better protocol design, and enhanced security features that address the vulnerabilities found in SSL.',
                    'Incorrect - Actually, SSL does not inherently support perfect forward secrecy, while modern TLS versions do support this feature. Perfect forward secrecy ensures that past communications remain secure even if long-term keys are compromised. This is actually an advantage of TLS over SSL, but the statement incorrectly attributes this feature to SSL.',
                ],
                'bloom_level' => 1,
                'difficulty_level' => 3,
                'status' => 'published',
                'type_id' => 1,
                'irt_a' => 1.3,
                'irt_b' => -0.2,
                'irt_c' => 0.25,
            ],

            // Item 4 - L3 - Apply
            [
                'topic' => 'Network Security Protocols',
                'subtopic' => 'Security Protocols',
                'question' => 'A company is setting up a secure tunnel between its branch office and its main data center over the public internet to protect sensitive inter-office traffic. Which security protocol suite is specifically designed to provide confidentiality, integrity, and authentication for IP packets during such a connection?',
                'options' => [
                    'TLS/SSL',
                    'SSH',
                    'IPSec',
                    'HTTPS',
                ],
                'correct_options' => ['IPSec'],
                'justifications' => [
                    'Incorrect - TLS/SSL operates at the application layer and is primarily designed to secure specific application protocols like HTTP, SMTP, or FTP. While TLS can provide end-to-end encryption for applications, it does not operate at the IP layer to create secure tunnels for all IP traffic between networks like the scenario describes.',
                    'Incorrect - SSH (Secure Shell) is designed for secure remote login and command execution on individual systems. While SSH can create tunnels for specific applications, it is not designed as a comprehensive solution for securing all inter-office IP traffic between networks. SSH tunnels are typically used for individual connections rather than site-to-site network connectivity.',
                    'Correct - IPSec (Internet Protocol Security) is specifically designed to provide security services at the IP layer, making it ideal for creating secure tunnels between networks over the public internet. IPSec provides confidentiality through encryption, integrity through authentication headers and checksums, and authentication through digital certificates or pre-shared keys. It can secure all IP traffic between the branch office and data center, regardless of the specific applications being used.',
                    'Incorrect - HTTPS is HTTP over TLS/SSL and is designed specifically for securing web traffic between browsers and web servers. Like TLS/SSL, it operates at the application layer and is not designed to create comprehensive secure tunnels for all inter-office network traffic. HTTPS would only protect web-based communications, not other types of network traffic like file sharing, database connections, or internal applications.',
                ],
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'status' => 'published',
                'type_id' => 1,
                'irt_a' => 1.4,
                'irt_b' => 0.1,
                'irt_c' => 0.25,
            ],

            // Item 5 - L3 - Apply
            [
                'topic' => 'Network Security Protocols',
                'subtopic' => 'Security Protocols',
                'question' => 'You are advising a startup on securing their remote workforce\'s access to internal resources. The solution must provide encrypted communication over untrusted networks, authenticate users, and be relatively easy to deploy and manage for a growing number of users. Which VPN technology would you recommend as the best fit for these requirements?',
                'options' => [
                    'PPTP (Point-to-Point Tunneling Protocol)',
                    'L2TP/IPSec',
                    'SSTP (Secure Socket Tunneling Protocol)',
                    'OpenVPN',
                ],
                'correct_options' => ['OpenVPN'],
                'justifications' => [
                    'Incorrect - PPTP is an outdated VPN protocol with known security vulnerabilities, including weak encryption (40-bit and 128-bit) and authentication flaws. Microsoft deprecated PPTP due to security concerns, and it can be easily compromised by modern attacks. For a startup requiring secure remote access, PPTP would expose the organization to significant security risks.',
                    'Incorrect - While L2TP/IPSec provides strong security with robust encryption and authentication, it can be complex to deploy and manage, especially for a startup with limited IT resources. L2TP/IPSec requires more complex firewall configurations, can have issues with NAT traversal, and may require additional setup for mobile devices, making it less suitable for a growing workforce.',
                    'Incorrect - SSTP is a Microsoft-proprietary protocol that works well in Windows environments and can traverse firewalls easily. However, being proprietary limits its cross-platform compatibility, and it may not be the best choice for a diverse startup environment with various operating systems and devices.',
                    'Correct - OpenVPN is the best choice for this scenario because it provides strong security with robust encryption (AES-256), supports multiple authentication methods including certificates and multi-factor authentication, and is relatively easy to deploy and manage. It\'s cross-platform compatible, cost-effective (open source), scales well for growing organizations, and can traverse firewalls and NAT easily, making it ideal for a startup\'s remote workforce.',
                ],
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'status' => 'published',
                'type_id' => 1,
                'irt_a' => 1.5,
                'irt_b' => 0.3,
                'irt_c' => 0.25,
            ],

            // Item 6 - L3 - Apply
            [
                'topic' => 'Network Security Protocols',
                'subtopic' => 'Security Protocols',
                'question' => 'A company uses a VPN to connect remote users to the corporate network. What risk is introduced if split tunneling is enabled?',
                'options' => [
                    'Loss of availability',
                    'Increased packet loss',
                    'Traffic visibility by ISPs',
                    'Exposure to unsecured local network traffic',
                ],
                'correct_options' => ['Exposure to unsecured local network traffic'],
                'justifications' => [
                    'Incorrect - Loss of availability refers to system or service downtime, which is not directly related to split tunneling. Split tunneling typically improves performance by allowing some traffic to bypass the VPN, potentially increasing rather than decreasing availability of internet resources.',
                    'Incorrect - Increased packet loss is a network performance issue that can occur due to network congestion or hardware problems, but split tunneling generally reduces packet loss by allowing local internet traffic to take more direct routes rather than routing everything through the corporate VPN tunnel.',
                    'Incorrect - Traffic visibility by ISPs is actually reduced with split tunneling for corporate traffic, as that traffic still goes through the encrypted VPN tunnel. ISPs can only see the local internet traffic that bypasses the VPN, which they could see regardless of VPN usage.',
                    'Correct - Split tunneling allows users to access both the corporate network through the VPN and local internet resources directly. This creates a security risk because the user\'s device becomes a bridge between the secured corporate network and potentially unsecured local networks (like public Wi-Fi or home networks). Malware or attacks from the local network could potentially compromise the device and gain access to corporate resources through the VPN connection.',
                ],
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'status' => 'published',
                'type_id' => 1,
                'irt_a' => 1.4,
                'irt_b' => 0.5,
                'irt_c' => 0.25,
            ],

            // Item 7 - L4 - Analyze
            [
                'topic' => 'Network Security Protocols',
                'subtopic' => 'Security Protocols',
                'question' => 'In the context of TLS, which of the following occurs FIRST during the handshake?',
                'options' => [
                    'Client Hello',
                    'Certificate exchange',
                    'Key derivation',
                    'Session key transmission',
                ],
                'correct_options' => ['Client Hello'],
                'justifications' => [
                    'Correct - The Client Hello message is the first step in the TLS handshake process. The client initiates the connection by sending a Client Hello message to the server, which includes information such as the TLS version the client supports, a list of cipher suites the client can use, a random number for key generation, and optionally server name indication (SNI). This message starts the entire TLS negotiation process.',
                    'Incorrect - Certificate exchange occurs after the Client Hello and Server Hello messages. The server sends its digital certificate to the client to prove its identity, but this happens only after the initial hello messages have been exchanged and the server has responded with its supported cryptographic parameters.',
                    'Incorrect - Key derivation occurs much later in the TLS handshake process, after the certificate exchange, key exchange, and verification steps. The client and server derive the actual session keys from the pre-master secret only after they have agreed on cryptographic parameters and verified each other\'s identities.',
                    'Incorrect - Session key transmission does not occur as a separate step in modern TLS. Instead, both parties derive the same session keys independently using the shared pre-master secret and the random values exchanged during the handshake. The keys are never directly transmitted over the network, which would be a security vulnerability.',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 4,
                'status' => 'published',
                'type_id' => 1,
                'irt_a' => 1.7,
                'irt_b' => 0.8,
                'irt_c' => 0.20,
            ],

            // Item 8 - L4 - Analyze
            [
                'topic' => 'Network Security Protocols',
                'subtopic' => 'Security Protocols',
                'question' => 'An organization is transitioning from IPv4 to IPv6 to enhance scalability and security. During the transition, the security team is evaluating the use of IPSec for securing network communications. Which of the following statements is true regarding IPSec in IPv6?',
                'options' => [
                    'IPSec is integrated into IPv6 but not automatically enabled by default',
                    'IPSec is integrated into IPv6 and is automatically enabled by default',
                    'IPSec is not integrated into IPv6 and must be enabled and configured',
                    'IPSec is not integrated into IPv6 and must be installed and configured',
                ],
                'correct_options' => ['IPSec is integrated into IPv6 but not automatically enabled by default'],
                'justifications' => [
                    'Correct - IPSec support is built into the IPv6 protocol specification as a mandatory feature, meaning all IPv6 implementations must include IPSec capabilities. However, IPSec is not automatically enabled by default and requires explicit configuration to activate. Organizations must still configure IPSec policies, authentication methods, encryption algorithms, and key management to use IPSec protection for their IPv6 communications.',
                    'Incorrect - While IPSec is integrated into IPv6, it is not automatically enabled by default. IPv6 networks operate without IPSec protection unless specifically configured to use it. This design allows organizations to choose when and how to implement IPSec based on their security requirements, rather than forcing universal encryption that might impact performance or compatibility.',
                    'Incorrect - IPSec is indeed integrated into IPv6 as a mandatory component of the IPv6 specification. Unlike IPv4 where IPSec was retrofitted as an optional extension, IPv6 was designed from the ground up with built-in IPSec support. Organizations do not need to add separate IPSec functionality to IPv6 implementations.',
                    'Incorrect - IPSec does not need to be installed separately for IPv6 because it is an integral part of the IPv6 protocol stack. All compliant IPv6 implementations include IPSec capabilities by design. However, IPSec policies and configurations must still be enabled and configured by network administrators to provide actual security protection.',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 4,
                'status' => 'published',
                'type_id' => 1,
                'irt_a' => 1.8,
                'irt_b' => 1.0,
                'irt_c' => 0.20,
            ],

            // Item 9 - L5 - Evaluate
            [
                'topic' => 'Network Security Protocols',
                'subtopic' => 'Security Protocols',
                'question' => 'A multinational corporation is implementing IPSec to secure its network communications. In which of the following scenarios is IPSec Transport Mode the most appropriate choice over Tunnel Mode?',
                'options' => [
                    'Securing communications between two servers within the intranet',
                    'Establishing host-to-site VPN for remote employees working from home',
                    'Establishing a site-to-site VPN between corporate headquarters and a remote office',
                    'Securing communications in an extranet environment with business partners',
                ],
                'correct_options' => ['Securing communications between two servers within the intranet'],
                'justifications' => [
                    'Correct - IPSec Transport Mode is most appropriate for securing communications between two servers within the same intranet because it only encrypts the payload (data) of IP packets while preserving the original IP headers. This is ideal for host-to-host communication within the same network where the original source and destination IP addresses need to remain visible for routing purposes, and there is no need to hide the network topology.',
                    'Incorrect - Host-to-site VPN connections require IPSec Tunnel Mode because the remote employee\'s device needs to appear as if it\'s directly connected to the corporate network. Tunnel Mode encapsulates the entire original IP packet (including headers) within a new IP packet, allowing the remote host to communicate with internal network resources as if it were locally connected.',
                    'Incorrect - Site-to-site VPNs between different locations require IPSec Tunnel Mode to create a secure tunnel between the network gateways. Tunnel Mode is necessary to encapsulate packets from one network and route them securely over the internet to another network, effectively extending the private network across public infrastructure.',
                    'Incorrect - Extranet communications with business partners typically require IPSec Tunnel Mode to securely connect different organizations\' networks while maintaining network separation and security. Tunnel Mode provides the necessary encapsulation to route traffic between different network domains securely over public networks.',
                ],
                'bloom_level' => 5,
                'difficulty_level' => 5,
                'status' => 'published',
                'type_id' => 1,
                'irt_a' => 1.9,
                'irt_b' => 1.3,
                'irt_c' => 0.15,
            ],

            // Item 10 - L5 - Evaluate
            [
                'topic' => 'Network Security Protocols',
                'subtopic' => 'Security Protocols',
                'question' => 'An organization is implementing IPSec Transport Mode instead of Tunnel Mode to secure internal communications between critical application servers. What is the primary benefit of choosing Transport Mode in this scenario?',
                'options' => [
                    'Better anonymity',
                    'Improved scalability',
                    'Higher resiliency',
                    'Reduced overhead',
                ],
                'correct_options' => ['Reduced overhead'],
                'justifications' => [
                    'Incorrect - Transport Mode does not provide better anonymity than Tunnel Mode. In fact, Transport Mode preserves the original IP headers, making the source and destination addresses visible, which provides less anonymity. Tunnel Mode would actually provide better anonymity by encapsulating the original packet within new IP headers.',
                    'Incorrect - While Transport Mode may have slightly better performance characteristics, this does not directly translate to improved scalability. Scalability is more dependent on factors like network architecture, server capacity, and application design rather than the specific IPSec mode used for securing communications between servers.',
                    'Incorrect - IPSec mode selection does not significantly impact network resiliency. Resiliency is primarily achieved through redundant network paths, failover mechanisms, and robust network architecture design. Both Transport and Tunnel modes can be equally resilient when properly implemented.',
                    'Correct - Transport Mode provides reduced overhead compared to Tunnel Mode because it only encrypts and authenticates the payload of IP packets while preserving the original IP headers. This eliminates the need for additional IP header encapsulation required in Tunnel Mode, resulting in smaller packet sizes, reduced bandwidth consumption, and lower processing overhead - which is particularly beneficial for high-volume internal server-to-server communications.',
                ],
                'bloom_level' => 5,
                'difficulty_level' => 5,
                'status' => 'published',
                'type_id' => 1,
                'irt_a' => 2.0,
                'irt_b' => 1.5,
                'irt_c' => 0.15,
            ],

            // Topic 2: Network Attacks & Threats (10 questions)
            // Bloom Distribution: L1:1, L2:2, L3:3, L4:2, L5:2

            // Item 11 - L2 - Understand
            [
                'topic' => 'Network Attacks & Threats',
                'subtopic' => 'Network Attacks',
                'question' => 'Which of the following best describes how a SYN flood attack operates and what its primary impact is on a target system?',
                'options' => [
                    'A SYN flood attack works by sending malformed SYN packets that crash the target server, leading to a denial of service (DoS) and a complete shutdown of the network.',
                    'A SYN flood attack sends a large volume of SYN requests to a server, but fails to complete the TCP handshake, exhausting the server\'s connection resources and preventing legitimate users from establishing connections.',
                    'A SYN flood attack injects malicious payloads within SYN packets, exploiting a vulnerability in the TCP/IP stack to gain unauthorized access to the system.',
                    'A SYN flood attack relies on flooding the server with complete TCP handshakes, overwhelming the system\'s CPU resources, and causing it to slow down significantly.',
                ],
                'correct_options' => ['A SYN flood attack sends a large volume of SYN requests to a server, but fails to complete the TCP handshake, exhausting the server\'s connection resources and preventing legitimate users from establishing connections.'],
                'justifications' => [
                    'Incorrect - SYN flood attacks do not send malformed packets or cause complete network shutdowns. The packets are properly formatted TCP SYN packets, and the attack targets the server\'s connection table rather than crashing the entire network infrastructure.',
                    'Correct - A SYN flood attack exploits the TCP three-way handshake process by sending numerous SYN packets to initiate connections but never responding to the server\'s SYN-ACK replies. This leaves half-open connections in the server\'s connection table, eventually exhausting available resources and preventing legitimate users from establishing new connections. The server waits for ACK responses that never come.',
                    'Incorrect - SYN flood attacks do not inject malicious payloads or exploit vulnerabilities for unauthorized access. They are purely resource exhaustion attacks that target the server\'s ability to handle connection requests, not attacks designed to gain system access or execute malicious code.',
                    'Incorrect - SYN flood attacks specifically avoid completing the TCP handshake - that\'s the key to their effectiveness. If the handshakes were completed, the attack would not work because completed connections would be properly closed, freeing up resources. The attack\'s power lies in leaving connections in a half-open state.',
                ],
                'bloom_level' => 1,
                'difficulty_level' => 3,
                'status' => 'published',
                'type_id' => 1,
                'irt_a' => 1.2,
                'irt_b' => -0.3,
                'irt_c' => 0.25,
            ],

            // Item 12 - L3 - Apply
            [
                'topic' => 'Network Attacks & Threats',
                'subtopic' => 'Network Attacks',
                'question' => 'Which of the following best explains the difference between a firewall "drop" rule and a "reject" rule, and how each affects network traffic?',
                'options' => [
                    'A "drop" rule silently discards the packet without notifying the sender, while a "reject" rule blocks the packet and sends an error message back to the sender.',
                    'A "drop" rule blocks the packet and immediately closes the connection, while a "reject" rule allows the packet but logs its details for further analysis.',
                    'A "drop" rule blocks the packet and sends an error message back to the sender, while a "reject" rule silently discards the packet without notifying the sender.',
                    'A "drop" rule applies to outgoing traffic only, while a "reject" rule applies to incoming traffic and triggers alerts.',
                ],
                'correct_options' => ['A "drop" rule silently discards the packet without notifying the sender, while a "reject" rule blocks the packet and sends an error message back to the sender.'],
                'justifications' => [
                    'Correct - A "drop" rule silently discards packets without any response to the sender, making the firewall appear invisible. The sender will experience timeouts as if the destination host doesn\'t exist. A "reject" rule actively responds with an ICMP error message (like "Destination Unreachable") or TCP RST packet, informing the sender that the connection was explicitly denied.',
                    'Incorrect - Drop rules do not close connections or send responses, and reject rules do not allow packets through. Both rules block traffic, but they differ in whether they provide feedback to the sender about the blocked traffic.',
                    'Incorrect - This reverses the correct behavior. Drop rules are silent (no response), while reject rules send error messages. The key distinction is that drop rules provide no feedback, while reject rules actively inform the sender of the denial.',
                    'Incorrect - Both drop and reject rules can apply to incoming and outgoing traffic depending on firewall configuration. The direction of traffic is not what distinguishes these rule types - the difference lies in whether they respond to the sender.',
                ],
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'status' => 'published',
                'type_id' => 1,
                'irt_a' => 1.4,
                'irt_b' => 0.1,
                'irt_c' => 0.25,
            ],

            // Item 13 - L2 - Understand
            [
                'topic' => 'Network Attacks & Threats',
                'subtopic' => 'Network Attacks',
                'question' => 'Which of the following HTTP response codes is most commonly associated with rate limiting, often seen during a Distributed Denial of Service (DDoS) attack mitigation?',
                'options' => [
                    '301',
                    '403',
                    '429',
                    '503',
                ],
                'correct_options' => ['429'],
                'justifications' => [
                    'Incorrect - HTTP 301 is a "Moved Permanently" redirect status code used when a resource has been permanently moved to a new URL. This is unrelated to rate limiting or DDoS mitigation and is used for normal website navigation and SEO purposes.',
                    'Incorrect - HTTP 403 "Forbidden" indicates that the server understands the request but refuses to authorize it due to insufficient permissions. While this might be used in some security contexts, it is not specifically associated with rate limiting during DDoS mitigation.',
                    'Correct - HTTP 429 "Too Many Requests" is specifically designed for rate limiting scenarios. It indicates that the user has sent too many requests in a given amount of time and should retry after a specified period. This is the standard response code used by DDoS mitigation systems, load balancers, and rate limiting mechanisms to throttle excessive requests.',
                    'Incorrect - HTTP 503 "Service Unavailable" indicates that the server is temporarily unable to handle requests, often due to maintenance or overload. While this might appear during severe DDoS attacks when services become unavailable, it is not specifically associated with rate limiting mechanisms.',
                ],
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'status' => 'published',
                'type_id' => 1,
                'irt_a' => 1.3,
                'irt_b' => -0.2,
                'irt_c' => 0.25,
            ],

            // Item 14 - L3 - Apply
            [
                'topic' => 'Network Attacks & Threats',
                'subtopic' => 'Network Attacks',
                'question' => 'An organization notices unusual network traffic patterns with connections to unknown external IP addresses. What should be their immediate response?',
                'options' => [
                    'Ignore the traffic if systems appear to be working normally',
                    'Isolate affected systems and investigate for potential compromise',
                    'Increase bandwidth to handle the additional traffic',
                    'Wait to see if the traffic stops on its own',
                ],
                'correct_options' => ['Isolate affected systems and investigate for potential compromise'],
                'justifications' => [
                    'Incorrect - Ignore the traffic if systems appear to be working normally',
                    'Correct - Isolate affected systems and investigate for potential compromise',
                    'Incorrect - Increase bandwidth to handle the additional traffic',
                    'Incorrect - Wait to see if the traffic stops on its own',
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
                'topic' => 'Network Attacks & Threats',
                'subtopic' => 'Network Attacks',
                'question' => 'A financial institution receives multiple reports from users stating that they are being redirected to a fake version of the bank\'s website, even though they typed the correct URL manually into their browsers. The spoofed website has a valid-looking design but does not use the institution\'s actual TLS certificate. An investigation finds no compromise in the bank\'s authoritative DNS server or web infrastructure. Which of the following is the MOST likely cause of this behavior?',
                'options' => [
                    'Phishing attack',
                    'Pharming attack',
                    'Cross-site scripting attack',
                    'DNS spoofing',
                ],
                'correct_options' => ['Pharming attack'],
                'justifications' => [
                    'Incorrect - A phishing attack typically involves tricking users into clicking malicious links or entering credentials on fake websites, often through deceptive emails or messages. However, in this scenario, users are typing the correct URL manually and still being redirected, which indicates the attack is occurring at the DNS resolution level rather than through social engineering tactics.',
                    'Correct - A pharming attack redirects users to malicious websites by compromising DNS resolution, even when they type the correct URL. Since the bank\'s authoritative DNS server and web infrastructure are not compromised, the attack is likely targeting intermediate DNS servers (ISP DNS servers, local DNS caches, or DNS resolvers) or using DNS cache poisoning techniques to redirect legitimate domain requests to the attacker\'s malicious server hosting the fake website.',
                    'Incorrect - Cross-site scripting (XSS) attacks involve injecting malicious scripts into legitimate websites to steal user data or perform unauthorized actions within the user\'s browser session. XSS attacks occur on compromised legitimate websites and would not cause users to be redirected to completely different fake websites when typing URLs manually.',
                    'Incorrect - While DNS spoofing is technically involved in this attack, pharming is the more specific and accurate term for this scenario. DNS spoofing is a broader category that includes various DNS manipulation techniques, while pharming specifically refers to redirecting users to fraudulent websites through DNS manipulation, which precisely describes the observed behavior.',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'status' => 'published',
                'type_id' => 1,
                'irt_a' => 1.4,
                'irt_b' => 0.4,
                'irt_c' => 0.25,
            ],

            // Item 16 - L3 - Apply
            [
                'topic' => 'Network Attacks & Threats',
                'subtopic' => 'Network Attacks',
                'question' => 'Identify the attack that can be launched by running software against the CAM table on the same switch as the target.',
                'options' => [
                    'MAC flooding',
                    'MAC spoofing',
                    'ARP poisoning attack',
                    'Pharming attack',
                ],
                'correct_options' => ['MAC flooding'],
                'justifications' => [
                    'Correct - MAC flooding is the attack that specifically targets a switch\'s CAM (Content Addressable Memory) table by overwhelming it with fake MAC addresses. When the CAM table becomes full, the switch fails open and begins operating like a hub, broadcasting all traffic to all ports. This allows an attacker on the same switch to intercept network traffic that should normally be switched only to the intended recipient. The attack requires software tools that generate thousands of fake MAC addresses to fill the CAM table beyond its capacity.',
                    'Incorrect - MAC spoofing involves changing or impersonating another device\'s MAC address but does not directly attack the CAM table. While MAC spoofing can be used in conjunction with other attacks, it doesn\'t overwhelm the switch\'s CAM table with entries. MAC spoofing is more about identity impersonation rather than table exhaustion attacks against network infrastructure.',
                    'Incorrect - ARP poisoning attacks target the ARP cache of hosts and routers, not the switch\'s CAM table. ARP poisoning involves sending fraudulent ARP messages to associate the attacker\'s MAC address with legitimate IP addresses, redirecting traffic through the attacker. While both attacks can enable traffic interception, ARP poisoning operates at Layer 3 (network) while MAC flooding targets Layer 2 (data link) switching infrastructure.',
                    'Incorrect - Pharming attacks redirect users from legitimate websites to fraudulent ones through DNS manipulation or hosts file modification. Pharming operates at the application layer and has no relationship to switch CAM tables or Layer 2 network infrastructure. Pharming is primarily concerned with redirecting web traffic to malicious sites rather than exploiting switching hardware limitations.',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'status' => 'published',
                'type_id' => 1,
                'irt_a' => 1.4,
                'irt_b' => 0.2,
                'irt_c' => 0.25,
            ],

            // Item 17 - L4 - Analyze
            [
                'topic' => 'Network Attacks & Threats',
                'subtopic' => 'Network Attacks',
                'question' => 'Compare the types of Distributed Denial of Service (DDoS) attacks and select the best example of a synchronize (SYN) flood attack.',
                'options' => [
                    'A group of attackers work together to form an attack on a network.',
                    'An attack consumes all of the network bandwidth resulting in denial to legitimate hosts.',
                    'Client IP addresses are spoofed to misdirect the server\'s SYN/ACK packet increasing session queues.',
                    'A client\'s IP address is spoofed and pings the broadcast address of a third-party network with many hosts.',
                ],
                'correct_options' => ['Client IP addresses are spoofed to misdirect the server\'s SYN/ACK packet increasing session queues.'],
                'justifications' => [
                    'Incorrect - While this describes the distributed nature of DDoS attacks in general, it does not specifically describe the mechanism of a SYN flood attack. A SYN flood is a specific type of DDoS that exploits the TCP three-way handshake process, not just any coordinated group attack. The key distinguishing feature of SYN flood is the manipulation of TCP connection establishment, not merely multiple attackers working together.',
                    'Incorrect - This describes a volumetric or bandwidth exhaustion DDoS attack that aims to consume network resources through high traffic volume. While SYN floods can contribute to resource exhaustion, the primary mechanism is not bandwidth consumption but rather exhaustion of server connection resources through incomplete TCP handshakes. SYN floods target server memory and connection tables, not necessarily network bandwidth.',
                    'Correct - This accurately describes a SYN flood attack mechanism. The attacker sends numerous SYN packets with spoofed source IP addresses to initiate TCP connections. When the server responds with SYN/ACK packets, they are sent to the spoofed (non-existent or unreachable) IP addresses, so no ACK response is received. This leaves half-open connections in the server\'s connection queue, eventually exhausting server resources and preventing legitimate connections from being established.',
                    'Incorrect - This describes a Smurf attack, not a SYN flood. In a Smurf attack, the attacker spoofs the victim\'s IP address and sends ICMP ping requests to a network\'s broadcast address, causing all hosts on that network to respond to the victim with ping replies, overwhelming the victim with traffic. This attack uses ICMP protocol and broadcast amplification, whereas SYN flood specifically targets TCP connection establishment processes.',
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
                'topic' => 'Network Attacks & Threats',
                'subtopic' => 'Network Attacks',
                'question' => 'Which of the following network attacks relies on exploiting the DNS server to divert traffic from a legitimate server to a malicious one?',
                'options' => [
                    'ARP Spoofing',
                    'DNS Spoofing',
                    'SQL Injection',
                    'Ransomware Attack',
                ],
                'correct_options' => ['DNS Spoofing'],
                'justifications' => [
                    'Incorrect - ARP Spoofing operates at the Data Link Layer (Layer 2) by associating the attacker\'s MAC address with legitimate IP addresses on the local network. While ARP spoofing can redirect traffic within a local network segment, it does not exploit DNS servers or manipulate domain name resolution. ARP spoofing affects the mapping between IP addresses and MAC addresses, not the translation of domain names to IP addresses that DNS provides.',
                    'Correct - DNS Spoofing (also known as DNS cache poisoning) specifically targets the Domain Name System to redirect users from legitimate servers to malicious ones. The attack works by corrupting DNS resolution, causing domain name queries to return incorrect IP addresses that point to attacker-controlled servers. When users attempt to visit legitimate websites, they are unknowingly redirected to malicious sites that may harvest credentials, distribute malware, or conduct other attacks.',
                    'Incorrect - SQL Injection is an application-layer attack that targets database-driven web applications by inserting malicious SQL code through user input fields. While SQL injection can compromise web applications and databases, it does not directly exploit DNS servers or manipulate DNS resolution. SQL injection attacks occur after successful DNS resolution when users interact with vulnerable web applications.',
                    'Incorrect - Ransomware Attack is a type of malware that encrypts victim files and demands payment for decryption keys. While ransomware can spread through various vectors including compromised websites, it is not primarily a DNS exploitation technique. Ransomware focuses on file encryption and extortion rather than manipulating DNS resolution to redirect network traffic to malicious servers.',
                ],
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'status' => 'published',
                'type_id' => 1,
                'irt_a' => 1.6,
                'irt_b' => 0.8,
                'irt_c' => 0.20,
            ],

            // Item 19 - L5 - Evaluate
            [
                'topic' => 'Network Attacks & Threats',
                'subtopic' => 'Network Attacks',
                'question' => 'Evaluate the effectiveness of implementing a "security through obscurity" approach for protecting against network attacks.',
                'options' => [
                    'Obscurity provides complete protection against all attacks',
                    'Obscurity may provide minimal protection but should not be relied upon as primary defense',
                    'Obscurity is the most effective security strategy',
                    'Obscurity has no security value whatsoever',
                ],
                'correct_options' => ['Obscurity may provide minimal protection but should not be relied upon as primary defense'],
                'justifications' => [
                    'Incorrect - Obscurity provides complete protection against all attacks',
                    'Correct - Obscurity may provide minimal protection but should not be relied upon as primary defense',
                    'Incorrect - Obscurity is the most effective security strategy',
                    'Incorrect - Obscurity has no security value whatsoever',
                ],
                'bloom_level' => 5,
                'difficulty_level' => 5,
                'status' => 'published',
                'type_id' => 1,
                'irt_a' => 1.9,
                'irt_b' => 1.4,
                'irt_c' => 0.15,
            ],

            // Item 20 - L5 - Evaluate
            [
                'topic' => 'Network Attacks & Threats',
                'subtopic' => 'Network Attacks',
                'question' => 'A multinational corporation\'s security team detected unusual activity in its network after noticing sensitive intellectual property data being exfiltrated. Upon forensic analysis, they found that a highly sophisticated attacker had been present for nearly a year, executing well-coordinated intrusions. The adversary remained undetected by traditional perimeter defenses. Logs revealed a pattern of highly targeted east-west traffic between different workloads in the corporate data center. Which of the following best identifies the nature of the attack and the most effective preventive measure to mitigate such threats in the future?',
                'options' => [
                    'MITRE ATT&CK; deploy Network Functions Virtualization (NFV)',
                    'Advanced Persistent Threat (APT); enforce microsegmentation',
                    'Cyber Kill Chain; implement VLAN Access Control Lists (VACLs)',
                    'Zero-day attack; use Security Information and Event Management (SIEM)',
                ],
                'correct_options' => ['Advanced Persistent Threat (APT); enforce microsegmentation'],
                'justifications' => [
                    'Incorrect - While MITRE ATT&CK is a valuable framework for understanding attack tactics and techniques, it is not the nature of the attack itself but rather a classification system. Network Functions Virtualization (NFV) is primarily focused on virtualizing network services for operational efficiency and would not directly address the lateral movement and persistence issues described in this APT scenario.',
                    'Correct - This scenario describes a classic Advanced Persistent Threat (APT) characterized by long-term presence (nearly a year), sophisticated coordination, stealth capabilities that bypass perimeter defenses, and lateral movement within the network. Microsegmentation is the most effective preventive measure because it creates granular network zones that limit lateral movement between workloads, making it much harder for attackers to move east-west through the data center and access sensitive resources.',
                    'Incorrect - The Cyber Kill Chain is a framework for understanding attack progression, not the attack type itself. While VLAN Access Control Lists can provide some network segmentation, VACLs are less granular than microsegmentation and may not be sufficient to prevent the sophisticated lateral movement typical of APTs that can persist undetected for long periods.',
                    'Incorrect - This is not primarily a zero-day attack, as the description emphasizes long-term persistence and lateral movement rather than exploitation of unknown vulnerabilities. While SIEM systems are valuable for detection and correlation, they are reactive tools that help identify attacks after they occur, rather than preventive measures that limit an attacker\'s ability to move laterally within the network.',
                ],
                'bloom_level' => 5,
                'difficulty_level' => 5,
                'status' => 'published',
                'type_id' => 1,
                'irt_a' => 2.0,
                'irt_b' => 1.3,
                'irt_c' => 0.15,
            ],

            // Topic 3: Network Segmentation & Architecture (10 questions)
            // Bloom Distribution: L1:2, L2:2, L3:3, L4:2, L5:1

            // Item 21 - L1 - Remember
            [
                'topic' => 'Network Segmentation & Architecture',
                'subtopic' => 'Network Segmentation',
                'question' => 'What is the primary purpose of network segmentation?',
                'options' => [
                    'Increasing network speed',
                    'Limiting the scope of security breaches and controlling traffic flow',
                    'Reducing hardware costs',
                    'Simplifying network management',
                ],
                'correct_options' => ['Limiting the scope of security breaches and controlling traffic flow'],
                'justifications' => [
                    'Incorrect - Increasing network speed',
                    'Correct - Limiting the scope of security breaches and controlling traffic flow',
                    'Incorrect - Reducing hardware costs',
                    'Incorrect - Simplifying network management',
                ],
                'bloom_level' => 1,
                'difficulty_level' => 1,
                'status' => 'published',
                'type_id' => 1,
                'irt_a' => 0.8,
                'irt_b' => -1.4,
                'irt_c' => 0.25,
            ],

            // Item 22 - L1 - Remember
            [
                'topic' => 'Network Segmentation & Architecture',
                'subtopic' => 'Network Segmentation',
                'question' => 'What is a DMZ (Demilitarized Zone) in network architecture?',
                'options' => [
                    'A restricted access server room',
                    'A network segment between internal and external networks for public-facing services',
                    'A backup network connection',
                    'A wireless network zone',
                ],
                'correct_options' => ['A network segment between internal and external networks for public-facing services'],
                'justifications' => [
                    'Incorrect - A restricted access server room',
                    'Correct - A network segment between internal and external networks for public-facing services',
                    'Incorrect - A backup network connection',
                    'Incorrect - A wireless network zone',
                ],
                'bloom_level' => 1,
                'difficulty_level' => 1,
                'status' => 'published',
                'type_id' => 1,
                'irt_a' => 0.9,
                'irt_b' => -1.2,
                'irt_c' => 0.25,
            ],

            // Item 23 - L2 - Understand
            [
                'topic' => 'Network Segmentation & Architecture',
                'subtopic' => 'Network Segmentation',
                'question' => 'How does micro-segmentation improve network security?',
                'options' => [
                    'It reduces network maintenance costs',
                    'It creates granular security zones with individualized access controls',
                    'It increases network bandwidth',
                    'It eliminates the need for firewalls',
                ],
                'correct_options' => ['It creates granular security zones with individualized access controls'],
                'justifications' => [
                    'Incorrect - It reduces network maintenance costs',
                    'Correct - It creates granular security zones with individualized access controls',
                    'Incorrect - It increases network bandwidth',
                    'Incorrect - It eliminates the need for firewalls',
                ],
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'status' => 'published',
                'type_id' => 1,
                'irt_a' => 1.2,
                'irt_b' => -0.5,
                'irt_c' => 0.25,
            ],

            // Item 24 - L2 - Understand
            [
                'topic' => 'Network Segmentation & Architecture',
                'subtopic' => 'Network Segmentation',
                'question' => 'Why is east-west traffic monitoring important in modern network architectures?',
                'options' => [
                    'It only affects external network communications',
                    'Most data center traffic is between servers, where threats can move laterally',
                    'East-west traffic is always encrypted and secure',
                    'It only impacts network performance, not security',
                ],
                'correct_options' => ['Most data center traffic is between servers, where threats can move laterally'],
                'justifications' => [
                    'Incorrect - It only affects external network communications',
                    'Correct - Most data center traffic is between servers, where threats can move laterally',
                    'Incorrect - East-west traffic is always encrypted and secure',
                    'Incorrect - It only impacts network performance, not security',
                ],
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'status' => 'published',
                'type_id' => 1,
                'irt_a' => 1.3,
                'irt_b' => -0.2,
                'irt_c' => 0.25,
            ],

            // Item 25 - L3 - Apply
            [
                'topic' => 'Network Segmentation & Architecture',
                'subtopic' => 'Network Segmentation',
                'question' => 'A financial institution requires the highest level of security for its most sensitive systems and data, such as customer PII and cryptographic key servers. To eliminate the risk of unauthorized access, data leakage, or remote compromise, the organization decides to isolate these critical systems completely. Which of the following methods is most appropriate for achieving this objective?',
                'options' => [
                    'Air gap',
                    'VLAN',
                    'Microsegmentation',
                    'Demilitarized Zone (DMZ)',
                ],
                'correct_options' => ['Air gap'],
                'justifications' => [
                    'Correct - Air gapping provides the highest level of security by physically isolating critical systems from all network connections, including the internet and internal networks. This complete physical separation eliminates the possibility of remote network-based attacks, data exfiltration, or unauthorized access through network vulnerabilities. For extremely sensitive financial data like customer PII and cryptographic keys, air gapping ensures that these systems cannot be compromised through network-based attacks, making it the most appropriate choice for maximum security.',
                    'Incorrect - VLANs provide logical network segmentation but still operate on the same physical network infrastructure. While VLANs can separate network traffic, they are vulnerable to VLAN hopping attacks, misconfigurations, and compromises of the underlying network equipment. For the highest level of security required for critical financial systems, VLANs do not provide sufficient isolation.',
                    'Incorrect - Microsegmentation creates small, isolated network zones with granular access controls, which improves security over traditional network segmentation. However, microsegmented systems are still connected to the network and can potentially be compromised through sophisticated attacks, zero-day exploits, or misconfigurations. While effective for many scenarios, it does not provide the absolute isolation required for the most critical systems.',
                    'Incorrect - A DMZ is a network segment that sits between internal and external networks, typically used for publicly accessible services like web servers. While DMZs provide some isolation, they are designed to be accessible from both internal and external networks, making them inappropriate for the most sensitive systems that require complete isolation from all network access.',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'status' => 'published',
                'type_id' => 1,
                'irt_a' => 1.4,
                'irt_b' => 0.2,
                'irt_c' => 0.25,
            ],

            // Item 26 - L3 - Apply
            [
                'topic' => 'Network Segmentation & Architecture',
                'subtopic' => 'Network Segmentation',
                'question' => 'An organization has instructed the IS manager to enhance the security and reliability of its Voice-over-Internet Protocol (VoIP) system and data traffic. Which of the following would meet this objective?',
                'options' => [
                    'VoIP infrastructure needs to be segregated using virtual local area networks (VLANs).',
                    'Buffers need to be introduced at the VoIP endpoints.',
                    'Ensure that emergency backup power is available for all parts of the VoIP infrastructure.',
                    'Increase the bandwidth allocated to the VoIP system.',
                ],
                'correct_options' => ['VoIP infrastructure needs to be segregated using virtual local area networks (VLANs).'],
                'justifications' => [
                    'Correct - VoIP infrastructure segregation using VLANs enhances both security and reliability. From a security perspective, VLANs isolate VoIP traffic from other network traffic, reducing the attack surface and preventing eavesdropping or tampering with voice communications. From a reliability perspective, VLANs provide Quality of Service (QoS) controls, traffic prioritization, and network resource allocation specifically for VoIP traffic, ensuring consistent voice quality and reducing latency, jitter, and packet loss.',
                    'Incorrect - While buffers at VoIP endpoints can help with jitter control and packet timing, they primarily address quality of service issues rather than security concerns. Excessive buffering can actually introduce latency, which degrades voice quality. This solution does not address the security aspects of the requirement.',
                    'Incorrect - Emergency backup power addresses availability and business continuity but does not enhance security. While power backup is important for maintaining VoIP service during outages, it does not protect against network-based security threats, eavesdropping, or unauthorized access to voice communications.',
                    'Incorrect - Increasing bandwidth allocation can improve VoIP performance and reduce congestion, but it does not enhance security aspects of the system. More bandwidth alone does not protect against security threats such as call interception, toll fraud, or unauthorized access to the VoIP infrastructure.',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'status' => 'published',
                'type_id' => 1,
                'irt_a' => 1.5,
                'irt_b' => 0.4,
                'irt_c' => 0.25,
            ],

            // Item 27 - L3 - Apply
            [
                'topic' => 'Network Segmentation & Architecture',
                'subtopic' => 'Network Segmentation',
                'question' => 'What is the most effective approach for implementing zero trust network architecture?',
                'options' => [
                    'Trust all internal network traffic',
                    'Verify every user and device before granting access to any resource',
                    'Only verify external connections',
                    'Implement zero trust only for wireless networks',
                ],
                'correct_options' => ['Verify every user and device before granting access to any resource'],
                'justifications' => [
                    'Incorrect - Trust all internal network traffic',
                    'Correct - Verify every user and device before granting access to any resource',
                    'Incorrect - Only verify external connections',
                    'Incorrect - Implement zero trust only for wireless networks',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'status' => 'published',
                'type_id' => 1,
                'irt_a' => 1.6,
                'irt_b' => 0.6,
                'irt_c' => 0.25,
            ],

            // Item 28 - L4 - Analyze
            [
                'topic' => 'Network Segmentation & Architecture',
                'subtopic' => 'Network Segmentation',
                'question' => 'Analyze the security trade-offs between flat network architectures and highly segmented networks.',
                'options' => [
                    'Flat networks are always more secure than segmented networks',
                    'Segmentation improves security but increases complexity and management overhead',
                    'Network architecture has no impact on security',
                    'Highly segmented networks eliminate all security risks',
                ],
                'correct_options' => ['Segmentation improves security but increases complexity and management overhead'],
                'justifications' => [
                    'Incorrect - Flat networks are always more secure than segmented networks',
                    'Correct - Segmentation improves security but increases complexity and management overhead',
                    'Incorrect - Network architecture has no impact on security',
                    'Incorrect - Highly segmented networks eliminate all security risks',
                ],
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'status' => 'published',
                'type_id' => 1,
                'irt_a' => 1.7,
                'irt_b' => 0.8,
                'irt_c' => 0.20,
            ],

            // Item 29 - L4 - Analyze
            [
                'topic' => 'Network Segmentation & Architecture',
                'subtopic' => 'Network Segmentation',
                'question' => 'What is the fundamental challenge in maintaining network segmentation in cloud and hybrid environments?',
                'options' => [
                    'Cloud networks don\'t support segmentation',
                    'Dynamic infrastructure and shared responsibility models complicate traditional perimeter controls',
                    'Segmentation is not needed in cloud environments',
                    'Cloud providers handle all segmentation automatically',
                ],
                'correct_options' => ['Dynamic infrastructure and shared responsibility models complicate traditional perimeter controls'],
                'justifications' => [
                    'Incorrect - Cloud networks don\'t support segmentation',
                    'Correct - Dynamic infrastructure and shared responsibility models complicate traditional perimeter controls',
                    'Incorrect - Segmentation is not needed in cloud environments',
                    'Incorrect - Cloud providers handle all segmentation automatically',
                ],
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'status' => 'published',
                'type_id' => 1,
                'irt_a' => 1.8,
                'irt_b' => 1.0,
                'irt_c' => 0.20,
            ],

            // Item 30 - L5 - Evaluate
            [
                'topic' => 'Network Segmentation & Architecture',
                'subtopic' => 'Network Segmentation',
                'question' => 'Evaluate the effectiveness of software-defined perimeter (SDP) compared to traditional network segmentation for modern distributed workforces.',
                'options' => [
                    'Traditional segmentation is always superior to SDP',
                    'SDP offers better granular control for remote access but requires new infrastructure',
                    'SDP and traditional segmentation provide identical security benefits',
                    'SDP is only useful for small organizations',
                ],
                'correct_options' => ['SDP offers better granular control for remote access but requires new infrastructure'],
                'justifications' => [
                    'Incorrect - Traditional segmentation is always superior to SDP',
                    'Correct - SDP offers better granular control for remote access but requires new infrastructure',
                    'Incorrect - SDP and traditional segmentation provide identical security benefits',
                    'Incorrect - SDP is only useful for small organizations',
                ],
                'bloom_level' => 5,
                'difficulty_level' => 5,
                'status' => 'published',
                'type_id' => 1,
                'irt_a' => 1.9,
                'irt_b' => 1.5,
                'irt_c' => 0.15,
            ],

            // Topic 4: Wireless Security (10 questions)
            // Bloom Distribution: L1:2, L2:2, L3:3, L4:2, L5:1

            // Item 31 - L1 - Remember
            [
                'topic' => 'Wireless Security',
                'subtopic' => 'Wireless Security',
                'question' => 'What is the most secure wireless encryption protocol currently available?',
                'options' => [
                    'WEP',
                    'WPA3',
                    'WPA',
                    'Open network',
                ],
                'correct_options' => ['WPA3'],
                'justifications' => [
                    'Incorrect - WEP',
                    'Correct - WPA3',
                    'Incorrect - WPA',
                    'Incorrect - Open network',
                ],
                'bloom_level' => 1,
                'difficulty_level' => 1,
                'status' => 'published',
                'type_id' => 1,
                'irt_a' => 0.8,
                'irt_b' => -1.5,
                'irt_c' => 0.25,
            ],

            // Item 32 - L3 - Apply
            [
                'topic' => 'Wireless Security',
                'subtopic' => 'Wireless Security',
                'question' => 'Bob is accessing a remote website on the Internet from his laptop connected to a Wi-Fi access point (AP) which is secured using WPA2. Which of the following statements is true?',
                'options' => [
                    'The traffic between the laptop and the remote website is always encrypted',
                    'The traffic between the laptop and the access point (AP) is always encrypted',
                    'The traffic between the access point (AP) and the router is always encrypted',
                    'The traffic between the router and remote website is always encrypted',
                ],
                'correct_options' => ['The traffic between the laptop and the access point (AP) is always encrypted'],
                'justifications' => [
                    'Incorrect - The traffic between the laptop and remote website is not always encrypted end-to-end. While the Wi-Fi connection to the AP is encrypted by WPA2, the traffic beyond the AP depends on whether the website uses HTTPS or other encryption protocols. If Bob accesses an HTTP website, the traffic between the AP and the website would be unencrypted, even though the Wi-Fi segment is protected.',
                    'Correct - WPA2 encryption always protects the wireless link between Bob\'s laptop and the Wi-Fi access point. This encryption is automatic and mandatory for all data transmitted over the Wi-Fi connection when WPA2 is properly configured. WPA2 uses strong encryption algorithms (AES) to secure all wireless communication between the client device and the access point, regardless of the type of traffic being transmitted.',
                    'Incorrect - The traffic between the access point and router is typically transmitted over wired Ethernet connections within the local network infrastructure. These wired connections are not encrypted by WPA2, which only protects the wireless segment. The wired portion of the network relies on physical security and other network security measures rather than wireless encryption protocols.',
                    'Incorrect - The traffic between the router and remote website travels over the public internet through various ISPs and network infrastructure. This traffic is not encrypted by WPA2, which only protects the local Wi-Fi connection. Encryption for internet traffic depends on application-layer protocols like HTTPS/TLS, not on the local wireless security protocol.',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'status' => 'published',
                'type_id' => 1,
                'irt_a' => 1.4,
                'irt_b' => 0.3,
                'irt_c' => 0.25,
            ],

            // Item 33 - L2 - Understand
            [
                'topic' => 'Wireless Security',
                'subtopic' => 'Wireless Security',
                'question' => 'Why is hiding the SSID not considered a strong security measure?',
                'options' => [
                    'Hidden SSIDs improve network performance',
                    'SSIDs can still be discovered through wireless traffic analysis',
                    'Hidden SSIDs are more secure than encryption',
                    'Hiding SSIDs prevents all unauthorized access',
                ],
                'correct_options' => ['SSIDs can still be discovered through wireless traffic analysis'],
                'justifications' => [
                    'Incorrect - Hidden SSIDs improve network performance',
                    'Correct - SSIDs can still be discovered through wireless traffic analysis',
                    'Incorrect - Hidden SSIDs are more secure than encryption',
                    'Incorrect - Hiding SSIDs prevents all unauthorized access',
                ],
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'status' => 'published',
                'type_id' => 1,
                'irt_a' => 1.2,
                'irt_b' => -0.4,
                'irt_c' => 0.25,
            ],

            // Item 34 - L4 - Analyze
            [
                'topic' => 'Wireless Security',
                'subtopic' => 'Wireless Security',
                'question' => 'A company is reviewing the options for installing a new wireless network. They have requested recommendations for utilizing WEP, WPA, or WPA2. Differentiate between Wired Equivalent Privacy (WEP) and Wi-Fi Protected Access (WPA). Determine which of the following statements accurately distinguishes between the options.',
                'options' => [
                    'WEP and WPA use RC4 with a Temporal Key Integrity Protocol (TKIP), while WPA2 uses a 24-bit Initialization Vector (IV). WPA2 combines the 24-bit IV with an Advanced Encryption Standard (AES) to add security.',
                    'WEP is the strongest encryption scheme, followed by WPA2, then WPA. WEP is difficult to crack when protected by a strong password, or if deploying enterprise authentication. WPA2 is more vulnerable to decryption due to replay attack possibilities.',
                    'WPA and WEP use RC4, while WEP uses a 24-bit Initialization Vector (IV). WPA uses a Temporal Key Integrity Protocol (TKIP), and WPA2 uses an Advanced Encryption Standard (AES) for encryption.',
                    'WPA is the strongest encryption scheme, followed by WPA2, then WEP. WPA is difficult to crack if protected by a strong password, or if deploying enterprise authentication. WEP is more vulnerable to decryption due to replay attack possibilities.',
                ],
                'correct_options' => ['WPA and WEP use RC4, while WEP uses a 24-bit Initialization Vector (IV). WPA uses a Temporal Key Integrity Protocol (TKIP), and WPA2 uses an Advanced Encryption Standard (AES) for encryption.'],
                'justifications' => [
                    'Incorrect - This statement contains several errors. WPA2 does not use a 24-bit IV; that\'s a characteristic of WEP. Additionally, WPA2 primarily uses AES encryption, not RC4 with TKIP. The statement incorrectly describes the security mechanisms of each protocol.',
                    'Incorrect - This statement is completely backwards. WEP is actually the weakest encryption scheme due to fundamental flaws in its RC4 implementation and short IV space. WPA2 is stronger than WPA, and both are significantly more secure than WEP. The statement also incorrectly describes the relative vulnerabilities.',
                    'Correct - This accurately describes the key differences: Both WEP and WPA use the RC4 stream cipher, but WEP uses a problematic 24-bit Initialization Vector that leads to IV collisions and cryptographic weaknesses. WPA improved upon WEP by implementing TKIP (Temporal Key Integrity Protocol) which provides better key management and integrity checking. WPA2 represents a major advancement by using AES (Advanced Encryption Standard) instead of RC4, providing much stronger encryption.',
                    'Incorrect - The strength ranking is wrong. WPA2 is actually the strongest, followed by WPA, then WEP. WEP has fundamental design flaws that make it vulnerable regardless of password strength or authentication method. The statement incorrectly positions WPA as the strongest option.',
                ],
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'status' => 'published',
                'type_id' => 1,
                'irt_a' => 1.6,
                'irt_b' => 0.7,
                'irt_c' => 0.20,
            ],

            // Item 35 - L3 - Apply
            [
                'topic' => 'Wireless Security',
                'subtopic' => 'Wireless Security',
                'question' => 'An organization wants to provide guest wireless access while protecting their internal network. What approach should they implement?',
                'options' => [
                    'Give guests access to the main corporate network',
                    'Create a separate guest network with internet-only access',
                    'Disable wireless access entirely',
                    'Use WEP encryption for guest access',
                ],
                'correct_options' => ['Create a separate guest network with internet-only access'],
                'justifications' => [
                    'Incorrect - Give guests access to the main corporate network',
                    'Correct - Create a separate guest network with internet-only access',
                    'Incorrect - Disable wireless access entirely',
                    'Incorrect - Use WEP encryption for guest access',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'status' => 'published',
                'type_id' => 1,
                'irt_a' => 1.5,
                'irt_b' => 0.2,
                'irt_c' => 0.25,
            ],

            // Item 36 - L3 - Apply
            [
                'topic' => 'Wireless Security',
                'subtopic' => 'Wireless Security',
                'question' => 'How should a company secure wireless access for employee devices in a BYOD environment?',
                'options' => [
                    'Use open wireless networks for simplicity',
                    'Implement WPA3-Enterprise with certificate-based authentication',
                    'Share a single wireless password among all employees',
                    'Only allow company-issued devices on wireless networks',
                ],
                'correct_options' => ['Implement WPA3-Enterprise with certificate-based authentication'],
                'justifications' => [
                    'Incorrect - Use open wireless networks for simplicity',
                    'Correct - Implement WPA3-Enterprise with certificate-based authentication',
                    'Incorrect - Share a single wireless password among all employees',
                    'Incorrect - Only allow company-issued devices on wireless networks',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'status' => 'published',
                'type_id' => 1,
                'irt_a' => 1.4,
                'irt_b' => 0.4,
                'irt_c' => 0.25,
            ],

            // Item 37 - L3 - Apply
            [
                'topic' => 'Wireless Security',
                'subtopic' => 'Wireless Security',
                'question' => 'What is the most effective approach for detecting rogue wireless access points?',
                'options' => [
                    'Visual inspection of network equipment only',
                    'Deploy wireless intrusion detection systems and conduct regular RF surveys',
                    'Rely on employee reports of unknown networks',
                    'Use only wired network monitoring tools',
                ],
                'correct_options' => ['Deploy wireless intrusion detection systems and conduct regular RF surveys'],
                'justifications' => [
                    'Incorrect - Visual inspection of network equipment only',
                    'Correct - Deploy wireless intrusion detection systems and conduct regular RF surveys',
                    'Incorrect - Rely on employee reports of unknown networks',
                    'Incorrect - Use only wired network monitoring tools',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'status' => 'published',
                'type_id' => 1,
                'irt_a' => 1.6,
                'irt_b' => 0.6,
                'irt_c' => 0.25,
            ],

            // Item 38 - L4 - Analyze
            [
                'topic' => 'Wireless Security',
                'subtopic' => 'Wireless Security',
                'question' => 'Analyze the security implications of using public Wi-Fi networks for business communications.',
                'options' => [
                    'Public Wi-Fi networks are always secure',
                    'Unencrypted traffic can be intercepted, requiring VPN or application-level encryption',
                    'Public Wi-Fi is more secure than private networks',
                    'Business communications are automatically protected on public Wi-Fi',
                ],
                'correct_options' => ['Unencrypted traffic can be intercepted, requiring VPN or application-level encryption'],
                'justifications' => [
                    'Incorrect - Public Wi-Fi networks are always secure',
                    'Correct - Unencrypted traffic can be intercepted, requiring VPN or application-level encryption',
                    'Incorrect - Public Wi-Fi is more secure than private networks',
                    'Incorrect - Business communications are automatically protected on public Wi-Fi',
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
                'topic' => 'Wireless Security',
                'subtopic' => 'Wireless Security',
                'question' => 'What is the fundamental challenge in securing IoT devices on wireless networks?',
                'options' => [
                    'IoT devices are inherently secure',
                    'Many IoT devices have weak authentication and are difficult to update',
                    'IoT devices only connect to wired networks',
                    'Wireless networks cannot support IoT devices',
                ],
                'correct_options' => ['Many IoT devices have weak authentication and are difficult to update'],
                'justifications' => [
                    'Incorrect - IoT devices are inherently secure',
                    'Correct - Many IoT devices have weak authentication and are difficult to update',
                    'Incorrect - IoT devices only connect to wired networks',
                    'Incorrect - Wireless networks cannot support IoT devices',
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
                'topic' => 'Wireless Security',
                'subtopic' => 'Wireless Security',
                'question' => 'Evaluate the decision to implement a "wireless-first" office environment from a security perspective.',
                'options' => [
                    'Wireless networks are always more secure than wired networks',
                    'Requires enhanced security measures but offers flexibility; needs careful architecture design',
                    'Wireless networks should never be used for business purposes',
                    'Security is identical between wireless and wired networks',
                ],
                'correct_options' => ['Requires enhanced security measures but offers flexibility; needs careful architecture design'],
                'justifications' => [
                    'Incorrect - Wireless networks are always more secure than wired networks',
                    'Correct - Requires enhanced security measures but offers flexibility; needs careful architecture design',
                    'Incorrect - Wireless networks should never be used for business purposes',
                    'Incorrect - Security is identical between wireless and wired networks',
                ],
                'bloom_level' => 5,
                'difficulty_level' => 5,
                'status' => 'published',
                'type_id' => 1,
                'irt_a' => 1.9,
                'irt_b' => 1.4,
                'irt_c' => 0.15,
            ],

            // Topic 5: Network Monitoring & Tools (10 questions)
            // Bloom Distribution: L1:2, L2:2, L3:3, L4:2, L5:1

            // Item 41 - L2 - Understand
            [
                'topic' => 'Network Monitoring & Tools',
                'subtopic' => 'Network Diagnostic Tools',
                'question' => 'Which of the following Nmap commands would you use to perform a SYN scan on a target network?',
                'options' => [
                    'nmap -sU 192.168.1.1',
                    'nmap -O 192.168.1.1',
                    'nmap -sS 192.168.1.1',
                    'nmap -A 192.168.1.1',
                ],
                'correct_options' => ['nmap -sS 192.168.1.1'],
                'justifications' => [
                    'Incorrect - The -sU flag performs a UDP scan, not a SYN scan. UDP scans send UDP packets to target ports to identify open UDP services, which is different from the TCP SYN scanning technique that sends TCP SYN packets.',
                    'Incorrect - The -O flag is used for operating system detection, not for performing SYN scans. This option attempts to identify the target\'s operating system by analyzing TCP/IP stack characteristics, but does not specify the scanning method.',
                    'Correct - The -sS flag specifically performs a TCP SYN scan, also known as a "stealth scan" or "half-open scan". This technique sends TCP SYN packets to target ports and analyzes the responses to determine if ports are open, closed, or filtered. It\'s called a half-open scan because it doesn\'t complete the full TCP three-way handshake, making it less likely to be logged by the target system.',
                    'Incorrect - The -A flag performs an aggressive scan that includes multiple techniques (OS detection, version detection, script scanning, and traceroute) but does not specifically indicate that a SYN scan method will be used. While -A may use SYN scanning as part of its comprehensive approach, it\'s not the specific command for performing a SYN scan.',
                ],
                'bloom_level' => 2,
                'difficulty_level' => 2,
                'status' => 'published',
                'type_id' => 1,
                'irt_a' => 1.0,
                'irt_b' => -0.8,
                'irt_c' => 0.25,
            ],

            // Item 42 - L3 - Apply
            [
                'topic' => 'Network Monitoring & Tools',
                'subtopic' => 'Network Diagnostic Tools',
                'question' => 'Which of the following Nmap commands would most effectively scan a network for open ports and services while also detecting the operating system and version of running services on the target machines?',
                'options' => [
                    'nmap -sP 192.168.1.0/24',
                    'nmap -O -sV 192.168.1.0/24',
                    'nmap -A 192.168.1.0/24',
                    'nmap -sT 192.168.1.0/24',
                ],
                'correct_options' => ['nmap -A 192.168.1.0/24'],
                'justifications' => [
                    'Incorrect - The -sP flag (or -sn in newer versions) performs a ping sweep to discover live hosts but does not scan for open ports, services, operating systems, or service versions. This command only determines which hosts are reachable on the network.',
                    'Incorrect - While -O performs operating system detection and -sV performs service version detection, this combination does not provide the most comprehensive scan. The -A flag includes both of these features plus additional capabilities like script scanning and traceroute, making it more effective for complete network reconnaissance.',
                    'Correct - The -A flag performs an "aggressive" scan that combines multiple reconnaissance techniques: port scanning, operating system detection (-O), service version detection (-sV), script scanning (--script=default), and traceroute. This provides the most comprehensive information about open ports, running services, OS identification, and service versions in a single command.',
                    'Incorrect - The -sT flag performs a TCP connect scan to identify open ports but does not include operating system detection or service version identification. While it will find open ports and services, it lacks the OS and version detection capabilities specified in the question.',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'status' => 'published',
                'type_id' => 1,
                'irt_a' => 1.3,
                'irt_b' => 0.1,
                'irt_c' => 0.25,
            ],

            // Item 43 - L3 - Apply
            [
                'topic' => 'Network Monitoring & Tools',
                'subtopic' => 'Network Diagnostic Tools',
                'question' => 'Which of the following scenarios best demonstrates the use of the dig (Domain Information Groper) command in troubleshooting DNS issues, and what specific option would be most useful in diagnosing an incorrect DNS resolution?',
                'options' => [
                    'You want to retrieve the mail exchange (MX) records for a domain to diagnose email delivery issues. Using dig domain.com MX will provide you with the necessary DNS information.',
                    'You want to flush the local DNS cache to ensure you\'re getting the latest records. Using dig -flush domain.com will clear the DNS cache.',
                    'You want to see all the DNS records for a domain in a human-readable format. Using dig domain.com ALL will display all DNS records in detail.',
                    'You want to identify whether the DNS server itself is misconfigured. Using dig -x domain.com will allow you to reverse lookup the IP address and compare results.',
                ],
                'correct_options' => ['You want to retrieve the mail exchange (MX) records for a domain to diagnose email delivery issues. Using dig domain.com MX will provide you with the necessary DNS information.'],
                'justifications' => [
                    'Correct - This is a perfect use case for the dig command. When troubleshooting email delivery issues, you need to verify the mail exchange (MX) records for a domain to ensure they are properly configured and pointing to the correct mail servers. The syntax `dig domain.com MX` will query specifically for MX records, showing the priority and mail server hostnames responsible for handling email for that domain.',
                    'Incorrect - The dig command does not have a -flush option and cannot clear DNS cache. DNS cache flushing is typically done at the operating system level using commands like `sudo systemctl flush-dns` (Linux), `ipconfig /flushdns` (Windows), or `sudo dscacheutil -flushcache` (macOS). The dig command is purely for querying DNS servers, not manipulating local cache.',
                    'Incorrect - While you can query multiple record types with dig, the correct syntax is not `dig domain.com ALL`. To see multiple DNS records, you would use `dig domain.com ANY` or query specific record types individually (A, AAAA, MX, NS, TXT, etc.). The "ALL" keyword is not a valid dig option.',
                    'Incorrect - The -x option in dig is used for reverse DNS lookups (PTR records), which requires an IP address as input, not a domain name. The correct syntax would be `dig -x 192.168.1.1` to find the hostname associated with an IP address. Using -x with a domain name would result in an error or invalid query.',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'status' => 'published',
                'type_id' => 1,
                'irt_a' => 1.4,
                'irt_b' => 0.2,
                'irt_c' => 0.25,
            ],

            // Item 44 - L2 - Understand
            [
                'topic' => 'Network Monitoring & Tools',
                'subtopic' => 'Network Diagnostic Tools',
                'question' => 'How does behavioral analysis enhance traditional signature-based detection?',
                'options' => [
                    'Behavioral analysis is slower than signature-based detection',
                    'It can identify previously unknown threats by detecting abnormal network behavior',
                    'It only works with encrypted traffic',
                    'It replaces the need for signature updates',
                ],
                'correct_options' => ['It can identify previously unknown threats by detecting abnormal network behavior'],
                'justifications' => [
                    'Incorrect - Behavioral analysis is slower than signature-based detection',
                    'Correct - It can identify previously unknown threats by detecting abnormal network behavior',
                    'Incorrect - It only works with encrypted traffic',
                    'Incorrect - It replaces the need for signature updates',
                ],
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'status' => 'published',
                'type_id' => 1,
                'irt_a' => 1.3,
                'irt_b' => -0.1,
                'irt_c' => 0.25,
            ],

            // Item 45 - L3 - Apply (Simulation)
            [
                'topic' => 'Network Monitoring & Tools',
                'subtopic' => 'Network Diagnostic Tools',
                'question' => 'As a security analyst responding to suspicious activity reported on the internal system **intranet.saazcorp.local**, verify whether the host is reachable from your workstation using the command line.',
                'options' => [
                    'Host is reachable with <15ms latency',
                    'Request timed out – no reply received',
                    'Unknown host – name resolution failed',
                    'Network unreachable – routing issue',
                ],
                'correct_options' => ['Host is reachable with <15ms latency'],
                'justifications' => [
                    'Correct - The simulated ping output shows successful ICMP replies with latency below 15ms (0.87-0.91ms), confirming reachability. The ping statistics show 3 packets transmitted, 3 received, 0% packet loss, which indicates the host intranet.saazcorp.local at IP 10.10.10.25 is fully reachable and responding normally to ICMP echo requests.',
                    'Incorrect - This would occur if there were no ICMP responses, which is not the case here. The ping output clearly shows successful replies from 10.10.10.25 with consistent response times, indicating the host is responding properly to network connectivity tests.',
                    'Incorrect - This would appear if DNS resolution failed to resolve the hostname to an IP address. However, the ping shows a successfully resolved IP address (10.10.10.25) for intranet.saazcorp.local, indicating DNS resolution is working correctly.',
                    'Incorrect - This message appears for unreachable routes or firewall drops where packets cannot reach the destination. Here, replies are received successfully with normal TTL values (63), showing proper network routing and no firewall blocking.',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'status' => 'published',
                'type_id' => 7, // Simulation
                'irt_a' => 1.4,
                'irt_b' => 0.3,
                'irt_c' => 0.25,
                'simulation_settings' => [
                    'shell' => 'bash',
                    'clear_command' => 'clear',
                    'available_commands' => [
                        'ping intranet.saazcorp.local',
                        'ping -c 3 intranet.saazcorp.local',
                        'ping -c 4 intranet.saazcorp.local',
                        'ping -c 5 intranet.saazcorp.local',
                    ],
                    'target_response' => 'PING intranet.saazcorp.local (10.10.10.25) 56(84) bytes of data.\n64 bytes from 10.10.10.25: icmp_seq=1 ttl=63 time=0.89 ms\n64 bytes from 10.10.10.25: icmp_seq=2 ttl=63 time=0.91 ms\n64 bytes from 10.10.10.25: icmp_seq=3 ttl=63 time=0.87 ms\n\n--- intranet.saazcorp.local ping statistics ---\n3 packets transmitted, 3 received, 0% packet loss, time 2012ms\nrtt min/avg/max/mdev = 0.87/0.89/0.91/0.02 ms',
                ],
            ],

            // Item 46 - L3 - Apply
            [
                'topic' => 'Network Monitoring & Tools',
                'subtopic' => 'Network Diagnostic Tools',
                'question' => 'How should an organization implement network monitoring for a hybrid cloud environment?',
                'options' => [
                    'Use only on-premises monitoring tools',
                    'Deploy monitoring across on-premises and cloud environments with centralized correlation',
                    'Rely solely on cloud provider monitoring',
                    'Monitor only external network connections',
                ],
                'correct_options' => ['Deploy monitoring across on-premises and cloud environments with centralized correlation'],
                'justifications' => [
                    'Incorrect - Use only on-premises monitoring tools',
                    'Correct - Deploy monitoring across on-premises and cloud environments with centralized correlation',
                    'Incorrect - Rely solely on cloud provider monitoring',
                    'Incorrect - Monitor only external network connections',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'status' => 'published',
                'type_id' => 1,
                'irt_a' => 1.5,
                'irt_b' => 0.4,
                'irt_c' => 0.25,
            ],

            // Item 47 - L4 - Analyze (Simulation)
            [
                'topic' => 'Network Monitoring & Tools',
                'subtopic' => 'Network Diagnostic Tools',
                'question' => 'You\'re investigating failed remote login attempts to the internal VPN system **vpn.saazcorp.local**. Use an appropriate command-line tool to analyze the network path and identify where communication to the host is breaking.',
                'options' => [
                    'The connection is dropping at the firewall (10.10.20.1)',
                    'The destination is reachable with minimal latency',
                    'The DNS resolution for vpn.saazcorp.local failed',
                    'The failure occurs at the first hop (local gateway)',
                ],
                'correct_options' => ['The connection is dropping at the firewall (10.10.20.1)'],
                'justifications' => [
                    'Correct - Hop 4 (10.10.20.1) shows no response (*), indicating packets are blocked or dropped there. The traceroute shows successful progression through the first three hops (192.168.1.1, 172.16.0.1, 10.10.10.1) but fails consistently at hop 4 with "Request timed out", which corresponds to the firewall at 10.10.20.1. This is a classic pattern when a firewall is blocking traffic or not configured to respond to traceroute probes.',
                    'Incorrect - If the trace had reached all hops, including the destination (10.10.30.5), this would be true — but it doesn\'t. The traceroute output shows timeouts starting at hop 4, indicating the destination is not reachable and the path is broken somewhere in the network infrastructure.',
                    'Incorrect - Since the resolved IP address (10.10.30.5) is visible in the traceroute output header, DNS resolution succeeded properly. The issue is not with name resolution but with network connectivity along the path to the destination.',
                    'Incorrect - The trace shows the first hop (192.168.1.1) responded successfully with 1ms latency, so the issue isn\'t at the local gateway. The problem occurs later in the path, specifically at hop 4 where the firewall is located.',
                ],
                'bloom_level' => 4,
                'difficulty_level' => 3,
                'status' => 'published',
                'type_id' => 7, // Simulation
                'irt_a' => 1.6,
                'irt_b' => 0.6,
                'irt_c' => 0.20,
                'simulation_settings' => [
                    'shell' => 'bash',
                    'clear_command' => 'clear',
                    'available_commands' => [
                        'traceroute vpn.saazcorp.local',
                        'tracert vpn.saazcorp.local',
                        'traceroute -n vpn.saazcorp.local',
                        'tracert -n vpn.saazcorp.local',
                    ],
                    'target_response' => 'Tracing route to vpn.saazcorp.local [10.10.30.5]...\n 1     1 ms     1 ms     1 ms  192.168.1.1\n 2     2 ms     2 ms     2 ms  172.16.0.1\n 3     3 ms     3 ms     3 ms  10.10.10.1\n 4     *        *        *     Request timed out.\n 5     *        *        *     Request timed out.\nTrace complete.',
                    'network_topology' => [
                        'hop_1' => '192.168.1.1 (Local Gateway)',
                        'hop_2' => '172.16.0.1 (ISP Router)',
                        'hop_3' => '10.10.10.1 (Corporate Network)',
                        'hop_4' => '10.10.20.1 (Firewall - BLOCKED)',
                        'destination' => '10.10.30.5 (VPN Server)',
                    ],
                ],
            ],

            // Item 48 - L4 - Analyze (Simulation)
            [
                'topic' => 'Network Monitoring & Tools',
                'subtopic' => 'Network Diagnostic Tools',
                'question' => 'As part of a lateral movement investigation, you are tasked with identifying open TCP ports on the internal web server **srv-web1.saazcorp.local**. Use `nmap` to scan the system and determine which services are reachable.',
                'options' => [
                    'Ports 22 and 443 are open (SSH and HTTPS)',
                    'Only port 80 is open (HTTP)',
                    'No ports are open — host is unreachable',
                    'Only port 21 is open (FTP)',
                ],
                'correct_options' => ['Ports 22 and 443 are open (SSH and HTTPS)'],
                'justifications' => [
                    'Correct - The `nmap` output clearly shows port 22 (SSH) and port 443 (HTTPS) as open. These are commonly used for secure administration (SSH) and secure web services (HTTPS). The scan results consistently show "22/tcp open ssh" and "443/tcp open https" across different nmap scan types, indicating these services are actively listening and responding to connection attempts.',
                    'Incorrect - Port 80 appears as "closed" in the scan result — it is not available. The nmap output specifically shows "80/tcp closed http", meaning the port is not accepting connections. A closed port indicates the host is reachable but no service is listening on that specific port.',
                    'Incorrect - The scan completes successfully and identifies open ports, so the host is reachable. The nmap output shows "Host is up" with latency measurements (around 1ms), confirming network connectivity to srv-web1.saazcorp.local at IP address 10.10.40.15.',
                    'Incorrect - Port 21 (FTP) is not listed as open in any of the scan outputs, hence this is incorrect. FTP service is not running on this web server, which is common in secure environments where SSH is used instead of FTP for file transfers.',
                ],
                'bloom_level' => 4,
                'difficulty_level' => 3,
                'status' => 'published',
                'type_id' => 7, // Simulation
                'irt_a' => 1.7,
                'irt_b' => 0.8,
                'irt_c' => 0.20,
                'simulation_settings' => [
                    'shell' => 'bash',
                    'clear_command' => 'clear',
                    'available_commands' => [
                        'nmap srv-web1.saazcorp.local',
                        'nmap -F srv-web1.saazcorp.local',
                        'nmap -p- srv-web1.saazcorp.local',
                        'nmap -Pn srv-web1.saazcorp.local',
                        'nmap -sS srv-web1.saazcorp.local',
                    ],
                    'target_host' => 'srv-web1.saazcorp.local (10.10.40.15)',
                    'open_ports' => [
                        '22/tcp' => 'ssh',
                        '443/tcp' => 'https',
                    ],
                    'closed_ports' => [
                        '80/tcp' => 'http',
                        '5432/tcp' => 'postgresql',
                        '8080/tcp' => 'http-proxy',
                    ],
                    'filtered_ports' => [
                        '3306/tcp' => 'mysql',
                    ],
                ],
            ],

            // Item 49 - L4 - Analyze (Simulation)
            [
                'topic' => 'Network Monitoring & Tools',
                'subtopic' => 'Network Diagnostic Tools',
                'question' => 'Using the command line and `nmap`, determine the **operating system** of the host **core-db.saazcorp.local**.',
                'options' => [
                    'Linux 5.X (Ubuntu or Debian)',
                    'Windows Server 2016',
                    'FreeBSD 12.X',
                    'OS detection failed due to insufficient privileges',
                ],
                'correct_options' => ['Linux 5.X (Ubuntu or Debian)'],
                'justifications' => [
                    'Correct - The `nmap -O` command output shows OS detection results with "Running: Linux 5.X" and "OS details: Linux 5.3 - 5.10 (Ubuntu or Debian based)" with high confidence (95%). The TCP/IP stack fingerprint analysis, along with service signatures like "OpenSSH 8.4p1 Debian 5" and "MySQL 5.7.42-0ubuntu0.18.04.1", clearly identifies this as a Linux system running Ubuntu or Debian.',
                    'Incorrect - Windows Server would show completely different TCP/IP fingerprint characteristics, different service implementations, and would be identified with Microsoft-specific signatures in the OS detection output. The services running (OpenSSH, MySQL with Ubuntu-specific version strings) are not typical of Windows Server environments.',
                    'Incorrect - FreeBSD would have a different TCP stack signature, different service behaviors, and would be specifically identified as FreeBSD in the nmap OS detection. The kernel version format and service implementations shown are characteristic of Linux, not BSD systems.',
                    'Incorrect - The scan completed successfully without any privilege-related errors. The OS detection was performed successfully and shows detailed results including device type, running OS, CPE identifiers, and confidence percentages. If there were privilege issues, nmap would display specific error messages about requiring root access.',
                ],
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'status' => 'published',
                'type_id' => 7, // Simulation
                'irt_a' => 1.8,
                'irt_b' => 1.0,
                'irt_c' => 0.20,
                'simulation_settings' => [
                    'shell' => 'bash',
                    'clear_command' => 'clear',
                    'error_messages' => [
                        'command_not_found' => '$COMMAND: command not found',
                        'permission_denied' => '$COMMAND: permission denied',
                    ],
                    'available_commands' => [
                        'nmap -O core-db.saazcorp.local',
                        'nmap -A core-db.saazcorp.local',
                        'nmap core-db.saazcorp.local',
                        'nmap -O --osscan-limit core-db.saazcorp.local',
                        'nmap -O -Pn core-db.saazcorp.local',
                    ],
                    'target_host' => 'core-db.saazcorp.local (10.10.99.22)',
                    'detected_os' => 'Linux 5.3 - 5.10 (Ubuntu or Debian based)',
                    'services' => [
                        '22/tcp' => 'OpenSSH 8.4p1 Debian 5',
                        '3306/tcp' => 'MySQL 5.7.42-0ubuntu0.18.04.1',
                    ],
                    'confidence' => '95%',
                ],
            ],

            // Item 50 - L5 - Evaluate
            [
                'topic' => 'Network Monitoring & Tools',
                'subtopic' => 'Network Diagnostic Tools',
                'question' => 'Evaluate the effectiveness of implementing AI-powered network monitoring versus traditional rule-based systems.',
                'options' => [
                    'AI systems are always superior to rule-based monitoring',
                    'AI can identify subtle patterns but may produce false positives and requires careful tuning',
                    'Rule-based systems are always more accurate than AI',
                    'AI and rule-based systems provide identical results',
                ],
                'correct_options' => ['AI can identify subtle patterns but may produce false positives and requires careful tuning'],
                'justifications' => [
                    'Incorrect - AI systems are always superior to rule-based monitoring',
                    'Correct - AI can identify subtle patterns but may produce false positives and requires careful tuning',
                    'Incorrect - Rule-based systems are always more accurate than AI',
                    'Incorrect - AI and rule-based systems provide identical results',
                ],
                'bloom_level' => 5,
                'difficulty_level' => 5,
                'status' => 'published',
                'type_id' => 1,
                'irt_a' => 1.9,
                'irt_b' => 1.5,
                'irt_c' => 0.15,
            ],
        ];
    }
}
