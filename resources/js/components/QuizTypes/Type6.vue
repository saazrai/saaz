<template>
    <div :class="[
            'transition-all duration-300 w-full backdrop-blur-md rounded-2xl border shadow-xl',
            isThemeDark 
                ? 'bg-gray-800 border-gray-700' 
                : 'bg-white border-gray-200'
         ]">
        <div class="px-2 py-8 lg:p-8">
            <div class="text-lg font-medium mb-6 px-6"
                :class="isThemeDark 
                    ? 'text-white' 
                    : 'text-gray-800'"
                v-html="renderedQuestion">
            </div>
            
            <div class="relative inline-block mx-6">
                <!-- Image with white background outline -->
                <img 
                    v-if="imageUrl"
                    :src="imageUrl" 
                    class="max-w-full h-auto block mx-auto"
                    :style="{ 
                        boxShadow: isThemeDark ? '0 0 0 8px white, 0 0 0 10px rgba(0,0,0,0.1)' : 'none',
                        borderRadius: '8px'
                    }"
                />
                <div v-else :class="[
                    'flex items-center justify-center h-96 w-full rounded-lg',
                    isThemeDark ? 'bg-gray-700' : 'bg-gray-100'
                ]">
                    <p :class="isThemeDark ? 'text-gray-400' : 'text-gray-500'">
                        Image not available
                    </p>
                </div>
                
                <!-- Hotspot overlays -->
                <template v-if="isReview">
                    <div
                        v-for="(option, i) in question.options"
                        :key="`review-${i}`"
                        :class="getReviewOptionClasses(i, option)"
                        :style="{
                            position: 'absolute',
                            top: option.y + 'px',
                            left: option.x + 'px',
                            marginLeft: '-35px',
                            marginTop: '-35px'
                        }"
                    ></div>
                </template>
                <template v-else>
                    <div
                        v-for="(option, i) in question.options"
                        :key="`interactive-${i}`"
                        :class="getInteractiveOptionClasses(option)"
                        :style="{
                            position: 'absolute',
                            top: option.y + 'px',
                            left: option.x + 'px',
                            marginLeft: '-35px',
                            marginTop: '-35px'
                        }"
                        @click="select(option)"
                    >
                        <span v-if="selectedOptions === option" class="absolute inset-0 flex items-center justify-center text-white font-bold text-lg">
                            ✓
                        </span>
                    </div>
                </template>
            </div>
        </div>
        
        <!-- Answer Review Section (only in review mode) -->
        <div v-if="isReview && answer"
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
                            ? 'Great job! You identified the correct placement.' 
                            : 'Not quite right. See the correct placement below.' }}
                    </p>
                </div>
                
                <!-- Justification/Explanation -->
                <div v-if="question.justifications || question.explanation">
                    <h4 class="font-semibold text-lg mb-2"
                        :class="isThemeDark ? 'text-white' : 'text-gray-900'">
                        Explanation:
                    </h4>
                    <div class="text-lg"
                         :class="isThemeDark ? 'text-gray-300' : 'text-gray-700'"
                         v-html="renderJustification()">
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
        question: {
            type: Object,
            required: true
        },
        answer: {
            type: Object,
            default: () => ({})
        },
        isReview: {
            type: Boolean,
            default: false
        },
        isDarkMode: {
            type: Boolean,
            default: null
        }
    },
    computed: {
        renderedQuestion() {
            if (!this.question?.content) return '';
            return marked(this.question.content);
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
        },
        imageUrl() {
            // Check if image is provided as a path
            if (this.question.image) {
                if (typeof this.question.image === 'string') {
                    return this.question.image;
                }
                if (this.question.image.path) {
                    return this.question.image.path;
                }
            }
            // Check if image URL is embedded in content as markdown
            const imgMatch = this.question.content?.match(/!\[.*?\]\((.*?)\)/);
            if (imgMatch && imgMatch[1]) {
                return imgMatch[1];
            }
            return null;
        },
        correctOptionIndex() {
            const target = this.question.correct_options;
            return this.question.options.findIndex(
                (item) => item.x === target.x && item.y === target.y
            );
        },
        isMultiChoice() {
            return (
                Array.isArray(this.question.correct_options) &&
                this.question.correct_options.length > 1
            );
        }
    },
    data() {
        return {
            selectedOptions: null,
            bullets: ["A", "B", "C", "D", "E", "F", "G", "H"]
        };
    },
    methods: {
        select(option) {
            this.selectedOptions = option;
        },
        renderJustification() {
            try {
                // Handle justifications field
                if (this.question?.justifications) {
                    // Check if it's a string
                    if (typeof this.question.justifications === 'string') {
                        return marked(this.question.justifications);
                    }
                    // Check if it's an array
                    else if (Array.isArray(this.question.justifications) && this.question.justifications.length > 0) {
                        // Get the justification for the correct answer
                        const correctIndex = this.correctOptionIndex;
                        if (correctIndex >= 0 && this.question.justifications[correctIndex]) {
                            return marked(this.question.justifications[correctIndex]);
                        }
                        // Fallback to first justification if available
                        if (this.question.justifications[0]) {
                            return marked(this.question.justifications[0]);
                        }
                    }
                }
                
                // Fallback to explanation field if justifications not available
                if (this.question?.explanation) {
                    return marked(this.question.explanation);
                }
                
                return '';
            } catch (error) {
                console.error('Error rendering justification:', error);
                return '';
            }
        },
        isCorrectOption(index) {
            return this.correctOptionIndex == index;
        },
        isIncorrectOption(option) {
            const selected = this.answer.selected_options;
            const correct = this.question.correct_options;
            return (
                selected?.x === option.x &&
                selected?.y === option.y &&
                !(correct?.x === option.x && correct?.y === option.y)
            );
        },
        selectedOptionIndex() {
            return this.question.options.findIndex(
                (option) =>
                    this.selectedOptions.x === option.x &&
                    this.selectedOptions.y === option.y
            );
        },
        findArrayIndex(mainArray, searchArray) {
            return mainArray.findIndex(
                (arr) =>
                    arr.length === searchArray.length &&
                    arr.every(
                        (element, index) => element === searchArray[index]
                    )
            );
        },
        getReviewOptionClasses(i, option) {
            const baseClasses = 'h-[70px] w-[70px] rounded-lg z-[200] border-2';
            
            if (this.isCorrectOption(i)) {
                return `${baseClasses} ${this.isThemeDark ? 'bg-green-500/40 border-green-400' : 'bg-green-400/40 border-green-600'}`;
            } else if (this.isIncorrectOption(option)) {
                return `${baseClasses} ${this.isThemeDark ? 'bg-red-500/40 border-red-400' : 'bg-red-400/40 border-red-600'}`;
            }
            return `${baseClasses} ${this.isThemeDark ? 'bg-gray-600/20 border-gray-500' : 'bg-gray-300/20 border-gray-400'}`;
        },
        getInteractiveOptionClasses(option) {
            const baseClasses = 'h-[70px] w-[70px] rounded-lg cursor-pointer z-[200] border-2 transition-all duration-200';
            
            if (this.selectedOptions === option) {
                return `${baseClasses} ${this.isThemeDark ? 'bg-blue-500/60 border-blue-400 shadow-lg shadow-blue-500/30' : 'bg-blue-500/60 border-blue-600 shadow-lg shadow-blue-500/30'}`;
            } else {
                return `${baseClasses} ${this.isThemeDark ? 'hover:bg-blue-500/30 hover:border-blue-400 border-transparent' : 'hover:bg-blue-500/30 hover:border-blue-600 border-transparent'}`;
            }
        }
    },
    watch: {
        question: {
            immediate: true,
            handler() {
                // Check if there's a saved answer to restore
                if (this.answer?.selected_options && this.answer.selected_options) {
                    // For Type6 (hotspot), selected_options should be an object with x and y coordinates
                    if (typeof this.answer.selected_options === 'object' && !Array.isArray(this.answer.selected_options)) {
                        this.selectedOptions = this.answer.selected_options;
                    } else if (Array.isArray(this.answer.selected_options) && this.answer.selected_options.length > 0) {
                        // Handle case where it might be stored as array
                        this.selectedOptions = this.answer.selected_options[0];
                    } else {
                        this.selectedOptions = null;
                    }
                } else {
                    this.selectedOptions = null;
                }
            }
        },
        selectedOptions() {
            this.$emit("selected", this.selectedOptions);
        },
    },
};
</script>
