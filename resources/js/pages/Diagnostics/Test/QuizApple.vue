<template>
    <div class="min-h-screen flex flex-col bg-gray-200 dark:bg-gray-900">
        <!-- Refined Top Bar - Cleaner, more focused -->
        <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-xl border-b border-gray-200/50 dark:border-gray-700/50">
            <div class="px-6 py-4">
                <div class="flex items-center justify-between">
                    <!-- Left: Title and Phase -->
                    <div class="flex-1">
                        <h1 class="text-lg font-semibold text-gray-900 dark:text-white">
                            Diagnostic Assessment
                        </h1>
                        <div class="flex items-center gap-2 mt-1">
                            <span class="text-sm text-gray-500 dark:text-gray-400">
                                {{ currentPhaseData.name }}
                            </span>
                            <span class="text-gray-300 dark:text-gray-600">•</span>
                            <span class="text-sm font-medium text-blue-600 dark:text-blue-400">
                                {{ overallConfidence }}% confidence
                            </span>
                        </div>
                    </div>
                    
                    <!-- Right: Timer and Actions -->
                    <div class="flex items-center gap-3">
                        <!-- Timer - Subtle design -->
                        <div class="flex items-center gap-4 px-4 py-2 bg-gray-100 dark:bg-gray-700 rounded-full">
                            <div class="flex items-center gap-2">
                                <span class="text-xs text-gray-500 dark:text-gray-400">Question</span>
                                <span class="font-mono text-sm font-medium text-gray-700 dark:text-gray-300">
                                    {{ formatTime(questionTime) }}
                                </span>
                            </div>
                            <div class="w-px h-4 bg-gray-300 dark:bg-gray-600"></div>
                            <div class="flex items-center gap-2">
                                <span class="text-xs text-gray-500 dark:text-gray-400">Total</span>
                                <span class="font-mono text-sm font-medium text-gray-700 dark:text-gray-300">
                                    {{ formatTime(totalTime) }}
                                </span>
                            </div>
                        </div>
                        
                        <!-- Theme Toggle - iOS style -->
                        <button
                            @click="toggleTheme"
                            class="relative inline-flex h-7 w-12 items-center rounded-full transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                            :class="isDark ? 'bg-blue-600' : 'bg-gray-300'"
                            aria-label="Toggle theme"
                        >
                            <span
                                class="inline-block h-5 w-5 transform rounded-full bg-white shadow transition-transform"
                                :class="isDark ? 'translate-x-6' : 'translate-x-1'"
                            >
                                <SunIcon v-if="!isDark" class="h-5 w-5 p-1 text-yellow-500" />
                                <MoonIcon v-else class="h-5 w-5 p-1 text-gray-700" />
                            </span>
                        </button>
                        
                        <!-- Pause Button - Red accent -->
                        <button
                            @click="pauseTest"
                            class="px-4 py-2 text-sm font-medium text-red-600 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300 transition-colors"
                        >
                            Pause Test
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Progress Bar - Integrated into header -->
            <div class="px-6 pb-4">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-sm font-medium text-gray-700 dark:text-gray-300">
                        <template v-if="totalQuestions">
                            Question {{ currentQuestionNumber }} of {{ totalQuestions }}
                        </template>
                        <template v-else>
                            Q{{ currentQuestionNumber }} • {{ diagnostic?.current_domain || 'Assessment' }}
                        </template>
                    </span>
                    <span class="text-sm text-gray-500 dark:text-gray-400">
                        <template v-if="diagnostic?.phases_total">
                            Phase {{ diagnostic.current_phase || 1 }} of {{ diagnostic.phases_total }} • {{ Math.round(progress) }}% Complete
                        </template>
                        <template v-else>
                            {{ Math.round(progress) }}% Complete
                        </template>
                    </span>
                </div>
                <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2 overflow-hidden">
                    <div 
                        class="h-full bg-gradient-to-r from-blue-500 to-blue-600 rounded-full transition-all duration-500 ease-out"
                        :style="{ width: `${progress}%` }"
                    ></div>
                </div>
                
                <!-- Domain Pills - Clean tags -->
                <div v-if="currentMilestoneDomains.length > 0" class="flex items-center gap-2 mt-3 flex-wrap">
                    <span 
                        v-for="domain in currentMilestoneDomains" 
                        :key="domain.id"
                        class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-medium transition-colors"
                        :class="getDomainStatusClasses(domain.id)"
                    >
                        <span class="w-1.5 h-1.5 rounded-full" :class="getDomainDotClasses(domain.id)"></span>
                        {{ domain.name }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Main Content Area - Clean layout -->
        <div class="flex-1 px-6 py-8">
            <div class="max-w-6xl mx-auto">
                <div class="max-w-4xl mx-auto">
                    <!-- Question Card - Primary focus -->
                    <div>
                        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200/50 dark:border-gray-700/50 overflow-hidden">
                            <div class="p-8">
                                <!-- Question Content using QuizTypes -->
                                <div v-if="currentQuestionData">
                                    <component
                                        :is="currentQuestionComponent"
                                        :question="currentQuestionData"
                                        :answer="currentAnswer"
                                        :isDarkMode="isDark"
                                        @selected="handleSelection"
                                    />
                                </div>
                                
                                <!-- Loading State -->
                                <div v-else class="flex items-center justify-center h-64">
                                    <div class="text-center">
                                        <div class="inline-flex items-center justify-center w-12 h-12 bg-gray-100 dark:bg-gray-700 rounded-full mb-4">
                                            <svg class="animate-spin h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24">
                                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                            </svg>
                                        </div>
                                        <p class="text-gray-500 dark:text-gray-400">Loading question...</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Bottom Action Bar - Floating design -->
        <div class="fixed bottom-0 left-0 right-0 bg-white/80 dark:bg-gray-800/80 backdrop-blur-xl border-t border-gray-200/50 dark:border-gray-700/50">
            <div class="px-6 py-4">
                <div class="max-w-6xl mx-auto flex justify-end">
                    <button
                        @click="submitAnswer"
                        :disabled="!hasSelection"
                        class="px-8 py-3 rounded-full font-medium transition-all transform"
                        :class="[
                            hasSelection 
                                ? 'bg-blue-600 hover:bg-blue-700 text-white shadow-lg hover:shadow-xl active:scale-95 cursor-pointer' 
                                : 'bg-gray-300 dark:bg-gray-600 text-gray-500 dark:text-gray-400 cursor-not-allowed opacity-60',
                            !hasSelection && 'pointer-events-none'
                        ]"
                    >
                        {{ isLastQuestion ? 'Complete Assessment' : 'Submit Answer' }}
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Modals - Clean, minimal design -->
        <TransitionRoot appear :show="showPauseModal" as="template">
            <DialogComponent as="div" @close="showPauseModal = false" class="relative z-50">
                <TransitionChild
                    as="template"
                    enter="duration-300 ease-out"
                    enter-from="opacity-0"
                    enter-to="opacity-100"
                    leave="duration-200 ease-in"
                    leave-from="opacity-100"
                    leave-to="opacity-0"
                >
                    <div class="fixed inset-0 bg-black/30 backdrop-blur-sm" />
                </TransitionChild>

                <div class="fixed inset-0 overflow-y-auto">
                    <div class="flex min-h-full items-center justify-center p-4">
                        <TransitionChild
                            as="template"
                            enter="duration-300 ease-out"
                            enter-from="opacity-0 scale-95"
                            enter-to="opacity-100 scale-100"
                            leave="duration-200 ease-in"
                            leave-from="opacity-100 scale-100"
                            leave-to="opacity-0 scale-95"
                        >
                            <DialogComponentPanel class="w-full max-w-md transform overflow-hidden rounded-2xl bg-white dark:bg-gray-800 p-6 shadow-xl transition-all">
                                <DialogComponentTitle as="h3" class="text-lg font-semibold text-gray-900 dark:text-white mb-2">
                                    Pause Assessment?
                                </DialogTitle>
                                <p class="text-sm text-gray-500 dark:text-gray-400 mb-6">
                                    You can resume this assessment later from where you left off.
                                </p>
                                <div class="flex gap-3 justify-end">
                                    <button
                                        @click="showPauseModal = false"
                                        class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-gray-100"
                                    >
                                        Continue Test
                                    </button>
                                    <button
                                        @click="confirmPause"
                                        class="px-4 py-2 text-sm font-medium bg-red-600 hover:bg-red-700 text-white rounded-lg"
                                    >
                                        Pause & Exit
                                    </button>
                                </div>
                            </DialogPanel>
                        </TransitionChild>
                    </div>
                </div>
            </DialogComponent>
        </TransitionRoot>
    </div>
