<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { LoaderCircle, ArrowLeft } from 'lucide-vue-next';

defineProps<{
    status?: string;
}>();

// Set layout to null to avoid AppLayout
defineOptions({
    layout: null
});

const form = useForm({
    email: '',
});

const submit = () => {
    form.post(route('password.email'));
};
</script>

<template>
    <div class="min-h-screen flex items-center justify-center bg-gray-900 px-4">
        <Head title="Forgot password" />
        
        <div class="w-full max-w-md">
            <!-- Back to Sign In link -->
            <Link :href="route('login')" 
                class="inline-flex items-center text-gray-300 hover:text-white transition-colors group mb-8">
                <ArrowLeft class="w-5 h-5 mr-2 group-hover:-translate-x-1 transition-transform" />
                <span class="text-base">Back to Sign In</span>
            </Link>
            
            <!-- Icon -->
            <div class="flex justify-center mb-8">
                <div class="w-16 h-16 bg-gray-800 rounded-2xl flex items-center justify-center">
                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                    </svg>
                </div>
            </div>
            
            <!-- Title -->
            <h1 class="text-2xl font-semibold text-white text-center mb-2">Forgot password</h1>
            <p class="text-gray-400 text-center mb-8">Enter your email to receive a password reset link</p>
            
            <!-- Status message -->
            <div v-if="status" class="mb-6 p-4 bg-green-900/20 border border-green-800 rounded-lg text-center text-sm text-green-400">
                {{ status }}
            </div>
            
            <!-- Form -->
            <form @submit.prevent="submit" class="space-y-6">
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-300 mb-2">
                        Email address
                    </label>
                    <input
                        id="email"
                        type="email"
                        v-model="form.email"
                        class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-colors"
                        placeholder="email@example.com"
                        required
                        autofocus
                    />
                    <InputError :message="form.errors.email" class="mt-2" />
                </div>
                
                <button
                    type="submit"
                    :disabled="form.processing"
                    class="w-full py-3 px-4 bg-blue-600 hover:bg-blue-700 disabled:bg-blue-600/50 text-white font-medium rounded-lg transition-colors duration-200 flex items-center justify-center"
                >
                    <LoaderCircle v-if="form.processing" class="w-5 h-5 animate-spin mr-2" />
                    Email password reset link
                </button>
            </form>
            
            <!-- Secondary back to login link (optional, but good for redundancy) -->
            <div class="mt-6">
                <Link :href="route('login')" 
                    class="block w-full py-2.5 text-center text-gray-400 hover:text-white transition-colors">
                    Return to Sign In
                </Link>
            </div>
        </div>
    </div>
</template>
