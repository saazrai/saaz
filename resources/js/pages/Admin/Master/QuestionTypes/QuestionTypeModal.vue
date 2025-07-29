<template>
    <TransitionRoot as="template" :show="show">
        <Dialog as="div" class="relative z-50" @close="$emit('close')">
            <!-- Background overlay -->
            <TransitionChild
                as="template"
                enter="ease-out duration-300"
                enter-from="opacity-0"
                enter-to="opacity-100"
                leave="ease-in duration-200"
                leave-from="opacity-100"
                leave-to="opacity-0"
            >
                <div class="fixed inset-0 bg-black/20 backdrop-blur-sm transition-opacity" />
            </TransitionChild>

            <!-- Slide-over panel -->
            <div class="fixed inset-0 overflow-hidden">
                <div class="absolute inset-0 overflow-hidden">
                    <div class="pointer-events-none fixed inset-y-0 right-0 flex max-w-full pl-10 sm:pl-16">
                        <TransitionChild
                            as="template"
                            enter="transform transition ease-in-out duration-300"
                            enter-from="translate-x-full"
                            enter-to="translate-x-0"
                            leave="transform transition ease-in-out duration-300"
                            leave-from="translate-x-0"
                            leave-to="translate-x-full"
                        >
                            <DialogPanel class="pointer-events-auto w-screen max-w-md">
                                <div class="flex h-full flex-col bg-white/95 dark:bg-gray-900/95 backdrop-blur-xl shadow-2xl border-l border-gray-200/50 dark:border-gray-700/50">
                                    <!-- Header -->
                                    <div class="flex items-center justify-between px-6 py-6 border-b border-gray-200/50 dark:border-gray-700/50">
                                        <div class="flex items-center gap-4">
                                            <div class="w-10 h-10 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center shadow-lg">
                                                <Shapes class="h-5 w-5 text-white" />
                                            </div>
                                            <div>
                                                <DialogTitle as="h2" class="text-xl font-semibold text-gray-900 dark:text-white">
                                                    {{ isEditing ? 'Edit Question Type' : 'Create Question Type' }}
                                                </DialogTitle>
                                                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                                    {{ isEditing ? 'Update the question type information' : 'Create a new question type for assessments' }}
                                                </p>
                                            </div>
                                        </div>
                                        <button
                                            type="button"
                                            @click="$emit('close')"
                                            class="rounded-xl p-2 text-gray-400 hover:text-gray-500 dark:hover:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors duration-200"
                                        >
                                            <X class="h-5 w-5" />
                                        </button>
                                    </div>

                                    <!-- Form Content -->
                                    <form @submit.prevent="submit" class="flex-1 flex flex-col">
                                        <div class="flex-1 px-6 py-6 space-y-6 overflow-y-auto">

                                            <!-- Code -->
                                            <div>
                                                <Label for="code" class="text-sm font-semibold text-gray-900 dark:text-white">
                                                    Code <span class="text-red-500">*</span>
                                                </Label>
                                                <Input
                                                    id="code"
                                                    v-model="form.code"
                                                    type="text"
                                                    required
                                                    class="mt-2 h-12 bg-gray-50/50 dark:bg-gray-800/50 border-gray-200 dark:border-gray-700 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200"
                                                    :class="{ 'border-red-500 focus:ring-red-500': errors.code }"
                                                    placeholder="e.g., MCQ, TF, SA"
                                                    maxlength="10"
                                                />
                                                <p v-if="errors.code" class="mt-2 text-sm text-red-600 flex items-center gap-1">
                                                    <AlertCircle class="h-4 w-4" />
                                                    {{ errors.code }}
                                                </p>
                                                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                                    Short unique identifier (max 10 characters)
                                                </p>
                                            </div>

                                            <!-- Name -->
                                            <div>
                                                <Label for="name" class="text-sm font-semibold text-gray-900 dark:text-white">
                                                    Name <span class="text-red-500">*</span>
                                                </Label>
                                                <Input
                                                    id="name"
                                                    v-model="form.name"
                                                    type="text"
                                                    required
                                                    class="mt-2 h-12 bg-gray-50/50 dark:bg-gray-800/50 border-gray-200 dark:border-gray-700 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200"
                                                    :class="{ 'border-red-500 focus:ring-red-500': errors.name }"
                                                    placeholder="e.g., Multiple Choice Question"
                                                />
                                                <p v-if="errors.name" class="mt-2 text-sm text-red-600 flex items-center gap-1">
                                                    <AlertCircle class="h-4 w-4" />
                                                    {{ errors.name }}
                                                </p>
                                            </div>

                                            <!-- Description -->
                                            <div>
                                                <Label for="description" class="text-sm font-semibold text-gray-900 dark:text-white">
                                                    Description
                                                </Label>
                                                <textarea
                                                    id="description"
                                                    v-model="form.description"
                                                    rows="4"
                                                    class="mt-2 block w-full rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50/50 dark:bg-gray-800/50 px-4 py-3 text-sm text-gray-900 dark:text-gray-100 placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200 resize-none"
                                                    :class="{ 'border-red-500 focus:ring-red-500': errors.description }"
                                                    placeholder="Describe the question type and its use cases..."
                                                ></textarea>
                                                <p v-if="errors.description" class="mt-2 text-sm text-red-600 flex items-center gap-1">
                                                    <AlertCircle class="h-4 w-4" />
                                                    {{ errors.description }}
                                                </p>
                                            </div>

                                            <!-- Status -->
                                            <div>
                                                <Label for="status" class="text-sm font-semibold text-gray-900 dark:text-white">
                                                    Status <span class="text-red-500">*</span>
                                                </Label>
                                                <Select v-model="form.status" required>
                                                    <SelectTrigger class="mt-2 h-12 bg-gray-50/50 dark:bg-gray-800/50 border-gray-200 dark:border-gray-700 rounded-xl text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200" :class="{ 'border-red-500 focus:ring-red-500': errors.status }">
                                                        <SelectValue placeholder="Select status" />
                                                    </SelectTrigger>
                                                    <SelectContent class="bg-white/95 dark:bg-gray-900/95 backdrop-blur-xl border border-gray-200 dark:border-gray-700 rounded-xl shadow-xl">
                                                        <SelectItem value="active" class="text-gray-900 dark:text-gray-100 rounded-lg">Active</SelectItem>
                                                        <SelectItem value="inactive" class="text-gray-900 dark:text-gray-100 rounded-lg">Inactive</SelectItem>
                                                    </SelectContent>
                                                </Select>
                                                <p v-if="errors.status" class="mt-2 text-sm text-red-600 flex items-center gap-1">
                                                    <AlertCircle class="h-4 w-4" />
                                                    {{ errors.status }}
                                                </p>
                                            </div>
                                        </div>

                                        <!-- Actions -->
                                        <div class="flex-shrink-0 px-6 py-6 border-t border-gray-200/50 dark:border-gray-700/50 bg-gray-50/30 dark:bg-gray-800/30">
                                            <div class="flex gap-3">
                                                <button
                                                    type="button"
                                                    @click="$emit('close')"
                                                    class="flex-1 inline-flex justify-center items-center gap-2 px-4 py-3 bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 border border-gray-300 dark:border-gray-600 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-700 focus:ring-2 focus:ring-gray-500 focus:border-transparent transition-all duration-200 font-medium"
                                                >
                                                    Cancel
                                                </button>
                                                <button
                                                    type="submit"
                                                    :disabled="processing"
                                                    class="flex-1 inline-flex justify-center items-center gap-2 px-4 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-xl hover:from-indigo-500 hover:to-purple-500 focus:ring-2 focus:ring-indigo-500 focus:border-transparent disabled:opacity-50 disabled:cursor-not-allowed transition-all duration-200 font-medium shadow-lg"
                                                >
                                                    <span v-if="processing">
                                                        <svg class="animate-spin h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                                        </svg>
                                                    </span>
                                                    <span v-else>
                                                        <Check class="h-4 w-4" />
                                                    </span>
                                                    {{ processing ? (isEditing ? 'Updating...' : 'Creating...') : (isEditing ? 'Update' : 'Create') }}
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </DialogPanel>
                        </TransitionChild>
                    </div>
                </div>
            </div>
        </Dialog>
    </TransitionRoot>
