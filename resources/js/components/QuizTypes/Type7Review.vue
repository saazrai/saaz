<template>
    <div class="bg-white backdrop-blur-md rounded-2xl p-6 w-full">
        <!-- Question Display -->
        <div class="text-lg text-[#333] mb-6" v-html="renderedQuestion"></div>

        <!-- Terminal Section -->
        <div class="terminal-container mb-6">
            <!-- Terminal Header -->
            <div class="terminal-header bg-gray-800 rounded-t-lg p-2 flex items-center">
                <div class="flex space-x-2 ml-2">
                    <div class="w-3 h-3 rounded-full bg-red-500"></div>
                    <div class="w-3 h-3 rounded-full bg-yellow-500"></div>
                    <div class="w-3 h-3 rounded-full bg-green-500"></div>
                </div>
                <div class="text-white text-sm mx-auto">Terminal</div>
            </div>

            <!-- Terminal Body -->
            <div class="terminal-body bg-black rounded-b-lg p-4 font-mono text-sm">
                <!-- Command History -->
                <div ref="terminalHistory" class="text-white mb-4 terminal-history">
                    <template v-if="isReview">
                        <!-- In review mode, show the correct command and its response -->
                        <div class="mb-2">
                            <div class="flex items-start">
                                <span class="text-green-400 mr-2">$</span>
                                <span class="text-white">{{ correctCommand }}</span>
                            </div>
                            <div class="mt-1 text-gray-300 whitespace-pre-wrap" v-html="correctResponse"></div>
                        </div>
                    </template>
                    <template v-else>
                        <div v-for="(entry, index) in commandHistory" :key="index" class="mb-2">
                            <div class="flex items-start">
                                <span class="text-green-400 mr-2">$</span>
                                <span class="text-white break-all">{{ entry.command }}</span>
                            </div>
                            <div v-if="entry.response" 
                                 class="mt-1 text-gray-300 whitespace-pre-wrap break-words"
                                 v-html="entry.response">
                            </div>
                        </div>
                    </template>
                </div>

                <!-- Command Input - Only show if not in review mode -->
                <div class="flex items-center" v-if="!isReview">
                    <span class="text-green-400 mr-2">$</span>
                    <input
                        type="text"
                        v-model="currentCommand"
                        @keyup.enter="executeCommand"
                        @keydown.up.prevent="navigateHistory('up')"
                        @keydown.down.prevent="navigateHistory('down')"
                        placeholder="Enter your command..."
                        class="flex-1 bg-transparent text-white focus:outline-none"
                    />
                </div>
            </div>
        </div>

        <!-- Options Section -->
        <div class="mt-6">
            <ol class="space-y-2">
                <li
                    v-for="(option, i) in options"
                    :key="i"
                    class="p-4 rounded-md flex items-center"
                    :class="{
                        'bg-[#d5e5fd] text-black font-medium border border-[#007aff]': 
                            isSelectedOption(option) && !isReview,
                        'bg-[#f2f4f8] text-black border border-[#d6d6d6] hover:bg-[#e0e4ef]': 
                            !isSelectedOption(option) && !isReview,
                        'cursor-default': isReview,
                        'bg-green-200 border-green-600': isCorrectOption(i) && isReview,
                        'bg-[#f8e7e6] border-[#cb7d75] text-[#cb7d75]': 
                            isSelectedOptionInReview(option) && isIncorrectOption(option),
                        'opacity-50': isReview && !isSelectedOptionInReview(option) && !isCorrectOption(i)
                    }"
                >
                    <input
                        type="radio"
                        name="option"
                        :id="'option' + i"
                        :value="option"
                        v-model="selectedOption"
                        :disabled="isReview"
                        class="form-check-input w-5 h-5 mr-3 rounded-full"
                    />
                    <label :for="'option' + i" class="flex-1 cursor-pointer">
                        <div class="flex space-x-2">
                            <span class="w-4">{{ bullets[i] }}.</span>
                            <span v-html="renderMarkdown(option)"></span>
                        </div>
                    </label>
                    <div v-if="isReview">
                        <span v-if="isCorrectOption(i)" class="text-green-600 ml-2">✓</span>
                        <span v-if="isIncorrectOption(option)" class="text-red-500 ml-2">✗</span>
                    </div>
                </li>
            </ol>
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
        isReview: {
            type: Boolean,
            default: false
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
        }
    },

    data() {
        return {
            currentCommand: '',
            commandHistory: [],
            selectedOption: '',
            bullets: ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H'],
            commandResponses: {},
            commandHistoryIndex: -1,
            commandHistoryBuffer: [],
            currentInputBuffer: '',
        };
    },

    computed: {
        options() {
            return this.question.options || [];
        },
        renderedQuestion() {
            try {
                const questionData = JSON.parse(this.question.question);
                return marked(questionData.scenario || '');
            } catch {
                return '';
            }
        },
        correctOptionIndexes() {
            if (!this.question?.correct_options) return [];
            return this.question.correct_options.map(answer => 
                this.question.options.indexOf(answer)
            );
        },
        correctCommand() {
            try {
                const questionData = JSON.parse(this.question.question);
                const commandData = questionData.command_data;
                // Get the first valid pattern and clean it up for display
                if (commandData.valid_patterns && commandData.valid_patterns.length > 0) {
                    // Remove regex markers and clean up the pattern
                    return commandData.valid_patterns[0]
                        .replace(/^\^/, '') // Remove start marker
                        .replace(/\$$/, '') // Remove end marker
                        .replace(/\\\\/g, '\\') // Fix escaped backslashes
                        .replace(/\\s\+/g, ' ') // Replace \s+ with space
                        .replace(/\\./g, match => match.charAt(1)); // Remove backslash from escaped chars
                }
                return '';
            } catch {
                return '';
            }
        },
        correctResponse() {
            try {
                const questionData = JSON.parse(this.question.question);
                return questionData.command_data.success_response || '';
            } catch {
                return '';
            }
        }
    },

    methods: {
        normalizeCommand(command) {
            // Remove extra spaces and normalize command format
            return command.trim().replace(/\s+/g, ' ').toLowerCase();
        },

        async executeCommand() {
            if (!this.currentCommand.trim()) return;

            const command = this.normalizeCommand(this.currentCommand);
            
            // Parse the command data from the question field
            const questionData = JSON.parse(this.question.question);
            const commandData = questionData.command_data;
            let response = '';

            // Check if the command matches any of the valid patterns
            const validPatterns = commandData.valid_patterns || [];
            const isValidCommand = validPatterns.some(pattern => {
                const regex = new RegExp(pattern, 'i');
                return regex.test(command);
            });

            if (isValidCommand) {
                response = commandData.success_response || 'Command executed successfully.';
            } else {
                response = commandData.error_response || 'Invalid command. Please try again.';
            }

            // Add command to history buffer for up/down navigation
            this.commandHistoryBuffer.push(this.currentCommand);
            this.commandHistoryIndex = this.commandHistoryBuffer.length;

            // Add command and response to display history
            this.commandHistory.push({
                command: this.currentCommand,
                response: response
            });

            // Clear the input
            this.currentCommand = '';

            // Scroll to bottom after Vue updates the DOM
            this.$nextTick(() => {
                this.scrollToBottom();
            });

            // Emit the command for tracking
            this.$emit('command-executed', {
                command: command,
                isValid: isValidCommand
            });
        },

        scrollToBottom() {
            if (this.$refs.terminalHistory) {
                const terminal = this.$refs.terminalHistory;
                terminal.scrollTop = terminal.scrollHeight;
            }
        },

        navigateHistory(direction) {
            if (this.commandHistoryBuffer.length === 0) return;

            if (direction === 'up') {
                // Save current command if we're starting navigation
                if (this.commandHistoryIndex === this.commandHistoryBuffer.length) {
                    this.currentInputBuffer = this.currentCommand;
                }
                this.commandHistoryIndex = Math.max(0, this.commandHistoryIndex - 1);
                this.currentCommand = this.commandHistoryBuffer[this.commandHistoryIndex];
            } else if (direction === 'down') {
                this.commandHistoryIndex = Math.min(this.commandHistoryBuffer.length, this.commandHistoryIndex + 1);
                if (this.commandHistoryIndex === this.commandHistoryBuffer.length) {
                    // Restore the command that was being typed
                    this.currentCommand = this.currentInputBuffer || '';
                    this.currentInputBuffer = '';
                } else {
                    this.currentCommand = this.commandHistoryBuffer[this.commandHistoryIndex];
                }
            }
        },

        isSelectedOption(option) {
            return this.selectedOption === option;
        },

        isCorrectOption(index) {
            return this.correctOptionIndexes.includes(index);
        },

        isIncorrectOption(option) {
            if (!this.answer?.user_answer) return false;
            return this.answer.user_answer.includes(option) && 
                   !this.question.correct_options.includes(option);
        },

        isSelectedOptionInReview(option) {
            if (!this.answer?.user_answer) return false;
            return this.answer.user_answer.includes(option);
        },

        renderMarkdown(text) {
            return text ? marked(text) : '';
        }
    },

    watch: {
        selectedOption(val) {
            if (val) {
                this.$emit('selected', [val]);
            }
        },

        question: {
            immediate: true,
            handler() {
                this.selectedOption = '';
                this.commandHistory = [];
                this.currentCommand = '';
                this.commandHistoryBuffer = [];
                this.commandHistoryIndex = -1;
                this.currentInputBuffer = '';

                if (this.isReview && this.answer?.commands) {
                    this.commandHistory = this.answer.commands;
                }
            }
        }
    }
};
</script>

<style scoped>
.terminal-container {
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
}

.terminal-body {
    min-height: 120px; /* Minimum height for command + output */
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

/* Add styles for review mode */
.terminal-body.review {
    opacity: 0.9;
    cursor: not-allowed;
}

input::placeholder {
    color: #4a4a4a;
}

/* Ensure long commands and responses wrap properly */
.break-all {
    word-break: break-all;
}

.break-words {
    word-wrap: break-word;
}
</style> 