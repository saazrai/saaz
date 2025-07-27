<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import SettingsLayout from '@/layouts/settings/Layout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { ref, computed } from 'vue';

import { Button } from '@/components/shadcn/ui/button';
import { Input } from '@/components/shadcn/ui/input';
import { Label } from '@/components/shadcn/ui/label';
import { Badge } from '@/components/shadcn/ui/badge';
import { type BreadcrumbItem } from '@/types';

const breadcrumbItems: BreadcrumbItem[] = [
    {
        title: 'Password settings',
        href: '/settings/password',
    },
];

const passwordInput = ref<HTMLInputElement | null>(null);
const currentPasswordInput = ref<HTMLInputElement | null>(null);

// Using Tailwind dark mode classes instead of conditional rendering
const showCurrentPassword = ref(false);
const showNewPassword = ref(false);
const showConfirmPassword = ref(false);

const form = useForm({
    current_password: '',
    password: '',
    password_confirmation: '',
});

// Password strength calculation
const passwordStrength = computed(() => {
    const password = form.password;
    if (!password) return { score: 0, text: '', color: 'gray', feedback: [], percentage: 0 };

    let score = 0;
    const feedback = [];

    // Length check
    if (password.length >= 8) score += 1;
    else feedback.push('At least 8 characters');

    // Uppercase check
    if (/[A-Z]/.test(password)) score += 1;
    else feedback.push('One uppercase letter');

    // Lowercase check
    if (/[a-z]/.test(password)) score += 1;
    else feedback.push('One lowercase letter');

    // Number check
    if (/\d/.test(password)) score += 1;
    else feedback.push('One number');

    // Special character check
    if (/[!@#$%^&*(),.?":{}|<>]/.test(password)) score += 1;
    else feedback.push('One special character');

    const strengthLevels = [
        { text: 'Very Weak', color: 'red' },
        { text: 'Weak', color: 'red' },
        { text: 'Fair', color: 'amber' },
        { text: 'Good', color: 'blue' },
        { text: 'Strong', color: 'green' },
        { text: 'Very Strong', color: 'green' },
    ];

    return {
        score,
        text: strengthLevels[score].text,
        color: strengthLevels[score].color,
        feedback: feedback.slice(0, 3), // Show only top 3 missing requirements
        percentage: (score / 5) * 100
    };
});

// Password match validation
const passwordsMatch = computed(() => {
    if (!form.password_confirmation) return null;
    return form.password === form.password_confirmation;
});

const updatePassword = () => {
    form.put(route('password.update'), {
        preserveScroll: true,
        onSuccess: () => form.reset(),
        onError: (errors: any) => {
            if (errors.password) {
                form.reset('password', 'password_confirmation');
                if (passwordInput.value instanceof HTMLInputElement) {
                    passwordInput.value.focus();
                }
            }

            if (errors.current_password) {
                form.reset('current_password');
                if (currentPasswordInput.value instanceof HTMLInputElement) {
                    currentPasswordInput.value.focus();
                }
            }
        },
    });
};

// Security tips
const securityTips = [
    { icon: '🔒', text: 'Use a unique password you don\'t use elsewhere' },
    { icon: '📱', text: 'Consider using a password manager' },
    { icon: '🔄', text: 'Update your password regularly' },
    { icon: '🚫', text: 'Never share your password with anyone' },
];
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbItems">
        <Head title="Password settings" />

        <SettingsLayout>
            <!-- Security Header -->
            <div class="mb-8">
                <div class="bg-white dark:bg-gray-900/50 backdrop-blur-xl rounded-3xl border border-gray-200 dark:border-gray-800 overflow-hidden shadow-sm dark:shadow-none transition-colors duration-300">
                    <div class="px-6 py-8 sm:px-8">
                        <div class="flex items-center space-x-4">
                            <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-blue-600 rounded-2xl flex items-center justify-center shadow-lg">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                </svg>
                            </div>
                            <div>
                                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Password Security</h1>
                                <p class="text-gray-600 dark:text-gray-300 mt-1">Keep your account secure with a strong password</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="space-y-8">
                <!-- Update Password Form -->
                <div>
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Update Password</h2>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-6">Ensure your account is using a long, random password to stay secure.</p>

                    <form @submit.prevent="updatePassword" class="bg-white dark:bg-gray-900/50 backdrop-blur-xl rounded-2xl border border-gray-200 dark:border-gray-800 overflow-hidden shadow-sm dark:shadow-none transition-colors duration-300">
                        <div class="p-6 sm:p-8 space-y-6">
                            <!-- Current Password -->
                            <div class="space-y-2">
                                <Label for="current_password" class="text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Current Password
                                </Label>
                                <div class="relative">
                                    <Input
                                        id="current_password"
                                        ref="currentPasswordInput"
                                        v-model="form.current_password"
                                        :type="showCurrentPassword ? 'text' : 'password'"
                                        class="w-full h-12 px-4 pr-12 rounded-xl border-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-400 focus:ring-2 focus:ring-blue-500/20 dark:focus:ring-blue-400/20 transition-all duration-200"
                                        autocomplete="current-password"
                                        placeholder="Enter your current password"
                                    />
                                    <button
                                        type="button"
                                        @click="showCurrentPassword = !showCurrentPassword"
                                        class="absolute inset-y-0 right-0 flex items-center pr-4 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transition-colors"
                                    >
                                        <svg v-if="showCurrentPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"></path>
                                        </svg>
                                        <svg v-else class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                    </button>
                                </div>
                                <InputError class="text-sm" :message="form.errors.current_password" />
                            </div>

                            <!-- New Password -->
                            <div class="space-y-2">
                                <Label for="password" class="text-sm font-medium text-gray-700 dark:text-gray-300">
                                    New Password
                                </Label>
                                <div class="relative">
                                    <Input
                                        id="password"
                                        ref="passwordInput"
                                        v-model="form.password"
                                        :type="showNewPassword ? 'text' : 'password'"
                                        class="w-full h-12 px-4 pr-12 rounded-xl border-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-400 focus:ring-2 focus:ring-blue-500/20 dark:focus:ring-blue-400/20 transition-all duration-200"
                                        autocomplete="new-password"
                                        placeholder="Enter your new password"
                                    />
                                    <button
                                        type="button"
                                        @click="showNewPassword = !showNewPassword"
                                        class="absolute inset-y-0 right-0 flex items-center pr-4 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transition-colors"
                                    >
                                        <svg v-if="showNewPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"></path>
                                        </svg>
                                        <svg v-else class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                    </button>
                                </div>

                                <!-- Password Strength Indicator -->
                                <div v-if="form.password" class="mt-3">
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Password Strength</span>
                                        <Badge :class="[
                                            'text-xs px-2 py-1',
                                            passwordStrength.color === 'red' ? 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300' :
                                            passwordStrength.color === 'amber' ? 'bg-amber-100 text-amber-800 dark:bg-amber-900/30 dark:text-amber-300' :
                                            passwordStrength.color === 'blue' ? 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300' :
                                            passwordStrength.color === 'green' ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300' :
                                            'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300'
                                        ]">
                                            {{ passwordStrength.text }}
                                        </Badge>
                                    </div>
                                    
                                    <!-- Strength Bar -->
                                    <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2 mb-3">
                                        <div 
                                            class="h-2 rounded-full transition-all duration-300"
                                            :class="[
                                                passwordStrength.color === 'red' ? 'bg-red-500' :
                                                passwordStrength.color === 'amber' ? 'bg-amber-500' :
                                                passwordStrength.color === 'blue' ? 'bg-blue-500' :
                                                passwordStrength.color === 'green' ? 'bg-green-500' :
                                                'bg-gray-400'
                                            ]"
                                            :style="{ width: passwordStrength.percentage + '%' }"
                                        ></div>
                                    </div>

                                    <!-- Missing Requirements -->
                                    <div v-if="passwordStrength.feedback.length > 0" class="text-sm text-gray-600 dark:text-gray-400">
                                        <span class="font-medium">Missing: </span>
                                        {{ passwordStrength.feedback.join(', ') }}
                                    </div>
                                </div>

                                <InputError class="text-sm" :message="form.errors.password" />
                            </div>

                            <!-- Confirm Password -->
                            <div class="space-y-2">
                                <Label for="password_confirmation" class="text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Confirm New Password
                                </Label>
                                <div class="relative">
                                    <Input
                                        id="password_confirmation"
                                        v-model="form.password_confirmation"
                                        :type="showConfirmPassword ? 'text' : 'password'"
                                        class="w-full h-12 px-4 pr-12 rounded-xl border-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-400 focus:ring-2 focus:ring-blue-500/20 dark:focus:ring-blue-400/20 transition-all duration-200"
                                        autocomplete="new-password"
                                        placeholder="Confirm your new password"
                                    />
                                    <button
                                        type="button"
                                        @click="showConfirmPassword = !showConfirmPassword"
                                        class="absolute inset-y-0 right-0 flex items-center pr-4 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transition-colors"
                                    >
                                        <svg v-if="showConfirmPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"></path>
                                        </svg>
                                        <svg v-else class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                    </button>
                                </div>

                                <!-- Password Match Indicator -->
                                <div v-if="form.password_confirmation" class="flex items-center mt-2">
                                    <div v-if="passwordsMatch" class="flex items-center text-sm text-green-600 dark:text-green-400">
                                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                        </svg>
                                        Passwords match
                                    </div>
                                    <div v-else class="flex items-center text-sm text-red-600 dark:text-red-400">
                                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                        </svg>
                                        Passwords don't match
                                    </div>
                                </div>

                                <InputError class="text-sm" :message="form.errors.password_confirmation" />
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
                                        Password updated successfully
                                    </div>
                                </Transition>
                                
                                <Button 
                                    type="submit"
                                    :disabled="form.processing || passwordStrength.score < 3 || !passwordsMatch"
                                    class="w-full sm:w-auto px-6 py-2.5 bg-blue-600 hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600 text-white font-medium rounded-xl transition-all duration-200 disabled:opacity-50 disabled:cursor-not-allowed shadow-sm hover:shadow-md"
                                >
                                    <span v-if="form.processing" class="flex items-center">
                                        <svg class="animate-spin -ml-1 mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                        </svg>
                                        Updating Password...
                                    </span>
                                    <span v-else>Update Password</span>
                                </Button>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Security Tips -->
                <div>
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Security Best Practices</h2>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-6">Follow these guidelines to keep your account secure.</p>
                    
                    <div class="bg-white dark:bg-gray-900/50 backdrop-blur-xl rounded-2xl border border-gray-200 dark:border-gray-800 overflow-hidden shadow-sm dark:shadow-none transition-colors duration-300">
                        <div class="p-6 sm:p-8">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div v-for="tip in securityTips" :key="tip.text" 
                                     class="flex items-start space-x-3 p-4 rounded-xl bg-gray-50 dark:bg-gray-800/50 border border-gray-200 dark:border-gray-700">
                                    <span class="text-2xl">{{ tip.icon }}</span>
                                    <p class="text-sm text-gray-700 dark:text-gray-300 leading-relaxed">{{ tip.text }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </SettingsLayout>
    </AppLayout>
</template>
