<template>
  <AdminLayout pageTitle="Users Management">
    <div class="container mx-auto px-4 py-8">
      <!-- Header Section -->
      <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8">
        <div>
          <h1 :class="['text-3xl font-bold', isDarkMode ? 'text-white' : 'text-gray-900']">Users Management</h1>
          <p :class="[isDarkMode ? 'text-gray-300' : 'text-gray-600']">Manage users, assign roles, and control access permissions.</p>
        </div>
        <div class="flex flex-col sm:flex-row gap-4 mt-4 md:mt-0">
          <button
            @click="showCreateModal = true"
            type="button"
            class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
          >
            <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
              <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
              <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
            </svg>
            Add User
          </button>
        </div>
      </div>

    <!-- Filters and Search -->
    <div class="mt-6">
      <div :class="['shadow rounded-lg', isDarkMode ? 'bg-gray-800' : 'bg-white']">
        <div class="p-6">
          <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <!-- Search -->
            <div class="md:col-span-2">
              <label for="search" :class="['block text-sm font-medium', isDarkMode ? 'text-gray-300' : 'text-gray-700']">Search Users</label>
              <div class="mt-1 relative rounded-md shadow-sm">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                  <svg :class="['h-5 w-5', isDarkMode ? 'text-gray-500' : 'text-gray-400']" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                  </svg>
                </div>
                <input
                  v-model="search"
                  type="text"
                  name="search"
                  id="search"
                  :class="[
                    'block w-full pl-10 sm:text-sm rounded-md',
                    isDarkMode 
                      ? 'bg-gray-700 border-gray-600 text-white placeholder-gray-400 focus:ring-indigo-400 focus:border-indigo-400' 
                      : 'bg-white border-gray-300 text-gray-900 placeholder-gray-500 focus:ring-indigo-500 focus:border-indigo-500'
                  ]"
                  placeholder="Search by name or email..."
                />
              </div>
            </div>
            
            <!-- Role Filter -->
            <div>
              <label for="role-filter" :class="['block text-sm font-medium', isDarkMode ? 'text-gray-300' : 'text-gray-700']">Filter by Role</label>
              <select
                v-model="selectedRole"
                id="role-filter"
                name="role-filter"
                :class="[
                  'mt-1 block w-full pl-3 pr-10 py-2 text-base sm:text-sm rounded-md',
                  isDarkMode 
                    ? 'bg-gray-700 border-gray-600 text-white focus:ring-indigo-400 focus:border-indigo-400' 
                    : 'bg-white border-gray-300 text-gray-900 focus:ring-indigo-500 focus:border-indigo-500'
                ]"
              >
                <option value="">All Roles</option>
                <option v-for="role in availableRoles" :key="role.id" :value="role.name">
                  {{ role.name }}
                </option>
              </select>
            </div>

            <!-- Status Filter -->
            <div>
              <label for="status-filter" :class="['block text-sm font-medium', isDarkMode ? 'text-gray-300' : 'text-gray-700']">Status</label>
              <select
                v-model="selectedStatus"
                id="status-filter"
                name="status-filter"
                :class="[
                  'mt-1 block w-full pl-3 pr-10 py-2 text-base sm:text-sm rounded-md',
                  isDarkMode 
                    ? 'bg-gray-700 border-gray-600 text-white focus:ring-indigo-400 focus:border-indigo-400' 
                    : 'bg-white border-gray-300 text-gray-900 focus:ring-indigo-500 focus:border-indigo-500'
                ]"
              >
                <option value="">All Status</option>
                <option value="verified">Verified</option>
                <option value="unverified">Unverified</option>
              </select>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Users Table -->
    <div class="mt-6">
      <div :class="[
        'shadow overflow-hidden sm:rounded-lg',
        isDarkMode ? 'bg-gray-800' : 'bg-white'
      ]">
        <div class="px-4 py-5 sm:p-6">
          <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
              <thead :class="isDarkMode ? 'bg-gray-700' : 'bg-gray-50'">
                <tr>
                  <th scope="col" :class="[
                    'px-6 py-3 text-left text-xs font-medium uppercase tracking-wider',
                    isDarkMode ? 'text-gray-300' : 'text-gray-500'
                  ]">
                    User
                  </th>
                  <th scope="col" :class="[
                    'px-6 py-3 text-left text-xs font-medium uppercase tracking-wider',
                    isDarkMode ? 'text-gray-300' : 'text-gray-500'
                  ]">
                    Roles
                  </th>
                  <th scope="col" :class="[
                    'px-6 py-3 text-left text-xs font-medium uppercase tracking-wider',
                    isDarkMode ? 'text-gray-300' : 'text-gray-500'
                  ]">
                    Status
                  </th>
                  <th scope="col" :class="[
                    'px-6 py-3 text-left text-xs font-medium uppercase tracking-wider',
                    isDarkMode ? 'text-gray-300' : 'text-gray-500'
                  ]">
                    Joined
                  </th>
                  <th scope="col" :class="[
                    'px-6 py-3 text-left text-xs font-medium uppercase tracking-wider',
                    isDarkMode ? 'text-gray-300' : 'text-gray-500'
                  ]">
                    Last Activity
                  </th>
                  <th scope="col" class="relative px-6 py-3">
                    <span class="sr-only">Actions</span>
                  </th>
                </tr>
              </thead>
              <tbody :class="[
                'divide-y',
                isDarkMode ? 'bg-gray-800 divide-gray-700' : 'bg-white divide-gray-200'
              ]">
                <tr v-for="user in filteredUsers" :key="user.id" :class="[
                  isDarkMode ? 'hover:bg-gray-700' : 'hover:bg-gray-50'
                ]">
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex items-center">
                      <div class="flex-shrink-0 h-10 w-10">
                        <img
                          v-if="user.profile?.avatar_url"
                          class="h-10 w-10 rounded-full"
                          :src="user.profile.avatar_url"
                          :alt="user.name"
                        />
                        <div
                          v-else
                          :class="[
                            'h-10 w-10 rounded-full flex items-center justify-center',
                            isDarkMode ? 'bg-gray-600' : 'bg-gray-300'
                          ]"
                        >
                          <span :class="[
                            'text-sm font-medium',
                            isDarkMode ? 'text-gray-200' : 'text-gray-700'
                          ]">
                            {{ user.name.charAt(0).toUpperCase() }}
                          </span>
                        </div>
                      </div>
                      <div class="ml-4">
                        <div :class="[
                          'text-sm font-medium',
                          isDarkMode ? 'text-white' : 'text-gray-900'
                        ]">{{ user.name }}</div>
                        <div :class="[
                          'text-sm',
                          isDarkMode ? 'text-gray-300' : 'text-gray-500'
                        ]">{{ user.email }}</div>
                      </div>
                    </div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex flex-wrap gap-1">
                      <span
                        v-for="role in user.roles"
                        :key="role.id"
                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium"
                        :class="getRoleColor(role.name)"
                      >
                        {{ role.name }}
                      </span>
                      <span v-if="!user.roles || user.roles.length === 0" :class="[
                        'text-sm',
                        isDarkMode ? 'text-gray-400' : 'text-gray-500'
                      ]">
                        No roles assigned
                      </span>
                    </div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <span
                      class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium"
                      :class="getStatusBadgeClass(user.email_verified_at)"
                    >
                      {{ user.email_verified_at ? 'Verified' : 'Unverified' }}
                    </span>
                  </td>
                  <td :class="[
                    'px-6 py-4 whitespace-nowrap text-sm',
                    isDarkMode ? 'text-gray-300' : 'text-gray-900'
                  ]">
                    {{ formatDate(user.created_at) }}
                  </td>
                  <td :class="[
                    'px-6 py-4 whitespace-nowrap text-sm',
                    isDarkMode ? 'text-gray-300' : 'text-gray-900'
                  ]">
                    {{ user.last_login_at ? formatDate(user.last_login_at) : 'Never' }}
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <div class="flex items-center space-x-2">
                      <button
                        @click="editUser(user)"
                        :class="[
                          isDarkMode 
                            ? 'text-indigo-400 hover:text-indigo-300' 
                            : 'text-indigo-600 hover:text-indigo-900'
                        ]"
                      >
                        Edit
                      </button>
                      <button
                        @click="manageRoles(user)"
                        :class="[
                          isDarkMode 
                            ? 'text-blue-400 hover:text-blue-300' 
                            : 'text-blue-600 hover:text-blue-900'
                        ]"
                      >
                        Roles
                      </button>
                      <button
                        v-if="!user.email_verified_at"
                        @click="verifyUser(user)"
                        :class="[
                          isDarkMode 
                            ? 'text-green-400 hover:text-green-300' 
                            : 'text-green-600 hover:text-green-900'
                        ]"
                      >
                        Verify
                      </button>
                      <button
                        @click="deleteUser(user)"
                        :class="[
                          isDarkMode 
                            ? 'text-red-400 hover:text-red-300' 
                            : 'text-red-600 hover:text-red-900'
                        ]"
                      >
                        Delete
                      </button>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>

          <!-- Pagination -->
          <div v-if="users.total > users.per_page" class="mt-6">
            <nav :class="[
              'px-4 py-3 flex items-center justify-between border-t sm:px-6',
              isDarkMode 
                ? 'bg-gray-800 border-gray-700' 
                : 'bg-white border-gray-200'
            ]">
              <div class="hidden sm:block">
                <p :class="[
                  'text-sm',
                  isDarkMode ? 'text-gray-300' : 'text-gray-700'
                ]">
                  Showing {{ users.from }} to {{ users.to }} of {{ users.total }} results
                </p>
              </div>
              <div class="flex-1 flex justify-between sm:justify-end">
                <Link
                  v-if="users.prev_page_url"
                  :href="users.prev_page_url"
                  :class="[
                    'relative inline-flex items-center px-4 py-2 border text-sm font-medium rounded-md',
                    isDarkMode 
                      ? 'border-gray-600 text-gray-300 bg-gray-700 hover:bg-gray-600' 
                      : 'border-gray-300 text-gray-700 bg-white hover:bg-gray-50'
                  ]"
                >
                  Previous
                </Link>
                <Link
                  v-if="users.next_page_url"
                  :href="users.next_page_url"
                  :class="[
                    'ml-3 relative inline-flex items-center px-4 py-2 border text-sm font-medium rounded-md',
                    isDarkMode 
                      ? 'border-gray-600 text-gray-300 bg-gray-700 hover:bg-gray-600' 
                      : 'border-gray-300 text-gray-700 bg-white hover:bg-gray-50'
                  ]"
                >
                  Next
                </Link>
              </div>
            </nav>
          </div>
        </div>
      </div>
    </div>

    <!-- Create User Modal -->
    <div v-if="showCreateModal" class="fixed inset-0 z-50 overflow-y-auto">
      <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
        <div :class="[
          'inline-block align-bottom rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full',
          isDarkMode ? 'bg-gray-800' : 'bg-white'
        ]">
          <form @submit.prevent="createUser">
            <div :class="[
              'px-4 pt-5 pb-4 sm:p-6 sm:pb-4',
              isDarkMode ? 'bg-gray-800' : 'bg-white'
            ]">
              <div class="sm:flex sm:items-start">
                <div class="mt-3 text-center sm:mt-0 sm:text-left w-full">
                  <h3 :class="[
                    'text-lg leading-6 font-medium',
                    isDarkMode ? 'text-white' : 'text-gray-900'
                  ]">Create New User</h3>
                  <div class="mt-4 space-y-4">
                    <div>
                      <label for="name" :class="[
                        'block text-sm font-medium',
                        isDarkMode ? 'text-gray-300' : 'text-gray-700'
                      ]">Name</label>
                      <input
                        v-model="createForm.name"
                        type="text"
                        name="name"
                        id="name"
                        required
                        :class="[
                          'mt-1 block w-full shadow-sm sm:text-sm rounded-md',
                          isDarkMode 
                            ? 'bg-gray-700 border-gray-600 text-white focus:ring-indigo-400 focus:border-indigo-400' 
                            : 'bg-white border-gray-300 text-gray-900 focus:ring-indigo-500 focus:border-indigo-500'
                        ]"
                      />
                    </div>
                    <div>
                      <label for="email" :class="[
                        'block text-sm font-medium',
                        isDarkMode ? 'text-gray-300' : 'text-gray-700'
                      ]">Email</label>
                      <input
                        v-model="createForm.email"
                        type="email"
                        name="email"
                        id="email"
                        required
                        :class="[
                          'mt-1 block w-full shadow-sm sm:text-sm rounded-md',
                          isDarkMode 
                            ? 'bg-gray-700 border-gray-600 text-white focus:ring-indigo-400 focus:border-indigo-400' 
                            : 'bg-white border-gray-300 text-gray-900 focus:ring-indigo-500 focus:border-indigo-500'
                        ]"
                      />
                    </div>
                    <div>
                      <label for="password" :class="[
                        'block text-sm font-medium',
                        isDarkMode ? 'text-gray-300' : 'text-gray-700'
                      ]">Password</label>
                      <input
                        v-model="createForm.password"
                        type="password"
                        name="password"
                        id="password"
                        required
                        :class="[
                          'mt-1 block w-full shadow-sm sm:text-sm rounded-md',
                          isDarkMode 
                            ? 'bg-gray-700 border-gray-600 text-white focus:ring-indigo-400 focus:border-indigo-400' 
                            : 'bg-white border-gray-300 text-gray-900 focus:ring-indigo-500 focus:border-indigo-500'
                        ]"
                      />
                    </div>
                    <div>
                      <label for="role" :class="[
                        'block text-sm font-medium',
                        isDarkMode ? 'text-gray-300' : 'text-gray-700'
                      ]">Role</label>
                      <select
                        v-model="createForm.role"
                        id="role"
                        name="role"
                        :class="[
                          'mt-1 block w-full pl-3 pr-10 py-2 text-base sm:text-sm rounded-md',
                          isDarkMode 
                            ? 'bg-gray-700 border-gray-600 text-white focus:ring-indigo-400 focus:border-indigo-400' 
                            : 'bg-white border-gray-300 text-gray-900 focus:ring-indigo-500 focus:border-indigo-500'
                        ]"
                      >
                        <option value="">Select a role</option>
                        <option v-for="role in availableRoles" :key="role.id" :value="role.name">
                          {{ role.name }}
                        </option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div :class="[
              'px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse',
              isDarkMode ? 'bg-gray-700' : 'bg-gray-50'
            ]">
              <button
                type="submit"
                class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm"
              >
                Create User
              </button>
              <button
                @click="showCreateModal = false"
                type="button"
                :class="[
                  'mt-3 w-full inline-flex justify-center rounded-md border shadow-sm px-4 py-2 text-base font-medium focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm',
                  isDarkMode 
                    ? 'border-gray-600 text-gray-300 bg-gray-600 hover:bg-gray-500' 
                    : 'border-gray-300 text-gray-700 bg-white hover:bg-gray-50'
                ]"
              >
                Cancel
              </button>
            </div>
          </form>
        </div>        </div>
      </div>
    </div>
  </AdminLayout>
