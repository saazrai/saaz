<template>
    <AdminLayout>
        <div class="px-4 sm:px-6 lg:px-8 py-8">
            <!-- Header -->
            <div class="sm:flex sm:items-center">
                <div class="sm:flex-auto">
                        <div class="flex items-center space-x-4">
                            <h1 class="text-3xl font-semibold text-gray-900 dark:text-white">
                                {{ showingReview ? 'Answer Review' : '' }}
                            </h1>
                            
                            <!-- Navigation -->
                            <div class="flex items-center space-x-3">
                                <!-- Back Button -->
                                <Link
                                    :href="route('admin.diagnostics.items.index')"
                                    class="inline-flex items-center px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm text-sm font-medium text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors"
                                >
                                    <ArrowLeftIcon class="w-4 h-4 mr-2" />
                                    Back
                                </Link>
                                
                                <!-- Previous Button -->
                                <button
                                    @click="navigateToPrevious"
                                    :disabled="!hasPrevious"
                                    class="inline-flex items-center px-3 py-2 border rounded-md shadow-sm text-sm font-medium transition-colors"
                                    :class="[
                                        hasPrevious 
                                            ? 'border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600'
                                            : 'border-gray-200 dark:border-gray-700 text-gray-400 dark:text-gray-500 bg-gray-50 dark:bg-gray-800 cursor-not-allowed'
                                    ]"
                                >
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                                    </svg>
                                    Previous
                                </button>
                                
                                <!-- Current Question -->
                                <div class="px-4 py-2 bg-blue-100 dark:bg-blue-900/30 border border-blue-200 dark:border-blue-800 rounded-md">
                                    <span class="text-lg font-bold text-blue-700 dark:text-blue-300">
                                        {{ item.id }}
                                    </span>
                                </div>
                                
                                <!-- Next Button -->
                                <button
                                    @click="navigateToNext"
                                    :disabled="!hasNext"
                                    class="inline-flex items-center px-3 py-2 border rounded-md shadow-sm text-sm font-medium transition-colors"
                                    :class="[
                                        hasNext 
                                            ? 'border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600'
                                            : 'border-gray-200 dark:border-gray-700 text-gray-400 dark:text-gray-500 bg-gray-50 dark:bg-gray-800 cursor-not-allowed'
                                    ]"
                                >
                                    Next
                                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                </div>
                <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none space-x-3">
                    <button
                        v-if="showingReview"
                        @click="resetTest"
                        class="inline-flex items-center justify-center rounded-md bg-blue-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500"
                    >
                        <ArrowPathIcon class="-ml-0.5 mr-1.5 h-5 w-5" />
                        Test Again
                    </button>
                    <Link
                        :href="route('admin.diagnostics.items.edit', item.id)"
                        class="inline-flex items-center justify-center rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500"
                    >
                        <PencilIcon class="-ml-0.5 mr-1.5 h-5 w-5" />
                        Edit
                    </Link>
                </div>
            </div>

            <!-- Content -->
            <div class="mt-8 grid grid-cols-1 gap-6 lg:grid-cols-3">
                <!-- Main Content -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Test Mode -->
                    <div v-if="!showingReview" class="bg-white dark:bg-gray-800 shadow-lg rounded-lg overflow-hidden">
                        <!-- Question Header -->
                        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-blue-900/20 dark:to-indigo-900/20 px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                            <div class="flex items-center justify-between">
                                <div>
                                    <div class="flex items-center space-x-4 text-sm text-gray-600 dark:text-gray-400">
                                        <span>{{ item.subtopic?.topic?.domain?.name }}</span>
                                        <span>•</span>
                                        <span>{{ item.type?.name }}</span>
                                        <span>•</span>
                                        <span>{{ getDifficultyLabel(item.difficulty_level) }}</span>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <span
                                        :class="[
                                            item.status === 'published'
                                                ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400'
                                                : item.status === 'draft'
                                                ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400'
                                                : 'bg-gray-100 text-gray-800 dark:bg-gray-900/30 dark:text-gray-400',
                                            'inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium capitalize'
                                        ]"
                                    >
                                        {{ item.status }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Question Content -->
                        <div class="px-6 py-8">
                            <!-- Render the appropriate quiz type component -->
                            <component
                                :is="getQuizComponent()"
                                :question="formatQuestionForComponent()"
                                :answer="formatAnswerForComponent()"
                                :isDark="isAdminDark"
                                @selected="handleAnswerChanged"
                            />
                        </div>

                        <!-- Submit Button -->
                        <div class="px-6 py-4 bg-gray-50 dark:bg-gray-900 border-t border-gray-200 dark:border-gray-700">
                            <div class="flex justify-center">
                                <button
                                    @click="submitAnswer"
                                    :disabled="!hasAnswer || isSubmitting"
                                    class="w-full max-w-md px-6 py-3 rounded-xl font-medium transition-all active:scale-95 shadow-lg"
                                    :class="[
                                        hasAnswer && !isSubmitting
                                            ? 'bg-blue-500 hover:bg-blue-600 text-white shadow-blue-500/25 cursor-pointer' 
                                            : 'bg-gray-300 dark:bg-gray-600 text-gray-500 dark:text-gray-400 cursor-not-allowed opacity-60 shadow-none',
                                        (!hasAnswer || isSubmitting) && 'pointer-events-none'
                                    ]"
                                >
                                    <span v-if="isSubmitting" class="flex items-center justify-center gap-2">
                                        <svg class="animate-spin h-4 w-4" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                        </svg>
                                        Submitting...
                                    </span>
                                    <span v-else>Submit Answer</span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Review Mode -->
                    <div v-else class="space-y-6">
                        <!-- Result Banner -->
                        <div
                            :class="[
                                isCorrect
                                    ? 'bg-green-50 border-green-200 dark:bg-green-900/20 dark:border-green-800'
                                    : 'bg-red-50 border-red-200 dark:bg-red-900/20 dark:border-red-800',
                                'border rounded-lg p-4'
                            ]"
                        >
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <CheckIcon
                                        v-if="isCorrect"
                                        class="h-8 w-8 text-green-600 dark:text-green-400"
                                    />
                                    <XCircleIcon
                                        v-else
                                        class="h-8 w-8 text-red-600 dark:text-red-400"
                                    />
                                </div>
                                <div class="ml-3">
                                    <h3
                                        :class="[
                                            isCorrect
                                                ? 'text-green-800 dark:text-green-200'
                                                : 'text-red-800 dark:text-red-200',
                                            'text-lg font-medium'
                                        ]"
                                    >
                                        {{ isCorrect ? 'Correct!' : 'Incorrect' }}
                                    </h3>
                                    <p
                                        :class="[
                                            isCorrect
                                                ? 'text-green-600 dark:text-green-300'
                                                : 'text-red-600 dark:text-red-300',
                                            'text-sm mt-1'
                                        ]"
                                    >
                                        {{ isCorrect 
                                            ? 'You selected the correct answer.' 
                                            : 'Your answer was not correct. Review the explanation below.' 
                                        }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Review Content -->
                        <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg overflow-hidden">
                            <!-- Question Header -->
                            <div class="bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-blue-900/20 dark:to-indigo-900/20 px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Question #{{ item.id }}</h2>
                                        <div class="mt-1 flex items-center space-x-4 text-sm text-gray-600 dark:text-gray-400">
                                            <span>{{ item.subtopic?.topic?.domain?.name }}</span>
                                            <span>•</span>
                                            <span>{{ item.type?.name }}</span>
                                            <span>•</span>
                                            <span>{{ getDifficultyLabel(item.difficulty_level) }}</span>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <div
                                            :class="[
                                                isCorrect
                                                    ? 'text-green-600 dark:text-green-400'
                                                    : 'text-red-600 dark:text-red-400',
                                                'text-2xl font-bold'
                                            ]"
                                        >
                                            {{ isCorrect ? '✓' : '✗' }}
                                        </div>
                                        <div class="text-xs text-gray-500 dark:text-gray-400">Result</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Review Component -->
                            <div class="px-6 py-8">
                                <component
                                    :is="getReviewComponent()"
                                    :question="formatQuestionForComponent()"
                                    :answer="formatAnswerForReview()"
                                    :isDark="isAdminDark"
                                />
                            </div>

                            <!-- Answer Summary -->
                            <div class="px-6 py-4 bg-gray-50 dark:bg-gray-900 border-t border-gray-200 dark:border-gray-700">
                                <div class="text-sm text-gray-600 dark:text-gray-400">
                                    Your answer: <span class="font-medium">{{ formatUserAnswer() }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="space-y-6">
                    <!-- Basic Info -->
                    <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Basic Information</h3>
                        <dl class="space-y-3">
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">ID</dt>
                                <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ item.id }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Status</dt>
                                <dd class="mt-1">
                                    <span
                                        :class="[
                                            item.status === 'published'
                                                ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400'
                                                : item.status === 'draft'
                                                ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400'
                                                : 'bg-gray-100 text-gray-800 dark:bg-gray-900/30 dark:text-gray-400',
                                            'inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium capitalize'
                                        ]"
                                    >
                                        {{ item.status }}
                                    </span>
                                </dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Question Type</dt>
                                <dd class="mt-1">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400">
                                        {{ item.type?.code || 'Unknown' }}
                                    </span>
                                </dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Dimension</dt>
                                <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ item.dimension || 'Not specified' }}</dd>
                            </div>
                        </dl>
                    </div>

                    <!-- Domain & Topic -->
                    <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Classification</h3>
                        <dl class="space-y-3">
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Domain</dt>
                                <dd class="mt-1 text-sm font-medium text-gray-900 dark:text-white">
                                    {{ item.subtopic?.topic?.domain?.name || 'Not specified' }}
                                </dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Topic</dt>
                                <dd class="mt-1 text-sm text-gray-900 dark:text-white">
                                    {{ item.subtopic?.topic?.name || 'Not specified' }}
                                </dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Subtopic</dt>
                                <dd class="mt-1 text-sm text-gray-900 dark:text-white">
                                    {{ item.subtopic?.name || 'Not specified' }}
                                </dd>
                            </div>
                        </dl>
                    </div>

                    <!-- Difficulty & Bloom Level -->
                    <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Assessment Levels</h3>
                        <dl class="space-y-3">
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Difficulty Level</dt>
                                <dd class="mt-1 text-sm text-gray-900 dark:text-white">
                                    {{ getDifficultyLabel(item.difficulty_level) }}
                                </dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Bloom's Taxonomy Level</dt>
                                <dd class="mt-1 text-sm text-gray-900 dark:text-white">
                                    {{ getBloomLabel(item.bloom_level) }}
                                </dd>
                            </div>
                        </dl>
                    </div>

                    <!-- IRT Parameters -->
                    <div v-if="item.irt_a || item.irt_b || item.irt_c" class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">IRT Parameters</h3>
                        <dl class="space-y-3">
                            <div v-if="item.irt_a">
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Discrimination (a)</dt>
                                <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ item.irt_a }}</dd>
                            </div>
                            <div v-if="item.irt_b">
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Difficulty (b)</dt>
                                <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ item.irt_b }}</dd>
                            </div>
                            <div v-if="item.irt_c">
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Guessing (c)</dt>
                                <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ item.irt_c }}</dd>
                            </div>
                        </dl>
                    </div>

                    <!-- Timestamps -->
                    <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Timestamps</h3>
                        <dl class="space-y-3">
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Created</dt>
                                <dd class="mt-1 text-sm text-gray-900 dark:text-white">
                                    {{ formatDate(item.created_at) }}
                                </dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Last Updated</dt>
                                <dd class="mt-1 text-sm text-gray-900 dark:text-white">
                                    {{ formatDate(item.updated_at) }}
                                </dd>
                            </div>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>

