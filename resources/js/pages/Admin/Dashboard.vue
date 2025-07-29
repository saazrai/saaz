<template>
  <AdminLayout pageTitle="Dashboard">
    <div class="container mx-auto px-4 py-8">
      <!-- Header Section -->
      <div class="mb-8">
        <p :class="[isDark ? 'text-gray-300' : 'text-gray-600']">
          Overview of your SecureStart™ V1 Diagnostics Platform
        </p>
      </div>

      <!-- Stats Grid -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Users -->
        <div :class="[
          'rounded-lg p-6',
          isDark ? 'bg-gray-800 border border-gray-700' : 'bg-white shadow-sm'
        ]">
          <div class="flex items-center justify-between">
            <div>
              <p :class="['text-sm font-medium', isDark ? 'text-gray-400' : 'text-gray-500']">
                Total Users
              </p>
              <p :class="['text-2xl font-bold mt-1', isDark ? 'text-white' : 'text-gray-900']">
                {{ stats.total_users.toLocaleString() }}
              </p>
              <p :class="['text-sm mt-2', isDark ? 'text-gray-400' : 'text-gray-500']">
                <span :class="stats.new_users_week > 0 ? 'text-green-500' : ''">
                  +{{ stats.new_users_week }} this week
                </span>
              </p>
            </div>
            <div :class="[
              'p-3 rounded-lg',
              isDark ? 'bg-blue-900/20' : 'bg-blue-100'
            ]">
              <Users :class="['h-6 w-6', isDark ? 'text-blue-400' : 'text-blue-600']" />
            </div>
          </div>
        </div>

        <!-- Active Users -->
        <div :class="[
          'rounded-lg p-6',
          isDark ? 'bg-gray-800 border border-gray-700' : 'bg-white shadow-sm'
        ]">
          <div class="flex items-center justify-between">
            <div>
              <p :class="['text-sm font-medium', isDark ? 'text-gray-400' : 'text-gray-500']">
                Active Users
              </p>
              <p :class="['text-2xl font-bold mt-1', isDark ? 'text-white' : 'text-gray-900']">
                {{ stats.active_users.toLocaleString() }}
              </p>
              <p :class="['text-sm mt-2', isDark ? 'text-gray-400' : 'text-gray-500']">
                {{ Math.round((stats.active_users / stats.total_users) * 100) }}% of total
              </p>
            </div>
            <div :class="[
              'p-3 rounded-lg',
              isDark ? 'bg-green-900/20' : 'bg-green-100'
            ]">
              <UserCheck :class="['h-6 w-6', isDark ? 'text-green-400' : 'text-green-600']" />
            </div>
          </div>
        </div>

        <!-- Total Assessments -->
        <div :class="[
          'rounded-lg p-6',
          isDark ? 'bg-gray-800 border border-gray-700' : 'bg-white shadow-sm'
        ]">
          <div class="flex items-center justify-between">
            <div>
              <p :class="['text-sm font-medium', isDark ? 'text-gray-400' : 'text-gray-500']">
                Total Assessments
              </p>
              <p :class="['text-2xl font-bold mt-1', isDark ? 'text-white' : 'text-gray-900']">
                {{ stats.total_assessments.toLocaleString() }}
              </p>
              <p :class="['text-sm mt-2', isDark ? 'text-gray-400' : 'text-gray-500']">
                +{{ stats.assessments_week }} this week
              </p>
            </div>
            <div :class="[
              'p-3 rounded-lg',
              isDark ? 'bg-purple-900/20' : 'bg-purple-100'
            ]">
              <FileQuestion :class="['h-6 w-6', isDark ? 'text-purple-400' : 'text-purple-600']" />
            </div>
          </div>
        </div>

        <!-- Average Score -->
        <div :class="[
          'rounded-lg p-6',
          isDark ? 'bg-gray-800 border border-gray-700' : 'bg-white shadow-sm'
        ]">
          <div class="flex items-center justify-between">
            <div>
              <p :class="['text-sm font-medium', isDark ? 'text-gray-400' : 'text-gray-500']">
                Average Score
              </p>
              <p :class="['text-2xl font-bold mt-1', isDark ? 'text-white' : 'text-gray-900']">
                {{ Math.round(stats.average_score) }}%
              </p>
              <p :class="['text-sm mt-2', isDark ? 'text-gray-400' : 'text-gray-500']">
                Across all assessments
              </p>
            </div>
            <div :class="[
              'p-3 rounded-lg',
              isDark ? 'bg-orange-900/20' : 'bg-orange-100'
            ]">
              <TrendingUp :class="['h-6 w-6', isDark ? 'text-orange-400' : 'text-orange-600']" />
            </div>
          </div>
        </div>
      </div>

      <!-- Charts and Recent Activity -->
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Assessment Completion Chart -->
        <div :class="[
          'rounded-lg p-6',
          isDark ? 'bg-gray-800 border border-gray-700' : 'bg-white shadow-sm'
        ]">
          <h3 :class="['text-lg font-semibold mb-4', isDark ? 'text-white' : 'text-gray-900']">
            Assessment Completion Rate (Last 7 Days)
          </h3>
          <div class="space-y-4">
            <div v-for="day in completionData" :key="day.date" class="flex items-center gap-4">
              <span :class="['text-sm w-16', isDark ? 'text-gray-400' : 'text-gray-600']">
                {{ day.date }}
              </span>
              <div class="flex-1">
                <div :class="[
                  'h-8 rounded-lg overflow-hidden',
                  isDark ? 'bg-gray-700' : 'bg-gray-200'
                ]">
                  <div 
                    :style="`width: ${day.completion_rate}%`"
                    :class="[
                      'h-full flex items-center justify-end px-2 text-xs font-medium transition-all duration-300',
                      isDark ? 'bg-blue-600 text-white' : 'bg-blue-500 text-white'
                    ]"
                  >
                    {{ day.completion_rate }}%
                  </div>
                </div>
              </div>
              <span :class="['text-sm w-20 text-right', isDark ? 'text-gray-400' : 'text-gray-600']">
                {{ day.completed }}/{{ day.total }}
              </span>
            </div>
          </div>
        </div>

        <!-- Role Distribution -->
        <div :class="[
          'rounded-lg p-6',
          isDark ? 'bg-gray-800 border border-gray-700' : 'bg-white shadow-sm'
        ]">
          <h3 :class="['text-lg font-semibold mb-4', isDark ? 'text-white' : 'text-gray-900']">
            User Role Distribution
          </h3>
          <div class="space-y-4">
            <div v-for="role in roleDistribution" :key="role.role" class="flex items-center justify-between">
              <div class="flex items-center gap-3">
                <div :class="[
                  'w-3 h-3 rounded-full',
                  getRoleColor(role.role)
                ]"></div>
                <span :class="['text-sm', isDark ? 'text-gray-300' : 'text-gray-700']">
                  {{ role.role }}
                </span>
              </div>
              <span :class="['text-sm font-medium', isDark ? 'text-white' : 'text-gray-900']">
                {{ role.count }}
              </span>
            </div>
          </div>
        </div>
      </div>

      <!-- Recent Activity Tables -->
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-6">
        <!-- Recent Users -->
        <div :class="[
          'rounded-lg',
          isDark ? 'bg-gray-800 border border-gray-700' : 'bg-white shadow-sm'
        ]">
          <div class="p-6">
            <h3 :class="['text-lg font-semibold mb-4', isDark ? 'text-white' : 'text-gray-900']">
              Recent Users
            </h3>
            <div class="space-y-3">
              <div v-for="user in recentUsers" :key="user.id" 
                   :class="[
                     'flex items-center justify-between p-3 rounded-lg',
                     isDark ? 'bg-gray-700' : 'bg-gray-50'
                   ]">
                <div>
                  <p :class="['font-medium', isDark ? 'text-white' : 'text-gray-900']">
                    {{ user.name }}
                  </p>
                  <p :class="['text-sm', isDark ? 'text-gray-400' : 'text-gray-500']">
                    {{ user.email }}
                  </p>
                </div>
                <span :class="['text-xs', isDark ? 'text-gray-400' : 'text-gray-500']">
                  {{ formatTimeAgo(user.created_at) }}
                </span>
              </div>
            </div>
          </div>
        </div>

        <!-- Recent Assessments -->
        <div :class="[
          'rounded-lg',
          isDark ? 'bg-gray-800 border border-gray-700' : 'bg-white shadow-sm'
        ]">
          <div class="p-6">
            <h3 :class="['text-lg font-semibold mb-4', isDark ? 'text-white' : 'text-gray-900']">
              Recent Assessments
            </h3>
            <div class="space-y-3">
              <div v-for="assessment in recentAssessments" :key="assessment.id" 
                   :class="[
                     'flex items-center justify-between p-3 rounded-lg',
                     isDark ? 'bg-gray-700' : 'bg-gray-50'
                   ]">
                <div>
                  <p :class="['font-medium', isDark ? 'text-white' : 'text-gray-900']">
                    {{ assessment.user?.name || 'Guest User' }}
                  </p>
                  <p :class="['text-sm', isDark ? 'text-gray-400' : 'text-gray-500']">
                    Score: {{ assessment.score || 0 }}% 
                    <span v-if="assessment.status === 'completed'" class="text-green-500">✓</span>
                    <span v-else-if="assessment.status === 'paused'" class="text-yellow-500">Paused</span>
                    <span v-else class="text-yellow-500">In Progress</span>
                  </p>
                </div>
                <span :class="['text-xs', isDark ? 'text-gray-400' : 'text-gray-500']">
                  {{ formatTimeAgo(assessment.created_at) }}
                </span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AdminLayout>
