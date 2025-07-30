<template>
    <!-- Question Review Panel - True/False Style -->
    <div :class="[
            'transition-all duration-300 w-full',
            // Small screens: original card styling
            'backdrop-blur-md rounded-3xl border-0',
            // Large screens: match Question Details styling
            'xl:bg-white/90 xl:dark:bg-gray-800/90 xl:backdrop-blur-xl xl:rounded-2xl xl:shadow-xl xl:border xl:border-gray-200/30 xl:dark:border-gray-700/30',
            // Colors for small screens
            isThemeDark 
                ? 'bg-gray-800/90' 
                : 'bg-white/90'
         ]">
        <div class="xl:p-0">
            <div
                class="xl:px-0 xl:pt-0 xl:pb-4 rounded text-lg font-medium mb-4"
                :class="isThemeDark 
                    ? 'text-white' 
                    : 'text-gray-800'"
                v-html="renderedQuestion"
            ></div>

            <div class="flex gap-4 justify-center xl:px-0 xl:pb-0">
                <div
                    v-for="option in ['True', 'False']"
                    :key="option"
                    class="flex-1 max-w-xs py-4 px-8 rounded-xl font-medium text-lg transition-all"
                    :class="getButtonClasses(option)"
                >
                    <div class="flex items-center justify-center gap-3">
                        <svg v-if="option === 'True'" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <svg v-else class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>{{ option }}</span>
                        <span
                            v-if="isCorrectAnswer(option)"
                            class="ml-2"
                        >
                            <svg class="w-6 h-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        </span>
                        <span
                            v-else-if="isUserAnswer(option) && !isCorrectAnswer(option)"
                            class="ml-2"
                        >
                            <svg class="w-6 h-6 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </span>
                    </div>
                </div>
            </div>


            <!-- Explanation Section -->
            <div v-if="shouldShowExplanations" 
                 class="xl:mx-0 xl:mb-0 xl:mt-6 rounded-lg mt-6 p-4"
                 :class="isThemeDark 
                     ? 'bg-blue-900/20 border border-blue-600/50' 
                     : 'bg-blue-50 border border-blue-200'">
                <h4 class="font-semibold mb-2"
                    :class="isThemeDark ? 'text-blue-300' : 'text-blue-800'">
                    Explanation
                </h4>
                <div v-if="question.explanation"
                     :class="isThemeDark ? 'text-gray-300' : 'text-gray-700'"
                     v-html="renderMarkdown(question.explanation)">
                </div>
                <div v-else-if="question.justifications && question.justifications[0]"
                     :class="isThemeDark ? 'text-gray-300' : 'text-gray-700'"
                     v-html="renderMarkdown(question.justifications[0])">
                </div>
            </div>
        </div>
    </div>
</template>

<script lang="ts">
import { renderMarkdown } from '@/utils/markdown';

export default {
    props: {
        question: Object,
        answer: {
            type: Object,
            default: () => ({
                question_id: null,
                selected_options: [],
                duration: 0,
                is_correct: false
            })
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
        isThemeDark() {
            // Use prop if provided, otherwise fallback to detection methods
            if (this.isDark !== null) {
                return this.isDark;
            }
            // Fallback detection for backward compatibility
            return document.documentElement.classList.contains('dark') ||
                   this.$el?.classList?.contains('dark-mode') ||
                   this.$parent?.$el?.classList?.contains('dark-mode') ||
                   window.matchMedia?.('(prefers-color-scheme: dark)').matches;
        },
        hasAnyExplanations() {
            return this.question?.explanation || this.question?.justifications;
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
        isCorrectAnswer(option) {
            return this.question?.correct_options?.includes(option);
        },
        isUserAnswer(option) {
            // Handle both selected_options array and user_answer
            const userAnswer = this.answer?.selected_options || this.answer?.user_answer;
            if (Array.isArray(userAnswer)) {
                return userAnswer.includes(option);
            }
            return userAnswer === option;
        },
        getButtonClasses(option) {
            const isCorrect = this.isCorrectAnswer(option);
            const isUserSelected = this.isUserAnswer(option);
            
            if (this.isThemeDark) {
                if (isCorrect) {
                    return 'bg-green-700/40 text-white font-medium border-2 border-green-400 shadow-lg shadow-green-400/20';
                } else if (isUserSelected && !isCorrect) {
                    return 'bg-red-700/40 text-white font-medium border-2 border-red-400 shadow-lg shadow-red-400/20';
                } else {
                    return 'bg-gray-700 text-gray-400 border-2 border-gray-500 opacity-60';
                }
            } else {
                if (isCorrect) {
                    return 'bg-green-100 text-green-900 font-medium border-2 border-green-500 shadow-md';
                } else if (isUserSelected && !isCorrect) {
                    return 'bg-red-100 text-red-900 font-medium border-2 border-red-500 shadow-md';
                } else {
                    return 'bg-gray-100 text-gray-500 border-2 border-gray-300 opacity-60';
                }
            }
        },
        renderMarkdown(text) {
            return renderMarkdown(text, this.isThemeDark);
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
    }
};
</script>

<style scoped>
/* Dark mode markdown styles - more specific selectors */
.bg-gray-800 :deep(strong),
.bg-gray-800 :deep(b) {
    color: white !important;
    font-weight: 600;
}

.bg-gray-800 :deep(p) {
    color: rgb(209 213 219);
}

.bg-gray-800 :deep(code) {
    background-color: rgb(51 65 85);
    color: rgb(229 231 235);
    padding: 0.25rem 0.5rem;
    border-radius: 0.25rem;
}

.bg-gray-800 :deep(h1),
.bg-gray-800 :deep(h2),
.bg-gray-800 :deep(h3),
.bg-gray-800 :deep(h4),
.bg-gray-800 :deep(h5),
.bg-gray-800 :deep(h6) {
    color: white;
}

/* Light mode markdown styles */
.bg-white :deep(strong),
.bg-white :deep(b) {
    font-weight: 700;
    color: rgb(17 24 39);
}

.bg-white :deep(code) {
    background-color: rgb(243 244 246);
    color: rgb(31 41 55);
    padding: 0 0.25rem;
    border-radius: 0.25rem;
}
</style>