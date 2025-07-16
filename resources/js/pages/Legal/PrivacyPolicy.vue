<template>
    <Head>
        <title>Privacy Policy | Saaz Academy</title>
        <meta name="description"
            content="Saaz Academy's privacy policy outlines how we collect, use, and protect your personal information." />
    </Head>

    <div :class="['min-h-screen transition-colors duration-300', isDark ? 'bg-gray-900' : 'bg-gray-50']">
        <!-- Hero Section -->
        <div :class="[
            'py-16 transition-colors duration-300',
            isDark 
                ? 'bg-gradient-to-br from-gray-800 via-gray-700 to-gray-800' 
                : 'bg-gradient-to-br from-blue-900 via-blue-800 to-blue-700'
        ]">
            <div class="max-w-4xl mx-auto px-6 text-center text-white">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">Privacy Policy</h1>
                <p class="text-xl text-blue-100">
                    Last updated: {{ lastUpdated }}
                </p>
            </div>
        </div>

        <!-- Content -->
        <div class="max-w-4xl mx-auto px-6 py-12">
            <div :class="[
                'rounded-xl p-8 shadow-lg',
                isDark ? 'bg-gray-800' : 'bg-white'
            ]">
                <!-- Introduction -->
                <section class="mb-8">
                    <p :class="['text-lg mb-4', isDark ? 'text-gray-300' : 'text-gray-700']">
                        At Saaz Academy ("we," "our," or "us"), we are committed to protecting your privacy and ensuring the security of your personal information. This Privacy Policy explains how we collect, use, disclose, and safeguard your information when you use our SecureStart™ platform and related services.
                    </p>
                </section>

                <!-- Information We Collect -->
                <section class="mb-8">
                    <h2 :class="['text-2xl font-bold mb-4', isDark ? 'text-white' : 'text-gray-900']">
                        1. Information We Collect
                    </h2>
                    
                    <h3 :class="['text-xl font-semibold mb-3', isDark ? 'text-gray-100' : 'text-gray-800']">
                        1.1 Personal Information
                    </h3>
                    <ul :class="['list-disc list-inside mb-4 space-y-2', isDark ? 'text-gray-300' : 'text-gray-700']">
                        <li>Name and contact information (email address, phone number)</li>
                        <li>Account credentials (username, password)</li>
                        <li>Company/organization information</li>
                        <li>Job title and role</li>
                        <li>Billing and payment information</li>
                    </ul>

                    <h3 :class="['text-xl font-semibold mb-3', isDark ? 'text-gray-100' : 'text-gray-800']">
                        1.2 Assessment Data
                    </h3>
                    <ul :class="['list-disc list-inside mb-4 space-y-2', isDark ? 'text-gray-300' : 'text-gray-700']">
                        <li>Assessment responses and scores</li>
                        <li>Time spent on assessments</li>
                        <li>Progress and completion data</li>
                        <li>Performance analytics</li>
                    </ul>

                    <h3 :class="['text-xl font-semibold mb-3', isDark ? 'text-gray-100' : 'text-gray-800']">
                        1.3 Technical Information
                    </h3>
                    <ul :class="['list-disc list-inside mb-4 space-y-2', isDark ? 'text-gray-300' : 'text-gray-700']">
                        <li>IP address and location data</li>
                        <li>Browser type and version</li>
                        <li>Device information</li>
                        <li>Usage patterns and preferences</li>
                        <li>Cookies and similar tracking technologies</li>
                    </ul>
                </section>

                <!-- How We Use Your Information -->
                <section class="mb-8">
                    <h2 :class="['text-2xl font-bold mb-4', isDark ? 'text-white' : 'text-gray-900']">
                        2. How We Use Your Information
                    </h2>
                    <p :class="['mb-4', isDark ? 'text-gray-300' : 'text-gray-700']">
                        We use the collected information for the following purposes:
                    </p>
                    <ul :class="['list-disc list-inside space-y-2', isDark ? 'text-gray-300' : 'text-gray-700']">
                        <li>Providing and maintaining our services</li>
                        <li>Processing and managing your account</li>
                        <li>Delivering assessment results and analytics</li>
                        <li>Personalizing your experience</li>
                        <li>Communicating with you about services and updates</li>
                        <li>Processing payments and transactions</li>
                        <li>Improving our platform and developing new features</li>
                        <li>Ensuring security and preventing fraud</li>
                        <li>Complying with legal obligations</li>
                    </ul>
                </section>

                <!-- Data Sharing -->
                <section class="mb-8">
                    <h2 :class="['text-2xl font-bold mb-4', isDark ? 'text-white' : 'text-gray-900']">
                        3. How We Share Your Information
                    </h2>
                    <p :class="['mb-4', isDark ? 'text-gray-300' : 'text-gray-700']">
                        We do not sell your personal information. We may share your information in the following circumstances:
                    </p>
                    
                    <h3 :class="['text-xl font-semibold mb-3', isDark ? 'text-gray-100' : 'text-gray-800']">
                        3.1 With Your Organization
                    </h3>
                    <p :class="['mb-4', isDark ? 'text-gray-300' : 'text-gray-700']">
                        If you access our services through an enterprise account, we may share your assessment data and results with designated administrators within your organization.
                    </p>

                    <h3 :class="['text-xl font-semibold mb-3', isDark ? 'text-gray-100' : 'text-gray-800']">
                        3.2 Service Providers
                    </h3>
                    <p :class="['mb-4', isDark ? 'text-gray-300' : 'text-gray-700']">
                        We may share information with trusted third-party service providers who assist us in operating our platform, such as hosting providers, payment processors, and analytics services.
                    </p>

                    <h3 :class="['text-xl font-semibold mb-3', isDark ? 'text-gray-100' : 'text-gray-800']">
                        3.3 Legal Requirements
                    </h3>
                    <p :class="['mb-4', isDark ? 'text-gray-300' : 'text-gray-700']">
                        We may disclose information when required by law, court order, or other legal processes, or to protect our rights, property, or safety.
                    </p>
                </section>

                <!-- Data Security -->
                <section class="mb-8">
                    <h2 :class="['text-2xl font-bold mb-4', isDark ? 'text-white' : 'text-gray-900']">
                        4. Data Security
                    </h2>
                    <p :class="['mb-4', isDark ? 'text-gray-300' : 'text-gray-700']">
                        We implement appropriate technical and organizational measures to protect your personal information, including:
                    </p>
                    <ul :class="['list-disc list-inside space-y-2', isDark ? 'text-gray-300' : 'text-gray-700']">
                        <li>Encryption of data in transit and at rest</li>
                        <li>Regular security assessments and audits</li>
                        <li>Access controls and authentication measures</li>
                        <li>Employee training on data protection</li>
                        <li>Incident response procedures</li>
                    </ul>
                </section>

                <!-- Data Retention -->
                <section class="mb-8">
                    <h2 :class="['text-2xl font-bold mb-4', isDark ? 'text-white' : 'text-gray-900']">
                        5. Data Retention
                    </h2>
                    <p :class="['mb-4', isDark ? 'text-gray-300' : 'text-gray-700']">
                        We retain your personal information for as long as necessary to provide our services and comply with legal obligations. Assessment data is typically retained for the duration of your account and a reasonable period thereafter for analytics and reporting purposes.
                    </p>
                </section>

                <!-- Your Rights -->
                <section class="mb-8">
                    <h2 :class="['text-2xl font-bold mb-4', isDark ? 'text-white' : 'text-gray-900']">
                        6. Your Rights
                    </h2>
                    <p :class="['mb-4', isDark ? 'text-gray-300' : 'text-gray-700']">
                        Depending on your location, you may have the following rights regarding your personal information:
                    </p>
                    <ul :class="['list-disc list-inside space-y-2', isDark ? 'text-gray-300' : 'text-gray-700']">
                        <li>Access and receive a copy of your data</li>
                        <li>Correct or update inaccurate information</li>
                        <li>Delete your personal information</li>
                        <li>Object to or restrict processing</li>
                        <li>Data portability</li>
                        <li>Withdraw consent</li>
                    </ul>
                    <p :class="['mt-4', isDark ? 'text-gray-300' : 'text-gray-700']">
                        To exercise these rights, please contact us at privacy@saazacademy.com.
                    </p>
                </section>

                <!-- Cookies -->
                <section class="mb-8">
                    <h2 :class="['text-2xl font-bold mb-4', isDark ? 'text-white' : 'text-gray-900']">
                        7. Cookies and Tracking Technologies
                    </h2>
                    <p :class="['mb-4', isDark ? 'text-gray-300' : 'text-gray-700']">
                        We use cookies and similar tracking technologies to improve your experience on our platform. You can manage your cookie preferences through your browser settings or our cookie consent tool. For more information, please see our <Link :href="route('legal.cookie-policy')" class="text-blue-600 hover:text-blue-700 underline">Cookie Policy</Link>.
                    </p>
                </section>

                <!-- International Data Transfers -->
                <section class="mb-8">
                    <h2 :class="['text-2xl font-bold mb-4', isDark ? 'text-white' : 'text-gray-900']">
                        8. International Data Transfers
                    </h2>
                    <p :class="['mb-4', isDark ? 'text-gray-300' : 'text-gray-700']">
                        Your information may be transferred to and processed in countries other than your own. We ensure appropriate safeguards are in place for such transfers in compliance with applicable data protection laws.
                    </p>
                </section>

                <!-- Children's Privacy -->
                <section class="mb-8">
                    <h2 :class="['text-2xl font-bold mb-4', isDark ? 'text-white' : 'text-gray-900']">
                        9. Children's Privacy
                    </h2>
                    <p :class="['mb-4', isDark ? 'text-gray-300' : 'text-gray-700']">
                        Our services are not intended for individuals under the age of 16. We do not knowingly collect personal information from children under 16. If we become aware of such collection, we will take steps to delete the information.
                    </p>
                </section>

                <!-- Updates to Privacy Policy -->
                <section class="mb-8">
                    <h2 :class="['text-2xl font-bold mb-4', isDark ? 'text-white' : 'text-gray-900']">
                        10. Updates to This Privacy Policy
                    </h2>
                    <p :class="['mb-4', isDark ? 'text-gray-300' : 'text-gray-700']">
                        We may update this Privacy Policy from time to time. We will notify you of any material changes by posting the new Privacy Policy on this page and updating the "Last updated" date.
                    </p>
                </section>

                <!-- Contact Information -->
                <section>
                    <h2 :class="['text-2xl font-bold mb-4', isDark ? 'text-white' : 'text-gray-900']">
                        11. Contact Us
                    </h2>
                    <p :class="['mb-4', isDark ? 'text-gray-300' : 'text-gray-700']">
                        If you have any questions about this Privacy Policy or our data practices, please contact us at:
                    </p>
                    <div :class="[
                        'rounded-lg p-6',
                        isDark ? 'bg-gray-700' : 'bg-gray-100'
                    ]">
                        <p :class="['font-semibold mb-2', isDark ? 'text-white' : 'text-gray-900']">
                            Saaz Academy Privacy Team
                        </p>
                        <p :class="isDark ? 'text-gray-300' : 'text-gray-700'">
                            Email: <a href="mailto:privacy@saazacademy.com" class="text-blue-600 hover:text-blue-700">privacy@saazacademy.com</a><br>
                            Address: 123 Enterprise Avenue, Suite 400<br>
                            New York, NY 10001<br>
                            United States
                        </p>
                    </div>
                </section>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { inject } from 'vue';
import AppLayout from '@/layouts/AppLayout.vue';

defineOptions({
    layout: AppLayout,
});

// Get dark mode state from parent
const isDark = inject('isDark', false);

// Last updated date
const lastUpdated = new Date().toLocaleDateString('en-US', {
    year: 'numeric',
    month: 'long',
    day: 'numeric'
});
</script>