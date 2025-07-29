<script setup lang="ts">
import { ref, onMounted, onBeforeUnmount, computed, nextTick, watch, provide } from 'vue'
import { Link, usePage, router } from '@inertiajs/vue3'
import { Button } from '@/components/shadcn/ui/button'
import { Avatar, AvatarFallback, AvatarImage } from '@/components/shadcn/ui/avatar'
import { useSidebarStore } from '@/stores/sidebarStore.js'
import { useTheme } from '@/composables/useTheme'

import FlashMessage from '@/components/FlashMessage.vue'
import {
    DropdownMenu,
    DropdownMenuContent,
    DropdownMenuItem,
    DropdownMenuLabel,
    DropdownMenuSeparator,
    DropdownMenuTrigger,
} from '@/components/shadcn/ui/dropdown-menu'
import {
    Collapsible,
    CollapsibleContent,
    CollapsibleTrigger,
} from '@/components/shadcn/ui/collapsible'
import {
    Home,
    Users,
    Settings,
    Shield,
    GraduationCap,
    FileQuestion,
    Layers,
    Shapes,
    Brain,
    ChevronLeft,
    Bell,
    LogOut,
    User,
    ChevronDown,
    FileText,
    FileCheck,
    Moon,
    Sun,
    GitBranch
} from 'lucide-vue-next'

// No props needed for the layout

const page = usePage()
const sidebarStore = useSidebarStore()

// Helper function to safely generate routes
const safeRoute = (routeName, params = {}) => {
    try {
        return route(routeName, params)
    } catch {
        // Route not found
        return '#'
    }
}

// Refs for scroll preservation
const sidebarRef = ref(null)

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
const directThemeToggle = (event) => {
    // Prevent default behavior and stop propagation
    if (event) {
        event.preventDefault()
        event.stopPropagation()
    }
    
    // Save current scroll position
    const scrollY = window.scrollY
    
    const html = document.documentElement
    const currentIsDark = html.classList.contains('dark')
    
    if (currentIsDark) {
        html.classList.remove('dark')
        html.setAttribute('data-theme', 'light')
        localStorage.setItem('theme', 'light')
        localStorage.setItem('adminDarkMode', 'false')
    } else {
        html.classList.add('dark')
        html.setAttribute('data-theme', 'dark')
        localStorage.setItem('theme', 'dark')
        localStorage.setItem('adminDarkMode', 'true')
    }
    
    // Try to sync with the composable
    try {
        toggleTheme(true) // true for admin theme
    } catch (e) {
        console.error('Theme sync failed:', e)
    }
    
    // Restore scroll position
    requestAnimationFrame(() => {
        window.scrollTo(0, scrollY)
    })
}


// WebSocket connection state for admin
const isConnected = ref(false)
const onlineUsersCount = ref(0)
const recentPurchases = ref([])
const activeQuizAttempts = ref([])
// const systemAlerts = ref([])

// Echo connection references for admin
let adminChannel = null
let presenceChannel = null
let purchaseChannel = null
let quizChannel = null

