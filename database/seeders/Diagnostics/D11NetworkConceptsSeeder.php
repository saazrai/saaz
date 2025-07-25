<?php

namespace Database\Seeders\Diagnostics;

class D11NetworkConceptsSeeder extends BaseDiagnosticSeeder
{
    protected string $domainName = 'Network Concepts';
    
    protected function getQuestions(): array
    {
        return [
            // Topic 1: OSI Model (10 questions)
            // Bloom Distribution: L1:1, L2:2, L3:3, L4:2, L5:2
            
            // Item 1 - L1 - Remember
            [
                'type_id' => 1,
                'subtopic' => 'OSI Model',
                'question' => 'What are the seven layers of the OSI model in order from bottom to top?',

                'options' => [
                    'Application, Presentation, Session, Transport, Network, Data Link, Physical',
                    'Physical, Data Link, Network, Transport, Session, Presentation, Application',
                    'Physical, Network, Data Link, Transport, Session, Application, Presentation',
                    'Application, Session, Presentation, Transport, Network, Physical, Data Link'
                ],
                'correct_options' => ['Physical, Data Link, Network, Transport, Session, Presentation, Application'],
                'justifications' => [
                    'Incorrect - This shows the layers in reverse order, from top to bottom',
                    'Correct - The OSI model layers from bottom to top are Physical, Data Link, Network, Transport, Session, Presentation, Application',
                    'Incorrect - The order is mixed up with Network and Data Link swapped',
                    'Incorrect - The order is completely jumbled'
                ],
                'bloom_level' => 1,
                'difficulty_level' => 1,
                'status' => 'published',
                'irt_a' => 0.8,
                'irt_b' => -1.5,
                'irt_c' => 0.25
            ],
            
            // Item 2 - L2 - Understand
            [
                'type_id' => 1,
                'subtopic' => 'OSI Model',
                'question' => 'What is the main objective behind the creation of the OSI (Open Systems Interconnection) model?',

                'options' => [
                    'To provide cross-platform portability for different operating systems',
                    'To establish a layered approach for securing network communication',
                    'To create universal hardware standards for network equipment',
                    'To promote interoperability between different network systems and protocols'
                ],
                'correct_options' => ['To promote interoperability between different network systems and protocols'],
                'justifications' => [
                    'Incorrect - While the OSI model does facilitate some cross-platform compatibility, its primary purpose is not operating system portability. The model focuses on network communication layers rather than operating system compatibility, and cross-platform portability is more of a secondary benefit than the main objective.',
                    'Incorrect - Although security can be implemented at various OSI layers, establishing a layered security approach was not the main objective behind creating the OSI model. Security considerations came later as networks evolved, but the original goal was standardizing communication protocols and interfaces.',
                    'Incorrect - The OSI model is a conceptual framework that defines how different network functions should be organized, not a hardware standard. It does not specify particular hardware requirements or create universal hardware standards, but rather provides a logical structure for network communication.',
                    'Correct - The primary objective of the OSI model was to promote interoperability between different network systems and protocols by providing a standardized, layered framework. This allows different vendors and technologies to communicate effectively by following the same architectural principles and interface standards.'
                ],
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'status' => 'published',
                'irt_a' => 1.3,
                'irt_b' => -0.4,
                'irt_c' => 0.25
            ],
            
            // Item 3 - L2 - Understand
            [
                'type_id' => 1,
                'subtopic' => 'OSI Model',
                'question' => 'Which OSI layer is responsible for ensuring error-free delivery of data packets over a network, often through retransmission mechanisms?',
                'options' => [
                    'Layer 2 - Data Link',
                    'Layer 3 – Network',
                    'Layer 4 – Transport',
                    'Layer 7 – Application'
                ],
                'correct_options' => ['Layer 4 – Transport'],
                'justifications' => [
                    'Incorrect - Layer 2 (Data Link) handles error detection and correction within a single network segment but does not provide end-to-end error-free delivery across multiple network segments',
                    'Incorrect - Layer 3 (Network) is responsible for routing packets between networks but does not guarantee error-free delivery or handle retransmissions',
                    'Correct - Layer 4 (Transport) is responsible for end-to-end error-free delivery of data, including error detection, correction, and retransmission mechanisms (e.g., TCP)',
                    'Incorrect - Layer 7 (Application) provides network services to applications but does not handle low-level error correction and retransmission'
                ],
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'status' => 'published',
                'irt_a' => 1.3,
                'irt_b' => -0.2,
                'irt_c' => 0.25
            ],
            
            // Item 4 - L2 - Understand
            [
                'type_id' => 1,
                'subtopic' => 'OSI Model',
                'question' => 'Which of the following operates at Layer 1 of the OSI model?',
                'options' => [
                    'Switch',
                    'Hub',
                    'Router',
                    'Firewall'
                ],
                'correct_options' => ['Hub'],
                'justifications' => [
                    'Incorrect - A switch operates at Layer 2 (Data Link) as it makes forwarding decisions based on MAC addresses and maintains a MAC address table',
                    'Correct - A hub operates at Layer 1 (Physical) as it simply repeats electrical signals to all connected devices without any intelligence about MAC addresses or data content',
                    'Incorrect - A router operates at Layer 3 (Network) as it makes forwarding decisions based on IP addresses and routing tables',
                    'Incorrect - A firewall typically operates at Layer 3 (Network) and above, examining IP addresses, ports, and application data to make security decisions'
                ],
                'bloom_level' => 2,
                'difficulty_level' => 2,
                'status' => 'published',
                'irt_a' => 1.2,
                'irt_b' => -0.3,
                'irt_c' => 0.25
            ],
            
            // Item 5 - L3 - Apply
            [
                'type_id' => 1,
                'subtopic' => 'OSI Model',
                'question' => 'When designing a secure network architecture, which OSI layers should implement security controls for defense in depth?',

                'options' => [
                    'Only the Application Layer (Layer 7)',
                    'Multiple layers to provide redundant security controls',
                    'Only the Network Layer (Layer 3)',
                    'Only the Physical Layer (Layer 1)'
                ],
                'correct_options' => ['Multiple layers to provide redundant security controls'],
                'justifications' => [
                    'Incorrect - Only the Application Layer (Layer 7)',
                    'Correct - Multiple layers to provide redundant security controls',
                    'Incorrect - Only the Network Layer (Layer 3)',
                    'Incorrect - Only the Physical Layer (Layer 1)'
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'status' => 'published',
                'irt_a' => 1.5,
                'irt_b' => 0.3,
                'irt_c' => 0.25
            ],
            
            // Item 6 - L3 - Apply
            [
                'type_id' => 1,
                'subtopic' => 'OSI Model',
                'question' => 'How should a network administrator apply the OSI model when implementing a new enterprise network?',

                'options' => [
                    'Focus only on Layer 3 routing decisions',
                    'Consider each layer\'s requirements and interactions for comprehensive design',
                    'Start with Layer 7 applications and work down',
                    'Implement layers independently without consideration of others'
                ],
                'correct_options' => ['Start with Layer 7 applications and work down'],
                'justifications' => [
                    'Incorrect - Focus only on Layer 3 routing decisions',
                    'Correct - Start with Layer 7 applications and work down',
                    'Incorrect - Implement layers independently without consideration of others'
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'status' => 'published',
                'irt_a' => 1.4,
                'irt_b' => 0.5,
                'irt_c' => 0.25
            ],
            
            // Item 7 - L4 - Analyze
            [
                'type_id' => 1,
                'subtopic' => 'OSI Model',
                'question' => 'Analyze why modern networks often blur the boundaries between OSI layers in practice.',

                'options' => [
                    'The OSI model is outdated and no longer relevant',
                    'Performance optimization and feature integration drive layer convergence',
                    'Modern protocols only operate at Layer 3',
                    'Hardware limitations prevent proper layer separation'
                ],
                'correct_options' => ['Performance optimization and feature integration drive layer convergence'],
                'justifications' => [
                    'Incorrect - The OSI model is outdated and no longer relevant',
                    'Correct - Performance optimization and feature integration drive layer convergence',
                    'Incorrect - Modern protocols only operate at Layer 3',
                    'Incorrect - Hardware limitations prevent proper layer separation'
                ],
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'status' => 'published',
                'irt_a' => 1.7,
                'irt_b' => 0.8,
                'irt_c' => 0.20
            ],
            
            // Item 8 - L4 - Analyze
            [
                'type_id' => 1,
                'subtopic' => 'OSI Model',
                'question' => 'What is the fundamental challenge in applying the OSI model to modern software-defined networking (SDN)?',

                'options' => [
                    'SDN eliminates the need for layered models',
                    'Control plane abstraction changes traditional layer boundaries and functions',
                    'SDN only operates at the Physical Layer',
                    'The OSI model cannot handle programmable networks'
                ],
                'correct_options' => ['Control plane abstraction changes traditional layer boundaries and functions'],
                'justifications' => [
                    'Incorrect - SDN eliminates the need for layered models',
                    'Correct - Control plane abstraction changes traditional layer boundaries and functions',
                    'Incorrect - SDN only operates at the Physical Layer',
                    'Incorrect - The OSI model cannot handle programmable networks'
                ],
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'status' => 'published',
                'irt_a' => 1.8,
                'irt_b' => 1.0,
                'irt_c' => 0.20
            ],
            
            // Item 9 - L5 - Evaluate
            [
                'type_id' => 1,
                'subtopic' => 'OSI Model',
                'question' => 'Evaluate the effectiveness of using the OSI model as the primary framework for teaching network security concepts in modern cybersecurity programs.',

                'options' => [
                    'Highly effective as it covers all necessary security concepts',
                    'Partially effective but should be supplemented with practical threat models',
                    'Completely ineffective for security education',
                    'Only effective for physical security concepts'
                ],
                'correct_options' => ['Partially effective but should be supplemented with practical threat models'],
                'justifications' => [
                    'Incorrect - Highly effective as it covers all necessary security concepts',
                    'Correct - Partially effective but should be supplemented with practical threat models',
                    'Incorrect - Completely ineffective for security education',
                    'Incorrect - Only effective for physical security concepts'
                ],
                'bloom_level' => 5,
                'difficulty_level' => 5,
                'status' => 'published',
                'irt_a' => 1.9,
                'irt_b' => 1.3,
                'irt_c' => 0.15
            ],
            
            // Item 10 - L5 - Evaluate
            [
                'type_id' => 1,
                'subtopic' => 'OSI Model',
                'question' => 'Assess the relevance of strict OSI layer adherence in cloud-native application architectures.',

                'options' => [
                    'Essential for all cloud applications',
                    'Less critical due to abstraction layers and service-oriented architectures',
                    'More important than ever for cloud security',
                    'Only relevant for infrastructure-as-a-service deployments'
                ],
                'correct_options' => ['Less critical due to abstraction layers and service-oriented architectures'],
                'justifications' => [
                    'Incorrect - Essential for all cloud applications',
                    'Correct - Less critical due to abstraction layers and service-oriented architectures',
                    'Incorrect - More important than ever for cloud security',
                    'Incorrect - Only relevant for infrastructure-as-a-service deployments'
                ],
                'bloom_level' => 5,
                'difficulty_level' => 5,
                'status' => 'published',
                'irt_a' => 2.0,
                'irt_b' => 1.5,
                'irt_c' => 0.15
            ],
            
            // Topic 2: TCP/IP Protocols (10 questions)
            // Bloom Distribution: L1:1, L2:2, L3:3, L4:2, L5:2
            
            // Item 11 - L1 - Remember
            [
                'type_id' => 1,
                'subtopic' => 'TCP/IP Protocols',
                'question' => 'What are the four layers of the TCP/IP model?',

                'options' => [
                    'Application, Transport, Internet, Network Access',
                    'Application, Session, Network, Physical',
                    'Presentation, Transport, Network, Data Link',
                    'Application, Internet, Transport, Physical'
                ],
                'correct_options' => ['Application, Transport, Internet, Network Access'],
                'justifications' => [
                    'Correct - Application, Transport, Internet, Network Access',
                    'Incorrect - Application, Session, Network, Physical',
                    'Incorrect - Presentation, Transport, Network, Data Link',
                    'Incorrect - Application, Internet, Transport, Physical'
                ],
                'bloom_level' => 1,
                'difficulty_level' => 1,
                'status' => 'published',
                'irt_a' => 0.9,
                'irt_b' => -1.3,
                'irt_c' => 0.25
            ],
            
            // Item 12 - L3 - Apply
            [
                'type_id' => 1,
                'subtopic' => 'TCP/IP Protocols',
                'question' => 'An application uses UDP to stream live video. If a few packets are lost during transmission, the video might briefly pixelate but continues playing without significant interruption. If the same application were to use TCP, how would the loss of those same packets impact the video stream differently?',
                'options' => [
                    'The video stream would be unaffected, as TCP would automatically re-route the packets.',
                    'The video stream would likely pause or freeze until the lost packets are successfully retransmitted.',
                    'TCP would convert the lost packets into audio data.',
                    'TCP would prioritize the lost packets over new data, resulting in faster streaming.'
                ],
                'correct_options' => ['The video stream would likely pause or freeze until the lost packets are successfully retransmitted.'],
                'justifications' => [
                    'Incorrect - TCP does not re-route packets; that is a routing function handled by routers. TCP retransmits lost packets through the same network path, which introduces delays rather than solving connectivity issues.',
                    'Correct - TCP guarantees ordered, reliable delivery of all data. When packets are lost, TCP automatically retransmits them and will not deliver subsequent data to the application until missing packets arrive. This creates buffering delays that cause video to pause or freeze while waiting for retransmissions, making real-time data stale.',
                    'Incorrect - TCP is a transport protocol that does not modify data content or convert between different types of media. It simply ensures reliable delivery of whatever data the application provides.',
                    'Incorrect - While TCP does retransmit lost packets, this slows down streaming rather than making it faster, as new video frames must wait in buffers until older missing frames are successfully retransmitted and delivered in order.'
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'status' => 'published',
                'irt_a' => 1.4,
                'irt_b' => 0.1,
                'irt_c' => 0.25
            ],
            
            // Item 13 - L2 - Understand
            [
                'type_id' => 1,
                'subtopic' => 'TCP/IP Protocols',
                'question' => 'Why might an application choose UDP over TCP for data transmission?',

                'options' => [
                    'UDP is more secure than TCP',
                    'UDP provides lower latency and overhead for time-sensitive applications',
                    'UDP offers better error correction',
                    'UDP works better over long distances'
                ],
                'correct_options' => ['UDP provides lower latency and overhead for time-sensitive applications'],
                'justifications' => [
                    'Incorrect - UDP is more secure than TCP',
                    'Correct - UDP provides lower latency and overhead for time-sensitive applications',
                    'Incorrect - UDP offers better error correction',
                    'Incorrect - UDP works better over long distances'
                ],
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'status' => 'published',
                'irt_a' => 1.4,
                'irt_b' => -0.1,
                'irt_c' => 0.25
            ],
            
            // Item 14 - L2 - Understand
            [
                'type_id' => 1,
                'subtopic' => 'TCP/IP Protocols',
                'question' => 'A network administrator receives a "Destination Host Unreachable" message from a router when attempting to ping a remote server. Which TCP/IP protocol is responsible for generating this error message?',
                'options' => [
                    'TCP (Transmission Control Protocol)',
                    'UDP (User Datagram Protocol)',
                    'ICMP (Internet Control Message Protocol)',
                    'ARP (Address Resolution Protocol)'
                ],
                'correct_options' => ['ICMP (Internet Control Message Protocol)'],
                'justifications' => [
                    'Incorrect - TCP handles reliable data delivery between applications at the Transport Layer (Layer 4) and does not generate network-level error messages about unreachable destinations.',
                    'Incorrect - UDP provides unreliable datagram delivery at the Transport Layer (Layer 4) and does not include error reporting mechanisms for network connectivity issues.',
                    'Correct - ICMP (Internet Control Message Protocol) is specifically designed for network diagnostics and error reporting at the Network Layer (Layer 3). When a router cannot forward a packet to its destination, it generates an ICMP Destination Unreachable message back to the sender.',
                    'Incorrect - ARP resolves IP addresses to MAC addresses within local network segments at the Data Link Layer (Layer 2) and only works for local network communication, not remote server connectivity.'
                ],
                'bloom_level' => 2,
                'difficulty_level' => 2,
                'status' => 'published',
                'irt_a' => 1.3,
                'irt_b' => -0.2,
                'irt_c' => 0.25
            ],
            
            // Item 15 - L3 - Apply
            [
                'type_id' => 1,
                'subtopic' => 'TCP/IP Protocols',
                'question' => 'How should a network engineer configure Quality of Service (QoS) for different types of network traffic?',

                'options' => [
                    'Treat all traffic equally for fairness',
                    'Prioritize based on application requirements and business needs',
                    'Always prioritize TCP over UDP traffic',
                    'Prioritize based on packet size only'
                ],
                'correct_options' => ['Prioritize based on application requirements and business needs'],
                'justifications' => [
                    'Incorrect - Treat all traffic equally for fairness',
                    'Correct - Prioritize based on application requirements and business needs',
                    'Incorrect - Always prioritize TCP over UDP traffic',
                    'Incorrect - Prioritize based on packet size only'
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'status' => 'published',
                'irt_a' => 1.4,
                'irt_b' => 0.4,
                'irt_c' => 0.25
            ],
            
            // Item 16 - L2 - Understand
            [
                'type_id' => 1,
                'subtopic' => 'TCP/IP Protocols',
                'question' => 'Which of the following is a valid IPv6 address, and why does it conform to IPv6 addressing rules?',
                'options' => [
                    '2001:0db8:85a3::8a2e:0370:7334',
                    '192.168.1.1:5000:abcd::1234',
                    '2001::85a3::8a2e:7334',
                    '2001:db8:85a3:2e1g:8a2e:370:7334'
                ],
                'correct_options' => ['2001:0db8:85a3::8a2e:0370:7334'],
                'justifications' => [
                    'Correct - This is a valid IPv6 address using proper hexadecimal notation (0-9, a-f) with 8 groups of 4 hex digits. The double colon (::) correctly represents consecutive zero groups and appears only once, which is allowed in IPv6 to compress multiple consecutive zero groups.',
                    'Incorrect - This mixes IPv4 (192.168.1.1) and IPv6 notation incorrectly. IPv6 addresses use only hexadecimal digits (0-9, a-f) separated by colons, not decimal numbers separated by periods. The format 192.168.1.1:5000 suggests a port number, which is not part of the IP address itself.',
                    'Incorrect - This violates the IPv6 rule that double colon (::) can only appear once in an address. Having multiple :: sequences (2001::85a3::8a2e:7334) creates ambiguity about how many zero groups each :: represents, making the address invalid.',
                    'Incorrect - This contains an invalid hexadecimal character \'g\' in the fourth group (2e1g). IPv6 addresses can only use hexadecimal digits 0-9 and a-f (case insensitive). Any character outside this range makes the address invalid.'
                ],
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'status' => 'published',
                'irt_a' => 1.4,
                'irt_b' => -0.1,
                'irt_c' => 0.25
            ],
            
            // Item 17 - L4 - Analyze
            [
                'type_id' => 1,
                'subtopic' => 'TCP/IP Protocols',
                'question' => 'Analyze the security implications of the stateless nature of the IP protocol.',

                'options' => [
                    'Stateless protocols are inherently more secure',
                    'Lack of connection state can enable IP spoofing and routing attacks',
                    'Stateless design has no security impact',
                    'Stateless protocols prevent all network attacks'
                ],
                'correct_options' => ['Lack of connection state can enable IP spoofing and routing attacks'],
                'justifications' => [
                    'Incorrect - Stateless protocols are inherently more secure',
                    'Correct - Lack of connection state can enable IP spoofing and routing attacks',
                    'Incorrect - Stateless design has no security impact',
                    'Incorrect - Stateless protocols prevent all network attacks'
                ],
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'status' => 'published',
                'irt_a' => 1.7,
                'irt_b' => 0.9,
                'irt_c' => 0.20
            ],
            
            // Item 18 - L4 - Analyze
            [
                'type_id' => 1,
                'subtopic' => 'TCP/IP Protocols',
                'question' => 'What is the fundamental challenge in securing protocols that were designed without security considerations?',

                'options' => [
                    'Legacy protocols cannot be secured',
                    'Security must be added as overlay solutions, creating complexity',
                    'Only authentication can be added to legacy protocols',
                    'Legacy protocols are automatically secure'
                ],
                'correct_options' => ['Security must be added as overlay solutions, creating complexity'],
                'justifications' => [
                    'Incorrect - Legacy protocols cannot be secured',
                    'Correct - Security must be added as overlay solutions, creating complexity',
                    'Incorrect - Only authentication can be added to legacy protocols',
                    'Incorrect - Legacy protocols are automatically secure'
                ],
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'status' => 'published',
                'irt_a' => 1.8,
                'irt_b' => 1.1,
                'irt_c' => 0.20
            ],
            
            // Item 19 - L5 - Evaluate
            [
                'type_id' => 1,
                'subtopic' => 'TCP/IP Protocols',
                'question' => 'Evaluate the long-term viability of TCP as the primary reliable transport protocol for emerging IoT and edge computing applications.',

                'options' => [
                    'TCP will remain optimal for all future applications',
                    'TCP\'s overhead may be problematic for resource-constrained environments',
                    'TCP is irrelevant for IoT applications',
                    'Only UDP should be used for IoT communications'
                ],
                'correct_options' => ['TCP is irrelevant for IoT applications'],
                'justifications' => [
                    'Incorrect - TCP will remain optimal for all future applications',
                    'Correct - TCP is irrelevant for IoT applications',
                    'Incorrect - Only UDP should be used for IoT communications'
                ],
                'bloom_level' => 5,
                'difficulty_level' => 5,
                'status' => 'published',
                'irt_a' => 1.9,
                'irt_b' => 1.4,
                'irt_c' => 0.15
            ],
            
            // Item 20 - L5 - Evaluate
            [
                'type_id' => 1,
                'subtopic' => 'TCP/IP Protocols',
                'question' => 'Assess the effectiveness of current IPv6 adoption strategies in addressing both technical and business requirements.',

                'options' => [
                    'Current strategies are perfectly effective',
                    'Mixed effectiveness due to dual-stack complexity and gradual transition challenges',
                    'IPv6 adoption strategies are completely ineffective',
                    'Technical adoption is complete, only business adoption remains'
                ],
                'correct_options' => ['Mixed effectiveness due to dual-stack complexity and gradual transition challenges'],
                'justifications' => [
                    'Incorrect - Current strategies are perfectly effective',
                    'Correct - Mixed effectiveness due to dual-stack complexity and gradual transition challenges',
                    'Incorrect - IPv6 adoption strategies are completely ineffective',
                    'Incorrect - Technical adoption is complete, only business adoption remains'
                ],
                'bloom_level' => 5,
                'difficulty_level' => 5,
                'status' => 'published',
                'irt_a' => 2.0,
                'irt_b' => 1.3,
                'irt_c' => 0.15
            ],
            
            // Topic 3: Network Appliances (10 questions)
            // Bloom Distribution: L1:2, L2:2, L3:3, L4:2, L5:1
            
            // Item 21 - L1 - Remember
            [
                'type_id' => 1,
                'subtopic' => 'Network Appliances',
                'question' => 'What is the primary function of a network switch?',
                'options' => [
                    'Connecting different network segments at Layer 2',
                    'Providing wireless connectivity',
                    'Converting analog signals to digital',
                    'Encrypting network traffic'
                ],
                'correct_options' => ['Connecting different network segments at Layer 2'],
                'justifications' => [
                    'Correct - Connecting different network segments at Layer 2',
                    'Incorrect - Providing wireless connectivity',
                    'Incorrect - Converting analog signals to digital',
                    'Incorrect - Encrypting network traffic'
                ],
                'bloom_level' => 1,
                'difficulty_level' => 1,
                'status' => 'published',
                'irt_a' => 0.8,
                'irt_b' => -1.4,
                'irt_c' => 0.25
            ],
            
            // Item 22 - L1 - Remember
            [
                'type_id' => 1,
                'subtopic' => 'Network Appliances',
                'question' => 'What is the difference between a hub and a switch?',
                'options' => [
                    'Hubs are faster than switches',
                    'Switches create separate collision domains while hubs share one collision domain',
                    'Hubs operate at Layer 3 while switches operate at Layer 2',
                    'Switches are wireless while hubs are wired'
                ],
                'correct_options' => ['Switches create separate collision domains while hubs share one collision domain'],
                'justifications' => [
                    'Incorrect - Hubs are faster than switches',
                    'Correct - Switches create separate collision domains while hubs share one collision domain',
                    'Incorrect - Hubs operate at Layer 3 while switches operate at Layer 2',
                    'Incorrect - Switches are wireless while hubs are wired'
                ],
                'bloom_level' => 1,
                'difficulty_level' => 1,
                'status' => 'published',
                'irt_a' => 0.9,
                'irt_b' => -1.2,
                'irt_c' => 0.25
            ],
            
            // Item 23 - L2 - Understand
            [
                'type_id' => 1,
                'subtopic' => 'Network Appliances',
                'question' => 'Why do enterprise networks use VLANs?',
                'options' => [
                    'To increase network speed',
                    'To logically segment networks for security and management',
                    'To reduce hardware costs',
                    'To improve wireless connectivity'
                ],
                'correct_options' => ['To logically segment networks for security and management'],
                'justifications' => [
                    'Incorrect - To increase network speed',
                    'Correct - To logically segment networks for security and management',
                    'Incorrect - To reduce hardware costs',
                    'Incorrect - To improve wireless connectivity'
                ],
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'status' => 'published',
                'irt_a' => 1.2,
                'irt_b' => -0.5,
                'irt_c' => 0.25
            ],
            
            // Item 24 - L2 - Understand
            [
                'type_id' => 1,
                'subtopic' => 'Network Appliances',
                'question' => 'How does Spanning Tree Protocol (STP) prevent network loops?',
                'options' => [
                    'By encrypting all network traffic',
                    'By blocking redundant paths and creating a loop-free topology',
                    'By increasing bandwidth on all links',
                    'By limiting the number of devices per network'
                ],
                'correct_options' => ['By blocking redundant paths and creating a loop-free topology'],
                'justifications' => [
                    'Incorrect - By encrypting all network traffic',
                    'Correct - By blocking redundant paths and creating a loop-free topology',
                    'Incorrect - By increasing bandwidth on all links',
                    'Incorrect - By limiting the number of devices per network'
                ],
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'status' => 'published',
                'irt_a' => 1.3,
                'irt_b' => -0.2,
                'irt_c' => 0.25
            ],
            
            // Item 25 - L3 - Apply
            [
                'type_id' => 1,
                'subtopic' => 'Network Appliances',
                'question' => 'An organization needs to connect three buildings with high-speed, reliable connectivity. What infrastructure approach would be most appropriate?',
                'options' => [
                    'Use wireless connections between all buildings',
                    'Implement fiber optic connections with redundant paths',
                    'Use standard Ethernet cables between buildings',
                    'Rely on internet-based VPN connections'
                ],
                'correct_options' => ['Implement fiber optic connections with redundant paths'],
                'justifications' => [
                    'Incorrect - Use wireless connections between all buildings',
                    'Correct - Implement fiber optic connections with redundant paths',
                    'Incorrect - Use standard Ethernet cables between buildings',
                    'Incorrect - Rely on internet-based VPN connections'
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'status' => 'published',
                'irt_a' => 1.4,
                'irt_b' => 0.2,
                'irt_c' => 0.25
            ],
            
            // Item 26 - L3 - Apply
            [
                'type_id' => 1,
                'subtopic' => 'Network Appliances',
                'question' => 'How should a network administrator design VLAN segmentation for a company with departments that have different security requirements?',
                'options' => [
                    'Put all devices on the same VLAN for simplicity',
                    'Create separate VLANs based on security zones and department functions',
                    'Use VLANs only for wireless devices',
                    'Assign VLANs randomly to balance load'
                ],
                'correct_options' => ['Create separate VLANs based on security zones and department functions'],
                'justifications' => [
                    'Incorrect - Put all devices on the same VLAN for simplicity',
                    'Correct - Create separate VLANs based on security zones and department functions',
                    'Incorrect - Use VLANs only for wireless devices',
                    'Incorrect - Assign VLANs randomly to balance load'
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'status' => 'published',
                'irt_a' => 1.5,
                'irt_b' => 0.4,
                'irt_c' => 0.25
            ],
            
            // Item 27 - L3 - Apply
            [
                'type_id' => 1,
                'subtopic' => 'Network Appliances',
                'question' => 'What is the most effective approach for implementing network redundancy in a critical business environment?',
                'options' => [
                    'Use only the fastest single connection',
                    'Implement multiple paths with automatic failover mechanisms',
                    'Add more devices to the same network segment',
                    'Increase bandwidth on existing connections'
                ],
                'correct_options' => ['Implement multiple paths with automatic failover mechanisms'],
                'justifications' => [
                    'Incorrect - Use only the fastest single connection',
                    'Correct - Implement multiple paths with automatic failover mechanisms',
                    'Incorrect - Add more devices to the same network segment',
                    'Incorrect - Increase bandwidth on existing connections'
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'status' => 'published',
                'irt_a' => 1.6,
                'irt_b' => 0.6,
                'irt_c' => 0.25
            ],
            
            // Item 28 - L4 - Analyze
            [
                'type_id' => 1,
                'subtopic' => 'Network Appliances',
                'question' => 'Analyze the trade-offs between Layer 2 and Layer 3 switching in modern data center architectures.',
                'options' => [
                    'Layer 2 switching is always superior to Layer 3',
                    'Layer 3 provides better scalability and security but increases complexity',
                    'Layer 3 switching is only useful for WAN connections',
                    'There are no significant differences between the approaches'
                ],
                'correct_options' => ['Layer 3 provides better scalability and security but increases complexity'],
                'justifications' => [
                    'Incorrect - Layer 2 switching is always superior to Layer 3',
                    'Correct - Layer 3 provides better scalability and security but increases complexity',
                    'Incorrect - Layer 3 switching is only useful for WAN connections',
                    'Incorrect - There are no significant differences between the approaches'
                ],
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'status' => 'published',
                'irt_a' => 1.7,
                'irt_b' => 0.8,
                'irt_c' => 0.20
            ],
            
            // Item 29 - L4 - Analyze
            [
                'type_id' => 1,
                'subtopic' => 'Network Appliances',
                'question' => 'What is the fundamental challenge in managing east-west traffic in modern data center networks?',
                'options' => [
                    'East-west traffic is always encrypted',
                    'Traditional north-south architectures don\'t optimize for inter-server communication',
                    'East-west traffic only occurs during maintenance windows',
                    'East-west traffic requires special hardware'
                ],
                'correct_options' => ['East-west traffic only occurs during maintenance windows'],
                'justifications' => [
                    'Incorrect - East-west traffic is always encrypted',
                    'Correct - East-west traffic only occurs during maintenance windows',
                    'Incorrect - East-west traffic requires special hardware'
                ],
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'status' => 'published',
                'irt_a' => 1.8,
                'irt_b' => 1.0,
                'irt_c' => 0.20
            ],
            
            // Item 30 - L5 - Evaluate
            [
                'type_id' => 1,
                'subtopic' => 'Network Appliances',
                'question' => 'Evaluate the decision to implement software-defined networking (SDN) instead of traditional network architectures for a large enterprise.',
                'options' => [
                    'SDN is always the better choice for all organizations',
                    'SDN offers flexibility and centralized control but requires new skills and introduces complexity',
                    'Traditional networking is always more reliable than SDN',
                    'SDN is only suitable for small networks'
                ],
                'correct_options' => ['SDN offers flexibility and centralized control but requires new skills and introduces complexity'],
                'justifications' => [
                    'Incorrect - SDN is always the better choice for all organizations',
                    'Correct - SDN offers flexibility and centralized control but requires new skills and introduces complexity',
                    'Incorrect - Traditional networking is always more reliable than SDN',
                    'Incorrect - SDN is only suitable for small networks'
                ],
                'bloom_level' => 5,
                'difficulty_level' => 5,
                'status' => 'published',
                'irt_a' => 1.9,
                'irt_b' => 1.5,
                'irt_c' => 0.15
            ],
            
            // Topic 4: Network Services (10 questions)
            // Bloom Distribution: L1:2, L2:2, L3:3, L4:2, L5:1
            
            // Item 31 - L1 - Remember
            [
                'type_id' => 1,
                'subtopic' => 'Network Services',
                'question' => 'What is the primary function of DNS?',
                'options' => [
                    'Encrypting network communications',
                    'Translating domain names to IP addresses',
                    'Managing network bandwidth',
                    'Monitoring network performance'
                ],
                'correct_options' => ['Translating domain names to IP addresses'],
                'justifications' => [
                    'Incorrect - Encrypting network communications',
                    'Correct - Translating domain names to IP addresses',
                    'Incorrect - Managing network bandwidth',
                    'Incorrect - Monitoring network performance'
                ],
                'bloom_level' => 1,
                'difficulty_level' => 1,
                'status' => 'published',
                'irt_a' => 0.8,
                'irt_b' => -1.5,
                'irt_c' => 0.25
            ],
            
            // Item 32 - L1 - Remember
            [
                'type_id' => 1,
                'subtopic' => 'Network Services',
                'question' => 'What protocol does DHCP use to automatically assign IP addresses?',
                'options' => [
                    'TCP',
                    'UDP',
                    'ICMP',
                    'ARP'
                ],
                'correct_options' => ['UDP'],
                'justifications' => [
                    'Incorrect - TCP',
                    'Correct - UDP',
                    'Incorrect - ICMP',
                    'Incorrect - ARP'
                ],
                'bloom_level' => 1,
                'difficulty_level' => 1,
                'status' => 'published',
                'irt_a' => 0.9,
                'irt_b' => -1.3,
                'irt_c' => 0.25
            ],
            
            // Item 33 - L2 - Understand
            [
                'type_id' => 1,
                'subtopic' => 'Network Services',
                'question' => 'Why is DNS caching important for network performance?',
                'options' => [
                    'It improves network security',
                    'It reduces DNS query response time and network traffic',
                    'It increases DNS server capacity',
                    'It prevents DNS attacks'
                ],
                'correct_options' => ['It reduces DNS query response time and network traffic'],
                'justifications' => [
                    'Incorrect - It improves network security',
                    'Correct - It reduces DNS query response time and network traffic',
                    'Incorrect - It increases DNS server capacity',
                    'Incorrect - It prevents DNS attacks'
                ],
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'status' => 'published',
                'irt_a' => 1.2,
                'irt_b' => -0.4,
                'irt_c' => 0.25
            ],
            
            // Item 34 - L2 - Understand
            [
                'type_id' => 1,
                'subtopic' => 'Network Services',
                'question' => 'How does DHCP lease management work?',
                'options' => [
                    'IP addresses are assigned permanently',
                    'IP addresses are assigned for a specific time period and must be renewed',
                    'DHCP only assigns static IP addresses',
                    'DHCP assigns IP addresses randomly without tracking'
                ],
                'correct_options' => ['IP addresses are assigned for a specific time period and must be renewed'],
                'justifications' => [
                    'Incorrect - IP addresses are assigned permanently',
                    'Correct - IP addresses are assigned for a specific time period and must be renewed',
                    'Incorrect - DHCP only assigns static IP addresses',
                    'Incorrect - DHCP assigns IP addresses randomly without tracking'
                ],
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'status' => 'published',
                'irt_a' => 1.3,
                'irt_b' => -0.1,
                'irt_c' => 0.25
            ],
            
            // Item 35 - L3 - Apply
            [
                'type_id' => 1,
                'subtopic' => 'Network Services',
                'question' => 'A company wants to ensure employees can access internal resources using friendly names instead of IP addresses. What solution should they implement?',
                'options' => [
                    'Require employees to memorize IP addresses',
                    'Set up internal DNS servers with appropriate zone configurations',
                    'Use only external DNS services',
                    'Implement static host files on all devices'
                ],
                'correct_options' => ['Set up internal DNS servers with appropriate zone configurations'],
                'justifications' => [
                    'Incorrect - Require employees to memorize IP addresses',
                    'Correct - Set up internal DNS servers with appropriate zone configurations',
                    'Incorrect - Use only external DNS services',
                    'Incorrect - Implement static host files on all devices'
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'status' => 'published',
                'irt_a' => 1.4,
                'irt_b' => 0.2,
                'irt_c' => 0.25
            ],
            
            // Item 36 - L3 - Apply
            [
                'type_id' => 1,
                'subtopic' => 'Network Services',
                'question' => 'How should a network administrator configure DHCP for a network with both permanent servers and dynamic client devices?',
                'options' => [
                    'Use DHCP for all devices without exceptions',
                    'Use static IP addresses for servers and DHCP reservations for critical devices',
                    'Use only static IP addresses for all devices',
                    'Configure random IP assignment for all devices'
                ],
                'correct_options' => ['Use static IP addresses for servers and DHCP reservations for critical devices'],
                'justifications' => [
                    'Incorrect - Use DHCP for all devices without exceptions',
                    'Correct - Use static IP addresses for servers and DHCP reservations for critical devices',
                    'Incorrect - Use only static IP addresses for all devices',
                    'Incorrect - Configure random IP assignment for all devices'
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'status' => 'published',
                'irt_a' => 1.5,
                'irt_b' => 0.4,
                'irt_c' => 0.25
            ],
            
            // Item 37 - L3 - Apply
            [
                'type_id' => 1,
                'subtopic' => 'Network Services',
                'question' => 'What is the most secure approach for implementing time synchronization across an enterprise network?',
                'options' => [
                    'Allow each device to use internet time servers directly',
                    'Deploy internal NTP servers with authentication and restrict external access',
                    'Use different time sources for each department',
                    'Disable time synchronization for security'
                ],
                'correct_options' => ['Deploy internal NTP servers with authentication and restrict external access'],
                'justifications' => [
                    'Incorrect - Allow each device to use internet time servers directly',
                    'Correct - Deploy internal NTP servers with authentication and restrict external access',
                    'Incorrect - Use different time sources for each department',
                    'Incorrect - Disable time synchronization for security'
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'status' => 'published',
                'irt_a' => 1.6,
                'irt_b' => 0.6,
                'irt_c' => 0.25
            ],
            
            // Item 38 - L4 - Analyze
            [
                'type_id' => 1,
                'subtopic' => 'Network Services',
                'question' => 'Analyze the security risks of traditional DNS and why DNS over HTTPS (DoH) was developed.',
                'options' => [
                    'Traditional DNS has no security risks',
                    'DNS queries are sent in plaintext, enabling eavesdropping and manipulation',
                    'DoH was developed only for performance reasons',
                    'Traditional DNS is too slow for modern applications'
                ],
                'correct_options' => ['DNS queries are sent in plaintext, enabling eavesdropping and manipulation'],
                'justifications' => [
                    'Incorrect - Traditional DNS has no security risks',
                    'Correct - DNS queries are sent in plaintext, enabling eavesdropping and manipulation',
                    'Incorrect - DoH was developed only for performance reasons',
                    'Incorrect - Traditional DNS is too slow for modern applications'
                ],
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'status' => 'published',
                'irt_a' => 1.7,
                'irt_b' => 0.9,
                'irt_c' => 0.20
            ],
            
            // Item 39 - L4 - Analyze
            [
                'type_id' => 1,
                'subtopic' => 'Network Services',
                'question' => 'Which of the following best describes how a DHCP starvation attack is carried out and its impact on network availability?',
                'options' => [
                    'A DHCP starvation attack involves overwhelming the DHCP server with repeated invalid requests, forcing it to crash and deny network access to legitimate devices.',
                    'A DHCP starvation attack occurs when an attacker floods the DHCP server with requests from spoofed MAC addresses, exhausting the available IP address pool, and forcing legitimate users to connect to a rogue DHCP server set up by the attacker.',
                    'A DHCP starvation attack uses man-in-the-middle techniques to intercept DHCP requests and modify IP configurations, redirecting network traffic to malicious servers.',
                    'A DHCP starvation attack manipulates the lease time on IP addresses, ensuring that legitimate users frequently lose their IP configuration and are forced to reconnect.'
                ],
                'correct_options' => ['A DHCP starvation attack occurs when an attacker floods the DHCP server with requests from spoofed MAC addresses, exhausting the available IP address pool, and forcing legitimate users to connect to a rogue DHCP server set up by the attacker.'],
                'justifications' => [
                    'Incorrect - DHCP servers typically handle invalid requests gracefully. The attack relies on valid requests with spoofed MAC addresses, not invalid ones. The goal is pool exhaustion through resource consumption, not server crashes.',
                    'Correct - A DHCP starvation attack floods the DHCP server with massive numbers of requests using different spoofed MAC addresses. Each request appears to come from a unique device, causing the server to allocate IP addresses from its pool until exhaustion. When legitimate users cannot obtain IP addresses, they may be forced to accept configuration from the attacker\'s rogue DHCP server.',
                    'Incorrect - This describes a different attack vector focused on traffic interception. DHCP starvation is about resource exhaustion of the IP address pool, not man-in-the-middle interception of existing DHCP traffic.',
                    'Incorrect - DHCP starvation attacks do not manipulate existing lease times. The attack focuses on consuming all available IP addresses through rapid requests with spoofed identities, not modifying lease parameters of existing allocations.'
                ],
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'status' => 'published',
                'irt_a' => 1.7,
                'irt_b' => 0.8,
                'irt_c' => 0.20
            ],
            
            // Item 40 - L3 - Apply (Simulation)
            [
                'type_id' => 7, // Simulation
                'subtopic' => 'Network Diagnostic Tools',
                'question' => 'Using the command line, determine the **MAC address** of the primary network interface (eth0) on this system. (You may use Linux or Windows commands)',
                'options' => [
                    '00:1B:44:11:3A:B7',
                    '02:42:AC:11:00:02',
                    '00:0C:29:4F:8E:35',
                    'A8:6D:AA:5F:92:C4'
                ],
                'correct_options' => ['00:1B:44:11:3A:B7'],
                'justifications' => [
                    'Correct - This is the correct MAC address of the primary network interface (eth0). You can verify this using commands like \'ifconfig\', \'ip addr\', \'ipconfig /all\' (Windows), or \'getmac\'. The MAC address appears in the network interface configuration output in formats like \'ether 00:1b:44:11:3a:b7\' (Linux) or \'Physical Address. . . . . . . . . : 00-1B-44-11-3A-B7\' (Windows).',
                    'Incorrect - This appears to be a Docker container\'s virtual MAC address (02:42:AC:11:00:02), not the primary network interface. Docker containers typically use MAC addresses starting with 02:42 for their virtual network interfaces, which are different from the host system\'s physical interface MAC address.',
                    'Incorrect - This looks like a VMware virtual machine\'s MAC address (00:0C:29:4F:8E:35), not the primary physical interface. VMware assigns MAC addresses starting with 00:0C:29 to virtual machines, but this simulation is asking for the primary network interface of the host system.',
                    'Incorrect - While this is a valid MAC address format (A8:6D:AA:5F:92:C4), it is not the MAC address of the primary network interface (eth0) on this system. You can verify the correct MAC address by examining the output of network configuration commands which will show the actual hardware address assigned to the interface.'
                ],
                'bloom_level' => 3,
                'difficulty_level' => 2,
                'status' => 'published',
                'irt_a' => 1.2,
                'irt_b' => -0.5,
                'irt_c' => 0.25,
                'simulation_settings' => [
                    'shell' => 'bash',
                    'clear_command' => 'clear',
                    'error_messages' => [
                        'command_not_found' => '$COMMAND: command not found',
                        'permission_denied' => '$COMMAND: permission denied'
                    ],
                    'available_commands' => [
                        'ifconfig',
                        'ifconfig eth0',
                        'ip addr',
                        'ip link',
                        'cat /sys/class/net/eth0/address',
                        'getmac',
                        'ipconfig /all',
                        'wmic nic get macaddress',
                        'arp -a'
                    ]
                ]
            ],
            
            // Topic 5: Communication Protocols (10 questions)
            // Bloom Distribution: L1:2, L2:2, L3:3, L4:2, L5:1
            
            // Item 41 - L1 - Remember
            [
                'type_id' => 1,
                'subtopic' => 'Communication Protocols',
                'question' => 'You are configuring a network device that needs to forward packets to different networks based on their destination IP addresses. The device examines the destination IP address in each packet, consults its routing table to determine the best path to the destination network, and then forwards the packet to the appropriate next-hop device. At which layer of the OSI model would this device primarily operate to make its forwarding decisions, and what data unit is it processing?',
                'options' => [
                    'Physical Layer (Layer 1) - processing bits',
                    'Data Link Layer (Layer 2) - processing frames',
                    'Network Layer (Layer 3) - processing packets',
                    'Transport Layer (Layer 4) - processing segments'
                ],
                'correct_options' => ['Network Layer (Layer 3) - processing packets'],
                'justifications' => [
                    'Incorrect - The Physical Layer (Layer 1) deals with the transmission of raw bits over physical media such as cables, radio waves, or optical signals. While routing devices have physical interfaces, the routing decision-making process described in the question does not occur at this layer. Layer 1 is concerned with electrical signals, not IP addresses or routing tables.',
                    'Incorrect - The Data Link Layer (Layer 2) handles communication between adjacent network nodes on the same local network segment using MAC addresses. While routers do process frames at Layer 2 for local delivery, the routing decision based on destination IP addresses and routing tables is not a Layer 2 function. Layer 2 switching uses MAC address tables, not IP routing tables.',
                    'Correct - The Network Layer (Layer 3) is responsible for logical addressing using IP addresses and routing packets between different networks. The scenario describes classic Layer 3 functionality: examining destination IP addresses, consulting routing tables, determining best paths, and forwarding packets to next-hop devices. Routers operate primarily at Layer 3, and the data unit they process for routing decisions is the packet, which contains the IP header with source and destination IP addresses.',
                    'Incorrect - The Transport Layer (Layer 4) is responsible for end-to-end communication, reliability, flow control, and error recovery using port numbers. While routers may examine Layer 4 information for advanced features like QoS or firewall functions, the basic routing decision described in the question (forwarding based on destination IP addresses) is purely a Layer 3 function. Segments are the data unit at Layer 4, not the primary concern for basic IP routing.'
                ],
                'bloom_level' => 1,
                'difficulty_level' => 1,
                'status' => 'published',
                'irt_a' => 0.8,
                'irt_b' => -1.4,
                'irt_c' => 0.25
            ],
            
            // Item 42 - L3 - Apply
            [
                'type_id' => 1,
                'subtopic' => 'Communication Protocols',
                'question' => 'How should a network engineer design routing table entries for a multi-site organization with redundant connections?',
                'options' => [
                    'Use only static routes with single paths to each destination',
                    'Implement multiple routes with different metrics for automatic failover',
                    'Configure identical routing entries on all routers',
                    'Rely only on default routes without specific destination entries'
                ],
                'correct_options' => ['Implement multiple routes with different metrics for automatic failover'],
                'justifications' => [
                    'Incorrect - Single paths create single points of failure',
                    'Correct - Multiple routes with different metrics provide redundancy and automatic failover capability',
                    'Incorrect - Identical entries don\'t account for topology differences',
                    'Incorrect - Default routes alone don\'t provide optimal path selection'
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'status' => 'published',
                'irt_a' => 1.4,
                'irt_b' => 0.2,
                'irt_c' => 0.25
            ],
            
            // Item 43 - L2 - Understand
            [
                'type_id' => 1,
                'subtopic' => 'Communication Protocols',
                'question' => 'How do dynamic routing protocols like OSPF help network scalability?',
                'options' => [
                    'They increase bandwidth automatically',
                    'They automatically adapt to network changes and calculate optimal paths',
                    'They reduce the number of required routers',
                    'They eliminate the need for network planning'
                ],
                'correct_options' => ['They automatically adapt to network changes and calculate optimal paths'],
                'justifications' => [
                    'Incorrect - They increase bandwidth automatically',
                    'Correct - They automatically adapt to network changes and calculate optimal paths',
                    'Incorrect - They reduce the number of required routers',
                    'Incorrect - They eliminate the need for network planning'
                ],
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'status' => 'published',
                'irt_a' => 1.2,
                'irt_b' => -0.3,
                'irt_c' => 0.25
            ],
            
            // Item 44 - L2 - Understand
            [
                'type_id' => 1,
                'subtopic' => 'Communication Protocols',
                'question' => 'Why is the default gateway important for network communication?',
                'options' => [
                    'It provides DNS resolution services',
                    'It enables devices to communicate outside their local network',
                    'It manages wireless connections',
                    'It provides network authentication'
                ],
                'correct_options' => ['It enables devices to communicate outside their local network'],
                'justifications' => [
                    'Incorrect - It provides DNS resolution services',
                    'Correct - It enables devices to communicate outside their local network',
                    'Incorrect - It manages wireless connections',
                    'Incorrect - It provides network authentication'
                ],
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'status' => 'published',
                'irt_a' => 1.3,
                'irt_b' => -0.1,
                'irt_c' => 0.25
            ],
            
            // Item 45 - L3 - Apply
            [
                'type_id' => 1,
                'subtopic' => 'Communication Protocols',
                'question' => 'A company needs to connect multiple branch offices to headquarters with automatic failover. What routing approach would be most appropriate?',
                'options' => [
                    'Use only static routes for simplicity',
                    'Implement dynamic routing protocols with redundant paths',
                    'Use a single connection per branch office',
                    'Rely only on default routes'
                ],
                'correct_options' => ['Implement dynamic routing protocols with redundant paths'],
                'justifications' => [
                    'Incorrect - Use only static routes for simplicity',
                    'Correct - Implement dynamic routing protocols with redundant paths',
                    'Incorrect - Use a single connection per branch office',
                    'Incorrect - Rely only on default routes'
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'status' => 'published',
                'irt_a' => 1.4,
                'irt_b' => 0.3,
                'irt_c' => 0.25
            ],
            
            // Item 46 - L3 - Apply
            [
                'type_id' => 1,
                'subtopic' => 'Communication Protocols',
                'question' => 'How should a network engineer implement load balancing across multiple internet connections?',
                'options' => [
                    'Use only the fastest connection',
                    'Configure equal-cost multi-path routing or policy-based routing',
                    'Alternate connections manually each day',
                    'Use connections for different applications randomly'
                ],
                'correct_options' => ['Configure equal-cost multi-path routing or policy-based routing'],
                'justifications' => [
                    'Incorrect - Use only the fastest connection',
                    'Correct - Configure equal-cost multi-path routing or policy-based routing',
                    'Incorrect - Alternate connections manually each day',
                    'Incorrect - Use connections for different applications randomly'
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'status' => 'published',
                'irt_a' => 1.5,
                'irt_b' => 0.4,
                'irt_c' => 0.25
            ],
            
            // Item 47 - L3 - Apply
            [
                'type_id' => 1,
                'subtopic' => 'Communication Protocols',
                'question' => 'What is the most effective approach for implementing inter-VLAN routing in an enterprise network?',
                'options' => [
                    'Use separate physical connections for each VLAN',
                    'Implement router-on-a-stick or Layer 3 switching',
                    'Avoid inter-VLAN communication entirely',
                    'Use hubs to connect different VLANs'
                ],
                'correct_options' => ['Implement router-on-a-stick or Layer 3 switching'],
                'justifications' => [
                    'Incorrect - Use separate physical connections for each VLAN',
                    'Correct - Implement router-on-a-stick or Layer 3 switching',
                    'Incorrect - Avoid inter-VLAN communication entirely',
                    'Incorrect - Use hubs to connect different VLANs'
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'status' => 'published',
                'irt_a' => 1.6,
                'irt_b' => 0.6,
                'irt_c' => 0.25
            ],
            
            // Item 48 - L4 - Analyze
            [
                'type_id' => 1,
                'subtopic' => 'Communication Protocols',
                'question' => 'Analyze the security implications of dynamic routing protocols in enterprise networks.',
                'options' => [
                    'Dynamic routing protocols have no security implications',
                    'Lack of authentication can enable routing table poisoning and traffic redirection',
                    'Dynamic routing is always more secure than static routing',
                    'Security is only a concern for external routing protocols'
                ],
                'correct_options' => ['Lack of authentication can enable routing table poisoning and traffic redirection'],
                'justifications' => [
                    'Incorrect - Dynamic routing protocols have no security implications',
                    'Correct - Lack of authentication can enable routing table poisoning and traffic redirection',
                    'Incorrect - Dynamic routing is always more secure than static routing',
                    'Incorrect - Security is only a concern for external routing protocols'
                ],
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'status' => 'published',
                'irt_a' => 1.7,
                'irt_b' => 0.8,
                'irt_c' => 0.20
            ],
            
            // Item 49 - L4 - Analyze
            [
                'type_id' => 1,
                'subtopic' => 'Communication Protocols',
                'question' => 'What is the fundamental challenge in designing routing for modern cloud and hybrid environments?',
                'options' => [
                    'Cloud networks don\'t use routing',
                    'Dynamic infrastructure requires flexible routing that adapts to rapid changes',
                    'Cloud routing is identical to traditional data center routing',
                    'Routing is only needed for on-premises networks'
                ],
                'correct_options' => ['Cloud routing is identical to traditional data center routing'],
                'justifications' => [
                    'Incorrect - Dynamic infrastructure requires flexible routing that adapts to rapid changes',
                    'Correct - Cloud routing is identical to traditional data center routing',
                    'Incorrect - Routing is only needed for on-premises networks'
                ],
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'status' => 'published',
                'irt_a' => 1.8,
                'irt_b' => 1.0,
                'irt_c' => 0.20
            ],
            
            // Item 50 - L3 - Apply (Simulation)
            [
                'type_id' => 7, // Simulation
                'subtopic' => 'Network Diagnostic Tools',
                'question' => 'Using the command line, determine the **IPv6** address for *saazacademy.com*',
                'options' => [
                    '2606:4700:3037::6815:4c99',
                    '2a00:1450:4009:80f::200e',
                    '2001:4860:4860::8888',
                    '172.67.180.227'
                ],
                'correct_options' => ['2606:4700:3037::6815:4c99'],
                'justifications' => [
                    'Correct - This is the correct IPv6 address for *saazacademy.com*. You can verify this using commands like \'dig AAAA saazacademy.com\' or \'host -t AAAA saazacademy.com\'. The dig command with AAAA record type specifically queries for IPv6 addresses, and this address appears in the DNS response for the domain.',
                    'Incorrect - This is a Google IPv6 address (2a00:1450:4009:80f::200e), not related to *saazacademy.com*. This address belongs to Google\'s infrastructure and would be returned when querying Google services, not saazacademy.com.',
                    'Incorrect - This is a Google Public DNS IPv6 address (2001:4860:4860::8888), not related to *saazacademy.com*. This is the IPv6 equivalent of Google\'s 8.8.8.8 DNS server and is used for DNS resolution, not as a website address.',
                    'Incorrect - This is an IPv4 address (172.67.180.227) for *saazacademy.com*, not an IPv6 address. While this may be a valid IPv4 address for the domain, the question specifically asks for the IPv6 address, which uses a different addressing format with hexadecimal notation and colons.'
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'status' => 'published',
                'irt_a' => 1.5,
                'irt_b' => 0.3,
                'irt_c' => 0.25,
                'simulation_settings' => [
                    'shell' => 'bash',
                    'clear_command' => 'clear',
                    'error_messages' => [
                        'command_not_found' => '$COMMAND: command not found',
                        'missing_argument' => '$COMMAND: missing required argument: domain name',
                        'unknown_host' => '$COMMAND: cannot resolve $1: Unknown host'
                    ],
                    'available_commands' => [
                        'dig AAAA saazacademy.com',
                        'host -t AAAA saazacademy.com',
                        'nslookup -query=AAAA saazacademy.com',
                        'ping6 saazacademy.com',
                        'getent hosts saazacademy.com',
                        'systemd-resolve saazacademy.com'
                    ]
                ]
            ]
        ];
    }
}
