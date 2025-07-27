<template>
    <div class="bg-slate-100 dark:bg-slate-900">
        <!-- Apple-Style Header - Responsive -->
        <div class="bg-white/90 dark:bg-slate-800/90 backdrop-blur-xl sticky top-0 z-50" style="box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);">
            <!-- Mobile Header -->
            <div class="xl:hidden">
                <div class="max-w-7xl mx-auto px-3 py-1.5">
                    <div class="relative flex items-center justify-between">
                        <!-- Left Side: Back Button + Status -->
                        <div class="flex items-center space-x-3">
                            <!-- Back Button -->
                            <Link
                                :href="route('assessments.diagnostics.all-results')"
                                class="p-1 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors"
                            >
                                <ChevronLeftIcon class="w-5 h-5 text-gray-600 dark:text-gray-400" />
                            </Link>
                            
                            <!-- Status Indicator -->
                            <div v-if="currentResponse" :class="[
                                'flex items-center space-x-1 px-2 py-1 rounded-full text-xs font-bold uppercase tracking-wide',
                                currentResponse.is_correct 
                                    ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300'
                                    : 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300'
                            ]">
                                <span :class="currentResponse.is_correct ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400'">
                                    {{ currentResponse.is_correct ? '✓' : '✗' }}
                                </span>
                                <span>{{ currentResponse.is_correct ? 'CORRECT' : 'INCORRECT' }}</span>
                            </div>
                        </div>
                        
                        <!-- Question Number - Centered -->
                        <div class="absolute left-1/2 transform -translate-x-1/2">
                            <span class="text-sm font-semibold text-gray-900 dark:text-white">
                                Q{{ currentQuestionIndex + 1 }}/{{ diagnostic?.responses?.length ?? 0 }}
                            </span>
                        </div>
                        
                        <!-- Right Actions -->
                        <div class="flex items-center space-x-2 ml-auto">
                            <!-- Explanations Toggle (Mobile Only) -->
                            <button
                                v-if="currentQuestionHasJustifications"
                                @click="toggleExplanations"
                                :class="[
                                    'transition-all duration-200 flex items-center',
                                    'portrait:p-1.5 portrait:rounded-full portrait:justify-center',
                                    'landscape:px-3 landscape:py-1.5 landscape:rounded-full landscape:space-x-1.5',
                                    showAllExplanations
                                        ? 'bg-blue-500 hover:bg-blue-600 text-white shadow-md'
                                        : 'bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300 border border-gray-300 dark:border-gray-600'
                                ]"
                                :aria-label="showAllExplanations ? 'Hide explanations' : 'Show explanations'"
                            >
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0zM12 17.25h.01" />
                                </svg>
                                <span class="landscape:inline portrait:hidden text-xs tracking-wide">
                                    {{ showAllExplanations ? 'Hide' : 'Explain' }}
                                </span>
                            </button>
                            
                            <!-- Theme Toggle -->
                            <button
                                @click="toggleTheme"
                                class="p-1 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors"
                                aria-label="Toggle theme"
                            >
                                <SunIcon v-if="isDark" class="w-5 h-5 text-yellow-500" />
                                <MoonIcon v-else class="w-5 h-5 text-gray-600" />
                            </button>
                            
                            <!-- End Review Button -->
                            <Link
                                :href="route('assessments.diagnostics.all-results')"
                                class="p-1 rounded-lg bg-red-500 hover:bg-red-600 text-white transition-colors"
                                aria-label="End review"
                            >
                                <XIcon class="w-5 h-5" />
                            </Link>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Large Screen Header -->
            <div class="hidden xl:block">
                <div class="max-w-6xl mx-auto px-8 py-4">
                    <div class="flex items-center justify-center relative">
                        <!-- Left Side: Back Button + Status -->
                        <div class="absolute left-0 flex items-center space-x-4">
                            <!-- Back Button -->
                            <Link
                                :href="route('assessments.diagnostics.all-results')"
                                class="p-2 rounded-full hover:bg-black/5 dark:hover:bg-white/5 transition-all duration-200"
                            >
                                <ChevronLeftIcon class="w-6 h-6 text-gray-600 dark:text-gray-300" />
                            </Link>
                            
                            <!-- Status Indicator -->
                            <div v-if="currentResponse" :class="[
                                'flex items-center space-x-2 px-4 py-2 rounded-full text-sm font-bold uppercase tracking-wide',
                                currentResponse.is_correct 
                                    ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300'
                                    : 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300'
                            ]">
                                <span :class="currentResponse.is_correct ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400'">
                                    {{ currentResponse.is_correct ? '✓' : '✗' }}
                                </span>
                                <span>{{ currentResponse.is_correct ? 'CORRECT' : 'INCORRECT' }}</span>
                            </div>
                        </div>
                        
                        <!-- Centered Progress - Apple Style -->
                        <div class="flex flex-col items-center space-y-2">
                            <div class="flex items-center justify-center">
                                <span class="text-2xl font-semibold text-gray-900 dark:text-white">
                                    {{ currentQuestionIndex + 1 }} of {{ diagnostic?.responses?.length ?? 0 }}
                                </span>
                            </div>
                            <div class="w-80 h-1 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
                                <div 
                                    class="h-full bg-blue-500 rounded-full transition-all duration-500 ease-out" 
                                    :style="{ width: ((currentQuestionIndex + 1) / (diagnostic?.responses?.length || 1)) * 100 + '%' }"
                                ></div>
                            </div>
                        </div>
                        
                        <!-- Right Actions -->
                        <div class="absolute right-0 flex items-center space-x-3">
                            <!-- Theme Toggle -->
                            <button
                                @click="toggleTheme"
                                class="p-2 rounded-full hover:bg-black/5 dark:hover:bg-white/5 transition-all duration-200"
                                aria-label="Toggle theme"
                            >
                                <SunIcon v-if="isDark" class="w-6 h-6 text-yellow-500" />
                                <MoonIcon v-else class="w-6 h-6 text-gray-600" />
                            </button>
                            
                            <!-- Close Button -->
                            <Link
                                :href="route('assessments.diagnostics.all-results')"
                                class="w-8 h-8 rounded-full bg-red-500 hover:bg-red-600 flex items-center justify-center transition-all duration-200"
                            >
                                <XIcon class="w-4 h-4 text-white" />
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content - Apple Clean Layout -->
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 xl:px-6 py-6 pb-32">
            <!-- Mobile Layout (existing) -->
            <div class="xl:hidden">
                <div class="grid grid-cols-1">
                    <!-- Question and Answer Section with Swipe Support -->
                    <!-- Swipeable Container with Status Tint -->
                    <div 
                        ref="swipeContainer"
                        :class="[
                            'relative overflow-x-hidden rounded-3xl touch-pan-y swipe-container'
                        ]"
                        :style="{
                            borderTop: currentResponse?.is_correct 
                                ? '3px solid rgb(34, 197, 94)' 
                                : '3px solid rgb(239, 68, 68)'
                        }"
                        @touchstart="handleTouchStart"
                        @touchmove="handleTouchMove" 
                        @touchend="handleTouchEnd"
                    >
                        <!-- Questions Container with Transform -->
                        <div 
                            class="flex transition-transform duration-300 ease-out rounded-3xl"
                            :style="{ 
                                transform: `translateX(${swipeOffset}px)`,
                                width: `${(diagnostic?.responses?.length || 1) * 100}%`
                            }"
                        >
                            <!-- Individual Question Cards -->
                            <div 
                                v-for="(response, index) in diagnostic?.responses" 
                                :key="index"
                                class="w-full flex-shrink-0"
                                :style="{ width: `${100 / (diagnostic?.responses?.length || 1)}%` }"
                            >
                                <!-- Only render current and adjacent questions for performance -->
                                <div v-if="Math.abs(index - currentQuestionIndex) <= 1">
                                    <component
                                        :is="getReviewComponentForIndex(index)"
                                        :question="getQuestionDataForIndex(index)"
                                        :answer="getResponseDataForIndex(index)"
                                        :isDark="isDark"
                                        :showExplanations="showAllExplanations"
                                    />
                                </div>
                                <!-- Placeholder for non-adjacent questions -->
                                <div v-else class="rounded-3xl p-8 h-96">
                                    <div class="flex justify-center items-center h-full text-gray-500">
                                        <span class="text-lg font-medium">Question {{ index + 1 }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Loading State -->
                        <div v-if="!diagnostic?.responses?.length" class="rounded-3xl p-8">
                            <div class="flex justify-center items-center h-32 text-gray-500">
                                <LoaderIcon class="w-6 h-6 animate-spin" />
                                <span class="ml-2 font-medium">Loading questions...</span>
                            </div>
                        </div>
                        
                        
                    </div>
                </div>

                <!-- Sidebar - Hidden on mobile/tablet, visible on desktop -->
                <div class="hidden xl:block space-y-6">
                    <!-- Question Details -->
                    <div class="bg-white/70 dark:bg-slate-800/70 backdrop-blur-lg rounded-3xl shadow-xl border border-gray-200/50 dark:border-slate-700/50 overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-200/50 dark:border-slate-700/50">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Question Details</h3>
                        </div>
                        <div class="p-6 space-y-4">
                            <div class="space-y-3">
                                <div class="flex flex-col space-y-1">
                                    <span class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Domain</span>
                                    <span class="text-sm text-gray-900 dark:text-white font-medium">
                                        {{ currentQuestionData?.topic?.domain?.name ?? "N/A" }}
                                    </span>
                                </div>
                                
                                <div class="flex flex-col space-y-1">
                                    <span class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Topic</span>
                                    <span class="text-sm text-gray-900 dark:text-white font-medium">
                                        {{ currentQuestionData?.topic?.name ?? "N/A" }}
                                    </span>
                                </div>
                                
                                <div class="flex flex-col space-y-2">
                                    <span class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Difficulty & Level</span>
                                    <BarChartLevelIndicator 
                                        v-if="currentQuestionData?.difficulty || currentQuestionData?.bloom"
                                        :total-bars="5"
                                        :filled-bars="Math.max(currentQuestionData?.difficulty || 1, currentQuestionData?.bloom || 1)"
                                    />
                                    <span v-else class="text-sm text-gray-500 dark:text-gray-400 italic">
                                        Level data not available
                                    </span>
                                </div>
                                
                                <div class="flex flex-col space-y-1">
                                    <span class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Your Answer</span>
                                    <span :class="[
                                        'text-sm font-medium',
                                        currentResponse?.is_correct 
                                            ? 'text-green-600 dark:text-green-400' 
                                            : 'text-red-500 dark:text-red-400'
                                    ]">
                                        {{ formatAnswer(currentResponse?.user_answer) }}
                                    </span>
                                </div>
                                
                                <div v-if="!currentResponse?.is_correct" class="flex flex-col space-y-1">
                                    <span class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Correct Answer</span>
                                    <span class="text-sm text-green-600 dark:text-green-400 font-medium">
                                        {{ formatAnswer(currentQuestionData?.correct_options) }}
                                    </span>
                                </div>
                                
                                <div class="flex flex-col space-y-1">
                                    <span class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Time Taken</span>
                                    <span class="text-sm text-gray-900 dark:text-white font-medium">
                                        {{ formatTime(currentResponse?.response_time_seconds) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Large Screen Layout - Apple Design -->
            <div class="hidden xl:block">
                <div class="grid grid-cols-12 gap-10">
                    <!-- Main Question Area -->
                    <div class="col-span-8">
                        
                        <!-- Review Component with Clean Styling -->
                        <component
                            :is="getReviewComponentForIndex(currentQuestionIndex)"
                            :question="currentQuestionData"
                            :answer="currentResponse"
                            :isDark="isDark"
                            :showExplanations="true"
                            class="large-screen-review-enhanced"
                        />
                    </div>

                    <!-- Right Sidebar: Question Details - Enhanced Apple Style -->
                    <div class="col-span-4 space-y-6">
                        <!-- Question Metadata Card -->
                        <div class="bg-white/90 dark:bg-gray-800/90 backdrop-blur-xl rounded-2xl shadow-xl border border-gray-200/30 dark:border-gray-700/30 p-6 space-y-5">
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white">Question Details</h3>
                            
                            <div class="space-y-4">
                                <div>
                                    <span class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Domain</span>
                                    <p class="text-gray-900 dark:text-white font-medium mt-1">{{ currentQuestionData?.topic?.domain?.name ?? "N/A" }}</p>
                                </div>
                                
                                <div>
                                    <span class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Topic</span>
                                    <p class="text-gray-900 dark:text-white font-medium mt-1">{{ currentQuestionData?.topic?.name ?? "N/A" }}</p>
                                </div>
                                
                                <div>
                                    <span class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Difficulty</span>
                                    <div class="flex items-center space-x-1 mt-2">
                                        <div 
                                            v-for="i in 5" 
                                            :key="i"
                                            :class="[
                                                'w-2 h-2 rounded-full',
                                                i <= (currentQuestionData?.difficulty || 0) ? 'bg-blue-500' : 'bg-gray-300 dark:bg-gray-600'
                                            ]"
                                        ></div>
                                        <span class="text-gray-600 dark:text-gray-400 text-xs ml-2">
                                            {{ getDifficultyLabel(currentQuestionData?.difficulty) }}
                                        </span>
                                    </div>
                                </div>
                                
                                <div>
                                    <span class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Bloom Level</span>
                                    <div class="flex items-center space-x-1 mt-2">
                                        <div 
                                            v-for="i in 5" 
                                            :key="i"
                                            :class="[
                                                'w-2 h-2 rounded-full',
                                                i <= (currentQuestionData?.bloom || 0) ? 'bg-purple-500' : 'bg-gray-300 dark:bg-gray-600'
                                            ]"
                                        ></div>
                                        <span class="text-gray-600 dark:text-gray-400 text-xs ml-2">
                                            {{ getBloomLabel(currentQuestionData?.bloom) }}
                                        </span>
                                    </div>
                                </div>
                                
                                <hr class="border-gray-200/50 dark:border-gray-700/50">
                                
                                <div>
                                    <span class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Your Answer</span>
                                    <p :class="[
                                        'font-medium mt-1 text-sm',
                                        currentResponse?.is_correct 
                                            ? 'text-green-500 dark:text-green-400' 
                                            : 'text-red-500 dark:text-red-400'
                                    ]">{{ formatAnswer(currentResponse?.user_answer) }}</p>
                                </div>
                                
                                <div v-if="!currentResponse?.is_correct">
                                    <span class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Correct Answer</span>
                                    <p class="text-green-500 dark:text-green-400 font-medium mt-1 text-sm">{{ formatAnswer(currentQuestionData?.correct_options) }}</p>
                                </div>
                                
                                <div>
                                    <span class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Time Taken</span>
                                    <p class="text-gray-900 dark:text-white font-medium mt-1">{{ formatTime(currentResponse?.response_time_seconds) }}</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <!-- Enhanced Review Navigation (Portrait + Desktop) -->
        <div class="fixed bottom-0 left-0 right-0 bg-white/90 dark:bg-slate-800/90 backdrop-blur-xl z-50 portrait:block landscape:xl:block landscape:hidden" style="box-shadow: 0 -1px 3px rgba(0, 0, 0, 0.1);">
            <div class="max-w-6xl mx-auto px-4 xl:py-5 py-3">
                <div class="flex w-full gap-3 max-w-md mx-auto">
                    <!-- Previous Button -->
                    <button
                        @click="previousQuestion"
                        :disabled="currentQuestionIndex === 0"
                        :class="[
                            'px-4 py-2 rounded-xl font-medium flex-1 transition-all flex items-center justify-center',
                            currentQuestionIndex === 0
                                ? 'bg-gray-600 cursor-not-allowed opacity-50 text-gray-400'
                                : 'bg-gray-500 hover:bg-gray-600 text-white'
                        ]"
                        :aria-label="currentQuestionIndex === 0 ? 'No previous question' : 'Previous question'"
                    >
                        <span>Previous</span>
                    </button>

                    <!-- Next Button (Primary) or End Review Button (on last question) -->
                    <button
                        v-if="!isLastQuestion"
                        @click="nextQuestion"
                        class="px-4 py-2 rounded-xl font-medium flex-1 text-white transition-all bg-blue-500 hover:bg-blue-600 flex items-center justify-center"
                        aria-label="Next question"
                    >
                        <span>Next</span>
                    </button>
                    
                    <!-- End Review Button (Primary - only on last question) -->
                    <Link
                        v-if="isLastQuestion"
                        :href="route('assessments.diagnostics.all-results')"
                        class="px-4 py-2 rounded-xl font-medium flex-1 text-white transition-all bg-red-500 hover:bg-red-600 flex items-center justify-center"
                        aria-label="End review and return to results"
                    >
                        <span>End Review</span>
                    </Link>

                </div>
            </div>
        </div>
        
        <!-- Floating Navigation Buttons (Mobile Landscape Only) - Outside Content Area -->
        <div class="hidden max-md:landscape:block portrait:hidden">
            <!-- Previous Button - Far Left Edge, Outside Content -->
            <button
                v-if="currentQuestionIndex > 0"
                @click="previousQuestion"
                class="fixed left-0 top-1/2 transform -translate-y-1/2 w-10 h-16 bg-blue-500 hover:bg-blue-600 rounded-r-full shadow-xl flex items-center justify-center transition-all duration-300 hover:shadow-2xl z-50"
                style="margin-left: 0px;"
                aria-label="Previous question"
            >
                <ChevronLeftIcon class="w-4 h-4 text-white ml-1" />
            </button>
            
            <!-- Next Button - Far Right Edge, Outside Content -->
            <button
                v-if="currentQuestionIndex < (diagnostic?.responses?.length ?? 0) - 1"
                @click="nextQuestion"
                class="fixed right-0 top-1/2 transform -translate-y-1/2 w-10 h-16 bg-blue-500 hover:bg-blue-600 rounded-l-full shadow-xl flex items-center justify-center transition-all duration-300 hover:shadow-2xl z-50"
                style="margin-right: 0px;"
                aria-label="Next question"
            >
                <ChevronRightIcon class="w-4 h-4 text-white mr-1" />
            </button>
        </div>
    </div>
