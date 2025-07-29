<template>
    <AdminLayout>
        <div class="px-4 sm:px-6 lg:px-8 py-8">
            <!-- Header -->
            <div class="mb-8">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-semibold text-gray-900 dark:text-white">Question Review</h1>
                        <p class="mt-2 text-sm text-gray-700 dark:text-gray-300">
                            Review your answer and see the correct solution
                        </p>
                    </div>
                    <div class="flex items-center space-x-3">
                        <Link
                            :href="route('admin.diagnostics.items.test', item.id)"
                            class="inline-flex items-center rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-200 shadow-sm hover:bg-gray-50 dark:hover:bg-gray-600"
                        >
                            <ArrowPathIcon class="-ml-1 mr-2 h-4 w-4" />
                            Test Again
                        </Link>
                        <Link
                            :href="route('admin.diagnostics.items.edit', item.id)"
                            class="inline-flex items-center rounded-md bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700"
                        >
                            <PencilIcon class="-ml-1 mr-2 h-4 w-4" />
                            Edit Question
                        </Link>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Review Area -->
                <div class="lg:col-span-2">
                    <!-- Result Banner -->
                    <div class="mb-6">
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
                                    <CheckCircleIcon
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
                    </div>

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

                        <!-- Question Content with Review -->
                        <div class="px-6 py-8">
                            <!-- Render the appropriate review component -->
                            <component
                                :is="getReviewComponent()"
                                :question="formatQuestionForComponent()"
                                :user-answer="userAnswer"
                                :correct-answer="item.correct_options"
                                :is-correct="isCorrect"
                                class="review-component"
                            />
                        </div>

                        <!-- Justifications/Explanations -->
                        <div v-if="item.justifications && Object.keys(item.justifications).length > 0" class="px-6 py-6 bg-gray-50 dark:bg-gray-900 border-t border-gray-200 dark:border-gray-700">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Explanations</h3>
                            <div class="space-y-4">
                                <div
                                    v-for="(justification, optionKey) in item.justifications"
                                    :key="optionKey"
                                    class="flex items-start space-x-3"
                                >
                                    <div class="flex-shrink-0">
                                        <div
                                            :class="[
                                                isCorrectOption(optionKey)
                                                    ? 'bg-green-100 text-green-600 dark:bg-green-900/30 dark:text-green-400'
                                                    : 'bg-gray-100 text-gray-600 dark:bg-gray-800 dark:text-gray-400',
                                                'w-6 h-6 rounded-full flex items-center justify-center text-xs font-medium'
                                            ]"
                                        >
                                            {{ getOptionLabel(optionKey) }}
                                        </div>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm text-gray-700 dark:text-gray-300">
                                            {{ justification }}
                                        </p>
                                        <div v-if="isCorrectOption(optionKey)" class="mt-1">
                                            <span class="inline-flex items-center text-xs font-medium text-green-600 dark:text-green-400">
                                                <CheckCircleIcon class="w-3 h-3 mr-1" />
                                                Correct Answer
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="px-6 py-4 bg-gray-50 dark:bg-gray-900 border-t border-gray-200 dark:border-gray-700">
                            <div class="flex justify-between items-center">
                                <div class="text-sm text-gray-600 dark:text-gray-400">
                                    Your answer: <span class="font-medium">{{ formatUserAnswer() }}</span>
                                </div>
                                <div class="flex space-x-3">
                                    <Link
                                        :href="route('admin.diagnostics.items.test', item.id)"
                                        class="inline-flex items-center rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-200 shadow-sm hover:bg-gray-50 dark:hover:bg-gray-600"
                                    >
                                        <ArrowPathIcon class="-ml-1 mr-2 h-4 w-4" />
                                        Test Again
                                    </Link>
                                    <Link
                                        :href="route('admin.diagnostics.items.index')"
                                        class="inline-flex items-center rounded-md bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700"
                                    >
                                        <ArrowLeftIcon class="-ml-1 mr-2 h-4 w-4" />
                                        Back to Questions
                                    </Link>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="space-y-6">
                    <!-- Performance Summary -->
                    <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Performance</h3>
                        <div class="space-y-4">
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-600 dark:text-gray-400">Result</span>
                                <span
                                    :class="[
                                        isCorrect
                                            ? 'text-green-600 dark:text-green-400'
                                            : 'text-red-600 dark:text-red-400',
                                        'text-sm font-medium'
                                    ]"
                                >
                                    {{ isCorrect ? 'Correct' : 'Incorrect' }}
                                </span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-600 dark:text-gray-400">Difficulty</span>
                                <span class="text-sm font-medium text-gray-900 dark:text-white">
                                    {{ getDifficultyLabel(item.difficulty_level) }}
                                </span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-600 dark:text-gray-400">Bloom Level</span>
                                <span class="text-sm font-medium text-gray-900 dark:text-white">
                                    {{ getBloomLabel(item.bloom_level) }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Question Details -->
                    <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Question Details</h3>
                        <dl class="space-y-3">
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Domain</dt>
                                <dd class="text-sm text-gray-900 dark:text-white">{{ item.subtopic?.topic?.domain?.name }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Topic</dt>
                                <dd class="text-sm text-gray-900 dark:text-white">{{ item.subtopic?.topic?.name }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Subtopic</dt>
                                <dd class="text-sm text-gray-900 dark:text-white">{{ item.subtopic?.name }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Dimension</dt>
                                <dd class="text-sm text-gray-900 dark:text-white">{{ item.dimension }}</dd>
                            </div>
                        </dl>
                    </div>

                    <!-- Actions -->
                    <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Actions</h3>
                        <div class="space-y-3">
                            <Link
                                :href="route('admin.diagnostics.items.show', item.id)"
                                class="flex items-center justify-center w-full rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 px-3 py-2 text-sm font-medium text-gray-700 dark:text-gray-200 shadow-sm hover:bg-gray-50 dark:hover:bg-gray-600"
                            >
                                <EyeIcon class="-ml-1 mr-2 h-4 w-4" />
                                View Details
                            </Link>
                            <Link
                                :href="route('admin.diagnostics.items.edit', item.id)"
                                class="flex items-center justify-center w-full rounded-md bg-indigo-600 px-3 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700"
                            >
                                <PencilIcon class="-ml-1 mr-2 h-4 w-4" />
                                Edit Question
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>

<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import AdminLayout from '@/layouts/AdminLayout.vue';
import { 
    EyeIcon, 
    PencilIcon, 
    CheckCircleIcon, 
    XCircleIcon,
    ArrowLeftIcon,
    ArrowPathIcon
} from '@heroicons/vue/24/outline';

// Import review type components
import Type1Review from '@/components/QuizTypes/Type1Review.vue';
import Type2Review from '@/components/QuizTypes/Type2Review.vue';
import Type3Review from '@/components/QuizTypes/Type3Review.vue';
import Type4Review from '@/components/QuizTypes/Type4Review.vue';
import Type5Review from '@/components/QuizTypes/Type5Review.vue';
import Type6Review from '@/components/QuizTypes/Type6Review.vue';
import Type7Review from '@/components/QuizTypes/Type7Review.vue';

const props = defineProps({
    item: Object,
    userAnswer: [String, Array, Number],
    isCorrect: Boolean,
});

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

const formatQuestionForComponent = () => {
    return {
        id: props.item.id,
        content: props.item.content,
        options: props.item.options || [],
        settings: props.item.settings || {},
        justifications: props.item.justifications || {},
    };
};

const formatUserAnswer = () => {
    if (Array.isArray(props.userAnswer)) {
        return props.userAnswer.join(', ');
    }
    return String(props.userAnswer || 'No answer');
};

const isCorrectOption = (optionKey) => {
    const correctOptions = Array.isArray(props.item.correct_options) 
        ? props.item.correct_options 
        : [props.item.correct_options];
    
    return correctOptions.includes(optionKey) || correctOptions.includes(String(optionKey));
};

const getOptionLabel = (optionKey) => {
    // Convert option key to letter (0 -> A, 1 -> B, etc.)
    if (typeof optionKey === 'number') {
        return String.fromCharCode(65 + optionKey);
    }
    return optionKey;
};
</script>

<style scoped>
.review-component {
    /* Styling for review components */
    font-size: 1rem;
}
</style>