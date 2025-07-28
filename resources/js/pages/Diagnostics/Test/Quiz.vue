<template>
    <div :class="[
        'min-h-screen flex flex-col',
        isDark ? 'bg-gray-900' : 'bg-gray-300'
    ]">
        <!-- Unified Header for All Screens -->
        <div :class="[
            'backdrop-blur-xl border-b flex items-center justify-between',
            'px-3 py-1.5 lg:px-6 lg:py-4',
            isDark 
                ? 'bg-gray-800/90 border-gray-700' 
                : 'bg-white/90 border-gray-200'
        ]">
            <!-- Left: Back Button + Question Progress -->
            <div :class="[
                'flex items-center',
                'space-x-3 lg:space-x-4'
            ]">
                <!-- Back Button -->
                <button @click="pauseTest" :class="[
                    'rounded-lg transition-colors',
                    'p-1 lg:p-2',
                    isDark 
                        ? 'hover:bg-gray-700 text-gray-300' 
                        : 'hover:bg-gray-100 text-gray-600'
                ]">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>
                
                <!-- Question Progress -->
                <div class="flex items-center space-x-1 lg:space-x-2">
                    <span :class="[
                        'font-semibold',
                        'text-base lg:text-lg',
                        isDark ? 'text-white' : 'text-gray-900'
                    ]">
                        Q{{ currentQuestionNumber }}
                    </span>
                    <span :class="[
                        'text-sm lg:hidden',
                        isDark ? 'text-gray-400' : 'text-gray-500'
                    ]">
                        <template v-if="totalQuestions">/{{ totalQuestions }}</template>
                    </span>
                </div>
            </div>
            
            <!-- Center: Progress Bar -->
            <div :class="[
                'flex-1 mx-4 lg:mx-8',
                'max-w-xs lg:max-w-md'
            ]">
                <div :class="[
                    'bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden',
                    'h-1 lg:h-2'
                ]">
                    <div class="h-full bg-blue-500 rounded-full transition-all duration-500 ease-out" 
                         :style="{ width: progress + '%' }">
                    </div>
                </div>
            </div>
            
            <!-- Right: Timer + Theme + Actions -->
            <div :class="[
                'flex items-center',
                'space-x-2 lg:space-x-3'
            ]">
                <!-- Unified Responsive Timer -->
                <QuizTimer 
                    :isReview="false" 
                    :isDark="isDark" 
                    @question-tick="onQuestionTick" 
                    ref="quizTimer"
                    displayMode="container"
                    widthClass="w-16 sm:w-28 lg:w-36"
                    heightClass="h-10"
                    fontSizeClass="text-sm"
                    :showLabels="false"
                    :showDivider="true"
                    :totalOnly="false"
                />
                
                <!-- Theme Toggle -->
                <button @click="() => toggleTheme(false)" :class="[
                    'flex items-center justify-center rounded-lg transition-colors',
                    'w-10 h-10 bg-gray-100 dark:bg-gray-700',
                    isDark 
                        ? 'hover:bg-gray-600 text-yellow-500' 
                        : 'hover:bg-gray-200 text-gray-600'
                ]">
                    <svg v-if="isDark" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    <svg v-else class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                    </svg>
                </button>
                
                <!-- Pause Test Button -->
                <button @click="pauseTest" :class="[
                    'rounded-lg font-medium transition-colors flex items-center',
                    'portrait:p-2 portrait:justify-center',
                    'landscape:px-3 landscape:py-2 landscape:gap-2',
                    'lg:px-4 lg:py-2 lg:gap-2',
                    isDark
                        ? 'bg-red-900/20 hover:bg-red-900/30 text-red-400 border border-red-800'
                        : 'bg-red-600/20 hover:bg-red-600/30 text-red-700 border border-red-700'
                ]">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 9v6m4-6v6" />
                    </svg>
                    <span class="text-sm portrait:hidden landscape:inline lg:inline">Pause Test</span>
                </button>
            </div>
        </div>

        <!-- Main Content Area - Responsive layout -->
        <div class="flex-1 px-2 sm:px-4 md:px-6 lg:px-6 py-4 lg:py-8 pb-24">
            <div class="max-w-6xl mx-auto">
                <div class="max-w-4xl mx-auto">
                    <!-- Question Content - Direct without wrapper card -->
                    <div v-if="currentQuestionData">
                        <component
                            :is="currentQuestionComponent"
                            :question="currentQuestionData"
                            :answer="currentAnswer"
                            :isDark="isDark"
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
        
        
        <!-- Bottom Action Bar - Always visible -->
        <div :class="[
            'fixed bottom-0 left-0 right-0 backdrop-blur-xl border-t z-50',
            isDark
                ? 'bg-gray-800/90 border-gray-700'
                : 'bg-white/90 border-gray-200'
        ]">
            <div class="px-3 py-2 lg:py-4">
                <div class="max-w-md portrait:max-w-md landscape:max-w-xs mx-auto">
                    <button
                        @click="submitAnswer"
                        :disabled="!hasSelection || isSubmitting"
                        class="w-full px-6 py-2 lg:py-3 rounded-xl font-medium transition-all active:scale-95 shadow-lg"
                        :class="[
                            hasSelection && !isSubmitting
                                ? 'bg-blue-500 hover:bg-blue-600 text-white shadow-blue-500/25 cursor-pointer' 
                                : 'bg-gray-300 dark:bg-gray-600 text-gray-500 dark:text-gray-400 cursor-not-allowed opacity-60 shadow-none',
                            (!hasSelection || isSubmitting) && 'pointer-events-none'
                        ]"
                    >
                        <span v-if="isSubmitting" class="flex items-center gap-2">
                            <svg class="animate-spin h-4 w-4" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            Loading next question...
                        </span>
                        <span v-else>{{ isLastQuestion ? 'Complete Assessment' : 'Submit Answer' }}</span>
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Modals - Clean, minimal design -->
        <TransitionRoot appear :show="showPauseModal" as="template">
            <BaseDialog as="div" @close="showPauseModal = false" class="relative z-50">
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
                            <DialogPanel class="w-full max-w-md transform overflow-hidden rounded-2xl bg-white dark:bg-gray-800 p-6 shadow-xl transition-all">
                                <DialogTitle as="h3" class="text-lg font-semibold text-gray-900 dark:text-white mb-2">
                                    {{ showPauseModal && inactivityTimer === null ? 'Assessment Paused' : 'Pause Assessment?' }}
                                </DialogTitle>
                                <p class="text-sm text-gray-500 dark:text-gray-400 mb-6">
                                    {{ showPauseModal && inactivityTimer === null 
                                        ? 'Your assessment has been automatically paused due to 5 minutes of inactivity. You can resume from where you left off.' 
                                        : 'You can resume this assessment later from where you left off.' }}
                                </p>
                                <div class="flex gap-3 justify-end">
                                    <button
                                        @click="resumeFromPause"
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
            </BaseDialog>
        </TransitionRoot>
    </div>
