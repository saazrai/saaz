<template>
    <div :class="[
        'min-h-screen flex flex-col pb-40',
        isDark ? 'bg-gray-900' : 'bg-gray-300'
    ]">
        <!-- Top Navbar -->
        <div :class="[
            'backdrop-blur-xl border-b px-4 sm:px-8 py-3 sm:py-4 flex flex-wrap items-center justify-between gap-4',
            isDark
                ? 'bg-gray-800 border-gray-700 shadow-lg'
                : 'bg-gray-700 border-gray-800 shadow-lg shadow-gray-800/20'
        ]">
            <div class="w-full flex flex-col lg:flex-row lg:items-center lg:justify-between gap-2">
                <div :class="[
                    'flex-1 min-w-[50%] md:text-base xl:text-2xl font-semibold truncate',
                    isDark ? 'text-gray-100' : 'text-white'
                ]">
                    Sample Diagnostic Quiz
                </div>
                <div class="sm:w-auto flex items-center gap-4">
                    <!-- Timer -->
                    <div class="hidden sm:block">
                        <div :class="isDark ? '' : '[&_span]:!text-white [&_span]:!text-gray-200'">
                            <QuizTimer :isReview="isReviewMode" @question-tick="onQuestionTick" ref="timer" />
                        </div>
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
                            : 'bg-red-600/20 hover:bg-red-600/30 text-red-300 border border-red-700'
                    ]" aria-label="Exit quiz">
                        <XMarkIcon class="w-4 h-4" />
                        <span class="hidden sm:inline">Exit Quiz</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Progress Section -->
        <div :class="[
            'backdrop-blur-xl border-b px-4 sm:px-8 py-3',
            isDark
                ? 'bg-gray-800/50 border-gray-700 shadow'
                : 'bg-gray-600 border-gray-700 shadow-md'
        ]">
            <!-- Desktop Progress -->
            <div class="hidden sm:flex items-center justify-between gap-4">
                <div :class="[
                    'md:text-base xl:text-xl font-semibold truncate',
                    isDark ? 'text-gray-200' : 'text-white'
                ]">
                    Question {{ currentQuestionIndex + 1 }} / {{ sampleQuestions.length }}
                </div>

                <div class="flex-grow">
                    <div :class="[
                        'w-full border shadow-inner rounded-full h-4 overflow-hidden',
                        isDark ? 'bg-gray-700 border-gray-600' : 'bg-gray-100 border-gray-300'
                    ]">
                        <div :class="[
                            'h-4 transition-all duration-300 shadow-sm',
                            isDark ? 'bg-blue-500' : 'bg-blue-500'
                        ]" :style="{ width: `${progress}%` }"></div>
                    </div>
                </div>
            </div>

            <!-- Mobile Progress and Timer -->
            <div class="sm:hidden space-y-3">
                <div class="flex items-center justify-between">
                    <div :class="[
                        'text-base font-semibold',
                        isDark ? 'text-gray-200' : 'text-white'
                    ]">
                        Question {{ currentQuestionIndex + 1 }} / {{ sampleQuestions.length }}
                    </div>
                </div>

                <div :class="[
                    'w-full border shadow-inner rounded-full h-4 overflow-hidden',
                    isDark ? 'bg-gray-700 border-gray-600' : 'bg-gray-100 border-gray-300'
                ]">
                    <div :class="[
                        'h-4 transition-all duration-300 shadow-sm',
                        isDark ? 'bg-blue-500' : 'bg-blue-500'
                    ]" :style="{ width: `${progress}%` }"></div>
                </div>

                <!-- Mobile Timer -->
                <div :class="isDark ? '' : '[&_span]:!text-white [&_span]:!text-gray-200'">
                    <QuizTimer :isReview="isReviewMode" @question-tick="onQuestionTick" ref="mobileTimer" />
                </div>
            </div>
        </div>


        <!-- Question Section -->
        <div class="mx-2 sm:mx-4 md:mx-6 lg:mx-8 my-4 rounded-md flex-1 overflow-hidden">
            <div class="flex flex-col md:flex-row h-full gap-4">
                <div class="flex-1">
                    <div class="flex flex-col lg:flex-row bg-transparent space-y-4 lg:space-y-0">
                        <component :is="currentQuestionComponent" :question="currentQuestionForDisplay"
                            :answer="currentAnswerForDisplay" :isReview="isReviewMode" :isDarkMode="isDark"
                            @selected="selected" v-if="currentQuestion"
                            :class="['diagnostic-question', isDark ? 'dark-mode' : 'light-mode']" />
                    </div>
                </div>

                <!-- Question Metadata Section -->
                <div :class="[
                    'backdrop-blur-md rounded-2xl w-full lg:w-2/6 p-6 border',
                    isDark
                        ? 'bg-gray-800 border-gray-700 shadow-xl'
                        : 'bg-white border-gray-200 shadow-sm'
                ]">
                    <h3 :class="[
                        'text-xl font-bold mb-6 pb-3 border-b',
                        isDark
                            ? 'text-gray-100 border-gray-700'
                            : 'text-slate-900 border-slate-200'
                    ]">
                        Question Details
                    </h3>

                    <!-- Metadata Grid -->
                    <div class="space-y-4">
                        <!-- Domain -->
                        <div class="flex flex-col space-y-1">
                            <span :class="[
                                'text-xs uppercase tracking-wider font-semibold',
                                isDark ? 'text-gray-400' : 'text-slate-500'
                            ]">
                                Domain
                            </span>
                            <span :class="[
                                'text-lg font-medium',
                                isDark ? 'text-gray-200' : 'text-slate-800'
                            ]">
                                {{ currentQuestion?.domain || "N/A" }}
                            </span>
                        </div>

                        <!-- Topic -->
                        <div class="flex flex-col space-y-1">
                            <span :class="[
                                'text-xs uppercase tracking-wider font-semibold',
                                isDark ? 'text-gray-400' : 'text-slate-500'
                            ]">
                                Topic
                            </span>
                            <span :class="[
                                'text-lg font-medium',
                                isDark ? 'text-gray-200' : 'text-slate-800'
                            ]">
                                {{ currentQuestion?.topic || "N/A" }}
                            </span>
                        </div>

                        <!-- Dimension -->
                        <div class="flex flex-col space-y-1">
                            <span :class="[
                                'text-xs uppercase tracking-wider font-semibold',
                                isDark ? 'text-gray-400' : 'text-slate-500'
                            ]">
                                Dimension
                            </span>
                            <span :class="[
                                'text-lg font-medium',
                                isDark ? 'text-gray-200' : 'text-slate-800'
                            ]">
                                {{ currentQuestion?.dimension || "N/A" }}
                            </span>
                        </div>

                        <!-- Question Type -->
                        <div class="flex flex-col space-y-1">
                            <span :class="[
                                'text-xs uppercase tracking-wider font-semibold',
                                isDark ? 'text-gray-400' : 'text-slate-500'
                            ]">
                                Question Type
                            </span>
                            <span :class="[
                                'text-lg font-medium',
                                isDark ? 'text-gray-200' : 'text-slate-800'
                            ]">
                                {{ getQuestionTypeName() }}
                            </span>
                        </div>

                        <!-- Difficulty Level -->
                        <div class="flex flex-col space-y-1">
                            <div class="flex items-center space-x-2">
                                <span :class="[
                                    'text-xs uppercase tracking-wider font-semibold',
                                    isDark ? 'text-gray-400' : 'text-slate-500'
                                ]">
                                    Difficulty Level
                                </span>
                                <!-- Desktop Tooltip -->
                                <Popover class="relative hidden sm:block">
                                    <PopoverButton :class="[
                                        'p-0.5 rounded-full transition-colors focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-1',
                                        isDark 
                                            ? 'hover:bg-gray-700 focus-visible:ring-gray-600 focus-visible:ring-offset-gray-800' 
                                            : 'hover:bg-slate-100 focus-visible:ring-slate-400 focus-visible:ring-offset-white'
                                    ]">
                                        <QuestionMarkCircleIcon :class="[
                                            'h-4 w-4',
                                            isDark ? 'text-gray-500 hover:text-gray-400' : 'text-slate-400 hover:text-slate-600'
                                        ]" />
                                    </PopoverButton>

                                    <transition
                                        enter-active-class="transition duration-200 ease-out"
                                        enter-from-class="-translate-x-1 opacity-0"
                                        enter-to-class="translate-x-0 opacity-100"
                                        leave-active-class="transition duration-150 ease-in"
                                        leave-from-class="translate-x-0 opacity-100"
                                        leave-to-class="-translate-x-1 opacity-0"
                                    >
                                        <PopoverPanel :class="[
                                            'absolute z-50 w-80 px-4 py-3 rounded-lg shadow-xl border',
                                            // Position to the right of the icon
                                            'left-full ml-2 top-1/2 -translate-y-1/2',
                                            // Ensure it stays within viewport
                                            'max-h-[calc(100vh-4rem)] overflow-y-auto',
                                            isDark 
                                                ? 'bg-gray-800 border-gray-700' 
                                                : 'bg-white border-gray-200'
                                        ]">
                                            <!-- Arrow pointing to the left -->
                                            <div :class="[
                                                'absolute -left-2 top-1/2 -translate-y-1/2 w-4 h-4 transform rotate-45',
                                                isDark ? 'bg-gray-800 border-l border-b border-gray-700' : 'bg-white border-l border-b border-gray-200'
                                            ]"></div>

                                            <div class="space-y-3 relative">
                                                <h4 :class="[
                                                    'text-base font-semibold flex items-center gap-2',
                                                    isDark ? 'text-gray-100' : 'text-gray-900'
                                                ]">
                                                    ❓ Difficulty Level?
                                                </h4>
                                                <p :class="[
                                                    'text-sm leading-relaxed',
                                                    isDark ? 'text-gray-300' : 'text-gray-600'
                                                ]">
                                                    Each question is rated by how challenging it is:
                                                </p>
                                                <ul :class="[
                                                    'text-sm space-y-1',
                                                    isDark ? 'text-gray-300' : 'text-gray-600'
                                                ]">
                                                    <li>• <span class="font-medium">1 – Very Easy:</span> Basic facts or definitions</li>
                                                    <li>• <span class="font-medium">2 – Easy:</span> Simple application of key concepts</li>
                                                    <li>• <span class="font-medium">3 – Medium:</span> Involves moderate reasoning or scenarios</li>
                                                    <li>• <span class="font-medium">4 – Hard:</span> Requires deep analysis and multi-step thinking</li>
                                                    <li>• <span class="font-medium">5 – Very Hard:</span> Complex, expert-level questions</li>
                                                </ul>
                                                <p :class="[
                                                    'text-sm pt-2 border-t',
                                                    isDark ? 'text-gray-400 border-gray-700' : 'text-gray-500 border-gray-200'
                                                ]">
                                                    Helps the system adapt to your skill level!
                                                </p>
                                            </div>
                                        </PopoverPanel>
                                    </transition>
                                </Popover>
                                <!-- Mobile Tooltip Button -->
                                <button 
                                    @click="showDifficultyModal = true"
                                    class="sm:hidden p-0.5 rounded-full transition-colors focus:outline-none focus:ring-2 focus:ring-offset-1"
                                    :class="[
                                        isDark 
                                            ? 'hover:bg-gray-700 focus:ring-gray-600 focus:ring-offset-gray-800' 
                                            : 'hover:bg-slate-100 focus:ring-slate-400 focus:ring-offset-white'
                                    ]"
                                >
                                    <QuestionMarkCircleIcon :class="[
                                        'h-4 w-4',
                                        isDark ? 'text-gray-500 hover:text-gray-400' : 'text-slate-400 hover:text-slate-600'
                                    ]" />
                                </button>
                            </div>
                            <div class="flex items-end space-x-3">
                                <span :class="[
                                    'text-lg font-medium leading-none pb-0.5',
                                    isDark ? 'text-gray-200' : 'text-slate-800'
                                ]">
                                    {{ currentQuestion?.difficulty || "N/A" }}
                                </span>
                                <BarChartLevelIndicator 
                                    :totalBars="5"
                                    :filledBars="getDifficultyScore()"
                                    :showLabel="false"
                                    :containerClass="'flex items-end pb-1'"
                                    :baseHeight="8"
                                    :heightIncrement="3" />
                            </div>
                        </div>

                        <!-- Bloom Level -->
                        <div class="flex flex-col space-y-1">
                            <div class="flex items-center space-x-2">
                                <span :class="[
                                    'text-xs uppercase tracking-wider font-semibold',
                                    isDark ? 'text-gray-400' : 'text-slate-500'
                                ]">
                                    Bloom Level
                                </span>
                                <!-- Desktop Tooltip -->
                                <Popover class="relative hidden sm:block">
                                    <PopoverButton :class="[
                                        'p-0.5 rounded-full transition-colors focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-1',
                                        isDark 
                                            ? 'hover:bg-gray-700 focus-visible:ring-gray-600 focus-visible:ring-offset-gray-800' 
                                            : 'hover:bg-slate-100 focus-visible:ring-slate-400 focus-visible:ring-offset-white'
                                    ]">
                                        <QuestionMarkCircleIcon :class="[
                                            'h-4 w-4',
                                            isDark ? 'text-gray-500 hover:text-gray-400' : 'text-slate-400 hover:text-slate-600'
                                        ]" />
                                    </PopoverButton>

                                    <transition
                                        enter-active-class="transition duration-200 ease-out"
                                        enter-from-class="-translate-x-1 opacity-0"
                                        enter-to-class="translate-x-0 opacity-100"
                                        leave-active-class="transition duration-150 ease-in"
                                        leave-from-class="translate-x-0 opacity-100"
                                        leave-to-class="-translate-x-1 opacity-0"
                                    >
                                        <PopoverPanel :class="[
                                            'absolute z-50 w-80 px-4 py-3 rounded-lg shadow-xl border',
                                            // Position to the right of the icon
                                            'left-full ml-2 top-1/2 -translate-y-1/2',
                                            // Ensure it stays within viewport
                                            'max-h-[calc(100vh-4rem)] overflow-y-auto',
                                            isDark 
                                                ? 'bg-gray-800 border-gray-700' 
                                                : 'bg-white border-gray-200'
                                        ]">
                                            <!-- Arrow pointing to the left -->
                                            <div :class="[
                                                'absolute -left-2 top-1/2 -translate-y-1/2 w-4 h-4 transform rotate-45',
                                                isDark ? 'bg-gray-800 border-l border-b border-gray-700' : 'bg-white border-l border-b border-gray-200'
                                            ]"></div>

                                            <div class="space-y-3 relative">
                                                <h4 :class="[
                                                    'text-base font-semibold flex items-center gap-2',
                                                    isDark ? 'text-gray-100' : 'text-gray-900'
                                                ]">
                                                    💡 Bloom's Taxonomy Levels
                                                </h4>
                                                <p :class="[
                                                    'text-sm leading-relaxed',
                                                    isDark ? 'text-gray-300' : 'text-gray-600'
                                                ]">
                                                    A framework that measures the depth of understanding:
                                                </p>
                                                <div :class="[
                                                    'text-sm space-y-2 pl-2',
                                                    isDark ? 'text-gray-300' : 'text-gray-600'
                                                ]">
                                                    <div class="flex items-start gap-2">
                                                        <span class="font-bold text-blue-500">1.</span>
                                                        <div>
                                                            <span class="font-semibold">Remember</span>
                                                            <span class="text-xs block opacity-80">Recall facts and basic concepts</span>
                                                        </div>
                                                    </div>
                                                    <div class="flex items-start gap-2">
                                                        <span class="font-bold text-blue-500">2.</span>
                                                        <div>
                                                            <span class="font-semibold">Understand</span>
                                                            <span class="text-xs block opacity-80">Explain ideas or concepts</span>
                                                        </div>
                                                    </div>
                                                    <div class="flex items-start gap-2">
                                                        <span class="font-bold text-green-500">3.</span>
                                                        <div>
                                                            <span class="font-semibold">Apply</span>
                                                            <span class="text-xs block opacity-80">Use information in new situations</span>
                                                        </div>
                                                    </div>
                                                    <div class="flex items-start gap-2">
                                                        <span class="font-bold text-green-500">4.</span>
                                                        <div>
                                                            <span class="font-semibold">Analyze</span>
                                                            <span class="text-xs block opacity-80">Draw connections among ideas</span>
                                                        </div>
                                                    </div>
                                                    <div class="flex items-start gap-2">
                                                        <span class="font-bold text-orange-500">5.</span>
                                                        <div>
                                                            <span class="font-semibold">Evaluate</span>
                                                            <span class="text-xs block opacity-80">Justify decisions or judgments</span>
                                                        </div>
                                                    </div>
                                                    <div class="flex items-start gap-2">
                                                        <span class="font-bold text-red-500">6.</span>
                                                        <div>
                                                            <span class="font-semibold">Create</span>
                                                            <span class="text-xs block opacity-80">Produce new or original work</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <p :class="[
                                                    'text-xs pt-2 border-t italic',
                                                    isDark ? 'text-gray-400 border-gray-700' : 'text-gray-500 border-gray-200'
                                                ]">
                                                    The assessment adapts difficulty based on your performance at each level.
                                                </p>
                                            </div>
                                        </PopoverPanel>
                                    </transition>
                                </Popover>
                                <!-- Mobile Tooltip Button -->
                                <button 
                                    @click="showBloomModal = true"
                                    class="sm:hidden p-0.5 rounded-full transition-colors focus:outline-none focus:ring-2 focus:ring-offset-1"
                                    :class="[
                                        isDark 
                                            ? 'hover:bg-gray-700 focus:ring-gray-600 focus:ring-offset-gray-800' 
                                            : 'hover:bg-slate-100 focus:ring-slate-400 focus:ring-offset-white'
                                    ]"
                                >
                                    <QuestionMarkCircleIcon :class="[
                                        'h-4 w-4',
                                        isDark ? 'text-gray-500 hover:text-gray-400' : 'text-slate-400 hover:text-slate-600'
                                    ]" />
                                </button>
                            </div>
                            <div class="flex items-end space-x-3">
                                <span :class="[
                                    'text-lg font-medium leading-none pb-0.5',
                                    isDark ? 'text-gray-200' : 'text-slate-800'
                                ]">
                                    {{ currentQuestion?.bloom || "N/A" }}
                                </span>
                                <BarChartLevelIndicator 
                                    :totalBars="6"
                                    :filledBars="getBloomScore()"
                                    :showLabel="false"
                                    :containerClass="'flex items-end pb-1'"
                                    :baseHeight="8"
                                    :heightIncrement="3" />
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Notice Banner -->
            <div v-if="!isReviewMode" class="mt-6 mx-2">
                <div :class="[
                    'rounded-lg p-4 border',
                    isDark
                        ? 'bg-blue-900/20 border-blue-600 text-blue-200'
                        : 'bg-blue-50 border-blue-300 text-blue-800'
                ]">
                    <p class="text-base">
                        <strong>Note:</strong> This is a sample quiz for demonstration purposes. Your answers won't be
                        saved.
                        <Link
                            :href="typeof route !== 'undefined' ? route('assessments.diagnostics.index') : '/diagnostics'"
                            class="underline hover:no-underline font-semibold">
                        Take the full diagnostic assessment
                        </Link> to receive personalized results and recommendations.
                    </p>
                </div>
            </div>
        </div>

        <!-- Footer Controls -->
        <div :class="[
            'backdrop-blur-xl border-t py-4 px-4 fixed bottom-0 left-0 w-full z-50',
            isDark
                ? 'bg-gray-800/90 border-gray-700 shadow-2xl'
                : 'bg-gray-700 border-gray-800 shadow-2xl shadow-gray-800/30'
        ]">
            <div class="flex w-full gap-2 md:max-w-xl md:mx-auto">
                <!-- Review Mode Navigation -->
                <div v-if="isReviewMode" class="flex w-full gap-2">
                    <button @click="previousQuestion" :disabled="currentQuestionIndex === 0" :class="[
                        'px-5 py-3 rounded-lg font-semibold flex-1 backdrop-blur-md border transition-all transform active:scale-95',
                        currentQuestionIndex === 0
                            ? (isDark
                                ? 'bg-gray-600 border-gray-500 cursor-not-allowed opacity-50 text-gray-400'
                                : 'bg-gray-500 border-gray-600 cursor-not-allowed opacity-60 text-gray-300')
                            : 'bg-gray-500 hover:bg-gray-600 border-gray-400 text-white'
                    ]">
                        Previous
                    </button>
                    <button v-if="currentQuestionIndex < sampleQuestions.length - 1" @click="nextQuestion" :class="[
                        'px-5 py-3 rounded-lg font-semibold flex-1 backdrop-blur-md border text-white transition-all transform active:scale-95',
                        'bg-blue-500 hover:bg-blue-600 border-blue-400'
                    ]">
                        Next
                    </button>
                    <button v-else @click="restartQuiz" :class="[
                        'px-5 py-3 rounded-lg font-semibold flex-1 backdrop-blur-md border text-white transition-all transform active:scale-95',
                        isDark
                            ? 'bg-emerald-600 hover:bg-emerald-700 border-emerald-500'
                            : 'bg-emerald-600 hover:bg-emerald-700 border-emerald-500'
                    ]">
                        Restart Quiz
                    </button>
                </div>

                <!-- Quiz Mode Controls -->
                <div v-else class="flex w-full gap-2">
                    <button @click="goToPreviousQuestion" 
                        :disabled="currentQuestionIndex === 0" 
                        :class="[
                            'px-5 py-3 rounded-lg font-semibold flex-1 backdrop-blur-md border transition-all transform',
                            currentQuestionIndex === 0
                                ? (isDark
                                    ? 'bg-gray-600 border-gray-500 cursor-not-allowed opacity-50 text-gray-400'
                                    : 'bg-gray-500 border-gray-600 cursor-not-allowed opacity-60 text-gray-300')
                                : 'bg-gray-500 hover:bg-gray-600 border-gray-400 text-white active:scale-95'
                        ]">
                        Previous
                    </button>
                    <button v-if="currentQuestionIndex < sampleQuestions.length - 1" @click="submitAnswer"
                        :disabled="!hasSelection" :class="[
                            'px-5 py-3 rounded-lg font-semibold flex-1 backdrop-blur-md border text-white transition-all transform active:scale-95 shadow-lg',
                            !hasSelection
                                ? (isDark
                                    ? 'bg-gray-600 border-gray-500 cursor-not-allowed opacity-50'
                                    : 'bg-gray-400 border-gray-300 cursor-not-allowed opacity-60')
                                : 'bg-blue-500 hover:bg-blue-600 border-blue-400 text-white hover:shadow-blue-500/25'
                        ]">
                        Submit Answer
                    </button>
                    <button v-else @click="finishQuiz" :disabled="!hasSelection" :class="[
                        'px-5 py-3 rounded-lg font-semibold flex-1 backdrop-blur-md border text-white transition-all transform active:scale-95 shadow-lg',
                        !hasSelection
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

        <!-- Results Modal -->
        <Modal :show="showResults" @close="closeResults" :max-width="'2xl'">
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

                <div class="flex gap-3">
                    <button @click="reviewAnswers" :class="[
                        'px-4 py-2 rounded-lg font-semibold transition-colors',
                        isDark
                            ? 'bg-gray-700 hover:bg-gray-600 text-white'
                            : 'bg-gray-200 hover:bg-gray-300 text-gray-800'
                    ]">
                        Review Answers
                    </button>
                    <Link :href="typeof route !== 'undefined' ? route('assessments.diagnostics.index') : '/diagnostics'"
                        :class="[
                            'px-4 py-2 rounded-lg font-semibold transition-colors',
                            'bg-blue-600 hover:bg-blue-700 text-white'
                        ]">
                    Take Full Assessment
                    </Link>
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
                        : 'bg-gray-50 border-gray-200 shadow-sm'
                ]">
                    <div class="flex items-start space-x-3">
                        <div :class="[
                            'flex-shrink-0 w-5 h-5 rounded-full flex items-center justify-center mt-0.5',
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
                                To help prevent fatigue and ensure accurate responses, the quiz automatically pauses after 30 seconds of inactivity.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-center">
                    <button @click="resumeQuiz" :class="[
                        'px-8 py-3 rounded-xl font-semibold text-white transition-all duration-200 transform hover:scale-105 focus:outline-none focus:ring-4 focus:ring-blue-500/30 shadow-lg hover:shadow-xl',
                        isDark 
                            ? 'bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 shadow-blue-500/25 hover:shadow-blue-500/40' 
                            : 'bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 shadow-blue-500/30 hover:shadow-blue-500/50'
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

