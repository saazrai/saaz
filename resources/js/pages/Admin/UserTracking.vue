<template>
  <AdminLayout :pageTitle="`Track User: ${user?.name || 'Unknown'}`">
    <!-- Back Navigation -->
    <div class="mb-6">
      <Button variant="outline" @click="goBack" class="flex items-center gap-2">
        <ArrowLeft class="h-4 w-4" />
        Back to Live Monitor
      </Button>
    </div>

    <!-- User Details Header -->
    <Card :class="[isDarkMode ? 'bg-gray-800 border-gray-700' : '']" class="mb-6">
      <CardContent class="p-6">
        <div class="flex items-center gap-6">
          <div class="relative">
            <div class="w-16 h-16 bg-blue-500 rounded-full flex items-center justify-center text-white font-semibold text-xl">
              {{ user?.name?.charAt(0)?.toUpperCase() || 'U' }}
            </div>
            <div v-if="isUserOnline" class="absolute -bottom-1 -right-1 w-5 h-5 bg-green-500 border-2 border-white rounded-full"></div>
          </div>
          <div class="flex-1">
            <h1 :class="[isDarkMode ? 'text-white' : '']" class="text-2xl font-bold">{{ user?.name || 'Unknown User' }}</h1>
            <p :class="[isDarkMode ? 'text-gray-400' : 'text-muted-foreground']">{{ user?.email }}</p>
            <div class="flex items-center gap-4 mt-2">
              <Badge :variant="isUserOnline ? 'default' : 'secondary'" 
                     :class="isUserOnline ? 'bg-green-600 text-white hover:bg-green-700' : 'bg-gray-400 text-white'">
                {{ isUserOnline ? 'Online' : 'Offline' }}
              </Badge>
              <span :class="[isDarkMode ? 'text-gray-400' : 'text-muted-foreground']" class="text-sm">
                Active for {{ formatDynamicDuration(currentSessionDuration) }}
              </span>
            </div>
          </div>
          <div class="flex gap-2">
            <Button variant="outline" size="sm" @click="sendMessage">
              <MessageCircle class="h-4 w-4 mr-2" />
              Send Message
            </Button>
            <Button variant="outline" size="sm" @click="viewProfile">
              <User class="h-4 w-4 mr-2" />
              View Profile
            </Button>
            <Button size="sm" @click="refreshData">
              <RefreshCw class="h-4 w-4 mr-2" />
              Refresh
            </Button>
          </div>
        </div>
      </CardContent>
    </Card>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
      <Card :class="[isDarkMode ? 'bg-gray-800 border-gray-700' : '']">
        <CardContent class="p-4">
          <div class="flex items-center gap-2">
            <Clock :class="[isDarkMode ? 'text-gray-400' : 'text-muted-foreground']" class="h-4 w-4" />
            <span :class="[isDarkMode ? 'text-gray-200' : '']" class="text-sm font-medium">Session Time</span>
          </div>
          <p :class="[isDarkMode ? 'text-white' : '']" class="text-2xl font-bold mt-2">{{ formatDynamicDuration(currentSessionDuration) }}</p>
          <p :class="[isDarkMode ? 'text-gray-400' : 'text-muted-foreground']" class="text-xs">Current session</p>
        </CardContent>
      </Card>

      <Card :class="[isDarkMode ? 'bg-gray-800 border-gray-700' : '']">
        <CardContent class="p-4">
          <div class="flex items-center gap-2">
            <Activity :class="[isDarkMode ? 'text-gray-400' : 'text-muted-foreground']" class="h-4 w-4" />
            <span :class="[isDarkMode ? 'text-gray-200' : '']" class="text-sm font-medium">Actions</span>
          </div>
          <p :class="[isDarkMode ? 'text-white' : '']" class="text-2xl font-bold mt-2">{{ userActivity?.actions_count || 0 }}</p>
          <p :class="[isDarkMode ? 'text-gray-400' : 'text-muted-foreground']" class="text-xs">This session</p>
        </CardContent>
      </Card>

      <Card :class="[isDarkMode ? 'bg-gray-800 border-gray-700' : '']">
        <CardContent class="p-4">
          <div class="flex items-center gap-2">
            <MapPin :class="[isDarkMode ? 'text-gray-400' : 'text-muted-foreground']" class="h-4 w-4" />
            <span :class="[isDarkMode ? 'text-gray-200' : '']" class="text-sm font-medium">Current Page</span>
          </div>
          <p :class="[isDarkMode ? 'text-white' : '']" class="text-sm font-bold mt-2">{{ userActivity?.current_page || 'Unknown' }}</p>
          <p :class="[isDarkMode ? 'text-gray-400' : 'text-muted-foreground']" class="text-xs">{{ formatTimeAgo(userActivity?.last_activity) }}</p>
        </CardContent>
      </Card>

      <Card :class="[isDarkMode ? 'bg-gray-800 border-gray-700' : '']">
        <CardContent class="p-4">
          <div class="flex items-center gap-2">
            <Eye :class="[isDarkMode ? 'text-gray-400' : 'text-muted-foreground']" class="h-4 w-4" />
            <span :class="[isDarkMode ? 'text-gray-200' : '']" class="text-sm font-medium">Pages Visited</span>
          </div>
          <p :class="[isDarkMode ? 'text-white' : '']" class="text-2xl font-bold mt-2">{{ userSession?.pages_visited || 0 }}</p>
          <p :class="[isDarkMode ? 'text-gray-400 hover:text-blue-400' : 'text-muted-foreground hover:text-blue-600']" class="text-xs cursor-pointer" @click="showPagesModal = true">
            Click to view details
          </p>
        </CardContent>
      </Card>
    </div>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
      <!-- Live Activity Feed -->
      <Card :class="[isDarkMode ? 'bg-gray-800 border-gray-700' : '']" class="flex flex-col h-full">
        <CardHeader>
          <CardTitle :class="[isDarkMode ? 'text-white' : '']" class="flex items-center gap-2">
            <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
            Live Activity Feed
          </CardTitle>
          <CardDescription :class="[isDarkMode ? 'text-gray-400' : '']">Real-time user actions and navigation (newest first)</CardDescription>
        </CardHeader>
        <CardContent class="flex-1 flex flex-col min-h-0">
          <div class="flex-1 space-y-3 overflow-y-auto min-h-[500px] max-h-[calc(100vh-400px)]">
            <div v-for="activity in liveActivities" :key="activity.id" :class="[
              'flex items-start gap-3 p-3 rounded-lg border transition-colors',
              isDarkMode ? 'border-gray-600 hover:bg-gray-700' : 'hover:bg-gray-50'
            ]">
              <div :class="[
                'w-8 h-8 rounded-full flex items-center justify-center text-white text-xs flex-shrink-0',
                getActivityColor(activity.action)
              ]">
                <component :is="getActivityIcon(activity.action)" class="h-4 w-4" />
              </div>
              <div class="flex-1 min-w-0">
                <p :class="[isDarkMode ? 'text-gray-200' : '']" class="text-sm font-medium">{{ activity.description }}</p>
                <p :class="[isDarkMode ? 'text-gray-400' : 'text-muted-foreground']" class="text-xs truncate">{{ activity.page || activity.url }}</p>
                <p :class="[isDarkMode ? 'text-gray-400' : 'text-muted-foreground']" class="text-xs">{{ formatTimeAgo(activity.timestamp) }}</p>
              </div>
            </div>
            <div v-if="liveActivities.length === 0" class="text-center py-8">
              <Activity :class="[isDarkMode ? 'text-gray-400' : 'text-muted-foreground']" class="h-8 w-8 mx-auto mb-2" />
              <p :class="[isDarkMode ? 'text-gray-400' : 'text-muted-foreground']" class="text-sm">No recent activity</p>
              <p :class="[isDarkMode ? 'text-gray-400' : 'text-muted-foreground']" class="text-xs">Activity will appear here in real-time</p>
            </div>
          </div>
          
          <!-- Load More Button -->
          <div v-if="canLoadMore" :class="[isDarkMode ? 'border-gray-600' : '']" class="mt-4 text-center border-t pt-4">
            <Button variant="outline" size="sm" @click="loadMoreActivities" :disabled="isLoadingMore">
              <RefreshCw v-if="isLoadingMore" class="h-4 w-4 mr-2 animate-spin" />
              <span v-else>Load Previous Activities</span>
            </Button>
          </div>
        </CardContent>
      </Card>

      <!-- User Information & Session Details -->
      <div class="space-y-6">
        <!-- User Information -->
        <Card :class="[isDarkMode ? 'bg-gray-800 border-gray-700' : '']">
          <CardHeader>
            <CardTitle :class="[isDarkMode ? 'text-white' : '']">User Information</CardTitle>
            <CardDescription :class="[isDarkMode ? 'text-gray-400' : '']">Account details and statistics</CardDescription>
          </CardHeader>
          <CardContent>
            <div class="space-y-4">
              <div class="grid grid-cols-2 gap-4">
                <div>
                  <label :class="[isDarkMode ? 'text-gray-400' : 'text-muted-foreground']" class="text-sm font-medium">User ID</label>
                  <p :class="[isDarkMode ? 'text-gray-200' : '']" class="text-sm">{{ user?.id }}</p>
                </div>
                <div>
                  <label :class="[isDarkMode ? 'text-gray-400' : 'text-muted-foreground']" class="text-sm font-medium">Role</label>
                  <p :class="[isDarkMode ? 'text-gray-200' : '']" class="text-sm">{{ user?.role || 'Student' }}</p>
                </div>
                <div>
                  <label :class="[isDarkMode ? 'text-gray-400' : 'text-muted-foreground']" class="text-sm font-medium">Joined</label>
                  <p :class="[isDarkMode ? 'text-gray-200' : '']" class="text-sm">{{ formatDate(user?.created_at) }}</p>
                </div>
                <div>
                  <label :class="[isDarkMode ? 'text-gray-400' : 'text-muted-foreground']" class="text-sm font-medium">Last Login</label>
                  <p :class="[isDarkMode ? 'text-gray-200' : '']" class="text-sm">{{ formatDate(user?.last_login_at) }}</p>
                </div>
              </div>

              <Separator :class="[isDarkMode ? 'bg-gray-600' : '']" />

              <div class="space-y-3">
                <div class="flex justify-between">
                  <span :class="[isDarkMode ? 'text-gray-400' : 'text-muted-foreground']" class="text-sm">Total Courses</span>
                  <span :class="[isDarkMode ? 'text-gray-200' : '']" class="text-sm font-medium">{{ userStats?.courses_enrolled || 0 }}</span>
                </div>
                <div class="flex justify-between">
                  <span :class="[isDarkMode ? 'text-gray-400' : 'text-muted-foreground']" class="text-sm">Completed Assessments</span>
                  <span :class="[isDarkMode ? 'text-gray-200' : '']" class="text-sm font-medium">{{ userStats?.assessments_completed || 0 }}</span>
                </div>
                <div class="flex justify-between">
                  <span :class="[isDarkMode ? 'text-gray-400' : 'text-muted-foreground']" class="text-sm">Average Score</span>
                  <span :class="[isDarkMode ? 'text-gray-200' : '']" class="text-sm font-medium">{{ Math.round(userStats?.average_score || 0) }}%</span>
                </div>
                <div class="flex justify-between">
                  <span :class="[isDarkMode ? 'text-gray-400' : 'text-muted-foreground']" class="text-sm">Total Purchases</span>
                  <span :class="[isDarkMode ? 'text-gray-200' : '']" class="text-sm font-medium">${{ userStats?.total_spent || 0 }}</span>
                </div>
              </div>
            </div>
          </CardContent>
        </Card>

        <!-- Session Details -->
        <Card :class="[isDarkMode ? 'bg-gray-800 border-gray-700' : '']">
          <CardHeader>
            <CardTitle :class="[isDarkMode ? 'text-white' : '']">Session Details</CardTitle>
            <CardDescription :class="[isDarkMode ? 'text-gray-400' : '']">Current session information and browser details</CardDescription>
          </CardHeader>
          <CardContent>
            <div class="space-y-3">
              <div class="flex justify-between">
                <span :class="[isDarkMode ? 'text-gray-400' : 'text-muted-foreground']" class="text-sm">IP Address</span>
                <span :class="[isDarkMode ? 'text-gray-200' : '']" class="text-sm font-medium">{{ userSession?.ip_address || 'Unknown' }}</span>
              </div>
              <div class="flex justify-between">
                <span :class="[isDarkMode ? 'text-gray-400' : 'text-muted-foreground']" class="text-sm">Location</span>
                <span :class="[isDarkMode ? 'text-gray-200' : '']" class="text-sm font-medium">{{ userSession?.location || 'Unknown' }}</span>
              </div>
              <div class="flex justify-between">
                <span :class="[isDarkMode ? 'text-gray-400' : 'text-muted-foreground']" class="text-sm">Session Started</span>
                <span :class="[isDarkMode ? 'text-gray-200' : '']" class="text-sm font-medium">{{ formatDate(userSession?.started_at) }}</span>
              </div>
              <div class="flex justify-between">
                <span :class="[isDarkMode ? 'text-gray-400' : 'text-muted-foreground']" class="text-sm">Last Activity</span>
                <span :class="[isDarkMode ? 'text-gray-200' : '']" class="text-sm font-medium">{{ formatTimeAgo(userSession?.last_activity) }}</span>
              </div>
              <div class="flex justify-between">
                <span :class="[isDarkMode ? 'text-gray-400' : 'text-muted-foreground']" class="text-sm">User Agent</span>
                <span :class="[isDarkMode ? 'text-gray-200' : '']" class="text-sm font-medium truncate" :title="userSession?.user_agent">
                  {{ userSession?.user_agent ? userSession.user_agent.substring(0, 30) + '...' : 'Unknown' }}
                </span>
              </div>
            </div>
          </CardContent>
        </Card>

        <!-- Visited Pages -->
        <Card :class="[isDarkMode ? 'bg-gray-800 border-gray-700' : '']">
          <CardHeader>
            <CardTitle :class="[isDarkMode ? 'text-white' : '']" class="flex items-center gap-2">
              <Eye class="h-4 w-4" />
              Visited Pages
            </CardTitle>
            <CardDescription :class="[isDarkMode ? 'text-gray-400' : '']">Pages visited during this session</CardDescription>
          </CardHeader>
          <CardContent>
            <div class="space-y-2 max-h-48 overflow-y-auto">
              <div v-for="(page, index) in userActivity?.unique_pages || []" :key="index" :class="[
                'flex items-center gap-2 p-2 rounded border transition-colors',
                isDarkMode ? 'border-gray-600 hover:bg-gray-700' : 'hover:bg-gray-50'
              ]">
                <FileText :class="[isDarkMode ? 'text-gray-400' : 'text-muted-foreground']" class="h-4 w-4 flex-shrink-0" />
                <div class="flex-1 min-w-0">
                  <p :class="[isDarkMode ? 'text-gray-200' : '']" class="text-sm font-medium truncate" :title="page">{{ getPageTitle(page) }}</p>
                  <p :class="[isDarkMode ? 'text-gray-400' : 'text-muted-foreground']" class="text-xs truncate">{{ page }}</p>
                </div>
              </div>
              <div v-if="!userActivity?.unique_pages || userActivity.unique_pages.length === 0" class="text-center py-4">
                <FileText :class="[isDarkMode ? 'text-gray-400' : 'text-muted-foreground']" class="h-6 w-6 mx-auto mb-2" />
                <p :class="[isDarkMode ? 'text-gray-400' : 'text-muted-foreground']" class="text-sm">No pages visited yet</p>
              </div>
            </div>
          </CardContent>
        </Card>
      </div>
    </div>

    <!-- Visited Pages Modal -->
    <div v-if="showPagesModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50" @click="showPagesModal = false">
      <div :class="[
        isDarkMode ? 'bg-gray-800 text-white border border-gray-700' : 'bg-white text-gray-900 border border-gray-200',
        'rounded-lg p-6 max-w-2xl w-full mx-4 max-h-[80vh] overflow-hidden shadow-lg transition-colors duration-200'
      ]" @click.stop>
        <div class="flex items-center justify-between mb-4">
          <h3 :class="[isDarkMode ? 'text-white' : 'text-gray-900']" class="text-lg font-semibold">Pages Visited This Session</h3>
          <button @click="showPagesModal = false" :class="[isDarkMode ? 'text-gray-400 hover:text-gray-300' : 'text-gray-400 hover:text-gray-600', 'transition-colors']">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
          </button>
        </div>
        <div class="space-y-3 max-h-96 overflow-y-auto">
          <div v-for="(page, index) in visitedPagesWithTime" :key="index"
               :class="[
                 'flex items-center gap-3 p-3 rounded-lg border transition-colors',
                 isDarkMode ? 'border-gray-600 bg-gray-700 hover:bg-gray-600' : 'border-gray-200 bg-white hover:bg-gray-50'
               ]">
            <FileText :class="[isDarkMode ? 'text-blue-400' : 'text-blue-500']" class="h-5 w-5 flex-shrink-0" />
            <div class="flex-1 min-w-0">
              <p :class="[isDarkMode ? 'text-gray-200' : 'text-gray-900']" class="text-sm font-medium truncate" :title="page.url">{{ getPageTitle(page.url) }}</p>
              <p :class="[isDarkMode ? 'text-gray-400' : 'text-gray-500']" class="text-xs truncate">{{ page.url }}</p>
              <p :class="[isDarkMode ? 'text-gray-500' : 'text-gray-400']" class="text-xs">{{ formatTimeAgo(page.visited_at) }}</p>
            </div>
            <div class="text-right">
              <p :class="[isDarkMode ? 'text-gray-400' : 'text-gray-500']" class="text-xs">{{ page.visit_count }} visit{{ page.visit_count > 1 ? 's' : '' }}</p>
            </div>
          </div>
          <div v-if="visitedPagesWithTime.length === 0" class="text-center py-8">
            <FileText :class="[isDarkMode ? 'text-gray-500' : 'text-gray-400']" class="h-8 w-8 mx-auto mb-2" />
            <p :class="[isDarkMode ? 'text-gray-400' : 'text-gray-500']" class="text-sm">No pages visited yet</p>
          </div>
        </div>
      </div>
    </div>
  </AdminLayout>
