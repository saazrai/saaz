<template>
    <AdminLayout>
        <Head title="Assessment Details" />
        
        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <!-- Header -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                    <div class="p-6">
                        <div class="flex justify-between items-start">
                            <div>
                                <h1 class="text-2xl font-semibold text-gray-900 dark:text-gray-100">Assessment Details</h1>
                                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                                    Session ID: <code class="bg-gray-100 dark:bg-gray-700 px-2 py-1 rounded">{{ assessment.session_id }}</code>
                                </p>
                            </div>
                            <Link
                                :href="route('admin.sample-quiz.assessments.index')"
                                class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200"
                            >
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </Link>
                        </div>
                    </div>
                </div>

                <!-- Assessment Summary -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div :class="[
                                    'w-12 h-12 rounded-full flex items-center justify-center',
                                    assessment.status === 'completed' 
                                        ? 'bg-green-100 dark:bg-green-900' 
                                        : 'bg-yellow-100 dark:bg-yellow-900'
                                ]">
                                    <svg v-if="assessment.status === 'completed'" class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <svg v-else class="w-6 h-6 text-yellow-600 dark:text-yellow-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Status</p>
                                <p class="text-lg font-semibold text-gray-900 dark:text-gray-100 capitalize">{{ assessment.status }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900 rounded-full flex items-center justify-center">
                                    <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Score</p>
                                <p class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                                    {{ assessment.score || 0 }}%
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-purple-100 dark:bg-purple-900 rounded-full flex items-center justify-center">
                                    <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Questions</p>
                                <p class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                                    {{ assessment.responses_count }}/{{ assessment.total_questions }}
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-orange-100 dark:bg-orange-900 rounded-full flex items-center justify-center">
                                    <svg class="w-6 h-6 text-orange-600 dark:text-orange-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Duration</p>
                                <p class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                                    {{ assessment.completion_time_formatted || 'N/A' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Domain Performance -->
                <div v-if="domainStats.length > 0" class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6 mb-6">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Domain Performance</h2>
                    <div class="space-y-3">
                        <div v-for="domain in domainStats" :key="domain.name" class="flex items-center">
                            <div class="flex-1">
                                <div class="flex items-center justify-between mb-1">
                                    <span class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ domain.name }}</span>
                                    <span class="text-sm text-gray-600 dark:text-gray-400">
                                        {{ domain.correct }}/{{ domain.total }} ({{ domain.score }}%)
                                    </span>
                                </div>
                                <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2.5">
                                    <div 
                                        class="h-2.5 rounded-full"
                                        :class="[
                                            domain.score >= 80 ? 'bg-green-600' :
                                            domain.score >= 60 ? 'bg-yellow-600' :
                                            'bg-red-600'
                                        ]"
                                        :style="`width: ${domain.score}%`"
                                    ></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Assessment Info -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6 mb-6">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Assessment Information</h2>
                    <dl class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Started At</dt>
                            <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">
                                {{ new Date(assessment.started_at).toLocaleString() }}
                            </dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Completed At</dt>
                            <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">
                                {{ assessment.completed_at ? new Date(assessment.completed_at).toLocaleString() : 'Not completed' }}
                            </dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">IP Address</dt>
                            <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ assessment.ip_address }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">User Agent</dt>
                            <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100 truncate" :title="assessment.user_agent">
                                {{ assessment.user_agent }}
                            </dd>
                        </div>
                    </dl>
                </div>

                <!-- Responses -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                        <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Question Responses</h2>
                    </div>
                    <div class="divide-y divide-gray-200 dark:divide-gray-700">
                        <div v-for="response in responses" :key="response.id" class="p-6">
                            <div class="flex items-start justify-between mb-4">
                                <div class="flex-1">
                                    <div class="flex items-center gap-3 mb-2">
                                        <span class="text-sm font-medium text-gray-500 dark:text-gray-400">
                                            Q{{ response.question_sequence }}
                                        </span>
                                        <span :class="[
                                            'px-2 py-1 text-xs font-medium rounded-full',
                                            response.is_correct 
                                                ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' 
                                                : 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200'
                                        ]">
                                            {{ response.is_correct ? 'Correct' : 'Incorrect' }}
                                        </span>
                                        <span class="text-xs text-gray-500 dark:text-gray-400">
                                            {{ response.question_type }}
                                        </span>
                                        <span class="text-xs text-gray-500 dark:text-gray-400">
                                            {{ response.domain }}
                                        </span>
                                        <span class="text-xs text-gray-500 dark:text-gray-400">
                                            {{ response.difficulty }}
                                        </span>
                                    </div>
                                    <p class="text-gray-900 dark:text-gray-100 font-medium mb-3">
                                        {{ response.question_content }}
                                    </p>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <p class="text-sm font-medium text-gray-600 dark:text-gray-400 mb-1">User Answer:</p>
                                            <div class="text-sm text-gray-900 dark:text-gray-100">
                                                <span v-if="Array.isArray(response.user_answer)" class="block">
                                                    <span v-for="(answer, index) in response.user_answer" :key="index" class="block">
                                                        • {{ answer }}
                                                    </span>
                                                </span>
                                                <span v-else>{{ response.user_answer }}</span>
                                            </div>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-gray-600 dark:text-gray-400 mb-1">Correct Answer:</p>
                                            <div class="text-sm text-gray-900 dark:text-gray-100">
                                                <span v-if="Array.isArray(response.correct_answer)" class="block">
                                                    <span v-for="(answer, index) in response.correct_answer" :key="index" class="block">
                                                        • {{ answer }}
                                                    </span>
                                                </span>
                                                <span v-else>{{ response.correct_answer }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="ml-4 text-right">
                                    <p class="text-sm text-gray-500 dark:text-gray-400">
                                        {{ response.response_time_formatted || 'N/A' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>

<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3'
import AdminLayout from '@/layouts/AdminLayout.vue'

defineProps({
    assessment: Object,
    responses: Array,
    domainStats: Array,
})
</script>