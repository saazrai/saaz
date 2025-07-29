<template>
    <AdminLayout>
        <template #header>
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
                        Edit Permission
                    </h1>
                    <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                        Edit "{{ permission.name }}" permission
                    </p>
                </div>
            </div>
        </template>

        <div class="py-6">
            <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
                <Card>
                    <CardHeader>
                        <CardTitle class="flex items-center gap-2">
                            <Shield class="h-5 w-5" />
                            Permission Details
                        </CardTitle>
                        <CardDescription>
                            Update the permission details below. Changes will affect all roles that have this permission.
                        </CardDescription>
                    </CardHeader>
                    <CardContent>
                        <form @submit.prevent="submit" class="space-y-6">
                            <div class="grid grid-cols-1 gap-6">
                                <!-- Permission Name -->
                                <div>
                                    <Label for="name" class="text-sm font-medium text-gray-700 dark:text-gray-300">
                                        Permission Name *
                                    </Label>
                                    <Input
                                        id="name"
                                        v-model="form.name"
                                        type="text"
                                        placeholder="e.g., view users, edit posts, manage settings"
                                        class="mt-1"
                                        :class="{ 'border-red-500': errors.name }"
                                        required
                                    />
                                    <p v-if="errors.name" class="mt-1 text-sm text-red-600">{{ errors.name }}</p>
                                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                        Use descriptive names like "view users" or "manage settings". Use lowercase with spaces.
                                    </p>
                                </div>

                                <!-- Guard Name -->
                                <div>
                                    <Label for="guard_name" class="text-sm font-medium text-gray-700 dark:text-gray-300">
                                        Guard Name
                                    </Label>
                                    <Input
                                        id="guard_name"
                                        v-model="form.guard_name"
                                        type="text"
                                        placeholder="web"
                                        class="mt-1"
                                        :class="{ 'border-red-500': errors.guard_name }"
                                    />
                                    <p v-if="errors.guard_name" class="mt-1 text-sm text-red-600">{{ errors.guard_name }}</p>
                                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                        Usually "web" for web applications.
                                    </p>
                                </div>

                                <!-- Role Assignment -->
                                <div>
                                    <Label class="text-sm font-medium text-gray-700 dark:text-gray-300">
                                        Assign to Roles
                                    </Label>
                                    <div class="mt-2 space-y-2">
                                        <div
                                            v-for="role in roles"
                                            :key="role.id"
                                            class="flex items-center space-x-3"
                                        >
                                            <input
                                                :id="`role-${role.id}`"
                                                v-model="form.roles"
                                                :value="role.id"
                                                type="checkbox"
                                                class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                                            />
                                            <Label
                                                :for="`role-${role.id}`"
                                                class="text-sm text-gray-700 dark:text-gray-300 cursor-pointer"
                                            >
                                                {{ role.name }}
                                            </Label>
                                        </div>
                                    </div>
                                    <p v-if="errors.roles" class="mt-1 text-sm text-red-600">{{ errors.roles }}</p>
                                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                        Select which roles should have this permission.
                                    </p>
                                </div>
                            </div>

                            <!-- Actions -->
                            <div class="flex items-center justify-end gap-4 pt-6 border-t border-gray-200 dark:border-gray-700">
                                <Button
                                    type="button"
                                    variant="outline"
                                    @click="$inertia.visit(safeRoute('admin.permissions.index'))"
                                >
                                    Cancel
                                </Button>
                                <Button
                                    type="submit"
                                    :disabled="processing"
                                    class="flex items-center gap-2"
                                >
                                    <span v-if="processing">
                                        <Loader2 class="h-4 w-4 animate-spin" />
                                        Updating...
                                    </span>
                                    <span v-else>
                                        Update Permission
                                    </span>
                                </Button>
                            </div>
                        </form>
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
import { Input } from '@/components/shadcn/ui/input'
import { Label } from '@/components/shadcn/ui/label'
import { Shield, ArrowLeft, Loader2 } from 'lucide-vue-next'

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
    assigned_roles: Array,
    errors: Object
})

const form = ref({
    name: props.permission.name,
    guard_name: props.permission.guard_name,
    roles: [...props.assigned_roles]
})

const processing = ref(false)

const submit = () => {
    processing.value = true
    
    router.put(safeRoute('admin.permissions.update', props.permission.id), form.value, {
        onFinish: () => {
            processing.value = false
        }
    })
}
</script>