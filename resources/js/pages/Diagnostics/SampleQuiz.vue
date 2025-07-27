<template>
    <div :class="[
        'flex flex-col',
        isDark ? 'bg-gray-900' : 'bg-gray-300'
    ]">
        <!-- Mobile: Ultra-Minimal Header -->
        <div class="lg:hidden relative" :class="[
            'backdrop-blur-xl border-b px-3 py-2 flex items-center justify-between',
            isDark 
                ? 'bg-gray-800/90 border-gray-700' 
                : 'bg-white/90 border-gray-200'
        ]">
            <!-- Left Side: Back Button + Status -->
            <div class="flex items-center space-x-3">
                <button @click="showExitConfirmation = true" :class="[
                    'p-1 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors',
                ]" aria-label="Back">
                    <svg class="w-5 h-5 text-gray-600 dark:text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>
                
                <!-- Status Indicator -->
                <div v-if="isReviewMode && getCurrentAnswer()" :class="[
                    'flex items-center space-x-1 px-2 py-1 rounded-full text-xs font-bold uppercase tracking-wide',
                    getCurrentAnswer().is_correct 
                        ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300'
                        : 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300'
                ]">
                    <span :class="getCurrentAnswer().is_correct ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400'">
                        {{ getCurrentAnswer().is_correct ? '✓' : '✗' }}
                    </span>
                    <span>{{ getCurrentAnswer().is_correct ? 'CORRECT' : 'INCORRECT' }}</span>
                </div>
            </div>
            
            <!-- Question Number - Centered -->
            <div class="absolute left-1/2 transform -translate-x-1/2">
                <span class="text-sm font-semibold text-gray-900 dark:text-white">
                    Q{{ currentQuestionIndex + 1 }}/{{ sampleQuestions.length }}
                </span>
            </div>
            
            <!-- Status & Actions (Right) -->
            <div class="flex items-center space-x-1">
                <!-- Timer Container (Hidden in Review Mode) -->
                <div v-if="!isReviewMode" :class="[
                    'px-2 py-1 rounded-lg backdrop-blur-sm border text-xs font-medium w-24 text-center whitespace-nowrap',
                    isDark 
                        ? 'bg-white/10 border-white/20 text-gray-300'
                        : 'bg-black/10 border-black/20 text-gray-600'
                ]">
                    <QuizTimer :isReview="isReviewMode" :isDark="isDark" @question-tick="onQuestionTick" ref="mobileTimer" :compact="true" />
                </div>
                
                <!-- Explain Button (Review Mode Only) -->
                <button v-if="isReviewMode" @click="showAllExplanations = !showAllExplanations" :class="[
                    'transition-all duration-200 flex items-center',
                    'portrait:p-1.5 portrait:rounded-full portrait:justify-center',
                    'landscape:px-3 landscape:py-1.5 landscape:rounded-full landscape:space-x-1.5',
                    showAllExplanations
                        ? 'bg-blue-500 hover:bg-blue-600 text-white shadow-md'
                        : 'bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300 border border-gray-300 dark:border-gray-600'
                ]" :aria-label="showAllExplanations ? 'Hide explanations' : 'Show explanations'">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0zM12 17.25h.01" />
                    </svg>
                    <span class="landscape:inline portrait:hidden text-xs tracking-wide">
                        {{ showAllExplanations ? 'Hide' : 'Explain' }}
                    </span>
                </button>
                
                <!-- Theme Toggle -->
                <button @click="toggleTheme" :class="[
                    'p-1 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors',
                ]" aria-label="Toggle theme">
                    <SunIcon v-if="isDark" class="w-5 h-5 text-yellow-500" />
                    <MoonIcon v-else class="w-5 h-5 text-gray-600" />
                </button>
                
                <!-- Exit Button -->
                <button @click="showExitConfirmation = true" :class="[
                    'p-1 rounded-lg bg-red-500 hover:bg-red-600 text-white transition-colors',
                ]" aria-label="Exit quiz">
                    <XMarkIcon class="w-5 h-5" />
                </button>
            </div>
        </div>

        <!-- Desktop: Compact Header with Inline Progress -->
        <div class="hidden lg:block" :class="[
            'backdrop-blur-xl border-b px-4 sm:px-8 py-3 sm:py-4',
            isDark 
                ? 'bg-gray-800/90 border-gray-700' 
                : 'bg-white/90 border-gray-200'
        ]">
            <div class="flex items-center justify-between gap-6">
                <!-- Left: Title and Status -->
                <div class="flex items-center space-x-3">
                    <div :class="[
                        'md:text-base xl:text-2xl font-semibold truncate',
                        isDark ? 'text-white' : 'text-gray-900'
                    ]">
                        {{ isReviewMode ? 'Review' : 'Sample Diagnostic Quiz' }}
                    </div>
                    
                    <!-- Review Mode Status Badge -->
                    <div v-if="isReviewMode && getCurrentAnswer()" :class="[
                        'flex items-center space-x-1 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wide',
                        getCurrentAnswer().is_correct 
                            ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300'
                            : 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300'
                    ]">
                        <span :class="getCurrentAnswer().is_correct ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400'">
                            {{ getCurrentAnswer().is_correct ? '✓' : '✗' }}
                        </span>
                        <span>{{ getCurrentAnswer().is_correct ? 'CORRECT' : 'INCORRECT' }}</span>
                    </div>
                </div>

                <!-- Center: Progress -->
                <div class="flex-1 max-w-lg flex flex-col items-center space-y-1">
                    <span :class="[
                        'text-lg font-semibold',
                        isDark ? 'text-white' : 'text-gray-900'
                    ]">
                        {{ currentQuestionIndex + 1 }} of {{ sampleQuestions.length }}
                    </span>
                    <div class="w-full h-1 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
                        <div 
                            class="h-full bg-blue-500 rounded-full transition-all duration-500 ease-out" 
                            :style="{ width: progress + '%' }"
                        ></div>
                    </div>
                </div>

                <!-- Right: Timer and Actions -->
                <div class="flex items-center gap-4">
                    <!-- Timer (Hidden in Review Mode) -->
                    <div v-if="!isReviewMode">
                        <QuizTimer :isReview="isReviewMode" :isDark="isDark" @question-tick="onQuestionTick" ref="timer" />
                    </div>

                    <!-- Theme Toggle Button -->
                    <button @click="toggleTheme" :class="[
                        'p-2 rounded-lg transition-colors',
                        isDark
                            ? 'bg-gray-700 hover:bg-gray-600'
                            : 'bg-gray-600 hover:bg-gray-500'
                    ]" aria-label="Toggle theme">
                        <SunIcon v-if="isDark" class="w-5 h-5 text-yellow-500" />
                        <MoonIcon v-else :class="[
                            'w-5 h-5',
                            isDark ? 'text-gray-300' : 'text-gray-200'
                        ]" />
                    </button>

                    <!-- Exit Quiz Button -->
                    <button @click="showExitConfirmation = true" :class="[
                        'px-3 py-2 rounded-lg font-medium transition-colors flex items-center gap-2',
                        isDark
                            ? 'bg-red-900/20 hover:bg-red-900/30 text-red-400 border border-red-800'
                            : 'bg-red-600/20 hover:bg-red-600/30 text-red-700 border border-red-700'
                    ]" aria-label="Exit quiz">
                        <XMarkIcon class="w-4 h-4" />
                        <span>Exit Quiz</span>
                    </button>
                </div>
            </div>
        </div>


        <!-- Question Section with Apple-style Background Hierarchy -->
        <div class="mx-2 sm:mx-4 md:mx-6 lg:mx-8 xl:mx-6 mt-6 pb-32 rounded-md flex-1">
            <div :class="[
                'min-h-full gap-4',
                isReviewMode 
                    ? 'grid grid-cols-1 xl:grid-cols-12 max-w-7xl mx-auto' 
                    : 'flex flex-col md:flex-row max-w-4xl mx-auto'
            ]">
                <div :class="isReviewMode ? 'xl:col-span-8' : 'flex-1'">
                    <!-- Direct Question Component without Double Card -->
                    <component :is="currentQuestionComponent" :question="currentQuestionForDisplay"
                        :answer="currentAnswerForDisplay" :isReview="isReviewMode" :isDark="isDark"
                        @selected="selected" v-if="currentQuestion"
                        :showExplanations="showAllExplanations"
                        :class="[
                            'diagnostic-question rounded-3xl backdrop-blur-xl border',
                            isDark 
                                ? 'dark-mode bg-gray-800/70 border-gray-700/50' 
                                : 'light-mode bg-white/90 border-gray-200/50'
                        ]" 
                        :style="isReviewMode && getCurrentAnswer() ? {
                            borderTop: getCurrentAnswer().is_correct 
                                ? '3px solid rgb(34, 197, 94)' 
                                : '3px solid rgb(239, 68, 68)'
                        } : {}"
                        @touchstart="handleTouchStart"
                        @touchend="handleTouchEnd" />

                    <!-- Notice Banner (Aligned with Question Content) -->
                    <div v-if="!isReviewMode" class="mt-4">
                        <div :class="[
                            'rounded-lg p-4 border',
                            isDark
                                ? 'bg-blue-900/20 border-blue-600 text-blue-200'
                                : 'bg-blue-50 border-blue-300 text-blue-800'
                        ]">
                            <p class="text-base">
                                <strong>Note:</strong> This is a sample quiz for demonstration purposes. Your answers won't be
                                saved.
                                <InertiaLink
                                    :href="typeof route !== 'undefined' ? route('assessments.diagnostics.index') : '/diagnostics'"
                                    class="underline hover:no-underline font-semibold">
                                Take the full diagnostic assessment
                                </InertiaLink> to receive personalized results and recommendations.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Question Details Card (Right Sidebar - Review Mode Only) -->
                <div v-if="isReviewMode" class="hidden xl:block xl:col-span-4 space-y-6">
                    <!-- Question Metadata Card -->
                    <div :class="[
                        'backdrop-blur-xl rounded-2xl shadow-xl border p-6 space-y-5',
                        isDark 
                            ? 'bg-gray-800/90 border-gray-700/30' 
                            : 'bg-white/90 border-gray-200/30'
                    ]">
                        <h3 :class="[
                            'text-lg font-semibold',
                            isDark ? 'text-white' : 'text-gray-900'
                        ]">
                            Question Details
                        </h3>
                        
                        <div class="space-y-4">
                            <!-- Domain -->
                            <div v-if="currentQuestion?.domain">
                                <label :class="[
                                    'text-xs font-medium uppercase tracking-wider',
                                    isDark ? 'text-gray-400' : 'text-gray-500'
                                ]">Domain</label>
                                <p :class="[
                                    'font-medium mt-1',
                                    isDark ? 'text-white' : 'text-gray-900'
                                ]">
                                    {{ currentQuestion.domain }}
                                </p>
                            </div>
                            
                            <!-- Topic -->
                            <div v-if="currentQuestion?.topic">
                                <label :class="[
                                    'text-xs font-medium uppercase tracking-wider',
                                    isDark ? 'text-gray-400' : 'text-gray-500'
                                ]">Topic</label>
                                <p :class="[
                                    'font-medium mt-1',
                                    isDark ? 'text-white' : 'text-gray-900'
                                ]">
                                    {{ currentQuestion.topic }}
                                </p>
                            </div>
                            
                            <!-- Difficulty -->
                            <div v-if="currentQuestion?.difficulty">
                                <span :class="[
                                    'text-xs font-medium uppercase tracking-wider',
                                    isDark ? 'text-gray-400' : 'text-gray-500'
                                ]">Difficulty</span>
                                <div class="flex items-center space-x-1 mt-2">
                                    <div 
                                        v-for="i in 5" 
                                        :key="i"
                                        :class="[
                                            'w-2 h-2 rounded-full',
                                            i <= getDifficultyNumeric(currentQuestion.difficulty) 
                                                ? 'bg-blue-500' 
                                                : (isDark ? 'bg-gray-600' : 'bg-gray-300')
                                        ]"
                                    ></div>
                                    <span :class="[
                                        'text-xs ml-2',
                                        isDark ? 'text-gray-400' : 'text-gray-600'
                                    ]">
                                        {{ getDifficultyLabel(currentQuestion.difficulty) }}
                                    </span>
                                </div>
                            </div>
                            
                            <!-- Bloom Level -->
                            <div v-if="currentQuestion?.bloom">
                                <span :class="[
                                    'text-xs font-medium uppercase tracking-wider',
                                    isDark ? 'text-gray-400' : 'text-gray-500'
                                ]">Bloom Level</span>
                                <div class="flex items-center space-x-1 mt-2">
                                    <div 
                                        v-for="i in 6" 
                                        :key="i"
                                        :class="[
                                            'w-2 h-2 rounded-full',
                                            i <= getBloomNumeric(currentQuestion.bloom) 
                                                ? 'bg-purple-500' 
                                                : (isDark ? 'bg-gray-600' : 'bg-gray-300')
                                        ]"
                                    ></div>
                                    <span :class="[
                                        'text-xs ml-2',
                                        isDark ? 'text-gray-400' : 'text-gray-600'
                                    ]">
                                        {{ getBloomLabel(currentQuestion.bloom) }}
                                    </span>
                                </div>
                            </div>
                            
                            <!-- Your Answer -->
                            <div v-if="getCurrentAnswer()?.selected_options?.length > 0">
                                <label :class="[
                                    'text-xs font-medium uppercase tracking-wider',
                                    isDark ? 'text-gray-400' : 'text-gray-500'
                                ]">Your Answer</label>
                                <div :class="[
                                    'mt-1 space-y-1',
                                    getCurrentAnswer().is_correct
                                        ? (isDark ? 'text-green-400' : 'text-green-600')
                                        : (isDark ? 'text-red-400' : 'text-red-600')
                                ]">
                                    <p v-for="option in getCurrentAnswer().selected_options" :key="option" class="font-medium">
                                        {{ option }}
                                    </p>
                                </div>
                            </div>
                            
                            <!-- Correct Answer -->
                            <div v-if="currentQuestion?.correct_options?.length > 0">
                                <label :class="[
                                    'text-xs font-medium uppercase tracking-wider',
                                    isDark ? 'text-gray-400' : 'text-gray-500'
                                ]">Correct Answer{{ currentQuestion.correct_options.length > 1 ? 's' : '' }}</label>
                                <div :class="[
                                    'mt-1 space-y-1',
                                    isDark ? 'text-green-400' : 'text-green-600'
                                ]">
                                    <p v-for="option in currentQuestion.correct_options" :key="option" class="font-medium">
                                        {{ option }}
                                    </p>
                                </div>
                            </div>
                            
                            <!-- Time Taken -->
                            <div v-if="getCurrentAnswer()?.duration">
                                <label :class="[
                                    'text-xs font-medium uppercase tracking-wider',
                                    isDark ? 'text-gray-400' : 'text-gray-500'
                                ]">Time Taken</label>
                                <p :class="[
                                    'font-medium mt-1',
                                    isDark ? 'text-white' : 'text-gray-900'
                                ]">
                                    {{ formatTime(getCurrentAnswer().duration) }}
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- Floating Edge Navigation (Review Mode Only - Mobile Landscape) -->
        <div v-if="isReviewMode" class="hidden max-md:landscape:block portrait:hidden fixed top-1/2 left-2 transform -translate-y-1/2 z-40">
            <button 
                v-if="currentQuestionIndex > 0"
                @click="previousQuestion" 
                :class="[
                    'w-12 h-12 rounded-full backdrop-blur-xl border-2 shadow-lg transition-all duration-300',
                    isDark 
                        ? 'bg-gray-800/90 border-gray-600 text-white hover:bg-gray-700/90' 
                        : 'bg-white/90 border-gray-300 text-gray-700 hover:bg-gray-50/90'
                ]"
                aria-label="Previous Question"
            >
                <svg class="w-6 h-6 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>
        </div>
        
        <div v-if="isReviewMode" class="hidden max-md:landscape:block portrait:hidden fixed top-1/2 right-2 transform -translate-y-1/2 z-40">
            <button 
                v-if="currentQuestionIndex < sampleQuestions.length - 1"
                @click="nextQuestion" 
                :class="[
                    'w-12 h-12 rounded-full backdrop-blur-xl border-2 shadow-lg transition-all duration-300',
                    isDark 
                        ? 'bg-gray-800/90 border-gray-600 text-white hover:bg-gray-700/90' 
                        : 'bg-white/90 border-gray-300 text-gray-700 hover:bg-gray-50/90'
                ]"
                aria-label="Next Question"
            >
                <svg class="w-6 h-6 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>
        </div>

        <!-- Bottom-Right Floating CTA Badge (Final Question Only - Mobile Landscape) -->
        <transition
            enter-active-class="transition-all duration-300 ease-out delay-200"
            enter-from-class="transform translate-x-full opacity-0"
            enter-to-class="transform translate-x-0 opacity-100"
            leave-active-class="transition-all duration-200 ease-in"
            leave-from-class="transform translate-x-0 opacity-100"
            leave-to-class="transform translate-x-full opacity-0"
        >
            <InertiaLink
                v-if="isReviewMode && currentQuestionIndex === 9"
                :href="typeof route !== 'undefined' ? route('assessments.diagnostics.index') : '/diagnostics'"
                class="fixed bottom-6 right-6 z-50 hidden max-md:landscape:block portrait:hidden"
            >
                <div :class="[
                    'px-4 py-2 rounded-full backdrop-blur-xl border shadow-lg transition-all duration-300 hover:shadow-xl',
                    'bg-emerald-500/90 hover:bg-emerald-600/90 border-emerald-400/30 text-white',
                    'text-sm font-semibold whitespace-nowrap'
                ]">
                    Full Assessment
                </div>
            </InertiaLink>
        </transition>

        <!-- Mobile: Ultra-Minimal Footer (Hidden in Landscape Review Mode Only) -->
        <div :class="[
            'lg:hidden backdrop-blur-xl border-t py-2 px-4 fixed bottom-0 left-0 w-full z-50',
            isReviewMode ? 'landscape:hidden' : '',
            isDark
                ? 'bg-gray-800/90 border-gray-700'
                : 'bg-gray-700 border-gray-800'
        ]">
            <div class="flex w-full gap-3 max-w-md mx-auto">
                <!-- Review Mode Navigation -->
                <div v-if="isReviewMode" class="flex w-full gap-2">
                    
                    <button @click="previousQuestion" :disabled="currentQuestionIndex === 0" :class="[
                        'px-4 py-2 rounded-xl font-medium flex-1 transition-all',
                        currentQuestionIndex === 0
                            ? 'bg-gray-600 cursor-not-allowed opacity-50 text-gray-400'
                            : 'bg-gray-500 hover:bg-gray-600 text-white'
                    ]">
                        Previous
                    </button>
                    <button v-if="currentQuestionIndex < sampleQuestions.length - 1" @click="nextQuestion" :class="[
                        'px-4 py-2 rounded-xl font-medium flex-1 text-white transition-all',
                        'bg-blue-500 hover:bg-blue-600'
                    ]">
                        Next
                    </button>
                    <button v-else @click="restartQuiz" :class="[
                        'px-4 py-2 rounded-xl font-medium flex-1 text-white transition-all',
                        'bg-emerald-600 hover:bg-emerald-700'
                    ]">
                        Full Assessment
                    </button>
                </div>

                <!-- Quiz Mode Controls -->
                <div v-else class="flex w-full gap-3">
                    <button @click="goToPreviousQuestion" 
                        :disabled="currentQuestionIndex === 0" 
                        :class="[
                            'px-4 py-2 rounded-xl font-medium flex-1 transition-all',
                            currentQuestionIndex === 0
                                ? 'bg-gray-600 cursor-not-allowed opacity-50 text-gray-400'
                                : 'bg-gray-500 hover:bg-gray-600 text-white'
                        ]">
                        Previous
                    </button>
                    <button v-if="currentQuestionIndex < sampleQuestions.length - 1" @click="submitAnswer"
                        :disabled="!hasSelection || isSubmitting" :class="[
                            'px-4 py-2 rounded-xl font-medium flex-1 text-white transition-all',
                            !hasSelection || isSubmitting
                                ? 'bg-gray-600 cursor-not-allowed opacity-50'
                                : 'bg-blue-500'
                        ]">
                        {{ isSubmitting ? 'Submitting...' : 'Submit Answer' }}
                    </button>
                    <button v-else @click="finishQuiz" :disabled="!hasSelection || isSubmitting" :class="[
                        'px-4 py-2 rounded-xl font-medium flex-1 text-white transition-all',
                        !hasSelection || isSubmitting
                            ? 'bg-gray-600 cursor-not-allowed opacity-50'
                            : 'bg-rose-500 hover:bg-rose-600'
                    ]">
                        Finish Quiz
                    </button>
                </div>
            </div>
        </div>

        <!-- Desktop: Original Footer -->
        <div class="hidden lg:block" :class="[
            'backdrop-blur-xl border-t py-4 px-4 fixed bottom-0 left-0 w-full z-50',
            isDark
                ? 'bg-gray-800/90 border-gray-700 shadow-2xl'
                : 'bg-gray-700 border-gray-800 shadow-2xl shadow-gray-800/30'
        ]">
            <div class="flex w-full gap-2 md:max-w-xl md:mx-auto">
                <!-- Review Mode Navigation -->
                <div v-if="isReviewMode" class="flex w-full gap-2">
                    <button @click="previousQuestion" :disabled="currentQuestionIndex === 0" :class="[
                        'px-5 py-3 rounded-lg font-semibold flex-1 backdrop-blur-md border transition-all',
                        currentQuestionIndex === 0
                            ? (isDark
                                ? 'bg-gray-600 border-gray-500 cursor-not-allowed opacity-50 text-gray-400'
                                : 'bg-gray-500 border-gray-600 cursor-not-allowed opacity-60 text-gray-300')
                            : 'bg-gray-500 hover:bg-gray-600 border-gray-400 text-white'
                    ]">
                        Previous
                    </button>
                    <button v-if="currentQuestionIndex < sampleQuestions.length - 1" @click="nextQuestion" :class="[
                        'px-5 py-3 rounded-lg font-semibold flex-1 backdrop-blur-md border text-white transition-all',
                        'bg-blue-500 border-blue-400'
                    ]">
                        Next
                    </button>
                    <button v-else @click="restartQuiz" :class="[
                        'px-5 py-3 rounded-lg font-semibold flex-1 backdrop-blur-md border text-white transition-all',
                        isDark
                            ? 'bg-emerald-600 hover:bg-emerald-700 border-emerald-500'
                            : 'bg-emerald-600 hover:bg-emerald-700 border-emerald-500'
                    ]">
                        Full Assessment
                    </button>
                </div>

                <!-- Quiz Mode Controls -->
                <div v-else class="flex w-full gap-2">
                    <button @click="goToPreviousQuestion" 
                        :disabled="currentQuestionIndex === 0" 
                        :class="[
                            'px-5 py-3 rounded-lg font-semibold flex-1 backdrop-blur-md border transition-all',
                            currentQuestionIndex === 0
                                ? (isDark
                                    ? 'bg-gray-600 border-gray-500 cursor-not-allowed opacity-50 text-gray-400'
                                    : 'bg-gray-500 border-gray-600 cursor-not-allowed opacity-60 text-gray-300')
                                : 'bg-gray-500 hover:bg-gray-600 border-gray-400 text-white'
                        ]">
                        Previous
                    </button>
                    <button v-if="currentQuestionIndex < sampleQuestions.length - 1" @click="submitAnswer"
                        :disabled="!hasSelection || isSubmitting" :class="[
                            'px-5 py-3 rounded-lg font-semibold flex-1 backdrop-blur-md border text-white transition-all shadow-lg',
                            !hasSelection || isSubmitting
                                ? (isDark
                                    ? 'bg-gray-600 border-gray-500 cursor-not-allowed opacity-50'
                                    : 'bg-gray-400 border-gray-300 cursor-not-allowed opacity-60')
                                : 'bg-blue-500 hover:bg-blue-600 border-blue-400 text-white'
                        ]">
                        {{ isSubmitting ? 'Submitting...' : 'Submit Answer' }}
                    </button>
                    <button v-else @click="finishQuiz" :disabled="!hasSelection || isSubmitting" :class="[
                        'px-5 py-3 rounded-lg font-semibold flex-1 backdrop-blur-md border text-white transition-all shadow-lg',
                        !hasSelection || isSubmitting
                            ? (isDark
                                ? 'bg-gray-600 border-gray-500 cursor-not-allowed opacity-50'
                                : 'bg-gray-400 border-gray-300 cursor-not-allowed opacity-60')
                            : 'bg-rose-500 hover:bg-rose-600 border-rose-400 text-white hover:shadow-rose-500/25'
                    ]">
                        Finish Quiz
                    </button>
                </div>
            </div>
        </div>

        <!-- Full Page Overlay for Results -->
        <div v-if="showResults" class="fixed inset-0 bg-black/50 dark:bg-black/60 z-40"></div>
        
        <!-- Results Modal -->
        <Modal :show="showResults" @close="closeResults" :max-width="'2xl'" :show-overlay="false">
            <div class="p-6">
                <h2 :class="[
                    'text-2xl font-bold mb-4',
                    isDark ? 'text-white' : 'text-gray-900'
                ]">
                    Sample Quiz Complete!
                </h2>

                <div :class="[
                    'mb-6 p-4 rounded-lg',
                    isDark ? 'bg-gray-800' : 'bg-gray-100'
                ]">
                    <p :class="[
                        'text-lg font-semibold mb-2',
                        isDark ? 'text-gray-200' : 'text-gray-800'
                    ]">
                        Your Score: {{ score }}%
                    </p>
                    <p :class="isDark ? 'text-gray-400' : 'text-gray-600'">
                        You answered {{ correctCount }} out of {{ sampleQuestions.length }} questions correctly.
                    </p>
                </div>

                <div :class="[
                    'mb-6 p-4 rounded-lg border',
                    isDark
                        ? 'bg-blue-900/20 border-blue-600'
                        : 'bg-blue-50 border-blue-300'
                ]">
                    <p :class="isDark ? 'text-blue-200' : 'text-blue-800'">
                        This was just a sample quiz! To get a comprehensive assessment of your cybersecurity knowledge
                        across 20 domains with personalized recommendations:
                    </p>
                </div>

                <div class="flex gap-3 justify-center">
                    <button @click="reviewAnswers" :class="[
                        'px-4 py-2 rounded-lg font-semibold transition-colors',
                        isDark
                            ? 'bg-gray-700 hover:bg-gray-600 text-white'
                            : 'bg-gray-200 hover:bg-gray-300 text-gray-800'
                    ]">
                        Review Answers
                    </button>
                    <InertiaLink :href="typeof route !== 'undefined' ? route('assessments.diagnostics.index') : '/diagnostics'"
                        :class="[
                            'px-4 py-2 rounded-lg font-semibold transition-colors',
                            'bg-blue-600 hover:bg-blue-700 text-white'
                        ]">
                    Take Full Assessment
                    </InertiaLink>
                </div>
            </div>
        </Modal>

        <!-- Auto-Pause Modal -->
        <Modal :show="showPauseModal" @close="resumeQuiz" :max-width="'md'">
            <div :class="[
                'p-8',
                isDark ? 'bg-gray-800' : 'bg-white'
            ]">
                <!-- Header with Icon -->
                <div class="text-center mb-6">
                    <div :class="[
                        'mx-auto flex items-center justify-center w-16 h-16 rounded-full mb-4',
                        isDark ? 'bg-yellow-900/20' : 'bg-yellow-100'
                    ]">
                        <svg class="w-8 h-8 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 9v6m4-6v6m7-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h2 :class="[
                        'text-2xl font-bold mb-2',
                        isDark ? 'text-white' : 'text-gray-900'
                    ]">
                        Quiz Paused
                    </h2>
                    <p :class="[
                        'text-lg',
                        isDark ? 'text-gray-300' : 'text-gray-600'
                    ]">
                        Your quiz has been automatically paused due to inactivity.
                    </p>
                </div>

                <!-- Information Card -->
                <div :class="[
                    'mb-8 p-5 rounded-xl border',
                    isDark 
                        ? 'bg-gray-750 border-gray-600 shadow-lg shadow-gray-900/20' 
                        : 'bg-gray-50 border-gray-200 shadow-xs'
                ]">
                    <div class="flex items-start space-x-3">
                        <div :class="[
                            'shrink-0 w-5 h-5 rounded-full flex items-center justify-center mt-0.5',
                            isDark ? 'bg-blue-900/30' : 'bg-blue-100'
                        ]">
                            <svg class="w-3 h-3 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div>
                            <p :class="[
                                'text-lg font-medium mb-1',
                                isDark ? 'text-gray-200' : 'text-gray-900'
                            ]">
                                Why did this happen?
                            </p>
                            <p :class="[
                                'text-lg leading-relaxed',
                                isDark ? 'text-gray-400' : 'text-gray-600'
                            ]">
                                To help prevent fatigue and ensure accurate responses, the quiz automatically pauses after 5 minutes of inactivity.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-center">
                    <button @click="resumeQuiz" :class="[
                        'px-8 py-3 rounded-xl font-semibold text-white transition-all duration-200 focus:outline-none focus:ring-4 focus:ring-blue-500/30 shadow-lg hover:shadow-xl',
                        isDark 
                            ? 'bg-linear-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 shadow-blue-500/25 hover:shadow-blue-500/40' 
                            : 'bg-linear-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 shadow-blue-500/30 hover:shadow-blue-500/50'
                    ]">
                        <span class="flex items-center space-x-2">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h1m4 0h1m-6 4h.01M19 10a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>Resume Quiz</span>
                        </span>
                    </button>
                </div>
            </div>
        </Modal>

        <!-- Exit Confirmation Dialog -->
        <ConfirmationDialog
            :isOpen="showExitConfirmation"
            title="Exit Quiz?"
            description="Are you sure you want to exit? Your progress will not be saved."
            type="warning"
            confirmText="Exit"
            cancelText="Continue"
            :isDark="isDark"
            @confirm="exitQuiz"
            @close="showExitConfirmation = false"
        />

        <!-- Mobile Difficulty Level Modal -->
        <Modal :show="showDifficultyModal" @close="showDifficultyModal = false" maxWidth="sm">
            <div :class="[
                'p-6',
                isDark ? 'bg-gray-800' : 'bg-white'
            ]">
                <div class="space-y-4">
                    <h3 :class="[
                        'text-lg font-semibold flex items-center gap-2',
                        isDark ? 'text-gray-100' : 'text-gray-900'
                    ]">
                        ❓ Difficulty Level?
                    </h3>
                    <p :class="[
                        'text-base leading-relaxed',
                        isDark ? 'text-gray-300' : 'text-gray-600'
                    ]">
                        Each question is rated by how challenging it is:
                    </p>
                    <ul :class="[
                        'text-base space-y-2',
                        isDark ? 'text-gray-300' : 'text-gray-600'
                    ]">
                        <li class="flex items-start">
                            <span class="mr-2">•</span>
                            <div>
                                <span class="font-medium">1 – Very Easy:</span> Basic facts or definitions
                            </div>
                        </li>
                        <li class="flex items-start">
                            <span class="mr-2">•</span>
                            <div>
                                <span class="font-medium">2 – Easy:</span> Simple application of key concepts
                            </div>
                        </li>
                        <li class="flex items-start">
                            <span class="mr-2">•</span>
                            <div>
                                <span class="font-medium">3 – Medium:</span> Involves moderate reasoning or scenarios
                            </div>
                        </li>
                        <li class="flex items-start">
                            <span class="mr-2">•</span>
                            <div>
                                <span class="font-medium">4 – Hard:</span> Requires deep analysis and multi-step thinking
                            </div>
                        </li>
                        <li class="flex items-start">
                            <span class="mr-2">•</span>
                            <div>
                                <span class="font-medium">5 – Very Hard:</span> Complex, expert-level questions
                            </div>
                        </li>
                    </ul>
                    <p :class="[
                        'text-sm pt-4 border-t',
                        isDark ? 'text-gray-400 border-gray-700' : 'text-gray-500 border-gray-200'
                    ]">
                        Helps the system adapt to your skill level!
                    </p>
                    <div class="pt-4">
                        <button @click="showDifficultyModal = false" :class="[
                            'w-full px-4 py-2 rounded-lg font-medium transition-colors',
                            isDark
                                ? 'bg-gray-700 hover:bg-gray-600 text-gray-200'
                                : 'bg-gray-100 hover:bg-gray-200 text-gray-700'
                        ]">
                            Got it!
                        </button>
                    </div>
                </div>
            </div>
        </Modal>

        <!-- Mobile Bloom Level Modal -->
        <Modal :show="showBloomModal" @close="showBloomModal = false" maxWidth="sm">
            <div :class="[
                'p-6',
                isDark ? 'bg-gray-800' : 'bg-white'
            ]">
                <div class="space-y-4">
                    <h3 :class="[
                        'text-lg font-semibold flex items-center gap-2',
                        isDark ? 'text-gray-100' : 'text-gray-900'
                    ]">
                        💡 Bloom's Taxonomy Levels
                    </h3>
                    <p :class="[
                        'text-base leading-relaxed',
                        isDark ? 'text-gray-300' : 'text-gray-600'
                    ]">
                        A framework that measures the depth of understanding:
                    </p>
                    <div :class="[
                        'text-base space-y-3',
                        isDark ? 'text-gray-300' : 'text-gray-600'
                    ]">
                        <div class="flex items-start gap-3">
                            <span class="font-bold text-blue-500 text-lg">1.</span>
                            <div>
                                <span class="font-semibold">Remember</span>
                                <span class="text-sm block opacity-80 mt-0.5">Recall facts and basic concepts</span>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <span class="font-bold text-blue-500 text-lg">2.</span>
                            <div>
                                <span class="font-semibold">Understand</span>
                                <span class="text-sm block opacity-80 mt-0.5">Explain ideas or concepts</span>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <span class="font-bold text-green-500 text-lg">3.</span>
                            <div>
                                <span class="font-semibold">Apply</span>
                                <span class="text-sm block opacity-80 mt-0.5">Use information in new situations</span>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <span class="font-bold text-green-500 text-lg">4.</span>
                            <div>
                                <span class="font-semibold">Analyze</span>
                                <span class="text-sm block opacity-80 mt-0.5">Draw connections among ideas</span>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <span class="font-bold text-orange-500 text-lg">5.</span>
                            <div>
                                <span class="font-semibold">Evaluate</span>
                                <span class="text-sm block opacity-80 mt-0.5">Justify decisions or judgments</span>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <span class="font-bold text-red-500 text-lg">6.</span>
                            <div>
                                <span class="font-semibold">Create</span>
                                <span class="text-sm block opacity-80 mt-0.5">Produce new or original work</span>
                            </div>
                        </div>
                    </div>
                    <p :class="[
                        'text-sm pt-4 border-t italic',
                        isDark ? 'text-gray-400 border-gray-700' : 'text-gray-500 border-gray-200'
                    ]">
                        The assessment adapts difficulty based on your performance at each level.
                    </p>
                    <div class="pt-4">
                        <button @click="showBloomModal = false" :class="[
                            'w-full px-4 py-2 rounded-lg font-medium transition-colors',
                            isDark
                                ? 'bg-gray-700 hover:bg-gray-600 text-gray-200'
                                : 'bg-gray-100 hover:bg-gray-200 text-gray-700'
                        ]">
                            Got it!
                        </button>
                    </div>
                </div>
            </div>
        </Modal>
    </div>
