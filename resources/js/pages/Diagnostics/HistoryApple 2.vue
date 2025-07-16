<template>
    <div class="min-h-screen bg-gray-50 dark:bg-gray-900">
        <!-- Header -->
        <header class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-xl border-b border-gray-200/50 dark:border-gray-700/50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <h1 class="text-3xl font-semibold text-gray-900 dark:text-white">
                    Assessments
                </h1>
                <p class="mt-2 text-gray-600 dark:text-gray-300">
                    Track your learning progress over time
                </p>
            </div>
        </header>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <!-- Primary Action -->
            <div class="mb-12">
                <div class="bg-gradient-to-r from-blue-600 to-indigo-600 rounded-3xl p-8 text-white">
                    <div class="max-w-3xl">
                        <h2 class="text-2xl font-semibold mb-3">
                            Start a New Assessment
                        </h2>
                        <p class="text-blue-100 mb-6">
                            Our adaptive assessment adjusts to your knowledge level, typically taking 30-60 minutes to complete.
                        </p>
                        <button 
                            @click="startNewAssessment"
                            class="inline-flex items-center px-6 py-3 bg-white text-blue-600 font-medium rounded-full hover:bg-blue-50 transition-colors"
                        >
                            Begin Assessment
                            <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Active Assessment (if any) -->
            <div v-if="activeAssessment" class="mb-8">
                <h2 class="text-lg font-medium text-gray-900 dark:text-white mb-4">
                    Continue Where You Left Off
                </h2>
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm p-6 border-2 border-orange-200 dark:border-orange-800">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <div class="flex items-center gap-3 mb-3">
                                <span class="px-3 py-1 bg-orange-100 dark:bg-orange-900/30 text-orange-700 dark:text-orange-300 text-xs font-medium rounded-full">
                                    In Progress
                                </span>
                                <span class="text-sm text-gray-500 dark:text-gray-400">
                                    Started {{ formatRelativeTime(activeAssessment.created_at) }}
                                </span>
                            </div>
                            <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">
                                {{ activeAssessment.mode === 'standard' ? 'Standard' : 'Quick' }} Assessment
                            </h3>
                            <div class="flex items-center gap-6 text-sm text-gray-600 dark:text-gray-400">
                                <span>Question {{ activeAssessment.current_question }} of {{ activeAssessment.total_questions }}</span>
                                <span>{{ Math.round((activeAssessment.current_question / activeAssessment.total_questions) * 100) }}% complete</span>
                            </div>
                        </div>
                        <button 
                            @click="continueAssessment"
                            class="px-4 py-2 bg-orange-600 hover:bg-orange-700 text-white font-medium rounded-full transition-colors text-sm"
                        >
                            Continue
                        </button>
                    </div>
                    <!-- Progress Bar -->
                    <div class="mt-4 w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2 overflow-hidden">
                        <div 
                            class="h-2 bg-orange-500 rounded-full transition-all"
                            :style="{ width: `${(activeAssessment.current_question / activeAssessment.total_questions) * 100}%` }"
                        ></div>
                    </div>
                </div>
            </div>

            <!-- Assessment History -->
            <div v-if="completedAssessments.length > 0">
                <h2 class="text-lg font-medium text-gray-900 dark:text-white mb-4">
                    Previous Assessments
                </h2>
                
                <!-- Assessment Cards -->
                <div class="space-y-4">
                    <div 
                        v-for="assessment in completedAssessments" 
                        :key="assessment.id"
                        @click="viewResults(assessment.id)"
                        class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm p-6 hover:shadow-md transition-all cursor-pointer group"
                    >
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <div class="flex items-center gap-3 mb-2">
                                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                                        Assessment #{{ assessment.id }}
                                    </h3>
                                    <span class="px-3 py-1 bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300 text-xs font-medium rounded-full">
                                        Completed
                                    </span>
                                </div>
                                <div class="flex items-center gap-6 text-sm text-gray-600 dark:text-gray-400">
                                    <span>{{ formatDate(assessment.created_at) }}</span>
                                    <span>{{ assessment.current_question }} questions</span>
                                    <span>{{ formatDuration(assessment.total_duration_seconds) }}</span>
                                </div>
                            </div>
                            
                            <!-- Score Display -->
                            <div class="text-right">
                                <div class="text-3xl font-semibold" :class="getScoreColor(assessment.score)">
                                    {{ assessment.score }}%
                                </div>
                                <div class="text-sm text-gray-500 dark:text-gray-400">
                                    Overall Score
                                </div>
                            </div>
                        </div>
                        
                        <!-- Quick Stats -->
                        <div class="grid grid-cols-3 gap-4 mt-6 pt-6 border-t border-gray-200 dark:border-gray-700">
                            <div>
                                <div class="text-2xl font-semibold text-gray-900 dark:text-white">
                                    {{ assessment.strongest_domain?.score || '—' }}%
                                </div>
                                <div class="text-xs text-gray-500 dark:text-gray-400">
                                    Strongest Domain
                                </div>
                                <div class="text-sm text-gray-700 dark:text-gray-300 truncate">
                                    {{ assessment.strongest_domain?.name || 'N/A' }}
                                </div>
                            </div>
                            <div>
                                <div class="text-2xl font-semibold text-gray-900 dark:text-white">
                                    {{ assessment.weakest_domain?.score || '—' }}%
                                </div>
                                <div class="text-xs text-gray-500 dark:text-gray-400">
                                    Needs Improvement
                                </div>
                                <div class="text-sm text-gray-700 dark:text-gray-300 truncate">
                                    {{ assessment.weakest_domain?.name || 'N/A' }}
                                </div>
                            </div>
                            <div>
                                <div class="text-2xl font-semibold text-gray-900 dark:text-white">
                                    {{ assessment.ability ? assessment.ability.toFixed(1) : '—' }}
                                </div>
                                <div class="text-xs text-gray-500 dark:text-gray-400">
                                    Ability Level
                                </div>
                                <div class="text-sm text-gray-700 dark:text-gray-300">
                                    IRT Score
                                </div>
                            </div>
                        </div>
                        
                        <!-- View Details Link -->
                        <div class="flex items-center justify-end mt-4 text-blue-600 dark:text-blue-400 group-hover:text-blue-700 dark:group-hover:text-blue-300">
                            <span class="text-sm font-medium">View Detailed Results</span>
                            <svg class="ml-1 w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </div>
                    </div>
                </div>
                
                <!-- Load More -->
                <div v-if="hasMoreAssessments" class="mt-8 text-center">
                    <button 
                        @click="loadMore"
                        class="px-6 py-3 text-gray-700 dark:text-gray-300 font-medium hover:text-gray-900 dark:hover:text-gray-100 transition-colors"
                    >
                        Show More
                    </button>
                </div>
            </div>

            <!-- Empty State -->
            <div v-else-if="!activeAssessment" class="text-center py-16">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-gray-100 dark:bg-gray-800 rounded-full mb-4">
                    <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-medium text-gray-900 dark:text-white mb-2">
                    No Assessments Yet
                </h3>
                <p class="text-gray-500 dark:text-gray-400 mb-8 max-w-md mx-auto">
                    Take your first diagnostic assessment to discover your strengths and identify areas for improvement.
                </p>
                <button 
                    @click="startNewAssessment"
                    class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-full transition-colors"
                >
                    Start Your First Assessment
                    <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import { router } from '@inertiajs/vue3'

