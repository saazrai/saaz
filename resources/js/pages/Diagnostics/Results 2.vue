<template>
    <AppLayout title="Diagnostic Results">
        <div class="min-h-screen bg-gray-50 dark:bg-gray-900">
            <!-- Hero Section with Overall Score -->
            <div class="bg-gradient-to-r from-blue-600 to-indigo-700 dark:from-blue-800 dark:to-indigo-900">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                    <div class="text-center text-white">
                        <h1 class="text-4xl font-bold mb-4">
                            {{ diagnostic.status === 'paused' ? 'Test Paused' : 'Diagnostic Assessment Complete!' }}
                        </h1>
                        <p class="text-xl opacity-90 mb-8">
                            {{ diagnostic.status === 'paused' 
                                ? 'You can resume your test where you left off' 
                                : 'Here\'s your comprehensive performance analysis' 
                            }}
                        </p>
                        
                        <!-- Overall Score Circle (only for completed tests) -->
                        <div v-if="diagnostic.status !== 'paused'" class="flex justify-center mb-8">
                            <div class="relative">
                                <svg class="w-48 h-48 transform -rotate-90">
                                    <circle
                                        cx="96"
                                        cy="96"
                                        r="88"
                                        stroke="currentColor"
                                        stroke-width="12"
                                        fill="none"
                                        class="text-white/20"
                                    />
                                    <circle
                                        cx="96"
                                        cy="96"
                                        r="88"
                                        stroke="currentColor"
                                        stroke-width="12"
                                        fill="none"
                                        :stroke-dasharray="`${2 * Math.PI * 88} ${2 * Math.PI * 88}`"
                                        :stroke-dashoffset="`${2 * Math.PI * 88 - (score / 100) * 2 * Math.PI * 88}`"
                                        class="text-white transition-all duration-1000 ease-out"
                                    />
                                </svg>
                                <div class="absolute inset-0 flex flex-col items-center justify-center">
                                    <span class="text-5xl font-bold">{{ Math.round(score) }}%</span>
                                    <span class="text-lg opacity-90">Overall Score</span>
                                </div>
                            </div>
                        </div>

                        <!-- Progress indicator for paused tests -->
                        <div v-else class="flex flex-col items-center mb-8">
                            <div class="text-center mb-6">
                                <div class="text-5xl font-bold mb-2">{{ diagnostic.current_question }}</div>
                                <div class="text-lg opacity-90">of {{ diagnostic.total_questions }} questions answered</div>
                            </div>
                            <div class="w-64 bg-white/20 rounded-full h-4 mb-6">
                                <div 
                                    class="bg-white h-4 rounded-full transition-all duration-500"
                                    :style="{ width: `${(diagnostic.current_question / diagnostic.total_questions) * 100}%` }"
                                ></div>
                            </div>
                            <!-- Resume Button -->
                            <div class="flex justify-center">
                                <button
                                    @click="resumeTest"
                                    :disabled="isResuming"
                                    class="inline-flex items-center px-8 py-4 bg-green-600 hover:bg-green-700 disabled:bg-green-400 text-white font-bold rounded-xl shadow-lg transition-all duration-200 transform hover:scale-105 disabled:scale-100"
                                >
                                <svg v-if="isResuming" class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                <svg v-else class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h1m4 0h1m-6 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ isResuming ? 'Resuming...' : 'Resume Test' }}
                                </button>
                            </div>
                        </div>
                        
                        <!-- Performance Level (only for completed tests) -->
                        <Badge v-if="diagnostic.status !== 'paused'" :variant="performanceVariant" class="text-lg px-4 py-2">
                            {{ performanceLevel }}
                        </Badge>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 -mt-8">
                
                <!-- Paused Test Information -->
                <div v-if="diagnostic.status === 'paused'" class="mb-8">
                    <Card class="bg-gradient-to-r from-yellow-50 to-orange-50 dark:from-yellow-900/20 dark:to-orange-900/20 border-yellow-200 dark:border-yellow-700 shadow-xl rounded-2xl overflow-hidden">
                        <CardHeader class="pb-4">
                            <CardTitle class="flex items-center text-yellow-800 dark:text-yellow-200 text-xl font-semibold">
                                <ClockIcon class="w-6 h-6 mr-3" />
                                Test Progress
                            </CardTitle>
                        </CardHeader>
                        <CardContent class="pt-0">
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <div class="text-center p-4 bg-white/20 dark:bg-gray-800/20 rounded-xl">
                                    <div class="text-3xl font-bold text-yellow-600 dark:text-yellow-400 mb-2">
                                        {{ diagnostic.current_question }}
                                    </div>
                                    <p class="text-sm font-medium text-yellow-700 dark:text-yellow-300">
                                        Questions completed
                                    </p>
                                </div>
                                <div class="text-center p-4 bg-white/20 dark:bg-gray-800/20 rounded-xl">
                                    <div class="text-3xl font-bold text-yellow-600 dark:text-yellow-400 mb-2">
                                        {{ diagnostic.total_questions - diagnostic.current_question }}
                                    </div>
                                    <p class="text-sm font-medium text-yellow-700 dark:text-yellow-300">
                                        Questions remaining
                                    </p>
                                </div>
                                <div class="text-center p-4 bg-white/20 dark:bg-gray-800/20 rounded-xl">
                                    <div class="text-3xl font-bold text-yellow-600 dark:text-yellow-400 mb-2">
                                        {{ formattedTime(diagnostic.total_duration_seconds) }}
                                    </div>
                                    <p class="text-sm font-medium text-yellow-700 dark:text-yellow-300">
                                        Time spent so far
                                    </p>
                                </div>
                            </div>
                            <div class="mt-8">
                                <div class="flex items-center justify-between mb-3">
                                    <span class="text-lg font-semibold text-yellow-700 dark:text-yellow-300">
                                        Overall Progress
                                    </span>
                                    <span class="text-lg font-bold text-yellow-600 dark:text-yellow-400">
                                        {{ Math.round((diagnostic.current_question / diagnostic.total_questions) * 100) }}%
                                    </span>
                                </div>
                                <Progress 
                                    :model-value="(diagnostic.current_question / diagnostic.total_questions) * 100" 
                                    class="h-4 bg-white/30 dark:bg-gray-700/30"
                                />
                            </div>
                        </CardContent>
                    </Card>
                </div>

                <!-- Key Metrics Cards (only for completed tests) -->
                <div v-if="diagnostic.status !== 'paused'" class="space-y-8">
                <!-- Key Metrics Cards -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
                    <Card class="bg-white dark:bg-gray-800 shadow-lg">
                        <CardHeader class="pb-2">
                            <CardTitle class="text-base font-medium text-gray-600 dark:text-gray-400">
                                Questions Answered
                            </CardTitle>
                        </CardHeader>
                        <CardContent>
                            <div class="text-2xl font-bold">{{ diagnostic.current_question }}</div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                of {{ diagnostic.total_questions }} total
                            </p>
                        </CardContent>
                    </Card>

                    <Card class="bg-white dark:bg-gray-800 shadow-lg">
                        <CardHeader class="pb-2">
                            <CardTitle class="text-base font-medium text-gray-600 dark:text-gray-400">
                                Correct Answers
                            </CardTitle>
                        </CardHeader>
                        <CardContent>
                            <div class="text-2xl font-bold text-green-600">{{ correctCount }}</div>
                            <Progress :model-value="(correctCount / diagnostic.current_question) * 100" class="mt-2" />
                        </CardContent>
                    </Card>

                    <Card class="bg-white dark:bg-gray-800 shadow-lg">
                        <CardHeader class="pb-2">
                            <CardTitle class="text-base font-medium text-gray-600 dark:text-gray-400">
                                Time Taken
                            </CardTitle>
                        </CardHeader>
                        <CardContent>
                            <div class="text-2xl font-bold">{{ formattedTime(diagnostic.total_duration_seconds) }}</div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                {{ avgTimePerQuestion }} avg/question
                            </p>
                        </CardContent>
                    </Card>

                    <Card class="bg-white dark:bg-gray-800 shadow-lg">
                        <CardHeader class="pb-2">
                            <CardTitle class="text-base font-medium text-gray-600 dark:text-gray-400">
                                Accuracy Rate
                            </CardTitle>
                        </CardHeader>
                        <CardContent>
                            <div class="text-2xl font-bold">{{ accuracyRate }}%</div>
                            <div class="flex items-center mt-2">
                                <span v-if="accuracyTrend > 0" class="text-green-600 text-sm flex items-center">
                                    <ArrowUpIcon class="w-4 h-4 mr-1" />
                                    {{ accuracyTrend }}% vs last
                                </span>
                                <span v-else-if="accuracyTrend < 0" class="text-red-600 text-sm flex items-center">
                                    <ArrowDownIcon class="w-4 h-4 mr-1" />
                                    {{ Math.abs(accuracyTrend) }}% vs last
                                </span>
                                <span v-else class="text-gray-500 text-sm">
                                    First attempt
                                </span>
                            </div>
                        </CardContent>
                    </Card>
                </div>

                <!-- Charts Section -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                    <!-- Domain Performance Chart -->
                    <Card class="bg-white dark:bg-gray-800 shadow-lg">
                        <CardHeader>
                            <CardTitle>Performance by Domain</CardTitle>
                            <CardDescription>Your score across different security domains</CardDescription>
                        </CardHeader>
                        <CardContent>
                            <div class="h-80">
                                <BarChart 
                                    :data="domainChartData" 
                                    index="name" 
                                    :categories="['score']"
                                    :colors="['blue']"
                                    :y-formatter="(value) => `${value}%`"
                                />
                            </div>
                        </CardContent>
                    </Card>

                    <!-- Difficulty Distribution -->
                    <Card class="bg-white dark:bg-gray-800 shadow-lg">
                        <CardHeader>
                            <CardTitle>Performance by Difficulty</CardTitle>
                            <CardDescription>How you performed on questions of varying difficulty</CardDescription>
                        </CardHeader>
                        <CardContent>
                            <div class="h-80">
                                <DonutChart 
                                    :data="difficultyChartData"
                                    index="difficulty"
                                    category="percentage"
                                    :colors="['green', 'yellow', 'red']"
                                    :show-label="true"
                                />
                            </div>
                        </CardContent>
                    </Card>
                </div>

                <!-- Detailed Analysis Section -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
                    <!-- Strengths -->
                    <Card class="bg-white dark:bg-gray-800 shadow-lg">
                        <CardHeader>
                            <CardTitle class="flex items-center">
                                <TrophyIcon class="w-5 h-5 mr-2 text-green-600" />
                                Your Strengths
                            </CardTitle>
                        </CardHeader>
                        <CardContent>
                            <div v-if="topStrengths.length > 0" class="space-y-3">
                                <div v-for="strength in topStrengths" :key="strength.domain" 
                                     class="flex items-center justify-between">
                                    <span class="text-sm font-medium">{{ strength.domain }}</span>
                                    <Badge variant="success">{{ strength.score }}%</Badge>
                                </div>
                            </div>
                            <p v-else class="text-gray-500 dark:text-gray-400 text-sm">
                                Keep practicing to identify your strengths!
                            </p>
                        </CardContent>
                    </Card>

                    <!-- Areas for Improvement -->
                    <Card class="bg-white dark:bg-gray-800 shadow-lg">
                        <CardHeader>
                            <CardTitle class="flex items-center">
                                <AlertCircleIcon class="w-5 h-5 mr-2 text-yellow-600" />
                                Areas to Improve
                            </CardTitle>
                        </CardHeader>
                        <CardContent>
                            <div v-if="topWeaknesses.length > 0" class="space-y-3">
                                <div v-for="weakness in topWeaknesses" :key="weakness.domain" 
                                     class="flex items-center justify-between">
                                    <span class="text-sm font-medium">{{ weakness.domain }}</span>
                                    <Badge variant="warning">{{ weakness.score }}%</Badge>
                                </div>
                            </div>
                            <p v-else class="text-gray-500 dark:text-gray-400 text-sm">
                                Great job! No significant weak areas identified.
                            </p>
                        </CardContent>
                    </Card>

                    <!-- Time Analysis -->
                    <Card class="bg-white dark:bg-gray-800 shadow-lg">
                        <CardHeader>
                            <CardTitle class="flex items-center">
                                <ClockIcon class="w-5 h-5 mr-2 text-blue-600" />
                                Time Management
                            </CardTitle>
                        </CardHeader>
                        <CardContent>
                            <div class="space-y-3">
                                <div class="flex justify-between items-center">
                                    <span class="text-sm">Fastest Answer</span>
                                    <span class="font-medium">{{ fastestAnswer }}s</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-sm">Slowest Answer</span>
                                    <span class="font-medium">{{ slowestAnswer }}s</span>
                                </div>
                                <Separator class="my-2" />
                                <div class="flex justify-between items-center">
                                    <span class="text-sm font-medium">Average Time</span>
                                    <span class="font-bold">{{ avgTimePerQuestion }}</span>
                                </div>
                            </div>
                        </CardContent>
                    </Card>
                </div>

                <!-- Question Type Performance -->
                <Card class="bg-white dark:bg-gray-800 shadow-lg mb-8">
                    <CardHeader>
                        <CardTitle>Performance by Question Type</CardTitle>
                        <CardDescription>How you performed on different types of questions</CardDescription>
                    </CardHeader>
                    <CardContent>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            <div v-for="type in questionTypePerformance" :key="type.type" 
                                 class="text-center p-4 rounded-lg bg-gray-50 dark:bg-gray-700">
                                <div class="text-2xl font-bold" :class="getScoreColorClass(type.score)">
                                    {{ type.score }}%
                                </div>
                                <div class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                                    {{ type.type }}
                                </div>
                                <div class="text-xs text-gray-500 dark:text-gray-500 mt-1">
                                    {{ type.count }} questions
                                </div>
                            </div>
                        </div>
                    </CardContent>
                </Card>

                <!-- Next Steps -->
                <Card class="bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-gray-800 dark:to-gray-800 border-blue-200 dark:border-gray-700 shadow-lg">
                    <CardHeader>
                        <CardTitle class="text-xl">Recommended Next Steps</CardTitle>
                    </CardHeader>
                    <CardContent>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                            <div v-for="(recommendation, index) in personalizedRecommendations" 
                                 :key="index" 
                                 class="flex items-start space-x-3">
                                <CheckCircleIcon class="w-5 h-5 text-green-600 mt-0.5 flex-shrink-0" />
                                <p class="text-sm">{{ recommendation }}</p>
                            </div>
                        </div>
                        
                        <!-- Action Buttons -->
                        <div class="flex flex-wrap gap-4">
                            <Link 
                                :href="typeof route !== 'undefined' ? route('assessments.diagnostics.show', diagnostic.id) : `/assessments/diagnostics/${diagnostic.id}`"
                                class="inline-flex items-center px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg shadow-md transition-colors"
                            >
                                <BookOpenIcon class="w-5 h-5 mr-2" />
                                Review Questions
                            </Link>
                            <Link 
                                :href="typeof route !== 'undefined' ? route('assessments.diagnostics.report', diagnostic.id) : `/assessments/diagnostics/${diagnostic.id}/report`"
                                class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow-md transition-colors"
                            >
                                <FileTextIcon class="w-5 h-5 mr-2" />
                                Detailed Report
                            </Link>
                            <Link 
                                :href="typeof route !== 'undefined' ? route('assessments.diagnostics.report', diagnostic.id) : `/assessments/diagnostics/${diagnostic.id}/report`"
                                class="inline-flex items-center px-6 py-3 bg-purple-600 hover:bg-purple-700 text-white font-semibold rounded-lg shadow-md transition-colors"
                            >
                                <SparklesIcon class="w-5 h-5 mr-2" />
                                AI-Enhanced Report
                            </Link>
                            <button
                                @click="downloadPdf"
                                class="inline-flex items-center px-6 py-3 bg-gray-600 hover:bg-gray-700 text-white font-semibold rounded-lg shadow-md transition-colors"
                            >
                                <DownloadIcon class="w-5 h-5 mr-2" />
                                Download PDF
                            </button>
                            <Link 
                                :href="typeof route !== 'undefined' ? route('dashboard') : '/dashboard'"
                                class="inline-flex items-center px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg shadow-md transition-colors"
                            >
                                <GraduationCapIcon class="w-5 h-5 mr-2" />
                                Start Learning
                            </Link>
                            <Link 
                                :href="typeof route !== 'undefined' ? route('assessments.diagnostics.index') : '/assessments/diagnostics'" 
                                class="inline-flex items-center px-6 py-3 bg-gray-600 hover:bg-gray-700 text-white font-semibold rounded-lg shadow-md transition-colors"
                            >
                                <HomeIcon class="w-5 h-5 mr-2" />
                                Back to Diagnostics
                            </Link>
                        </div>
                    </CardContent>
                </Card>
                </div>
                <!-- End conditional content for completed tests -->
            </div>
        </div>
    </AppLayout>
