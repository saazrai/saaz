<template>
  <AdminLayout>
    <Head title="Audit Logs" />
    
    <div class="container mx-auto px-4 py-8">
      <!-- Header -->
      <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8">
        <div>
          <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Audit Logs</h1>
          <p class="text-gray-700 dark:text-gray-300">Track all changes and activities across the system</p>
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
                  <dt class="text-sm font-medium text-gray-600 dark:text-gray-400 truncate">
                    Total Audits
                  </dt>
                  <dd class="text-lg font-semibold text-gray-900 dark:text-white">
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
                  <dt class="text-sm font-medium text-gray-600 dark:text-gray-400 truncate">
                    Creates
                  </dt>
                  <dd class="text-lg font-semibold text-gray-900 dark:text-white">
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
                  <dt class="text-sm font-medium text-gray-600 dark:text-gray-400 truncate">
                    Updates
                  </dt>
                  <dd class="text-lg font-semibold text-gray-900 dark:text-white">
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
                  <dt class="text-sm font-medium text-gray-600 dark:text-gray-400 truncate">
                    Deletes
                  </dt>
                  <dd class="text-lg font-semibold text-gray-900 dark:text-white">
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
          
          <form @submit.prevent="applyFilters" class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-4">
            <!-- Date Range -->
            <div>
              <Label for="date_preset">Date Range</Label>
              <div class="mt-1 space-y-2">
                <!-- Preset Options -->
                <Select v-model="filters.date_preset" @update:model-value="handleDatePresetChange">
                  <SelectTrigger id="date_preset" class="text-gray-900 dark:text-gray-100">
                    <SelectValue placeholder="Select date range" />
                  </SelectTrigger>
                  <SelectContent class="bg-white dark:bg-gray-800 bg-opacity-95 dark:bg-opacity-95">
                    <SelectItem value="all">All Time</SelectItem>
                    <SelectItem value="today">Today</SelectItem>
                    <SelectItem value="yesterday">Yesterday</SelectItem>
                    <SelectItem value="last_7_days">Last 7 Days</SelectItem>
                    <SelectItem value="last_30_days">Last 30 Days</SelectItem>
                    <SelectItem value="this_month">This Month</SelectItem>
                    <SelectItem value="last_month">Last Month</SelectItem>
                    <SelectItem value="custom">Custom Range</SelectItem>
                  </SelectContent>
                </Select>
                
                <!-- Custom Date Inputs -->
                <div v-if="filters.date_preset === 'custom'" class="grid grid-cols-2 gap-2">
                  <Input
                    type="date"
                    id="date_from"
                    v-model="filters.date_from"
                    @change="applyFilters"
                  />
                  <Input
                    type="date"
                    id="date_to"
                    v-model="filters.date_to"
                    @change="applyFilters"
                  />
                </div>
              </div>
            </div>

            <!-- Event Type -->
            <div>
              <Label for="event">Event Type</Label>
              <Select v-model="filters.event">
                <SelectTrigger id="event" class="mt-1 text-gray-900 dark:text-gray-100">
                  <SelectValue placeholder="All Events" />
                </SelectTrigger>
                <SelectContent class="bg-white dark:bg-gray-800 bg-opacity-95 dark:bg-opacity-95">
                  <SelectItem value="all">All Events</SelectItem>
                  <SelectItem v-for="event in filterOptions.events" :key="event" :value="event">
                    {{ event.charAt(0).toUpperCase() + event.slice(1) }}
                  </SelectItem>
                </SelectContent>
              </Select>
            </div>

            <!-- Model Type -->
            <div>
              <Label for="model_type">Model Type</Label>
              <Select v-model="filters.auditable_type">
                <SelectTrigger id="model_type" class="mt-1 text-gray-900 dark:text-gray-100">
                  <SelectValue placeholder="All Models" />
                </SelectTrigger>
                <SelectContent class="bg-white dark:bg-gray-800 bg-opacity-95 dark:bg-opacity-95">
                  <SelectItem value="all">All Models</SelectItem>
                  <SelectItem v-for="model in filterOptions.models" :key="model.value" :value="model.value">
                    {{ model.label }}
                  </SelectItem>
                </SelectContent>
              </Select>
            </div>

            <!-- Search -->
            <div>
              <Label for="search">Search</Label>
              <Input
                id="search"
                v-model="filters.search"
                type="text"
                placeholder="User, IP, URL..."
                class="mt-1"
              />
            </div>

            <!-- Actions -->
            <div class="flex items-end space-x-2">
              <Button type="submit" class="bg-indigo-600 hover:bg-indigo-700">
                Apply
              </Button>
              <Button
                type="button"
                variant="outline"
                @click="clearFilters"
              >
                Clear
              </Button>
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
          <p class="mt-1 max-w-2xl text-sm text-gray-600 dark:text-gray-400">
            Showing {{ audits.from || 0 }} to {{ audits.to || 0 }} of {{ audits.total || 0 }} results
          </p>
        </div>

        <div class="overflow-x-auto">
          <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead class="bg-gray-50 dark:bg-gray-700">
              <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                  Event
                </th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                  Model
                </th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                  User
                </th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                  IP Address
                </th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                  Date
                </th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase tracking-wider">
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
                  <div class="text-sm text-gray-600 dark:text-gray-400">
                    ID: {{ audit.auditable_id }}
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div v-if="audit.user" class="text-sm text-gray-900 dark:text-white">
                    {{ audit.user.name }}
                  </div>
                  <div v-if="audit.user" class="text-sm text-gray-600 dark:text-gray-400">
                    {{ audit.user.email }}
                  </div>
                  <div v-else class="text-sm text-gray-600 dark:text-gray-400">
                    System
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-gray-400">
                  {{ audit.ip_address || 'N/A' }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-gray-400">
                  {{ formatDate(audit.created_at) }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                  <Link
                    :href="route('admin.audits.show', audit.id)"
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
                    >
                      {{ link.label }}
                    </Link>
                    <span
                      v-else
                      :class="[
                        'relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-500',
                        index === 0 ? 'rounded-l-md' : '',
                        index === audits.links.length - 1 ? 'rounded-r-md' : ''
                      ]"
                    >
                      {{ link.label }}
                    </span>
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

<script setup lang="ts">
import { ref, reactive, onMounted } from 'vue'
import { Head, Link, router } from '@inertiajs/vue3'
import AdminLayout from '@/layouts/AdminLayout.vue'
import { Input } from '@/components/shadcn/ui/input'
import { Label } from '@/components/shadcn/ui/label'
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/shadcn/ui/select'
import { Button } from '@/components/shadcn/ui/button'

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


const filters = reactive({
  date_from: props.filters.date_from || '',
  date_to: props.filters.date_to || '',
  date_preset: props.filters.date_preset || 'all',
  event: props.filters.event || 'all',
  auditable_type: props.filters.auditable_type || 'all',
  user_id: props.filters.user_id || '',
  search: props.filters.search || ''
})

const applyFilters = () => {
  // Convert 'all' values to empty strings for backend
  const processedFilters = Object.keys(filters).reduce((acc, key) => {
    if (filters[key] === 'all' && (key === 'event' || key === 'auditable_type')) {
      acc[key] = ''
    } else {
      acc[key] = filters[key]
    }
    return acc
  }, {})
  
  router.get(route('admin.audits.index'), processedFilters, {
    preserveState: true,
    replace: true
  })
}

const clearFilters = () => {
  Object.keys(filters).forEach(key => {
    if (key === 'date_preset' || key === 'event' || key === 'auditable_type') {
      filters[key] = 'all'
    } else {
      filters[key] = ''
    }
  })
  applyFilters()
}

const handleDatePresetChange = (preset) => {
  const today = new Date();
  const formatDate = (date) => date.toISOString().split('T')[0];
  
  switch (preset) {
    case 'today':
      filters.date_from = formatDate(today);
      filters.date_to = formatDate(today);
      break;
    case 'yesterday':
      const yesterday = new Date(today);
      yesterday.setDate(yesterday.getDate() - 1);
      filters.date_from = formatDate(yesterday);
      filters.date_to = formatDate(yesterday);
      break;
    case 'last_7_days':
      const last7Days = new Date(today);
      last7Days.setDate(last7Days.getDate() - 7);
      filters.date_from = formatDate(last7Days);
      filters.date_to = formatDate(today);
      break;
    case 'last_30_days':
      const last30Days = new Date(today);
      last30Days.setDate(last30Days.getDate() - 30);
      filters.date_from = formatDate(last30Days);
      filters.date_to = formatDate(today);
      break;
    case 'this_month':
      const thisMonthStart = new Date(today.getFullYear(), today.getMonth(), 1);
      filters.date_from = formatDate(thisMonthStart);
      filters.date_to = formatDate(today);
      break;
    case 'last_month':
      const lastMonthStart = new Date(today.getFullYear(), today.getMonth() - 1, 1);
      const lastMonthEnd = new Date(today.getFullYear(), today.getMonth(), 0);
      filters.date_from = formatDate(lastMonthStart);
      filters.date_to = formatDate(lastMonthEnd);
      break;
    case 'custom':
      // Keep existing dates for custom range
      break;
    case 'all':
    default:
      filters.date_from = '';
      filters.date_to = '';
      break;
  }
  
  if (preset !== 'custom') {
    applyFilters();
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
