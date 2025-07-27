<script setup lang="ts">
import { Head, Link, useForm, usePage } from '@inertiajs/vue3';
import { ref, computed } from 'vue';

import DeleteUser from '@/components/DeleteUser.vue';
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/shadcn/ui/button';
import { Input } from '@/components/shadcn/ui/input';
import { Label } from '@/components/shadcn/ui/label';
import { Badge } from '@/components/shadcn/ui/badge';
import AppLayout from '@/layouts/AppLayout.vue';
import SettingsLayout from '@/layouts/settings/Layout.vue';
import { type BreadcrumbItem, type User } from '@/types';

interface Props {
    mustVerifyEmail: boolean;
    status?: string;
}

defineProps<Props>();

const breadcrumbItems: BreadcrumbItem[] = [
    {
        title: 'Profile settings',
        href: '/settings/profile',
    },
];

const page = usePage();
const user = page.props.auth.user as User;

// Using Tailwind dark mode classes instead of conditional rendering
const showDeleteAccount = ref(false);

const form = useForm({
    name: user.name,
    email: user.email,
});

const submit = () => {
    form.patch(route('profile.update'), {
        preserveScroll: true,
    });
};

// Get user initials for avatar placeholder
const userInitials = computed(() => {
    const names = user.name.split(' ');
    return names.map(name => name.charAt(0).toUpperCase()).join('').slice(0, 2);
});

