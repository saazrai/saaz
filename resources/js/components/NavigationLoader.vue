<template>
    <Transition
        enter-active-class="transition-opacity duration-300"
        enter-from-class="opacity-0"
        enter-to-class="opacity-100"
        leave-active-class="transition-opacity duration-300"
        leave-from-class="opacity-100"
        leave-to-class="opacity-0"
    >
        <div v-if="isNavigating" class="fixed inset-0 z-50 flex items-center justify-center bg-white/80 dark:bg-gray-900/80 backdrop-blur-sm">
            <div class="text-center">
                <svg class="animate-spin h-12 w-12 text-blue-600 dark:text-blue-400 mx-auto mb-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <p class="text-gray-600 dark:text-gray-400">Loading study content...</p>
            </div>
        </div>
    </Transition>
</template>

<script setup lang="ts">
import { ref, onMounted, onUnmounted } from 'vue';
import { router } from '@inertiajs/vue3';

const isNavigating = ref(false);
let navigationTimeout = null;

onMounted(() => {
    // Show loader when navigation starts
    router.on('start', () => {
        // Only show loader if navigation takes more than 300ms
        navigationTimeout = setTimeout(() => {
            isNavigating.value = true;
        }, 300);
    });
    
    // Hide loader when navigation finishes
    router.on('finish', () => {
        if (navigationTimeout) {
            clearTimeout(navigationTimeout);
        }
        isNavigating.value = false;
    });
});

onUnmounted(() => {
    if (navigationTimeout) {
        clearTimeout(navigationTimeout);
    }
});
</script>