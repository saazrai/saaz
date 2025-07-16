<template>
    <Head>
        <title>Frequently Asked Questions | Saaz Academy</title>
        <meta
            name="description"
            content="Find answers to frequently asked questions about Saaz Academy's courses, access, support, and more."
        />
    </Head>

    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-blue-600 to-purple-600 text-white py-12 sm:py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-3xl sm:text-4xl md:text-5xl font-bold mb-4">
            Frequently Asked Questions
        </h1>
                <p class="text-lg sm:text-xl text-blue-100 max-w-3xl mx-auto">
                    Find answers to common questions about our courses, platform, and support
                </p>
            </div>
        </div>
    </div>

    <!-- FAQ Content -->
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-12">
        <!-- Quick Stats -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-8">
            <div class="bg-white rounded-lg p-4 border border-gray-200 text-center">
                <div class="text-2xl font-bold text-blue-600">{{ faqs.length }}</div>
                <div class="text-sm text-gray-600">Total Questions</div>
            </div>
            <div class="bg-white rounded-lg p-4 border border-gray-200 text-center">
                <div class="text-2xl font-bold text-green-600">{{ filteredFAQs.length }}</div>
                <div class="text-sm text-gray-600">{{ searchQuery || selectedCategory !== 'all' ? 'Filtered Results' : 'Available Now' }}</div>
            </div>
            <div class="bg-white rounded-lg p-4 border border-gray-200 text-center">
                <div class="text-2xl font-bold text-purple-600">{{ categories.length - 1 }}</div>
                <div class="text-sm text-gray-600">Categories</div>
            </div>
        </div>

        <!-- Search Bar -->
        <div class="mb-8">
            <div class="relative">
                <input
                    v-model="searchQuery"
                    type="text"
                    placeholder="Search frequently asked questions..."
                    class="w-full px-4 py-3 pl-10 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                >
                <svg class="absolute left-3 top-3.5 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m21 21-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
                <button
                    v-if="searchQuery"
                    @click="searchQuery = ''"
                    class="absolute right-3 top-3.5 h-5 w-5 text-gray-400 hover:text-gray-600 transition-colors duration-200"
                >
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Category Tabs -->
        <div class="mb-8">
            <div class="flex flex-wrap gap-2 sm:gap-4 items-center justify-between">
                <div class="flex flex-wrap gap-2 sm:gap-4">
                    <button
                        v-for="category in categories"
                        :key="category.id"
                        @click="selectedCategory = category.id"
                        :class="selectedCategory === category.id ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200'"
                        class="px-3 py-2 sm:px-4 sm:py-2 rounded-lg font-medium transition-colors duration-200 text-sm sm:text-base"
                    >
                        {{ category.name }}
                    </button>
                </div>
                <div class="flex gap-2 mt-2 sm:mt-0">
                    <button
                        @click="expandAll"
                        class="text-sm text-blue-600 hover:text-blue-800 font-medium transition-colors duration-200"
                    >
                        Expand All
                    </button>
                    <span class="text-gray-300">|</span>
                    <button
                        @click="collapseAll"
                        class="text-sm text-blue-600 hover:text-blue-800 font-medium transition-colors duration-200"
                    >
                        Collapse All
                    </button>
                </div>
            </div>
        </div>

        <!-- FAQ Items -->
        <div class="space-y-4">
            <div
                v-for="faq in filteredFAQs"
                :key="faq.id"
                class="bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden hover:shadow-md transition-shadow duration-200"
            >
                <button
                    @click="toggleFAQ(faq.id)"
                    @keydown="handleKeydown($event, faq.id)"
                    :aria-expanded="openFAQs.includes(faq.id)"
                    :aria-controls="`faq-answer-${faq.id}`"
                    class="w-full px-4 sm:px-6 py-4 sm:py-5 text-left focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-inset hover:bg-gray-50 transition-colors duration-200"
                >
                    <div class="flex items-center justify-between">
                        <h3 :id="`faq-question-${faq.id}`" class="text-base sm:text-lg font-semibold text-gray-900 pr-4">
                            {{ faq.question }}
                        </h3>
                        <svg
                            :class="openFAQs.includes(faq.id) ? 'rotate-180' : ''"
                            class="h-5 w-5 text-gray-500 transition-transform duration-300 flex-shrink-0"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>
                </button>
                <Transition
                    name="slide-down"
                    mode="out-in"
                >
                    <div
                        v-if="openFAQs.includes(faq.id)"
                        :id="`faq-answer-${faq.id}`"
                        role="region"
                        :aria-labelledby="`faq-question-${faq.id}`"
                        class="px-4 sm:px-6 pb-4 sm:pb-5 border-t border-gray-100"
                    >
                        <div class="text-gray-600 leading-relaxed pt-4" v-html="faq.answer"></div>
                    </div>
                </Transition>
            </div>
        </div>

        <!-- No Results -->
        <div v-if="filteredFAQs.length === 0" class="text-center py-12">
            <svg class="w-12 h-12 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <h3 class="text-lg font-medium text-gray-900 mb-2">No questions found</h3>
            <p class="text-gray-600">Try adjusting your search or category filter</p>
        </div>

        <!-- Contact Support -->
        <div class="mt-12 bg-blue-50 rounded-lg p-6 sm:p-8">
            <div class="text-center">
                <h2 class="text-xl sm:text-2xl font-bold text-gray-900 mb-4">
                    Can't find what you're looking for?
                </h2>
                <p class="text-gray-600 mb-6">
                    Our support team is here to help you with any questions about our courses or platform.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <Link
                        href="/support"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-6 rounded-lg transition-colors duration-200"
                    >
                        Contact Support
                    </Link>
                    <Link
                        href="/help"
                        class="bg-white hover:bg-gray-50 text-gray-900 font-medium py-3 px-6 rounded-lg border border-gray-300 transition-colors duration-200"
                    >
                        Browse Help Center
                    </Link>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import { Head, Link } from "@inertiajs/vue3";
