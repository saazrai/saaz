<script setup lang="ts">
import Layout from '@/layouts/AppLayout.vue';
import InputError from '@/components/InputError.vue';
import InputLabel from '@/components/InputLabel.vue';
import TextInput from '@/components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const step = ref(1); // 1: Email + Consent, 2: Email verification, 3: Name + Password
const formStartTime = ref(Math.floor(Date.now() / 1000)); // Track when form was loaded

// Step 1: Email and consent
const emailForm = useForm({
    email: '',
    consent: false,
    _form_start_time: formStartTime.value,
});

// Step 2: Verification code
const verificationForm = useForm({
    verification_code: '',
    _form_start_time: formStartTime.value,
});

// Step 3: Complete registration
const registrationForm = useForm({
    name: '',
    password: '',
    password_confirmation: '',
    _form_start_time: formStartTime.value,
});

const submitEmail = () => {
    if (!emailForm.consent) {
        emailForm.setError('consent', 'You must agree to the Privacy Policy and Terms of Service.');
        return;
    }
    
    emailForm.post(route('email.send.verification'), {
        onSuccess: () => {
            // Move to verification step
            step.value = 2;
        },
    });
};

const verifyEmail = () => {
    // Include email from step 1
    verificationForm.transform(data => ({
        ...data,
        email: emailForm.email
    })).post(route('email.verify.code'), {
        onSuccess: () => {
            // Move to final registration step
            step.value = 3;
        },
    });
};

const completeRegistration = () => {
    // Include email from step 1
    registrationForm.transform(data => ({
        ...data,
        email: emailForm.email,
        consent: emailForm.consent
    })).post(route('register'), {
        onSuccess: () => {
            // Registration complete - redirect handled by backend
        },
        onFinish: () => registrationForm.reset('password', 'password_confirmation'),
    });
};

const resendCode = () => {
    // For step 2, we need to send email in the request since we're not authenticated
    emailForm.transform(data => ({
        email: data.email
    })).post(route('email.verification.resend'), {
        preserveScroll: true,
    });
};

const registerWithGoogle = () => {
    window.location.href = route('auth.social.redirect', { provider: 'google' });
};

const goBackToStep = (targetStep) => {
    step.value = targetStep;
};
</script>

