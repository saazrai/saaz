<template>
    <div :class="[
            'transition-all duration-300 w-full backdrop-blur-md rounded-2xl pt-8 font-medium border shadow-xl',
            isThemeDark 
                ? 'bg-gray-800 border-gray-700' 
                : 'bg-white border-gray-200'
         ]">
        <div class="px-2 py-8 lg:p-8">
            <h4 class="text-lg mb-10 px-6"
                :class="isThemeDark 
                    ? 'text-white' 
                    : 'text-gray-800'">
                {{ question.content }}
            </h4>
            
            <div class="flex flex-col md:flex-row gap-6 px-6">
                <!-- Source Items (Left Side) -->
                <div class="flex-1">
                    <h3 class="mb-4 font-semibold text-sm uppercase tracking-wider"
                        :class="isThemeDark 
                            ? 'text-gray-400' 
                            : 'text-gray-600'">Available Items</h3>
                    <p class="text-sm mb-4"
                       :class="isThemeDark 
                           ? 'text-gray-500' 
                           : 'text-gray-500'">Drag items to the right panel to order them ({{ sourceItems.length }} remaining)</p>
                    <draggable
                        v-model="sourceItems"
                        class="min-h-[150px] space-y-2"
                        :group="{ name: 'sorting', pull: true, put: true }"
                        :sort="false"
                        :itemKey="getItemKey"
                    >
                        <template #item="{ element }">
                            <div
                                :key="element.id"
                                :class="[
                                    'text-base font-medium rounded-lg px-4 py-3 transition-all duration-200 hover:scale-[1.02] cursor-move border',
                                    isThemeDark 
                                        ? 'bg-gray-700/50 border-gray-600 text-gray-200 hover:bg-gray-700/70 hover:border-blue-500' 
                                        : 'bg-gray-200 border-gray-400 text-gray-900 hover:bg-blue-50 hover:border-blue-500 shadow-lg hover:shadow-blue-500/20'
                                ]"
                            >
                                {{ element.text }}
                            </div>
                        </template>
                        <template #footer>
                            <div v-if="sourceItems.length === 0" 
                                 :class="[
                                     'text-center py-8',
                                     isThemeDark 
                                         ? 'text-gray-500' 
                                         : 'text-gray-400'
                                 ]">
                                All items have been moved
                            </div>
                        </template>
                    </draggable>
                </div>
                
                <!-- Drop Zone (Right Side) -->
                <div class="flex-1">
                    <h3 class="mb-4 font-semibold text-sm uppercase tracking-wider"
                        :class="isThemeDark 
                            ? 'text-gray-400' 
                            : 'text-gray-600'">Order Items</h3>
                    <p class="text-sm mb-4"
                       :class="isThemeDark 
                           ? 'text-gray-500' 
                           : 'text-gray-500'">Arrange items in the correct order ({{ orderedItems.length }} items placed)</p>
                    <draggable
                        v-model="orderedItems"
                        class="min-h-[250px] p-4 border border-dashed rounded-xl transition-colors"
                        :class="getDropZoneClasses()"
                        :group="{ name: 'sorting', pull: true, put: true }"
                        :itemKey="getItemKey"
                    >
                        <template #item="{ element }">
                            <div
                                :key="element.id"
                                :class="[
                                    'text-base font-medium rounded-lg px-4 py-3 mb-2 transition-all duration-200 hover:scale-[1.02] cursor-move border',
                                    isThemeDark 
                                        ? 'bg-blue-600/30 border-blue-500 text-white hover:bg-blue-600/40' 
                                        : 'bg-blue-500 border-blue-600 text-white hover:bg-blue-600 shadow-md'
                                ]"
                            >
                                {{ element.text }}
                            </div>
                        </template>
                        <template #footer>
                            <div v-if="orderedItems.length === 0" 
                                 :class="[
                                     'flex items-center justify-center text-base font-medium pointer-events-none min-h-[200px]',
                                     isThemeDark 
                                         ? 'text-gray-500' 
                                         : 'text-gray-400'
                                 ]">
                                Drop items here to order them
                            </div>
                        </template>
                    </draggable>
                </div>
            </div>
        </div>
    </div>