</template>

<script lang="ts">
import { ref, computed, onMounted, onUnmounted, watch } from 'vue'
import { SunIcon, MoonIcon } from '@heroicons/vue/24/outline'
import { QuestionMarkCircleIcon } from '@heroicons/vue/24/outline'
import { Dialog as BaseDialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot } from '@headlessui/vue'
import { useTheme } from '@/composables/useTheme'
import { router } from '@inertiajs/vue3'
import Type1 from '@/components/QuizTypes/Type1.vue'
import Type2 from '@/components/QuizTypes/Type2.vue'
import Type3 from '@/components/QuizTypes/Type3.vue'
import Type4 from '@/components/QuizTypes/Type4.vue'
import Type5 from '@/components/QuizTypes/Type5.vue'
import Type6 from '@/components/QuizTypes/Type6.vue'
import Type7 from '@/components/QuizTypes/Type7.vue'
import QuizTimer from '@/components/QuizTimer.vue'

export default {
    components: {
        BaseDialog,
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
        Type6,
        Type7,
        QuizTimer
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
        const { isDark, toggleTheme, initializeTheme } = useTheme()
        
        // Initialize theme properly using the composable
        initializeTheme()
        
        // Reactive data
        const selectedOptions = ref([])
        const selectedAnswer = ref(null) // For single choice (radio)
        const currentQuestionData = ref(props.question)
        const showPauseModal = ref(false)
        const showBloomHelp = ref(false)
        const isSubmitting = ref(false) // Prevent double submissions
        
        // Inactivity timer variables
        let inactivityTimer = null
        const lastActivity = ref(Date.now())
        
        // Watch for prop changes to update reactive state
        watch(() => props.question, (newQuestion) => {
            if (newQuestion) {
                currentQuestionData.value = newQuestion
                // Clear previous selections when new question loads
                selectedOptions.value = []
                selectedAnswer.value = null
                // Re-enable submit button when new question is received
                isSubmitting.value = false
            }
        }, { deep: true })
        
        // Timer tracking variables
        const questionTime = ref(0)
        const totalTime = ref(0)
        
        onMounted(() => {
            
            // Start inactivity timer
            resetInactivityTimer()
            
            // Add event listeners for user activity
            document.addEventListener('click', trackActivity)
            document.addEventListener('keydown', trackActivity)
            document.addEventListener('mousemove', trackActivity)
            document.addEventListener('touchstart', trackActivity)
        })
        
        onUnmounted(() => {
            
            // Clean up inactivity timer
            if (inactivityTimer) {
                clearTimeout(inactivityTimer)
            }
            
            // Remove event listeners
            document.removeEventListener('click', trackActivity)
            document.removeEventListener('keydown', trackActivity)
            document.removeEventListener('mousemove', trackActivity)
            document.removeEventListener('touchstart', trackActivity)
        })
        
        // Computed properties
        const currentQuestionComponent = computed(() => {
            const typeId = currentQuestionData.value?.type_id || 1
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
        const onQuestionTick = (questionSeconds, totalSeconds) => {
            questionTime.value = questionSeconds
            totalTime.value = totalSeconds
        }
        
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
            // Clear inactivity timer
            if (inactivityTimer) {
                clearTimeout(inactivityTimer)
                inactivityTimer = null
            }
            // Redirect to results page
            const route_url = typeof route !== 'undefined' 
                ? route('assessments.diagnostics.all-results')
                : `/diagnostics/results`;
            router.visit(route_url)
        }
        
        // Inactivity timer functions
        const resetInactivityTimer = () => {
            // Update last activity time
            lastActivity.value = Date.now()
            
            // Clear existing timer if any
            if (inactivityTimer) {
                clearTimeout(inactivityTimer)
            }
            
            // Don't set timer if already paused
            if (showPauseModal.value) {
                return
            }
            
            // Set new timer for 5 minutes
            inactivityTimer = setTimeout(() => {
                autoPauseTest()
            }, 300000) // 5 minutes (300,000 milliseconds)
        }
        
        const autoPauseTest = () => {
            // Don't pause if already paused
            if (showPauseModal.value) {
                return
            }
            
            console.log('Auto-pausing test due to inactivity')
            
            // Clear the timer
            if (inactivityTimer) {
                clearTimeout(inactivityTimer)
                inactivityTimer = null
            }
            
            // Show pause modal
            pauseTest()
        }
        
        const trackActivity = () => {
            resetInactivityTimer()
        }
        
        const resumeFromPause = () => {
            showPauseModal.value = false
            // Reset inactivity timer when resuming
            resetInactivityTimer()
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
            if (!hasSelection.value || isSubmitting.value) {
                console.warn('Submit blocked: No selection made or already submitting');
                return;
            }
            
            if (!currentQuestionData.value) {
                console.warn('Submit blocked: No current question');
                return;
            }
            
            // Set submitting flag to prevent double submit
            isSubmitting.value = true
            
            // Reset inactivity timer on answer submission
            resetInactivityTimer()
            
            // Additional validation based on question type
            if (currentQuestionData.value.type_id === 2) {
                if (!Array.isArray(selectedOptions.value) || selectedOptions.value.length === 0) {
                    console.warn('Submit blocked: No options selected for multiple choice');
                    isSubmitting.value = false
                    return;
                }
            } else {
                if (!selectedAnswer.value) {
                    console.warn('Submit blocked: No answer selected for single choice');
                    isSubmitting.value = false
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
                // Re-enable submit button on error so user can retry
                isSubmitting.value = false
                // Handle error - maybe show a notification
            }
            // Note: isSubmitting.value will be reset to false when the new question is received
            // via the watch() function above, ensuring button stays disabled until backend responds
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
        
        const getDomainStatusClasses = () => {
            // Implementation based on domain completion status
            return 'bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300'
        }
        
        const getDomainDotClasses = () => {
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
            isSubmitting,
            currentPhaseData,
            overallConfidence,
            currentMilestoneDomains,
            formatTime,
            pauseTest,
            confirmPause,
            resumeFromPause,
            handleSelection,
            submitAnswer,
            onQuestionTick,
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