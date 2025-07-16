<template>
    <Head>
        <title>Cookie Policy | Saaz Academy</title>
        <meta name="description"
            content="Learn about how Saaz Academy uses cookies and similar tracking technologies on our SecureStart™ platform." />
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
                <h1 class="text-4xl md:text-5xl font-bold mb-4">Cookie Policy</h1>
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
                        This Cookie Policy explains how Saaz Academy ("we," "our," or "us") uses cookies and similar tracking technologies when you visit our SecureStart™ platform and related services. This policy provides information about what cookies are, what types we use, and how you can control them.
                    </p>
                </section>

                <!-- What Are Cookies -->
                <section class="mb-8">
                    <h2 :class="['text-2xl font-bold mb-4', isDark ? 'text-white' : 'text-gray-900']">
                        1. What Are Cookies?
                    </h2>
                    <p :class="['mb-4', isDark ? 'text-gray-300' : 'text-gray-700']">
                        Cookies are small text files that are stored on your device (computer, tablet, or mobile) when you visit a website. They help websites remember information about your visit, making your next visit easier and the site more useful to you.
                    </p>
                    <p :class="['mb-4', isDark ? 'text-gray-300' : 'text-gray-700']">
                        We also use similar technologies like web beacons, pixels, and local storage, which function similarly to cookies and are covered by this policy.
                    </p>
                </section>

                <!-- Types of Cookies -->
                <section class="mb-8">
                    <h2 :class="['text-2xl font-bold mb-4', isDark ? 'text-white' : 'text-gray-900']">
                        2. Types of Cookies We Use
                    </h2>
                    
                    <h3 :class="['text-xl font-semibold mb-3', isDark ? 'text-gray-100' : 'text-gray-800']">
                        2.1 Essential Cookies
                    </h3>
                    <p :class="['mb-4', isDark ? 'text-gray-300' : 'text-gray-700']">
                        These cookies are necessary for the website to function properly. They enable basic functions like page navigation, secure area access, and assessment functionality.
                    </p>
                    <div :class="[
                        'rounded-lg p-4 mb-6',
                        isDark ? 'bg-gray-700' : 'bg-gray-100'
                    ]">
                        <table class="w-full">
                            <thead>
                                <tr :class="isDark ? 'text-gray-200' : 'text-gray-800'">
                                    <th class="text-left font-semibold pb-2">Cookie Name</th>
                                    <th class="text-left font-semibold pb-2">Purpose</th>
                                    <th class="text-left font-semibold pb-2">Duration</th>
                                </tr>
                            </thead>
                            <tbody :class="isDark ? 'text-gray-300' : 'text-gray-700'">
                                <tr>
                                    <td class="py-1">session_id</td>
                                    <td class="py-1">Maintains user session</td>
                                    <td class="py-1">Session</td>
                                </tr>
                                <tr>
                                    <td class="py-1">csrf_token</td>
                                    <td class="py-1">Security token</td>
                                    <td class="py-1">Session</td>
                                </tr>
                                <tr>
                                    <td class="py-1">auth_token</td>
                                    <td class="py-1">Authentication</td>
                                    <td class="py-1">7 days</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <h3 :class="['text-xl font-semibold mb-3', isDark ? 'text-gray-100' : 'text-gray-800']">
                        2.2 Functional Cookies
                    </h3>
                    <p :class="['mb-4', isDark ? 'text-gray-300' : 'text-gray-700']">
                        These cookies enable enhanced functionality and personalization, such as remembering your preferences and settings.
                    </p>
                    <div :class="[
                        'rounded-lg p-4 mb-6',
                        isDark ? 'bg-gray-700' : 'bg-gray-100'
                    ]">
                        <table class="w-full">
                            <thead>
                                <tr :class="isDark ? 'text-gray-200' : 'text-gray-800'">
                                    <th class="text-left font-semibold pb-2">Cookie Name</th>
                                    <th class="text-left font-semibold pb-2">Purpose</th>
                                    <th class="text-left font-semibold pb-2">Duration</th>
                                </tr>
                            </thead>
                            <tbody :class="isDark ? 'text-gray-300' : 'text-gray-700'">
                                <tr>
                                    <td class="py-1">language_pref</td>
                                    <td class="py-1">Language preference</td>
                                    <td class="py-1">1 year</td>
                                </tr>
                                <tr>
                                    <td class="py-1">theme_mode</td>
                                    <td class="py-1">Dark/light mode</td>
                                    <td class="py-1">1 year</td>
                                </tr>
                                <tr>
                                    <td class="py-1">timezone</td>
                                    <td class="py-1">User timezone</td>
                                    <td class="py-1">1 year</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <h3 :class="['text-xl font-semibold mb-3', isDark ? 'text-gray-100' : 'text-gray-800']">
                        2.3 Analytics Cookies
                    </h3>
                    <p :class="['mb-4', isDark ? 'text-gray-300' : 'text-gray-700']">
                        These cookies help us understand how visitors interact with our platform by collecting and reporting information anonymously.
                    </p>
                    <div :class="[
                        'rounded-lg p-4 mb-6',
                        isDark ? 'bg-gray-700' : 'bg-gray-100'
                    ]">
                        <table class="w-full">
                            <thead>
                                <tr :class="isDark ? 'text-gray-200' : 'text-gray-800'">
                                    <th class="text-left font-semibold pb-2">Cookie Name</th>
                                    <th class="text-left font-semibold pb-2">Purpose</th>
                                    <th class="text-left font-semibold pb-2">Duration</th>
                                </tr>
                            </thead>
                            <tbody :class="isDark ? 'text-gray-300' : 'text-gray-700'">
                                <tr>
                                    <td class="py-1">_ga</td>
                                    <td class="py-1">Google Analytics</td>
                                    <td class="py-1">2 years</td>
                                </tr>
                                <tr>
                                    <td class="py-1">_gid</td>
                                    <td class="py-1">Google Analytics</td>
                                    <td class="py-1">24 hours</td>
                                </tr>
                                <tr>
                                    <td class="py-1">analytics_id</td>
                                    <td class="py-1">Internal analytics</td>
                                    <td class="py-1">1 year</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <h3 :class="['text-xl font-semibold mb-3', isDark ? 'text-gray-100' : 'text-gray-800']">
                        2.4 Performance Cookies
                    </h3>
                    <p :class="['mb-4', isDark ? 'text-gray-300' : 'text-gray-700']">
                        These cookies collect information about how you use our platform, helping us improve performance and user experience.
                    </p>
                </section>

                <!-- Third-Party Cookies -->
                <section class="mb-8">
                    <h2 :class="['text-2xl font-bold mb-4', isDark ? 'text-white' : 'text-gray-900']">
                        3. Third-Party Cookies
                    </h2>
                    <p :class="['mb-4', isDark ? 'text-gray-300' : 'text-gray-700']">
                        Some cookies are placed by third-party services that appear on our pages. We do not control these cookies, and you should refer to the third party's privacy policy for more information.
                    </p>
                    <p :class="['mb-4', isDark ? 'text-gray-300' : 'text-gray-700']">
                        Third parties we work with include:
                    </p>
                    <ul :class="['list-disc list-inside space-y-2', isDark ? 'text-gray-300' : 'text-gray-700']">
                        <li>Google Analytics - for website analytics</li>
                        <li>Stripe - for payment processing</li>
                        <li>Intercom - for customer support</li>
                        <li>CloudFlare - for security and performance</li>
                    </ul>
                </section>

                <!-- Cookie Management -->
                <section class="mb-8">
                    <h2 :class="['text-2xl font-bold mb-4', isDark ? 'text-white' : 'text-gray-900']">
                        4. How to Manage Cookies
                    </h2>
                    <p :class="['mb-4', isDark ? 'text-gray-300' : 'text-gray-700']">
                        You have several options for managing cookies:
                    </p>
                    
                    <h3 :class="['text-xl font-semibold mb-3', isDark ? 'text-gray-100' : 'text-gray-800']">
                        4.1 Cookie Consent Tool
                    </h3>
                    <p :class="['mb-4', isDark ? 'text-gray-300' : 'text-gray-700']">
                        When you first visit our platform, you'll see a cookie consent banner that allows you to accept or customize your cookie preferences.
                    </p>

                    <h3 :class="['text-xl font-semibold mb-3', isDark ? 'text-gray-100' : 'text-gray-800']">
                        4.2 Browser Settings
                    </h3>
                    <p :class="['mb-4', isDark ? 'text-gray-300' : 'text-gray-700']">
                        Most web browsers allow you to control cookies through their settings. You can:
                    </p>
                    <ul :class="['list-disc list-inside space-y-2 mb-4', isDark ? 'text-gray-300' : 'text-gray-700']">
                        <li>View what cookies are stored on your device</li>
                        <li>Delete some or all cookies</li>
                        <li>Block all cookies or specific types</li>
                        <li>Set preferences for specific websites</li>
                    </ul>

                    <p :class="['mb-4', isDark ? 'text-gray-300' : 'text-gray-700']">
                        Links to cookie management instructions for popular browsers:
                    </p>
                    <ul :class="['list-disc list-inside space-y-2', isDark ? 'text-gray-300' : 'text-gray-700']">
                        <li><a href="https://support.google.com/chrome/answer/95647" target="_blank" class="text-blue-600 hover:text-blue-700">Google Chrome</a></li>
                        <li><a href="https://support.mozilla.org/en-US/kb/cookies" target="_blank" class="text-blue-600 hover:text-blue-700">Mozilla Firefox</a></li>
                        <li><a href="https://support.apple.com/guide/safari/manage-cookies-and-website-data-sfri11471/mac" target="_blank" class="text-blue-600 hover:text-blue-700">Safari</a></li>
                        <li><a href="https://support.microsoft.com/en-us/microsoft-edge/delete-cookies-in-microsoft-edge-63947406-40ac-c3b8-57b9-2a946a29ae09" target="_blank" class="text-blue-600 hover:text-blue-700">Microsoft Edge</a></li>
                    </ul>
                </section>

                <!-- Impact of Disabling Cookies -->
                <section class="mb-8">
                    <h2 :class="['text-2xl font-bold mb-4', isDark ? 'text-white' : 'text-gray-900']">
                        5. Impact of Disabling Cookies
                    </h2>
                    <p :class="['mb-4', isDark ? 'text-gray-300' : 'text-gray-700']">
                        Please note that disabling certain cookies may impact your experience on our platform:
                    </p>
                    <ul :class="['list-disc list-inside space-y-2', isDark ? 'text-gray-300' : 'text-gray-700']">
                        <li><strong>Essential cookies:</strong> Disabling these may prevent you from accessing secure areas or taking assessments</li>
                        <li><strong>Functional cookies:</strong> You may need to reset preferences each visit</li>
                        <li><strong>Analytics cookies:</strong> We won't be able to improve our services based on usage patterns</li>
                        <li><strong>Performance cookies:</strong> The platform may load slower or function less efficiently</li>
                    </ul>
                </section>

                <!-- Do Not Track -->
                <section class="mb-8">
                    <h2 :class="['text-2xl font-bold mb-4', isDark ? 'text-white' : 'text-gray-900']">
                        6. Do Not Track Signals
                    </h2>
                    <p :class="['mb-4', isDark ? 'text-gray-300' : 'text-gray-700']">
                        Some browsers offer a "Do Not Track" (DNT) setting that signals websites not to track your online activity. Currently, our platform does not respond to DNT signals, but we respect your cookie preferences set through our consent tool or browser settings.
                    </p>
                </section>

                <!-- Updates to Policy -->
                <section class="mb-8">
                    <h2 :class="['text-2xl font-bold mb-4', isDark ? 'text-white' : 'text-gray-900']">
                        7. Updates to This Policy
                    </h2>
                    <p :class="['mb-4', isDark ? 'text-gray-300' : 'text-gray-700']">
                        We may update this Cookie Policy from time to time to reflect changes in our practices or for legal reasons. We will notify you of any material changes by updating the "Last updated" date and, where appropriate, through our cookie consent tool.
                    </p>
                </section>

                <!-- Contact Information -->
                <section>
                    <h2 :class="['text-2xl font-bold mb-4', isDark ? 'text-white' : 'text-gray-900']">
                        8. Contact Us
                    </h2>
                    <p :class="['mb-4', isDark ? 'text-gray-300' : 'text-gray-700']">
                        If you have questions about our use of cookies or this policy, please contact us:
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

                <!-- Cookie Settings Button -->
                <div class="mt-8 text-center">
                    <button
                        @click="openCookieSettings"
                        :class="[
                            'px-6 py-3 rounded-lg font-semibold transition-colors',
                            isDark 
                                ? 'bg-blue-600 hover:bg-blue-700 text-white' 
                                : 'bg-blue-600 hover:bg-blue-700 text-white'
                        ]"
                    >
                        Manage Cookie Preferences
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { Head } from '@inertiajs/vue3';
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

// Function to open cookie settings
const openCookieSettings = () => {
    // This would typically trigger the cookie consent modal
    // For now, we'll just emit an event or call a global method
    if (window.showCookieConsent) {
        window.showCookieConsent();
    } else {
        alert('Cookie preferences modal would open here');
    }
};
</script>