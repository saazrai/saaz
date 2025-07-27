<script setup lang="ts">
import { useAppearance } from '@/composables/useAppearance';
import { Monitor, Moon, Sun } from 'lucide-vue-next';
import { inject } from 'vue';

const { appearance, updateAppearance } = useAppearance();

// Get dark mode state from AppLayout
const isDark = inject('isDark', false);

const tabs = [
    { value: 'light', Icon: Sun, label: 'Light' },
    { value: 'dark', Icon: Moon, label: 'Dark' },
    { value: 'system', Icon: Monitor, label: 'System' },
] as const;
</script>

<template>
    <div :class="[
        'inline-flex gap-1 rounded-lg p-1 transition-colors duration-300',
        isDark ? 'bg-gray-800' : 'bg-gray-100'
    ]">
        <button
            v-for="{ value, Icon, label } in tabs"
            :key="value"
            @click="updateAppearance(value)"
            :class="[
                'flex items-center rounded-md px-3.5 py-1.5 transition-colors duration-300',
                appearance === value
                    ? (isDark ? 'bg-gray-700 text-gray-100 shadow-xs' : 'bg-white text-gray-900 shadow-xs')
                    : (isDark 
                        ? 'text-gray-400 hover:bg-gray-700/60 hover:text-gray-200' 
                        : 'text-gray-500 hover:bg-gray-200/60 hover:text-gray-900'
                    )
            ]"
        >
            <component :is="Icon" :class="[
                '-ml-1 h-4 w-4 transition-colors duration-300',
                appearance === value
                    ? (isDark ? 'text-gray-100' : 'text-gray-900')
                    : (isDark ? 'text-gray-400' : 'text-gray-500')
            ]" />
            <span :class="[
                'ml-1.5 text-sm transition-colors duration-300',
                appearance === value
                    ? (isDark ? 'text-gray-100' : 'text-gray-900')
                    : (isDark ? 'text-gray-400' : 'text-gray-500')
            ]">{{ label }}</span>
        </button>
    </div>
</template>
