<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DiagnosticDomain;
use App\Models\DiagnosticTopic;
use App\Models\DiagnosticSubtopic;
use App\Models\QuestionType;
use App\Models\DiagnosticItem;
use App\Models\SampleQuizQuestion;
use App\Models\Bloom;
use Illuminate\Support\Facades\DB;

class SampleQuizSeeder extends Seeder
{
    private function getDifficultyLevel($level): int
    {
        return match(strtolower($level)) {
            'easy' => 1,
            'medium' => 2,
            'hard' => 3,
            'expert' => 4,
            default => 2
        };
    }
    
    private function getBloomLevel($level): int
    {
        $bloom = Bloom::where('name', $level)->first();
        return $bloom ? $bloom->id : 3; // Default to Apply
    }
    
    public function run(): void
    {
        DB::transaction(function () {
            // Always clear existing sample quiz questions
            SampleQuizQuestion::truncate();
            
            // Create or update all 10 questions
            $this->createOrUpdateAllQuestions();
            
            // Then add all 10 questions to sample_quiz_questions
            $this->addQuestionsToSampleQuiz();
        });
    }
    
    private function createOrUpdateAllQuestions(): void
    {
        // Get question types
        $type1 = QuestionType::where('code', 'MCQ')->first();
        $type2 = QuestionType::where('code', 'MSQ')->first();
        $type3 = QuestionType::where('code', 'DDS')->first();
        $type4 = QuestionType::where('code', 'DDO')->first();
        $type5 = QuestionType::where('code', 'MP')->first();
        $type6 = QuestionType::where('code', 'HS')->first();
        $type7 = QuestionType::where('code', 'CL')->first();
        
        // 1. MAC Address Question (Type 7 - Command Line)
        $networkDomain = DiagnosticDomain::where('code', 'NETS')->first();
        $networkConfigTopic = DiagnosticTopic::firstOrCreate([
            'domain_id' => $networkDomain->id,
            'name' => 'Network Configuration',
        ]);
        $networkInterfacesSubtopic = DiagnosticSubtopic::firstOrCreate([
            'topic_id' => $networkConfigTopic->id,
            'name' => 'Network Interfaces',
        ]);
        
        $this->createOrUpdateQuestion([
            'content' => 'Using the command line, determine the **MAC address** of the primary network interface (eth0) on this system. (You may use Linux or Windows commands)',
            'subtopic_id' => $networkInterfacesSubtopic->id,
            'type_id' => $type7->id,
            'options' => [
                "00:1B:44:11:3A:B7",
                "02:42:AC:11:00:02", 
                "00:0C:29:4F:8E:35",
                "A8:6D:AA:5F:92:C4"
            ],
            'correct_options' => ["00:1B:44:11:3A:B7"],
            'justifications' => [
                "This is the correct MAC address of the primary network interface. You can verify this using commands like 'ifconfig', 'ip addr', 'ipconfig /all' (Windows), or 'getmac'.",
                "This appears to be a Docker container's virtual MAC address, not the primary network interface.",
                "This looks like a VMware virtual machine's MAC address, not the primary physical interface.",
                "This is a valid MAC address format, but it is not the MAC address of the primary network interface on this system."
            ],
            'settings' => [
                "shell" => "bash",
                "clearCommand" => "clear",
                "errorMessages" => [
                    "commandNotFound" => "\$COMMAND: command not found",
                    "permissionDenied" => "\$COMMAND: permission denied"
                ],
                "commands" => [
                    [
                        "pattern" => "^ifconfig$",
                        "response" => "eth0: flags=4163<UP,BROADCAST,RUNNING,MULTICAST>  mtu 1500\n        inet 192.168.1.100  netmask 255.255.255.0  broadcast 192.168.1.255\n        inet6 fe80::21b:44ff:fe11:3ab7  prefixlen 64  scopeid 0x20<link>\n        ether 00:1b:44:11:3a:b7  txqueuelen 1000  (Ethernet)\n        RX packets 128420  bytes 95234567 (90.8 MiB)\n        RX errors 0  dropped 0  overruns 0  frame 0\n        TX packets 84321  bytes 12345678 (11.8 MiB)\n        TX errors 0  dropped 0 overruns 0  carrier 0  collisions 0\n\nlo: flags=73<UP,LOOPBACK,RUNNING>  mtu 65536\n        inet 127.0.0.1  netmask 255.0.0.0\n        inet6 ::1  prefixlen 128  scopeid 0x10<host>\n        loop  txqueuelen 1000  (Local Loopback)\n        RX packets 82  bytes 8120 (7.9 KiB)\n        RX errors 0  dropped 0  overruns 0  frame 0\n        TX packets 82  bytes 8120 (7.9 KiB)\n        TX errors 0  dropped 0 overruns 0  carrier 0  collisions 0"
                    ],
                    [
                        "pattern" => "^help$",
                        "response" => "Available commands:\n\nLinux:\n  ifconfig                    - Show network interfaces (includes MAC)\n  ip addr                     - Show IP addresses and MAC\n\nWindows:\n  ipconfig /all               - Show detailed configuration (includes MAC)\n  getmac                      - Show MAC addresses\n\nOther:\n  clear                       - Clear the terminal\n  help                        - Show this help message"
                    ]
                ]
            ],
            'difficulty_level' => 'Easy',
            'bloom_level' => 'Apply',
            'dimension' => 'Technical',
        ]);
        
        // 2. Defense-in-depth True/False (Type 2 - Multiple Select for True/False)
        $secArchDomain = DiagnosticDomain::where('code', 'GSC')->first();
        $defenseInDepthTopic = DiagnosticTopic::firstOrCreate([
            'domain_id' => $secArchDomain->id,
            'name' => 'Defense in Depth'
        ]);
        $layeredSecuritySubtopic = DiagnosticSubtopic::firstOrCreate([
            'topic_id' => $defenseInDepthTopic->id,
            'name' => 'Layered Security',
        ]);
        
        $this->createOrUpdateQuestion([
            'content' => 'In a properly implemented defense-in-depth strategy, if one security control fails, the entire security posture is compromised.',
            'subtopic_id' => $layeredSecuritySubtopic->id,
            'type_id' => $type2->id,
            'options' => ["True", "False"],
            'correct_options' => ["False"],
            'explanation' => 'Defense-in-depth uses multiple layers of security controls. If one control fails, other controls continue to provide protection. This layered approach ensures that a single point of failure doesn\'t compromise the entire security posture.',
            'difficulty_level' => 'Easy',
            'bloom_level' => 'Understand',
            'dimension' => 'Technical',
            'randomize' => false,
        ]);
        
        // 3. Legacy system vulnerability (Type 1 - Multiple Choice)
        $riskDomain = DiagnosticDomain::where('code', 'RSK')->first();
        $riskAssessmentTopic = DiagnosticTopic::firstOrCreate([
            'domain_id' => $riskDomain->id,
            'name' => 'Risk Assessment'
        ]);
        $vulnerabilitySubtopic = DiagnosticSubtopic::firstOrCreate([
            'topic_id' => $riskAssessmentTopic->id,
            'name' => 'Vulnerability Identification',
        ]);
        
        $this->createOrUpdateQuestion([
            'content' => 'An organization is running a legacy system that no longer receives vendor patches or support. In risk management terms, what does this represent?',
            'subtopic_id' => $vulnerabilitySubtopic->id,
            'type_id' => $type1->id,
            'options' => [
                "A threat",
                "A vulnerability",
                "An impact",
                "A risk"
            ],
            'correct_options' => ["A vulnerability"],
            'justifications' => [
                "A threat is a potential danger that could exploit a weakness. The legacy system itself is not the threat, but rather what could be exploited.",
                "Correct. A vulnerability is a weakness or gap in security that can be exploited. An unpatched legacy system represents a weakness in the organization's security posture.",
                "An impact refers to the potential damage or consequences if a vulnerability is exploited. The legacy system itself is not the impact.",
                "A risk is the combination of a threat, vulnerability, and impact. The legacy system alone is just one component (vulnerability) of the overall risk equation."
            ],
            'difficulty_level' => 'Medium',
            'bloom_level' => 'Understand',
            'dimension' => 'Managerial',
        ]);
        
        // 4. Multi-factor authentication (Type 1 - Multiple Choice Multi-select)
        $accessDomain = DiagnosticDomain::where('code', 'IAM')->first();
        $authenticationTopic = DiagnosticTopic::firstOrCreate([
            'domain_id' => $accessDomain->id,
            'name' => 'Authentication'
        ]);
        $mfaSubtopic = DiagnosticSubtopic::firstOrCreate([
            'topic_id' => $authenticationTopic->id,
            'name' => 'Multi-Factor Authentication'
        ]);
        
        $this->createOrUpdateQuestion([
            'content' => 'Which of the following are examples of multi-factor authentication (MFA)? (Select **ALL** that apply)',
            'subtopic_id' => $mfaSubtopic->id,
            'type_id' => $type1->id,
            'options' => [
                "Password + SMS code",
                "Fingerprint + PIN",
                "Username + password",
                "Smart card + biometric"
            ],
            'correct_options' => ["Password + SMS code", "Fingerprint + PIN", "Smart card + biometric"],
            'settings' => [
                'isMultiSelect' => true,
                'maxSelectable' => 3
            ],
            'justifications' => [
                "Combines something you know (password) with something you have (phone for SMS) - two different factors.",
                "Combines something you are (fingerprint biometric) with something you know (PIN) - two different factors.",
                "Both username and password are 'something you know' - this is single-factor authentication, not MFA.",
                "Combines something you have (smart card) with something you are (biometric) - two different factors."
            ],
            'difficulty_level' => 'Easy',
            'bloom_level' => 'Understand',
            'dimension' => 'Technical',
        ]);
        
        // 5. Symmetric algorithms drag & drop (Type 3)
        $cryptoDomain = DiagnosticDomain::where('code', 'CKM')->first();
        $encryptionTopic = DiagnosticTopic::firstOrCreate([
            'domain_id' => $cryptoDomain->id,
            'name' => 'Encryption'
        ]);
        $symmetricSubtopic = DiagnosticSubtopic::firstOrCreate([
            'topic_id' => $encryptionTopic->id,
            'name' => 'Symmetric Encryption'
        ]);
        
        $this->createOrUpdateQuestion([
            'content' => 'Drag only symmetric algorithms to the drop zone:',
            'subtopic_id' => $symmetricSubtopic->id,
            'type_id' => $type3->id,
            'options' => [
                "AES",
                "RSA",
                "DES",
                "Diffie-Hellman",
                "3DES",
                "ECC"
            ],
            'correct_options' => ["AES", "DES", "3DES"],
            'justifications' => [
                "AES (Advanced Encryption Standard) is a symmetric block cipher that uses the same key for encryption and decryption.",
                "RSA is an asymmetric algorithm that uses different keys for encryption and decryption (public/private key pair).",
                "DES (Data Encryption Standard) is a symmetric block cipher that uses the same 56-bit key for encryption and decryption.",
                "Diffie-Hellman is a key exchange protocol, not an encryption algorithm. It's used to securely establish a shared secret.",
                "3DES (Triple DES) is a symmetric algorithm that applies DES three times with different keys.",
                "ECC (Elliptic Curve Cryptography) is an asymmetric algorithm based on elliptic curve mathematics."
            ],
            'difficulty_level' => 'Medium',
            'bloom_level' => 'Apply',
            'dimension' => 'Technical',
        ]);
        
        // 6. OSI model ordering (Type 4 - Drag & Drop Order)
        $networkConceptsDomain = DiagnosticDomain::where('code', 'NET')->first();
        $osiTopic = DiagnosticTopic::firstOrCreate([
            'domain_id' => $networkConceptsDomain->id,
            'name' => 'OSI Model'
        ]);
        $osiSubtopic = DiagnosticSubtopic::firstOrCreate([
            'topic_id' => $osiTopic->id,
            'name' => 'OSI Layers'
        ]);
        
        $this->createOrUpdateQuestion([
            'content' => 'The Open System Interconnection (OSI) reference model is a conceptual model made up of seven layers that describe information flow from one computing asset to another over a network. Each layer of the OSI model performs or facilitates a specific network function. Drag & drop the layers in sequence from top (layer 7) to bottom (layer 1).',
            'subtopic_id' => $osiSubtopic->id,
            'type_id' => $type4->id,
            'options' => ["Transport", "Physical", "Application", "Data Link", "Network", "Presentation", "Session"],
            'correct_options' => ["Application", "Presentation", "Session", "Transport", "Network", "Data Link", "Physical"],
            'difficulty_level' => 'Medium',
            'bloom_level' => 'Remember',
            'dimension' => 'Technical',
            'randomize' => false,
        ]);
        
        // 7. Intellectual property matching (Type 5)
        $legalDomain = DiagnosticDomain::where('code', 'LRC')->first();
        $ipTopic = DiagnosticTopic::firstOrCreate([
            'domain_id' => $legalDomain->id,
            'name' => 'Intellectual Property'
        ]);
        $ipTypesSubtopic = DiagnosticSubtopic::firstOrCreate([
            'topic_id' => $ipTopic->id,
            'name' => 'IP Types'
        ]);
        
        $this->createOrUpdateQuestion([
            'content' => 'Drag and match the type of intellectual property with its definition on the left.',
            'subtopic_id' => $ipTypesSubtopic->id,
            'type_id' => $type5->id,
            'options' => [
                "items" => ["Patent", "Trademark", "Copyright", "Trade Secret"],
                "responses" => [
                    "Protects new inventions, processes, and technical solutions",
                    "Protects logos, brand names, slogans, and symbols used in commerce",
                    "Protects original artistic and literary works like books, music, and software",
                    "Protects confidential business information that gives a competitive advantage"
                ]
            ],
            'correct_options' => [
                "Protects new inventions, processes, and technical solutions",
                "Protects logos, brand names, slogans, and symbols used in commerce",
                "Protects original artistic and literary works like books, music, and software",
                "Protects confidential business information that gives a competitive advantage"
            ],
            'justifications' => [
                "Patent" => "A patent gives exclusive rights to an inventor for a limited time, typically 20 years, protecting new inventions or discoveries.",
                "Trademark" => "Trademarks identify and distinguish the source of goods or services and protect brand identity in the marketplace.",
                "Copyright" => "Copyright protects the expression of ideas in tangible form, such as books, software, music, or films — not the idea itself.",
                "Trade Secret" => "Trade secrets include formulas, practices, or designs that are confidential and give a business advantage, such as the Coca-Cola recipe."
            ],
            'difficulty_level' => 'Medium',
            'bloom_level' => 'Understand',
            'dimension' => 'Managerial',
        ]);
        
        // 8. Firewall placement hotspot (Type 6 - Hot Spot)
        $firewallTopic = DiagnosticTopic::firstOrCreate([
            'domain_id' => $networkDomain->id,
            'name' => 'Network Security Architecture',
        ]);
        $firewallSubtopic = DiagnosticSubtopic::firstOrCreate([
            'topic_id' => $firewallTopic->id,
            'name' => 'Firewall Placement',
        ]);
        
        $this->createOrUpdateQuestion([
            'content' => 'Click where the Firewall should be placed to secure outbound connections from internal computers, protect internal resources from inbound connections from Internet, and use a separate **DMZ** segment to allow web connections from the Internet.',
            'subtopic_id' => $firewallSubtopic->id,
            'type_id' => $type6->id,
            'settings' => [
                'image' => '/images/questions/1.png'
            ],
            'options' => [
                ["x" => 132, "y" => 58],
                ["x" => 238, "y" => 58],
                ["x" => 342, "y" => 58],
                ["x" => 448, "y" => 58]
            ],
            'correct_options' => ["x" => 342, "y" => 58],
            'justifications' => "A single firewall with at least 3 network interfaces can be used to create a network architecture containing a DMZ. The external network is formed from the ISP to the firewall on the first network interface, the internal network is formed from the second network interface, and the DMZ is formed from the third network interface.",
            'difficulty_level' => 'Hard',
            'bloom_level' => 'Apply',
            'dimension' => 'Technical',
            'randomize' => false,
        ]);
        
        // 9. IPv6 address for saazacademy.com (Type 7)
        $dnsSubtopic = DiagnosticSubtopic::firstOrCreate([
            'topic_id' => $networkConfigTopic->id,
            'name' => 'DNS and Network Commands',
        ]);
        
        $this->createOrUpdateQuestion([
            'content' => 'Using the command line, determine the **IPv6** address for *saazacademy.com*',
            'subtopic_id' => $dnsSubtopic->id,
            'type_id' => $type7->id,
            'options' => [
                "2606:4700:3037::6815:4c99",
                "2a00:1450:4009:80f::200e", 
                "2001:4860:4860::8888",
                "172.67.180.227"
            ],
            'correct_options' => ["2606:4700:3037::6815:4c99"],
            'justifications' => [
                "This is the correct IPv6 address for *saazacademy.com*. You can verify this using commands like 'dig AAAA saazacademy.com' or 'host -t AAAA saazacademy.com'.",
                "This is a Google Public DNS IPv6 address, not related to *saazacademy.com*.",
                "This is a Google DNS64 IPv6 address, not related to *saazacademy.com*.",
                "This is an IPv4 address for *saazacademy.com* not an IPv6 address."
            ],
            'settings' => [
                "shell" => "bash",
                "clearCommand" => "clear",
                "commands" => [
                    [
                        "pattern" => "dig AAAA saazacademy\\.com \\+short$",
                        "response" => "2606:4700:3037::6815:4c99\n2606:4700:3037::ac43:b4e3"
                    ],
                    [
                        "pattern" => "^help$",
                        "response" => "Available commands:\n  dig AAAA <domain>           - Query AAAA (IPv6) record using DNS\n  dig AAAA <domain> +short    - Query IPv6 address (short format)\n  host -t AAAA <domain>       - Display IPv6 address for hostname\n  clear                       - Clear the terminal\n  help                        - Show this help message"
                    ]
                ]
            ],
            'difficulty_level' => 'Medium',
            'bloom_level' => 'Apply',
            'dimension' => 'Technical',
        ]);
        
        // 10. EU GDPR/HIPAA compliance (Type 1)
        $dataProtectionTopic = DiagnosticTopic::firstOrCreate([
            'domain_id' => $legalDomain->id,
            'name' => 'Data Protection Laws'
        ]);
        $crossBorderSubtopic = DiagnosticSubtopic::firstOrCreate([
            'topic_id' => $dataProtectionTopic->id,
            'name' => 'Cross-Border Data Protection'
        ]);
        
        $this->createOrUpdateQuestion([
            'content' => 'An EU citizen is traveling in the United States and requires medical attention. During the visit, a U.S.-based hospital collects the individual\'s personal and medical data for treatment purposes.\n\nWhich of the following statements is TRUE regarding the hospital\'s data protection obligations?',
            'subtopic_id' => $crossBorderSubtopic->id,
            'type_id' => $type1->id,
            'options' => [
                "The U.S. hospital must comply with the EU GDPR because the patient is an EU citizen.",
                "The U.S. hospital must adhere to both GDPR and HIPAA due to the dual nature of the data (EU citizenship and medical information).",
                "The U.S. hospital must comply with HIPAA, not GDPR, as the data processing occurs in the U.S. for domestic healthcare purposes.",
                "The U.S. hospital can share the data with third parties without consent since the patient is a foreign national."
            ],
            'correct_options' => ["The U.S. hospital must comply with HIPAA, not GDPR, as the data processing occurs in the U.S. for domestic healthcare purposes."],
            'justifications' => [
                "GDPR does not automatically apply to U.S.-based organizations solely because the data belongs to an EU citizen. GDPR applies when data is processed within the EU or by entities targeting EU residents, which is not the case here.",
                "While HIPAA governs medical data in the U.S., GDPR does not apply to data processed domestically in the U.S., even if the individual is an EU citizen.",
                "HIPAA governs healthcare data protection within the U.S., and since the data processing occurs locally for healthcare purposes, GDPR does not apply.",
                "HIPAA strictly prohibits sharing patient data without consent or legal justification, regardless of nationality."
            ],
            'difficulty_level' => 'Medium',
            'bloom_level' => 'Understand',
            'dimension' => 'Managerial',
        ]);
    }
    
