<template>
    <div :class="[
            'transition-all duration-300 w-full backdrop-blur-md rounded-2xl p-3 lg:p-6 border shadow-xl',
            isThemeDark 
                ? 'bg-gray-800 border-gray-700' 
                : 'bg-white border-gray-200'
         ]">
        <!-- Question Display -->
        <div class="text-lg font-medium mb-6"
             :class="isThemeDark 
                 ? 'text-white' 
                 : 'text-gray-800'"
             v-html="renderedQuestion"></div>

        <!-- Terminal Section -->
        <div :class="[
                'terminal-container mb-6',
                !isThemeDark ? 'shadow-lg' : ''
             ]">
            <!-- Terminal Header -->
            <div :class="[
                    'terminal-header rounded-t-lg p-2 flex items-center',
                    isThemeDark 
                        ? 'bg-gray-900' 
                        : 'bg-gray-700'
                 ]">
                <div class="flex space-x-2 ml-2">
                    <div class="w-3 h-3 rounded-full bg-red-500"></div>
                    <div class="w-3 h-3 rounded-full bg-yellow-500"></div>
                    <div class="w-3 h-3 rounded-full bg-green-500"></div>
                </div>
                <div class="text-white text-sm mx-auto">Terminal</div>
            </div>

            <!-- Terminal Body -->
            <div :class="[
                    'terminal-body rounded-b-lg p-4 font-mono text-sm',
                    isThemeDark 
                        ? 'bg-black' 
                        : 'bg-gray-900'
                 ]">
                <!-- Command History for Review -->
                <div ref="terminalHistory" class="text-gray-300 mb-4 terminal-history font-mono text-sm">
                    <!-- Show command history or example command -->
                    <div v-if="commandHistory.length === 0">
                        <!-- Show example correct command -->
                        <div class="mb-2">
                            <div class="flex items-start">
                                <span class="text-green-400 mr-2">$</span>
                                <span class="text-white">dig AAAA saazacademy.com +short</span>
                            </div>
                            <div class="whitespace-pre-wrap text-gray-300 mt-1">{{ exampleResponse }}</div>
                        </div>
                    </div>
                    <div v-else>
                        <div v-for="(entry, index) in commandHistory" :key="`review-${index}`" class="mb-2">
                            <div v-if="entry.command" class="flex items-start">
                                <span class="text-green-400 mr-2">$</span>
                                <span class="text-white">{{ entry.command }}</span>
                            </div>
                            <div v-if="entry.response || entry.displayResponse" class="whitespace-pre-wrap text-gray-300">{{ entry.response || entry.displayResponse }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Options with Contextual Justifications (Type1Review style) -->
        <div class="mt-6">
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
                            <div class="flex lg:space-x-2">
                                <span class="hidden lg:inline w-4 font-semibold" :class="getOptionTextClasses(option, i)">{{ bullets[i] }}.</span>
                                <span class="flex-1 text-base" 
                                      :class="getOptionTextClasses(option, i)"
                                      v-html="renderMarkdown(option)">
                                </span>
                            </div>
                        </div>
                        
                        <!-- Status Indicator -->
                        <div class="flex items-center space-x-2 flex-shrink-0">
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
            default: () => ({
                question_id: null,
                selected_options: [],
                duration: 0,
                is_correct: false,
                commands: []
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
            commandHistory: [],
            bullets: ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H'],
            windowWidth: typeof window !== 'undefined' ? window.innerWidth : 1024
        };
    },

    computed: {
        options() {
            return this.question.options || [];
        },
        renderedQuestion() {
            if (this.question.content) {
                // Split content to separate the question from terminal output
                const contentParts = this.question.content.split('```');
                if (contentParts.length > 0) {
                    return marked(contentParts[0]);
                }
                return marked(this.question.content);
            }
            return '';
        },
        correctOptionIndexes() {
            if (!this.question?.correct_options) return [];
            return this.question.correct_options.map(answer => 
                this.question.options.indexOf(answer)
            );
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
        exampleResponse() {
            // Return the response for the example command
            if (this.question && this.question.settings && this.question.settings.commands) {
                // Look for the dig +short command
                const shortDigCmd = this.question.settings.commands.find(cmd => 
                    cmd.pattern.includes('\\+short')
                );
                if (shortDigCmd) {
                    return shortDigCmd.response;
                }
            }
            // Default response
            return '2606:4700:3037::6815:4c99\n2606:4700:3037::ac43:b4e3';
        },
        hasAnyJustifications() {
            return this.question?.justifications && 
                   Object.values(this.question.justifications).some(justification => 
                       typeof justification === 'string' && justification.trim() !== '');
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
            return text ? marked(text) : '';
        },
        getOptionClasses(option, i) {
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
        getOptionContainerClasses(option, i) {
            // Get container styling based on option state
            if (this.isCorrectOption(i)) {
                return this.isThemeDark 
                    ? 'bg-green-500/5 border border-green-500/30' 
                    : 'bg-green-50 border border-green-200';
            } else if (this.isIncorrectOption(option)) {
                return this.isThemeDark 
                    ? 'bg-red-500/5 border border-red-500/30' 
                    : 'bg-red-50 border border-red-200';
            } else {
                return this.isThemeDark 
                    ? 'bg-gray-800/50 border border-gray-700' 
                    : 'bg-gray-50 border border-gray-200';
            }
        },
        getOptionTextClasses(option, i) {
            if (this.isCorrectOption(i)) {
                return this.isThemeDark ? 'text-green-300' : 'text-green-800';
            } else if (this.isIncorrectOption(option)) {
                return this.isThemeDark ? 'text-red-300' : 'text-red-700';
            } else {
                return this.isThemeDark ? 'text-gray-300' : 'text-gray-700';
            }
        },
        shouldShowJustification(i) {
            // Use the global explanation visibility state
            return this.shouldShowExplanations && this.hasJustificationForOption(i);
        },
        hasJustificationForOption(i) {
            if (!this.question?.justifications) return false;
            
            // Check if justifications is an array (indexed by option index)
            if (Array.isArray(this.question.justifications)) {
                const justification = this.question.justifications[i];
                return justification && typeof justification === 'string' && justification.trim() !== '';
            }
            
            // Check if justifications is an object (keyed by option index or option text)
            if (typeof this.question.justifications === 'object') {
                // Try by index first
                let justification = this.question.justifications[i];
                
                // If not found by index, try by option content
                if (!justification && this.options[i]) {
                    justification = this.question.justifications[this.options[i]];
                }
                
                return justification && typeof justification === 'string' && justification.trim() !== '';
            }
            
            return false;
        },
        getJustificationForOption(i) {
            if (!this.question?.justifications) return null;
            
            // Check if justifications is an array (indexed by option index)
            if (Array.isArray(this.question.justifications)) {
                return this.question.justifications[i] || null;
            }
            
            // Check if justifications is an object (keyed by option index or option text)
            if (typeof this.question.justifications === 'object') {
                // Try by index first
                let justification = this.question.justifications[i];
                
                // If not found by index, try by option content
                if (!justification && this.options[i]) {
                    justification = this.question.justifications[this.options[i]];
                }
                
                return justification || null;
            }
            
            return null;
        }
    },

    mounted() {
        // Load saved command history (both in review mode and when navigating back)
        // Check both legacy format (answer.commands) and new metadata format
        if (this.answer?.metadata?.commands && Array.isArray(this.answer.metadata.commands)) {
            // New format: stored in metadata
            this.commandHistory = this.answer.metadata.commands;
        } else if (this.answer?.commands && Array.isArray(this.answer.commands)) {
            // Legacy format: stored directly on answer
            this.commandHistory = this.answer.commands;
        }
        
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
.terminal-container {
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
}

.terminal-body {
    min-height: 200px; /* Minimum height for terminal */
    max-height: 400px; /* Maximum height before scrolling */
    display: flex;
    flex-direction: column;
}

.terminal-history {
    flex: 1;
    overflow-y: auto;
    overflow-x: hidden;
    scrollbar-width: thin;
    scrollbar-color: #4a4a4a #1a1a1a;
    padding-bottom: 8px;
    min-height: 150px; /* Ensure minimum height even when empty */
}

.terminal-history::-webkit-scrollbar {
    width: 8px;
}

.terminal-history::-webkit-scrollbar-track {
    background: #1a1a1a;
    border-radius: 4px;
}

.terminal-history::-webkit-scrollbar-thumb {
    background: #4a4a4a;
    border-radius: 4px;
}

/* Ensure long commands and responses wrap properly */
.break-all {
    word-break: break-all;
}

.break-words {
    word-wrap: break-word;
}
</style>