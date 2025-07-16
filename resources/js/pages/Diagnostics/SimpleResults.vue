<template>
    <AppLayout title="Diagnostic Results">
        <div class="min-h-screen flex items-center justify-center bg-white dark:bg-gray-900">
            <div class="text-center px-4 max-w-2xl mx-auto">
                <!-- Date and Time -->
                <div class="text-gray-500 dark:text-gray-400 text-sm mb-8">
                    {{ formattedDate }}
                </div>
                
                <!-- Main Score Display -->
                <div class="mb-8">
                    <h1 class="text-4xl font-bold text-gray-900 dark:text-gray-100 mb-12">
                        Diagnostic Results
                    </h1>
                    
                    <div class="text-8xl font-bold text-gray-900 dark:text-gray-100 mb-4">
                        {{ score.toFixed(2) }}%
                    </div>
                    
                    <p class="text-xl text-gray-600 dark:text-gray-400 mb-2">
                        {{ performanceLevel }}
                    </p>
                    
                    <p class="text-gray-500 dark:text-gray-500 text-sm">
                        Diagnostic Results
                    </p>
                </div>
                
                <!-- Score Circle -->
                <div class="flex justify-center mb-12">
                    <div class="relative">
                        <svg class="w-80 h-80 transform -rotate-90">
                            <circle
                                cx="160"
                                cy="160"
                                r="150"
                                stroke="currentColor"
                                stroke-width="20"
                                fill="none"
                                class="text-gray-200 dark:text-gray-700"
                            />
                            <circle
                                cx="160"
                                cy="160"
                                r="150"
                                stroke="currentColor"
                                stroke-width="20"
                                fill="none"
                                :stroke-dasharray="`${2 * Math.PI * 150} ${2 * Math.PI * 150}`"
                                :stroke-dashoffset="`${2 * Math.PI * 150 - (score / 100) * 2 * Math.PI * 150}`"
                                :class="getScoreStrokeClass(score)"
                                class="transition-all duration-1000 ease-out"
                            />
                        </svg>
                        <div class="absolute inset-0 flex flex-col items-center justify-center">
                            <span class="text-7xl font-bold text-gray-900 dark:text-gray-100">{{ score.toFixed(2) }}</span>
                            <span class="text-lg text-gray-500 dark:text-gray-400 mt-2">{{ performanceLevel }}</span>
                        </div>
                    </div>
                </div>
                
                <!-- Primary CTA -->
                <div v-if="diagnostic.current_phase && diagnostic.current_phase < 4" class="mb-8">
                    <Link 
                        :href="typeof route !== 'undefined' ? route('assessments.diagnostics.continue', diagnostic.id) : `/assessments/diagnostics/${diagnostic.id}/continue`"
                        class="inline-flex items-center px-10 py-5 bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-lg rounded-xl shadow-lg transition-all duration-200 transform hover:scale-105"
                    >
                        <RocketIcon class="w-7 h-7 mr-3" />
                        Continue to Phase {{ diagnostic.current_phase + 1 }}
                    </Link>
                </div>
                
                <!-- Secondary Actions -->
                <div class="flex flex-wrap gap-4 justify-center">
                    <Link 
                        :href="typeof route !== 'undefined' ? route('assessments.diagnostics.report', diagnostic.id) : `/assessments/diagnostics/${diagnostic.id}/report`"
                        class="inline-flex items-center px-6 py-3 bg-gray-100 hover:bg-gray-200 dark:bg-gray-800 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300 font-semibold rounded-lg transition-colors"
                    >
                        <FileTextIcon class="w-5 h-5 mr-2" />
                        View Detailed Report
                    </Link>
                    <Link 
                        :href="typeof route !== 'undefined' ? route('assessments.diagnostics.index') : '/assessments/diagnostics'"
                        class="inline-flex items-center px-6 py-3 bg-gray-100 hover:bg-gray-200 dark:bg-gray-800 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300 font-semibold rounded-lg transition-colors"
                    >
                        <HomeIcon class="w-5 h-5 mr-2" />
                        Back to Diagnostics
                    </Link>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { computed } from 'vue';
import AppLayout from "@/layouts/AppLayout.vue";
import { FileTextIcon, HomeIcon, RocketIcon } from 'lucide-vue-next';

const props = defineProps({
    diagnostic: Object,
    score: Number,
});

// Computed properties
const performanceLevel = computed(() => {
    if (props.score >= 90) return 'Exceptional';
    if (props.score >= 80) return 'Excellent';
    if (props.score >= 70) return 'Good';
    if (props.score >= 60) return 'Satisfactory';
    return 'Keep practicing!';
});

const formattedDate = computed(() => {
    const date = new Date();
    const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
    const month = months[date.getMonth()];
    const day = date.getDate();
    const year = date.getFullYear();
    const _hours = date.getHours().toString().padStart(2, '0');
    const minutes = date.getMinutes().toString().padStart(2, '0');
    const period = date.getHours() >= 12 ? 'PM' : 'AM';
    const displayHours = date.getHours() % 12 || 12;
    
    return `${month} ${day}, ${year}, ${displayHours}:${minutes} ${period}`;
});

const getScoreStrokeClass = (score) => {
    if (score >= 80) return 'text-green-500';
    if (score >= 60) return 'text-blue-500';
    if (score >= 40) return 'text-yellow-500';
    return 'text-red-500';
};
</script>

<style scoped>
/* Smooth animation for the score circle */
circle {
    transition: stroke-dashoffset 1.5s ease-out;
}
</style>