// Menu structure with icons
const menuItems = computed(() => [
    {
        title: 'Overview',
        key: 'overview',
        items: [
            { title: 'Dashboard', href: safeRoute('admin.dashboard'), icon: Home },
            // { title: 'Live Monitor', href: safeRoute('admin.monitoring.live'), icon: Activity },
            // { title: 'Analytics', href: safeRoute('admin.analytics.dashboard'), icon: BarChart3 },
        ]
    },
    {
        title: 'User Management',
        key: 'users',
        items: [
            { title: 'Users', href: safeRoute('admin.users.index'), icon: Users },
            // { title: 'User Roles', href: safeRoute('admin.user-roles.index'), icon: UserCheck },
        ]
    },
    {
        title: 'Diagnostics',
        key: 'diagnostics',
        items: [
            { title: 'Domains', href: safeRoute('admin.diagnostics.domains.index'), icon: GitBranch },
            { title: 'Assessments', href: safeRoute('admin.diagnostics.assessments.index'), icon: FileCheck },
            { title: 'Questions', href: safeRoute('admin.diagnostics.items.index'), icon: FileQuestion },
            { title: 'Phases', href: safeRoute('admin.diagnostics.phases.index'), icon: Layers },
        ]
    },
    {
        title: 'Master Data',
        key: 'master',
        items: [
            { title: 'Question Types', href: safeRoute('admin.master.question-types.index'), icon: Shapes },
            { title: 'Bloom Levels', href: safeRoute('admin.master.blooms.index'), icon: Brain },
            // { title: 'Difficulty Levels', href: safeRoute('admin.master.difficulty-levels.index'), icon: BarChart3 },
        ]
    },
    {
        title: 'System',
        key: 'system',
        items: [
            { title: 'Audit Logs', href: safeRoute('admin.audits.index'), icon: Shield },
            { title: 'System Logs', href: safeRoute('admin.system.logs.index'), icon: FileText },
            // { title: 'System Settings', href: safeRoute('admin.settings.index'), icon: Cog },
        ]
    },
])

// Enhanced active checking to support nested routes
const isActiveItem = (href) => {
    const currentUrl = page.url
    return currentUrl === href || (href !== '/admin/dashboard' && currentUrl.startsWith(href))
}

// Determine which group should be open based on current URL
const getActiveGroup = () => {
    for (const group of menuItems.value) {
        for (const item of group.items) {
            if (isActiveItem(item.href)) {
                return group.key
            }
        }
    }
    return null
}

// Store-based methods
const isGroupOpen = (groupKey) => {
    return sidebarStore.isGroupOpen(groupKey)
}

const handleGroupUpdate = (groupKey) => {
    sidebarStore.toggleGroup(groupKey)
}

// Restore scroll position from store
const restoreScrollPosition = () => {
    nextTick(() => {
        const sidebarElement = sidebarRef.value
        if (sidebarElement && sidebarStore.scrollPosition > 0) {
            sidebarElement.scrollTop = sidebarStore.scrollPosition
        }
    })
}

// Enhanced navigation handler with store
const handleNavigation = (href) => {
    // Save current scroll position before navigation
    const sidebarElement = sidebarRef.value
    if (sidebarElement) {
        sidebarStore.updateScrollPosition(sidebarElement.scrollTop)
    }
    
    // Set navigation state for smooth transitions
    sidebarStore.setNavigating(true)
    
    // Use Inertia for smooth navigation
    router.visit(href, {
        preserveScroll: true,
        preserveState: true,
        onFinish: () => {
            sidebarStore.setNavigating(false)
            // Restore scroll position after navigation
            nextTick(() => {
                restoreScrollPosition()
            })
        }
    })
}

// Listen for scroll events to save position
const handleSidebarScroll = () => {
    const sidebarElement = sidebarRef.value
    if (sidebarElement) {
        sidebarStore.updateScrollPosition(sidebarElement.scrollTop)
    }
}

const showNotifications = ref(false)
const notifications = ref([])

// WebSocket connection management for admin
const connectToAdminWebSocket = () => {
    // Attempting to connect AdminLayout WebSocket...
    
    if (!window.Echo) {
        // Echo not available
        return
    }

    // Check Echo connection state
    if (window.Echo.connector && window.Echo.connector.pusher) {
        const state = window.Echo.connector.pusher.connection.state
        // Echo connection state: checking...
        
        if (state !== 'connected') {
            // Echo not connected, waiting for connection...
            
            // Wait for connection before proceeding
            window.Echo.connector.pusher.connection.bind('connected', () => {
                // Echo connected, setting up admin channels...
                setupAdminChannels()
            })
            
            // Try to connect if not already connecting
            if (state === 'disconnected' || state === 'unavailable') {
                window.Echo.connector.pusher.connect()
            }
            
            return
        }
    }

    // If already connected, setup channels immediately
    setupAdminChannels()
}

