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
    <header>
        <h3 :class="[
            'mb-0.5 text-base font-medium transition-colors duration-300',
            isDark ? 'text-white' : 'text-gray-900'
        ]">{{ title }}</h3>
        <p v-if="description" :class="[
            'text-sm transition-colors duration-300',
            isDark ? 'text-gray-400' : 'text-gray-600'
        ]">
            {{ description }}
        </p>
    </header>
</template>