</template>

<script setup lang="ts">
import { ref, onMounted, onUnmounted, computed } from 'vue'
import { router } from '@inertiajs/vue3'
import AdminLayout from '@/layouts/AdminLayout.vue'
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/shadcn/ui/card'
import { Button } from '@/components/shadcn/ui/button'
import { Badge } from '@/components/shadcn/ui/badge'
import { Separator } from '@/components/shadcn/ui/separator'
import { 
  Clock, 
  Activity, 
  MapPin, 
  User, 
  MessageCircle, 
  RefreshCw,
  Eye,
  MousePointer,
  Navigation,
  FileText,
  Play,
  Award,
  ArrowLeft
} from 'lucide-vue-next'

const props = defineProps({
  user: Object
})

// Dark mode state management
const isDarkMode = ref(false)

// Initialize dark mode from localStorage
const initializeDarkMode = () => {
  const saved = localStorage.getItem('adminDarkMode')
  if (saved !== null) {
    isDarkMode.value = JSON.parse(saved)
  }
}

// Listen for dark mode changes
const handleDarkModeChange = (event) => {
  if (event.key === 'adminDarkMode') {
    isDarkMode.value = JSON.parse(event.newValue || 'false')
  }
}

const handleCustomDarkModeChange = (event) => {
  isDarkMode.value = event.detail.isDarkMode
}