</template>

<script lang="ts">
import { Link } from "@inertiajs/vue3";
import Type1 from "@/components/QuizTypes/Type1.vue";
import Type2 from "@/components/QuizTypes/Type2.vue";
import Type3 from "@/components/QuizTypes/Type3.vue";
import Type4 from "@/components/QuizTypes/Type4.vue";
import Type5 from "@/components/QuizTypes/Type5.vue";
import Type6 from "@/components/QuizTypes/Type6.vue";
import Type7 from "@/components/QuizTypes/Type7.vue";
import Type1Review from "@/components/QuizTypes/Type1Review.vue";
import Type2Review from "@/components/QuizTypes/Type2Review.vue";
import Type3Review from "@/components/QuizTypes/Type3Review.vue";
import Type4Review from "@/components/QuizTypes/Type4Review.vue";
import Type5Review from "@/components/QuizTypes/Type5Review.vue";
import Type6Review from "@/components/QuizTypes/Type6Review.vue";
import Type7Review from "@/components/QuizTypes/Type7Review.vue";
import Modal from "@/components/Modal.vue";
import QuizTimer from "@/components/QuizTimer.vue";
import BarChartLevelIndicator from "@/components/LevelIndicators/BarChartLevelIndicator.vue";
import ConfirmationDialog from "@/components/ConfirmationDialog.vue";
import { SunIcon, MoonIcon } from 'lucide-vue-next';
import { XMarkIcon, QuestionMarkCircleIcon } from '@heroicons/vue/24/outline';
import { Popover, PopoverButton, PopoverPanel } from '@headlessui/vue';
import { sampleQuestions } from '@/data/sampleQuestions.js';

