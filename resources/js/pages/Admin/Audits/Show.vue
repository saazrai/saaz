<template>
  <AdminLayout>
    <Head title="Audit Log Detail" />
    
    <div class="py-6">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-6 flex justify-between items-center">
          <div>
            <Link
              :href="route('admin.audits.index')"
              :class="[
                'text-sm mb-2 inline-block',
                isDarkMode ? 'text-indigo-400 hover:text-indigo-300' : 'text-indigo-600 hover:text-indigo-900'
              ]"
            >
              ← Back to Audit Logs
            </Link>
            <h1 :class="['text-2xl font-semibold', isDarkMode ? 'text-white' : 'text-gray-900']">Audit Log Detail</h1>
            <p :class="['mt-1 text-sm', isDarkMode ? 'text-gray-400' : 'text-gray-600']">
              {{ audit.model_name }} {{ audit.event }} on {{ formatDate(audit.created_at) }}
            </p>
          </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
          <!-- Main Content -->
          <div class="lg:col-span-2 space-y-6">
            <!-- Event Information -->
            <div :class="[
              'shadow overflow-hidden sm:rounded-lg',
              isDarkMode ? 'bg-gray-800' : 'bg-white'
            ]">
              <div class="px-4 py-5 sm:px-6">
                <h3 :class="['text-lg leading-6 font-medium', isDarkMode ? 'text-white' : 'text-gray-900']">
                  Event Information
                </h3>
                <p :class="['mt-1 max-w-2xl text-sm', isDarkMode ? 'text-gray-400' : 'text-gray-500']">
                  Details about the audit event
                </p>
              </div>
              <div :class="['border-t', isDarkMode ? 'border-gray-700' : 'border-gray-200']">
                <dl>
                  <div :class="['px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6', isDarkMode ? 'bg-gray-700' : 'bg-gray-50']">
                    <dt :class="['text-sm font-medium', isDarkMode ? 'text-gray-300' : 'text-gray-500']">Event Type</dt>
                    <dd :class="['mt-1 text-sm sm:mt-0 sm:col-span-2', isDarkMode ? 'text-white' : 'text-gray-900']">
                      <span :class="getEventBadgeClass(audit.event)" class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium">
                        {{ audit.event.charAt(0).toUpperCase() + audit.event.slice(1) }}
                      </span>
                    </dd>
                  </div>
                  <div :class="['px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6', isDarkMode ? 'bg-gray-800' : 'bg-white']">
                    <dt :class="['text-sm font-medium', isDarkMode ? 'text-gray-300' : 'text-gray-500']">Model</dt>
                    <dd :class="['mt-1 text-sm sm:mt-0 sm:col-span-2', isDarkMode ? 'text-white' : 'text-gray-900']">
                      {{ audit.model_name }} (ID: {{ audit.auditable_id }})
                    </dd>
                  </div>
                  <div :class="['px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6', isDarkMode ? 'bg-gray-700' : 'bg-gray-50']">
                    <dt :class="['text-sm font-medium', isDarkMode ? 'text-gray-300' : 'text-gray-500']">User</dt>
                    <dd :class="['mt-1 text-sm sm:mt-0 sm:col-span-2', isDarkMode ? 'text-white' : 'text-gray-900']">
                      <div v-if="audit.user_info">
                        <div>{{ audit.user_info.name }}</div>
                        <div :class="['text-sm', isDarkMode ? 'text-gray-400' : 'text-gray-500']">{{ audit.user_info.email }}</div>
                      </div>
                      <div v-else :class="[isDarkMode ? 'text-gray-400' : 'text-gray-500']">System</div>
                    </dd>
                  </div>
                  <div :class="['px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6', isDarkMode ? 'bg-gray-800' : 'bg-white']">
                    <dt :class="['text-sm font-medium', isDarkMode ? 'text-gray-300' : 'text-gray-500']">Timestamp</dt>
                    <dd :class="['mt-1 text-sm sm:mt-0 sm:col-span-2', isDarkMode ? 'text-white' : 'text-gray-900']">
                      {{ formatDate(audit.created_at) }}
                    </dd>
                  </div>
                </dl>
              </div>
            </div>

            <!-- Changes -->
            <div v-if="hasChanges" :class="[
              'shadow overflow-hidden sm:rounded-lg',
              isDarkMode ? 'bg-gray-800' : 'bg-white'
            ]">
              <div class="px-4 py-5 sm:px-6">
                <h3 :class="['text-lg leading-6 font-medium', isDarkMode ? 'text-white' : 'text-gray-900']">
                  Changes Made
                </h3>
                <p :class="['mt-1 max-w-2xl text-sm', isDarkMode ? 'text-gray-400' : 'text-gray-500']">
                  What changed during this event
                </p>
              </div>
              <div :class="['border-t', isDarkMode ? 'border-gray-700' : 'border-gray-200']">
                <div class="overflow-x-auto">
                  <table :class="['min-w-full divide-y', isDarkMode ? 'divide-gray-700' : 'divide-gray-200']">
                    <thead :class="[isDarkMode ? 'bg-gray-700' : 'bg-gray-50']">
                      <tr>
                        <th :class="['px-6 py-3 text-left text-xs font-medium uppercase tracking-wider', isDarkMode ? 'text-gray-300' : 'text-gray-500']">
                          Field
                        </th>
                        <th :class="['px-6 py-3 text-left text-xs font-medium uppercase tracking-wider', isDarkMode ? 'text-gray-300' : 'text-gray-500']">
                          Old Value
                        </th>
                        <th :class="['px-6 py-3 text-left text-xs font-medium uppercase tracking-wider', isDarkMode ? 'text-gray-300' : 'text-gray-500']">
                          New Value
                        </th>
                      </tr>
                    </thead>
                    <tbody :class="['divide-y', isDarkMode ? 'bg-gray-800 divide-gray-700' : 'bg-white divide-gray-200']">
                      <tr v-for="change in getChanges()" :key="change.field">
                        <td :class="['px-6 py-4 whitespace-nowrap text-sm font-medium', isDarkMode ? 'text-white' : 'text-gray-900']">
                          {{ change.field }}
                        </td>
                        <td :class="['px-6 py-4 text-sm', isDarkMode ? 'text-gray-400' : 'text-gray-500']">
                          <div v-if="change.old_value !== null" class="max-w-xs">
                            <code v-if="change.old_type === 'object'" :class="[
                              'text-xs p-1 rounded block whitespace-pre-wrap',
                              isDarkMode ? 'bg-gray-700' : 'bg-gray-100'
                            ]">{{ change.old_value }}</code>
                            <span v-else>{{ change.old_value }}</span>
                          </div>
                          <span v-else class="text-gray-400 italic">null</span>
                        </td>
                        <td :class="['px-6 py-4 text-sm', isDarkMode ? 'text-white' : 'text-gray-900']">
                          <div v-if="change.new_value !== null" class="max-w-xs">
                            <code v-if="change.new_type === 'object'" :class="[
                              'text-xs p-1 rounded block whitespace-pre-wrap',
                              isDarkMode ? 'bg-gray-700' : 'bg-gray-100'
                            ]">{{ change.new_value }}</code>
                            <span v-else>{{ change.new_value }}</span>
                          </div>
                          <span v-else class="text-gray-400 italic">null</span>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

            <!-- Raw Data -->
            <div :class="[
              'shadow overflow-hidden sm:rounded-lg',
              isDarkMode ? 'bg-gray-800' : 'bg-white'
            ]">
              <div class="px-4 py-5 sm:px-6">
                <h3 :class="['text-lg leading-6 font-medium', isDarkMode ? 'text-white' : 'text-gray-900']">
                  Raw Audit Data
                </h3>
                <p :class="['mt-1 max-w-2xl text-sm', isDarkMode ? 'text-gray-400' : 'text-gray-500']">
                  Complete audit record information
                </p>
              </div>
              <div :class="['border-t p-4', isDarkMode ? 'border-gray-700' : 'border-gray-200']">
                <pre :class="[
                  'text-xs p-4 rounded overflow-x-auto',
                  isDarkMode ? 'bg-gray-700 text-gray-200' : 'bg-gray-100 text-gray-800'
                ]">{{ JSON.stringify(audit, null, 2) }}</pre>
              </div>
            </div>
          </div>

          <!-- Sidebar -->
          <div class="space-y-6">
            <!-- Context Information -->
            <div :class="[
              'shadow overflow-hidden sm:rounded-lg',
              isDarkMode ? 'bg-gray-800' : 'bg-white'
            ]">
              <div class="px-4 py-5 sm:px-6">
                <h3 :class="['text-lg leading-6 font-medium', isDarkMode ? 'text-white' : 'text-gray-900']">
                  Context
                </h3>
              </div>
              <div :class="['border-t', isDarkMode ? 'border-gray-700' : 'border-gray-200']">
                <dl>
                  <div :class="['px-4 py-5', isDarkMode ? 'bg-gray-700' : 'bg-gray-50']">
                    <dt :class="['text-sm font-medium mb-2', isDarkMode ? 'text-gray-300' : 'text-gray-500']">IP Address</dt>
                    <dd :class="['text-sm', isDarkMode ? 'text-white' : 'text-gray-900']">
                      {{ audit.ip_address || 'Not recorded' }}
                    </dd>
                  </div>
                  <div :class="['px-4 py-5', isDarkMode ? 'bg-gray-800' : 'bg-white']">
                    <dt :class="['text-sm font-medium mb-2', isDarkMode ? 'text-gray-300' : 'text-gray-500']">URL</dt>
                    <dd :class="['text-sm break-all', isDarkMode ? 'text-white' : 'text-gray-900']">
                      {{ audit.url || 'Not recorded' }}
                    </dd>
                  </div>
                  <div :class="['px-4 py-5', isDarkMode ? 'bg-gray-700' : 'bg-gray-50']">
                    <dt :class="['text-sm font-medium mb-2', isDarkMode ? 'text-gray-300' : 'text-gray-500']">User Agent</dt>
                    <dd :class="['text-sm break-all', isDarkMode ? 'text-white' : 'text-gray-900']">
                      {{ audit.user_agent || 'Not recorded' }}
                    </dd>
                  </div>
                  <div v-if="audit.tags" :class="['px-4 py-5', isDarkMode ? 'bg-gray-800' : 'bg-white']">
                    <dt :class="['text-sm font-medium mb-2', isDarkMode ? 'text-gray-300' : 'text-gray-500']">Tags</dt>
                    <dd :class="['text-sm', isDarkMode ? 'text-white' : 'text-gray-900']">
                      {{ audit.tags }}
                    </dd>
                  </div>
                </dl>
              </div>
            </div>

            <!-- Quick Actions -->
            <div :class="[
              'shadow overflow-hidden sm:rounded-lg',
              isDarkMode ? 'bg-gray-800' : 'bg-white'
            ]">
              <div class="px-4 py-5 sm:px-6">
                <h3 :class="['text-lg leading-6 font-medium', isDarkMode ? 'text-white' : 'text-gray-900']">
                  Quick Actions
                </h3>
              </div>
              <div :class="['border-t p-4 space-y-3', isDarkMode ? 'border-gray-700' : 'border-gray-200']">
                <Link
                  v-if="audit.user_info"
                  :href="route('admin.users.show', audit.user_id)"
                  :class="[
                    'w-full inline-flex justify-center items-center px-4 py-2 border shadow-sm text-sm font-medium rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500',
                    isDarkMode 
                      ? 'bg-gray-700 text-white border-gray-600 hover:bg-gray-600' 
                      : 'text-gray-700 bg-white border-gray-300 hover:bg-gray-50'
                  ]"
                >
                  View User Profile
                </Link>
                
                <Link
                  :href="route('admin.audits.index', { auditable_type: audit.auditable_type, auditable_id: audit.auditable_id })"
                  :class="[
                    'w-full inline-flex justify-center items-center px-4 py-2 border shadow-sm text-sm font-medium rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500',
                    isDarkMode 
                      ? 'bg-gray-700 text-white border-gray-600 hover:bg-gray-600' 
                      : 'text-gray-700 bg-white border-gray-300 hover:bg-gray-50'
                  ]"
                >
                  View Related Audits
                </Link>
                
                <button
                  @click="copyAuditId"
                  :class="[
                    'w-full inline-flex justify-center items-center px-4 py-2 border shadow-sm text-sm font-medium rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500',
                    isDarkMode 
                      ? 'bg-gray-700 text-white border-gray-600 hover:bg-gray-600' 
                      : 'text-gray-700 bg-white border-gray-300 hover:bg-gray-50'
                  ]"
                >
                  Copy Audit ID
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AdminLayout>
</template>

