<template>
    <div :class="[
        'flex flex-col',
        isDark ? 'bg-gray-900' : 'bg-gray-300'
    ]">
        <!-- Loading State -->
        <div v-if="!questionsLoaded && !loadingError" class="flex items-center justify-center min-h-screen">
            <div class="text-center">
                <div class="animate-spin rounded-full h-16 w-16 border-b-2 border-blue-500 mx-auto mb-4"></div>
                <p :class="[
                    'text-lg font-medium',
                    isDark ? 'text-white' : 'text-gray-900'
                ]">
                    Loading sample quiz questions...
                </p>
            </div>
        </div>

        <!-- Error State -->
        <div v-else-if="loadingError" class="flex items-center justify-center min-h-screen">
            <div class="text-center max-w-md mx-auto p-6">
                <div class="text-red-500 mb-4">
                    <svg class="w-16 h-16 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.962-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z" />
                    </svg>
                </div>
                <h2 :class="[
                    'text-2xl font-bold mb-2',
                    isDark ? 'text-white' : 'text-gray-900'
                ]">
                    Failed to Load Questions
                </h2>
                <p :class="[
                    'text-gray-600 dark:text-gray-400 mb-4'
                ]">
                    {{ loadingError }}
                </p>
                <button 
                    @click="loadQuestions" 
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium transition-colors"
                >
                    Try Again
                </button>
            </div>
        </div>

        <!-- Main Content (Only show when questions are loaded) -->
        <div v-else>
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
                <button @click="showExitConfirmation = true" :class="[
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
                        Q{{ currentQuestionIndex + 1 }}
                    </span>
                    <span :class="[
                        'text-sm',
                        isDark ? 'text-gray-400' : 'text-gray-500'
                    ]">
                        /{{ sampleQuestions.length }}
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
                         :style="{ width: progressPercentage + '%' }">
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
                    v-if="!isReviewMode"
                    :isReview="isReviewMode" 
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
                
                <!-- Review Mode Status Badge -->
                <div v-if="isReviewMode && getCurrentAnswer()" :class="[
                    'flex items-center space-x-1 px-2 py-1 lg:px-3 lg:py-1 rounded-full text-xs font-bold uppercase tracking-wide',
                    getCurrentAnswer().isCorrect 
                        ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300'
                        : 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300'
                ]">
                    <span :class="getCurrentAnswer().isCorrect ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400'">
                        {{ getCurrentAnswer().isCorrect ? '✓' : '✗' }}
                    </span>
                    <span>{{ getCurrentAnswer().isCorrect ? 'CORRECT' : 'INCORRECT' }}</span>
                </div>
                
                <!-- Theme Toggle -->
                <button @click="toggleTheme" :class="[
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
                <button @click="showExitConfirmation = true" :class="[
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
                    <span class="text-sm portrait:hidden landscape:inline lg:inline">{{ isReviewMode ? 'Exit Review' : 'Pause Test' }}</span>
                </button>
            </div>
        </div>


        <!-- Question Section with Apple-style Background Hierarchy -->
        <div class="mx-2 sm:mx-4 md:mx-6 lg:mx-8 xl:mx-6 mt-6 pb-32 rounded-md flex-1">
            <div :class="[
                'min-h-full gap-4',
                isReviewMode 
                    ? 'grid grid-cols-1 xl:grid-cols-12 max-w-7xl mx-auto' 
                    : 'flex flex-col md:flex-row max-w-4xl xl:max-w-5xl 2xl:max-w-6xl mx-auto'
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
                                : 'light-mode bg-white/90 border-gray-200/50',
                            isReviewMode ? 'large-screen-review-enhanced' : ''
                        ]" 
                        :style="isReviewMode && getCurrentAnswer() ? {
                            borderTop: getCurrentAnswer().isCorrect 
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
                                    getCurrentAnswer().isCorrect
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

        <!-- Footer Navigation (Always visible on all screen sizes) -->
        <div :class="[
            'backdrop-blur-xl border-t px-4 fixed bottom-0 left-0 w-full z-50',
            'py-2 lg:py-4',
            isDark
                ? 'bg-gray-800/90 border-gray-700'
                : 'bg-gray-700 border-gray-800'
        ]">
            <div class="flex w-full gap-3 max-w-md mx-auto">
                <!-- Review Mode Navigation -->
                <div v-if="isReviewMode" class="flex w-full gap-2">
                    
                    <button @click="previousQuestion" :disabled="currentQuestionIndex === 0" :class="[
                        'px-4 py-2 lg:py-3 rounded-xl font-medium flex-1 transition-all',
                        currentQuestionIndex === 0
                            ? 'bg-gray-600 cursor-not-allowed opacity-50 text-gray-400'
                            : 'bg-gray-500 hover:bg-gray-600 text-white'
                    ]">
                        Previous
                    </button>
                    <button v-if="currentQuestionIndex < sampleQuestions.length - 1" @click="nextQuestion" :class="[
                        'px-4 py-2 lg:py-3 rounded-xl font-medium flex-1 text-white transition-all',
                        'bg-blue-500 hover:bg-blue-600'
                    ]">
                        Next
                    </button>
                    <button v-else @click="restartQuiz" :class="[
                        'px-4 py-2 lg:py-3 rounded-xl font-medium flex-1 text-white transition-all',
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
                            'px-4 py-2 lg:py-3 rounded-xl font-medium flex-1 transition-all',
                            currentQuestionIndex === 0
                                ? 'bg-gray-600 cursor-not-allowed opacity-50 text-gray-400'
                                : 'bg-gray-500 hover:bg-gray-600 text-white'
                        ]">
                        Previous
                    </button>
                    <button v-if="currentQuestionIndex < sampleQuestions.length - 1" @click="submitAnswer"
                        :disabled="!hasSelection || isSubmitting" :class="[
                            'px-4 py-2 lg:py-3 rounded-xl font-medium flex-1 text-white transition-all',
                            !hasSelection || isSubmitting
                                ? 'bg-gray-600 cursor-not-allowed opacity-50'
                                : 'bg-blue-500'
                        ]">
                        {{ isSubmitting ? 'Submitting...' : 'Submit Answer' }}
                    </button>
                    <button v-else @click="finishQuiz" :disabled="!hasSelection || isSubmitting" :class="[
                        'px-4 py-2 lg:py-3 rounded-xl font-medium flex-1 text-white transition-all',
                        !hasSelection || isSubmitting
                            ? 'bg-gray-600 cursor-not-allowed opacity-50'
                            : 'bg-rose-500 hover:bg-rose-600'
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

        <!-- Pause Modal - Diagnostic Quiz Style -->
        <Modal :show="showPauseModal" @close="resumeQuiz" :max-width="'md'">
            <div class="w-full max-w-md transform overflow-hidden rounded-2xl bg-white dark:bg-gray-800 p-6 shadow-xl transition-all">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">
                    Quiz Paused
                </h3>
                <p class="text-sm text-gray-500 dark:text-gray-400 mb-6">
                    Your quiz has been automatically paused due to 5 minutes of inactivity. You can resume from where you left off.
                </p>
                <div class="flex gap-3 justify-end">
                    <button
                        @click="resumeQuiz"
                        class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors"
                    >
                        Continue Test
                    </button>
                    <button
                        @click="confirmPause"
                        class="px-4 py-2 text-sm font-medium bg-red-600 hover:bg-red-700 text-white rounded-lg transition-colors"
                    >
                        Pause & Exit
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
// Remove hardcoded import - questions now come from database
// import { sampleQuestions } from '@/data/sampleQuestions.js';

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
            // Sample questions data (loaded from database)
            sampleQuestions: [],
            questionsLoaded: false,
            loadingError: null,
            // Analytics tracking
            sessionId: null,
            assessmentId: null,
            quizStartTime: null,
            analyticsEnabled: true, // Can be disabled for privacy
            backendScore: null, // Score from backend when available
        };
    },
    computed: {
        progressPercentage() {
            if (!this.sampleQuestions.length) return 0;
            return ((this.currentQuestionIndex + 1) / this.sampleQuestions.length) * 100;
        },
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
            // Use backend score if available (more accurate)
            if (this.backendScore !== null) {
                return this.backendScore;
            }
            // Otherwise calculate locally
            const correct = this.userAnswers.filter(a => a && a.isCorrect).length;
            return Math.round((correct / this.sampleQuestions.length) * 100);
        },
        correctCount() {
            return this.userAnswers.filter(a => a && a.isCorrect).length;
        }
    },
    methods: {
        async loadQuestions() {
            try {
                const response = await fetch('/api/sample-quiz/questions');
                const data = await response.json();
                
                if (data.success && data.questions.length > 0) {
                    this.sampleQuestions = data.questions;
                    this.questionsLoaded = true;
                    console.log(`Loaded ${data.questions.length} sample questions from database`);
                } else {
                    throw new Error(data.message || 'No sample questions found');
                }
            } catch (error) {
                console.error('Failed to load sample questions:', error);
                this.loadingError = error.message;
                this.questionsLoaded = false;
                
                // Show user-friendly error
                alert('Failed to load sample quiz questions. Please try refreshing the page.');
            }
        },
        
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
                this.resetAllTimers();

                // Reset inactivity timer
                this.resetInactivityTimer();

                // Reset scroll position to top of page
                window.scrollTo({ top: 0, behavior: 'smooth' });
                
                // Progress is automatically tracked server-side through individual responses
            } finally {
                // Reset submitting flag after a short delay to ensure UI updates
                setTimeout(() => {
                    this.isSubmitting = false;
                }, 300);
            }
        },
        async finishQuiz() {
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

                // Submit analytics data (async, don't wait for completion)
                this.submitAnalytics().catch(error => {
                    console.warn('Failed to submit analytics:', error);
                });

                // Stop all timers on quiz completion
                this.stopAllTimers();
                console.log('Quiz completed successfully - timers stopped');

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

            // Type 5: Matching (array of responses in correct order)
            if (type === 5) {
                const correctOptions = question.correct_options || [];
                if (!Array.isArray(userAnswer) || !Array.isArray(correctOptions)) return false;
                
                // Check if both arrays have the same length
                if (userAnswer.length !== correctOptions.length) return false;
                
                // Check if each element matches in order
                return userAnswer.every((answer, index) => answer === correctOptions[index]);
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
                // Normalize the correct options for comparison
                const normalizedCorrect = correctOptions.map(opt => opt.trim());
                
                if (Array.isArray(userAnswer)) {
                    // For array answers, check if the first element matches any correct option
                    return userAnswer.length > 0 && normalizedCorrect.includes(userAnswer[0].trim());
                }
                // For single answers, check if it matches any correct option
                return normalizedCorrect.includes(userAnswer.trim());
            }

            return false;
        },
        async reviewAnswers() {
            this.showResults = false;
            this.isReviewMode = true;
            this.currentQuestionIndex = 0;

            // Fetch responses from backend for accurate review
            await this.fetchResponsesForReview();

            // Load the first question's answer for review
            if (this.userAnswers[0]) {
                this.selectedOptions = this.userAnswers[0].selectedOptions;
            }
        },
        
        async fetchResponsesForReview() {
            if (!this.sessionId) {
                console.warn('No session ID available for fetching responses');
                return;
            }
            
            try {
                const response = await fetch('/api/sample-quiz/progress', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '',
                    },
                    body: JSON.stringify({
                        session_id: this.sessionId,
                    }),
                });
                
                if (response.ok) {
                    const data = await response.json();
                    
                    if (data.progress && data.progress.length > 0) {
                        // Update userAnswers with backend data
                        this.userAnswers = data.progress.map((resp) => ({
                            questionId: resp.question_id || resp.diagnostic_item_id,
                            selectedOptions: resp.selected_options || resp.user_answer,
                            isCorrect: resp.is_correct,
                            responseTime: resp.response_time_seconds,
                            metadata: resp.metadata || {}
                        }));
                        
                        // Update score from backend
                        if (data.assessment && data.assessment.score !== undefined) {
                            this.backendScore = data.assessment.score;
                        }
                        
                        console.log('Fetched responses from backend:', this.userAnswers.length);
                    }
                } else {
                    console.error('Failed to fetch responses:', response.status);
                }
            } catch (error) {
                console.error('Error fetching responses for review:', error);
                // Fallback to local data if fetch fails
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
                
                // Navigation state preserved server-side
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
                
                // Navigation state preserved server-side
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
        resetAllTimers() {
            // Reset the unified timer instance
            if (this.$refs.quizTimer) {
                this.$refs.quizTimer.resetQuestionTimer();
            }
        },
        pauseAllTimers() {
            // Pause the unified timer instance
            if (this.$refs.quizTimer) {
                this.$refs.quizTimer.pause();
            }
        },
        resumeAllTimers() {
            // Resume the unified timer instance
            if (this.$refs.quizTimer) {
                this.$refs.quizTimer.resume();
            }
        },
        stopAllTimers() {
            // Stop the unified timer instance completely and permanently
            if (this.$refs.quizTimer) {
                this.$refs.quizTimer.stop(); // Use stop() for permanent timer termination
            }
            
            // Clear inactivity timer
            if (this.inactivityTimer) {
                clearTimeout(this.inactivityTimer);
                this.inactivityTimer = null;
            }
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
                this.pauseAllTimers();
            });
        },
        resumeQuiz() {
            // Hide modal
            this.showPauseModal = false;
            
            // Resume the timer
            this.resumeAllTimers();
            
            // Reset inactivity timer
            this.resetInactivityTimer();
        },
        confirmPause() {
            // Hide modal and exit quiz
            this.showPauseModal = false;
            this.exitQuiz();
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
        
        // Analytics Methods

        async initializeSession() {
            // Server-side session tracking - always call assessment creation
            // Server will return existing assessment if user already has one in progress
            console.log('Initializing assessment session...');
            const assessmentData = await this.createAssessment();
            
            if (assessmentData) {
                this.sessionId = assessmentData.sessionId;
                this.assessmentId = assessmentData.assessmentId;
                this.quizStartTime = Date.now();
                
                if (assessmentData.isResumed) {
                    console.log('Resuming existing session:', assessmentData.sessionId);
                    // Get progress from server
                    await this.loadProgress();
                } else {
                    console.log('New assessment created:', assessmentData.assessment);
                }
                
                return assessmentData;
            }
            
            return null;
        },

        async loadProgress() {
            if (!this.sessionId) return;
            
            try {
                const response = await fetch('/api/sample-quiz/progress', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '',
                    },
                    body: JSON.stringify({
                        session_id: this.sessionId,
                    }),
                });
                
                if (response.ok) {
                    const data = await response.json();
                    
                    // Restore progress from server
                    if (data.progress && data.progress.length > 0) {
                        console.log(`Restored ${data.progress.length} answers, continuing from question ${data.current_question}`);
                        
                        // Convert server responses back to userAnswers format
                        this.userAnswers = [];
                        data.progress.forEach((response) => {
                            this.userAnswers[response.question_sequence - 1] = {
                                questionId: response.question_id,
                                selectedOptions: response.selected_options,
                                isCorrect: response.is_correct,
                                responseTime: response.response_time_seconds,
                            };
                        });
                        
                        // Set current question to first unanswered question
                        this.currentQuestionIndex = Math.min(data.current_question - 1, this.sampleQuestions.length - 1);
                        
                        // Load current question's answer if it exists
                        if (this.userAnswers[this.currentQuestionIndex]) {
                            this.selectedOptions = this.userAnswers[this.currentQuestionIndex].selectedOptions;
                        }
                    }
                }
            } catch (error) {
                console.warn('Failed to load progress:', error);
            }
        },

        async createAssessment() {
            if (!this.analyticsEnabled) return null;
            
            try {
                const response = await fetch('/api/sample-quiz/assessments', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '',
                    },
                    body: JSON.stringify({
                        type: 'sample',
                        total_questions: this.sampleQuestions.length
                    }),
                });
                
                if (response.ok) {
                    const data = await response.json();
                    return {
                        sessionId: data.assessment.session_id,
                        assessmentId: data.assessment.id,
                        assessment: data.assessment,
                        isResumed: data.is_resumed || false
                    };
                }
            } catch (error) {
                console.warn('Failed to create assessment:', error);
            }
            
            // Fallback: generate client-side session ID (for offline compatibility)
            return {
                sessionId: `sample_${Math.random().toString(36).substring(2)}_${Date.now()}`,
                assessmentId: null,
                assessment: null
            };
        },
        
        async submitAnalytics() {
            if (!this.analyticsEnabled || !this.sessionId) return;
            
            try {
                const completionTime = this.quizStartTime ? 
                    Math.floor((Date.now() - this.quizStartTime) / 1000) : 0;

                // Step 1: Store individual responses if using new normalized approach
                if (this.assessmentId) {
                    await this.storeAllResponses();
                }

                // Step 2: Complete the assessment
                const response = await fetch('/api/sample-quiz/complete-assessment', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '',
                    },
                    body: JSON.stringify({
                        session_id: this.sessionId,
                        completion_time_seconds: completionTime,
                    }),
                });
                
                if (response.ok) {
                    const result = await response.json();
                    console.log('Assessment completed successfully:', result);
                    
                    // Update score from backend if available
                    if (result.score !== undefined) {
                        this.backendScore = result.score;
                        console.log('Score updated from backend:', this.backendScore);
                    }
                } else {
                    console.warn('Failed to complete assessment:', response.status);
                    // Fallback to legacy approach
                    await this.submitAnalyticsLegacy();
                }
            } catch (error) {
                console.warn('Assessment completion error:', error);
                // Fallback to legacy approach
                await this.submitAnalyticsLegacy();
            }
        },

        async storeAllResponses() {
            // Store all responses using the normalized endpoint
            for (let index = 0; index < this.userAnswers.length; index++) {
                const answer = this.userAnswers[index];
                const question = this.sampleQuestions[index];
                
                if (answer && question) {
                    try {
                        await fetch('/api/sample-quiz/response', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '',
                            },
                            body: JSON.stringify({
                                session_id: this.sessionId,
                                question_id: question.id || index + 1,
                                question_sequence: index + 1,
                                selected_options: Array.isArray(answer.selectedOptions) ? 
                                    answer.selectedOptions : [answer.selectedOptions],
                                is_correct: answer.isCorrect || false,
                                response_time_seconds: answer.responseTime || null,
                                // Question metadata for analytics
                                question_type: this.getQuestionTypeForQuestion(question),
                                domain: question.domain,
                                topic: question.topic,
                                difficulty: question.difficulty,
                                bloom_level: question.bloom,
                                // Additional metadata (commands for type 7 simulation questions)
                                metadata: question.type_id === 7 && answer.commands ? {
                                    commands: answer.commands
                                } : null,
                            }),
                        });
                    } catch (error) {
                        console.warn(`Failed to store response for question ${index + 1}:`, error);
                    }
                }
            }
        },

        async submitAnalyticsLegacy() {
            // Legacy bulk submission approach (fallback)
            try {
                const completionTime = this.quizStartTime ? 
                    Math.floor((Date.now() - this.quizStartTime) / 1000) : 0;
                
                const formattedResponses = this.userAnswers.map((answer, index) => ({
                    question_id: this.sampleQuestions[index]?.id || index + 1,
                    selected_options: Array.isArray(answer.selectedOptions) ? 
                        answer.selectedOptions : [answer.selectedOptions],
                    is_correct: answer.isCorrect || false,
                    response_time: answer.responseTime || null,
                }));
                
                const analyticsData = {
                    session_id: this.sessionId,
                    responses: formattedResponses,
                    score: this.score,
                    completion_time_seconds: completionTime,
                    questions_count: this.sampleQuestions.length,
                    started_at: this.quizStartTime ? new Date(this.quizStartTime).toISOString() : null,
                };
                
                const response = await fetch('/api/sample-quiz/complete', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '',
                    },
                    body: JSON.stringify(analyticsData),
                });
                
                if (response.ok) {
                    const result = await response.json();
                    console.log('Legacy analytics submitted successfully:', result);
                } else {
                    console.warn('Failed to submit legacy analytics:', response.status);
                }
            } catch (error) {
                console.warn('Legacy analytics submission error:', error);
            }
        },

        getQuestionTypeForQuestion(question) {
            // Use the actual question type name from database if available
            if (question?.question_type?.name) {
                return question.question_type.name;
            }
            
            // Fallback to mapping for backward compatibility
            const typeMap = {
                1: 'Multiple Choice Question',
                2: 'Multiple Select Question', 
                3: 'Drag & Drop – Select',
                4: 'Drag & Drop – Order',
                5: 'Matching Pairs',
                6: 'Hot Spot',
                7: 'Command Line'
            };
            return typeMap[question?.type_id] || 'Multiple Choice Question';
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
        },
        
        disableZoom() {
            // Add meta viewport tag to prevent zoom
            const metaViewport = document.querySelector('meta[name="viewport"]');
            if (metaViewport) {
                metaViewport.setAttribute('content', 'width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no');
            } else {
                const meta = document.createElement('meta');
                meta.name = 'viewport';
                meta.content = 'width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no';
                document.head.appendChild(meta);
            }
            
            // CSS touch-action
            document.body.style.touchAction = 'manipulation';
            
            // Prevent zoom with keyboard shortcuts
            this.preventZoomKeyboard = (e) => {
                if ((e.ctrlKey || e.metaKey) && (e.key === '+' || e.key === '-' || e.key === '0' || e.key === '=')) {
                    e.preventDefault();
                }
            };
            
            // Prevent zoom with mouse wheel
            this.preventZoomWheel = (e) => {
                if (e.ctrlKey || e.metaKey) {
                    e.preventDefault();
                }
            };
            
            document.addEventListener('keydown', this.preventZoomKeyboard);
            document.addEventListener('wheel', this.preventZoomWheel, { passive: false });
        },
        
        enableZoom() {
            // Restore original viewport
            const metaViewport = document.querySelector('meta[name="viewport"]');
            if (metaViewport) {
                metaViewport.setAttribute('content', 'width=device-width, initial-scale=1.0');
            }
            
            // Restore touch action
            document.body.style.touchAction = '';
            
            // Remove event listeners
            if (this.preventZoomKeyboard) {
                document.removeEventListener('keydown', this.preventZoomKeyboard);
            }
            if (this.preventZoomWheel) {
                document.removeEventListener('wheel', this.preventZoomWheel);
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
    async mounted() {
        // Set dark theme as default
        if (typeof window !== 'undefined') {
            this.isDark = true;
            document.documentElement.classList.add('dark');
            document.documentElement.classList.remove('light');
        }
        
        // Disable zoom for sample quiz
        this.disableZoom();
        
        // Load questions from database first
        await this.loadQuestions();
        
        // Initialize analytics tracking with session persistence
        if (this.analyticsEnabled && this.questionsLoaded) {
            await this.initializeSession();
        }
        
        // Start inactivity timer only if questions loaded
        if (this.questionsLoaded) {
            this.resetInactivityTimer();
        }
        
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
        
        // Re-enable zoom when leaving the page
        this.enableZoom();
        
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

/* Large screen review enhanced styling */
.large-screen-review-enhanced {
    padding: 1.5rem !important;
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