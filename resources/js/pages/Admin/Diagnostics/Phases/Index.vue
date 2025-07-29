<template>
    <AdminLayout>
        <div class="px-4 sm:px-6 lg:px-8 py-8">
            <!-- Header -->
            <div class="sm:flex sm:items-center">
                <div class="sm:flex-auto">
                    <h1 class="text-3xl font-semibold text-gray-900 dark:text-white">Diagnostic Phases</h1>
                    <p class="mt-2 text-sm text-gray-700 dark:text-gray-300">
                        Manage the four phases of the diagnostic assessment
                    </p>
                </div>
            </div>

            <!-- Phase Cards -->
            <div class="mt-8 space-y-6">
                <div v-for="phase in phases" :key="phase.id" class="bg-white dark:bg-gray-800 shadow-lg rounded-lg overflow-hidden">
                            <div class="p-6">
                                <div class="flex items-center justify-between mb-4">
                                    <div class="flex items-center space-x-4">
                                        <!-- Phase Number & Color -->
                                        <div
                                            class="w-12 h-12 rounded-full flex items-center justify-center text-white font-bold text-lg"
                                            :style="{backgroundColor: phase.color || '#6B7280'}"
                                        >
                                            {{ phase.order_sequence }}
                                        </div>
                                        
                                        <!-- Phase Name & Description -->
                                        <div>
                                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                {{ phase.name }}
                                            </h3>
                                            <p class="text-sm text-gray-600 dark:text-gray-400">
                                                {{ phase.description }}
                                            </p>
                                        </div>
                                    </div>
                                    
                                    <!-- Actions -->
                                    <div class="flex items-center space-x-2">
                                        <!-- Status Badge -->
                                        <span
                                            :class="[
                                                phase.is_active
                                                    ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400'
                                                    : 'bg-gray-100 text-gray-800 dark:bg-gray-900/30 dark:text-gray-400',
                                                'inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium'
                                            ]"
                                        >
                                            {{ phase.is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                        
                                        <!-- Action Dropdown -->
                                        <Menu as="div" class="relative inline-block text-left">
                                            <div>
                                                <MenuButton class="flex items-center text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                                                    <EllipsisVerticalIcon class="h-5 w-5" aria-hidden="true" />
                                                </MenuButton>
                                            </div>
                                            
                                            <transition
                                                enter-active-class="transition ease-out duration-100"
                                                enter-from-class="transform opacity-0 scale-95"
                                                enter-to-class="transform opacity-100 scale-100"
                                                leave-active-class="transition ease-in duration-75"
                                                leave-from-class="transform opacity-100 scale-100"
                                                leave-to-class="transform opacity-0 scale-95"
                                            >
                                                <MenuItems class="absolute right-0 z-10 mt-2 w-56 origin-top-right rounded-md bg-white dark:bg-gray-700 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
                                                    <div class="py-1">
                                                        <MenuItem v-slot="{ active }">
                                                            <Link
                                                                :href="route('admin.diagnostics.phases.edit', phase.id)"
                                                                :class="[
                                                                    active ? 'bg-gray-100 text-gray-900 dark:bg-gray-600 dark:text-white' : 'text-gray-700 dark:text-gray-200',
                                                                    'block px-4 py-2 text-sm'
                                                                ]"
                                                            >
                                                                Edit Phase
                                                            </Link>
                                                        </MenuItem>
                                                        <MenuItem v-slot="{ active }">
                                                            <button
                                                                @click="toggleActive(phase)"
                                                                :class="[
                                                                    active ? 'bg-gray-100 text-gray-900 dark:bg-gray-600 dark:text-white' : 'text-gray-700 dark:text-gray-200',
                                                                    'block w-full text-left px-4 py-2 text-sm'
                                                                ]"
                                                            >
                                                                {{ phase.is_active ? 'Deactivate' : 'Activate' }}
                                                            </button>
                                                        </MenuItem>
                                                    </div>
                                                </MenuItems>
                                            </transition>
                                        </Menu>
                                    </div>
                                </div>
                                
                                <!-- Phase Info -->
                                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-4">
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Target Domains</dt>
                                        <dd class="text-sm text-gray-900 dark:text-white">{{ phase.target_domains }}</dd>
                                    </div>
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Questions per Domain</dt>
                                        <dd class="text-sm text-gray-900 dark:text-white">{{ phase.min_questions_per_domain }}</dd>
                                    </div>
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Active Diagnostics</dt>
                                        <dd class="text-sm text-gray-900 dark:text-white">{{ phase.diagnostics_count }}</dd>
                                    </div>
                                </div>
                                
                                <!-- Domains -->
                                <div v-if="phase.domains && phase.domains.length > 0">
                                    <h4 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Assigned Domains ({{ phase.domains_count }})</h4>
                                    <div class="flex flex-wrap gap-2">
                                        <span
                                            v-for="domain in phase.domains"
                                            :key="domain.id"
                                            class="inline-flex items-center rounded-md px-2.5 py-1.5 text-xs font-medium ring-1 ring-inset"
                                            :style="{
                                                backgroundColor: `${domain.color}20`,
                                                color: domain.color,
                                                borderColor: domain.color
                                            }"
                                        >
                                            {{ domain.code || domain.name }}
                                        </span>
                                    </div>
                                </div>
                                <div v-else class="text-sm text-gray-500 dark:text-gray-400 italic">
                                    No domains assigned to this phase
                                </div>
                            </div>
                        </div>
            </div>
        </div>
    </AdminLayout>
</template>

<script setup lang="ts">
import { Link, router } from '@inertiajs/vue3';
import AdminLayout from '@/layouts/AdminLayout.vue';
import { Menu, MenuButton, MenuItem, MenuItems } from '@headlessui/vue';
import { EllipsisVerticalIcon } from '@heroicons/vue/24/outline';

defineProps({
    phases: Array,
});

const toggleActive = (phase) => {
    router.post(route('admin.diagnostics.phases.toggle-active', phase.id), {}, {
        preserveScroll: true,
    });
};
</script>