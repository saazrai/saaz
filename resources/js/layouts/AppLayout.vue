<script setup lang="ts">
import { ref, computed, onMounted, onBeforeUnmount, watch, watchEffect, provide } from 'vue'
import { Link, usePage } from '@inertiajs/vue3'
import Dropdown from '@/components/Dropdown.vue'
import { safeRoute } from '@/utils/route-helper'
import { useTheme } from '@/composables/useTheme'
import CookieConsentBanner from '@/components/CookieConsentBanner.vue'
import NavigationLoader from '@/components/NavigationLoader.vue'

const page = usePage()
const user = computed(() => page.props.auth?.user)
const showMobileMenu = ref(false)
const isMobile = ref(false)

// Theme management
const { toggleTheme, initializeTheme } = useTheme()

// Create a reactive dark mode state based on DOM
const isDark = ref(document.documentElement.classList.contains('dark'))

// Watch for DOM changes
const observeThemeChanges = () => {
    const observer = new MutationObserver(() => {
        isDark.value = document.documentElement.classList.contains('dark')
    })
    
    observer.observe(document.documentElement, {
        attributes: true,
        attributeFilter: ['class']
    })
    
    return observer
}

// Provide dark mode state to child components
provide('isDark', isDark)

// Direct theme toggle that always works
const directThemeToggle = () => {
    const html = document.documentElement
    const currentIsDark = html.classList.contains('dark')
    
    if (currentIsDark) {
        html.classList.remove('dark')
        html.setAttribute('data-theme', 'light')
        localStorage.setItem('theme', 'light')
    } else {
        html.classList.add('dark')
        html.setAttribute('data-theme', 'dark')
        localStorage.setItem('theme', 'dark')
    }
    
    // Try to sync with the composable
    try {
        toggleTheme()
    } catch (e) {
        console.error('Theme sync failed:', e)
    }
}


const toggleMobileMenu = () => {
    showMobileMenu.value = !showMobileMenu.value;
}

const updateScreen = () => {
    isMobile.value = window.innerWidth < 1024
}

let themeObserver: MutationObserver | null = null

onMounted(async () => {
    updateScreen()
    window.addEventListener('resize', updateScreen)
    
    // Initialize theme
    await initializeTheme()
    
    // Start observing theme changes
    themeObserver = observeThemeChanges()
    
    // Update initial state
    isDark.value = document.documentElement.classList.contains('dark')
})

onBeforeUnmount(() => {
    window.removeEventListener('resize', updateScreen)
    if (themeObserver) {
        themeObserver.disconnect()
    }
})

// Watch for user changes (login/logout)
watch(user, (newUser, oldUser) => {
    // V1 Enhanced doesn't need complex WebSocket handling
    if (newUser && !oldUser) {
        console.log('User logged in')
    } else if (!newUser && oldUser) {
        console.log('User logged out')
    }
})

watchEffect(() => {
    if (showMobileMenu.value && isMobile.value) {
        document.body.style.overflow = 'hidden';
    } else {
        document.body.style.overflow = '';
    }
})
</script>

