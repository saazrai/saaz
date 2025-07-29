<template>
    <AdminLayout>
        <div class="min-h-screen bg-gradient-to-br from-gray-50 via-white to-gray-100 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900">
            <!-- Header Section -->
            <div class="relative">
                <!-- Background Pattern -->
                <div class="absolute inset-0 bg-gradient-to-r from-indigo-500/5 via-purple-500/5 to-pink-500/5"></div>
                
                <div class="relative px-4 sm:px-6 lg:px-8 py-12">
                    <!-- Breadcrumb -->
                    <nav class="flex mb-6" aria-label="Breadcrumb">
                        <ol class="flex items-center space-x-2">
                            <li>
                                <Link 
                                    :href="route('admin.master.question-types.index')" 
                                    class="flex items-center text-sm font-medium text-gray-500 hover:text-indigo-600 dark:text-gray-400 dark:hover:text-indigo-400 transition-colors duration-200"
                                >
                                    <ArrowLeft class="h-4 w-4 mr-1" />
                                    Question Types
                                </Link>
                            </li>
                            <li>
                                <ChevronRight class="h-4 w-4 text-gray-400" />
                            </li>
                            <li>
                                <span class="text-sm font-medium text-gray-900 dark:text-white">{{ questionType.name }}</span>
                            </li>
                        </ol>
                    </nav>

                    <!-- Hero Section -->
                    <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-6">
                        <div class="flex-1">
                            <div class="flex items-center gap-4 mb-4">
                                <div class="flex-shrink-0">
                                    <div class="w-16 h-16 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-2xl flex items-center justify-center shadow-lg">
                                        <span class="text-white font-bold text-lg">{{ questionType.code }}</span>
                                    </div>
                                </div>
                                <div>
                                    <h1 class="text-3xl sm:text-4xl font-bold bg-gradient-to-r from-gray-900 to-gray-600 dark:from-white dark:to-gray-300 bg-clip-text text-transparent">
                                        {{ questionType.name }}
                                    </h1>
                                    <div class="flex items-center gap-3 mt-2">
                                        <span class="text-sm text-gray-500 dark:text-gray-400">ID: {{ questionType.id }}</span>
                                        <div class="w-1 h-1 bg-gray-300 dark:bg-gray-600 rounded-full"></div>
                                        <span
                                            :class="[
                                                questionType.status === 'active'
                                                    ? 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400'
                                                    : 'bg-gray-100 text-gray-700 dark:bg-gray-800 dark:text-gray-400',
                                                'inline-flex items-center px-3 py-1 rounded-full text-xs font-medium capitalize shadow-sm'
                                            ]"
                                        >
                                            <div :class="[
                                                questionType.status === 'active' ? 'bg-emerald-500' : 'bg-gray-400',
                                                'w-1.5 h-1.5 rounded-full mr-2'
                                            ]"></div>
                                            {{ questionType.status }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Action Button -->
                        <div class="flex-shrink-0">
                            <button
                                @click="showEditModal = true"
                                class="inline-flex items-center gap-2 px-6 py-3 bg-white dark:bg-gray-800 text-gray-900 dark:text-white border border-gray-200 dark:border-gray-700 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-700 transition-all duration-200 shadow-lg hover:shadow-xl font-medium"
                            >
                                <Pencil class="h-4 w-4" />
                                Edit Question Type
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content Section -->
            <div class="px-4 sm:px-6 lg:px-8 pb-12">
                <div class="max-w-4xl mx-auto">
                    <!-- Main Content Card -->
                    <div class="bg-white/70 dark:bg-gray-800/70 backdrop-blur-xl rounded-3xl shadow-xl border border-white/20 dark:border-gray-700/20 overflow-hidden">
                        <!-- Description Section -->
                        <div class="p-8">
                            <div class="mb-8">
                                <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4 flex items-center gap-2">
                                    <div class="w-2 h-2 bg-indigo-500 rounded-full"></div>
                                    Description
                                </h2>
                                <p class="text-gray-700 dark:text-gray-300 text-lg leading-relaxed bg-gray-50/50 dark:bg-gray-900/20 rounded-2xl p-6 border border-gray-100 dark:border-gray-700/30">
                                    {{ questionType.description }}
                                </p>
                            </div>

                            <!-- Metadata -->
                            <div class="pt-6 border-t border-gray-100 dark:border-gray-700/30">
                                <div class="flex items-center gap-6 text-xs text-gray-500 dark:text-gray-400">
                                    <span>Created {{ formatDate(questionType.created_at) }}</span>
                                    <div class="w-1 h-1 bg-gray-300 dark:bg-gray-600 rounded-full"></div>
                                    <span>Updated {{ formatDate(questionType.updated_at) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Modal -->
        <QuestionTypeModal
            :show="showEditModal"
            :question-type="questionType"
            @close="showEditModal = false"
            @saved="handleSaved"
        />
    </AdminLayout>
</template>

<script setup lang="ts">
import { ref } from 'vue';
import { Link, router } from '@inertiajs/vue3';
import AdminLayout from '@/layouts/AdminLayout.vue';
import { ChevronRight, Pencil, ArrowLeft } from 'lucide-vue-next';
import QuestionTypeModal from './QuestionTypeModal.vue';

defineProps({
    questionType: Object,
});

const showEditModal = ref(false);

const formatDate = (dateString) => {
    return new Date(dateString).toLocaleDateString('en-US', {
        year: 'numeric',
        month: 'long',
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
    });
};

const handleSaved = () => {
    showEditModal.value = false;
    router.reload();
};
</script>