<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import { ref, computed, onMounted } from 'vue';
import { useTheme } from '@/composables/useTheme';
import { Monitor, Moon, Sun, Check } from 'lucide-vue-next';

import { type BreadcrumbItem } from '@/types';

import AppLayout from '@/layouts/AppLayout.vue';
import SettingsLayout from '@/layouts/settings/Layout.vue';

const breadcrumbItems: BreadcrumbItem[] = [
    {
        title: 'Appearance settings',
        href: '/settings/appearance',
    },
];

const { uiPreferences, setTheme } = useTheme();
const isChanging = ref(false);

// Map the themes to match the new system
const themes = [
    {
        value: 'light' as const,
        label: 'Light',
        description: 'Clean and bright interface',
        icon: Sun,
        preview: {
            bg: 'bg-white',
            surface: 'bg-gray-50',
            text: 'text-gray-900',
            textSecondary: 'text-gray-600',
            border: 'border-gray-200',
            accent: 'bg-blue-600'
        }
    },
    {
        value: 'dark' as const,
        label: 'Dark',
        description: 'Easy on the eyes in low light',
        icon: Moon,
        preview: {
            bg: 'bg-gray-900',
            surface: 'bg-gray-800',
            text: 'text-white',
            textSecondary: 'text-gray-300',
            border: 'border-gray-700',
            accent: 'bg-blue-500'
        }
    },
];

// Current theme from the main theme system
const currentTheme = computed(() => uiPreferences.value.theme);

const handleThemeChange = async (newTheme: 'light' | 'dark') => {
    if (newTheme === currentTheme.value) return;
    
    // Save current scroll position to preserve it during theme change
    const scrollY = window.scrollY;
    
    isChanging.value = true;
    
    // Add a small delay for visual feedback
    await new Promise(resolve => setTimeout(resolve, 150));
    
    // Use the main theme system
    await setTheme(newTheme);
    
    // Restore scroll position immediately after theme change
    requestAnimationFrame(() => {
        window.scrollTo(0, scrollY);
    });
    
    // Wait for the transition to complete
    await new Promise(resolve => setTimeout(resolve, 300));
    
    // Ensure scroll position is maintained after all transitions
    requestAnimationFrame(() => {
        window.scrollTo(0, scrollY);
    });
    
    isChanging.value = false;
};

// System theme detection for preview
const systemPrefersDark = ref(false);

onMounted(() => {
    systemPrefersDark.value = window.matchMedia('(prefers-color-scheme: dark)').matches;
    
    const mediaQuery = window.matchMedia('(prefers-color-scheme: dark)');
    const handler = (e: MediaQueryListEvent) => {
        systemPrefersDark.value = e.matches;
    };
    
    mediaQuery.addEventListener('change', handler);
});

