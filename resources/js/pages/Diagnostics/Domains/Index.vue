<template>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-2xl font-semibold mb-4">Diagnostic Domains</h2>
                    
                    <!-- Add Domain Form -->
                    <form @submit.prevent="submit" class="mb-8">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Name</label>
                                <input v-model="form.name" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Description</label>
                                <textarea v-model="form.description" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                            </div>
                        </div>
                        <div class="mt-4">
                            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">
                                Add Domain
                            </button>
                        </div>
                    </form>

                    <!-- Domains List -->
                    <div class="space-y-4">
                        <div v-for="domain in domains" :key="domain.id" class="border rounded-lg p-4">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="text-lg font-medium">{{ domain.name }}</h3>
                                    <p class="text-gray-600">{{ domain.description }}</p>
                                </div>
                                <Link :href="route('diagnostics.topics.index', domain.id)" class="text-indigo-600 hover:text-indigo-900">
                                    View Topics
                                </Link>
                            </div>
                            
                            <!-- Topics List -->
                            <div v-if="domain.topics?.length" class="mt-4">
                                <h4 class="text-sm font-medium text-gray-700 mb-2">Topics:</h4>
                                <ul class="list-disc list-inside space-y-1">
                                    <li v-for="topic in domain.topics" :key="topic.id" class="text-sm text-gray-600">
                                        {{ topic.name }}
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import { useForm, Link } from '@inertiajs/vue3';

const props = defineProps({
    domains: Array
});

const form = useForm({
    name: '',
    description: ''
});

const submit = () => {
    form.post(route('diagnostics.domains.store'), {
        onSuccess: () => {
            form.reset();
        }
    });
};
</script> 