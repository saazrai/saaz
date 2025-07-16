<template>
    <div :class="[
            'backdrop-blur-md rounded-2xl p-6 w-full border shadow-xl',
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
                    <template v-if="isReview">
                        <!-- In review mode, show command history or example command -->
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
                    </template>
                    <template v-else>
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
                    class="p-4 rounded-md flex items-center transition-all duration-200"
                    :class="getOptionClasses(option, i)"
                >
                    <input
                        type="radio"
                        name="option"
                        :id="'option' + i"
                        :value="option"
                        v-model="selectedOption"
                        :disabled="isReview"
                        class="form-check-input w-5 h-5 mr-3 rounded-full"
                        :class="getRadioClasses(option)"
                    />
                    <label :for="'option' + i" class="flex-1 cursor-pointer">
                        <div class="flex space-x-2">
                            <span class="w-4 font-semibold text-lg" :class="isThemeDark ? 'text-white' : 'text-black'">{{ bullets[i] }}.</span>
                            <span v-html="renderMarkdown(option)"></span>
                            <span v-if="isReview && isCorrectOption(i)" class="ml-2 text-xs font-semibold uppercase tracking-wider"
                                  :class="isThemeDark ? 'text-green-400' : 'text-green-600'">
                                (Correct)
                            </span>
                        </div>
                    </label>
                    <span
                        v-if="isSelectedOption(option)"
                        class="ml-auto font-bold text-lg"
                        :class="isThemeDark 
                            ? 'text-blue-300' 
                            : 'text-blue-700'"
                        >✓</span>
                    <div v-if="isReview" class="ml-3">
                        <div v-if="isCorrectOption(i)" 
                             :class="[
                                 'w-8 h-8 rounded-full flex items-center justify-center',
                                 isThemeDark 
                                     ? 'bg-green-500/20 text-green-400' 
                                     : 'bg-green-500/20 text-green-600'
                             ]">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <div v-else-if="isIncorrectOption(option)" 
                             :class="[
                                 'w-8 h-8 rounded-full flex items-center justify-center',
                                 isThemeDark 
                                     ? 'bg-red-500/20 text-red-400' 
                                     : 'bg-red-500/20 text-red-600'
                             ]">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </div>
                    </div>
                </li>
            </ol>
        </div>
        
        <!-- Answer Explanations Section (only in review mode) -->
        <div v-if="isReview && answer"
            :class="[
                'border-t mt-6 -mx-6 -mb-6',
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
                            ? 'Excellent work! You found the correct answer.' 
                            : 'Not quite right. See the correct answer below.' }}
                    </p>
                </div>
                
                <!-- Your Answer -->
                <div class="mb-6" v-if="answer?.selected_options?.length > 0">
                    <h4 class="font-semibold text-lg mb-2"
                        :class="isThemeDark ? 'text-white' : 'text-gray-900'">
                        Your Answer:
                    </h4>
                    <p class="text-lg"
                       :class="isThemeDark ? 'text-gray-300' : 'text-gray-700'">
                        {{ answer.selected_options[0] }}
                    </p>
                </div>
                
                <!-- Option Explanations -->
                <div class="space-y-3">
                    <div
                        v-for="(option, index) in question.options"
                        :key="index"
                        :class="[
                            'rounded-xl p-4 transition-all relative',
                            isCorrectOption(index) 
                                ? (isThemeDark 
                                    ? 'bg-green-500/20 border border-green-500/60 ring-2 ring-green-500/30' 
                                    : 'bg-green-50 border border-green-500 ring-2 ring-green-200')
                                : (isThemeDark 
                                    ? 'bg-gray-700/30 border border-gray-600' 
                                    : 'bg-white border border-gray-300')
                        ]"
                    >
                        <!-- Correct Badge -->
                        <div v-if="isCorrectOption(index)" class="absolute -top-2 -right-2">
                            <div :class="[
                                'px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider',
                                isThemeDark 
                                    ? 'bg-green-500 text-white' 
                                    : 'bg-green-500 text-white'
                            ]">
                                Correct
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <span class="font-bold mr-3 text-lg flex-shrink-0"
                                  :class="isCorrectOption(index) 
                                      ? (isThemeDark ? 'text-green-400' : 'text-green-700')
                                      : (isThemeDark ? 'text-white' : 'text-black')">
                                {{ bullets[index] }}.
                            </span>
                            <div class="flex-1">
                                <div class="font-medium mb-2 text-lg flex items-center"
                                     :class="[
                                         isCorrectOption(index)
                                             ? (isThemeDark ? 'text-green-300' : 'text-green-800')
                                             : (isThemeDark ? 'text-gray-300' : 'text-gray-700')
                                     ]">
                                    {{ option }}
                                    <svg v-if="isCorrectOption(index)" class="w-5 h-5 ml-2 inline-block" 
                                         :class="isThemeDark ? 'text-green-400' : 'text-green-600'"
                                         fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                                <div 
                                    v-if="question.justifications && question.justifications[index]" 
                                    class="text-lg"
                                    :class="[
                                        isCorrectOption(index)
                                            ? (isThemeDark ? 'text-green-200' : 'text-green-700')
                                            : (isThemeDark ? 'text-gray-400' : 'text-gray-600')
                                    ]"
                                    v-html="renderMarkdown(question.justifications[index])"
                                ></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
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
        },
        isDarkMode: {
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
        correctOptionIndexes() {
            if (!this.question?.correct_options) return [];
            return this.question.correct_options.map(answer => 
                this.question.options.indexOf(answer)
            );
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
        }
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
            if (this.isReview) {
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
            } else {
                if (this.isSelectedOption(option)) {
                    return this.isThemeDark 
                        ? 'bg-blue-900/40 text-white font-medium border border-blue-400 shadow-lg shadow-blue-400/20' 
                        : 'bg-blue-50 text-gray-900 font-medium border border-blue-500 shadow-md';
                } else {
                    return this.isThemeDark 
                        ? 'bg-gray-700/40 text-gray-300 border border-gray-600 hover:bg-gray-700/60 hover:border-gray-500 cursor-pointer' 
                        : 'bg-white text-gray-800 border border-gray-300 hover:bg-gray-50 hover:border-gray-400 cursor-pointer shadow-sm';
                }
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
            if (input && !this.isReview) {
                input.focus();
            }
            
            // Scroll to bottom in review mode to show last command
            if (this.isReview && this.commandHistory.length > 0) {
                this.scrollToBottom();
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