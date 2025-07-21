<template>
    <div>
        <Head>
            <title>SecureStart™ Diagnostics - Cybersecurity Skills Assessment | Saaz Academy</title>
            <meta name="description" content="Evaluate your cybersecurity expertise across 20 critical domains with our comprehensive diagnostic assessment." />
            <meta name="keywords" content="cybersecurity assessment, security skills test, CISSP preparation, security diagnostic" />
        </Head>
        
        <div class="min-h-screen bg-gradient-to-b from-gray-50 to-white dark:from-gray-900 dark:to-gray-800">
            <!-- Hero Section with Apple-style gradient -->
            <div class="relative overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-br from-blue-500/5 via-purple-500/5 to-pink-500/5"></div>
                <div class="relative flex flex-col items-center justify-center px-4 py-20 text-center">
                    <h1 class="text-5xl md:text-6xl font-bold bg-gradient-to-r from-gray-900 to-gray-600 dark:from-white dark:to-gray-300 bg-clip-text text-transparent mb-4">
                        SecureStart™ Diagnostics
                    </h1>
                    <p class="text-xl md:text-2xl text-gray-600 dark:text-gray-400 mb-12 max-w-2xl">
                        {{ isAuthenticated ? 'Discover your cybersecurity expertise.' : 'Test your cybersecurity knowledge across 20 critical domains.' }}
                    </p>
                    
                    <!-- Primary CTA with Apple-style button -->
                    <div v-if="isAuthenticated" class="mb-8">
                        <button 
                            @click="startDiagnostic('standard')"
                            class="px-12 py-4 bg-gradient-to-r from-blue-600 to-blue-500 text-white text-lg font-semibold rounded-full hover:from-blue-700 hover:to-blue-600 transition-all shadow-lg hover:shadow-xl transform hover:scale-105"
                        >
                            Start Full Assessment
                        </button>
                    </div>
                    
                    <!-- Guest User CTAs -->
                    <div v-else class="mb-8">
                        <div class="flex flex-col md:flex-row items-center justify-center gap-4 mb-8">
                            <Link 
                                :href="route('login')"
                                class="inline-block px-8 py-3 bg-gray-900 dark:bg-gray-700 text-white text-base font-semibold rounded-full hover:bg-gray-800 dark:hover:bg-gray-600 transition-all shadow-lg hover:shadow-xl min-w-[180px] text-center"
                            >
                                Sign In
                            </Link>
                            
                            <div class="text-sm text-gray-500 dark:text-gray-400 hidden md:block">or</div>
                            
                            <Link 
                                :href="route('register')"
                                class="inline-block px-8 py-3 bg-gradient-to-r from-blue-600 to-blue-500 text-white text-base font-semibold rounded-full hover:from-blue-700 hover:to-blue-600 transition-all shadow-lg hover:shadow-xl min-w-[180px] text-center"
                            >
                                Create Account
                            </Link>
                        </div>
                        
                        <div class="text-center mb-6">
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-3">Not ready to commit?</p>
                            <Link 
                                :href="route('assessments.diagnostics.sample')"
                                class="inline-block px-6 py-2 bg-transparent border-2 border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 text-sm font-semibold rounded-full hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors"
                            >
                                Try 10-Question Sample First
                            </Link>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Domains Section with Apple-style Cards -->
            <div class="px-4 py-6 mx-auto w-full max-w-7xl">
                <h2 class="text-3xl md:text-4xl font-bold text-center bg-gradient-to-r from-gray-900 to-gray-600 dark:from-white dark:to-gray-300 bg-clip-text text-transparent mb-12">
                    20 Security Domains. One Comprehensive Assessment.
                </h2>
                
                <!-- Domains by Phase -->
                <div class="space-y-8 mb-8">
                    <!-- Phase 1 -->
                    <div>
                        <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-4 flex items-center">
                            <span class="w-8 h-8 bg-blue-100 dark:bg-blue-900/30 rounded-full flex items-center justify-center mr-3 text-sm font-bold text-blue-600 dark:text-blue-400">1</span>
                            Foundation & Governance
                        </h3>
                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-3">
                            <div v-for="(domain, index) in phase1Domains" :key="domain.name"
                                 class="domain-card group"
                                 @click="showDomainTooltip(domain)">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-blue-100 dark:bg-blue-900/30 rounded-xl flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform">
                                        <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path v-if="index === 0" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                            <path v-else-if="index === 1" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                            <path v-else-if="index === 2" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                            <path v-else-if="index === 3" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3" />
                                            <path v-else stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                                        </svg>
                                    </div>
                                    <h4 class="text-sm font-semibold text-gray-800 dark:text-gray-100">{{ domain.name }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Phase 2 -->
                    <div>
                        <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-4 flex items-center">
                            <span class="w-8 h-8 bg-green-100 dark:bg-green-900/30 rounded-full flex items-center justify-center mr-3 text-sm font-bold text-green-600 dark:text-green-400">2</span>
                            Technical Controls
                        </h3>
                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-3">
                            <div v-for="(domain, index) in phase2Domains" :key="domain.name"
                                 class="domain-card group"
                                 @click="showDomainTooltip(domain)">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-green-100 dark:bg-green-900/30 rounded-xl flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform">
                                        <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path v-if="index === 0" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                                            <path v-else-if="index === 1" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                            <path v-else-if="index === 2" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                                            <path v-else-if="index === 3" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8 8m0 0V4m0 11h11M9 4H4v5m0 0l8 8" />
                                            <path v-else stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                        </svg>
                                    </div>
                                    <h4 class="text-sm font-semibold text-gray-800 dark:text-gray-100">{{ domain.name }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Phase 3 -->
                    <div>
                        <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-4 flex items-center">
                            <span class="w-8 h-8 bg-purple-100 dark:bg-purple-900/30 rounded-full flex items-center justify-center mr-3 text-sm font-bold text-purple-600 dark:text-purple-400">3</span>
                            Infrastructure & Applications
                        </h3>
                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-3">
                            <div v-for="(domain, index) in phase3Domains" :key="domain.name"
                                 class="domain-card group"
                                 @click="showDomainTooltip(domain)">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-purple-100 dark:bg-purple-900/30 rounded-xl flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform">
                                        <svg class="w-5 h-5 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path v-if="index === 0" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                                            <path v-else-if="index === 1" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                                            <path v-else-if="index === 2" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z" />
                                            <path v-else-if="index === 3" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                            <path v-else stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                                        </svg>
                                    </div>
                                    <h4 class="text-sm font-semibold text-gray-800 dark:text-gray-100">{{ domain.name }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Phase 4 -->
                    <div>
                        <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-4 flex items-center">
                            <span class="w-8 h-8 bg-orange-100 dark:bg-orange-900/30 rounded-full flex items-center justify-center mr-3 text-sm font-bold text-orange-600 dark:text-orange-400">4</span>
                            Operations & Response
                        </h3>
                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-3">
                            <div v-for="(domain, index) in phase4Domains" :key="domain.name"
                                 class="domain-card group"
                                 @click="showDomainTooltip(domain)">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-orange-100 dark:bg-orange-900/30 rounded-xl flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform">
                                        <svg class="w-5 h-5 text-orange-600 dark:text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path v-if="index === 0" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                            <path v-else-if="index === 1" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                            <path v-else-if="index === 2" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                            <path v-else-if="index === 3" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                            <path v-else stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                        </svg>
                                    </div>
                                    <h4 class="text-sm font-semibold text-gray-800 dark:text-gray-100">{{ domain.name }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Assessment Features -->
                <p class="text-center text-lg text-gray-600 dark:text-gray-400">
                    Adaptive questions. Personalized insights. Professional report.
                </p>
            </div>

            <!-- Final CTA Section -->
            <div class="px-4 py-20 text-center bg-gradient-to-t from-gray-50 to-transparent dark:from-gray-900 dark:to-transparent">
                <h3 class="text-2xl font-semibold text-gray-900 dark:text-white mb-8">
                    {{ isAuthenticated ? 'Ready to begin?' : 'See how you compare to industry professionals' }}
                </h3>
                
                <div v-if="isAuthenticated" class="mb-6">
                    <button 
                        @click="startDiagnostic('standard')"
                        class="px-12 py-4 bg-gradient-to-r from-blue-600 to-blue-500 text-white text-lg font-semibold rounded-full hover:from-blue-700 hover:to-blue-600 transition-all shadow-lg hover:shadow-xl transform hover:scale-105"
                    >
                        Start Full Assessment
                    </button>
                </div>
                
                <div v-else class="mb-6">
                    <div class="max-w-2xl mx-auto">
                        <div class="mb-8 text-gray-600 dark:text-gray-400">
                            <p class="text-lg mb-4">Join 10,000+ cybersecurity professionals who have tested their skills</p>
                            <div class="flex justify-center space-x-8 text-sm">
                                <div>
                                    <span class="text-2xl font-bold text-gray-900 dark:text-white">20</span>
                                    <p>Security Domains</p>
                                </div>
                                <div>
                                    <span class="text-2xl font-bold text-gray-900 dark:text-white">4</span>
                                    <p>Learning Phases</p>
                                </div>
                                <div>
                                    <span class="text-2xl font-bold text-gray-900 dark:text-white">5</span>
                                    <p>Proficiency Levels</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="space-y-6">
                            <div class="flex flex-col md:flex-row items-center justify-center gap-4">
                                <Link 
                                    :href="route('login')"
                                    class="inline-block px-10 py-3 bg-gray-900 dark:bg-gray-700 text-white text-base font-semibold rounded-full hover:bg-gray-800 dark:hover:bg-gray-600 transition-all shadow-lg hover:shadow-xl min-w-[200px] text-center"
                                >
                                    Sign In to Start
                                </Link>
                                
                                <div class="text-sm text-gray-500 dark:text-gray-400 hidden md:block">or</div>
                                
                                <Link 
                                    :href="route('register')"
                                    class="inline-block px-10 py-3 bg-gradient-to-r from-blue-600 to-blue-500 text-white text-base font-semibold rounded-full hover:from-blue-700 hover:to-blue-600 transition-all shadow-lg hover:shadow-xl min-w-[200px] text-center"
                                >
                                    Create Free Account
                                </Link>
                            </div>
                            
                            <div class="text-gray-500 dark:text-gray-400">
                                <Link 
                                    :href="route('assessments.diagnostics.sample')"
                                    class="hover:text-gray-700 dark:hover:text-gray-300 underline text-sm"
                                >
                                    Or try the 10-question sample without registration
                                </Link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Domain Tooltip Modal -->
        <Transition name="fade">
            <div v-if="tooltipDomain" 
                 @click="tooltipDomain = null"
                 class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/20 backdrop-blur-sm">
                <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 max-w-md shadow-2xl transform transition-all"
                     @click.stop>
                    <div class="flex items-start justify-between mb-4">
                        <h4 class="font-semibold text-lg text-gray-900 dark:text-white">{{ tooltipDomain.name }}</h4>
                        <button @click="tooltipDomain = null" 
                                class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">{{ tooltipDomain.description }}</p>
                    <div v-if="tooltipDomain.topics && tooltipDomain.topics.length > 0">
                        <h5 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Topics covered:</h5>
                        <ul class="space-y-1">
                            <li v-for="topic in tooltipDomain.topics.slice(0, 5)" :key="topic" 
                                class="text-xs text-gray-600 dark:text-gray-400 flex items-start">
                                <span class="text-gray-400 dark:text-gray-500 mr-2">•</span>
                                <span>{{ topic }}</span>
                            </li>
                        </ul>
                        <p v-if="tooltipDomain.topics.length > 5" class="text-xs text-gray-500 dark:text-gray-400 mt-2">
                            And {{ tooltipDomain.topics.length - 5 }} more topics...
                        </p>
                    </div>
                </div>
            </div>
        </Transition>
    </div>
</template>

<script setup lang="ts">
import { Link, router, Head } from '@inertiajs/vue3';
import { computed, ref } from 'vue';
import AppLayout from "@/layouts/AppLayout.vue";

const props = defineProps({
    isAuthenticated: {
        type: Boolean,
        default: false
    },
});

// Domains organized by phase with simplified structure
const phase1Domains = ref([
    { 
        name: 'General Security', 
        description: 'Core security principles including CIA Triad and security controls',
        topics: [
            '5 Pillars of Information Security',
            'Professional Ethics',
            'Security Controls',
            'Security Principles',
            'Cybersecurity Frameworks'
        ]
    },
    { 
        name: 'Governance', 
        description: 'Management frameworks and security policies',
        topics: [
            'Information Security Program',
            'Strategic Alignment',
            'Leadership & Accountability',
            'Security Policy Framework',
            'Policy Governance and Management'
        ]
    },
    { 
        name: 'Risk Management', 
        description: 'Risk assessment and treatment strategies',
        topics: [
            'Risk Management Fundamentals',
            'Risk Identification',
            'Risk Assessment',
            'Risk Treatment',
            'Risk Monitoring & Reporting'
        ]
    },
    { 
        name: 'Legal & Compliance', 
        description: 'Regulatory requirements and legal frameworks',
        topics: [
            'Compliance Requirements',
            'Contracts',
            'Industry Specific Regulations',
            'Intellectual Property',
            'Investigation Types'
        ]
    },
    { 
        name: 'Privacy', 
        description: 'Data protection and privacy principles',
        topics: [
            'Personal Information',
            'Privacy Principles',
            'Data Subject Rights',
            'Privacy Governance',
            'Privacy Protection'
        ]
    }
]);

const phase2Domains = ref([
    { 
        name: 'Security Audits', 
        description: 'Audit methodologies and assessment techniques',
        topics: [
            'Audit Fundamentals & Planning',
            'Evidence Gathering & Documentation',
            'Control Assessment & Testing',
            'Testing Methodologies & Approaches',
            'Security Testing & Assessment'
        ]
    },
    { 
        name: 'Threat & Vulnerability', 
        description: 'Threat identification and vulnerability management',
        topics: [
            'Threat Actors',
            'TTPs',
            'Vulnerability Management',
            'Vulnerability Assessment',
            'Malware'
        ]
    },
    { 
        name: 'Cryptography', 
        description: 'Encryption algorithms and key management',
        topics: [
            'Cryptographic Algorithms',
            'Cryptographic Applications',
            'Public Key Infrastructure (PKI)',
            'Key Management',
            'Cryptanalysis & Security'
        ]
    },
    { 
        name: 'Data Governance', 
        description: 'Data lifecycle and protection strategies',
        topics: [
            'Data Classification & Categorization',
            'Data Lifecycle Management',
            'Data Retention & Archival',
            'Data Sanitization',
            'Data Security Controls'
        ]
    },
    { 
        name: 'Identity & Access', 
        description: 'IAM principles and access control',
        topics: [
            'Identification',
            'Authentication',
            'Authorization',
            'Accounting (Auditing)',
            'Federation & Advanced IAM'
        ]
    }
]);

const phase3Domains = ref([
    { 
        name: 'Networking', 
        description: 'Network protocols and infrastructure',
        topics: [
            'OSI Model',
            'TCP/IP Protocols',
            'Network Appliances',
            'Network Services',
            'Communication Protocols'
        ]
    },
    { 
        name: 'Network Security', 
        description: 'Network defense and security protocols',
        topics: [
            'Security Protocols',
            'Network Attacks',
            'Network Segmentation',
            'Wireless Security',
            'Network Diagnostic Tools'
        ]
    },
    { 
        name: 'Application Security', 
        description: 'Secure development and DevSecOps',
        topics: [
            'Secure Software Development Lifecycle',
            'Models',
            'Application vulnerabilities',
            'Security Testing',
            'Secure Coding'
        ]
    },
    { 
        name: 'Cloud Security', 
        description: 'Cloud infrastructure and security controls',
        topics: [
            'Cloud Fundamentals',
            'Cloud Models',
            'Cloud Governance',
            'Cloud Security Controls',
            'Cloud Infrastructure Security'
        ]
    },
    { 
        name: 'Endpoint & IoT', 
        description: 'Device security and management',
        topics: [
            'Endpoint Protection Platform',
            'Application Whitelisting',
            'Secure Configuration',
            'Device Encryption',
            'Mobile Device Management'
        ]
    }
]);

const phase4Domains = ref([
    { 
        name: 'Security Architecture', 
        description: 'Design principles and frameworks',
        topics: [
            'Security by Design',
            'Secure Defaults',
            'Least Privilege',
            'Defense in Depth',
            'Zero Trust'
        ]
    },
    { 
        name: 'Human Factors', 
        description: 'Security awareness and training',
        topics: [
            'Social Engineering',
            'Security Awareness Training',
            'Personnel Security',
            'Physical Access Controls',
            'Environmental Security'
        ]
    },
    { 
        name: 'Security Operations', 
        description: 'SOC and monitoring operations',
        topics: [
            'Security Operations Center',
            'Operational Metrics',
            'Log & Event Management',
            'Patch Management',
            'SIEM & SOAR'
        ]
    },
    { 
        name: 'Incident Response', 
        description: 'Incident handling and forensics',
        topics: [
            'Incident Response Phases',
            'Playbooks & Runbooks',
            'Reporting & Communication',
            'Forensic Investigation',
            'Digital Forensics Tools'
        ]
    },
    { 
        name: 'Business Continuity', 
        description: 'Disaster recovery and resilience',
        topics: [
            'Business Impact Analysis',
            'Recovery Objectives',
            'Business Continuity Plan',
            'Disaster Recovery Plan',
            'Backup Strategies'
        ]
    }
]);

// Tooltip state
const tooltipDomain = ref(null);

const showDomainTooltip = (domain) => {
    tooltipDomain.value = domain;
};

const startDiagnostic = (mode) => {
    router.visit(route('assessments.diagnostics.begin'), {
        method: 'post',
        data: { mode: mode }
    });
};

// Set the layout
defineOptions({
    layout: AppLayout
});
</script>

<style scoped>
/* Fade transitions */
.fade-enter-active, .fade-leave-active {
    transition: opacity 0.3s ease;
}
.fade-enter-from, .fade-leave-to {
    opacity: 0;
}

/* Domain card styles - Apple-inspired design */
.domain-card {
    position: relative;
    background: rgba(255, 255, 255, 0.8);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    border: 1px solid rgba(0, 0, 0, 0.1);
    border-radius: 16px;
    padding: 16px;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    cursor: pointer;
    display: flex;
    align-items: center;
    min-height: 72px;
    width: 100%;
    box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
}

.dark .domain-card {
    background: rgba(30, 41, 59, 0.8);
    border-color: rgba(148, 163, 184, 0.1);
}

.domain-card:hover {
    background: rgba(255, 255, 255, 0.95);
    border-color: rgba(0, 0, 0, 0.15);
    box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    transform: translateY(-2px);
}

.dark .domain-card:hover {
    background: rgba(30, 41, 59, 0.95);
    border-color: rgba(148, 163, 184, 0.2);
    box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.3), 0 4px 6px -2px rgba(0, 0, 0, 0.2);
}

@media (min-width: 768px) {
    .domain-card {
        min-height: 80px;
    }
}
</style>