</template>

<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { computed, ref } from 'vue';
import { router } from '@inertiajs/vue3';
import AppLayout from "@/layouts/AppLayout.vue";
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/shadcn/ui/card';
import Badge from '@/components/shadcn/ui/badge/Badge.vue';
import Progress from '@/components/shadcn/ui/progress/Progress.vue';
import Separator from '@/components/shadcn/ui/separator/Separator.vue';
import BarChart from '@/components/shadcn/ui/chart-bar/BarChart.vue';
import DonutChart from '@/components/shadcn/ui/chart-donut/DonutChart.vue';
import { 
    TrophyIcon, 
    AlertCircleIcon, 
    ClockIcon, 
    ArrowUpIcon, 
    ArrowDownIcon,
    CheckCircleIcon,
    BookOpenIcon,
    FileTextIcon,
    GraduationCapIcon,
    HomeIcon,
    SparklesIcon,
    DownloadIcon
} from 'lucide-vue-next';

const props = defineProps({
    diagnostic: Object,
    score: Number,
    correctCount: Number,
    domainPerformance: Array,
    questionTypePerformance: Array,
    difficultyPerformance: Array,
    timeAnalysis: Object,
    previousScore: Number,
    recommendations: Array,
});

// Reactive state
const isResuming = ref(false);

