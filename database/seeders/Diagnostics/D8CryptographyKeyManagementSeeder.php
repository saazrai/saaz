<?php

namespace Database\Seeders\Diagnostics;

use App\Models\DiagnosticItem;
use App\Models\DiagnosticTopic;


use Illuminate\Database\Seeder;

class D8CryptographyKeyManagementSeeder extends Seeder
{
    public function run(): void
    {
        // Clear existing items for this domain to prevent duplicates
        DiagnosticItem::whereHas('topic.domain', function($query) {
            $query->where('name', 'Cryptography & Key Management');
        })->forceDelete();
        
        // Get reference data
        $topics = DiagnosticTopic::whereHas('domain', function($query) {
            $query->where('name', 'Cryptography & Key Management');
        })->pluck('id', 'name');
        
        
        $items = [
            // Symmetric Encryption - Item 1
            [
                'topic_id' => $topics['Symmetric & Asymmetric Encryption'] ?? 190,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Which of the following is a characteristic of symmetric encryption?',
                'options' => [
                    'Uses different keys for encryption and decryption',
                    'Uses the same key for encryption and decryption',
                    'Does not require key exchange',
                    'Is slower than asymmetric encryption'
                ],
                'correct_options' => ['Uses the same key for encryption and decryption'],
                'justifications' => [
                    'This describes asymmetric encryption',
                    'Correct - Symmetric encryption uses a single shared secret key',
                    'Key exchange is a major challenge in symmetric encryption',
                    'Symmetric encryption is typically much faster than asymmetric'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            
            // DES vs 3DES - Item 3
            [
                'topic_id' => $topics['Symmetric & Asymmetric Encryption'] ?? 190,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What is the effective key length of 3DES when using three independent keys?',
                'options' => [
                    '56 bits',
                    '112 bits',
                    '168 bits',
                    '192 bits'
                ],
                'correct_options' => ['168 bits'],
                'justifications' => [
                    'This is the key length of single DES',
                    'This is the effective strength with 2-key 3DES',
                    'Correct - 3DES with 3 keys has 3 × 56 = 168 bits',
                    'Not the correct calculation for 3DES'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // DSA vs RSA - Item 5
            [
                'topic_id' => $topics['Symmetric & Asymmetric Encryption'] ?? 190,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What is the primary difference between DSA and RSA?',
                'options' => [
                    'DSA is faster than RSA',
                    'DSA can only be used for digital signatures',
                    'RSA uses smaller key sizes',
                    'DSA provides better encryption'
                ],
                'correct_options' => ['DSA can only be used for digital signatures'],
                'justifications' => [
                    'Speed depends on implementation and key size',
                    'Correct - DSA is signature-only, RSA does both encryption and signatures',
                    'RSA typically uses larger key sizes',
                    'DSA cannot perform encryption'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            
            // ECDSA Benefits - Item 6
            [
                'topic_id' => $topics['Symmetric & Asymmetric Encryption'] ?? 190,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What is the main advantage of ECDSA over RSA?',
                'options' => [
                    'ECDSA is quantum-resistant',
                    'ECDSA provides equivalent security with smaller key sizes',
                    'ECDSA is easier to implement',
                    'ECDSA has been around longer'
                ],
                'correct_options' => ['ECDSA provides equivalent security with smaller key sizes'],
                'justifications' => [
                    'Neither ECDSA nor RSA is quantum-resistant',
                    'Correct - ECDSA achieves same security level with much smaller keys',
                    'ECDSA is actually more complex to implement correctly',
                    'RSA predates ECDSA'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            
            // Stream Cipher Examples - Item 8
            [
                'topic_id' => $topics['Symmetric & Asymmetric Encryption'] ?? 191,
                'type_id' => 3,
                'dimension' => 'Technical',
                'content' => 'Identify examples of stream ciphers:',
                'options' => [
                    'RC4',
                    'AES',
                    'ChaCha20',
                    'DES',
                    'Salsa20',
                    'Blowfish'
                ],
                'correct_options' => ['RC4', 'ChaCha20', 'Salsa20'],
                'justifications' => [
                    'RC4 is a stream cipher (now deprecated)',
                    'AES is a block cipher',
                    'ChaCha20 is a modern stream cipher',
                    'DES is a block cipher',
                    'Salsa20 is a stream cipher',
                    'Blowfish is a block cipher'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // CBC Mode Requirements - Item 10
            [
                'topic_id' => $topics['Symmetric & Asymmetric Encryption'] ?? 192,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What additional input does CBC mode require compared to ECB mode?',
                'options' => [
                    'A larger key size',
                    'An initialization vector (IV)',
                    'A digital certificate',
                    'Multiple encryption keys'
                ],
                'correct_options' => ['An initialization vector (IV)'],
                'justifications' => [
                    'Key size is independent of the mode',
                    'Correct - CBC requires a random IV for each encryption',
                    'Certificates are not required for CBC',
                    'CBC uses the same key throughout'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            
            // CTR Mode Properties - Item 11
            [
                'topic_id' => $topics['Symmetric & Asymmetric Encryption'] ?? 192,
                'type_id' => 2,
                'dimension' => 'Technical',
                'content' => '**True or False:** CTR mode converts a block cipher into a stream cipher.',
                'options' => [
                    'True',
                    'False'
                ],
                'correct_options' => ['True'],
                'justifications' => [
                    'explanation' => 'CTR (Counter) mode generates a keystream by encrypting successive counter values, effectively turning a block cipher into a stream cipher. This allows encryption of arbitrary-length data without padding.'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            
            // GCM Mode Features - Item 12
            [
                'topic_id' => $topics['Symmetric & Asymmetric Encryption'] ?? 192,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What does GCM mode provide that other traditional modes do not?',
                'options' => [
                    'Faster encryption speed',
                    'Built-in authentication',
                    'Smaller ciphertext size',
                    'Quantum resistance'
                ],
                'correct_options' => ['Built-in authentication'],
                'justifications' => [
                    'Speed varies by implementation',
                    'Correct - GCM provides authenticated encryption with associated data (AEAD)',
                    'GCM adds an authentication tag, slightly increasing size',
                    'No classical mode provides quantum resistance'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            
            // Hash Function Properties - Item 13
            [
                'topic_id' => $topics['Hashing'] ?? 191,
                'type_id' => 3,
                'dimension' => 'Technical',
                'content' => 'Select the essential properties of a cryptographic hash function:',
                'options' => [
                    'One-way (pre-image resistance)',
                    'Reversible',
                    'Collision resistance',
                    'Fixed output size',
                    'Requires a key',
                    'Deterministic'
                ],
                'correct_options' => ['One-way (pre-image resistance)', 'Collision resistance', 'Fixed output size', 'Deterministic'],
                'justifications' => [
                    'Cannot reverse hash to get original input',
                    'Hash functions must be irreversible',
                    'Hard to find two inputs with same hash',
                    'Always produces same size output',
                    'Hash functions do not use keys',
                    'Same input always produces same hash'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            
            // Key Lifecycle Phases - Item 20
            [
                'topic_id' => $topics['Key Management Lifecycle'] ?? 194,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What is the correct order of phases in the cryptographic key lifecycle?',
                'options' => [
                    'Generation → Distribution → Storage → Use → Destruction',
                    'Creation → Activation → Use → Deactivation → Destruction',
                    'Generation → Storage → Use → Archival → Destruction',
                    'All of the above represent valid lifecycle models'
                ],
                'correct_options' => ['All of the above represent valid lifecycle models'],
                'justifications' => [
                    'Valid simplified lifecycle',
                    'NIST SP 800-57 lifecycle model',
                    'Another valid lifecycle representation',
                    'Correct - Different standards define slightly different phases'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            
            // HSM vs Software Crypto - Item 24
            [
                'topic_id' => $topics['Hardware Security Module (HSM)'] ?? 195,
                'type_id' => 3,
                'dimension' => 'Technical',
                'content' => 'Select advantages of HSMs over software-based cryptography:',
                'options' => [
                    'Physical tamper resistance',
                    'Lower cost',
                    'Higher performance for crypto operations',
                    'Easier to deploy',
                    'Key material never exists in plaintext outside HSM',
                    'No maintenance required'
                ],
                'correct_options' => ['Physical tamper resistance', 'Higher performance for crypto operations', 'Key material never exists in plaintext outside HSM'],
                'justifications' => [
                    'HSMs detect/respond to physical attacks',
                    'HSMs are significantly more expensive',
                    'Dedicated crypto hardware is faster',
                    'HSMs require specialized setup',
                    'Keys are generated and used within HSM',
                    'HSMs require regular maintenance'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            
            // Secure Enclave - Item 26
            [
                'topic_id' => $topics['Trusted Platform Module (TPM) & Secure Enclave'] ?? 196,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What distinguishes a Secure Enclave from a standard TPM?',
                'options' => [
                    'Secure Enclaves are software-only',
                    'Secure Enclaves can run custom secure applications',
                    'TPMs are faster than Secure Enclaves',
                    'Secure Enclaves cannot store keys'
                ],
                'correct_options' => ['Secure Enclaves can run custom secure applications'],
                'justifications' => [
                    'Secure Enclaves are hardware-based',
                    'Correct - Secure Enclaves execute code in isolated environment',
                    'Performance varies by implementation',
                    'Secure Enclaves excel at key storage'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            
            // Cryptographic Attacks - Item 27
            [
                'topic_id' => $topics['Cryptographic Attacks'] ?? 197,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What type of attack attempts to find two different inputs that produce the same hash output?',
                'options' => [
                    'Preimage attack',
                    'Collision attack',
                    'Birthday attack',
                    'Both collision and birthday attacks'
                ],
                'correct_options' => ['Both collision and birthday attacks'],
                'justifications' => [
                    'Preimage finds input for given hash',
                    'Collision finds two inputs with same hash',
                    'Birthday attack is a collision attack method',
                    'Correct - Birthday attack is a technique for finding collisions'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            
            // Side-Channel Attacks - Item 28
            [
                'topic_id' => $topics['Cryptographic Attacks'] ?? 197,
                'type_id' => 3,
                'dimension' => 'Technical',
                'content' => 'Identify types of side-channel attacks:',
                'options' => [
                    'Timing attacks',
                    'Brute force attacks',
                    'Power analysis attacks',
                    'Dictionary attacks',
                    'Acoustic cryptanalysis',
                    'SQL injection'
                ],
                'correct_options' => ['Timing attacks', 'Power analysis attacks', 'Acoustic cryptanalysis'],
                'justifications' => [
                    'Exploits execution time variations',
                    'Direct attack, not side-channel',
                    'Analyzes power consumption patterns',
                    'Password attack, not side-channel',
                    'Exploits sound emissions from devices',
                    'Web application attack'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            
            // Replay Attack - Item 29
            [
                'topic_id' => $topics['Cryptographic Attacks'] ?? 197,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Which cryptographic technique best prevents replay attacks?',
                'options' => [
                    'Using stronger encryption',
                    'Including timestamps or nonces',
                    'Increasing key length',
                    'Using digital certificates'
                ],
                'correct_options' => ['Including timestamps or nonces'],
                'justifications' => [
                    'Encryption strength doesn\'t prevent replay',
                    'Correct - Timestamps/nonces ensure message freshness',
                    'Key length doesn\'t address replay attacks',
                    'Certificates authenticate but don\'t prevent replay'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Downgrade Attack - Item 30
            [
                'topic_id' => $topics['Cryptographic Attacks'] ?? 197,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'In a downgrade attack, what does the attacker attempt to do?',
                'options' => [
                    'Steal the encryption keys',
                    'Force the use of weaker cryptographic protocols',
                    'Decrypt messages directly',
                    'Impersonate the server'
                ],
                'correct_options' => ['Force the use of weaker cryptographic protocols'],
                'justifications' => [
                    'Key theft is a different attack type',
                    'Correct - Attacker forces fallback to vulnerable protocols/ciphers',
                    'Downgrade doesn\'t directly decrypt',
                    'Impersonation is a different attack'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            
            // Quantum Computing Threat - Item 31
            [
                'topic_id' => $topics['Quantum-Resistant Cryptography (PQC)'] ?? 198,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Which cryptographic algorithms are most threatened by quantum computers?',
                'options' => [
                    'Symmetric key algorithms like AES',
                    'Hash functions like SHA-256',
                    'Public key algorithms like RSA and ECC',
                    'All algorithms equally'
                ],
                'correct_options' => ['Public key algorithms like RSA and ECC'],
                'justifications' => [
                    'Symmetric algorithms need larger keys but remain secure',
                    'Hash functions are relatively quantum-resistant',
                    'Correct - Shor\'s algorithm breaks RSA/ECC efficiently',
                    'Quantum impact varies significantly by algorithm type'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            
            // PQC Algorithms - Item 32
            [
                'topic_id' => $topics['Quantum-Resistant Cryptography (PQC)'] ?? 198,
                'type_id' => 3,
                'dimension' => 'Technical',
                'content' => 'Select post-quantum cryptography algorithm categories:',
                'options' => [
                    'Lattice-based',
                    'RSA-based',
                    'Code-based',
                    'ECC-based',
                    'Hash-based',
                    'DES-based'
                ],
                'correct_options' => ['Lattice-based', 'Code-based', 'Hash-based'],
                'justifications' => [
                    'Leading PQC approach using lattice problems',
                    'RSA is vulnerable to quantum attacks',
                    'Based on error-correcting codes',
                    'ECC is quantum-vulnerable',
                    'Quantum-resistant signature schemes',
                    'DES is symmetric, not PQC category'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            
            // Key Derivation Function - Item 33
            [
                'topic_id' => $topics['Key Management Lifecycle'] ?? 194,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What is the purpose of a Key Derivation Function (KDF)?',
                'options' => [
                    'To generate random numbers',
                    'To derive cryptographic keys from a password or other input',
                    'To encrypt symmetric keys',
                    'To compress key material'
                ],
                'correct_options' => ['To derive cryptographic keys from a password or other input'],
                'justifications' => [
                    'KDFs derive keys, not random numbers',
                    'Correct - KDFs like PBKDF2 create keys from passwords',
                    'KDFs generate keys, not encrypt them',
                    'KDFs expand, not compress, input material'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            
            // Perfect Forward Secrecy - Item 34
            [
                'topic_id' => $topics['Key Management Lifecycle'] ?? 194,
                'type_id' => 2,
                'dimension' => 'Technical',
                'content' => '**True or False:** Perfect Forward Secrecy ensures that past communications remain secure even if long-term keys are compromised.',
                'options' => [
                    'True',
                    'False'
                ],
                'correct_options' => ['True'],
                'justifications' => [
                    'explanation' => 'Perfect Forward Secrecy (PFS) uses ephemeral keys for each session. Even if an attacker obtains the server\'s private key, they cannot decrypt past communications because the session keys were temporary and have been destroyed.'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            
            // Cryptographic Agility - Item 35
            [
                'topic_id' => $topics['Key Management Lifecycle'] ?? 194,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What does "cryptographic agility" mean in system design?',
                'options' => [
                    'Using the fastest encryption algorithms',
                    'Ability to quickly switch between cryptographic algorithms',
                    'Implementing multiple layers of encryption',
                    'Using lightweight cryptography only'
                ],
                'correct_options' => ['Ability to quickly switch between cryptographic algorithms'],
                'justifications' => [
                    'Speed is not the primary concern',
                    'Correct - Allows migration when algorithms become weak',
                    'Agility is about flexibility, not layers',
                    'Agility includes all algorithm types'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            
            // Command Line - OpenSSL Key Generation - Item 36
            [
                'topic_id' => $topics['Symmetric & Asymmetric Encryption'] ?? 190,
                'type_id' => 7,
                'dimension' => 'Technical',
                'content' => 'Which OpenSSL command generates a 2048-bit RSA private key?',
                'options' => [
                    'openssl genrsa -out private.key 2048',
                    'openssl genpkey -algorithm RSA -out private.key -pkeyopt rsa_keygen_bits:2048',
                    'openssl rsa -in private.key -pubout -out public.key',
                    'openssl req -new -key private.key -out request.csr'
                ],
                'correct_options' => [
                    'openssl genrsa -out private.key 2048',
                    'openssl genpkey -algorithm RSA -out private.key -pkeyopt rsa_keygen_bits:2048'
                ],
                'justifications' => [
                    'Traditional command for RSA key generation',
                    'Modern unified command for key generation'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Command Line - Certificate Signing - Item 37
            [
                'topic_id' => $topics['Public Key Infrastructure (PKI)'] ?? 193,
                'type_id' => 7,
                'dimension' => 'Technical',
                'content' => 'Which command creates a self-signed certificate valid for 365 days?',
                'options' => [
                    'openssl req -x509 -new -key private.key -out cert.crt -days 365',
                    'openssl x509 -req -days 365 -in cert.csr -signkey private.key -out cert.crt',
                    'openssl genrsa -out private.key 2048 -days 365',
                    'openssl verify -CAfile cert.crt cert.crt'
                ],
                'correct_options' => [
                    'openssl req -x509 -new -key private.key -out cert.crt -days 365',
                    'openssl x509 -req -days 365 -in cert.csr -signkey private.key -out cert.crt'
                ],
                'justifications' => [
                    'Creates self-signed cert directly from key',
                    'Signs a CSR with the private key'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Elliptic Curve Selection - Item 38
            [
                'topic_id' => $topics['Symmetric & Asymmetric Encryption'] ?? 190,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Which elliptic curve is recommended by NIST for 128-bit security level?',
                'options' => [
                    'P-192',
                    'P-256',
                    'P-384',
                    'P-521'
                ],
                'correct_options' => ['P-256'],
                'justifications' => [
                    'Provides 96-bit security level',
                    'Correct - P-256 provides 128-bit security level',
                    'Provides 192-bit security level',
                    'Provides 256-bit security level'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            
            // Key Wrapping - Item 39
            [
                'topic_id' => $topics['Key Management Lifecycle'] ?? 194,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What is key wrapping?',
                'options' => [
                    'Physically protecting keys in plastic',
                    'Encrypting keys for secure storage or transport',
                    'Combining multiple keys together',
                    'Compressing keys to save space'
                ],
                'correct_options' => ['Encrypting keys for secure storage or transport'],
                'justifications' => [
                    'Not related to physical protection',
                    'Correct - Key wrapping encrypts keys using KEKs (Key Encryption Keys)',
                    'This would be key combination or derivation',
                    'Keys are fixed-size, not compressible'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            
            // FIPS 140-2 Levels - Item 40
            [
                'topic_id' => $topics['Hardware Security Module (HSM)'] ?? 195,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What does FIPS 140-2 Level 4 require that Level 3 does not?',
                'options' => [
                    'Tamper-evident physical security',
                    'Identity-based authentication',
                    'Environmental protection against extreme conditions',
                    'Role-based authentication'
                ],
                'correct_options' => ['Environmental protection against extreme conditions'],
                'justifications' => [
                    'Required at Level 2',
                    'Required at Level 3',
                    'Correct - Level 4 adds environmental attack protection',
                    'Required at Level 3'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            
            // Homomorphic Encryption - Item 41
            [
                'topic_id' => $topics['Symmetric & Asymmetric Encryption'] ?? 190,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What unique capability does homomorphic encryption provide?',
                'options' => [
                    'Faster encryption than traditional methods',
                    'Ability to perform computations on encrypted data',
                    'Smaller ciphertext size',
                    'Quantum resistance'
                ],
                'correct_options' => ['Ability to perform computations on encrypted data'],
                'justifications' => [
                    'Homomorphic encryption is typically slower',
                    'Correct - Allows operations on ciphertext without decryption',
                    'Usually produces larger ciphertexts',
                    'Not inherently quantum-resistant'
                ],
                'difficulty_level' => 5,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            
            // Salt vs Pepper - Item 42
            [
                'topic_id' => $topics['Hashing'] ?? 191,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What is the key difference between a salt and a pepper in password hashing?',
                'options' => [
                    'Salt is secret, pepper is public',
                    'Salt is unique per password, pepper is a global secret',
                    'Salt is encrypted, pepper is hashed',
                    'There is no difference'
                ],
                'correct_options' => ['Salt is unique per password, pepper is a global secret'],
                'justifications' => [
                    'Salt is stored publicly with the hash',
                    'Correct - Salt prevents rainbow tables, pepper adds secret component',
                    'Both are used in hashing, not encrypted',
                    'They serve different security purposes'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 5,
                'status' => 'published'
            ],
            
            // Key Stretching - Item 43
            [
                'topic_id' => $topics['Key Management Lifecycle'] ?? 194,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Which algorithm is specifically designed for password-based key derivation with configurable work factor?',
                'options' => [
                    'SHA-256',
                    'PBKDF2',
                    'AES-GCM',
                    'RSA-OAEP'
                ],
                'correct_options' => ['PBKDF2'],
                'justifications' => [
                    'Hash function, not key derivation',
                    'Correct - PBKDF2 uses iterations to slow brute force',
                    'Encryption mode, not key derivation',
                    'Encryption padding scheme'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            
            // Certificate Pinning - Item 44
            [
                'topic_id' => $topics['Public Key Infrastructure (PKI)'] ?? 193,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What security benefit does certificate pinning provide?',
                'options' => [
                    'Faster TLS handshakes',
                    'Protection against fraudulent certificates',
                    'Smaller certificate sizes',
                    'Automatic certificate renewal'
                ],
                'correct_options' => ['Protection against fraudulent certificates'],
                'justifications' => [
                    'Pinning may slightly slow connections',
                    'Correct - Pinning prevents MITM with rogue but valid certificates',
                    'Doesn\'t affect certificate size',
                    'Pinning complicates renewal, doesn\'t automate it'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            
            // Cryptographic Best Practices - Item 45
            [
                'topic_id' => $topics['Key Management Lifecycle'] ?? 194,
                'type_id' => 3,
                'dimension' => 'Technical',
                'content' => 'Select cryptographic best practices for modern applications:',
                'options' => [
                    'Use authenticated encryption modes',
                    'Implement custom crypto algorithms',
                    'Use cryptographically secure random generators',
                    'Hard-code encryption keys',
                    'Validate all cryptographic inputs',
                    'Use ECB mode for efficiency'
                ],
                'correct_options' => ['Use authenticated encryption modes', 'Use cryptographically secure random generators', 'Validate all cryptographic inputs'],
                'justifications' => [
                    'AEAD modes prevent tampering',
                    'Never implement custom crypto',
                    'Essential for key and IV generation',
                    'Keys must be properly managed',
                    'Prevent crypto implementation attacks',
                    'ECB is insecure, reveals patterns'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            
            // AES-GCM Implementation - Item 46 (Bloom 3)
            [
                'topic_id' => $topics['Symmetric & Asymmetric Encryption'] ?? 192,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'When implementing AES-GCM, what must be ensured about the initialization vector (IV)?',
                'options' => [
                    'It must be exactly 128 bits',
                    'It must never be reused with the same key',
                    'It must be kept secret',
                    'It must be generated using SHA-256'
                ],
                'correct_options' => ['It must never be reused with the same key'],
                'justifications' => [
                    'GCM IVs can be 96 bits (recommended) or other sizes',
                    'Correct - IV reuse breaks GCM security completely',
                    'IVs are typically transmitted in plaintext',
                    'Any secure random generator is acceptable'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // PKI Certificate Validation - Item 47 (Bloom 3)
            [
                'topic_id' => $topics['Public Key Infrastructure (PKI)'] ?? 193,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'During certificate validation, what should be checked in addition to the digital signature?',
                'options' => [
                    'Only the expiration date',
                    'Certificate chain, expiration, and revocation status',
                    'Only the issuer name',
                    'Only the key size'
                ],
                'correct_options' => ['Certificate chain, expiration, and revocation status'],
                'justifications' => [
                    'Expiration is important but not sufficient',
                    'Correct - Complete validation requires multiple checks',
                    'Issuer verification is part of chain validation',
                    'Key size alone doesn\'t ensure validity'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Hybrid Cryptosystem Design - Item 48 (Bloom 3)
            [
                'topic_id' => $topics['Symmetric & Asymmetric Encryption'] ?? 190,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'In a hybrid cryptosystem, why is symmetric encryption used for the actual data?',
                'options' => [
                    'Symmetric keys are more secure',
                    'Asymmetric encryption is too slow for large data',
                    'Symmetric encryption provides better integrity',
                    'Asymmetric keys are too large'
                ],
                'correct_options' => ['Asymmetric encryption is too slow for large data'],
                'justifications' => [
                    'Security depends on key size and algorithm',
                    'Correct - Asymmetric operations are computationally expensive',
                    'Both can provide integrity with proper modes',
                    'Key size doesn\'t determine encryption choice'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Key Agreement vs Key Transport - Item 49 (Bloom 3)
            [
                'topic_id' => $topics['Key Management Lifecycle'] ?? 194,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What is the main difference between key agreement and key transport protocols?',
                'options' => [
                    'Key agreement is faster than key transport',
                    'Key agreement derives shared keys, key transport encrypts existing keys',
                    'Key transport provides forward secrecy, key agreement does not',
                    'Key agreement only works with symmetric algorithms'
                ],
                'correct_options' => ['Key agreement derives shared keys, key transport encrypts existing keys'],
                'justifications' => [
                    'Performance depends on implementation',
                    'Correct - Agreement creates new keys, transport moves existing ones',
                    'Agreement protocols typically provide better forward secrecy',
                    'Agreement can work with various key types'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Stream Cipher Keystream Reuse - Item 50 (Bloom 3)
            [
                'topic_id' => $topics['Symmetric & Asymmetric Encryption'] ?? 191,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What happens if the same keystream is used to encrypt two different plaintexts in a stream cipher?',
                'options' => [
                    'The encryption becomes twice as strong',
                    'The ciphertexts can be XORed to reveal plaintext relationships',
                    'The decryption process becomes faster',
                    'Nothing significant happens'
                ],
                'correct_options' => ['The ciphertexts can be XORed to reveal plaintext relationships'],
                'justifications' => [
                    'Keystream reuse weakens security',
                    'Correct - XOR of ciphertexts equals XOR of plaintexts',
                    'Security vulnerability, not performance benefit',
                    'Keystream reuse is a critical security failure'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Digital Signature Non-Repudiation - Item 51 (Bloom 4)
            [
                'topic_id' => $topics['Digital Signatures'] ?? 192,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'How do digital signatures provide non-repudiation?',
                'options' => [
                    'By encrypting the message content',
                    'By using the signer\'s private key which only they control',
                    'By including timestamps in all signatures',
                    'By requiring multiple signatures'
                ],
                'correct_options' => ['By using the signer\'s private key which only they control'],
                'justifications' => [
                    'Signatures provide authenticity, not confidentiality',
                    'Correct - Only the private key owner can create valid signatures',
                    'Timestamps help but don\'t provide non-repudiation alone',
                    'Multiple signatures add complexity, not non-repudiation'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 5,
                'status' => 'published'
            ],
            
            // Entropy in Key Generation - Item 52 (Bloom 5)
            [
                'topic_id' => $topics['Key Management Lifecycle'] ?? 194,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Evaluate this statement: "A 256-bit key generated from a PRNG seeded with only 64 bits of entropy provides 256-bit security."',
                'options' => [
                    'True - the output key is 256 bits regardless of seed',
                    'False - security is limited by the entropy of the seed',
                    'True - PRNG expansion increases security',
                    'False - PRNGs always reduce security'
                ],
                'correct_options' => ['False - security is limited by the entropy of the seed'],
                'justifications' => [
                    'Key length doesn\'t determine security strength',
                    'Correct - Security cannot exceed the entropy input',
                    'PRNGs distribute entropy, they don\'t create it',
                    'Good PRNGs preserve entropy, they don\'t reduce it'
                ],
                'difficulty_level' => 4,
                'bloom_level' => 5,
                'status' => 'published'
            ],
            
            // Cryptographic Protocol Design - Item 53 (Bloom 5)
            [
                'topic_id' => $topics['Key Management Lifecycle'] ?? 194,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'When designing a new cryptographic protocol, what is the most critical principle to follow?',
                'options' => [
                    'Optimize for maximum performance',
                    'Use the latest cryptographic algorithms',
                    'Never design custom cryptography without expert review',
                    'Implement multiple encryption layers'
                ],
                'correct_options' => ['Never design custom cryptography without expert review'],
                'justifications' => [
                    'Security should come before performance',
                    'Proven algorithms are better than latest',
                    'Correct - Cryptographic design requires deep expertise',
                    'Layers don\'t guarantee security'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 5,
                'status' => 'published'
            ],
            
            // Side-Channel Attack Mitigation - Item 54 (Bloom 5)
            [
                'topic_id' => $topics['Cryptographic Attacks'] ?? 197,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Evaluate the effectiveness of different countermeasures against timing attacks on RSA implementations:',
                'options' => [
                    'Constant-time algorithms are the most effective',
                    'Adding random delays is sufficient',
                    'Using larger key sizes prevents timing attacks',
                    'Timing attacks are not a practical concern'
                ],
                'correct_options' => ['Constant-time algorithms are the most effective'],
                'justifications' => [
                    'Correct - Constant-time prevents timing information leakage',
                    'Random delays can be statistically filtered out',
                    'Key size doesn\'t affect timing attack vulnerability',
                    'Timing attacks are practical and demonstrated'
                ],
                'difficulty_level' => 4,
                'bloom_level' => 5,
                'status' => 'published'
            ],
            
            // Quantum Cryptography vs PQC - Item 55 (Bloom 5)
            [
                'topic_id' => $topics['Quantum-Resistant Cryptography (PQC)'] ?? 198,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Evaluate the trade-offs between quantum cryptography (QKD) and post-quantum cryptography for enterprise deployment:',
                'options' => [
                    'QKD is more practical for most enterprises',
                    'PQC offers better scalability and infrastructure compatibility',
                    'Both are equally suitable for current deployment',
                    'Neither technology is ready for production use'
                ],
                'correct_options' => ['PQC offers better scalability and infrastructure compatibility'],
                'justifications' => [
                    'QKD requires specialized hardware and infrastructure',
                    'Correct - PQC works with existing systems and scales better',
                    'QKD has significant practical limitations',
                    'PQC standards are being finalized and implemented'
                ],
                'difficulty_level' => 4,
                'bloom_level' => 5,
                'status' => 'published'
            ],
            
            // Cryptographic Agility Implementation - Item 56 (Bloom 5)
            [
                'topic_id' => $topics['Key Management Lifecycle'] ?? 194,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Assess the most critical factor when implementing cryptographic agility in a large distributed system:',
                'options' => [
                    'Choosing the fastest algorithms',
                    'Ensuring backward compatibility during transitions',
                    'Using only FIPS-approved algorithms',
                    'Implementing hardware-based cryptography'
                ],
                'correct_options' => ['Ensuring backward compatibility during transitions'],
                'justifications' => [
                    'Speed is less important than security and compatibility',
                    'Correct - Smooth transitions prevent system failures',
                    'FIPS compliance is important but not the critical factor',
                    'Hardware can help but isn\'t the main consideration'
                ],
                'difficulty_level' => 4,
                'bloom_level' => 5,
                'status' => 'published'
            ],
            
            // Applied Cryptanalysis - Item 57 (Bloom 3)
            [
                'topic_id' => $topics['Cryptographic Attacks'] ?? 197,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'In a chosen-plaintext attack against a block cipher, what advantage does the attacker have?',
                'options' => [
                    'Access to the encryption key',
                    'Ability to choose inputs and observe outputs',
                    'Knowledge of the decryption algorithm',
                    'Access to the hardware implementation'
                ],
                'correct_options' => ['Ability to choose inputs and observe outputs'],
                'justifications' => [
                    'If attacker had the key, no attack would be needed',
                    'Correct - Attacker can analyze cipher behavior with chosen inputs',
                    'Algorithm knowledge is assumed in Kerckhoffs principle',
                    'Hardware access implies a different attack model'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Diffie-Hellman Key Exchange - Item 58 (Bloom 3)
            [
                'topic_id' => $topics['Key Management Lifecycle'] ?? 194,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What vulnerability does ephemeral Diffie-Hellman address that static DH does not?',
                'options' => [
                    'Computational complexity',
                    'Forward secrecy',
                    'Authentication of parties',
                    'Protection against quantum computers'
                ],
                'correct_options' => ['Forward secrecy'],
                'justifications' => [
                    'Both have similar computational requirements',
                    'Correct - Ephemeral keys provide forward secrecy',
                    'Neither provides authentication without additional mechanisms',
                    'Both are equally vulnerable to quantum attacks'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Cryptographic Commitment Schemes - Item 59 (Bloom 3)
            [
                'topic_id' => $topics['Hashing'] ?? 191,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'How do hash-based commitment schemes ensure the binding property?',
                'options' => [
                    'By using symmetric encryption',
                    'Through the collision resistance of the hash function',
                    'By requiring digital signatures',
                    'Through time-based validation'
                ],
                'correct_options' => ['Through the collision resistance of the hash function'],
                'justifications' => [
                    'Commitment schemes don\'t require encryption',
                    'Correct - Collision resistance prevents changing committed values',
                    'Signatures provide authenticity, not binding',
                    'Time doesn\'t provide cryptographic binding'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Authenticated Key Exchange - Item 60 (Bloom 3)
            [
                'topic_id' => $topics['Key Management Lifecycle'] ?? 194,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What does an authenticated key exchange protocol provide that basic Diffie-Hellman does not?',
                'options' => [
                    'Computational efficiency',
                    'Protection against man-in-the-middle attacks',
                    'Smaller key sizes',
                    'Quantum resistance'
                ],
                'correct_options' => ['Protection against man-in-the-middle attacks'],
                'justifications' => [
                    'Authentication typically adds computational overhead',
                    'Correct - Authentication prevents MITM attacks',
                    'Authentication doesn\'t affect key sizes',
                    'Authentication doesn\'t provide quantum resistance'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Key Derivation Security - Item 61 (Bloom 3)
            [
                'topic_id' => $topics['Key Management Lifecycle'] ?? 194,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Why should different derived keys be used for encryption and authentication in the same protocol?',
                'options' => [
                    'To improve performance',
                    'To prevent key reuse vulnerabilities',
                    'To reduce storage requirements',
                    'To comply with regulations'
                ],
                'correct_options' => ['To prevent key reuse vulnerabilities'],
                'justifications' => [
                    'Separate keys add complexity, not performance',
                    'Correct - Key separation prevents cryptographic attacks',
                    'Separate keys increase storage needs',
                    'While good practice, the primary reason is security'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Padding Oracle Attacks - Item 62 (Bloom 3)
            [
                'topic_id' => $topics['Cryptographic Attacks'] ?? 197,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'How do padding oracle attacks exploit CBC mode implementations?',
                'options' => [
                    'By guessing the encryption key',
                    'By observing different error responses to manipulated ciphertext',
                    'By analyzing the initialization vector',
                    'By measuring encryption timing'
                ],
                'correct_options' => ['By observing different error responses to manipulated ciphertext'],
                'justifications' => [
                    'The attack doesn\'t directly target the key',
                    'Correct - Different errors reveal padding validity',
                    'IV analysis is a different type of attack',
                    'This describes timing attacks, not padding oracles'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // AES Key Schedule - Item 63 (Bloom 4)
            [
                'topic_id' => $topics['Symmetric & Asymmetric Encryption'] ?? 190,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Which statement best describes the AES key schedule?',
                'options' => [
                    'It uses the same key for all encryption rounds',
                    'It derives round keys from the main key using transformation functions',
                    'It requires external key generation for each round',
                    'It uses random keys for each round'
                ],
                'correct_options' => ['It derives round keys from the main key using transformation functions'],
                'justifications' => [
                    'AES uses different keys for each round',
                    'Correct - Key schedule expands main key into round keys',
                    'Round keys are derived, not externally generated',
                    'Round keys are deterministically derived, not random'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            
            // Key Derivation Best Practices - Item 64 (Bloom 4)
            [
                'topic_id' => $topics['Key Management Lifecycle'] ?? 194,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'When deriving multiple keys from a master key, what is the most important security consideration?',
                'options' => [
                    'Use the fastest derivation algorithm',
                    'Ensure derived keys are cryptographically independent',
                    'Use the same salt for all derivations',
                    'Generate keys in alphabetical order'
                ],
                'correct_options' => ['Ensure derived keys are cryptographically independent'],
                'justifications' => [
                    'Security is more important than speed',
                    'Correct - Independence prevents related-key attacks',
                    'Different salts should be used for different keys',
                    'Order of generation doesn\'t affect security'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            
            // Additional 6 questions to reach perfect 7-10-16-10-7 distribution
            // Need: +1 Level 1, +1 Level 2, +3 Level 3, +1 Level 4
            
            // Item 65 - Level 1 (Remember)
            [
                'topic_id' => $topics['Symmetric & Asymmetric Encryption'] ?? 187,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What is the key size of AES-256?',
                'options' => [
                    '128 bits',
                    '192 bits',
                    '256 bits',
                    '512 bits'
                ],
                'correct_options' => ['256 bits'],
                'justifications' => [
                    'This is AES-128 key size',
                    'This is AES-192 key size',
                    'Correct - AES-256 uses 256-bit keys',
                    'This is not a standard AES key size'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            
            // Item 66 - Level 2 (Understand)
            [
                'topic_id' => $topics['Hashing'] ?? 189,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Why is SHA-1 no longer recommended for security-critical applications?',
                'options' => [
                    'It is too slow for modern systems',
                    'It produces outputs that are too short',
                    'It has known collision vulnerabilities',
                    'It requires too much memory'
                ],
                'correct_options' => ['It has known collision vulnerabilities'],
                'justifications' => [
                    'Speed is not the primary security concern',
                    'Output length is adequate for many applications',
                    'Correct - SHA-1 collision attacks have been demonstrated',
                    'Memory requirements are not the main issue'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            
            // Item 67 - Level 3 (Apply)
            [
                'topic_id' => $topics['Digital Signatures'] ?? 190,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Your organization needs to implement document signing for legal contracts. Which approach provides the strongest non-repudiation?',
                'options' => [
                    'Symmetric encryption with shared key',
                    'Digital signatures with certificate authority validation',
                    'Hash-based message authentication codes (HMAC)',
                    'Basic password protection'
                ],
                'correct_options' => ['Digital signatures with certificate authority validation'],
                'justifications' => [
                    'Shared keys don\'t provide non-repudiation',
                    'Correct - Digital signatures with CA validation provide strong non-repudiation',
                    'HMAC provides authentication but not non-repudiation',
                    'Passwords provide weak protection and no non-repudiation'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Item 68 - Level 3 (Apply)
            [
                'topic_id' => $topics['Key Management Lifecycle'] ?? 194,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'A database encryption key needs to be rotated. What is the proper sequence of actions?',
                'options' => [
                    'Delete old key, generate new key, re-encrypt all data',
                    'Generate new key, re-encrypt all data, securely destroy old key',
                    'Re-encrypt all data, generate new key, delete old key',
                    'Generate new key, delete old key, re-encrypt all data'
                ],
                'correct_options' => ['Generate new key, re-encrypt all data, securely destroy old key'],
                'justifications' => [
                    'Deleting old key first would make data inaccessible',
                    'Correct - Generate new key first, then migrate data, then destroy old key',
                    'Can\'t re-encrypt without the new key',
                    'Deleting old key before re-encryption would cause data loss'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Item 69 - Level 3 (Apply)
            [
                'topic_id' => $topics['Public Key Infrastructure (PKI)'] ?? 191,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'An employee leaves the company and their digital certificate needs to be revoked. Which PKI component handles this process?',
                'options' => [
                    'Registration Authority (RA)',
                    'Certificate Authority (CA)',
                    'Certificate Revocation List (CRL)',
                    'Online Certificate Status Protocol (OCSP)'
                ],
                'correct_options' => ['Certificate Authority (CA)'],
                'justifications' => [
                    'RA handles registration, not revocation',
                    'Correct - CA issues and revokes certificates',
                    'CRL lists revoked certificates but doesn\'t perform revocation',
                    'OCSP provides revocation status but doesn\'t perform revocation'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Item 70 - Level 4 (Analyze)
            [
                'topic_id' => $topics['Symmetric & Asymmetric Encryption'] ?? 192,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'A company implements TLS 1.3 for web communications but still experiences security issues. Analysis shows perfect forward secrecy is not achieved. What is the MOST likely cause?',
                'options' => [
                    'Using RSA key exchange instead of ephemeral keys',
                    'Incorrect certificate configuration',
                    'Using weak cipher suites',
                    'Improper session management'
                ],
                'correct_options' => ['Using RSA key exchange instead of ephemeral keys'],
                'justifications' => [
                    'Correct - RSA key exchange doesn\'t provide perfect forward secrecy, ephemeral keys are required',
                    'Certificate issues don\'t directly affect perfect forward secrecy',
                    'TLS 1.3 eliminated weak cipher suites',
                    'Session management doesn\'t directly impact perfect forward secrecy'
                ],
                'difficulty_level' => 4,
                'bloom_level' => 4,
                'status' => 'published'
            ]
        ];
        
        // Insert all items
        foreach ($items as $item) {
            DiagnosticItem::create($item);
        }
        
        $this->command->info('Domain 8 (Cryptography & Key Management) diagnostic items seeded successfully!');
    }
}