// Reactive state
const userActivity = ref({})
const userStats = ref({})
const userSession = ref({})
const liveActivities = ref([])
const currentSessionDuration = ref(0)
const sessionStartTime = ref(null)
const showPagesModal = ref(false)
const isLoadingMore = ref(false)
const canLoadMore = ref(false)
const activitiesPage = ref(1)
const activitiesPerPage = 50
const isUserOnline = ref(props.user?.is_online || false) // Track online status reactively

// Real-time tracking
let userTrackingChannel = null
let timeUpdateInterval = null

// Computed properties
const visitedPagesWithTime = computed(() => {
  if (!liveActivities.value || liveActivities.value.length === 0) {
    return []
  }
  
  // Get page view activities and group by URL
  const pageViews = liveActivities.value.filter(activity => activity.action === 'page_view')
  const pageMap = new Map()
  
  pageViews.forEach(activity => {
    const url = activity.page || activity.url || 'Unknown'
    if (pageMap.has(url)) {
      const existing = pageMap.get(url)
      existing.visit_count++
      // Keep the most recent visit time
      if (new Date(activity.timestamp) > new Date(existing.visited_at)) {
        existing.visited_at = activity.timestamp
      }
    } else {
      pageMap.set(url, {
        url: url,
        visited_at: activity.timestamp,
        visit_count: 1
      })
    }
  })
  
  // Convert to array and sort by most recent visit
  return Array.from(pageMap.values()).sort((a, b) => 
    new Date(b.visited_at) - new Date(a.visited_at)
  )
})

