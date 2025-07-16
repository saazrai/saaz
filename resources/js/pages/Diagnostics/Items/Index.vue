<template>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-semibold">Items for {{ topic.name }}</h2>
                        <Link :href="route('diagnostics.topics.index', topic.domain_id)" class="text-indigo-600 hover:text-indigo-900">
                            Back to Topics
                        </Link>
                    </div>
                    
                    <!-- Add Item Form -->
                    <form @submit.prevent="submit" class="mb-8">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Question</label>
                                <textarea v-model="form.question" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Dimension</label>
                                <select v-model="form.dimension" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="Technical">Technical</option>
                                    <option value="Managerial">Managerial</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Options</label>
                                <div v-for="(option, index) in form.options" :key="index" class="flex gap-2 mt-2">
                                    <input v-model="form.options[index]" type="text" class="flex-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <button type="button" @click="removeOption(index)" class="text-red-600 hover:text-red-900">Remove</button>
                                </div>
                                <button type="button" @click="addOption" class="mt-2 text-indigo-600 hover:text-indigo-900">
                                    Add Option
                                </button>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Correct Answer</label>
                                <div v-for="(answer, index) in form.correct_answer" :key="index" class="flex gap-2 mt-2">
                                    <input v-model="form.correct_answer[index]" type="text" class="flex-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <button type="button" @click="removeAnswer(index)" class="text-red-600 hover:text-red-900">Remove</button>
                                </div>
                                <button type="button" @click="addAnswer" class="mt-2 text-indigo-600 hover:text-indigo-900">
                                    Add Answer
                                </button>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Status</label>
                                <select v-model="form.status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="draft">Draft</option>
                                    <option value="published">Published</option>
                                    <option value="retired">Retired</option>
                                </select>
                            </div>
                        </div>
                        <div class="mt-4">
                            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">
                                Add Item
                            </button>
                        </div>
                    </form>

                    <!-- Items List -->
                    <div class="space-y-4">
                        <div v-for="item in items" :key="item.id" class="border rounded-lg p-4">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="text-lg font-medium">{{ item.content }}</h3>
                                    <p class="text-gray-600">Dimension: {{ item.dimension }}</p>
                                    <p class="text-gray-600">Status: {{ item.status }}</p>
                                </div>
                            </div>
                            
                            <!-- Options List -->
                            <div v-if="item.options?.length" class="mt-4">
                                <h4 class="text-sm font-medium text-gray-700 mb-2">Options:</h4>
                                <ul class="list-disc list-inside space-y-1">
                                    <li v-for="(option, index) in item.options" :key="index" class="text-sm text-gray-600">
                                        {{ option }}
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
    topic: Object,
    items: Array
});

const form = useForm({
    question: '',
    dimension: 'Technical',
    options: [''],
    correct_answer: [''],
    status: 'draft'
});

const addOption = () => {
    form.options.push('');
};

const removeOption = (index) => {
    form.options.splice(index, 1);
};

const addAnswer = () => {
    form.correct_answer.push('');
};

const removeAnswer = (index) => {
    form.correct_answer.splice(index, 1);
};

const submit = () => {
    form.post(route('diagnostics.items.store', props.topic.id), {
        onSuccess: () => {
            form.reset();
            form.options = [''];
            form.correct_answer = [''];
        }
    });
};
</script> 