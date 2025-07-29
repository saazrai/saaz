<template>
    <AdminLayout>
        <Head title="User Tracking" />
        
        <div class="p-6">
            <div class="mb-6">
                <h1 :class="isDarkMode ? 'text-white' : 'text-gray-900'" class="text-2xl font-semibold">User Tracking</h1>
                <p :class="isDarkMode ? 'text-gray-300' : 'text-gray-600'">Monitor user activity and behavior</p>
            </div>

            <!-- Time Range Selector -->
            <div class="mb-6">
                <select v-model="timeRange" @change="loadData" 
                        :class="[
                            isDarkMode ? 'bg-gray-700 border-gray-600 text-white' : 'bg-white border-gray-300 text-gray-900',
                            'form-select rounded-md shadow-sm'
                        ]">
                    <option value="1">Last hour</option>
                    <option value="24">Last 24 hours</option>
                    <option value="48">Last 48 hours</option>
                    <option value="168">Last week</option>
                </select>
            </div>

            <!-- Activity Summary -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div :class="isDarkMode ? 'bg-gray-800' : 'bg-white'" class="p-6 rounded-lg shadow">
                    <h3 :class="isDarkMode ? 'text-gray-400' : 'text-gray-500'" class="text-sm font-medium">Total Activities</h3>
                    <p :class="isDarkMode ? 'text-white' : 'text-gray-900'" class="text-2xl font-bold mt-2">{{ activitySummary.total_activities || 0 }}</p>
                </div>
                <div :class="isDarkMode ? 'bg-gray-800' : 'bg-white'" class="p-6 rounded-lg shadow">
                    <h3 :class="isDarkMode ? 'text-gray-400' : 'text-gray-500'" class="text-sm font-medium">Unique Users</h3>
                    <p :class="isDarkMode ? 'text-white' : 'text-gray-900'" class="text-2xl font-bold mt-2">{{ activitySummary.unique_users || 0 }}</p>
                </div>
                <div :class="isDarkMode ? 'bg-gray-800' : 'bg-white'" class="p-6 rounded-lg shadow">
                    <h3 :class="isDarkMode ? 'text-gray-400' : 'text-gray-500'" class="text-sm font-medium">Most Visited Page</h3>
                    <p :class="isDarkMode ? 'text-white' : 'text-gray-900'" class="text-sm font-medium mt-2">{{ getMostVisitedPage() }}</p>
                </div>
            </div>

            <!-- Tracked Users Table -->
            <div :class="isDarkMode ? 'bg-gray-800' : 'bg-white'" class="rounded-lg shadow">
                <div :class="isDarkMode ? 'border-gray-700' : 'border-gray-200'" class="px-6 py-4 border-b">
                    <h3 :class="isDarkMode ? 'text-white' : 'text-gray-900'" class="text-lg font-medium">Tracked Users</h3>
                </div>
                <div class="p-6">
                    <table class="min-w-full">
                        <thead>
                            <tr :class="isDarkMode ? 'text-gray-400' : 'text-gray-500'" class="text-left text-sm font-medium">
                                <th class="pb-3">User</th>
                                <th class="pb-3">Activities</th>
                                <th class="pb-3">Last Activity</th>
                                <th class="pb-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody :class="isDarkMode ? 'divide-gray-700' : 'divide-gray-200'" class="divide-y">
                            <tr v-for="user in trackedUsers.data" :key="user.id">
                                <td class="py-3">
                                    <div>
                                        <p :class="isDarkMode ? 'text-white' : 'text-gray-900'" class="font-medium">{{ user.name }}</p>
                                        <p :class="isDarkMode ? 'text-gray-400' : 'text-gray-500'" class="text-sm">{{ user.email }}</p>
                                    </div>
                                </td>
                                <td :class="isDarkMode ? 'text-white' : 'text-gray-900'" class="py-3">{{ user.activities_count }}</td>
                                <td :class="isDarkMode ? 'text-white' : 'text-gray-900'" class="py-3">{{ formatDate(user.last_activity) }}</td>
                                <td class="py-3">
                                    <button @click="viewUserDetails(user.id)" 
                                            :class="isDarkMode ? 'text-blue-400 hover:text-blue-300' : 'text-indigo-600 hover:text-indigo-900'"
                                            class="text-sm">
                                        View Details
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>

<script setup lang="ts">
import { ref, onMounted, onUnmounted } from 'vue'
import { Head } from '@inertiajs/vue3'
import AdminLayout from '@/layouts/AdminLayout.vue'

const props = defineProps({
    trackedUsers: Object,
    activitySummary: Object,
    timeRange: String
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

const timeRange = ref(props.timeRange || '24')

const loadData = () => {
    window.location.href = `/admin/user-tracking?time_range=${timeRange.value}`
}

const getMostVisitedPage = () => {
    if (props.activitySummary.most_visited_pages?.length > 0) {
        return props.activitySummary.most_visited_pages[0].page_url
    }
    return 'N/A'
}

const formatDate = (date) => {
    if (!date) return 'Never'
    return new Date(date).toLocaleString()
}

const viewUserDetails = (userId) => {
    // Implement user details modal or navigation
    console.log('View details for user:', userId)
}
</script>