onMounted(() => {
  // Initialize dark mode
  initializeDarkMode()
  
  // Listen for dark mode changes
  window.addEventListener('storage', handleDarkModeChange)
  window.addEventListener('adminDarkModeChanged', handleCustomDarkModeChange)
  
  fetchUserData()
  
  // Start time tracking if user is online
  if (isUserOnline.value) {
    startTimeTracking()
  }
  
  // Listen for user offline events from AdminLayout
  window.addEventListener('admin-user-left', handleUserOfflineEvent)
  
  // Listen for user online events from AdminLayout
  window.addEventListener('admin-user-joined', handleUserOnlineEvent)
  
  // Also start tracking for real-time updates
  startUserTracking()
})

onUnmounted(() => {
  stopUserTracking()
  stopTimeTracking()
  
  // Remove event listeners
  window.removeEventListener('storage', handleDarkModeChange)
  window.removeEventListener('adminDarkModeChanged', handleCustomDarkModeChange)
  window.removeEventListener('admin-user-left', handleUserOfflineEvent)
  window.removeEventListener('admin-user-joined', handleUserOnlineEvent)
})

const startUserTracking = async () => {
  if (!props.user?.id) return

  try {
    // Fetch initial user data
    await fetchUserData()
    
    // Start real-time tracking
    userTrackingChannel = window.Echo.private(`user-tracking.${props.user.id}`)
      .listen('UserActivityUpdate', (e) => {
        console.log('👤 User activity update:', e)
        updateUserActivity(e.data)
      })
      .listen('UserPageView', (e) => {
        console.log('📄 User page view:', e)
        addLiveActivity({
          id: Date.now(),
          action: 'page_view',
          description: `Viewed ${e.page_title || e.url}`,
          page: e.url,
          timestamp: new Date()
        })
      })
      .listen('UserAction', (e) => {
        console.log('🎯 User action:', e)
        addLiveActivity({
          id: Date.now(),
          action: e.action_type,
          description: e.description,
          page: e.page,
          timestamp: new Date()
        })
      })

    // Listen for AdminLayout activity events
    window.addEventListener('admin-user-activity', (event) => {
      const detail = event.detail
      if (detail.user && detail.user.id === props.user?.id) {
        console.log('📈 User activity from AdminLayout:', detail)
        addLiveActivity({
          id: Date.now(),
          action: detail.activity.action,
          description: detail.activity.description,
          page: detail.activity.page,
          timestamp: detail.timestamp || new Date()
        })
        
        // Update activity stats
        userActivity.value.actions_count = (userActivity.value.actions_count || 0) + 1
        userActivity.value.last_activity = detail.timestamp || new Date()
        userActivity.value.current_page = detail.activity.page || userActivity.value.current_page
      }
    })

    console.log(`🔍 Started tracking user: ${props.user.name}`)
  } catch (error) {
    console.error('Failed to start user tracking:', error)
    
    // Always provide fallback data regardless of API failure
    sessionStartTime.value = new Date(Date.now() - (Math.random() * 3600000)) // Random start time within last hour
    updateSessionDuration()
    
    // Mock some basic data
    userActivity.value = {
      current_page: 'Dashboard',
      last_activity: new Date(),
      actions_count: Math.floor(Math.random() * 20),
      pages_visited: Math.floor(Math.random() * 10) + 1
    }
    
    userSession.value = {
      started_at: sessionStartTime.value,
      ip_address: '127.0.0.1',
      user_agent: 'Chrome/91.0.4472.124',
      location: 'Local Development',
      last_activity: new Date(),
      pages_visited: Math.floor(Math.random() * 10) + 1
    }
    
    userStats.value = {
      courses_enrolled: Math.floor(Math.random() * 5),
      assessments_completed: Math.floor(Math.random() * 15),
      average_score: Math.floor(Math.random() * 40) + 60, // 60-100%
      total_spent: Math.floor(Math.random() * 500)
    }
  }
}