const setupAdminChannels = () => {
    try {
        // Setting up admin channels...
        
        // Join admin presence channel
        presenceChannel = window.Echo.join('online-users')
            .here((users) => {
                // Admin presence channel connected
                onlineUsersCount.value = users.length
                isConnected.value = true
                
                // Dispatch custom event for LiveMonitor
                window.dispatchEvent(new CustomEvent('admin-online-users-updated', {
                    detail: { users: users, count: users.length }
                }))
            })
            .joining((user) => {
                // User joined
                onlineUsersCount.value++
                
                // Dispatch custom event for components to listen
                window.dispatchEvent(new CustomEvent('admin-user-joined', {
                    detail: { user: user }
                }))
                
                // Sync with server-side cache system
                fetch('/admin/realtime/sync-user-online', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        user_id: user.id,
                        action: 'join'
                    })
                })
                .then(response => {
                    // Sync join response received
                    if (!response.ok) {
                        return response.text().then(() => {
                            // Sync join failed
                        })
                    }
                    return response.json()
                })
                .then(data => {
                    if (data) {
                        // Sync join success
                    }
                })
                .catch(() => {
                    // Failed to sync user online status (join)
                })
                
                // Broadcast to other admin users
                window.Echo.private('admin-dashboard')
                    .whisper('user-joined', {
                        user: user,
                        timestamp: new Date().toISOString()
                    })
            })
            .leaving((user) => {
                // User left
                onlineUsersCount.value = Math.max(0, onlineUsersCount.value - 1)
                
                // Dispatch custom event for components to listen
                window.dispatchEvent(new CustomEvent('admin-user-left', {
                    detail: { user: user }
                }))
                
                // Sync with server-side cache system
                fetch('/admin/realtime/sync-user-online', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        user_id: user.id,
                        action: 'leave'
                    })
                })
                .then(response => {
                    // Sync leave response received
                    if (!response.ok) {
                        return response.text().then(() => {
                            // Sync leave failed
                        })
                    }
                    return response.json()
                })
                .then(data => {
                    if (data) {
                        // Sync leave success
                    }
                })
                .catch(() => {
                    // Failed to sync user online status (leave)
                })
                
                // Broadcast to other admin users
                window.Echo.private('admin-dashboard')
                    .whisper('user-left', {
                        user: user,
                        timestamp: new Date().toISOString()
                    })
            })
            .error(() => {
                // Admin presence channel error
                isConnected.value = false
            })

        // Listen to admin dashboard channel
        adminChannel = window.Echo.private('admin-dashboard')
            .listen('UserOnlineStatusChanged', (event) => {
                // Dispatch custom event for LiveMonitor
                window.dispatchEvent(new CustomEvent('admin-user-online', {
                    detail: event
                }))
            })
            .listen('PurchaseMade', (e) => {
                recentPurchases.value.unshift({
                    id: e.purchase.id,
                    user: e.user.name,
                    product: e.product.name,
                    amount: e.purchase.amount,
                    time: 'Just now'
                })
                
                notifications.value.unshift({
                    id: Date.now(),
                    title: 'New Purchase',
                    message: `${e.user.name} purchased ${e.product.name}`,
                    time: 'Just now',
                    type: 'purchase'
                })
                
                // Keep only latest 10 purchases
                if (recentPurchases.value.length > 10) {
                    recentPurchases.value = recentPurchases.value.slice(0, 10)
                }
                
                // Dispatch custom event for LiveMonitor
                window.dispatchEvent(new CustomEvent('admin-purchase-made', {
                    detail: e
                }))
            })
            .listen('UserActivityUpdate', (e) => {
                // Dispatch custom event for LiveMonitor
                window.dispatchEvent(new CustomEvent('admin-user-activity', {
                    detail: e
                }))
            })

        // Listen to quiz attempts channel
        quizChannel = window.Echo.private('quiz-attempts')
            .listen('QuizAttemptStarted', (e) => {
                activeQuizAttempts.value.unshift({
                    id: e.assessment.id,
                    user: e.user.name,
                    quiz: e.assessment.title,
                    questions: e.assessment.question_count,
                    time: 'Just now'
                })
                
                notifications.value.unshift({
                    id: Date.now(),
                    title: 'Quiz Started',
                    message: `${e.user.name} started ${e.assessment.title}`,
                    time: 'Just now',
                    type: 'quiz'
                })
                
                // Keep only latest 10 attempts
                if (activeQuizAttempts.value.length > 10) {
                    activeQuizAttempts.value = activeQuizAttempts.value.slice(0, 10)
                }
                
                // Dispatch custom event for LiveMonitor
                window.dispatchEvent(new CustomEvent('admin-quiz-started', {
                    detail: e
                }))
            })
            .listen('QuizAttemptCompleted', (e) => {
                // Remove from active attempts
                activeQuizAttempts.value = activeQuizAttempts.value.filter(
                    attempt => attempt.id !== e.assessment.id
                )
                
                notifications.value.unshift({
                    id: Date.now(),
                    title: 'Quiz Completed',
                    message: `${e.user.name} completed ${e.assessment.title} (Score: ${e.score}%)`,
                    time: 'Just now',
                    type: 'quiz'
                })
            })

        // Listen to purchase notifications channel
        purchaseChannel = window.Echo.private('purchase-notifications')
            .listen('PurchaseMade', () => {
                // Additional purchase processing if needed
            })

        // Admin channels setup complete

    } catch {
        // Failed to setup admin channels
        isConnected.value = false
    }
}

