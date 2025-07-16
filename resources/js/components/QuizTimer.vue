<template>
    <div class="timer w-full">
        <div
            class="flex flex-wrap justify-between items-center gap-x-6 gap-y-1 w-full text-gray-800 dark:text-gray-200"
        >
            <div class="flex items-center">
                <span class="text-gray-700 dark:text-gray-300">Question Time:</span>
                <span class="ml-1 font-bold text-gray-900 dark:text-white">{{
                    formatTime(questionTimer)
                }}</span>
            </div>
            <div class="flex items-center">
                <span class="text-gray-700 dark:text-gray-300">Total Time:</span>
                <span class="ml-1 font-bold text-gray-900 dark:text-white">{{
                    formatTime(totalTimer)
                }}</span>
            </div>
            <div
                v-if="maxDuration"
                class="flex items-center text-red-600 dark:text-red-400 font-semibold"
            >
                <span>Time Remaining:</span>
                <span class="ml-1 font-bold">{{ formatTime(remaining) }}</span>
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
<style>
.timer {
    display: flex;
    justify-content: space-between;
}
</style>