// Computed properties
const performanceLevel = computed(() => {
    if (props.score >= 90) return 'Exceptional';
    if (props.score >= 80) return 'Excellent';
    if (props.score >= 70) return 'Good';
    if (props.score >= 60) return 'Satisfactory';
    return 'Needs Improvement';
});

const performanceVariant = computed(() => {
    if (props.score >= 80) return 'success';
    if (props.score >= 60) return 'default';
    return 'warning';
});

const accuracyRate = computed(() => {
    return Math.round((props.correctCount / props.diagnostic.current_question) * 100);
});

const accuracyTrend = computed(() => {
    if (!props.previousScore) return 0;
    return Math.round(props.score - props.previousScore);
});

const avgTimePerQuestion = computed(() => {
    const avgSeconds = Math.round(props.diagnostic.total_duration_seconds / props.diagnostic.current_question);
    return formatTime(avgSeconds);
});

const domainChartData = computed(() => {
    return props.domainPerformance?.map(domain => {
        const domainName = domain.name || 'Unknown Domain';
        return {
            name: domainName.length > 20 ? domainName.substring(0, 20) + '...' : domainName,
            score: domain.score || 0,
            fullName: domainName
        };
    }) || [];
});

const difficultyChartData = computed(() => {
    return props.difficultyPerformance?.map(diff => ({
        difficulty: diff.level || 'Unknown',
        percentage: diff.score || 0,
        count: diff.count || 0
    })) || [];
});

