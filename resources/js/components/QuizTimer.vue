<template>
    <!-- Configurable Timer Display -->
    <div 
        v-if="actualDisplayMode === 'container'"
        :class="[
            'flex items-center justify-center px-3 py-2 bg-gray-100 dark:bg-gray-700 rounded-lg',
            totalOnly || shouldShowTotalOnly ? '' : (isMobileLandscape ? '' : 'gap-1'),
            widthClass,
            heightClass
        ]"
    >
        <!-- Question Time -->
        <span 
            v-if="!totalOnly && !shouldShowTotalOnly"
            :class="[
                'font-mono font-medium text-gray-700 dark:text-gray-300 text-center',
                fontSizeClass
            ]"
        >
            <span v-if="showLabels" class="text-xs text-gray-500 dark:text-gray-400 mr-1">Q</span>{{ formatTime(questionTimer) }}
        </span>
        
        <!-- Divider - compact for mobile landscape -->
        <span 
            v-if="!totalOnly && !shouldShowTotalOnly && !questionOnly && showDivider" 
            :class="[
                'font-mono font-medium text-gray-400 dark:text-gray-500',
                fontSizeClass
            ]"
        >{{ isMobileLandscape ? '/' : ' / ' }}</span>

        
        <!-- Total Time -->
        <span 
            v-if="!questionOnly"
            :class="[
                'font-mono font-medium text-gray-700 dark:text-gray-300 text-center',
                fontSizeClass
            ]"
        >
            <span v-if="showLabels" class="text-xs text-gray-500 dark:text-gray-400 mr-1">T</span>{{ formatTime(totalTimer) }}
        </span>
        
        <!-- Remaining Time (for exams) -->
        <template v-if="maxDuration && showRemaining">
            <div class="w-px h-3 bg-gray-300 dark:bg-gray-600"></div>
            <span 
                :class="[
                    'font-mono font-medium text-red-600 dark:text-red-400 text-center',
                    fontSizeClass
                ]"
            >
                <span v-if="showLabels" class="text-xs text-red-500 dark:text-red-400 mr-1">R</span>{{ formatTime(remaining) }}
            </span>
        </template>
    </div>
    
    <!-- Legacy compact mode (for backward compatibility) -->
    <div v-else-if="actualDisplayMode === 'legacy-compact'">
        {{ formatTime(questionTimer) }} / {{ formatTime(totalTimer) }}
    </div>
    
    <!-- Legacy full mode (for backward compatibility) -->
    <div
        v-else-if="actualDisplayMode === 'legacy-full'"
        class="flex flex-wrap justify-between items-center gap-x-6 gap-y-1 w-full"
    >
        <div class="flex items-center">
            <span :class="['text-sm', isDark ? 'text-gray-400' : 'text-gray-600']">Question Time:</span>
            <span :class="['ml-1 font-bold text-sm', isDark ? 'text-gray-100' : 'text-gray-900']">{{
                formatTime(questionTimer)
            }}</span>
        </div>
        <div class="flex items-center">
            <span :class="['text-sm', isDark ? 'text-gray-400' : 'text-gray-600']">Total Time:</span>
            <span :class="['ml-1 font-bold text-sm', isDark ? 'text-gray-100' : 'text-gray-900']">{{
                formatTime(totalTimer)
            }}</span>
        </div>
        <div
            v-if="maxDuration"
            class="flex items-center font-semibold"
        >
            <span :class="['text-sm', isDark ? 'text-red-400' : 'text-red-600']">Time Remaining:</span>
            <span :class="['ml-1 font-bold text-sm', isDark ? 'text-red-400' : 'text-red-600']">{{ formatTime(remaining) }}</span>
        </div>
    </div>
    
    <!-- Text-only mode (no container) -->
    <template v-else>
        <span 
            v-if="!totalOnly && !shouldShowTotalOnly"
            :class="[
                'font-mono font-medium text-gray-700 dark:text-gray-300',
                fontSizeClass
            ]"
        >
            <span v-if="showLabels" class="text-xs text-gray-500 dark:text-gray-400 mr-1">Q</span>{{ formatTime(questionTimer) }}
        </span>
        
        <span v-if="!totalOnly && !shouldShowTotalOnly && !questionOnly">{{ isMobileLandscape ? '/' : ' / ' }}</span>
        
        <span 
            v-if="!questionOnly"
            :class="[
                'font-mono font-medium text-gray-700 dark:text-gray-300',
                fontSizeClass
            ]"
        >
            <span v-if="showLabels" class="text-xs text-gray-500 dark:text-gray-400 mr-1">T</span>{{ formatTime(totalTimer) }}
        </span>
    </template>