const disconnectFromAdminWebSocket = () => {
    try {
        if (presenceChannel) {
            window.Echo.leave('online-users')
            presenceChannel = null
        }
        
        if (adminChannel) {
            window.Echo.leave('admin-dashboard')
            adminChannel = null
        }
        
        if (quizChannel) {
            window.Echo.leave('quiz-attempts')
            quizChannel = null
        }
        
        if (purchaseChannel) {
            window.Echo.leave('purchase-notifications')
            purchaseChannel = null
        }
        
        isConnected.value = false
    } catch {
        // Error disconnecting from Admin WebSocket
    }
}

// Connection health check
const checkWebSocketHealth = () => {
    if (!window.Echo || !window.Echo.connector || !window.Echo.connector.pusher) {
        // Echo WebSocket not initialized
        return false
    }
    
    const state = window.Echo.connector.pusher.connection.state
    // WebSocket Health Check
    
    return state === 'connected'
}

// Periodic health check
let healthCheckInterval = null

const startHealthCheck = () => {
    healthCheckInterval = setInterval(() => {
        const healthy = checkWebSocketHealth()
        isConnected.value = healthy
        
        if (!healthy && window.Echo && window.Echo.connector && window.Echo.connector.pusher) {
            const state = window.Echo.connector.pusher.connection.state
            if (state === 'disconnected' || state === 'unavailable') {
                // Auto-reconnecting WebSocket...
                window.Echo.connector.pusher.connect()
            }
        }
    }, 30000) // Check every 30 seconds
}

const stopHealthCheck = () => {
    if (healthCheckInterval) {
        clearInterval(healthCheckInterval)
        healthCheckInterval = null
    }
}

// Expose method to get current online users for LiveMonitor
window.getAdminOnlineUsers = () => {
    if (presenceChannel && presenceChannel.members) {
        const users = Object.values(presenceChannel.members.members)
        // Providing online users to dashboard
        return users
    }
    return []
}

// Simulate user activity for demo purposes
const simulateUserActivity = () => {
    if (presenceChannel && presenceChannel.members) {
        const users = Object.values(presenceChannel.members.members)
        
        users.forEach((user, index) => {
            // Simulate random activity every 30-120 seconds
            setTimeout(() => {
                const activities = [
                    { action: 'page_view', description: 'Viewed Dashboard', page: '/dashboard' },
                    { action: 'page_view', description: 'Viewed Course List', page: '/learn' },
                    { action: 'click', description: 'Started Quiz', page: '/learn/course/quiz' },
                    { action: 'navigation', description: 'Navigated to Study Notes', page: '/learn/course/study-notes' },
                    { action: 'file_download', description: 'Downloaded Resource', page: '/learn/course/resources' },
                ]
                
                const randomActivity = activities[Math.floor(Math.random() * activities.length)]
                
                // Dispatch activity update
                window.dispatchEvent(new CustomEvent('admin-user-activity', {
                    detail: {
                        user: user,
                        activity: randomActivity,
                        timestamp: new Date()
                    }
                }))
            }, (index + 1) * 30000 + Math.random() * 90000) // Stagger activities
        })
    }
}