</template>

<script setup lang="ts">
import { Link } from "@inertiajs/vue3";
import { ref, computed, onMounted, onUnmounted, nextTick, watch } from "vue";
import Type1Review from '@/components/QuizTypes/Type1Review.vue';
import Type2Review from '@/components/QuizTypes/Type2Review.vue';
import Type3Review from '@/components/QuizTypes/Type3Review.vue';
import Type4Review from '@/components/QuizTypes/Type4Review.vue';
import Type5Review from '@/components/QuizTypes/Type5Review.vue';
import Type6Review from '@/components/QuizTypes/Type6Review.vue';
import Type7Review from '@/components/QuizTypes/Type7Review.vue';
import BarChartLevelIndicator from '@/components/LevelIndicators/BarChartLevelIndicator.vue';
import { 
    XIcon, 
    ChevronLeftIcon,
    ChevronRightIcon,
    LoaderIcon,
    SunIcon,
    MoonIcon
} from 'lucide-vue-next';

const props = defineProps({
    diagnostic: Object,
});

const currentQuestionIndex = ref(0);

// Swipe handling state
const swipeContainer = ref(null);
const swipeOffset = ref(0);
const touchStartX = ref(0);
const touchStartY = ref(0);
const isSwiping = ref(false);
const initialOffset = ref(0);

