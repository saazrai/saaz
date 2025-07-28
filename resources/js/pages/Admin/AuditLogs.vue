<template>
  <AdminLayout>
    <Head title="Audit Logs" />
    
    <div class="container mx-auto px-4 py-8">
      <!-- Header -->
      <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8">
        <div>
          <h1 :class="['text-3xl font-bold', isDarkMode ? 'text-white' : 'text-gray-900']">Audit Logs</h1>
          <p :class="[isDarkMode ? 'text-gray-300' : 'text-gray-600']">Track all changes and activities across the system</p>
        </div>
        <div class="flex flex-col sm:flex-row gap-4 mt-4 md:mt-0">
          <button
            @click="exportLogs"
            :disabled="exporting"
            :class="[
              'inline-flex items-center px-4 py-2 border rounded-md shadow-sm text-sm font-medium focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 disabled:opacity-50',
              isDarkMode 
                ? 'border-gray-600 text-gray-300 bg-gray-800 hover:bg-gray-700'
                : 'border-gray-300 text-gray-700 bg-white hover:bg-gray-50'
            ]"
          >
            <DownloadIcon class="w-4 h-4 mr-2" />
            {{ exporting ? 'Exporting...' : 'Export CSV' }}
          </button>
        </div>
      </div>

      <!-- Statistics Cards -->
      <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow rounded-lg">
          <div class="p-5">
            <div class="flex items-center">
              <div class="flex-shrink-0">
                <div class="w-8 h-8 bg-blue-500 rounded-md flex items-center justify-center">
                  <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                  </svg>
                </div>
              </div>
              <div class="ml-5 w-0 flex-1">
                <dl>
                  <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">
                    Total Audits
                  </dt>
                  <dd class="text-lg font-medium text-gray-900 dark:text-white">
                    {{ stats.total_audits?.toLocaleString() || '0' }}
                  </dd>
                </dl>
              </div>
            </div>
          </div>
        </div>

        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow rounded-lg">
          <div class="p-5">
            <div class="flex items-center">
              <div class="flex-shrink-0">
                <div class="w-8 h-8 bg-green-500 rounded-md flex items-center justify-center">
                  <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                  </svg>
                </div>
              </div>
              <div class="ml-5 w-0 flex-1">
                <dl>
                  <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">
                    Creates
                  </dt>
                  <dd class="text-lg font-medium text-gray-900 dark:text-white">
                    {{ stats.event_counts?.created || '0' }}
                  </dd>
                </dl>
              </div>
            </div>
          </div>
        </div>

        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow rounded-lg">
          <div class="p-5">
            <div class="flex items-center">
              <div class="flex-shrink-0">
                <div class="w-8 h-8 bg-yellow-500 rounded-md flex items-center justify-center">
                  <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                  </svg>
                </div>
              </div>
              <div class="ml-5 w-0 flex-1">
                <dl>
                  <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">
                    Updates
                  </dt>
                  <dd class="text-lg font-medium text-gray-900 dark:text-white">
                    {{ stats.event_counts?.updated || '0' }}
                  </dd>
                </dl>
              </div>
            </div>
          </div>
        </div>

        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow rounded-lg">
          <div class="p-5">
            <div class="flex items-center">
              <div class="flex-shrink-0">
                <div class="w-8 h-8 bg-red-500 rounded-md flex items-center justify-center">
                  <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                  </svg>
                </div>
              </div>
              <div class="ml-5 w-0 flex-1">
                <dl>
                  <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">
                    Deletes
                  </dt>
                  <dd class="text-lg font-medium text-gray-900 dark:text-white">
                    {{ stats.event_counts?.deleted || '0' }}
                  </dd>
                </dl>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Filters -->
      <div class="bg-white dark:bg-gray-800 shadow rounded-lg mb-6">
        <div class="px-4 py-5 sm:p-6">
          <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white mb-4">
            Filters
          </h3>
          
          <form @submit.prevent="applyFilters" class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-6 gap-4">
            <!-- Date From -->
            <div>
              <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                From Date
              </label>
              <input
                v-model="filters.date_from"
                type="date"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white"
              />
            </div>

            <!-- Date To -->
            <div>
              <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                To Date
              </label>
              <input
                v-model="filters.date_to"
                type="date"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white"
              />
            </div>

            <!-- Event Type -->
            <div>
              <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                Event Type
              </label>
              <select
                v-model="filters.event"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white"
              >
                <option value="">All Events</option>
                <option v-for="event in filterOptions.events" :key="event" :value="event">
                  {{ event.charAt(0).toUpperCase() + event.slice(1) }}
                </option>
              </select>
            </div>

            <!-- Model Type -->
            <div>
              <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                Model Type
              </label>
              <select
                v-model="filters.auditable_type"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white"
              >
                <option value="">All Models</option>
                <option v-for="model in filterOptions.models" :key="model.value" :value="model.value">
                  {{ model.label }}
                </option>
              </select>
            </div>

            <!-- Search -->
            <div>
              <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                Search
              </label>
              <input
                v-model="filters.search"
                type="text"
                placeholder="User, IP, URL..."
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white"
              />
            </div>

            <!-- Actions -->
            <div class="flex items-end space-x-2">
              <button
                type="submit"
                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
              >
                Apply
              </button>
              <button
                type="button"
                @click="clearFilters"
                class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md shadow-sm text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:bg-gray-700 dark:text-white dark:border-gray-600"
              >
                Clear
              </button>
            </div>
          </form>
        </div>
      </div>

      <!-- Audit Logs Table -->
      <div class="bg-white dark:bg-gray-800 shadow overflow-hidden sm:rounded-md">
        <div class="px-4 py-5 sm:px-6 border-b border-gray-200 dark:border-gray-700">
          <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white">
            Audit Logs
          </h3>
          <p class="mt-1 max-w-2xl text-sm text-gray-500 dark:text-gray-400">
            Showing {{ audits.from || 0 }} to {{ audits.to || 0 }} of {{ audits.total || 0 }} results
          </p>
        </div>

        <div class="overflow-x-auto">
          <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead class="bg-gray-50 dark:bg-gray-700">
              <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                  Event
                </th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                  Model
                </th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                  User
                </th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                  IP Address
                </th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                  Date
                </th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                  Actions
                </th>
              </tr>
            </thead>
            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
              <tr v-for="audit in audits.data" :key="audit.id" class="hover:bg-gray-50 dark:hover:bg-gray-700">
                <td class="px-6 py-4 whitespace-nowrap">
                  <span :class="getEventBadgeClass(audit.event)" class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium">
                    {{ audit.event.charAt(0).toUpperCase() + audit.event.slice(1) }}
                  </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="text-sm text-gray-900 dark:text-white">
                    {{ getModelName(audit.auditable_type) }}
                  </div>
                  <div class="text-sm text-gray-500 dark:text-gray-400">
                    ID: {{ audit.auditable_id }}
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div v-if="audit.user" class="text-sm text-gray-900 dark:text-white">
                    {{ audit.user.name }}
                  </div>
                  <div v-if="audit.user" class="text-sm text-gray-500 dark:text-gray-400">
                    {{ audit.user.email }}
                  </div>
                  <div v-else class="text-sm text-gray-500 dark:text-gray-400">
                    System
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                  {{ audit.ip_address || 'N/A' }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                  {{ formatDate(audit.created_at) }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                  <Link
                    :href="route('admin.monitoring.audit.show', audit.id)"
                    class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300"
                  >
                    View Details
                  </Link>
                </td>
              </tr>
            </tbody>
          </table>
        </div>

        <!-- Pagination -->
        <div v-if="audits.links" class="bg-white dark:bg-gray-800 px-4 py-3 border-t border-gray-200 dark:border-gray-700 sm:px-6">
          <div class="flex items-center justify-between">
            <div class="flex-1 flex justify-between sm:hidden">
              <Link
                v-if="audits.prev_page_url"
                :href="audits.prev_page_url"
                class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50"
              >
                Previous
              </Link>
              <Link
                v-if="audits.next_page_url"
                :href="audits.next_page_url"
                class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50"
              >
                Next
              </Link>
            </div>
            <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
              <div>
                <p class="text-sm text-gray-700 dark:text-gray-300">
                  Showing {{ audits.from || 0 }} to {{ audits.to || 0 }} of {{ audits.total || 0 }} results
                </p>
              </div>
              <div>
                <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px">
                  <template v-for="(link, index) in audits.links" :key="index">
                    <Link
                      v-if="link.url"
                      :href="link.url"
                      :class="[
                        'relative inline-flex items-center px-4 py-2 border text-sm font-medium',
                        link.active
                          ? 'z-10 bg-indigo-50 border-indigo-500 text-indigo-600'
                          : 'bg-white border-gray-300 text-gray-500 hover:bg-gray-50',
                        index === 0 ? 'rounded-l-md' : '',
                        index === audits.links.length - 1 ? 'rounded-r-md' : ''
                      ]"
                      v-html="link.label"
                    />
                    <span
                      v-else
                      :class="[
                        'relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-500',
                        index === 0 ? 'rounded-l-md' : '',
                        index === audits.links.length - 1 ? 'rounded-r-md' : ''
                      ]"
                      v-html="link.label"
                    />
                  </template>
                </nav>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AdminLayout>
