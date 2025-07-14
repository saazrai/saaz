<template>
    <!-- Question Panel -->
    <div :class="[
            'transition-all duration-300 w-full backdrop-blur-md rounded-2xl border shadow-xl',
            isThemeDark 
                ? 'bg-gray-800 border-gray-700' 
                : 'bg-white border-gray-200'
         ]">
        <div class="p-6">
            <h4 class="text-lg font-bold mb-6"
                :class="isThemeDark 
                    ? 'text-white' 
                    : 'text-gray-800'">
                {{ question.content }}
            </h4>
            
            <!-- Matching Area -->
            <div class="mb-8">
                <div class="space-y-3">
                    <div
                        v-for="(element, index) in displayItems"
                        :key="index"
                        :class="[
                            'flex flex-col sm:flex-row items-stretch gap-3',
                            'p-4 rounded-xl',
                            isThemeDark 
                                ? 'bg-gray-700/30' 
                                : 'bg-gray-50'
                        ]"
                    >
                        <!-- Item -->
                        <div
                            :class="[
                                'flex items-center justify-center sm:justify-start p-4 rounded-lg border sm:min-w-[180px] sm:w-1/3',
                                isThemeDark 
                                    ? 'text-gray-200 bg-gray-800/50 border-gray-600' 
                                    : 'text-gray-800 bg-white border-gray-300 shadow-sm'
                            ]"
                        >
                            <span class="font-medium text-lg">{{ element }}</span>
                        </div>
                        
                        <!-- Arrow (hidden on mobile) -->
                        <div class="hidden sm:flex items-center px-2">
                            <svg xmlns="http://www.w3.org/2000/svg" 
                                 :class="[
                                     'w-6 h-6',
                                     isThemeDark ? 'text-gray-500' : 'text-gray-400'
                                 ]"
                                 fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </div>
                        
                        <!-- Drop Zone -->
                        <div
                            :class="[
                                'flex-1 h-[70px] border-2 border-dashed rounded-lg transition-colors overflow-hidden',
                                dropZones[index] && dropZones[index].length > 0
                                    ? (isThemeDark ? 'bg-blue-900/20 border-blue-500' : 'bg-blue-50 border-blue-400')
                                    : (isThemeDark ? 'bg-gray-700/20 border-gray-600' : 'bg-gray-100 border-gray-400')
                            ]"
                        >
                            <draggable
                                v-model="dropZones[index]"
                                class="h-full"
                                :group="{ name: 'definitions', put: true, pull: true }"
                                :item-key="itemKey"
                                @change="(evt) => handleDropZoneChange(evt, index)"
                            >
                                <template #item="{ element }">
                                    <div
                                        :key="element.key"
                                        :class="[
                                            'h-full p-2 rounded-lg cursor-move text-lg transition-colors flex items-center',
                                            isThemeDark 
                                                ? 'text-white bg-blue-900/40 border border-blue-400 shadow-lg shadow-blue-400/20 hover:bg-blue-900/60' 
                                                : 'text-gray-900 bg-blue-50 border border-blue-500 shadow-md hover:bg-blue-100'
                                        ]"
                                    >
                                        {{ element.value }}
                                    </div>
                                </template>
                                <template #footer>
                                    <div v-if="(!dropZones[index] || dropZones[index].length === 0)"
                                         :class="[
                                             'flex items-center justify-center h-full text-lg',
                                             isThemeDark ? 'text-gray-500' : 'text-gray-400'
                                         ]">
                                        Drop definition here
                                    </div>
                                </template>
                            </draggable>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Available Definitions Section -->
            <div>
                <h3 class="mb-2 font-semibold text-base uppercase tracking-wider"
                    :class="isThemeDark 
                        ? 'text-gray-400' 
                        : 'text-gray-600'">
                    AVAILABLE DEFINITIONS ({{ availableDefinitions.length }} remaining)
                </h3>
                <div :class="[
                    'p-3 rounded-xl border',
                    isThemeDark 
                        ? 'bg-gray-800/30 border-gray-700' 
                        : 'bg-gray-50 border-gray-300'
                ]">
                    <draggable
                        v-model="availableDefinitions"
                        class="grid grid-cols-1 sm:grid-cols-2 gap-2"
                        :group="{ name: 'definitions', put: true, pull: true }"
                        :item-key="itemKey"
                    >
                        <template #item="{ element }">
                            <div
                                :key="element.key"
                                :class="[
                                    'p-3 rounded-lg border transition-colors duration-200 cursor-move text-lg',
                                    isThemeDark 
                                        ? 'text-white bg-blue-900/40 border border-blue-400 shadow-lg shadow-blue-400/20 hover:bg-blue-900/60' 
                                        : 'text-gray-900 bg-blue-50 border border-blue-500 shadow-md hover:bg-blue-100'
                                ]"
                            >
                                {{ element.value }}
                            </div>
                        </template>
                        <template #footer>
                            <div v-if="availableDefinitions.length === 0" 
                                 :class="[
                                     'col-span-full text-center py-8',
                                     isThemeDark 
                                         ? 'text-gray-500' 
                                         : 'text-gray-400'
                                 ]">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                All definitions have been matched!
                            </div>
                        </template>
                    </draggable>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import draggable from "vuedraggable";