// Email verification status
const emailStatus = computed(() => {
    if (user.email_verified_at) {
        return { text: 'Verified', variant: 'default', color: 'green' };
    }
    return { text: 'Unverified', variant: 'secondary', color: 'amber' };
});
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbItems">
        <Head title="Profile settings" />

        <SettingsLayout>
            <!-- Profile Header Section -->
            <div class="mb-8">
                <div class="bg-white dark:bg-gray-900/50 backdrop-blur-xl rounded-3xl border border-gray-200 dark:border-gray-800 overflow-hidden shadow-sm dark:shadow-none transition-colors duration-300">
                    <div class="px-6 py-8 sm:px-8">
                        <div class="flex flex-col sm:flex-row sm:items-center space-y-4 sm:space-y-0 sm:space-x-6">
                            <!-- Avatar -->
                            <div class="relative">
                                <div class="w-20 h-20 bg-gradient-to-br from-blue-500 to-purple-600 rounded-2xl flex items-center justify-center text-white text-2xl font-bold shadow-lg">
                                    {{ userInitials }}
                                </div>
                                <div class="absolute -bottom-2 -right-2 w-6 h-6 bg-green-500 rounded-full border-2 border-white dark:border-gray-900 shadow-sm"></div>
                            </div>
                            
                            <!-- User Info -->
                            <div class="flex-1 min-w-0">
                                <h1 class="text-2xl font-bold text-gray-900 dark:text-white truncate">{{ user.name }}</h1>
                                <div class="flex flex-col sm:flex-row sm:items-center mt-2 space-y-2 sm:space-y-0 sm:space-x-4">
                                    <p class="text-gray-600 dark:text-gray-300">{{ user.email }}</p>
                                    <Badge :variant="emailStatus.variant" 
                                           :class="[
                                               'w-fit text-xs px-2 py-1',
                                               emailStatus.color === 'green' ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300' :
                                               'bg-amber-100 text-amber-800 dark:bg-amber-900/30 dark:text-amber-300'
                                           ]">
                                        <span class="w-1.5 h-1.5 rounded-full mr-1.5" 
                                              :class="emailStatus.color === 'green' ? 'bg-green-500' : 'bg-amber-500'"></span>
                                        {{ emailStatus.text }}
                                    </Badge>
                                </div>
                                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                    Member since {{ new Date(user.created_at).toLocaleDateString('en-US', { month: 'long', year: 'numeric' }) }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Edit Profile Section -->
            <div class="space-y-8">
                <div>
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Personal Information</h2>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-6">Update your personal details and email preferences.</p>
                    
                    <form @submit.prevent="submit" class="bg-white dark:bg-gray-900/50 backdrop-blur-xl rounded-2xl border border-gray-200 dark:border-gray-800 overflow-hidden shadow-sm dark:shadow-none transition-colors duration-300">
                        <div class="p-6 sm:p-8 space-y-6">
                            <!-- Name Field -->
                            <div class="space-y-2">
                                <Label for="name" class="text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Full Name
                                </Label>
                                <Input 
                                    id="name" 
                                    class="w-full h-12 px-4 rounded-xl border-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-400 focus:ring-2 focus:ring-blue-500/20 dark:focus:ring-blue-400/20 transition-all duration-200"
                                    v-model="form.name" 
                                    required 
                                    autocomplete="name" 
                                    placeholder="Enter your full name" 
                                />
                                <InputError class="text-sm" :message="form.errors.name" />
                            </div>

                            <!-- Email Field -->
                            <div class="space-y-2">
                                <Label for="email" class="text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Email Address
                                </Label>
                                <Input
                                    id="email"
                                    type="email"
                                    class="w-full h-12 px-4 rounded-xl border-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-400 focus:ring-2 focus:ring-blue-500/20 dark:focus:ring-blue-400/20 transition-all duration-200"
                                    v-model="form.email"
                                    required
                                    autocomplete="username"
                                    placeholder="Enter your email address"
                                />
                                <InputError class="text-sm" :message="form.errors.email" />
                            </div>

                            <!-- Email Verification Notice -->
                            <div v-if="mustVerifyEmail && !user.email_verified_at" 
                                 class="p-4 bg-amber-50 dark:bg-amber-900/20 border border-amber-200 dark:border-amber-800 rounded-xl">
                                <div class="flex items-start space-x-3">
                                    <div class="flex-shrink-0 mt-0.5">
                                        <svg class="w-5 h-5 text-amber-600 dark:text-amber-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <h4 class="text-sm font-medium text-amber-800 dark:text-amber-200">Email Verification Required</h4>
                                        <p class="text-sm text-amber-700 dark:text-amber-300 mt-1">
                                            Your email address is unverified. 
                                            <Link
                                                :href="route('verification.send')"
                                                method="post"
                                                as="button"
                                                class="font-medium underline hover:no-underline transition-all duration-200"
                                            >
                                                Click here to resend the verification email.
                                            </Link>
                                        </p>
                                        
                                        <div v-if="status === 'verification-link-sent'" class="mt-2 text-sm font-medium text-green-700 dark:text-green-300">
                                            ✓ A new verification link has been sent to your email address.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="px-6 py-4 sm:px-8 bg-gray-50 dark:bg-gray-800/50 border-t border-gray-200 dark:border-gray-700">
                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-3 sm:space-y-0">
                                <Transition
                                    enter-active-class="transition-all duration-300 ease-out"
                                    enter-from-class="opacity-0 transform scale-95"
                                    enter-to-class="opacity-1 transform scale-100"
                                    leave-active-class="transition-all duration-200 ease-in"
                                    leave-from-class="opacity-1 transform scale-100"
                                    leave-to-class="opacity-0 transform scale-95"
                                >
                                    <div v-show="form.recentlySuccessful" class="flex items-center text-sm text-green-600 dark:text-green-400">
                                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                        </svg>
                                        Profile updated successfully
                                    </div>
                                </Transition>
                                
                                <Button 
                                    type="submit"
                                    :disabled="form.processing"
                                    class="w-full sm:w-auto px-6 py-2.5 bg-blue-600 hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600 text-white font-medium rounded-xl transition-all duration-200 disabled:opacity-50 disabled:cursor-not-allowed shadow-sm hover:shadow-md"
                                >
                                    <span v-if="form.processing" class="flex items-center">
                                        <svg class="animate-spin -ml-1 mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                        </svg>
                                        Saving...
                                    </span>
                                    <span v-else>Save Changes</span>
                                </Button>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Danger Zone -->
                <div class="pt-8 border-t border-gray-200 dark:border-gray-800">
                    <h2 class="text-lg font-semibold text-red-600 dark:text-red-400 mb-2">Danger Zone</h2>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-6">Irreversible and destructive actions.</p>
                    
                    <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-2xl overflow-hidden">
                        <div class="p-6 sm:p-8">
                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-4 sm:space-y-0">
                                <div class="flex-1">
                                    <h3 class="text-base font-semibold text-red-900 dark:text-red-100">Delete Account</h3>
                                    <p class="text-sm text-red-700 dark:text-red-300 mt-1">
                                        Permanently delete your account and all associated data. This action cannot be undone.
                                    </p>
                                </div>
                                <Button 
                                    @click="showDeleteAccount = true"
                                    variant="destructive"
                                    class="w-full sm:w-auto px-6 py-2.5 bg-red-600 hover:bg-red-700 text-white font-medium rounded-xl transition-all duration-200 shadow-sm hover:shadow-md"
                                >
                                    Delete Account
                                </Button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Delete User Modal -->
            <DeleteUser v-if="showDeleteAccount" @close="showDeleteAccount = false" />
        </SettingsLayout>
    </AppLayout>
</template>