export default {
    layout: null, // No layout for sample quiz
    components: {
        InertiaLink: Link,
        Type1,
        Type2,
        Type3,
        Type4,
        Type5,
        Type6,
        Type7,
        Type1Review,
        Type2Review,
        Type3Review,
        Type4Review,
        Type5Review,
        Type6Review,
        Type7Review,
        Modal,
        QuizTimer,
        BarChartLevelIndicator,
        ConfirmationDialog,
        SunIcon,
        MoonIcon,
        XMarkIcon,
        QuestionMarkCircleIcon,
        Popover,
        PopoverButton,
        PopoverPanel
    },
    data() {
        return {
            currentQuestionIndex: 0,
            selectedOptions: [],
            answer: {
                question_id: null,
                selected_options: [],
                duration: 0,
                is_correct: null,
            },
            userAnswers: [],
            isReviewMode: false,
            showResults: false,
            isDark: true,
            showPauseModal: false,
            showExitConfirmation: false,
            showDifficultyModal: false,
            showBloomModal: false,
            inactivityTimer: null,
            lastActivity: Date.now(),
            commandHistory: [], // For Type7 terminal commands
            isSubmitting: false, // Prevent double submissions
            showAllExplanations: false, // For mobile explanation toggle
            // Swipe navigation
            touchStartX: 0,
            touchStartY: 0,
            touchEndX: 0,
            touchEndY: 0,
            swipeThreshold: 50,
            // Sample questions data (imported from separate file)
            sampleQuestions
        };
    },
    computed: {
        currentQuestion() {
            return this.sampleQuestions[this.currentQuestionIndex] || null;
        },
        currentQuestionComponent() {
            if (this.isReviewMode) {
                const typeMap = {
                    1: 'Type1Review', // Single choice & Multiple choice review
                    2: 'Type2Review', // True/False review
                    3: 'Type3Review', // Drag and drop review
                    4: 'Type4Review', // Ordering review
                    5: 'Type5Review', // Matching review
                    6: 'Type6Review', // Hotspot review
                    7: 'Type7Review', // Simulation review
                };
                return typeMap[this.currentQuestion?.type_id] || 'Type1Review';
            } else {
                const typeMap = {
                    1: 'Type1', // Single choice & Multiple choice (based on settings)
                    2: 'Type2', // True/False
                    3: 'Type3', // Drag and drop
                    4: 'Type4', // Ordering
                    5: 'Type5', // Matching
                    6: 'Type6', // Hotspot
                    7: 'Type7', // Simulation
                };
                return typeMap[this.currentQuestion?.type_id] || 'Type1';
            }
        },
        currentQuestionForDisplay() {
            // For review mode, we need to add the correct_options to the question
            if (this.isReviewMode && this.currentQuestion) {
                return {
                    ...this.currentQuestion,
                    type: this.currentQuestion.type_id // Type components expect 'type' not 'type_id'
                };
            }
            return {
                ...this.currentQuestion,
                type: this.currentQuestion?.type_id
            };
        },
        currentAnswerForDisplay() {
            if (this.isReviewMode && this.userAnswers[this.currentQuestionIndex]) {
                const answer = {
                    selected_options: this.userAnswers[this.currentQuestionIndex].selectedOptions,
                    is_correct: this.userAnswers[this.currentQuestionIndex].isCorrect,
                    metadata: {}
                };
                
                // Store command history in metadata for Type7
                if (this.userAnswers[this.currentQuestionIndex].commands) {
                    answer.metadata.commands = this.userAnswers[this.currentQuestionIndex].commands;
                }
                
                return answer;
            }
            // During quiz mode, pass any saved answer for the current question
            if (this.userAnswers[this.currentQuestionIndex]) {
                const answer = {
                    selected_options: this.userAnswers[this.currentQuestionIndex].selectedOptions,
                    is_correct: this.userAnswers[this.currentQuestionIndex].isCorrect,
                    metadata: {}
                };
                
                // Store command history in metadata for Type7
                if (this.userAnswers[this.currentQuestionIndex].commands) {
                    answer.metadata.commands = this.userAnswers[this.currentQuestionIndex].commands;
                }
                
                return answer;
            }
            return this.answer;
        },
        hasSelection() {
            // Special handling for Type 4 (ordering) questions
            if (this.currentQuestion?.type_id === 4) {
                // For Type4, check if all items have been moved (selectedOptions length equals total options)
                return Array.isArray(this.selectedOptions) && 
                       this.selectedOptions.length === this.currentQuestion.options.length;
            }
            
            // Special handling for Type 5 (matching) questions
            if (this.currentQuestion?.type_id === 5) {
                // For Type5, check if all items have been matched (no null values in selectedOptions)
                if (!Array.isArray(this.selectedOptions)) return false;
                
                // Get the expected number of items to match
                const itemCount = this.currentQuestion.options?.items?.length || 0;
                
                // Check that we have the right number of matches and none are null
                return this.selectedOptions.length === itemCount && 
                       this.selectedOptions.every(option => option !== null && option !== undefined);
            }
            
            // Default behavior for other question types
            return Array.isArray(this.selectedOptions)
                ? this.selectedOptions.length > 0
                : !!this.selectedOptions;
        },
        progress() {
            return Math.round(((this.currentQuestionIndex + 1) / this.sampleQuestions.length) * 100);
        },
        score() {
            const correct = this.userAnswers.filter(a => a && a.isCorrect).length;
            return Math.round((correct / this.sampleQuestions.length) * 100);
        },
        correctCount() {
            return this.userAnswers.filter(a => a && a.isCorrect).length;
        }
    },
    methods: {
        initialAnswer() {
            return {
                question_id: null,
                selected_options: [],
                duration: 0,
                is_correct: null,
            };
        },
        selected(options, commandHistory) {
            this.selectedOptions = options;
            // Store command history if provided (for Type7)
            if (commandHistory) {
                this.commandHistory = commandHistory;
            }
        },
        toggleTheme() {
            this.isDark = !this.isDark;

            if (this.isDark) {
                document.documentElement.classList.add('dark');
                localStorage.setItem('theme', 'dark');
            } else {
                document.documentElement.classList.remove('dark');
                localStorage.setItem('theme', 'light');
            }
        },
        submitAnswer() {
            if (!this.hasSelection || this.isSubmitting) return;

            // Set submitting flag to prevent double submission
            this.isSubmitting = true;

            try {
                // Check if answer is correct
                const isCorrect = this.checkAnswer(this.currentQuestion, this.selectedOptions);

                // Store or update the answer
                const answerData = {
                    questionId: this.currentQuestion.id,
                    selectedOptions: Array.isArray(this.selectedOptions) ? [...this.selectedOptions] : this.selectedOptions,
                    isCorrect: isCorrect
                };
                
                // For Type7, store command history locally
                if (this.currentQuestion?.type_id === 7) {
                    answerData.commands = [...this.commandHistory]; // Keep for local navigation and review
                    
                    // In a real assessment, this would be stored as:
                    // AssessmentResponse::create([
                    //     'selected_options' => [selected_answer],
                    //     'metadata' => [
                    //         'commands' => $commandHistory
                    //     ]
                    // ]);
                }
                
                this.userAnswers[this.currentQuestionIndex] = answerData;

                // Move to next question
                this.currentQuestionIndex++;

                // Load next question's answer if it exists
                if (this.userAnswers[this.currentQuestionIndex]) {
                    this.selectedOptions = this.userAnswers[this.currentQuestionIndex].selectedOptions;
                } else {
                    this.selectedOptions = [];
                }
                this.answer = this.initialAnswer();

                // Reset question timer
                if (this.$refs.timer) {
                    this.$refs.timer.resetQuestionTimer();
                }
                if (this.$refs.mobileTimer) {
                    this.$refs.mobileTimer.resetQuestionTimer();
                }

                // Reset inactivity timer
                this.resetInactivityTimer();

                // Reset scroll position to top of page
                window.scrollTo({ top: 0, behavior: 'smooth' });
            } finally {
                // Reset submitting flag after a short delay to ensure UI updates
                setTimeout(() => {
                    this.isSubmitting = false;
                }, 300);
            }
        },
        finishQuiz() {
            if (!this.hasSelection || this.isSubmitting) return;

            // Set submitting flag to prevent double submission
            this.isSubmitting = true;

            try {
                // Submit the last answer
                const isCorrect = this.checkAnswer(this.currentQuestion, this.selectedOptions);
                this.userAnswers[this.currentQuestionIndex] = {
                    questionId: this.currentQuestion.id,
                    selectedOptions: Array.isArray(this.selectedOptions) ? [...this.selectedOptions] : this.selectedOptions,
                    isCorrect: isCorrect,
                commands: this.currentQuestion?.type_id === 7 ? [...this.commandHistory] : undefined
            };

                // Show results
                this.showResults = true;
            } finally {
                // Reset submitting flag after a short delay
                setTimeout(() => {
                    this.isSubmitting = false;
                }, 300);
            }
        },
        checkAnswer(question, userAnswer) {
            const type = question.type_id;

            // Type 1 and 2: Single and Multiple choice
            if (type === 1 || type === 2) {
                const correctOptions = question.correct_options || [];
                const normalizedCorrect = correctOptions.map(opt => opt.toLowerCase().trim()).sort();
                const normalizedUser = Array.isArray(userAnswer)
                    ? userAnswer.map(opt => opt.toLowerCase().trim()).sort()
                    : [userAnswer.toLowerCase().trim()];
                return JSON.stringify(normalizedCorrect) === JSON.stringify(normalizedUser);
            }

            // Type 3: Drag and drop (single zone)
            if (type === 3) {
                const correctOptions = question.correct_options || [];
                const normalizedCorrect = correctOptions.map(opt => opt.toLowerCase().trim()).sort();
                const normalizedUser = Array.isArray(userAnswer)
                    ? userAnswer.map(opt => opt.toLowerCase().trim()).sort()
                    : [];
                return JSON.stringify(normalizedCorrect) === JSON.stringify(normalizedUser);
            }

            // Type 4: Ordering
            if (type === 4) {
                const correctOrder = question.correct_options || question.responses || [];
                return JSON.stringify(correctOrder) === JSON.stringify(userAnswer);
            }

            // Type 5: Matching
            if (type === 5) {
                const correctMatches = question.correct_matches || question.correct_answers || {};
                if (!userAnswer || typeof userAnswer !== 'object') return false;

                for (const key in correctMatches) {
                    if (userAnswer[key] !== correctMatches[key]) {
                        return false;
                    }
                }
                return true;
            }

            // Type 6: Hotspot
            if (type === 6) {
                const correctOption = question.correct_options;
                if (!userAnswer || !correctOption) return false;
                return userAnswer.x === correctOption.x && userAnswer.y === correctOption.y;
            }

            // Type 7: Simulation (now using standard structure)
            if (type === 7) {
                const correctOptions = question.correct_options || [];
                if (Array.isArray(userAnswer)) {
                    return userAnswer.length > 0 && correctOptions.includes(userAnswer[0]);
                }
                return correctOptions.includes(userAnswer);
            }

            return false;
        },
        reviewAnswers() {
            this.showResults = false;
            this.isReviewMode = true;
            this.currentQuestionIndex = 0;

            // Load the first question's answer for review
            if (this.userAnswers[0]) {
                this.selectedOptions = this.userAnswers[0].selectedOptions;
            }
        },
        previousQuestion() {
            if (this.currentQuestionIndex > 0) {
                this.currentQuestionIndex--;
                // Load the previous answer
                if (this.userAnswers[this.currentQuestionIndex]) {
                    this.selectedOptions = this.userAnswers[this.currentQuestionIndex].selectedOptions;
                }
                // Reset scroll position to top of page
                window.scrollTo({ top: 0, behavior: 'smooth' });
            }
        },
        goToPreviousQuestion() {
            if (this.currentQuestionIndex > 0) {
                // Save current selection before moving (if any)
                if (this.hasSelection) {
                    const isCorrect = this.checkAnswer(this.currentQuestion, this.selectedOptions);
                    this.userAnswers[this.currentQuestionIndex] = {
                        questionId: this.currentQuestion.id,
                        selectedOptions: Array.isArray(this.selectedOptions) ? [...this.selectedOptions] : this.selectedOptions,
                        isCorrect: isCorrect,
                        commands: this.currentQuestion?.type_id === 7 ? [...this.commandHistory] : undefined
                    };
                }
                
                this.currentQuestionIndex--;
                
                // Load the previous answer if it exists
                if (this.userAnswers[this.currentQuestionIndex]) {
                    this.selectedOptions = this.userAnswers[this.currentQuestionIndex].selectedOptions;
                } else {
                    // Clear selection for unanswered question
                    this.selectedOptions = [];
                    this.answer = this.initialAnswer();
                }
                
                // Reset inactivity timer
                this.resetInactivityTimer();
            }
        },
        nextQuestion() {
            if (this.currentQuestionIndex < this.sampleQuestions.length - 1) {
                this.currentQuestionIndex++;
                // Load the next answer
                if (this.userAnswers[this.currentQuestionIndex]) {
                    this.selectedOptions = this.userAnswers[this.currentQuestionIndex].selectedOptions;
                }
                // Reset scroll position to top of page
                window.scrollTo({ top: 0, behavior: 'smooth' });
            }
        },
        restartQuiz() {
            // Redirect to diagnostics page with encouraging message
            window.location.href = route('assessments.diagnostics.index') + '?completed_sample=true';
        },
        closeResults() {
            this.showResults = false;
        },
        onQuestionTick() {
            // Don't reset inactivity timer on every tick
            // The timer should pause after 30 seconds of no user interaction
            // Timer ticking is not considered user activity
        },
        resetInactivityTimer() {
            // Update last activity time
            this.lastActivity = Date.now();
            
            // Clear existing timer if any
            if (this.inactivityTimer) {
                clearTimeout(this.inactivityTimer);
            }
            
            // Don't set timer in review mode or if quiz is already paused
            if (this.isReviewMode || this.showPauseModal || this.showResults) {
                return;
            }
            
            // Set new timer for 5 minutes (300 seconds)
            this.inactivityTimer = setTimeout(() => {
                this.pauseQuiz();
            }, 300000); // 5 minutes (300,000 milliseconds)
        },
        pauseQuiz() {
            // Don't pause if already in review mode, showing results, or already paused
            if (this.isReviewMode || this.showResults || this.showPauseModal) {
                return;
            }
            
            console.log('Pausing quiz due to inactivity');
            
            // Clear the timer
            if (this.inactivityTimer) {
                clearTimeout(this.inactivityTimer);
                this.inactivityTimer = null;
            }
            
            // Show pause modal first
            this.showPauseModal = true;
            
            // Then pause the timer with a small delay to ensure modal is shown
            this.$nextTick(() => {
                if (this.$refs.timer) {
                    this.$refs.timer.pause();
                }
                if (this.$refs.mobileTimer) {
                    this.$refs.mobileTimer.pause();
                }
            });
        },
        resumeQuiz() {
            // Hide modal
            this.showPauseModal = false;
            
            // Resume the timer
            if (this.$refs.timer) {
                this.$refs.timer.resume();
            }
            if (this.$refs.mobileTimer) {
                this.$refs.mobileTimer.resume();
            }
            
            // Reset inactivity timer
            this.resetInactivityTimer();
        },
        trackActivity() {
            this.resetInactivityTimer();
        },
        getQuestionTypeName() {
            // Check if question_type relationship exists
            if (this.currentQuestion?.question_type?.name) {
                return this.currentQuestion.question_type.name;
            }
            
            // Fallback to type mapping if question_type not loaded
            const typeMap = {
                1: 'Single Choice',
                2: 'Multiple Choice',
                3: 'Drag & Drop',
                4: 'Ordering',
                5: 'Matching',
                6: 'Hotspot',
                7: 'Simulation'
            };
            return typeMap[this.currentQuestion?.type_id] || 'Unknown';
        },
        getDifficultyScore() {
            const scores = {
                'Very Easy': 1,
                'Easy': 2,
                'Medium': 3,
                'Hard': 4,
                'Very Hard': 5
            };
            return scores[this.currentQuestion?.difficulty] || 3; // Default to Medium (3)
        },
        getBloomScore() {
            const scores = {
                'Remember': 1,
                'Understand': 2,
                'Apply': 3,
                'Analyze': 4,
                'Evaluate': 5,
                'Create': 6
            };
            return scores[this.currentQuestion?.bloom] || 2; // Default to Understand (2)
        },
        exitQuiz() {
            // Clear any timers
            if (this.inactivityTimer) {
                clearTimeout(this.inactivityTimer);
            }
            
            // Navigate back to diagnostics index page
            window.location.href = typeof route !== 'undefined' ? route('assessments.diagnostics.index') : '/diagnostics';
        },
        getCurrentAnswer() {
            return this.userAnswers[this.currentQuestionIndex] || null;
        },
        formatTime(seconds) {
            if (!seconds) return 'N/A';
            
            if (seconds < 60) {
                return `${seconds}s`;
            } else {
                const minutes = Math.floor(seconds / 60);
                const remainingSeconds = seconds % 60;
                return remainingSeconds > 0 ? `${minutes}m ${remainingSeconds}s` : `${minutes}m`;
            }
        },
        getDifficultyLabel(difficulty) {
            // Handle both string and numeric inputs
            if (typeof difficulty === 'string') {
                return difficulty; // Return string as-is (e.g., "Easy", "Medium")
            }
            
            const labels = {
                1: 'Beginner',
                2: 'Easy',
                3: 'Intermediate',
                4: 'Advanced',
                5: 'Expert'
            };
            return labels[difficulty] || 'Unknown';
        },
        getBloomLabel(bloom) {
            // Handle both string and numeric inputs
            if (typeof bloom === 'string') {
                return bloom; // Return string as-is (e.g., "Apply", "Understand")
            }
            
            const labels = {
                1: 'Remember (L1)',
                2: 'Understand (L2)',
                3: 'Apply (L3)',
                4: 'Analysis (L4)',
                5: 'Evaluate (L5)',
                6: 'Create (L6)'
            };
            return labels[bloom] || 'Unknown';
        },
        getDifficultyNumeric(difficulty) {
            // Convert string difficulty to numeric for dot indicators
            if (typeof difficulty === 'number') {
                return difficulty;
            }
            
            const difficultyMap = {
                'Easy': 2,
                'Medium': 3,
                'Hard': 4,
                'Expert': 5,
                'Beginner': 1
            };
            return difficultyMap[difficulty] || 0;
        },
        getBloomNumeric(bloom) {
            // Convert string bloom to numeric for dot indicators
            if (typeof bloom === 'number') {
                return bloom;
            }
            
            const bloomMap = {
                'Remember': 1,
                'Understand': 2,
                'Apply': 3,
                'Analysis': 4,
                'Analyze': 4,
                'Evaluate': 5,
                'Create': 6
            };
            return bloomMap[bloom] || 0;
        },
        handleTouchStart(event) {
            if (!this.isReviewMode) return;
            
            this.touchStartX = event.touches[0].clientX;
            this.touchStartY = event.touches[0].clientY;
        },
        handleTouchEnd(event) {
            if (!this.isReviewMode) return;
            
            this.touchEndX = event.changedTouches[0].clientX;
            this.touchEndY = event.changedTouches[0].clientY;
            
            this.handleSwipe();
        },
        handleSwipe() {
            const deltaX = this.touchEndX - this.touchStartX;
            const deltaY = this.touchEndY - this.touchStartY;
            
            // Only process horizontal swipes
            if (Math.abs(deltaX) > Math.abs(deltaY) && Math.abs(deltaX) > this.swipeThreshold) {
                if (deltaX > 0) {
                    // Swipe right - go to previous
                    this.previousQuestion();
                } else {
                    // Swipe left - go to next
                    this.nextQuestion();
                }
            }
        }
    },
    watch: {
        currentQuestionIndex: {
            immediate: true,
            handler(newIndex) {
                // Load the answer for the current question if it exists
                if (this.userAnswers[newIndex]) {
                    this.selectedOptions = this.userAnswers[newIndex].selectedOptions;
                    this.commandHistory = this.userAnswers[newIndex].commands || [];
                } else {
                    this.selectedOptions = [];
                    this.commandHistory = [];
                }
            }
        },
        selectedOptions: {
            handler() {
                // Track activity when user selects an option
                this.trackActivity();
            },
            deep: true
        },
        isReviewMode(newVal) {
            if (newVal) {
                // Clear inactivity timer when entering review mode
                if (this.inactivityTimer) {
                    clearTimeout(this.inactivityTimer);
                    this.inactivityTimer = null;
                }
            }
        }
    },
    mounted() {
        // Set dark theme as default
        if (typeof window !== 'undefined') {
            this.isDark = true;
            document.documentElement.classList.add('dark');
            document.documentElement.classList.remove('light');
        }
        
        // Start inactivity timer
        this.resetInactivityTimer();
        
        // Add event listeners for user activity
        document.addEventListener('click', this.trackActivity);
        document.addEventListener('keydown', this.trackActivity);
        document.addEventListener('mousemove', this.trackActivity);
        document.addEventListener('touchstart', this.trackActivity);
    },
    beforeUnmount() {
        // Clean up timers and event listeners
        if (this.inactivityTimer) {
            clearTimeout(this.inactivityTimer);
        }
        
        document.removeEventListener('click', this.trackActivity);
        document.removeEventListener('keydown', this.trackActivity);
        document.removeEventListener('mousemove', this.trackActivity);
        document.removeEventListener('touchstart', this.trackActivity);
    }
};
</script>

<style scoped>
.diagnostic-question {
    /* Inherits styles from the quiz type components */
    transform: translateZ(0); /* Hardware acceleration */
    transition: all 0.3s ease;
}

/* Enhanced animations for navigation grid */
.grid button {
    transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
}

/* Floating navigation animations */
.fixed button {
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

/* Status badge animations */
.rounded-full {
    animation: fadeInScale 0.3s ease-out;
}

@keyframes fadeInScale {
    0% {
        opacity: 0;
        transform: scale(0.8);
    }
    100% {
        opacity: 1;
        transform: scale(1);
    }
}

/* Progress bar animations */
.h-4 div {
    transition: width 0.5s ease-in-out;
}

/* Touch feedback for mobile */
@media (max-width: 1024px) {
    .diagnostic-question {
        touch-action: pan-y; /* Allow vertical scrolling only */
    }
}
</style>