<template>
    <div :class="[
            'transition-all duration-300 w-full overflow-hidden',
            // Small screens: original card styling
            'backdrop-blur-md rounded-2xl border shadow-xl',
            // Large screens: match Question Details styling
            'xl:bg-white/90 xl:dark:bg-gray-800/90 xl:backdrop-blur-xl xl:rounded-2xl xl:shadow-xl xl:border xl:border-gray-200/30 xl:dark:border-gray-700/30',
            // Colors for small screens
            isThemeDark 
                ? 'bg-gray-700 border-gray-500' 
                : 'bg-white border-gray-200'
         ]">
        <!-- Question Section -->
        <div class="p-8 xl:p-0">
            <div
                class="text-lg font-medium mb-8"
                :class="isThemeDark 
                    ? 'text-white' 
                    : 'text-gray-800'"
                v-html="renderedQuestion"
            ></div>
                
            <!-- Your Answer Order -->
            <div class="space-y-4 lg:max-w-[50%] lg:mx-auto">
                <h3 class="text-lg font-semibold mb-4"
                    :class="isThemeDark 
                        ? 'text-white' 
                        : 'text-gray-800'">YOUR ANSWERS</h3>
                <div class="space-y-3">
                    <div
                        v-for="(option, i) in getUserAnswers()"
                        :key="i"
                        class="relative rounded-xl transition-all duration-200"
                        :class="getAnswerItemClasses(i)"
                    >
                        <div class="flex items-center p-4">
                            <!-- Number -->
                            <div class="mr-4">
                                <div :class="[
                                        'w-8 h-8 rounded-full flex items-center justify-center font-bold text-sm',
                                        isCorrectOption(i)
                                            ? (isThemeDark ? 'bg-green-500/20 text-green-400' : 'bg-green-500/20 text-green-600')
                                            : (isThemeDark ? 'bg-red-500/20 text-red-400' : 'bg-red-500/20 text-red-600')
                                    ]">
                                    {{ i + 1 }}
                                </div>
                            </div>
                            
                            <!-- Option Content -->
                            <span class="flex-1 text-lg font-medium" 
                                  :class="isCorrectOption(i) 
                                      ? (isThemeDark ? 'text-green-300' : 'text-green-700') 
                                      : (isThemeDark ? 'text-red-300' : 'text-red-700')">
                                {{ option }}
                            </span>
                            
                            <!-- Result Indicator -->
                            <div class="ml-4">
                                <div v-if="isCorrectOption(i)" 
                                     :class="[
                                         'w-8 h-8 rounded-full flex items-center justify-center',
                                         isThemeDark 
                                             ? 'bg-green-500/20 text-green-400' 
                                             : 'bg-green-500/20 text-green-600'
                                     ]">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                                <div v-else 
                                     :class="[
                                         'w-8 h-8 rounded-full flex items-center justify-center',
                                         isThemeDark 
                                             ? 'bg-red-500/20 text-red-400' 
                                             : 'bg-red-500/20 text-red-600'
                                     ]">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            
        <!-- Answer Explanations Section -->
        <div
            :class="[
                'border-t',
                answer.is_correct
                    ? (isThemeDark ? 'bg-green-500/5 border-green-500/30' : 'bg-green-100 border-green-300')
                    : (isThemeDark ? 'bg-red-500/5 border-red-500/30' : 'bg-red-100 border-red-300')
            ]"
        >
            <div class="p-8">
                <!-- Section Header -->
                <div class="flex items-center mb-6">
                    <div :class="[
                            'w-10 h-10 rounded-xl flex items-center justify-center mr-3',
                            answer.is_correct
                                ? (isThemeDark ? 'bg-green-500/20' : 'bg-green-500/20')
                                : (isThemeDark ? 'bg-red-500/20' : 'bg-red-500/20')
                        ]">
                        <svg v-if="answer.is_correct" class="w-6 h-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <svg v-else class="w-6 h-6 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold"
                        :class="isThemeDark ? 'text-white' : 'text-gray-900'">
                        Answer Review
                    </h3>
                </div>
                
                <!-- Result Message -->
                
                <!-- Correct Order -->
                <div class="lg:max-w-[50%] lg:mx-auto">
                    <h4 class="font-semibold text-lg mb-3"
                        :class="isThemeDark ? 'text-white' : 'text-gray-900'">
                        Correct Order:
                    </h4>
                    <div class="space-y-3">
                    <div
                        v-for="(option, index) in question.correct_options"
                        :key="index"
                        :class="[
                            'rounded-xl p-4 transition-all',
                            isThemeDark 
                                ? 'bg-green-500/20 border border-green-500/50' 
                                : 'bg-green-50 border border-green-500'
                        ]"
                    >
                        <div class="flex">
                            <span class="font-bold mr-3 text-lg"
                                  :class="isThemeDark ? 'text-white' : 'text-black'">
                                {{ index + 1 }}.
                            </span>
                            <div class="flex-1">
                                <div class="font-medium mb-2 text-lg"
                                     :class="isThemeDark ? 'text-white' : 'text-gray-900'">
                                    {{ option }}
                                </div>
                                <div 
                                    v-if="shouldShowExplanations && question.justifications && question.justifications[index]" 
                                    class="text-lg"
                                    :class="isThemeDark ? 'text-green-200' : 'text-green-800'"
                                    v-html="question.justifications[index]"
                                ></div>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script lang="ts">