</template>

<script setup>
import { ref, reactive, onMounted } from 'vue'
import { Head, Link, router } from '@inertiajs/vue3'
import AdminLayout from '@/Layouts/AdminLayout.vue'

const props = defineProps({
  audits: Object,
  stats: Object,
  filterOptions: Object,
  filters: Object
})

// Dark mode state
const isDarkMode = ref(false)

// Load dark mode preference and watch for changes
onMounted(() => {
    const saved = localStorage.getItem('adminDarkMode')
    isDarkMode.value = saved === 'true'
    
    // Watch for localStorage changes (when dark mode is toggled from AdminLayout)
    const handleStorageChange = () => {
        const saved = localStorage.getItem('adminDarkMode')
        isDarkMode.value = saved === 'true'
    }
    
    window.addEventListener('storage', handleStorageChange)
    
    // Also watch for custom events from AdminLayout
    window.addEventListener('adminDarkModeChanged', handleStorageChange)
    
    // Cleanup on unmount
    return () => {
        window.removeEventListener('storage', handleStorageChange)
        window.removeEventListener('adminDarkModeChanged', handleStorageChange)
    }
})

const exporting = ref(false)

const filters = reactive({
  date_from: props.filters.date_from || '',
  date_to: props.filters.date_to || '',
  event: props.filters.event || '',
  auditable_type: props.filters.auditable_type || '',
  user_id: props.filters.user_id || '',
  search: props.filters.search || ''
})

const applyFilters = () => {
  router.get(route('admin.monitoring.audit.index'), filters, {
    preserveState: true,
    replace: true
  })
}

const clearFilters = () => {
  Object.keys(filters).forEach(key => {
    filters[key] = ''
  })
  applyFilters()
}

const exportLogs = async () => {
  exporting.value = true
  try {
    const url = route('admin.monitoring.audit.export', filters)
    window.open(url, '_blank')
  } catch (error) {
    console.error('Export failed:', error)
  } finally {
    exporting.value = false
  }
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
    const lightClasses = {
      created: 'bg-green-100 text-green-800',
      updated: 'bg-yellow-100 text-yellow-800', 
      deleted: 'bg-red-100 text-red-800',
      restored: 'bg-blue-100 text-blue-800'
    }
    return lightClasses[event] || 'bg-gray-100 text-gray-800'
  }
}

const getModelName = (auditableType) => {
  if (!auditableType) return 'Unknown'
  return auditableType.split('\\').pop()
}

const formatDate = (dateString) => {
  return new Date(dateString).toLocaleString()
}
</script>
