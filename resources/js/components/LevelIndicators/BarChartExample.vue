<template>
    <div class="p-8 space-y-8">
        <h2 class="text-2xl font-bold mb-4">BarChartLevelIndicator Examples</h2>
        
        <!-- Example 1: Basic usage -->
        <div>
            <h3 class="text-lg font-semibold mb-2">Basic Usage (3 of 5 filled)</h3>
            <BarChartLevelIndicator 
                :total-bars="5" 
                :filled-bars="3"
                container-class="flex items-center"
            />
        </div>

        <!-- Example 2: Custom colors -->
        <div>
            <h3 class="text-lg font-semibold mb-2">Custom Colors (7 of 10 filled)</h3>
            <BarChartLevelIndicator 
                :total-bars="10" 
                :filled-bars="7"
                container-class="flex items-center"
                active-color="bg-blue-600"
                inactive-color="bg-blue-200 dark:bg-blue-900"
            />
        </div>

        <!-- Example 3: Different dimensions -->
        <div>
            <h3 class="text-lg font-semibold mb-2">Larger Bars (4 of 6 filled)</h3>
            <BarChartLevelIndicator 
                :total-bars="6" 
                :filled-bars="4"
                container-class="flex items-center"
                :base-height="20"
                :height-increment="10"
                bar-width="w-4"
            />
        </div>

        <!-- Example 4: Progress indicator -->
        <div>
            <h3 class="text-lg font-semibold mb-2">Progress Indicator ({{ progress }} of 8)</h3>
            <BarChartLevelIndicator 
                :total-bars="8" 
                :filled-bars="progress"
                container-class="flex items-center"
                active-color="bg-purple-500"
            />
            <button 
                @click="progress = Math.min(progress + 1, 8)"
                class="mt-2 px-4 py-2 bg-purple-500 text-white rounded-md hover:bg-purple-600"
            >
                Increase Progress
            </button>
            <button 
                @click="progress = Math.max(progress - 1, 0)"
                class="mt-2 ml-2 px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600"
            >
                Decrease Progress
            </button>
        </div>

        <!-- Example 5: Rating system -->
        <div>
            <h3 class="text-lg font-semibold mb-2">Rating System ({{ rating }} stars)</h3>
            <BarChartLevelIndicator 
                :total-bars="5" 
                :filled-bars="rating"
                container-class="flex items-center"
                active-color="bg-yellow-400"
                inactive-color="bg-gray-300"
                :base-height="24"
                :height-increment="0"
                bar-width="w-6"
            />
            <div class="mt-2 space-x-2">
                <button 
                    v-for="i in 5"
                    :key="i"
                    @click="rating = i"
                    class="px-3 py-1 bg-gray-200 hover:bg-gray-300 rounded"
                >
                    {{ i }}
                </button>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import { ref } from 'vue';
import BarChartLevelIndicator from './BarChartLevelIndicator.vue';

const progress = ref(3);
const rating = ref(4);
</script>