import { renderMarkdown } from '@/utils/markdown';
export default {
    props: {
        question: {
            type: Object,
            required: true
        },
        answer: {
            type: Object,
            default: () => ({})
        },
        isDark: {
            type: Boolean,
            default: null
        },
        showExplanations: {
            type: Boolean,
            default: false
        }
    },
    data() {
        return {
            windowWidth: typeof window !== 'undefined' ? window.innerWidth : 1024
        };
    },
    computed: {
        renderedQuestion() {
            return renderMarkdown(this.question?.content, this.isThemeDark);
        },
        isThemeDark(): boolean {
            // Use prop if provided, otherwise fallback to detection methods
            if (this.isDark !== null) {
                return this.isDark;
            }
            // Fallback detection for backward compatibility
            return document.documentElement.classList.contains('dark') ||
                   this.$el?.classList?.contains('dark-mode') ||
                   this.isThemeDark ||
                   window.matchMedia?.('(prefers-color-scheme: dark)').matches;
        },
        hasAnyExplanations() {
            return this.question?.justifications && this.question.justifications.some(j => j);
        },
        shouldShowExplanations() {
            // Desktop: always show if explanations exist
            // Mobile: show only if parent component says to show them
            if (this.windowWidth >= 1024) {
                return this.hasAnyExplanations;
            } else {
                return this.showExplanations && this.hasAnyExplanations;
            }
        }
    },
    methods: {
        getUserAnswers() {
            // Get user's selected answers
            if (this.answer && this.answer.selected_options) {
                return Array.isArray(this.answer.selected_options) 
                    ? this.answer.selected_options 
                    : [];
            }
            return [];
        },
        isCorrectOption(index: number) {
            // Check if the user's answer at this index matches the correct answer
            const userAnswers = this.getUserAnswers();
            return userAnswers[index] === this.question?.correct_options?.[index];
        },
        getAnswerItemClasses(index: number) {
            const isDarkMode = this.isThemeDark;
            const isCorrect = this.isCorrectOption(index);
            
            if (isDarkMode) {
                return isCorrect
                    ? 'border bg-green-500/10 border-green-500/50'
                    : 'border bg-red-500/10 border-red-500/50';
            } else {
                return isCorrect
                    ? 'border bg-green-50 border-green-500'
                    : 'border bg-red-50 border-red-500';
            }
        },
        updateWindowWidth() {
            this.windowWidth = window.innerWidth;
        }
    },
    mounted() {
        if (typeof window !== 'undefined') {
            window.addEventListener('resize', this.updateWindowWidth);
        }
    },
    beforeUnmount() {
        if (typeof window !== 'undefined') {
            window.removeEventListener('resize', this.updateWindowWidth);
        }
    },
};
</script> 