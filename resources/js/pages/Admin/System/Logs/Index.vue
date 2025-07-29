<template>
    <AdminLayout>
        <div class="space-y-6">
            <!-- Header Section -->
            <div class="bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-gray-800 dark:to-gray-700 rounded-xl p-6 border border-blue-100 dark:border-gray-600">
                <div class="flex items-center space-x-4">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 rounded-lg bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center shadow-lg">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">System Logs</h1>
                        <p class="text-gray-600 dark:text-gray-300 mt-1">Monitor application logs and security events</p>
                    </div>
                </div>
            </div>

            <!-- Controls -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                <div class="flex flex-col sm:flex-row gap-4">
                    <!-- File Selection -->
                    <div class="flex-1">
                        <Label for="log_file">Log File</Label>
                        <Select v-model="selectedFile" @update:model-value="loadLogs">
                            <SelectTrigger id="log_file" class="mt-1">
                                <SelectValue placeholder="Select log file" />
                            </SelectTrigger>
                            <SelectContent class="bg-white dark:bg-gray-800 bg-opacity-95 dark:bg-opacity-95">
                                <SelectItem v-for="file in logFiles" :key="file.name" :value="file.name">
                                    {{ file.name }} ({{ file.size }}) - {{ file.modified }}
                                </SelectItem>
                            </SelectContent>
                        </Select>
                    </div>

                    <!-- Date Range -->
                    <div class="flex-1">
                        <Label for="date_preset">Date Range</Label>
                        <div class="mt-1 space-y-2">
                            <!-- Preset Options -->
                            <Select v-model="datePreset" @update:model-value="handleDatePresetChange">
                                <SelectTrigger id="date_preset">
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
                            <div v-if="datePreset === 'custom'" class="grid grid-cols-2 gap-2">
                                <Input
                                    type="date"
                                    id="date_from"
                                    v-model="dateFrom"
                                    @change="loadLogs"
                                />
                                <Input
                                    type="date"
                                    id="date_to"
                                    v-model="dateTo"
                                    @change="loadLogs"
                                />
                            </div>
                        </div>
                    </div>

                    <!-- Refresh Button -->
                    <div class="flex items-end">
                        <Button 
                            @click="loadLogs" 
                            :disabled="loading"
                            class="flex items-center space-x-2"
                        >
                            <svg v-if="loading" class="animate-spin w-4 h-4" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            <svg v-else class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                            </svg>
                            <span>{{ loading ? 'Loading...' : 'Refresh' }}</span>
                        </Button>
                    </div>
                </div>
            </div>

            <!-- Log Entries -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">
                <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Log Entries ({{ entries.length }} entries shown)
                    </h2>
                </div>

                <div class="divide-y divide-gray-200 dark:divide-gray-700">
                    <div v-if="entries.length === 0" class="p-8 text-center">
                        <svg class="w-12 h-12 text-gray-400 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <p class="text-gray-500 dark:text-gray-400">No log entries found</p>
                    </div>

                    <div 
                        v-for="(entry, index) in entries" 
                        :key="index"
                        class="p-4 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-150"
                    >
                        <div class="flex items-start space-x-3">
                            <!-- Level Badge -->
                            <div class="flex-shrink-0 mt-1">
                                <span 
                                    :class="getLevelBadgeClass(entry.level)"
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium"
                                >
                                    {{ entry.level.toUpperCase() }}
                                </span>
                            </div>

                            <!-- Content -->
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center justify-between mb-1">
                                    <p class="text-sm font-medium text-gray-900 dark:text-white">
                                        {{ entry.message }}
                                    </p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 whitespace-nowrap ml-2">
                                        {{ entry.timestamp }}
                                    </p>
                                </div>

                                <!-- Context Information -->
                                <div v-if="Object.keys(entry.context).length > 0" class="mt-2">
                                    <details class="group">
                                        <summary class="cursor-pointer text-xs text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 select-none">
                                            Show Context ({{ Object.keys(entry.context).length }} items)
                                        </summary>
                                        <div class="mt-2 p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                            <pre class="text-xs text-gray-800 dark:text-gray-200 overflow-x-auto">{{ JSON.stringify(entry.context, null, 2) }}</pre>
                                        </div>
                                    </details>
                                </div>

                                <!-- Environment and Level Info -->
                                <div class="flex items-center space-x-4 mt-1 text-xs text-gray-500 dark:text-gray-400">
                                    <span class="inline-flex items-center">
                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                                        </svg>
                                        {{ entry.environment }}
                                    </span>
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
import { ref, computed, onMounted } from 'vue'
import { router } from '@inertiajs/vue3'
import AdminLayout from '@/layouts/AdminLayout.vue'
import { Input } from '@/components/shadcn/ui/input'
import { Label } from '@/components/shadcn/ui/label'
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/shadcn/ui/select'
import { Button } from '@/components/shadcn/ui/button'

