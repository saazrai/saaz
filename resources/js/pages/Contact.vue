<template>
    <Head>
        <title>Contact Us | Saaz Academy</title>
        <meta name="description"
            content="Get in touch with Saaz Academy for support, inquiries about SecureStart™ assessments, or enterprise solutions." />
    </Head>

    <div :class="['min-h-screen transition-colors duration-300', isDark ? 'bg-gray-900' : 'bg-gray-50']">
        <!-- Hero Section -->
        <div :class="[
            'py-16 transition-colors duration-300',
            isDark 
                ? 'bg-gradient-to-br from-gray-800 via-gray-700 to-gray-800' 
                : 'bg-gradient-to-br from-blue-900 via-blue-800 to-blue-700'
        ]">
            <div class="max-w-6xl mx-auto px-6 text-center text-white">
                <h1 class="text-4xl md:text-5xl font-bold mb-6">Get in Touch</h1>
                <p class="text-xl text-blue-100 max-w-3xl mx-auto">
                    Have questions about SecureStart™ or need enterprise support? We're here to help.
                </p>
            </div>
        </div>

        <!-- Contact Options -->
        <div class="max-w-6xl mx-auto px-6 py-16">
            <div class="grid md:grid-cols-3 gap-8 mb-16">
                <!-- Email Support -->
                <div :class="[
                    'rounded-xl p-8 shadow-lg text-center hover:shadow-xl transition-shadow',
                    isDark ? 'bg-gray-800' : 'bg-white'
                ]">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3 :class="['text-xl font-semibold mb-2', isDark ? 'text-white' : 'text-gray-900']">Email Support</h3>
                    <p :class="['mb-4', isDark ? 'text-gray-300' : 'text-gray-600']">
                        For general inquiries and support
                    </p>
                    <a href="mailto:support@saazacademy.com" class="text-blue-600 hover:text-blue-700 font-medium">
                        support@saazacademy.com
                    </a>
                </div>

                <!-- Sales -->
                <div :class="[
                    'rounded-xl p-8 shadow-lg text-center hover:shadow-xl transition-shadow',
                    isDark ? 'bg-gray-800' : 'bg-white'
                ]">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3 :class="['text-xl font-semibold mb-2', isDark ? 'text-white' : 'text-gray-900']">Enterprise Sales</h3>
                    <p :class="['mb-4', isDark ? 'text-gray-300' : 'text-gray-600']">
                        For enterprise licensing and custom solutions
                    </p>
                    <a href="mailto:enterprise@saazacademy.com" class="text-blue-600 hover:text-blue-700 font-medium">
                        enterprise@saazacademy.com
                    </a>
                </div>

                <!-- Phone -->
                <div :class="[
                    'rounded-xl p-8 shadow-lg text-center hover:shadow-xl transition-shadow',
                    isDark ? 'bg-gray-800' : 'bg-white'
                ]">
                    <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                    </div>
                    <h3 :class="['text-xl font-semibold mb-2', isDark ? 'text-white' : 'text-gray-900']">Phone Support</h3>
                    <p :class="['mb-4', isDark ? 'text-gray-300' : 'text-gray-600']">
                        Monday - Friday, 9AM - 5PM EST
                    </p>
                    <a href="tel:+1-555-123-4567" class="text-blue-600 hover:text-blue-700 font-medium">
                        +1 (555) 123-4567
                    </a>
                </div>
            </div>

            <!-- Contact Form -->
            <div :class="[
                'max-w-3xl mx-auto rounded-xl p-8 shadow-lg',
                isDark ? 'bg-gray-800' : 'bg-white'
            ]">
                <h2 :class="['text-2xl font-bold mb-6 text-center', isDark ? 'text-white' : 'text-gray-900']">
                    Send Us a Message
                </h2>
                
                <form @submit.prevent="handleSubmit" class="space-y-6">
                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label :class="['block text-sm font-medium mb-2', isDark ? 'text-gray-200' : 'text-gray-700']">
                                First Name
                            </label>
                            <input
                                v-model="form.firstName"
                                type="text"
                                required
                                :class="[
                                    'w-full px-4 py-2 rounded-lg border focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors',
                                    isDark 
                                        ? 'bg-gray-700 border-gray-600 text-white placeholder-gray-400' 
                                        : 'bg-white border-gray-300 text-gray-900'
                                ]"
                                placeholder="John"
                            />
                        </div>
                        
                        <div>
                            <label :class="['block text-sm font-medium mb-2', isDark ? 'text-gray-200' : 'text-gray-700']">
                                Last Name
                            </label>
                            <input
                                v-model="form.lastName"
                                type="text"
                                required
                                :class="[
                                    'w-full px-4 py-2 rounded-lg border focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors',
                                    isDark 
                                        ? 'bg-gray-700 border-gray-600 text-white placeholder-gray-400' 
                                        : 'bg-white border-gray-300 text-gray-900'
                                ]"
                                placeholder="Doe"
                            />
                        </div>
                    </div>

                    <div>
                        <label :class="['block text-sm font-medium mb-2', isDark ? 'text-gray-200' : 'text-gray-700']">
                            Email Address
                        </label>
                        <input
                            v-model="form.email"
                            type="email"
                            required
                            :class="[
                                'w-full px-4 py-2 rounded-lg border focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors',
                                isDark 
                                    ? 'bg-gray-700 border-gray-600 text-white placeholder-gray-400' 
                                    : 'bg-white border-gray-300 text-gray-900'
                            ]"
                            placeholder="john.doe@company.com"
                        />
                    </div>

                    <div>
                        <label :class="['block text-sm font-medium mb-2', isDark ? 'text-gray-200' : 'text-gray-700']">
                            Company (Optional)
                        </label>
                        <input
                            v-model="form.company"
                            type="text"
                            :class="[
                                'w-full px-4 py-2 rounded-lg border focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors',
                                isDark 
                                    ? 'bg-gray-700 border-gray-600 text-white placeholder-gray-400' 
                                    : 'bg-white border-gray-300 text-gray-900'
                            ]"
                            placeholder="Acme Corporation"
                        />
                    </div>

                    <div>
                        <label :class="['block text-sm font-medium mb-2', isDark ? 'text-gray-200' : 'text-gray-700']">
                            Subject
                        </label>
                        <select
                            v-model="form.subject"
                            required
                            :class="[
                                'w-full px-4 py-2 rounded-lg border focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors',
                                isDark 
                                    ? 'bg-gray-700 border-gray-600 text-white' 
                                    : 'bg-white border-gray-300 text-gray-900'
                            ]"
                        >
                            <option value="">Select a subject</option>
                            <option value="general">General Inquiry</option>
                            <option value="support">Technical Support</option>
                            <option value="enterprise">Enterprise Solutions</option>
                            <option value="securestart">SecureStart™ Questions</option>
                            <option value="partnership">Partnership Opportunities</option>
                            <option value="other">Other</option>
                        </select>
                    </div>

                    <div>
                        <label :class="['block text-sm font-medium mb-2', isDark ? 'text-gray-200' : 'text-gray-700']">
                            Message
                        </label>
                        <textarea
                            v-model="form.message"
                            required
                            rows="5"
                            :class="[
                                'w-full px-4 py-2 rounded-lg border focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors resize-none',
                                isDark 
                                    ? 'bg-gray-700 border-gray-600 text-white placeholder-gray-400' 
                                    : 'bg-white border-gray-300 text-gray-900'
                            ]"
                            placeholder="Please provide details about your inquiry..."
                        ></textarea>
                    </div>

                    <div class="text-center">
                        <button
                            type="submit"
                            :disabled="isSubmitting"
                            :class="[
                                'px-8 py-3 rounded-lg font-semibold transition-colors disabled:opacity-50 disabled:cursor-not-allowed',
                                isDark 
                                    ? 'bg-blue-600 hover:bg-blue-700 text-white' 
                                    : 'bg-blue-600 hover:bg-blue-700 text-white'
                            ]"
                        >
                            {{ isSubmitting ? 'Sending...' : 'Send Message' }}
                        </button>
                    </div>
                </form>

                <!-- Success Message -->
                <div v-if="showSuccess" :class="[
                    'mt-6 p-4 rounded-lg text-center',
                    isDark ? 'bg-green-900 text-green-200' : 'bg-green-100 text-green-800'
                ]">
                    <p class="font-medium">Thank you for your message! We'll get back to you within 24 hours.</p>
                </div>
            </div>

            <!-- Office Locations -->
            <div class="mt-16">
                <h2 :class="['text-2xl font-bold text-center mb-8', isDark ? 'text-white' : 'text-gray-900']">
                    Our Offices
                </h2>
                <div class="grid md:grid-cols-2 gap-8">
                    <div :class="[
                        'rounded-xl p-8 shadow-lg',
                        isDark ? 'bg-gray-800' : 'bg-white'
                    ]">
                        <h3 :class="['text-xl font-semibold mb-4', isDark ? 'text-white' : 'text-gray-900']">
                            United States - Headquarters
                        </h3>
                        <address :class="['not-italic space-y-2', isDark ? 'text-gray-300' : 'text-gray-600']">
                            <p>123 Enterprise Avenue</p>
                            <p>Suite 400</p>
                            <p>New York, NY 10001</p>
                            <p class="pt-2">
                                <a href="tel:+1-555-123-4567" class="text-blue-600 hover:text-blue-700">
                                    +1 (555) 123-4567
                                </a>
                            </p>
                        </address>
                    </div>

                    <div :class="[
                        'rounded-xl p-8 shadow-lg',
                        isDark ? 'bg-gray-800' : 'bg-white'
                    ]">
                        <h3 :class="['text-xl font-semibold mb-4', isDark ? 'text-white' : 'text-gray-900']">
                            Europe - Regional Office
                        </h3>
                        <address :class="['not-italic space-y-2', isDark ? 'text-gray-300' : 'text-gray-600']">
                            <p>456 Business Park</p>
                            <p>Building B, Floor 3</p>
                            <p>London, UK EC2A 4BX</p>
                            <p class="pt-2">
                                <a href="tel:+44-20-1234-5678" class="text-blue-600 hover:text-blue-700">
                                    +44 20 1234 5678
                                </a>
                            </p>
                        </address>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { Head } from '@inertiajs/vue3';
import { ref, inject } from 'vue';
import AppLayout from '@/layouts/AppLayout.vue';

defineOptions({
    layout: AppLayout,
});

// Get dark mode state from parent
const isDark = inject('isDark', false);

// Form state
const form = ref({
    firstName: '',
    lastName: '',
    email: '',
    company: '',
    subject: '',
    message: ''
});

const isSubmitting = ref(false);
const showSuccess = ref(false);

// Handle form submission
const handleSubmit = async () => {
    isSubmitting.value = true;
    
    // Simulate API call
    setTimeout(() => {
        isSubmitting.value = false;
        showSuccess.value = true;
        
        // Reset form
        form.value = {
            firstName: '',
            lastName: '',
            email: '',
            company: '',
            subject: '',
            message: ''
        };
        
        // Hide success message after 5 seconds
        setTimeout(() => {
            showSuccess.value = false;
        }, 5000);
    }, 1500);
};
</script>