import { ref, computed } from 'vue';
import AppLayout from '@/layouts/AppLayout.vue';

defineOptions({ layout: AppLayout });

// Reactive state
const searchQuery = ref('');
const selectedCategory = ref('all');
const openFAQs = ref([]);

// Categories
const categories = ref([
    { id: 'all', name: 'All' },
    { id: 'courses', name: 'Courses' },
    { id: 'account', name: 'Account' },
    { id: 'billing', name: 'Billing' },
    { id: 'technical', name: 'Technical' },
    { id: 'support', name: 'Support' }
]);

// FAQ data
const faqs = ref([
    {
        id: 1,
        question: "How do I enroll in a course?",
        answer: "To enroll in a course, simply browse our course catalog, click on the course you're interested in, and click the 'Enroll Now' button. You'll need to create an account or sign in if you haven't already.",
        category: 'courses'
    },
    {
        id: 2,
        question: "Are the courses self-paced or scheduled?",
        answer: "Most of our courses are self-paced, allowing you to learn at your own speed. However, some advanced courses may have scheduled live sessions or cohort-based learning. This information is clearly indicated on each course page.",
        category: 'courses'
    },
    {
        id: 3,
        question: "Do I get a certificate upon completion?",
        answer: "Yes! Upon successful completion of a course, you'll receive a certificate that you can download and share on your professional profiles like LinkedIn.",
        category: 'courses'
    },
    {
        id: 4,
        question: "Can I access courses on mobile devices?",
        answer: "Absolutely! Our platform is fully responsive and works seamlessly on desktop, tablet, and mobile devices. You can also download our mobile app for an optimized learning experience on the go.",
        category: 'technical'
    },
    {
        id: 5,
        question: "How do I reset my password?",
        answer: "To reset your password, click on the 'Forgot Password' link on the login page, enter your email address, and follow the instructions sent to your email.",
        category: 'account'
    },
    {
        id: 6,
        question: "Can I change my email address?",
        answer: "Yes, you can update your email address in your account settings. Go to your profile, click 'Edit Profile', update your email, and verify the new address.",
        category: 'account'
    },
    {
        id: 7,
        question: "What payment methods do you accept?",
        answer: "We accept all major credit cards (Visa, MasterCard, American Express), PayPal, and bank transfers. All payments are processed securely through our encrypted payment system.",
        category: 'billing'
    },
    {
        id: 8,
        question: "Is there a refund policy?",
        answer: "Yes, we offer a 30-day money-back guarantee. If you're not satisfied with your purchase, you can request a full refund within 30 days of purchase. Please see our <a href='/refund' class='text-blue-600 hover:underline'>refund policy</a> for more details.",
        category: 'billing'
    },
    {
        id: 9,
        question: "Can I access my courses offline?",
        answer: "While our courses are primarily online, many video lessons can be downloaded for offline viewing through our mobile app. However, interactive elements and quizzes require an internet connection.",
        category: 'technical'
    },
    {
        id: 10,
        question: "What if I'm having technical issues?",
        answer: "If you're experiencing technical difficulties, please try refreshing your browser, clearing your cache, or using a different browser. If issues persist, contact our technical support team through the <a href='/support' class='text-blue-600 hover:underline'>support page</a>.",
        category: 'technical'
    },
    {
        id: 11,
        question: "How long do I have access to a course?",
        answer: "Once you enroll in a course, you have lifetime access to the content. This includes any future updates or additional materials added to the course.",
        category: 'courses'
    },
    {
        id: 12,
        question: "Are there group discounts available?",
        answer: "Yes! We offer special pricing for teams and organizations. Contact our sales team through the <a href='/enterprise' class='text-blue-600 hover:underline'>enterprise page</a> to discuss volume discounts and custom learning solutions.",
        category: 'billing'
    },
    {
        id: 13,
        question: "Can I preview course content before purchasing?",
        answer: "Absolutely! Most courses offer free preview lessons so you can get a feel for the instructor's teaching style and course quality before making a purchase.",
        category: 'courses'
    },
    {
        id: 14,
        question: "Do you offer live support?",
        answer: "We provide support through multiple channels including email, live chat during business hours, and a comprehensive help center. Our average response time is under 2 hours during business days.",
        category: 'support'
    },
    {
        id: 15,
        question: "Can I switch between different subscription plans?",
        answer: "Yes, you can upgrade or downgrade your subscription plan at any time. Changes will be reflected in your next billing cycle, and we'll prorate any differences.",
        category: 'billing'
    },
    {
        id: 16,
        question: "Are there prerequisites for advanced courses?",
        answer: "Some advanced courses may have prerequisites, which are clearly listed on the course page. We also provide learning paths to help you progress from beginner to advanced levels.",
        category: 'courses'
    },
    {
        id: 17,
        question: "How do I track my learning progress?",
        answer: "Your dashboard provides a comprehensive overview of your learning progress, including completed lessons, quiz scores, and estimated completion times for each course.",
        category: 'account'
    },
    {
        id: 18,
        question: "What browsers are supported?",
        answer: "Our platform works best with the latest versions of Chrome, Firefox, Safari, and Edge. We recommend keeping your browser updated for the best experience.",
        category: 'technical'
    }
]);

