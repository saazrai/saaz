<template>
    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-900 dark:to-gray-800 pb-20">
        <!-- Minimal Header -->
        <div class="bg-white/90 dark:bg-gray-900/90 backdrop-blur-lg border-b border-gray-200/30 dark:border-gray-700/30 sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-2 py-2">
                <div class="relative flex items-center h-6">
                    <!-- Back Button -->
                    <Link
                        :href="route('assessments.diagnostics.all-results')"
                        class="p-1 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors"
                    >
                        <ChevronLeftIcon class="w-5 h-5 text-gray-600 dark:text-gray-400" />
                    </Link>
                    
                    <!-- Question Indicator - Absolutely centered -->
                    <div class="absolute left-1/2 transform -translate-x-1/2">
                        <span class="text-sm font-semibold text-gray-900 dark:text-white">
                            Q{{ currentQuestionIndex + 1 }}/{{ diagnostic?.responses?.length ?? 0 }}
                        </span>
                    </div>
                    
                    <!-- Right Actions -->
                    <div class="flex items-center space-x-2 ml-auto">
                        <!-- Explanations Toggle (Mobile Only) -->
                        <button
                            v-if="currentQuestionHasJustifications && windowWidth < 1024"
                            @click="toggleExplanations"
                            :class="[
                                'px-3 py-1.5 rounded-full transition-all duration-200 text-xs font-semibold flex items-center space-x-1.5',
                                showAllExplanations
                                    ? 'bg-blue-500 hover:bg-blue-600 text-white shadow-md'
                                    : 'bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300 border border-gray-300 dark:border-gray-600'
                            ]"
                            :aria-label="showAllExplanations ? 'Hide explanations' : 'Show explanations'"
                        >
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0zM12 17.25h.01" />
                            </svg>
                            <span class="tracking-wide">{{ showAllExplanations ? 'Hide' : 'Explain' }}</span>
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

        <!-- Main Content with Maximum Space -->
        <div class="max-w-7xl mx-auto px-2 sm:px-4 lg:px-6 py-4 pb-20">
            <div class="grid grid-cols-1 xl:grid-cols-4 gap-6 lg:gap-8">
                <!-- Question and Answer Section with Swipe Support -->
                <div class="xl:col-span-3">
                    <!-- Swipeable Container -->
                    <div 
                        ref="swipeContainer"
                        class="relative overflow-hidden rounded-3xl touch-pan-y swipe-container"
                        @touchstart="handleTouchStart"
                        @touchmove="handleTouchMove" 
                        @touchend="handleTouchEnd"
                    >
                        <!-- Questions Container with Transform -->
                        <div 
                            class="flex transition-transform duration-300 ease-out"
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
                                <div v-else class="bg-white/70 dark:bg-gray-800/70 backdrop-blur-lg rounded-3xl shadow-xl border border-gray-200/50 dark:border-gray-700/50 p-8 h-96">
                                    <div class="flex justify-center items-center h-full text-gray-500">
                                        <span class="text-lg font-medium">Question {{ index + 1 }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Loading State -->
                        <div v-if="!diagnostic?.responses?.length" class="bg-white/70 dark:bg-gray-800/70 backdrop-blur-lg rounded-3xl shadow-xl border border-gray-200/50 dark:border-gray-700/50 p-8">
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
                    <div class="bg-white/70 dark:bg-gray-800/70 backdrop-blur-lg rounded-3xl shadow-xl border border-gray-200/50 dark:border-gray-700/50 overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-200/50 dark:border-gray-700/50">
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
                                    <span class="text-sm text-gray-900 dark:text-white font-medium">
                                        {{ formatAnswer(currentResponse?.user_answer) }}
                                    </span>
                                </div>
                                
                                <div class="flex flex-col space-y-1">
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

                    <!-- Quick Navigation -->
                    <div class="bg-white/70 dark:bg-gray-800/70 backdrop-blur-lg rounded-3xl shadow-xl border border-gray-200/50 dark:border-gray-700/50 overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-200/50 dark:border-gray-700/50">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Quick Navigation</h3>
                        </div>
                        <div class="p-6">
                            <div class="grid grid-cols-5 gap-2">
                                <button
                                    v-for="(response, index) in diagnostic.responses"
                                    :key="index"
                                    @click="currentQuestionIndex = index"
                                    :class="[
                                        'w-12 h-12 rounded-xl font-semibold text-sm transition-all duration-200 transform hover:scale-105',
                                        currentQuestionIndex === index
                                            ? 'ring-2 ring-blue-500 ring-offset-2 dark:ring-offset-gray-800 scale-105'
                                            : '',
                                        response.is_correct
                                            ? 'bg-green-100 dark:bg-green-900/50 text-green-700 dark:text-green-300 hover:bg-green-200 dark:hover:bg-green-900/70'
                                            : 'bg-red-100 dark:bg-red-900/50 text-red-700 dark:text-red-300 hover:bg-red-200 dark:hover:bg-red-900/70'
                                    ]"
                                >
                                    {{ index + 1 }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Review Navigation -->
        <div class="fixed bottom-0 left-0 right-0 bg-white/95 dark:bg-gray-900/95 backdrop-blur-xl border-t border-gray-200/40 dark:border-gray-700/40 z-50">
            <div class="max-w-7xl mx-auto px-4 py-4">
                <div class="flex items-center justify-between gap-3">
                    <!-- Previous Button -->
                    <button
                        @click="previousQuestion"
                        :disabled="currentQuestionIndex === 0"
                        :class="[
                            'flex items-center justify-center px-6 py-3 rounded-xl font-medium text-sm transition-all duration-200',
                            'min-w-[100px]',
                            currentQuestionIndex === 0
                                ? 'bg-gray-100 dark:bg-gray-800 text-gray-400 dark:text-gray-600 cursor-not-allowed'
                                : 'bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-300 dark:hover:bg-gray-600'
                        ]"
                        :aria-label="currentQuestionIndex === 0 ? 'No previous question' : 'Previous question'"
                    >
                        <span>Previous</span>
                    </button>

                    <!-- Next Button (Primary) or End Review Button (on last question) -->
                    <button
                        v-if="!isLastQuestion"
                        @click="nextQuestion"
                        class="flex items-center justify-center px-8 py-3 rounded-xl bg-blue-500 dark:bg-blue-600 hover:bg-blue-600 dark:hover:bg-blue-700 text-white font-semibold text-sm transition-all duration-200 transform hover:scale-105 shadow-lg min-w-[100px]"
                        aria-label="Next question"
                    >
                        <span>Next</span>
                    </button>
                    
                    <!-- End Review Button (Primary - only on last question) -->
                    <Link
                        v-if="isLastQuestion"
                        :href="route('assessments.diagnostics.all-results')"
                        class="flex items-center justify-center px-8 py-3 rounded-xl bg-red-500 dark:bg-red-600 hover:bg-red-600 dark:hover:bg-red-700 text-white font-semibold text-sm transition-all duration-200 transform hover:scale-105 shadow-lg min-w-[100px]"
                        aria-label="End review and return to results"
                    >
                        <span>End Review</span>
                    </Link>

                </div>
            </div>
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