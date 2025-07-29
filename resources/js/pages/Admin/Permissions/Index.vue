<template>
    <AdminLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-semibold text-gray-900 dark:text-gray-100">
                        Permission Management
                    </h1>
                    <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                        Manage system permissions and role assignments
                    </p>
                </div>
            </div>
        </template>

        <div class="py-6">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <Card>
                        <CardContent class="p-6">
                            <div class="flex items-center">
                                <div class="p-2 bg-blue-500/10 rounded-lg">
                                    <Shield class="h-6 w-6 text-blue-600" />
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">
                                        Total Permissions
                                    </p>
                                    <p class="text-2xl font-semibold text-gray-900 dark:text-gray-100">
                                        {{ stats.total_permissions }}
                                    </p>
                                </div>
                            </div>
                        </CardContent>
                    </Card>
                    
                    <Card>
                        <CardContent class="p-6">
                            <div class="flex items-center">
                                <div class="p-2 bg-green-500/10 rounded-lg">
                                    <Users class="h-6 w-6 text-green-600" />
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">
                                        Total Roles
                                    </p>
                                    <p class="text-2xl font-semibold text-gray-900 dark:text-gray-100">
                                        {{ stats.total_roles }}
                                    </p>
                                </div>
                            </div>
                        </CardContent>
                    </Card>
                </div>

                <!-- Filters and Actions -->
                <Card class="mb-6">
                    <CardContent class="p-6">
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                            <div class="flex flex-col sm:flex-row gap-4">
                                <div class="relative">
                                    <Search class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 h-4 w-4" />
                                    <Input
                                        v-model="filters.search"
                                        placeholder="Search permissions..."
                                        class="pl-10 w-full sm:w-64"
                                        @input="debouncedSearch"
                                    />
                                </div>
                            </div>
                            
                            <div class="flex gap-2">
                                <Button
                                    @click="$inertia.visit(safeRoute('admin.permissions.create'))"
                                    class="flex items-center gap-2"
                                >
                                    <Plus class="h-4 w-4" />
                                    Add Permission
                                </Button>
                            </div>
                        </div>
                    </CardContent>
                </Card>

                <!-- Permissions Table -->
                <Card>
                    <CardContent class="p-0">
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-50 dark:bg-gray-800">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                            <button
                                                @click="sort('name')"
                                                class="flex items-center gap-1 hover:text-gray-700 dark:hover:text-gray-200"
                                            >
                                                Permission Name
                                                <ArrowUpDown class="h-3 w-3" />
                                            </button>
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                            Guard
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                            Assigned Roles
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                            Created
                                        </th>
                                        <th scope="col" class="relative px-6 py-3">
                                            <span class="sr-only">Actions</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-700">
                                    <tr
                                        v-for="permission in permissions.data"
                                        :key="permission.id"
                                        class="hover:bg-gray-50 dark:hover:bg-gray-800 cursor-pointer"
                                        @click="$inertia.visit(safeRoute('admin.permissions.show', permission.id))"
                                    >
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <Shield class="h-5 w-5 text-gray-400 mr-3" />
                                                <div>
                                                    <div class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                                        {{ permission.name }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200">
                                                {{ permission.guard_name }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex flex-wrap gap-1">
                                                <span
                                                    v-for="role in permission.roles_list"
                                                    :key="role"
                                                    class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200"
                                                >
                                                    {{ role }}
                                                </span>
                                                <span
                                                    v-if="permission.roles_count === 0"
                                                    class="text-xs text-gray-500 dark:text-gray-400"
                                                >
                                                    No roles assigned
                                                </span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                            {{ new Date(permission.created_at).toLocaleDateString() }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <div class="flex items-center justify-end gap-2">
                                                <Button
                                                    variant="ghost"
                                                    size="sm"
                                                    @click.stop="$inertia.visit(safeRoute('admin.permissions.edit', permission.id))"
                                                >
                                                    <Pencil class="h-4 w-4" />
                                                </Button>
                                                <Button
                                                    variant="ghost"
                                                    size="sm"
                                                    @click.stop="deletePermission(permission)"
                                                    class="text-red-600 hover:text-red-900"
                                                >
                                                    <Trash2 class="h-4 w-4" />
                                                </Button>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        
                        <!-- Pagination -->
                        <div v-if="permissions.links.length > 3" class="px-6 py-4 border-t border-gray-200 dark:border-gray-700">
                            <nav class="flex items-center justify-between">
                                <div class="flex-1 flex justify-between sm:hidden">
                                    <Link
                                        v-if="permissions.prev_page_url"
                                        :href="permissions.prev_page_url"
                                        class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-700"
                                    >
                                        Previous
                                    </Link>
                                    <span
                                        v-else
                                        class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-400 bg-gray-100 cursor-not-allowed dark:bg-gray-700 dark:text-gray-500 dark:border-gray-600"
                                    >
                                        Previous
                                    </span>
                                    <Link
                                        v-if="permissions.next_page_url"
                                        :href="permissions.next_page_url"
                                        class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-700"
                                    >
                                        Next
                                    </Link>
                                    <span
                                        v-else
                                        class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-400 bg-gray-100 cursor-not-allowed dark:bg-gray-700 dark:text-gray-500 dark:border-gray-600"
                                    >
                                        Next
                                    </span>
                                </div>
                                <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                                    <div>
                                        <p class="text-sm text-gray-700 dark:text-gray-300">
                                            Showing {{ permissions.from }} to {{ permissions.to }} of {{ permissions.total }} results
                                        </p>
                                    </div>
                                    <div>
                                        <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px">
                                            <template v-for="link in permissions.links" :key="link.label">
                                                <Link
                                                    v-if="link.url !== null"
                                                    :href="link.url"
                                                    :class="[
                                                        'relative inline-flex items-center px-4 py-2 border text-sm font-medium',
                                                        link.active
                                                            ? 'z-10 bg-blue-50 border-blue-500 text-blue-600 dark:bg-blue-900 dark:border-blue-400 dark:text-blue-200'
                                                            : 'bg-white border-gray-300 text-gray-500 hover:bg-gray-50 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-400 dark:hover:bg-gray-700'
                                                    ]"
                                                >
                                                    {{ link.label }}
                                                </Link>
                                                <span
                                                    v-else
                                                    class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium bg-gray-100 text-gray-400 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:text-gray-500"
                                                >
                                                    {{ link.label }}
                                                </span>
                                            </template>
                                        </nav>
                                    </div>
                                </div>
                            </nav>
                        </div>
                    </CardContent>
                </Card>
            </div>
        </div>
    </AdminLayout>
</template>

<script setup lang="ts">
import { ref } from 'vue'
import { router, Link } from '@inertiajs/vue3'
import { debounce } from 'lodash'
import AdminLayout from '@/layouts/AdminLayout.vue'
import { Card, CardContent } from '@/components/shadcn/ui/card'
import { Button } from '@/components/shadcn/ui/button'
import { Input } from '@/components/shadcn/ui/input'
import { Shield, Users, Search, Plus, ArrowUpDown, Pencil, Trash2 } from 'lucide-vue-next'

// Helper function to safely generate routes
const safeRoute = (routeName, params = {}) => {
    try {
        return route(routeName, params)
    } catch {
        console.warn(`Route ${routeName} not found`)
        return '#'
    }
}

const props = defineProps({
    permissions: Object,
    filters: Object,
    stats: Object
})

const filters = ref({
    search: props.filters.search || '',
    sort_by: props.filters.sort_by || 'name',
    sort_order: props.filters.sort_order || 'asc'
})

const debouncedSearch = debounce(() => {
    router.get(safeRoute('admin.permissions.index'), {
        search: filters.value.search,
        sort_by: filters.value.sort_by,
        sort_order: filters.value.sort_order
    }, {
        preserveState: true,
        replace: true
    })
}, 300)

const sort = (column) => {
    if (filters.value.sort_by === column) {
        filters.value.sort_order = filters.value.sort_order === 'asc' ? 'desc' : 'asc'
    } else {
        filters.value.sort_by = column
        filters.value.sort_order = 'asc'
    }
    
    router.get(safeRoute('admin.permissions.index'), {
        search: filters.value.search,
        sort_by: filters.value.sort_by,
        sort_order: filters.value.sort_order
    }, {
        preserveState: true,
        replace: true
    })
}

const deletePermission = (permission) => {
    if (permission.roles_count > 0) {
        alert('Cannot delete permission that is assigned to roles. Remove role assignments first.')
        return
    }
    
    if (confirm(`Are you sure you want to delete the "${permission.name}" permission?`)) {
        router.delete(safeRoute('admin.permissions.destroy', permission.id))
    }
}
</script>