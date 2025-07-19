<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link } from '@inertiajs/vue3';
import Button from '@/components/shadcn/ui/button/Button.vue';
import Avatar from '@/components/shadcn/ui/avatar/Avatar.vue';
import AvatarImage from '@/components/shadcn/ui/avatar/AvatarImage.vue';
import AvatarFallback from '@/components/shadcn/ui/avatar/AvatarFallback.vue';
import { computed } from 'vue';
import { usePage } from '@inertiajs/vue3';

interface Props {
    diagnosticResults?: Array<{
        id: number;
        score: number;
        total_questions: number;
        completed_at: string;
        duration_minutes?: number;
    }>;
    recentActivity?: Array<{
        icon: string;
        title: string;
        description: string;
        date: string;
    }>;
    enterpriseMetrics?: {
        totalDiagnostics: number;
        averageScore: number;
        lastAssessment: string;
    };
    diagnosticTaken?: boolean;
    complianceStatus?: {
        status: string;
        gdpr: boolean;
        sox: boolean;
        hipaa: boolean;
    };
}

const props = defineProps<Props>();

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
    },
];

const page = usePage();
const user = computed(() => page.props.auth.user);

// Computed properties
const hasRecentActivity = computed(() => props.recentActivity && props.recentActivity.length > 0);
const hasDiagnosticResults = computed(() => props.diagnosticResults && props.diagnosticResults.length > 0);

// Format time ago helper
const formatTimeAgo = (date: string) => {
    const now = new Date();
    const past = new Date(date);
    const diffMs = now.getTime() - past.getTime();
    const diffDays = Math.floor(diffMs / (1000 * 60 * 60 * 24));
    
    if (diffDays === 0) return 'Today';
    if (diffDays === 1) return 'Yesterday';
    if (diffDays < 7) return `${diffDays} days ago`;
    if (diffDays < 30) return `${Math.floor(diffDays / 7)} weeks ago`;
    return `${Math.floor(diffDays / 30)} months ago`;
};
</script>

