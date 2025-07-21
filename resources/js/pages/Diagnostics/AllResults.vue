<template>
    <AppLayout title="Diagnostic Results">
        <div class="min-h-screen bg-gray-50 dark:bg-gray-900">
            <!-- Header -->
            <div class="bg-white dark:bg-gray-800 shadow-xs">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100">
                        Diagnostic Assessment Results
                    </h1>
                    <p class="mt-2 text-gray-600 dark:text-gray-400">
                        Track your progress through all four assessment phases
                    </p>
                </div>
            </div>

            <!-- Phase Cards Grid -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <!-- 4 Phase Cards in a Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <div v-for="phase in 4" :key="phase" 
                         class="bg-white dark:bg-gray-800 rounded-lg shadow-xs overflow-hidden hover:shadow-lg transition-all cursor-pointer border-2"
                         :class="selectedPhase === phase ? 'border-indigo-500 shadow-lg' : 'border-transparent'"
                         @click="selectedPhase = phase">
                        <!-- Phase Card Header -->
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center">
                                    <div 
                                        class="w-10 h-10 rounded-full flex items-center justify-center font-bold text-lg"
                                        :class="getPhaseIconClass(phase)"
                                    >
                                        <CheckIcon v-if="phases[phase]?.completed" class="w-6 h-6 text-white" />
                                        <LockIcon v-else-if="phases[phase]?.locked" class="w-5 h-5 text-gray-500" />
                                        <span v-else>{{ phase }}</span>
                                    </div>
                                    <span class="ml-3 text-sm font-medium text-gray-500 dark:text-gray-400">
                                        Phase {{ phase }}
                                    </span>
                                </div>
                                <div v-if="phases[phase]?.completed">
                                    <CheckCircleIcon class="w-5 h-5 text-green-500" />
                                </div>
                            </div>
                            
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-2">
                                {{ phases[phase]?.name || `Phase ${phase}` }}
                            </h3>
                            
                            <!-- Score or Status -->
                            <div v-if="phases[phase]?.completed" class="mb-4">
                                <div class="text-3xl font-bold" :class="getScoreColorClass(phases[phase].score)">
                                    {{ phases[phase].score }}%
                                </div>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Score</p>
                            </div>
                            <div v-else-if="phases[phase]?.attempts.length > 0" class="mb-4">
                                <div class="text-2xl font-semibold text-yellow-600 dark:text-yellow-400">
                                    In Progress
                                </div>
                                <p class="text-sm text-gray-600 dark:text-gray-400">
                                    {{ phases[phase].attempts[0].questions_answered }} questions answered
                                </p>
                            </div>
                            <div v-else-if="phases[phase]?.locked" class="mb-4">
                                <div class="text-lg font-medium text-gray-400">
                                    Locked
                                </div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                    Complete Phase {{ phase - 1 }} first
                                </p>
                            </div>
                            <div v-else class="mb-4">
                                <div class="text-lg font-medium text-indigo-600 dark:text-indigo-400">
                                    Ready to Start
                                </div>
                                <p class="text-sm text-gray-600 dark:text-gray-400">
                                    Begin assessment
                                </p>
                            </div>
                            
                            <!-- CTA Button -->
                            <div class="mt-4">
                                <button
                                    v-if="phases[phase]?.completed"
                                    @click="selectedPhase = phase"
                                    class="w-full inline-flex justify-center items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300 font-medium rounded-lg transition-colors"
                                >
                                    View Details
                                </button>
                                <Link 
                                    v-else-if="phases[phase]?.attempts.length > 0"
                                    :href="route('assessments.diagnostics.show', phases[phase].attempts[0].id)"
                                    class="w-full inline-flex justify-center items-center px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white font-medium rounded-lg transition-colors"
                                >
                                    Continue
                                </Link>
                                <button
                                    v-else-if="phases[phase]?.locked"
                                    disabled
                                    class="w-full px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-400 font-medium rounded-lg cursor-not-allowed"
                                >
                                    <LockIcon class="w-4 h-4 inline mr-2" />
                                    Locked
                                </button>
                                <Link 
                                    v-else
                                    :href="route('assessments.diagnostics.start', { phase: phase })"
                                    class="w-full inline-flex justify-center items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg transition-colors"
                                >
                                    <RocketIcon class="w-4 h-4 mr-2" />
                                    Start Phase {{ phase }}
                                </Link>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Overall Progress Bar -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xs p-6 mb-8">
                    <div class="flex items-center justify-between mb-2">
                        <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                            Overall Progress
                        </h2>
                        <span class="text-sm text-gray-600 dark:text-gray-400">
                            {{ completedPhasesCount }}/4 Phases Complete
                        </span>
                    </div>
                    <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-3">
                        <div 
                            class="h-3 bg-linear-to-r from-indigo-500 to-purple-600 rounded-full transition-all duration-500"
                            :style="{ width: `${(completedPhasesCount / 4) * 100}%` }"
                        ></div>
                    </div>
                </div>

                <!-- Phase Results -->
                <div class="space-y-6">
                    <div v-for="phase in 4" :key="phase" class="bg-white dark:bg-gray-800 rounded-lg shadow-xs overflow-hidden">
                        <!-- Phase Header -->
                        <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100">
                                        Phase {{ phase }}: {{ phases[phase]?.name || 'Loading...' }}
                                    </h3>
                                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                        {{ phases[phase]?.description || '' }}
                                    </p>
                                </div>
                                <div v-if="phases[phase]?.completed" class="text-right">
                                    <div class="text-3xl font-bold" :class="getScoreColorClass(phases[phase].score)">
                                        {{ phases[phase].score }}%
                                    </div>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Score</p>
                                </div>
                            </div>
                        </div>

                        <!-- Phase Content -->
                        <div class="p-6">
                            <!-- Completed Phase -->
                            <div v-if="phases[phase] && phases[phase].attempts.length > 0">
                                <!-- Attempt Selector (if multiple) -->
                                <div v-if="phases[phase].attempts.length > 1" class="mb-6">
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        Select Attempt
                                    </label>
                                    <select 
                                        v-model="selectedAttempts[phase]"
                                        @change="changeAttempt(phase, $event.target.value)"
                                        class="w-full md:w-auto px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-indigo-500"
                                    >
                                        <option 
                                            v-for="attempt in phases[phase].attempts" 
                                            :key="attempt.id"
                                            :value="attempt.id"
                                        >
                                            {{ attempt.date }} - Score: {{ attempt.score }}% {{ attempt.is_latest ? '(Latest)' : '' }}
                                        </option>
                                    </select>
                                </div>

                                <!-- Domain Performance -->
                                <div v-if="phases[phase].domain_performance.length > 0" class="space-y-4">
                                    <h4 class="font-medium text-gray-900 dark:text-gray-100">Domain Performance</h4>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div 
                                            v-for="domain in phases[phase].domain_performance" 
                                            :key="domain.name"
                                            class="relative"
                                        >
                                            <div class="flex justify-between items-center mb-2">
                                                <span class="text-sm font-medium text-gray-700 dark:text-gray-300">
                                                    {{ domain.name }}
                                                </span>
                                                <span class="text-sm font-bold" :class="getScoreColorClass(domain.score)">
                                                    {{ domain.score }}%
                                                </span>
                                            </div>
                                            <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-3">
                                                <div 
                                                    class="h-3 rounded-full transition-all duration-500"
                                                    :class="getScoreBackgroundClass(domain.score)"
                                                    :style="{ width: `${domain.score}%` }"
                                                ></div>
                                            </div>
                                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                                {{ domain.correct }}/{{ domain.total }} correct
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Summary Stats -->
                                <div class="grid grid-cols-3 gap-4 mt-6">
                                    <div class="text-center p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                        <div class="text-2xl font-bold text-gray-900 dark:text-gray-100">
                                            {{ phases[phase].selected_attempt.total_questions }}
                                        </div>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">Questions</p>
                                    </div>
                                    <div class="text-center p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                        <div class="text-2xl font-bold text-green-600 dark:text-green-400">
                                            {{ phases[phase].selected_attempt.correct_count }}
                                        </div>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">Correct</p>
                                    </div>
                                    <div class="text-center p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                        <div class="text-2xl font-bold text-blue-600 dark:text-blue-400">
                                            {{ formatDuration(phases[phase].selected_attempt.duration) }}
                                        </div>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">Duration</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Not Started/Locked Phase -->
                            <div v-else class="text-center py-12">
                                <div v-if="phases[phase]?.locked" class="max-w-sm mx-auto">
                                    <LockIcon class="w-16 h-16 text-gray-400 dark:text-gray-600 mx-auto mb-4" />
                                    <h4 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-2">
                                        Phase Locked
                                    </h4>
                                    <p class="text-gray-600 dark:text-gray-400 mb-6">
                                        Complete Phase {{ phase - 1 }} to unlock this assessment
                                    </p>
                                    <button 
                                        disabled
                                        class="px-6 py-3 bg-gray-300 dark:bg-gray-700 text-gray-500 dark:text-gray-500 font-semibold rounded-lg cursor-not-allowed"
                                    >
                                        <LockIcon class="w-5 h-5 inline-block mr-2" />
                                        Locked
                                    </button>
                                </div>
                                <div v-else class="max-w-sm mx-auto">
                                    <RocketIcon class="w-16 h-16 text-indigo-600 dark:text-indigo-400 mx-auto mb-4" />
                                    <h4 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-2">
                                        Ready to Start Phase {{ phase }}
                                    </h4>
                                    <p class="text-gray-600 dark:text-gray-400 mb-6">
                                        {{ phase === 1 ? 'Begin your cybersecurity assessment journey' : 
                                           `You've completed Phase ${phase - 1}. Ready for the next challenge?` }}
                                    </p>
                                    <Link 
                                        :href="route('assessments.diagnostics.start', { phase: phase })"
                                        class="inline-flex items-center px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg shadow-md transition-all duration-200 transform hover:scale-105"
                                    >
                                        <RocketIcon class="w-5 h-5 mr-2" />
                                        Start Phase {{ phase }}
                                    </Link>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Career Recommendations (when all phases completed) -->
                <div v-if="all_phases_completed && career_recommendations" class="mt-8 bg-white dark:bg-gray-800 rounded-lg shadow-xs p-6">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-6">
                        Career Path Recommendations
                    </h2>
                    
                    <!-- Overall Readiness -->
                    <div class="mb-8 text-center">
                        <div class="inline-flex items-center justify-center w-32 h-32 rounded-full bg-linear-to-br from-indigo-500 to-purple-600 text-white mb-4">
                            <span class="text-3xl font-bold">{{ Math.round(career_recommendations.overall_readiness) }}%</span>
                        </div>
                        <p class="text-lg text-gray-700 dark:text-gray-300">Overall Career Readiness</p>
                    </div>

                    <!-- Recommended Career Paths -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                        <div 
                            v-for="path in career_recommendations.career_paths" 
                            :key="path.title"
                            class="border border-gray-200 dark:border-gray-700 rounded-lg p-6 hover:shadow-lg transition-shadow"
                        >
                            <div class="flex justify-between items-start mb-4">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                                    {{ path.title }}
                                </h3>
                                <span class="text-sm font-bold text-green-600 dark:text-green-400">
                                    {{ path.match }} match
                                </span>
                            </div>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
                                {{ path.description }}
                            </p>
                            <div class="space-y-2">
                                <p class="text-xs font-medium text-gray-700 dark:text-gray-300">Next Steps:</p>
                                <ul class="text-xs text-gray-600 dark:text-gray-400 space-y-1">
                                    <li v-for="step in path.next_steps" :key="step" class="flex items-start">
                                        <CheckIcon class="w-3 h-3 text-green-500 mr-1 mt-0.5 shrink-0" />
                                        {{ step }}
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Strengths & Improvements -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="font-semibold text-gray-900 dark:text-gray-100 mb-3">
                                Your Strengths
                            </h3>
                            <div class="space-y-2">
                                <div 
                                    v-for="strength in career_recommendations.strengths" 
                                    :key="strength"
                                    class="flex items-center"
                                >
                                    <CheckCircleIcon class="w-5 h-5 text-green-500 mr-2" />
                                    <span class="text-sm text-gray-700 dark:text-gray-300">{{ strength }}</span>
                                </div>
                            </div>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-900 dark:text-gray-100 mb-3">
                                Areas for Improvement
                            </h3>
                            <div class="space-y-2">
                                <div 
                                    v-for="area in career_recommendations.improvement_areas" 
                                    :key="area"
                                    class="flex items-center"
                                >
                                    <AlertCircleIcon class="w-5 h-5 text-yellow-500 mr-2" />
                                    <span class="text-sm text-gray-700 dark:text-gray-300">{{ area }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recommended Certifications -->
                    <div class="mt-6 pt-6 border-t border-gray-200 dark:border-gray-700">
                        <h3 class="font-semibold text-gray-900 dark:text-gray-100 mb-3">
                            Recommended Certifications
                        </h3>
                        <div class="flex flex-wrap gap-2">
                            <span 
                                v-for="cert in career_recommendations.recommended_certifications" 
                                :key="cert"
                                class="px-3 py-1 bg-indigo-100 dark:bg-indigo-900 text-indigo-700 dark:text-indigo-300 text-sm rounded-full"
                            >
                                {{ cert }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Career Recommendations Placeholder (incomplete) -->
                <div v-else-if="!all_phases_completed" class="mt-8 bg-gray-100 dark:bg-gray-800 rounded-lg p-8 text-center">
                    <GraduationCapIcon class="w-16 h-16 text-gray-400 dark:text-gray-600 mx-auto mb-4" />
                    <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-2">
                        Career Recommendations Locked
                    </h3>
                    <p class="text-gray-600 dark:text-gray-400">
                        Complete all four assessment phases to unlock personalized career path recommendations
                    </p>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup lang="ts">
import { computed, ref } from 'vue';
import { Link } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import { 
    CheckIcon, 
    LockIcon, 
    RocketIcon,
    CheckCircleIcon,
    AlertCircleIcon,
    GraduationCapIcon
} from 'lucide-vue-next';

const props = defineProps({
    phases: Object,
    all_phases_completed: Boolean,
    career_recommendations: Object
});

// Debug: Log received data
console.log('AllResults received phases:', props.phases);
console.log('Phase keys:', Object.keys(props.phases));

// Track selected attempts for each phase
const selectedAttempts = ref({});

// Initialize selected phase to first completed or available phase
const getInitialSelectedPhase = () => {
    // First try to find a completed phase
    for (let i = 1; i <= 4; i++) {
        if (props.phases[i]?.completed) return i;
    }
    // Then try to find an in-progress phase
    for (let i = 1; i <= 4; i++) {
        if (props.phases[i]?.attempts.length > 0) return i;
    }
    // Finally, find the first unlocked phase
    for (let i = 1; i <= 4; i++) {
        if (props.phases[i] && !props.phases[i].locked) return i;
    }
    return 1;
};

const selectedPhase = ref(getInitialSelectedPhase());

// Initialize selected attempts
Object.keys(props.phases).forEach(phaseNum => {
    const phase = props.phases[phaseNum];
    if (phase.attempts.length > 0) {
        selectedAttempts.value[phaseNum] = phase.attempts.find(a => a.is_latest)?.id || phase.attempts[0].id;
    }
});

// Computed property for completed phases count
const completedPhasesCount = computed(() => {
    return Object.values(props.phases).filter(phase => phase.completed).length;
});

// Helper functions
const getPhaseIconClass = (phaseNum) => {
    const phase = props.phases[phaseNum];
    if (!phase) return 'bg-gray-300 dark:bg-gray-600 text-gray-500';
    if (phase.completed) return 'bg-green-500 text-white';
    if (phase.attempts.length > 0) return 'bg-yellow-500 text-white';
    if (phase.locked) return 'bg-gray-300 dark:bg-gray-600 text-gray-500';
    return 'bg-indigo-500 text-white';
};

const getScoreColorClass = (score) => {
    if (score >= 80) return 'text-green-600 dark:text-green-400';
    if (score >= 60) return 'text-yellow-600 dark:text-yellow-400';
    return 'text-red-600 dark:text-red-400';
};

const getScoreBackgroundClass = (score) => {
    if (score >= 80) return 'bg-green-500';
    if (score >= 60) return 'bg-yellow-500';
    return 'bg-red-500';
};

const formatDuration = (seconds) => {
    if (!seconds) return '0:00';
    const hours = Math.floor(seconds / 3600);
    const minutes = Math.floor((seconds % 3600) / 60);
    const secs = seconds % 60;
    
    if (hours > 0) {
        return `${hours}:${minutes.toString().padStart(2, '0')}:${secs.toString().padStart(2, '0')}`;
    }
    return `${minutes}:${secs.toString().padStart(2, '0')}`;
};

const changeAttempt = (phase, attemptId) => {
    // In a real implementation, this would fetch the data for the selected attempt
    // For now, we'll just track the selection
    console.log(`Changed phase ${phase} to attempt ${attemptId}`);
};
</script>