    private function createOrUpdateQuestion($data): void
    {
        // Convert difficulty and bloom levels if they're strings
        if (isset($data['difficulty_level']) && is_string($data['difficulty_level'])) {
            $data['difficulty_level'] = $this->getDifficultyLevel($data['difficulty_level']);
        }
        
        if (isset($data['bloom_level']) && is_string($data['bloom_level'])) {
            $data['bloom_level'] = $this->getBloomLevel($data['bloom_level']);
        }
        
        // Add common fields
        $data['status'] = $data['status'] ?? 'published';
        $data['randomize'] = $data['randomize'] ?? true;
        
        // Check if question already exists based on content
        $existingQuestion = DiagnosticItem::where('content', $data['content'])->first();
        
        if ($existingQuestion) {
            // Update existing question
            $existingQuestion->update($data);
        } else {
            // Create new question
            DiagnosticItem::create($data);
        }
    }
    
    private function addQuestionsToSampleQuiz(): void
    {
        // Define the questions in order
        $questionsToAdd = [
            ['content_pattern' => 'MAC address.*primary network interface', 'order' => 1],
            ['content_pattern' => 'defense-in-depth strategy.*one security control fails', 'order' => 2],
            ['content_pattern' => 'legacy system.*no longer receives vendor patches', 'order' => 3],
            ['content_pattern' => 'examples of multi-factor authentication', 'order' => 4],
            ['content_pattern' => 'symmetric algorithms to the drop zone', 'order' => 5],
            ['content_pattern' => 'OSI.*reference model.*seven layers', 'order' => 6],
            ['content_pattern' => 'intellectual property with its definition', 'order' => 7],
            ['content_pattern' => 'Firewall should be placed.*DMZ', 'order' => 8],
            ['content_pattern' => 'IPv6.*address for.*saazacademy.com', 'order' => 9],
            ['content_pattern' => 'EU citizen.*traveling.*United States.*medical', 'order' => 10],
        ];
        
        foreach ($questionsToAdd as $questionData) {
            $pattern = $questionData['content_pattern'];
            $order = $questionData['order'];
            
            // Find the diagnostic item using pattern matching
            $item = DiagnosticItem::whereRaw("content ~* ?", [$pattern])->first();
            
            if ($item) {
                SampleQuizQuestion::create([
                    'diagnostic_item_id' => $item->id,
                    'display_order' => $order,
                ]);
            }
        }
    }
}