<script setup>
import { ref, onMounted, onBeforeUnmount, computed, nextTick, watch } from 'vue'
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
    BookOpen,
    Users,
    Settings,
    BarChart3,
    Shield,
    Package,
    GraduationCap,
    FileQuestion,
    Tag,
    Layers,
    BookMarked,
    UserCheck,
    ShieldCheck,
    Signal,
    DollarSign,
    Flower2,
    Shapes,
    ShoppingCart,
    Ticket,
    TrendingUp,
    Bot,
    Cog,
    ChevronLeft,
    Bell,
    LogOut,
    User,
    ChevronDown,
    ChevronRight,
    FileText,
    FileCheck,
    Activity,
    Moon,
    Sun
} from 'lucide-vue-next'

defineProps({
    pageTitle: {
        type: String,
        default: null
    }
})

const page = usePage()
const sidebarStore = useSidebarStore()

// Helper function to safely generate routes
    try {
        return route(routeName, params)
    } catch {
        console.warn(`Route ${routeName} not found`)
        return '#'
    }
}

// Refs for scroll preservation
const sidebarRef = ref(null)

// Dark mode state
// Theme management
const { isDark: isDarkMode, toggleTheme } = useTheme()

// Toggle dark mode
const toggleDarkMode = () => {
    toggleTheme(true) // true = admin theme
}


// WebSocket connection state for admin
const isConnected = ref(false)
const onlineUsersCount = ref(0)
const recentPurchases = ref([])
const activeQuizAttempts = ref([])

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
            { title: 'Dashboard', href: route('admin.dashboard'), icon: Home },
            { title: 'Live Monitor', href: route('admin.monitoring.live'), icon: Activity },
            { title: 'Analytics', href: route('admin.analytics.dashboard'), icon: BarChart3 },
            { title: 'Learner Progress', href: route('admin.analytics.learners'), icon: TrendingUp },
        ]
    },
    {
        title: 'Content Management',
        key: 'content',
        items: [
            { title: 'Courses', href: route('admin.content.courses.index'), icon: BookOpen },
            { title: 'Domains', href: route('admin.content.domains.index'), icon: Layers },
            { title: 'Lessons', href: route('admin.content.lessons.index'), icon: BookMarked },
            { title: 'Topics', href: route('admin.content.topics.index'), icon: Tag },
            { title: 'Study Notes', href: route('admin.content.study-notes.index'), icon: FileText },
            { title: 'Questions', href: route('admin.content.questions.index'), icon: FileQuestion },
        ]
    },
    {
        title: 'Diagnostics',
        key: 'diagnostics',
        items: [
            { title: 'Diagnostic Modes', href: route('admin.diagnostic-modes.index'), icon: Settings },
            { title: 'Diagnostic Items', href: route('admin.diagnostics.items.index'), icon: FileText },
            { title: 'Diagnostic Tests', href: route('admin.diagnostics.index'), icon: BarChart3 },
        ]
    },
    {
        title: 'User Management',
        key: 'users',
        items: [
            { title: 'Users', href: route('admin.users.index'), icon: Users },
            { title: 'Instructors', href: route('admin.instructors.index'), icon: GraduationCap },
            { title: 'User Roles', href: route('admin.user-roles.index'), icon: UserCheck },
            { title: 'Roles & Permissions', href: route('admin.users.roles.index'), icon: ShieldCheck },
        ]
    },
    {
        title: 'Master Data',
        key: 'master',
        items: [
            { title: 'Difficulty Levels', href: route('admin.settings.learning.difficulty-levels.index'), icon: Signal },
            { title: 'Course Levels', href: route('admin.settings.learning.course-levels.index'), icon: BarChart3 },
            { title: 'Course Difficulty Profiles', href: route('admin.settings.learning.course-difficulty-profiles.index'), icon: Activity },
            { title: 'Exam Settings', href: route('admin.settings.learning.exam-settings.index'), icon: FileCheck },
            { title: 'Currencies', href: route('admin.settings.commerce.currencies.index'), icon: DollarSign },
            { title: "Bloom's Taxonomy", href: route('admin.settings.learning.blooms.index'), icon: Flower2 },
            { title: 'Product Types', href: route('admin.settings.commerce.product-types.index'), icon: Shapes },
        ]
    },
    {
        title: 'Commerce',
        key: 'commerce',
        items: [
            { title: 'Products', href: route('admin.commerce.products.index'), icon: Package },
            { title: 'Orders', href: route('admin.commerce.orders.index'), icon: ShoppingCart },
            { title: 'Coupons', href: route('admin.commerce.coupons.index'), icon: Ticket },
            { title: 'Vouchers', href: route('admin.commerce.vouchers.index'), icon: Tag },
        ]
    },
    {
        title: 'System',
        key: 'system',
        items: [
            { title: 'Audit Logs', href: route('admin.monitoring.audit.index'), icon: Shield },
            { title: 'Log Viewer', href: route('admin.monitoring.logs.index'), icon: FileText },
            { title: 'Pulse Monitor', href: route('admin.developer.monitoring.pulse.index'), icon: Activity },
            { title: 'User Tracking', href: route('admin.monitoring.tracking.users'), icon: Users },
            { title: 'System Settings', href: route('admin.settings.system.index'), icon: Cog },
            { title: 'AI Configuration', href: route('admin.settings.ai-config.index'), icon: Bot },
        ]
    },
])

