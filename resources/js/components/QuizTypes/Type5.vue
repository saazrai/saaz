<template>
    <!-- Question Panel with Apple-style design -->
    <div class="w-full">
        <!-- Compact Header -->
        <div class="mb-4">
            <h3 class="text-lg font-semibold text-center"
                :class="isThemeDark ? 'text-white' : 'text-gray-900'">
                {{ question.content }}
            </h3>
            <p class="text-sm text-center mt-1"
               :class="isThemeDark ? 'text-gray-400' : 'text-gray-600'">
                Drag items from below and drop them on the matching pairs • {{ getMatchedCount() }} of {{ displayItems.length }} matched
            </p>
        </div>
        
        <!-- Matching Interface -->
        <div class="max-w-5xl mx-auto">
            <!-- Desktop Layout -->
            <div class="hidden md:block">
                <!-- Items with Drop Zones -->
                <div class="space-y-2 mb-6">
                    <div
                        v-for="(element, index) in displayItems"
                        :key="`item-${index}`"
                        class="flex items-center gap-3"
                    >
                        <!-- Item -->
                        <div :class="[
                            'flex-1 p-3 rounded-lg border text-sm',
                            isThemeDark 
                                ? 'bg-gray-800 border-gray-700' 
                                : 'bg-white border-gray-300'
                        ]">
                            <span :class="[
                                'font-medium',
                                isThemeDark ? 'text-gray-200' : 'text-gray-900'
                            ]">
                                {{ element }}
                            </span>
                        </div>
                        
                        <!-- Arrow -->
                        <svg class="w-5 h-5 flex-shrink-0" 
                             :class="isThemeDark ? 'text-gray-600' : 'text-gray-400'"
                             fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                        </svg>
                        
                        <!-- Drop Zone -->
                        <div
                            :data-role-index="index"
                            :class="[
                                'flex-1 min-h-[44px] rounded-lg border-2 border-dashed transition-all duration-200 flex items-center justify-center cursor-pointer',
                                matches[index]
                                    ? (isThemeDark ? 'bg-blue-900/50 border-blue-500' : 'bg-blue-50 border-blue-400')
                                    : dragOverIndex === index
                                        ? (isThemeDark ? 'bg-blue-900/70 border-blue-400 scale-[1.02]' : 'bg-blue-100 border-blue-500 scale-[1.02]')
                                        : (isThemeDark ? 'bg-gray-800 border-gray-600 hover:bg-gray-700' : 'bg-gray-100 border-gray-400 hover:bg-gray-200'),
                            ]"
                            @dragover.prevent="dragOverIndex = index"
                            @dragleave="dragOverIndex = null"
                            @drop="handleDrop($event, index)"
                            @click="matches[index] && clearMatch(index)"
                        >
                            <div v-if="!matches[index]" :class="[
                                'text-xs',
                                isThemeDark ? 'text-gray-500' : 'text-gray-400'
                            ]">
                                Drop here
                            </div>
                            <div v-else 
                                 class="w-full h-full flex items-center justify-center cursor-move"
                                 draggable="true"
                                 @dragstart="handleDragStartFromDropzone($event, index)"
                                 @dragend="handleDragEnd"
                                 title="Drag to move or click to remove"
                            >
                                <p :class="[
                                    'text-sm text-center truncate pointer-events-none px-3',
                                    isThemeDark ? 'text-gray-200' : 'text-gray-700'
                                ]">
                                    {{ getMatchedDefinitionText(index) }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Draggable Definitions at Bottom -->
                <div>
                    <h4 :class="[
                        'text-xs font-semibold uppercase tracking-wider mb-2',
                        isThemeDark ? 'text-gray-500' : 'text-gray-600'
                    ]">
                        Drag these options
                    </h4>
                    <div :class="[
                        'p-3 rounded-lg border min-h-[60px]',
                        isThemeDark 
                            ? 'bg-gray-800 border-gray-700' 
                            : 'bg-gray-50 border-gray-300',
                        dragOverBottom && 'ring-2 ring-blue-500'
                    ]"
                    @dragover.prevent="dragOverBottom = true"
                    @dragleave="dragOverBottom = false"
                    @drop="handleDropToBottom($event)"
                    >
                        <div class="flex flex-wrap gap-2">
                            <div
                                v-for="definition in availableDefinitions"
                                :key="definition.id"
                                :class="[
                                    'px-3 py-2 rounded-md border cursor-move transition-all duration-200',
                                    isThemeDark 
                                        ? 'bg-gray-700 border-gray-600 hover:bg-gray-600 hover:border-gray-500' 
                                        : 'bg-white border-gray-300 hover:bg-gray-100 hover:border-gray-400',
                                    'hover:scale-[1.02] active:scale-[0.98]',
                                    draggedItem === definition.id && 'opacity-50'
                                ]"
                                draggable="true"
                                @dragstart="handleDragStart($event, definition)"
                                @dragend="handleDragEnd"
                            >
                                <div class="flex items-center gap-2">
                                    <svg class="w-3 h-3 text-gray-400 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                    </svg>
                                    <span :class="[
                                        'text-sm',
                                        isThemeDark ? 'text-gray-200' : 'text-gray-700'
                                    ]">
                                        {{ definition.text }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Empty State -->
                        <div v-if="availableDefinitions.length === 0" :class="[
                            'text-center py-4',
                            isThemeDark ? 'text-gray-500' : 'text-gray-400'
                        ]">
                            <svg class="w-8 h-8 mx-auto mb-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <p class="text-xs">All items matched!</p>
                        </div>
                    </div>
                </div>
                
            </div>
            
            <!-- Mobile Layout -->
            <div class="md:hidden">
                <!-- Progress Pills -->
                <div class="flex justify-center mb-6">
                    <div class="flex space-x-2">
                        <div
                            v-for="(item, index) in displayItems"
                            :key="`pill-${index}`"
                            :class="[
                                'w-2 h-2 rounded-full transition-all duration-300',
                                matches[index] 
                                    ? 'bg-green-500 w-8' 
                                    : (isThemeDark ? 'bg-gray-600' : 'bg-gray-300')
                            ]"
                        ></div>
                    </div>
                </div>
                
                <!-- Cards Stack -->
                <div class="relative h-[400px] mb-8">
                    <div
                        v-for="(element, index) in displayItems"
                        :key="`mobile-role-${index}`"
                        v-show="currentCardIndex === index"
                        class="absolute inset-0"
                    >
                        <!-- Role Card -->
                        <div
                            :class="[
                                'rounded-3xl p-8 h-full flex flex-col justify-center',
                                'backdrop-blur-xl border',
                                isThemeDark 
                                    ? 'bg-gray-800/90 border-gray-700/50 shadow-2xl' 
                                    : 'bg-white/90 border-gray-200/50 shadow-xl'
                            ]"
                        >
                            <h4 :class="[
                                'text-2xl font-semibold text-center mb-8',
                                isThemeDark ? 'text-white' : 'text-gray-900'
                            ]">
                                {{ element }}
                            </h4>
                            
                            <!-- Definition Options -->
                            <div class="space-y-3">
                                <button
                                    v-for="(def, defIndex) in availableDefinitionsForCurrent"
                                    :key="`def-${defIndex}`"
                                    @click="selectDefinition(def)"
                                    :class="[
                                        'w-full p-4 rounded-2xl text-left transition-all duration-200',
                                        'border backdrop-blur-md',
                                        isThemeDark 
                                            ? 'bg-gray-700/50 border-gray-600 hover:bg-gray-700/70 active:bg-gray-700/90' 
                                            : 'bg-gray-50/50 border-gray-200 hover:bg-gray-100/70 active:bg-gray-200/90',
                                        'transform hover:scale-[1.02] active:scale-[0.98]'
                                    ]"
                                >
                                    <p :class="[
                                        'text-sm',
                                        isThemeDark ? 'text-gray-200' : 'text-gray-700'
                                    ]">
                                        {{ def.text }}
                                    </p>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Navigation -->
                <div class="flex justify-between items-center px-4">
                    <button
                        v-if="currentCardIndex > 0"
                        @click="previousCard"
                        :class="[
                            'p-3 rounded-full transition-all duration-200',
                            isThemeDark 
                                ? 'bg-gray-800 hover:bg-gray-700 active:bg-gray-900' 
                                : 'bg-gray-100 hover:bg-gray-200 active:bg-gray-300'
                        ]"
                    >
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>
                    
                    <span :class="[
                        'text-sm font-medium',
                        isThemeDark ? 'text-gray-400' : 'text-gray-600'
                    ]">
                        {{ currentCardIndex + 1 }} of {{ displayItems.length }}
                    </span>
                    
                    <button
                        v-if="currentCardIndex < displayItems.length - 1"
                        @click="nextCard"
                        :class="[
                            'p-3 rounded-full transition-all duration-200',
                            isThemeDark 
                                ? 'bg-gray-800 hover:bg-gray-700 active:bg-gray-900' 
                                : 'bg-gray-100 hover:bg-gray-200 active:bg-gray-300'
                        ]"
                    >
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script lang="ts">
import { shuffle } from "lodash";

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
        isDarkMode: {
            type: Boolean,
            default: null
        }
    },
    data() {
        return {
            displayItems: [],
            definitions: [],
            matches: {},
            draggedItem: null,
            dragOverIndex: null,
            dragOverBottom: false,
            currentCardIndex: 0,
            matchedDefinitions: new Set(),
        };
    },
    computed: {
        isThemeDark() {
            if (this.isDarkMode !== null) {
                return this.isDarkMode;
            }
            return document.documentElement.classList.contains('dark') ||
                   window.matchMedia?.('(prefers-color-scheme: dark)').matches;
        },
        availableDefinitions() {
            // Show definitions that haven't been matched yet
            return this.definitions.filter(def => !this.matchedDefinitions.has(def.id));
        },
        availableDefinitionsForCurrent() {
            // For mobile: show unmatched definitions for current card
            return this.availableDefinitions;
        }
    },
    mounted() {
        this.initializeData();
    },
    methods: {
        initializeData() {
            const items = this.question.items || (this.question.options && this.question.options.items);
            const responses = this.question.responses || 
                           (this.question.options && this.question.options.responses) ||
                           (this.question.options && this.question.options.targets);
            
            if (items && responses) {
                this.displayItems = [...items];
                
                // Create definition objects with IDs
                this.definitions = shuffle(responses.map((response, index) => ({
                    id: `def-${index}`,
                    text: response,
                    originalIndex: index // Keep track of original position in responses array
                })));
                
                // Initialize matches
                this.matches = {};
                items.forEach((_, index) => {
                    this.matches[index] = null;
                });
                
                // Restore saved answers if any
                if (this.answer?.selected_options?.length > 0) {
                    this.restoreSavedAnswers();
                }
            }
        },
        
        handleDrop(event, roleIndex) {
            event.preventDefault();
            this.dragOverIndex = null;
            
            // Get the dragged definition data
            const definitionData = event.dataTransfer.getData('definition');
            const fromDropzone = event.dataTransfer.getData('fromDropzone');
            
            if (definitionData) {
                const definition = JSON.parse(definitionData);
                
                // If dragging from another dropzone, clear that dropzone first
                if (fromDropzone !== null && fromDropzone !== '') {
                    const fromIndex = parseInt(fromDropzone);
                    if (fromIndex !== roleIndex) {
                        // Clear the source dropzone
                        this.clearMatch(fromIndex);
                    }
                }
                
                this.makeMatch(roleIndex, definition);
            }
        },
        
        handleDragStart(event, definition) {
            event.dataTransfer.effectAllowed = 'move';
            event.dataTransfer.setData('definition', JSON.stringify(definition));
            this.draggedItem = definition.id;
        },
        
        handleDragStartFromDropzone(event, fromIndex) {
            const matchedDefId = this.matches[fromIndex];
            if (matchedDefId) {
                const definition = this.definitions.find(d => d.id === matchedDefId);
                if (definition) {
                    event.dataTransfer.effectAllowed = 'move';
                    event.dataTransfer.setData('definition', JSON.stringify(definition));
                    event.dataTransfer.setData('fromDropzone', fromIndex.toString());
                    this.draggedItem = definition.id;
                }
            }
        },
        
        handleDragEnd() {
            this.draggedItem = null;
            this.dragOverIndex = null;
            this.dragOverBottom = false;
        },
        
        handleDropToBottom(event) {
            event.preventDefault();
            this.dragOverBottom = false;
            
            // Get the dragged definition data
            const fromDropzone = event.dataTransfer.getData('fromDropzone');
            
            if (fromDropzone !== null && fromDropzone !== '') {
                const fromIndex = parseInt(fromDropzone);
                // Clear the source dropzone
                this.clearMatch(fromIndex);
            }
        },
        
        makeMatch(roleIndex, definition) {
            // Clear any existing match for this role
            if (this.matches[roleIndex]) {
                this.matchedDefinitions.delete(this.matches[roleIndex]);
            }
            
            // Make new match
            this.matches[roleIndex] = definition.id;
            this.matchedDefinitions.add(definition.id);
            
            // Update matches object to trigger reactivity
            this.matches = { ...this.matches };
            
            // Emit selection
            this.emitSelection();
            
            // Animate
            this.animateMatch(roleIndex);
        },
        
        clearMatch(roleIndex) {
            if (this.matches[roleIndex]) {
                this.matchedDefinitions.delete(this.matches[roleIndex]);
                delete this.matches[roleIndex];
                
                // Update matches object to trigger reactivity
                this.matches = { ...this.matches };
                
                // Emit selection
                this.emitSelection();
            }
        },
        
        selectDefinition(definition) {
            // Mobile: match with current card
            this.makeMatch(this.currentCardIndex, definition);
            
            // Auto-advance to next card after short delay
            setTimeout(() => {
                if (this.currentCardIndex < this.displayItems.length - 1) {
                    this.nextCard();
                }
            }, 500);
        },
        
        animateMatch(index) {
            // Trigger animation on the matched drop zone
            this.$nextTick(() => {
                // Find the drop zone element
                const dropZone = document.querySelector(`[data-role-index="${index}"]`);
                if (dropZone) {
                    // Add a temporary animation class
                    dropZone.classList.add('animate-pulse');
                    
                    // Remove the animation class after it completes
                    setTimeout(() => {
                        dropZone.classList.remove('animate-pulse');
                    }, 1000);
                }
            });
        },
        
        previousCard() {
            if (this.currentCardIndex > 0) {
                this.currentCardIndex--;
            }
        },
        
        nextCard() {
            if (this.currentCardIndex < this.displayItems.length - 1) {
                this.currentCardIndex++;
            }
        },
        
        getMatchedCount() {
            return Object.keys(this.matches).filter(key => this.matches[key]).length;
        },
        
        getMatchedDefinitionText(index) {
            const matchedDefId = this.matches[index];
            if (matchedDefId) {
                const def = this.definitions.find(d => d.id === matchedDefId);
                return def?.text || '';
            }
            return '';
        },
        
        emitSelection() {
            const selectedOptions = this.displayItems.map((_, index) => {
                const matchedDefId = this.matches[index];
                if (matchedDefId) {
                    // Find definition in all definitions (including matched ones)
                    const def = this.definitions.find(d => d.id === matchedDefId);
                    return def?.text || null;
                }
                return null;
            });
            this.$emit("selected", selectedOptions);
        },
        
        restoreSavedAnswers() {
            // Restore from saved state
            this.answer.selected_options.forEach((savedOption, index) => {
                if (savedOption) {
                    const def = this.definitions.find(d => d.text === savedOption);
                    if (def) {
                        this.makeMatch(index, def);
                    }
                }
            });
        }
    },
    watch: {
        question: {
            handler(newQuestion, oldQuestion) {
                // Only reinitialize if we have a new question
                if (newQuestion && newQuestion !== oldQuestion) {
                    // Reset all state
                    this.displayItems = [];
                    this.definitions = [];
                    this.matches = {};
                    this.draggedItem = null;
                    this.dragOverIndex = null;
                    this.dragOverBottom = false;
                    this.currentCardIndex = 0;
                    this.matchedDefinitions.clear();
                    
                    // Reinitialize data after DOM update
                    this.$nextTick(() => {
                        this.initializeData();
                    });
                }
            },
            deep: true
        }
    }
};
</script>

<style scoped>
/* Apple-style animations */
@keyframes scale-in {
    0% {
        transform: scale(0);
        opacity: 0;
    }
    50% {
        transform: scale(1.1);
    }
    100% {
        transform: scale(1);
        opacity: 1;
    }
}

.animate-scale-in {
    animation: scale-in 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
}

/* Smooth drag transitions */
.sortable-ghost {
    opacity: 0.5;
}

.sortable-drag {
    transform: scale(1.05);
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
}

/* Glass morphism effect */
.backdrop-blur-xl {
    -webkit-backdrop-filter: blur(20px);
    backdrop-filter: blur(20px);
}

/* Mobile swipe hint */
@media (max-width: 768px) {
    .swipe-hint {
        animation: swipe-hint 2s ease-in-out infinite;
    }
}

@keyframes swipe-hint {
    0%, 100% {
        transform: translateX(0);
    }
    50% {
        transform: translateX(-10px);
    }
}
</style>