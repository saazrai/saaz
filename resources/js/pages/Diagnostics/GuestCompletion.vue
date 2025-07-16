<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3'
import Layout from '@/layouts/AppLayout.vue'
import { computed } from 'vue'

const props = defineProps({
    assessment: Object,
    score: Number,
    totalQuestions: Number,
})

// Calculate basic metrics
const scorePercentage = computed(() => Math.round(props.score || 0))
// const isPassed = computed(() => scorePercentage.value >= 70)
const performanceLevel = computed(() => {
    if (scorePercentage.value >= 85) return 'excellent'
    if (scorePercentage.value >= 70) return 'good'
    return 'needs_improvement'
})

const performanceColors = {
    excellent: 'from-green-600 to-emerald-600',
    good: 'from-blue-600 to-indigo-600', 
    needs_improvement: 'from-orange-600 to-red-600'
}

const performanceMessages = {
    excellent: 'Outstanding Performance!',
    good: 'Good Performance!',
    needs_improvement: 'Room for Improvement'
}
</script>

<template>
    <Head title="Assessment Complete - Get Your Results" />
    
    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Celebration Header -->
            <div class="text-center mb-12">
                <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-gradient-to-r from-blue-600 to-purple-600 mb-6">
                    <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h1 class="text-4xl font-bold text-gray-900 mb-4">
                    Assessment Complete! 🎉
                </h1>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    You've successfully completed the SecureStart™ diagnostic assessment. 
                    Get your detailed results and insights by creating your account.
                </p>
            </div>

            <!-- Basic Score Display -->
            <div class="bg-white rounded-2xl shadow-lg p-8 mb-8">
                <div class="text-center mb-8">
                    <div class="inline-flex items-center justify-center w-32 h-32 rounded-full bg-gradient-to-r mb-6"
                         :class="performanceColors[performanceLevel]">
                        <span class="text-4xl font-bold text-white">{{ scorePercentage }}%</span>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900 mb-2">
                        {{ performanceMessages[performanceLevel] }}
                    </h2>
                    <p class="text-gray-600">
                        You scored {{ scorePercentage }}% on your SecureStart™ assessment
                    </p>
                </div>

                <!-- Basic Performance Indicator -->
                <div class="max-w-md mx-auto">
                    <div class="flex justify-between text-sm text-gray-600 mb-2">
                        <span>Your Score</span>
                        <span>{{ scorePercentage }}% ({{ score }}/{{ totalQuestions }})</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-3 mb-4">
                        <div class="h-3 rounded-full bg-gradient-to-r transition-all duration-1000"
                             :class="performanceColors[performanceLevel]"
                             :style="`width: ${scorePercentage}%`"></div>
                    </div>
                    <div class="flex justify-between text-xs text-gray-500">
                        <span>0%</span>
                        <span class="font-medium">70% (Pass)</span>
                        <span>100%</span>
                    </div>
                </div>
            </div>

            <!-- Value Proposition for Registration -->
            <div class="bg-gradient-to-r from-blue-600 to-purple-600 rounded-2xl p-8 text-white mb-8">
                <div class="max-w-3xl mx-auto text-center">
                    <h3 class="text-2xl font-bold mb-4">
                        Unlock Your Complete SecureStart™ Report
                    </h3>
                    <p class="text-blue-100 mb-8 text-lg">
                        Get detailed analysis, domain breakdowns, personalized recommendations, 
                        and track your progress over time with a free account.
                    </p>
                    
                    <!-- Features Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <div class="flex items-center">
                            <div class="w-10 h-10 rounded-lg bg-white/20 flex items-center justify-center mr-4">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                </svg>
                            </div>
                            <span class="text-left">Detailed domain-by-domain analysis</span>
                        </div>
                        <div class="flex items-center">
                            <div class="w-10 h-10 rounded-lg bg-white/20 flex items-center justify-center mr-4">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                </svg>
                            </div>
                            <span class="text-left">Progress tracking over time</span>
                        </div>
                        <div class="flex items-center">
                            <div class="w-10 h-10 rounded-lg bg-white/20 flex items-center justify-center mr-4">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C20.832 18.477 19.246 18 17.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                </svg>
                            </div>
                            <span class="text-left">Personalized recommendations</span>
                        </div>
                        <div class="flex items-center">
                            <div class="w-10 h-10 rounded-lg bg-white/20 flex items-center justify-center mr-4">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            <span class="text-left">Professional PDF reports</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Registration/Login Actions -->
            <div class="bg-white rounded-2xl shadow-lg p-8">
                <div class="max-w-md mx-auto text-center">
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">
                        Ready to see your full results?
                    </h3>
                    <p class="text-gray-600 mb-8">
                        Create your free account or sign in to access your detailed SecureStart™ report.
                    </p>
                    
                    <!-- Action Buttons -->
                    <div class="space-y-4">
                        <Link :href="route('auth.register')" 
                              class="block w-full bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold py-4 px-6 rounded-xl hover:from-blue-700 hover:to-purple-700 transition-all duration-300 transform hover:scale-105">
                            Create Free Account & Get Results
                        </Link>
                        
                        <div class="flex items-center">
                            <div class="flex-1 border-t border-gray-300"></div>
                            <span class="px-4 text-sm text-gray-500">or</span>
                            <div class="flex-1 border-t border-gray-300"></div>
                        </div>
                        
                        <Link :href="route('auth.login')" 
                              class="block w-full border-2 border-gray-300 text-gray-700 font-semibold py-4 px-6 rounded-xl hover:border-gray-400 hover:bg-gray-50 transition-all duration-300">
                            Sign In to Existing Account
                        </Link>
                    </div>
                    
                    <!-- Security & Privacy Note -->
                    <div class="mt-8 p-4 bg-gray-50 rounded-lg">
                        <div class="flex items-center justify-center mb-2">
                            <svg class="w-5 h-5 text-green-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                            </svg>
                            <span class="text-sm font-medium text-gray-700">Enterprise Security</span>
                        </div>
                        <p class="text-xs text-gray-600">
                            Your assessment data is encrypted and GDPR compliant. 
                            We'll never share your results without permission.
                        </p>
                    </div>
                </div>
            </div>
            
            <!-- Continue as Guest Option -->
            <div class="text-center mt-8">
                <Link :href="route('home')" 
                      class="text-gray-500 hover:text-gray-700 text-sm font-medium transition-colors">
                    ← Continue browsing without an account
                </Link>
            </div>
        </div>
    </div>
</template>

<script lang="ts">
export default {
    layout: Layout
}
</script>