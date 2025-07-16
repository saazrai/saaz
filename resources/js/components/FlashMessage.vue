<script setup lang="ts">
import { ref, watch, computed } from 'vue';
import { usePage } from '@inertiajs/vue3';

const show = ref(false);
const message = ref('');
const type = ref('success');
const progress = ref(100);
const page = usePage();
let timer = null;

const errors = computed(() => page.props.errors || {});

// Check if we should show the global flash message
const shouldShowGlobalFlash = computed(() => {
    // Hide on pages that have their own inline flash message
    const currentRoute = page.url;
    const pagesWithInlineFlash = [
        '/admin/content/questions/import',
        '/admin/questions/import', // in case the route changes
        '/admin/content/courses/import',
        '/admin/courses/import' // in case the route changes
    ];
    
    return !pagesWithInlineFlash.some(path => currentRoute.includes(path));
});

const startTimer = () => {
    progress.value = 100;
    const duration = 4000;
    const interval = 50;
    const decrement = (interval / duration) * 100;

    timer = setInterval(() => {
        if (progress.value <= 0) {
            clearInterval(timer);
            show.value = false;
        } else {
            progress.value -= decrement;
        }
    }, interval);
};

const close = () => {
    show.value = false;
    clearInterval(timer);
};

watch(
    () => [page.props.flash, errors.value, shouldShowGlobalFlash.value],
    ([flash, err, shouldShow]) => {
        // Don't show if this page has its own inline flash message
        if (!shouldShow) {
            show.value = false;
            return;
        }

        const hasErrors = Object.keys(err).length > 0;

        if (hasErrors) {
            message.value = flash?.message || 'Validation failed';
            type.value = 'error';
            show.value = true;
            startTimer();
        } else if (flash?.message && flash?.status) {
            message.value = flash.message;
            type.value = flash.status;
            show.value = true;
            startTimer();
        }
    },
    { immediate: true }
);
</script>

<template>
    <transition name="fade">
        <div v-if="show" class="flash-message" :class="{
            'bg-green-600': type === 'success',
            'bg-red-600': type === 'error',
            'bg-blue-600': type === 'info',
            'bg-orange-600': type === 'warning',
        }">
            <!-- Close button -->
            <button @click="close" class="absolute top-1 right-2 text-white text-lg font-bold focus:outline-none">
                &times;
            </button>

            <!-- Icon & Message -->
            <div class="flex items-start space-x-2 pr-6">
                <div class="mt-0.5">
                    <img :src="`/images/icons/${type}.png`" alt="status icon" class="w-6 h-6 mr-2" />
                </div>
                <div class="flex-1">
                    <div v-if="message" v-html="message" class="mb-1"></div>
                    <div v-if="type === 'error' && Object.keys(errors).length" class="space-y-1">
                        <div v-for="(err, key) in errors" :key="key">{{ err }}</div>
                    </div>
                </div>
            </div>

            <!-- Progress bar -->
            <div class="toast-progress" :style="{ width: `${progress}%` }"></div>
        </div>
    </transition>
</template>

<style scoped>
.flash-message {
    position: fixed;
    top: 1.25rem;
    right: 1.25rem;
    z-index: 9999;
    padding: 0.75rem 1rem;
    border-radius: 0.5rem;
    color: white;
    box-shadow: 0 0 12px #999;
    opacity: 0.95;
    width: 300px;
    word-wrap: break-word;
    overflow: hidden;
}

.toast-progress {
    height: 4px;
    background: rgba(255, 255, 255, 0.7);
    transition: width 50ms linear;
    margin-top: 8px;
}

/* Transition animation */
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.4s ease;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}
</style>