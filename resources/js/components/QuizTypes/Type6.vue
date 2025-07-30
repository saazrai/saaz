<template>
    <div :class="[
            'transition-all duration-300 w-full backdrop-blur-md rounded-2xl p-3 lg:p-6 border shadow-xl',
            isThemeDark 
                ? 'bg-gray-800 border-gray-700' 
                : 'bg-white border-gray-200'
         ]">
        <div>
            <div class="text-lg font-medium mb-6"
                :class="isThemeDark 
                    ? 'text-white' 
                    : 'text-gray-800'"
                v-html="renderedQuestion">
            </div>
            
            <div class="overflow-x-auto">
                <div class="relative inline-block">
                <!-- Image wrapper with border -->
                <div v-if="imageUrl" 
                     class="inline-block mx-auto"
                     :style="{ 
                        border: '16px solid white',
                        borderRadius: '8px',
                        boxShadow: '0 4px 8px rgba(0,0,0,0.1)'
                     }">
                    <img 
                        :src="imageUrl" 
                        class="block"
                        :style="{ 
                            width: 'auto',
                            height: 'auto',
                            maxWidth: 'none',
                            maxHeight: 'none',
                            display: 'block'
                        }"
                        @error="onImageError"
                        @load="onImageLoad"
                    />
                </div>
                <div v-else :class="[
                    'flex items-center justify-center h-96 w-full rounded-lg',
                    isThemeDark ? 'bg-gray-700' : 'bg-gray-100'
                ]">
                    <p :class="isThemeDark ? 'text-gray-400' : 'text-gray-500'">
                        Image not available
                    </p>
                </div>
                
                <!-- Interactive hotspot overlays -->
                <div
                    v-for="(option, i) in question.options"
                    :key="`interactive-${i}`"
                    :class="getInteractiveOptionClasses(option)"
                    :style="{
                        position: 'absolute',
                        top: (option.y + 16) + 'px',
                        left: (option.x + 16) + 'px',
                        marginLeft: '-35px',
                        marginTop: '-35px'
                    }"
                    @click="select(option)"
                >
                    <span v-if="selectedOptions === option" class="absolute inset-0 flex items-center justify-center text-white font-bold text-lg">
                        ✓
                    </span>
                </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script lang="ts">
import { renderMarkdown } from '@/utils/markdown';

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
    computed: {
        renderedQuestion() {
            return renderMarkdown(this.question?.content, this.isThemeDark);
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
        imageUrl() {
            // Check if image is in settings
            if (this.question.settings?.image) {
                return this.question.settings.image;
            }
            // Check if image is provided as a path (legacy)
            if (this.question.image) {
                if (typeof this.question.image === 'string') {
                    return this.question.image;
                }
                if (this.question.image.path) {
                    return this.question.image.path;
                }
            }
            // Check if image URL is embedded in content as markdown
            const imgMatch = this.question.content?.match(/!\[.*?\]\((.*?)\)/);
            if (imgMatch && imgMatch[1]) {
                return imgMatch[1];
            }
            return null;
        },
    },
    data() {
        return {
            selectedOptions: null,
            bullets: ["A", "B", "C", "D", "E", "F", "G", "H"]
        };
    },
    methods: {
        select(option) {
            this.selectedOptions = option;
        },
        selectedOptionIndex() {
            return this.question.options.findIndex(
                (option) =>
                    this.selectedOptions.x === option.x &&
                    this.selectedOptions.y === option.y
            );
        },
        findArrayIndex(mainArray, searchArray) {
            return mainArray.findIndex(
                (arr) =>
                    arr.length === searchArray.length &&
                    arr.every(
                        (element, index) => element === searchArray[index]
                    )
            );
        },
        getInteractiveOptionClasses(option) {
            const baseClasses = 'h-[70px] w-[70px] rounded-lg cursor-pointer z-200 border-2 transition-all duration-200';
            
            if (this.selectedOptions === option) {
                return `${baseClasses} ${this.isThemeDark ? 'bg-blue-500/60 border-blue-400 shadow-lg shadow-blue-500/30' : 'bg-blue-500/60 border-blue-600 shadow-lg shadow-blue-500/30'}`;
            } else {
                return `${baseClasses} ${this.isThemeDark ? 'hover:bg-blue-500/30 hover:border-blue-400 border-transparent' : 'hover:bg-blue-500/30 hover:border-blue-600 border-transparent'}`;
            }
        },
        onImageError(event) {
            console.error('Image failed to load:', event.target.src);
            console.error('Error event:', event);
        },
        onImageLoad(event) {
            console.log('Image loaded successfully:', event.target.src);
        }
    },
    watch: {
        question: {
            immediate: true,
            handler() {
                // Debug when question changes
                console.log('Question changed:', this.question);
                console.log('Image URL computed:', this.imageUrl);
                
                // Check if there's a saved answer to restore
                if (this.answer?.selected_options && this.answer.selected_options) {
                    // For Type6 (hotspot), selected_options should be an object with x and y coordinates
                    if (typeof this.answer.selected_options === 'object' && !Array.isArray(this.answer.selected_options)) {
                        this.selectedOptions = this.answer.selected_options;
                    } else if (Array.isArray(this.answer.selected_options) && this.answer.selected_options.length > 0) {
                        // Handle case where it might be stored as array
                        this.selectedOptions = this.answer.selected_options[0];
                    } else {
                        this.selectedOptions = null;
                    }
                } else {
                    this.selectedOptions = null;
                }
            }
        },
        selectedOptions() {
            this.$emit("selected", this.selectedOptions);
        },
    },
    mounted() {
        // Debug image URL
        console.log('Type6 Question:', this.question);
        console.log('Settings:', this.question.settings);
        console.log('Image URL:', this.imageUrl);
    }
};
</script>
