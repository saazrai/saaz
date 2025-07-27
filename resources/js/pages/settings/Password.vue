<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import SettingsLayout from '@/layouts/settings/Layout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { ref, inject } from 'vue';

import HeadingSmall from '@/components/HeadingSmall.vue';
import { Button } from '@/components/shadcn/ui/button';
import { Input } from '@/components/shadcn/ui/input';
import { Label } from '@/components/shadcn/ui/label';
import { type BreadcrumbItem } from '@/types';

const breadcrumbItems: BreadcrumbItem[] = [
    {
        title: 'Password settings',
        href: '/settings/password',
    },
];

const passwordInput = ref<HTMLInputElement | null>(null);
const currentPasswordInput = ref<HTMLInputElement | null>(null);

// Get dark mode state from AppLayout
const isDark = inject('isDark', false);

// Debug: Log theme state (remove this after testing)
console.log('Password component isDark:', isDark);

const form = useForm({
    current_password: '',
    password: '',
    password_confirmation: '',
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
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbItems">
        <Head title="Password settings" />

        <SettingsLayout>
            <div class="space-y-6">
                <HeadingSmall title="Update password" description="Ensure your account is using a long, random password to stay secure" />

                <form @submit.prevent="updatePassword" :class="[
                    'space-y-6 p-6 rounded-xl border transition-colors duration-300',
                    isDark 
                        ? 'bg-gray-800 border-gray-700' 
                        : 'bg-white border-gray-200 shadow-xs'
                ]">
                    <div class="grid gap-2">
                        <Label for="current_password" :class="[
                            'font-medium transition-colors duration-300',
                            isDark ? 'text-gray-200' : 'text-gray-700'
                        ]">Current password</Label>
                        <Input
                            id="current_password"
                            ref="currentPasswordInput"
                            v-model="form.current_password"
                            type="password"
                            :class="[
                                'mt-1 block w-full transition-colors duration-300',
                                isDark 
                                    ? 'bg-gray-700 border-gray-600 text-gray-100 placeholder-gray-400 focus:border-blue-500 focus:ring-blue-500' 
                                    : 'bg-white border-gray-300 text-gray-900 placeholder-gray-500 focus:border-blue-500 focus:ring-blue-500'
                            ]"
                            autocomplete="current-password"
                            placeholder="Current password"
                        />
                        <InputError :message="form.errors.current_password" />
                    </div>

                    <div class="grid gap-2">
                        <Label for="password" :class="[
                            'font-medium transition-colors duration-300',
                            isDark ? 'text-gray-200' : 'text-gray-700'
                        ]">New password</Label>
                        <Input
                            id="password"
                            ref="passwordInput"
                            v-model="form.password"
                            type="password"
                            :class="[
                                'mt-1 block w-full transition-colors duration-300',
                                isDark 
                                    ? 'bg-gray-700 border-gray-600 text-gray-100 placeholder-gray-400 focus:border-blue-500 focus:ring-blue-500' 
                                    : 'bg-white border-gray-300 text-gray-900 placeholder-gray-500 focus:border-blue-500 focus:ring-blue-500'
                            ]"
                            autocomplete="new-password"
                            placeholder="New password"
                        />
                        <InputError :message="form.errors.password" />
                    </div>

                    <div class="grid gap-2">
                        <Label for="password_confirmation" :class="[
                            'font-medium transition-colors duration-300',
                            isDark ? 'text-gray-200' : 'text-gray-700'
                        ]">Confirm password</Label>
                        <Input
                            id="password_confirmation"
                            v-model="form.password_confirmation"
                            type="password"
                            :class="[
                                'mt-1 block w-full transition-colors duration-300',
                                isDark 
                                    ? 'bg-gray-700 border-gray-600 text-gray-100 placeholder-gray-400 focus:border-blue-500 focus:ring-blue-500' 
                                    : 'bg-white border-gray-300 text-gray-900 placeholder-gray-500 focus:border-blue-500 focus:ring-blue-500'
                            ]"
                            autocomplete="new-password"
                            placeholder="Confirm password"
                        />
                        <InputError :message="form.errors.password_confirmation" />
                    </div>

                    <div class="flex items-center gap-4">
                        <Button 
                            :disabled="form.processing"
                            :class="[
                                'px-6 py-2 rounded-lg font-medium transition-all duration-300',
                                isDark 
                                    ? 'bg-blue-600 hover:bg-blue-700 text-white disabled:bg-gray-600 disabled:text-gray-400' 
                                    : 'bg-blue-600 hover:bg-blue-700 text-white disabled:bg-gray-400 disabled:text-gray-600'
                            ]"
                        >
                            Save password
                        </Button>

                        <Transition
                            enter-active-class="transition ease-in-out"
                            enter-from-class="opacity-0"
                            leave-active-class="transition ease-in-out"
                            leave-to-class="opacity-0"
                        >
                            <p v-show="form.recentlySuccessful" :class="[
                                'text-sm transition-colors duration-300',
                                isDark ? 'text-gray-400' : 'text-gray-600'
                            ]">Saved.</p>
                        </Transition>
                    </div>
                </form>
            </div>
        </SettingsLayout>
    </AppLayout>
</template>
