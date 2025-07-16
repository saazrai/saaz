<template>
    <AppLayout title="Diagnostic Report">
        <div class="min-h-screen bg-gray-50 dark:bg-gray-900">
            <!-- Compact Hero Header -->
            <div class="bg-gradient-to-r from-blue-600 to-indigo-700 dark:from-blue-800 dark:to-indigo-900">
                <div class="container mx-auto px-4 py-8">
                    <div class="flex items-center justify-between">
                        <div>
                            <h1 class="text-2xl font-bold text-white mb-1">Diagnostic Report</h1>
                            <p class="text-blue-100">Complete performance analysis</p>
                        </div>
                        <div class="text-right">
                            <div class="text-4xl font-bold text-white">{{ Math.round(score) }}%</div>
                            <Badge :variant="getHeaderBadgeVariant(score)" class="mt-1">
                                {{ getPerformanceLevel(score) }}
                            </Badge>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container mx-auto px-4 py-6 -mt-4">
                <!-- Quick Stats -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
                    <Card class="bg-white dark:bg-gray-800 shadow-md">
                        <CardContent class="p-4 text-center">
                            <div class="text-2xl font-bold text-green-600 dark:text-green-400">{{ correctCount }}</div>
                            <div class="text-xs text-gray-600 dark:text-gray-400">Correct</div>
                        </CardContent>
                    </Card>
                    <Card class="bg-white dark:bg-gray-800 shadow-md">
                        <CardContent class="p-4 text-center">
                            <div class="text-2xl font-bold text-gray-700 dark:text-gray-300">{{ totalAnswered }}</div>
                            <div class="text-xs text-gray-600 dark:text-gray-400">Total</div>
                        </CardContent>
                    </Card>
                    <Card class="bg-white dark:bg-gray-800 shadow-md">
                        <CardContent class="p-4 text-center">
                            <div class="text-2xl font-bold text-blue-600 dark:text-blue-400">{{ formattedTime(diagnostic.total_duration_seconds) }}</div>
                            <div class="text-xs text-gray-600 dark:text-gray-400">Time</div>
                        </CardContent>
                    </Card>
                    <Card class="bg-white dark:bg-gray-800 shadow-md">
                        <CardContent class="p-4 text-center">
                            <div class="text-2xl font-bold text-purple-600 dark:text-purple-400">{{ avgTimePerQuestion }}</div>
                            <div class="text-xs text-gray-600 dark:text-gray-400">Avg/Q</div>
                        </CardContent>
                    </Card>
                </div>

                <!-- Domain Performance - Compact Cards -->
                <div class="mb-6">
                    <div class="flex items-center mb-4">
                        <ChartBarIcon class="w-5 h-5 mr-2 text-gray-600 dark:text-gray-400" />
                        <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Performance by Domain</h2>
                    </div>
                    <div v-if="domainPerformance.length > 0" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        <Card v-for="domain in domainPerformance" :key="domain.name" 
                              class="bg-white dark:bg-gray-800 shadow-md hover:shadow-lg transition-shadow">
                            <CardContent class="p-4">
                                <div class="flex items-center justify-between mb-2">
                                    <h3 class="font-medium text-sm text-gray-900 dark:text-white truncate">
                                        {{ domain.name }}
                                    </h3>
                                    <Badge :variant="getScoreBadgeVariant(domain.score)" class="ml-2">
                                        {{ Math.round(domain.score) }}%
                                    </Badge>
                                </div>
                                <div class="mb-2">
                                    <Progress :model-value="domain.score" class="h-2" />
                                </div>
                                <div class="flex justify-between text-xs text-gray-600 dark:text-gray-400">
                                    <span>{{ domain.correct_count || 0 }}/{{ domain.total_answered || 0 }} correct</span>
                                    <span class="font-medium" :class="getScoreTextClass(domain.score)">
                                        {{ getPerformanceText(domain.score) }}
                                    </span>
                                </div>
                            </CardContent>
                        </Card>
                    </div>
                    <Card v-else class="bg-white dark:bg-gray-800 shadow-md">
                        <CardContent class="p-6 text-center">
                            <p class="text-gray-500 dark:text-gray-400">No domain performance data available.</p>
                        </CardContent>
                    </Card>
                </div>

                <!-- Strengths and Weaknesses - Side by Side -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                    <!-- Strengths -->
                    <div>
                        <div class="flex items-center mb-3">
                            <TrophyIcon class="w-5 h-5 mr-2 text-green-600" />
                            <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Top Strengths</h2>
                        </div>
                        <div v-if="strengths.length > 0" class="space-y-2">
                            <Card v-for="strength in strengths.slice(0, 3)" :key="strength.name" 
                                  class="bg-gradient-to-r from-green-50 to-emerald-50 dark:from-green-900/20 dark:to-emerald-900/20 border-green-200 dark:border-green-800">
                                <CardContent class="p-3">
                                    <div class="flex items-center justify-between">
                                        <span class="font-medium text-sm text-green-800 dark:text-green-200">{{ strength.name }}</span>
                                        <Badge variant="success" class="text-xs">{{ Math.round(strength.score) }}%</Badge>
                                    </div>
                                </CardContent>
                            </Card>
                        </div>
                        <Card v-else class="bg-gray-50 dark:bg-gray-800/50">
                            <CardContent class="p-4 text-center">
                                <p class="text-gray-600 dark:text-gray-400 text-sm">Continue practicing to identify your strengths</p>
                            </CardContent>
                        </Card>
                    </div>

                    <!-- Areas for Improvement -->
                    <div>
                        <div class="flex items-center mb-3">
                            <AlertTriangleIcon class="w-5 h-5 mr-2 text-orange-600" />
                            <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Areas to Improve</h2>
                        </div>
                        <div v-if="weaknesses.length > 0" class="space-y-2">
                            <Card v-for="weakness in weaknesses.slice(0, 3)" :key="weakness.name" 
                                  class="bg-gradient-to-r from-orange-50 to-red-50 dark:from-orange-900/20 dark:to-red-900/20 border-orange-200 dark:border-orange-800">
                                <CardContent class="p-3">
                                    <div class="flex items-center justify-between">
                                        <span class="font-medium text-sm text-orange-800 dark:text-orange-200">{{ weakness.name }}</span>
                                        <Badge variant="destructive" class="text-xs">{{ Math.round(weakness.score) }}%</Badge>
                                    </div>
                                </CardContent>
                            </Card>
                        </div>
                        <Card v-else class="bg-gray-50 dark:bg-gray-800/50">
                            <CardContent class="p-4 text-center">
                                <p class="text-gray-600 dark:text-gray-400 text-sm">Great job! No significant weaknesses found</p>
                            </CardContent>
                        </Card>
                    </div>
                </div>

                <!-- Study Recommendations -->
                <div class="mb-6">
                    <div class="flex items-center mb-4">
                        <LightbulbIcon class="w-5 h-5 mr-2 text-yellow-600" />
                        <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Study Recommendations</h2>
                    </div>
                    <Card class="bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-blue-900/20 dark:to-indigo-900/20">
                        <CardContent class="p-4">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                <div v-for="(recommendation, index) in recommendations.slice(0, 6)" 
                                     :key="index" 
                                     class="flex items-start space-x-2">
                                    <CheckCircle2Icon class="w-4 h-4 text-blue-600 mt-0.5 flex-shrink-0" />
                                    <p class="text-sm text-gray-700 dark:text-gray-300">{{ recommendation }}</p>
                                </div>
                            </div>
                        </CardContent>
                    </Card>
                </div>

                <!-- Performance Analysis - Compact Tabs -->
                <div class="mb-6">
                    <div class="flex items-center mb-4">
                        <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Detailed Analysis</h2>
                    </div>
                    <Card class="bg-white dark:bg-gray-800">
                        <CardContent class="p-4">
                            <Tabs default-value="difficulty" class="w-full">
                                <TabsList class="grid w-full grid-cols-3 mb-4">
                                    <TabsTrigger value="difficulty" class="text-sm">By Difficulty</TabsTrigger>
                                    <TabsTrigger value="bloom" class="text-sm">By Bloom Level</TabsTrigger>
                                    <TabsTrigger value="time" class="text-sm">Time Analysis</TabsTrigger>
                                </TabsList>
                                
                                <TabsContent value="difficulty">
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                                        <div v-for="level in difficultyAnalysis" :key="level.name" 
                                             class="p-3 rounded-lg bg-gray-50 dark:bg-gray-700 text-center">
                                            <div class="font-medium text-sm mb-1">{{ level.name }}</div>
                                            <div class="text-lg font-bold" :class="getScoreTextClass(level.score)">{{ level.score }}%</div>
                                            <div class="text-xs text-gray-600 dark:text-gray-400">{{ level.correct }}/{{ level.total }}</div>
                                        </div>
                                    </div>
                                </TabsContent>
                                
                                <TabsContent value="bloom">
                                    <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                                        <div v-for="level in bloomAnalysis" :key="level.name" 
                                             class="p-3 rounded-lg bg-gray-50 dark:bg-gray-700 text-center">
                                            <div class="font-medium text-sm mb-1">{{ level.name }}</div>
                                            <div class="text-lg font-bold" :class="getScoreTextClass(level.score)">{{ level.score }}%</div>
                                            <div class="text-xs text-gray-600 dark:text-gray-400">{{ level.correct }}/{{ level.total }}</div>
                                        </div>
                                    </div>
                                </TabsContent>
                                
                                <TabsContent value="time">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                        <div class="p-3 rounded-lg bg-gray-50 dark:bg-gray-700 text-center">
                                            <div class="text-sm text-gray-600 dark:text-gray-400 mb-1">Avg Time/Question</div>
                                            <div class="text-xl font-bold">{{ avgTimePerQuestion }}</div>
                                        </div>
                                        <div class="p-3 rounded-lg bg-gray-50 dark:bg-gray-700 text-center">
                                            <div class="text-sm text-gray-600 dark:text-gray-400 mb-1">Time Efficiency</div>
                                            <div class="text-xl font-bold" :class="getScoreTextClass(timeEfficiencyScore)">{{ timeEfficiencyScore }}%</div>
                                        </div>
                                    </div>
                                    <div class="p-3 rounded-lg bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800">
                                        <p class="text-sm text-blue-800 dark:text-blue-300">{{ timeRecommendation }}</p>
                                    </div>
                                </TabsContent>
                            </Tabs>
                        </CardContent>
                    </Card>
                </div>

                <!-- Action Buttons -->
                <Card class="bg-white dark:bg-gray-800">
                    <CardContent class="p-4">
                        <div class="flex flex-wrap gap-3 justify-center">
                            <Link
                                :href="typeof route !== 'undefined' ? route('assessments.diagnostics.review', diagnostic.id) : '#'"
                                class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg shadow-sm transition-colors text-sm"
                            >
                                <BookOpenIcon class="w-4 h-4 mr-2" />
                                Review Questions
                            </Link>
                            <button
                                @click="downloadReport"
                                class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg shadow-sm transition-colors text-sm"
                            >
                                <DownloadIcon class="w-4 h-4 mr-2" />
                                Download PDF
                            </button>
                            <Link
                                :href="typeof route !== 'undefined' ? route('learn.courses.index') : '#'"
                                class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg shadow-sm transition-colors text-sm"
                            >
                                <GraduationCapIcon class="w-4 h-4 mr-2" />
                                Start Learning
                            </Link>
                            <Link
                                :href="typeof route !== 'undefined' ? route('assessments.diagnostics.dashboard') : '#'"
                                class="inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white font-medium rounded-lg shadow-sm transition-colors text-sm"
                            >
                                <HomeIcon class="w-4 h-4 mr-2" />
                                Dashboard
                            </Link>
                        </div>
                    </CardContent>
                </Card>
            </div>
        </div>
    </AppLayout>