const stopUserTracking = () => {
  if (userTrackingChannel) {
    window.Echo.leave(`user-tracking.${props.user.id}`)
    userTrackingChannel = null
  }
}

const startTimeTracking = () => {
  // Set session start time (either from user data or current time)
  sessionStartTime.value = userSession.value?.started_at ? new Date(userSession.value.started_at) : new Date()
  
  // Update current session duration
  updateSessionDuration()
  
  // Start interval to update time every minute
  timeUpdateInterval = setInterval(() => {
    updateSessionDuration()
  }, 60000) // Update every minute
}

const stopTimeTracking = () => {
  if (timeUpdateInterval) {
    clearInterval(timeUpdateInterval)
    timeUpdateInterval = null
  }
}

const updateSessionDuration = () => {
  if (sessionStartTime.value) {
    const now = new Date()
    const diffInSeconds = Math.floor((now - sessionStartTime.value) / 1000)
    currentSessionDuration.value = diffInSeconds
  }
}

const fetchUserData = async () => {
  try {
    const response = await fetch(`/admin/realtime/users/${props.user.id}/tracking-data`)
    const data = await response.json()
    
    userActivity.value = data.activity || {}
    userStats.value = data.stats || {}
    userSession.value = data.session || {}
    liveActivities.value = data.recent_activities || []
    canLoadMore.value = data.can_load_more || false
    
    // Update session start time if available
    if (data.session?.started_at) {
      sessionStartTime.value = new Date(data.session.started_at)
      updateSessionDuration()
    }
  } catch (error) {
    console.error('Failed to fetch user data:', error)
    
    // Only use minimal fallback data - no dummy values
    userActivity.value = {
      current_page: 'Unknown',
      last_activity: null,
      actions_count: 0,
      pages_visited: 0,
      unique_pages: []
    }
    
    userSession.value = {
      started_at: null,
      ip_address: 'Unknown',
      user_agent: 'Unknown',
      location: 'Unknown',
      last_activity: null,
      pages_visited: 0
    }
    
    userStats.value = {
      courses_enrolled: 0,
      assessments_completed: 0,
      average_score: 0,
      total_spent: 0
    }
    
    // Reset session time to 0 if no real data
    sessionStartTime.value = null
    currentSessionDuration.value = 0
    
    // Clear activities if no real data
    liveActivities.value = []
    canLoadMore.value = false
  }
}