</template>

<script setup lang="ts">
import { ref, computed, watch } from 'vue';
import { router } from '@inertiajs/vue3';
import { Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot } from '@headlessui/vue';
import { Shapes, X, AlertCircle, Check } from 'lucide-vue-next';
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
    show: Boolean,
    questionType: Object,
});

const emit = defineEmits(['close', 'saved']);

// State
const processing = ref(false);
const errors = ref({});

const form = ref({
    code: '',
    name: '',
    description: '',
    status: 'active',
});

const isEditing = computed(() => !!props.questionType);

// Methods
const resetForm = () => {
    form.value = {
        code: '',
        name: '',
        description: '',
        status: 'active',
    };
};

// Watch for prop changes
watch(() => props.questionType, (newQuestionType) => {
    if (newQuestionType) {
        form.value = {
            code: newQuestionType.code || '',
            name: newQuestionType.name || '',
            description: newQuestionType.description || '',
            status: newQuestionType.status || 'active',
        };
    } else {
        resetForm();
    }
}, { immediate: true });

watch(() => props.show, (show) => {
    if (!show) {
        resetForm();
        errors.value = {};
    }
});

const submit = () => {
    processing.value = true;
    errors.value = {};

    const data = {
        ...form.value,
    };

    const url = isEditing.value 
        ? route('admin.master.question-types.update', props.questionType.id)
        : route('admin.master.question-types.store');

    const method = isEditing.value ? 'put' : 'post';

    router[method](url, data, {
        onSuccess: () => {
            emit('saved');
            processing.value = false;
        },
        onError: (responseErrors) => {
            errors.value = responseErrors;
            processing.value = false;
        },
    });
};
</script>