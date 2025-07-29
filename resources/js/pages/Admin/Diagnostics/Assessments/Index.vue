<template>
    <AdminLayout>
        <div class="px-4 sm:px-6 lg:px-8 py-8">
            <!-- Header -->
            <div class="sm:flex sm:items-center">
                <div class="sm:flex-auto">
                    <h1 class="text-3xl font-semibold text-gray-900 dark:text-white">Diagnostic Assessments</h1>
                    <p class="mt-2 text-sm text-gray-700 dark:text-gray-300">
                        View and manage all diagnostic assessments taken by users
                    </p>
                </div>
                <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                    <button
                        v-if="selectedAssessments.length > 0"
                        @click="exportSelected"
                        class="inline-flex items-center justify-center rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                    >
                        <ArrowDownTrayIcon class="-ml-0.5 mr-1.5 h-5 w-5" aria-hidden="true" />
                        Export Selected ({{ selectedAssessments.length }})
                    </button>
                </div>
            </div>

            <!-- Filters -->
            <div class="mt-8 bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6">
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
                    <!-- Search -->
                    <div>
                        <Label for="search">Search User</Label>
                        <Input
                            type="text"
                            id="search"
                            v-model="filters.search"
                            @input="debouncedSearch"
                            placeholder="Name or email..."
                            class="mt-1"
                        />
                    </div>

                    <!-- Status -->
                    <div>
                        <Label for="status">Status</Label>
                        <Select v-model="filters.status" class="mt-1" @update:model-value="applyFilters">
                            <SelectTrigger id="status">
                                <SelectValue placeholder="All Statuses" />
                            </SelectTrigger>
                            <SelectContent class="bg-white dark:bg-gray-800 bg-opacity-95 dark:bg-opacity-95">
                                <SelectItem value="all">All Statuses</SelectItem>
                                <SelectItem 
                                    v-for="status in filterOptions.statuses" 
                                    :key="status.value" 
                                    :value="status.value"
                                >
                                    {{ status.label }}
                                </SelectItem>
                            </SelectContent>
                        </Select>
                    </div>

                    <!-- Phase -->
                    <div>
                        <Label for="phase">Phase</Label>
                        <Select v-model="filters.phase_id" class="mt-1" @update:model-value="applyFilters">
                            <SelectTrigger id="phase">
                                <SelectValue placeholder="All Phases" />
                            </SelectTrigger>
                            <SelectContent class="bg-white dark:bg-gray-800 bg-opacity-95 dark:bg-opacity-95">
                                <SelectItem value="all">All Phases</SelectItem>
                                <SelectItem 
                                    v-for="phase in filterOptions.phases" 
                                    :key="phase.id" 
                                    :value="String(phase.id)"
                                >
                                    {{ phase.name }}
                                </SelectItem>
                            </SelectContent>
                        </Select>
                    </div>

                    <!-- Date Range -->
                    <div>
                        <Label for="date_preset">Date Range</Label>
                        <div class="mt-1 space-y-2">
                            <!-- Preset Options -->
                            <Select v-model="filters.date_preset" class="" @update:model-value="handleDatePresetChange">
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
                            <div v-if="filters.date_preset === 'custom'" class="grid grid-cols-2 gap-2">
                                <Input
                                    type="date"
                                    id="date_from"
                                    v-model="filters.date_from"
                                    @change="applyFilters"
                                />
                                <Input
                                    type="date"
                                    id="date_to"
                                    v-model="filters.date_to"
                                    @change="applyFilters"
                                />
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Clear Filters -->
                <div v-if="hasActiveFilters" class="mt-4">
                    <button
                        @click="clearFilters"
                        class="text-sm text-indigo-600 hover:text-indigo-500 dark:text-indigo-400 dark:hover:text-indigo-300"
                    >
                        Clear all filters
                    </button>
                </div>
            </div>

            <!-- Assessments Table -->
            <div class="mt-8 bg-white dark:bg-gray-800 shadow-sm rounded-lg overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-900">
                        <tr>
                            <th scope="col" class="relative w-12 px-6 sm:w-16 sm:px-8">
                                <input
                                    type="checkbox"
                                    class="absolute left-4 top-1/2 -mt-2 h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 sm:left-6"
                                    :checked="selectedAssessments.length === assessments.data.length"
                                    @change="toggleAll"
                                />
                            </th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 dark:text-white">
                                User
                            </th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 dark:text-white">
                                Status
                            </th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 dark:text-white">
                                Score
                            </th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 dark:text-white">
                                Phase
                            </th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 dark:text-white">
                                Duration
                            </th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 dark:text-white">
                                Started
                            </th>
                            <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                <span class="sr-only">Actions</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700 bg-white dark:bg-gray-800">
                        <tr v-for="assessment in assessments.data" :key="assessment.id">
                            <td class="relative w-12 px-6 sm:w-16 sm:px-8">
                                <input
                                    type="checkbox"
                                    class="absolute left-4 top-1/2 -mt-2 h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 sm:left-6"
                                    :value="assessment.id"
                                    v-model="selectedAssessments"
                                />
                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900 dark:text-white">
                                <div class="flex items-center">
                                    <div>
                                        <div class="font-medium">{{ assessment.user?.name || 'Unknown User' }}</div>
                                        <div class="text-gray-500 dark:text-gray-400">{{ assessment.user?.email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm">
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
                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900 dark:text-white">
                                <span v-if="assessment.score !== null">
                                    {{ assessment.score }}%
                                </span>
                                <span v-else class="text-gray-500 dark:text-gray-400">-</span>
                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900 dark:text-white">
                                {{ assessment.phase?.name || 'Phase 1' }}
                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900 dark:text-white">
                                <span v-if="assessment.duration_minutes">
                                    {{ assessment.duration_minutes }} min
                                </span>
                                <span v-else class="text-gray-500 dark:text-gray-400">-</span>
                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 dark:text-gray-400">
                                {{ formatDate(assessment.created_at) }}
                            </td>
                            <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                <Link
                                    :href="route('admin.diagnostics.assessments.show', assessment.id)"
                                    class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300"
                                >
                                    View
                                </Link>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <!-- Empty State -->
                <div v-if="assessments.data.length === 0" class="text-center py-12">
                    <p class="text-sm text-gray-500 dark:text-gray-400">No assessments found.</p>
                </div>

                <!-- Pagination -->
                <div v-if="assessments.data.length > 0" class="bg-white dark:bg-gray-800 px-4 py-3 border-t border-gray-200 dark:border-gray-700 sm:px-6">
                    <div class="flex items-center justify-between">
                        <div class="flex-1 flex justify-between sm:hidden">
                            <Link
                                v-if="assessments.prev_page_url"
                                :href="assessments.prev_page_url"
                                class="relative inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 text-sm font-medium rounded-md text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600"
                            >
                                Previous
                            </Link>
                            <Link
                                v-if="assessments.next_page_url"
                                :href="assessments.next_page_url"
                                class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 text-sm font-medium rounded-md text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600"
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
                                <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                                    <Link
                                        v-for="link in assessments.links"
                                        :key="link.label"
                                        :href="link.url || '#'"
                                        :class="[
                                            link.active
                                                ? 'z-10 bg-indigo-50 dark:bg-indigo-900/30 border-indigo-500 text-indigo-600 dark:text-indigo-400'
                                                : 'bg-white dark:bg-gray-800 border-gray-300 dark:border-gray-600 text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700',
                                            link.url ? '' : 'cursor-not-allowed opacity-50',
                                            'relative inline-flex items-center px-4 py-2 border text-sm font-medium'
                                        ]"
                                    >
                                        {{ link.label.replace(/&laquo;|&raquo;/g, match => match === '&laquo;' ? '←' : '→') }}
                                    </Link>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Export Modal -->
        <TransitionRoot as="template" :show="showExportModal">
            <Dialog as="div" class="relative z-10" @close="showExportModal = false">
                <TransitionChild
                    as="template"
                    enter="ease-out duration-300"
                    enter-from="opacity-0"
                    enter-to="opacity-100"
                    leave="ease-in duration-200"
                    leave-from="opacity-100"
                    leave-to="opacity-0"
                >
                    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" />
                </TransitionChild>

                <div class="fixed inset-0 z-10 overflow-y-auto">
                    <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                        <TransitionChild
                            as="template"
                            enter="ease-out duration-300"
                            enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                            enter-to="opacity-100 translate-y-0 sm:scale-100"
                            leave="ease-in duration-200"
                            leave-from="opacity-100 translate-y-0 sm:scale-100"
                            leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                        >
                            <DialogPanel class="relative transform overflow-hidden rounded-lg bg-white dark:bg-gray-800 px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-sm sm:p-6">
                                <div>
                                    <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-green-100 dark:bg-green-900/30">
                                        <ArrowDownTrayIcon class="h-6 w-6 text-green-600 dark:text-green-400" aria-hidden="true" />
                                    </div>
                                    <div class="mt-3 text-center sm:mt-5">
                                        <DialogTitle as="h3" class="text-base font-semibold leading-6 text-gray-900 dark:text-white">
                                            Export Assessments
                                        </DialogTitle>
                                        <div class="mt-2">
                                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                                Choose the format for exporting {{ selectedAssessments.length }} selected assessments.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-5 sm:mt-6 sm:grid sm:grid-flow-row-dense sm:grid-cols-2 sm:gap-3">
                                    <button
                                        type="button"
                                        class="inline-flex w-full justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 sm:col-start-2"
                                        @click="exportData('csv')"
                                    >
                                        Export as CSV
                                    </button>
                                    <button
                                        type="button"
                                        class="mt-3 inline-flex w-full justify-center rounded-md bg-white dark:bg-gray-700 px-3 py-2 text-sm font-semibold text-gray-900 dark:text-white shadow-sm ring-1 ring-inset ring-gray-300 dark:ring-gray-600 hover:bg-gray-50 dark:hover:bg-gray-600 sm:col-start-1 sm:mt-0"
                                        @click="exportData('json')"
                                    >
                                        Export as JSON
                                    </button>
                                </div>
                            </DialogPanel>
                        </TransitionChild>
                    </div>
                </div>
            </Dialog>
        </TransitionRoot>
    </AdminLayout>
</template>

<script setup lang="ts">
import { ref, computed } from 'vue';
import { Link, router } from '@inertiajs/vue3';
import AdminLayout from '@/layouts/AdminLayout.vue';
import { ArrowDownTrayIcon } from '@heroicons/vue/24/outline';
import { Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot } from '@headlessui/vue';
import { debounce } from 'lodash';
import { Input } from '@/components/shadcn/ui/input';
import { Label } from '@/components/shadcn/ui/label';
import {
  Select,
  SelectContent,
  SelectItem,
  SelectTrigger,
  SelectValue,
} from '@/components/shadcn/ui/select';

const props = defineProps({
    assessments: Object,
    filters: Object,
    filterOptions: Object,
});

const filters = ref({
    search: props.filters.search || '',
    status: props.filters.status || 'all',
    phase_id: props.filters.phase_id ? String(props.filters.phase_id) : 'all',
    date_from: props.filters.date_from || '',
    date_to: props.filters.date_to || '',
    date_preset: props.filters.date_preset || 'all',
});

const selectedAssessments = ref([]);
const showExportModal = ref(false);

const hasActiveFilters = computed(() => {
    return filters.value.search || 
           (filters.value.status && filters.value.status !== 'all') || 
           (filters.value.phase_id && filters.value.phase_id !== 'all') || 
           filters.value.date_from || 
           filters.value.date_to || 
           (filters.value.date_preset && filters.value.date_preset !== 'all');
});

const formatDate = (date) => {
    if (!date) return '-';
    return new Date(date).toLocaleDateString('en-US', {
        year: 'numeric',
        month: 'short',
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit',
    });
};

const applyFilters = () => {
    // Convert 'all' values back to empty strings for the backend
    const filterData = {
        search: filters.value.search,
        status: filters.value.status === 'all' ? '' : filters.value.status,
        phase_id: filters.value.phase_id === 'all' ? '' : filters.value.phase_id,
        date_from: filters.value.date_from,
        date_to: filters.value.date_to,
        date_preset: filters.value.date_preset === 'all' ? '' : filters.value.date_preset,
    };
    
    router.get(route('admin.diagnostics.assessments.index'), filterData, {
        preserveState: true,
        preserveScroll: true,
    });
};

const debouncedSearch = debounce(applyFilters, 300);

const clearFilters = () => {
    filters.value = {
        search: '',
        status: 'all',
        phase_id: 'all',
        date_from: '',
        date_to: '',
        date_preset: 'all',
    };
    applyFilters();
};

const handleDatePresetChange = (preset) => {
    const today = new Date();
    const formatDate = (date) => date.toISOString().split('T')[0];
    
    switch (preset) {
        case 'today':
            filters.value.date_from = formatDate(today);
            filters.value.date_to = formatDate(today);
            break;
        case 'yesterday':
            const yesterday = new Date(today);
            yesterday.setDate(yesterday.getDate() - 1);
            filters.value.date_from = formatDate(yesterday);
            filters.value.date_to = formatDate(yesterday);
            break;
        case 'last_7_days':
            const last7Days = new Date(today);
            last7Days.setDate(last7Days.getDate() - 7);
            filters.value.date_from = formatDate(last7Days);
            filters.value.date_to = formatDate(today);
            break;
        case 'last_30_days':
            const last30Days = new Date(today);
            last30Days.setDate(last30Days.getDate() - 30);
            filters.value.date_from = formatDate(last30Days);
            filters.value.date_to = formatDate(today);
            break;
        case 'this_month':
            const thisMonthStart = new Date(today.getFullYear(), today.getMonth(), 1);
            filters.value.date_from = formatDate(thisMonthStart);
            filters.value.date_to = formatDate(today);
            break;
        case 'last_month':
            const lastMonthStart = new Date(today.getFullYear(), today.getMonth() - 1, 1);
            const lastMonthEnd = new Date(today.getFullYear(), today.getMonth(), 0);
            filters.value.date_from = formatDate(lastMonthStart);
            filters.value.date_to = formatDate(lastMonthEnd);
            break;
        case 'custom':
            // Keep existing dates for custom range
            break;
        case 'all':
        default:
            filters.value.date_from = '';
            filters.value.date_to = '';
            break;
    }
    
    if (preset !== 'custom') {
        applyFilters();
    }
};

const toggleAll = (event) => {
    if (event.target.checked) {
        selectedAssessments.value = props.assessments.data.map(a => a.id);
    } else {
        selectedAssessments.value = [];
    }
};

const exportSelected = () => {
    if (selectedAssessments.value.length > 0) {
        showExportModal.value = true;
    }
};

const exportData = (format) => {
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = route('admin.diagnostics.assessments.export');
    
    // CSRF Token
    const csrfInput = document.createElement('input');
    csrfInput.type = 'hidden';
    csrfInput.name = '_token';
    csrfInput.value = document.querySelector('meta[name="csrf-token"]').content;
    form.appendChild(csrfInput);
    
    // Format
    const formatInput = document.createElement('input');
    formatInput.type = 'hidden';
    formatInput.name = 'format';
    formatInput.value = format;
    form.appendChild(formatInput);
    
    // Selected IDs
    selectedAssessments.value.forEach(id => {
        const idInput = document.createElement('input');
        idInput.type = 'hidden';
        idInput.name = 'assessment_ids[]';
        idInput.value = id;
        form.appendChild(idInput);
    });
    
    document.body.appendChild(form);
    form.submit();
    document.body.removeChild(form);
    
    showExportModal.value = false;
};
</script>