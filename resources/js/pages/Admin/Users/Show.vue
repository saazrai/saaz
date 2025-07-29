<template>
  <AdminLayout :pageTitle="`User Details: ${user.name}`">
    <div class="container mx-auto px-4 py-8">
      <!-- Header -->
      <div class="mb-8">
        <Link :href="route('admin.users.index')" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 flex items-center gap-2 mb-4">
          <ChevronLeft class="h-4 w-4" />
          Back to Users
        </Link>
        <div class="flex justify-between items-start">
          <div>
            <h1 :class="['text-3xl font-bold', isDarkMode ? 'text-white' : 'text-gray-900']">
              {{ user.name }}
            </h1>
            <p :class="[isDarkMode ? 'text-gray-300' : 'text-gray-600']">
              {{ user.email }}
            </p>
          </div>
          <Link
            :href="route('admin.users.edit', user.id)"
            class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700"
          >
            Edit User
          </Link>
        </div>
      </div>

      <!-- User Details Grid -->
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Basic Information -->
        <div :class="['rounded-lg shadow-sm p-6', isDarkMode ? 'bg-gray-800' : 'bg-white']">
          <h3 :class="['text-lg font-semibold mb-4', isDarkMode ? 'text-white' : 'text-gray-900']">
            Basic Information
          </h3>
          <dl class="space-y-3">
            <div>
              <dt :class="['text-sm font-medium', isDarkMode ? 'text-gray-400' : 'text-gray-500']">ID</dt>
              <dd :class="['text-sm', isDarkMode ? 'text-white' : 'text-gray-900']">{{ user.id }}</dd>
            </div>
            <div>
              <dt :class="['text-sm font-medium', isDarkMode ? 'text-gray-400' : 'text-gray-500']">Name</dt>
              <dd :class="['text-sm', isDarkMode ? 'text-white' : 'text-gray-900']">{{ user.name }}</dd>
            </div>
            <div>
              <dt :class="['text-sm font-medium', isDarkMode ? 'text-gray-400' : 'text-gray-500']">Email</dt>
              <dd :class="['text-sm', isDarkMode ? 'text-white' : 'text-gray-900']">{{ user.email }}</dd>
            </div>
            <div>
              <dt :class="['text-sm font-medium', isDarkMode ? 'text-gray-400' : 'text-gray-500']">Created</dt>
              <dd :class="['text-sm', isDarkMode ? 'text-white' : 'text-gray-900']">{{ formatDate(user.created_at) }}</dd>
            </div>
          </dl>
        </div>

        <!-- Account Status -->
        <div :class="['rounded-lg shadow-sm p-6', isDarkMode ? 'bg-gray-800' : 'bg-white']">
          <h3 :class="['text-lg font-semibold mb-4', isDarkMode ? 'text-white' : 'text-gray-900']">
            Account Status
          </h3>
          <dl class="space-y-3">
            <div>
              <dt :class="['text-sm font-medium', isDarkMode ? 'text-gray-400' : 'text-gray-500']">Status</dt>
              <dd>
                <span
                  :class="[
                    'inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium',
                    user.is_active 
                      ? 'bg-green-100 text-green-800 dark:bg-green-900/20 dark:text-green-400' 
                      : 'bg-red-100 text-red-800 dark:bg-red-900/20 dark:text-red-400'
                  ]"
                >
                  {{ user.is_active ? 'Active' : 'Inactive' }}
                </span>
              </dd>
            </div>
            <div>
              <dt :class="['text-sm font-medium', isDarkMode ? 'text-gray-400' : 'text-gray-500']">Email Verified</dt>
              <dd>
                <span
                  :class="[
                    'inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium',
                    user.email_verified_at 
                      ? 'bg-green-100 text-green-800 dark:bg-green-900/20 dark:text-green-400' 
                      : 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/20 dark:text-yellow-400'
                  ]"
                >
                  {{ user.email_verified_at ? 'Verified' : 'Unverified' }}
                </span>
              </dd>
            </div>
            <div>
              <dt :class="['text-sm font-medium', isDarkMode ? 'text-gray-400' : 'text-gray-500']">Last Login</dt>
              <dd :class="['text-sm', isDarkMode ? 'text-white' : 'text-gray-900']">
                {{ user.last_login_at ? formatDate(user.last_login_at) : 'Never' }}
              </dd>
            </div>
            <div>
              <dt :class="['text-sm font-medium', isDarkMode ? 'text-gray-400' : 'text-gray-500']">Login Count</dt>
              <dd :class="['text-sm', isDarkMode ? 'text-white' : 'text-gray-900']">{{ user.login_count || 0 }}</dd>
            </div>
          </dl>
        </div>

        <!-- Roles & Permissions -->
        <div :class="['rounded-lg shadow-sm p-6', isDarkMode ? 'bg-gray-800' : 'bg-white']">
          <h3 :class="['text-lg font-semibold mb-4', isDarkMode ? 'text-white' : 'text-gray-900']">
            Roles & Permissions
          </h3>
          <div class="space-y-4">
            <div>
              <h4 :class="['text-sm font-medium mb-2', isDarkMode ? 'text-gray-400' : 'text-gray-500']">Roles</h4>
              <div class="flex flex-wrap gap-2">
                <span
                  v-for="role in user.roles"
                  :key="role.id"
                  class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium"
                  :class="getRoleColor(role.name)"
                >
                  {{ role.name }}
                </span>
                <span v-if="!user.roles || user.roles.length === 0" :class="['text-sm', isDarkMode ? 'text-gray-400' : 'text-gray-500']">
                  No roles assigned
                </span>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Assessment Statistics -->
      <div :class="['rounded-lg shadow-sm p-6 mt-6', isDarkMode ? 'bg-gray-800' : 'bg-white']">
        <h3 :class="['text-lg font-semibold mb-4', isDarkMode ? 'text-white' : 'text-gray-900']">
          Assessment Statistics
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
          <div>
            <dt :class="['text-sm font-medium', isDarkMode ? 'text-gray-400' : 'text-gray-500']">Total Assessments</dt>
            <dd :class="['text-2xl font-semibold mt-1', isDarkMode ? 'text-white' : 'text-gray-900']">
              {{ user.diagnostics_count || 0 }}
            </dd>
          </div>
          <div>
            <dt :class="['text-sm font-medium', isDarkMode ? 'text-gray-400' : 'text-gray-500']">Completed</dt>
            <dd :class="['text-2xl font-semibold mt-1', isDarkMode ? 'text-white' : 'text-gray-900']">
              {{ user.completed_diagnostics_count || 0 }}
            </dd>
          </div>
          <div>
            <dt :class="['text-sm font-medium', isDarkMode ? 'text-gray-400' : 'text-gray-500']">Average Score</dt>
            <dd :class="['text-2xl font-semibold mt-1', isDarkMode ? 'text-white' : 'text-gray-900']">
              {{ user.average_score ? `${Math.round(user.average_score)}%` : 'N/A' }}
            </dd>
          </div>
          <div>
            <dt :class="['text-sm font-medium', isDarkMode ? 'text-gray-400' : 'text-gray-500']">Last Assessment</dt>
            <dd :class="['text-sm mt-1', isDarkMode ? 'text-white' : 'text-gray-900']">
              {{ user.last_assessment_at ? formatDate(user.last_assessment_at) : 'Never' }}
            </dd>
          </div>
        </div>
      </div>

      <!-- Recent Activity -->
      <div :class="['rounded-lg shadow-sm p-6 mt-6', isDarkMode ? 'bg-gray-800' : 'bg-white']">
        <h3 :class="['text-lg font-semibold mb-4', isDarkMode ? 'text-white' : 'text-gray-900']">
          Recent Assessments
        </h3>
        <div v-if="user.recent_diagnostics && user.recent_diagnostics.length > 0" class="space-y-3">
          <div 
            v-for="assessment in user.recent_diagnostics" 
            :key="assessment.id"
            :class="[
              'flex items-center justify-between p-3 rounded-lg',
              isDarkMode ? 'bg-gray-700' : 'bg-gray-50'
            ]"
          >
            <div>
              <p :class="['font-medium', isDarkMode ? 'text-white' : 'text-gray-900']">
                Assessment #{{ assessment.id }}
              </p>
              <p :class="['text-sm', isDarkMode ? 'text-gray-400' : 'text-gray-500']">
                Score: {{ assessment.score || 0 }}% 
                <span v-if="assessment.status === 'completed'" class="text-green-500">✓</span>
                <span v-else class="text-yellow-500">{{ assessment.status }}</span>
              </p>
            </div>
            <span :class="['text-xs', isDarkMode ? 'text-gray-400' : 'text-gray-500']">
              {{ formatDate(assessment.created_at) }}
            </span>
          </div>
        </div>
        <p v-else :class="['text-sm', isDarkMode ? 'text-gray-400' : 'text-gray-500']">
          No assessments found
        </p>
      </div>
    </div>
  </AdminLayout>
