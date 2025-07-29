<template>
  <AdminLayout :pageTitle="`Edit User: ${user.name}`">
    <div class="container mx-auto px-4 py-8">
      <!-- Header -->
      <div class="mb-8">
        <Link :href="route('admin.users.index')" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 flex items-center gap-2 mb-4">
          <ChevronLeft class="h-4 w-4" />
          Back to Users
        </Link>
        <h1 :class="['text-3xl font-bold', isDarkMode ? 'text-white' : 'text-gray-900']">
          Edit User
        </h1>
        <p :class="[isDarkMode ? 'text-gray-300' : 'text-gray-600']">
          Update user information and permissions
        </p>
      </div>

      <!-- Form -->
      <div :class="['rounded-lg shadow-sm', isDarkMode ? 'bg-gray-800' : 'bg-white']">
        <form @submit.prevent="updateUser" class="p-6 space-y-6">
          <!-- Basic Information -->
          <div>
            <h3 :class="['text-lg font-semibold mb-4', isDarkMode ? 'text-white' : 'text-gray-900']">
              Basic Information
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <div>
                <label for="name" :class="['block text-sm font-medium mb-2', isDarkMode ? 'text-gray-300' : 'text-gray-700']">
                  Name
                </label>
                <input
                  v-model="form.name"
                  type="text"
                  id="name"
                  :class="[
                    'block w-full px-3 py-2 rounded-md shadow-sm border transition-colors duration-200',
                    isDarkMode 
                      ? 'bg-gray-800 border-gray-600 text-white placeholder-gray-400 focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400' 
                      : 'bg-white border-gray-300 text-gray-900 placeholder-gray-500 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500'
                  ]"
                  required
                />
                <p v-if="form.errors.name" class="mt-2 text-sm text-red-600">{{ form.errors.name }}</p>
              </div>

              <div>
                <label for="email" :class="['block text-sm font-medium mb-2', isDarkMode ? 'text-gray-300' : 'text-gray-700']">
                  Email
                </label>
                <input
                  v-model="form.email"
                  type="email"
                  id="email"
                  :class="[
                    'block w-full px-3 py-2 rounded-md shadow-sm border transition-colors duration-200',
                    isDarkMode 
                      ? 'bg-gray-800 border-gray-600 text-white placeholder-gray-400 focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400' 
                      : 'bg-white border-gray-300 text-gray-900 placeholder-gray-500 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500'
                  ]"
                  required
                />
                <p v-if="form.errors.email" class="mt-2 text-sm text-red-600">{{ form.errors.email }}</p>
              </div>
            </div>
          </div>

          <!-- Status -->
          <div>
            <h3 :class="['text-lg font-semibold mb-4', isDarkMode ? 'text-white' : 'text-gray-900']">
              Account Status
            </h3>
            <div class="space-y-4">
              <div class="flex items-center">
                <input
                  v-model="form.is_active"
                  type="checkbox"
                  id="is_active"
                  :class="[
                    'h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-colors',
                    isDarkMode ? 'focus:ring-offset-gray-800' : 'focus:ring-offset-white'
                  ]"
                />
                <label for="is_active" :class="['ml-2 block text-sm', isDarkMode ? 'text-gray-300' : 'text-gray-700']">
                  Account is active
                </label>
              </div>

              <div class="flex items-center">
                <input
                  v-model="form.email_verified"
                  type="checkbox"
                  id="email_verified"
                  :class="[
                    'h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-colors',
                    isDarkMode ? 'focus:ring-offset-gray-800' : 'focus:ring-offset-white'
                  ]"
                />
                <label for="email_verified" :class="['ml-2 block text-sm', isDarkMode ? 'text-gray-300' : 'text-gray-700']">
                  Email is verified
                </label>
              </div>
            </div>
          </div>

          <!-- Roles -->
          <div>
            <h3 :class="['text-lg font-semibold mb-4', isDarkMode ? 'text-white' : 'text-gray-900']">
              Roles & Permissions
            </h3>
            <div class="space-y-3">
              <div v-for="role in availableRoles" :key="role" class="flex items-center">
                <input
                  :id="`role-${role}`"
                  v-model="form.roles"
                  :value="role"
                  type="checkbox"
                  :class="[
                    'h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-colors',
                    isDarkMode ? 'focus:ring-offset-gray-800' : 'focus:ring-offset-white'
                  ]"
                />
                <label :for="`role-${role}`" :class="['ml-2 block text-sm', isDarkMode ? 'text-gray-300' : 'text-gray-700']">
                  {{ role }}
                </label>
              </div>
            </div>
            <p v-if="form.errors.roles" class="mt-2 text-sm text-red-600">{{ form.errors.roles }}</p>
          </div>

          <!-- Password (optional) -->
          <div>
            <h3 :class="['text-lg font-semibold mb-4', isDarkMode ? 'text-white' : 'text-gray-900']">
              Change Password (Optional)
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <div>
                <label for="password" :class="['block text-sm font-medium mb-2', isDarkMode ? 'text-gray-300' : 'text-gray-700']">
                  New Password
                </label>
                <input
                  v-model="form.password"
                  type="password"
                  id="password"
                  :class="[
                    'block w-full px-3 py-2 rounded-md shadow-sm border transition-colors duration-200',
                    isDarkMode 
                      ? 'bg-gray-800 border-gray-600 text-white placeholder-gray-400 focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400' 
                      : 'bg-white border-gray-300 text-gray-900 placeholder-gray-500 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500'
                  ]"
                  placeholder="Leave blank to keep current password"
                />
                <p v-if="form.errors.password" class="mt-2 text-sm text-red-600">{{ form.errors.password }}</p>
              </div>

              <div>
                <label for="password_confirmation" :class="['block text-sm font-medium mb-2', isDarkMode ? 'text-gray-300' : 'text-gray-700']">
                  Confirm Password
                </label>
                <input
                  v-model="form.password_confirmation"
                  type="password"
                  id="password_confirmation"
                  :class="[
                    'block w-full px-3 py-2 rounded-md shadow-sm border transition-colors duration-200',
                    isDarkMode 
                      ? 'bg-gray-800 border-gray-600 text-white placeholder-gray-400 focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400' 
                      : 'bg-white border-gray-300 text-gray-900 placeholder-gray-500 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500'
                  ]"
                  placeholder="Confirm new password"
                />
              </div>
            </div>
          </div>

          <!-- Form Actions -->
          <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200 dark:border-gray-700">
            <Link
              :href="route('admin.users.index')"
              :class="[
                'px-4 py-2 border rounded-md text-sm font-medium',
                isDarkMode 
                  ? 'border-gray-600 text-gray-300 hover:bg-gray-700' 
                  : 'border-gray-300 text-gray-700 hover:bg-gray-50'
              ]"
            >
              Cancel
            </Link>
            <button
              type="submit"
              :disabled="form.processing"
              :class="[
                'px-4 py-2 border border-transparent rounded-md text-sm font-medium text-white',
                form.processing 
                  ? 'bg-indigo-400 cursor-not-allowed' 
                  : 'bg-indigo-600 hover:bg-indigo-700'
              ]"
            >
              {{ form.processing ? 'Saving...' : 'Save Changes' }}
            </button>
          </div>
        </form>
      </div>
    </div>
  </AdminLayout>
</template>

<script setup lang="ts">
import { ref, onMounted, onUnmounted } from 'vue'
import { Link, useForm } from '@inertiajs/vue3'
import AdminLayout from '@/layouts/AdminLayout.vue'
import { ChevronLeft } from 'lucide-vue-next'

const props = defineProps({
  user: {
    type: Object,
    required: true
  },
  roles: {
    type: Array,
    default: () => []
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

// Available roles
const availableRoles = ['super-admin', 'admin', 'moderator', 'user']

// Form setup
const form = useForm({
  name: props.user.name,
  email: props.user.email,
  is_active: props.user.is_active,
  email_verified: !!props.user.email_verified_at,
  roles: props.user.roles?.map(r => r.name) || [],
  password: '',
  password_confirmation: ''
})

// Update user
const updateUser = () => {
  form.put(route('admin.users.update', props.user.id), {
    preserveScroll: true,
    onSuccess: () => {
      form.reset('password', 'password_confirmation')
    }
  })
}
</script>