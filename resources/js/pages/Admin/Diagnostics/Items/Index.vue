<template>
    <AdminLayout>
        <div class="px-4 sm:px-6 lg:px-8 py-8">
            <!-- Header -->
            <div class="sm:flex sm:items-center">
                <div class="sm:flex-auto">
                    <h1 class="text-3xl font-semibold text-gray-900 dark:text-white">Diagnostic Items</h1>
                    <p class="mt-2 text-sm text-gray-700 dark:text-gray-300">
                        Manage diagnostic assessment questions and items
                    </p>
                </div>
                <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none space-x-3">
                    <button
                        v-if="selectedItems.length > 0"
                        @click="showBulkModal = true"
                        class="inline-flex items-center justify-center rounded-md bg-gray-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-gray-500"
                    >
                        Bulk Actions ({{ selectedItems.length }})
                    </button>
                </div>
            </div>

            <!-- Filters -->
            <div class="mt-8 bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6">
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-6">
                    <!-- Search -->
                    <div>
                        <Label for="search">Search</Label>
                        <Input
                            type="text"
                            id="search"
                            v-model="filters.search"
                            @input="debouncedSearch"
                            placeholder="Question content..."
                            class="mt-1 h-10"
                        />
                    </div>

                    <!-- Domain -->
                    <div>
                        <Label for="domain">Domain</Label>
                        <Select v-model="filters.domain_id" @update:model-value="applyFilters">
                            <SelectTrigger id="domain" class="mt-1 text-gray-900 dark:text-gray-100">
                                <SelectValue placeholder="All Domains" />
                            </SelectTrigger>
                            <SelectContent class="bg-white dark:bg-gray-800">
                                <SelectItem value="all" class="text-gray-900 dark:text-gray-100">All Domains</SelectItem>
                                <SelectItem 
                                    v-for="domain in filterOptions.domains" 
                                    :key="domain.id" 
                                    :value="String(domain.id)"
                                    class="text-gray-900 dark:text-gray-100"
                                >
                                    {{ domain.name }}
                                </SelectItem>
                            </SelectContent>
                        </Select>
                    </div>

                    <!-- Type -->
                    <div>
                        <Label for="type">Type</Label>
                        <Select v-model="filters.type_id" @update:model-value="applyFilters">
                            <SelectTrigger id="type" class="mt-1 text-gray-900 dark:text-gray-100">
                                <SelectValue placeholder="All Types" />
                            </SelectTrigger>
                            <SelectContent class="bg-white dark:bg-gray-800">
                                <SelectItem value="all" class="text-gray-900 dark:text-gray-100">All Types</SelectItem>
                                <SelectItem 
                                    v-for="type in filterOptions.types" 
                                    :key="type.id" 
                                    :value="String(type.id)"
                                    class="text-gray-900 dark:text-gray-100"
                                >
                                    {{ type.code }} - {{ type.name }}
                                </SelectItem>
                            </SelectContent>
                        </Select>
                    </div>

                    <!-- Difficulty -->
                    <div>
                        <Label for="difficulty">Difficulty</Label>
                        <Select v-model="filters.difficulty_level" @update:model-value="applyFilters">
                            <SelectTrigger id="difficulty" class="mt-1 text-gray-900 dark:text-gray-100">
                                <SelectValue placeholder="All Difficulties" />
                            </SelectTrigger>
                            <SelectContent class="bg-white dark:bg-gray-800">
                                <SelectItem value="all" class="text-gray-900 dark:text-gray-100">All Difficulties</SelectItem>
                                <SelectItem 
                                    v-for="level in filterOptions.difficultyLevels" 
                                    :key="level.value" 
                                    :value="String(level.value)"
                                    class="text-gray-900 dark:text-gray-100"
                                >
                                    {{ level.label }}
                                </SelectItem>
                            </SelectContent>
                        </Select>
                    </div>

                    <!-- Bloom Level -->
                    <div>
                        <Label for="bloom">Bloom Level</Label>
                        <Select v-model="filters.bloom_level" @update:model-value="applyFilters">
                            <SelectTrigger id="bloom" class="mt-1 text-gray-900 dark:text-gray-100">
                                <SelectValue placeholder="All Bloom Levels" />
                            </SelectTrigger>
                            <SelectContent class="bg-white dark:bg-gray-800">
                                <SelectItem value="all" class="text-gray-900 dark:text-gray-100">All Bloom Levels</SelectItem>
                                <SelectItem 
                                    v-for="level in filterOptions.bloomLevels" 
                                    :key="level.value" 
                                    :value="String(level.value)"
                                    class="text-gray-900 dark:text-gray-100"
                                >
                                    {{ level.label }}
                                </SelectItem>
                            </SelectContent>
                        </Select>
                    </div>

                    <!-- Status -->
                    <div>
                        <Label for="status">Status</Label>
                        <Select v-model="filters.status" @update:model-value="applyFilters">
                            <SelectTrigger id="status" class="mt-1 text-gray-900 dark:text-gray-100">
                                <SelectValue placeholder="All Statuses" />
                            </SelectTrigger>
                            <SelectContent class="bg-white dark:bg-gray-800">
                                <SelectItem value="all" class="text-gray-900 dark:text-gray-100">All Statuses</SelectItem>
                                <SelectItem 
                                    v-for="status in filterOptions.statuses" 
                                    :key="status.value" 
                                    :value="status.value"
                                    class="text-gray-900 dark:text-gray-100"
                                >
                                    {{ status.label }}
                                </SelectItem>
                            </SelectContent>
                        </Select>
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

            <!-- Items Table -->
            <div class="mt-8 bg-white dark:bg-gray-800 shadow-sm rounded-lg overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-900">
                        <tr>
                            <th scope="col" class="relative w-12 px-6 sm:w-16 sm:px-8">
                                <input
                                    type="checkbox"
                                    class="absolute left-4 top-1/2 -mt-2 h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 sm:left-6"
                                    :checked="selectedItems.length === items.data.length"
                                    @change="toggleAll"
                                />
                            </th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 dark:text-white">
                                ID
                            </th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 dark:text-white">
                                Question
                            </th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 dark:text-white">
                                Domain/Topic
                            </th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 dark:text-white">
                                Type
                            </th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 dark:text-white">
                                Difficulty
                            </th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 dark:text-white">
                                Status
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700 bg-white dark:bg-gray-800">
                        <tr 
                            v-for="item in items.data" 
                            :key="item.id" 
                            class="hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer"
                            @click="navigateToItem(item.id)"
                        >
                            <td class="relative w-12 px-6 sm:w-16 sm:px-8" @click.stop>
                                <input
                                    type="checkbox"
                                    class="absolute left-4 top-1/2 -mt-2 h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 sm:left-6"
                                    :value="item.id"
                                    v-model="selectedItems"
                                />
                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900 dark:text-white">
                                <span class="font-mono text-xs bg-gray-100 dark:bg-gray-700 px-2 py-1 rounded">
                                    {{ item.id }}
                                </span>
                            </td>
                            <td class="px-3 py-4 text-sm text-gray-900 dark:text-white">
                                <div class="max-w-xs">
                                    <div class="font-medium truncate" :title="item.content">
                                        {{ truncateText(item.content, 80) }}
                                    </div>
                                    <div class="text-gray-500 dark:text-gray-400 text-xs mt-1">
                                        {{ item.dimension }}
                                    </div>
                                </div>
                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900 dark:text-white">
                                <div>
                                    <div class="font-medium">{{ item.subtopic?.topic?.domain?.name }}</div>
                                    <div class="text-gray-500 dark:text-gray-400 text-xs">
                                        {{ item.subtopic?.topic?.name }} > {{ item.subtopic?.name }}
                                    </div>
                                </div>
                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900 dark:text-white">
                                <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400">
                                    {{ item.type?.code || 'UNK' }}
                                </span>
                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900 dark:text-white">
                                <div class="flex items-center space-x-2">
                                    <span class="text-sm">{{ getDifficultyLabel(item.difficulty_level) }}</span>
                                    <span class="text-xs text-gray-500 dark:text-gray-400">/ {{ getBloomLabel(item.bloom_level) }}</span>
                                </div>
                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm">
                                <span
                                    :class="[
                                        item.status === 'published'
                                            ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400'
                                            : item.status === 'draft'
                                            ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400'
                                            : 'bg-gray-100 text-gray-800 dark:bg-gray-900/30 dark:text-gray-400',
                                        'inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium capitalize'
                                    ]"
                                >
                                    {{ item.status }}
                                </span>
                            </td>
                        </tr>
                    </tbody>
                    </table>
                </div>

                <!-- Empty State -->
                <div v-if="items.data.length === 0" class="text-center py-12">
                    <div class="mx-auto h-12 w-12 text-gray-400">
                        <QuestionMarkCircleIcon class="h-12 w-12" />
                    </div>
                    <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">No questions found</h3>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Get started by creating a new question.</p>
                    <div class="mt-6">
                    </div>
                </div>

                <!-- Pagination -->
                <div v-if="items.data.length > 0" class="bg-white dark:bg-gray-800 px-4 py-3 border-t border-gray-200 dark:border-gray-700 sm:px-6">
                    <div class="flex items-center justify-between">
                        <div class="flex-1 flex justify-between sm:hidden">
                            <Link
                                v-if="items.prev_page_url"
                                :href="items.prev_page_url"
                                class="relative inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 text-sm font-medium rounded-md text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600"
                            >
                                Previous
                            </Link>
                            <Link
                                v-if="items.next_page_url"
                                :href="items.next_page_url"
                                class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 text-sm font-medium rounded-md text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600"
                            >
                                Next
                            </Link>
                        </div>
                        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                            <div>
                                <p class="text-sm text-gray-700 dark:text-gray-300">
                                    Showing <span class="font-medium">{{ items.from }}</span> to
                                    <span class="font-medium">{{ items.to }}</span> of
                                    <span class="font-medium">{{ items.total }}</span> results
                                </p>
                            </div>
                            <div>
                                <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                                    <Link
                                        v-for="link in items.links"
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
                                        {{ link.label }}
                                    </Link>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bulk Action Modal -->
        <TransitionRoot as="template" :show="showBulkModal">
            <Dialog as="div" class="relative z-10" @close="showBulkModal = false">
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
                                    <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-blue-100 dark:bg-blue-900/30">
                                        <CogIcon class="h-6 w-6 text-blue-600 dark:text-blue-400" />
                                    </div>
                                    <div class="mt-3 text-center sm:mt-5">
                                        <DialogTitle as="h3" class="text-base font-semibold leading-6 text-gray-900 dark:text-white">
                                            Bulk Actions
                                        </DialogTitle>
                                        <div class="mt-2">
                                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                                Choose an action to apply to {{ selectedItems.length }} selected items.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-5 sm:mt-6 space-y-3">
                                    <button
                                        type="button"
                                        class="inline-flex w-full justify-center rounded-md bg-green-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-green-500"
                                        @click="bulkAction('publish')"
                                    >
                                        Publish Items
                                    </button>
                                    <button
                                        type="button"
                                        class="inline-flex w-full justify-center rounded-md bg-yellow-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-yellow-500"
                                        @click="bulkAction('draft')"
                                    >
                                        Set to Draft
                                    </button>
                                    <button
                                        type="button"
                                        class="inline-flex w-full justify-center rounded-md bg-gray-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-gray-500"
                                        @click="bulkAction('retire')"
                                    >
                                        Retire Items
                                    </button>
                                    <button
                                        type="button"
                                        class="inline-flex w-full justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500"
                                        @click="bulkAction('delete')"
                                    >
                                        Delete Items
                                    </button>
                                    <button
                                        type="button"
                                        class="inline-flex w-full justify-center rounded-md bg-white dark:bg-gray-700 px-3 py-2 text-sm font-semibold text-gray-900 dark:text-white shadow-sm ring-1 ring-inset ring-gray-300 dark:ring-gray-600 hover:bg-gray-50 dark:hover:bg-gray-600"
                                        @click="showBulkModal = false"
                                    >
                                        Cancel
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
import { 
    QuestionMarkCircleIcon,
    CogIcon
} from '@heroicons/vue/24/outline';
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
    items: Object,
    filters: Object,
    filterOptions: Object,
});