const updateUserActivity = (activity) => {
  userActivity.value = { ...userActivity.value, ...activity }
}

const addLiveActivity = (activity) => {
  liveActivities.value.unshift(activity)
  // Keep only latest 50 activities in view
  if (liveActivities.value.length > activitiesPerPage) {
    liveActivities.value = liveActivities.value.slice(0, activitiesPerPage)
    canLoadMore.value = true
  }
}

const loadMoreActivities = async () => {
  if (isLoadingMore.value || !props.user?.id) return
  
  isLoadingMore.value = true
  activitiesPage.value++
  
  try {
    const response = await fetch(`/admin/realtime/users/${props.user.id}/activities?page=${activitiesPage.value}&per_page=${activitiesPerPage}`)
    const data = await response.json()
    
    if (data.activities && data.activities.length > 0) {
      // Add older activities to the end of the list
      liveActivities.value.push(...data.activities.map(activity => ({
        id: activity.id,
        action: activity.action_type,
        description: activity.description || formatActivityDescription(activity),
        page: activity.page_url,
        timestamp: activity.created_at
      })))
      
      // Check if there are more activities to load
      canLoadMore.value = data.has_more || false
    } else {
      canLoadMore.value = false
    }
  } catch (error) {
    console.error('Failed to load more activities:', error)
    canLoadMore.value = false
  } finally {
    isLoadingMore.value = false
  }
}

