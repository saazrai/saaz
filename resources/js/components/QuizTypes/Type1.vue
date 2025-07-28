<template>
    <!-- Question Panel -->
    <div :class="[
            'transition-all duration-300 w-full backdrop-blur-md rounded-2xl border shadow-xl p-3 lg:p-6',
            isThemeDark 
                ? 'bg-gray-800 border-gray-700' 
                : 'bg-white border-slate-300 shadow-slate-200'
         ]"
         :data-theme="isThemeDark ? 'dark' : 'light'">
        <div>
            <div
                class="rounded text-base lg:text-lg font-medium leading-tight lg:leading-normal"
                :class="isThemeDark 
                    ? 'text-white' 
                    : 'text-slate-900'"
                v-html="renderedQuestion"
            ></div>

            <div class="pb-2 my-4 lg:my-6 space-y-2">
                <div
                    v-for="(option, i) in options"
                    :key="i"
                    class="relative p-4 rounded-xl transition-all duration-200 ease-in-out active:scale-98"
                    :class="[
                        getCardClasses(option),
                        isOptionDisabled(option) ? 'cursor-not-allowed opacity-50' : 'cursor-pointer hover:shadow-lg'
                    ]"
                    @click="handleOptionClick(option)"
                    role="button"
                    :aria-pressed="isSelectedOption(option)"
                    :aria-disabled="isOptionDisabled(option)"
                >
                    <!-- Option Content -->
                    <div class="flex items-start space-x-3">
                        <!-- Option Label (Desktop only) -->
                        <span 
                            :class="[
                                'hidden lg:inline-flex items-center justify-center w-8 h-8 text-sm font-bold transition-colors',
                                isMultiSelect ? 'rounded-md' : 'rounded-full',
                                isSelectedOption(option)
                                    ? (isThemeDark ? 'bg-blue-600 text-white' : 'bg-blue-600 text-white')
                                    : (isThemeDark ? 'bg-gray-500 text-gray-300' : 'bg-gray-100 text-gray-600')
                            ]"
                        >
                            {{ bullets[i] }}
                        </span>
                        
                        <!-- Option Text -->
                        <div 
                            class="flex-1 text-base lg:text-lg leading-relaxed"
                            :class="[
                                isSelectedOption(option) ? 'font-semibold' : 'font-medium',
                                isThemeDark ? 'text-white' : 'text-gray-900'
                            ]"
                            v-html="renderMarkdown(option)"
                        ></div>
                    </div>
                </div>
            </div>
            
            <!-- Max Selection Message -->
            <div v-if="showMaxSelectionMessage" 
                 class="mx-6 mb-6 p-3 rounded-lg flex items-center gap-2 text-sm"
                 :class="isThemeDark 
                     ? 'bg-amber-900/20 border border-amber-600/50 text-amber-300' 
                     : 'bg-amber-50 border border-amber-200 text-amber-700'">
                <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
                <span>Maximum {{ maxSelectable }} selections reached. Deselect an option to choose another.</span>
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
        }
    },
    data() {
        return {
            selectedOptions: [],
            bullets: ["A", "B", "C", "D", "E", "F", "G", "H"],
            showMaxSelectionMessage: false,
        };
    },
    computed: {
        options() {
            return this.question?.options || [];
        },
        isMultiSelect() {
            // Check settings for multi-select mode
            return this.question?.settings?.isMultiSelect === true;
        },
        maxSelectable() {
            // Use settings if provided, otherwise no limit
            if (this.question?.settings?.maxSelectable) {
                return this.question.settings.maxSelectable;
            }
            // If no setting is provided, allow selecting all options
            return this.options.length || 999;
        },
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
        }
    },
    methods: {
        isSelectedOption(option) {
            return this.isMultiSelect
                ? (Array.isArray(this.selectedOptions) && this.selectedOptions.includes(option))
                : this.selectedOptions === option;
        },
        isOptionDisabled(option) {
            // Only disable in multi-select mode when max selections reached
            if (!this.isMultiSelect) {
                return false;
            }
            return !this.isSelectedOption(option) && 
                   Array.isArray(this.selectedOptions) && 
                   this.selectedOptions.length >= this.maxSelectable;
        },
        getCardClasses(option) {
            const isSelected = this.isSelectedOption(option);
            const isDisabled = this.isOptionDisabled(option);
            
            if (this.isThemeDark) {
                if (isSelected) {
                    return 'bg-blue-600/20 border-2 border-blue-400 shadow-xl shadow-blue-400/30 ring-1 ring-blue-300/50';
                } else if (isDisabled) {
                    return 'bg-gray-800/40 border border-gray-700 text-gray-500';
                } else {
                    return 'bg-gray-700 border border-gray-500 hover:bg-gray-700/80 hover:border-gray-400';
                }
            } else {
                if (isSelected) {
                    return 'bg-blue-50 border-2 border-blue-500 shadow-xl shadow-blue-200/50 ring-1 ring-blue-200';
                } else if (isDisabled) {
                    return 'bg-gray-50 border border-gray-200 text-gray-400';
                } else {
                    return 'bg-white border border-gray-200 hover:bg-gray-50 hover:border-gray-300 shadow-sm';
                }
            }
        },
        handleOptionClick(option) {
            // Don't do anything if option is disabled
            if (this.isOptionDisabled(option)) {
                return;
            }
            
            if (this.isMultiSelect) {
                // Ensure we have an array
                if (!Array.isArray(this.selectedOptions)) {
                    this.selectedOptions = [];
                }
                
                // Create a new array to trigger Vue's reactivity
                const newSelection = [...this.selectedOptions];
                const index = newSelection.indexOf(option);
                
                if (index > -1) {
                    // Option is already selected, remove it
                    newSelection.splice(index, 1);
                    this.showMaxSelectionMessage = false; // Hide message when deselecting
                } else {
                    // Option is not selected, add it
                    newSelection.push(option);
                    // Show message when reaching max
                    if (newSelection.length >= this.maxSelectable) {
                        this.showMaxSelectionMessage = true;
                    }
                }
                
                // Update the selectedOptions with the new array
                this.selectedOptions = newSelection;
            } else {
                this.selectedOptions = option;
            }
        },
        normalizeSelected(value) {
            // Always return an array, even for single-choice questions
            if (Array.isArray(value)) {
                // Filter out null values from arrays
                const filtered = value.filter(v => v !== null && v !== undefined && v !== '');
                return filtered;
            } else if (value !== null && value !== undefined && value !== '') {
                return [value];
            } else {
                // Return empty array for null, undefined, or empty values
                return [];
            }
        },
        renderMarkdown(text) {
             return renderMarkdown(text, this.isThemeDark);
        }
    },
    watch: {
        question: {
            immediate: true,
            handler() {
                this.showMaxSelectionMessage = false;
                // Check if there's a saved answer to restore
                if (this.answer?.selected_options && Array.isArray(this.answer.selected_options) && this.answer.selected_options.length > 0) {
                    // Restore saved answer
                    if (this.isMultiSelect) {
                        this.selectedOptions = [...this.answer.selected_options];
                    } else {
                        this.selectedOptions = this.answer.selected_options[0];
                    }
                } else {
                    // Initialize with empty value
                    this.selectedOptions = this.isMultiSelect ? [] : "";
                }
            },
        },
        selectedOptions: {
            deep: true,
            handler(val) {
                this.$emit("selected", this.normalizeSelected(val));
                // Update message visibility based on selection count
                if (this.isMultiSelect && Array.isArray(val)) {
                    this.showMaxSelectionMessage = val.length >= this.maxSelectable;
                }
            },
        },
    },
};
</script>