</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbItems">
        <Head title="Appearance settings" />

        <SettingsLayout>
            <!-- Theme Header -->
            <div class="mb-8">
                <div class="bg-white dark:bg-gray-900/50 backdrop-blur-xl rounded-3xl border border-gray-200 dark:border-gray-800 overflow-hidden shadow-sm dark:shadow-none transition-colors duration-300">
                    <div class="px-6 py-8 sm:px-8">
                        <div class="flex items-center space-x-4">
                            <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-pink-600 rounded-2xl flex items-center justify-center shadow-lg">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zM21 5a2 2 0 00-2-2h-4a2 2 0 00-2 2v12a4 4 0 004 4h4a2 2 0 002-2V5z"></path>
                                </svg>
                            </div>
                            <div>
                                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Appearance</h1>
                                <p class="text-gray-600 dark:text-gray-300 mt-1">Customize how the interface looks and feels</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="space-y-8">
                <!-- Theme Selection -->
                <div>
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Theme Preference</h2>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-6">Choose how you want the interface to appear.</p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div v-for="theme in themes" :key="theme.value" 
                             :class="[
                                 'relative group cursor-pointer transition-all duration-300 hover:scale-[1.02]',
                                 currentTheme === theme.value ? 'ring-2 ring-blue-500 dark:ring-blue-400' : ''
                             ]"
                             @click="handleThemeChange(theme.value)">
                            
                            <!-- Theme Preview Card -->
                            <div class="bg-white dark:bg-gray-900/50 backdrop-blur-xl rounded-2xl border border-gray-200 dark:border-gray-800 overflow-hidden shadow-sm dark:shadow-none transition-all duration-300 group-hover:shadow-lg dark:group-hover:shadow-2xl">
                                
                                <!-- Preview Window -->
                                <div class="p-4">
                                    <div :class="[
                                        'rounded-xl border overflow-hidden transition-all duration-300',
                                        theme.preview.border,
                                        'h-32 relative'
                                    ]">
                                        <!-- Preview Background -->
                                        <div :class="[
                                            'absolute inset-0 transition-all duration-300',
                                            theme.preview.bg
                                        ]"></div>
                                        
                                        <!-- Preview Content -->
                                        <div class="relative p-3 h-full">
                                            <!-- Top bar -->
                                            <div :class="[
                                                'h-1.5 rounded-full mb-2 transition-all duration-300',
                                                theme.preview.accent
                                            ]" style="width: 40%"></div>
                                            
                                            <!-- Content area -->
                                            <div :class="[
                                                'rounded-lg p-2 mb-2 transition-all duration-300',
                                                theme.preview.surface
                                            ]">
                                                <div :class="[
                                                    'h-1 rounded mb-1 transition-all duration-300',
                                                    theme.preview.text,
                                                    'opacity-80'
                                                ]" style="width: 70%"></div>
                                                <div :class="[
                                                    'h-1 rounded transition-all duration-300',
                                                    theme.preview.textSecondary,
                                                    'opacity-60'
                                                ]" style="width: 50%"></div>
                                            </div>
                                            
                                            <!-- Bottom elements -->
                                            <div class="flex space-x-1">
                                                <div :class="[
                                                    'h-3 w-8 rounded transition-all duration-300',
                                                    theme.preview.surface
                                                ]"></div>
                                                <div :class="[
                                                    'h-3 w-6 rounded transition-all duration-300',
                                                    theme.preview.surface
                                                ]"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Selection Indicator -->
                                <div v-if="currentTheme === theme.value" 
                                     class="absolute top-4 right-4 w-6 h-6 bg-blue-600 dark:bg-blue-500 rounded-full flex items-center justify-center shadow-md transition-all duration-300">
                                    <Check class="w-4 h-4 text-white" />
                                </div>

                                <!-- Loading Overlay -->
                                <div v-if="isChanging && currentTheme === theme.value" 
                                     class="absolute inset-0 bg-black/5 dark:bg-white/5 backdrop-blur-sm flex items-center justify-center transition-all duration-300">
                                    <div class="w-6 h-6 border-2 border-blue-500 border-t-transparent rounded-full animate-spin"></div>
                                </div>

                                <!-- Theme Info -->
                                <div class="p-4 pt-0">
                                    <div class="flex items-center space-x-3 mb-2">
                                        <div :class="[
                                            'w-8 h-8 rounded-lg flex items-center justify-center transition-all duration-300',
                                            currentTheme === theme.value 
                                                ? 'bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400' 
                                                : 'bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-400'
                                        ]">
                                            <component :is="theme.icon" class="w-4 h-4" />
                                        </div>
                                        <div>
                                            <h3 :class="[
                                                'font-semibold transition-colors duration-300',
                                                currentTheme === theme.value 
                                                    ? 'text-blue-600 dark:text-blue-400' 
                                                    : 'text-gray-900 dark:text-white'
                                            ]">{{ theme.label }}</h3>
                                        </div>
                                    </div>
                                    <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed">
                                        {{ theme.description }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Current Selection Display -->
                    <div class="mt-6 p-4 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-xl">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-blue-600 dark:bg-blue-500 rounded-lg flex items-center justify-center">
                                <component :is="themes.find(t => t.value === currentTheme)?.icon" class="w-4 h-4 text-white" />
                            </div>
                            <div>
                                <p class="text-sm font-medium text-blue-900 dark:text-blue-100">
                                    Currently using <strong>{{ themes.find(t => t.value === currentTheme)?.label }}</strong> theme
                                </p>
                                <p class="text-xs text-blue-700 dark:text-blue-300">
                                    {{ themes.find(t => t.value === currentTheme)?.description }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- System Theme Notice -->
                <div>
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">System Integration</h2>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-6">Theme preferences are synchronized across the application.</p>
                    
                    <div class="bg-white dark:bg-gray-900/50 backdrop-blur-xl rounded-2xl border border-gray-200 dark:border-gray-800 overflow-hidden shadow-sm dark:shadow-none transition-colors duration-300">
                        <div class="p-6 sm:p-8">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Auto-sync -->
                                <div class="flex items-center justify-between p-4 bg-green-50 dark:bg-green-900/20 rounded-xl border border-green-200 dark:border-green-800">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-8 h-8 bg-green-100 dark:bg-green-900/30 rounded-lg flex items-center justify-center">
                                            <svg class="w-4 h-4 text-green-600 dark:text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                        <div>
                                            <h3 class="font-medium text-green-900 dark:text-green-100">Auto Sync</h3>
                                            <p class="text-sm text-green-700 dark:text-green-300 mt-0.5">Changes apply instantly across all pages</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Future: System Theme -->
                                <div class="flex items-center justify-between p-4 bg-gray-50 dark:bg-gray-800/50 rounded-xl border border-gray-200 dark:border-gray-700">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-8 h-8 bg-gray-100 dark:bg-gray-700 rounded-lg flex items-center justify-center">
                                            <Monitor class="w-4 h-4 text-gray-600 dark:text-gray-400" />
                                        </div>
                                        <div>
                                            <h3 class="font-medium text-gray-900 dark:text-white">System Theme</h3>
                                            <p class="text-sm text-gray-600 dark:text-gray-400 mt-0.5">Auto-adapt to device preferences</p>
                                        </div>
                                    </div>
                                    <span class="text-sm text-gray-500 dark:text-gray-400">Coming soon</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </SettingsLayout>
    </AppLayout>
</template>
