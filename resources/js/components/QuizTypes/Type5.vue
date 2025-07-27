<template>
    <!-- Main Card Container with consistent styling -->
    <div :class="[
            'transition-all duration-300 w-full backdrop-blur-md rounded-2xl p-3 lg:p-6 border shadow-xl',
            isThemeDark 
                ? 'bg-gray-800 border-gray-700' 
                : 'bg-white border-gray-200'
         ]">
        <!-- Question Panel with Apple-style design -->
        <div class="w-full">
        <!-- Compact Header -->
        <div class="mb-4">
            <h3 class="text-lg font-semibold text-center"
                :class="isThemeDark ? 'text-white' : 'text-gray-900'">
                <span v-if="!isTouchDevice">{{ question.content }}</span>
                <span v-else>Match the type of intellectual property with its definition.</span>
            </h3>
            <p class="text-sm text-center mt-1"
               :class="isThemeDark ? 'text-gray-400' : 'text-gray-600'">
                <span v-if="!isTouchDevice">Drag items from below and drop them on the matching pairs</span>
                <span v-else>Tap the correct definition for each item</span>
                 • {{ getMatchedCount() }} of {{ displayItems.length }} matched
            </p>
        </div>
        
        <!-- Matching Interface -->
        <div class="max-w-5xl mx-auto">
            <!-- Desktop Layout (only for non-touch devices) -->
            <div class="hidden" :class="{ 'md:block': !isTouchDevice }">
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
                        <svg class="w-5 h-5 shrink-0" 
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
                                        ? (isThemeDark ? 'bg-blue-900/70 border-blue-400 drop-zone-highlight' : 'bg-blue-100 border-blue-500 drop-zone-highlight')
                                        : (isThemeDark ? 'bg-gray-800 border-gray-600 hover:bg-gray-700' : 'bg-gray-100 border-gray-400 hover:bg-gray-200'),
                            ]"
                            @dragover.prevent="dragOverIndex = index"
                            @dragleave="dragOverIndex = null"
                            @drop="handleDrop($event, index)"
                            @click="matches[index] && clearMatch(index)"
                            @touchstart="handleDropZoneTouchStart($event, index)"
                            @touchend="handleDropZoneTouchEnd($event, index)"
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
                                    draggedItem === definition.id && (isDragging ? 'touch-dragging' : 'opacity-50')
                                ]"
                                draggable="true"
                                @dragstart="handleDragStart($event, definition)"
                                @dragend="handleDragEnd"
                                @touchstart="handleTouchStart($event, definition)"
                                @touchmove="handleTouchMove($event)"
                                @touchend="handleTouchEnd($event)"
                            >
                                <div class="flex items-center gap-2">
                                    <svg class="w-3 h-3 text-gray-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
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
            
            <!-- Touch Drag Preview (floating element during touch drag) -->
            <div v-if="isDragging && touchDraggedDefinition" 
                 :style="{ 
                     position: 'fixed', 
                     left: dragPreviewX + 'px', 
                     top: dragPreviewY + 'px',
                     zIndex: 1000,
                     pointerEvents: 'none',
                     transform: 'translate(-50%, -50%)'
                 }"
                 :class="[
                     'px-3 py-2 rounded-md border shadow-2xl drag-preview',
                     isThemeDark 
                         ? 'bg-blue-600 border-blue-500 text-white' 
                         : 'bg-blue-500 border-blue-600 text-white'
                 ]"
            >
                <div class="flex items-center gap-2">
                    <svg class="w-3 h-3 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <span class="text-sm font-medium">
                        {{ touchDraggedDefinition.text }}
                    </span>
                </div>
            </div>
            
            <!-- Mobile Layout (for small screens OR touch devices) -->
            <div class="block" :class="{ 'md:hidden': !isTouchDevice }">
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
                <div class="relative mb-8" :class="isTouchDevice && isLargeScreen ? 'h-[500px]' : 'h-[400px]'"
                     @touchstart="handleCardTouchStart"
                     @touchmove="handleCardTouchMove"
                     @touchend="handleCardTouchEnd">
                    
                    <!-- Summary View - Shows when all items are matched -->
                    <div v-if="allItemsMatched && currentCardIndex === displayItems.length"
                         class="absolute inset-0">
                        <div
                            :class="[
                                'rounded-3xl h-full flex flex-col backdrop-blur-xl border transition-transform duration-200',
                                isTouchDevice && isLargeScreen ? 'p-6' : 'p-4',
                                isThemeDark 
                                    ? 'bg-gray-800/90 border-gray-700/50 shadow-2xl' 
                                    : 'bg-white/90 border-gray-200/50 shadow-xl',
                                isSwipeActive && swipeDirection === 'left' && 'transform -translate-x-2',
                                isSwipeActive && swipeDirection === 'right' && 'transform translate-x-2'
                            ]"
                        >
                            <div class="flex justify-between items-center mb-4">
                                <h4 :class="[
                                    'text-xl font-semibold',
                                    isThemeDark ? 'text-white' : 'text-gray-900'
                                ]">
                                    Summary of Matches
                                </h4>
                                <button
                                    @click="resetAllMatches"
                                    :class="[
                                        'text-sm px-3 py-1.5 rounded-lg transition-colors font-medium',
                                        isThemeDark 
                                            ? 'bg-red-900/50 text-red-400 hover:bg-red-900/70' 
                                            : 'bg-red-100 text-red-600 hover:bg-red-200'
                                    ]"
                                >
                                    Cancel
                                </button>
                            </div>
                            
                            <div class="space-y-2 flex-1">
                                <div
                                    v-for="(item, index) in displayItems"
                                    :key="`summary-${index}`"
                                    :class="[
                                        'p-2 rounded-xl border',
                                        isThemeDark 
                                            ? 'bg-gray-700/50 border-gray-600' 
                                            : 'bg-gray-50 border-gray-200'
                                    ]"
                                >
                                    <h5 :class="[
                                        'font-semibold text-sm mb-1',
                                        isThemeDark ? 'text-blue-400' : 'text-blue-600'
                                    ]">
                                        {{ item }}
                                    </h5>
                                    <p :class="[
                                        'text-xs leading-relaxed',
                                        isThemeDark ? 'text-gray-300' : 'text-gray-600'
                                    ]">
                                        {{ getMatchedDefinitionText(index) }}
                                    </p>
                                </div>
                            </div>
                            
                            <div class="mt-4 text-center">
                                <p :class="[
                                    'text-xs',
                                    isThemeDark ? 'text-gray-400' : 'text-gray-500'
                                ]">
                                    Tap Cancel to reset all matches and start over
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Individual Cards -->
                    <div
                        v-for="(element, index) in displayItems"
                        :key="`mobile-role-${index}`"
                        v-show="currentCardIndex === index && (!allItemsMatched || currentCardIndex < displayItems.length)"
                        class="absolute inset-0"
                    >
                        <!-- Role Card -->
                        <div
                            :class="[
                                'rounded-3xl h-full flex flex-col justify-center backdrop-blur-xl border transition-transform duration-200',
                                isTouchDevice && isLargeScreen ? 'p-12' : 'p-3',
                                isThemeDark 
                                    ? 'bg-gray-800/90 border-gray-700/50 shadow-2xl' 
                                    : 'bg-white/90 border-gray-200/50 shadow-xl',
                                isSwipeActive && swipeDirection === 'left' && 'transform -translate-x-2',
                                isSwipeActive && swipeDirection === 'right' && 'transform translate-x-2'
                            ]"
                        >
                            <h4 :class="[
                                'text-xl font-semibold text-center mb-4',
                                isThemeDark ? 'text-white' : 'text-gray-900'
                            ]">
                                {{ element }}
                            </h4>
                            
                            <!-- Current Match Display (if any) -->
                            <div v-if="matches[currentCardIndex]" class="mb-6">
                                <div :class="[
                                    'p-4 rounded-2xl border-2',
                                    isThemeDark 
                                        ? 'bg-green-900/30 border-green-500/50' 
                                        : 'bg-green-50 border-green-300'
                                ]">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p :class="[
                                                'text-xs font-medium uppercase tracking-wider mb-1',
                                                isThemeDark ? 'text-green-400' : 'text-green-600'
                                            ]">Currently Matched</p>
                                            <p :class="[
                                                'text-sm',
                                                isThemeDark ? 'text-green-200' : 'text-green-700'
                                            ]">
                                                {{ getMatchedDefinitionText(currentCardIndex) }}
                                            </p>
                                        </div>
                                        <button
                                            @click="clearCurrentMatch"
                                            :class="[
                                                'p-2 rounded-lg transition-all duration-200',
                                                isThemeDark 
                                                    ? 'bg-red-900/50 hover:bg-red-900/70 text-red-400' 
                                                    : 'bg-red-100 hover:bg-red-200 text-red-600'
                                            ]"
                                            title="Remove this match"
                                        >
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Definition Options -->
                            <div class="space-y-2">
                                <button
                                    v-for="(def, defIndex) in availableDefinitionsForCurrent"
                                    :key="`def-${defIndex}`"
                                    @click="selectDefinition(def)"
                                    :class="[
                                        'w-full rounded-2xl text-left transition-all duration-200 border backdrop-blur-md',
                                        isTouchDevice && isLargeScreen ? 'p-5' : 'p-3',
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
                                
                                <!-- No options message -->
                                <div v-if="availableDefinitionsForCurrent.length === 0 && !matches[currentCardIndex]" :class="[
                                    'text-center py-8',
                                    isThemeDark ? 'text-gray-500' : 'text-gray-400'
                                ]">
                                    <svg class="w-8 h-8 mx-auto mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <p class="text-sm">All definitions have been used</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Navigation -->
                <div class="flex justify-between items-center px-4">
                    <button
                        v-if="currentCardIndex > 0 || currentCardIndex === displayItems.length"
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
                        <span v-if="currentCardIndex === displayItems.length">Summary</span>
                        <span v-else>{{ currentCardIndex + 1 }} of {{ displayItems.length }}</span>
                    </span>
                    
                    <button
                        v-if="currentCardIndex < displayItems.length - 1 || (allItemsMatched && currentCardIndex === displayItems.length - 1)"
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
        isDark: {
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
            windowWidth: typeof window !== 'undefined' ? window.innerWidth : 0,
            windowHeight: typeof window !== 'undefined' ? window.innerHeight : 0,
            // Touch drag state
            touchDraggedDefinition: null,
            touchStartX: 0,
            touchStartY: 0,
            isDragging: false,
            dragPreviewX: 0,
            dragPreviewY: 0,
            // Card swipe state
            cardSwipeStartX: 0,
            cardSwipeStartY: 0,
            cardSwipeStartTime: 0,
            swipeDirection: null, // 'left' or 'right'
            isSwipeActive: false,
        };
    },
    computed: {
        isThemeDark() {
            if (this.isDark !== null) {
                return this.isDark;
            }
            return document.documentElement.classList.contains('dark') ||
                   window.matchMedia?.('(prefers-color-scheme: dark)').matches;
        },
        isTouchDevice() {
            // Only show mobile interface for small screens (phones)
            if (typeof window === 'undefined') return false;
            return this.windowWidth < 768; // Only phones get mobile interface
        },
        isLargeScreen() {
            // Reactive window width check
            return this.windowWidth >= 768;
        },
        availableDefinitions() {
            // Show definitions that haven't been matched yet
            return this.definitions.filter(def => !this.matchedDefinitions.has(def.id));
        },
        availableDefinitionsForCurrent() {
            // For mobile: show unmatched definitions for current card
            return this.availableDefinitions;
        },
        allItemsMatched() {
            // Check if all items have been matched
            return this.displayItems.length > 0 && 
                   this.displayItems.every((_, index) => this.matches[index]);
        }
    },
    methods: {
        updateWindowWidth() {
            if (typeof window !== 'undefined') {
                this.windowWidth = window.innerWidth;
                this.windowHeight = window.innerHeight;
            }
        },
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
        
        // Touch event handlers for drag and drop
        handleTouchStart(event, definition) {
            this.touchDraggedDefinition = definition;
            this.touchStartX = event.touches[0].clientX;
            this.touchStartY = event.touches[0].clientY;
            this.dragPreviewX = event.touches[0].clientX;
            this.dragPreviewY = event.touches[0].clientY;
            this.isDragging = false;
            
            // Add visual feedback - make original item semi-transparent
            this.draggedItem = definition.id;
            
            // Add haptic feedback for touch devices
            if (navigator.vibrate) {
                navigator.vibrate(50);
            }
        },
        
        handleTouchMove(event) {
            if (!this.touchDraggedDefinition) return;
            
            event.preventDefault(); // Prevent scrolling
            
            const touch = event.touches[0];
            const deltaX = Math.abs(touch.clientX - this.touchStartX);
            const deltaY = Math.abs(touch.clientY - this.touchStartY);
            
            // Update drag preview position
            this.dragPreviewX = touch.clientX;
            this.dragPreviewY = touch.clientY;
            
            // Start dragging if moved enough
            if (!this.isDragging && (deltaX > 10 || deltaY > 10)) {
                this.isDragging = true;
                // Add haptic feedback when drag starts
                if (navigator.vibrate) {
                    navigator.vibrate(30);
                }
            }
            
            if (this.isDragging) {
                // Find element under touch point
                const elementBelow = document.elementFromPoint(touch.clientX, touch.clientY);
                const dropZone = elementBelow?.closest('[data-role-index]');
                
                if (dropZone) {
                    const index = parseInt(dropZone.getAttribute('data-role-index'));
                    if (this.dragOverIndex !== index) {
                        this.dragOverIndex = index;
                        // Add haptic feedback when hovering over new drop zone
                        if (navigator.vibrate) {
                            navigator.vibrate(20);
                        }
                    }
                } else {
                    this.dragOverIndex = null;
                }
            }
        },
        
        handleTouchEnd(event) {
            if (!this.touchDraggedDefinition || !this.isDragging) {
                this.resetTouchState();
                return;
            }
            
            const touch = event.changedTouches[0];
            const elementBelow = document.elementFromPoint(touch.clientX, touch.clientY);
            const dropZone = elementBelow?.closest('[data-role-index]');
            
            if (dropZone) {
                const index = parseInt(dropZone.getAttribute('data-role-index'));
                this.makeMatch(index, this.touchDraggedDefinition);
                
                // Success feedback
                if (navigator.vibrate) {
                    navigator.vibrate([100, 50, 100]); // Double vibration for success
                }
            } else {
                // Failed drop feedback
                if (navigator.vibrate) {
                    navigator.vibrate(200); // Longer vibration for failure
                }
            }
            
            this.resetTouchState();
        },
        
        handleDropZoneTouchStart(event, index) {
            // Prevent touch events from bubbling when touching drop zones
            if (this.matches[index]) {
                event.stopPropagation();
            }
        },
        
        handleDropZoneTouchEnd(event, index) {
            // Handle clearing matches on touch
            if (this.matches[index] && !this.isDragging) {
                this.clearMatch(index);
            }
        },
        
        resetTouchState() {
            this.touchDraggedDefinition = null;
            this.touchStartX = 0;
            this.touchStartY = 0;
            this.isDragging = false;
            this.draggedItem = null;
            this.dragOverIndex = null;
            this.dragPreviewX = 0;
            this.dragPreviewY = 0;
        },
        
        // Card swipe handlers for mobile navigation
        handleCardTouchStart(event) {
            this.cardSwipeStartX = event.touches[0].clientX;
            this.cardSwipeStartY = event.touches[0].clientY;
            this.cardSwipeStartTime = Date.now();
        },
        
        handleCardTouchMove(event) {
            // Don't interfere with button/definition dragging
            if (this.touchDraggedDefinition) return;
            
            const deltaX = event.touches[0].clientX - this.cardSwipeStartX;
            const deltaY = Math.abs(event.touches[0].clientY - this.cardSwipeStartY);
            const absDeltaX = Math.abs(deltaX);
            
            // Prevent scrolling if horizontal swipe is detected
            if (absDeltaX > deltaY && absDeltaX > 20) {
                event.preventDefault();
                
                // Show visual feedback when swipe is detected
                if (absDeltaX > 30) {
                    this.isSwipeActive = true;
                    this.swipeDirection = deltaX > 0 ? 'right' : 'left';
                }
            }
        },
        
        handleCardTouchEnd(event) {
            // Don't interfere with button/definition interactions
            if (this.touchDraggedDefinition) return;
            
            const endX = event.changedTouches[0].clientX;
            const endY = event.changedTouches[0].clientY;
            const deltaX = endX - this.cardSwipeStartX;
            const deltaY = endY - this.cardSwipeStartY;
            const deltaTime = Date.now() - this.cardSwipeStartTime;
            
            // Reset swipe visual feedback
            this.isSwipeActive = false;
            this.swipeDirection = null;
            
            // Check if it's a valid swipe (horizontal movement, not too slow)
            const isHorizontalSwipe = Math.abs(deltaX) > Math.abs(deltaY) && Math.abs(deltaX) > 50;
            const isFastEnough = deltaTime < 500; // Less than 500ms
            
            if (isHorizontalSwipe && isFastEnough) {
                if (deltaX > 0) {
                    // Swipe right - go to previous card
                    this.previousCard();
                } else {
                    // Swipe left - go to next card
                    this.nextCard();
                }
                
                // Add haptic feedback for swipe
                if (navigator.vibrate) {
                    navigator.vibrate(30);
                }
            }
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
        
        clearCurrentMatch() {
            // Mobile: clear the match for the current card
            this.clearMatch(this.currentCardIndex);
        },
        
        selectDefinition(definition) {
            // Check if this is a new match or changing an existing one
            const wasAlreadyMatched = !!this.matches[this.currentCardIndex];
            
            // Mobile: match with current card
            this.makeMatch(this.currentCardIndex, definition);
            
            // Only auto-advance for new matches, not when changing existing ones
            if (!wasAlreadyMatched) {
                setTimeout(() => {
                    if (this.currentCardIndex < this.displayItems.length - 1) {
                        this.nextCard();
                    } else if (this.allItemsMatched) {
                        // Go to summary when all items are matched
                        this.currentCardIndex = this.displayItems.length;
                    }
                }, 500);
            }
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
            if (this.currentCardIndex === this.displayItems.length) {
                // Coming back from summary view
                this.currentCardIndex = this.displayItems.length - 1;
            } else if (this.currentCardIndex > 0) {
                this.currentCardIndex--;
            }
        },
        
        nextCard() {
            if (this.allItemsMatched && this.currentCardIndex === this.displayItems.length - 1) {
                // Go to summary view
                this.currentCardIndex = this.displayItems.length;
            } else if (this.currentCardIndex < this.displayItems.length - 1) {
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
        },
        
        resetAllMatches() {
            // Clear all matches
            this.matches = {};
            this.displayItems.forEach((_, index) => {
                this.matches[index] = null;
            });
            this.matchedDefinitions.clear();
            
            // Reset to the first card
            this.currentCardIndex = 0;
            
            // Emit updated selection
            this.emitSelection();
        }
    },
    mounted() {
        this.initializeData();
        
        // Add window resize listener for reactive width tracking
        if (typeof window !== 'undefined') {
            this.updateWindowWidth();
            window.addEventListener('resize', this.updateWindowWidth);
        }
    },
    unmounted() {
        // Cleanup resize listener
        if (typeof window !== 'undefined') {
            window.removeEventListener('resize', this.updateWindowWidth);
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

/* Touch drag animations */
@keyframes dragPreviewPulse {
    0%, 100% {
        transform: translate(-50%, -50%) scale(1.1);
    }
    50% {
        transform: translate(-50%, -50%) scale(1.15);
    }
}

.drag-preview {
    animation: dragPreviewPulse 1s ease-in-out infinite;
}

/* Enhanced drop zone feedback */
.drop-zone-highlight {
    animation: dropZonePulse 0.6s ease-in-out infinite;
}

@keyframes dropZonePulse {
    0%, 100% {
        transform: scale(1);
        opacity: 1;
    }
    50% {
        transform: scale(1.02);
        opacity: 0.9;
    }
}

/* Touch feedback for draggable items */
.touch-dragging {
    transform: scale(0.95);
    opacity: 0.5;
    transition: all 0.2s ease;
}
</style>