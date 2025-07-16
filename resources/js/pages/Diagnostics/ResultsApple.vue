<template>
    <div class="min-h-screen bg-gray-50 dark:bg-gray-900">
        <!-- Navigation Bar -->
        <nav class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-xl border-b border-gray-200/50 dark:border-gray-700/50 sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-16">
                    <button 
                        @click="goBack"
                        class="flex items-center gap-2 text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-100 transition-colors"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                        <span class="font-medium">Assessments</span>
                    </button>
                    
                    <button 
                        @click="startNewAssessment"
                        class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-full transition-colors text-sm"
                    >
                        New Assessment
                    </button>
                </div>
            </div>
        </nav>

        <!-- Results Hero -->
        <div class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                <div class="text-center">
                    <!-- Score Circle -->
                    <div class="relative inline-flex items-center justify-center w-32 h-32 mb-6">
                        <svg class="w-32 h-32 transform -rotate-90">
                            <circle
                                cx="64"
                                cy="64"
                                r="56"
                                stroke="currentColor"
                                stroke-width="12"
                                fill="none"
                                class="text-gray-200 dark:text-gray-700"
                            />
                            <circle
                                cx="64"
                                cy="64"
                                r="56"
                                stroke="currentColor"
                                stroke-width="12"
                                fill="none"
                                :stroke-dasharray="`${2 * Math.PI * 56}`"
                                :stroke-dashoffset="`${2 * Math.PI * 56 * (1 - diagnostic.score / 100)}`"
                                class="text-blue-600 dark:text-blue-400 transition-all duration-1000 ease-out"
                            />
                        </svg>
                        <div class="absolute inset-0 flex flex-col items-center justify-center">
                            <span class="text-3xl font-semibold text-gray-900 dark:text-white">{{ diagnostic.score }}%</span>
                            <span class="text-xs text-gray-500 dark:text-gray-400 uppercase tracking-wider">Score</span>
                        </div>
                    </div>
                    
                    <h1 class="text-2xl font-semibold text-gray-900 dark:text-white mb-2">
                        Assessment Complete
                    </h1>
                    <p class="text-gray-600 dark:text-gray-300">
                        {{ formatDate(diagnostic.created_at) }}
                    </p>
                    
                    <!-- Key Metrics -->
                    <div class="grid grid-cols-3 gap-8 mt-8 max-w-md mx-auto">
                        <div>
                            <div class="text-2xl font-semibold text-gray-900 dark:text-white">
                                {{ diagnostic.current_question }}
                            </div>
                            <div class="text-sm text-gray-500 dark:text-gray-400">
                                Questions
                            </div>
                        </div>
                        <div>
                            <div class="text-2xl font-semibold text-gray-900 dark:text-white">
                                {{ formatDuration(diagnostic.total_duration_seconds) }}
                            </div>
                            <div class="text-sm text-gray-500 dark:text-gray-400">
                                Duration
                            </div>
                        </div>
                        <div>
                            <div class="text-2xl font-semibold text-gray-900 dark:text-white">
                                {{ diagnostic.ability ? diagnostic.ability.toFixed(1) : '—' }}
                            </div>
                            <div class="text-sm text-gray-500 dark:text-gray-400">
                                Ability
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Domain Performance -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-6">
                Performance by Domain
            </h2>
            
            <div class="grid gap-4">
                <div 
                    v-for="domain in domainPerformance" 
                    :key="domain.id"
                    class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-sm hover:shadow-md transition-shadow"
                >
                    <div class="flex items-start justify-between mb-4">
                        <div>
                            <h3 class="font-medium text-gray-900 dark:text-white">
                                {{ domain.name }}
                            </h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                {{ domain.questions_answered }} questions answered
                            </p>
                        </div>
                        <div class="text-right">
                            <div class="text-2xl font-semibold" :class="getScoreColor(domain.score)">
                                {{ domain.score }}%
                            </div>
                            <div class="text-xs text-gray-500 dark:text-gray-400">
                                {{ getDomainLevel(domain.score) }}
                            </div>
                        </div>
                    </div>
                    
                    <!-- Progress Bar -->
                    <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2 overflow-hidden">
                        <div 
                            class="h-full rounded-full transition-all duration-500"
                            :class="getProgressBarColor(domain.score)"
                            :style="{ width: `${domain.score}%` }"
                        ></div>
                    </div>
                    
                    <!-- Topics Performance -->
                    <div v-if="domain.topics && domain.topics.length > 0" class="mt-4 space-y-2">
                        <div 
                            v-for="topic in domain.topics" 
                            :key="topic.id"
                            class="flex items-center justify-between text-sm"
                        >
                            <span class="text-gray-600 dark:text-gray-400">{{ topic.name }}</span>
                            <span class="font-medium" :class="getScoreColor(topic.score)">
                                {{ topic.score }}%
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Section -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-12">
            <div class="bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-blue-900/20 dark:to-indigo-900/20 rounded-2xl p-8">
                <div class="max-w-3xl mx-auto text-center">
                    <h2 class="text-2xl font-semibold text-gray-900 dark:text-white mb-4">
                        Ready to Continue Learning?
                    </h2>
                    <p class="text-gray-600 dark:text-gray-300 mb-8">
                        Based on your assessment results, we've identified areas where you can improve. Start with a personalized study plan or take another assessment to track your progress.
                    </p>
                    
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <Link 
                            :href="route('learn.study-plan.index')"
                            class="inline-flex items-center justify-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-full transition-colors"
                        >
                            View Study Plan
                            <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </Link>
                        
                        <button 
                            @click="startNewAssessment"
                            class="inline-flex items-center justify-center px-6 py-3 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 text-gray-900 dark:text-white font-medium rounded-full border border-gray-300 dark:border-gray-600 transition-colors"
                        >
                            Take Another Assessment
                        </button>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Floating Action Button (Mobile) -->
        <div class="fixed bottom-6 right-6 sm:hidden">
            <button 
                @click="showActions = !showActions"
                class="w-14 h-14 bg-blue-600 hover:bg-blue-700 text-white rounded-full shadow-lg flex items-center justify-center transition-all"
                :class="{ 'rotate-45': showActions }"
            >
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
            </button>
            
            <!-- Action Menu -->
            <transition
                enter-active-class="transition ease-out duration-200"
                enter-from-class="opacity-0 translate-y-1"
                enter-to-class="opacity-100 translate-y-0"
                leave-active-class="transition ease-in duration-150"
                leave-from-class="opacity-100 translate-y-0"
                leave-to-class="opacity-0 translate-y-1"
            >
                <div v-if="showActions" class="absolute bottom-16 right-0 space-y-2">
                    <button 
                        @click="downloadReport"
                        class="flex items-center gap-3 px-4 py-3 bg-white dark:bg-gray-800 rounded-full shadow-md text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Download Report
                    </button>
                    <button 
                        @click="shareResults"
                        class="flex items-center gap-3 px-4 py-3 bg-white dark:bg-gray-800 rounded-full shadow-md text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m9.032 4.026a9.001 9.001 0 010-5.684m-9.032 4.026A9.001 9.001 0 015.641 14m3.043-4.026A9.001 9.001 0 015.641 10"></path>
                        </svg>
                        Share Results
                    </button>
                </div>
            </transition>
        </div>
    </div>