<script setup lang="ts">
import { computed, ref, onMounted, onUnmounted } from 'vue'
import { Head, Link } from '@inertiajs/vue3'
import AdminLayout from '@/layouts/AdminLayout.vue'

const props = defineProps({
  audit: Object
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

onMounted(() => {
  // Initialize dark mode
  initializeDarkMode()
  
  // Listen for dark mode changes
  window.addEventListener('storage', handleDarkModeChange)
  window.addEventListener('adminDarkModeChanged', handleCustomDarkModeChange)
})

onUnmounted(() => {
  // Remove event listeners
  window.removeEventListener('storage', handleDarkModeChange)
  window.removeEventListener('adminDarkModeChanged', handleCustomDarkModeChange)
})

const hasChanges = computed(() => {
  return props.audit.old_values_formatted || props.audit.new_values_formatted
})

const getChanges = () => {
  const changes = []
  const oldValues = props.audit.old_values_formatted || []
  const newValues = props.audit.new_values_formatted || []
  
  // Create a map of all fields that changed
  const fieldMap = new Map()
  
  oldValues.forEach(item => {
    fieldMap.set(item.field, { ...item, old: true })
  })
  
  newValues.forEach(item => {
    if (fieldMap.has(item.field)) {
      fieldMap.get(item.field).new_value = item.value
      fieldMap.get(item.field).new_type = item.type
    } else {
      fieldMap.set(item.field, { 
        field: item.field, 
        new_value: item.value, 
        new_type: item.type,
        old_value: null,
        old_type: null
      })
    }
  })
  
  // Convert map to array and format
  fieldMap.forEach((value, field) => {
    changes.push({
      field: field,
      old_value: value.value || value.old_value || null,
      old_type: value.type || value.old_type,
      new_value: value.new_value || null,
      new_type: value.new_type
    })
  })
  
  return changes
}

const getEventBadgeClass = (event) => {
  if (isDarkMode.value) {
    const darkClasses = {
      created: 'bg-green-900/30 text-green-400',
      updated: 'bg-yellow-900/30 text-yellow-400',
      deleted: 'bg-red-900/30 text-red-400',
      restored: 'bg-blue-900/30 text-blue-400'
    }
    return darkClasses[event] || 'bg-gray-700/30 text-gray-300'
  } else {
    const classes = {
      created: 'bg-green-100 text-green-800',
      updated: 'bg-yellow-100 text-yellow-800',
      deleted: 'bg-red-100 text-red-800',
      restored: 'bg-blue-100 text-blue-800'
    }
    return classes[event] || 'bg-gray-100 text-gray-800'
  }
}

const formatDate = (dateString) => {
  return new Date(dateString).toLocaleString()
}

const copyAuditId = async () => {
  try {
    await navigator.clipboard.writeText(props.audit.id.toString())
    // You could add a toast notification here
  } catch (err) {
    console.error('Failed to copy audit ID:', err)
  }
}
</script>