const filters = ref({
    search: props.filters.search || '',
    domain_id: props.filters.domain_id ? String(props.filters.domain_id) : 'all',
    type_id: props.filters.type_id ? String(props.filters.type_id) : 'all',
    difficulty_level: props.filters.difficulty_level ? String(props.filters.difficulty_level) : 'all',
    bloom_level: props.filters.bloom_level ? String(props.filters.bloom_level) : 'all',
    status: props.filters.status || 'all',
});

const selectedItems = ref([]);
const showBulkModal = ref(false);

const hasActiveFilters = computed(() => {
    return filters.value.search || 
           (filters.value.domain_id && filters.value.domain_id !== 'all') || 
           (filters.value.type_id && filters.value.type_id !== 'all') || 
           (filters.value.difficulty_level && filters.value.difficulty_level !== 'all') || 
           (filters.value.bloom_level && filters.value.bloom_level !== 'all') || 
           (filters.value.status && filters.value.status !== 'all');
});

const truncateText = (text, maxLength) => {
    if (!text) return '';
    return text.length > maxLength ? text.substring(0, maxLength) + '...' : text;
};

const getDifficultyLabel = (level) => {
    const labels = {
        1: 'Very Easy',
        2: 'Easy', 
        3: 'Medium',
        4: 'Hard',
        5: 'Very Hard',
        6: 'Expert'
    };
    return labels[level] || 'Unknown';
};