const topStrengths = computed(() => {
    return props.domainPerformance
        ?.filter(d => (d.score || 0) >= 75)
        .sort((a, b) => (b.score || 0) - (a.score || 0))
        .slice(0, 3)
        .map(d => ({ domain: d.name || 'Unknown Domain', score: d.score || 0 })) || [];
});

const topWeaknesses = computed(() => {
    return props.domainPerformance
        ?.filter(d => (d.score || 0) < 60)
        .sort((a, b) => (a.score || 0) - (b.score || 0))
        .slice(0, 3)
        .map(d => ({ domain: d.name || 'Unknown Domain', score: d.score || 0 })) || [];
});

const fastestAnswer = computed(() => props.timeAnalysis?.fastest || 0);
const slowestAnswer = computed(() => props.timeAnalysis?.slowest || 0);

const personalizedRecommendations = computed(() => {
    return props.recommendations?.slice(0, 6) || [
        'Review incorrect answers to understand key concepts',
        'Focus on domains with scores below 60%',
        'Practice with timed assessments to improve speed',
        'Study recommended materials for weak areas'
    ];
});

// Helper functions
const formattedTime = (seconds) => {
    if (!seconds) return '00:00:00';
    const h = Math.floor(seconds / 3600).toString().padStart(2, '0');
    const m = Math.floor((seconds % 3600) / 60).toString().padStart(2, '0');
    const s = Math.floor(seconds % 60).toString().padStart(2, '0');
    return `${h}:${m}:${s}`;
};