const formatActivityDescription = (activity) => {
  switch (activity.action_type) {
    case 'page_view':
      return 'Viewed ' + (activity.page_title || getPageTitle(activity.page_url))
    case 'click':
      return 'Clicked ' + (activity.element_text || activity.element_type || 'element')
    case 'scroll':
      return 'Scrolled to ' + (activity.scroll_position ? activity.scroll_position + '%' : 'position') + ' of page'
    default:
      return activity.description || activity.action_type.charAt(0).toUpperCase() + activity.action_type.slice(1).replace(/_/g, ' ')
  }
}

const refreshData = async () => {
  try {
    // Refresh user tracking data
    await fetchUserData()
    
    // Also refresh the user's online status from the server
    const response = await fetch(`/admin/realtime/users/${props.user.id}/tracking-data`)
    const data = await response.json()
    
    if (data.session?.is_online !== undefined) {
      // Update the user's online status
      isUserOnline.value = data.session.is_online
      console.log('✅ Refreshed online status:', data.session.is_online)
    }
  } catch (error) {
    console.error('❌ Failed to refresh data:', error)
  }
}

const sendMessage = () => {
  // Implement messaging functionality
  console.log('Send message to user:', props.user.id)
}

const viewProfile = () => {
  // Navigate to user profile
  window.open(`/admin/users/${props.user.id}`, '_blank')
}