<style scoped>
/* No form inputs - pure card-based selection */

/* Markdown styles - Dark theme */
[data-theme="dark"] :deep(strong) {
    color: white;
    font-weight: 600;
}

[data-theme="dark"] :deep(p) {
    color: #d1d5db;
}

[data-theme="dark"] :deep(code) {
    background-color: #374151;
    color: #e5e7eb;
    padding: 2px 8px;
    border-radius: 4px;
}

[data-theme="dark"] :deep(h1),
[data-theme="dark"] :deep(h2), 
[data-theme="dark"] :deep(h3), 
[data-theme="dark"] :deep(h4), 
[data-theme="dark"] :deep(h5), 
[data-theme="dark"] :deep(h6) {
    color: white;
}

/* Markdown styles - Light theme */
[data-theme="light"] :deep(strong) {
    color: #111827;
    font-weight: 700;
}

[data-theme="light"] :deep(code) {
    background-color: #f3f4f6;
    color: #1f2937;
    padding: 2px 4px;
    border-radius: 4px;
}

[data-theme="light"] :deep(h1),
[data-theme="light"] :deep(h2), 
[data-theme="light"] :deep(h3), 
[data-theme="light"] :deep(h4), 
[data-theme="light"] :deep(h5), 
[data-theme="light"] :deep(h6) {
    color: #111827;
}

/* Card-based selection - no form inputs needed */
</style>