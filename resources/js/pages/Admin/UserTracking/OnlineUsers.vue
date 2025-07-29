<template>
    <AdminLayout>
        <Head title="Online Users" />
        
        <div class="p-6">
            <div class="mb-6">
                <h1 :class="isDarkMode ? 'text-white' : 'text-gray-900'" class="text-2xl font-semibold">Online Users</h1>
                <p :class="isDarkMode ? 'text-gray-300' : 'text-gray-600'">Users currently active on the platform</p>
            </div>

            <!-- Summary -->
            <div :class="isDarkMode ? 'bg-gray-800' : 'bg-white'" class="p-6 rounded-lg shadow mb-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div :class="isDarkMode ? 'bg-green-900' : 'bg-green-100'" class="h-12 w-12 rounded-full flex items-center justify-center">
                            <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <h2 :class="isDarkMode ? 'text-white' : 'text-gray-900'" class="text-3xl font-bold">{{ totalOnline }}</h2>
                        <p :class="isDarkMode ? 'text-gray-400' : 'text-gray-500'">Users online now</p>
                    </div>
                </div>
            </div>

            <!-- Online Users List -->
            <div :class="isDarkMode ? 'bg-gray-800' : 'bg-white'" class="rounded-lg shadow">
                <div :class="isDarkMode ? 'border-gray-700' : 'border-gray-200'" class="px-6 py-4 border-b">
                    <h3 :class="isDarkMode ? 'text-white' : 'text-gray-900'" class="text-lg font-medium">Active Users</h3>
                </div>
                <div class="p-6">
                    <div v-if="onlineUsers.length > 0" class="space-y-4">
                        <div v-for="user in onlineUsers" :key="user.id" 
                             :class="[
                                 isDarkMode ? 'border-gray-700 hover:bg-gray-700' : 'border-gray-200 hover:bg-gray-50',
                                 'flex items-center justify-between p-4 border rounded-lg'
                             ]">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <div :class="isDarkMode ? 'bg-gray-600' : 'bg-gray-300'" class="h-10 w-10 rounded-full flex items-center justify-center">
                                        <span :class="isDarkMode ? 'text-gray-200' : 'text-gray-600'" class="font-medium">
                                            {{ user.name.charAt(0).toUpperCase() }}
                                        </span>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <p :class="isDarkMode ? 'text-white' : 'text-gray-900'" class="text-sm font-medium">{{ user.name }}</p>
                                    <p :class="isDarkMode ? 'text-gray-400' : 'text-gray-500'" class="text-sm">{{ user.email }}</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p :class="isDarkMode ? 'text-white' : 'text-gray-900'" class="text-sm">{{ formatLastActivity(user.last_activity) }}</p>
                                <p :class="isDarkMode ? 'text-gray-400' : 'text-gray-500'" class="text-xs">{{ user.ip_address }}</p>
                            </div>
                        </div>
                    </div>
                    <div v-else class="text-center py-8">
                        <p :class="isDarkMode ? 'text-gray-400' : 'text-gray-500'">No users online at the moment</p>
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>

<script setup lang="ts">
import { ref, onMounted, onUnmounted } from 'vue'
import { Head } from '@inertiajs/vue3'
import AdminLayout from '@/Layouts/AdminLayout.vue'

defineProps({
    onlineUsers: Array,
    totalOnline: Number
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

const formatLastActivity = (timestamp) => {
    if (!timestamp) return 'Unknown'
    const date = new Date(timestamp * 1000) // Convert from Unix timestamp
    const now = new Date()
    const diff = Math.floor((now - date) / 1000 / 60) // Minutes
    
    if (diff < 1) return 'Just now'
    if (diff < 60) return `${diff} minutes ago`
    if (diff < 1440) return `${Math.floor(diff / 60)} hours ago`
    return `${Math.floor(diff / 1440)} days ago`
}
</script>