// Start activity simulation after a delay
setTimeout(() => {
    simulateUserActivity()
    // Repeat every 2 minutes
    setInterval(simulateUserActivity, 120000)
}, 5000)

// Watch for URL changes to ensure active group is open
watch(() => page.url, () => {
    const activeGroup = getActiveGroup()
    if (activeGroup) {
        sidebarStore.ensureActiveGroupOpen(activeGroup)
    }
}, { immediate: true })

let themeObserver = null

onMounted(async () => {
    // Disable activity tracking on admin pages to prevent conflicts
    window.activityTrackerAutoInit = false
    
    // Initialize theme
    await initializeTheme()
    
    // Start observing theme changes
    themeObserver = observeThemeChanges()
    
    // Update initial state
    isDark.value = document.documentElement.classList.contains('dark')
    
    // Initialize store from localStorage
    sidebarStore.initializeFromStorage()
    
    // Ensure active group is open
    const activeGroup = getActiveGroup()
    if (activeGroup) {
        sidebarStore.ensureActiveGroupOpen(activeGroup)
    }
    
    // Restore scroll position
    restoreScrollPosition()
    
    // Add scroll listener
    if (sidebarRef.value) {
        sidebarRef.value.addEventListener('scroll', handleSidebarScroll)
    }
    
    // Setup connection status monitoring
    if (window.Echo && window.Echo.connector && window.Echo.connector.pusher) {
        window.Echo.connector.pusher.connection.bind('connected', () => {
            // AdminLayout detected Echo connection
            isConnected.value = true
        })

        window.Echo.connector.pusher.connection.bind('disconnected', () => {
            // AdminLayout detected Echo disconnection
            isConnected.value = false
        })

        window.Echo.connector.pusher.connection.bind('error', () => {
            // AdminLayout Echo error detected
            isConnected.value = false
            
            // Notify user about connection issues
            notifications.value.unshift({
                id: Date.now(),
                title: 'Connection Issue',
                message: 'WebSocket connection lost. Real-time features may not work properly.',
                time: 'Just now',
                type: 'system'
            })
        })
    }
    
    // Connect to Admin WebSocket with retry logic
    const attemptConnection = () => {
        if (window.Echo) {
            connectToAdminWebSocket()
        } else {
            // Echo not ready, retrying in 500ms...
            setTimeout(attemptConnection, 500)
        }
    }
    
    setTimeout(attemptConnection, 100)
    
    // Start health check
    startHealthCheck()
})

onBeforeUnmount(() => {
    // Stop health check
    stopHealthCheck()
    
    // Cleanup theme observer
    if (themeObserver) {
        themeObserver.disconnect()
    }
    
    // Save current scroll position before component unmounts
    const sidebarElement = sidebarRef.value
    if (sidebarElement) {
        sidebarStore.updateScrollPosition(sidebarElement.scrollTop)
    }
    
    // Clean up scroll listener
    if (sidebarRef.value) {
        sidebarRef.value.removeEventListener('scroll', handleSidebarScroll)
    }
    
    // Disconnect from Admin WebSocket
    disconnectFromAdminWebSocket()
})
</script>