</template>

<script lang="ts">
import draggable from "vuedraggable";

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
        isDark: {
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
            if (this.isDark !== null) {
                return this.isDark;
            }
            // Fallback detection for backward compatibility
            return document.documentElement.classList.contains('dark') ||
                   this.$el?.classList?.contains('dark-mode') ||
                   this.$parent?.$el?.classList?.contains('dark-mode') ||
                   window.matchMedia?.('(prefers-color-scheme: dark)').matches;
        },
        totalItems() {
            return this.question.options ? this.question.options.length : 0;
        },
        hasItemsInTarget() {
            return this.orderedItems.length > 0;
        }
    },
    data() {
        return {
            sourceItems: [],
            orderedItems: [],
        };
    },
    mounted() {
        this.$nextTick(function () {
            this.initializeItems();
        });
    },
    methods: {
        initializeItems() {
            if (this.question.options) {
                // Check if there's a saved answer to restore
                if (this.answer?.selected_options && Array.isArray(this.answer.selected_options) && this.answer.selected_options.length > 0) {
                    // Create all items with unique IDs
                    const allItems = this.question.options.map((option, index) => ({
                        id: `item-${index}`,
                        text: option,
                        originalIndex: index
                    }));
                    
                    // Separate saved ordered items from remaining source items
                    this.orderedItems = [];
                    this.sourceItems = [];
                    
                    // First, add saved items in their saved order
                    this.answer.selected_options.forEach(savedOption => {
                        const item = allItems.find(i => i.text === savedOption);
                        if (item) {
                            this.orderedItems.push(item);
                        }
                    });
                    
                    // Then add remaining items to source
                    allItems.forEach(item => {
                        if (!this.orderedItems.find(i => i.id === item.id)) {
                            this.sourceItems.push(item);
                        }
                    });
                } else {
                    // No saved answer - all items start in source
                    this.sourceItems = this.question.options.map((option, index) => ({
                        id: `item-${index}`,
                        text: option,
                        originalIndex: index
                    }));
                    
                    // Initialize empty ordered items
                    this.orderedItems = [];
                }
                
                // Emit initial selection
                this.emitSelection();
            }
        },
        getItemKey(item) {
            return item.id;
        },
        getDropZoneClasses() {
            const hasItems = this.orderedItems.length > 0;
            
            if (this.isThemeDark) {
                return hasItems 
                    ? 'bg-gray-700/40 border-gray-600 hover:bg-gray-700/50' 
                    : 'bg-gray-700/30 border-gray-600 hover:bg-gray-700/40';
            } else {
                return hasItems 
                    ? 'bg-blue-100/50 border-blue-400 hover:bg-blue-100' 
                    : 'bg-blue-50/50 border-blue-300 hover:bg-blue-50';
            }
        },
        emitSelection() {
            // Emit the ordered text values - now only items in the target area
            // Filter out any null/undefined values that might have been introduced
            const selectedOptions = this.orderedItems
                .map(item => item ? item.text : null)
                .filter(text => text !== null && text !== undefined && text !== '');
            this.$emit("selected", selectedOptions);
        }
    },
    watch: {
        question() {
            this.initializeItems();
        },
        orderedItems: {
            handler() {
                this.emitSelection();
            },
            deep: true
        }
    },
};
</script>

<style>
blockquote {
    border-left: 4px solid #ccc;
    padding-left: 1em;
    margin-left: 0;
    margin-top: 1em;
    color: #333;
    font-style: italic;
}

/* Custom scrollbar for drag areas */
.min-h-\[200px\] {
    max-height: 400px;
    overflow-y: auto;
}

.min-h-\[200px\]::-webkit-scrollbar {
    width: 6px;
}

.min-h-\[200px\]::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 3px;
}

.min-h-\[200px\]::-webkit-scrollbar-thumb {
    background: #c1c1c1;
    border-radius: 3px;
}

.min-h-\[200px\]::-webkit-scrollbar-thumb:hover {
    background: #a8a8a8;
}
</style>
