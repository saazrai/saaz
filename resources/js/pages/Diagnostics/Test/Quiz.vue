<template>
    <div :class="[
        'min-h-screen flex flex-col pb-40',
        isDark ? 'bg-gray-900' : 'bg-slate-100'
    ]">
        <!-- Top Navbar -->
        <div
            :class="[
                'backdrop-blur-md border-b shadow-lg px-4 sm:px-8 py-3 sm:py-4 flex flex-wrap items-center justify-between gap-4',
                isDark ? 'bg-gray-800 border-gray-700' : 'bg-white border-slate-300 shadow-slate-200'
            ]"
        >
            <div
                class="w-full flex flex-col lg:flex-row lg:items-center lg:justify-between gap-2"
            >
                <div
                    :class="[
                        'flex-1 min-w-[50%] md:text-base xl:text-2xl font-semibold truncate',
                        isDark ? 'text-gray-100' : 'text-slate-900'
                    ]"
                >
                    Diagnostic Assessment
                </div>
                <div class="sm:w-auto flex items-center gap-3">
                    <!-- Theme Toggle Button -->
                    <button
                        @click="toggleDarkMode"
                        :class="[
                            'p-2 rounded-lg transition-colors',
                            isDark 
                                ? 'bg-gray-700 hover:bg-gray-600' 
                                : 'bg-slate-200 hover:bg-slate-300'
                        ]"
                        aria-label="Toggle theme"
                    >
                        <SunIcon v-if="isDark" class="w-5 h-5 text-yellow-500" />
                        <MoonIcon v-else :class="[
                            'w-5 h-5',
                            isDark ? 'text-gray-300' : 'text-slate-700'
                        ]" />
                    </button>
                    
                    <!-- Keep timer visible -->
                    <Timer
                        ref="timer"
                        :initialElapsed="initialTimeElapsed"
                        @question-tick="handleQuestionTick"
                    />
                </div>
            </div>
        </div>

        <!-- Progress Section -->
        <div
            :class="[
                'backdrop-blur-md border-b shadow px-4 sm:px-8 py-3 flex flex-wrap sm:flex-nowrap items-center justify-between gap-4',
                isDark ? 'bg-gray-800/50 border-gray-700' : 'bg-white/90 border-slate-300'
            ]"
        >
            <div
                :class="[
                    'md:text-base xl:text-xl font-semibold truncate',
                    isDark ? 'text-gray-200' : 'text-slate-800'
                ]"
            >
                <!-- Always show current question number -->
                Question {{ currentQuestionNumber }} /
                {{ diagnostic?.total_questions ?? 100 }}
            </div>

            <div
                class="hidden sm:block landscape:block portrait:hidden flex-grow sm:w-auto"
            >
                <div
                    :class="[
                        'w-full border shadow-inner rounded-full h-4 overflow-hidden',
                        isDark ? 'bg-gray-700 border-gray-600' : 'bg-slate-300 border-slate-400'
                    ]"
                >
                    <!-- Use currentProgress for the progress bar -->
                    <div
                        :class="[
                            'h-4 transition-all duration-300 shadow-sm',
                            isDark ? 'bg-blue-500' : 'bg-blue-700'
                        ]"
                        :style="{ width: `${currentProgress}%` }"
                    ></div>
                </div>
            </div>
        </div>

        <!-- Pause Test Button -->
        <div
            class="w-full flex flex-row flex-wrap justify-end items-center gap-2 px-4 mt-2 relative z-40"
        >
            <!-- Always show Pause Test button -->
            <button
                type="button"
                @click.prevent.stop="handlePauseClick"
                dusk="pause-btn"
                :class="[
                    'px-4 py-2 rounded-lg text-white font-medium shadow-md transition-colors cursor-pointer',
                    isDark 
                        ? 'bg-rose-600 hover:bg-rose-700' 
                        : 'bg-rose-500 hover:bg-rose-600'
                ]"
            >
                Pause Test
            </button>
        </div>

        <!-- Question Section -->
        <div class="mx-2 sm:mx-2 my-2 rounded-md flex-1 overflow-hidden">
            <div class="flex flex-col md:flex-row h-full gap-4">
                <div class="flex-1">
                    <div
                        class="flex flex-col lg:flex-row bg-transparent space-y-4 lg:space-y-0"
                    >
                        <component
                            :is="currentQuestionComponent"
                            :question="currentQuestionData"
                            :answer="answer"
                            :isReview="false"
                            :isDarkMode="isDark"
                            @selected="selected"
                            v-if="currentQuestionData"
                            :class="['diagnostic-question', isDark ? 'dark-mode' : 'light-mode']"
                        />
                        <div
                            v-else
                            :class="[
                                'flex justify-center items-center h-full text-xl rounded-2xl p-8',
                                isDark 
                                    ? 'text-gray-400 bg-gray-800' 
                                    : 'text-slate-600 bg-white border border-slate-300 shadow-sm'
                            ]"
                        >
                            Loading question...
                        </div>
                    </div>
                </div>

                <!-- Question Details Section -->
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
                                {{ currentQuestionData?.topic?.domain?.name || "N/A" }}
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
                                {{ currentQuestionData?.topic?.name || "N/A" }}
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
                                {{ currentQuestionData?.dimension || "N/A" }}
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
                                <Popover class="relative hidden sm:block" v-slot="{ open }">
                                    <PopoverButton 
                                        ref="difficultyTooltipButton"
                                        :class="[
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
                                        enter-from-class="opacity-0 scale-95"
                                        enter-to-class="opacity-100 scale-100"
                                        leave-active-class="transition duration-150 ease-in"
                                        leave-from-class="opacity-100 scale-100"
                                        leave-to-class="opacity-0 scale-95"
                                    >
                                        <PopoverPanel 
                                            v-if="open"
                                            :class="[
                                            'absolute z-50 w-80 px-4 py-3 rounded-lg shadow-xl border max-h-[calc(100vh-4rem)] overflow-y-auto',
                                            isDark 
                                                ? 'bg-gray-800 border-gray-700' 
                                                : 'bg-white border-gray-200'
                                        ]"
                                            :style="getTooltipPosition('difficulty', open)"
                                        >
                                            <!-- Dynamic Arrow -->
                                            <div :class="[
                                                'absolute w-4 h-4 transform rotate-45 z-[-1]',
                                                isDark ? 'bg-gray-800' : 'bg-white',
                                                getArrowClasses('difficulty', open)
                                            ]"
                                            :style="getArrowStyle()"
                                            ></div>

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
                                    {{ getDifficultyLabel() }}
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
                                <!-- Desktop Tooltip - Only show when Bloom level is not NA -->
                                <Popover v-if="getBloomScore() > 0" class="relative hidden sm:block" v-slot="{ open }">
                                    <PopoverButton 
                                        ref="bloomTooltipButton"
                                        :class="[
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
                                        enter-from-class="opacity-0 scale-95"
                                        enter-to-class="opacity-100 scale-100"
                                        leave-active-class="transition duration-150 ease-in"
                                        leave-from-class="opacity-100 scale-100"
                                        leave-to-class="opacity-0 scale-95"
                                    >
                                        <PopoverPanel 
                                            v-if="open"
                                            :class="[
                                            'absolute z-50 w-80 px-4 py-3 rounded-lg shadow-xl border max-h-[calc(100vh-4rem)] overflow-y-auto',
                                            isDark 
                                                ? 'bg-gray-800 border-gray-700' 
                                                : 'bg-white border-gray-200'
                                        ]"
                                            :style="getTooltipPosition('bloom', open)"
                                        >
                                            <!-- Dynamic Arrow -->
                                            <div :class="[
                                                'absolute w-4 h-4 transform rotate-45 z-[-1]',
                                                isDark ? 'bg-gray-800' : 'bg-white',
                                                getArrowClasses('bloom', open)
                                            ]"
                                            :style="getArrowStyle()"
                                            ></div>

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
                                <!-- Mobile Tooltip Button - Only show when Bloom level is not NA -->
                                <button 
                                    v-if="getBloomScore() > 0"
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
                                    {{ getBloomLabel() }}
                                </span>
                                <!-- Only show bar chart when Bloom level is not NA -->
                                <BarChartLevelIndicator 
                                    v-if="getBloomScore() > 0"
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
        </div>

        <!-- Footer Controls -->
        <div
            :class="[
                'backdrop-blur-xl border-t shadow-2xl py-4 px-4 fixed bottom-0 left-0 w-full z-50',
                isDark 
                    ? 'bg-gray-800/90 border-gray-700' 
                    : 'bg-white/95 border-slate-300 shadow-slate-300'
            ]"
        >
            <div class="flex w-full gap-2 md:max-w-xl md:mx-auto">
                <div class="w-full">
                    <button
                        v-if="!isLastQuestion"
                        @click="submitAnswer"
                        :disabled="!hasSelection"
                        dusk="submit-answer-btn"
                        :class="[
                            'px-5 py-3 rounded-lg font-semibold w-full backdrop-blur-md border text-white transition-all transform active:scale-95 shadow-lg',
                            !hasSelection
                                ? (isDark 
                                    ? 'bg-gray-600 border-gray-500 cursor-not-allowed opacity-50'
                                    : 'bg-slate-500 border-slate-400 cursor-not-allowed opacity-60')
                                : (isDark 
                                    ? 'bg-emerald-600 hover:bg-emerald-700 border-emerald-500 hover:shadow-emerald-500/25'
                                    : 'bg-emerald-600 hover:bg-emerald-700 border-emerald-500 hover:shadow-emerald-500/25')
                        ]"
                    >
                        Submit Answer
                    </button>
                    <button
                        v-else
                        @click="finishAssessment"
                        :disabled="!hasSelection"
                        dusk="submit-answer-btn"
                        :class="[
                            'px-5 py-3 rounded-lg font-semibold w-full backdrop-blur-md border text-white transition-all transform active:scale-95 shadow-lg',
                            !hasSelection
                                ? (isDark 
                                    ? 'bg-gray-600 border-gray-500 cursor-not-allowed opacity-50'
                                    : 'bg-slate-500 border-slate-400 cursor-not-allowed opacity-60')
                                : (isDark 
                                    ? 'bg-rose-600 hover:bg-rose-700 border-rose-500 hover:shadow-rose-500/25'
                                    : 'bg-rose-600 hover:bg-rose-700 border-rose-500 hover:shadow-rose-500/25')
                        ]"
                    >
                        End Assessment
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Pause Test Modal -->
    <ConfirmationDialog
        :is-open="showPauseModal"
        title="Pause Test?"
        description="You can resume the test later from the results page."
        type="question"
        confirm-text="Yes, Pause it!"
        cancel-text="Continue Test"
        :is-dark="isDark"
        @confirm="confirmPause"
        @cancel="cancelPause"
        @close="showPauseModal = false"
    />

    <!-- Finish Assessment Modal -->
    <ConfirmationDialog
        :is-open="showFinishModal"
        title="End Assessment?"
        description="You are about to complete your diagnostic assessment. Are you sure you want to end the assessment now?"
        type="warning"
        confirm-text="Yes, End Assessment"
        cancel-text="Continue Assessment"
        :is-dark="isDark"
        @confirm="confirmFinish"
        @cancel="showFinishModal = false"
        @close="showFinishModal = false"
    />

    <!-- Time Warning Modal -->
    <ConfirmationDialog
        :is-open="showTimeWarningModal"
        title="Time on Question Exceeded"
        :description="timeWarningMessage"
        type="warning"
        confirm-text="Continue Test"
        cancel-text="Pause Immediately"
        :is-dark="isDark"
        @confirm="handleTimeWarningContinue"
        @cancel="handleTimeWarningPause"
        @close="handleTimeWarningContinue"
    />

    <!-- Error Modal -->
    <ConfirmationDialog
        :is-open="showErrorModal"
        title="Error"
        :description="errorMessage"
        type="error"
        confirm-text="OK"
        cancel-text=""
        :is-dark="isDark"
        @confirm="handleErrorConfirm"
        @close="showErrorModal = false"
    />

    <!-- Mobile Difficulty Modal -->
    <Modal :show="showDifficultyModal" @close="showDifficultyModal = false">
        <div :class="[
            'p-6 max-w-md mx-auto',
            isDark ? 'bg-gray-800 text-gray-100' : 'bg-white text-gray-900'
        ]">
            <h3 :class="[
                'text-lg font-semibold mb-4 flex items-center gap-2',
                isDark ? 'text-gray-100' : 'text-gray-900'
            ]">
                ❓ Difficulty Level?
            </h3>
            <p :class="[
                'text-sm mb-4',
                isDark ? 'text-gray-300' : 'text-gray-600'
            ]">
                Each question is rated by how challenging it is:
            </p>
            <ul :class="[
                'text-sm space-y-2 mb-4',
                isDark ? 'text-gray-300' : 'text-gray-600'
            ]">
                <li>• <span class="font-medium">1 – Very Easy:</span> Basic facts or definitions</li>
                <li>• <span class="font-medium">2 – Easy:</span> Simple application of key concepts</li>
                <li>• <span class="font-medium">3 – Medium:</span> Involves moderate reasoning or scenarios</li>
                <li>• <span class="font-medium">4 – Hard:</span> Requires deep analysis and multi-step thinking</li>
                <li>• <span class="font-medium">5 – Very Hard:</span> Complex, expert-level questions</li>
            </ul>
            <p :class="[
                'text-sm pt-4 border-t',
                isDark ? 'text-gray-400 border-gray-700' : 'text-gray-500 border-gray-200'
            ]">
                Helps the system adapt to your skill level!
            </p>
            <div class="mt-6 flex justify-end">
                <button @click="showDifficultyModal = false" :class="[
                    'px-4 py-2 rounded-lg font-medium',
                    isDark 
                        ? 'bg-gray-700 hover:bg-gray-600 text-gray-200' 
                        : 'bg-gray-200 hover:bg-gray-300 text-gray-800'
                ]">
                    Got it!
                </button>
            </div>
        </div>
    </Modal>

    <!-- Mobile Bloom Modal -->
    <Modal :show="showBloomModal" @close="showBloomModal = false">
        <div :class="[
            'p-6 max-w-md mx-auto',
            isDark ? 'bg-gray-800 text-gray-100' : 'bg-white text-gray-900'
        ]">
            <h3 :class="[
                'text-lg font-semibold mb-4 flex items-center gap-2',
                isDark ? 'text-gray-100' : 'text-gray-900'
            ]">
                💡 Bloom's Taxonomy Levels
            </h3>
            <p :class="[
                'text-sm mb-4',
                isDark ? 'text-gray-300' : 'text-gray-600'
            ]">
                A framework that measures the depth of understanding:
            </p>
            <div :class="[
                'text-sm space-y-3 mb-4',
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
                'text-xs pt-4 border-t italic',
                isDark ? 'text-gray-400 border-gray-700' : 'text-gray-500 border-gray-200'
            ]">
                The assessment adapts difficulty based on your performance at each level.
            </p>
            <div class="mt-6 flex justify-end">
                <button @click="showBloomModal = false" :class="[
                    'px-4 py-2 rounded-lg font-medium',
                    isDark 
                        ? 'bg-gray-700 hover:bg-gray-600 text-gray-200' 
                        : 'bg-gray-200 hover:bg-gray-300 text-gray-800'
                ]">
                    Got it!
                </button>
            </div>
        </div>
    </Modal>
