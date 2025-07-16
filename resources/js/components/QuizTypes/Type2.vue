<template>
    <!-- Question Panel - True/False Style -->
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

            <div class="flex gap-4 justify-center px-6 pb-8 mt-6">
                <button
                    v-for="option in ['True', 'False']"
                    :key="option"
                    class="flex-1 max-w-xs py-4 px-8 rounded-xl font-medium text-lg transition-all transform hover:scale-105"
                    :class="getButtonClasses(option)"
                    @click="handleOptionClick(option)"
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
                            v-if="selectedOption === option"
                            class="ml-2 font-bold text-xl"
                            >✓</span
                        >
                    </div>
                </button>
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
            selectedOption: null,
        };
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
        getButtonClasses(option) {
            const isSelected = this.selectedOption === option;
            
            if (this.isThemeDark) {
                if (isSelected) {
                    // Use neutral blue for both True and False when selected
                    return 'bg-blue-700/60 text-white font-medium border-2 border-blue-400 shadow-lg shadow-blue-400/30 ring-2 ring-blue-400/20';
                } else {
                    return 'bg-gray-700/40 text-gray-300 border-2 border-gray-600 hover:bg-gray-700/60 hover:border-gray-500 hover:shadow-lg';
                }
            } else {
                if (isSelected) {
                    // Use neutral blue for both True and False when selected
                    return 'bg-blue-100 text-blue-900 font-medium border-2 border-blue-500 shadow-md ring-2 ring-blue-200';
                } else {
                    return 'bg-gray-100 text-gray-800 border-2 border-gray-300 hover:bg-gray-200 hover:border-gray-400 hover:shadow-lg';
                }
            }
        },
        handleOptionClick(option) {
            this.selectedOption = option;
        },
        normalizeSelected(value) {
            // Always return an array for consistency with other question types
            if (value !== null && value !== undefined && value !== '') {
                return [value];
            } else {
                return [];
            }
        }
    },
    watch: {
        question: {
            immediate: true,
            handler() {
                // Check if there's a saved answer to restore
                if (this.answer?.selected_options && Array.isArray(this.answer.selected_options) && this.answer.selected_options.length > 0) {
                    // Restore saved answer
                    this.selectedOption = this.answer.selected_options[0];
                } else {
                    // Initialize with no selection
                    this.selectedOption = null;
                }
            },
        },
        selectedOption: {
            handler(val) {
                this.$emit("selected", this.normalizeSelected(val));
            },
        },
    },
};
</script>

<style scoped>
button:focus {
    outline: none;
}

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