// Computed properties
const filteredFAQs = computed(() => {
    let filtered = faqs.value;
    
    // Filter by category
    if (selectedCategory.value !== 'all') {
        filtered = filtered.filter(faq => faq.category === selectedCategory.value);
    }
    
    // Filter by search query
    if (searchQuery.value) {
        const query = searchQuery.value.toLowerCase();
        filtered = filtered.filter(faq => 
            faq.question.toLowerCase().includes(query) || 
            faq.answer.toLowerCase().includes(query)
        );
    }
    
    return filtered;
});

// Methods
const toggleFAQ = (faqId) => {
    const index = openFAQs.value.indexOf(faqId);
    if (index > -1) {
        openFAQs.value.splice(index, 1);
    } else {
        openFAQs.value.push(faqId);
    }
};

// Keyboard navigation
const handleKeydown = (event, faqId) => {
    if (event.key === 'Enter' || event.key === ' ') {
        event.preventDefault();
        toggleFAQ(faqId);
    }
};

// Expand/Collapse all FAQs
const expandAll = () => {
    openFAQs.value = filteredFAQs.value.map(faq => faq.id);
};

const collapseAll = () => {
    openFAQs.value = [];
};
</script>

<style scoped>
/* Smooth slide down animation for FAQ answers */
.slide-down-enter-active,
.slide-down-leave-active {
    transition: all 0.3s ease-in-out;
    overflow: hidden;
}

.slide-down-enter-from {
    opacity: 0;
    max-height: 0;
    transform: translateY(-10px);
}

.slide-down-leave-to {
    opacity: 0;
    max-height: 0;
    transform: translateY(-10px);
}

.slide-down-enter-to,
.slide-down-leave-from {
    opacity: 1;
    max-height: 500px;
    transform: translateY(0);
}

/* Custom scrollbar for better mobile experience */
::-webkit-scrollbar {
    width: 6px;
}

::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 3px;
}

::-webkit-scrollbar-thumb {
    background: #c1c1c1;
    border-radius: 3px;
}

::-webkit-scrollbar-thumb:hover {
    background: #a1a1a1;
}

/* Focus styles for better accessibility */
button:focus-visible {
    outline: 2px solid #3b82f6;
    outline-offset: 2px;
}

/* Enhanced mobile responsiveness */
@media (max-width: 640px) {
    .max-w-4xl {
        padding-left: 1rem;
        padding-right: 1rem;
    }
    
    /* Adjust category buttons for mobile */
    .flex-wrap button {
        min-width: fit-content;
        white-space: nowrap;
    }
}

/* Search input enhancements */
input[type="text"]:focus {
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}

/* Smooth hover effects */
.bg-white:hover {
    transform: translateY(-1px);
    transition: transform 0.2s ease-in-out;
}
</style>
