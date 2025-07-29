<template>
    <AdminLayout>
        <div class="px-4 sm:px-6 lg:px-8 py-8">
            <!-- Header -->
            <div class="mb-8">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-semibold text-gray-900 dark:text-white">Test Question</h1>
                        <p class="mt-2 text-sm text-gray-700 dark:text-gray-300">
                            Test this diagnostic question as if taking the assessment
                        </p>
                    </div>
                    <div class="flex items-center space-x-3">
                        <Link
                            :href="route('admin.diagnostics.items.show', item.id)"
                            class="inline-flex items-center rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-200 shadow-sm hover:bg-gray-50 dark:hover:bg-gray-600"
                        >
                            <EyeIcon class="-ml-1 mr-2 h-4 w-4" />
                            View Details
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
                <!-- Question Area -->\n                <div class="lg:col-span-2">
                    <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg overflow-hidden">
                        <!-- Question Header -->\n                        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-blue-900/20 dark:to-indigo-900/20 px-6 py-4 border-b border-gray-200 dark:border-gray-700">
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
                                    <div class="text-2xl font-bold text-blue-600 dark:text-blue-400">
                                        {{ Math.floor(Math.random() * 60) + 30 }}s
                                    </div>
                                    <div class="text-xs text-gray-500 dark:text-gray-400">Time Limit</div>\n                                </div>
                            </div>
                        </div>

                        <!-- Question Content -->\n                        <div class="px-6 py-8">
                            <!-- Render the appropriate quiz type component -->\n                            <component
                                :is="getQuizComponent()"
                                :question="formatQuestionForComponent()"
                                @answer-selected="handleAnswerSelected"
                                class="question-component"
                            />
                        </div>

                        <!-- Submit Button -->\n                        <div class="px-6 py-4 bg-gray-50 dark:bg-gray-900 border-t border-gray-200 dark:border-gray-700">
                            <div class="flex justify-between items-center">
                                <div class="text-sm text-gray-600 dark:text-gray-400">
                                    Select your answer and click submit to see the review.
                                </div>
                                <button
                                    @click="submitAnswer"
                                    :disabled="!hasAnswer"
                                    :class="[
                                        hasAnswer
                                            ? 'bg-green-600 hover:bg-green-700 text-white'
                                            : 'bg-gray-300 dark:bg-gray-600 text-gray-500 dark:text-gray-400 cursor-not-allowed',
                                        'inline-flex items-center rounded-md px-6 py-3 text-sm font-semibold shadow-sm transition-colors'
                                    ]"
                                >
                                    <CheckCircleIcon class="-ml-1 mr-2 h-4 w-4" />
                                    Submit Answer
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->\n                <div class="space-y-6">
                    <!-- Question Details -->\n                    <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6">
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
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Type</dt>
                                <dd class="text-sm text-gray-900 dark:text-white">{{ item.type?.name }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Dimension</dt>
                                <dd class="text-sm text-gray-900 dark:text-white">{{ item.dimension }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Difficulty</dt>
                                <dd class="text-sm text-gray-900 dark:text-white">{{ getDifficultyLabel(item.difficulty_level) }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Bloom Level</dt>
                                <dd class="text-sm text-gray-900 dark:text-white">{{ getBloomLabel(item.bloom_level) }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Status</dt>
                                <dd>
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
                                </dd>
                            </div>
                        </dl>
                    </div>

                    <!-- IRT Parameters -->\n                    <div v-if="item.irt_a || item.irt_b || item.irt_c" class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">IRT Parameters</h3>
                        <dl class="space-y-3">
                            <div v-if="item.irt_a">
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Discrimination (a)</dt>
                                <dd class="text-sm text-gray-900 dark:text-white">{{ item.irt_a }}</dd>
                            </div>
                            <div v-if="item.irt_b">
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Difficulty (b)</dt>
                                <dd class="text-sm text-gray-900 dark:text-white">{{ item.irt_b }}</dd>
                            </div>
                            <div v-if="item.irt_c">
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Guessing (c)</dt>
                                <dd class="text-sm text-gray-900 dark:text-white">{{ item.irt_c }}</dd>
                            </div>
                        </dl>
                    </div>

                    <!-- Actions -->\n                    <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Actions</h3>
                        <div class="space-y-3">
                            <Link
                                :href="route('admin.diagnostics.items.index')"
                                class="flex items-center justify-center w-full rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 px-3 py-2 text-sm font-medium text-gray-700 dark:text-gray-200 shadow-sm hover:bg-gray-50 dark:hover:bg-gray-600"
                            >
                                <ArrowLeftIcon class="-ml-1 mr-2 h-4 w-4" />
                                Back to Questions
                            </Link>
                            <button
                                @click="resetTest"
                                class="flex items-center justify-center w-full rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 px-3 py-2 text-sm font-medium text-gray-700 dark:text-gray-200 shadow-sm hover:bg-gray-50 dark:hover:bg-gray-600"
                            >
                                <ArrowPathIcon class="-ml-1 mr-2 h-4 w-4" />
                                Reset Test
                            </button>
                        </div>
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
import { 
    EyeIcon, 
    PencilIcon, 
    CheckCircleIcon, 
    ArrowLeftIcon,
    ArrowPathIcon
} from '@heroicons/vue/24/outline';

// Import quiz type components
import Type1 from '@/components/QuizTypes/Type1.vue';
import Type2 from '@/components/QuizTypes/Type2.vue';
import Type3 from '@/components/QuizTypes/Type3.vue';
import Type4 from '@/components/QuizTypes/Type4.vue';
import Type5 from '@/components/QuizTypes/Type5.vue';
import Type6 from '@/components/QuizTypes/Type6.vue';
import Type7 from '@/components/QuizTypes/Type7.vue';

const props = defineProps({
    item: Object,
});

const userAnswer = ref(null);

const hasAnswer = computed(() => {
    return userAnswer.value !== null && userAnswer.value !== undefined && userAnswer.value !== '';
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

const formatQuestionForComponent = () => {
    // Format the question data to match what the quiz components expect
    return {
        id: props.item.id,
        content: props.item.content,
        options: props.item.options || [],
        settings: props.item.settings || {},
        // Add any additional formatting needed by specific components
    };
};

const handleAnswerSelected = (answer) => {
    userAnswer.value = answer;
};

const submitAnswer = () => {
    if (!hasAnswer.value) return;
    
    // Submit the answer to the review endpoint
    router.post(route('admin.diagnostics.items.review', props.item.id), {
        user_answer: userAnswer.value
    });
};

const resetTest = () => {
    userAnswer.value = null;
    // Reset any component state if needed
    window.location.reload();
};
</script>

<style scoped>
.question-component {
    /* Any specific styling for the quiz components in test mode */
    font-size: 1rem;
}
</style>