<script setup lang="ts">
import { inject } from 'vue';

interface Props {
    title: string;
    description?: string;
}

defineProps<Props>();

// Get dark mode state from AppLayout
const isDark = inject('isDark', false);
</script>

<template>
    <div class="mb-8 space-y-0.5">
        <h2 :class="[
            'text-xl font-semibold tracking-tight transition-colors duration-300',
            isDark ? 'text-white' : 'text-gray-900'
        ]">{{ title }}</h2>
        <p v-if="description" :class="[
            'text-sm transition-colors duration-300',
            isDark ? 'text-gray-400' : 'text-gray-600'
        ]">
            {{ description }}
        </p>
    </div>
</template>