</template>

<script setup lang="ts">
import { computed } from 'vue';
import AppLayout from '@/layouts/AppLayout.vue';
import Badge from '@/components/shadcn/ui/badge/Badge.vue';
import Progress from '@/components/shadcn/ui/progress/Progress.vue';
import Tabs from '@/components/shadcn/ui/tabs/Tabs.vue';
import TabsContent from '@/components/shadcn/ui/tabs/TabsContent.vue';
import TabsList from '@/components/shadcn/ui/tabs/TabsList.vue';
import TabsTrigger from '@/components/shadcn/ui/tabs/TabsTrigger.vue';
import { 
    TrophyIcon, 
    AlertTriangleIcon, 
    LightbulbIcon,
    ChartBarIcon,
    CheckCircle2Icon,
    BookOpenIcon,
    DownloadIcon,
    GraduationCapIcon,
    HomeIcon
} from 'lucide-vue-next';

const props = defineProps({
    diagnostic: Object,
    score: Number,
    correctCount: Number,
    totalAnswered: Number,
    domainPerformance: Array,
    strengths: Array,
    weaknesses: Array,
    recommendations: Array,
});

// Add computed properties for additional analysis
const difficultyAnalysis = computed(() => {
    // This would be calculated from the diagnostic responses
    return [
        { name: 'Easy', total: 20, correct: 18, score: 90 },
        { name: 'Medium', total: 30, correct: 21, score: 70 },
        { name: 'Hard', total: 10, correct: 5, score: 50 },
    ];
});

