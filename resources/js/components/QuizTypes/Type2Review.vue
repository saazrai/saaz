<template>
    <!-- Question Review Panel - True/False Style -->
    <div :class="[
            'transition-all duration-300 w-full backdrop-blur-md rounded-2xl border shadow-xl',
            isThemeDark 
                ? 'bg-gray-800 border-gray-700' 
                : 'bg-white border-gray-200'
         ]">
        <div>
            <div
                class="px-6 pt-8 pb-4 rounded text-lg font-medium"
                :class="isThemeDark 
                    ? 'text-white' 
                    : 'text-gray-800'"
                v-html="renderedQuestion"
            ></div>

            <div class="flex gap-4 justify-center px-6 pb-4 mt-6">
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

            <!-- Result Section -->
            <div class="px-6 pb-6">
                <div :class="[
                    'rounded-lg p-4 text-center',
                    answer?.is_correct 
                        ? (isThemeDark ? 'bg-green-900/20 border border-green-600/50' : 'bg-green-50 border border-green-200')
                        : (isThemeDark ? 'bg-red-900/20 border border-red-600/50' : 'bg-red-50 border border-red-200')
                ]">
                    <p :class="[
                        'font-semibold text-lg',
                        answer?.is_correct
                            ? (isThemeDark ? 'text-green-400' : 'text-green-700')
                            : (isThemeDark ? 'text-red-400' : 'text-red-700')
                    ]">
                        {{ answer?.is_correct ? '✓ Correct!' : '✗ Incorrect' }}
                    </p>
                </div>
            </div>

            <!-- Explanation Section -->
            <div v-if="question.explanation || question.justifications" 
                 class="mx-6 mb-6 p-4 rounded-lg"
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

<script>
import { marked } from 'marked';

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
        isDarkMode: {
            type: Boolean,
            default: null
        }
    },
    computed: {
        renderedQuestion() {
             if (!this.question?.content) return '';
             let html = marked(this.question.content);
             // Force white color for bold/strong tags in dark mode
             if (this.isThemeDark) {
                 html = html.replace(/<strong>/g, '<strong style="color: white;">');
                 html = html.replace(/<b>/g, '<b style="color: white;">');
             }
             return html;
        },
        isThemeDark() {
            // Use prop if provided, otherwise fallback to detection methods
            if (this.isDarkMode !== null) {
                return this.isDarkMode;
            }
            // Fallback detection for backward compatibility
            return document.documentElement.classList.contains('dark') ||
                   this.$el?.classList?.contains('dark-mode') ||
                   this.$parent?.$el?.classList?.contains('dark-mode') ||
                   window.matchMedia?.('(prefers-color-scheme: dark)').matches;
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
                    return 'bg-gray-700/40 text-gray-400 border-2 border-gray-600 opacity-60';
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
             if (!text) return '';
             let html = marked(text);
             // Force white color for bold/strong tags in dark mode
             if (this.isThemeDark) {
                 html = html.replace(/<strong>/g, '<strong style="color: inherit;">');
                 html = html.replace(/<b>/g, '<b style="color: inherit;">');
             }
             return html;
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