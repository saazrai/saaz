<template>
    <AdminLayout>
        <Head title="Sample Quiz Assessments" />
        
        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <!-- Header -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h1 class="text-2xl font-semibold">Sample Quiz Assessments</h1>
                        <p class="text-gray-600 dark:text-gray-400 mt-1">
                            View and manage all sample quiz assessments
                        </p>
                    </div>
                </div>

                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm">
                        <div class="text-2xl font-bold text-blue-600">{{ stats.total_assessments }}</div>
                        <div class="text-gray-600 dark:text-gray-400">Total Assessments</div>
                    </div>
                    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm">
                        <div class="text-2xl font-bold text-green-600">{{ stats.completed_assessments }}</div>
                        <div class="text-gray-600 dark:text-gray-400">Completed</div>
                    </div>
                    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm">
                        <div class="text-2xl font-bold text-orange-600">{{ stats.in_progress_assessments }}</div>
                        <div class="text-gray-600 dark:text-gray-400">In Progress</div>
                    </div>
                    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm">
                        <div class="text-2xl font-bold text-purple-600">{{ stats.average_score }}%</div>
                        <div class="text-gray-600 dark:text-gray-400">Average Score</div>
                    </div>
                </div>

                <!-- Secondary Stats -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                    <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow-sm">
                        <div class="flex items-center justify-between">
                            <div>
                                <div class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ stats.today_assessments }}</div>
                                <div class="text-sm text-gray-600 dark:text-gray-400">Today</div>
                            </div>
                            <svg class="w-8 h-8 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                    </div>
                    <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow-sm">
                        <div class="flex items-center justify-between">
                            <div>
                                <div class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ stats.this_week_assessments }}</div>
                                <div class="text-sm text-gray-600 dark:text-gray-400">This Week</div>
                            </div>
                            <svg class="w-8 h-8 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                        </div>
                    </div>
                    <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow-sm">
                        <div class="flex items-center justify-between">
                            <div>
                                <div class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ stats.this_month_assessments }}</div>
                                <div class="text-sm text-gray-600 dark:text-gray-400">This Month</div>
                            </div>
                            <svg class="w-8 h-8 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Filters -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6 mb-6">
                    <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white mb-4">
                        Filters
                    </h3>
                    
                    <form @submit.prevent="applyFilters" class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-4">
                        <!-- Search -->
                        <div>
                            <Label for="search">Search</Label>
                            <Input
                                id="search"
                                v-model="form.search"
                                @input="debouncedSearch"
                                type="text"
                                placeholder="Session ID, IP..."
                                class="mt-1"
                            />
                        </div>
                        
                        <!-- Status -->
                        <div>
                            <Label for="status">Status</Label>
                            <Select v-model="form.status" @update:model-value="applyFilters">
                                <SelectTrigger id="status" class="mt-1 text-gray-900 dark:text-gray-100">
                                    <SelectValue placeholder="All Status" />
                                </SelectTrigger>
                                <SelectContent class="bg-white dark:bg-gray-800 bg-opacity-95 dark:bg-opacity-95">
                                    <SelectItem value="all">All Status</SelectItem>
                                    <SelectItem value="completed">Completed</SelectItem>
                                    <SelectItem value="in_progress">In Progress</SelectItem>
                                </SelectContent>
                            </Select>
                        </div>
                        
                        <!-- Date Range -->
                        <div>
                            <Label for="date_preset">Date Range</Label>
                            <div class="mt-1 space-y-2">
                                <!-- Preset Options -->
                                <Select v-model="form.date_preset" @update:model-value="handleDatePresetChange">
                                    <SelectTrigger id="date_preset" class="text-gray-900 dark:text-gray-100">
                                        <SelectValue placeholder="Select date range" />
                                    </SelectTrigger>
                                    <SelectContent class="bg-white dark:bg-gray-800 bg-opacity-95 dark:bg-opacity-95">
                                        <SelectItem value="all">All Time</SelectItem>
                                        <SelectItem value="today">Today</SelectItem>
                                        <SelectItem value="yesterday">Yesterday</SelectItem>
                                        <SelectItem value="last_7_days">Last 7 Days</SelectItem>
                                        <SelectItem value="last_30_days">Last 30 Days</SelectItem>
                                        <SelectItem value="this_month">This Month</SelectItem>
                                        <SelectItem value="last_month">Last Month</SelectItem>
                                        <SelectItem value="custom">Custom Range</SelectItem>
                                    </SelectContent>
                                </Select>
                                
                                <!-- Custom Date Inputs -->
                                <div v-if="form.date_preset === 'custom'" class="grid grid-cols-2 gap-2">
                                    <Input
                                        type="date"
                                        id="date_from"
                                        v-model="form.date_from"
                                        @change="applyFilters"
                                    />
                                    <Input
                                        type="date"
                                        id="date_to"
                                        v-model="form.date_to"
                                        @change="applyFilters"
                                    />
                                </div>
                            </div>
                        </div>
                        
                        <!-- Actions -->
                        <div class="flex items-end space-x-2">
                            <Button type="submit" class="bg-blue-600 hover:bg-blue-700">
                                Apply
                            </Button>
                            <Button
                                type="button"
                                variant="outline"
                                @click="resetFilters"
                                v-if="hasActiveFilters"
                            >
                                Clear
                            </Button>
                        </div>
                    </form>
                </div>

                <!-- Assessments Table -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        IP Address
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        Score
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        Questions
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        Duration
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        Date
                                    </th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                <tr 
                                    v-for="assessment in assessments.data" 
                                    :key="assessment.id" 
                                    @click="viewAssessment(assessment)"
                                    class="hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer transition-colors"
                                >
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                        {{ assessment.ip_address }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            :class="[
                                                'px-2 inline-flex text-xs leading-5 font-semibold rounded-full',
                                                assessment.status === 'completed' 
                                                    ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' 
                                                    : 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200'
                                            ]"
                                        >
                                            {{ assessment.status }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                        <span v-if="assessment.score !== null" class="font-medium">
                                            {{ assessment.score }}%
                                        </span>
                                        <span v-else class="text-gray-400">-</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                        {{ assessment.responses_count }}/{{ assessment.total_questions }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                        <span v-if="assessment.completion_time_formatted">
                                            {{ assessment.completion_time_formatted }}
                                        </span>
                                        <span v-else class="text-gray-400">-</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                        {{ assessment.created_at_formatted }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <button
                                            @click.stop="deleteAssessment(assessment)"
                                            class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300 px-2 py-1 hover:bg-red-50 dark:hover:bg-red-900/20 rounded transition-colors"
                                        >
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Empty State -->
                    <div v-if="assessments.data.length === 0" class="text-center py-12">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-gray-100">No assessments found</h3>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                            {{ hasActiveFilters ? 'Try adjusting your filters.' : 'No sample quiz assessments have been taken yet.' }}
                        </p>
                    </div>

                    <!-- Pagination -->
                    <div v-if="assessments.last_page > 1" class="bg-white dark:bg-gray-800 px-4 py-3 border-t border-gray-200 dark:border-gray-700 sm:px-6">
                        <div class="flex items-center justify-between">
                            <div class="flex-1 flex justify-between sm:hidden">
                                <Link
                                    v-if="assessments.current_page > 1"
                                    :href="assessments.prev_page_url"
                                    class="relative inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 text-sm font-medium rounded-md text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600"
                                >
                                    Previous
                                </Link>
                                <Link
                                    v-if="assessments.current_page < assessments.last_page"
                                    :href="assessments.next_page_url"
                                    class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 text-sm font-medium rounded-md text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600"
                                >
                                    Next
                                </Link>
                            </div>
                            <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                                <div>
                                    <p class="text-sm text-gray-700 dark:text-gray-300">
                                        Showing <span class="font-medium">{{ assessments.from }}</span> to
                                        <span class="font-medium">{{ assessments.to }}</span> of
                                        <span class="font-medium">{{ assessments.total }}</span> results
                                    </p>
                                </div>
                                <div>
                                    <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px">
                                        <template v-for="link in assessments.links" :key="link.label">
                                            <Link
                                                v-if="!link.label.includes('&')"
                                                :href="link.url || '#'"
                                                :class="[
                                                    'relative inline-flex items-center px-4 py-2 border text-sm font-medium',
                                                    link.active
                                                        ? 'z-10 bg-blue-50 dark:bg-blue-900 border-blue-500 text-blue-600 dark:text-blue-300'
                                                        : 'bg-white dark:bg-gray-700 border-gray-300 dark:border-gray-600 text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-600',
                                                    !link.url ? 'cursor-not-allowed opacity-50' : ''
                                                ]"
                                            >
                                                {{ link.label }}
                                            </Link>
                                            <span
                                                v-else
                                                :class="[
                                                    'relative inline-flex items-center px-4 py-2 border text-sm font-medium',
                                                    'bg-white dark:bg-gray-700 border-gray-300 dark:border-gray-600 text-gray-500 dark:text-gray-400',
                                                    'cursor-default'
                                                ]"
                                                v-html="link.label"
                                            />
                                        </template>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Delete Confirmation Modal -->
        <AlertDialog v-model:open="showDeleteModal">
            <AlertDialogContent>
                <AlertDialogHeader>
                    <AlertDialogTitle>Are you sure you want to delete this assessment?</AlertDialogTitle>
                    <AlertDialogDescription>
                        This action cannot be undone. This will permanently delete the assessment and all associated responses.
                    </AlertDialogDescription>
                </AlertDialogHeader>
                <AlertDialogFooter>
                    <AlertDialogCancel>Cancel</AlertDialogCancel>
                    <AlertDialogAction @click="confirmDelete" class="bg-red-600 hover:bg-red-700">
                        Delete
                    </AlertDialogAction>
                </AlertDialogFooter>
            </AlertDialogContent>
        </AlertDialog>
    </AdminLayout>
</template>

<script setup lang="ts">
import { ref, computed } from 'vue'
import { Head, router, Link } from '@inertiajs/vue3'
import AdminLayout from '@/layouts/AdminLayout.vue'
import debounce from 'lodash/debounce'
import {
    AlertDialog,
    AlertDialogAction,
    AlertDialogCancel,
    AlertDialogContent,
    AlertDialogDescription,
    AlertDialogFooter,
    AlertDialogHeader,
    AlertDialogTitle,
} from '@/components/shadcn/ui/alert-dialog'
import { Input } from '@/components/shadcn/ui/input'
import { Label } from '@/components/shadcn/ui/label'
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/shadcn/ui/select'
import { Button } from '@/components/shadcn/ui/button'

const props = defineProps({
    assessments: Object,
    stats: Object,
    filters: Object,
})

const form = ref({
    search: props.filters?.search || '',
    status: props.filters?.status || 'all', // Default to 'all' instead of empty string
    date_preset: props.filters?.date_preset || 'all',
    date_from: props.filters?.date_from || '',
    date_to: props.filters?.date_to || '',
})

const showDeleteModal = ref(false)
const assessmentToDelete = ref(null)

const hasActiveFilters = computed(() => {
    return form.value.search || (form.value.status && form.value.status !== 'all') || form.value.date_preset !== 'all' || form.value.date_from || form.value.date_to
})

const debouncedSearch = debounce(() => {
    applyFilters()
}, 300)

const applyFilters = () => {
    router.get(route('admin.sample-quiz.assessments.index'), {
        search: form.value.search || undefined,
        status: form.value.status !== 'all' ? form.value.status : undefined,
        date_preset: form.value.date_preset !== 'all' ? form.value.date_preset : undefined,
        date_from: form.value.date_from || undefined,
        date_to: form.value.date_to || undefined,
    }, {
        preserveState: true,
        preserveScroll: true,
    })
}

const resetFilters = () => {
    form.value = {
        search: '',
        status: 'all',
        date_preset: 'all',
        date_from: '',
        date_to: '',
    }
    applyFilters()
}

const handleDatePresetChange = (preset) => {
    const today = new Date()
    const formatDate = (date) => date.toISOString().split('T')[0]
    
    switch (preset) {
        case 'today':
            form.value.date_from = formatDate(today)
            form.value.date_to = formatDate(today)
            break
        case 'yesterday':
            const yesterday = new Date(today)
            yesterday.setDate(yesterday.getDate() - 1)
            form.value.date_from = formatDate(yesterday)
            form.value.date_to = formatDate(yesterday)
            break
        case 'last_7_days':
            const last7Days = new Date(today)
            last7Days.setDate(last7Days.getDate() - 7)
            form.value.date_from = formatDate(last7Days)
            form.value.date_to = formatDate(today)
            break
        case 'last_30_days':
            const last30Days = new Date(today)
            last30Days.setDate(last30Days.getDate() - 30)
            form.value.date_from = formatDate(last30Days)
            form.value.date_to = formatDate(today)
            break
        case 'this_month':
            const startOfMonth = new Date(today.getFullYear(), today.getMonth(), 1)
            form.value.date_from = formatDate(startOfMonth)
            form.value.date_to = formatDate(today)
            break
        case 'last_month':
            const lastMonth = new Date(today.getFullYear(), today.getMonth() - 1, 1)
            const endOfLastMonth = new Date(today.getFullYear(), today.getMonth(), 0)
            form.value.date_from = formatDate(lastMonth)
            form.value.date_to = formatDate(endOfLastMonth)
            break
        case 'custom':
            // Do nothing, user will select dates manually
            break
        case 'all':
            form.value.date_from = ''
            form.value.date_to = ''
            break
    }
    
    // Apply filters after date preset change (except for custom)
    if (preset !== 'custom') {
        applyFilters()
    }
}

const deleteAssessment = (assessment) => {
    assessmentToDelete.value = assessment
    showDeleteModal.value = true
}

const confirmDelete = () => {
    if (assessmentToDelete.value) {
        router.delete(route('admin.sample-quiz.assessments.destroy', assessmentToDelete.value.id), {
            preserveScroll: true,
            onFinish: () => {
                assessmentToDelete.value = null
            }
        })
    }
}

const viewAssessment = (assessment) => {
    router.visit(route('admin.sample-quiz.assessments.show', assessment.id))
}
</script>