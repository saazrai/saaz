<script setup lang="ts">
import { Head, Link, useForm, usePage } from '@inertiajs/vue3';
import { inject } from 'vue';

import DeleteUser from '@/components/DeleteUser.vue';
import HeadingSmall from '@/components/HeadingSmall.vue';
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/shadcn/ui/button';
import { Input } from '@/components/shadcn/ui/input';
import { Label } from '@/components/shadcn/ui/label';
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

// Get dark mode state from AppLayout
const isDark = inject('isDark', false);

const form = useForm({
    name: user.name,
    email: user.email,
});

const submit = () => {
    form.patch(route('profile.update'), {
        preserveScroll: true,
    });
};
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbItems">
        <Head title="Profile settings" />

        <SettingsLayout>
            <div class="flex flex-col space-y-6">
                <HeadingSmall title="Profile information" description="Update your name and email address" />

                <form @submit.prevent="submit" :class="[
                    'space-y-6 p-6 rounded-xl border transition-colors duration-300',
                    isDark 
                        ? 'bg-gray-800 border-gray-700' 
                        : 'bg-white border-gray-200 shadow-sm'
                ]">
                    <div class="grid gap-2">
                        <Label for="name" :class="[
                            'font-medium transition-colors duration-300',
                            isDark ? 'text-gray-200' : 'text-gray-700'
                        ]">Name</Label>
                        <Input 
                            id="name" 
                            :class="[
                                'mt-1 block w-full transition-colors duration-300',
                                isDark 
                                    ? 'bg-gray-700 border-gray-600 text-gray-100 placeholder-gray-400 focus:border-blue-500 focus:ring-blue-500' 
                                    : 'bg-white border-gray-300 text-gray-900 placeholder-gray-500 focus:border-blue-500 focus:ring-blue-500'
                            ]" 
                            v-model="form.name" 
                            required 
                            autocomplete="name" 
                            placeholder="Full name" 
                        />
                        <InputError class="mt-2" :message="form.errors.name" />
                    </div>

                    <div class="grid gap-2">
                        <Label for="email" :class="[
                            'font-medium transition-colors duration-300',
                            isDark ? 'text-gray-200' : 'text-gray-700'
                        ]">Email address</Label>
                        <Input
                            id="email"
                            type="email"
                            :class="[
                                'mt-1 block w-full transition-colors duration-300',
                                isDark 
                                    ? 'bg-gray-700 border-gray-600 text-gray-100 placeholder-gray-400 focus:border-blue-500 focus:ring-blue-500' 
                                    : 'bg-white border-gray-300 text-gray-900 placeholder-gray-500 focus:border-blue-500 focus:ring-blue-500'
                            ]"
                            v-model="form.email"
                            required
                            autocomplete="username"
                            placeholder="Email address"
                        />
                        <InputError class="mt-2" :message="form.errors.email" />
                    </div>

                    <div v-if="mustVerifyEmail && !user.email_verified_at">
                        <p :class="[
                            '-mt-4 text-sm transition-colors duration-300',
                            isDark ? 'text-gray-400' : 'text-gray-600'
                        ]">
                            Your email address is unverified.
                            <Link
                                :href="route('verification.send')"
                                method="post"
                                as="button"
                                :class="[
                                    'underline underline-offset-4 transition-colors duration-300 ease-out hover:decoration-current',
                                    isDark 
                                        ? 'text-gray-100 decoration-gray-500 hover:text-white' 
                                        : 'text-gray-900 decoration-gray-300 hover:text-gray-700'
                                ]"
                            >
                                Click here to resend the verification email.
                            </Link>
                        </p>

                        <div v-if="status === 'verification-link-sent'" :class="[
                            'mt-2 text-sm font-medium transition-colors duration-300',
                            isDark ? 'text-green-400' : 'text-green-600'
                        ]">
                            A new verification link has been sent to your email address.
                        </div>
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
                            Save
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

            <DeleteUser />
        </SettingsLayout>
    </AppLayout>
</template>