// Enhanced active checking to support nested routes
const isActiveItem = (href) => {
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

const handleGroupUpdate = (groupKey, isOpen) => {
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
    console.log('🔄 Attempting to connect AdminLayout WebSocket...')
    
    if (!window.Echo) {
        console.error('❌ Echo not available')
        return
    }

    // Check Echo connection state
    if (window.Echo.connector && window.Echo.connector.pusher) {
        const state = window.Echo.connector.pusher.connection.state
        console.log('📡 Echo connection state:', state)
        
        if (state !== 'connected') {
            console.log('🔄 Echo not connected, waiting for connection...')
            
            // Wait for connection before proceeding
            window.Echo.connector.pusher.connection.bind('connected', () => {
                console.log('✅ Echo connected, setting up admin channels...')
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
        console.log('🔧 Setting up admin channels...')
        
        // Join admin presence channel
        presenceChannel = window.Echo.join('online-users')
            .here((users) => {
                console.log('👥 Admin presence channel - here:', users.length, 'users')
                onlineUsersCount.value = users.length
                isConnected.value = true
                
                // Dispatch custom event for LiveMonitor
                window.dispatchEvent(new CustomEvent('admin-online-users-updated', {
                    detail: { users: users, count: users.length }
                }))
            })
            .joining((user) => {
                console.log('🟢 User joined:', user.name)
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
                    console.log('✅ Sync join response status:', response.status)
                    if (!response.ok) {
                        return response.text().then(text => {
                            console.error('❌ Sync join failed:', response.status, text)
                        })
                    }
                    return response.json()
                })
                .then(data => {
                    if (data) {
                        console.log('✅ Sync join success:', data)
                    }
                })
                .catch(error => {
                    console.error('❌ Failed to sync user online status (join):', error)
                })
                
                // Broadcast to other admin users
                window.Echo.private('admin-dashboard')
                    .whisper('user-joined', {
                        user: user,
                        timestamp: new Date().toISOString()
                    })
            })
            .leaving((user) => {
                console.log('🔴 User left:', user.name)
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
                    console.log('✅ Sync leave response status:', response.status)
                    if (!response.ok) {
                        return response.text().then(text => {
                            console.error('❌ Sync leave failed:', response.status, text)
                        })
                    }
                    return response.json()
                })
                .then(data => {
                    if (data) {
                        console.log('✅ Sync leave success:', data)
                    }
                })
                .catch(error => {
                    console.error('❌ Failed to sync user online status (leave):', error)
                })
                
                // Broadcast to other admin users
                window.Echo.private('admin-dashboard')
                    .whisper('user-left', {
                        user: user,
                        timestamp: new Date().toISOString()
                    })
            })
            .error((error) => {
                console.error('❌ Admin presence channel error:', error)
                isConnected.value = false
            })

        // Listen to admin dashboard channel
        adminChannel = window.Echo.private('admin-dashboard')
            .listen('UserOnlineStatusChanged', (e) => {
                // Dispatch custom event for LiveMonitor
                window.dispatchEvent(new CustomEvent('admin-user-online', {
                    detail: e
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
            .listen('PurchaseMade', (e) => {
                // Additional purchase processing if needed
            })

        console.log('✅ Admin channels setup complete')

    } catch (error) {
        console.error('❌ Failed to setup admin channels:', error)
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
    } catch (error) {
        console.error('❌ Error disconnecting from Admin WebSocket:', error)
    }
}

// Connection health check
const checkWebSocketHealth = () => {
    if (!window.Echo || !window.Echo.connector || !window.Echo.connector.pusher) {
        console.warn('⚠️ Echo WebSocket not initialized')
        return false
    }
    
    const state = window.Echo.connector.pusher.connection.state
    console.log('📊 WebSocket Health Check:', {
        state: state,
        isConnected: state === 'connected',
        timestamp: new Date().toISOString()
    })
    
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
                console.log('🔄 Auto-reconnecting WebSocket...')
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
        console.log('📊 Providing online users to dashboard:', users.length)
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

onMounted(async () => {
    // Disable activity tracking on admin pages to prevent conflicts
    window.activityTrackerAutoInit = false
    
    // Initialize theme system
    // Theme is initialized automatically by useTheme composable
    
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
            console.log('✅ AdminLayout detected Echo connection')
            isConnected.value = true
        })

        window.Echo.connector.pusher.connection.bind('disconnected', () => {
            console.log('❌ AdminLayout detected Echo disconnection')
            isConnected.value = false
        })

        window.Echo.connector.pusher.connection.bind('error', (error) => {
            console.error('❌ AdminLayout Echo error:', {
                type: 'WebSocketError',
                error: error,
                message: error.message || 'Unknown WebSocket error',
                code: error.code || 'N/A',
                timestamp: new Date().toISOString(),
                connectionState: window.Echo.connector.pusher.connection.state
            });
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
            console.log('⏳ Echo not ready, retrying in 500ms...')
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
    <div :class="['min-h-screen transition-colors duration-300', isDarkMode ? 'bg-gray-900' : 'bg-gray-200']">
        <!-- Flash Messages -->
        <FlashMessage />
        
        <!-- Full-width navbar on top -->
        <header :class="[
            'w-full h-16 flex items-center fixed top-0 left-0 right-0 z-50 transition-colors duration-300',
            isDarkMode 
                ? 'bg-gray-800 border-b border-gray-700' 
                : 'bg-white border-b border-gray-200'
        ]">
            <!-- Left section (1/6 width) - Admin Panel info aligned with sidebar -->
            <div :class="[
                'w-1/6 flex items-center gap-3 px-6 transition-colors duration-300',
                isDarkMode ? 'border-r border-gray-700' : 'border-r border-gray-200'
            ]">
                <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-primary text-primary-foreground">
                    <GraduationCap class="h-6 w-6" />
                </div>
                <div>
                    <h2 :class="['text-lg font-semibold', isDarkMode ? 'text-white' : '']">Admin Panel</h2>
                    <p :class="['text-xs', isDarkMode ? 'text-gray-400' : 'text-muted-foreground']">Saaz Academy</p>
                </div>
            </div>

            <!-- Right section (5/6 width) - Page title and controls -->
            <div class="w-5/6 flex items-center justify-between px-6">
                <div class="flex items-center gap-4">
                    <h1 :class="['text-xl font-semibold', isDarkMode ? 'text-white' : '']">{{ pageTitle || 'Dashboard' }}</h1>
                    <!-- WebSocket Status Indicator -->
                    <div :class="[
                        'flex items-center gap-2 px-3 py-1 rounded-full transition-colors duration-300',
                        isDarkMode ? 'bg-gray-700' : 'bg-gray-100'
                    ]">
                        <div :class="[
                            'w-2 h-2 rounded-full transition-colors',
                            isConnected ? 'bg-green-500 animate-pulse' : 'bg-red-500'
                        ]"></div>
                        <span :class="['text-xs', isDarkMode ? 'text-gray-300' : 'text-gray-600']">
                            {{ isConnected ? 'Live' : 'Offline' }}
                        </span>
                        <span v-if="isConnected && onlineUsersCount > 0" :class="['text-xs', isDarkMode ? 'text-gray-400' : 'text-gray-500']">
                            ({{ onlineUsersCount }} online)
                        </span>
                    </div>
                </div>

                <div class="flex items-center gap-4">
                    <!-- Notifications -->
                    <DropdownMenu v-model:open="showNotifications">
                        <DropdownMenuTrigger asChild>
                            <Button variant="ghost" size="icon" class="relative">
                                <Bell class="h-5 w-5" />
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
                    <Button variant="ghost" size="icon" @click="toggleDarkMode">
                        <Sun v-if="isDarkMode" class="h-5 w-5" />
                        <Moon v-else class="h-5 w-5" />
                    </Button>

                    <!-- Back to main site -->
                    <Button variant="outline" size="sm" asChild>
                        <Link href="/dashboard" class="flex items-center gap-2">
                        <ChevronLeft class="h-4 w-4" />
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
                'w-1/6 h-screen overflow-y-auto fixed left-0 top-16 transition-all duration-300 scrollbar-thin',
                isDarkMode 
                    ? 'bg-gray-800 border-r border-gray-700 scrollbar-thumb-gray-600 scrollbar-track-gray-800' 
                    : 'bg-white border-r border-gray-200 scrollbar-thumb-gray-300 scrollbar-track-gray-100',
                { 'opacity-95': sidebarStore.isNavigating }
            ]">
                <div class="p-4">
                    <!-- Menu Groups with Collapsible functionality -->
                    <div v-for="(group, index) in menuItems" :key="group.title" class="mb-4">
                        <Collapsible :open="isGroupOpen(group.key)"
                            @update:open="(isOpen) => handleGroupUpdate(group.key, isOpen)">
                            <CollapsibleTrigger
                                :class="[
                                    'flex w-full items-center justify-between py-2 text-xs font-semibold uppercase tracking-wide transition-colors duration-200',
                                    isDarkMode 
                                        ? 'text-gray-400 hover:text-gray-200' 
                                        : 'text-gray-500 hover:text-gray-700'
                                ]">
                                <span>{{ group.title }}</span>
                                <ChevronDown class="h-4 w-4 transition-transform duration-200"
                                    :class="{ 'rotate-180': isGroupOpen(group.key) }" />
                            </CollapsibleTrigger>
                            <CollapsibleContent class="mt-2">
                                <nav class="space-y-1">
                                    <button 
                                        v-for="item in group.items" 
                                        :key="item.href" 
                                        @click="handleNavigation(item.href)"
                                        :class="[
                                            'group flex items-center px-3 py-2 text-sm font-medium rounded-md transition-all duration-200 w-full text-left',
                                            isActiveItem(item.href)
                                                ? 'bg-primary text-primary-foreground shadow-sm'
                                                : isDarkMode
                                                    ? 'text-gray-300 hover:bg-gray-700 hover:text-white hover:shadow-sm'
                                                    : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900 hover:shadow-sm'
                                        ]">
                                        <component :is="item.icon" :class="[
                                            'h-5 w-5 mr-3 flex-shrink-0 transition-all duration-200',
                                            isActiveItem(item.href) 
                                                ? 'text-primary-foreground' 
                                                : isDarkMode
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
                    isDarkMode ? 'border-t border-gray-700' : 'border-t border-gray-200'
                ]">
                    <div class="flex items-center gap-3">
                        <Avatar class="h-8 w-8">
                            <AvatarImage :src="`https://ui-avatars.com/api/?name=${page.props.auth.user?.name}`" />
                            <AvatarFallback>{{ page.props.auth.user?.name?.charAt(0).toUpperCase() }}</AvatarFallback>
                        </Avatar>
                        <div class="flex-1 text-sm">
                            <p :class="['font-medium', isDarkMode ? 'text-white' : '']">{{ page.props.auth.user?.name }}</p>
                            <p :class="['text-xs', isDarkMode ? 'text-gray-400' : 'text-muted-foreground']">Administrator</p>
                        </div>
                    </div>
                </div>
            </aside>

            <!-- Main content (5/6 width) -->
            <main :class="[
                'w-5/6 ml-[16.666667%] p-6 transition-all duration-300',
                isDarkMode ? 'bg-gray-900' : '',
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

/* Smooth transitions for dark mode */
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
</style>