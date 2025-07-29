<template>
    <AdminLayout>
        <div class="px-4 sm:px-6 lg:px-8 py-8">
            <!-- Header -->
            <div class="sm:flex sm:items-center">
                <div class="sm:flex-auto">
                    <h1 class="text-3xl font-semibold text-gray-900 dark:text-white">Bloom's Taxonomy Levels</h1>
                    <p class="mt-2 text-sm text-gray-700 dark:text-gray-300">
                        Manage cognitive complexity levels used for assessment questions
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
                            placeholder="Search bloom levels..."
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

            <!-- Blooms Table -->
            <div class="mt-8 bg-white dark:bg-gray-800 shadow-sm rounded-lg overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-100 dark:bg-gray-700 border-b border-gray-200 dark:border-gray-600">
                            <tr>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 dark:text-white">
                                    Level
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
                                v-for="bloom in blooms.data" 
                                :key="bloom.id" 
                                class="hover:bg-gray-50 dark:hover:bg-gray-700"
                            >
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900 dark:text-white">
                                    <div class="flex items-center">
                                        <div :class="getLevelColorClass(bloom.level)" class="w-8 h-8 rounded-full flex items-center justify-center text-white font-bold text-sm">
                                            {{ bloom.level }}
                                        </div>
                                    </div>
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900 dark:text-white">
                                    <span class="font-mono bg-gray-100 dark:bg-gray-700 px-2 py-1 rounded text-xs">
                                        {{ bloom.code }}
                                    </span>
                                </td>
                                <td class="px-3 py-4 text-sm text-gray-900 dark:text-white">
                                    <div class="font-medium">{{ bloom.name }}</div>
                                </td>
                                <td class="px-3 py-4 text-sm text-gray-500 dark:text-gray-400">
                                    <div class="max-w-xs">{{ bloom.description }}</div>
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm">
                                    <span
                                        :class="[
                                            bloom.status === 'active'
                                                ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400'
                                                : 'bg-gray-100 text-gray-800 dark:bg-gray-900/30 dark:text-gray-400',
                                            'inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium capitalize'
                                        ]"
                                    >
                                        {{ bloom.status }}
                                    </span>
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                    <div class="flex items-center space-x-3">
                                        <button
                                            @click="openEditModal(bloom)"
                                            class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300"
                                        >
                                            Edit
                                        </button>
                                        <button
                                            @click="toggleStatus(bloom)"
                                            :class="[
                                                bloom.status === 'active'
                                                    ? 'bg-indigo-600'
                                                    : 'bg-gray-200 dark:bg-gray-700',
                                                'relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:ring-offset-2'
                                            ]"
                                        >
                                            <span
                                                :class="[
                                                    bloom.status === 'active' ? 'translate-x-5' : 'translate-x-0',
                                                    'pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out'
                                                ]"
                                            />
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Empty State -->
                <div v-if="blooms.data.length === 0" class="text-center py-12">
                    <div class="mx-auto h-12 w-12 text-gray-400">
                        <Shapes class="h-12 w-12" />
                    </div>
                    <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">No bloom levels found</h3>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">No bloom levels match your current filters.</p>
                </div>
            </div>
        </div>

        <!-- Edit Slide Over -->
        <Sheet :open="isEditModalOpen" @update:open="isEditModalOpen = $event">
            <SheetContent side="right" class="w-full sm:w-[480px] overflow-y-auto bg-white/90 dark:bg-gray-950/90 backdrop-blur-xl border-l border-gray-200/20 dark:border-gray-700/30">
                <SheetHeader>
                    <SheetTitle class="text-lg font-semibold text-gray-900 dark:text-white">
                        Edit Bloom Level
                    </SheetTitle>
                    <SheetDescription class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                        Update the name and description for this bloom level.
                    </SheetDescription>
                </SheetHeader>
                
                <form @submit.prevent="updateBloom" class="space-y-6 py-6">
                    <div class="space-y-4">
                        <div>
                            <Label for="edit-code" class="text-sm font-medium text-gray-700 dark:text-gray-400">Code (Read-only)</Label>
                            <Input 
                                id="edit-code" 
                                :value="editForm.code" 
                                type="text" 
                                disabled
                                class="mt-1.5 bg-gray-100 dark:bg-gray-800 cursor-not-allowed text-gray-900 dark:text-gray-100"
                            />
                        </div>
                        
                        <div>
                            <Label for="edit-name" class="text-gray-700 dark:text-gray-300">Name</Label>
                            <Input
                                id="edit-name"
                                v-model="editForm.name"
                                type="text"
                                required
                                class="mt-1.5 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 border-gray-300 dark:border-gray-600"
                            />
                        </div>

                        <div>
                            <Label for="edit-description" class="text-gray-700 dark:text-gray-300">Description</Label>
                            <Textarea
                                id="edit-description"
                                v-model="editForm.description"
                                rows="4"
                                class="mt-1.5 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 border-gray-300 dark:border-gray-600"
                            />
                        </div>

                        <div>
                            <Label for="edit-status" class="text-gray-700 dark:text-gray-300">Status</Label>
                            <Select v-model="editForm.status">
                                <SelectTrigger id="edit-status" class="mt-1.5 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 border-gray-300 dark:border-gray-600">
                                    <SelectValue />
                                </SelectTrigger>
                                <SelectContent class="bg-white dark:bg-gray-800">
                                    <SelectItem value="active" class="text-gray-900 dark:text-gray-100">Active</SelectItem>
                                    <SelectItem value="inactive" class="text-gray-900 dark:text-gray-100">Inactive</SelectItem>
                                </SelectContent>
                            </Select>
                        </div>
                    </div>
                    
                    <SheetFooter class="flex justify-end gap-3 pt-6 border-t border-gray-200 dark:border-gray-700">
                        <Button
                            type="button"
                            variant="outline"
                            @click="isEditModalOpen = false"
                            class="bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 border-gray-300 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700"
                        >
                            Cancel
                        </Button>
                        <Button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white">
                            Save Changes
                        </Button>
                    </SheetFooter>
                </form>
            </SheetContent>
        </Sheet>
    </AdminLayout>
