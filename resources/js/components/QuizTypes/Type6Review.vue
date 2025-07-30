<template>
    <div :class="[
            'transition-all duration-300 w-full',
            // Small screens: original card styling
            'backdrop-blur-md rounded-2xl border shadow-xl',
            // Large screens: match Question Details styling
            'xl:bg-white/90 xl:dark:bg-gray-800/90 xl:backdrop-blur-xl xl:rounded-2xl xl:shadow-xl xl:border xl:border-gray-200/30 xl:dark:border-gray-700/30 xl:p-6',
            // Colors for small screens
            isThemeDark 
                ? 'bg-gray-700 border-gray-500' 
                : 'bg-white border-gray-200'
         ]">
        <div>
            <div class="text-lg font-medium mb-6"
                :class="isThemeDark 
                    ? 'text-white' 
                    : 'text-gray-800'"
                v-html="renderedQuestion">
            </div>
            
            <div class="overflow-x-auto">
                <div class="relative inline-block">
                <!-- Image wrapper with border -->
                <div v-if="imageUrl" 
                     class="inline-block mx-auto"
                     :style="{ 
                        border: '16px solid white',
                        borderRadius: '8px',
                        boxShadow: '0 4px 8px rgba(0,0,0,0.1)'
                     }">
                    <img 
                        :src="imageUrl" 
                        class="block"
                        :style="{ 
                            width: 'auto',
                            height: 'auto',
                            maxWidth: 'none',
                            maxHeight: 'none',
                            display: 'block'
                        }"
                    />
                </div>
                <div v-else :class="[
                    'flex items-center justify-center h-96 w-full rounded-lg',
                    isThemeDark ? 'bg-gray-700' : 'bg-gray-100'
                ]">
                    <p :class="isThemeDark ? 'text-gray-400' : 'text-gray-500'">
                        Image not available
                    </p>
                </div>
                
                <!-- Hotspot overlays for review -->
                <div
                    v-for="(option, i) in question.options"
                    :key="`review-${i}`"
                    :class="getReviewOptionClasses(i, option)"
                    :style="{
                        position: 'absolute',
                        top: (option.y + 16) + 'px',
                        left: (option.x + 16) + 'px',
                        marginLeft: '-35px',
                        marginTop: '-35px'
                    }"
                ></div>
                </div>
            </div>
        </div>
        
        <!-- Answer Review Section -->
        <div v-if="answer"
            :class="[
                'border-t mt-6 rounded-b-2xl',
                answer.is_correct
                    ? (isThemeDark ? 'bg-green-500/5 border-green-500/30' : 'bg-green-100 border-green-300')
                    : (isThemeDark ? 'bg-red-500/5 border-red-500/30' : 'bg-red-100 border-red-300')
            ]"
        >
            <div class="p-6 lg:p-8">
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
                <div v-if="shouldShowExplanations">
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
        imageUrl() {
            // Check if image is in settings
            if (this.question.settings?.image) {
                return this.question.settings.image;
            }
            // Check if image is provided as a path (legacy)
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
        hasAnyExplanations() {
            return this.question?.justifications || this.question?.explanation;
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
        renderJustification() {
            try {
                // Handle justifications field
                if (this.question?.justifications) {
                    // Check if it's a string
                    if (typeof this.question.justifications === 'string') {
                        return renderMarkdown(this.question.justifications, this.isThemeDark);
                    }
                    // Check if it's an array
                    else if (Array.isArray(this.question.justifications) && this.question.justifications.length > 0) {
                        // Get the justification for the correct answer
                        const correctIndex = this.correctOptionIndex;
                        if (correctIndex >= 0 && this.question.justifications[correctIndex]) {
                            return renderMarkdown(this.question.justifications[correctIndex], this.isThemeDark);
                        }
                        // Fallback to first justification if available
                        if (this.question.justifications[0]) {
                            return renderMarkdown(this.question.justifications[0], this.isThemeDark);
                        }
                    }
                }
                
                // Fallback to explanation field if justifications not available
                if (this.question?.explanation) {
                    return renderMarkdown(this.question.explanation, this.isThemeDark);
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
        getReviewOptionClasses(i, option) {
            const baseClasses = 'h-[70px] w-[70px] rounded-lg z-200 border-2';
            
            if (this.isCorrectOption(i)) {
                return `${baseClasses} ${this.isThemeDark ? 'bg-green-500/40 border-green-400' : 'bg-green-400/40 border-green-600'}`;
            } else if (this.isIncorrectOption(option)) {
                return `${baseClasses} ${this.isThemeDark ? 'bg-red-500/40 border-red-400' : 'bg-red-400/40 border-red-600'}`;
            }
            return `${baseClasses} ${this.isThemeDark ? 'bg-gray-600/20 border-gray-500' : 'bg-gray-300/20 border-gray-400'}`;
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