const bloomAnalysis = computed(() => {
    // This would be calculated from the diagnostic responses
    return [
        { name: 'Remember', total: 15, correct: 14, score: 93 },
        { name: 'Understand', total: 20, correct: 16, score: 80 },
        { name: 'Apply', total: 15, correct: 10, score: 67 },
        { name: 'Analyze', total: 10, correct: 6, score: 60 },
    ];
});

const avgTimePerQuestion = computed(() => {
    const avgSeconds = Math.round(props.diagnostic.total_duration_seconds / props.totalAnswered);
    return formatTime(avgSeconds);
});

const timeEfficiencyScore = computed(() => {
    // Calculate based on average time vs expected time
    const avgSeconds = props.diagnostic.total_duration_seconds / props.totalAnswered;
    const expectedSeconds = 90; // Expected 90 seconds per question
    return Math.min(100, Math.round((expectedSeconds / avgSeconds) * 100));
});

const timeRecommendation = computed(() => {
    if (timeEfficiencyScore.value >= 80) {
        return "Excellent time management! You're answering questions efficiently without rushing.";
    } else if (timeEfficiencyScore.value >= 60) {
        return "Good pacing. Consider spending a bit more time on complex questions to improve accuracy.";
    } else {
        return "You may be spending too much time per question. Practice with timed assessments to improve speed.";
    }
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

const getPerformanceLevel = (score) => {
    if (score >= 90) return 'Exceptional Performance';
    if (score >= 80) return 'Excellent Performance';
    if (score >= 70) return 'Good Performance';
    if (score >= 60) return 'Satisfactory Performance';
    return 'Needs Improvement';
};

const getScoreBadgeVariant = (score) => {
    if (score >= 80) return 'success';
    if (score >= 60) return 'default';
    return 'destructive';
};

const getHeaderBadgeVariant = (score) => {
    if (score >= 80) return 'success';
    if (score >= 60) return 'default';
    return 'destructive';
};

const getScoreTextClass = (score) => {
    if (score >= 80) return 'text-green-600 dark:text-green-400';
    if (score >= 60) return 'text-yellow-600 dark:text-yellow-400';
    return 'text-red-600 dark:text-red-400';
};

const getPerformanceText = (score) => {
    if (score >= 90) return 'Excellent';
    if (score >= 80) return 'Great';
    if (score >= 70) return 'Good';
    if (score >= 60) return 'Fair';
    return 'Needs work';
};

const downloadReport = () => {
    const downloadUrl = typeof route !== 'undefined' 
        ? route('assessments.diagnostics.download', props.diagnostic.id) 
        : `/assessments/diagnostics/${props.diagnostic.id}/download`;
    window.open(downloadUrl, '_blank');
};
</script>

<style scoped>
/* Add any specific styles if needed */
</style>