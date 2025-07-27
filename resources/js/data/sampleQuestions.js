// Sample Questions Data extracted from SampleQuiz.vue
// Contains 10 questions covering all question types (Type1-Type7)

export const sampleQuestions = [
    {
        id: 1,
        type_id: 7, // Simulation
        question_type: { id: 7, name: 'Simulation', code: 'simulation' },
        content: "Using the command line, determine the **MAC address** of the primary network interface (eth0) on this system. (You may use Linux or Windows commands)",
        options: [
            "00:1B:44:11:3A:B7",
            "02:42:AC:11:00:02", 
            "00:0C:29:4F:8E:35",
            "A8:6D:AA:5F:92:C4"
        ],
        correct_options: ["00:1B:44:11:3A:B7"],
        justifications: [
            "This is the correct MAC address of the primary network interface. You can verify this using commands like 'ifconfig', 'ip addr', 'ipconfig /all' (Windows), or 'getmac'.",
            "This appears to be a Docker container's virtual MAC address, not the primary network interface.",
            "This looks like a VMware virtual machine's MAC address, not the primary physical interface.",
            "This is a valid MAC address format, but it is not the MAC address of the primary network interface on this system."
        ],
        settings: {
            "shell": "bash",
            "clearCommand": "clear",
            "errorMessages": {
                "commandNotFound": "$COMMAND: command not found",
                "permissionDenied": "$COMMAND: permission denied"
            },
            "commands": [
                // Linux/Unix commands
                {
                    "pattern": "^ifconfig$",
                    "response": "eth0: flags=4163<UP,BROADCAST,RUNNING,MULTICAST>  mtu 1500\n        inet 192.168.1.100  netmask 255.255.255.0  broadcast 192.168.1.255\n        inet6 fe80::21b:44ff:fe11:3ab7  prefixlen 64  scopeid 0x20<link>\n        ether 00:1b:44:11:3a:b7  txqueuelen 1000  (Ethernet)\n        RX packets 128420  bytes 95234567 (90.8 MiB)\n        RX errors 0  dropped 0  overruns 0  frame 0\n        TX packets 84321  bytes 12345678 (11.8 MiB)\n        TX errors 0  dropped 0 overruns 0  carrier 0  collisions 0\n\nlo: flags=73<UP,LOOPBACK,RUNNING>  mtu 65536\n        inet 127.0.0.1  netmask 255.0.0.0\n        inet6 ::1  prefixlen 128  scopeid 0x10<host>\n        loop  txqueuelen 1000  (Local Loopback)\n        RX packets 82  bytes 8120 (7.9 KiB)\n        RX errors 0  dropped 0  overruns 0  frame 0\n        TX packets 82  bytes 8120 (7.9 KiB)\n        TX errors 0  dropped 0 overruns 0  carrier 0  collisions 0"
                },
                {
                    "pattern": "^ifconfig eth0$",
                    "response": "eth0: flags=4163<UP,BROADCAST,RUNNING,MULTICAST>  mtu 1500\n        inet 192.168.1.100  netmask 255.255.255.0  broadcast 192.168.1.255\n        inet6 fe80::21b:44ff:fe11:3ab7  prefixlen 64  scopeid 0x20<link>\n        ether 00:1b:44:11:3a:b7  txqueuelen 1000  (Ethernet)\n        RX packets 128420  bytes 95234567 (90.8 MiB)\n        RX errors 0  dropped 0  overruns 0  frame 0\n        TX packets 84321  bytes 12345678 (11.8 MiB)\n        TX errors 0  dropped 0 overruns 0  carrier 0  collisions 0"
                },
                {
                    "pattern": "^ip addr$|^ip addr show$|^ip a$",
                    "response": "1: lo: <LOOPBACK,UP,LOWER_UP> mtu 65536 qdisc noqueue state UNKNOWN group default qlen 1000\n    link/loopback 00:00:00:00:00:00 brd 00:00:00:00:00:00\n    inet 127.0.0.1/8 scope host lo\n       valid_lft forever preferred_lft forever\n    inet6 ::1/128 scope host\n       valid_lft forever preferred_lft forever\n2: eth0: <BROADCAST,MULTICAST,UP,LOWER_UP> mtu 1500 qdisc pfifo_fast state UP group default qlen 1000\n    link/ether 00:1b:44:11:3a:b7 brd ff:ff:ff:ff:ff:ff\n    inet 192.168.1.100/24 brd 192.168.1.255 scope global dynamic noprefixroute eth0\n       valid_lft 86389sec preferred_lft 86389sec\n    inet6 fe80::21b:44ff:fe11:3ab7/64 scope link noprefixroute\n       valid_lft forever preferred_lft forever"
                },
                {
                    "pattern": "^ip link$|^ip link show$|^ip l$",
                    "response": "1: lo: <LOOPBACK,UP,LOWER_UP> mtu 65536 qdisc noqueue state UNKNOWN mode DEFAULT group default qlen 1000\n    link/loopback 00:00:00:00:00:00 brd 00:00:00:00:00:00\n2: eth0: <BROADCAST,MULTICAST,UP,LOWER_UP> mtu 1500 qdisc pfifo_fast state UP mode DEFAULT group default qlen 1000\n    link/ether 00:1b:44:11:3a:b7 brd ff:ff:ff:ff:ff:ff"
                },
                {
                    "pattern": "^hostname -I$",
                    "response": "192.168.1.100 fe80::21b:44ff:fe11:3ab7"
                },
                {
                    "pattern": "^cat /sys/class/net/eth0/address$",
                    "response": "00:1b:44:11:3a:b7"
                },
                {
                    "pattern": "^getmac$",
                    "response": "Physical Address    Transport Name\n=================== ==================================================\n00-1B-44-11-3A-B7   \\Device\\Tcpip_{B8E2A55C-7D17-4C85-A88B-123456789012}"
                },
                // Windows commands
                {
                    "pattern": "^ipconfig$",
                    "response": "Windows IP Configuration\n\n\nEthernet adapter Ethernet:\n\n   Connection-specific DNS Suffix  . : \n   Link-local IPv6 Address . . . . . : fe80::21b:44ff:fe11:3ab7%12\n   IPv4 Address. . . . . . . . . . . : 192.168.1.100\n   Subnet Mask . . . . . . . . . . . : 255.255.255.0\n   Default Gateway . . . . . . . . . : 192.168.1.1\n\nWireless LAN adapter Local Area Connection* 1:\n\n   Media State . . . . . . . . . . . : Media disconnected\n   Connection-specific DNS Suffix  . : \n\nWireless LAN adapter Wi-Fi:\n\n   Media State . . . . . . . . . . . : Media disconnected\n   Connection-specific DNS Suffix  . : \n\nEthernet adapter Bluetooth Network Connection:\n\n   Media State . . . . . . . . . . . : Media disconnected\n   Connection-specific DNS Suffix  . :"
                },
                {
                    "pattern": "^ipconfig /all$",
                    "response": "Windows IP Configuration\n\n   Host Name . . . . . . . . . . . . : DESKTOP-ABC123\n   Primary Dns Suffix  . . . . . . . : \n   Node Type . . . . . . . . . . . . : Hybrid\n   IP Routing Enabled. . . . . . . . : No\n   WINS Proxy Enabled. . . . . . . . : No\n\nEthernet adapter Ethernet:\n\n   Connection-specific DNS Suffix  . : \n   Description . . . . . . . . . . . : Intel(R) Ethernet Connection\n   Physical Address. . . . . . . . . : 00-1B-44-11-3A-B7\n   DHCP Enabled. . . . . . . . . . . : Yes\n   Autoconfiguration Enabled . . . . : Yes\n   Link-local IPv6 Address . . . . . : fe80::21b:44ff:fe11:3ab7%12(Preferred)\n   IPv4 Address. . . . . . . . . . . : 192.168.1.100(Preferred)\n   Subnet Mask . . . . . . . . . . . : 255.255.255.0\n   Lease Obtained. . . . . . . . . . : Sunday, June 8, 2025 8:00:00 AM\n   Lease Expires . . . . . . . . . . : Monday, June 9, 2025 8:00:00 AM\n   Default Gateway . . . . . . . . . : 192.168.1.1\n   DHCP Server . . . . . . . . . . . : 192.168.1.1\n   DNS Servers . . . . . . . . . . . : 8.8.8.8\n                                       8.8.4.4"
                },
                {
                    "pattern": "^wmic nic get macaddress$",
                    "response": "MACAddress\n00:1B:44:11:3A:B7\n"
                },
                {
                    "pattern": "^getmac /v$",
                    "response": "Connection Name     Network Adapter                Physical Address    Transport Name\n===============     ========================       ==================  ==================\nEthernet            Intel(R) Ethernet Connection   00-1B-44-11-3A-B7   \\Device\\Tcpip_{B8E2A55C}\nWi-Fi               Not Connected                  N/A                 N/A"
                },
                // Additional Linux commands
                {
                    "pattern": "^arp -a$",
                    "response": "? (192.168.1.1) at 00:11:22:33:44:55 on eth0 [ether] REACHABLE\n? (192.168.1.100) at 00:1b:44:11:3a:b7 on eth0 [ether] PERMANENT\n? (192.168.1.105) at aa:bb:cc:dd:ee:ff on eth0 [ether] STALE"
                },
                // Help command
                {
                    "pattern": "^help$",
                    "response": "Available commands:\n\nLinux:\n  ifconfig                    - Show network interfaces (includes MAC)\n  ifconfig eth0               - Show specific interface details\n  ip addr                     - Show IP addresses and MAC\n  ip link                     - Show network links with MAC\n  cat /sys/class/net/eth0/address - Show MAC address directly\n  hostname -I                 - Show IP addresses\n  arp -a                      - Show ARP table\n\nWindows:\n  ipconfig                    - Show basic network configuration (NO MAC)\n  ipconfig /all               - Show detailed configuration (includes MAC)\n  getmac                      - Show MAC addresses\n  getmac /v                   - Verbose MAC address listing\n  wmic nic get macaddress     - WMI query for MAC addresses\n\nOther:\n  clear                       - Clear the terminal\n  help                        - Show this help message"
                }
            ]
        },
        domain: "Network Security",
        topic: "Network Configuration",
        difficulty: "Easy",
        bloom: "Apply",
        dimension: "Technical"
    },
    {
        id: 2,
        type_id: 2, // True/False question
        question_type: { id: 2, name: 'True/False', code: 'true_false' },
        content: "In a properly implemented defense-in-depth strategy, if one security control fails, the entire security posture is compromised.",
        options: ["True", "False"],
        correct_options: ["False"],
        explanation: "Defense-in-depth uses multiple layers of security controls. If one control fails, other controls continue to provide protection. This layered approach ensures that a single point of failure doesn't compromise the entire security posture.",
        domain: "Security Architecture & Design",
        topic: "Defense in Depth",
        difficulty: "Easy",
        bloom: "Understand",
        dimension: "Technical"
    },
    {
        id: 3,
        type_id: 1, // Single choice
        question_type: { id: 1, name: 'Single Choice', code: 'single_choice' },
        content: "An organization is running a legacy system that no longer receives vendor patches or support. In risk management terms, what does this represent?",
        options: [
            "A threat",
            "A vulnerability",
            "An impact",
            "A risk"
        ],
        correct_options: ["A vulnerability"],
        justifications: [
            "A threat is a potential danger that could exploit a weakness. The legacy system itself is not the threat, but rather what could be exploited.",
            "Correct. A vulnerability is a weakness or gap in security that can be exploited. An unpatched legacy system represents a weakness in the organization's security posture.",
            "An impact refers to the potential damage or consequences if a vulnerability is exploited. The legacy system itself is not the impact.",
            "A risk is the combination of a threat, vulnerability, and impact. The legacy system alone is just one component (vulnerability) of the overall risk equation."
        ],
        domain: "Risk Management",
        topic: "Risk Components",
        difficulty: "Medium",
        bloom: "Understand",
        dimension: "Managerial"
    },
    {
        id: 4,
        type_id: 1, // Using Type1 with multi-select settings
        question_type: { id: 1, name: 'Multiple Choice', code: 'multiple_choice' },
        content: "Which of the following are examples of multi-factor authentication (MFA)? (Select **ALL** that apply)",
        options: [
            "Password + SMS code",
            "Fingerprint + PIN",
            "Username + password",
            "Smart card + biometric"
        ],
        correct_options: ["Password + SMS code", "Fingerprint + PIN", "Smart card + biometric"],
        settings: {
            isMultiSelect: true,
            maxSelectable: 3  // There are 3 correct answers
        },
        justifications: [
            "Combines something you know (password) with something you have (phone for SMS) - two different factors.",
            "Combines something you are (fingerprint biometric) with something you know (PIN) - two different factors.",
            "Both username and password are 'something you know' - this is single-factor authentication, not MFA.",
            "Combines something you have (smart card) with something you are (biometric) - two different factors."
        ],
        domain: "Access Control",
        topic: "Authentication Methods",
        difficulty: "Easy",
        bloom: "Understand",
        dimension: "Technical"
    },
    {
        id: 5,
        type_id: 3, // Drag and drop (single zone)
        question_type: { id: 3, name: 'Drag and Drop', code: 'drag_drop' },
        content: "Drag only symmetric algorithms to the drop zone:",
        options: [
            "AES",
            "RSA",
            "DES",
            "Diffie-Hellman",
            "3DES",
            "ECC"
        ],
        correct_options: ["AES", "DES", "3DES"],
        justifications: [
            "AES (Advanced Encryption Standard) is a symmetric block cipher that uses the same key for encryption and decryption.",
            "RSA is an asymmetric algorithm that uses different keys for encryption and decryption (public/private key pair).",
            "DES (Data Encryption Standard) is a symmetric block cipher that uses the same 56-bit key for encryption and decryption.",
            "Diffie-Hellman is a key exchange protocol, not an encryption algorithm. It's used to securely establish a shared secret.",
            "3DES (Triple DES) is a symmetric algorithm that applies DES three times with different keys.",
            "ECC (Elliptic Curve Cryptography) is an asymmetric algorithm based on elliptic curve mathematics."
        ],
        domain: "Cryptography",
        topic: "Encryption Algorithms",
        difficulty: "Medium",
        bloom: "Apply",
        dimension: "Technical"
    },
    {
        id: 6,
        type_id: 4, // Drag and drop (ordering)
        question_type: { id: 4, name: 'Ordering', code: 'ordering' },
        content: "The Open System Interconnection (OSI) reference model is a conceptual model made up of seven layers that describe information flow from one computing asset to another over a network. Each layer of the OSI model performs or facilitates a specific network function. Drag & drop the layers in sequence from top (layer 7) to bottom (layer 1).",
        options: ["Transport", "Physical", "Application", "Data Link", "Network", "Presentation", "Session"], // Shuffled
        correct_options: ["Application", "Presentation", "Session", "Transport", "Network", "Data Link", "Physical"],
        domain: "Network Security",
        topic: "OSI Model",
        difficulty: "Medium",
        bloom: "Remember",
        dimension: "Technical"
    },
    {
        id: 7,
        type_id: 5, // Matching
        question_type: { id: 5, name: 'Matching', code: 'matching' },
        content: "Drag and match the type of intellectual property with its definition on the left.",
        options: {
            items: ["Patent", "Trademark", "Copyright", "Trade Secret"],
            responses: [
                "Protects new inventions, processes, and technical solutions",
                "Protects logos, brand names, slogans, and symbols used in commerce",
                "Protects original artistic and literary works like books, music, and software",
                "Protects confidential business information that gives a competitive advantage"
            ]
        },
        correct_options: {
            "Patent": "Protects new inventions, processes, and technical solutions",
            "Trademark": "Protects logos, brand names, slogans, and symbols used in commerce",
            "Copyright": "Protects original artistic and literary works like books, music, and software",
            "Trade Secret": "Protects confidential business information that gives a competitive advantage"
        },
        justifications: {
            "Patent": "A patent gives exclusive rights to an inventor for a limited time, typically 20 years, protecting new inventions or discoveries.",
            "Trademark": "Trademarks identify and distinguish the source of goods or services and protect brand identity in the marketplace.",
            "Copyright": "Copyright protects the expression of ideas in tangible form, such as books, software, music, or films — not the idea itself.",
            "Trade Secret": "Trade secrets include formulas, practices, or designs that are confidential and give a business advantage, such as the Coca-Cola recipe."
        },
        domain: "Legal, Regulatory & Compliance",
        topic: "Intellectual Property",
        difficulty: "Medium",
        bloom: "Understand",
        dimension: "Managerial"
    },
    {
        id: 8,
        type_id: 6, // Hotspot
        question_type: { id: 6, name: 'Hotspot', code: 'hotspot' },
        content: "Click where the Firewall should be placed to secure outbound connections from internal computers, protect internal resources from inbound connections from Internet, and use a separate **DMZ** segment to allow web connections from the Internet.",
        image: "/images/questions/1.png",
        options: [
            { "x": 132, "y": 58 },
            { "x": 238, "y": 58 },
            { "x": 342, "y": 58 },
            { "x": 448, "y": 58 }
        ],
        correct_options: { "x": 342, "y": 58 },
        justifications: "A single firewall with at least 3 network interfaces can be used to create a network architecture containing a DMZ. The external network is formed from the ISP to the firewall on the first network interface, the internal network is formed from the second network interface, and the DMZ is formed from the third network interface.",
        domain: "Network Security",
        topic: "Firewall Placement",
        difficulty: "Hard",
        bloom: "Apply",
        dimension: "Technical"
    },
    {
        id: 9,
        type_id: 7, // Simulation
        question_type: { id: 7, name: 'Simulation', code: 'simulation' },
        content: "Using the command line, determine the **IPv6** address for *saazacademy.com*",
        options: [
            "2606:4700:3037::6815:4c99",
            "2a00:1450:4009:80f::200e", 
            "2001:4860:4860::8888",
            "172.67.180.227"
        ],
        correct_options: ["2606:4700:3037::6815:4c99"],
        justifications: [
            "This is the correct IPv6 address for *saazacademy.com*. You can verify this using commands like 'dig AAAA saazacademy.com' or 'host -t AAAA saazacademy.com'.",
            "This is a Google Public DNS IPv6 address, not related to *saazacademy.com*.",
            "This is a Google DNS64 IPv6 address, not related to *saazacademy.com*.",
            "This is an IPv4 address for *saazacademy.com* not an IPv6 address."
        ],
        settings: {
            "shell": "bash",
            "clearCommand": "clear",
            "errorMessages": {
                "commandNotFound": "$COMMAND: command not found",
                "missingArgument": "$COMMAND: missing required argument: domain name",
                "unknownHost": "$COMMAND: cannot resolve $1: Unknown host"
            },
            "commands": [
                // Commands that work only for saazacademy.com
                {
                    "pattern": "dig (AAAA saazacademy\\.com|saazacademy\\.com AAAA)$",
                    "response": "; <<>> DiG 9.18.28-0ubuntu0.20.04.1-Ubuntu <<>> AAAA saazacademy.com\n;; global options: +cmd\n;; Got answer:\n;; ->>HEADER<<- opcode: QUERY, status: NOERROR, id: 47823\n;; flags: qr rd ra; QUERY: 1, ANSWER: 2, AUTHORITY: 0, ADDITIONAL: 1\n\n;; OPT PSEUDOSECTION:\n; EDNS: version: 0, flags:; udp: 65494\n;; QUESTION SECTION:\n;saazacademy.com.\t\tIN\tAAAA\n\n;; ANSWER SECTION:\nsaazacademy.com.\t300\tIN\tAAAA\t2606:4700:3037::6815:4c99\nsaazacademy.com.\t300\tIN\tAAAA\t2606:4700:3037::ac43:b4e3\n\n;; Query time: 23 msec\n;; SERVER: 172.20.10.1#53(172.20.10.1)\n;; WHEN: Sat Jun 08 17:42:31 PST 2025\n;; MSG SIZE  rcvd: 88"
                },
                {
                    "pattern": "dig AAAA saazacademy\\.com \\+short$",
                    "response": "2606:4700:3037::6815:4c99\n2606:4700:3037::ac43:b4e3"
                },
                {
                    "pattern": "host -t AAAA saazacademy\\.com$",
                    "response": "saazacademy.com has IPv6 address 2606:4700:3037::6815:4c99\nsaazacademy.com has IPv6 address 2606:4700:3037::ac43:b4e3"
                },
                // IPv4 commands for saazacademy.com
                {
                    "pattern": "dig saazacademy\\.com \\+short$",
                    "response": "172.67.180.227\n104.21.76.153"
                },
                {
                    "pattern": "dig saazacademy\\.com$",
                    "response": "; <<>> DiG 9.18.28-0ubuntu0.20.04.1-Ubuntu <<>> saazacademy.com\n;; global options: +cmd\n;; Got answer:\n;; ->>HEADER<<- opcode: QUERY, status: NOERROR, id: 32451\n;; flags: qr rd ra; QUERY: 1, ANSWER: 2, AUTHORITY: 0, ADDITIONAL: 1\n\n;; OPT PSEUDOSECTION:\n; EDNS: version: 0, flags:; udp: 65494\n;; QUESTION SECTION:\n;saazacademy.com.\t\tIN\tA\n\n;; ANSWER SECTION:\nsaazacademy.com.\t300\tIN\tA\t172.67.180.227\nsaazacademy.com.\t300\tIN\tA\t104.21.76.153\n\n;; Query time: 15 msec\n;; SERVER: 172.20.10.1#53(172.20.10.1)\n;; WHEN: Sat Jun 08 17:45:22 PST 2025\n;; MSG SIZE  rcvd: 76"
                },
                {
                    "pattern": "host saazacademy\\.com$",
                    "response": "saazacademy.com has address 172.67.180.227\nsaazacademy.com has address 104.21.76.153\nsaazacademy.com has IPv6 address 2606:4700:3037::6815:4c99\nsaazacademy.com has IPv6 address 2606:4700:3037::ac43:b4e3\nsaazacademy.com mail is handled by 0 _dc-mx.b54f0cda8c8e.saazacademy.com."
                },
                {
                    "pattern": "nslookup saazacademy\\.com$",
                    "response": "Server:\t\t172.20.10.1\nAddress:\t172.20.10.1#53\n\nNon-authoritative answer:\nName:\tsaazacademy.com\nAddress: 172.67.180.227\nName:\tsaazacademy.com\nAddress: 104.21.76.153\nName:\tsaazacademy.com\nAddress: 2606:4700:3037::6815:4c99\nName:\tsaazacademy.com\nAddress: 2606:4700:3037::ac43:b4e3"
                },
                {
                    "pattern": "ping saazacademy\\.com$",
                    "response": "PING saazacademy.com (172.67.180.227) 56(84) bytes of data.\n64 bytes from 172.67.180.227: icmp_seq=1 ttl=52 time=23.7 ms\n64 bytes from 172.67.180.227: icmp_seq=2 ttl=52 time=23.5 ms\n64 bytes from 172.67.180.227: icmp_seq=3 ttl=52 time=23.6 ms\n64 bytes from 172.67.180.227: icmp_seq=4 ttl=52 time=23.8 ms\n\n--- saazacademy.com ping statistics ---\n4 packets transmitted, 4 received, 0% packet loss, time 3003ms\nrtt min/avg/max/mdev = 23.5/23.65/23.8/0.122 ms"
                },
                {
                    "pattern": "nslookup -query=AAAA saazacademy\\.com$",
                    "response": "Server:\t\t172.20.10.1\nAddress:\t172.20.10.1#53\n\nNon-authoritative answer:\nName:\tsaazacademy.com\nAddress: 2606:4700:3037::6815:4c99\nName:\tsaazacademy.com\nAddress: 2606:4700:3037::ac43:b4e3"
                },
                {
                    "pattern": "ping6 saazacademy\\.com$",
                    "response": "PING6(56=40+8+8 bytes) 2001:db8:0:1234::1 --> 2606:4700:3037::6815:4c99\n16 bytes from 2606:4700:3037::6815:4c99, icmp_seq=0 hlim=52 time=24.152 ms\n16 bytes from 2606:4700:3037::6815:4c99, icmp_seq=1 hlim=52 time=23.897 ms\n16 bytes from 2606:4700:3037::6815:4c99, icmp_seq=2 hlim=52 time=24.021 ms\n16 bytes from 2606:4700:3037::6815:4c99, icmp_seq=3 hlim=52 time=23.944 ms\n\n--- saazacademy.com ping6 statistics ---\n4 packets transmitted, 4 packets received, 0.0% packet loss\nround-trip min/avg/max/std-dev = 23.897/24.004/24.152/0.099 ms"
                },
                {
                    "pattern": "ping -6 saazacademy\\.com$",
                    "response": "PING saazacademy.com(2606:4700:3037::6815:4c99) 56 data bytes\n64 bytes from 2606:4700:3037::6815:4c99: icmp_seq=1 ttl=52 time=24.1 ms\n64 bytes from 2606:4700:3037::6815:4c99: icmp_seq=2 ttl=52 time=23.9 ms\n64 bytes from 2606:4700:3037::6815:4c99: icmp_seq=3 ttl=52 time=24.0 ms\n64 bytes from 2606:4700:3037::6815:4c99: icmp_seq=4 ttl=52 time=23.8 ms\n\n--- saazacademy.com ping statistics ---\n4 packets transmitted, 4 received, 0% packet loss, time 3004ms\nrtt min/avg/max/mdev = 23.8/23.95/24.1/0.125 ms"
                },
                // Additional IPv6 commands
                {
                    "pattern": "getent ahosts saazacademy\\.com$",
                    "response": "2606:4700:3037::6815:4c99 STREAM saazacademy.com\n2606:4700:3037::6815:4c99 DGRAM\n2606:4700:3037::6815:4c99 RAW\n2606:4700:3037::ac43:b4e3 STREAM\n2606:4700:3037::ac43:b4e3 DGRAM\n2606:4700:3037::ac43:b4e3 RAW\n172.67.180.227  STREAM\n172.67.180.227  DGRAM\n172.67.180.227  RAW\n104.21.76.153   STREAM\n104.21.76.153   DGRAM\n104.21.76.153   RAW"
                },
                {
                    "pattern": "getent hosts saazacademy\\.com$",
                    "response": "2606:4700:3037::6815:4c99 saazacademy.com"
                },
                {
                    "pattern": "host -t ANY saazacademy\\.com$",
                    "response": "saazacademy.com has address 172.67.180.227\nsaazacademy.com has address 104.21.76.153\nsaazacademy.com has IPv6 address 2606:4700:3037::6815:4c99\nsaazacademy.com has IPv6 address 2606:4700:3037::ac43:b4e3\nsaazacademy.com mail is handled by 0 _dc-mx.b54f0cda8c8e.saazacademy.com.\nsaazacademy.com nameserver = ns1.example.com.\nsaazacademy.com nameserver = ns2.example.com."
                },
                {
                    "pattern": "drill AAAA saazacademy\\.com$",
                    "response": ";; ->>HEADER<<- opcode: QUERY, rcode: NOERROR, id: 12345\n;; flags: qr rd ra ; QUERY: 1, ANSWER: 2, AUTHORITY: 0, ADDITIONAL: 0\n;; QUESTION SECTION:\n;; saazacademy.com.\tIN\tAAAA\n\n;; ANSWER SECTION:\nsaazacademy.com.\t300\tIN\tAAAA\t2606:4700:3037::6815:4c99\nsaazacademy.com.\t300\tIN\tAAAA\t2606:4700:3037::ac43:b4e3\n\n;; AUTHORITY SECTION:\n\n;; ADDITIONAL SECTION:\n\n;; Query time: 25 msec\n;; SERVER: 8.8.8.8\n;; WHEN: Sun Jun  8 21:30:00 2025\n;; MSG SIZE  rcvd: 88"
                },
                {
                    "pattern": "resolveip -6 saazacademy\\.com$",
                    "response": "IPv6 address of saazacademy.com is 2606:4700:3037::6815:4c99"
                },
                {
                    "pattern": "dnseval saazacademy\\.com$",
                    "response": "saazacademy.com. A: 172.67.180.227, 104.21.76.153\nsaazacademy.com. AAAA: 2606:4700:3037::6815:4c99, 2606:4700:3037::ac43:b4e3"
                },
                {
                    "pattern": "systemd-resolve saazacademy\\.com$",
                    "response": "saazacademy.com: 2606:4700:3037::6815:4c99\n                 2606:4700:3037::ac43:b4e3\n                 172.67.180.227\n                 104.21.76.153\n\n-- Information acquired via protocol DNS in 15.2ms.\n-- Data is authenticated: no"
                },
                {
                    "pattern": "resolvectl query saazacademy\\.com$",
                    "response": "saazacademy.com: 2606:4700:3037::6815:4c99\n                 2606:4700:3037::ac43:b4e3\n                 172.67.180.227\n                 104.21.76.153\n\n-- Information acquired via protocol DNS in 12.4ms.\n-- Data is authenticated: no"
                },
                {
                    "pattern": "nmap -6 -sn saazacademy\\.com$",
                    "response": "Starting Nmap 7.80 ( https://nmap.org ) at 2025-06-08 21:30 IST\nNmap scan report for saazacademy.com (2606:4700:3037::6815:4c99)\nHost is up (0.024s latency).\nOther addresses for saazacademy.com (not scanned): 2606:4700:3037::ac43:b4e3\nNmap done: 1 IP address (1 host up) scanned in 0.08 seconds"
                },
                {
                    "pattern": "curl -6 -I saazacademy\\.com$",
                    "response": "curl: (7) Failed to connect to saazacademy.com port 80: Connection refused"
                },
                // Generic commands for other domains with NXDOMAIN response
                {
                    "pattern": "ping ([a-zA-Z0-9.-]+\\.[a-zA-Z]{2,})$",
                    "condition": "^ping (?!saazacademy\\.com$)",
                    "generateResponse": {
                        "type": "error",
                        "template": "ping: cannot resolve $1: Unknown host"
                    },
                    "isError": true
                },
                {
                    "pattern": "dig ([a-zA-Z0-9.-]+\\.[a-zA-Z]{2,})$",
                    "condition": "^dig (?!saazacademy\\.com$)",
                    "generateResponse": {
                        "type": "nxdomain",
                        "template": "; <<>> DiG 9.10.6 <<>> $1\n;; global options: +cmd\n;; Got answer:\n;; ->>HEADER<<- opcode: QUERY, status: NXDOMAIN, id: $RANDOM_ID\n;; flags: qr rd ra; QUERY: 1, ANSWER: 0, AUTHORITY: 1, ADDITIONAL: 1\n\n;; OPT PSEUDOSECTION:\n; EDNS: version: 0, flags:; udp: 1280\n;; QUESTION SECTION:\n;$1.\t\t\tIN\tA\n\n;; AUTHORITY SECTION:\ncom.\t\t\t899\tIN\tSOA\ta.gtld-servers.net. nstld.verisign-grs.com. 1749397177 1800 900 604800 900\n\n;; Query time: $RANDOM_TIME msec\n;; SERVER: 2405:201:4017:721c::c0a8:1d01#53(2405:201:4017:721c::c0a8:1d01)\n;; WHEN: $DATE\n;; MSG SIZE  rcvd: $RANDOM_SIZE"
                    }
                },
                {
                    "pattern": "dig AAAA ([a-zA-Z0-9.-]+\\.[a-zA-Z]{2,})",
                    "condition": "^dig AAAA (?!saazacademy\\.com)",
                    "generateResponse": {
                        "type": "nxdomain",
                        "template": "; <<>> DiG 9.10.6 <<>> AAAA $1\n;; global options: +cmd\n;; Got answer:\n;; ->>HEADER<<- opcode: QUERY, status: NXDOMAIN, id: $RANDOM_ID\n;; flags: qr rd ra; QUERY: 1, ANSWER: 0, AUTHORITY: 1, ADDITIONAL: 1\n\n;; OPT PSEUDOSECTION:\n; EDNS: version: 0, flags:; udp: 1280\n;; QUESTION SECTION:\n;$1.\t\t\tIN\tAAAA\n\n;; AUTHORITY SECTION:\ncom.\t\t\t899\tIN\tSOA\ta.gtld-servers.net. nstld.verisign-grs.com. 1749397177 1800 900 604800 900\n\n;; Query time: $RANDOM_TIME msec\n;; SERVER: 2405:201:4017:721c::c0a8:1d01#53(2405:201:4017:721c::c0a8:1d01)\n;; WHEN: $DATE\n;; MSG SIZE  rcvd: $RANDOM_SIZE"
                    }
                },
                // Help command
                {
                    "pattern": "^help$",
                    "response": "Available commands:\n  dig <domain>                   - Query A (IPv4) record using DNS\n  dig AAAA <domain>              - Query AAAA (IPv6) record using DNS\n  dig AAAA <domain> +short       - Query IPv6 address (short format)\n  host <domain>                  - Display all DNS records for hostname\n  host -t AAAA <domain>          - Display IPv6 address for hostname\n  host -t ANY <domain>           - Display ALL DNS records\n  nslookup <domain>              - Query all addresses for domain\n  nslookup -query=AAAA <domain>  - Query nameserver for IPv6 only\n  ping <domain>                  - Ping using IPv4\n  ping6 <domain>                 - Ping using IPv6\n  ping -6 <domain>               - Ping using IPv6\n  getent hosts <domain>          - Get host entry (prefers IPv6)\n  getent ahosts <domain>         - Get all host addresses\n  drill AAAA <domain>            - DNS lookup tool (alternative to dig)\n  systemd-resolve <domain>       - SystemD resolver query\n  resolvectl query <domain>      - SystemD resolver control\n  resolveip -6 <domain>          - Resolve to IPv6 address only\n  dnseval <domain>               - Evaluate DNS records\n  nmap -6 -sn <domain>           - IPv6 host discovery\n  curl -6 -I <domain>            - HTTP HEAD request over IPv6\n  clear                          - Clear the terminal\n  help                           - Show this help message"
                }
            ]
        },
        domain: "Network Security",
        topic: "Network Commands",
        difficulty: "Medium",
        bloom: "Apply",
        dimension: "Technical"
    },
    {
        id: 10,
        type_id: 1, // Single choice
        question_type: { id: 1, name: 'Single Choice', code: 'single_choice' },
        content: "An EU citizen is traveling in the United States and requires medical attention. During the visit, a U.S.-based hospital collects the individual's personal and medical data for treatment purposes.\n\nWhich of the following statements is TRUE regarding the hospital's data protection obligations?",
        options: [
            "The U.S. hospital must comply with the EU GDPR because the patient is an EU citizen.",
            "The U.S. hospital must adhere to both GDPR and HIPAA due to the dual nature of the data (EU citizenship and medical information).",
            "The U.S. hospital must comply with HIPAA, not GDPR, as the data processing occurs in the U.S. for domestic healthcare purposes.",
            "The U.S. hospital can share the data with third parties without consent since the patient is a foreign national."
        ],
        correct_options: ["The U.S. hospital must comply with HIPAA, not GDPR, as the data processing occurs in the U.S. for domestic healthcare purposes."],
        justifications: [
            "GDPR does not automatically apply to U.S.-based organizations solely because the data belongs to an EU citizen. GDPR applies when data is processed within the EU or by entities targeting EU residents, which is not the case here.",
            "While HIPAA governs medical data in the U.S., GDPR does not apply to data processed domestically in the U.S., even if the individual is an EU citizen.",
            "HIPAA governs healthcare data protection within the U.S., and since the data processing occurs locally for healthcare purposes, GDPR does not apply.",
            "HIPAA strictly prohibits sharing patient data without consent or legal justification, regardless of nationality."
        ],
        domain: "Legal, Regulatory & Compliance",
        topic: "Data Protection Laws",
        difficulty: "Medium",
        bloom: "Understand",
        dimension: "Managerial"
    }
];

export default sampleQuestions;