const props = defineProps({
    logFiles: Array,
    selectedFile: String,
    selectedDate: String,
    entries: Array,
    filters: Object,
})

const loading = ref(false)
const selectedFile = ref(props.selectedFile)
const selectedDate = ref(props.selectedDate)
const datePreset = ref(props.filters?.date_preset || 'all')
const dateFrom = ref(props.filters?.date_from || '')
const dateTo = ref(props.filters?.date_to || '')

const isDatedLog = computed(() => {
    return selectedFile.value && !selectedFile.value.includes('-') && selectedFile.value !== 'security.log'
})

const loadLogs = () => {
    loading.value = true
    
    const params = {
        file: selectedFile.value,
        date_preset: datePreset.value === 'all' ? '' : datePreset.value,
        date_from: dateFrom.value,
        date_to: dateTo.value,
    }
    
    if (selectedDate.value && isDatedLog.value) {
        params.date = selectedDate.value
    }
    
    router.get(route('admin.system.logs.index'), params, {
        preserveState: true,
        preserveScroll: true,
        onFinish: () => {
            loading.value = false
        }
    })
}

const handleDatePresetChange = (preset) => {
    const today = new Date();
    const formatDate = (date) => date.toISOString().split('T')[0];
    
    switch (preset) {
        case 'today':
            dateFrom.value = formatDate(today);
            dateTo.value = formatDate(today);
            break;
        case 'yesterday':
            const yesterday = new Date(today);
            yesterday.setDate(yesterday.getDate() - 1);
            dateFrom.value = formatDate(yesterday);
            dateTo.value = formatDate(yesterday);
            break;
        case 'last_7_days':
            const last7Days = new Date(today);
            last7Days.setDate(last7Days.getDate() - 7);
            dateFrom.value = formatDate(last7Days);
            dateTo.value = formatDate(today);
            break;
        case 'last_30_days':
            const last30Days = new Date(today);
            last30Days.setDate(last30Days.getDate() - 30);
            dateFrom.value = formatDate(last30Days);
            dateTo.value = formatDate(today);
            break;
        case 'this_month':
            const thisMonthStart = new Date(today.getFullYear(), today.getMonth(), 1);
            dateFrom.value = formatDate(thisMonthStart);
            dateTo.value = formatDate(today);
            break;
        case 'last_month':
            const lastMonthStart = new Date(today.getFullYear(), today.getMonth() - 1, 1);
            const lastMonthEnd = new Date(today.getFullYear(), today.getMonth(), 0);
            dateFrom.value = formatDate(lastMonthStart);
            dateTo.value = formatDate(lastMonthEnd);
            break;
        case 'custom':
            // Keep existing dates for custom range
            break;
        case 'all':
        default:
            dateFrom.value = '';
            dateTo.value = '';
            break;
    }
    
    if (preset !== 'custom') {
        loadLogs();
    }
}

const getLevelBadgeClass = (level) => {
    const classes = {
        emergency: 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200',
        alert: 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200',
        critical: 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200',
        error: 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200',
        warning: 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200',
        notice: 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200',
        info: 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200',
        debug: 'bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-200',
    }
    
    return classes[level] || classes.info
}

onMounted(() => {
    // Set default date to today for dated logs
    if (isDatedLog.value && !selectedDate.value) {
        selectedDate.value = new Date().toISOString().split('T')[0]
    }
})
</script>