<template>
    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="p-6 space-y-6">
            <!-- Welcome Header -->
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white">
                        Welcome back, {{ user?.name?.split(' ')[0] }}! 👋
                    </h1>
                    <p class="text-gray-600 dark:text-gray-400 mt-1">
                        {{ diagnosticTaken ? 'Review your diagnostic results and continue your assessment journey' : 'Ready to start your professional assessment?' }}
                    </p>
                </div>
                <Avatar class="h-12 w-12">
                    <AvatarImage :src="user?.avatar || '/images/avatar-placeholder.png'" />
                    <AvatarFallback>{{ user?.name?.[0] || 'U' }}</AvatarFallback>
                </Avatar>
            </div>

            <!-- Diagnostic Test Encouragement (if not taken) -->
            <div v-if="!diagnosticTaken" class="bg-gradient-to-r from-blue-600 to-indigo-600 rounded-2xl p-8 text-white shadow-lg">
                <div class="flex flex-col lg:flex-row items-center justify-between">
                    <div class="mb-6 lg:mb-0 lg:mr-8">
                        <h2 class="text-2xl font-bold mb-3">Start Your SecureStart™ Assessment</h2>
                        <p class="text-blue-100 mb-4">
                            Take our comprehensive SecureStart™ diagnostic assessment to evaluate your cybersecurity knowledge across 20 security domains. 
                            Get detailed insights into your strengths and areas for improvement.
                        </p>
                        <ul class="space-y-2 text-sm">
                            <li class="flex items-center">
                                <svg class="w-5 h-5 mr-2 text-blue-200" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                Comprehensive assessment across 20 domains
                            </li>
                            <li class="flex items-center">
                                <svg class="w-5 h-5 mr-2 text-blue-200" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                Professional-grade analysis and reporting
                            </li>
                            <li class="flex items-center">
                                <svg class="w-5 h-5 mr-2 text-blue-200" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                Enterprise compliance ready
                            </li>
                        </ul>
                    </div>
                    <div class="flex flex-col items-center">
                        <Link :href="route('assessments.diagnostics.index')">
                            <Button size="lg" variant="secondary" class="bg-white text-blue-600 hover:bg-blue-50">
                                Start Assessment
                                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                </svg>
                            </Button>
                        </Link>
                    </div>
                </div>
            </div>

            <!-- Enterprise Metrics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6" v-if="enterpriseMetrics">
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6 border border-gray-200 dark:border-gray-700">
                    <div class="flex items-center">
                        <div class="p-2 bg-blue-100 dark:bg-blue-900 rounded-lg">
                            <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Diagnostics Completed</p>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ enterpriseMetrics.totalDiagnostics || 0 }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6 border border-gray-200 dark:border-gray-700">
                    <div class="flex items-center">
                        <div class="p-2 bg-green-100 dark:bg-green-900 rounded-lg">
                            <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Average Score</p>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ enterpriseMetrics.averageScore || 0 }}%</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6 border border-gray-200 dark:border-gray-700">
                    <div class="flex items-center">
                        <div class="p-2 bg-purple-100 dark:bg-purple-900 rounded-lg">
                            <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Compliance Status</p>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ complianceStatus?.status || 'Active' }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6 border border-gray-200 dark:border-gray-700">
                    <div class="flex items-center">
                        <div class="p-2 bg-orange-100 dark:bg-orange-900 rounded-lg">
                            <svg class="w-6 h-6 text-orange-600 dark:text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Last Assessment</p>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ enterpriseMetrics.lastAssessment || 'N/A' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Main Content Area -->
                <div class="lg:col-span-2 space-y-8">
                    <!-- Diagnostic Results Section -->
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">
                        <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                            <div class="flex items-center justify-between">
                                <h2 class="text-xl font-bold text-gray-900 dark:text-white">Diagnostic Results</h2>
                                <Link :href="route('assessments.diagnostics.index')" class="text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 text-sm font-medium">
                                    View All
                                </Link>
                            </div>
                        </div>
                        <div class="p-6">
                            <!-- Recent Diagnostic Results -->
                            <div v-if="hasDiagnosticResults" class="space-y-4">
                                <div v-for="result in diagnosticResults" :key="result.id" 
                                     class="border border-gray-200 dark:border-gray-700 rounded-lg p-4 hover:border-gray-300 dark:hover:border-gray-600 transition-colors">
                                    <div class="flex items-center justify-between">
                                        <div class="flex-1 min-w-0">
                                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                SecureStart™ Assessment
                                            </h3>
                                            <p class="text-sm text-gray-600 dark:text-gray-400">{{ new Date(result.completed_at).toLocaleDateString() }}</p>
                                            <div class="mt-2 flex items-center space-x-4">
                                                <div class="flex items-center space-x-2">
                                                    <span class="text-sm text-gray-600 dark:text-gray-400">Overall Score:</span>
                                                    <span class="font-medium text-lg" :class="result.score >= 70 ? 'text-green-600 dark:text-green-400' : 'text-orange-600 dark:text-orange-400'">
                                                        {{ result.score }}%
                                                    </span>
                                                </div>
                                                <div class="flex items-center space-x-2">
                                                    <span class="text-sm text-gray-600 dark:text-gray-400">Questions:</span>
                                                    <span class="font-medium">{{ result.total_questions }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex flex-col space-y-2">
                                            <Link :href="route('assessments.diagnostics.results', result.id)">
                                                <Button size="sm" class="w-full">
                                                    View Report
                                                </Button>
                                            </Link>
                                            <div v-if="result.score >= 70" class="flex items-center text-green-600 dark:text-green-400 text-xs">
                                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                                </svg>
                                                Passed
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- No Diagnostics State -->
                            <div v-else class="text-center py-12">
                                <div class="w-24 h-24 mx-auto mb-4 flex items-center justify-center bg-gray-100 dark:bg-gray-700 rounded-full">
                                    <svg class="w-12 h-12 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">No assessments yet</h3>
                                <p class="text-gray-600 dark:text-gray-400 mb-6 max-w-md mx-auto">
                                    Start your cybersecurity assessment journey. Take your first SecureStart™ diagnostic to evaluate your knowledge and skills.
                                </p>
                                <Link :href="route('assessments.diagnostics.index')">
                                    <Button>Start Diagnostic</Button>
                                </Link>
                            </div>
                        </div>
                    </div>

                    <!-- Privacy & Compliance Section -->
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">
                        <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                            <h2 class="text-xl font-bold text-gray-900 dark:text-white">Privacy & Compliance</h2>
                            <p class="text-gray-600 dark:text-gray-400 text-sm mt-1">Enterprise-grade privacy and compliance management</p>
                        </div>
                        <div class="p-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-4">
                                    <div class="flex items-center mb-3">
                                        <div class="p-2 bg-green-100 dark:bg-green-900 rounded-lg mr-3">
                                            <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <h3 class="font-semibold text-gray-900 dark:text-white">GDPR Compliance</h3>
                                            <p class="text-sm text-gray-600 dark:text-gray-400">Data protection compliant</p>
                                        </div>
                                    </div>
                                    <Link :href="route('privacy.settings')">
                                        <Button size="sm" variant="outline" class="w-full">
                                            Manage Privacy
                                        </Button>
                                    </Link>
                                </div>

                                <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-4">
                                    <div class="flex items-center mb-3">
                                        <div class="p-2 bg-blue-100 dark:bg-blue-900 rounded-lg mr-3">
                                            <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <h3 class="font-semibold text-gray-900 dark:text-white">Enterprise Security</h3>
                                            <p class="text-sm text-gray-600 dark:text-gray-400">SOX & HIPAA ready</p>
                                        </div>
                                    </div>
                                    <Link :href="route('profile.edit')">
                                        <Button size="sm" variant="outline" class="w-full">
                                            Security Settings
                                        </Button>
                                    </Link>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="space-y-6">
                    <!-- Quick Actions -->
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Quick Actions</h3>
                        <div class="space-y-3">
                            <Link :href="route('assessments.diagnostics.index')" class="block">
                                <Button variant="outline" class="w-full justify-start">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Start Diagnostic
                                </Button>
                            </Link>
                            <Link :href="route('privacy.settings')" class="block">
                                <Button variant="outline" class="w-full justify-start">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                    </svg>
                                    Privacy Settings
                                </Button>
                            </Link>
                            <Link :href="route('profile.edit')" class="block">
                                <Button variant="outline" class="w-full justify-start">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    Edit Profile
                                </Button>
                            </Link>
                        </div>
                    </div>

                    <!-- Recent Activity -->
                    <div v-if="hasRecentActivity" class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Recent Activity</h3>
                        <div class="space-y-4">
                            <div v-for="activity in recentActivity?.slice(0, 5)" :key="activity.title + activity.date" 
                                 class="flex items-start space-x-3">
                                <div class="text-xl">{{ activity.icon }}</div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900 dark:text-white">{{ activity.title }}</p>
                                    <p class="text-xs text-gray-600 dark:text-gray-400">{{ activity.description }}</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-500 mt-1">{{ formatTimeAgo(activity.date) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Support Links -->
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Platform Info</h3>
                        <div class="space-y-2">
                            <Link :href="route('info.about')" class="block text-sm text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300">ℹ️ About Platform</Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>