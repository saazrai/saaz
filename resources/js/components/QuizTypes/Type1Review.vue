<template>
    <div :class="[
            'transition-all duration-300 w-full backdrop-blur-md rounded-2xl border shadow-xl overflow-hidden',
            isThemeDark 
                ? 'bg-gray-800 border-gray-700' 
                : 'bg-white border-gray-200'
         ]">
        <!-- Question Section -->
        <div class="p-8">
            <div
                class="text-lg font-medium mb-8"
                :class="isThemeDark 
                    ? 'text-white' 
                    : 'text-gray-800'"
                v-html="renderedQuestion"
            ></div>

            <!-- Options -->
            <div class="space-y-3">
                <div
                    v-for="(option, i) in options"
                    :key="i"
                    :class="['relative rounded-xl transition-all duration-200', getOptionContainerClasses(option, i)]"
                >
                    <div class="flex items-center p-4">
                        <!-- Radio/Checkbox -->
                        <div class="mr-4">
                            <input
                                :type="question.type == 2 ? 'checkbox' : 'radio'"
                                :id="'option' + i"
                                :checked="isSelectedOptionInReview(option)"
                                disabled
                                class="w-5 h-5 cursor-not-allowed"
                                :class="getInputClasses(option, i)"
                            />
                        </div>
                        
                        <!-- Option Content -->
                        <label
                            :for="'option' + i"
                            class="flex-1 flex items-center cursor-default"
                        >
                            <span class="font-semibold mr-3 text-lg"
                                  :class="isThemeDark ? 'text-white' : 'text-black'">
                                {{ bullets[i] }}.
                            </span>
                            <span class="text-lg" 
                                  :class="getOptionTextClasses(option, i)"
                                  v-html="renderMarkdown(option)">
                            </span>
                        </label>
                        
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
                            <div v-else-if="isIncorrectOption(option)" 
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
        
        <!-- Answer Explanations Section -->
        <div
            :class="[
                'border-t',
                answer.is_correct
                    ? (isThemeDark ? 'bg-green-500/5 border-green-500/30' : 'bg-green-100 border-green-300')
                    : (isThemeDark ? 'bg-red-500/5 border-red-500/30' : 'bg-red-100 border-red-500')
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
                <div class="mb-6">
                    <p :class="[
                        'font-semibold text-lg mb-2',
                        answer.is_correct
                            ? (isThemeDark ? 'text-green-400' : 'text-green-700')
                            : (isThemeDark ? 'text-red-400' : 'text-red-700')
                    ]">
                        {{ answer.is_correct ? '✓ Correct!' : '✗ Incorrect' }}
                    </p>
                    <p :class="isThemeDark ? 'text-gray-300 text-lg' : 'text-gray-700 text-lg'">
                        {{ answer.is_correct 
                            ? 'Great job! You selected the right answer.' 
                            : 'The correct answer is highlighted below.' }}
                    </p>
                </div>
                
                <!-- Option Explanations -->
                <div class="space-y-3">
                    <div
                        v-for="(option, index) in question.options"
                        :key="index"
                        :class="[
                            'rounded-xl p-4 transition-all relative',
                            isCorrectOption(index) 
                                ? (isThemeDark 
                                    ? 'bg-green-500/20 border border-green-500/60 ring-2 ring-green-500/30' 
                                    : 'bg-green-50 border border-green-500 ring-2 ring-green-200')
                                : (isThemeDark 
                                    ? 'bg-gray-700/30 border border-gray-600' 
                                    : 'bg-white border border-gray-300')
                        ]"
                    >
                        <!-- Correct Badge -->
                        <div v-if="isCorrectOption(index)" class="absolute -top-2 -right-2">
                            <div :class="[
                                'px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider',
                                isThemeDark 
                                    ? 'bg-green-500 text-white' 
                                    : 'bg-green-500 text-white'
                            ]">
                                Correct
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <span class="font-bold mr-3 text-lg flex-shrink-0"
                                  :class="isCorrectOption(index) 
                                      ? (isThemeDark ? 'text-green-400' : 'text-green-700')
                                      : (isThemeDark ? 'text-white' : 'text-black')">
                                {{ bullets[index] }}.
                            </span>
                            <div class="flex-1">
                                <div class="font-medium mb-2 text-lg flex items-center"
                                     :class="[
                                         isCorrectOption(index)
                                             ? (isThemeDark ? 'text-green-300' : 'text-green-800')
                                             : (isThemeDark ? 'text-gray-300' : 'text-gray-700')
                                     ]">
                                    {{ option }}
                                    <svg v-if="isCorrectOption(index)" class="w-5 h-5 ml-2 inline-block" 
                                         :class="isThemeDark ? 'text-green-400' : 'text-green-600'"
                                         fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                                <div 
                                    v-if="question.justifications && question.justifications[index]" 
                                    class="text-lg"
                                    :class="[
                                        isCorrectOption(index)
                                            ? (isThemeDark ? 'text-green-200' : 'text-green-700')
                                            : (isThemeDark ? 'text-gray-400' : 'text-gray-600')
                                    ]"
                                    v-html="renderMarkdown(question.justifications[index])"
                                ></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script lang="ts">
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
    data() {
        return {
            bullets: ["A", "B", "C", "D", "E", "F", "G", "H"],
        };
    },
    computed: {
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
        },
        options() {
            return this.question.options;
        },
        isMultiChoice() {
            return this.question.type == 2;
        },
        correctOptionIndexes() {
            if (!this.question?.correct_options) return [];
            // Check if correct_options contains indexes (numbers) or values (strings)
            if (typeof this.question.correct_options[0] === 'number') {
                // Already contains indexes
                return this.question.correct_options;
            } else {
                // Contains values, need to find indexes
                return this.question.correct_options.map((answer) =>
                    this.question.options.indexOf(answer)
                );
            }
        },
        renderedQuestion() {
             if (!this.question?.content) return '';
             return marked(this.question.content);
        }
    },
    methods: {
        getOptionContainerClasses(option, i) {
            // Container classes for the option div
            if (this.isCorrectOption(i)) {
                return this.isThemeDark 
                    ? 'border bg-green-500/10 border-green-500/50' 
                    : 'border bg-green-100 border-green-500';
            } else if (this.isSelectedOptionInReview(option) && this.isIncorrectOption(option)) {
                return this.isThemeDark 
                    ? 'border bg-red-500/10 border-red-500/50' 
                    : 'border bg-red-100 border-red-500';
            } else {
                return this.isThemeDark 
                    ? 'border border-gray-700 hover:bg-gray-700/20' 
                    : 'border border-gray-200 hover:bg-gray-50';
            }
        },
        getInputClasses(option, i) {
            // Classes for the radio/checkbox input
            if (this.isCorrectOption(i)) {
                return this.isThemeDark 
                    ? 'accent-green-500 border-green-500' 
                    : 'accent-green-600 border-green-600';
            } else if (this.isSelectedOptionInReview(option) && this.isIncorrectOption(option)) {
                return this.isThemeDark 
                    ? 'accent-red-500 border-red-500' 
                    : 'accent-red-600 border-red-600';
            } else {
                return this.isThemeDark 
                    ? 'border-gray-600' 
                    : 'border-gray-400';
            }
        },
        getOptionTextClasses(option, i) {
            // Classes for the option text
            if (this.isCorrectOption(i)) {
                return this.isThemeDark 
                    ? 'text-green-300' 
                    : 'text-green-700';
            } else if (this.isSelectedOptionInReview(option) && this.isIncorrectOption(option)) {
                return this.isThemeDark 
                    ? 'text-red-300' 
                    : 'text-red-700';
            } else if (!this.isSelectedOptionInReview(option) && !this.isCorrectOption(i)) {
                return this.isThemeDark 
                    ? 'text-gray-500' 
                    : 'text-gray-500';
            } else {
                return this.isThemeDark 
                    ? 'text-gray-300' 
                    : 'text-gray-700';
            }
        },
        isCorrectOption(index) {
            return this.correctOptionIndexes.includes(index);
        },
        isIncorrectOption(option) {
            if (!this.answer) return false;
            
            // Get user's answer from either user_answer or selected_options (for review mode)
            const userAnswer = this.answer.user_answer || this.answer.selected_options;
            if (!userAnswer) return false;
            
            // Normalize user_answer to array for consistent handling
            const selected = Array.isArray(userAnswer) 
                ? userAnswer 
                : [userAnswer];

            if (!this.question?.correct_options) {
                return false;
            }

            // An option is incorrect if the user selected it AND it's not in the correct options
            return (
                selected.includes(option) &&
                !this.question.correct_options.includes(option)
            );
        },
        isSelectedOptionInReview(option) {
            if (!this.answer) return false;
            
            // Get user's answer from either user_answer or selected_options (for review mode)
            const userAnswer = this.answer.user_answer || this.answer.selected_options;
            if (!userAnswer) return false;
            
            // Normalize user_answer to array for consistent handling
            const selected = Array.isArray(userAnswer) 
                ? userAnswer 
                : [userAnswer];
                
            return selected.includes(option);
        },
        renderMarkdown(text) {
             if (!text) return '';
             return marked(text);
        }
    }
};
</script>