<template>
    <Head title="Register" />

    <div class="min-h-screen flex items-center justify-center px-4">
        <div class="w-full max-w-md bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-8">
            <!-- Step Indicator -->
            <div class="flex justify-center mb-6">
                <div class="flex items-center space-x-4">
                    <div :class="['w-8 h-8 rounded-full flex items-center justify-center text-sm font-medium', 
                                 step >= 1 ? 'bg-blue-600 text-white' : 'bg-gray-200 dark:bg-gray-600 text-gray-600 dark:text-gray-300']">
                        1
                    </div>
                    <div :class="['w-8 h-1', step >= 2 ? 'bg-blue-600' : 'bg-gray-200 dark:bg-gray-600']"></div>
                    <div :class="['w-8 h-8 rounded-full flex items-center justify-center text-sm font-medium', 
                                 step >= 2 ? 'bg-blue-600 text-white' : 'bg-gray-200 dark:bg-gray-600 text-gray-600 dark:text-gray-300']">
                        2
                    </div>
                    <div :class="['w-8 h-1', step >= 3 ? 'bg-blue-600' : 'bg-gray-200 dark:bg-gray-600']"></div>
                    <div :class="['w-8 h-8 rounded-full flex items-center justify-center text-sm font-medium', 
                                 step >= 3 ? 'bg-blue-600 text-white' : 'bg-gray-200 dark:bg-gray-600 text-gray-600 dark:text-gray-300']">
                        3
                    </div>
                </div>
            </div>

            <!-- Step 1: Email + Consent -->
            <div v-if="step === 1">
                <h2 class="text-2xl font-bold text-center text-blue-900 dark:text-blue-100">Create an Account</h2>
                <p class="text-center text-gray-500 dark:text-gray-400 mb-6 text-sm">
                    Enter your email to get started
                </p>

                <!-- Google Registration Button -->
                <div class="mb-6">
                    <button
                        type="button"
                        @click="registerWithGoogle"
                        class="w-full inline-flex items-center justify-center gap-3 px-6 py-3 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-200 rounded-lg text-sm font-medium border border-gray-300 dark:border-gray-600 shadow-sm transition-colors duration-200"
                    >
                        <svg width="20" height="20" viewBox="0 0 24 24">
                            <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                            <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                            <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                            <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                        </svg>
                        Continue with Google
                    </button>
                </div>

                <!-- Divider -->
                <div class="relative mb-6">
                    <div class="absolute inset-0 flex items-center">
                        <span class="w-full border-t border-gray-300 dark:border-gray-600" />
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-2 bg-white dark:bg-gray-800 text-gray-500 dark:text-gray-400">Or continue with email</span>
                    </div>
                </div>

                <form @submit.prevent="submitEmail">
                    <div class="mb-4">
                        <InputLabel for="email" value="Email" />
                        <TextInput 
                            id="email" 
                            type="email" 
                            class="mt-1 block w-full" 
                            v-model="emailForm.email" 
                            required
                            autofocus
                            autocomplete="username" 
                            placeholder="you@example.com" 
                        />
                        <InputError class="mt-2" :message="emailForm.errors.email" />
                    </div>

                    <div class="mb-6">
                        <label class="flex items-center">
                            <input type="checkbox" v-model="emailForm.consent" required />
                            <span class="ml-2 text-sm text-gray-600 dark:text-gray-300">
                                I agree to the
                                <a href="/privacy-policy" target="_blank" class="text-blue-600 dark:text-blue-400 underline">Privacy Policy</a>
                                and
                                <a href="/terms" target="_blank" class="text-blue-600 dark:text-blue-400 underline">Terms of Service</a>
                            </span>
                        </label>
                        <InputError class="mt-2" :message="emailForm.errors.consent" />
                    </div>

                    <button
                        type="submit"
                        class="w-full inline-flex items-center justify-center px-6 py-3 bg-blue-600 dark:bg-blue-500 hover:bg-blue-700 dark:hover:bg-blue-600 text-white rounded-lg text-sm font-medium shadow-sm transition-colors duration-200 disabled:opacity-50 disabled:cursor-not-allowed"
                        :class="{ 'opacity-50': emailForm.processing }"
                        :disabled="emailForm.processing"
                    >
                        <svg v-if="emailForm.processing" class="animate-spin -ml-1 mr-3 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        {{ emailForm.processing ? 'Processing...' : 'Continue' }}
                    </button>
                </form>
            </div>

            <!-- Step 2: Email Verification -->
            <div v-else-if="step === 2">
                <h2 class="text-2xl font-bold text-center text-blue-900 dark:text-blue-100">Verify Your Email</h2>
                <p class="text-center text-gray-500 dark:text-gray-400 mb-6 text-sm">
                    We've sent a 4-digit verification code to <strong>{{ emailForm.email }}</strong>
                </p>

                <form @submit.prevent="verifyEmail">
                    <div class="mb-6">
                        <InputLabel for="verification_code" value="Verification Code" />
                        <TextInput 
                            id="verification_code" 
                            type="text" 
                            class="mt-1 block w-full text-center text-2xl tracking-widest" 
                            v-model="verificationForm.verification_code" 
                            required 
                            autofocus
                            maxlength="4"
                            placeholder="0000"
                        />
                        <InputError class="mt-2" :message="verificationForm.errors.verification_code" />
                    </div>

                    <button
                        type="submit"
                        class="w-full inline-flex items-center justify-center px-6 py-3 bg-blue-600 dark:bg-blue-500 hover:bg-blue-700 dark:hover:bg-blue-600 text-white rounded-lg text-sm font-medium shadow-sm transition-colors duration-200 disabled:opacity-50 disabled:cursor-not-allowed mb-4"
                        :class="{ 'opacity-50': verificationForm.processing }"
                        :disabled="verificationForm.processing"
                    >
                        <svg v-if="verificationForm.processing" class="animate-spin -ml-1 mr-3 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        {{ verificationForm.processing ? 'Verifying...' : 'Verify Email' }}
                    </button>

                    <button
                        type="button"
                        @click="resendCode"
                        class="w-full text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 text-sm underline mb-4"
                    >
                        Didn't receive the code? Resend
                    </button>

                    <button
                        type="button"
                        @click="goBackToStep(1)"
                        class="w-full text-gray-600 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-300 text-sm underline"
                    >
                        ← Change email address
                    </button>
                </form>
            </div>

            <!-- Step 3: Complete Registration -->
            <div v-else>
                <h2 class="text-2xl font-bold text-center text-blue-900 dark:text-blue-100">Complete Your Account</h2>
                <p class="text-center text-gray-500 dark:text-gray-400 mb-6 text-sm">
                    Almost done! Create your password to finish setup
                </p>

                <form @submit.prevent="completeRegistration">
                    <div class="mb-4">
                        <InputLabel for="name" value="Full Name" />
                        <TextInput 
                            id="name" 
                            type="text" 
                            class="mt-1 block w-full" 
                            v-model="registrationForm.name" 
                            required 
                            autofocus
                            autocomplete="name" 
                            placeholder="Your full name" 
                        />
                        <InputError class="mt-2" :message="registrationForm.errors.name" />
                    </div>

                    <div class="mb-4">
                        <InputLabel for="password" value="Password" />
                        <TextInput 
                            id="password" 
                            type="password" 
                            class="mt-1 block w-full" 
                            v-model="registrationForm.password" 
                            required
                            autocomplete="new-password" 
                        />
                        <InputError class="mt-2" :message="registrationForm.errors.password" />
                        
                        <!-- Password Requirements -->
                        <div class="mt-3 p-3 bg-gray-50 dark:bg-gray-700 rounded-lg text-sm">
                            <p class="font-semibold text-gray-700 dark:text-gray-200 mb-2">Password Requirements:</p>
                            <ul class="space-y-1 text-gray-600 dark:text-gray-300">
                                <li class="flex items-start">
                                    <span class="text-gray-400 dark:text-gray-500 mr-2">•</span>
                                    <span>At least 12 characters long</span>
                                </li>
                                <li class="flex items-start">
                                    <span class="text-gray-400 dark:text-gray-500 mr-2">•</span>
                                    <span>Must include at least 3 of the following:</span>
                                </li>
                                <li class="ml-4 flex items-start">
                                    <span class="text-gray-400 dark:text-gray-500 mr-2">◦</span>
                                    <span>Uppercase letter (A-Z)</span>
                                </li>
                                <li class="ml-4 flex items-start">
                                    <span class="text-gray-400 dark:text-gray-500 mr-2">◦</span>
                                    <span>Lowercase letter (a-z)</span>
                                </li>
                                <li class="ml-4 flex items-start">
                                    <span class="text-gray-400 dark:text-gray-500 mr-2">◦</span>
                                    <span>Number (0-9)</span>
                                </li>
                                <li class="ml-4 flex items-start">
                                    <span class="text-gray-400 dark:text-gray-500 mr-2">◦</span>
                                    <span>Special character (@#$%^&*-_! etc.)</span>
                                </li>
                                <li class="flex items-start">
                                    <span class="text-gray-400 dark:text-gray-500 mr-2">•</span>
                                    <span>Cannot contain your name or email</span>
                                </li>
                                <li class="flex items-start">
                                    <span class="text-gray-400 dark:text-gray-500 mr-2">•</span>
                                    <span>Cannot be a common password</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="mb-6">
                        <InputLabel for="password_confirmation" value="Confirm Password" />
                        <TextInput 
                            id="password_confirmation" 
                            type="password" 
                            class="mt-1 block w-full"
                            v-model="registrationForm.password_confirmation" 
                            required 
                            autocomplete="new-password" 
                        />
                        <InputError class="mt-2" :message="registrationForm.errors.password_confirmation" />
                    </div>

                    <button
                        type="submit"
                        class="w-full inline-flex items-center justify-center px-6 py-3 bg-blue-600 dark:bg-blue-500 hover:bg-blue-700 dark:hover:bg-blue-600 text-white rounded-lg text-sm font-medium shadow-sm transition-colors duration-200 disabled:opacity-50 disabled:cursor-not-allowed mb-4"
                        :class="{ 'opacity-50': registrationForm.processing }"
                        :disabled="registrationForm.processing"
                    >
                        <svg v-if="registrationForm.processing" class="animate-spin -ml-1 mr-3 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        {{ registrationForm.processing ? 'Creating account...' : 'Create Account' }}
                    </button>

                    <button
                        type="button"
                        @click="goBackToStep(2)"
                        class="w-full text-gray-600 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-300 text-sm underline"
                    >
                        ← Back to verification
                    </button>
                </form>
            </div>

            <div class="mt-6 text-center text-sm">
                <span class="text-gray-600 dark:text-gray-400">Already have an account?</span>
                <Link :href="route('login')" class="ml-1 text-blue-600 dark:text-blue-400 hover:underline">
                    Log in
                </Link>
            </div>
        </div>
    </div>
</template>

<script lang="ts">
export default {
    layout: Layout
}
</script>