<script setup lang="ts">
import { ref, computed } from 'vue';
import { Link, router } from '@inertiajs/vue3';
import AdminLayout from '@/layouts/AdminLayout.vue';
import { useTheme } from '@/composables/useTheme';
import { 
    ArrowLeftIcon,
    ArrowPathIcon,
    PencilIcon,
    CheckIcon,
    XCircleIcon
} from '@heroicons/vue/24/outline';

// Import Quiz Type Components
import Type1 from '@/components/QuizTypes/Type1.vue';
import Type2 from '@/components/QuizTypes/Type2.vue';
import Type3 from '@/components/QuizTypes/Type3.vue';
import Type4 from '@/components/QuizTypes/Type4.vue';
import Type5 from '@/components/QuizTypes/Type5.vue';
import Type6 from '@/components/QuizTypes/Type6.vue';
import Type7 from '@/components/QuizTypes/Type7.vue';

// Import Review Type Components
import Type1Review from '@/components/QuizTypes/Type1Review.vue';
import Type2Review from '@/components/QuizTypes/Type2Review.vue';
import Type3Review from '@/components/QuizTypes/Type3Review.vue';
import Type4Review from '@/components/QuizTypes/Type4Review.vue';
import Type5Review from '@/components/QuizTypes/Type5Review.vue';
import Type6Review from '@/components/QuizTypes/Type6Review.vue';
import Type7Review from '@/components/QuizTypes/Type7Review.vue';