</template>

<script lang="ts">
export default {
    props: {
        // Timer functionality
        isReview: {
            type: Boolean,
            default: false,
        },
        maxDuration: {
            type: Number,
            default: null, // In seconds — used only in Exam
        },
        initialElapsed: {
            type: Number,
            default: 0, // Time already spent if resuming exam
        },
        
        // Visual configuration
        isDark: {
            type: Boolean,
            default: false,
        },
        
        // Display mode
        displayMode: {
            type: String,
            default: 'container', // 'container', 'text', 'legacy-compact', 'legacy-full'
        },
        
        // Content options
        totalOnly: {
            type: Boolean,
            default: false, // Show only total time
        },
        questionOnly: {
            type: Boolean,
            default: false, // Show only question time
        },
        showLabels: {
            type: Boolean,
            default: false, // Show Q/T/R labels
        },
        showDivider: {
            type: Boolean,
            default: true, // Show divider between times
        },
        showRemaining: {
            type: Boolean,
            default: false, // Show remaining time (for exams)
        },
        
        // Styling (Tailwind classes)
        widthClass: {
            type: String,
            default: 'w-32', // Container width
        },
        heightClass: {
            type: String,
            default: 'h-10', // Container height
        },
        fontSizeClass: {
            type: String,
            default: 'text-sm', // Font size
        },
        
        // Legacy backward compatibility
        compact: {
            type: Boolean,
            default: false, // For legacy support
        },
    },
    data() {
        return {
            totalTimer: this.initialElapsed,
            questionTimer: 0,
            interval: null,
            remaining: this.maxDuration
                ? this.maxDuration - this.initialElapsed
                : null,
            windowWidth: typeof window !== 'undefined' ? window.innerWidth : 1024,
            windowHeight: typeof window !== 'undefined' ? window.innerHeight : 768,
        };
    },
    computed: {
        // Auto-determine display mode for legacy compatibility
        actualDisplayMode() {
            // If displayMode is explicitly set, use it
            if (this.displayMode !== 'container') {
                return this.displayMode;
            }
            
            // Legacy compatibility: convert old compact prop
            if (this.compact) {
                return 'legacy-compact';
            }
            
            return this.displayMode;
        },
        shouldShowTotalOnly() {
            // Show only total timer in mobile portrait mode
            return this.totalOnly || this.isMobilePortrait;
        },
        isMobileLandscape() {
            // Mobile landscape: width > height and width < 1024px (covers all mobile devices)
            return this.windowWidth < 1024 && this.windowWidth > this.windowHeight;
        },
        isMobilePortrait() {
            // Mobile portrait: width < height and width < 1024px  
            return this.windowWidth < 1024 && this.windowHeight > this.windowWidth;
        },
        isMobile() {
            return this.windowWidth < 1024;
        }
    },
    watch: {
        isReview(newVal) {
            if (newVal) {
                clearInterval(this.interval);
            } else {
                this.startTimers();
            }
        },
    },
    mounted() {
        this.startTimers();
        this.updateWindowDimensions();
        window.addEventListener('resize', this.updateWindowDimensions);
        // Force initial update
        this.$nextTick(() => {
            this.updateWindowDimensions();
        });
    },
    beforeUnmount() {
        clearInterval(this.interval);
        window.removeEventListener('resize', this.updateWindowDimensions);
    },
    methods: {
        startTimers() {
            clearInterval(this.interval); // Just in case
            this.interval = setInterval(() => {
                this.totalTimer++;
                this.questionTimer++;

                if (this.maxDuration !== null) {
                    this.remaining--;

                    if (this.remaining <= 0) {
                        clearInterval(this.interval);
                        this.$emit("time-up"); // ✅ emit only once!
                        return;
                    }
                }

                this.$emit(
                    "question-tick",
                    this.questionTimer,
                    this.totalTimer
                ); // Emit question time and total time
            }, 1000);
        },
        pause() {
            clearInterval(this.interval);
        },
        resume() {
            this.startTimers();
        },
        resetQuestionTimer() {
            this.questionTimer = 0;
        },
        formatTime(seconds) {
            const m = Math.floor(seconds / 60);
            const s = seconds % 60;
            // Always pad minutes with leading zero for consistent width
            return `${m < 10 ? "0" : ""}${m}:${s < 10 ? "0" : ""}${s}`;
        },
        updateWindowDimensions() {
            if (typeof window !== 'undefined') {
                this.windowWidth = window.innerWidth;
                this.windowHeight = window.innerHeight;
            }
        },
    },
};
</script>