</template>

<script lang="ts">
import { ref, computed, onMounted, onUnmounted, watch } from 'vue'
import { Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot } from '@headlessui/vue'
import { SunIcon, MoonIcon } from '@heroicons/vue/24/outline'
import { QuestionMarkCircleIcon } from '@heroicons/vue/24/outline'
import { useTheme } from '@/composables/useTheme'
import { router } from '@inertiajs/vue3'
import Type1 from '@/components/QuizTypes/Type1.vue'
import Type2 from '@/components/QuizTypes/Type2.vue'
import Type3 from '@/components/QuizTypes/Type3.vue'
import Type4 from '@/components/QuizTypes/Type4.vue'
import Type5 from '@/components/QuizTypes/Type5.vue'
import Type5Apple from '@/components/QuizTypes/Type5Apple.vue'
import Type6 from '@/components/QuizTypes/Type6.vue'
import Type7 from '@/components/QuizTypes/Type7.vue'

export default {
    components: {
        Dialog,
        DialogPanel,
        DialogTitle,
        TransitionChild,
        TransitionRoot,
        SunIcon,
        MoonIcon,
        QuestionMarkCircleIcon,
        Type1,
        Type2,
        Type3,
        Type4,
        Type5,
        Type5Apple,
        Type6,
        Type7
    },
    props: {
        diagnostic: Object,
        question: Object,
        progress: Number,
        totalQuestions: Number,
        currentQuestionNumber: Number,
        domains: Array,
        milestoneConfig: Object
    },
    setup(props) {
        const { isDark, toggleTheme, setTheme } = useTheme()
        
        // Initialize dark theme immediately
        if (!localStorage.getItem('theme')) {
            setTheme('dark');
        }
        
        // Reactive data
        const selectedOptions = ref([])
        const selectedAnswer = ref(null) // For single choice (radio)
        const currentQuestionData = ref(props.question)
        const showPauseModal = ref(false)
        const showBloomHelp = ref(false)
        const questionTime = ref(0)
        const totalTime = ref(0)
        
        // Watch for prop changes to update reactive state
        watch(() => props.question, (newQuestion) => {
            if (newQuestion) {
                currentQuestionData.value = newQuestion
                // Clear previous selections when new question loads
                selectedOptions.value = []
                selectedAnswer.value = null
            }
        }, { deep: true })
        
        // Timer logic
        let questionTimer = null
        let totalTimer = null
        
        onMounted(() => {
            // Initialize theme - ensure dark theme is applied
            if (!localStorage.getItem('theme')) {
                // Apply dark theme as default
                localStorage.setItem('theme', 'dark');
            }
            
            // Always ensure the theme classes match the stored preference
            const currentStoredTheme = localStorage.getItem('theme') || 'dark';
            if (currentStoredTheme === 'dark') {
                document.documentElement.classList.add('dark');
                document.documentElement.classList.remove('light');
            } else {
                document.documentElement.classList.add('light');
                document.documentElement.classList.remove('dark');
            }
            
            // Start timers
            questionTimer = setInterval(() => {
                questionTime.value++
            }, 1000)
            
            totalTimer = setInterval(() => {
                totalTime.value++
            }, 1000)
        })
        
        onUnmounted(() => {
            // Clean up timers
            if (questionTimer) clearInterval(questionTimer)
            if (totalTimer) clearInterval(totalTimer)
        })
        
        // Computed properties
        const currentQuestionComponent = computed(() => {
            const typeId = currentQuestionData.value?.type_id || 1
            // Use Apple-designed Type5 component for matching questions
            if (typeId === 5) {
                return 'Type5Apple'
            }
            return `Type${typeId}`
        })
        
        const currentAnswer = computed(() => {
            // Always return an object that matches Type1's expected answer prop structure
            const selectedOptionsArray = currentQuestionData.value?.type_id === 2 
                ? selectedOptions.value 
                : (selectedAnswer.value !== null ? [selectedAnswer.value] : []);
            
            return {
                question_id: currentQuestionData.value?.id || null,
                selected_options: selectedOptionsArray,
                duration: 0,
                is_correct: false
            };
        })
        
        const hasSelection = computed(() => {
            if (!currentQuestionData.value) return false;
            
            if (currentQuestionData.value.type_id === 2) {
                // Multiple choice - check if array has items
                return Array.isArray(selectedOptions.value) && selectedOptions.value.length > 0;
            } else {
                // Single choice - check if value is not null/undefined/empty
                return selectedAnswer.value !== null && 
                       selectedAnswer.value !== undefined && 
                       selectedAnswer.value !== '';
            }
        })
        
        // Debug: Watch selection state changes (after hasSelection is defined)
        watch([selectedAnswer, selectedOptions, hasSelection], ([answer, options, hasSelectionValue]) => {
            console.log('Selection state changed:', {
                selectedAnswer: answer,
                selectedOptions: options,
                hasSelection: hasSelectionValue,
                questionType: currentQuestionData.value?.type_id
            });
        });
        
        const isLastQuestion = computed(() => {
            // Implementation
            return false
        })
        
        const currentPhaseData = computed(() => {
            return {
                name: 'Foundation',
                description: 'Core concepts'
            }
        })
        
        const overallConfidence = computed(() => {
            // Calculate confidence based on diagnostic data if available
            if (props.diagnostic?.score) {
                return Math.round(props.diagnostic.score);
            }
            
            // If diagnostic has responses data, use that
            if (props.diagnostic?.responses && Array.isArray(props.diagnostic.responses)) {
                const correctAnswers = props.diagnostic.responses.filter(response => response.is_correct).length;
                const totalAnswered = props.diagnostic.responses.length;
                
                if (totalAnswered === 0) return 0;
                
                const percentage = Math.round((correctAnswers / totalAnswered) * 100);
                return Math.min(100, Math.max(0, percentage));
            }
            
            // For in-progress diagnostics, show current question number as progress indicator
            if (props.currentQuestionNumber && props.currentQuestionNumber > 1) {
                // Simple confidence approximation based on progress
                // This is just a visual indicator, real confidence is calculated server-side
                return Math.min(85, Math.max(25, props.currentQuestionNumber * 2));
            }
            
            return 0;
        })
        
        const currentMilestoneDomains = computed(() => {
            return []
        })
        
        // Methods
        const formatTime = (seconds) => {
            const mins = Math.floor(seconds / 60)
            const secs = seconds % 60
            return `${mins.toString().padStart(2, '0')}:${secs.toString().padStart(2, '0')}`
        }
        
        const pauseTest = () => {
            showPauseModal.value = true
        }
        
        const confirmPause = async () => {
            showPauseModal.value = false
            // Redirect to results page
            const route_url = typeof route !== 'undefined' 
                ? route('assessments.diagnostics.results', props.diagnostic.id)
                : `/diagnostics/${props.diagnostic.id}/results`;
            router.visit(route_url)
        }
        
        const handleSelection = (selection) => {
            // QuizTypes component always emits arrays, so we handle both types the same way
            if (currentQuestionData.value?.type_id === 2) {
                // Multiple choice - selection is an array
                selectedOptions.value = Array.isArray(selection) ? selection : [selection]
            } else {
                // Single choice - selection is still an array from QuizTypes normalization
                selectedAnswer.value = Array.isArray(selection) ? selection[0] : selection
            }
        }
        
        const submitAnswer = async () => {
            // Comprehensive validation before submission
            if (!hasSelection.value) {
                console.warn('Submit blocked: No selection made');
                return;
            }
            
            if (!currentQuestionData.value) {
                console.warn('Submit blocked: No current question');
                return;
            }
            
            // Additional validation based on question type
            if (currentQuestionData.value.type_id === 2) {
                if (!Array.isArray(selectedOptions.value) || selectedOptions.value.length === 0) {
                    console.warn('Submit blocked: No options selected for multiple choice');
                    return;
                }
            } else {
                if (!selectedAnswer.value) {
                    console.warn('Submit blocked: No answer selected for single choice');
                    return;
                }
            }
            
            try {
                // Reset question timer for next question
                const currentQuestionTime = questionTime.value
                questionTime.value = 0
                
                // Prepare response data - send as array for consistency
                const userAnswer = currentQuestionData.value?.type_id === 2 
                    ? selectedOptions.value  // Array for multiple choice
                    : [selectedAnswer.value]; // Wrap single answer in array
                
                const responseData = {
                    selected_options: userAnswer,
                    response_time: currentQuestionTime,
                    diagnostic_item_id: currentQuestionData.value?.id
                }
                
                // Submit answer to backend using route helper
                console.log('Diagnostic ID:', props.diagnostic?.id)
                console.log('Response data:', responseData)
                
                const route_url = typeof route !== 'undefined' 
                    ? route('assessments.diagnostics.answer', props.diagnostic.id)
                    : `/assessments/diagnostics/${props.diagnostic.id}/answer`;
                
                console.log('Submitting to URL:', route_url)
                await router.post(route_url, responseData)
                
                // Selection will be cleared automatically by the watcher when new question loads
                
            } catch (error) {
                console.error('Error submitting answer:', error)
                // Handle error - maybe show a notification
            }
        }
        
        const getDifficultyLabel = () => {
            return currentQuestionData.value?.difficulty?.name || 'Medium'
        }
        
        const getDifficultyScore = () => {
            const scores = {
                'Very Easy': 1,
                'Easy': 2,
                'Medium': 3,
                'Hard': 4,
                'Very Hard': 5
            }
            return scores[getDifficultyLabel()] || 3
        }
        
        const getBloomLabel = () => {
            return currentQuestionData.value?.bloom?.level || 'Apply'
        }
        
        const getQuestionTypeName = () => {
            const types = {
                1: 'Single Choice',
                2: 'Multiple Choice',
                3: 'Fill in Blank',
                4: 'Ordering',
                5: 'Matching',
                6: 'Code Review',
                7: 'Terminal Command'
            }
            return types[currentQuestionData.value?.type_id] || 'Single Choice'
        }
        
        const getDomainStatusClasses = (domainId) => {
            // Implementation based on domain completion status
            return 'bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300'
        }
        
        const getDomainDotClasses = (domainId) => {
            // Implementation based on domain completion status
            return 'bg-gray-400'
        }
        
        return {
            isDark,
            toggleTheme,
            selectedOptions,
            selectedAnswer,
            currentQuestionData,
            showPauseModal,
            showBloomHelp,
            questionTime,
            totalTime,
            currentQuestionComponent,
            currentAnswer,
            hasSelection,
            isLastQuestion,
            currentPhaseData,
            overallConfidence,
            currentMilestoneDomains,
            formatTime,
            pauseTest,
            confirmPause,
            handleSelection,
            submitAnswer,
            getDifficultyLabel,
            getDifficultyScore,
            getBloomLabel,
            getQuestionTypeName,
            getDomainStatusClasses,
            getDomainDotClasses
        }
    }
}
</script>