import { shuffle } from "lodash";

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
                is_correct: false
            })
        },
        isDarkMode: {
            type: Boolean,
            default: null
        }
    },
    components: {
        draggable,
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
                   this.$parent?.$el?.classList?.contains('dark-mode') ||
                   window.matchMedia?.('(prefers-color-scheme: dark)').matches;
        }
    },
    data() {
        return {
            items: [],
            displayItems: [], // Items to match (left column)
            availableDefinitions: [], // Shuffled definitions (right column)
            dropZones: {}, // Individual drop zones for each item
            itemKey: "key",
        };
    },
    mounted() {
        this.$nextTick(function () {
            this.shuffleItems();
        });
    },

    methods: {
        submit() {
            this.$emit("submit", this.response);
        },
        shuffleItems() {
            // Check for both possible data structures
            const items = this.question.items || (this.question.options && this.question.options.items);
            const responses = this.question.responses || (this.question.options && this.question.options.responses);
            
            if (items && responses) {
                // Keep items (left side) in original order
                this.displayItems = [...items];
                
                // Initialize empty drop zones for each item
                this.dropZones = {};
                items.forEach((item, index) => {
                    this.dropZones[index] = [];
                });
                
                // Check if there's a saved answer to restore
                if (this.answer?.selected_options && Array.isArray(this.answer.selected_options) && this.answer.selected_options.length > 0) {
                    // Create all definitions with unique keys
                    const allDefinitions = responses.map(
                        (response, index) => ({ key: `def-${index}`, value: response })
                    );
                    
                    // Place saved matches in their drop zones
                    this.answer.selected_options.forEach((savedMatch, itemIndex) => {
                        if (savedMatch && itemIndex < items.length) {
                            const definition = allDefinitions.find(d => d.value === savedMatch);
                            if (definition) {
                                this.dropZones[itemIndex] = [definition];
                            }
                        }
                    });
                    
                    // Remaining definitions go to available
                    this.availableDefinitions = allDefinitions.filter(def => {
                        // Check if this definition is not already placed in any drop zone
                        for (let i = 0; i < items.length; i++) {
                            if (this.dropZones[i].some(d => d.key === def.key)) {
                                return false;
                            }
                        }
                        return true;
                    });
                    
                    // Shuffle the remaining available definitions
                    this.availableDefinitions = shuffle(this.availableDefinitions);
                } else {
                    // No saved answer - shuffle all responses for the right column
                    this.availableDefinitions = shuffle(responses).map(
                        (response, index) => ({ key: `def-${index}`, value: response })
                    );
                }
                
                // Emit initial state
                this.emitSelection();
            }
        },
        emitSelection() {
            // Create the matched pairs based on what's in each drop zone
            const matchedPairs = [];
            this.displayItems.forEach((item, index) => {
                if (this.dropZones[index] && this.dropZones[index].length > 0) {
                    matchedPairs.push(this.dropZones[index][0].value);
                } else {
                    matchedPairs.push(null);
                }
            });
            this.$emit("selected", matchedPairs);
        },
        handleDropZoneChange(evt, dropZoneIndex) {
            // Check if an item was added to this drop zone
            if (evt.added) {
                // If there were already items in this drop zone (more than the one just added)
                if (this.dropZones[dropZoneIndex].length > 1) {
                    // Find the item that was already there (not the newly added one)
                    const existingItem = this.dropZones[dropZoneIndex].find(item => item.key !== evt.added.element.key);
                    
                    if (existingItem) {
                        // Remove the existing item from the drop zone
                        this.dropZones[dropZoneIndex] = this.dropZones[dropZoneIndex].filter(item => item.key === evt.added.element.key);
                        
                        // Add the existing item back to available definitions
                        this.availableDefinitions.push(existingItem);
                    }
                }
            }
        }
    },
    watch: {
        question() {
            this.items = [];
            this.availableDefinitions = [];
            this.dropZones = {};
            this.shuffleItems();
        },
        dropZones: {
            handler() {
                this.emitSelection();
            },
            deep: true
        }
    },
};
</script>
