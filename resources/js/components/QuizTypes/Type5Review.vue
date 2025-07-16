<template>
    <!-- Question Panel -->
    <div :class="[
            'transition-all duration-300 w-full backdrop-blur-md rounded-2xl border shadow-xl',
            isThemeDark 
                ? 'bg-slate-800 dark:bg-slate-900 border-slate-700 dark:border-slate-800' 
                : 'bg-white border-gray-200'
         ]">
        <div class="p-8">
            <h4 class="text-lg font-bold mb-8"
                :class="isThemeDark 
                    ? 'text-white dark:text-white' 
                    : 'text-gray-800'">
                <b>{{ question.content }}</b>
            </h4>
            
            <!-- Your Matches -->
            <div class="mb-8">
                <h3 class="text-lg font-semibold mb-4"
                    :class="isThemeDark 
                        ? 'text-white' 
                        : 'text-gray-800'">Your Matches</h3>
                <div class="space-y-3">
                    <div
                        v-for="(element, index) in displayItems"
                        :key="index"
                        :class="[
                            'flex flex-col sm:flex-row items-stretch gap-3 p-4 rounded-xl',
                            isCorrectOption(index)
                                ? (isThemeDark 
                                    ? 'bg-green-500/10 border border-green-500/50' 
                                    : 'bg-green-50 border border-green-500')
                                : (isThemeDark 
                                    ? 'bg-red-500/10 border border-red-500/50' 
                                    : 'bg-red-50 border border-red-500')
                        ]"
                    >
                        <!-- Item -->
                        <div :class="[
                            'flex-1 sm:flex-none sm:w-1/3 p-3 rounded-lg font-medium text-lg',
                            isThemeDark 
                                ? 'bg-gray-800/50 text-white' 
                                : 'bg-white text-gray-900'
                        ]">
                            {{ element }}
                        </div>
                        
                        <!-- Arrow -->
                        <div class="hidden sm:flex items-center px-2">
                            <svg xmlns="http://www.w3.org/2000/svg" 
                                 :class="[
                                     'w-6 h-6',
                                     isCorrectOption(index)
                                         ? (isThemeDark ? 'text-green-400' : 'text-green-600')
                                         : (isThemeDark ? 'text-red-400' : 'text-red-600')
                                 ]"
                                 fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </div>
                        
                        <!-- User's Answer -->
                        <div :class="[
                            'flex-1 p-3 rounded-lg text-lg flex items-center justify-between',
                            isThemeDark 
                                ? 'bg-gray-800/50' 
                                : 'bg-white'
                        ]">
                            <span :class="isCorrectOption(index) 
                                ? (isThemeDark ? 'text-green-300' : 'text-green-700') 
                                : (isThemeDark ? 'text-red-300' : 'text-red-700')">
                                {{ getUserAnswers()[index] || '(No answer)' }}
                            </span>
                            <span>
                                <svg v-if="isCorrectOption(index)" 
                                     class="w-5 h-5" 
                                     :class="isThemeDark ? 'text-green-400' : 'text-green-600'"
                                     fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                                </svg>
                                <svg v-else 
                                     class="w-5 h-5" 
                                     :class="isThemeDark ? 'text-red-400' : 'text-red-600'"
                                     fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Answer Review Section -->
        <div
            :class="[
                'border-t -mx-[1px] -mb-[1px] rounded-b-2xl',
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
                                ? 'Excellent! You matched all items correctly.' 
                                : 'Some matches are incorrect. See the correct pairings below.' }}
                        </p>
                    </div>
                    
                    <!-- Correct Matches -->
                    <div>
                        <h4 class="font-semibold text-lg mb-3"
                            :class="isThemeDark ? 'text-white' : 'text-gray-900'">
                            Correct Matches:
                        </h4>
                        <div class="space-y-3">
                            <div
                                v-for="(item, index) in displayItems"
                                :key="index"
                                :class="[
                                    'flex flex-col sm:flex-row items-stretch gap-3 p-4 rounded-xl',
                                    isThemeDark 
                                        ? 'bg-green-500/20 border border-green-500/50' 
                                        : 'bg-green-50 border border-green-500'
                                ]"
                            >
                                <!-- Item -->
                                <div :class="[
                                    'flex-1 sm:flex-none sm:w-1/3 p-3 rounded-lg font-medium text-lg',
                                    isThemeDark 
                                        ? 'bg-gray-800/50 text-white' 
                                        : 'bg-white text-gray-900'
                                ]">
                                    {{ item }}
                                </div>
                                
                                <!-- Arrow -->
                                <div class="hidden sm:flex items-center px-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" 
                                         class="w-6 h-6 text-green-500"
                                         fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                    </svg>
                                </div>
                                
                                <!-- Correct Definition -->
                                <div :class="[
                                    'flex-1 p-3 rounded-lg text-lg flex items-center justify-between',
                                    isThemeDark 
                                        ? 'bg-gray-800/50 text-green-300' 
                                        : 'bg-white text-green-700'
                                ]">
                                    <span class="font-medium">{{ getCorrectAnswer(item) }}</span>
                                    <svg class="w-5 h-5 ml-2 flex-shrink-0" 
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
        isDarkMode: {
            type: Boolean,
            default: null
        }
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
                   this.isThemeDark ||
                   window.matchMedia?.('(prefers-color-scheme: dark)').matches;
        }
    },
    data() {
        return {
            displayItems: [], // Keep items in original order for review
        };
    },
    mounted() {
        this.$nextTick(function () {
            this.setupItems();
        });
    },

    methods: {
        setupItems() {
            if (this.question.options && this.question.options.items) {
                // Keep items (left side) in original order for review
                this.displayItems = [...this.question.options.items];
            }
        },
        getUserAnswers() {
            // Get user's selected answers from either user_answer or selected_options (for review mode)
            if (this.answer) {
                const userAnswer = this.answer.user_answer || this.answer.selected_options;
                if (userAnswer && Array.isArray(userAnswer)) {
                    return userAnswer;
                }
            }
            return [];
        },
        isCorrectOption(index) {
            // For Type 5 (Drag & Drop Match), check if the user matched the correct definition to the item
            const userAnswers = this.getUserAnswers();
            const item = this.displayItems[index];
            const userAnswer = userAnswers[index];
            
            // If correct_options is an object (mapping items to definitions)
            if (this.question?.correct_options && typeof this.question.correct_options === 'object' && !Array.isArray(this.question.correct_options)) {
                return userAnswer === this.question.correct_options[item];
            }
            
            // If correct_options is an array (ordered list)
            return userAnswers[index] === this.question?.correct_options?.[index];
        },
        getAnswerItemClasses(index) {
            const isDark = this.isThemeDark;
            const isCorrect = this.isCorrectOption(index);
            
            if (isDark) {
                return isCorrect
                    ? 'bg-green-500/10 border border-green-500/50'
                    : 'bg-red-500/10 border border-red-500/50';
            } else {
                return isCorrect
                    ? 'bg-green-100 border border-green-500'
                    : 'bg-red-100 border border-red-500';
            }
        },
        getCorrectAnswer(item) {
            // Check if correct_options is an object with item as key (primary case)
            if (this.question?.correct_options && typeof this.question.correct_options === 'object' && !Array.isArray(this.question.correct_options)) {
                return this.question.correct_options[item] || '';
            }
            
            // Fallback: For Type 5, correct_options might be ordered array to match displayItems
            const itemIndex = this.displayItems.indexOf(item);
            if (itemIndex !== -1 && this.question?.correct_options?.[itemIndex]) {
                return this.question.correct_options[itemIndex];
            }
            
            return '';
        },
    },
    watch: {
        question() {
            this.setupItems();
        },
    },
};
</script> 