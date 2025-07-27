<script setup lang="ts">
import { type NavItem } from '@/types';
import { Link, usePage } from '@inertiajs/vue3';
import { inject, provide, ref } from 'vue';

const sidebarNavItems: NavItem[] = [
    {
        title: 'Profile',
        href: '/settings/profile',
        icon: '👤',
        description: 'Personal information'
    },
    {
        title: 'Password', 
        href: '/settings/password',
        icon: '🔐',
        description: 'Security settings'
    },
    {
        title: 'Appearance',
        href: '/settings/appearance', 
        icon: '🎨',
        description: 'Theme preferences'
    },
];

const page = usePage();
const showMobileMenu = ref(false);

// Get dark mode state from AppLayout
const isDark = inject('isDark', false);

// Provide dark mode state to child components
provide('isDark', isDark);

const currentPath = page.props.ziggy?.location ? new URL(page.props.ziggy.location).pathname : '';
</script>

<template>
    <!-- Mobile menu overlay -->
    <div v-if="showMobileMenu" 
         class="fixed inset-0 z-50 lg:hidden"
         @click="showMobileMenu = false">
        <div class="fixed inset-0 bg-black/25 backdrop-blur-sm transition-opacity duration-300"></div>
        <div class="fixed inset-y-0 left-0 w-64 bg-white dark:bg-gray-900 shadow-xl transform transition-transform duration-300">
            <div class="p-6">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Settings</h2>
                <nav class="space-y-1">
                    <Link v-for="item in sidebarNavItems"
                          :key="item.href"
                          :href="item.href"
                          @click="showMobileMenu = false"
                          :class="[
                              'flex items-center space-x-3 px-3 py-2 rounded-xl text-sm font-medium transition-colors duration-200',
                              currentPath === item.href
                                  ? 'bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400'
                                  : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800'
                          ]">
                        <span class="text-lg">{{ item.icon }}</span>
                        <div>
                            <div class="text-sm font-medium">{{ item.title }}</div>
                            <div class="text-xs text-gray-500 dark:text-gray-400">{{ item.description }}</div>
                        </div>
                    </Link>
                </nav>
            </div>
        </div>
    </div>

    <div :class="['min-h-screen transition-colors duration-300', isDark ? 'bg-gray-950' : 'bg-gray-50']">
        <!-- Header -->
        <div :class="[
            'sticky top-0 z-40 backdrop-blur-xl border-b transition-colors duration-300',
            isDark 
                ? 'bg-gray-950/80 border-gray-800' 
                : 'bg-white/80 border-gray-200'
        ]">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-16">
                    <!-- Mobile menu button -->
                    <button @click="showMobileMenu = true"
                            class="lg:hidden p-2 rounded-lg text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>

                    <!-- Desktop title -->
                    <div class="hidden lg:block">
                        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Settings</h1>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Manage your profile and account settings</p>
                    </div>

                    <!-- Mobile title -->
                    <div class="lg:hidden">
                        <h1 class="text-lg font-semibold text-gray-900 dark:text-white">Settings</h1>
                    </div>

                    <div class="w-10 lg:w-0"></div> <!-- Spacer for mobile centering -->
                </div>
            </div>
        </div>

        <!-- Main content -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="lg:grid lg:grid-cols-12 lg:gap-x-8">
                <!-- Desktop sidebar -->
                <aside class="hidden lg:block lg:col-span-4 xl:col-span-3">
                    <div :class="[
                        'sticky top-24 space-y-1 p-1 rounded-2xl border transition-colors duration-300',
                        isDark 
                            ? 'bg-gray-900/50 border-gray-800 backdrop-blur-xl' 
                            : 'bg-white/80 border-gray-200 backdrop-blur-xl shadow-sm'
                    ]">
                        <Link v-for="item in sidebarNavItems"
                              :key="item.href"
                              :href="item.href"
                              :class="[
                                  'flex items-center space-x-3 px-4 py-3 rounded-xl text-sm font-medium transition-all duration-200 group',
                                  currentPath === item.href
                                      ? (isDark 
                                          ? 'bg-blue-600/20 text-blue-400 shadow-lg shadow-blue-600/10' 
                                          : 'bg-blue-50 text-blue-600 shadow-md shadow-blue-600/5')
                                      : (isDark 
                                          ? 'text-gray-300 hover:bg-gray-800/50 hover:text-white' 
                                          : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900')
                              ]">
                            <span :class="[
                                'text-xl transition-transform duration-200 group-hover:scale-110',
                                currentPath === item.href ? 'scale-110' : ''
                            ]">{{ item.icon }}</span>
                            <div class="flex-1 min-w-0">
                                <div class="font-medium leading-tight">{{ item.title }}</div>
                                <div :class="[
                                    'text-xs leading-tight transition-colors duration-200',
                                    currentPath === item.href
                                        ? (isDark ? 'text-blue-300' : 'text-blue-500')
                                        : 'text-gray-500 dark:text-gray-400'
                                ]">{{ item.description }}</div>
                            </div>
                        </Link>
                    </div>
                </aside>

                <!-- Main content area -->
                <main class="lg:col-span-8 xl:col-span-9">
                    <div class="max-w-4xl">
                        <slot />
                    </div>
                </main>
            </div>
        </div>
    </div>
</template>
