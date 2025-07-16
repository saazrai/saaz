<template>
    <Head>
        <title>Help Center | Saaz Academy</title>
        <meta name="description"
            content="Find help and support for Saaz Academy's SecureStart™ platform, including guides, tutorials, and resources." />
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
                <h1 class="text-4xl md:text-5xl font-bold mb-6">Help Center</h1>
                <p class="text-xl text-blue-100 max-w-3xl mx-auto mb-8">
                    Everything you need to get the most out of SecureStart™
                </p>
                
                <!-- Search Bar -->
                <div class="max-w-2xl mx-auto">
                    <div class="relative">
                        <input
                            v-model="searchQuery"
                            type="text"
                            placeholder="Search for help articles..."
                            :class="[
                                'w-full px-6 py-4 pl-12 rounded-lg text-gray-900 placeholder-gray-500 focus:ring-4 focus:ring-blue-300 focus:outline-none transition-all',
                                isDark ? 'bg-gray-700 text-white placeholder-gray-400' : 'bg-white'
                            ]"
                        />
                        <svg class="absolute left-4 top-4 h-6 w-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m21 21-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Links -->
        <div class="max-w-6xl mx-auto px-6 py-12">
            <div class="grid md:grid-cols-3 gap-6">
                <a :href="'#getting-started'" :class="[
                    'rounded-xl p-6 shadow-lg hover:shadow-xl transition-all group',
                    isDark ? 'bg-gray-800 hover:bg-gray-700' : 'bg-white hover:bg-gray-50'
                ]">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <h3 :class="['text-lg font-semibold ml-4', isDark ? 'text-white' : 'text-gray-900']">
                            Getting Started
                        </h3>
                    </div>
                    <p :class="isDark ? 'text-gray-300' : 'text-gray-600'">
                        New to SecureStart™? Learn the basics and get up to speed quickly.
                    </p>
                </a>

                <a :href="'#assessments'" :class="[
                    'rounded-xl p-6 shadow-lg hover:shadow-xl transition-all group',
                    isDark ? 'bg-gray-800 hover:bg-gray-700' : 'bg-white hover:bg-gray-50'
                ]">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 :class="['text-lg font-semibold ml-4', isDark ? 'text-white' : 'text-gray-900']">
                            Taking Assessments
                        </h3>
                    </div>
                    <p :class="isDark ? 'text-gray-300' : 'text-gray-600'">
                        Everything about diagnostic assessments, from start to completion.
                    </p>
                </a>

                <a :href="'#results'" :class="[
                    'rounded-xl p-6 shadow-lg hover:shadow-xl transition-all group',
                    isDark ? 'bg-gray-800 hover:bg-gray-700' : 'bg-white hover:bg-gray-50'
                ]">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                        </div>
                        <h3 :class="['text-lg font-semibold ml-4', isDark ? 'text-white' : 'text-gray-900']">
                            Understanding Results
                        </h3>
                    </div>
                    <p :class="isDark ? 'text-gray-300' : 'text-gray-600'">
                        Learn how to interpret and use your assessment results effectively.
                    </p>
                </a>
            </div>
        </div>

        <!-- Help Articles -->
        <div class="max-w-6xl mx-auto px-6 py-12">
            <!-- Getting Started Section -->
            <section id="getting-started" class="mb-16">
                <h2 :class="['text-2xl font-bold mb-6', isDark ? 'text-white' : 'text-gray-900']">
                    Getting Started
                </h2>
                <div class="grid md:grid-cols-2 gap-6">
                    <article :class="[
                        'rounded-lg p-6 shadow-md hover:shadow-lg transition-shadow',
                        isDark ? 'bg-gray-800' : 'bg-white'
                    ]">
                        <h3 :class="['text-lg font-semibold mb-2', isDark ? 'text-white' : 'text-gray-900']">
                            Creating Your Account
                        </h3>
                        <p :class="['mb-4', isDark ? 'text-gray-300' : 'text-gray-600']">
                            Learn how to create and set up your Saaz Academy account for the first time.
                        </p>
                        <a href="#" class="text-blue-600 hover:text-blue-700 font-medium">Read more →</a>
                    </article>

                    <article :class="[
                        'rounded-lg p-6 shadow-md hover:shadow-lg transition-shadow',
                        isDark ? 'bg-gray-800' : 'bg-white'
                    ]">
                        <h3 :class="['text-lg font-semibold mb-2', isDark ? 'text-white' : 'text-gray-900']">
                            Platform Overview
                        </h3>
                        <p :class="['mb-4', isDark ? 'text-gray-300' : 'text-gray-600']">
                            Get familiar with the SecureStart™ platform interface and navigation.
                        </p>
                        <a href="#" class="text-blue-600 hover:text-blue-700 font-medium">Read more →</a>
                    </article>

                    <article :class="[
                        'rounded-lg p-6 shadow-md hover:shadow-lg transition-shadow',
                        isDark ? 'bg-gray-800' : 'bg-white'
                    ]">
                        <h3 :class="['text-lg font-semibold mb-2', isDark ? 'text-white' : 'text-gray-900']">
                            First Assessment Guide
                        </h3>
                        <p :class="['mb-4', isDark ? 'text-gray-300' : 'text-gray-600']">
                            Step-by-step guide to taking your first diagnostic assessment.
                        </p>
                        <a href="#" class="text-blue-600 hover:text-blue-700 font-medium">Read more →</a>
                    </article>

                    <article :class="[
                        'rounded-lg p-6 shadow-md hover:shadow-lg transition-shadow',
                        isDark ? 'bg-gray-800' : 'bg-white'
                    ]">
                        <h3 :class="['text-lg font-semibold mb-2', isDark ? 'text-white' : 'text-gray-900']">
                            System Requirements
                        </h3>
                        <p :class="['mb-4', isDark ? 'text-gray-300' : 'text-gray-600']">
                            Technical requirements and supported browsers for optimal performance.
                        </p>
                        <a href="#" class="text-blue-600 hover:text-blue-700 font-medium">Read more →</a>
                    </article>
                </div>
            </section>

            <!-- Assessments Section -->
            <section id="assessments" class="mb-16">
                <h2 :class="['text-2xl font-bold mb-6', isDark ? 'text-white' : 'text-gray-900']">
                    Taking Assessments
                </h2>
                <div class="grid md:grid-cols-2 gap-6">
                    <article :class="[
                        'rounded-lg p-6 shadow-md hover:shadow-lg transition-shadow',
                        isDark ? 'bg-gray-800' : 'bg-white'
                    ]">
                        <h3 :class="['text-lg font-semibold mb-2', isDark ? 'text-white' : 'text-gray-900']">
                            Assessment Types
                        </h3>
                        <p :class="['mb-4', isDark ? 'text-gray-300' : 'text-gray-600']">
                            Understanding different assessment types and their purposes.
                        </p>
                        <a href="#" class="text-blue-600 hover:text-blue-700 font-medium">Read more →</a>
                    </article>

                    <article :class="[
                        'rounded-lg p-6 shadow-md hover:shadow-lg transition-shadow',
                        isDark ? 'bg-gray-800' : 'bg-white'
                    ]">
                        <h3 :class="['text-lg font-semibold mb-2', isDark ? 'text-white' : 'text-gray-900']">
                            Time Management Tips
                        </h3>
                        <p :class="['mb-4', isDark ? 'text-gray-300' : 'text-gray-600']">
                            Best practices for managing your time during assessments.
                        </p>
                        <a href="#" class="text-blue-600 hover:text-blue-700 font-medium">Read more →</a>
                    </article>

                    <article :class="[
                        'rounded-lg p-6 shadow-md hover:shadow-lg transition-shadow',
                        isDark ? 'bg-gray-800' : 'bg-white'
                    ]">
                        <h3 :class="['text-lg font-semibold mb-2', isDark ? 'text-white' : 'text-gray-900']">
                            Saving Progress
                        </h3>
                        <p :class="['mb-4', isDark ? 'text-gray-300' : 'text-gray-600']">
                            How to save your progress and resume assessments later.
                        </p>
                        <a href="#" class="text-blue-600 hover:text-blue-700 font-medium">Read more →</a>
                    </article>

                    <article :class="[
                        'rounded-lg p-6 shadow-md hover:shadow-lg transition-shadow',
                        isDark ? 'bg-gray-800' : 'bg-white'
                    ]">
                        <h3 :class="['text-lg font-semibold mb-2', isDark ? 'text-white' : 'text-gray-900']">
                            Technical Issues
                        </h3>
                        <p :class="['mb-4', isDark ? 'text-gray-300' : 'text-gray-600']">
                            Troubleshooting common technical problems during assessments.
                        </p>
                        <a href="#" class="text-blue-600 hover:text-blue-700 font-medium">Read more →</a>
                    </article>
                </div>
            </section>

            <!-- Results Section -->
            <section id="results" class="mb-16">
                <h2 :class="['text-2xl font-bold mb-6', isDark ? 'text-white' : 'text-gray-900']">
                    Understanding Results
                </h2>
                <div class="grid md:grid-cols-2 gap-6">
                    <article :class="[
                        'rounded-lg p-6 shadow-md hover:shadow-lg transition-shadow',
                        isDark ? 'bg-gray-800' : 'bg-white'
                    ]">
                        <h3 :class="['text-lg font-semibold mb-2', isDark ? 'text-white' : 'text-gray-900']">
                            Reading Your Report
                        </h3>
                        <p :class="['mb-4', isDark ? 'text-gray-300' : 'text-gray-600']">
                            How to interpret your assessment results and scores.
                        </p>
                        <a href="#" class="text-blue-600 hover:text-blue-700 font-medium">Read more →</a>
                    </article>

                    <article :class="[
                        'rounded-lg p-6 shadow-md hover:shadow-lg transition-shadow',
                        isDark ? 'bg-gray-800' : 'bg-white'
                    ]">
                        <h3 :class="['text-lg font-semibold mb-2', isDark ? 'text-white' : 'text-gray-900']">
                        Skill Gap Analysis
                        </h3>
                        <p :class="['mb-4', isDark ? 'text-gray-300' : 'text-gray-600']">
                            Understanding and addressing identified skill gaps.
                        </p>
                        <a href="#" class="text-blue-600 hover:text-blue-700 font-medium">Read more →</a>
                    </article>

                    <article :class="[
                        'rounded-lg p-6 shadow-md hover:shadow-lg transition-shadow',
                        isDark ? 'bg-gray-800' : 'bg-white'
                    ]">
                        <h3 :class="['text-lg font-semibold mb-2', isDark ? 'text-white' : 'text-gray-900']">
                            Sharing Results
                        </h3>
                        <p :class="['mb-4', isDark ? 'text-gray-300' : 'text-gray-600']">
                            How to share your results with managers or team members.
                        </p>
                        <a href="#" class="text-blue-600 hover:text-blue-700 font-medium">Read more →</a>
                    </article>

                    <article :class="[
                        'rounded-lg p-6 shadow-md hover:shadow-lg transition-shadow',
                        isDark ? 'bg-gray-800' : 'bg-white'
                    ]">
                        <h3 :class="['text-lg font-semibold mb-2', isDark ? 'text-white' : 'text-gray-900']">
                            Action Planning
                        </h3>
                        <p :class="['mb-4', isDark ? 'text-gray-300' : 'text-gray-600']">
                            Creating development plans based on assessment results.
                        </p>
                        <a href="#" class="text-blue-600 hover:text-blue-700 font-medium">Read more →</a>
                    </article>
                </div>
            </section>

            <!-- Additional Resources -->
            <section :class="[
                'rounded-xl p-8 shadow-lg',
                isDark ? 'bg-gray-800' : 'bg-blue-50'
            ]">
                <h2 :class="['text-2xl font-bold mb-6 text-center', isDark ? 'text-white' : 'text-gray-900']">
                    Need More Help?
                </h2>
                <div class="grid md:grid-cols-3 gap-6 text-center">
                    <div>
                        <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                            </svg>
                        </div>
                        <h3 :class="['text-lg font-semibold mb-2', isDark ? 'text-white' : 'text-gray-900']">
                            Live Chat
                        </h3>
                        <p :class="['mb-4', isDark ? 'text-gray-300' : 'text-gray-600']">
                            Chat with our support team in real-time.
                        </p>
                        <button class="text-blue-600 hover:text-blue-700 font-medium">
                            Start Chat →
                        </button>
                    </div>

                    <div>
                        <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <h3 :class="['text-lg font-semibold mb-2', isDark ? 'text-white' : 'text-gray-900']">
                            Email Support
                        </h3>
                        <p :class="['mb-4', isDark ? 'text-gray-300' : 'text-gray-600']">
                            Get help via email within 24 hours.
                        </p>
                        <a href="mailto:support@saazacademy.com" class="text-blue-600 hover:text-blue-700 font-medium">
                            Send Email →
                        </a>
                    </div>

                    <div>
                        <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                        <h3 :class="['text-lg font-semibold mb-2', isDark ? 'text-white' : 'text-gray-900']">
                            Knowledge Base
                        </h3>
                        <p :class="['mb-4', isDark ? 'text-gray-300' : 'text-gray-600']">
                            Browse our extensive documentation and resources to find answers to your questions.
                        </p>
                    </div>
                </div>
            </section>
        </div>
    </div>
</template>

<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { ref, inject } from 'vue';
import AppLayout from '@/layouts/AppLayout.vue';

defineOptions({
    layout: AppLayout,
});

// Get dark mode state from parent
const isDark = inject('isDark', false);

// Search functionality
const searchQuery = ref('');
</script>