</template>

<script setup lang="ts">
import { ref, computed } from 'vue';
import { router } from '@inertiajs/vue3';
import AdminLayout from '@/layouts/AdminLayout.vue';
import { Shapes } from 'lucide-vue-next';
import { debounce } from 'lodash';
import { Input } from '@/components/shadcn/ui/input';
import { Label } from '@/components/shadcn/ui/label';
import { Textarea } from '@/components/shadcn/ui/textarea';
import { Button } from '@/components/shadcn/ui/button';
import {
  Select,
  SelectContent,
  SelectItem,
  SelectTrigger,
  SelectValue,
} from '@/components/shadcn/ui/select';
import {
  Sheet,
  SheetContent,
  SheetDescription,
  SheetHeader,
  SheetTitle,
  SheetFooter,
} from '@/components/shadcn/ui/sheet';

const props = defineProps({
    blooms: Object,
    filters: Object,
});

// State
const filters = ref({
    search: props.filters.search || '',
    status: props.filters.status || 'all',
});

const isEditModalOpen = ref(false);
const editForm = ref({
    id: null,
    code: '',
    name: '',
    description: '',
    status: 'active',
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
    
    router.get(route('admin.master.blooms.index'), filterData, {
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

const getLevelColorClass = (level: number) => {
    const colors = [
        'bg-red-500',
        'bg-orange-500',
        'bg-yellow-500',
        'bg-green-500',
        'bg-blue-500',
        'bg-purple-500',
    ];
    return colors[level - 1] || 'bg-gray-500';
};

const openEditModal = (bloom) => {
    editForm.value = {
        id: bloom.id,
        code: bloom.code,
        name: bloom.name,
        description: bloom.description || '',
        status: bloom.status,
    };
    isEditModalOpen.value = true;
};

const updateBloom = () => {
    router.put(route('admin.master.blooms.update', editForm.value.id), {
        name: editForm.value.name,
        description: editForm.value.description,
        status: editForm.value.status,
    }, {
        preserveState: true,
        preserveScroll: true,
        onSuccess: () => {
            isEditModalOpen.value = false;
        },
    });
};

const toggleStatus = (bloom) => {
    router.post(route('admin.master.blooms.toggle-status', bloom.id), {}, {
        preserveState: true,
        preserveScroll: true,
    });
};
</script>