</template>

<script setup lang="ts">
import { ref, onMounted, onUnmounted } from 'vue'
import AdminLayout from '@/layouts/AdminLayout.vue'
import { Users, UserCheck, FileQuestion, TrendingUp } from 'lucide-vue-next'

defineProps({
  stats: {
    type: Object,
    required: true
  },
  recentUsers: {
    type: Array,
    default: () => []
  },
  recentAssessments: {
    type: Array,
    default: () => []
  },
  completionData: {
    type: Array,
    default: () => []
  },
  roleDistribution: {
    type: Array,
    default: () => []
  }
})

// Create local dark mode state that directly checks DOM
const isDark = ref(false)

// Watch for DOM changes
let observer = null

// Function to check dark mode
const checkDarkMode = () => {
  const hasDarkClass = document.documentElement.classList.contains('dark')
  const computedStyle = window.getComputedStyle(document.documentElement)
  const bgColor = computedStyle.backgroundColor
  
  // Check if we're in dark mode by class or by computed background color
  return hasDarkClass || bgColor === 'rgb(17, 24, 39)' // gray-900
}

onMounted(() => {
  // Initial check to ensure accuracy
  isDark.value = checkDarkMode()
  
  // Watch for changes
  observer = new MutationObserver(() => {
    isDark.value = checkDarkMode()
  })
  
  observer.observe(document.documentElement, {
    attributes: true,
    attributeFilter: ['class'],
    subtree: false
  })
  
  // Also check on window focus (in case theme changed while tab was inactive)
  window.addEventListener('focus', () => {
    isDark.value = checkDarkMode()
  })
})

onUnmounted(() => {
  if (observer) {
    observer.disconnect()
  }
  window.removeEventListener('focus', () => {
    isDark.value = checkDarkMode()
  })
})

// Helper functions
const formatTimeAgo = (dateString) => {
  const date = new Date(dateString)
  const now = new Date()
  const diffMs = now - date
  const diffMins = Math.floor(diffMs / 60000)
  const diffHours = Math.floor(diffMs / 3600000)
  const diffDays = Math.floor(diffMs / 86400000)

  if (diffMins < 1) return 'Just now'
  if (diffMins < 60) return `${diffMins}m ago`
  if (diffHours < 24) return `${diffHours}h ago`
  if (diffDays < 7) return `${diffDays}d ago`
  
  return date.toLocaleDateString('en-US', { 
    month: 'short', 
    day: 'numeric' 
  })
}

const getRoleColor = (role) => {
  const colors = {
    'super-admin': 'bg-red-500',
    'admin': 'bg-purple-500',
    'moderator': 'bg-blue-500',
    'user': 'bg-gray-500',
    'No Role': 'bg-gray-400'
  }
  return colors[role] || 'bg-gray-400'
}
</script>