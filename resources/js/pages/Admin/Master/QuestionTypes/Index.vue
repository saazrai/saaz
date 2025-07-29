<template>
    <AdminLayout>
        <div class="px-4 sm:px-6 lg:px-8 py-8">
            <!-- Header -->
            <div class="sm:flex sm:items-center">
                <div class="sm:flex-auto">
                    <h1 class="text-3xl font-semibold text-gray-900 dark:text-white">Question Types</h1>
                    <p class="mt-2 text-sm text-gray-700 dark:text-gray-300">
                        Manage question types used across the platform for assessments and diagnostics
                    </p>
                </div>
            </div>

            <!-- Filters -->
            <div class="mt-8 bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6">
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <!-- Search -->
                    <div>
                        <Label for="search">Search</Label>
                        <Input
                            type="text"
                            id="search"
                            v-model="filters.search"
                            @input="debouncedSearch"
                            placeholder="Search question types..."
                            class="mt-1 h-10"
                        />
                    </div>

                    <!-- Status Filter -->
                    <div>
                        <Label for="status">Status</Label>
                        <Select v-model="filters.status" @update:model-value="applyFilters">
                            <SelectTrigger id="status" class="mt-1 text-gray-900 dark:text-gray-100">
                                <SelectValue placeholder="All Statuses" />
                            </SelectTrigger>
                            <SelectContent class="bg-white dark:bg-gray-800">
                                <SelectItem value="all" class="text-gray-900 dark:text-gray-100">All Statuses</SelectItem>
                                <SelectItem value="active" class="text-gray-900 dark:text-gray-100">Active</SelectItem>
                                <SelectItem value="inactive" class="text-gray-900 dark:text-gray-100">Inactive</SelectItem>
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

            <!-- Question Types Table -->
            <div class="mt-8 bg-white dark:bg-gray-800 shadow-sm rounded-lg overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-100 dark:bg-gray-700 border-b border-gray-200 dark:border-gray-600">
                            <tr>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 dark:text-white">
                                    ID
                                </th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 dark:text-white">
                                    Code
                                </th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 dark:text-white">
                                    Name
                                </th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 dark:text-white">
                                    Description
                                </th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 dark:text-white">
                                    Status
                                </th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 dark:text-white">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700 bg-white dark:bg-gray-800">
                            <tr 
                                v-for="questionType in questionTypes.data" 
                                :key="questionType.id" 
                                class="hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer"
                                @click="viewQuestionType(questionType)"
                            >
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900 dark:text-white">
                                    {{ questionType.id }}
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900 dark:text-white">
                                    <span class="font-mono bg-gray-100 dark:bg-gray-700 px-2 py-1 rounded text-xs">
                                        {{ questionType.code }}
                                    </span>
                                </td>
                                <td class="px-3 py-4 text-sm text-gray-900 dark:text-white">
                                    <div class="font-medium">{{ questionType.name }}</div>
                                </td>
                                <td class="px-3 py-4 text-sm text-gray-500 dark:text-gray-400">
                                    <div class="max-w-xs truncate">{{ questionType.description }}</div>
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm">
                                    <span
                                        :class="[
                                            questionType.status === 'active'
                                                ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400'
                                                : 'bg-gray-100 text-gray-800 dark:bg-gray-900/30 dark:text-gray-400',
                                            'inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium capitalize'
                                        ]"
                                    >
                                        {{ questionType.status }}
                                    </span>
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500" @click.stop>
                                    <button
                                        @click="toggleStatus(questionType)"
                                        :class="[
                                            questionType.status === 'active'
                                                ? 'bg-indigo-600'
                                                : 'bg-gray-200 dark:bg-gray-700',
                                            'relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:ring-offset-2'
                                        ]"
                                    >
                                        <span
                                            :class="[
                                                questionType.status === 'active' ? 'translate-x-5' : 'translate-x-0',
                                                'pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out'
                                            ]"
                                        />
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Empty State -->
                <div v-if="questionTypes.data.length === 0" class="text-center py-12">
                    <div class="mx-auto h-12 w-12 text-gray-400">
                        <Shapes class="h-12 w-12" />
                    </div>
                    <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">No question types found</h3>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">No question types match your current filters.</p>
                </div>
            </div>
        </div>

    </AdminLayout>
</template>

<script setup lang="ts">
import { ref, computed } from 'vue';
import { router } from '@inertiajs/vue3';
import AdminLayout from '@/layouts/AdminLayout.vue';
import { 
    Shapes
} from 'lucide-vue-next';
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
    questionTypes: Object,
    filters: Object,
});

// State

const filters = ref({
    search: props.filters.search || '',
    status: props.filters.status || 'all',
});

const hasActiveFilters = computed(() => {
    return filters.value.search || 
           (filters.value.status && filters.value.status !== 'all');
});

// Methods
const applyFilters = () => {
    const filterData = Object.fromEntries(
        Object.entries({
            search: filters.value.search,
            status: filters.value.status === 'all' ? '' : filters.value.status,
        }).filter(([, value]) => value !== '' && value !== null && value !== undefined)
    );
    
    router.get(route('admin.master.question-types.index'), filterData, {
        preserveState: true,
        preserveScroll: true,
        replace: true,
    });
};

const debouncedSearch = debounce(applyFilters, 300);

const clearFilters = () => {
    filters.value = {
        search: '',
        status: 'all',
    };
    applyFilters();
};

const viewQuestionType = (questionType) => {
    router.visit(route('admin.master.question-types.show', questionType.id));
};

const toggleStatus = (questionType) => {
    const newStatus = questionType.status === 'active' ? 'inactive' : 'active';
    
    router.patch(route('admin.master.question-types.update', questionType.id), {
        code: questionType.code,
        name: questionType.name,
        description: questionType.description,
        status: newStatus,
    }, {
        preserveState: true,
        preserveScroll: true,
    });
};
</script>