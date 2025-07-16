<template>
    <AppLayout title="Diagnostics Dashboard">
        <div class="min-h-screen bg-gray-50 dark:bg-gray-900">
            <!-- Header Section -->
            <div class="bg-white dark:bg-gray-800 shadow-sm">
                <div class="container mx-auto px-4 py-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Diagnostics Dashboard</h1>
                            <p class="text-gray-600 dark:text-gray-400 mt-1">Track your assessment progress and performance</p>
                        </div>
                        <Link 
                            :href="route('assessments.diagnostics.index')"
                            class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow-md transition-colors"
                        >
                            <PlusIcon class="w-5 h-5 mr-2" />
                            New Assessment
                        </Link>
                    </div>
                </div>
            </div>

            <div class="container mx-auto px-4 py-8">
                <!-- Paused Test Alert -->
                <div v-if="pausedTest" class="mb-8">
                    <Alert class="bg-yellow-50 border-yellow-200 dark:bg-yellow-900/20 dark:border-yellow-800">
                        <AlertCircleIcon class="h-4 w-4 text-yellow-600 dark:text-yellow-400" />
                        <AlertTitle class="text-yellow-800 dark:text-yellow-300">You have a paused assessment</AlertTitle>
                        <AlertDescription class="text-yellow-700 dark:text-yellow-400">
                            <p class="mb-3">
                                You paused your {{ pausedTest.mode_name }} assessment with {{ pausedTest.current_question }}/{{ pausedTest.total_questions }} questions completed.
                            </p>
                            <Link 
                                :href="route('assessments.diagnostics.show', pausedTest.id)"
                                class="inline-flex items-center px-4 py-2 bg-yellow-600 hover:bg-yellow-700 text-white font-semibold rounded-lg shadow-md transition-colors"
                            >
                                <PlayIcon class="w-4 h-4 mr-2" />
                                Resume Assessment
                            </Link>
                        </AlertDescription>
                    </Alert>
                </div>

                <!-- Stats Overview -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                    <Card class="bg-white dark:bg-gray-800 shadow-lg">
                        <CardHeader class="pb-2">
                            <CardTitle class="text-base font-medium text-gray-600 dark:text-gray-400">
                                Total Assessments
                            </CardTitle>
                        </CardHeader>
                        <CardContent>
                            <div class="text-3xl font-bold text-gray-900 dark:text-white">{{ stats.totalAssessments }}</div>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                {{ stats.completedAssessments }} completed
                            </p>
                        </CardContent>
                    </Card>

                    <Card class="bg-white dark:bg-gray-800 shadow-lg">
                        <CardHeader class="pb-2">
                            <CardTitle class="text-base font-medium text-gray-600 dark:text-gray-400">
                                Best Score
                            </CardTitle>
                        </CardHeader>
                        <CardContent>
                            <div class="text-3xl font-bold text-green-600 dark:text-green-400">
                                {{ stats.bestScore }}%
                            </div>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                Average: {{ stats.averageScore }}%
                            </p>
                        </CardContent>
                    </Card>

                    <Card class="bg-white dark:bg-gray-800 shadow-lg">
                        <CardHeader class="pb-2">
                            <CardTitle class="text-base font-medium text-gray-600 dark:text-gray-400">
                                Improvement
                            </CardTitle>
                        </CardHeader>
                        <CardContent>
                            <div class="text-3xl font-bold" :class="stats.improvement >= 0 ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400'">
                                {{ stats.improvement >= 0 ? '+' : '' }}{{ stats.improvement }}%
                            </div>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                Since first attempt
                            </p>
                        </CardContent>
                    </Card>

                    <Card class="bg-white dark:bg-gray-800 shadow-lg">
                        <CardHeader class="pb-2">
                            <CardTitle class="text-base font-medium text-gray-600 dark:text-gray-400">
                                Time Invested
                            </CardTitle>
                        </CardHeader>
                        <CardContent>
                            <div class="text-3xl font-bold text-purple-600 dark:text-purple-400">
                                {{ formatTotalTime(stats.totalTimeSpent) }}
                            </div>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                Across all attempts
                            </p>
                        </CardContent>
                    </Card>
                </div>

                <!-- Charts Section -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                    <!-- Progress Chart -->
                    <Card class="bg-white dark:bg-gray-800 shadow-lg">
                        <CardHeader>
                            <CardTitle>Score Progress Over Time</CardTitle>
                            <CardDescription>Track your improvement across attempts</CardDescription>
                        </CardHeader>
                        <CardContent>
                            <div class="h-80">
                                <LineChart 
                                    v-if="progressChartData.length > 0"
                                    :data="progressChartData" 
                                    index="date" 
                                    :categories="['score']"
                                    :colors="['blue']"
                                    :y-formatter="(value) => `${value}%`"
                                />
                                <div v-else class="flex items-center justify-center h-full text-gray-500 dark:text-gray-400">
                                    <p>Complete more assessments to see progress</p>
                                </div>
                            </div>
                        </CardContent>
                    </Card>

                    <!-- Domain Performance Radar -->
                    <Card class="bg-white dark:bg-gray-800 shadow-lg">
                        <CardHeader>
                            <CardTitle>Domain Performance Overview</CardTitle>
                            <CardDescription>Your strengths and areas for improvement</CardDescription>
                        </CardHeader>
                        <CardContent>
                            <div class="h-80">
                                <BarChart 
                                    v-if="domainPerformanceData.length > 0"
                                    :data="domainPerformanceData"
                                    index="domain"
                                    :categories="['score']"
                                    :colors="['blue']"
                                />
                                <div v-else class="flex items-center justify-center h-full text-gray-500 dark:text-gray-400">
                                    <p>Complete an assessment to see domain analysis</p>
                                </div>
                            </div>
                        </CardContent>
                    </Card>
                </div>

                <!-- Assessment History Table -->
                <Card class="bg-white dark:bg-gray-800 shadow-lg">
                    <CardHeader>
                        <CardTitle>Assessment History</CardTitle>
                        <CardDescription>All your diagnostic attempts and results</CardDescription>
                    </CardHeader>
                    <CardContent>
                        <div v-if="assessmentHistory.length > 0" class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead>
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                            Date
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                            Mode
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                            Status
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                            Score
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                            Progress
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                            Duration
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                    <tr v-for="assessment in assessmentHistory" :key="assessment.id" class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-300">
                                            {{ formatDate(assessment.created_at) }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            <Badge :variant="getModeVariant(assessment.mode)">
                                                {{ assessment.mode_name }}
                                            </Badge>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            <Badge :variant="getStatusVariant(assessment.status)">
                                                {{ assessment.status }}
                                            </Badge>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <span v-if="assessment.score !== null" :class="getScoreClass(assessment.score)">
                                                {{ assessment.score }}%
                                            </span>
                                            <span v-else class="text-gray-500 dark:text-gray-400">-</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-300">
                                            {{ assessment.current_question }}/{{ assessment.total_questions }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-300">
                                            {{ formatDuration(assessment.total_duration_seconds) }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <div class="flex space-x-2">
                                                <Link 
                                                    v-if="assessment.status === 'completed'"
                                                    :href="route('assessments.diagnostics.results', assessment.id)"
                                                    class="text-blue-600 hover:text-blue-900 dark:text-blue-400"
                                                >
                                                    View Results
                                                </Link>
                                                <Link 
                                                    v-else-if="assessment.status === 'in_progress' || assessment.status === 'paused'"
                                                    :href="route('assessments.diagnostics.show', assessment.id)"
                                                    class="text-green-600 hover:text-green-900 dark:text-green-400"
                                                >
                                                    Resume
                                                </Link>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div v-else class="text-center py-12">
                            <div class="w-24 h-24 mx-auto mb-4 flex items-center justify-center bg-gray-100 dark:bg-gray-700 rounded-full">
                                <ClipboardListIcon class="w-12 h-12 text-gray-400" />
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-2">No assessments yet</h3>
                            <p class="text-gray-600 dark:text-gray-400 mb-6">
                                Start your first diagnostic assessment to track your progress
                            </p>
                            <Link :href="route('assessments.diagnostics.index')">
                                <Button>Take Your First Assessment</Button>
                            </Link>
                        </div>
                    </CardContent>
                </Card>

                <!-- Top Performing Domains -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-8" v-if="topDomains.strengths.length > 0 || topDomains.weaknesses.length > 0">
                    <Card class="bg-white dark:bg-gray-800 shadow-lg">
                        <CardHeader>
                            <CardTitle class="flex items-center">
                                <TrophyIcon class="w-5 h-5 mr-2 text-green-600" />
                                Your Strongest Domains
                            </CardTitle>
                        </CardHeader>
                        <CardContent>
                            <div class="space-y-3">
                                <div v-for="domain in topDomains.strengths" :key="domain.name" 
                                     class="flex items-center justify-between p-3 bg-green-50 dark:bg-green-900/20 rounded-lg">
                                    <span class="font-medium text-gray-900 dark:text-gray-100">{{ domain.name }}</span>
                                    <Badge variant="success">{{ domain.score }}%</Badge>
                                </div>
                            </div>
                        </CardContent>
                    </Card>

                    <Card class="bg-white dark:bg-gray-800 shadow-lg">
                        <CardHeader>
                            <CardTitle class="flex items-center">
                                <AlertCircleIcon class="w-5 h-5 mr-2 text-yellow-600" />
                                Areas for Improvement
                            </CardTitle>
                        </CardHeader>
                        <CardContent>
                            <div class="space-y-3">
                                <div v-for="domain in topDomains.weaknesses" :key="domain.name" 
                                     class="flex items-center justify-between p-3 bg-yellow-50 dark:bg-yellow-900/20 rounded-lg">
                                    <span class="font-medium text-gray-900 dark:text-gray-100">{{ domain.name }}</span>
                                    <Badge variant="warning">{{ domain.score }}%</Badge>
                                </div>
                            </div>
                        </CardContent>
                    </Card>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup lang="ts">
import { computed } from 'vue';
import AppLayout from "@/layouts/AppLayout.vue";
import { Alert, AlertDescription, AlertTitle } from '@/components/shadcn/ui/alert/index.js';
import Badge from '@/components/shadcn/ui/badge/Badge.vue';
import Button from '@/components/shadcn/ui/button/Button.vue';
import LineChart from '@/components/shadcn/ui/chart-line/LineChart.vue';
import BarChart from '@/components/shadcn/ui/chart-bar/BarChart.vue';
import { 
    PlusIcon,
    PlayIcon,
    AlertCircleIcon,
    TrophyIcon,
    ClipboardListIcon
} from 'lucide-vue-next';
import moment from 'moment';

const props = defineProps({
    assessmentHistory: Array,
    pausedTest: Object,
    stats: Object,
    progressData: Array,
    domainPerformance: Array,
    topDomains: Object,
});

// Computed properties
const progressChartData = computed(() => {
    return props.progressData?.map(item => ({
        date: moment(item.date).format('MMM DD'),
        score: item.score
    })) || [];
});

const domainPerformanceData = computed(() => {
    return props.domainPerformance || [];
});

// Helper functions
const formatDate = (date) => {
    return moment(date).format('MMM DD, YYYY HH:mm');
};

const formatDuration = (seconds) => {
    if (!seconds) return '-';
    const hours = Math.floor(seconds / 3600);
    const minutes = Math.floor((seconds % 3600) / 60);
    const secs = seconds % 60;
    
    if (hours > 0) {
        return `${hours}h ${minutes}m`;
    }
    return `${minutes}m ${secs}s`;
};

const formatTotalTime = (seconds) => {
    if (!seconds) return '0h';
    const hours = Math.floor(seconds / 3600);
    const minutes = Math.floor((seconds % 3600) / 60);
    
    if (hours > 0) {
        return `${hours}h ${minutes}m`;
    }
    return `${minutes}m`;
};

const getModeVariant = (mode) => {
    const variants = {
        'test': 'warning',
        'quick': 'success',
        'standard': 'default',
        'indepth': 'secondary'
    };
    return variants[mode] || 'default';
};

const getStatusVariant = (status) => {
    const variants = {
        'completed': 'success',
        'in_progress': 'warning',
        'paused': 'secondary'
    };
    return variants[status] || 'default';
};

const getScoreClass = (score) => {
    if (score >= 80) return 'text-green-600 dark:text-green-400';
    if (score >= 60) return 'text-yellow-600 dark:text-yellow-400';
    return 'text-red-600 dark:text-red-400';
};
</script>