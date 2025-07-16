<template>
    <div class="min-h-screen flex flex-col bg-gray-50 dark:bg-gray-900">
        <!-- Header -->
        <div class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 px-4 sm:px-6 lg:px-8 py-4">
            <div class="max-w-7xl mx-auto">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                            Diagnostic Assessment
                        </h1>
                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                            {{ modeConfig.name }} Mode - {{ diagnostic?.total_questions }} questions
                        </p>
                    </div>
                    
                    <div class="flex items-center gap-4">
                        <!-- Timer -->
                        <div class="flex items-center gap-2">
                            <ClockIcon class="w-5 h-5 text-gray-500 dark:text-gray-400" />
                            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">
                                {{ formatTime(elapsedTime) }}
                            </span>
                        </div>
                        
                        <!-- Progress -->
                        <div class="flex items-center gap-2">
                            <span class="text-sm text-gray-600 dark:text-gray-400">
                                {{ currentQuestionNumber }} / {{ diagnostic?.total_questions }}
                            </span>
                        </div>
                    </div>
                </div>
                
                <!-- Progress Bar -->
                <div class="mt-4">
                    <div class="bg-gray-200 dark:bg-gray-700 rounded-full h-2 overflow-hidden">
                        <div 
                            class="bg-blue-600 h-full transition-all duration-300"
                            :style="{ width: `${progressPercentage}%` }"
                        ></div>
                    </div>
                </div>
                
                <!-- Domain Coverage -->
                <div v-if="domainCoverage.length > 0" class="mt-3 flex flex-wrap gap-2">
                    <div 
                        v-for="domain in domainCoverage" 
                        :key="domain.id"
                        class="inline-flex items-center gap-1 px-2 py-1 rounded-md text-xs bg-gray-100 dark:bg-gray-700"
                    >
                        <span :class="[
                            'w-2 h-2 rounded-full',
                            domain.questions > 0 ? 'bg-green-500' : 'bg-gray-400'
                        ]"></span>
                        <span class="text-gray-700 dark:text-gray-300">
                            {{ domain.name }} ({{ domain.questions }})
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 py-8">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Loading State -->
                <div v-if="loading" class="flex items-center justify-center py-12">
                    <div class="text-center">
                        <Spinner class="w-8 h-8 mx-auto mb-4" />
                        <p class="text-gray-600 dark:text-gray-400">Loading question...</p>
                    </div>
                </div>

                <!-- Question Display -->
                <div v-else-if="currentQuestion" class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
                    <!-- Bloom Level & Difficulty -->
                    <div class="flex items-center gap-4 mb-4">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                            Level {{ currentQuestion.bloom_level }}
                        </span>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-200">
                            {{ getDifficultyLabel(currentQuestion.difficulty) }}
                        </span>
                    </div>

                    <!-- Question Content -->
                    <div class="mb-6">
                        <h2 class="text-lg font-medium text-gray-900 dark:text-white mb-4">
                            {{ currentQuestion.content }}
                        </h2>
                    </div>

                    <!-- Answer Options -->
                    <div class="space-y-3">
                        <label
                            v-for="(option, index) in currentQuestion.options"
                            :key="index"
                            class="relative flex items-start p-4 border rounded-lg cursor-pointer transition-all"
                            :class="[
                                selectedAnswer === index
                                    ? 'border-blue-500 bg-blue-50 dark:bg-blue-900/20'
                                    : 'border-gray-300 dark:border-gray-600 hover:border-gray-400 dark:hover:border-gray-500'
                            ]"
                        >
                            <input
                                type="radio"
                                :value="index"
                                v-model="selectedAnswer"
                                class="sr-only"
                            />
                            <div class="flex items-center">
                                <div :class="[
                                    'w-4 h-4 rounded-full border-2 mr-3',
                                    selectedAnswer === index
                                        ? 'border-blue-500 bg-blue-500'
                                        : 'border-gray-400 dark:border-gray-500'
                                ]">
                                    <div v-if="selectedAnswer === index" class="w-2 h-2 bg-white rounded-full m-0.5"></div>
                                </div>
                                <span class="text-gray-900 dark:text-gray-100">{{ option }}</span>
                            </div>
                        </label>
                    </div>

                    <!-- Action Buttons -->
                    <div class="mt-6 flex justify-between">
                        <button
                            @click="pauseAssessment"
                            class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-gray-100"
                        >
                            Pause Assessment
                        </button>
                        
                        <button
                            @click="submitAnswer"
                            :disabled="selectedAnswer === null || submitting"
                            class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 disabled:opacity-50 disabled:cursor-not-allowed transition-colors"
                        >
                            {{ submitting ? 'Submitting...' : 'Submit Answer' }}
                        </button>
                    </div>
                </div>

                <!-- Completion State -->
                <div v-else-if="completed" class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-8 text-center">
                    <CheckCircleIcon class="w-16 h-16 text-green-500 mx-auto mb-4" />
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">
                        Assessment Complete!
                    </h2>
                    <p class="text-gray-600 dark:text-gray-400 mb-6">
                        Your diagnostic results are being processed...
                    </p>
                    
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <Link
                            :href="route('diagnostics.results', diagnostic.id)"
                            class="inline-flex items-center justify-center px-6 py-3 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors"
                        >
                            View Results
                        </Link>
                        <button
                            @click="downloadReport('pdf')"
                            class="inline-flex items-center justify-center px-6 py-3 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 rounded-md hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors"
                        >
                            <DocumentArrowDownIcon class="w-5 h-5 mr-2" />
                            Download Report
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, computed, onMounted, onUnmounted } from 'vue';
import { router } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3';
import axios from 'axios';
import { 
    ClockIcon, 
    CheckCircleIcon,
    DocumentArrowDownIcon 
} from '@heroicons/vue/24/outline';