const getBloomLabel = (level) => {
    const labels = {
        1: 'Remember',
        2: 'Understand',
        3: 'Apply',
        4: 'Analyze',
        5: 'Evaluate',
        6: 'Create'
    };
    return labels[level] || 'Unknown';
};

const applyFilters = () => {
    // Convert 'all' values back to empty strings for the backend
    // Remove empty/null/undefined values to keep URL clean
    const filterData = Object.fromEntries(
        Object.entries({
            search: filters.value.search,
            domain_id: filters.value.domain_id === 'all' ? '' : filters.value.domain_id,
            type_id: filters.value.type_id === 'all' ? '' : filters.value.type_id,
            difficulty_level: filters.value.difficulty_level === 'all' ? '' : filters.value.difficulty_level,
            bloom_level: filters.value.bloom_level === 'all' ? '' : filters.value.bloom_level,
            status: filters.value.status === 'all' ? '' : filters.value.status,
        }).filter(([, value]) => value !== '' && value !== null && value !== undefined)
    );
    
    router.get(route('admin.diagnostics.items.index'), filterData, {
        preserveState: true,
        preserveScroll: true,
        replace: true, // Replace current history entry to avoid cluttering browser history
    });
};

const debouncedSearch = debounce(applyFilters, 300);

const clearFilters = () => {
    filters.value = {
        search: '',
        domain_id: 'all',
        type_id: 'all',
        difficulty_level: 'all',
        bloom_level: 'all',
        status: 'all',
    };
    applyFilters();
};

const toggleAll = (event) => {
    if (event.target.checked) {
        selectedItems.value = props.items.data.map(item => item.id);
    } else {
        selectedItems.value = [];
    }
};

const navigateToItem = (itemId) => {
    // Navigate to item view while preserving current filters in URL
    const currentFilters = Object.fromEntries(
        Object.entries(filters.value).filter(([, value]) => value && value !== 'all')
    );
    
    router.visit(route('admin.diagnostics.items.show', { 
        item: itemId,
        ...currentFilters 
    }));
};

const bulkAction = (action) => {
    if (selectedItems.value.length === 0) return;
    
    const confirmMessages = {
        delete: 'Are you sure you want to delete the selected items?',
        publish: 'Are you sure you want to publish the selected items?',
        draft: 'Are you sure you want to set the selected items to draft?',
        retire: 'Are you sure you want to retire the selected items?',
    };
    
    if (confirm(confirmMessages[action])) {
        router.post(route('admin.diagnostics.items.bulk-action'), {
            action: action,
            item_ids: selectedItems.value
        }, {
            onSuccess: () => {
                selectedItems.value = [];
                showBulkModal.value = false;
            }
        });
    }
};
</script>