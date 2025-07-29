<template>
    <AdminLayout>
        <div class="px-4 sm:px-6 lg:px-8 py-8">
            <!-- Header -->
            <div class="sm:flex sm:items-center mb-8">
                <div class="sm:flex-auto">
                    <Link 
                        :href="route('admin.diagnostics.items.index')" 
                        class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 flex items-center gap-2 mb-4"
                    >
                        <ArrowLeftIcon class="h-4 w-4" />
                        Back to Diagnostic Items
                    </Link>
                    <h1 class="text-3xl font-semibold text-gray-900 dark:text-white">
                        Edit Diagnostic Item #{{ item.id }}
                    </h1>
                    <p class="mt-2 text-sm text-gray-700 dark:text-gray-300">
                        Update the diagnostic assessment item details
                    </p>
                </div>
            </div>

            <!-- Form -->
            <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg">
                <form @submit.prevent="updateItem" class="p-6 space-y-6">
                    <!-- Basic Information -->
                    <div>
                        <h3 class="text-lg font-semibold mb-4 text-gray-900 dark:text-white">
                            Basic Information
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Subtopic -->
                            <div>
                                <Label for="subtopic_id">Subtopic <span class="text-red-500">*</span></Label>
                                <select
                                    v-model="form.subtopic_id"
                                    id="subtopic_id"
                                    class="block w-full px-3 py-2 rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                                    required
                                >
                                    <option value="">Select a subtopic...</option>
                                    <option 
                                        v-for="subtopic in subtopics" 
                                        :key="subtopic.id" 
                                        :value="subtopic.id"
                                    >
                                        {{ subtopic.full_name }}
                                    </option>
                                </select>
                                <InputError v-if="errors.subtopic_id" :message="errors.subtopic_id" />
                            </div>

                            <!-- Question Type -->
                            <div>
                                <Label for="type_id">Question Type <span class="text-red-500">*</span></Label>
                                <select
                                    v-model="form.type_id"
                                    id="type_id"
                                    class="block w-full px-3 py-2 rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                                    required
                                >
                                    <option value="">Select a type...</option>
                                    <option 
                                        v-for="type in types" 
                                        :key="type.id" 
                                        :value="type.id"
                                    >
                                        {{ type.name }} ({{ type.code }})
                                    </option>
                                </select>
                                <InputError v-if="errors.type_id" :message="errors.type_id" />
                            </div>

                            <!-- Dimension -->
                            <div>
                                <Label for="dimension">Dimension <span class="text-red-500">*</span></Label>
                                <select
                                    v-model="form.dimension"
                                    id="dimension"
                                    class="block w-full px-3 py-2 rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                                    required
                                >
                                    <option value="">Select dimension...</option>
                                    <option value="Technical">Technical</option>
                                    <option value="Managerial">Managerial</option>
                                </select>
                                <InputError v-if="errors.dimension" :message="errors.dimension" />
                            </div>

                            <!-- Status -->
                            <div>
                                <Label for="status">Status <span class="text-red-500">*</span></Label>
                                <select
                                    v-model="form.status"
                                    id="status"
                                    class="block w-full px-3 py-2 rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                                    required
                                >
                                    <option value="draft">Draft</option>
                                    <option value="published">Published</option>
                                    <option value="retired">Retired</option>
                                </select>
                                <InputError v-if="errors.status" :message="errors.status" />
                            </div>
                        </div>
                    </div>

                    <!-- Question Content -->
                    <div>
                        <h3 class="text-lg font-semibold mb-4 text-gray-900 dark:text-white">
                            Question Content
                        </h3>
                        <div>
                            <Label for="content">Question Content <span class="text-red-500">*</span></Label>
                            <textarea
                                v-model="form.content"
                                id="content"
                                rows="4"
                                class="block w-full px-3 py-2 rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                                placeholder="Enter the question content..."
                                required
                            ></textarea>
                            <InputError v-if="errors.content" :message="errors.content" />
                        </div>
                    </div>

                    <!-- Difficulty & Bloom Levels -->
                    <div>
                        <h3 class="text-lg font-semibold mb-4 text-gray-900 dark:text-white">
                            Assessment Levels
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Difficulty Level -->
                            <div>
                                <Label for="difficulty_level">Difficulty Level (1-6) <span class="text-red-500">*</span></Label>
                                <Input
                                    v-model="form.difficulty_level"
                                    type="number"
                                    id="difficulty_level"
                                    min="1"
                                    max="6"
                                    required
                                />
                                <InputError v-if="errors.difficulty_level" :message="errors.difficulty_level" />
                            </div>

                            <!-- Bloom Level -->
                            <div>
                                <Label for="bloom_level">Bloom Level (1-6) <span class="text-red-500">*</span></Label>
                                <Input
                                    v-model="form.bloom_level"
                                    type="number"
                                    id="bloom_level"
                                    min="1"
                                    max="6"
                                    required
                                />
                                <InputError v-if="errors.bloom_level" :message="errors.bloom_level" />
                            </div>
                        </div>
                    </div>

                    <!-- IRT Parameters -->
                    <div>
                        <h3 class="text-lg font-semibold mb-4 text-gray-900 dark:text-white">
                            IRT Parameters (Optional)
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <!-- IRT A Parameter -->
                            <div>
                                <Label for="irt_a">IRT A Parameter (0.5-3.0)</Label>
                                <Input
                                    v-model="form.irt_a"
                                    type="number"
                                    id="irt_a"
                                    step="0.1"
                                    min="0.5"
                                    max="3.0"
                                />
                                <InputError v-if="errors.irt_a" :message="errors.irt_a" />
                            </div>

                            <!-- IRT B Parameter -->
                            <div>
                                <Label for="irt_b">IRT B Parameter (-3.0-3.0)</Label>
                                <Input
                                    v-model="form.irt_b"
                                    type="number"
                                    id="irt_b"
                                    step="0.1"
                                    min="-3.0"
                                    max="3.0"
                                />
                                <InputError v-if="errors.irt_b" :message="errors.irt_b" />
                            </div>

                            <!-- IRT C Parameter -->
                            <div>
                                <Label for="irt_c">IRT C Parameter (0.0-0.25)</Label>
                                <Input
                                    v-model="form.irt_c"
                                    type="number"
                                    id="irt_c"
                                    step="0.01"
                                    min="0.0"
                                    max="0.25"
                                />
                                <InputError v-if="errors.irt_c" :message="errors.irt_c" />
                            </div>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="flex items-center justify-end space-x-3 pt-6 border-t border-gray-200 dark:border-gray-700">
                        <Link
                            :href="route('admin.diagnostics.items.index')"
                            class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        >
                            Cancel
                        </Link>
                        <button
                            type="submit"
                            :disabled="processing"
                            class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 disabled:opacity-50 disabled:cursor-not-allowed"
                        >
                            <span v-if="processing" class="flex items-center">
                                <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Updating...
                            </span>
                            <span v-else>Update Diagnostic Item</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </AdminLayout>