<template>
    <div :class="['min-h-screen transition-colors duration-300', isDark ? 'bg-gray-900' : 'bg-[#efefef]']">
        <!-- Navbar -->
        <nav class="fixed top-4 z-navbar w-full lg:top-6 z-[9999]">
            <div class="container box-border !max-w-[1672px] !px-6 md:!px-9">
                <div :class="[
                    'relative flex h-[var(--navbar-height)] w-full items-center justify-between rounded-lg border px-2 py-1.5 transition-all duration-300 motion-reduce:transition-none lg:grid lg:grid-cols-[1fr_auto_1fr] lg:rounded-2xl lg:py-[0.4375rem] lg:pr-[0.4375rem] shadow-md',
                    isDark 
                        ? 'bg-gray-800 border-gray-700' 
                        : 'bg-white border-gray-200'
                ]">
                    <Link aria-label="Homepage" class="relative flex w-fit items-center gap-0.5 overflow-hidden lg:px-3" :href="user ? route('dashboard') : route('home')">
                        <img src="/images/logo.png" alt="Saaz Academy" :class="['h-10 transition-all duration-300', isDark ? 'brightness-0 invert' : '']">
                    </Link>
                    <ul :class="[
                        'col-start-2 gap-5 px-2 font-medium xl:gap-6 hidden lg:flex items-center',
                        isDark ? 'text-gray-200' : 'text-brand-neutrals-700'
                    ]">
                        <!-- V1 Enhanced Navigation - Diagnostics Focus -->
                        <li><a :class="[
                            'transition-colors duration-300 p-2 rounded-md motion-reduce:transition-none',
                            isDark 
                                ? 'hover:text-white hover:bg-gray-700' 
                                : 'hover:text-brand-foreground hover:bg-brand-neutrals-100'
                        ]" :href="route('assessments.diagnostics.index')">SecureStart™</a></li>
                    </ul>
                    <div class="col-start-3 hidden w-full justify-end gap-2 lg:flex items-center">
                        <!-- Dark Mode Toggle -->
                        <button
                            @click="directThemeToggle"
                            :class="[
                                'p-2 rounded-lg transition-all duration-300 mr-2',
                                isDark 
                                    ? 'bg-gray-700 hover:bg-gray-600 text-yellow-400' 
                                    : 'bg-gray-200 hover:bg-gray-300 text-gray-900'
                            ]"
                            :title="isDark ? 'Switch to light mode' : 'Switch to dark mode'"
                        >
                            <svg v-if="isDark" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" clip-rule="evenodd"/>
                            </svg>
                            <svg v-else xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                            </svg>
                        </button>
                        <div v-if="user" class="relative">
                            <Dropdown align="right" :contentClasses="`py-0 ${isDark ? 'bg-gray-800' : 'bg-white'} rounded-xl shadow-lg min-w-[220px] max-w-[90vw] z-50`" ref="userDropdown" width="auto">
                                <template #trigger>
                                    <button type="button" :class="[
                                        'inline-flex items-center justify-center w-12 h-12 rounded-xl focus:outline-none transition-colors duration-300',
                                        isDark 
                                            ? 'bg-gray-700 hover:bg-gray-600' 
                                            : 'bg-white hover:border hover:bg-gray-100'
                                    ]">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" :class="['w-8 h-8', isDark ? 'text-gray-300' : 'text-gray-700']">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9A3.75 3.75 0 1 1 8.25 9a3.75 3.75 0 0 1 7.5 0ZM4.5 19.5a7.5 7.5 0 0 1 15 0v.75a.75.75 0 0 1-.75.75h-13.5a.75.75 0 0 1-.75-.75v-.75Z" />
                                        </svg>
                                    </button>
                                </template>
                                <template #content>
                                    <div :class="['px-6 py-4', isDark ? 'border-b border-gray-700' : 'border-b']">
                                        <div :class="['font-semibold text-base uppercase', isDark ? 'text-gray-100' : 'text-gray-900']">{{ user.name }}</div>
                                        <div :class="['text-sm whitespace-nowrap', isDark ? 'text-gray-400' : 'text-gray-600']">{{ user.email }}</div>
                                    </div>
                                    <div class="py-2">
                                        <!-- V1 Enhanced User Menu -->
                                        <Link :href="safeRoute('assessments.diagnostics.all-results', '/diagnostics/results')" :class="['block px-6 py-3 text-base font-semibold whitespace-nowrap', isDark ? 'text-gray-100 hover:bg-gray-700' : 'text-gray-900 hover:bg-gray-100']">
                                            Diagnostic Results
                                        </Link>
                                        
                                        <!-- Admin Access (only show for admin/super-admin users) -->
                                        <Link v-if="$page.props.auth.roles && ($page.props.auth.roles.includes('admin') || $page.props.auth.roles.includes('super-admin'))" 
                                              :href="route('admin.audits.index')" 
                                              :class="['block px-6 py-3 text-base font-semibold whitespace-nowrap flex items-center', isDark ? 'text-red-400 hover:bg-red-900/30' : 'text-red-600 hover:bg-red-50']">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                                            </svg>
                                            Admin Panel
                                        </Link>
                                        
                                        <Link :href="route('settings.profile')" :class="['block px-6 py-3 text-base font-semibold whitespace-nowrap', isDark ? 'text-gray-100 hover:bg-gray-700' : 'text-gray-900 hover:bg-gray-100']">
                                            Profile Settings
                                        </Link>
                                        
                                        <Link :href="route('privacy.settings')" :class="['block px-6 py-3 text-base font-semibold whitespace-nowrap', isDark ? 'text-gray-100 hover:bg-gray-700' : 'text-gray-900 hover:bg-gray-100']">
                                            Privacy Settings
                                        </Link>
                                        
                                        <Link :href="route('logout')" method="post" as="button" :class="['block w-full text-left px-6 py-3 text-base font-semibold flex items-center justify-between whitespace-nowrap', isDark ? 'text-gray-100 hover:bg-gray-700' : 'text-gray-900 hover:bg-gray-100']">
                                            Log Out
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7" />
                                            </svg>
                                        </Link>
                                    </div>
                                </template>
                            </Dropdown>
                        </div>
                        <template v-else>
                            <Link :href="route('login')"
                                :class="[
                                    'inline-block px-6 py-2 border-2 font-semibold rounded-lg transition focus:outline-none focus:ring-2 focus:ring-offset-2 mr-2',
                                    isDark 
                                        ? 'bg-gray-700 border-gray-600 text-gray-100 hover:bg-gray-600 hover:text-white focus:ring-gray-500' 
                                        : 'bg-white border-gray-300 text-gray-600 hover:bg-gray-600 hover:text-white focus:ring-gray-400'
                                ]">
                                Sign In
                            </Link>
                            <Link :href="route('register')"
                                :class="[
                                    'inline-block px-6 py-2 border-2 font-semibold rounded-lg transition focus:outline-none focus:ring-2 focus:ring-offset-2',
                                    isDark 
                                        ? 'bg-gray-800 border-gray-600 text-gray-100 hover:bg-gray-700 hover:text-white focus:ring-gray-500' 
                                        : 'bg-black border-gray-300 text-gray-100 hover:bg-gray-100 hover:border-gray-600 hover:text-gray-600 focus:ring-gray-400'
                                ]">
                                Sign Up
                            </Link>
                        </template>
                    </div>
                    <!-- Mobile right-side icons -->
                    <div v-if="isMobile" class="flex items-center ml-auto gap-2">
                        <!-- Theme Toggle Button (visible on mobile) -->
                        <button
                            @click="directThemeToggle"
                            :class="[
                                'flex items-center justify-center w-12 h-12 rounded-xl focus:outline-none transition-colors duration-300',
                                isDark 
                                    ? 'bg-gray-700 hover:bg-gray-600 text-yellow-400' 
                                    : 'bg-white hover:border hover:bg-gray-100 text-gray-900'
                            ]"
                            :title="isDark ? 'Switch to light mode' : 'Switch to dark mode'"
                            aria-label="Toggle theme"
                        >
                            <svg v-if="isDark" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" clip-rule="evenodd"/>
                            </svg>
                            <svg v-else xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                            </svg>
                        </button>
                        <!-- General mobile menu button (always visible on mobile) -->
                        <button
                            @click="toggleMobileMenu"
                            :class="[
                                'lg:hidden flex items-center justify-center w-12 h-12 rounded-xl focus:outline-none transition-colors duration-300',
                                isDark 
                                    ? 'bg-gray-700 hover:bg-gray-600 text-gray-300' 
                                    : 'bg-white hover:border hover:bg-gray-100 text-gray-700'
                            ]"
                            aria-label="Open menu"
                        >
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>
                        <button
                            v-if="user"
                            @click="toggleMobileMenu"
                            :class="[
                                'lg:hidden flex items-center justify-center w-12 h-12 rounded-xl focus:outline-none transition-colors duration-300',
                                isDark 
                                    ? 'bg-gray-700 hover:bg-gray-600' 
                                    : 'bg-white hover:border hover:bg-gray-100'
                            ]"
                            aria-label="Open user menu"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" :class="['w-8 h-8', isDark ? 'text-gray-300' : 'text-gray-700']">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9A3.75 3.75 0 1 1 8.25 9a3.75 3.75 0 0 1 7.5 0ZM4.5 19.5a7.5 7.5 0 0 1 15 0v.75a.75.75 0 0 1-.75.75h-13.5a.75.75 0 0 1-.75-.75v-.75Z" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </nav>
        
        <!-- Mobile scrollable menu -->
        <div v-if="showMobileMenu && isMobile" :class="[
            'fixed top-24 left-0 w-full z-[9999] px-4 py-2 shadow-lg max-h-[calc(100vh-6rem)] overflow-y-auto',
            isDark 
                ? 'bg-gray-800 border-b border-gray-700' 
                : 'bg-white border-b border-gray-200'
        ]">
            <!-- Close (X) button -->
            <button @click="showMobileMenu = false" :class="['absolute top-4 right-4 focus:outline-none', isDark ? 'text-gray-400 hover:text-white' : 'text-gray-700 hover:text-black']" aria-label="Close menu">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
            
            <!-- Mobile menu items - V1 Enhanced only -->
            <Link :href="route('assessments.diagnostics.index')" :class="['block py-2 font-semibold', isDark ? 'text-gray-300' : 'text-gray-700']" @click="showMobileMenu = false">SecureStart™</Link>
            
            <!-- User menu items (if authenticated) -->
            <template v-if="user">
                <div :class="['my-2', isDark ? 'border-t border-gray-700' : 'border-t']"></div>
                <div class="px-2 py-2">
                    <div :class="['font-semibold text-base mb-1 uppercase', isDark ? 'text-gray-100' : 'text-gray-900']">{{ user.name }}</div>
                    <div :class="['text-sm mb-2', isDark ? 'text-gray-400' : 'text-gray-600']">{{ user.email }}</div>
                </div>
                <Link :href="safeRoute('assessments.diagnostics.all-results', '/diagnostics/results')" :class="['block py-2 font-semibold', isDark ? 'text-gray-300' : 'text-gray-700']" @click="showMobileMenu = false">SecureStart™ Results</Link>
                
                <!-- Admin Access (only show for admin/super-admin users) -->
                <Link v-if="$page.props.auth.roles && ($page.props.auth.roles.includes('admin') || $page.props.auth.roles.includes('super-admin'))" 
                      :href="route('admin.audits.index')" 
                      :class="['block py-2 font-semibold flex items-center', isDark ? 'text-gray-300' : 'text-gray-700']" @click="showMobileMenu = false">
                    Admin Panel
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                    </svg>
                </Link>
                
                <Link :href="route('settings.profile')" :class="['block py-2 font-semibold', isDark ? 'text-gray-300' : 'text-gray-700']" @click="showMobileMenu = false">Profile Settings</Link>
                <Link :href="route('privacy.settings')" :class="['block py-2 font-semibold', isDark ? 'text-gray-300' : 'text-gray-700']" @click="showMobileMenu = false">Privacy Settings</Link>
                <Link :href="route('logout')" method="post" as="button" :class="['block py-2 font-semibold', isDark ? 'text-gray-300' : 'text-gray-700']" @click="showMobileMenu = false">Log Out</Link>
            </template>
            <template v-else>
                <Link :href="route('login')"
                    :class="[
                        'block w-full text-center px-6 py-2 border-2 font-semibold rounded-lg transition focus:outline-none focus:ring-2 focus:ring-offset-2 mb-2',
                        isDark 
                            ? 'bg-gray-700 border-gray-600 text-gray-100 hover:bg-gray-600 hover:text-white focus:ring-gray-500' 
                            : 'bg-white border-gray-300 text-gray-600 hover:bg-gray-600 hover:text-white focus:ring-gray-400'
                    ]"
                    @click="showMobileMenu = false">Sign In</Link>
                <Link :href="route('register')"
                    :class="[
                        'block w-full text-center px-6 py-2 border-2 font-semibold rounded-lg transition focus:outline-none focus:ring-2 focus:ring-offset-2',
                        isDark 
                            ? 'bg-gray-800 border-gray-600 text-gray-100 hover:bg-gray-700 hover:text-white focus:ring-gray-500' 
                            : 'bg-white border-gray-300 text-gray-700 hover:bg-gray-100 hover:border-gray-600 hover:text-gray-600 focus:ring-gray-400'
                    ]"
                    @click="showMobileMenu = false">Sign Up</Link>
            </template>
        </div>
        
        <!-- Main Content -->
        <div class="pt-24 min-h-[calc(100vh-6rem)]">
            <div class="flex mx-auto px-8">
                <!-- Main Content (no sidebar in V1 Enhanced) -->
                <div class="flex-1 overflow-y-auto">
                    <main class="py-4 pb-24">
                        <slot />
                    </main>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer :class="['mt-12 py-10 transition-colors duration-300', isDark ? 'bg-gray-800 border-t border-gray-700' : 'bg-white border-t border-gray-200']">
            <div class="container mx-auto px-6 py-12 max-w-7xl">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    <!-- Company Info -->
                    <div class="col-span-1 lg:col-span-1">
                        <div class="flex items-center mb-4">
                            <img src="/images/logo.png" alt="Saaz Academy" :class="['h-8 mr-2 transition-all duration-300', isDark ? 'brightness-0 invert' : '']">
                            <span :class="['text-xl font-bold', isDark ? 'text-white' : 'text-gray-900']">Saaz Academy</span>
                        </div>
                        <p :class="['text-sm mb-4', isDark ? 'text-gray-400' : 'text-gray-600']">
                            Empowering Security Professionals
                        </p>
                    </div>

                    <!-- Quick Links -->
                    <div>
                        <h3 :class="['text-sm font-semibold tracking-wider uppercase mb-4', isDark ? 'text-white' : 'text-gray-900']">
                            Platform
                        </h3>
                        <ul class="space-y-3">
                            <li>
                                <Link :href="route('assessments.diagnostics.index')" :class="['transition-colors', isDark ? 'text-gray-400 hover:text-gray-200' : 'text-gray-600 hover:text-gray-900']">
                                    SecureStart™
                                </Link>
                            </li>
                        </ul>
                    </div>

                    <!-- Legal -->
                    <div>
                        <h3 :class="['text-sm font-semibold tracking-wider uppercase mb-4', isDark ? 'text-white' : 'text-gray-900']">
                            Legal
                        </h3>
                        <ul class="space-y-3">
                            <li>
                                <Link :href="route('privacy.policy')" :class="['transition-colors', isDark ? 'text-gray-400 hover:text-gray-200' : 'text-gray-600 hover:text-gray-900']">
                                    Privacy Policy
                                </Link>
                            </li>
                            <li>
                                <Link :href="route('terms')" :class="['transition-colors', isDark ? 'text-gray-400 hover:text-gray-200' : 'text-gray-600 hover:text-gray-900']">
                                    Terms of Service
                                </Link>
                            </li>
                            <li>
                                <Link :href="route('cookies')" :class="['transition-colors', isDark ? 'text-gray-400 hover:text-gray-200' : 'text-gray-600 hover:text-gray-900']">
                                    Cookie Policy
                                </Link>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Bottom Section -->
                <div :class="['mt-8 pt-8', isDark ? 'border-t border-gray-700' : 'border-t border-gray-200']">
                    <div class="flex flex-col md:flex-row justify-between items-center">
                        <div :class="['text-sm mb-4 md:mb-0', isDark ? 'text-gray-400' : 'text-gray-600']">
                            © {{ new Date().getFullYear() }} Saaz Academy. All rights reserved.
                        </div>
                    </div>
                </div>
            </div>
        </footer>

        <!-- Cookie Consent Banner -->
        <CookieConsentBanner :user="user" />
        
        <!-- Navigation Loader -->
        <NavigationLoader />
    </div>
</template>

<style scoped>
/* Dark mode transitions */
* {
    transition-property: background-color, border-color, color;
    transition-duration: 300ms;
    transition-timing-function: ease-in-out;
}

/* Override transition for certain interactive elements */
button, a {
    transition-property: all;
    transition-duration: 200ms;
}

/**** Dropdown shadow fix for z-index ****/
[role="menu"] {
    z-index: 50;
}

/* Dropdown menu content style */
.py-0.bg-white.rounded-xl {
    min-width: 200px;
    white-space: nowrap;
    overflow: hidden;
}
</style>