// Removed old navigation bar state (no longer needed with mini-navigator)

// Theme state
const isDark = ref(false);

// Explanations state (mobile only)
const showAllExplanations = ref(false);

// Window width for responsive behavior
const windowWidth = ref(typeof window !== 'undefined' ? window.innerWidth : 1024);

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

// Explanations toggle function
const toggleExplanations = () => {
    showAllExplanations.value = !showAllExplanations.value;
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

const currentQuestionHasJustifications = computed(() => {
    const currentQuestion = currentQuestionData.value;
    if (!currentQuestion?.justifications) return false;
    
    return Object.values(currentQuestion.justifications).some(justification => 
        typeof justification === 'string' && justification.trim() !== '');
});


// Helper functions for swipe functionality
const getReviewComponentForIndex = (index) => {
    const response = props.diagnostic?.responses?.[index];
    const typeId = response?.item?.type_id || 1;
    const componentMap = {
        1: Type1Review,    // Multiple Choice (Single)
        2: Type2Review,    // True/False
        3: Type3Review,    // Multiple Choice (Multiple)
        4: Type4Review,    // Matching
        5: Type5Review,    // Ordering/Sequencing
        6: Type6Review,    // Fill in the Blank
        7: Type7Review,    // Essay/Short Answer
    };
    return componentMap[typeId] || Type1Review;
};

const getQuestionDataForIndex = (index) => {
    const response = props.diagnostic?.responses?.[index];
    if (!response?.item) return null;
    
    return {
        ...response.item,
        content: response.item.content,
        question: response.item.content, // For component compatibility
        type_id: response.item.type_id || 1,
    };
};

const getResponseDataForIndex = (index) => {
    return props.diagnostic?.responses?.[index] || null;
};

// Update swipe offset when question changes
const updateSwipeOffset = () => {
    if (swipeContainer.value) {
        const containerWidth = swipeContainer.value.offsetWidth;
        swipeOffset.value = -currentQuestionIndex.value * containerWidth;
    }
};

// Scroll to top helper
const scrollToTop = () => {
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
};

// Methods
const previousQuestion = () => {
    if (currentQuestionIndex.value > 0) {
        currentQuestionIndex.value--;
        updateSwipeOffset();
        scrollToTop(); // Reset scroll to see question from top
    }
};

const nextQuestion = () => {
    if (currentQuestionIndex.value < (props.diagnostic?.responses?.length ?? 0) - 1) {
        currentQuestionIndex.value++;
        updateSwipeOffset();
        scrollToTop(); // Reset scroll to see question from top
    }
};


// Removed old navigation bar touch handling (no longer needed with mini-navigator)

// Swipe handling methods
const handleTouchStart = (event) => {
    if (event.touches.length !== 1) return;
    
    touchStartX.value = event.touches[0].clientX;
    touchStartY.value = event.touches[0].clientY;
    initialOffset.value = swipeOffset.value;
    isSwiping.value = false;
};

const handleTouchMove = (event) => {
    if (event.touches.length !== 1) return;
    
    const touchX = event.touches[0].clientX;
    const touchY = event.touches[0].clientY;
    const deltaX = touchX - touchStartX.value;
    const deltaY = touchY - touchStartY.value;
    
    // Determine if this is a horizontal swipe
    if (!isSwiping.value) {
        const threshold = 10;
        if (Math.abs(deltaX) > threshold || Math.abs(deltaY) > threshold) {
            // Only start swiping if the horizontal movement is greater than vertical
            if (Math.abs(deltaX) > Math.abs(deltaY)) {
                isSwiping.value = true;
            } else {
                // This is a vertical scroll, don't interfere
                return;
            }
        }
    }
    
    if (isSwiping.value) {
        // Prevent default scrolling behavior
        event.preventDefault();
        
        // Apply resistance at boundaries
        let resistance = 1;
        const maxQuestions = props.diagnostic?.responses?.length ?? 1;
        const containerWidth = swipeContainer.value?.offsetWidth || 0;
        const targetOffset = initialOffset.value + deltaX;
        const maxOffset = 0;
        const minOffset = -(maxQuestions - 1) * containerWidth;
        
        // Apply resistance when going beyond boundaries
        if (targetOffset > maxOffset) {
            resistance = Math.max(0.1, 1 - (targetOffset - maxOffset) / containerWidth);
        } else if (targetOffset < minOffset) {
            resistance = Math.max(0.1, 1 - (minOffset - targetOffset) / containerWidth);
        }
        
        swipeOffset.value = initialOffset.value + deltaX * resistance;
    }
};

const handleTouchEnd = (event) => {
    if (!isSwiping.value) return;
    
    const touchX = event.changedTouches[0].clientX;
    const deltaX = touchX - touchStartX.value;
    const containerWidth = swipeContainer.value?.offsetWidth || 0;
    const threshold = containerWidth * 0.25; // 25% of container width
    const velocity = Math.abs(deltaX) / 300; // Simple velocity calculation
    
    let newIndex = currentQuestionIndex.value;
    
    // Determine if we should change questions based on distance or velocity
    if (Math.abs(deltaX) > threshold || velocity > 0.5) {
        if (deltaX > 0 && currentQuestionIndex.value > 0) {
            // Swipe right - go to previous question
            newIndex = currentQuestionIndex.value - 1;
        } else if (deltaX < 0 && currentQuestionIndex.value < (props.diagnostic?.responses?.length ?? 0) - 1) {
            // Swipe left - go to next question
            newIndex = currentQuestionIndex.value + 1;
        }
    }
    
    // Update question index and reset swipe state
    if (newIndex !== currentQuestionIndex.value) {
        currentQuestionIndex.value = newIndex;
        updateSwipeOffset();
        nextTick(() => {
            scrollToTop(); // Reset scroll to see question from top
        });
    }
    isSwiping.value = false;
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

// Helper methods for large screen layout
const getDifficultyLabel = (difficulty) => {
    const labels = {
        1: 'Beginner',
        2: 'Easy',
        3: 'Intermediate',
        4: 'Advanced',
        5: 'Expert'
    };
    return labels[difficulty] || 'Unknown';
};

const getBloomLabel = (bloom) => {
    const labels = {
        1: 'Remember (L1)',
        2: 'Understand (L2)',
        3: 'Apply (L3)',
        4: 'Analysis (L4)',
        5: 'Evaluate (L5)',
        6: 'Create (L6)'
    };
    return labels[bloom] || 'Unknown';
};


// Window resize handler
const handleResize = () => {
    windowWidth.value = window.innerWidth;
    nextTick(() => {
        updateSwipeOffset();
    });
};

// Watch for question index changes to update swipe offset
watch(currentQuestionIndex, () => {
    updateSwipeOffset();
});

// Lifecycle hooks
onMounted(() => {
    // Initial setup for swipe functionality
    setTimeout(() => {
        updateSwipeOffset();
    }, 100);
    
    window.addEventListener('resize', handleResize);
});

onUnmounted(() => {
    window.removeEventListener('resize', handleResize);
});

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

/* Swipe behavior enhancements */
.touch-pan-y {
    touch-action: pan-y pinch-zoom;
}

/* Smooth transitions for swipe animations */
.transition-transform {
    transition-property: transform;
    transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
}

/* Disable text selection during swipe */
.select-none {
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}

/* Enhanced swipe indicator */
@media (max-width: 1279px) {
    .swipe-indicator {
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
    }
}

/* Performance optimizations for swipe animations */
.swipe-container {
    will-change: transform;
    transform: translateZ(0); /* Enable hardware acceleration */
}

.swipe-container > * {
    backface-visibility: hidden;
}

/* Large screen review styling */
.large-screen-review {
    padding: 2.5rem !important;
}

.large-screen-review-enhanced {
    padding: 0 !important;
}

.large-screen-review :deep(.question-option),
.large-screen-review-enhanced :deep(.question-option) {
    transition: all 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    margin-bottom: 1.25rem;
    border-radius: 1rem;
    padding: 1.5rem;
    border-width: 2px;
    font-size: 1.0625rem;
    line-height: 1.6;
}

.large-screen-review :deep(.question-option:hover),
.large-screen-review-enhanced :deep(.question-option:hover) {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    border-color: rgba(59, 130, 246, 0.3);
}

.dark .large-screen-review :deep(.question-option:hover),
.dark .large-screen-review-enhanced :deep(.question-option:hover) {
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.4);
    border-color: rgba(96, 165, 250, 0.3);
}

/* Enhanced question text styling */
.large-screen-review-enhanced :deep(.question-text) {
    font-size: 1.375rem !important;
    line-height: 1.7 !important;
    color: rgb(31, 41, 55) !important;
    font-weight: 600 !important;
    margin-bottom: 2rem !important;
}

.dark .large-screen-review-enhanced :deep(.question-text) {
    color: rgb(243, 244, 246) !important;
}

/* Enhanced answer option text styling */
.large-screen-review-enhanced :deep(.option-text) {
    font-size: 1.0625rem !important;
    line-height: 1.6 !important;
    font-weight: 500 !important;
    color: rgb(55, 65, 81) !important;
}

.dark .large-screen-review-enhanced :deep(.option-text) {
    color: rgb(229, 231, 235) !important;
}

/* Enhanced explanation text styling */
.large-screen-review-enhanced :deep(.explanation-text) {
    font-size: 0.95rem !important;
    line-height: 1.6 !important;
    font-weight: 500 !important;
    color: rgb(55, 65, 81) !important;
}

.dark .large-screen-review-enhanced :deep(.explanation-text) {
    color: rgb(209, 213, 219) !important;
}

/* Fix blue explanation text contrast */
.large-screen-review-enhanced :deep(.explanation-text.text-blue-600) {
    color: rgb(37, 99, 235) !important;
}

.dark .large-screen-review-enhanced :deep(.explanation-text.text-blue-400) {
    color: rgb(96, 165, 250) !important;
}

/* Improved spacing for answer options */
.large-screen-review-enhanced :deep(.answer-options) {
    gap: 1.25rem !important;
    margin-top: 1.5rem !important;
}

/* Enhanced typography for all text elements */
.large-screen-review-enhanced :deep(p) {
    font-size: 1.0625rem !important;
    line-height: 1.6 !important;
    color: rgb(55, 65, 81) !important;
}

.dark .large-screen-review-enhanced :deep(p) {
    color: rgb(209, 213, 219) !important;
}

/* Better spacing between sections */
.large-screen-review-enhanced :deep(.question-section) {
    margin-bottom: 2rem !important;
}

/* Enhanced correct answer display */
.large-screen-review-enhanced :deep(.correct-answer-section) {
    margin-top: 2rem !important;
    padding: 1.5rem !important;
    border-radius: 1rem !important;
}

/* Improve visual hierarchy */
.large-screen-review-enhanced :deep(h3),
.large-screen-review-enhanced :deep(.section-title) {
    font-size: 1.125rem !important;
    font-weight: 600 !important;
    margin-bottom: 1rem !important;
    color: rgb(31, 41, 55) !important;
}

.dark .large-screen-review-enhanced :deep(h3),
.dark .large-screen-review-enhanced :deep(.section-title) {
    color: rgb(243, 244, 246) !important;
}

/* Enhanced correct/incorrect styling */
.large-screen-review-enhanced :deep(.question-option.correct) {
    background: linear-gradient(135deg, rgb(220, 252, 231) 0%, rgb(187, 247, 208) 100%) !important;
    border-color: rgb(34, 197, 94) !important;
    box-shadow: 0 4px 14px rgba(34, 197, 94, 0.2) !important;
}

.large-screen-review-enhanced :deep(.question-option.incorrect) {
    background: linear-gradient(135deg, rgb(254, 226, 226) 0%, rgb(252, 165, 165) 100%) !important;
    border-color: rgb(239, 68, 68) !important;
    box-shadow: 0 4px 14px rgba(239, 68, 68, 0.2) !important;
}

.dark .large-screen-review-enhanced :deep(.question-option.correct) {
    background: linear-gradient(135deg, rgba(34, 197, 94, 0.2) 0%, rgba(34, 197, 94, 0.1) 100%) !important;
    border-color: rgb(34, 197, 94) !important;
}

.dark .large-screen-review-enhanced :deep(.question-option.incorrect) {
    background: linear-gradient(135deg, rgba(239, 68, 68, 0.2) 0%, rgba(239, 68, 68, 0.1) 100%) !important;
    border-color: rgb(239, 68, 68) !important;
}

/* Add extra spacing for question text on large screens */
.large-screen-review :deep(h2),
.large-screen-review :deep(.question-text) {
    margin-bottom: 2rem !important;
    padding: 0 1rem;
}

/* Better spacing for answer options on large screens */
.large-screen-review :deep(.answer-options) {
    padding: 0 1rem;
}

/* Hide scrollbar for navigation */
.scrollbar-hide {
    scrollbar-width: none; /* Firefox */
    -ms-overflow-style: none; /* Internet Explorer 10+ */
}

.scrollbar-hide::-webkit-scrollbar {
    display: none; /* WebKit */
}

/* Improve touch responsiveness */
@media (pointer: coarse) {
    .swipe-container {
        cursor: grab;
    }
    
    .swipe-container:active {
        cursor: grabbing;
    }
}
</style>