const props = defineProps({
    activeAssessment: {
        type: Object,
        default: null
    },
    completedAssessments: {
        type: Array,
        default: () => []
    },
    hasMoreAssessments: {
        type: Boolean,
        default: false
    }
})

const formatDate = (dateString) => {
    const date = new Date(dateString)
    return new Intl.DateTimeFormat('en-US', {
        month: 'short',
        day: 'numeric',
        year: 'numeric'
    }).format(date)
}

const formatRelativeTime = (dateString) => {
    const date = new Date(dateString)
    const now = new Date()
    const diff = now - date
    const days = Math.floor(diff / (1000 * 60 * 60 * 24))
    const hours = Math.floor(diff / (1000 * 60 * 60))
    const minutes = Math.floor(diff / (1000 * 60))
    
    if (days > 0) return `${days} day${days > 1 ? 's' : ''} ago`
    if (hours > 0) return `${hours} hour${hours > 1 ? 's' : ''} ago`
    if (minutes > 0) return `${minutes} minute${minutes > 1 ? 's' : ''} ago`
    return 'just now'
}

const formatDuration = (seconds) => {
    if (!seconds) return '—'
    const hours = Math.floor(seconds / 3600)
    const minutes = Math.floor((seconds % 3600) / 60)
    if (hours > 0) {
        return `${hours}h ${minutes}m`
    }
    return `${minutes} minutes`
}

const getScoreColor = (score) => {
    if (score >= 80) return 'text-green-600 dark:text-green-400'
    if (score >= 60) return 'text-yellow-600 dark:text-yellow-400'
    return 'text-red-600 dark:text-red-400'
}

const startNewAssessment = () => {
    router.visit(route('assessments.diagnostics.start'))
}

const continueAssessment = () => {
    router.visit(route('assessments.diagnostics.show', props.activeAssessment.id))
}

const viewResults = (assessmentId) => {
    router.visit(route('assessments.diagnostics.results', assessmentId))
}

const loadMore = () => {
    // Implementation for loading more assessments
    console.log('Load more assessments')
}
</script>