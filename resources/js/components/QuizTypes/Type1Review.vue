<template>
    <div :class="[
            'transition-all duration-300 w-full backdrop-blur-md rounded-2xl border shadow-xl overflow-hidden',
            isThemeDark 
                ? 'bg-gray-800 border-gray-700' 
                : 'bg-white border-gray-200'
         ]">
        <!-- Question Section -->
        <div class="p-4">
            <div
                class="text-base font-medium mb-4"
                :class="isThemeDark 
                    ? 'text-white' 
                    : 'text-gray-800'"
                v-html="renderedQuestion"
            ></div>

            <!-- Options with Contextual Justifications -->
            <div class="space-y-3">
                <div
                    v-for="(option, i) in options"
                    :key="i"
                    :class="['relative rounded-lg transition-all duration-200', getOptionContainerClasses(option, i)]"
                >
                    <!-- Option Header -->
                    <div class="flex items-center justify-between p-3">
                        <!-- Option Content -->
                        <div class="flex-1 mr-3">
                            <span class="text-base" 
                                  :class="getOptionTextClasses(option, i)"
                                  v-html="renderMarkdown(option)">
                            </span>
                        </div>
                        
                        <!-- Status Indicator -->
                        <div class="flex items-center space-x-2 flex-shrink-0">
                            <!-- Status Indicator -->
                            <div v-if="isCorrectOption(i)" 
                                 class="w-6 h-6 rounded-full bg-green-500 flex items-center justify-center">
                                <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <div v-else-if="isIncorrectOption(option)" 
                                 class="w-6 h-6 rounded-full bg-red-500 flex items-center justify-center">
                                <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Contextual Justification -->
                    <div 
                        v-if="shouldShowJustification(i)"
                        class="px-3 pb-3 pt-2"
                    >
                        <div class="flex items-start space-x-3">
                            <!-- Subtle Icon Indicator -->
                            <div :class="[
                                'w-1 h-4 rounded-full flex-shrink-0 mt-0.5',
                                isCorrectOption(i)
                                    ? 'bg-green-500'
                                    : 'bg-blue-500'
                            ]"></div>
                            
                            <!-- Clean Explanation Text -->
                            <div class="flex-1 min-w-0">
                                <div 
                                    v-if="getJustificationForOption(i)"
                                    :class="[
                                        'text-sm leading-relaxed',
                                        isCorrectOption(i)
                                            ? (isThemeDark ? 'text-green-200' : 'text-green-700')
                                            : (isThemeDark ? 'text-blue-200' : 'text-blue-700')
                                    ]"
                                    v-html="renderMarkdown(getJustificationForOption(i))"
                                ></div>
                                <div 
                                    v-else
                                    class="text-sm italic"
                                    :class="isThemeDark ? 'text-gray-500' : 'text-gray-500'"
                                >
                                    No explanation available
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
                    ? (isThemeDark ? 'bg-green-500/5 border-green-500/30' : 'bg-green-50 border-green-300')
                    : (isThemeDark ? 'bg-red-500/5 border-red-500/30' : 'bg-red-50 border-red-300')
            ]"
        >
            <div class="p-4">
                <!-- Result Summary -->
                <div class="flex items-center mb-4">
                    <div :class="[
                            'w-8 h-8 rounded-lg flex items-center justify-center mr-3',
                            answer.is_correct
                                ? 'bg-green-500'
                                : 'bg-red-500'
                        ]">
                        <svg v-if="answer.is_correct" class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <svg v-else class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </div>
                    <div>
                        <p :class="[
                            'font-semibold text-base',
                            answer.is_correct
                                ? (isThemeDark ? 'text-green-400' : 'text-green-700')
                                : (isThemeDark ? 'text-red-400' : 'text-red-700')
                        ]">
                            {{ answer.is_correct ? 'Correct!' : 'Incorrect' }}
                        </p>
                        <p :class="isThemeDark ? 'text-gray-300 text-sm' : 'text-gray-600 text-sm'">
                            {{ answer.is_correct 
                                ? 'Well done!' 
                                : 'Review the correct answer below.' }}
                        </p>
                    </div>
                </div>
                
                <!-- Correct Answer Highlight -->
                <div
                    v-for="correctAnswer in correctAnswers"
                    :key="correctAnswer.index"
                    :class="[
                        'rounded-lg p-3 mb-3',
                        isThemeDark 
                            ? 'bg-green-500/20 border border-green-500/50' 
                            : 'bg-green-50 border border-green-300'
                    ]"
                >
                    <div class="flex items-center justify-between">
                        <div class="flex-1">
                            <p class="font-medium text-sm mb-1"
                               :class="isThemeDark ? 'text-green-300' : 'text-green-800'">
                                Correct Answer:
                            </p>
                            <p class="text-base"
                               :class="isThemeDark ? 'text-green-200' : 'text-green-700'">
                                {{ correctAnswer.option }}
                            </p>
                        </div>
                        <div class="w-6 h-6 rounded-full bg-green-500 flex items-center justify-center ml-3">
                            <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                            </svg>
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
            showDetailedExplanations: false,
            windowWidth: typeof window !== 'undefined' ? window.innerWidth : 1024
        };
    },
    computed: {
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
        options() {
            return this.question?.options || [];
        },
        isMultiChoice() {
            return this.question.type == 2;
        },
        correctOptionIndexes() {
            if (!this.question?.correct_options || this.question.correct_options.length === 0) return [];
            // Check if correct_options contains indexes (numbers) or values (strings)
            if (typeof this.question.correct_options[0] === 'number') {
                // Already contains indexes
                return this.question.correct_options;
            } else {
                // Contains values, need to find indexes
                if (!this.question.options) return [];
                return this.question.correct_options.map((answer) =>
                    this.question.options.indexOf(answer)
                );
            }
        },
        renderedQuestion() {
             if (!this.question?.content) return '';
             return marked(this.question.content);
        },
        hasAnyJustifications() {
            return this.question?.justifications && 
                   Object.values(this.question.justifications).some(justification => 
                       typeof justification === 'string' && justification.trim() !== '');
        },
        correctAnswers() {
            if (!this.options || !this.correctOptionIndexes || this.correctOptionIndexes.length === 0) return [];
            
            return this.correctOptionIndexes.map(index => ({
                index: index,
                option: this.options[index]
            })).filter(item => item.option !== undefined && item.option !== null);
        },
        shouldShowExplanations() {
            // Desktop: always show if explanations exist
            // Mobile: show only if parent component says to show them
            if (this.windowWidth >= 1024) {
                return this.hasAnyJustifications;
            } else {
                return this.showExplanations && this.hasAnyJustifications;
            }
        }
    },
    methods: {
        getOptionContainerClasses(option, i) {
            // Simplified container classes for clean mobile design
            if (this.isCorrectOption(i)) {
                return this.isThemeDark 
                    ? 'bg-green-500/10 border border-green-500/30' 
                    : 'bg-green-50 border border-green-300';
            } else if (this.isSelectedOptionInReview(option) && this.isIncorrectOption(option)) {
                return this.isThemeDark 
                    ? 'bg-red-500/10 border border-red-500/30' 
                    : 'bg-red-50 border border-red-300';
            } else {
                return this.isThemeDark 
                    ? 'bg-gray-800/50 border border-gray-700' 
                    : 'bg-gray-50 border border-gray-200';
            }
        },
        getOptionTextClasses(option, i) {
            // Simplified text classes for better readability
            if (this.isCorrectOption(i)) {
                return this.isThemeDark 
                    ? 'text-green-300 font-medium' 
                    : 'text-green-700 font-medium';
            } else if (this.isSelectedOptionInReview(option) && this.isIncorrectOption(option)) {
                return this.isThemeDark 
                    ? 'text-red-300 font-medium' 
                    : 'text-red-700 font-medium';
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
        },
        shouldShowJustification(optionIndex) {
            // Use the global explanation visibility state
            return this.shouldShowExplanations && this.hasJustificationForOption(optionIndex);
        },
        hasJustificationForOption(optionIndex) {
            if (!this.question?.justifications) return false;
            
            // Check if justifications is an array (indexed by option index)
            if (Array.isArray(this.question.justifications)) {
                const justification = this.question.justifications[optionIndex];
                return justification && typeof justification === 'string' && justification.trim() !== '';
            }
            
            // Check if justifications is an object (keyed by option index or option text)
            if (typeof this.question.justifications === 'object') {
                // Try by index first
                let justification = this.question.justifications[optionIndex];
                
                // If not found by index, try by option content
                if (!justification && this.options[optionIndex]) {
                    justification = this.question.justifications[this.options[optionIndex]];
                }
                
                return justification && typeof justification === 'string' && justification.trim() !== '';
            }
            
            return false;
        },
        getJustificationForOption(optionIndex) {
            if (!this.question?.justifications) return null;
            
            // Check if justifications is an array (indexed by option index)
            if (Array.isArray(this.question.justifications)) {
                return this.question.justifications[optionIndex] || null;
            }
            
            // Check if justifications is an object (keyed by option index or option text)
            if (typeof this.question.justifications === 'object') {
                // Try by index first
                let justification = this.question.justifications[optionIndex];
                
                // If not found by index, try by option content
                if (!justification && this.options[optionIndex]) {
                    justification = this.question.justifications[this.options[optionIndex]];
                }
                
                return justification || null;
            }
            
            return null;
        }
    },
    mounted() {
        // Add window resize listener for responsive behavior
        if (typeof window !== 'undefined') {
            this.handleWindowResize = () => {
                this.windowWidth = window.innerWidth;
            };
            window.addEventListener('resize', this.handleWindowResize);
        }
    },
    beforeUnmount() {
        // Clean up window resize listener
        if (typeof window !== 'undefined' && this.handleWindowResize) {
            window.removeEventListener('resize', this.handleWindowResize);
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