</template>

<script setup lang="ts">
import { ref, onMounted, onUnmounted } from 'vue'
import { Link } from '@inertiajs/vue3'
import AdminLayout from '@/layouts/AdminLayout.vue'
import { ChevronLeft } from 'lucide-vue-next'

defineProps({
  user: {
    type: Object,
    required: true
  }
})

// Dark mode handling
const isDarkMode = ref(false)

const updateDarkMode = () => {
  isDarkMode.value = localStorage.getItem('adminDarkMode') === 'true'
}

onMounted(() => {
  updateDarkMode()
  window.addEventListener('storage', updateDarkMode)
  window.addEventListener('adminDarkModeChanged', updateDarkMode)
})

onUnmounted(() => {
  window.removeEventListener('storage', updateDarkMode)
  window.removeEventListener('adminDarkModeChanged', updateDarkMode)
})

// Helper functions
const formatDate = (dateString) => {
  if (!dateString) return 'Never'
  return new Date(dateString).toLocaleDateString('en-US', {
    year: 'numeric',
    month: 'short',
    day: 'numeric',
    hour: '2-digit',
    minute: '2-digit'
  })
}

const getRoleColor = (roleName) => {
  if (isDarkMode.value) {
    const darkColors = {
      'super-admin': 'bg-red-900/20 text-red-400',
      'admin': 'bg-purple-900/20 text-purple-400',
      'moderator': 'bg-blue-900/20 text-blue-400',
      'user': 'bg-gray-700 text-gray-300'
    }
    return darkColors[roleName] || 'bg-gray-700 text-gray-300'
  } else {
    const lightColors = {
      'super-admin': 'bg-red-100 text-red-800',
      'admin': 'bg-purple-100 text-purple-800',
      'moderator': 'bg-blue-100 text-blue-800',
      'user': 'bg-gray-100 text-gray-800'
    }
    return lightColors[roleName] || 'bg-gray-100 text-gray-800'
  }
}
</script>