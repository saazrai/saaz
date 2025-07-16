<template>
    <AppLayout title="Diagnostic Report - Enhanced Analysis">
        <div class="min-h-screen bg-gray-50 dark:bg-gray-900">
            <!-- Compact Summary Header -->
            <div class="bg-gradient-to-r from-blue-600 to-indigo-700 dark:from-blue-800 dark:to-indigo-900">
                <div class="container mx-auto px-4 py-8">
                    <div class="max-w-6xl mx-auto">
                        <!-- Performance Summary Card -->
                        <div class="bg-white/10 backdrop-blur-md rounded-2xl p-6 text-white">
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <!-- Score & Level -->
                                <div class="text-center">
                                    <div class="inline-flex items-center justify-center w-24 h-24 rounded-full bg-white/20 mb-3">
                                        <span class="text-3xl font-bold">{{ Math.round(score) }}%</span>
                                    </div>
                                    <h3 class="text-lg font-semibold">{{ performanceLevel }}</h3>
                                    <Badge :variant="levelBadgeVariant" class="mt-2">
                                        {{ currentCourseLevel.name }} Level
                                    </Badge>
                                </div>
                                
                                <!-- Key Insights -->
                                <div class="md:col-span-2">
                                    <h4 class="font-semibold mb-3">Key Insights</h4>
                                    <ul class="space-y-2">
                                        <li v-for="insight in keyInsights" :key="insight" class="flex items-start">
                                            <CheckCircleIcon class="w-5 h-5 mr-2 mt-0.5 flex-shrink-0" />
                                            <span class="text-sm">{{ insight }}</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content Area -->
            <div class="container mx-auto px-4 py-8 -mt-4">
                <div class="max-w-6xl mx-auto space-y-6">
                    <!-- Career Alignment Card -->
                    <Card class="bg-white dark:bg-gray-800 shadow-lg">
                        <CardHeader>
                            <CardTitle class="flex items-center">
                                <BriefcaseIcon class="w-5 h-5 mr-2 text-blue-600" />
                                Career Alignment Analysis
                            </CardTitle>
                        </CardHeader>
                        <CardContent>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <!-- Current Level -->
                                <div>
                                    <h4 class="font-medium text-gray-600 dark:text-gray-400 mb-2">Your Level</h4>
                                    <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                                        <div class="flex items-center mb-2">
                                            <span class="text-2xl mr-2">{{ currentCourseLevel.style.icon }}</span>
                                            <span class="font-semibold">{{ currentCourseLevel.name }}</span>
                                        </div>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">
                                            {{ currentCourseLevel.skill_level }}
                                        </p>
                                    </div>
                                </div>
                                
                                <!-- Job Role Matches -->
                                <div>
                                    <h4 class="font-medium text-gray-600 dark:text-gray-400 mb-2">Matching Roles</h4>
                                    <div class="space-y-2">
                                        <div v-for="role in matchingJobRoles" :key="role"
                                             class="flex items-center text-sm">
                                            <CheckIcon class="w-4 h-4 text-green-500 mr-2" />
                                            {{ role }}
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Certification Readiness -->
                                <div>
                                    <h4 class="font-medium text-gray-600 dark:text-gray-400 mb-2">Certification Ready</h4>
                                    <div class="space-y-2">
                                        <div v-for="cert in certificationReadiness" :key="cert.name" 
                                             class="flex items-center justify-between">
                                            <span class="text-sm">{{ cert.name }}</span>
                                            <div class="flex items-center">
                                                <div class="w-2 h-2 rounded-full mr-1"
                                                     :class="getCertReadinessColor(cert.readiness)"></div>
                                                <span class="text-xs">{{ cert.readiness }}%</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </CardContent>
                    </Card>

                    <!-- Domain Performance Visualization -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <!-- Heatmap View -->
                        <Card class="bg-white dark:bg-gray-800 shadow-lg">
                            <CardHeader>
                                <CardTitle class="flex items-center justify-between">
                                    <span class="flex items-center">
                                        <ChartBarIcon class="w-5 h-5 mr-2 text-purple-600" />
                                        Domain Performance Matrix
                                    </span>
                                    <Button @click="showDetailedDomains = !showDetailedDomains" size="sm" variant="ghost">
                                        {{ showDetailedDomains ? 'Compact' : 'Detailed' }}
                                    </Button>
                                </CardTitle>
                            </CardHeader>
                            <CardContent>
                            <!-- Heatmap Grid -->
                            <div v-if="!showDetailedDomains" class="grid grid-cols-5 gap-2">
                                <div v-for="domain in domainPerformance" :key="domain.name"
                                     class="relative group cursor-pointer"
                                     @click="selectedDomain = domain">
                                    <div class="aspect-square rounded-lg flex items-center justify-center text-xs font-medium transition-all"
                                         :class="getDomainColorClass(domain.score)"
                                         :title="`${domain.name}: ${domain.score}%`">
                                        {{ domain.score }}%
                                    </div>
                                    <div class="absolute bottom-full left-1/2 transform -translate-x-1/2 mb-2 px-2 py-1 bg-gray-900 text-white text-xs rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap z-10">
                                        {{ domain.name }}
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Detailed Domain List -->
                            <div v-else class="space-y-3">
                                <div v-for="domain in domainPerformance" :key="domain.name">
                                    <div class="flex items-center justify-between mb-1">
                                        <span class="text-sm font-medium">{{ domain.name }}</span>
                                        <span class="text-sm font-bold" :class="getScoreColorClass(domain.score)">
                                            {{ domain.score }}%
                                        </span>
                                    </div>
                                    <Progress :model-value="domain.score" class="h-2" />
                                </div>
                            </div>
                        </CardContent>
                    </Card>
                    
                    <!-- Radar Chart View -->
                    <Card class="bg-white dark:bg-gray-800 shadow-lg">
                        <CardHeader>
                            <CardTitle class="flex items-center">
                                <ActivityIcon class="w-5 h-5 mr-2 text-indigo-600" />
                                Skills Radar
                            </CardTitle>
                        </CardHeader>
                        <CardContent>
                            <div class="h-80 flex items-center justify-center">
                                <!-- Simplified Skills Overview -->
                                <div class="grid grid-cols-2 md:grid-cols-3 gap-4 w-full">
                                    <div v-for="item in domainPerformance.slice(0, 6)" :key="item.name" 
                                         class="text-center p-4 rounded-lg bg-gray-50 dark:bg-gray-700">
                                        <div class="w-16 h-16 mx-auto mb-2 rounded-full flex items-center justify-center"
                                             :class="getScoreBackgroundClass(item.score)">
                                            <span class="text-sm font-bold text-white">{{ Math.round(item.score) }}%</span>
                                        </div>
                                        <div class="text-xs font-medium text-gray-600 dark:text-gray-400">
                                            {{ item.name.length > 15 ? item.name.substring(0, 15) + '...' : item.name }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </CardContent>
                    </Card>
                </div>

                    <!-- AI-Powered Insights -->
                    <Card v-if="aiInsights" class="bg-gradient-to-r from-purple-50 to-indigo-50 dark:from-gray-800 dark:to-gray-800 border-purple-200 dark:border-gray-700 shadow-lg">
                        <CardHeader>
                            <CardTitle class="flex items-center">
                                <SparklesIcon class="w-5 h-5 mr-2 text-purple-600" />
                                AI-Powered Analysis
                            </CardTitle>
                        </CardHeader>
                        <CardContent>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Strengths -->
                                <div>
                                    <h4 class="font-semibold text-gray-900 dark:text-white mb-3">Key Strengths</h4>
                                    <div class="space-y-2">
                                        <div v-for="strength in aiInsights.strengths" :key="strength"
                                             class="flex items-start">
                                            <TrophyIcon class="w-4 h-4 text-green-600 mr-2 mt-0.5 flex-shrink-0" />
                                            <span class="text-sm">{{ strength }}</span>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Improvements -->
                                <div>
                                    <h4 class="font-semibold text-gray-900 dark:text-white mb-3">Priority Improvements</h4>
                                    <div class="space-y-2">
                                        <div v-for="improvement in aiInsights.improvements" :key="improvement"
                                             class="flex items-start">
                                            <AlertCircleIcon class="w-4 h-4 text-yellow-600 mr-2 mt-0.5 flex-shrink-0" />
                                            <span class="text-sm">{{ improvement }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- 30-Day Plan -->
                            <div class="mt-6 pt-6 border-t border-gray-200 dark:border-gray-600">
                                <h4 class="font-semibold text-gray-900 dark:text-white mb-3">Your 30-Day Study Plan</h4>
                                <div class="bg-white dark:bg-gray-700 rounded-lg p-4">
                                    <div class="space-y-3">
                                        <div v-for="(week, index) in aiInsights.studyPlan" :key="index"
                                             class="flex items-start">
                                            <div class="flex-shrink-0 w-16 text-sm font-medium text-gray-600 dark:text-gray-400">
                                                Week {{ index + 1 }}
                                            </div>
                                            <div class="flex-1">
                                                <p class="text-sm font-medium">{{ week.focus }}</p>
                                                <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">
                                                    {{ week.hours }} hours • {{ week.topics }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </CardContent>
                    </Card>

                    <!-- Quick Actions -->
                    <Card class="bg-white dark:bg-gray-800 shadow-lg">
                        <CardHeader>
                            <CardTitle>Next Steps</CardTitle>
                        </CardHeader>
                        <CardContent>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <Link :href="route('assessments.diagnostics.review', diagnostic.id)"
                                      class="flex items-center justify-center px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg transition-colors">
                                    <BookOpenIcon class="w-5 h-5 mr-2" />
                                    Review Answers
                                </Link>
                                <Link :href="route('learn.study-plans.generate')"
                                      class="flex items-center justify-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition-colors">
                                    <RocketIcon class="w-5 h-5 mr-2" />
                                    Generate Study Plan
                                </Link>
                                <button @click="downloadReport"
                                        class="flex items-center justify-center px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg transition-colors">
                                    <DownloadIcon class="w-5 h-5 mr-2" />
                                    Download Report
                                </button>
                            </div>
                        </CardContent>
                    </Card>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import { computed, ref } from 'vue';
import AppLayout from '@/layouts/AppLayout.vue';
import Badge from '@/components/shadcn/ui/badge/Badge.vue';
import { Button } from '@/components/shadcn/ui/button';
import Progress from '@/components/shadcn/ui/progress/Progress.vue';
import { 
    CheckCircleIcon,
    BriefcaseIcon,
    CheckIcon,
    ChartBarIcon,
    SparklesIcon,
    TrophyIcon,
    AlertCircleIcon,
    BookOpenIcon,
    RocketIcon,
    DownloadIcon,
    ActivityIcon
} from 'lucide-vue-next';
// import { VisSingleContainer, VisRadar, VisRadarAxis } from '@unovis/vue';

const props = defineProps({
    diagnostic: Object,
    score: Number,
    correctCount: Number,
    domainPerformance: Array,
    courseLevels: Array,
    currentCourseLevel: Object,
    matchingJobRoles: Array,
    certificationReadiness: Array,
    keyInsights: Array,
    aiInsights: Object,
    recommendations: Array,
});

// State
const showDetailedDomains = ref(false);
const selectedDomain = ref(null);

// Computed properties
const performanceLevel = computed(() => {
    if (props.score >= 90) return 'Exceptional Performance';
    if (props.score >= 80) return 'Advanced Proficiency';
    if (props.score >= 70) return 'Solid Foundation';
    if (props.score >= 60) return 'Developing Skills';
    return 'Building Fundamentals';
});

const levelBadgeVariant = computed(() => {
    const levelMap = {
        'Foundational': 'secondary',
        'Entry-Level': 'default',
        'Intermediate': 'warning',
        'Professional': 'primary',
        'Expert': 'destructive'
    };
    return levelMap[props.currentCourseLevel?.name] || 'default';
});

const radarData = computed(() => {
    if (!props.domainPerformance) return [];
    return props.domainPerformance.map(domain => ({
        category: domain.name,
        score: domain.score
    }));
});

// Helper functions
const getDomainColorClass = (score) => {
    if (score >= 80) return 'bg-green-500 text-white';
    if (score >= 70) return 'bg-green-400 text-white';
    if (score >= 60) return 'bg-yellow-400 text-gray-900';
    if (score >= 50) return 'bg-orange-400 text-white';
    return 'bg-red-500 text-white';
};

const getScoreColorClass = (score) => {
    if (score >= 80) return 'text-green-600';
    if (score >= 60) return 'text-yellow-600';
    return 'text-red-600';
};

const getScoreBackgroundClass = (score) => {
    if (score >= 80) return 'bg-green-500';
    if (score >= 60) return 'bg-yellow-500';
    return 'bg-red-500';
};

const getCertReadinessColor = (readiness) => {
    if (readiness >= 80) return 'bg-green-500';
    if (readiness >= 60) return 'bg-yellow-500';
    return 'bg-red-500';
};

const downloadReport = () => {
    // Open PDF download in new window
    const downloadUrl = typeof route !== 'undefined' 
        ? route('assessments.diagnostics.download', props.diagnostic.id) 
        : `/assessments/diagnostics/${props.diagnostic.id}/download`;
    window.open(downloadUrl, '_blank');
};
</script>

<style scoped>
/* Custom animations for the heatmap */
.group:hover > div:first-child {
    transform: scale(1.05);
}
</style>