const props = defineProps({
    item: Object,
});

// Theme management
const { isAdminDark } = useTheme();

// Navigation state (simple implementation for demo)
const totalItems = ref(100); // This should come from backend
const hasPrevious = computed(() => props.item.id > 1);
const hasNext = computed(() => props.item.id < totalItems.value);

// State management
const showingReview = ref(false);
const userAnswer = ref(null);
const isCorrect = ref(false);
const isSubmitting = ref(false);

const hasAnswer = computed(() => {
    return userAnswer.value !== null && userAnswer.value !== undefined && userAnswer.value !== '';
});

// Component selection
const getQuizComponent = () => {
    const typeComponents = {
        1: Type1,
        2: Type2,
        3: Type3,
        4: Type4,
        5: Type5,
        6: Type6,
        7: Type7,
    };
    
    return typeComponents[props.item.type_id] || Type1;
};

// Format data for Quiz Type components
const formatQuestionForComponent = () => {
    return {
        id: props.item.id,
        content: props.item.content,
        options: props.item.options || [],
        type_id: props.item.type_id,
        settings: props.item.settings || {},
        difficulty_level: props.item.difficulty_level,
        bloom_level: props.item.bloom_level,
        correct_options: props.item.correct_options || []
    };
};

const formatAnswerForComponent = () => {
    return {
        question_id: props.item.id,
        selected_options: userAnswer.value ? (Array.isArray(userAnswer.value) ? userAnswer.value : [userAnswer.value]) : [],
        duration: 0,
        is_correct: false
    };
};

