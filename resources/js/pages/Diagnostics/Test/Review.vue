<template>
    <div class="min-h-screen bg-gray-50 dark:bg-gray-900 pb-20">
        <!-- Header -->
        <div class="bg-white dark:bg-gray-800 shadow-xs">
            <div class="container mx-auto px-4 py-4">
                <div class="flex items-center justify-between">
                    <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Review Assessment</h1>
                    <div class="flex items-center gap-3">
                        <!-- Theme Toggle Button -->
                        <button
                            @click="toggleTheme"
                            class="p-2 rounded-lg bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors"
                            aria-label="Toggle theme"
                        >
                            <SunIcon v-if="isDark" class="w-5 h-5 text-yellow-500" />
                            <MoonIcon v-else class="w-5 h-5 text-gray-700" />
                        </button>
                        
                        <Link
                            :href="route('assessments.diagnostics.results', diagnostic.id)"
                            class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg transition-colors"
                        >
                            <XIcon class="w-4 h-4 mr-2" />
                            End Review
                        </Link>
                    </div>
                </div>
            </div>
        </div>

        <!-- Progress Bar -->
        <div class="bg-blue-50 dark:bg-gray-800 border-b border-blue-100 dark:border-gray-700">
            <div class="container mx-auto px-4 py-3">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-sm font-medium text-gray-700 dark:text-gray-300">
                        Question {{ currentQuestionIndex + 1 }} of {{ diagnostic?.responses?.length ?? 0 }}
                    </span>
                    <span class="text-sm text-gray-600 dark:text-gray-400">
                        {{ Math.round(((currentQuestionIndex + 1) / (diagnostic?.responses?.length ?? 1)) * 100) }}% Complete
                    </span>
                </div>
                <div class="w-full bg-gray-300 dark:bg-gray-700 rounded-full h-2 overflow-hidden">
                    <div 
                        class="bg-blue-500 dark:bg-blue-600 h-2 transition-all duration-300"
                        :style="{ width: `${((currentQuestionIndex + 1) / (diagnostic?.responses?.length ?? 1)) * 100}%` }"
                    ></div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="container mx-auto px-4 py-6">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Question and Answer Section -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Use Type1Review Component -->
                    <Type1Review
                        :question="currentQuestionData"
                        :answer="currentResponse"
                        v-if="currentQuestionData"
                    />
                    <div v-else class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-8">
                        <div class="flex justify-center items-center h-32 text-gray-500">
                            <LoaderIcon class="w-6 h-6 animate-spin" />
                            <span class="ml-2">Loading question...</span>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="space-y-6">
                    <!-- Question Details -->
                    <Card class="bg-white dark:bg-gray-800 shadow-lg">
                        <CardHeader>
                            <CardTitle>Question Details</CardTitle>
                        </CardHeader>
                        <CardContent class="space-y-3">
                            <div class="flex items-start">
                                <span class="text-sm text-gray-600 dark:text-gray-400 min-w-[80px]">Domain:</span>
                                <span class="text-sm text-gray-900 dark:text-white font-medium">
                                    {{ currentQuestionData?.topic?.domain?.name ?? "N/A" }}
                                </span>
                            </div>
                            <Separator />
                            <div class="flex items-start">
                                <span class="text-sm text-gray-600 dark:text-gray-400 min-w-[80px]">Topic:</span>
                                <span class="text-sm text-gray-900 dark:text-white font-medium">
                                    {{ currentQuestionData?.topic?.name ?? "N/A" }}
                                </span>
                            </div>
                            <Separator />
                            <div class="w-full">
                                <div class="text-sm text-gray-600 dark:text-gray-400 mb-3 font-medium">Difficulty & Cognitive Level</div>
                                <div class="px-2">
                                    <BarChartLevelIndicator 
                                        v-if="currentQuestionData?.difficulty || currentQuestionData?.bloom"
                                        :difficulty-level="currentQuestionData?.difficulty || null"
                                        :bloom-level="currentQuestionData?.bloom || null"
                                    />
                                    <div v-else class="text-sm text-gray-500 dark:text-gray-400 italic">
                                        Level data not available
                                    </div>
                                </div>
                            </div>
                            <Separator />
                            <div class="flex items-start">
                                <span class="text-sm text-gray-600 dark:text-gray-400 min-w-[80px]">Your Answer:</span>
                                <span class="text-sm text-gray-900 dark:text-white">
                                    {{ formatAnswer(currentResponse?.user_answer) }}
                                </span>
                            </div>
                            <Separator />
                            <div class="flex items-start">
                                <span class="text-sm text-gray-600 dark:text-gray-400 min-w-[80px]">Correct Answer:</span>
                                <span class="text-sm text-green-600 dark:text-green-400 font-medium">
                                    {{ formatAnswer(currentQuestionData?.correct_options) }}
                                </span>
                            </div>
                            <Separator />
                            <div class="flex items-start">
                                <span class="text-sm text-gray-600 dark:text-gray-400 min-w-[80px]">Time Taken:</span>
                                <span class="text-sm text-gray-900 dark:text-white">
                                    {{ formatTime(currentResponse?.response_time_seconds) }}
                                </span>
                            </div>
                        </CardContent>
                    </Card>

                    <!-- Quick Navigation -->
                    <Card class="bg-white dark:bg-gray-800 shadow-lg">
                        <CardHeader>
                            <CardTitle>Quick Navigation</CardTitle>
                        </CardHeader>
                        <CardContent>
                            <div class="grid grid-cols-5 gap-2">
                                <button
                                    v-for="(response, index) in diagnostic.responses"
                                    :key="index"
                                    @click="currentQuestionIndex = index"
                                    :class="[
                                        'w-10 h-10 rounded-lg font-medium text-sm transition-all',
                                        currentQuestionIndex === index
                                            ? 'ring-2 ring-blue-500 ring-offset-2'
                                            : '',
                                        response.is_correct
                                            ? 'bg-green-100 dark:bg-green-900 text-green-700 dark:text-green-300'
                                            : 'bg-red-100 dark:bg-red-900 text-red-700 dark:text-red-300'
                                    ]"
                                >
                                    {{ index + 1 }}
                                </button>
                            </div>
                        </CardContent>
                    </Card>
                </div>
            </div>
        </div>

        <!-- Footer Navigation - Fixed at bottom -->
        <div class="fixed bottom-0 left-0 right-0 bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700 shadow-lg z-50">
            <div class="container mx-auto px-6 py-4">
                <div class="flex items-center justify-between">
                    <button
                        @click="previousQuestion"
                        :disabled="currentQuestionIndex === 0"
                        class="inline-flex items-center px-6 py-3 bg-gray-600 hover:bg-gray-700 disabled:bg-gray-400 disabled:cursor-not-allowed text-white font-medium rounded-lg transition-all transform hover:scale-105 disabled:hover:scale-100 shadow-md"
                    >
                        <ChevronLeftIcon class="w-5 h-5 mr-2" />
                        Previous
                    </button>

                    <div class="text-sm text-gray-600 dark:text-gray-400 font-medium">
                        Question {{ currentQuestionIndex + 1 }} of {{ diagnostic?.responses?.length ?? 0 }}
                    </div>

                    <button
                        v-if="!isLastQuestion"
                        @click="nextQuestion"
                        class="inline-flex items-center px-6 py-3 bg-linear-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-medium rounded-lg transition-all transform hover:scale-105 shadow-md"
                    >
                        Next
                        <ChevronRightIcon class="w-5 h-5 ml-2" />
                    </button>
                    <Link
                        v-else
                        :href="route('assessments.diagnostics.results', diagnostic.id)"
                        class="inline-flex items-center px-6 py-3 bg-linear-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white font-medium rounded-lg transition-all transform hover:scale-105 shadow-md"
                    >
                        <CheckIcon class="w-5 h-5 mr-2" />
                        Finish Review
                    </Link>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import { Link } from "@inertiajs/vue3";
