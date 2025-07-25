<?php

namespace Database\Seeders\Diagnostics;

class D8CryptographyKeyManagementSeeder extends BaseDiagnosticSeeder
{
    protected string $domainName = 'Cryptography & Key Management';
    
    protected function getQuestions(): array
    {
        return [
            // Topic 1: Cryptographic Fundamentals (10 questions)
            // Bloom Distribution: L1:1, L2:2, L3:3, L4:2, L5:2
            
            // Item 1 - L3 - Apply
            [
                'topic' => 'Cryptography Algorithms',
                'subtopic' => 'Symmetric Encryption',
                'question' => 'In a discussion on symmetric encryption, a colleague points out that scalability is a major drawback. Specifically, they mention that as the number of participants increases, the number of required unique keys grows significantly.

If 10 users are part of a symmetric encryption system where each pair needs a unique shared key, how many unique symmetric keys are needed to support secure communication between all users?',
                'options' => [
                    '20',
                    '45',
                    '90',
                    '100'
                ],
                'correct_options' => ['45'],
                'justifications' => [
                    'Incorrect - This would be 2×10, but doesn\'t account for the combinatorial nature of unique pairs',
                    'Correct - Using the combination formula C(n,2) = n×(n-1)/2, where n=10: 10×9/2 = 45 unique pairs, each requiring one shared symmetric key',
                    'Incorrect - This would be 10×9, which counts each pair twice (e.g., Alice-Bob and Bob-Alice as separate)',
                    'Incorrect - This would be 10², but includes users paired with themselves and counts pairs bidirectionally'
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.4,
                'irt_b' => 0.2,
                'irt_c' => 0.25,
                'status' => 'published',
                'type_id' => 1

            ],
            
            // Item 2 - L1 - Remember
            [
                'topic' => 'Cryptography Algorithms',
                'subtopic' => 'Symmetric Encryption',
                'question' => 'Which of the following is an example of a symmetric encryption algorithm?',
                'type_id' => 1,
                'options' => [
                    'RSA',
                    'AES',
                    'Diffie-Hellman',
                    'DSA'
                ],
                'correct_options' => ['AES'],
                'justifications' => [
                    'Incorrect - RSA is an asymmetric encryption algorithm that uses a public-private key pair for encryption and decryption',
                    'Correct - AES (Advanced Encryption Standard) is a symmetric encryption algorithm that uses the same key for both encryption and decryption',
                    'Incorrect - Diffie-Hellman is a key exchange protocol used to establish a shared secret, not an encryption algorithm',
                    'Incorrect - DSA (Digital Signature Algorithm) is used for digital signatures, not encryption'
                ],
                'bloom_level' => 1,
                'difficulty_level' => 1,
                'irt_a' => 0.8,
                'irt_b' => -1.2,
                'irt_c' => 0.25,
                'status' => 'published'

            ],
            
            // Item 3 - L3 - Apply
            [
                'topic' => 'Cryptography Algorithms',
                'subtopic' => 'Cipher Types',
                'question' => 'Consider a scenario where live video conferencing data needs to be encrypted for confidentiality. The data arrives in a continuous stream, and any significant latency introduced by encryption would severely degrade the user experience.

Which type of symmetric cipher would be inherently more advantageous for this specific application compared to the other, and what is its main operational benefit in this context?',
                'options' => [
                    'Block cipher, because it provides stronger security due to its fixed block size.',
                    'Stream cipher, because it processes data continuously without needing to wait for full blocks, minimizing latency.',
                    'Block cipher, because it is easier to implement in hardware for video encoding.',
                    'Stream cipher, because it generates unique keys for each frame of video.'
                ],
                'correct_options' => ['Stream cipher, because it processes data continuously without needing to wait for full blocks, minimizing latency.'],
                'justifications' => [
                    'Incorrect - Block size does not inherently provide stronger security; both cipher types can be equally secure when properly implemented',
                    'Correct - Stream ciphers encrypt data bit-by-bit or byte-by-byte as it arrives, eliminating the need to buffer data into fixed-size blocks, which significantly reduces latency for real-time applications like video conferencing',
                    'Incorrect - Hardware implementation ease depends on specific designs, not cipher type; both block and stream ciphers can have efficient hardware implementations',
                    'Incorrect - Stream ciphers use a continuous keystream, not unique keys per frame; key management is separate from the cipher\'s operational characteristics'
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.4,
                'irt_b' => 0.1,
                'irt_c' => 0.25,
                'status' => 'published',
                'type_id' => 1

            ],
            
            // Item 4 - L3 - Apply
            [
                'topic' => 'Cryptography Algorithms',
                'subtopic' => 'Algorithm Selection',
                'question' => 'Consider two asymmetric cryptographic primitives:

**Primitive X:** Relies on the computational difficulty of factoring large prime numbers to provide security for encryption and digital signatures.

**Primitive Y:** Relies on the computational difficulty of the discrete logarithm problem over elliptic curves, offering equivalent security with significantly smaller key sizes compared to Primitive X.

How do Primitive X and Primitive Y primarily differ in their underlying mathematical problem and their practical implications for resource-constrained environments?',
                'options' => [
                    'Primitive X is RSA, Primitive Y is Diffie-Hellman; Y is faster for key exchange only.',
                    'Primitive X is ECC, Primitive Y is RSA; X is better for resource-constrained devices.',
                    'Primitive X is RSA, Primitive Y is ECC; Y is generally preferred for mobile devices or IoT due to smaller keys and computational efficiency.',
                    'Primitive X is Diffie-Hellman, Primitive Y is ECC; X is used for encryption while Y is for hashing.'
                ],
                'correct_options' => ['Primitive X is RSA, Primitive Y is ECC; Y is generally preferred for mobile devices or IoT due to smaller keys and computational efficiency.'],
                'justifications' => [
                    'Incorrect - Diffie-Hellman is based on discrete logarithms in finite fields, not prime factorization; it is primarily for key exchange, not encryption/signatures',
                    'Incorrect - This reverses the primitives; RSA relies on prime factorization while ECC uses elliptic curve discrete logarithms',
                    'Correct - Primitive X (prime factorization) is RSA, while Primitive Y (elliptic curve discrete logarithm) is ECC; ECC provides equivalent security with much smaller key sizes, making it ideal for resource-constrained environments like mobile devices and IoT',
                    'Incorrect - Diffie-Hellman uses discrete logarithms but not prime factorization; ECC is not used for hashing but for encryption and digital signatures'
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.4,
                'irt_b' => 0.1,
                'irt_c' => 0.25,
                'status' => 'published',
                'type_id' => 1

            ],
            
            // Item 5 - L3 - Apply
            [
                'topic' => 'Cryptography Algorithms',
                'subtopic' => 'Symmetric Encryption',
                'question' => 'Drag only symmetric algorithms to the drop zone:',
                'type_id' => 3, // Drag and drop (single zone)
                'options' => [
                    'AES',
                    'RSA', 
                    'DES',
                    'Diffie-Hellman',
                    '3DES',
                    'ECC'
                ],
                'correct_options' => ['AES', 'DES', '3DES'],
                'justifications' => [
                    'AES (Advanced Encryption Standard) is a symmetric block cipher that uses the same key for encryption and decryption.',
                    'RSA is an asymmetric algorithm that uses different keys for encryption and decryption (public/private key pair).',
                    'DES (Data Encryption Standard) is a symmetric block cipher that uses the same 56-bit key for encryption and decryption.',
                    'Diffie-Hellman is a key exchange protocol, not an encryption algorithm. It\'s used to securely establish a shared secret.',
                    '3DES (Triple DES) is a symmetric algorithm that applies DES three times with different keys.',
                    'ECC (Elliptic Curve Cryptography) is an asymmetric algorithm based on elliptic curve mathematics.'
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.5,
                'irt_b' => 0.3,
                'irt_c' => 0.25,
                'status' => 'published'

            ],
            
            // Item 6 - L3 - Apply
            [
                'topic' => 'Cryptography Algorithms',
                'subtopic' => 'Algorithm Selection',
                'question' => 'How should you implement cryptographic randomness for generating encryption keys in a production system?',
                'options' => [
                    'Use system time as a random seed',
                    'Use cryptographically secure pseudo-random number generators (CSPRNG)',
                    'Use simple mathematical formulas for key generation',
                    'Allow users to choose their own random values'
                ],
                'correct_options' => ['Use cryptographically secure pseudo-random number generators (CSPRNG)'],
                'justifications' => [
                    'Incorrect - This option does not accurately describe the concept',
                    'Correct - Use cryptographically secure pseudo-random number generators (CSPRNG)',
                    'Incorrect - This option does not accurately describe the concept',
                    'Incorrect - This overstates the capability or scope',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.4,
                'irt_b' => 0.5,
                'irt_c' => 0.25,
                'status' => 'published',
                'type_id' => 1

            ],
            
            // Item 7 - L3 - Apply
            [
                'topic' => 'Cryptography Algorithms',
                'subtopic' => 'Cipher Types',
                'question' => 'Consider two symmetric encryption algorithms:

**Algorithm X:** Operates on fixed-size blocks of data, requiring padding if the plaintext size is not a multiple of the block size.

**Algorithm Y:** Encrypts data bit-by-bit or byte-by-byte, suitable for streaming data where latency is critical.

How do Algorithm X and Algorithm Y primarily differ in their fundamental operational mode, and what is a key advantage of Algorithm Y in certain applications?',
                'options' => [
                    'Algorithm X is a stream cipher, Algorithm Y is a block cipher; Y is better for bulk encryption.',
                    'Algorithm X is a block cipher, Algorithm Y is a stream cipher; Y avoids padding and is efficient for continuous data streams.',
                    'Algorithm X uses a single key for encryption and decryption, Algorithm Y uses separate keys; Y is more secure.',
                    'Both are block ciphers, but Algorithm Y uses a larger block size for better performance.'
                ],
                'correct_options' => ['Algorithm X is a block cipher, Algorithm Y is a stream cipher; Y avoids padding and is efficient for continuous data streams.'],
                'justifications' => [
                    'Incorrect - This reverses the cipher types; fixed-size blocks with padding indicates block cipher behavior',
                    'Correct - Algorithm X (fixed blocks, requires padding) is a block cipher, while Algorithm Y (bit/byte-by-byte, streaming) is a stream cipher; stream ciphers avoid padding and efficiently handle continuous data',
                    'Incorrect - Both algorithms are symmetric and use the same key for encryption and decryption; key usage is not the distinguishing factor',
                    'Incorrect - Algorithm Y operates bit/byte-by-byte, which is characteristic of stream ciphers, not block ciphers with larger blocks'
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.4,
                'irt_b' => 0.2,
                'irt_c' => 0.25,
                'status' => 'published',
                'type_id' => 1

            ],
            
            // Item 8 - L3 - Apply
            [
                'topic' => 'Cryptography Algorithms',
                'subtopic' => 'Hash Functions',
                'question' => 'Consider two hashing algorithms:

**Algorithm A:** Produces a 128-bit hash value and has known, practical collision vulnerabilities, meaning it\'s feasible to find two different inputs that produce the same hash.

**Algorithm B:** Produces a 256-bit hash value and is designed to be highly resistant to collision attacks, making it suitable for digital signatures and password storage.

How do Algorithm A and Algorithm B primarily differ in their security strength and recommended use cases?',
                'options' => [
                    'Algorithm A is SHA-256, Algorithm B is MD5; A is for speed, B for security.',
                    'Algorithm A is MD5, Algorithm B is SHA-256; A is deprecated for security-critical applications, while B is a current standard.',
                    'Algorithm A is Blake2, Algorithm B is SHA-3; A is for general-purpose hashing, B is for cryptocurrencies.',
                    'Both algorithms are secure for integrity checks but differ in output size.'
                ],
                'correct_options' => ['Algorithm A is MD5, Algorithm B is SHA-256; A is deprecated for security-critical applications, while B is a current standard.'],
                'justifications' => [
                    'Incorrect - This reverses the algorithms; SHA-256 produces 256-bit hashes and is secure, while MD5 produces 128-bit hashes with known vulnerabilities',
                    'Correct - Algorithm A (128-bit, collision vulnerabilities) is MD5, which is deprecated for security-critical uses; Algorithm B (256-bit, collision-resistant) is SHA-256, the current standard for digital signatures and secure applications',
                    'Incorrect - Blake2 is actually a secure, modern hashing algorithm without practical collision vulnerabilities; SHA-3 is not specifically designed for cryptocurrencies',
                    'Incorrect - Algorithm A (MD5) has practical collision vulnerabilities making it unsuitable for integrity checks in security-critical applications'
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.4,
                'irt_b' => 0.2,
                'irt_c' => 0.25,
                'status' => 'published',
                'type_id' => 1

            ],
            
            // Item 9 - L5 - Evaluate
            [
                'topic' => 'Cryptography Algorithms',
                'subtopic' => 'Algorithm Selection',
                'question' => 'A startup proposes using their \"revolutionary\" encryption algorithm that is 10x faster than AES but uses a proprietary, secret design. Evaluate this approach.',
                'options' => [
                    'Excellent choice since faster encryption improves security',
                    'Highly risky - security through obscurity violates Kerckhoffs\' principle',
                    'Good option if the company has strong legal protections',
                    'Perfect for startups needing competitive advantages'
                ],
                'correct_options' => ['Highly risky - security through obscurity violates Kerckhoffs\' principle'],
                'justifications' => [
                    'Incorrect - This option does not accurately describe the concept',
                    'Correct - Highly risky - security through obscurity violates Kerckhoffs\' principle',
                    'Incorrect - This option does not accurately describe the concept',
                    'Incorrect - This option does not accurately describe the concept',
                ],
                'bloom_level' => 5,
                'difficulty_level' => 5,
                'irt_a' => 1.9,
                'irt_b' => 1.3,
                'irt_c' => 0.15,
                'status' => 'published',
                'type_id' => 1

            ],
            
            // Item 10 - L5 - Evaluate
            [
                'topic' => 'Cryptography Algorithms',
                'subtopic' => 'Algorithm Selection',
                'question' => 'A legacy system in an industrial control environment still relies on 3DES for data communication. A security assessment recommends migrating to a more modern encryption standard. From a combined perspective of security posture improvement and operational impact, which of the following migrations would be the most justifiable and practical for replacing 3DES, and why?',
                'options' => [
                    'Migrate to DES, as it offers a simpler implementation for legacy systems.',
                    'Migrate to RSA, as asymmetric encryption is inherently more secure than symmetric.',
                    'Migrate to AES-256, as it offers significantly stronger security, better performance, and is a widely adopted industry standard with robust implementations.',
                    'Migrate to ChaCha20, as it is a newer algorithm, but only if the system has strong hardware acceleration.'
                ],
                'correct_options' => ['Migrate to AES-256, as it offers significantly stronger security, better performance, and is a widely adopted industry standard with robust implementations.'],
                'justifications' => [
                    'Incorrect - DES is cryptographically weaker than 3DES with only 56-bit keys; migrating to DES would degrade security posture',
                    'Incorrect - RSA is asymmetric encryption used for key exchange and digital signatures, not bulk data encryption due to performance limitations; unsuitable for replacing 3DES in communication',
                    'Correct - AES-256 is the direct modern replacement for 3DES, offering superior security (256-bit keys vs 168-bit effective), better performance (especially with CPU hardware acceleration), and widespread industry adoption ensuring robust implementations and support',
                    'Incorrect - While ChaCha20 is excellent, AES-256 has broader hardware support in existing systems and is more established in industrial environments, making it more practical for legacy system migration'
                ],
                'bloom_level' => 5,
                'difficulty_level' => 5,
                'irt_a' => 2.0,
                'irt_b' => 1.5,
                'irt_c' => 0.15,
                'status' => 'published',
                'type_id' => 1

            ],
            
            // Topic 2: Encryption Implementation (10 questions)
            // Bloom Distribution: L1:1, L2:2, L3:3, L4:2, L5:2
            
            // Item 11 - L2 - Understand
            [
                'topic' => 'Cryptographic Applications',
                'subtopic' => 'Digital Signatures',
                'question' => 'Which cryptographic technique ensures the authenticity and integrity of a message?',
                'type_id' => 1,
                'options' => [
                    'Encryption',
                    'Digital Signature',
                    'Hashing',
                    'Decryption'
                ],
                'correct_options' => ['Digital Signature'],
                'justifications' => [
                    'Incorrect - Encryption ensures confidentiality by making data unreadable to unauthorized parties, but does not provide authenticity or integrity verification',
                    'Correct - Digital signatures ensure both authenticity (verifying the sender\'s identity) and integrity (confirming the message has not been tampered with) by using the sender\'s private key',
                    'Incorrect - Hashing provides integrity checking but does not ensure authenticity of the sender; anyone can compute a hash',
                    'Incorrect - Decryption is the process of converting encrypted data back to readable form; it does not provide authenticity or integrity assurance'
                ],
                'bloom_level' => 2,
                'difficulty_level' => 2,
                'irt_a' => 1.1,
                'irt_b' => -0.8,
                'irt_c' => 0.25,
                'status' => 'published'

            ],
            
            // Item 12 - L2 - Understand
            [
                'topic' => 'Cryptographic Applications',
                'subtopic' => 'Hash Functions',
                'question' => 'What is the primary function of a hash function in cryptography?',
                'type_id' => 1,
                'options' => [
                    'To encrypt data into a reversible form.',
                    'To generate a fixed-size hash value that represents data.',
                    'To create a public-private key pair.',
                    'To decrypt encrypted messages.'
                ],
                'correct_options' => ['To generate a fixed-size hash value that represents data.'],
                'justifications' => [
                    'Incorrect - Hash functions are one-way functions that cannot be reversed; they do not encrypt data in a reversible manner',
                    'Correct - The primary function of a hash function is to take input data of any size and produce a fixed-size hash value (digest) that uniquely represents that data',
                    'Incorrect - Creating public-private key pairs is the function of key generation algorithms in asymmetric cryptography, not hash functions',
                    'Incorrect - Hash functions do not decrypt messages; they create fixed-size digests of input data for integrity verification'
                ],
                'bloom_level' => 2,
                'difficulty_level' => 2,
                'irt_a' => 1.0,
                'irt_b' => -0.6,
                'irt_c' => 0.25,
                'status' => 'published'

            ],
            
            // Item 13 - L2 - Understand
            [
                'topic' => 'Cryptographic Applications',
                'subtopic' => 'Authentication vs Integrity',
                'question' => 'How do side-channel attacks exploit cryptographic implementations?',
                'options' => [
                    'By breaking the mathematical foundation of algorithms',
                    'By analyzing physical characteristics like timing, power consumption, or electromagnetic emissions',
                    'By reverse engineering source code',
                    'By intercepting network communications'
                ],
                'correct_options' => ['By analyzing physical characteristics like timing, power consumption, or electromagnetic emissions'],
                'justifications' => [
                    'Incorrect - This option does not accurately describe the concept',
                    'Correct - By analyzing physical characteristics like timing, power consumption, or electromagnetic emissions',
                    'Incorrect - This option does not accurately describe the concept',
                    'Incorrect - This option does not accurately describe the concept',
                ],
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'irt_a' => 1.4,
                'irt_b' => -0.1,
                'irt_c' => 0.25,
                'status' => 'published',
                'type_id' => 1

            ],
            
            // Item 14 - L3 - Apply
            [
                'topic' => 'Cryptographic Applications',
                'subtopic' => 'Message Authentication Codes',
                'question' => 'When implementing AES-GCM for a web application, what is the most critical implementation consideration?',
                'options' => [
                    'Using the fastest available processor',
                    'Ensuring nonce uniqueness for each encryption operation',
                    'Maximizing key size to 512 bits',
                    'Implementing custom padding schemes'
                ],
                'correct_options' => ['Ensuring nonce uniqueness for each encryption operation'],
                'justifications' => [
                    'Incorrect - This option does not accurately describe the concept',
                    'Correct - Ensuring nonce uniqueness for each encryption operation',
                    'Incorrect - This option does not accurately describe the concept',
                    'Incorrect - This option does not accurately describe the concept',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.5,
                'irt_b' => 0.2,
                'irt_c' => 0.25,
                'status' => 'published',
                'type_id' => 1

            ],
            
            // Item 15 - L5 - Evaluate
            [
                'topic' => 'Cryptographic Applications',
                'subtopic' => 'Cryptographic Applications',
                'question' => 'Evaluate the security implications of a mobile banking application that derives encryption keys from user PINs using a simple SHA-256 hash, arguing that "additional complexity would hurt user experience." Assess this cryptographic design decision.',
                'options' => [
                    'SHA-256 provides adequate security for PIN-based key derivation in all scenarios',
                    'This approach is cryptographically weak due to low entropy and lack of proper key stretching, creating significant security risks',
                    'User experience should always take priority over cryptographic strength',
                    'PIN-based key derivation is inherently secure regardless of implementation'
                ],
                'correct_options' => ['This approach is cryptographically weak due to low entropy and lack of proper key stretching, creating significant security risks'],
                'justifications' => [
                    'Incorrect - SHA-256 alone is insufficient for PIN-based key derivation due to limited entropy',
                    'Correct - PINs have low entropy and require proper key derivation functions with salting and iteration counts',
                    'Incorrect - Security requirements cannot be compromised, especially in financial applications',
                    'Incorrect - PIN-based systems require careful cryptographic design to provide adequate security',
                ],
                'bloom_level' => 5,
                'difficulty_level' => 5,
                'irt_a' => 1.9,
                'irt_b' => 1.4,
                'irt_c' => 0.15,
                'status' => 'published',
                'type_id' => 1

            ],
            
            // Item 16 - L3 - Apply
            [
                'topic' => 'Cryptographic Applications',
                'subtopic' => 'Cryptographic Applications',
                'question' => 'What is the best approach for implementing database field-level encryption in a high-transaction environment?',
                'options' => [
                    'Encrypt entire database files at the filesystem level',
                    'Use transparent data encryption with careful key management',
                    'Avoid encryption to maintain performance',
                    'Use the same key for all database fields'
                ],
                'correct_options' => ['Use transparent data encryption with careful key management'],
                'justifications' => [
                    'Incorrect - This option does not accurately describe the concept',
                    'Correct - Use transparent data encryption with careful key management',
                    'Incorrect - This option does not accurately describe the concept',
                    'Incorrect - This overstates the capability or scope',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.6,
                'irt_b' => 0.6,
                'irt_c' => 0.25,
                'status' => 'published',
                'type_id' => 1

            ],
            
            // Item 17 - L4 - Analyze
            [
                'topic' => 'Cryptographic Applications',
                'subtopic' => 'Cryptographic Applications',
                'question' => 'Analyze why hardcoding encryption keys in application source code creates severe security vulnerabilities.',
                'options' => [
                    'Hardcoded keys make applications run slower',
                    'Keys become visible to anyone with code access and cannot be rotated easily',
                    'Hardcoded keys only work on specific operating systems',
                    'Hardcoded keys reduce encryption strength'
                ],
                'correct_options' => ['Keys become visible to anyone with code access and cannot be rotated easily'],
                'justifications' => [
                    'Incorrect - This option does not accurately describe the concept',
                    'Correct - Keys become visible to anyone with code access and cannot be rotated easily',
                    'Incorrect - This is too absolute or limiting',
                    'Incorrect - This option does not accurately describe the concept',
                ],
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'irt_a' => 1.7,
                'irt_b' => 0.9,
                'irt_c' => 0.20,
                'status' => 'published',
                'type_id' => 1

            ],
            
            // Item 18 - L4 - Analyze
            [
                'topic' => 'Cryptographic Applications',
                'subtopic' => 'Cryptographic Applications',
                'question' => 'What is the critical flaw in using CBC mode with predictable initialization vectors?',
                'options' => [
                    'CBC mode becomes incompatible with most systems',
                    'Predictable IVs allow attackers to determine information about plaintext',
                    'CBC mode requires more computational resources',
                    'Predictable IVs make decryption impossible'
                ],
                'correct_options' => ['Predictable IVs allow attackers to determine information about plaintext'],
                'justifications' => [
                    'Incorrect - This option does not accurately describe the concept',
                    'Correct - Predictable IVs allow attackers to determine information about plaintext',
                    'Incorrect - This option does not accurately describe the concept',
                    'Incorrect - This option does not accurately describe the concept',
                ],
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'irt_a' => 1.8,
                'irt_b' => 1.1,
                'irt_c' => 0.20,
                'status' => 'published',
                'type_id' => 1

            ],
            
            // Item 19 - L5 - Evaluate
            [
                'topic' => 'Cryptographic Applications',
                'subtopic' => 'Cryptographic Applications',
                'question' => 'A developer implements "belt-and-suspenders" security by encrypting data with AES-256, then encrypting the result with Blowfish, then with 3DES. Evaluate this approach.',
                'options' => [
                    'Excellent layered security approach',
                    'Potentially weakens security and definitely reduces performance without clear benefit',
                    'Standard best practice for high-security environments',
                    'Required approach for government applications'
                ],
                'correct_options' => ['Potentially weakens security and definitely reduces performance without clear benefit'],
                'justifications' => [
                    'Incorrect - This option does not accurately describe the concept',
                    'Correct - Potentially weakens security and definitely reduces performance without clear benefit',
                    'Incorrect - This option does not accurately describe the concept',
                    'Incorrect - This option does not accurately describe the concept',
                ],
                'bloom_level' => 5,
                'difficulty_level' => 5,
                'irt_a' => 1.9,
                'irt_b' => 1.4,
                'irt_c' => 0.15,
                'status' => 'published',
                'type_id' => 1

            ],
            
            // Item 20 - L5 - Evaluate
            [
                'topic' => 'Cryptographic Applications',
                'subtopic' => 'Cryptographic Applications',
                'question' => 'An application uses client-side JavaScript to encrypt sensitive data before sending it to the server, claiming this provides end-to-end encryption. Assess this implementation.',
                'options' => [
                    'Perfect implementation of end-to-end encryption',
                    'Flawed approach - client-side code can be manipulated and keys exposed',
                    'Industry standard for web application security',
                    'Only acceptable for low-security applications'
                ],
                'correct_options' => ['Flawed approach - client-side code can be manipulated and keys exposed'],
                'justifications' => [
                    'Incorrect - This option does not accurately describe the concept',
                    'Correct - Flawed approach - client-side code can be manipulated and keys exposed',
                    'Incorrect - This option does not accurately describe the concept',
                    'Incorrect - This is too absolute or limiting',
                ],
                'bloom_level' => 5,
                'difficulty_level' => 5,
                'irt_a' => 2.0,
                'irt_b' => 1.3,
                'irt_c' => 0.15,
                'status' => 'published',
                'type_id' => 1

            ],
            
            // Topic 3: Digital Signatures & PKI (10 questions)
            // Bloom Distribution: L1:2, L2:2, L3:3, L4:2, L5:1
            
            // Item 21 - L2 - Understand
            [
                'topic' => 'Digital Signatures & PKI',
                'subtopic' => 'Public Key Infrastructure (PKI)',
                'question' => 'In public key infrastructure (PKI), what role does a certificate authority (CA) play?',
                'type_id' => 1,
                'options' => [
                    'Encrypts data using symmetric keys.',
                    'Issues and verifies digital certificates.',
                    'Stores private keys securely.',
                    'Performs hashing of data.'
                ],
                'correct_options' => ['Issues and verifies digital certificates.'],
                'justifications' => [
                    'Incorrect - Certificate Authorities do not encrypt data using symmetric keys; they manage digital certificates and use asymmetric cryptography for signing certificates',
                    'Correct - The primary role of a Certificate Authority is to issue digital certificates that bind public keys to identities and verify the authenticity of these certificates through digital signatures',
                    'Incorrect - CAs do not store private keys securely for others; private keys must remain under the control of their owners. CAs only use their own private keys for signing certificates',
                    'Incorrect - While CAs may use hashing as part of the certificate signing process, their primary role is certificate issuance and verification, not general data hashing'
                ],
                'bloom_level' => 2,
                'difficulty_level' => 2,
                'irt_a' => 1.1,
                'irt_b' => -0.4,
                'irt_c' => 0.25,
                'status' => 'published'

            ],
            
            // Item 22 - L3 - Apply
            [
                'topic' => 'Digital Signatures & PKI',
                'subtopic' => 'Public Key Infrastructure (PKI)',
                'question' => 'How should you apply CRL checking in a high-availability e-commerce application that experiences significant latency when accessing the CA\'s CRL distribution points?',
                'options' => [
                    'Disable CRL checking to improve performance',
                    'Implement local CRL caching with periodic updates and configure appropriate fail-over mechanisms',
                    'Only check CRLs during maintenance windows',
                    'Accept any certificate regardless of revocation status'
                ],
                'correct_options' => ['Implement local CRL caching with periodic updates and configure appropriate fail-over mechanisms'],
                'justifications' => [
                    'Incorrect - This option does not accurately describe the concept',
                    'Correct - Implement local CRL caching with periodic updates and configure appropriate fail-over mechanisms',
                    'Incorrect - This is too absolute or limiting',
                    'Incorrect - This option does not accurately describe the concept',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.4,
                'irt_b' => 0.2,
                'irt_c' => 0.25,
                'status' => 'published',
                'type_id' => 1

            ],
            
            // Item 23 - L3 - Apply
            [
                'topic' => 'Digital Signatures & PKI',
                'subtopic' => 'Public Key Cryptography',
                'question' => 'In public-key cryptography, which key is used to encrypt a message intended for a specific recipient?',
                'type_id' => 1,
                'options' => [
                    'The recipient\'s public key',
                    'The recipient\'s private key',
                    'The sender\'s public key',
                    'The sender\'s private key'
                ],
                'correct_options' => ['The recipient\'s public key'],
                'justifications' => [
                    'Correct - To ensure confidentiality, a message is encrypted using the recipient\'s public key, which means only the recipient can decrypt it using their corresponding private key',
                    'Incorrect - The recipient\'s private key is used for decryption, not encryption, and should never be shared or used by others',
                    'Incorrect - The sender\'s public key would allow anyone to decrypt the message, defeating the purpose of confidentiality',
                    'Incorrect - The sender\'s private key is used for digital signatures (authentication), not for encryption intended for a specific recipient'
                ],
                'bloom_level' => 3,
                'difficulty_level' => 2,
                'irt_a' => 1.2,
                'irt_b' => -0.3,
                'irt_c' => 0.25,
                'status' => 'published'

            ],
            
            // Item 24 - L2 - Understand
            [
                'topic' => 'Digital Signatures & PKI',
                'subtopic' => 'Digital Signatures',
                'question' => 'Which of the following statements is true regarding digital signatures?',
                'options' => [
                    'Digital signatures are issued once per user, to be used on all documents until they expire.',
                    'A digital signature is a plain hash of the document contents.',
                    'Digital signatures are issued per file type, allowing each to be used on multiple files until they expire.',
                    'A digital signature cannot be moved from one document to another.'
                ],
                'correct_options' => ['A digital signature cannot be moved from one document to another.'],
                'justifications' => [
                    'Incorrect - Digital signatures are created uniquely for each document using the signer\'s private key; they are not issued once for reuse across multiple documents',
                    'Incorrect - A digital signature is created by encrypting the document\'s hash with the signer\'s private key, not just a plain hash',
                    'Incorrect - Digital signatures are document-specific, not file-type-specific; each signature is mathematically bound to a specific document\'s content',
                    'Correct - Digital signatures are cryptographically bound to specific document content; moving a signature to a different document would fail verification because the hash would not match, ensuring document integrity and preventing signature reuse'
                ],
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'irt_a' => 1.3,
                'irt_b' => -0.2,
                'irt_c' => 0.25,
                'status' => 'published',
                'type_id' => 1

            ],
            
            // Item 25 - L2 - Understand
            [
                'topic' => 'Digital Signatures & PKI',
                'subtopic' => 'Non-repudiation',
                'question' => 'What does the term "non-repudiation" mean in the context of cryptography?',
                'type_id' => 1,
                'options' => [
                    'Ensuring data can be neither encrypted nor decrypted.',
                    'Guaranteeing the sender cannot deny having sent a message.',
                    'Preventing unauthorized users from accessing data.',
                    'Ensuring data is not modified during transmission.'
                ],
                'correct_options' => ['Guaranteeing the sender cannot deny having sent a message.'],
                'justifications' => [
                    'Incorrect - Non-repudiation does not prevent encryption or decryption; it is about proving the origin of a message or transaction',
                    'Correct - Non-repudiation ensures that a sender cannot falsely deny having sent a message or performed an action, typically achieved through digital signatures',
                    'Incorrect - Preventing unauthorized access is confidentiality, not non-repudiation; non-repudiation is about proving who performed an action',
                    'Incorrect - Ensuring data is not modified during transmission is integrity, not non-repudiation; non-repudiation proves the origin of the data'
                ],
                'bloom_level' => 2,
                'difficulty_level' => 2,
                'irt_a' => 1.3,
                'irt_b' => -0.1,
                'irt_c' => 0.25,
                'status' => 'published'

            ],
            
            // Item 26 - L3 - Apply
            [
                'topic' => 'Digital Signatures & PKI',
                'subtopic' => 'Asymmetric Encryption',
                'question' => 'An organization wants to future-proof its data against quantum threats. Which combination is MOST appropriate?',
                'options' => [
                    'Switch from AES to DES',
                    'Transition from RSA to lattice-based encryption',
                    'Use dual-key RSA schemes',
                    'Increase ECC key size'
                ],
                'correct_options' => ['Transition from RSA to lattice-based encryption'],
                'justifications' => [
                    'Incorrect - DES is much weaker than AES and provides worse security against both classical and quantum computers. This would be a significant downgrade in security rather than future-proofing against quantum threats.',
                    'Correct - Lattice-based encryption is one of the leading post-quantum cryptographic approaches that is believed to be secure against both classical and quantum computers. Transitioning from RSA (which is vulnerable to Shor\'s algorithm) to lattice-based schemes provides genuine quantum resistance.',
                    'Incorrect - Dual-key RSA schemes do not provide quantum resistance. RSA\'s underlying mathematical problem (integer factorization) remains vulnerable to Shor\'s algorithm regardless of how the keys are structured or used.',
                    'Incorrect - While increasing ECC key sizes improves security against classical attacks, ECC is still vulnerable to Shor\'s algorithm on quantum computers. No amount of key size increase can protect ECC against quantum attacks.'
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.6,
                'irt_b' => 0.5,
                'irt_c' => 0.25,
                'status' => 'published',
                'type_id' => 1

            ],
            
            // Item 27 - L2 - Understand
            [
                'topic' => 'Digital Signatures & PKI',
                'subtopic' => 'Hash Functions',
                'question' => 'What is the primary vulnerability associated with using MD5 as a cryptographic hash function?',
                'type_id' => 1,
                'options' => [
                    'Slow hashing speed',
                    'Large output size',
                    'Susceptibility to collision attacks',
                    'High computational resource requirements'
                ],
                'correct_options' => ['Susceptibility to collision attacks'],
                'justifications' => [
                    'Incorrect - MD5 is actually quite fast, which can be both an advantage and disadvantage; speed is not its primary vulnerability',
                    'Incorrect - MD5 produces a relatively small 128-bit output, not a large one; this smaller size contributes to its vulnerabilities',
                    'Correct - MD5\'s primary vulnerability is its susceptibility to collision attacks, where attackers can find two different inputs that produce the same hash output, compromising integrity verification',
                    'Incorrect - MD5 has low computational requirements, making it fast but also making brute-force attacks more feasible'
                ],
                'bloom_level' => 2,
                'difficulty_level' => 2,
                'irt_a' => 1.3,
                'irt_b' => -0.2,
                'irt_c' => 0.25,
                'status' => 'published'

            ],
            
            // Item 28 - L4 - Analyze
            [
                'topic' => 'Digital Signatures & PKI',
                'subtopic' => 'Symmetric Encryption',
                'question' => 'Consider two cryptographic problems:\n\nProblem A: An attacker has access to a system\'s internal clock and can precisely measure the time it takes for the system to decrypt a ciphertext, noticing slight variations based on the decrypted data.\n\nProblem B: An attacker discovers a flaw in the padding scheme used by a block cipher, allowing them to determine if a message\'s padding is correct or incorrect, leading to full plaintext decryption.\n\nHow do Problem A and Problem B primarily differ in the nature of the cryptographic weakness they expose?',
                'options' => [
                    'Problem A is a hash collision; Problem B is a brute-force attack.',
                    'Problem A is a side-channel attack; Problem B is an implementation weakness related to padding.',
                    'Problem A is a quantum threat; Problem B is a dictionary attack.',
                    'Both problems involve breaking the mathematical algorithm directly.'
                ],
                'correct_options' => ['Problem A is a side-channel attack; Problem B is an implementation weakness related to padding.'],
                'justifications' => [
                    'Incorrect - Neither problem involves hash collisions or brute-force attacks. Problem A exploits timing information (side-channel), while Problem B exploits padding validation flaws.',
                    'Correct - Problem A describes a timing attack, which is a type of side-channel attack that exploits physical information leakage (timing variations) rather than breaking the cryptographic algorithm itself. Problem B describes a padding oracle attack, which exploits implementation weaknesses in how padding validation is handled, not the underlying cipher.',
                    'Incorrect - Problem A is not related to quantum computing threats, and Problem B is not a dictionary attack. These classifications do not match the described attack vectors.',
                    'Incorrect - Neither problem breaks the mathematical algorithm directly. Both exploit implementation details and physical characteristics rather than mathematical weaknesses in the cryptographic algorithms themselves.'
                ],
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'irt_a' => 1.8,
                'irt_b' => 0.7,
                'irt_c' => 0.20,
                'status' => 'published',
                'type_id' => 1

            ],
            
            // Item 29 - L3 - Apply
            [
                'topic' => 'Digital Signatures & PKI',
                'subtopic' => 'Hash Functions',
                'question' => 'Despite the IT security analyst\'s warning, all users on a Linux server were assigned the same weak password: P@55w0rD. Later, an attacker reviewing the /etc/shadow file observed the following hashed entries:\n\n```\nalice:$6$a1fG...\nbob:$6$h3Kx...\nchris:$6$Z9tW...\n```\n\nEach hash appears different, even though the password is identical. Which of the following BEST explains this behavior?',
                'options' => [
                    'Perfect forward secrecy',
                    'Key stretching',
                    'Salting',
                    'Hashing'
                ],
                'correct_options' => ['Salting'],
                'justifications' => [
                    'Incorrect - Perfect forward secrecy is a property of key exchange protocols that ensures session keys remain secure even if long-term keys are compromised. It does not relate to password hashing or why identical passwords would produce different hash values.',
                    'Incorrect - Key stretching involves making hash computation deliberately slow (using iterations) to resist brute-force attacks. While this may be happening alongside salting, it does not explain why identical passwords produce different hashes.',
                    'Correct - Salting adds a unique random value to each password before hashing. In the /etc/shadow format, the salt appears after the algorithm identifier ($6$ indicates SHA-512). Each user gets a different salt (a1fG, h3Kx, Z9tW), so identical passwords produce different hash values, preventing rainbow table attacks and making identical passwords less obvious.',
                    'Incorrect - While hashing is the general process being used, it does not explain why identical passwords produce different hash outputs. Without salting, identical passwords would produce identical hashes.'
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.5,
                'irt_b' => 0.2,
                'irt_c' => 0.25,
                'status' => 'published',
                'type_id' => 1

            ],
            
            // Item 30 - L3 - Apply
            [
                'topic' => 'Digital Signatures & PKI',
                'subtopic' => 'Hash Functions',
                'question' => 'Consider two password cracking techniques:\n\nTechnique X: Uses a precomputed list of common words and phrases, often derived from real-world data breaches, to guess passwords.\n\nTechnique Y: Employs a large database of precomputed hash values to quickly find a plaintext password corresponding to a given hash, bypassing the need to recompute hashes during the attack.\n\nHow do Technique X and Technique Y primarily differ in their approach and efficiency against hashed passwords?',
                'options' => [
                    'Technique X is a brute-force attack; Technique Y is a dictionary attack.',
                    'Technique X is a dictionary attack, targeting common passwords; Technique Y uses rainbow tables to speed up hash inversion.',
                    'Both techniques rely on guessing random combinations.',
                    'Technique X requires online access; Technique Y is an offline attack.'
                ],
                'correct_options' => ['Technique X is a dictionary attack, targeting common passwords; Technique Y uses rainbow tables to speed up hash inversion.'],
                'justifications' => [
                    'Incorrect - This reverses the attack types. Technique X describes dictionary attacks (using wordlists of common passwords), while Technique Y describes rainbow table attacks (precomputed hash lookups), not brute-force attacks.',
                    'Correct - Technique X is a dictionary attack that uses lists of common passwords and phrases to guess likely passwords, requiring hash computation for each guess. Technique Y describes rainbow tables, which precompute hash values to enable quick plaintext recovery without needing to compute hashes during the attack.',
                    'Incorrect - Neither technique relies on random combinations. Dictionary attacks use probable passwords from wordlists, while rainbow tables use precomputed hash-to-plaintext mappings. Both are systematic rather than random approaches.',
                    'Incorrect - Both techniques can be used in offline scenarios where the attacker has obtained password hashes. The online/offline distinction is not the primary difference between dictionary attacks and rainbow table attacks.'
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.6,
                'irt_b' => 0.4,
                'irt_c' => 0.25,
                'status' => 'published',
                'type_id' => 1

            ],
            
            // Topic 4: Key Management (10 questions)
            // Bloom Distribution: L1:2, L2:2, L3:3, L4:2, L5:1
            
            // Item 31 - L3 - Apply
            [
                'topic' => 'Key Management',
                'subtopic' => 'Key Management',
                'question' => 'Which practice is MOST effective in reducing the feasibility of brute-force attacks against encrypted data?',
                'options' => [
                    'Storing encryption keys in application code',
                    'Using short passwords but with salt',
                    'Increasing key length and enforcing rate-limiting',
                    'Encrypting data with outdated algorithms'
                ],
                'correct_options' => ['Increasing key length and enforcing rate-limiting'],
                'justifications' => [
                    'Incorrect - Storing encryption keys in application code is a severe security vulnerability that makes keys easily accessible to attackers. This actually facilitates attacks rather than preventing them, as keys can be extracted from the application binary or source code.',
                    'Incorrect - While salting helps prevent rainbow table attacks and should be used, short passwords remain vulnerable to brute-force attacks due to their limited keyspace. Salt does not significantly increase the computational effort required for brute-force attacks against the actual password.',
                    'Correct - Increasing key length exponentially increases the computational effort required for brute-force attacks (each additional bit doubles the keyspace). Rate-limiting restricts the number of attempts an attacker can make per unit time, making brute-force attacks impractical by extending the time required to try all possible keys.',
                    'Incorrect - Using outdated algorithms typically means using cryptographically weak or broken algorithms that may have known vulnerabilities or reduced key spaces. This makes systems more vulnerable to attacks, not less.'
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.5,
                'irt_b' => 0.3,
                'irt_c' => 0.25,
                'status' => 'published',
                'type_id' => 1

            ],
            
            // Item 32 - L2 - Understand
            [
                'topic' => 'Key Management',
                'subtopic' => 'Key Management',
                'question' => 'Why are RSA and ECC considered vulnerable in a post-quantum environment?',
                'options' => [
                    'Quantum computers can factor primes in constant time',
                    'Shor\'s algorithm efficiently solves the mathematical problems underlying them',
                    'Grover\'s algorithm renders them ineffective',
                    'Quantum computers bypass encryption entirely'
                ],
                'correct_options' => ['Shor\'s algorithm efficiently solves the mathematical problems underlying them'],
                'justifications' => [
                    'Incorrect - While quantum computers can efficiently factor large integers and solve discrete logarithms, they do not do so in constant time. The complexity is still polynomial, but much more efficient than classical algorithms.',
                    'Correct - Shor\'s algorithm, when run on a sufficiently large quantum computer, can efficiently solve the integer factorization problem (RSA\'s foundation) and the discrete logarithm problem (ECC\'s foundation). This makes both RSA and ECC cryptographically insecure against quantum attacks.',
                    'Incorrect - Grover\'s algorithm provides a quadratic speedup for searching unsorted databases, which affects symmetric key lengths (requiring them to be doubled) but does not directly break RSA or ECC. Shor\'s algorithm is the specific threat to these public-key systems.',
                    'Incorrect - Quantum computers do not bypass encryption entirely. They use specific quantum algorithms like Shor\'s to solve particular mathematical problems more efficiently than classical computers, but they still require computational effort and do not instantly break all encryption.'
                ],
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'irt_a' => 1.5,
                'irt_b' => 0.0,
                'irt_c' => 0.25,
                'status' => 'published',
                'type_id' => 1

            ],
            
            // Item 33 - L2 - Understand
            [
                'topic' => 'Key Management',
                'subtopic' => 'Key Management',
                'question' => 'What is the purpose of the Diffie-Hellman key exchange?',
                'type_id' => 1,
                'options' => [
                    'To encrypt messages directly.',
                    'To hash passwords securely.',
                    'To securely exchange cryptographic keys over a public channel.',
                    'To provide digital signatures for authentication.'
                ],
                'correct_options' => ['To securely exchange cryptographic keys over a public channel.'],
                'justifications' => [
                    'Incorrect - Diffie-Hellman is not used to encrypt messages directly; it is a key exchange protocol that establishes a shared secret for use with symmetric encryption algorithms',
                    'Incorrect - Diffie-Hellman is not used for password hashing; password hashing is typically done with specialized hash functions like bcrypt or Argon2',
                    'Correct - The purpose of Diffie-Hellman key exchange is to allow two parties to securely establish a shared cryptographic key over an insecure public channel without transmitting the key directly',
                    'Incorrect - Diffie-Hellman is not used for digital signatures; digital signature algorithms like DSA or RSA are used for authentication purposes'
                ],
                'bloom_level' => 2,
                'difficulty_level' => 2,
                'irt_a' => 1.2,
                'irt_b' => -0.3,
                'irt_c' => 0.25,
                'status' => 'published'

            ],
            
            // Item 34 - L2 - Understand
            [
                'topic' => 'Key Management',
                'subtopic' => 'Key Management',
                'question' => 'An organization has a policy that allows for the recovery of encrypted data even if the original encryption key is lost or unavailable. To achieve this, a copy of the encryption key is securely stored with a trusted third party or split among multiple custodians. What is this practice known as?',
                'options' => [
                    'Key Rotation.',
                    'Key Escrow.',
                    'Key Generation.',
                    'Key Destruction.'
                ],
                'correct_options' => ['Key Escrow.'],
                'justifications' => [
                    'Incorrect - Key Rotation refers to the practice of periodically replacing cryptographic keys with new ones to limit the exposure from potential key compromise. It does not involve storing backup copies for data recovery purposes.',
                    'Correct - Key Escrow is the practice of securely storing copies of encryption keys with trusted third parties or splitting them among multiple custodians to enable authorized data recovery when original keys are lost or unavailable. This ensures business continuity while maintaining security controls.',
                    'Incorrect - Key Generation is the process of creating new cryptographic keys using secure random number generation. It does not involve storing backup copies of existing keys for recovery purposes.',
                    'Incorrect - Key Destruction is the secure deletion of cryptographic keys when they are no longer needed. This is the opposite of key escrow, which preserves keys for potential future recovery needs.'
                ],
                'bloom_level' => 2,
                'difficulty_level' => 2,
                'irt_a' => 1.3,
                'irt_b' => -0.1,
                'irt_c' => 0.25,
                'status' => 'published',
                'type_id' => 1

            ],
            
            // Item 35 - L4 - Analyze
            [
                'topic' => 'Key Management',
                'subtopic' => 'Key Management',
                'question' => 'Consider two approaches to protecting cryptographic keys:\n\nApproach X: Keys are stored encrypted within a software file system, protected by a passphrase that a user must enter.\n\nApproach Y: Keys are generated and stored within a dedicated hardware device that is tamper-resistant and performs cryptographic operations internally, never exposing the key material.\n\nHow do Approach X and Approach Y primarily differ in their security posture and the level of protection offered against key extraction?',
                'options' => [
                    'Approach X is more secure due to passphrase protection; Approach Y is less secure.',
                    'Approach X is less secure due to software-based storage; Approach Y offers stronger protection against physical and logical key extraction due to hardware isolation.',
                    'Both approaches offer similar security, but Approach X is more performant.',
                    'Approach Y is only for symmetric keys; Approach X is for asymmetric keys.'
                ],
                'correct_options' => ['Approach X is less secure due to software-based storage; Approach Y offers stronger protection against physical and logical key extraction due to hardware isolation.'],
                'justifications' => [
                    'Incorrect - This reverses the security assessment. Software-based key storage with passphrase protection is vulnerable to various attacks including malware, memory dumps, and sophisticated extraction techniques, while hardware-based protection offers superior security.',
                    'Correct - Approach X (software-based) is vulnerable to malware, memory analysis, file system attacks, and side-channel attacks that can extract keys even when encrypted. Approach Y (hardware-based) provides superior protection through physical tamper-resistance, secure key generation, and isolation that prevents key material from ever being exposed outside the secure boundary.',
                    'Incorrect - The security levels are significantly different, with hardware-based protection offering much stronger security. Performance is not the primary differentiator, and software-based approaches are not necessarily more performant than modern hardware security modules.',
                    'Incorrect - Both approaches can protect both symmetric and asymmetric keys. The key type compatibility is not what differentiates these approaches; rather, it is the fundamental difference between software-based and hardware-based security architectures.'
                ],
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'irt_a' => 1.7,
                'irt_b' => 0.6,
                'irt_c' => 0.20,
                'status' => 'published',
                'type_id' => 1

            ],
            
            // Item 36 - L3 - Apply
            [
                'topic' => 'Key Management',
                'subtopic' => 'Key Management',
                'question' => 'Compare the primary use cases and security capabilities of a Trusted Platform Module (TPM) found in a typical laptop and a dedicated Hardware Security Module (HSM) used in a data center.',
                'options' => [
                    'TPM is for general-purpose encryption; HSM is for network firewalling.',
                    'TPM offers platform integrity and secure boot; HSM provides high-assurance, tamper-resistant storage and processing for critical keys like CA keys.',
                    'Both are designed for general user authentication, but HSMs are faster.',
                    'TPM is cloud-based; HSM is on-premises.'
                ],
                'correct_options' => ['TPM offers platform integrity and secure boot; HSM provides high-assurance, tamper-resistant storage and processing for critical keys like CA keys.'],
                'justifications' => [
                    'Incorrect - TPMs are not primarily for general-purpose encryption, and HSMs are not network firewalls. TPMs focus on platform security, while HSMs provide specialized cryptographic key management.',
                    'Correct - TPMs are designed for platform integrity, secure boot, device attestation, and protecting platform-specific keys in endpoints like laptops. HSMs provide enterprise-grade, tamper-resistant storage and processing for high-value cryptographic keys such as CA root keys, requiring higher security assurance levels.',
                    'Incorrect - While both can support authentication functions, their primary purposes differ significantly. TPMs focus on platform security, while HSMs specialize in protecting critical organizational keys. Performance is not the key differentiator.',
                    'Incorrect - This describes deployment models, not the fundamental differences in their security capabilities and use cases. Both can be deployed in various environments depending on the specific implementation.'
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.6,
                'irt_b' => 0.4,
                'irt_c' => 0.25,
                'status' => 'published',
                'type_id' => 1

            ],
            
            // Item 37 - L2 - Understand
            [
                'topic' => 'Key Management',
                'subtopic' => 'Key Management',
                'question' => 'A server needs to store and use highly sensitive cryptographic keys, such as those for a Certificate Authority (CA) or a root DNSSEC key, in a tamper-resistant environment. This device typically performs cryptographic operations internally and never exposes the private key outside its boundaries. What type of specialized hardware device is designed for this purpose?',
                'options' => [
                    'Trusted Platform Module (TPM).',
                    'Network Interface Card (NIC).',
                    'Hardware Security Module (HSM).',
                    'Graphics Processing Unit (GPU).'
                ],
                'correct_options' => ['Hardware Security Module (HSM).'],
                'justifications' => [
                    'Incorrect - While TPMs provide hardware-based security, they are designed for platform integrity, secure boot, and device attestation rather than high-assurance storage of critical keys like CA keys. TPMs are typically integrated into computers for local security functions.',
                    'Incorrect - A Network Interface Card (NIC) is a networking component that connects devices to networks. It has no cryptographic key storage or tamper-resistant capabilities and is not designed for security purposes.',
                    'Correct - A Hardware Security Module (HSM) is specifically designed for storing and using highly sensitive cryptographic keys in a tamper-resistant environment. HSMs perform cryptographic operations internally without exposing private keys, making them ideal for CA keys, root DNSSEC keys, and other critical cryptographic material.',
                    'Incorrect - A Graphics Processing Unit (GPU) is designed for parallel processing of graphics and computational tasks. While GPUs can accelerate some cryptographic operations, they do not provide secure key storage or tamper-resistant environments.'
                ],
                'bloom_level' => 2,
                'difficulty_level' => 2,
                'irt_a' => 1.4,
                'irt_b' => 0.1,
                'irt_c' => 0.25,
                'status' => 'published',
                'type_id' => 1

            ],
            
            // Item 38 - L3 - Apply
            [
                'topic' => 'Key Management',
                'subtopic' => 'Key Management',
                'question' => 'Consider two cryptographic key management scenarios:\n\nScenario A: A highly sensitive signing key is created and stored directly on a secure hardware device, then used exclusively by that device.\n\nScenario B: A shared symmetric encryption key needs to be securely sent from one server to another over an insecure network.\n\nWhich key lifecycle management phases are most distinctly highlighted by Scenario A and Scenario B, respectively, and what is the primary challenge for Scenario B?',
                'options' => [
                    'Scenario A: Distribution; Scenario B: Generation.',
                    'Scenario A: Generation and storage; Scenario B: Secure distribution.',
                    'Scenario A: Rotation; Scenario B: Destruction.',
                    'Both scenarios focus on key destruction.'
                ],
                'correct_options' => ['Scenario A: Generation and storage; Scenario B: Secure distribution.'],
                'justifications' => [
                    'Incorrect - This reverses the focus areas. Scenario A emphasizes secure generation and storage on hardware, while Scenario B is about distributing an existing key, not generating it.',
                    'Correct - Scenario A highlights secure key generation and storage phases by creating the signing key directly on secure hardware and keeping it there exclusively. Scenario B focuses on the secure distribution phase, specifically the challenge of safely transmitting a key over an insecure network without interception or tampering.',
                    'Incorrect - Neither scenario primarily addresses key rotation (periodic replacement) or destruction (secure deletion). Scenario A is about initial creation and storage, while Scenario B is about secure transmission.',
                    'Incorrect - Key destruction is not the primary focus of either scenario. The scenarios address different phases: secure generation/storage versus secure distribution of keys.'
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.5,
                'irt_b' => 0.3,
                'irt_c' => 0.25,
                'status' => 'published',
                'type_id' => 1

            ],
            
            // Item 39 - L2 - Understand
            [
                'topic' => 'Key Management',
                'subtopic' => 'Key Management',
                'question' => 'A company issues a new cryptographic key pair for its secure web server every year. This practice helps to limit the amount of data encrypted with a single key, reducing the potential impact if that key were ever compromised. Which aspect of key lifecycle management does this practice primarily demonstrate?',
                'options' => [
                    'Key Generation.',
                    'Key Distribution.',
                    'Key Rotation.',
                    'Key Destruction.'
                ],
                'correct_options' => ['Key Rotation.'],
                'justifications' => [
                    'Incorrect - Key Generation is the initial process of creating cryptographic keys. While new keys are generated during rotation, the practice described focuses on the systematic replacement of keys over time, not just the creation process.',
                    'Incorrect - Key Distribution involves securely sharing keys with authorized parties. The scenario describes replacing keys annually, not the process of distributing them to users or systems.',
                    'Correct - Key Rotation is the practice of systematically replacing cryptographic keys at regular intervals (in this case, annually) to limit exposure and reduce the impact of potential key compromise. This proactive replacement of keys is a fundamental security practice.',
                    'Incorrect - Key Destruction involves securely deleting old keys after they are no longer needed. While destruction may occur after rotation, the primary practice described is the scheduled replacement of keys, not their destruction.'
                ],
                'bloom_level' => 2,
                'difficulty_level' => 2,
                'irt_a' => 1.3,
                'irt_b' => 0.0,
                'irt_c' => 0.25,
                'status' => 'published',
                'type_id' => 1

            ],
            
            // Item 40 - L2 - Understand
            [
                'topic' => 'Digital Signatures & PKI',
                'subtopic' => 'Digital Signatures & PKI',
                'question' => 'In a hierarchical trust model, what is the role of a subordinate CA?',
                'options' => [
                    'Validate its own identity through blockchain',
                    'Issue certificates to end-entities on behalf of a Root CA',
                    'Revoke CRLs',
                    'Sign the Root CA\'s certificate'
                ],
                'correct_options' => ['Issue certificates to end-entities on behalf of a Root CA'],
                'justifications' => [
                    'Incorrect - Subordinate CAs do not use blockchain for identity validation. Their identity is validated through the certificate chain leading back to the trusted Root CA that issued their certificate.',
                    'Correct - In a hierarchical trust model, subordinate (intermediate) CAs act as delegated authorities that issue certificates to end-entities (users, servers, devices) on behalf of the Root CA. This distributes the certificate issuance workload while maintaining the chain of trust back to the root.',
                    'Incorrect - Subordinate CAs issue Certificate Revocation Lists (CRLs), they do not revoke them. CRLs are published and updated by the CA that issued the certificates, not revoked by other entities.',
                    'Incorrect - This reverses the trust relationship. The Root CA signs the subordinate CA\'s certificate to establish its authority, not the other way around. The subordinate CA derives its trust from being certified by the Root CA.'
                ],
                'bloom_level' => 2,
                'difficulty_level' => 2,
                'irt_a' => 1.4,
                'irt_b' => -0.1,
                'irt_c' => 0.25,
                'status' => 'published',
                'type_id' => 1

            ],
            
            // Topic 5: Cryptanalysis & Attacks (10 questions)
            // Bloom Distribution: L1:2, L2:2, L3:4, L4:2, L5:0
            
            // Item 41 - L2 - Understand
            [
                'topic' => 'Digital Signatures & PKI',
                'subtopic' => 'Digital Signatures & PKI',
                'question' => 'What BEST describes the purpose of the Subject Alternative Name (SAN) field in a digital certificate?',
                'options' => [
                    'It identifies the key size used in encryption',
                    'It allows multiple domain names to be protected by a single certificate',
                    'It provides a backup certificate authority',
                    'It revokes the certificate automatically after expiration'
                ],
                'correct_options' => ['It allows multiple domain names to be protected by a single certificate'],
                'justifications' => [
                    'Incorrect - The key size information is stored in the public key field of the certificate, not in the SAN field. SAN is specifically for identifying additional names/identities that the certificate should cover.',
                    'Correct - The Subject Alternative Name (SAN) field allows a single certificate to protect multiple domain names, IP addresses, email addresses, or other identifiers. This is essential for modern web applications that may serve content from multiple domains or subdomains.',
                    'Incorrect - SAN does not provide backup certificate authority functionality. The certificate authority information is specified in the Issuer field, and backup CAs would require separate certificates or cross-certification arrangements.',
                    'Incorrect - Certificate revocation is not handled by the SAN field. Revocation is managed through Certificate Revocation Lists (CRLs) or Online Certificate Status Protocol (OCSP), and expiration is handled by the validity dates in the certificate.'
                ],
                'bloom_level' => 2,
                'difficulty_level' => 2,
                'irt_a' => 1.3,
                'irt_b' => -0.2,
                'irt_c' => 0.25,
                'status' => 'published',
                'type_id' => 1

            ],
            
            // Item 42 - L2 - Understand
            [
                'topic' => 'Digital Signatures & PKI',
                'subtopic' => 'Digital Signatures & PKI',
                'question' => 'What is the primary function of a Certificate Authority (CA) in a PKI?',
                'options' => [
                    'Encrypt messages using private keys',
                    'Authenticate users based on their username and password',
                    'Issue and digitally sign digital certificates to establish trust',
                    'Generate symmetric session keys for secure communication'
                ],
                'correct_options' => ['Issue and digitally sign digital certificates to establish trust'],
                'justifications' => [
                    'Incorrect - CAs do not encrypt messages. Message encryption is performed by the communicating parties using their own keys. CAs are responsible for certificate management, not message encryption.',
                    'Incorrect - Username/password authentication is typically handled by authentication systems, not CAs. CAs deal with digital certificates and public key cryptography, not traditional credential-based authentication.',
                    'Correct - The primary function of a Certificate Authority is to issue digital certificates that bind public keys to identities, and then digitally sign these certificates with the CA\'s private key. This establishes a chain of trust, allowing others to verify the authenticity of public keys.',
                    'Incorrect - Session key generation is typically handled by the communicating endpoints during key exchange protocols (like TLS handshake). CAs provide the certificates used to establish trust, but do not generate session keys.'
                ],
                'bloom_level' => 2,
                'difficulty_level' => 2,
                'irt_a' => 1.2,
                'irt_b' => -0.3,
                'irt_c' => 0.25,
                'status' => 'published',
                'type_id' => 1

            ],
            
            // Item 43 - L3 - Apply
            [
                'topic' => 'Digital Signatures & PKI',
                'subtopic' => 'Digital Signatures & PKI',
                'question' => 'Consider two distinct PKI scenarios for identity management:\n\nScenario A: A highly centralized government agency wants to issue digital identities to all its employees, with strict control and a clear chain of authority back to a single, top-level issuer.\n\nScenario B: A global open-source community wants to allow its members to cryptographically sign their contributions and endorse each other\'s public keys, without any central authority.\n\nWhich trust models are most suitable for Scenario A and Scenario B, respectively?',
                'options' => [
                    'Scenario A: Web of Trust; Scenario B: Hierarchical.',
                    'Scenario A: Hierarchical; Scenario B: Web of Trust.',
                    'Scenario A: Bridge CA; Scenario B: Federated.',
                    'Scenario A: Federated; Scenario B: Bridge CA.'
                ],
                'correct_options' => ['Scenario A: Hierarchical; Scenario B: Web of Trust.'],
                'justifications' => [
                    'Incorrect - This reverses the appropriate trust models. A centralized government agency requires hierarchical control, while the decentralized community needs web of trust.',
                    'Correct - Scenario A (centralized government agency) requires a Hierarchical trust model with clear chain of authority from a single root CA down through intermediate CAs to end-entity certificates. Scenario B (decentralized open-source community) is perfect for a Web of Trust model where members can directly sign and endorse each other\'s keys without central authority.',
                    'Incorrect - Bridge CA is used to connect different PKI hierarchies, and Federated trust involves multiple organizations with established trust relationships. Neither fits these specific scenarios as well as hierarchical and web of trust.',
                    'Incorrect - Federated trust involves multiple organizations with formal trust agreements, while Bridge CA connects different PKI domains. These don\'t match the centralized government agency or decentralized community requirements.'
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.5,
                'irt_b' => 0.2,
                'irt_c' => 0.25,
                'status' => 'published',
                'type_id' => 1

            ],
            
            // Item 44 - L2 - Understand
            [
                'topic' => 'Digital Signatures & PKI',
                'subtopic' => 'Digital Signatures & PKI',
                'question' => 'In the commercial internet PKI, your web browser trusts a handful of root Certificate Authorities (CAs). When you visit an HTTPS website, its certificate is typically issued by an Intermediate CA, which in turn was certified by one of the trusted root CAs. What is this fundamental PKI trust structure called?',
                'options' => [
                    'Web of Trust.',
                    'Distributed Trust Model.',
                    'Hierarchical Trust Model.',
                    'Peer-to-Peer Trust.'
                ],
                'correct_options' => ['Hierarchical Trust Model.'],
                'justifications' => [
                    'Incorrect - Web of Trust is used in systems like PGP where individuals directly sign each other\'s keys creating a decentralized network of trust relationships, rather than relying on centralized authorities.',
                    'Incorrect - While PKI does distribute trust across multiple entities, this term doesn\'t specifically describe the tree-like structure where root CAs sit at the top and intermediate CAs form branches below them.',
                    'Correct - The Hierarchical Trust Model describes the tree-like structure where trusted root CAs are at the top of the hierarchy, intermediate CAs are in the middle (certified by roots), and end-entity certificates are at the bottom (issued by intermediates). Trust flows down from root to leaf through the certificate chain.',
                    'Incorrect - Peer-to-Peer Trust implies equal trust relationships between peers without central authorities, which is the opposite of the centralized CA hierarchy used in commercial internet PKI.'
                ],
                'bloom_level' => 2,
                'difficulty_level' => 2,
                'irt_a' => 1.4,
                'irt_b' => 0.0,
                'irt_c' => 0.25,
                'status' => 'published',
                'type_id' => 1

            ],
            
            // Item 45 - L2 - Understand
            [
                'topic' => 'Digital Signatures & PKI',
                'subtopic' => 'Digital Signatures & PKI',
                'question' => 'A client application needs to determine if a server\'s digital certificate is still valid or if it has been cancelled by the issuing Certificate Authority. The application downloads a large file from a specific URL that contains a timestamped list of all certificates that are no longer trustworthy. What is this file commonly known as?',
                'options' => [
                    'OCSP Responder.',
                    'Certificate Revocation List (CRL).',
                    'X.509 Certificate.',
                    'Public Key Infrastructure (PKI).'
                ],
                'correct_options' => ['Certificate Revocation List (CRL).'],
                'justifications' => [
                    'Incorrect - An OCSP Responder is a service that provides real-time certificate status responses, not a downloadable file. OCSP is used for querying individual certificate status rather than downloading comprehensive lists.',
                    'Correct - A Certificate Revocation List (CRL) is exactly what is described: a timestamped file that contains a list of all certificates that have been revoked (cancelled) by the Certificate Authority. Applications download this file from a specific URL to check certificate validity offline.',
                    'Incorrect - An X.509 Certificate is the actual digital certificate itself, not a list of revoked certificates. X.509 is the standard format for public key certificates.',
                    'Incorrect - Public Key Infrastructure (PKI) is the overall framework and set of policies, procedures, and technologies for managing digital certificates and public keys. It is not a specific file containing revoked certificates.'
                ],
                'bloom_level' => 2,
                'difficulty_level' => 2,
                'irt_a' => 1.3,
                'irt_b' => 0.0,
                'irt_c' => 0.25,
                'status' => 'published',
                'type_id' => 1

            ],
            
            // Item 46 - L2 - Understand
            [
                'topic' => 'Digital Signatures & PKI',
                'subtopic' => 'Digital Signatures & PKI',
                'question' => 'A security mechanism requires a client to query a server to check the validity status of a single digital certificate in real-time, often receiving a response of "good," "revoked," or "unknown." Which protocol performs this function?',
                'options' => [
                    'Certificate Revocation List (CRL)',
                    'Online Certificate Status Protocol (OCSP)',
                    'Lightweight Directory Access Protocol (LDAP)',
                    'Simple Network Management Protocol (SNMP)'
                ],
                'correct_options' => ['Online Certificate Status Protocol (OCSP)'],
                'justifications' => [
                    'Incorrect - CRL (Certificate Revocation List) is a static list of revoked certificates that must be downloaded and checked locally. It does not provide real-time queries for individual certificates and does not return "good/revoked/unknown" responses for single certificate lookups.',
                    'Correct - OCSP (Online Certificate Status Protocol) is specifically designed for real-time certificate status checking. Clients query an OCSP responder about a single certificate and receive responses of "good" (valid), "revoked" (certificate revoked), or "unknown" (responder doesn\'t know about the certificate).',
                    'Incorrect - LDAP (Lightweight Directory Access Protocol) is used for accessing and maintaining distributed directory information services. While it can store certificate information, it is not specifically designed for real-time certificate validity checking with standardized good/revoked/unknown responses.',
                    'Incorrect - SNMP (Simple Network Management Protocol) is used for collecting information from and configuring network devices. It has no relationship to digital certificate validation and does not provide certificate status checking functionality.'
                ],
                'bloom_level' => 2,
                'difficulty_level' => 2,
                'irt_a' => 1.4,
                'irt_b' => 0.1,
                'irt_c' => 0.25,
                'status' => 'published',
                'type_id' => 1

            ],
            
            // Item 47 - L2 - Understand  
            [
                'topic' => 'Digital Signatures & PKI',
                'subtopic' => 'Digital Signatures & PKI',
                'question' => 'A company\'s policy states that all sent email must be encrypted to protect the confidentiality of the message because the organization shares nonpublic information through email. In a public-key infrastructure implementation properly configured to provide confidentiality, email is:',
                'options' => [
                    'encrypted with the sender\'s private key and decrypted with the sender\'s public key.',
                    'encrypted with the recipient\'s private key and decrypted with the sender\'s private key.',
                    'encrypted with the sender\'s private key and decrypted with the recipient\'s public key.',
                    'encrypted with the recipient\'s public key and decrypted with the recipient\'s private key.'
                ],
                'correct_options' => ['encrypted with the recipient\'s public key and decrypted with the recipient\'s private key.'],
                'justifications' => [
                    'Incorrect - This describes digital signing, not encryption for confidentiality. Encrypting with private key and decrypting with public key provides authentication/non-repudiation, but anyone with the public key can decrypt it, defeating confidentiality.',
                    'Incorrect - This is impossible in PKI. You cannot encrypt with someone else\'s private key as you don\'t have access to it, and this combination doesn\'t provide confidentiality.',
                    'Incorrect - This is also impossible and illogical. The sender cannot encrypt with their private key for the recipient to decrypt with the recipient\'s public key - these keys are not mathematically related.',
                    'Correct - For confidentiality in PKI, you encrypt with the recipient\'s public key (which is publicly available) so that only the recipient can decrypt it with their corresponding private key (which only they possess). This ensures only the intended recipient can read the message.'
                ],
                'bloom_level' => 2,
                'difficulty_level' => 2,
                'irt_a' => 1.3,
                'irt_b' => -0.2,
                'irt_c' => 0.25,
                'status' => 'published',
                'type_id' => 1

            ],
            
            // Item 48 - L2 - Understand
            [
                'topic' => 'Digital Signatures & PKI',
                'subtopic' => 'Digital Signatures & PKI',
                'question' => 'What is the primary benefit of code signing in software distribution and execution?',
                'options' => [
                    'It compresses the code to reduce network transfer time',
                    'It prevents the execution of any software on untrusted devices',
                    'It assures recipients that the code has not been altered and confirms the identity of the publisher',
                    'It automatically scans code for malware before execution'
                ],
                'correct_options' => ['It assures recipients that the code has not been altered and confirms the identity of the publisher'],
                'justifications' => [
                    'Incorrect - Code signing does not provide compression functionality. Compression is handled by separate tools and protocols for reducing file sizes during network transfer.',
                    'Incorrect - Code signing does not prevent execution on untrusted devices. It provides verification but the system/user still decides whether to execute based on trust policies and signature validation.',
                    'Correct - Code signing provides two critical security benefits: integrity (ensuring the code has not been tampered with since signing) and authenticity (confirming the identity of the software publisher through digital certificates). This helps users and systems trust the software.',
                    'Incorrect - Code signing does not include malware scanning capabilities. It only verifies that the code has not been modified since the publisher signed it, but does not analyze the content for malicious behavior.'
                ],
                'bloom_level' => 2,
                'difficulty_level' => 2,
                'irt_a' => 1.4,
                'irt_b' => -0.1,
                'irt_c' => 0.25,
                'status' => 'published',
                'type_id' => 1

            ],
            
            // Item 49 - L2 - Understand
            [
                'topic' => 'Digital Signatures & PKI',
                'subtopic' => 'Hash Functions',
                'question' => 'Which of the following explains why an attacker cannot easily decrypt passwords using a rainbow table attack?',
                'options' => [
                    'Digital signatures',
                    'Salting',
                    'Hashing',
                    'Perfect forward secrecy'
                ],
                'correct_options' => ['Salting'],
                'justifications' => [
                    'Incorrect - Digital signatures provide authentication and non-repudiation but do not protect against rainbow table attacks on password hashes. They are used to verify the authenticity of data, not to prevent password cracking.',
                    'Correct - Salting adds a unique random value to each password before hashing, making rainbow tables (precomputed hash tables) ineffective. Each password requires a different rainbow table due to the unique salt, making the attack computationally infeasible.',
                    'Incorrect - While hashing is part of secure password storage, hashing alone without salting is vulnerable to rainbow table attacks. Rainbow tables contain precomputed hashes of common passwords, making unsalted hashes easily reversible.',
                    'Incorrect - Perfect forward secrecy is a property of key exchange protocols that ensures session keys remain secure even if long-term keys are compromised. It does not relate to password storage or rainbow table attacks.'
                ],
                'bloom_level' => 2,
                'difficulty_level' => 2,
                'irt_a' => 1.5,
                'irt_b' => 0.0,
                'irt_c' => 0.25,
                'status' => 'published',
                'type_id' => 1

            ],
            
            // Item 50 - L3 - Apply
            [
                'topic' => 'Digital Signatures & PKI',
                'subtopic' => 'Digital Signatures & PKI',
                'question' => 'Consider two situations involving digital certificates:\n\nSituation A: A server administrator receives an alert that a server certificate will expire in 30 days.\n\nSituation B: A private key for an employee\'s code signing certificate is accidentally exposed on a public code repository.\n\nWhat are the appropriate, and distinctly different, certificate lifecycle actions required for Situation A and Situation B, respectively?',
                'options' => [
                    'Situation A requires revocation, Situation B requires renewal.',
                    'Situation A requires renewal, Situation B requires revocation.',
                    'Both situations require immediate re-issuance of a new certificate.',
                    'Both situations require no action, as the certificates will expire naturally.'
                ],
                'correct_options' => ['Situation A requires renewal, Situation B requires revocation.'],
                'justifications' => [
                    'Incorrect - This reverses the appropriate actions. Expiring certificates need renewal, not revocation, while compromised private keys require immediate revocation.',
                    'Correct - Situation A involves normal certificate lifecycle management where an expiring certificate should be renewed before expiration to maintain service continuity. Situation B involves a security compromise where the private key exposure requires immediate revocation to prevent unauthorized use, followed by issuance of a new certificate with a new key pair.',
                    'Incorrect - While both situations may eventually need new certificates, the immediate actions are different. Situation A can be handled through standard renewal, while Situation B requires urgent revocation due to the security breach.',
                    'Incorrect - Both situations require immediate action. Allowing certificates to expire naturally would cause service disruption in Situation A, and failing to revoke in Situation B would leave the organization vulnerable to attacks using the compromised private key.'
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.6,
                'irt_b' => 0.4,
                'irt_c' => 0.25,
                'status' => 'published',
                'type_id' => 1

            ],
        ];
    }
}