</template>

<script lang="ts">
import ConfirmationDialog from "@/Components/ConfirmationDialog.vue";
import Modal from "@/Components/Modal.vue";
import { Link } from "@inertiajs/vue3";
import Timer from "@/Components/QuizTimer.vue";
import Type1 from "@/Components/QuizTypes/Type1.vue";
import Type2 from "@/Components/QuizTypes/Type2.vue";
import Type3 from "@/Components/QuizTypes/Type3.vue";
import Type4 from "@/Components/QuizTypes/Type4.vue";
import Type5 from "@/Components/QuizTypes/Type5.vue";
import Type6 from "@/Components/QuizTypes/Type6.vue";
import Type7 from "@/Components/QuizTypes/Type7.vue";
import BarChartLevelIndicator from "@/Components/LevelIndicators/BarChartLevelIndicator.vue";
import { SunIcon, MoonIcon } from 'lucide-vue-next';
import { QuestionMarkCircleIcon } from '@heroicons/vue/24/outline';
import { Popover, PopoverButton, PopoverPanel } from '@headlessui/vue';
import { useTheme } from '@/composables/useTheme';
import axios from "axios";

export default {
    components: { LinkComponent: Link, Timer, Type1, Type2, Type3, Type4, Type5, Type6, Type7, BarChartLevelIndicator, SunIcon, MoonIcon, ConfirmationDialog, Modal, QuestionMarkCircleIcon, Popover, PopoverButton, PopoverPanel },
    props: {
        diagnostic: Object,
        question: Object, // This will be the *initial* current question or null
        progress: Number,
        initialTimeElapsed: {
            type: Number,
            default: 0,
        },
        questionTimeThreshold: {
            type: Number,
            default: 30, // Test with 30 seconds auto-pause
        },
    },
    setup() {
        const { isDarkMode, toggleTheme, initializeTheme } = useTheme();
        return {
            isDarkMode,
            toggleTheme,
            initializeTheme
        };
    },
    data() {
        return {
            selectedOptions: [],
            answer: this.initialAnswer(),
            currentQuestionData: this.question,
            currentProgress: Math.floor(this.progress ?? 0),
            currentTotalTime: this.initialTimeElapsed, // Local property for total time
            questionThresholdMultipliers: {}, // To track threshold extensions per question
            
            // Modal states
            showPauseModal: false,
            showFinishModal: false,
            showErrorModal: false,
            showTimeWarningModal: false,
            errorMessage: '',
            timeWarningMessage: '',
            autoAdvanceCountdown: 5,
            countdownInterval: null,
            shouldRedirectOnError: false,
            userContinuedTest: false,
            showDifficultyModal: false,
            showBloomModal: false,
            tooltipDirection: 'right'
        };
    },
    computed: {
        isDark() {
            return this.isDarkMode;
        },
        currentQuestionNumber() {
            // Use the current_question from the diagnostic object if available
            // This is the server-side count of submitted answers
            if (this.diagnostic?.current_question !== undefined) {
                // Add 1 because current_question is 0-based or represents completed questions
                return Math.min(this.diagnostic.current_question + 1, this.diagnostic?.total_questions || 20);
            }
            
            // Fallback: Calculate based on progress
            const progressBasedNumber = Math.ceil((this.currentProgress / 100) * (this.diagnostic?.total_questions || 20));
            return Math.max(1, Math.min(progressBasedNumber, this.diagnostic?.total_questions || 20));
        },
        currentQuestionComponent() {
            return `Type${this.currentQuestionData?.type_id || 1}`;
        },
        hasSelection() {
            // Special handling for Type4 (drag and drop ordering) questions
            if (this.currentQuestionData?.type_id === 4) {
                // For Type4, allow submit when at least one option has been moved to target area
                return (
                    Array.isArray(this.selectedOptions) &&
                    this.selectedOptions.length > 0
                );
            }
            
            // Default handling for other question types
            return Array.isArray(this.selectedOptions)
                ? this.selectedOptions.length > 0
                : !!this.selectedOptions;
        },
        // Format total time for display
        formattedTotalTime() {
             return this.formatTime(this.currentTotalTime);
        },
        isLastQuestion() {
            // Check if we're on the last question based on answered count
            const answeredCount = this.diagnostic?.responses?.filter(r => r.user_answer !== null).length || 0;
            return answeredCount >= (this.diagnostic?.total_questions ?? 20) - 1;
        },
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
        selected(options) {
            this.selectedOptions = options;
        },
        toggleDarkMode() {
            this.toggleTheme(false); // false = app theme, not admin theme
        },
        async submitAnswer() {
            if (!this.hasSelection) return;

            this.answer.question_id = this.currentQuestionData.id;
            this.answer.duration = this.$refs.timer?.questionTimer || 0;
            this.answer.selected_options = this.selectedOptions;

            try {
                const submittedAnswerData = { ...this.answer };

                const response = await axios.post(
                    typeof route !== 'undefined' ? route("assessments.diagnostics.answer", { diagnostic: this.diagnostic.id }) : `/assessments/diagnostics/${this.diagnostic.id}/answer`,
                    {
                        item_id: this.currentQuestionData.id,
                        answer: submittedAnswerData.selected_options,
                        time_taken: submittedAnswerData.duration,
                    }
                );

                if (response.data.completed) {
                    this.$inertia.visit(
                        typeof route !== 'undefined' ? route("assessments.diagnostics.results", this.diagnostic.id) : `/assessments/diagnostics/${this.diagnostic.id}/results`
                    );
                    return;
                }

                // Debug response data
                console.log('Answer submission response:', response.data);
                
                // Update all relevant data from the response
                this.currentQuestionData = response.data.question;
                this.currentProgress = Math.floor(response.data.progress);
                
                // Update diagnostic current_question if provided
                if (response.data.current_question !== undefined) {
                // Intentional prop mutation: updating diagnostic state from server response                    this.diagnostic.current_question = response.data.current_question;
                }
                
                // Update diagnostic responses if provided
                if (response.data.answered_count !== undefined) {
                    // Update the responses array to reflect the new answer
                    if (this.diagnostic.responses) {
                        // Find and update the response we just submitted
                        const responseIndex = this.diagnostic.responses.findIndex(r => r.diagnostic_item_id === this.currentQuestionData.id);
                        if (responseIndex !== -1) {
                        // Intentional prop mutation: updating diagnostic responses array                            this.diagnostic.responses[responseIndex].user_answer = submittedAnswerData.selected_options;
                        }
                    }
                }
                
                this.selectedOptions = [];
                this.answer = this.initialAnswer();
                // Reset question timer for the new question
                this.$refs.timer?.resetQuestionTimer();
                 // Update local total time after successful submission and question reset
                 this.currentTotalTime = this.$refs.timer?.totalTimer || this.currentTotalTime; // Use timer's total or retain current if timer not available

            } catch (error) {
                console.error("Error submitting answer:", error);
                console.error("Error details:", error.response?.data);
                
                let errorMessage = "Failed to submit answer. Please try again.";
                
                if (error.response?.status === 403) {
                    if (error.response.data?.error === "Invalid diagnostic state") {
                        const details = error.response.data?.details;
                        if (details?.user_mismatch) {
                            errorMessage = "This diagnostic session belongs to a different user. Please log in with the correct account.";
                        } else if (details?.status === 'completed') {
                            errorMessage = "This diagnostic has already been completed.";
                        } else if (details?.status === 'paused') {
                            errorMessage = "This diagnostic is currently paused. Please resume it from the diagnostics page.";
                        } else {
                            errorMessage = "This diagnostic session is no longer valid. The test may have been paused or completed. Please return to the diagnostics page.";
                        }
                    } else {
                        errorMessage = "You don't have permission to submit this answer. Please ensure you're logged in.";
                    }
                } else if (error.response?.status === 401) {
                    errorMessage = "Your session has expired. Please log in again.";
                    // Redirect to login after showing message
                    setTimeout(() => {
                        window.location.href = typeof route !== 'undefined' ? route('login') : '/login';
                    }, 2000);
                }
                
                this.showError(errorMessage, error.response?.status === 403 && error.response.data?.error === "Invalid diagnostic state");
            }
        },
        handlePauseClick(event) {
            console.log('Pause button clicked', event);
            event.preventDefault();
            event.stopPropagation();
            this.pauseTest(false);
        },
        async pauseTest(isAuto = false) {
            console.log('pauseTest called with isAuto:', isAuto);
            
            if (this.$refs.timer?.pause) {
                this.$refs.timer.pause();
            }

            if (isAuto) {
                try {
                    await axios.post(typeof route !== 'undefined' ? route("assessments.diagnostics.pause", { diagnostic: this.diagnostic.id }) : `/assessments/diagnostics/${this.diagnostic.id}/pause`, {
                        time_taken: this.$refs.timer?.totalTimer || 0,
                    });
                } catch (error) {
                    console.error("Error during auto-pause:", error);
                }
                this.$inertia.visit(
                    typeof route !== 'undefined' ? route("assessments.diagnostics.results", this.diagnostic.id) : `/assessments/diagnostics/${this.diagnostic.id}/results`
                );
            } else {
                // Show pause confirmation modal
                this.showPauseModal = true;
            }
        },
        async confirmPause() {
            try {
                await axios.post(typeof route !== 'undefined' ? route('assessments.diagnostics.pause', { diagnostic: this.diagnostic.id }) : `/assessments/diagnostics/${this.diagnostic.id}/pause`, {
                    time_taken: this.$refs.timer?.totalTimer || 0
                });
                this.$inertia.visit(typeof route !== 'undefined' ? route('assessments.diagnostics.results', this.diagnostic.id) : `/assessments/diagnostics/${this.diagnostic.id}/results`);
            } catch (error) {
                console.error('Error pausing test:', error);
                this.showError('Failed to pause test. Please try again.');
            }
        },
        cancelPause() {
            if (this.$refs.timer?.resume) {
                this.$refs.timer.resume();
            }
            this.showPauseModal = false;
        },
        handleQuestionTick(questionTime, totalTime) {
            // Update local total time with the value emitted by the Timer component
            this.currentTotalTime = totalTime;

            const currentQuestionId = this.currentQuestionData?.id;
            if (!currentQuestionId) return; // Only apply threshold logic if question data is available

            // Determine the effective threshold for the current question
            const multiplier = this.questionThresholdMultipliers[currentQuestionId] || 1;
            const effectiveThreshold = this.questionTimeThreshold * multiplier;

            // Check if the current question time exceeds the effective threshold
            if (questionTime >= effectiveThreshold) {
                if (this.$refs.timer?.pause) {
                    this.$refs.timer.pause();
                }

                // Reset the user continued flag for this warning
                this.userContinuedTest = false;

                // Set up the warning message and countdown
                this.autoAdvanceCountdown = 5;
                this.timeWarningMessage = `You've spent over ${this.formatTime(effectiveThreshold)} on this question. Auto-pausing in ${this.autoAdvanceCountdown} seconds...`;
                this.showTimeWarningModal = true;

                // Start countdown
                console.log('Starting countdown interval');
                this.countdownInterval = setInterval(() => {
                    this.autoAdvanceCountdown--;
                    this.timeWarningMessage = `You've spent over ${this.formatTime(effectiveThreshold)} on this question. Auto-pausing in ${this.autoAdvanceCountdown} seconds...`;
                    console.log('Countdown tick:', this.autoAdvanceCountdown);
                    
                    if (this.autoAdvanceCountdown <= 0) {
                        console.log('Countdown reached 0');
                        if (!this.userContinuedTest) {
                            console.log('Auto-pausing test (user did not continue)');
                            this.clearCountdown();
                            this.showTimeWarningModal = false;
                            this.pauseTest(true);
                        } else {
                            console.log('User already continued test - skipping auto-pause');
                            this.clearCountdown();
                        }
                    }
                }, 1000);
            }
        },
        formatTime(seconds) {
            if (seconds === null || seconds === undefined) {
                return '00:00:00';
            }
            const h = Math.floor(seconds / 3600).toString().padStart(2, '0');
            const m = Math.floor((seconds % 3600) / 60).toString().padStart(2, '0');
            const s = Math.floor(seconds % 60).toString().padStart(2, '0');
            return `${h}:${m}:${s}`;
        },
        async finishAssessment() {
            if (!this.hasSelection) return;

            // Show finish confirmation modal
            this.showFinishModal = true;
        },
        async confirmFinish() {
            // Submit the final answer and complete the assessment
            this.answer.question_id = this.currentQuestionData.id;
            this.answer.duration = this.$refs.timer?.questionTimer || 0;
            this.answer.selected_options = this.selectedOptions;

            try {
                // const _response = await axios.post(
                    route("assessments.diagnostics.answer", this.diagnostic.id),
                    {
                        item_id: this.currentQuestionData.id,
                        answer: this.answer.selected_options,
                        time_taken: this.answer.duration,
                    }
                );

                // Navigate to results page
                this.$inertia.visit(
                    route("assessments.diagnostics.results", this.diagnostic.id)
                );
            } catch (error) {
                console.error("Error submitting final answer:", error);
                this.showError("Failed to submit answer. Please try again.");
            }
        },
        showError(message, shouldRedirect = false) {
            this.errorMessage = message;
            this.showErrorModal = true;
            this.shouldRedirectOnError = shouldRedirect;
        },
        handleErrorConfirm() {
            this.showErrorModal = false;
            if (this.shouldRedirectOnError) {
                // Redirect to diagnostics page
                this.$inertia.visit(typeof route !== 'undefined' ? route('assessments.diagnostics.index') : '/diagnostics');
            }
        },
        clearCountdown() {
            if (this.countdownInterval) {
                console.log('Clearing countdown interval');
                clearInterval(this.countdownInterval);
                this.countdownInterval = null;
            } else {
                console.log('No countdown interval to clear');
            }
        },
        handleTimeWarningContinue() {
            console.log('handleTimeWarningContinue called - should CONTINUE the test');
            
            // Prevent multiple calls
            if (this.userContinuedTest) {
                console.log('Already handled continue - ignoring duplicate call');
                return;
            }
            
            // Immediately clear countdown to prevent race condition
            this.clearCountdown();
            this.showTimeWarningModal = false;
            
            // Add a flag to prevent auto-pause from triggering
            this.userContinuedTest = true;
            
            const currentQuestionId = this.currentQuestionData?.id;
            if (currentQuestionId) {
                // Increment the multiplier for this question
                const multiplier = this.questionThresholdMultipliers[currentQuestionId] || 1;
                this.questionThresholdMultipliers[currentQuestionId] = multiplier + 1;
            }
            
            if (this.$refs.timer?.resume) {
                console.log('Resuming timer...');
                this.$refs.timer.resume();
            } else {
                console.log('Timer resume method not available');
            }
        },
        handleTimeWarningPause() {
            console.log('handleTimeWarningPause called - should PAUSE the test');
            
            // Prevent pause if user already continued
            if (this.userContinuedTest) {
                console.log('User already continued test - ignoring pause call');
                return;
            }
            
            this.clearCountdown();
            this.showTimeWarningModal = false;
            this.pauseTest(true);
        },
        getQuestionTypeName() {
            const typeMap = {
                1: 'Single Choice',
                2: 'Multiple Choice',
                3: 'Fill in the Blank',
                4: 'Drag and Drop',
                5: 'Matching',
                6: 'Hotspot',
                7: 'Simulation'
            };
            return typeMap[this.currentQuestionData?.type_id] || 'Unknown';
        },
        getDifficultyLabel() {
            if (!this.currentQuestionData?.difficulty) return "N/A";
            
            // Handle both object and string formats
            if (typeof this.currentQuestionData.difficulty === 'object') {
                return this.currentQuestionData.difficulty.name || "N/A";
            }
            return this.currentQuestionData.difficulty;
        },
        getDifficultyScore() {
            if (!this.currentQuestionData?.difficulty) return 0;
            
            // Handle both object and string formats
            let difficultyName = this.currentQuestionData.difficulty;
            if (typeof difficultyName === 'object') {
                difficultyName = difficultyName.name;
            }
            
            const difficultyMap = {
                'Very Easy': 1,
                'Easy': 2,
                'Medium': 3,
                'Hard': 4,
                'Very Hard': 5
            };
            
            return difficultyMap[difficultyName] || 0;
        },
        getBloomLabel() {
            if (!this.currentQuestionData?.bloom) return "N/A";
            
            // Handle both object and string formats
            if (typeof this.currentQuestionData.bloom === 'object') {
                // Check if level is "NA" or null/undefined
                const bloomLevel = this.currentQuestionData.bloom.level;
                if (!bloomLevel || bloomLevel === 'NA' || bloomLevel === 'N/A') {
                    return "N/A";
                }
                return bloomLevel;
            }
            
            // Handle string format
            if (this.currentQuestionData.bloom === 'NA' || this.currentQuestionData.bloom === 'N/A') {
                return "N/A";
            }
            
            return this.currentQuestionData.bloom;
        },
        getBloomScore() {
            if (!this.currentQuestionData?.bloom) return 0;
            
            // Handle both object and string formats
            let bloomLevel = this.currentQuestionData.bloom;
            if (typeof bloomLevel === 'object') {
                bloomLevel = bloomLevel.level;
            }
            
            // Return 0 for NA values
            if (!bloomLevel || bloomLevel === 'NA' || bloomLevel === 'N/A') {
                return 0;
            }
            
            const bloomMap = {
                'Remember': 1,
                'Understand': 2,
                'Apply': 3,
                'Analyze': 4,
                'Evaluate': 5,
                'Create': 6
            };
            
            return bloomMap[bloomLevel] || 0;
        },
        getTooltipPosition(tooltipType, isOpen) {
            if (!isOpen) return {};
            
            const buttonRef = tooltipType === 'difficulty' ? this.$refs.difficultyTooltipButton : this.$refs.bloomTooltipButton;
            if (!buttonRef || !buttonRef.$el) return {};
            
            const button = buttonRef.$el;
            const buttonRect = button.getBoundingClientRect();
            const tooltipWidth = 320; // w-80 = 20rem = 320px
            const tooltipHeight = 400; // Approximate height
            const padding = 16; // Minimum padding from viewport edge
            
            // Check available space
            const spaceRight = window.innerWidth - buttonRect.right;
            const spaceLeft = buttonRect.left;
            // const _spaceTop = buttonRect.top;
            const spaceBottom = window.innerHeight - buttonRect.bottom;
            
            const position = {};
            let direction = 'right';
            
            // Determine horizontal position
            if (spaceRight >= tooltipWidth + padding) {
                // Position to the right
                position.left = `${buttonRect.width + 8}px`;
                direction = 'right';
            } else if (spaceLeft >= tooltipWidth + padding) {
                // Position to the left
                position.right = `${buttonRect.width + 8}px`;
                direction = 'left';
            } else {
                // Position below if not enough horizontal space
                position.left = '50%';
                position.transform = 'translateX(-50%)';
                if (spaceBottom >= tooltipHeight + padding) {
                    position.top = `${buttonRect.height + 8}px`;
                    direction = 'bottom';
                } else {
                    position.bottom = `${buttonRect.height + 8}px`;
                    direction = 'top';
                }
            }
            
            // Vertical centering for left/right positioning
            if (direction === 'left' || direction === 'right') {
                // Check if tooltip would extend beyond viewport when centered
                const centerOffset = tooltipHeight / 2;
                if (buttonRect.top + buttonRect.height / 2 - centerOffset < padding) {
                    // Too close to top, align with top
                    position.top = `${padding}px`;
                    position.transform = '';
                } else if (buttonRect.top + buttonRect.height / 2 + centerOffset > window.innerHeight - padding) {
                    // Too close to bottom, align with bottom
                    position.bottom = `${padding}px`;
                    position.transform = '';
                } else {
                    // Center vertically
                    position.top = '50%';
                    position.transform = (position.transform || '') + ' translateY(-50%)';
                }
            }
            
            // Store direction for arrow classes
            this.tooltipDirection = direction;
            
            return position;
        },
        getArrowClasses(tooltipType, isOpen) {
            if (!isOpen || !this.tooltipDirection) return '';
            
            const direction = this.tooltipDirection;
            
            switch (direction) {
                case 'right':
                    return '-left-2 top-1/2 -translate-y-1/2';
                case 'left':
                    return '-right-2 top-1/2 -translate-y-1/2';
                case 'bottom':
                    return 'left-1/2 -translate-x-1/2 -top-2';
                case 'top':
                    return 'left-1/2 -translate-x-1/2 -bottom-2';
                default:
                    return '';
            }
        },
        getArrowStyle() {
            if (!this.tooltipDirection) return {};
            
            const direction = this.tooltipDirection;
            const isDark = this.isDark;
            
            const borderColor = isDark ? '#374151' : '#e5e7eb'; // gray-700 : gray-200
            
            switch (direction) {
                case 'right':
                    return {
                        borderLeftColor: borderColor,
                        borderBottomColor: borderColor,
                        borderRightColor: 'transparent',
                        borderTopColor: 'transparent'
                    };
                case 'left':
                    return {
                        borderRightColor: borderColor,
                        borderTopColor: borderColor,
                        borderLeftColor: 'transparent',
                        borderBottomColor: 'transparent'
                    };
                case 'bottom':
                    return {
                        borderLeftColor: borderColor,
                        borderTopColor: borderColor,
                        borderRightColor: 'transparent',
                        borderBottomColor: 'transparent'
                    };
                case 'top':
                    return {
                        borderRightColor: borderColor,
                        borderBottomColor: borderColor,
                        borderLeftColor: 'transparent',
                        borderTopColor: 'transparent'
                    };
                default:
                    return {};
            }
        },
    },
    async mounted() {
        // Initialize theme using the composable
        await this.initializeTheme();
        
        // Debug diagnostic state
        console.log('Diagnostic state:', {
            id: this.diagnostic?.id,
            status: this.diagnostic?.status,
            user_id: this.diagnostic?.user_id,
            current_question: this.diagnostic?.current_question,
            total_questions: this.diagnostic?.total_questions,
            responses: this.diagnostic?.responses?.length,
            answered_responses: this.diagnostic?.responses?.filter(r => r.user_answer !== null).length,
            initial_progress: this.currentProgress,
            calculated_question_number: this.currentQuestionNumber
        });
        
        // Set the initial total time displayed from the diagnostic's total_duration if it exists
        this.currentTotalTime = this.diagnostic?.total_duration ?? this.initialTimeElapsed;
        // Ensure initial progress is an integer
        this.currentProgress = Math.floor(this.currentProgress);
        // Initialize multiplier for the first question if needed
        if (this.currentQuestionData?.id && !this.questionThresholdMultipliers[this.currentQuestionData.id]) {
             this.questionThresholdMultipliers[this.currentQuestionData.id] = 1;
        }
        // Reset the question timer when the component is mounted (for the first or resumed question)
        this.$refs.timer?.resetQuestionTimer();
        // The timer component itself will start from initialElapsed

        // Explicitly resume timers when the component is mounted, ensuring they start with initialElapsed
        this.$refs.timer?.resume();
    },
    beforeUnmount() {
        // Clean up any running intervals
        this.clearCountdown();
    }
};
</script>

<style scoped>
.form-check-input:focus {
    outline: none;
    box-shadow: none;
}
.form-check-input:checked {
    background-color: rgb(
        96 165 250 / var(--tw-bg-opacity, 1)
    ); /* Tailwind blue-400 */
    border-color: #3b82f6; /* Tailwind blue-500 */
    box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.3); /* ring effect */
}

/* Removed review mode specific styles */
/*
.question-circle.answered {
    background-color: #4CAF50;
    color: white;
}
.question-circle.incorrect {
    background-color: #F44336;
    color: white;
}
.question-circle.correct {
     background-color: #81C784;
     color: white;
}
.question-circle.current {
    border-color: #333;
    border-width: 2px;
}
*/
</style>
