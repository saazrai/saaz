<template>
    <div :class="[
            'transition-all duration-300 w-full backdrop-blur-md rounded-2xl pt-8 font-medium border shadow-xl',
            isThemeDark 
                ? 'bg-gray-800 border-gray-700' 
                : 'bg-white border-gray-200'
         ]">
        <div class="px-2 py-8 lg:p-8">
            <h4 class="text-lg font-bold mb-10 px-6"
                :class="isThemeDark 
                    ? 'text-white' 
                    : 'text-gray-800'">
                <b>{{ question.content }}</b>
            </h4>
            <div class="question-options flex flex-col md:flex-row gap-6 px-6">
                <div class="flex-1">
                    <h3 class="mb-4 font-semibold text-sm uppercase tracking-wider"
                        :class="isThemeDark 
                            ? 'text-gray-400' 
                            : 'text-gray-600'">Available Items</h3>
                    <draggable
                        v-model="possibleOptions"
                        class="min-h-[150px] space-y-2"
                        :group="{ name: 'people', pull: true, put: true }"
                        :item-key="item => item.key"
                    >
                        <template #item="{ element }">
                            <div
                                :class="[
                                    'text-base font-medium rounded-lg px-4 py-3 transition-all duration-200 hover:scale-[1.02] cursor-move border',
                                    isThemeDark 
                                        ? 'bg-gray-700/50 border-gray-600 text-gray-200 hover:bg-gray-700/70 hover:border-blue-500' 
                                        : 'bg-gray-200 border-gray-400 text-gray-900 hover:bg-blue-50 hover:border-blue-500 shadow-lg hover:shadow-blue-500/20'
                                ]"
                            >
                                {{ element.label }}
                            </div>
                        </template>
                        <template #footer>
                            <div
                                v-if="possibleOptions.length === 0"
                                :class="[
                                    'mt-4 text-sm text-center',
                                    isThemeDark 
                                        ? 'text-gray-500' 
                                        : 'text-gray-500'
                                ]"
                            >
                                All items moved. Drag back to remove.
                            </div>
                        </template>
                    </draggable>
                </div>
                <div class="flex-1">
                    <h3 class="mb-4 font-semibold text-sm uppercase tracking-wider"
                        :class="isThemeDark 
                            ? 'text-gray-400' 
                            : 'text-gray-600'">Drop Zone</h3>
                    <draggable
                        v-model="response"
                        :class="[
                            'min-h-[250px] rounded-xl border border-dashed relative p-4 transition-colors',
                            isThemeDark 
                                ? 'bg-gray-700/30 border-gray-600 hover:bg-gray-700/40' 
                                : 'bg-blue-50/50 border-blue-300 hover:bg-blue-50'
                         ]"
                        :group="{ name: 'people', pull: true, put: true }"
                        :item-key="item => item.key"
                        id="answers"
                    >
                        <template #item="{ element }">
                            <div
                                :class="[
                                    'text-base font-medium rounded-lg px-4 py-3 mb-2 transition-all duration-200 hover:scale-[1.02] cursor-move border',
                                    isThemeDark 
                                        ? 'bg-blue-900/40 text-white border-blue-400 shadow-lg shadow-blue-400/20 hover:bg-blue-900/50' 
                                        : 'bg-blue-50 text-gray-900 border-blue-500 shadow-md hover:bg-blue-100'
                                ]"
                            >
                                {{ element.label }}
                            </div>
                        </template>
                        <template #footer>
                            <div
                                v-if="response.length === 0"
                                :class="[
                                    'absolute inset-0 flex items-center justify-center text-base font-medium pointer-events-none',
                                    isThemeDark 
                                        ? 'text-gray-500' 
                                        : 'text-gray-400'
                                ]"
                            >
                                Drag items here
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
            response: [],
            possibleOptions: [],
        };
    },
    mounted() {
        this.$nextTick(() => {
            this.initializeOptions();
        });
    },
    methods: {
        submit() {
            this.$emit("submit", this.response);
        },
        initializeOptions() {
            // Clear both arrays first
            this.response = [];
            this.possibleOptions = [];

            if (this.question.options) {
                // Check if there's a saved answer to restore
                if (this.answer?.selected_options && Array.isArray(this.answer.selected_options) && this.answer.selected_options.length > 0) {
                    // Create items with unique keys
                    const allOptions = this.question.options.map(
                        (option, index) => ({
                            key: `option-${index}-${Date.now()}`,
                            label: option,
                        })
                    );
                    
                    // Separate saved options from remaining options
                    this.response = [];
                    this.possibleOptions = [];
                    
                    allOptions.forEach(item => {
                        if (this.answer.selected_options.includes(item.label)) {
                            this.response.push(item);
                        } else {
                            this.possibleOptions.push(item);
                        }
                    });
                } else {
                    // No saved answer, all options go to possibleOptions
                    this.possibleOptions = this.question.options.map(
                        (option, index) => ({
                            key: `option-${index}-${Date.now()}`,
                            label: option,
                        })
                    );
                }
            }
        },
    },
    watch: {
        question() {
            this.initializeOptions();
        },
        response() {
            this.$emit(
                "selected",
                this.response.map((item) => item.label)
            );
        },
    },
};
</script>