const goBack = () => {
  router.visit('/admin/live-monitor')
}

// Helper functions
const formatDynamicDuration = (seconds) => {
  if (!seconds || seconds < 0) return '0m'
  
  const hours = Math.floor(seconds / 3600)
  const minutes = Math.floor((seconds % 3600) / 60)
  
  if (hours > 0) {
    return `${hours}h ${minutes}m`
  }
  return `${minutes}m`
}

const formatDate = (date) => {
  if (!date) return 'Unknown'
  return new Date(date).toLocaleString('en-US', {
    month: 'short',
    day: 'numeric',
    year: 'numeric',
    hour: '2-digit',
    minute: '2-digit'
  })
}

const formatTimeAgo = (date) => {
  if (!date) return 'Unknown'
  const now = new Date()
  const diff = now - new Date(date)
  const minutes = Math.floor(diff / 60000)
  
  if (minutes < 1) return 'Just now'
  if (minutes < 60) return `${minutes}m ago`
  
  const hours = Math.floor(minutes / 60)
  if (hours < 24) return `${hours}h ago`
  
  const days = Math.floor(hours / 24)
  return `${days}d ago`
}

const getActivityIcon = (action) => {
  const icons = {
    page_view: Eye,
    click: MousePointer,
    navigation: Navigation,
    quiz_start: Play,
    quiz_complete: Award,
    file_download: FileText,
    course_access: FileText
  }
  return icons[action] || Activity
}

const getActivityColor = (action) => {
  const colors = {
    page_view: 'bg-blue-500',
    click: 'bg-green-500',
    navigation: 'bg-purple-500',
    quiz_start: 'bg-orange-500',
    quiz_complete: 'bg-yellow-500',
    file_download: 'bg-indigo-500',
    course_access: 'bg-pink-500',
    scroll: 'bg-teal-500'
  }
  return colors[action] || 'bg-gray-500'
}

const getPageTitle = (url) => {
  if (!url) return 'Unknown Page'
  
  // Extract meaningful page names from URLs
  const pathSegments = url.split('/').filter(segment => segment && segment !== '')
  
  if (pathSegments.length === 0) return 'Home'
  
  const pageMap = {
    'dashboard': 'Dashboard',
    'learn': 'Learning Center',
    'profile': 'User Profile',
    'settings': 'Settings',
    'courses': 'Courses',
    'quiz': 'Quiz',
    'practice': 'Practice',
    'certificates': 'Certificates',
    'admin': 'Admin Panel',
    'live-monitor': 'Live Monitor',
    'track-user': 'User Tracking'
  }
  
  // Check for known page types
  for (const segment of pathSegments) {
    if (pageMap[segment]) {
      return pageMap[segment]
    }
  }
  
  // Fallback to last segment, capitalized
  const lastSegment = pathSegments[pathSegments.length - 1]
  return lastSegment.charAt(0).toUpperCase() + lastSegment.slice(1).replace(/-/g, ' ')
}

// Handle user offline event
const handleUserOfflineEvent = (event) => {
  const leftUser = event.detail?.user
  if (leftUser && leftUser.id === props.user?.id) {
    console.log('🔴 Tracked user went offline:', leftUser.name)
    
    // Update the user's online status
    isUserOnline.value = false
    
    // Stop time tracking since user is offline
    stopTimeTracking()
    
    // Optionally refresh data to get latest state
    refreshData()
  }
}

// Handle user online event
const handleUserOnlineEvent = (event) => {
  const joinedUser = event.detail?.user
  if (joinedUser && joinedUser.id === props.user?.id) {
    console.log('🟢 Tracked user came online:', joinedUser.name)
    
    // Update the user's online status
    isUserOnline.value = true
    
    // Start time tracking since user is online
    startTimeTracking()
    
    // Optionally refresh data to get latest state
    refreshData()
  }
}
</script>