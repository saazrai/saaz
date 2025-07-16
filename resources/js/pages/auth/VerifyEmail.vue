<script setup lang="ts">
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import AuthLayout from '@/layouts/AuthLayout.vue';
import { Head, useForm, usePage } from '@inertiajs/vue3';
import { LoaderCircle } from 'lucide-vue-next';
import { ref } from 'vue';
import InputError from '@/components/InputError.vue';
import InputLabel from '@/components/InputLabel.vue';
import TextInput from '@/components/TextInput.vue';

defineProps<{
    status?: string;
}>();

const page = usePage();
const user = page.props.auth?.user;

const form = useForm({});
const showEmailChange = ref(false);

const emailChangeForm = useForm({
    email: '',
    password: ''
});

const submit = () => {
    form.post(route('verification.send'));
};

const changeEmail = () => {
    emailChangeForm.post(route('verification.email.change'), {
        onSuccess: () => {
            showEmailChange.value = false;
            emailChangeForm.reset();
        },
    });
};
</script>

<template>
    <AuthLayout title="Verify email" description="Please verify your email address by clicking on the link we just emailed to you.">
        <Head title="Email verification" />

        <div class="mb-4 text-sm text-gray-600 dark:text-gray-400 text-center">
            <p>We've sent a verification email to:</p>
            <p class="font-semibold text-gray-900 dark:text-gray-100 mt-1">{{ user?.email }}</p>
        </div>

        <div v-if="status === 'verification-link-sent'" class="mb-4 text-center text-sm font-medium text-green-600 dark:text-green-400">
            A new verification link has been sent to the email address you provided during registration.
        </div>

        <div v-if="status === 'email-changed'" class="mb-4 text-center text-sm font-medium text-green-600 dark:text-green-400">
            Your email has been updated. A new verification link has been sent to your new email address.
        </div>

        <div v-if="!showEmailChange" class="space-y-4">
            <form @submit.prevent="submit" class="text-center">
                <Button :disabled="form.processing" variant="secondary" class="w-full">
                    <LoaderCircle v-if="form.processing" class="h-4 w-4 animate-spin mr-2" />
                    Resend verification email
                </Button>
            </form>

            <div class="relative">
                <div class="absolute inset-0 flex items-center">
                    <span class="w-full border-t border-gray-300 dark:border-gray-600" />
                </div>
                <div class="relative flex justify-center text-xs uppercase">
                    <span class="bg-white dark:bg-gray-900 px-2 text-gray-500 dark:text-gray-400">
                        Or
                    </span>
                </div>
            </div>

            <div class="text-center space-y-3">
                <button 
                    @click="showEmailChange = true"
                    class="text-sm text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 underline"
                >
                    Wrong email? Change it here
                </button>

                <TextLink :href="route('logout')" method="post" as="button" class="block text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100">
                    Log out
                </TextLink>
            </div>
        </div>

        <!-- Email Change Form -->
        <div v-else class="space-y-4">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 text-center mb-4">
                Change Email Address
            </h3>

            <form @submit.prevent="changeEmail" class="space-y-4">
                <div>
                    <InputLabel for="email" value="New Email Address" />
                    <TextInput
                        id="email"
                        type="email"
                        class="mt-1 block w-full"
                        v-model="emailChangeForm.email"
                        required
                        autofocus
                        autocomplete="username"
                        placeholder="your.new.email@example.com"
                    />
                    <InputError class="mt-2" :message="emailChangeForm.errors.email" />
                </div>

                <div>
                    <InputLabel for="password" value="Current Password" />
                    <TextInput
                        id="password"
                        type="password"
                        class="mt-1 block w-full"
                        v-model="emailChangeForm.password"
                        required
                        autocomplete="current-password"
                        placeholder="Enter your password to confirm"
                    />
                    <InputError class="mt-2" :message="emailChangeForm.errors.password" />
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                        We need your password to confirm this change
                    </p>
                </div>

                <div class="flex gap-3">
                    <Button 
                        type="submit" 
                        :disabled="emailChangeForm.processing"
                        class="flex-1"
                    >
                        <LoaderCircle v-if="emailChangeForm.processing" class="h-4 w-4 animate-spin mr-2" />
                        Change Email
                    </Button>
                    <Button 
                        type="button"
                        variant="outline"
                        @click="showEmailChange = false; emailChangeForm.reset()"
                        :disabled="emailChangeForm.processing"
                        class="flex-1"
                    >
                        Cancel
                    </Button>
                </div>
            </form>
        </div>
    </AuthLayout>
</template>