export default {
    layout: null, // No layout for sample quiz
    components: {
        Link,
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
            answer: this.initialAnswer(),
            userAnswers: [],
            isReviewMode: false,
            showResults: false,
            isDark: false,
            showPauseModal: false,
            showExitConfirmation: false,
            showDifficultyModal: false,
            showBloomModal: false,
            inactivityTimer: null,
            lastActivity: Date.now(),
            commandHistory: [], // For Type7 terminal commands
            // Sample questions data
            sampleQuestions: [
                {
                    id: 1,
                    type_id: 7, // Simulation
                    question_type: { id: 7, name: 'Simulation', code: 'simulation' },
                    content: "Using the command line, determine the **MAC address** of the primary network interface (eth0) on this system. (You may use Linux or Windows commands)",
                    options: [
                        "00:1B:44:11:3A:B7",
                        "02:42:AC:11:00:02", 
                        "00:0C:29:4F:8E:35",
                        "A8:6D:AA:5F:92:C4"
                    ],
                    correct_options: ["00:1B:44:11:3A:B7"],
                    justifications: [
                        "This is the correct MAC address of the primary network interface. You can verify this using commands like 'ifconfig', 'ip addr', 'ipconfig /all' (Windows), or 'getmac'.",
                        "This appears to be a Docker container's virtual MAC address, not the primary network interface.",
                        "This looks like a VMware virtual machine's MAC address, not the primary physical interface.",
                        "This is a valid MAC address format, but it is not the MAC address of the primary network interface on this system."
                    ],
                    settings: {
                        "shell": "bash",
                        "clearCommand": "clear",
                        "errorMessages": {
                            "commandNotFound": "$COMMAND: command not found",
                            "permissionDenied": "$COMMAND: permission denied"
                        },
                        "commands": [
                            // Linux/Unix commands
                            {
                                "pattern": "^ifconfig$",
                                "response": "eth0: flags=4163<UP,BROADCAST,RUNNING,MULTICAST>  mtu 1500\n        inet 192.168.1.100  netmask 255.255.255.0  broadcast 192.168.1.255\n        inet6 fe80::21b:44ff:fe11:3ab7  prefixlen 64  scopeid 0x20<link>\n        ether 00:1b:44:11:3a:b7  txqueuelen 1000  (Ethernet)\n        RX packets 128420  bytes 95234567 (90.8 MiB)\n        RX errors 0  dropped 0  overruns 0  frame 0\n        TX packets 84321  bytes 12345678 (11.8 MiB)\n        TX errors 0  dropped 0 overruns 0  carrier 0  collisions 0\n\nlo: flags=73<UP,LOOPBACK,RUNNING>  mtu 65536\n        inet 127.0.0.1  netmask 255.0.0.0\n        inet6 ::1  prefixlen 128  scopeid 0x10<host>\n        loop  txqueuelen 1000  (Local Loopback)\n        RX packets 82  bytes 8120 (7.9 KiB)\n        RX errors 0  dropped 0  overruns 0  frame 0\n        TX packets 82  bytes 8120 (7.9 KiB)\n        TX errors 0  dropped 0 overruns 0  carrier 0  collisions 0"
                            },
                            {
                                "pattern": "^ifconfig eth0$",
                                "response": "eth0: flags=4163<UP,BROADCAST,RUNNING,MULTICAST>  mtu 1500\n        inet 192.168.1.100  netmask 255.255.255.0  broadcast 192.168.1.255\n        inet6 fe80::21b:44ff:fe11:3ab7  prefixlen 64  scopeid 0x20<link>\n        ether 00:1b:44:11:3a:b7  txqueuelen 1000  (Ethernet)\n        RX packets 128420  bytes 95234567 (90.8 MiB)\n        RX errors 0  dropped 0  overruns 0  frame 0\n        TX packets 84321  bytes 12345678 (11.8 MiB)\n        TX errors 0  dropped 0 overruns 0  carrier 0  collisions 0"
                            },
                            {
                                "pattern": "^ip addr$|^ip addr show$|^ip a$",
                                "response": "1: lo: <LOOPBACK,UP,LOWER_UP> mtu 65536 qdisc noqueue state UNKNOWN group default qlen 1000\n    link/loopback 00:00:00:00:00:00 brd 00:00:00:00:00:00\n    inet 127.0.0.1/8 scope host lo\n       valid_lft forever preferred_lft forever\n    inet6 ::1/128 scope host\n       valid_lft forever preferred_lft forever\n2: eth0: <BROADCAST,MULTICAST,UP,LOWER_UP> mtu 1500 qdisc pfifo_fast state UP group default qlen 1000\n    link/ether 00:1b:44:11:3a:b7 brd ff:ff:ff:ff:ff:ff\n    inet 192.168.1.100/24 brd 192.168.1.255 scope global dynamic noprefixroute eth0\n       valid_lft 86389sec preferred_lft 86389sec\n    inet6 fe80::21b:44ff:fe11:3ab7/64 scope link noprefixroute\n       valid_lft forever preferred_lft forever"
                            },
                            {
                                "pattern": "^ip link$|^ip link show$|^ip l$",
                                "response": "1: lo: <LOOPBACK,UP,LOWER_UP> mtu 65536 qdisc noqueue state UNKNOWN mode DEFAULT group default qlen 1000\n    link/loopback 00:00:00:00:00:00 brd 00:00:00:00:00:00\n2: eth0: <BROADCAST,MULTICAST,UP,LOWER_UP> mtu 1500 qdisc pfifo_fast state UP mode DEFAULT group default qlen 1000\n    link/ether 00:1b:44:11:3a:b7 brd ff:ff:ff:ff:ff:ff"
                            },
                            {
                                "pattern": "^hostname -I$",
                                "response": "192.168.1.100 fe80::21b:44ff:fe11:3ab7"
                            },
                            {
                                "pattern": "^cat /sys/class/net/eth0/address$",
                                "response": "00:1b:44:11:3a:b7"
                            },
                            {
                                "pattern": "^getmac$",
                                "response": "Physical Address    Transport Name\n=================== ==================================================\n00-1B-44-11-3A-B7   \\Device\\Tcpip_{B8E2A55C-7D17-4C85-A88B-123456789012}"
                            },
                            // Windows commands
                            {
                                "pattern": "^ipconfig$",
                                "response": "Windows IP Configuration\n\n\nEthernet adapter Ethernet:\n\n   Connection-specific DNS Suffix  . : \n   Link-local IPv6 Address . . . . . : fe80::21b:44ff:fe11:3ab7%12\n   IPv4 Address. . . . . . . . . . . : 192.168.1.100\n   Subnet Mask . . . . . . . . . . . : 255.255.255.0\n   Default Gateway . . . . . . . . . : 192.168.1.1\n\nWireless LAN adapter Local Area Connection* 1:\n\n   Media State . . . . . . . . . . . : Media disconnected\n   Connection-specific DNS Suffix  . : \n\nWireless LAN adapter Wi-Fi:\n\n   Media State . . . . . . . . . . . : Media disconnected\n   Connection-specific DNS Suffix  . : \n\nEthernet adapter Bluetooth Network Connection:\n\n   Media State . . . . . . . . . . . : Media disconnected\n   Connection-specific DNS Suffix  . :"
                            },
                            {
                                "pattern": "^ipconfig /all$",
                                "response": "Windows IP Configuration\n\n   Host Name . . . . . . . . . . . . : DESKTOP-ABC123\n   Primary Dns Suffix  . . . . . . . : \n   Node Type . . . . . . . . . . . . : Hybrid\n   IP Routing Enabled. . . . . . . . : No\n   WINS Proxy Enabled. . . . . . . . : No\n\nEthernet adapter Ethernet:\n\n   Connection-specific DNS Suffix  . : \n   Description . . . . . . . . . . . : Intel(R) Ethernet Connection\n   Physical Address. . . . . . . . . : 00-1B-44-11-3A-B7\n   DHCP Enabled. . . . . . . . . . . : Yes\n   Autoconfiguration Enabled . . . . : Yes\n   Link-local IPv6 Address . . . . . : fe80::21b:44ff:fe11:3ab7%12(Preferred)\n   IPv4 Address. . . . . . . . . . . : 192.168.1.100(Preferred)\n   Subnet Mask . . . . . . . . . . . : 255.255.255.0\n   Lease Obtained. . . . . . . . . . : Sunday, June 8, 2025 8:00:00 AM\n   Lease Expires . . . . . . . . . . : Monday, June 9, 2025 8:00:00 AM\n   Default Gateway . . . . . . . . . : 192.168.1.1\n   DHCP Server . . . . . . . . . . . : 192.168.1.1\n   DNS Servers . . . . . . . . . . . : 8.8.8.8\n                                       8.8.4.4"
                            },
                            {
                                "pattern": "^wmic nic get macaddress$",
                                "response": "MACAddress\n00:1B:44:11:3A:B7\n"
                            },
                            {
                                "pattern": "^getmac /v$",
                                "response": "Connection Name     Network Adapter                Physical Address    Transport Name\n===============     ========================       ==================  ==================\nEthernet            Intel(R) Ethernet Connection   00-1B-44-11-3A-B7   \\Device\\Tcpip_{B8E2A55C}\nWi-Fi               Not Connected                  N/A                 N/A"
                            },
                            // Additional Linux commands
                            {
                                "pattern": "^arp -a$",
                                "response": "? (192.168.1.1) at 00:11:22:33:44:55 on eth0 [ether] REACHABLE\n? (192.168.1.100) at 00:1b:44:11:3a:b7 on eth0 [ether] PERMANENT\n? (192.168.1.105) at aa:bb:cc:dd:ee:ff on eth0 [ether] STALE"
                            },
                            // Help command
                            {
                                "pattern": "^help$",
                                "response": "Available commands:\n\nLinux:\n  ifconfig                    - Show network interfaces (includes MAC)\n  ifconfig eth0               - Show specific interface details\n  ip addr                     - Show IP addresses and MAC\n  ip link                     - Show network links with MAC\n  cat /sys/class/net/eth0/address - Show MAC address directly\n  hostname -I                 - Show IP addresses\n  arp -a                      - Show ARP table\n\nWindows:\n  ipconfig                    - Show basic network configuration (NO MAC)\n  ipconfig /all               - Show detailed configuration (includes MAC)\n  getmac                      - Show MAC addresses\n  getmac /v                   - Verbose MAC address listing\n  wmic nic get macaddress     - WMI query for MAC addresses\n\nOther:\n  clear                       - Clear the terminal\n  help                        - Show this help message"
                            }
                        ]
                    },
                    domain: "Network Security",
                    topic: "Network Configuration",
                    difficulty: "Easy",
                    bloom: "Apply",
                    dimension: "Technical"
                },
                {
                    id: 2,
                    type_id: 2, // True/False question
                    question_type: { id: 2, name: 'True/False', code: 'true_false' },
                    content: "**True or False:** In a properly implemented defense-in-depth strategy, if one security control fails, the entire security posture is compromised.",
                    options: ["True", "False"],
                    correct_options: ["False"],
                    explanation: "Defense-in-depth uses multiple layers of security controls. If one control fails, other controls continue to provide protection. This layered approach ensures that a single point of failure doesn't compromise the entire security posture.",
                    domain: "Security Architecture & Design",
                    topic: "Defense in Depth",
                    difficulty: "Easy",
                    bloom: "Understand",
                    dimension: "Technical"
                },
                {
                    id: 3,
                    type_id: 1, // Single choice
                    question_type: { id: 1, name: 'Single Choice', code: 'single_choice' },
                    content: "Which of the following is **MOST** essential to establish non-repudiation in an application?",
                    options: [
                        "Who did what and when",
                        "Who did what and how",
                        "Who did what and why",
                        "Who did what and where"
                    ],
                    correct_options: ["Who did what and when"],
                    explanation: "\"Who did what and when\" information is essential for nonrepudiation and traceability of actors and their actions.",
                    domain: "Security Architecture & Design",
                    topic: "Non-repudiation",
                    difficulty: "Medium",
                    bloom: "Understand",
                    dimension: "Managerial"
                },
                {
                    id: 4,
                    type_id: 1, // Using Type1 with multi-select settings
                    question_type: { id: 1, name: 'Multiple Choice', code: 'multiple_choice' },
                    content: "Which of the following are examples of multi-factor authentication (MFA)? (Select **ALL** that apply)",
                    options: [
                        "Password + SMS code",
                        "Fingerprint + PIN",
                        "Username + password",
                        "Smart card + biometric"
                    ],
                    correct_options: ["Password + SMS code", "Fingerprint + PIN", "Smart card + biometric"],
                    settings: {
                        isMultiSelect: true,
                        maxSelectable: 3  // There are 3 correct answers
                    },
                    justifications: [
                        "Combines something you know (password) with something you have (phone for SMS) - two different factors.",
                        "Combines something you are (fingerprint biometric) with something you know (PIN) - two different factors.",
                        "Both username and password are 'something you know' - this is single-factor authentication, not MFA.",
                        "Combines something you have (smart card) with something you are (biometric) - two different factors."
                    ],
                    domain: "Access Control",
                    topic: "Authentication Methods",
                    difficulty: "Easy",
                    bloom: "Understand",
                    dimension: "Technical"
                },
                {
                    id: 5,
                    type_id: 3, // Drag and drop (single zone)
                    question_type: { id: 3, name: 'Drag and Drop', code: 'drag_drop' },
                    content: "Drag only symmetric algorithms to the drop zone:",
                    options: [
                        "AES",
                        "RSA",
                        "DES",
                        "Diffie-Hellman",
                        "3DES",
                        "ECC"
                    ],
                    correct_options: ["AES", "DES", "3DES"],
                    domain: "Cryptography",
                    topic: "Encryption Algorithms",
                    difficulty: "Medium",
                    bloom: "Apply",
                    dimension: "Technical"
                },
                {
                    id: 6,
                    type_id: 4, // Drag and drop (ordering)
                    question_type: { id: 4, name: 'Ordering', code: 'ordering' },
                    content: "The Open System Interconnection (OSI) reference model is a conceptual model made up of seven layers that describe information flow from one computing asset to another over a network. Each layer of the OSI model performs or facilitates a specific network function. Drag & drop the layers in sequence from top (layer 7) to bottom (layer 1).",
                    options: ["Transport", "Physical", "Application", "Data Link", "Network", "Presentation", "Session"], // Shuffled
                    correct_options: ["Application", "Presentation", "Session", "Transport", "Network", "Data Link", "Physical"],
                    domain: "Network Security",
                    topic: "OSI Model",
                    difficulty: "Medium",
                    bloom: "Remember",
                    dimension: "Technical"
                },
                {
                    id: 7,
                    type_id: 5, // Matching
                    question_type: { id: 5, name: 'Matching', code: 'matching' },
                    content: "Drag and match the type of intellectual property with its definition on the left.",
                    options: {
                        items: ["Patent", "Trademark", "Copyright", "Trade Secret"],
                        responses: [
                            "Protects new inventions, processes, and technical solutions",
                            "Protects logos, brand names, slogans, and symbols used in commerce",
                            "Protects original artistic and literary works like books, music, and software",
                            "Protects confidential business information that gives a competitive advantage"
                        ]
                    },
                    correct_options: {
                        "Patent": "Protects new inventions, processes, and technical solutions",
                        "Trademark": "Protects logos, brand names, slogans, and symbols used in commerce",
                        "Copyright": "Protects original artistic and literary works like books, music, and software",
                        "Trade Secret": "Protects confidential business information that gives a competitive advantage"
                    },
                    justifications: {
                        "Patent": "A patent gives exclusive rights to an inventor for a limited time, typically 20 years, protecting new inventions or discoveries.",
                        "Trademark": "Trademarks identify and distinguish the source of goods or services and protect brand identity in the marketplace.",
                        "Copyright": "Copyright protects the expression of ideas in tangible form, such as books, software, music, or films — not the idea itself.",
                        "Trade Secret": "Trade secrets include formulas, practices, or designs that are confidential and give a business advantage, such as the Coca-Cola recipe."
                    },
                    domain: "Legal, Regulatory & Compliance",
                    topic: "Intellectual Property",
                    difficulty: "Medium",
                    bloom: "Understand",
                    dimension: "Managerial"
                },
                {
                    id: 8,
                    type_id: 6, // Hotspot
                    question_type: { id: 6, name: 'Hotspot', code: 'hotspot' },
                    content: "Click where the Firewall should be placed to secure outbound connections from internal computers, protect internal resources from inbound connections from Internet, and use a separate **DMZ** segment to allow web connections from the Internet.",
                    image: "/images/questions/1.png",
                    options: [
                        { "x": 132, "y": 58 },
                        { "x": 238, "y": 58 },
                        { "x": 342, "y": 58 },
                        { "x": 448, "y": 58 }
                    ],
                    correct_options: { "x": 342, "y": 58 },
                    justifications: "A single firewall with at least 3 network interfaces can be used to create a network architecture containing a DMZ. The external network is formed from the ISP to the firewall on the first network interface, the internal network is formed from the second network interface, and the DMZ is formed from the third network interface.",
                    domain: "Network Security",
                    topic: "Firewall Placement",
                    difficulty: "Hard",
                    bloom: "Apply",
                    dimension: "Technical"
                },
                {
                    id: 9,
                    type_id: 7, // Simulation
                    question_type: { id: 7, name: 'Simulation', code: 'simulation' },
                    content: "Using the command line, determine the **IPv6** address for *saazacademy.com*",
                    options: [
                        "2606:4700:3037::6815:4c99",
                        "2a00:1450:4009:80f::200e", 
                        "2001:4860:4860::8888",
                        "172.67.180.227"
                    ],
                    correct_options: ["2606:4700:3037::6815:4c99"],
                    justifications: [
                        "This is the correct IPv6 address for *saazacademy.com*. You can verify this using commands like 'dig AAAA saazacademy.com' or 'host -t AAAA saazacademy.com'.",
                        "This is a Google Public DNS IPv6 address, not related to *saazacademy.com*.",
                        "This is a Google DNS64 IPv6 address, not related to *saazacademy.com*.",
                        "This is an IPv4 address for *saazacademy.com* not an IPv6 address."
                    ],
                    settings: {
                            "shell": "bash",
                            "clearCommand": "clear",
                            "errorMessages": {
                                "commandNotFound": "$COMMAND: command not found",
                                "missingArgument": "$COMMAND: missing required argument: domain name",
                                "unknownHost": "$COMMAND: cannot resolve $1: Unknown host"
                            },
                            "commands": [
                                // Commands that work only for saazacademy.com
                                {
                                    "pattern": "dig AAAA saazacademy\\.com$",
                                    "response": "; <<>> DiG 9.18.28-0ubuntu0.20.04.1-Ubuntu <<>> AAAA saazacademy.com\n;; global options: +cmd\n;; Got answer:\n;; ->>HEADER<<- opcode: QUERY, status: NOERROR, id: 47823\n;; flags: qr rd ra; QUERY: 1, ANSWER: 2, AUTHORITY: 0, ADDITIONAL: 1\n\n;; OPT PSEUDOSECTION:\n; EDNS: version: 0, flags:; udp: 65494\n;; QUESTION SECTION:\n;saazacademy.com.\t\tIN\tAAAA\n\n;; ANSWER SECTION:\nsaazacademy.com.\t300\tIN\tAAAA\t2606:4700:3037::6815:4c99\nsaazacademy.com.\t300\tIN\tAAAA\t2606:4700:3037::ac43:b4e3\n\n;; Query time: 23 msec\n;; SERVER: 172.20.10.1#53(172.20.10.1)\n;; WHEN: Sat Jun 08 17:42:31 PST 2025\n;; MSG SIZE  rcvd: 88"
                                },
                                {
                                    "pattern": "dig AAAA saazacademy\\.com \\+short$",
                                    "response": "2606:4700:3037::6815:4c99\n2606:4700:3037::ac43:b4e3"
                                },
                                {
                                    "pattern": "host -t AAAA saazacademy\\.com$",
                                    "response": "saazacademy.com has IPv6 address 2606:4700:3037::6815:4c99\nsaazacademy.com has IPv6 address 2606:4700:3037::ac43:b4e3"
                                },
                                // IPv4 commands for saazacademy.com
                                {
                                    "pattern": "dig saazacademy\\.com \\+short$",
                                    "response": "172.67.180.227\n104.21.76.153"
                                },
                                {
                                    "pattern": "dig saazacademy\\.com$",
                                    "response": "; <<>> DiG 9.18.28-0ubuntu0.20.04.1-Ubuntu <<>> saazacademy.com\n;; global options: +cmd\n;; Got answer:\n;; ->>HEADER<<- opcode: QUERY, status: NOERROR, id: 32451\n;; flags: qr rd ra; QUERY: 1, ANSWER: 2, AUTHORITY: 0, ADDITIONAL: 1\n\n;; OPT PSEUDOSECTION:\n; EDNS: version: 0, flags:; udp: 65494\n;; QUESTION SECTION:\n;saazacademy.com.\t\tIN\tA\n\n;; ANSWER SECTION:\nsaazacademy.com.\t300\tIN\tA\t172.67.180.227\nsaazacademy.com.\t300\tIN\tA\t104.21.76.153\n\n;; Query time: 15 msec\n;; SERVER: 172.20.10.1#53(172.20.10.1)\n;; WHEN: Sat Jun 08 17:45:22 PST 2025\n;; MSG SIZE  rcvd: 76"
                                },
                                {
                                    "pattern": "host saazacademy\\.com$",
                                    "response": "saazacademy.com has address 172.67.180.227\nsaazacademy.com has address 104.21.76.153\nsaazacademy.com has IPv6 address 2606:4700:3037::6815:4c99\nsaazacademy.com has IPv6 address 2606:4700:3037::ac43:b4e3\nsaazacademy.com mail is handled by 0 _dc-mx.b54f0cda8c8e.saazacademy.com."
                                },
                                {
                                    "pattern": "nslookup saazacademy\\.com$",
                                    "response": "Server:\t\t172.20.10.1\nAddress:\t172.20.10.1#53\n\nNon-authoritative answer:\nName:\tsaazacademy.com\nAddress: 172.67.180.227\nName:\tsaazacademy.com\nAddress: 104.21.76.153\nName:\tsaazacademy.com\nAddress: 2606:4700:3037::6815:4c99\nName:\tsaazacademy.com\nAddress: 2606:4700:3037::ac43:b4e3"
                                },
                                {
                                    "pattern": "ping saazacademy\\.com$",
                                    "response": "PING saazacademy.com (172.67.180.227) 56(84) bytes of data.\n64 bytes from 172.67.180.227: icmp_seq=1 ttl=52 time=23.7 ms\n64 bytes from 172.67.180.227: icmp_seq=2 ttl=52 time=23.5 ms\n64 bytes from 172.67.180.227: icmp_seq=3 ttl=52 time=23.6 ms\n64 bytes from 172.67.180.227: icmp_seq=4 ttl=52 time=23.8 ms\n\n--- saazacademy.com ping statistics ---\n4 packets transmitted, 4 received, 0% packet loss, time 3003ms\nrtt min/avg/max/mdev = 23.5/23.65/23.8/0.122 ms"
                                },
                                {
                                    "pattern": "nslookup -query=AAAA saazacademy\\.com$",
                                    "response": "Server:\t\t172.20.10.1\nAddress:\t172.20.10.1#53\n\nNon-authoritative answer:\nName:\tsaazacademy.com\nAddress: 2606:4700:3037::6815:4c99\nName:\tsaazacademy.com\nAddress: 2606:4700:3037::ac43:b4e3"
                                },
                                {
                                    "pattern": "ping6 saazacademy\\.com$",
                                    "response": "PING6(56=40+8+8 bytes) 2001:db8:0:1234::1 --> 2606:4700:3037::6815:4c99\n16 bytes from 2606:4700:3037::6815:4c99, icmp_seq=0 hlim=52 time=24.152 ms\n16 bytes from 2606:4700:3037::6815:4c99, icmp_seq=1 hlim=52 time=23.897 ms\n16 bytes from 2606:4700:3037::6815:4c99, icmp_seq=2 hlim=52 time=24.021 ms\n16 bytes from 2606:4700:3037::6815:4c99, icmp_seq=3 hlim=52 time=23.944 ms\n\n--- saazacademy.com ping6 statistics ---\n4 packets transmitted, 4 packets received, 0.0% packet loss\nround-trip min/avg/max/std-dev = 23.897/24.004/24.152/0.099 ms"
                                },
                                {
                                    "pattern": "ping -6 saazacademy\\.com$",
                                    "response": "PING saazacademy.com(2606:4700:3037::6815:4c99) 56 data bytes\n64 bytes from 2606:4700:3037::6815:4c99: icmp_seq=1 ttl=52 time=24.1 ms\n64 bytes from 2606:4700:3037::6815:4c99: icmp_seq=2 ttl=52 time=23.9 ms\n64 bytes from 2606:4700:3037::6815:4c99: icmp_seq=3 ttl=52 time=24.0 ms\n64 bytes from 2606:4700:3037::6815:4c99: icmp_seq=4 ttl=52 time=23.8 ms\n\n--- saazacademy.com ping statistics ---\n4 packets transmitted, 4 received, 0% packet loss, time 3004ms\nrtt min/avg/max/mdev = 23.8/23.95/24.1/0.125 ms"
                                },
                                // Additional IPv6 commands
                                {
                                    "pattern": "getent ahosts saazacademy\\.com$",
                                    "response": "2606:4700:3037::6815:4c99 STREAM saazacademy.com\n2606:4700:3037::6815:4c99 DGRAM\n2606:4700:3037::6815:4c99 RAW\n2606:4700:3037::ac43:b4e3 STREAM\n2606:4700:3037::ac43:b4e3 DGRAM\n2606:4700:3037::ac43:b4e3 RAW\n172.67.180.227  STREAM\n172.67.180.227  DGRAM\n172.67.180.227  RAW\n104.21.76.153   STREAM\n104.21.76.153   DGRAM\n104.21.76.153   RAW"
                                },
                                {
                                    "pattern": "getent hosts saazacademy\\.com$",
                                    "response": "2606:4700:3037::6815:4c99 saazacademy.com"
                                },
                                {
                                    "pattern": "host -t ANY saazacademy\\.com$",
                                    "response": "saazacademy.com has address 172.67.180.227\nsaazacademy.com has address 104.21.76.153\nsaazacademy.com has IPv6 address 2606:4700:3037::6815:4c99\nsaazacademy.com has IPv6 address 2606:4700:3037::ac43:b4e3\nsaazacademy.com mail is handled by 0 _dc-mx.b54f0cda8c8e.saazacademy.com.\nsaazacademy.com nameserver = ns1.example.com.\nsaazacademy.com nameserver = ns2.example.com."
                                },
                                {
                                    "pattern": "drill AAAA saazacademy\\.com$",
                                    "response": ";; ->>HEADER<<- opcode: QUERY, rcode: NOERROR, id: 12345\n;; flags: qr rd ra ; QUERY: 1, ANSWER: 2, AUTHORITY: 0, ADDITIONAL: 0\n;; QUESTION SECTION:\n;; saazacademy.com.\tIN\tAAAA\n\n;; ANSWER SECTION:\nsaazacademy.com.\t300\tIN\tAAAA\t2606:4700:3037::6815:4c99\nsaazacademy.com.\t300\tIN\tAAAA\t2606:4700:3037::ac43:b4e3\n\n;; AUTHORITY SECTION:\n\n;; ADDITIONAL SECTION:\n\n;; Query time: 25 msec\n;; SERVER: 8.8.8.8\n;; WHEN: Sun Jun  8 21:30:00 2025\n;; MSG SIZE  rcvd: 88"
                                },
                                {
                                    "pattern": "resolveip -6 saazacademy\\.com$",
                                    "response": "IPv6 address of saazacademy.com is 2606:4700:3037::6815:4c99"
                                },
                                {
                                    "pattern": "dnseval saazacademy\\.com$",
                                    "response": "saazacademy.com. A: 172.67.180.227, 104.21.76.153\nsaazacademy.com. AAAA: 2606:4700:3037::6815:4c99, 2606:4700:3037::ac43:b4e3"
                                },
                                {
                                    "pattern": "systemd-resolve saazacademy\\.com$",
                                    "response": "saazacademy.com: 2606:4700:3037::6815:4c99\n                 2606:4700:3037::ac43:b4e3\n                 172.67.180.227\n                 104.21.76.153\n\n-- Information acquired via protocol DNS in 15.2ms.\n-- Data is authenticated: no"
                                },
                                {
                                    "pattern": "resolvectl query saazacademy\\.com$",
                                    "response": "saazacademy.com: 2606:4700:3037::6815:4c99\n                 2606:4700:3037::ac43:b4e3\n                 172.67.180.227\n                 104.21.76.153\n\n-- Information acquired via protocol DNS in 12.4ms.\n-- Data is authenticated: no"
                                },
                                {
                                    "pattern": "nmap -6 -sn saazacademy\\.com$",
                                    "response": "Starting Nmap 7.80 ( https://nmap.org ) at 2025-06-08 21:30 IST\nNmap scan report for saazacademy.com (2606:4700:3037::6815:4c99)\nHost is up (0.024s latency).\nOther addresses for saazacademy.com (not scanned): 2606:4700:3037::ac43:b4e3\nNmap done: 1 IP address (1 host up) scanned in 0.08 seconds"
                                },
                                {
                                    "pattern": "curl -6 -I saazacademy\\.com$",
                                    "response": "curl: (7) Failed to connect to saazacademy.com port 80: Connection refused"
                                },
                                // Generic commands for other domains with NXDOMAIN response
                                {
                                    "pattern": "ping ([a-zA-Z0-9.-]+\\.[a-zA-Z]{2,})$",
                                    "condition": "^ping (?!saazacademy\\.com$)",
                                    "generateResponse": {
                                        "type": "error",
                                        "template": "ping: cannot resolve $1: Unknown host"
                                    },
                                    "isError": true
                                },
                                {
                                    "pattern": "dig ([a-zA-Z0-9.-]+\\.[a-zA-Z]{2,})$",
                                    "condition": "^dig (?!saazacademy\\.com$)",
                                    "generateResponse": {
                                        "type": "nxdomain",
                                        "template": "; <<>> DiG 9.10.6 <<>> $1\n;; global options: +cmd\n;; Got answer:\n;; ->>HEADER<<- opcode: QUERY, status: NXDOMAIN, id: $RANDOM_ID\n;; flags: qr rd ra; QUERY: 1, ANSWER: 0, AUTHORITY: 1, ADDITIONAL: 1\n\n;; OPT PSEUDOSECTION:\n; EDNS: version: 0, flags:; udp: 1280\n;; QUESTION SECTION:\n;$1.\t\t\tIN\tA\n\n;; AUTHORITY SECTION:\ncom.\t\t\t899\tIN\tSOA\ta.gtld-servers.net. nstld.verisign-grs.com. 1749397177 1800 900 604800 900\n\n;; Query time: $RANDOM_TIME msec\n;; SERVER: 2405:201:4017:721c::c0a8:1d01#53(2405:201:4017:721c::c0a8:1d01)\n;; WHEN: $DATE\n;; MSG SIZE  rcvd: $RANDOM_SIZE"
                                    }
                                },
                                {
                                    "pattern": "dig AAAA ([a-zA-Z0-9.-]+\\.[a-zA-Z]{2,})",
                                    "condition": "^dig AAAA (?!saazacademy\\.com)",
                                    "generateResponse": {
                                        "type": "nxdomain",
                                        "template": "; <<>> DiG 9.10.6 <<>> AAAA $1\n;; global options: +cmd\n;; Got answer:\n;; ->>HEADER<<- opcode: QUERY, status: NXDOMAIN, id: $RANDOM_ID\n;; flags: qr rd ra; QUERY: 1, ANSWER: 0, AUTHORITY: 1, ADDITIONAL: 1\n\n;; OPT PSEUDOSECTION:\n; EDNS: version: 0, flags:; udp: 1280\n;; QUESTION SECTION:\n;$1.\t\t\tIN\tAAAA\n\n;; AUTHORITY SECTION:\ncom.\t\t\t899\tIN\tSOA\ta.gtld-servers.net. nstld.verisign-grs.com. 1749397177 1800 900 604800 900\n\n;; Query time: $RANDOM_TIME msec\n;; SERVER: 2405:201:4017:721c::c0a8:1d01#53(2405:201:4017:721c::c0a8:1d01)\n;; WHEN: $DATE\n;; MSG SIZE  rcvd: $RANDOM_SIZE"
                                    }
                                },
                                // Help command
                                {
                                    "pattern": "^help$",
                                    "response": "Available commands:\n  dig <domain>                   - Query A (IPv4) record using DNS\n  dig AAAA <domain>              - Query AAAA (IPv6) record using DNS\n  dig AAAA <domain> +short       - Query IPv6 address (short format)\n  host <domain>                  - Display all DNS records for hostname\n  host -t AAAA <domain>          - Display IPv6 address for hostname\n  host -t ANY <domain>           - Display ALL DNS records\n  nslookup <domain>              - Query all addresses for domain\n  nslookup -query=AAAA <domain>  - Query nameserver for IPv6 only\n  ping <domain>                  - Ping using IPv4\n  ping6 <domain>                 - Ping using IPv6\n  ping -6 <domain>               - Ping using IPv6\n  getent hosts <domain>          - Get host entry (prefers IPv6)\n  getent ahosts <domain>         - Get all host addresses\n  drill AAAA <domain>            - DNS lookup tool (alternative to dig)\n  systemd-resolve <domain>       - SystemD resolver query\n  resolvectl query <domain>      - SystemD resolver control\n  resolveip -6 <domain>          - Resolve to IPv6 address only\n  dnseval <domain>               - Evaluate DNS records\n  nmap -6 -sn <domain>           - IPv6 host discovery\n  curl -6 -I <domain>            - HTTP HEAD request over IPv6\n  clear                          - Clear the terminal\n  help                           - Show this help message"
                                }
                            ]
                        },
                    domain: "Network Security",
                    topic: "Network Commands",
                    difficulty: "Medium",
                    bloom: "Apply",
                    dimension: "Technical"
                }
            ]
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
                    6: 'Type6', // Hotspot - no review component, use regular
                    7: 'Type7', // Simulation - no review component, use regular
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
            if (!this.hasSelection) return;

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
        },
        finishQuiz() {
            if (!this.hasSelection) return;

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
            }
        },
        restartQuiz() {
            this.currentQuestionIndex = 0;
            this.selectedOptions = [];
            this.answer = this.initialAnswer();
            this.userAnswers = [];
            this.isReviewMode = false;
            this.showResults = false;
        },
        closeResults() {
            this.showResults = false;
        },
        onQuestionTick(questionTime, totalTime) {
            // You can use this to track time spent per question if needed
            // For now, we'll just let the timer run
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
            
            // Set new timer for 30 seconds
            this.inactivityTimer = setTimeout(() => {
                this.pauseQuiz();
            }, 30000); // 30 seconds
        },
        pauseQuiz() {
            // Don't pause if already in review mode or showing results
            if (this.isReviewMode || this.showResults) {
                return;
            }
            
            // Clear the timer
            if (this.inactivityTimer) {
                clearTimeout(this.inactivityTimer);
                this.inactivityTimer = null;
            }
            
            // Pause the timer
            if (this.$refs.timer) {
                this.$refs.timer.pause();
            }
            if (this.$refs.mobileTimer) {
                this.$refs.mobileTimer.pause();
            }
            
            // Show pause modal
            this.showPauseModal = true;
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
        // Check initial theme
        if (typeof window !== 'undefined') {
            this.isDark = document.documentElement.classList.contains('dark') ||
                window.matchMedia('(prefers-color-scheme: dark)').matches;
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
}
</style>