const props = defineProps({
    mode: {
        type: String,
        required: true
    },
    diagnosticId: {
        type: String,
        default: null
    }
});

// State
const diagnostic = ref(null);
const currentQuestion = ref(null);
const selectedAnswer = ref(null);
const loading = ref(false);
const submitting = ref(false);
const completed = ref(false);
const elapsedTime = ref(0);
const questionStartTime = ref(null);
const timer = ref(null);
const currentQuestionNumber = ref(0);
const domainCoverage = ref([]);

// Mode configurations
const modeConfigs = {
    quick: {
        name: 'Quick',
        questions: 20,
        timeLimit: 900
    },
    standard: {
        name: 'Standard',
        questions: 40,
        timeLimit: 1800
    },
    comprehensive: {
        name: 'Comprehensive',
        questions: 60,
        timeLimit: 2700
    }
};

// Computed
const modeConfig = computed(() => modeConfigs[props.mode] || modeConfigs.standard);

const progressPercentage = computed(() => {
    if (!diagnostic.value) return 0;
    return Math.round((currentQuestionNumber.value / diagnostic.value.total_questions) * 100);
});

const formatTime = (seconds) => {
    const mins = Math.floor(seconds / 60);
    const secs = seconds % 60;
    return `${mins}:${secs.toString().padStart(2, '0')}`;
};

const getDifficultyLabel = (level) => {
    const labels = {
        1: 'Beginner',
        2: 'Intermediate',
        3: 'Advanced'
    };
    return labels[level] || 'Unknown';
};

// Methods
const startDiagnostic = async () => {
    try {
        loading.value = true;
        const response = await axios.post('/api/assessments/diagnostics/start', {
            mode: props.mode
        });
        
        diagnostic.value = response.data.diagnostic;
        
        // Start timer
        startTimer();
        
        // Get first question
        await getNextQuestion();
    } catch (error) {
        console.error('Failed to start diagnostic:', error);
        // Handle error - show notification
    } finally {
        loading.value = false;
    }
};

const getNextQuestion = async () => {
    try {
        loading.value = true;
        selectedAnswer.value = null;
        
        const response = await axios.get(`/api/assessments/diagnostics/${diagnostic.value.id}/next-question`);
        
        if (response.data.status === 'completed') {
            completed.value = true;
            stopTimer();
        } else {
            currentQuestion.value = response.data.question;
            currentQuestionNumber.value = response.data.progress.current;
            questionStartTime.value = Date.now();
            
            // Update domain coverage
            updateDomainCoverage(response.data.state);
        }
    } catch (error) {
        console.error('Failed to get next question:', error);
    } finally {
        loading.value = false;
    }
};

const submitAnswer = async () => {
    if (selectedAnswer.value === null || submitting.value) return;
    
    try {
        submitting.value = true;
        
        const timeTaken = Math.round((Date.now() - questionStartTime.value) / 1000);
        
        const response = await axios.post(`/api/assessments/diagnostics/${diagnostic.value.id}/answer`, {
            question_id: currentQuestion.value.id,
            answer: selectedAnswer.value,
            time_taken: timeTaken
        });
        
        if (response.data.status === 'completed') {
            completed.value = true;
            stopTimer();
        } else {
            // Get next question
            await getNextQuestion();
        }
    } catch (error) {
        console.error('Failed to submit answer:', error);
    } finally {
        submitting.value = false;
    }
};

const pauseAssessment = () => {
    stopTimer();
    // Save current state and redirect
    router.visit(route('diagnostics.index'));
};

const downloadReport = async (format) => {
    try {
        const response = await axios.get(`/api/assessments/diagnostics/${diagnostic.value.id}/report`, {
            params: { format }
        });
        
        if (format === 'pdf') {
            window.open(response.data.url, '_blank');
        }
    } catch (error) {
        console.error('Failed to download report:', error);
    }
};

const updateDomainCoverage = (state) => {
    if (!state.domains_covered) return;
    
    // This would be populated from actual domain data
    domainCoverage.value = Object.entries(state.domain_question_counts || {}).map(([id, count]) => ({
        id,
        name: `Domain ${id}`, // Would get actual name from props or API
        questions: count
    }));
};

// Timer functions
const startTimer = () => {
    timer.value = setInterval(() => {
        elapsedTime.value++;
    }, 1000);
};

const stopTimer = () => {
    if (timer.value) {
        clearInterval(timer.value);
        timer.value = null;
    }
};

// Lifecycle
onMounted(() => {
    if (props.diagnosticId) {
        // Resume existing diagnostic
        // Load state from API
    } else {
        // Start new diagnostic
        startDiagnostic();
    }
});

onUnmounted(() => {
    stopTimer();
});
</script>