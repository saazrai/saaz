<template>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-semibold">Topics for {{ domain.name }}</h2>
                        <Link :href="route('diagnostics.domains.index')" class="text-indigo-600 hover:text-indigo-900">
                            Back to Domains
                        </Link>
                    </div>
                    
                    <!-- Add Topic Form -->
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
                                Add Topic
                            </button>
                        </div>
                    </form>

                    <!-- Topics List -->
                    <div class="space-y-4">
                        <div v-for="topic in topics" :key="topic.id" class="border rounded-lg p-4">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="text-lg font-medium">{{ topic.name }}</h3>
                                    <p class="text-gray-600">{{ topic.description }}</p>
                                </div>
                                <Link :href="route('diagnostics.items.index', topic.id)" class="text-indigo-600 hover:text-indigo-900">
                                    View Items
                                </Link>
                            </div>
                            
                            <!-- Items List -->
                            <div v-if="topic.items?.length" class="mt-4">
                                <h4 class="text-sm font-medium text-gray-700 mb-2">Items:</h4>
                                <ul class="list-disc list-inside space-y-1">
                                    <li v-for="item in topic.items" :key="item.id" class="text-sm text-gray-600">
                                        {{ item.content }}
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
    domain: Object,
    topics: Array
});

const form = useForm({
    name: '',
    description: ''
});

const submit = () => {
    form.post(route('diagnostics.topics.store', props.domain.id), {
        onSuccess: () => {
            form.reset();
        }
    });
};
</script> 