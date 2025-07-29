<template>
    <AdminLayout>
        <Head title="Recent Activities" />
        
        <div class="p-6">
            <div class="mb-6">
                <h1 :class="isDarkMode ? 'text-white' : 'text-gray-900'" class="text-2xl font-semibold">Recent Activities</h1>
                <p :class="isDarkMode ? 'text-gray-300' : 'text-gray-600'">Real-time user activity stream</p>
            </div>

            <!-- Activity Stream -->
            <div :class="isDarkMode ? 'bg-gray-800' : 'bg-white'" class="rounded-lg shadow">
                <div :class="isDarkMode ? 'border-gray-700' : 'border-gray-200'" class="px-6 py-4 border-b flex justify-between items-center">
                    <h3 :class="isDarkMode ? 'text-white' : 'text-gray-900'" class="text-lg font-medium">Activity Stream</h3>
                    <button @click="refreshActivities" 
                            :class="isDarkMode ? 'text-blue-400 hover:text-blue-300' : 'text-indigo-600 hover:text-indigo-900'"
                            class="text-sm">
                        Refresh
                    </button>
                </div>
                <div class="p-6">
                    <div v-if="activities.length > 0" class="space-y-4">
                        <div v-for="activity in activities" :key="activity.id" 
                             :class="[
                                 isDarkMode ? 'border-gray-600 hover:border-blue-500' : 'border-gray-200 hover:border-indigo-500',
                                 'border-l-4 pl-4 transition-colors'
                             ]">
                            <div class="flex items-start justify-between">
                                <div>
                                    <p :class="isDarkMode ? 'text-white' : 'text-gray-900'" class="text-sm font-medium">
                                        {{ activity.user?.name || 'Unknown User' }}
                                    </p>
                                    <p :class="isDarkMode ? 'text-gray-300' : 'text-gray-600'" class="text-sm mt-1">
                                        {{ getActivityDescription(activity) }}
                                    </p>
                                    <div :class="isDarkMode ? 'text-gray-400' : 'text-gray-500'" class="flex items-center mt-2 text-xs">
                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        {{ formatTime(activity.created_at) }}
                                        
                                        <svg class="w-3 h-3 ml-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        {{ activity.page_url || 'Unknown page' }}
                                    </div>
                                </div>
                                <span :class="getActivityTypeClass(activity.action_type)" 
                                      class="px-2 py-1 text-xs font-medium rounded-full">
                                    {{ activity.action_type }}
                                </span>
                            </div>
                        </div>
                    </div>
                    <div v-else class="text-center py-8">
                        <p :class="isDarkMode ? 'text-gray-400' : 'text-gray-500'">No recent activities</p>
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>

<script setup lang="ts">
import { ref, onMounted, onUnmounted } from 'vue'
import { Head, router } from '@inertiajs/vue3'
import AdminLayout from '@/layouts/AdminLayout.vue'

defineProps({
    activities: Array
})

// Dark mode state
const isDarkMode = ref(false)

const initializeDarkMode = () => {
    const saved = localStorage.getItem('adminDarkMode')
    if (saved !== null) {
        isDarkMode.value = JSON.parse(saved)
    }
}

const handleStorageChange = (e) => {
    if (e.key === 'adminDarkMode') {
        isDarkMode.value = JSON.parse(e.newValue)
    }
}

const handleDarkModeChange = (e) => {
    isDarkMode.value = e.detail.isDarkMode
}

onMounted(() => {
    initializeDarkMode()
    window.addEventListener('storage', handleStorageChange)
    window.addEventListener('adminDarkModeChanged', handleDarkModeChange)
})

onUnmounted(() => {
    window.removeEventListener('storage', handleStorageChange)
    window.removeEventListener('adminDarkModeChanged', handleDarkModeChange)
})

const getActivityDescription = (activity) => {
    const descriptions = {
        'page_view': `Viewed ${activity.page_title || 'a page'}`,
        'click': `Clicked on ${activity.element_text || 'an element'}`,
        'form_submit': `Submitted ${activity.form_id || 'a form'}`,
        'scroll': `Scrolled on ${activity.page_title || 'a page'}`,
        'login': 'Logged in to the platform',
        'logout': 'Logged out of the platform',
        'purchase': `Purchased ${activity.product_name || 'a product'}`,
        'quiz_start': 'Started a quiz',
        'quiz_complete': 'Completed a quiz',
        'lesson_complete': 'Completed a lesson',
    }
    
    return descriptions[activity.action_type] || activity.action_type
}

const getActivityTypeClass = (type) => {
    const classes = {
        'page_view': 'bg-blue-100 text-blue-800',
        'click': 'bg-gray-100 text-gray-800',
        'form_submit': 'bg-green-100 text-green-800',
        'purchase': 'bg-purple-100 text-purple-800',
        'quiz_complete': 'bg-yellow-100 text-yellow-800',
        'login': 'bg-indigo-100 text-indigo-800',
    }
    
    return classes[type] || 'bg-gray-100 text-gray-800'
}

const formatTime = (timestamp) => {
    if (!timestamp) return 'Unknown'
    const date = new Date(timestamp)
    const now = new Date()
    const diff = Math.floor((now - date) / 1000) // Seconds
    
    if (diff < 60) return 'Just now'
    if (diff < 3600) return `${Math.floor(diff / 60)} min ago`
    if (diff < 86400) return `${Math.floor(diff / 3600)} hours ago`
    return date.toLocaleDateString()
}

const refreshActivities = () => {
    router.reload()
}
</script>