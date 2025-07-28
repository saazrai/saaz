<template>
  <Dialog :open="isOpen" @update:open="$emit('update:open', $event)">
    <DialogContent class="max-w-4xl max-h-[90vh] overflow-y-auto">
      <DialogHeader>
        <DialogTitle class="flex items-center gap-3">
          <div class="relative">
            <div class="w-12 h-12 bg-blue-500 rounded-full flex items-center justify-center text-white font-semibold text-lg">
              {{ user?.name?.charAt(0)?.toUpperCase() || 'U' }}
            </div>
            <div v-if="user?.is_online" class="absolute -bottom-1 -right-1 w-4 h-4 bg-green-500 border-2 border-white rounded-full"></div>
          </div>
          <div>
            <h2 class="text-xl font-semibold">{{ user?.name || 'Unknown User' }}</h2>
            <p class="text-sm text-muted-foreground">{{ user?.email }}</p>
          </div>
          <div class="ml-auto">
            <Badge :variant="user?.is_online ? 'default' : 'secondary'" class="text-xs">
              {{ user?.is_online ? 'Online' : 'Offline' }}
            </Badge>
          </div>
        </DialogTitle>
      </DialogHeader>

      <!-- User Stats Grid -->
      <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <Card>
          <CardContent class="p-4">
            <div class="flex items-center gap-2">
              <Clock class="h-4 w-4 text-muted-foreground" />
              <span class="text-sm font-medium">Active Time</span>
            </div>
            <p class="text-2xl font-bold mt-2">{{ formatDynamicDuration(currentSessionDuration) }}</p>
            <p class="text-xs text-muted-foreground">Current session</p>
          </CardContent>
        </Card>

        <Card>
          <CardContent class="p-4">
            <div class="flex items-center gap-2">
              <Activity class="h-4 w-4 text-muted-foreground" />
              <span class="text-sm font-medium">Actions</span>
            </div>
            <p class="text-2xl font-bold mt-2">{{ userActivity?.actions_count || 0 }}</p>
            <p class="text-xs text-muted-foreground">This session</p>
          </CardContent>
        </Card>

        <Card>
          <CardContent class="p-4">
            <div class="flex items-center gap-2">
              <MapPin class="h-4 w-4 text-muted-foreground" />
              <span class="text-sm font-medium">Current Page</span>
            </div>
            <p class="text-sm font-bold mt-2">{{ userActivity?.current_page || 'Unknown' }}</p>
            <p class="text-xs text-muted-foreground">{{ formatTimeAgo(userActivity?.last_activity) }}</p>
          </CardContent>
        </Card>
      </div>

      <!-- Live Activity Feed -->
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Real-time Activity -->
        <Card>
          <CardHeader>
            <CardTitle class="flex items-center gap-2">
              <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
              Live Activity
            </CardTitle>
            <CardDescription>Real-time user actions and navigation</CardDescription>
          </CardHeader>
          <CardContent>
            <div class="space-y-3 max-h-64 overflow-y-auto">
              <div v-for="activity in liveActivities" :key="activity.id" class="flex items-start gap-3 p-2 rounded-lg border">
                <div :class="[
                  'w-8 h-8 rounded-full flex items-center justify-center text-white text-xs',
                  getActivityColor(activity.action)
                ]">
                  <component :is="getActivityIcon(activity.action)" class="h-4 w-4" />
                </div>
                <div class="flex-1">
                  <p class="text-sm font-medium">{{ activity.description }}</p>
                  <p class="text-xs text-muted-foreground">{{ activity.page || activity.url }}</p>
                  <p class="text-xs text-muted-foreground">{{ formatTimeAgo(activity.timestamp) }}</p>
                </div>
              </div>
              <div v-if="liveActivities.length === 0" class="text-center py-4">
                <p class="text-sm text-muted-foreground">No recent activity</p>
              </div>
            </div>
          </CardContent>
        </Card>

        <!-- User Information -->
        <Card>
          <CardHeader>
            <CardTitle>User Information</CardTitle>
            <CardDescription>Account details and statistics</CardDescription>
          </CardHeader>
          <CardContent>
            <div class="space-y-4">
              <div class="grid grid-cols-2 gap-4">
                <div>
                  <label class="text-sm font-medium text-muted-foreground">User ID</label>
                  <p class="text-sm">{{ user?.id }}</p>
                </div>
                <div>
                  <label class="text-sm font-medium text-muted-foreground">Role</label>
                  <p class="text-sm">{{ user?.role || 'Student' }}</p>
                </div>
                <div>
                  <label class="text-sm font-medium text-muted-foreground">Joined</label>
                  <p class="text-sm">{{ formatDate(user?.created_at) }}</p>
                </div>
                <div>
                  <label class="text-sm font-medium text-muted-foreground">Last Login</label>
                  <p class="text-sm">{{ formatDate(user?.last_login_at) }}</p>
                </div>
              </div>

              <Separator />

              <div class="space-y-3">
                <div class="flex justify-between">
                  <span class="text-sm text-muted-foreground">Total Courses</span>
                  <span class="text-sm font-medium">{{ userStats?.courses_enrolled || 0 }}</span>
                </div>
                <div class="flex justify-between">
                  <span class="text-sm text-muted-foreground">Completed Assessments</span>
                  <span class="text-sm font-medium">{{ userStats?.assessments_completed || 0 }}</span>
                </div>
                <div class="flex justify-between">
                  <span class="text-sm text-muted-foreground">Average Score</span>
                  <span class="text-sm font-medium">{{ Math.round(userStats?.average_score || 0) }}%</span>
                </div>
                <div class="flex justify-between">
                  <span class="text-sm text-muted-foreground">Total Purchases</span>
                  <span class="text-sm font-medium">${{ userStats?.total_spent || 0 }}</span>
                </div>
              </div>
            </div>
          </CardContent>
        </Card>
      </div>

      <!-- Session Details -->
      <Card class="mt-6">
        <CardHeader>
          <CardTitle>Session Details</CardTitle>
          <CardDescription>Current session information and browser details</CardDescription>
        </CardHeader>
        <CardContent>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-3">
              <div class="flex justify-between">
                <span class="text-sm text-muted-foreground">IP Address</span>
                <span class="text-sm font-medium">{{ userSession?.ip_address || 'Unknown' }}</span>
              </div>
              <div class="flex justify-between">
                <span class="text-sm text-muted-foreground">User Agent</span>
                <span class="text-sm font-medium truncate">{{ userSession?.user_agent || 'Unknown' }}</span>
              </div>
              <div class="flex justify-between">
                <span class="text-sm text-muted-foreground">Location</span>
                <span class="text-sm font-medium">{{ userSession?.location || 'Unknown' }}</span>
              </div>
            </div>
            <div class="space-y-3">
              <div class="flex justify-between">
                <span class="text-sm text-muted-foreground">Session Started</span>
                <span class="text-sm font-medium">{{ formatDate(userSession?.started_at) }}</span>
              </div>
              <div class="flex justify-between">
                <span class="text-sm text-muted-foreground">Last Activity</span>
                <span class="text-sm font-medium">{{ formatTimeAgo(userSession?.last_activity) }}</span>
              </div>
              <div class="flex justify-between">
                <span class="text-sm text-muted-foreground">Pages Visited</span>
                <span class="text-sm font-medium">{{ userSession?.pages_visited || 0 }}</span>
              </div>
            </div>
          </div>
        </CardContent>
      </Card>

      <!-- Action Buttons -->
      <div class="flex justify-between items-center mt-6">
        <div class="flex gap-2">
          <Button variant="outline" size="sm" @click="sendMessage">
            <MessageCircle class="h-4 w-4 mr-2" />
            Send Message
          </Button>
          <Button variant="outline" size="sm" @click="viewProfile">
            <User class="h-4 w-4 mr-2" />
            View Profile
          </Button>
        </div>
        <div class="flex gap-2">
          <Button variant="outline" @click="$emit('update:open', false)">
            Close
          </Button>
          <Button @click="refreshData">
            <RefreshCw class="h-4 w-4 mr-2" />
            Refresh
          </Button>
        </div>
      </div>
    </DialogContent>
  </Dialog>
