<template>
    <Head>
        <title>About Us | Saaz Academy</title>
        <meta name="description"
            content="Learn about Saaz Academy's mission to provide enterprise-grade diagnostic assessments and professional development solutions." />
    </Head>

    <div :class="['min-h-screen transition-colors duration-300', isDarkMode ? 'bg-gray-900' : 'bg-gray-50']">
        <!-- Hero Section -->
        <div :class="[
            'py-24 transition-colors duration-300',
            isDarkMode 
                ? 'bg-gradient-to-br from-gray-800 via-gray-700 to-gray-800' 
                : 'bg-gradient-to-br from-blue-900 via-blue-800 to-blue-700'
        ]">
            <div class="max-w-6xl mx-auto px-6 text-center text-white">
                <h1 class="text-5xl font-bold mb-6">About Saaz Academy</h1>
                <p class="text-xl text-blue-100 max-w-3xl mx-auto">
                    Empowering organizations with enterprise diagnostic assessments through our SecureStart™ platform.
                </p>
            </div>
        </div>

        <!-- Mission Section -->
        <div :class="['py-16 transition-colors duration-300', isDarkMode ? 'bg-gray-800' : 'bg-white']">
            <div class="max-w-6xl mx-auto px-6">
                <div class="grid md:grid-cols-2 gap-12 items-center">
                    <div>
                        <h2 :class="['text-3xl font-bold mb-6', isDarkMode ? 'text-white' : 'text-gray-900']">
                            Our Mission
                        </h2>
                        <p :class="['text-lg mb-4', isDarkMode ? 'text-gray-300' : 'text-gray-600']">
                            At Saaz Academy, we're dedicated to providing organizations with comprehensive diagnostic tools that help identify strengths, gaps, and opportunities for growth.
                        </p>
                        <p :class="['text-lg mb-4', isDarkMode ? 'text-gray-300' : 'text-gray-600']">
                            Our SecureStart™ platform delivers enterprise-grade assessments that enable data-driven decisions and strategic planning for professional development.
                        </p>
                        <p :class="['text-lg', isDarkMode ? 'text-gray-300' : 'text-gray-600']">
                            We believe in empowering teams with insights that drive meaningful improvements in skills, processes, and organizational effectiveness.
                        </p>
                    </div>
                    <div :class="['rounded-xl p-8 shadow-lg', isDarkMode ? 'bg-gray-700' : 'bg-blue-50']">
                        <div class="space-y-6">
                            <div class="flex items-start">
                                <svg class="w-6 h-6 text-blue-600 mt-1 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <div>
                                    <h3 :class="['font-semibold mb-1', isDarkMode ? 'text-white' : 'text-gray-900']">Enterprise-Ready</h3>
                                    <p :class="['text-sm', isDarkMode ? 'text-gray-300' : 'text-gray-600']">Built for organizations of all sizes</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <svg class="w-6 h-6 text-blue-600 mt-1 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <div>
                                    <h3 :class="['font-semibold mb-1', isDarkMode ? 'text-white' : 'text-gray-900']">Data-Driven Insights</h3>
                                    <p :class="['text-sm', isDarkMode ? 'text-gray-300' : 'text-gray-600']">Comprehensive analytics and reporting</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <svg class="w-6 h-6 text-blue-600 mt-1 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <div>
                                    <h3 :class="['font-semibold mb-1', isDarkMode ? 'text-white' : 'text-gray-900']">Secure & Compliant</h3>
                                    <p :class="['text-sm', isDarkMode ? 'text-gray-300' : 'text-gray-600']">Industry-standard security practices</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Values Section -->
        <div :class="['py-16 transition-colors duration-300', isDarkMode ? 'bg-gray-900' : 'bg-gray-50']">
            <div class="max-w-6xl mx-auto px-6">
                <h2 :class="['text-3xl font-bold text-center mb-12', isDarkMode ? 'text-white' : 'text-gray-900']">
                    Our Core Values
                </h2>
                <div class="grid md:grid-cols-3 gap-8">
                    <div :class="['rounded-xl p-8 shadow-lg hover:shadow-xl transition-shadow', isDarkMode ? 'bg-gray-800' : 'bg-white']">
                        <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mb-6">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                            </svg>
                        </div>
                        <h3 :class="['text-xl font-semibold mb-4', isDarkMode ? 'text-white' : 'text-gray-900']">Excellence</h3>
                        <p :class="isDarkMode ? 'text-gray-300' : 'text-gray-600'">
                            We strive for excellence in every assessment, report, and interaction with our clients.
                        </p>
                    </div>
                    
                    <div :class="['rounded-xl p-8 shadow-lg hover:shadow-xl transition-shadow', isDarkMode ? 'bg-gray-800' : 'bg-white']">
                        <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mb-6">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                        <h3 :class="['text-xl font-semibold mb-4', isDarkMode ? 'text-white' : 'text-gray-900']">Integrity</h3>
                        <p :class="isDarkMode ? 'text-gray-300' : 'text-gray-600'">
                            We maintain the highest standards of integrity in data handling, analysis, and recommendations.
                        </p>
                    </div>
                    
                    <div :class="['rounded-xl p-8 shadow-lg hover:shadow-xl transition-shadow', isDarkMode ? 'bg-gray-800' : 'bg-white']">
                        <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mb-6">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <h3 :class="['text-xl font-semibold mb-4', isDarkMode ? 'text-white' : 'text-gray-900']">Innovation</h3>
                        <p :class="isDarkMode ? 'text-gray-300' : 'text-gray-600'">
                            We continuously innovate to provide cutting-edge diagnostic tools and insights.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Team Section -->
        <div :class="['py-16 transition-colors duration-300', isDarkMode ? 'bg-gray-800' : 'bg-white']">
            <div class="max-w-6xl mx-auto px-6">
                <h2 :class="['text-3xl font-bold text-center mb-12', isDarkMode ? 'text-white' : 'text-gray-900']">
                    Leadership Team
                </h2>
                <div class="grid md:grid-cols-3 gap-8">
                    <div class="text-center">
                        <div :class="[
                            'w-32 h-32 rounded-full mx-auto mb-4',
                            isDarkMode ? 'bg-gray-700' : 'bg-gray-200'
                        ]"></div>
                        <h3 :class="['text-lg font-semibold', isDarkMode ? 'text-white' : 'text-gray-900']">Sarah Johnson</h3>
                        <p :class="['text-sm mb-2', isDarkMode ? 'text-gray-400' : 'text-gray-600']">CEO & Founder</p>
                        <p :class="['text-sm', isDarkMode ? 'text-gray-300' : 'text-gray-600']">
                            20+ years in enterprise assessment and organizational development
                        </p>
                    </div>
                    
                    <div class="text-center">
                        <div :class="[
                            'w-32 h-32 rounded-full mx-auto mb-4',
                            isDarkMode ? 'bg-gray-700' : 'bg-gray-200'
                        ]"></div>
                        <h3 :class="['text-lg font-semibold', isDarkMode ? 'text-white' : 'text-gray-900']">Michael Chen</h3>
                        <p :class="['text-sm mb-2', isDarkMode ? 'text-gray-400' : 'text-gray-600']">CTO</p>
                        <p :class="['text-sm', isDarkMode ? 'text-gray-300' : 'text-gray-600']">
                            Expert in scalable assessment platforms and data analytics
                        </p>
                    </div>
                    
                    <div class="text-center">
                        <div :class="[
                            'w-32 h-32 rounded-full mx-auto mb-4',
                            isDarkMode ? 'bg-gray-700' : 'bg-gray-200'
                        ]"></div>
                        <h3 :class="['text-lg font-semibold', isDarkMode ? 'text-white' : 'text-gray-900']">Dr. Emily Rodriguez</h3>
                        <p :class="['text-sm mb-2', isDarkMode ? 'text-gray-400' : 'text-gray-600']">Head of Assessment Design</p>
                        <p :class="['text-sm', isDarkMode ? 'text-gray-300' : 'text-gray-600']">
                            PhD in Organizational Psychology, specialist in diagnostic methodologies
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- CTA Section -->
        <div :class="[
            'py-16 transition-colors duration-300',
            isDarkMode 
                ? 'bg-gradient-to-r from-gray-700 to-gray-800' 
                : 'bg-gradient-to-r from-blue-600 to-blue-800'
        ]">
            <div class="max-w-4xl mx-auto px-6 text-center text-white">
                <h2 class="text-3xl font-bold mb-6">Ready to Transform Your Organization?</h2>
                <p class="text-xl text-blue-100 mb-8">
                    Discover how SecureStart™ can provide the insights you need for strategic growth.
                </p>
                <Link :href="safeRoute('assessments.diagnostics.index', '/diagnostics')"
                    class="inline-block bg-white text-blue-600 px-8 py-4 rounded-lg font-semibold hover:bg-gray-100 transition-colors">
                    Get Started with SecureStart™
                </Link>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { inject } from 'vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { safeRoute } from '@/utils/route-helper';

defineOptions({
    layout: AppLayout,
});

// Get dark mode state from parent
const isDarkMode = inject('isDark', false);
</script>