</template>

<script setup lang="ts">
import { Link, router } from '@inertiajs/vue3'

const props = defineProps({
    diagnostic: {
        type: Object,
        required: true
    },
    domainPerformance: {
        type: Array,
        default: () => []
    }
})

const showActions = ref(false)

const formatDate = (dateString) => {
    const date = new Date(dateString)
    return new Intl.DateTimeFormat('en-US', {
        weekday: 'long',
        month: 'long',
        day: 'numeric',
        year: 'numeric'
    }).format(date)
}

const formatDuration = (seconds) => {
    if (!seconds) return '—'
    const hours = Math.floor(seconds / 3600)
    const minutes = Math.floor((seconds % 3600) / 60)
    if (hours > 0) {
        return `${hours}h ${minutes}m`
    }
    return `${minutes} min`
}

const getScoreColor = (score) => {
    if (score >= 80) return 'text-green-600 dark:text-green-400'
    if (score >= 60) return 'text-yellow-600 dark:text-yellow-400'
    return 'text-red-600 dark:text-red-400'
}

const getProgressBarColor = (score) => {
    if (score >= 80) return 'bg-green-500'
    if (score >= 60) return 'bg-yellow-500'
    return 'bg-red-500'
}

const getDomainLevel = (score) => {
    if (score >= 90) return 'Expert'
    if (score >= 80) return 'Proficient'
    if (score >= 70) return 'Competent'
    if (score >= 60) return 'Developing'
    return 'Beginning'
}

const goBack = () => {
    router.visit(route('assessments.diagnostics.dashboard'))
}

const startNewAssessment = () => {
    router.visit(route('assessments.diagnostics.start'))
}

const downloadReport = () => {
    window.location.href = route('assessments.diagnostics.download', props.diagnostic.id)
}

const shareResults = () => {
    // Implementation for sharing results
    console.log('Share results')
}
</script>

<style scoped>
/* Smooth animations */
* {
    transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
}

/* Progress circle animation */
@keyframes progress-fill {
    from {
        stroke-dashoffset: 352;
    }
}

circle {
    animation: progress-fill 1s ease-out forwards;
}
</style>