</template>

<script setup>
import { ref, onMounted, onUnmounted, watch } from 'vue'
import { Dialog, DialogContent, DialogHeader, DialogTitle } from '@/Components/shadcn/ui/dialog'
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/Components/shadcn/ui/card'
import { Button } from '@/Components/shadcn/ui/button'
import { Badge } from '@/Components/shadcn/ui/badge'
import { Separator } from '@/Components/shadcn/ui/separator'
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
  Award
} from 'lucide-vue-next'

const props = defineProps({
  isOpen: Boolean,
  user: Object
})

const emit = defineEmits(['update:open'])

// Reactive state
const userActivity = ref({})
const userStats = ref({})
const userSession = ref({})
const liveActivities = ref([])
const currentSessionDuration = ref(0)
const sessionStartTime = ref(null)

// Real-time tracking
let userTrackingChannel = null
let timeUpdateInterval = null

onMounted(() => {
  if (props.user?.id) {
    startUserTracking()
    startTimeTracking()
  }
})

onUnmounted(() => {
  stopUserTracking()
  stopTimeTracking()
})

watch(() => props.user?.id, (newUserId) => {
  if (newUserId) {
    startUserTracking()
    startTimeTracking()
  } else {
    stopUserTracking()
    stopTimeTracking()
  }
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
    // If API fails, try to get data from online users (from AdminLayout)
    if (window.getAdminOnlineUsers) {
      const onlineUsers = window.getAdminOnlineUsers()
      const onlineUser = onlineUsers.find(u => u.id === props.user.id)
      if (onlineUser) {
        // Set session start time to when user joined
        sessionStartTime.value = onlineUser.joined_at ? new Date(onlineUser.joined_at) : new Date()
        updateSessionDuration()
        
        // Mock some basic data
        userActivity.value = {
          current_page: onlineUser.current_page || 'Dashboard',
          last_activity: new Date(),
          actions_count: 0,
          pages_visited: 1
        }
        
        userSession.value = {
          started_at: sessionStartTime.value,
          ip_address: 'Unknown',
          user_agent: 'Unknown',
          location: 'Unknown',
          last_activity: new Date()
        }
        
        // Add some demo activities for development
        addDemoActivities()
      }
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
    
    // Update session start time if available
    if (data.session?.started_at) {
      sessionStartTime.value = new Date(data.session.started_at)
      updateSessionDuration()
    }
  } catch (error) {
    console.error('Failed to fetch user data:', error)
    // If API fails, try to get data from online users (from AdminLayout)
    if (window.getAdminOnlineUsers) {
      const onlineUsers = window.getAdminOnlineUsers()
      const onlineUser = onlineUsers.find(u => u.id === props.user.id)
      if (onlineUser) {
        // Set session start time to when user joined
        sessionStartTime.value = onlineUser.joined_at ? new Date(onlineUser.joined_at) : new Date()
        updateSessionDuration()
        
        // Mock some basic data
        userActivity.value = {
          current_page: onlineUser.current_page || 'Dashboard',
          last_activity: new Date(),
          actions_count: 0,
          pages_visited: 1
        }
        
        userSession.value = {
          started_at: sessionStartTime.value,
          ip_address: 'Unknown',
          user_agent: 'Unknown',
          location: 'Unknown',
          last_activity: new Date()
        }
        
        // Add some demo activities for development
        addDemoActivities()
      }
    }
  }
}

const updateUserActivity = (activity) => {
  userActivity.value = { ...userActivity.value, ...activity }
}

const addLiveActivity = (activity) => {
  liveActivities.value.unshift(activity)
  // Keep only latest 20 activities
  if (liveActivities.value.length > 20) {
    liveActivities.value = liveActivities.value.slice(0, 20)
  }
}

// Add demo activities for development
const addDemoActivities = () => {
  const demoActivities = [
    {
      id: Date.now() + 1,
      action: 'page_view',
      description: 'Viewed Dashboard',
      page: '/dashboard',
      timestamp: new Date(Date.now() - 120000) // 2 minutes ago
    },
    {
      id: Date.now() + 2,
      action: 'navigation',
      description: 'Navigated to Course List',
      page: '/learn',
      timestamp: new Date(Date.now() - 300000) // 5 minutes ago
    },
    {
      id: Date.now() + 3,
      action: 'click',
      description: 'Started Assessment',
      page: '/learn/course/quiz',
      timestamp: new Date(Date.now() - 480000) // 8 minutes ago
    }
  ]
  
  demoActivities.forEach(activity => addLiveActivity(activity))
}

const refreshData = () => {
  fetchUserData()
}

const sendMessage = () => {
  // Implement messaging functionality
  console.log('Send message to user:', props.user.id)
}

const viewProfile = () => {
  // Navigate to user profile
  window.open(`/admin/users/${props.user.id}`, '_blank')
}

// Helper functions
const formatDuration = (seconds) => {
  const hours = Math.floor(seconds / 3600)
  const minutes = Math.floor((seconds % 3600) / 60)
  
  if (hours > 0) {
    return `${hours}h ${minutes}m`
  }
  return `${minutes}m`
}

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
    course_access: 'bg-pink-500'
  }
  return colors[action] || 'bg-gray-500'
}
</script> 