const formatAnswerForReview = () => {
    return {
        question_id: props.item.id,
        selected_options: userAnswer.value ? (Array.isArray(userAnswer.value) ? userAnswer.value : [userAnswer.value]) : [],
        duration: 0,
        is_correct: isCorrect.value
    };
};

const getReviewComponent = () => {
    const reviewComponents = {
        1: Type1Review,
        2: Type2Review,
        3: Type3Review,
        4: Type4Review,
        5: Type5Review,
        6: Type6Review,
        7: Type7Review,
    };
    
    return reviewComponents[props.item.type_id] || Type1Review;
};

// Helper functions
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

const formatDate = (dateString) => {
    if (!dateString) return 'Not set';
    return new Date(dateString).toLocaleDateString('en-US', {
        year: 'numeric',
        month: 'long',
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
    });
};

const formatUserAnswer = () => {
    if (Array.isArray(userAnswer.value)) {
        return userAnswer.value.join(', ');
    }
    return String(userAnswer.value || 'No answer');
};

// Answer handling
const handleAnswerChanged = (selection) => {
    // QuizTypes component emits arrays for consistency
    if (props.item.type_id === 2) {
        // Multiple choice - selection is an array
        userAnswer.value = Array.isArray(selection) ? selection : [selection];
    } else {
        // Single choice - selection is an array but we take the first item
        userAnswer.value = Array.isArray(selection) ? selection[0] : selection;
    }
};


const submitAnswer = () => {
    if (!hasAnswer.value || isSubmitting.value) return;
    
    isSubmitting.value = true;
    
    // Determine if answer is correct
    const correctOptions = props.item.correct_options || [];
    
    if (Array.isArray(userAnswer.value) && Array.isArray(correctOptions)) {
        // Multi-select comparison
        isCorrect.value = userAnswer.value.length === correctOptions.length &&
                         userAnswer.value.every(answer => correctOptions.includes(answer));
    } else {
        // Single answer comparison
        isCorrect.value = correctOptions.includes(userAnswer.value) || 
                         correctOptions.includes(String(userAnswer.value));
    }
    
    // Show review mode
    showingReview.value = true;
    isSubmitting.value = false;
};

const resetTest = () => {
    showingReview.value = false;
    userAnswer.value = null;
    isCorrect.value = false;
    isSubmitting.value = false;
};

// Navigation functions
const navigateToPrevious = () => {
    if (hasPrevious.value) {
        router.visit(route('admin.diagnostics.items.show', props.item.id - 1));
    }
};

const navigateToNext = () => {
    if (hasNext.value) {
        router.visit(route('admin.diagnostics.items.show', props.item.id + 1));
    }
};
</script>