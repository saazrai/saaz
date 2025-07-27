<template>
    <div class="quiz-timer w-full">
        <!-- Compact Mode: Mobile minimal format -->
        <div v-if="compact">
            {{ formatTime(questionTimer) }} / {{ formatTime(totalTimer) }}
        </div>
        
        <!-- Full Mode: Desktop detailed format -->
        <div
            v-else
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
    </div>
</template>

<script lang="ts">
export default {
    props: {
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
        isDark: {
            type: Boolean,
            default: false,
        },
        compact: {
            type: Boolean,
            default: false, // Enable minimal mobile format
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
        };
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
    },
    beforeUnmount() {
        clearInterval(this.interval);
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
            return `${m}:${s < 10 ? "0" : ""}${s}`;
        },
    },
};
</script>
