<template>
    <!-- Question Panel -->
    <div :class="[
            'transition-all duration-300 w-full backdrop-blur-md rounded-2xl border shadow-xl',
            isThemeDark 
                ? 'bg-gray-800 border-gray-700' 
                : 'bg-white border-gray-200'
         ]">
        <div class="p-4 sm:p-6">
            <h4 class="text-lg font-bold mb-4 sm:mb-6"
                :class="isThemeDark 
                    ? 'text-white' 
                    : 'text-gray-800'">
                {{ question.content }}
            </h4>
            
            <!-- Desktop Layout -->
            <div class="hidden md:block">
                <!-- Two Column Layout for Desktop -->
                <div class="flex gap-6">
                    <!-- Left Column: Terms and Drop Zones -->
                    <div class="flex-1 space-y-3">
                        <div
                            v-for="(element, index) in displayItems"
                            :key="index"
                            class="flex items-center gap-3"
                        >
                            <!-- Term -->
                            <div
                                :class="[
                                    'w-1/3 p-3 rounded-lg border text-sm font-medium',
                                    isThemeDark 
                                        ? 'text-gray-200 bg-gray-800/50 border-gray-600' 
                                        : 'text-gray-800 bg-white border-gray-300 shadow-sm'
                                ]"
                            >
                                {{ element }}
                            </div>
                            
                            <!-- Arrow -->
                            <svg xmlns="http://www.w3.org/2000/svg" 
                                 :class="[
                                     'w-5 h-5 flex-shrink-0',
                                     isThemeDark ? 'text-gray-500' : 'text-gray-400'
                                 ]"
                                 fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                            
                            <!-- Drop Zone -->
                            <div
                                :class="[
                                    'flex-1 h-[50px] border-2 border-dashed rounded-lg transition-all overflow-hidden',
                                    dropZones[index] && dropZones[index].length > 0
                                        ? (isThemeDark ? 'bg-blue-900/20 border-blue-500' : 'bg-blue-50 border-blue-400')
                                        : (isThemeDark ? 'bg-gray-700/20 border-gray-600' : 'bg-gray-100 border-gray-400'),
                                    dragOverZone === index && 'scale-105 border-yellow-500'
                                ]"
                                @dragover.prevent="dragOverZone = index"
                                @dragleave="dragOverZone = null"
                                @drop="handleDrop($event, index)"
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
                                                'h-full px-3 py-2 rounded cursor-move text-sm flex items-center',
                                                isThemeDark 
                                                    ? 'text-white bg-blue-800/60' 
                                                    : 'text-gray-900 bg-blue-100'
                                            ]"
                                        >
                                            {{ element.value }}
                                        </div>
                                    </template>
                                    <template #footer>
                                        <div v-if="(!dropZones[index] || dropZones[index].length === 0)"
                                             :class="[
                                                 'flex items-center justify-center h-full text-sm',
                                                 isThemeDark ? 'text-gray-500' : 'text-gray-400'
                                             ]">
                                            Drop here
                                        </div>
                                    </template>
                                </draggable>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Right Column: Available Definitions -->
                    <div class="w-1/3">
                        <h3 class="mb-3 font-semibold text-sm uppercase tracking-wider"
                            :class="isThemeDark 
                                ? 'text-gray-400' 
                                : 'text-gray-600'">
                            Available ({{ availableDefinitions.length }})
                        </h3>
                        <div :class="[
                            'p-3 rounded-xl border max-h-[400px] overflow-y-auto',
                            isThemeDark 
                                ? 'bg-gray-800/30 border-gray-700' 
                                : 'bg-gray-50 border-gray-300'
                        ]">
                            <draggable
                                v-model="availableDefinitions"
                                class="space-y-2"
                                :group="{ name: 'definitions', put: true, pull: true }"
                                :item-key="itemKey"
                            >
                                <template #item="{ element }">
                                    <div
                                        :key="element.key"
                                        :class="[
                                            'p-3 rounded-lg border cursor-move text-sm transition-all hover:scale-105',
                                            isThemeDark 
                                                ? 'text-white bg-gray-700 border-gray-600 hover:bg-gray-600' 
                                                : 'text-gray-800 bg-white border-gray-300 hover:bg-gray-50'
                                        ]"
                                        draggable="true"
                                        @dragstart="handleDragStart($event, element)"
                                    >
                                        <div class="flex items-center gap-2">
                                            <svg class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                            </svg>
                                            <span>{{ element.value }}</span>
                                        </div>
                                    </div>
                                </template>
                            </draggable>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Mobile Layout -->
            <div class="md:hidden">
                <!-- Mobile Progress Indicator -->
                <div class="mb-4 text-center">
                    <span :class="[
                        'text-sm font-medium',
                        isThemeDark ? 'text-gray-300' : 'text-gray-600'
                    ]">
                        {{ getMatchedCount() }} of {{ displayItems.length }} matched
                    </span>
                </div>
                
                <!-- Mobile Tap Mode Toggle -->
                <div class="mb-4 flex justify-center">
                    <button
                        @click="mobileMode = mobileMode === 'drag' ? 'tap' : 'drag'"
                        :class="[
                            'px-4 py-2 rounded-lg text-sm font-medium transition-colors',
                            isThemeDark 
                                ? 'bg-gray-700 text-gray-300 hover:bg-gray-600' 
                                : 'bg-gray-200 text-gray-700 hover:bg-gray-300'
                        ]"
                    >
                        Mode: {{ mobileMode === 'tap' ? 'Tap to Match' : 'Drag & Drop' }}
                    </button>
                </div>
                
                <!-- Mobile Terms and Drop Zones -->
                <div class="space-y-3 mb-6">
                    <div
                        v-for="(element, index) in displayItems"
                        :key="index"
                        :class="[
                            'p-3 rounded-lg border transition-all',
                            isThemeDark 
                                ? 'bg-gray-700/30 border-gray-600' 
                                : 'bg-gray-50 border-gray-300',
                            selectedMobileTerm === index && 'ring-2 ring-blue-500'
                        ]"
                    >
                        <!-- Term -->
                        <div class="flex items-center justify-between mb-2">
                            <span :class="[
                                'font-medium',
                                isThemeDark ? 'text-white' : 'text-gray-800'
                            ]">
                                {{ element }}
                            </span>
                            <button
                                v-if="dropZones[index] && dropZones[index].length > 0"
                                @click="clearDropZone(index)"
                                :class="[
                                    'text-sm px-2 py-1 rounded',
                                    isThemeDark 
                                        ? 'text-red-400 hover:bg-red-900/20' 
                                        : 'text-red-600 hover:bg-red-50'
                                ]"
                            >
                                Clear
                            </button>
                        </div>
                        
                        <!-- Drop Zone -->
                        <div
                            :class="[
                                'min-h-[50px] border-2 border-dashed rounded-lg p-2 transition-all',
                                dropZones[index] && dropZones[index].length > 0
                                    ? (isThemeDark ? 'bg-blue-900/20 border-blue-500' : 'bg-blue-50 border-blue-400')
                                    : (isThemeDark ? 'bg-gray-800/20 border-gray-600' : 'bg-white border-gray-400'),
                                mobileMode === 'tap' && selectedMobileTerm === index && 'animate-pulse'
                            ]"
                            @click="mobileMode === 'tap' && handleMobileTapZone(index)"
                        >
                            <div v-if="dropZones[index] && dropZones[index].length > 0"
                                 :class="[
                                     'text-sm',
                                     isThemeDark ? 'text-white' : 'text-gray-800'
                                 ]">
                                {{ dropZones[index][0].value }}
                            </div>
                            <div v-else
                                 :class="[
                                     'text-sm text-center',
                                     isThemeDark ? 'text-gray-500' : 'text-gray-400'
                                 ]">
                                {{ mobileMode === 'tap' ? 'Tap to select' : 'Drop here' }}
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Mobile Available Definitions -->
                <div>
                    <h3 class="mb-3 font-semibold text-sm uppercase tracking-wider"
                        :class="isThemeDark 
                            ? 'text-gray-400' 
                            : 'text-gray-600'">
                        Available Definitions
                    </h3>
                    <div :class="[
                        'max-h-[300px] overflow-y-auto space-y-2',
                        mobileMode === 'tap' && selectedMobileDefinition !== null && 'opacity-50'
                    ]">
                        <div
                            v-for="(element, index) in availableDefinitions"
                            :key="element.key"
                            :class="[
                                'p-3 rounded-lg border cursor-pointer transition-all',
                                isThemeDark 
                                    ? 'text-white bg-gray-700 border-gray-600' 
                                    : 'text-gray-800 bg-white border-gray-300',
                                mobileMode === 'tap' && selectedMobileDefinition === element.key 
                                    ? 'ring-2 ring-blue-500 scale-105' 
                                    : 'hover:scale-102',
                                mobileMode === 'drag' && 'cursor-move'
                            ]"
                            @click="mobileMode === 'tap' && handleMobileTapDefinition(element)"
                            :draggable="mobileMode === 'drag'"
                            @dragstart="mobileMode === 'drag' && handleDragStart($event, element)"
                        >
                            <div class="text-sm">{{ element.value }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script lang="ts">
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
            dragOverZone: null,
            // Mobile specific
            mobileMode: 'tap', // 'tap' or 'drag'
            selectedMobileTerm: null,
            selectedMobileDefinition: null,
        };
    },
    mounted() {
        this.$nextTick(function () {
            this.shuffleItems();
        });
    },

    methods: {
        getMatchedCount() {
            let count = 0;
            for (let i = 0; i < this.displayItems.length; i++) {
                if (this.dropZones[i] && this.dropZones[i].length > 0) {
                    count++;
                }
            }
            return count;
        },
        
        handleDragStart(event, element) {
            event.dataTransfer.effectAllowed = 'move';
            event.dataTransfer.setData('element', JSON.stringify(element));
        },
        
        handleDrop(event, dropZoneIndex) {
            event.preventDefault();
            this.dragOverZone = null;
            
            const elementData = event.dataTransfer.getData('element');
            if (elementData) {
                const element = JSON.parse(elementData);
                
                // Check if drop zone already has an item
                if (this.dropZones[dropZoneIndex] && this.dropZones[dropZoneIndex].length > 0) {
                    const existingItem = this.dropZones[dropZoneIndex][0];
                    // Return existing item to available
                    this.availableDefinitions.push(existingItem);
                }
                
                // Remove from available definitions
                this.availableDefinitions = this.availableDefinitions.filter(def => def.key !== element.key);
                
                // Add to drop zone
                this.dropZones[dropZoneIndex] = [element];
                
                this.emitSelection();
            }
        },
        
        clearDropZone(index) {
            if (this.dropZones[index] && this.dropZones[index].length > 0) {
                const item = this.dropZones[index][0];
                this.availableDefinitions.push(item);
                this.dropZones[index] = [];
                this.emitSelection();
            }
        },
        
        // Mobile tap mode methods
        handleMobileTapZone(index) {
            if (this.mobileMode !== 'tap') return;
            
            if (this.selectedMobileDefinition) {
                // Place the selected definition
                const definition = this.availableDefinitions.find(d => d.key === this.selectedMobileDefinition);
                if (definition) {
                    // Clear existing item if any
                    if (this.dropZones[index] && this.dropZones[index].length > 0) {
                        const existingItem = this.dropZones[index][0];
                        this.availableDefinitions.push(existingItem);
                    }
                    
                    // Remove from available and add to drop zone
                    this.availableDefinitions = this.availableDefinitions.filter(d => d.key !== definition.key);
                    this.dropZones[index] = [definition];
                    
                    // Reset selections
                    this.selectedMobileDefinition = null;
                    this.selectedMobileTerm = null;
                    
                    this.emitSelection();
                }
            } else {
                // Select this term
                this.selectedMobileTerm = index;
            }
        },
        
        handleMobileTapDefinition(element) {
            if (this.mobileMode !== 'tap') return;
            
            if (this.selectedMobileTerm !== null) {
                // Place in selected term's drop zone
                const index = this.selectedMobileTerm;
                
                // Clear existing item if any
                if (this.dropZones[index] && this.dropZones[index].length > 0) {
                    const existingItem = this.dropZones[index][0];
                    this.availableDefinitions.push(existingItem);
                }
                
                // Remove from available and add to drop zone
                this.availableDefinitions = this.availableDefinitions.filter(d => d.key !== element.key);
                this.dropZones[index] = [element];
                
                // Reset selections
                this.selectedMobileDefinition = null;
                this.selectedMobileTerm = null;
                
                this.emitSelection();
            } else {
                // Select this definition
                this.selectedMobileDefinition = element.key;
            }
        },
        
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
            this.selectedMobileTerm = null;
            this.selectedMobileDefinition = null;
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

<style scoped>
/* Custom scrollbar for dark mode */
.dark ::-webkit-scrollbar {
    width: 8px;
}

.dark ::-webkit-scrollbar-track {
    background: rgba(31, 41, 55, 0.5);
    border-radius: 4px;
}

.dark ::-webkit-scrollbar-thumb {
    background: rgba(75, 85, 99, 0.8);
    border-radius: 4px;
}

.dark ::-webkit-scrollbar-thumb:hover {
    background: rgba(107, 114, 128, 0.8);
}

/* Smooth transitions */
.hover\:scale-102:hover {
    transform: scale(1.02);
}

/* Mobile tap mode animations */
@keyframes pulse {
    0%, 100% {
        opacity: 1;
    }
    50% {
        opacity: 0.7;
    }
}

.animate-pulse {
    animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
}
</style>