</template>

<script setup lang="ts">
import { ref } from 'vue'
import { router } from '@inertiajs/vue3'
import AdminLayout from '@/layouts/AdminLayout.vue'
import { Link } from '@inertiajs/vue3'
import { ArrowLeftIcon } from '@heroicons/vue/24/outline'
import Label from '@/components/shadcn/ui/label/Label.vue'
import Input from '@/components/shadcn/ui/input/Input.vue'
import InputError from '@/components/InputError.vue'

interface DiagnosticItem {
    id: number
    subtopic_id: number
    type_id: number
    dimension: string
    content: string
    options: any[]
    correct_options: any[]
    justifications: any[]
    settings: any[]
    difficulty_level: number
    bloom_level: number
    irt_a: number | null
    irt_b: number | null
    irt_c: number | null
    status: string
}

interface Subtopic {
    id: number
    name: string
    topic_name: string
    domain_name: string
    full_name: string
}

interface QuestionType {
    id: number
    name: string
    code: string
}

interface Props {
    item: DiagnosticItem
    subtopics: Subtopic[]
    types: QuestionType[]
    errors?: Record<string, string>
}

const props = defineProps<Props>()

const processing = ref(false)

// Initialize form with item data
const form = ref({
    subtopic_id: props.item.subtopic_id,
    type_id: props.item.type_id,
    dimension: props.item.dimension,
    content: props.item.content,
    options: props.item.options || [],
    correct_options: props.item.correct_options || [],
    justifications: props.item.justifications || [],
    settings: props.item.settings || {},
    difficulty_level: props.item.difficulty_level,
    bloom_level: props.item.bloom_level,
    irt_a: props.item.irt_a,
    irt_b: props.item.irt_b,
    irt_c: props.item.irt_c,
    status: props.item.status,
})

const updateItem = () => {
    processing.value = true
    
    router.put(route('admin.diagnostics.items.update', props.item.id), form.value, {
        onFinish: () => {
            processing.value = false
        },
        onSuccess: () => {
            // Redirect handled by controller
        }
    })
}
</script>