<template>
    <div :class="['min-h-screen theme-transition', isDark ? 'bg-gray-900' : 'bg-gray-200']">
        <!-- Flash Messages -->
        <FlashMessage />
        
        <!-- Full-width navbar on top -->
        <header :class="[
            'w-full h-16 flex items-center fixed top-0 left-0 right-0 z-50 theme-transition',
            isDark 
                ? 'bg-gray-800 border-b border-gray-700' 
                : 'bg-white border-b border-gray-200'
        ]">
            <!-- Left section (1/6 width) - Admin Panel info aligned with sidebar -->
            <div :class="[
                'w-1/6 flex items-center gap-3 px-6 theme-transition',
                isDark ? 'border-r border-gray-700' : 'border-r border-gray-200'
            ]">
                <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-primary text-primary-foreground">
                    <GraduationCap class="h-6 w-6" />
                </div>
                <div>
                    <h2 :class="['text-lg font-semibold', isDark ? 'text-white' : 'text-gray-900']">Admin Panel</h2>
                    <p :class="['text-xs', isDark ? 'text-gray-400' : 'text-gray-600']">Saaz Academy</p>
                </div>
            </div>

            <!-- Right section (5/6 width) - Page title and controls -->
            <div class="w-5/6 flex items-center justify-between px-6">
                <div class="flex items-center gap-4">
                    <!-- WebSocket Status Indicator -->
                    <div :class="[
                        'flex items-center gap-2 px-3 py-1 rounded-full transition-colors duration-300',
                        isDark ? 'bg-gray-700' : 'bg-gray-100'
                    ]">
                        <div :class="[
                            'w-2 h-2 rounded-full transition-colors',
                            isConnected ? 'bg-green-500 animate-pulse' : 'bg-red-500'
                        ]"></div>
                        <span :class="['text-xs', isDark ? 'text-gray-300' : 'text-gray-600']">
                            {{ isConnected ? 'Live' : 'Offline' }}
                        </span>
                        <span v-if="isConnected && onlineUsersCount > 0" :class="['text-xs', isDark ? 'text-gray-400' : 'text-gray-500']">
                            ({{ onlineUsersCount }} online)
                        </span>
                    </div>
                </div>

                <div class="flex items-center gap-4">
                    <!-- Notifications -->
                    <DropdownMenu v-model:open="showNotifications">
                        <DropdownMenuTrigger asChild>
                            <Button variant="ghost" size="icon" class="relative">
                                <Bell :class="['h-5 w-5', isDark ? 'text-white' : 'text-gray-700']" />
                                <span v-if="notifications.length > 0"
                                    class="absolute -right-1 -top-1 flex h-5 w-5 items-center justify-center rounded-full bg-red-500 text-[10px] text-white">
                                    {{ notifications.length > 9 ? '9+' : notifications.length }}
                                </span>
                            </Button>
                        </DropdownMenuTrigger>
                        <DropdownMenuContent align="end" class="w-80">
                            <DropdownMenuLabel class="flex items-center justify-between">
                                <span>Real-time Notifications</span>
                                <div :class="[
                                    'w-2 h-2 rounded-full',
                                    isConnected ? 'bg-green-500' : 'bg-red-500'
                                ]"></div>
                            </DropdownMenuLabel>
                            <DropdownMenuSeparator />
                            <div v-if="notifications.length === 0" class="p-3 text-center text-sm text-muted-foreground">
                                No new notifications
                            </div>
                            <DropdownMenuItem v-for="notification in notifications.slice(0, 5)" :key="notification.id"
                                class="flex flex-col items-start gap-1 p-3">
                                <div class="flex items-center gap-2 w-full">
                                    <div :class="[
                                        'w-2 h-2 rounded-full',
                                        notification.type === 'purchase' ? 'bg-green-500' :
                                        notification.type === 'quiz' ? 'bg-blue-500' :
                                        notification.type === 'user' ? 'bg-yellow-500' : 'bg-gray-500'
                                    ]"></div>
                                    <span class="text-sm font-medium flex-1">{{ notification.title }}</span>
                                </div>
                                <span class="text-xs text-muted-foreground ml-4">{{ notification.message || notification.time }}</span>
                                <span class="text-xs text-muted-foreground ml-4">{{ notification.time }}</span>
                            </DropdownMenuItem>
                            <DropdownMenuSeparator v-if="notifications.length > 0" />
                            <DropdownMenuItem class="justify-center">
                                <Link :href="route('admin.monitoring.live')" class="text-sm">
                                    View Live Monitor
                                </Link>
                            </DropdownMenuItem>
                        </DropdownMenuContent>
                    </DropdownMenu>

                    <!-- Dark Mode Toggle -->
                    <Button variant="ghost" size="icon" @click="directThemeToggle($event)">
                        <Sun v-if="isDark" :class="['h-5 w-5', 'text-white']" />
                        <Moon v-else :class="['h-5 w-5', 'text-gray-700']" />
                    </Button>

                    <!-- Back to main site -->
                    <Button variant="outline" size="sm" asChild>
                        <Link href="/dashboard" :class="['flex items-center gap-2', isDark ? 'text-white' : 'text-gray-700']">
                        <ChevronLeft :class="['h-4 w-4', isDark ? 'text-white' : 'text-gray-700']" />
                        Back to Site
                        </Link>
                    </Button>

                    <!-- User menu -->
                    <DropdownMenu>
                        <DropdownMenuTrigger asChild>
                            <Button variant="ghost" size="icon">
                                <Avatar class="h-8 w-8">
                                    <AvatarImage
                                        :src="`https://ui-avatars.com/api/?name=${page.props.auth.user?.name}`" />
                                    <AvatarFallback>{{ page.props.auth.user?.name?.charAt(0).toUpperCase() }}
                                    </AvatarFallback>
                                </Avatar>
                            </Button>
                        </DropdownMenuTrigger>
                        <DropdownMenuContent align="end" class="w-56">
                            <DropdownMenuLabel>
                                <div class="flex flex-col space-y-1">
                                    <p class="text-sm font-medium">{{ page.props.auth.user?.name }}</p>
                                    <p class="text-xs text-muted-foreground">{{ page.props.auth.user?.email }}</p>
                                </div>
                            </DropdownMenuLabel>
                            <DropdownMenuSeparator />
                            <DropdownMenuItem asChild>
                                <Link href="/profile" class="flex items-center gap-2">
                                <User class="h-4 w-4" />
                                Your Profile
                                </Link>
                            </DropdownMenuItem>
                            <DropdownMenuItem asChild>
                                <Link href="/admin/settings/system" class="flex items-center gap-2">
                                <Settings class="h-4 w-4" />
                                Settings
                                </Link>
                            </DropdownMenuItem>
                            <DropdownMenuSeparator />
                            <DropdownMenuItem asChild>
                                <Link :href="route('logout')" method="post" as="button"
                                    class="flex w-full items-center gap-2">
                                <LogOut class="h-4 w-4" />
                                Sign out
                                </Link>
                            </DropdownMenuItem>
                        </DropdownMenuContent>
                    </DropdownMenu>
                </div>
            </div>
        </header>

        <!-- Main container with sidebar and content -->
        <div class="flex pt-16">
            <!-- Sidebar (1/6 width) -->
            <aside ref="sidebarRef" :class="[
                'w-1/6 h-screen overflow-y-auto fixed left-0 top-16 theme-transition scrollbar-thin',
                isDark 
                    ? 'bg-gray-800 border-r border-gray-700 scrollbar-thumb-gray-600 scrollbar-track-gray-800' 
                    : 'bg-white border-r border-gray-200 scrollbar-thumb-gray-300 scrollbar-track-gray-100',
                { 'opacity-95': sidebarStore.isNavigating }
            ]">
                <div class="p-4">
                    <!-- Menu Groups with Collapsible functionality -->
                    <div v-for="group in menuItems" :key="group.title" class="mb-4">
                        <Collapsible :open="isGroupOpen(group.key)"
                            @update:open="() => handleGroupUpdate(group.key)">
                            <CollapsibleTrigger
                                :class="[
                                    'collapsible-trigger flex w-full items-center justify-between py-2 text-xs font-semibold uppercase tracking-wide',
                                    isDark 
                                        ? 'text-gray-400 hover:text-gray-200' 
                                        : 'text-gray-500 hover:text-gray-700'
                                ]">
                                <span>{{ group.title }}</span>
                                <ChevronDown class="chevron-icon h-4 w-4"
                                    :class="{ 'rotate-180': isGroupOpen(group.key) }" />
                            </CollapsibleTrigger>
                            <CollapsibleContent class="mt-2">
                                <nav class="space-y-1">
                                    <button 
                                        v-for="item in group.items" 
                                        :key="item.href" 
                                        @click="handleNavigation(item.href)"
                                        :class="[
                                            'menu-item group flex items-center px-3 py-2 text-sm font-medium rounded-md w-full text-left',
                                            isActiveItem(item.href)
                                                ? 'bg-primary text-primary-foreground shadow-sm'
                                                : isDark
                                                    ? 'text-gray-300 hover:bg-gray-700 hover:text-white hover:shadow-sm'
                                                    : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900 hover:shadow-sm'
                                        ]">
                                        <component :is="item.icon" :class="[
                                            'h-5 w-5 mr-3 flex-shrink-0 transition-all duration-200',
                                            isActiveItem(item.href) 
                                                ? 'text-primary-foreground' 
                                                : isDark
                                                    ? 'text-gray-400 group-hover:text-gray-200'
                                                    : 'text-gray-500 group-hover:text-gray-700'
                                        ]" />
                                        <span class="transition-all duration-200">{{ item.title }}</span>
                                        <div v-if="isActiveItem(item.href)" 
                                             class="ml-auto w-1 h-6 bg-primary-foreground rounded-full opacity-60"></div>
                                    </button>
                                </nav>
                            </CollapsibleContent>
                        </Collapsible>
                    </div>
                </div>

                <!-- Sidebar footer -->
                <div :class="[
                    'p-4 mt-auto transition-colors duration-300',
                    isDark ? 'border-t border-gray-700' : 'border-t border-gray-200'
                ]">
                    <div class="flex items-center gap-3">
                        <Avatar class="h-8 w-8">
                            <AvatarImage :src="`https://ui-avatars.com/api/?name=${page.props.auth.user?.name}`" />
                            <AvatarFallback>{{ page.props.auth.user?.name?.charAt(0).toUpperCase() }}</AvatarFallback>
                        </Avatar>
                        <div class="flex-1 text-sm">
                            <p :class="['font-medium', isDark ? 'text-white' : 'text-gray-900']">{{ page.props.auth.user?.name }}</p>
                            <p :class="['text-xs', isDark ? 'text-gray-400' : 'text-gray-600']">Administrator</p>
                        </div>
                    </div>
                </div>
            </aside>

            <!-- Main content (5/6 width) -->
            <main :class="[
                'w-5/6 ml-[16.666667%] p-6',
                { 'opacity-95': sidebarStore.isNavigating }
            ]">
                <slot />
            </main>
        </div>
    </div>