<style scoped>
.form-check-input:focus {
    outline: none;
    box-shadow: none;
}
.form-check-input:checked {
    background-color: rgb(
        96 165 250 / var(--tw-bg-opacity, 1)
    ); /* Tailwind blue-400 */
    border-color: #3b82f6; /* Tailwind blue-500 */
    box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.3); /* ring effect */
}

/* Dark mode styles for markdown content */
:deep(.dark strong) {
    color: white;
    font-weight: 600;
}

:deep(.dark p) {
    color: rgb(209 213 219);
}

:deep(.dark code) {
    background-color: rgb(51 65 85);
    color: rgb(229 231 235);
    padding: 0.25rem 0.5rem;
    border-radius: 0.25rem;
}

:deep(.dark h1, .dark h2, .dark h3, .dark h4, .dark h5, .dark h6) {
    color: white;
}

/* Ensure proper text color inheritance in dark mode */
.dark .text-gray-800 {
    color: white;
}

.dark .text-gray-700 {
    color: rgb(229 231 235);
}

.dark .text-gray-600 {
    color: rgb(209 213 219);
}

/* Radio button customization for dark mode */
.dark input[type="radio"] {
    accent-color: #3b82f6;
}

.dark input[type="checkbox"] {
    accent-color: #3b82f6;
}
</style> 