const formatTime = (seconds) => {
    if (seconds < 60) return `${seconds}s`;
    const minutes = Math.floor(seconds / 60);
    const secs = seconds % 60;
    return `${minutes}m ${secs}s`;
};

const getScoreColorClass = (score) => {
    if (score >= 80) return 'text-green-600';
    if (score >= 60) return 'text-yellow-600';
    return 'text-red-600';
};

const downloadPdf = () => {
    // Use the report route as PDF download for now since download route doesn't exist
    const downloadUrl = typeof route !== 'undefined' 
        ? route('assessments.diagnostics.report', props.diagnostic.id) 
        : `/assessments/diagnostics/${props.diagnostic.id}/report`;
    window.open(downloadUrl, '_blank');
};

const resumeTest = async () => {
    isResuming.value = true;
    
    try {
        // Navigate to the diagnostic show page - the backend will handle resuming the test
        const resumeUrl = typeof route !== 'undefined' 
            ? route('assessments.diagnostics.show', props.diagnostic.id)
            : `/assessments/diagnostics/${props.diagnostic.id}`;
        
        router.visit(resumeUrl);
    } catch (error) {
        console.error('Error resuming test:', error);
        isResuming.value = false;
        
        // Show error message (you could replace this with a toast notification)
        alert('Failed to resume test. Please try again.');
    }
};
</script>

<style scoped>
/* Add smooth transitions for progress bars and charts */
circle {
    transition: stroke-dashoffset 1s ease-out;
}
</style>