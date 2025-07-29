<template>
    <AdminLayout>
        <div class="px-4 sm:px-6 lg:px-8 py-8">
            <!-- Header -->
            <div class="sm:flex sm:items-center">
                <div class="sm:flex-auto">
                    <nav class="flex mb-4" aria-label="Breadcrumb">
                        <ol role="list" class="flex items-center space-x-4">
                            <li>
                                <div class="flex">
                                    <Link :href="route('admin.diagnostics.assessments.index')" class="text-sm font-medium text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300">
                                        Assessments
                                    </Link>
                                </div>
                            </li>
                            <li>
                                <div class="flex items-center">
                                    <svg class="h-5 w-5 flex-shrink-0 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                                        <path d="M5.555 17.776l8-16 .894.448-8 16-.894-.448z" />
                                    </svg>
                                    <span class="ml-4 text-sm font-medium text-gray-900 dark:text-white">Assessment Details</span>
                                </div>
                            </li>
                        </ol>
                    </nav>
                    <h1 class="text-3xl font-semibold text-gray-900 dark:text-white">Assessment Details</h1>
                    <p class="mt-2 text-sm text-gray-700 dark:text-gray-300">
                        Detailed view of assessment results and performance metrics
                    </p>
                </div>
            </div>

            <!-- Assessment Overview -->
            <div class="mt-8 bg-white dark:bg-gray-800 shadow-sm rounded-lg overflow-hidden">
                <div class="px-4 py-5 sm:p-6">
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
                        <!-- User Info -->
                        <div>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">User</dt>
                            <dd class="mt-1">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <div class="h-10 w-10 rounded-full bg-gray-300 dark:bg-gray-600 flex items-center justify-center">
                                            <span class="text-sm font-medium text-gray-700 dark:text-gray-200">
                                                {{ (assessment.user?.name || 'Unknown').charAt(0).toUpperCase() }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900 dark:text-white">
                                            {{ assessment.user?.name || 'Unknown User' }}
                                        </div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400">
                                            {{ assessment.user?.email }}
                                        </div>
                                    </div>
                                </div>
                            </dd>
                        </div>

                        <!-- Status -->
                        <div>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Status</dt>
                            <dd class="mt-1">
                                <span
                                    :class="[
                                        assessment.status === 'completed'
                                            ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400'
                                            : assessment.status === 'in_progress'
                                            ? 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400'
                                            : 'bg-gray-100 text-gray-800 dark:bg-gray-900/30 dark:text-gray-400',
                                        'inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium capitalize'
                                    ]"
                                >
                                    {{ assessment.status.replace('_', ' ') }}
                                </span>
                            </dd>
                        </div>

                        <!-- Score -->
                        <div>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Score</dt>
                            <dd class="mt-1 text-2xl font-semibold text-gray-900 dark:text-white">
                                <span v-if="assessment.score !== null">
                                    {{ assessment.score }}%
                                </span>
                                <span v-else class="text-gray-500 dark:text-gray-400 text-base">-</span>
                            </dd>
                        </div>

                        <!-- Duration -->
                        <div>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Duration</dt>
                            <dd class="mt-1 text-2xl font-semibold text-gray-900 dark:text-white">
                                <span v-if="assessment.duration_minutes">
                                    {{ assessment.duration_minutes }} min
                                </span>
                                <span v-else class="text-gray-500 dark:text-gray-400 text-base">-</span>
                            </dd>
                        </div>
                    </div>

                    <!-- Assessment Meta -->
                    <div class="mt-6 border-t border-gray-200 dark:border-gray-700 pt-6">
                        <dl class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Phase</dt>
                                <dd class="mt-1 text-sm text-gray-900 dark:text-white">
                                    {{ assessment.phase?.name || 'Phase 1' }}
                                </dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Started At</dt>
                                <dd class="mt-1 text-sm text-gray-900 dark:text-white">
                                    {{ formatDate(assessment.created_at) }}
                                </dd>
                            </div>
                            <div v-if="assessment.completed_at">
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Completed At</dt>
                                <dd class="mt-1 text-sm text-gray-900 dark:text-white">
                                    {{ formatDate(assessment.completed_at) }}
                                </dd>
                            </div>
                            <div v-if="assessment.questions_answered">
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Questions Answered</dt>
                                <dd class="mt-1 text-sm text-gray-900 dark:text-white">
                                    {{ assessment.questions_answered }} / {{ assessment.total_questions || 'N/A' }}
                                </dd>
                            </div>
                        </dl>
                    </div>
                </div>
            </div>

            <!-- Domain Breakdown -->
            <div v-if="assessment.domain_scores && assessment.domain_scores.length > 0" class="mt-8 bg-white dark:bg-gray-800 shadow-sm rounded-lg overflow-hidden">
                <div class="px-4 py-5 sm:p-6">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Domain Performance</h3>
                    <div class="space-y-4">
                        <div v-for="domain in assessment.domain_scores" :key="domain.domain_name" class="flex items-center justify-between">
                            <div class="flex-1">
                                <div class="flex items-center justify-between mb-1">
                                    <span class="text-sm font-medium text-gray-900 dark:text-white">{{ domain.domain_name }}</span>
                                    <span class="text-sm text-gray-500 dark:text-gray-400">{{ domain.score }}%</span>
                                </div>
                                <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                                    <div 
                                        class="h-2 rounded-full"
                                        :class="getScoreColor(domain.score)"
                                        :style="{ width: domain.score + '%' }"
                                    ></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Raw Data -->
            <div class="mt-8 bg-white dark:bg-gray-800 shadow-sm rounded-lg overflow-hidden">
                <div class="px-4 py-5 sm:p-6">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Assessment Data</h3>
                    <div class="bg-gray-50 dark:bg-gray-900 rounded-lg p-4 overflow-x-auto">
                        <pre class="text-xs text-gray-600 dark:text-gray-400">{{ JSON.stringify(assessment, null, 2) }}</pre>
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>

<script setup lang="ts">
import { Link } from '@inertiajs/vue3'
import AdminLayout from '@/layouts/AdminLayout.vue'

defineProps({
    assessment: {
        type: Object,
        required: true
    }
})

const formatDate = (date) => {
    if (!date) return '-'
    return new Date(date).toLocaleDateString('en-US', {
        year: 'numeric',
        month: 'short',
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit',
    })
}

const getScoreColor = (score) => {
    if (score >= 80) return 'bg-green-500'
    if (score >= 60) return 'bg-yellow-500'
    return 'bg-red-500'
}
</script>