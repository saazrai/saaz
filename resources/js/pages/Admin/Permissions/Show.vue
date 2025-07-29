<template>
    <AdminLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <Button
                        variant="ghost"
                        @click="$inertia.visit(safeRoute('admin.permissions.index'))"
                        class="flex items-center gap-2"
                    >
                        <ArrowLeft class="h-4 w-4" />
                        Back to Permissions
                    </Button>
                    <div>
                        <h1 class="text-2xl font-semibold text-gray-900 dark:text-gray-100">
                            {{ permission.name }}
                        </h1>
                        <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                            Permission details and role assignments
                        </p>
                    </div>
                </div>
                <div class="flex gap-2">
                    <Button
                        @click="$inertia.visit(safeRoute('admin.permissions.edit', permission.id))"
                        class="flex items-center gap-2"
                    >
                        <Pencil class="h-4 w-4" />
                        Edit Permission
                    </Button>
                </div>
            </div>
        </template>

        <div class="py-6">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
                <!-- Permission Details -->
                <Card>
                    <CardHeader>
                        <CardTitle class="flex items-center gap-2">
                            <Shield class="h-5 w-5" />
                            Permission Information
                        </CardTitle>
                    </CardHeader>
                    <CardContent class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <Label class="text-sm font-medium text-gray-500 dark:text-gray-400">
                                    Permission Name
                                </Label>
                                <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">
                                    {{ permission.name }}
                                </p>
                            </div>
                            <div>
                                <Label class="text-sm font-medium text-gray-500 dark:text-gray-400">
                                    Guard Name
                                </Label>
                                <p class="mt-1">
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200">
                                        {{ permission.guard_name }}
                                    </span>
                                </p>
                            </div>
                            <div>
                                <Label class="text-sm font-medium text-gray-500 dark:text-gray-400">
                                    Created At
                                </Label>
                                <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">
                                    {{ new Date(permission.created_at).toLocaleString() }}
                                </p>
                            </div>
                            <div>
                                <Label class="text-sm font-medium text-gray-500 dark:text-gray-400">
                                    Last Updated
                                </Label>
                                <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">
                                    {{ new Date(permission.updated_at).toLocaleString() }}
                                </p>
                            </div>
                        </div>
                    </CardContent>
                </Card>

                <!-- Role Assignments -->
                <Card>
                    <CardHeader>
                        <div class="flex items-center justify-between">
                            <div>
                                <CardTitle class="flex items-center gap-2">
                                    <Users class="h-5 w-5" />
                                    Role Assignments
                                </CardTitle>
                                <CardDescription>
                                    Roles that currently have this permission
                                </CardDescription>
                            </div>
                            <div class="flex gap-2">
                                <select
                                    v-model="selectedRoleToAssign"
                                    class="text-sm border border-gray-300 rounded-md px-3 py-1"
                                >
                                    <option value="">Select role to assign...</option>
                                    <option
                                        v-for="role in available_roles"
                                        :key="role.id"
                                        :value="role.id"
                                    >
                                        {{ role.name }}
                                    </option>
                                </select>
                                <Button
                                    @click="assignRole"
                                    :disabled="!selectedRoleToAssign"
                                    size="sm"
                                    class="flex items-center gap-2"
                                >
                                    <Plus class="h-4 w-4" />
                                    Assign
                                </Button>
                            </div>
                        </div>
                    </CardHeader>
                    <CardContent>
                        <div v-if="roles.length === 0" class="text-center py-8">
                            <Users class="h-12 w-12 text-gray-400 mx-auto mb-4" />
                            <p class="text-gray-500 dark:text-gray-400">
                                No roles assigned to this permission
                            </p>
                        </div>
                        <div v-else class="space-y-3">
                            <div
                                v-for="role in roles"
                                :key="role.id"
                                class="flex items-center justify-between p-4 border border-gray-200 dark:border-gray-700 rounded-lg"
                            >
                                <div class="flex items-center gap-3">
                                    <div class="p-2 bg-blue-500/10 rounded-lg">
                                        <Shield class="h-5 w-5 text-blue-600" />
                                    </div>
                                    <div>
                                        <h4 class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                            {{ role.name }}
                                        </h4>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">
                                            Created {{ new Date(role.created_at).toLocaleDateString() }}
                                        </p>
                                    </div>
                                </div>
                                <Button
                                    @click="revokeRole(role)"
                                    variant="outline"
                                    size="sm"
                                    class="text-red-600 hover:text-red-900 hover:border-red-300"
                                >
                                    <X class="h-4 w-4" />
                                    Revoke
                                </Button>
                            </div>
                        </div>
                    </CardContent>
                </Card>
            </div>
        </div>
    </AdminLayout>
</template>

<script setup lang="ts">
import { ref } from 'vue'
import { router } from '@inertiajs/vue3'
import AdminLayout from '@/layouts/AdminLayout.vue'
import { Card, CardHeader, CardTitle, CardDescription, CardContent } from '@/components/shadcn/ui/card'
import { Button } from '@/components/shadcn/ui/button'
import { Label } from '@/components/shadcn/ui/label'
import { Shield, Users, ArrowLeft, Pencil, Plus, X } from 'lucide-vue-next'

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
    permission: Object,
    roles: Array,
    available_roles: Array
})

const selectedRoleToAssign = ref('')

const assignRole = () => {
    if (!selectedRoleToAssign.value) return
    
    router.post(safeRoute('admin.permissions.assign-role', props.permission.id), {
        role_id: selectedRoleToAssign.value
    }, {
        onSuccess: () => {
            selectedRoleToAssign.value = ''
        }
    })
}

const revokeRole = (role) => {
    if (confirm(`Are you sure you want to revoke this permission from the "${role.name}" role?`)) {
        router.post(safeRoute('admin.permissions.revoke-role', props.permission.id), {
            role_id: role.id
        })
    }
}
</script>