</template>

<style>
/* Custom scrollbar styles for dark mode */
.scrollbar-thin {
    scrollbar-width: thin;
}

.scrollbar-thin::-webkit-scrollbar {
    width: 6px;
    height: 6px;
}

/* Dark mode scrollbar */
.dark .scrollbar-thin::-webkit-scrollbar-thumb {
    background-color: #4B5563;
    border-radius: 3px;
}

.dark .scrollbar-thin::-webkit-scrollbar-track {
    background-color: #1F2937;
}

/* Light mode scrollbar */
.scrollbar-thin::-webkit-scrollbar-thumb {
    background-color: #D1D5DB;
    border-radius: 3px;
}

.scrollbar-thin::-webkit-scrollbar-track {
    background-color: #F3F4F6;
}

/* Smooth transitions for dark mode - be more selective */
.theme-transition {
    transition-property: background-color, border-color;
    transition-duration: 150ms;
    transition-timing-function: ease-in-out;
}

/* Interactive elements only */
button, a, .menu-item {
    transition-property: background-color, border-color, color, transform;
    transition-duration: 200ms;
    transition-timing-function: ease-in-out;
}

/* Collapsible elements - only transition on hover/click, not theme change */
.collapsible-trigger:hover {
    transition: color 150ms ease-in-out;
}

.chevron-icon {
    transition: transform 200ms ease-in-out;
}
</style>