<template>
    <div :class="[
            'backdrop-blur-md rounded-2xl p-3 lg:p-6 w-full border shadow-xl',
            isThemeDark 
                ? 'bg-gray-800 border-gray-700' 
                : 'bg-white border-gray-200'
         ]">
        <!-- Question Display -->
        <div class="text-lg mb-6"
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
                <!-- Command History -->
                <div ref="terminalHistory" class="text-gray-300 mb-4 terminal-history font-mono text-sm">
                    <!-- Show command history during quiz -->
                    <div v-for="(entry, index) in commandHistory" :key="index" class="mb-2">
                        <div v-if="entry.command" class="flex items-start">
                            <span class="text-green-400 mr-2">$</span>
                            <span class="text-white">{{ entry.command }}</span>
                        </div>
                        <div v-if="entry.displayResponse" 
                             :class="[
                                 'whitespace-pre-wrap',
                                 entry.isError ? 'text-red-400' : 'text-gray-300'
                             ]">{{ entry.displayResponse }}<span v-if="entry.isTyping" class="animate-pulse">█</span></div>
                    </div>
                </div>

                <!-- Command Input -->
                <div class="flex items-center">
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
                    class="p-4 rounded-md flex items-center transition-all duration-200"
                    :class="getOptionClasses(option)"
                >
                    <input
                        type="radio"
                        name="option"
                        :id="'option' + i"
                        :value="option"
                        v-model="selectedOption"
                        class="form-check-input w-5 h-5 mr-3 rounded-full"
                        :class="getRadioClasses(option)"
                    />
                    <label :for="'option' + i" class="flex-1 cursor-pointer">
                        <div class="flex lg:space-x-2">
                            <span class="hidden lg:inline w-4 font-semibold" :class="isThemeDark ? 'text-white' : 'text-black'">{{ bullets[i] }}.</span>
                            <span class="flex-1" v-html="renderMarkdown(option)"></span>
                        </div>
                    </label>
                    <span
                        v-if="isSelectedOption(option)"
                        class="ml-auto font-bold text-lg"
                        :class="isThemeDark 
                            ? 'text-blue-300' 
                            : 'text-blue-700'"
                        >✓</span>
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
    },

    methods: {
        normalizeCommand(command) {
            // Remove extra spaces and normalize command format
            return command.trim().replace(/\s+/g, ' ').toLowerCase();
        },

        async executeCommand() {
            if (!this.currentCommand.trim()) return;

            const command = this.currentCommand.trim();
            let response = '';
            let isError = false;

            // Get settings from question
            const settings = this.question.settings || {};
            const commands = settings.commands || [];
            const errorMessages = settings.errorMessages || {};
            const clearCommand = settings.clearCommand || 'clear';
            
            // Check for clear command
            if (command.toLowerCase() === clearCommand.toLowerCase()) {
                this.commandHistory = [];
                this.currentCommand = '';
                return;
            }

            // Try to match command against patterns
            let matched = false;
            for (const cmd of commands) {
                try {
                    const regex = new RegExp(cmd.pattern, 'i');
                    const match = command.match(regex);
                    
                    if (match) {
                        // Check if there's a condition (e.g., exact domain match)
                        if (cmd.condition) {
                            const conditionRegex = new RegExp(cmd.condition, 'i');
                            if (!conditionRegex.test(command)) {
                                // Condition not met, use alternative response if provided
                                if (cmd.alternativeResponse) {
                                    // Replace placeholders with captured groups
                                    response = cmd.alternativeResponse;
                                    for (let i = 1; i < match.length; i++) {
                                        response = response.replace(`$${i}`, match[i] || '');
                                    }
                                } else if (cmd.generateResponse) {
                                    // Use a response generator if specified
                                    response = this.generateResponse(command, match, cmd.generateResponse);
                                } else {
                                    continue; // Try next pattern
                                }
                            } else {
                                // Condition met, use main response
                                response = cmd.response;
                            }
                        } else {
                            // No condition, use main response
                            response = cmd.response;
                            // Replace placeholders with captured groups
                            for (let i = 1; i < match.length; i++) {
                                response = response.replace(`$${i}`, match[i] || '');
                            }
                        }
                        
                        isError = cmd.isError || false;
                        matched = true;
                        break;
                    }
                } catch (e) {
                    console.error('Invalid regex pattern:', cmd.pattern, e);
                }
            }

            if (!matched) {
                // Use default error messages from settings
                const cmdName = command.split(' ')[0];
                
                if (errorMessages.commandNotFound) {
                    response = errorMessages.commandNotFound.replace('$COMMAND', cmdName);
                } else {
                    response = `${settings.shell || 'bash'}: ${cmdName}: command not found`;
                }
                isError = true;
            }

            // Add command to history buffer for up/down navigation
            this.commandHistoryBuffer.push(this.currentCommand);
            this.commandHistoryIndex = this.commandHistoryBuffer.length;

            // Add command to history with empty response first
            const entryIndex = this.commandHistory.length;
            this.commandHistory.push({
                command: this.currentCommand,
                response: response,
                displayResponse: '',
                isError: isError,
                isTyping: true
            });

            // Clear the input
            this.currentCommand = '';

            // Simulate typing animation
            this.typeResponse(entryIndex, response);
        },
        
        typeResponse(index, fullResponse) {
            // Split response into lines
            const lines = fullResponse.split('\n');
            let currentLineIndex = 0;
            let displayedText = '';
            
            // Show cursor immediately
            this.commandHistory[index].displayResponse = '';
            
            // Type one line at a time
            const typeNextLine = () => {
                if (currentLineIndex < lines.length) {
                    // Add the next line
                    if (currentLineIndex > 0) {
                        displayedText += '\n';
                    }
                    displayedText += lines[currentLineIndex];
                    this.commandHistory[index].displayResponse = displayedText;
                    currentLineIndex++;
                    
                    // Scroll to bottom
                    this.$nextTick(() => {
                        this.scrollToBottom();
                    });
                    
                    // Calculate delay based on line content
                    let delay = 50; // Base delay
                    if (lines[currentLineIndex - 1].length > 50) {
                        delay = 80; // Longer delay for longer lines
                    }
                    if (lines[currentLineIndex - 1].trim() === '') {
                        delay = 20; // Shorter delay for empty lines
                    }
                    
                    // Schedule next line
                    setTimeout(typeNextLine, delay);
                } else {
                    // Typing complete
                    this.commandHistory[index].isTyping = false;
                    
                    // Auto-focus back on input
                    this.$nextTick(() => {
                        const input = this.$el.querySelector('input[type="text"]');
                        if (input) input.focus();
                    });
                }
            };
            
            // Start typing after a short delay
            setTimeout(typeNextLine, 100);
        },

        scrollToBottom() {
            if (this.$refs.terminalHistory) {
                const terminal = this.$refs.terminalHistory;
                terminal.scrollTop = terminal.scrollHeight;
            }
        },

        generateResponse(command, match, generatorConfig) {
            // Simple response generator based on configuration
            // This allows for dynamic responses without hardcoding
            const template = generatorConfig.template || '';
            
            // Replace placeholders with captured groups from regex match
            let response = template;
            for (let i = 0; i < match.length; i++) {
                response = response.replace(new RegExp(`\\$${i}`, 'g'), match[i] || '');
            }
            
            // Replace special placeholders
            const replacements = {
                '$TIMESTAMP': new Date().toISOString(),
                '$DATE': new Date().toUTCString(),
                '$RANDOM_ID': Math.floor(Math.random() * 65535),
                '$RANDOM_IP': `${Math.floor(Math.random() * 256)}.${Math.floor(Math.random() * 256)}.${Math.floor(Math.random() * 256)}.${Math.floor(Math.random() * 256)}`,
                '$RANDOM_TIME': (Math.random() * 50 + 10).toFixed(1),
                '$RANDOM_PORT': Math.floor(Math.random() * 65535),
                '$RANDOM_TTL': Math.floor(Math.random() * 64) + 1,
                '$RANDOM_SIZE': Math.floor(Math.random() * 100) + 50
            };
            
            for (const [placeholder, value] of Object.entries(replacements)) {
                response = response.replace(new RegExp(placeholder.replace('$', '\\$'), 'g'), value);
            }
            
            return response;
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


        renderMarkdown(text) {
            return text ? marked(text) : '';
        },

        getOptionClasses(option) {
            if (this.isSelectedOption(option)) {
                return this.isThemeDark 
                    ? 'bg-blue-900/40 text-white font-medium border border-blue-400 shadow-lg shadow-blue-400/20' 
                    : 'bg-blue-50 text-gray-900 font-medium border border-blue-500 shadow-md';
            } else {
                return this.isThemeDark 
                    ? 'bg-gray-700/40 text-gray-300 border border-gray-600 hover:bg-gray-700/60 hover:border-gray-500 cursor-pointer' 
                    : 'bg-white text-gray-800 border border-gray-300 hover:bg-gray-50 hover:border-gray-400 cursor-pointer shadow-xs';
            }
        },

        getRadioClasses(option) {
            const isSelected = this.isSelectedOption(option);
            
            if (this.isThemeDark) {
                return isSelected
                    ? 'accent-blue-500 border-blue-400'
                    : 'accent-gray-600 border-gray-500';
            } else {
                return isSelected
                    ? 'accent-blue-500 border-blue-500'
                    : 'accent-gray-300 border-gray-300';
            }
        }
    },

    watch: {
        selectedOption(val) {
            if (val) {
                // Emit both the selected option and command history
                this.$emit('selected', [val], this.commandHistory);
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

                // Load saved answer (both in review mode and when navigating back)
                if (this.answer?.selected_options && Array.isArray(this.answer.selected_options) && this.answer.selected_options.length > 0) {
                    this.selectedOption = this.answer.selected_options[0];
                }
                
                // Load saved command history (both in review mode and when navigating back)
                // Check both legacy format (answer.commands) and new metadata format
                if (this.answer?.metadata?.commands && Array.isArray(this.answer.metadata.commands)) {
                    // New format: stored in metadata
                    this.commandHistory = this.answer.metadata.commands;
                } else if (this.answer?.commands && Array.isArray(this.answer.commands)) {
                    // Legacy format: stored directly on answer
                    this.commandHistory = this.answer.commands;
                }
                
                // Scroll to bottom after loading command history (only if there's history)
                if (this.commandHistory.length > 0) {
                    this.$nextTick(() => {
                        this.scrollToBottom();
                    });
                }
            }
        }
    },
    mounted() {
        // Auto-focus on terminal input when component mounts
        this.$nextTick(() => {
            const input = this.$el.querySelector('input[type="text"]');
            if (input) {
                input.focus();
            }
        });
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