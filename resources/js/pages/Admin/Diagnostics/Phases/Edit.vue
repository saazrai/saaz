<template>
    <AdminLayout>
        <div class="px-4 sm:px-6 lg:px-8 py-8">
            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-3xl font-semibold text-gray-900 dark:text-white">Edit Diagnostic Phase</h1>
                <p class="mt-2 text-sm text-gray-700 dark:text-gray-300">
                    Update phase settings and domain assignments
                </p>
            </div>

            <form @submit.prevent="submit" class="space-y-8">
                <!-- Basic Information -->
                <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Basic Information</h3>
                    
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                        <!-- Name -->
                        <div>
                            <Label for="name">Phase Name</Label>
                            <Input
                                type="text"
                                id="name"
                                v-model="form.name"
                                class="mt-1"
                                required
                            />
                            <p v-if="form.errors.name" class="mt-2 text-sm text-red-600 dark:text-red-400">
                                {{ form.errors.name }}
                            </p>
                        </div>

                        <!-- Order Sequence (Read-only) -->
                        <div>
                            <Label for="order_sequence">Order Sequence</Label>
                            <Input
                                type="number"
                                id="order_sequence"
                                v-model="form.order_sequence"
                                class="mt-1 bg-gray-50 dark:bg-gray-900"
                                readonly
                            />
                        </div>

                        <!-- Description -->
                        <div class="sm:col-span-2">
                            <Label for="description">Description</Label>
                            <Textarea
                                id="description"
                                v-model="form.description"
                                rows="3"
                                class="mt-1"
                            />
                            <p v-if="form.errors.description" class="mt-2 text-sm text-red-600 dark:text-red-400">
                                {{ form.errors.description }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Configuration -->
                <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Configuration</h3>
                    
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                        <!-- Target Domains -->
                        <div>
                            <Label for="target_domains">Target Domains</Label>
                            <Input
                                type="number"
                                id="target_domains"
                                v-model="form.target_domains"
                                min="1"
                                max="10"
                                class="mt-1"
                                required
                            />
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                Number of domains to include in this phase
                            </p>
                            <p v-if="form.errors.target_domains" class="mt-2 text-sm text-red-600 dark:text-red-400">
                                {{ form.errors.target_domains }}
                            </p>
                        </div>

                        <!-- Questions per Domain -->
                        <div>
                            <Label for="min_questions_per_domain">Questions per Domain</Label>
                            <Input
                                type="number"
                                id="min_questions_per_domain"
                                v-model="form.min_questions_per_domain"
                                min="1"
                                max="50"
                                class="mt-1"
                                required
                            />
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                Minimum questions to ask per domain
                            </p>
                            <p v-if="form.errors.min_questions_per_domain" class="mt-2 text-sm text-red-600 dark:text-red-400">
                                {{ form.errors.min_questions_per_domain }}
                            </p>
                        </div>

                        <!-- Color -->
                        <div>
                            <Label for="color">Color</Label>
                            <div class="mt-1 flex items-center">
                                <input
                                    type="color"
                                    id="color"
                                    v-model="form.color"
                                    class="h-10 w-10 rounded border border-gray-300 dark:border-gray-600"
                                />
                                <Input
                                    type="text"
                                    v-model="form.color"
                                    class="ml-2 flex-1"
                                    placeholder="#6B7280"
                                />
                            </div>
                            <p v-if="form.errors.color" class="mt-2 text-sm text-red-600 dark:text-red-400">
                                {{ form.errors.color }}
                            </p>
                        </div>

                        <!-- Active Status -->
                        <div>
                            <div class="flex items-center space-x-2">
                                <Checkbox
                                    id="is_active"
                                    v-model:checked="form.is_active"
                                />
                                <Label for="is_active">Active</Label>
                            </div>
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                Whether this phase is available for diagnostics
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Domain Assignment -->
                <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Domain Assignment</h3>
                    
                    <div v-if="availableDomains.length > 0">
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
                            Select domains to assign to this phase ({{ selectedDomains.length }} selected)
                        </p>
                        
                        <div class="space-y-2 max-h-64 overflow-y-auto">
                            <label
                                v-for="domain in availableDomains"
                                :key="domain.id"
                                class="flex items-center p-3 rounded-lg border border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer"
                            >
                                <input
                                    type="checkbox"
                                    :value="domain.id"
                                    v-model="form.domain_ids"
                                    class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                                />
                                <div class="ml-3 flex-1">
                                    <div class="text-sm font-medium text-gray-900 dark:text-white">
                                        {{ domain.name }}
                                        <span v-if="domain.code" class="text-gray-500 dark:text-gray-400">
                                            ({{ domain.code }})
                                        </span>
                                    </div>
                                    <div v-if="domain.description" class="text-xs text-gray-500 dark:text-gray-400">
                                        {{ domain.description }}
                                    </div>
                                </div>
                            </label>
                        </div>
                    </div>
                    <div v-else class="text-sm text-gray-500 dark:text-gray-400 italic">
                        No available domains to assign
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex justify-end space-x-3">
                    <Link
                        :href="route('admin.diagnostics.phases.index')"
                        class="rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 py-2 px-4 text-sm font-medium text-gray-700 dark:text-gray-200 shadow-sm hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                    >
                        Cancel
                    </Link>
                    <button
                        type="submit"
                        :disabled="form.processing"
                        class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-50"
                    >
                        Update Phase
                    </button>
                </div>
            </form>
        </div>
    </AdminLayout>
</template>

<script setup lang="ts">
import { computed } from 'vue';
import { Link, useForm } from '@inertiajs/vue3';
import AdminLayout from '@/layouts/AdminLayout.vue';
import { Input } from '@/components/shadcn/ui/input';
import { Label } from '@/components/shadcn/ui/label';
import { Textarea } from '@/components/shadcn/ui/textarea';
import { Checkbox } from '@/components/shadcn/ui/checkbox';

const props = defineProps({
    phase: Object,
    availableDomains: Array,
});

const form = useForm({
    name: props.phase.name,
    description: props.phase.description || '',
    order_sequence: props.phase.order_sequence,
    min_questions_per_domain: props.phase.min_questions_per_domain,
    target_domains: props.phase.target_domains,
    color: props.phase.color || '#6B7280',
    icon: props.phase.icon || null,
    is_active: props.phase.is_active,
    domain_ids: props.phase.domains.map(d => d.id),
});

const selectedDomains = computed(() => {
    return props.availableDomains.filter(domain => form.domain_ids.includes(domain.id));
});

const submit = () => {
    form.put(route('admin.diagnostics.phases.update', props.phase.id));
};
</script>