</template>

<script setup>
import { ref, computed, watch, onMounted, onUnmounted } from 'vue'
import { Link, useForm, router } from '@inertiajs/vue3'
import AdminLayout from '@/layouts/AdminLayout.vue'

const props = defineProps({
  users: {
    type: Object,
    required: true
  },
  roles: {
    type: Array,
    default: () => []
  },
  filters: {
    type: Object,
    default: () => ({})
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

// State
const showCreateModal = ref(false)
const search = ref(props.filters.search || '')
const selectedRole = ref(props.filters.role || '')
const selectedStatus = ref(props.filters.status || '')

// Form data
const createForm = useForm({
  name: '',
  email: '',
  password: '',
  role: ''
})

// Computed
const availableRoles = computed(() => props.roles || [])

const filteredUsers = computed(() => {
  let filtered = props.users.data || []
  
  if (search.value) {
    const searchTerm = search.value.toLowerCase()
    filtered = filtered.filter(user => 
      user.name.toLowerCase().includes(searchTerm) ||
      user.email.toLowerCase().includes(searchTerm)
    )
  }
  
  if (selectedRole.value) {
    filtered = filtered.filter(user => 
      user.roles && user.roles.some(role => role.name === selectedRole.value)
    )
  }
  
  if (selectedStatus.value) {
    filtered = filtered.filter(user => {
      if (selectedStatus.value === 'verified') {
        return user.email_verified_at
      } else if (selectedStatus.value === 'unverified') {
        return !user.email_verified_at
      }
      return true
    })
  }
  
  return filtered
})

// Methods
const getRoleColor = (roleName) => {
  if (isDarkMode.value) {
    const darkColors = {
      'super-admin': 'bg-red-900 text-red-200',
      'admin': 'bg-purple-900 text-purple-200',
      'instructor': 'bg-blue-900 text-blue-200',
      'content-manager': 'bg-green-900 text-green-200',
      'student': 'bg-gray-700 text-gray-200'
    }
    return darkColors[roleName] || 'bg-gray-700 text-gray-200'
  } else {
    const lightColors = {
      'super-admin': 'bg-red-100 text-red-800',
      'admin': 'bg-purple-100 text-purple-800',
      'instructor': 'bg-blue-100 text-blue-800',
      'content-manager': 'bg-green-100 text-green-800',
      'student': 'bg-gray-100 text-gray-800'
    }
    return lightColors[roleName] || 'bg-gray-100 text-gray-800'
  }
}

const getStatusBadgeClass = (isVerified) => {
  if (isDarkMode.value) {
    return isVerified 
      ? 'bg-green-900 text-green-200' 
      : 'bg-red-900 text-red-200'
  } else {
    return isVerified 
      ? 'bg-green-100 text-green-800' 
      : 'bg-red-100 text-red-800'
  }
}

const formatDate = (dateString) => {
  if (!dateString) return 'Never'
  return new Date(dateString).toLocaleDateString('en-US', {
    year: 'numeric',
    month: 'short',
    day: 'numeric'
  })
}

const createUser = () => {
  createForm.post(route('admin.users.store'), {
    onSuccess: () => {
      showCreateModal.value = false
      createForm.reset()
    }
  })
}

const editUser = (user) => {
  router.visit(route('admin.users.edit', user.id))
}

const manageRoles = (user) => {
  router.visit(route('admin.user-roles'), {
    data: { search: user.email }
  })
}

const verifyUser = (user) => {
  router.post(route('admin.users.verify', user.id))
}

const deleteUser = (user) => {
  if (confirm(`Are you sure you want to delete ${user.name}?`)) {
    router.delete(route('admin.users.destroy', user.id))
  }
}

// Watch for filter changes and update URL
watch([search, selectedRole, selectedStatus], () => {
  router.get(route('admin.users.index'), {
    search: search.value,
    role: selectedRole.value,
    status: selectedStatus.value
  }, {
    preserveState: true,
    replace: true
  })
}, { debounce: 300 })
</script>