import { ref, computed } from "vue";
import Type1Review from '@/components/QuizTypes/Type1Review.vue';
import BarChartLevelIndicator from '@/components/LevelIndicators/BarChartLevelIndicator.vue';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/shadcn/ui/card';
import Separator from '@/components/shadcn/ui/separator/Separator.vue';
import { 
    XIcon, 
    ChevronLeftIcon, 
    ChevronRightIcon,
    CheckIcon,
    LoaderIcon,
    SunIcon,
    MoonIcon
} from 'lucide-vue-next';

const props = defineProps({
    diagnostic: Object,
});

const currentQuestionIndex = ref(0);

// Theme state
const isDark = ref(false);

// Check initial theme
if (typeof window !== 'undefined') {
    isDark.value = document.documentElement.classList.contains('dark') || 
                   window.matchMedia('(prefers-color-scheme: dark)').matches;
}

// Theme toggle function
const toggleTheme = () => {
    isDark.value = !isDark.value;
    
    if (isDark.value) {
        document.documentElement.classList.add('dark');
        localStorage.setItem('theme', 'dark');
    } else {
        document.documentElement.classList.remove('dark');
        localStorage.setItem('theme', 'light');
    }
};

const currentQuestionData = computed(() => {
    if (!props.diagnostic?.responses?.[currentQuestionIndex.value]?.item) return null;
    
    const response = props.diagnostic.responses[currentQuestionIndex.value];
    return {
        ...response.item,
        content: response.item.content,
        question: response.item.content, // Type1Review expects 'question' property
        type_id: response.item.type_id || 1,
    };
});

const currentResponse = computed(() => {
    return props.diagnostic?.responses?.[currentQuestionIndex.value] || null;
});

const isLastQuestion = computed(() => {
    return currentQuestionIndex.value === (props.diagnostic?.responses?.length ?? 0) - 1;
});

// Methods
const previousQuestion = () => {
    if (currentQuestionIndex.value > 0) {
        currentQuestionIndex.value--;
    }
};

const nextQuestion = () => {
    if (currentQuestionIndex.value < (props.diagnostic?.responses?.length ?? 0) - 1) {
        currentQuestionIndex.value++;
    }
};

const formatAnswer = (answer) => {
    if (!answer) return "N/A";
    return Array.isArray(answer) ? answer.join(", ") : answer;
};

const formatTime = (seconds) => {
    if (!seconds) return "N/A";
    if (seconds < 60) return `${seconds}s`;
    const minutes = Math.floor(seconds / 60);
    const secs = seconds % 60;
    return `${minutes}m ${secs}s`;
};

</script>

<style scoped>
/* Prose styling for markdown content */
.prose :deep(p) {
    margin-bottom: 1rem;
}

.prose :deep(ul) {
    list-style-type: disc;
    padding-left: 1.5rem;
}

.prose :deep(ol) {
    list-style-type: decimal;
    padding-left: 1.5rem;
}

.prose :deep(li) {
    margin-bottom: 0.5rem;
}

.prose :deep(strong) {
    font-weight: 600;
}

.prose :deep(code) {
    background-color: #f3f4f6;
    padding: 0.125rem 0.25rem;
    border-radius: 0.25rem;
    font-size: 0.875rem;
}

.dark .prose :deep(code) {
    background-color: #374151;
}
</style>