<template>
    <Head>
        <title>Terms of Service | Saaz Academy</title>
        <meta name="description"
            content="Saaz Academy's terms of service outline the rules and regulations for using our SecureStart™ platform and services." />
    </Head>

    <div :class="['min-h-screen transition-colors duration-300', isDark ? 'bg-gray-900' : 'bg-gray-50']">
        <!-- Hero Section -->
        <div :class="[
            'py-16 transition-colors duration-300',
            isDark 
                ? 'bg-linear-to-br from-gray-800 via-gray-700 to-gray-800' 
                : 'bg-linear-to-br from-blue-900 via-blue-800 to-blue-700'
        ]">
            <div class="max-w-4xl mx-auto px-6 text-center text-white">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">Terms of Service</h1>
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
                        Welcome to Saaz Academy. These Terms of Service ("Terms") govern your use of our SecureStart™ platform and related services (collectively, the "Services"). By accessing or using our Services, you agree to be bound by these Terms.
                    </p>
                    <p :class="['mb-4', isDark ? 'text-gray-300' : 'text-gray-700']">
                        Please read these Terms carefully before using our Services. If you do not agree to these Terms, you may not access or use our Services.
                    </p>
                </section>

                <!-- Definitions -->
                <section class="mb-8">
                    <h2 :class="['text-2xl font-bold mb-4', isDark ? 'text-white' : 'text-gray-900']">
                        1. Definitions
                    </h2>
                    <ul :class="['list-disc list-inside space-y-2', isDark ? 'text-gray-300' : 'text-gray-700']">
                        <li><strong>"Account"</strong> means a unique account created for you to access our Services</li>
                        <li><strong>"Assessment"</strong> means any diagnostic test, evaluation, or assessment provided through our platform</li>
                        <li><strong>"Content"</strong> means all materials, including text, images, videos, and assessment questions</li>
                        <li><strong>"User"</strong> means any individual who accesses or uses our Services</li>
                        <li><strong>"Organization"</strong> means a company or entity that purchases enterprise access to our Services</li>
                    </ul>
                </section>

                <!-- Account Registration -->
                <section class="mb-8">
                    <h2 :class="['text-2xl font-bold mb-4', isDark ? 'text-white' : 'text-gray-900']">
                        2. Account Registration
                    </h2>
                    <p :class="['mb-4', isDark ? 'text-gray-300' : 'text-gray-700']">
                        To use certain features of our Services, you must create an Account. When creating an Account, you agree to:
                    </p>
                    <ul :class="['list-disc list-inside space-y-2', isDark ? 'text-gray-300' : 'text-gray-700']">
                        <li>Provide accurate, current, and complete information</li>
                        <li>Maintain and update your information to keep it accurate</li>
                        <li>Maintain the security of your account credentials</li>
                        <li>Accept responsibility for all activities under your Account</li>
                        <li>Notify us immediately of any unauthorized access</li>
                    </ul>
                </section>

                <!-- Acceptable Use -->
                <section class="mb-8">
                    <h2 :class="['text-2xl font-bold mb-4', isDark ? 'text-white' : 'text-gray-900']">
                        3. Acceptable Use
                    </h2>
                    <p :class="['mb-4', isDark ? 'text-gray-300' : 'text-gray-700']">
                        You agree to use our Services only for lawful purposes and in accordance with these Terms. You agree not to:
                    </p>
                    <ul :class="['list-disc list-inside space-y-2', isDark ? 'text-gray-300' : 'text-gray-700']">
                        <li>Violate any applicable laws or regulations</li>
                        <li>Infringe upon intellectual property rights</li>
                        <li>Transmit harmful, offensive, or inappropriate content</li>
                        <li>Attempt to gain unauthorized access to our systems</li>
                        <li>Interfere with or disrupt the Services</li>
                        <li>Use automated systems to access the Services without permission</li>
                        <li>Share assessment content or answers with others</li>
                        <li>Misrepresent your identity or affiliation</li>
                    </ul>
                </section>

                <!-- Assessment Integrity -->
                <section class="mb-8">
                    <h2 :class="['text-2xl font-bold mb-4', isDark ? 'text-white' : 'text-gray-900']">
                        4. Assessment Integrity
                    </h2>
                    <p :class="['mb-4', isDark ? 'text-gray-300' : 'text-gray-700']">
                        To maintain the integrity and validity of our assessments, you agree to:
                    </p>
                    <ul :class="['list-disc list-inside space-y-2', isDark ? 'text-gray-300' : 'text-gray-700']">
                        <li>Complete assessments independently without unauthorized assistance</li>
                        <li>Not share, copy, or distribute assessment questions or answers</li>
                        <li>Not use any unauthorized tools or resources during assessments</li>
                        <li>Report any suspected violations of assessment integrity</li>
                    </ul>
                    <p :class="['mt-4', isDark ? 'text-gray-300' : 'text-gray-700']">
                        Violations of assessment integrity may result in invalidation of results and termination of your Account.
                    </p>
                </section>

                <!-- Intellectual Property -->
                <section class="mb-8">
                    <h2 :class="['text-2xl font-bold mb-4', isDark ? 'text-white' : 'text-gray-900']">
                        5. Intellectual Property Rights
                    </h2>
                    <p :class="['mb-4', isDark ? 'text-gray-300' : 'text-gray-700']">
                        All content, features, and functionality of our Services are owned by Saaz Academy and are protected by international copyright, trademark, and other intellectual property laws.
                    </p>
                    <p :class="['mb-4', isDark ? 'text-gray-300' : 'text-gray-700']">
                        You may not reproduce, distribute, modify, create derivative works of, publicly display, or publicly perform any content from our Services without our prior written permission.
                    </p>
                </section>

                <!-- Privacy -->
                <section class="mb-8">
                    <h2 :class="['text-2xl font-bold mb-4', isDark ? 'text-white' : 'text-gray-900']">
                        6. Privacy
                    </h2>
                    <p :class="['mb-4', isDark ? 'text-gray-300' : 'text-gray-700']">
                        Your use of our Services is subject to our <Link :href="route('privacy.policy')" class="text-blue-600 hover:text-blue-700 underline">Privacy Policy</Link>, which explains how we collect, use, and protect your personal information.
                    </p>
                </section>

                <!-- Payment Terms -->
                <section class="mb-8">
                    <h2 :class="['text-2xl font-bold mb-4', isDark ? 'text-white' : 'text-gray-900']">
                        7. Payment Terms
                    </h2>
                    <p :class="['mb-4', isDark ? 'text-gray-300' : 'text-gray-700']">
                        For paid Services:
                    </p>
                    <ul :class="['list-disc list-inside space-y-2', isDark ? 'text-gray-300' : 'text-gray-700']">
                        <li>All fees are due in advance unless otherwise specified</li>
                        <li>Fees are non-refundable except as required by law</li>
                        <li>We reserve the right to change pricing with notice</li>
                        <li>You are responsible for all applicable taxes</li>
                        <li>Late payments may result in service suspension</li>
                    </ul>
                </section>

                <!-- Disclaimers -->
                <section class="mb-8">
                    <h2 :class="['text-2xl font-bold mb-4', isDark ? 'text-white' : 'text-gray-900']">
                        8. Disclaimers
                    </h2>
                    <p :class="['mb-4 uppercase', isDark ? 'text-gray-300' : 'text-gray-700']">
                        THE SERVICES ARE PROVIDED "AS IS" AND "AS AVAILABLE" WITHOUT WARRANTIES OF ANY KIND, EITHER EXPRESS OR IMPLIED.
                    </p>
                    <p :class="['mb-4', isDark ? 'text-gray-300' : 'text-gray-700']">
                        We do not warrant that:
                    </p>
                    <ul :class="['list-disc list-inside space-y-2', isDark ? 'text-gray-300' : 'text-gray-700']">
                        <li>The Services will be uninterrupted or error-free</li>
                        <li>Defects will be corrected</li>
                        <li>The Services are free of viruses or harmful components</li>
                        <li>Results from the Services will meet your requirements</li>
                    </ul>
                </section>

                <!-- Limitation of Liability -->
                <section class="mb-8">
                    <h2 :class="['text-2xl font-bold mb-4', isDark ? 'text-white' : 'text-gray-900']">
                        9. Limitation of Liability
                    </h2>
                    <p :class="['mb-4 uppercase', isDark ? 'text-gray-300' : 'text-gray-700']">
                        TO THE MAXIMUM EXTENT PERMITTED BY LAW, SAAZ ACADEMY SHALL NOT BE LIABLE FOR ANY INDIRECT, INCIDENTAL, SPECIAL, CONSEQUENTIAL, OR PUNITIVE DAMAGES ARISING FROM YOUR USE OF THE SERVICES.
                    </p>
                    <p :class="['mb-4', isDark ? 'text-gray-300' : 'text-gray-700']">
                        Our total liability shall not exceed the amount paid by you for the Services in the twelve months preceding the claim.
                    </p>
                </section>

                <!-- Indemnification -->
                <section class="mb-8">
                    <h2 :class="['text-2xl font-bold mb-4', isDark ? 'text-white' : 'text-gray-900']">
                        10. Indemnification
                    </h2>
                    <p :class="['mb-4', isDark ? 'text-gray-300' : 'text-gray-700']">
                        You agree to indemnify and hold harmless Saaz Academy, its affiliates, and their respective officers, directors, employees, and agents from any claims, damages, losses, or expenses arising from:
                    </p>
                    <ul :class="['list-disc list-inside space-y-2', isDark ? 'text-gray-300' : 'text-gray-700']">
                        <li>Your violation of these Terms</li>
                        <li>Your violation of any rights of another party</li>
                        <li>Your use or misuse of the Services</li>
                    </ul>
                </section>

                <!-- Termination -->
                <section class="mb-8">
                    <h2 :class="['text-2xl font-bold mb-4', isDark ? 'text-white' : 'text-gray-900']">
                        11. Termination
                    </h2>
                    <p :class="['mb-4', isDark ? 'text-gray-300' : 'text-gray-700']">
                        We may terminate or suspend your Account and access to the Services immediately, without prior notice, for any reason, including:
                    </p>
                    <ul :class="['list-disc list-inside space-y-2', isDark ? 'text-gray-300' : 'text-gray-700']">
                        <li>Breach of these Terms</li>
                        <li>Violation of assessment integrity</li>
                        <li>Request by law enforcement</li>
                        <li>Extended periods of inactivity</li>
                        <li>Non-payment of fees</li>
                    </ul>
                </section>

                <!-- Governing Law -->
                <section class="mb-8">
                    <h2 :class="['text-2xl font-bold mb-4', isDark ? 'text-white' : 'text-gray-900']">
                        12. Governing Law
                    </h2>
                    <p :class="['mb-4', isDark ? 'text-gray-300' : 'text-gray-700']">
                        These Terms shall be governed by and construed in accordance with the laws of the State of New York, United States, without regard to its conflict of law provisions.
                    </p>
                </section>

                <!-- Changes to Terms -->
                <section class="mb-8">
                    <h2 :class="['text-2xl font-bold mb-4', isDark ? 'text-white' : 'text-gray-900']">
                        13. Changes to Terms
                    </h2>
                    <p :class="['mb-4', isDark ? 'text-gray-300' : 'text-gray-700']">
                        We reserve the right to modify these Terms at any time. We will notify you of any material changes by posting the new Terms on this page and updating the "Last updated" date.
                    </p>
                    <p :class="['mb-4', isDark ? 'text-gray-300' : 'text-gray-700']">
                        Your continued use of the Services after any changes constitutes acceptance of the new Terms.
                    </p>
                </section>

            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { onMounted } from 'vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { useTheme } from '@/composables/useTheme';

defineOptions({
    layout: AppLayout,
});

// Use the theme composable
const { isDark, initializeTheme } = useTheme();

// Initialize theme on mount
onMounted(async () => {
    await initializeTheme();
});

// Last updated date
const lastUpdated = new Date().toLocaleDateString('en-US', {
    year: 'numeric',
    month: 'long',
    day: 'numeric'
});
</script>