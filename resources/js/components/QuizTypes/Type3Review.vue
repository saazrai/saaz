<template>
    <div :class="[
            'transition-all duration-300 w-full backdrop-blur-md rounded-2xl pt-8 font-medium shadow-xl',
            isThemeDark ? 'bg-slate-800' : 'bg-white'
         ]">
        <div :class="[
                'border rounded-2xl',
                isThemeDark ? 'border-slate-700' : 'border-gray-200'
             ]">
            <div class="px-2 py-8 lg:p-8">
                <h4 class="text-lg font-bold mb-10 px-6"
                    :class="isThemeDark ? 'text-white' : 'text-gray-800'">
                    <b>{{ question.content }}</b>
                </h4>
                <div class="question-options grid grid-cols-1 sm:grid-cols-2 gap-4 px-6">
                    <div class="mb-8">
                        <h3 class="text-md font-semibold mb-2"
                            :class="isThemeDark ? 'text-white' : 'text-gray-800'">ITEMS</h3>
                        <div
                            v-for="(option, index) in question.options"
                            :key="index"
                            :class="[
                                'h-[82px] sm:h-[82px] flex items-center p-4 my-2 text-lg rounded-xl border shadow-sm transition-all duration-200 cursor-default',
                                isThemeDark ? 'text-white bg-slate-700/40 border-slate-600' : 'text-gray-900 bg-gray-200 border-gray-200'
                            ]"
                        >
                            {{ option }}
                        </div>
                    </div>
                    <div class="mb-8">
                        <h3 class="text-md font-semibold mb-2"
                            :class="isThemeDark ? 'text-white' : 'text-gray-800'">YOUR ANSWERS</h3>
                        <div
                            v-for="(option, index) in getUserAnswers()"
                            :key="index"
                            class="option h-[82px] sm:h-[82px] flex items-center p-4 my-2 text-lg rounded-xl shadow-sm transition-all duration-200"
                            :class="getAnswerItemClasses(index)"
                        >
                            <span class="flex-1" :class="isUserAnswerCorrect(option) ? (isThemeDark ? 'text-green-300' : 'text-green-700') : (isThemeDark ? 'text-red-300' : 'text-red-700')">{{ option }}</span>
                            <span class="ml-auto">
                                <span
                                    v-if="isUserAnswerCorrect(option)"
                                    class="font-bold text-xl"
                                    :class="isThemeDark ? 'text-green-400' : 'text-green-600'"
                                >✓</span>
                                <span
                                    v-else
                                    class="font-bold text-xl"
                                    :class="isThemeDark ? 'text-red-400' : 'text-red-600'"
                                >✗</span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <!-- Answer Review Section -->
            <div
                :class="[
                    'border-t',
                    answer.is_correct
                        ? (this.isThemeDark ? 'bg-green-500/5 border-green-500/30' : 'bg-green-100 border-green-300')
                        : (this.isThemeDark ? 'bg-red-500/5 border-red-500/30' : 'bg-red-100 border-red-300')
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
                                ? 'Great job! You selected all the correct items.' 
                                : 'Some of your selections were incorrect.' }}
                        </p>
                    </div>
                    
                    <!-- Correct Answer -->
                    <div class="lg:max-w-[50%] lg:mx-auto">
                        <h4 class="font-semibold text-lg mb-3"
                            :class="isThemeDark ? 'text-white' : 'text-gray-900'">
                            Correct Answer:
                        </h4>
                        <div class="space-y-3">
                            <div v-for="(option, index) in question.correct_options" :key="index"
                                 :class="[
                                     'rounded-xl p-4 transition-all',
                                     isThemeDark 
                                         ? 'bg-green-500/20 border border-green-500/50' 
                                         : 'bg-green-50 border border-green-500'
                                 ]">
                                <div class="flex items-center">
                                    <span class="font-medium text-lg"
                                          :class="isThemeDark ? 'text-white' : 'text-gray-900'">
                                        {{ option }}
                                    </span>
                                    <svg class="w-5 h-5 ml-2 inline-block" 
                                         :class="isThemeDark ? 'text-green-400' : 'text-green-600'"
                                         fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</template>

<script lang="ts">
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
        }
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
        isCorrectOption(index) {
            // For Type 3 (Drag & Drop Fill-in-blanks), check if the user's answer 
            // exists in the correct options array (order doesn't matter for individual items)
            const userAnswers = this.getUserAnswers();
            const userAnswer = userAnswers[index];
            
            if (!userAnswer || !this.question?.correct_options) {
                return false;
            }
            
            // Check if this specific answer is in the correct options
            return this.question.correct_options.includes(userAnswer);
        },
        isUserAnswerCorrect(userAnswer) {
            if (!userAnswer || !this.question?.correct_options) {
                return false;
            }
            return this.question.correct_options.includes(userAnswer);
        },
        getAnswerItemClasses(index) {
            const userAnswers = this.getUserAnswers();
            const userAnswer = userAnswers[index];
            
            if (this.isUserAnswerCorrect(userAnswer)) {
                return this.isThemeDark
                    ? 'border bg-green-500/10 border-green-500/50'
                    : 'border bg-green-100 border-green-500';
            } else {
                return this.isThemeDark
                    ? 'border bg-red-500/10 border-red-500/50'
                    : 'border bg-red-100 border-red-500';
            }
        },
        getAnswerItemStyle() {
            // Return empty string - we'll use classes instead
            return '';
        },
    },
};
</script> 