<template>
    <AppLayout title="Diagnostic Results">
        <div class="min-h-screen bg-gray-50 dark:bg-gray-900">
            <!-- Header -->
            <div class="border-b border-gray-200/20 dark:border-gray-700/20">
                <div class="max-w-7xl mx-auto px-2 py-6 sm:px-6 lg:px-8 sm:py-8">
                    <h1 class="text-4xl font-black text-gray-900 dark:text-gray-100 tracking-tight leading-tight">
                        Diagnostic Assessment Results
                    </h1>
                    <p class="mt-3 text-lg font-medium text-gray-600 dark:text-gray-400 leading-relaxed">
                        Track your progress through all four assessment phases
                    </p>
                </div>
            </div>

            <!-- Phase Cards Grid -->
            <div class="max-w-7xl mx-auto px-2 py-4 sm:px-6 lg:px-8 sm:py-8">
                <!-- 4 Phase Cards in a Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4 lg:gap-6 mb-8">
                    <div v-for="phase in 4" :key="phase" 
                         class="group bg-white dark:bg-gray-800 rounded-2xl overflow-hidden border border-gray-200/60 dark:border-gray-700/60 transition-all duration-300 cursor-pointer"
                         :class="[
                             selectedPhase === phase 
                                 ? 'shadow-xl scale-[1.02] border-blue-500/40 dark:border-blue-400/40 ring-1 ring-blue-500/20 dark:ring-blue-400/20' 
                                 : 'shadow-sm hover:shadow-lg hover:scale-[1.01] hover:border-gray-300/80 dark:hover:border-gray-600/80'
                         ]"
                         @click="selectedPhase = phase">
                        
                        <!-- Card Content -->
                        <div class="p-5 sm:p-6">
                            <!-- Header Section -->
                            <div class="flex items-start justify-between mb-5">
                                <div class="flex items-center space-x-3">
                                    <div 
                                        class="w-11 h-11 rounded-xl flex items-center justify-center font-bold text-base shadow-sm transition-transform duration-200 group-hover:scale-105"
                                        :class="getPhaseIconClass(phase)"
                                    >
                                        <CheckIcon v-if="phases[phase]?.completed" class="w-6 h-6 text-white" />
                                        <LockIcon v-else-if="phases[phase]?.locked" class="w-5 h-5 text-gray-500" />
                                        <span v-else class="text-lg font-black">{{ phase }}</span>
                                    </div>
                                    <div>
                                        <div class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-0.5">
                                            Phase {{ phase }}
                                        </div>
                                        <div v-if="phases[phase]?.completed" class="flex items-center space-x-1">
                                            <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                                            <span class="text-xs font-medium text-green-600 dark:text-green-400">Completed</span>
                                        </div>
                                    </div>
                                </div>
                                <!-- Status Badge -->
                                <div v-if="phases[phase]?.completed" class="relative">
                                    <div class="w-7 h-7 rounded-full bg-green-500/15 flex items-center justify-center">
                                        <CheckCircleIcon class="w-4 h-4 text-green-500" />
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Phase Title -->
                            <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100 mb-4 leading-tight line-clamp-2">
                                {{ phases[phase]?.name || `Phase ${phase}` }}
                            </h3>
                            
                            <!-- Score/Status Display -->
                            <div class="mb-5">
                                <!-- Completed Phase Score -->
                                <div v-if="phases[phase]?.completed" class="relative">
                                    <div class="flex items-end space-x-1 mb-2">
                                        <div class="text-2xl sm:text-3xl font-black tracking-tighter leading-none" :class="getScoreColorClass(phases[phase].score)">
                                            {{ phases[phase].score }}
                                        </div>
                                        <div class="text-lg font-bold text-gray-400 dark:text-gray-500 pb-0.5">%</div>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <span class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide">Score</span>
                                        <div class="flex items-center space-x-1.5">
                                            <div class="w-1.5 h-1.5 rounded-full" :class="getScoreIndicatorClass(phases[phase].score)"></div>
                                            <span class="text-xs font-medium" :class="getScoreColorClass(phases[phase].score)">
                                                {{ getScoreLabel(phases[phase].score) }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- In Progress Status -->
                                <div v-else-if="phases[phase]?.attempts?.length > 0" class="space-y-2">
                                    <div class="flex items-center space-x-2">
                                        <div class="w-2.5 h-2.5 bg-amber-500 rounded-full animate-pulse"></div>
                                        <span class="text-lg font-bold text-amber-600 dark:text-amber-400">In Progress</span>
                                    </div>
                                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">
                                        {{ phases[phase].attempts[0].questions_answered || 0 }} questions answered
                                    </p>
                                    <!-- Progress indicator for in-progress -->
                                    <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                                        <div 
                                            class="h-2 bg-amber-500 rounded-full transition-all duration-300"
                                            :style="{ width: `${Math.min(((phases[phase].attempts[0].questions_answered || 0) / 20) * 100, 100)}%` }"
                                        ></div>
                                    </div>
                                </div>
                                
                                <!-- Locked Status -->
                                <div v-else-if="phases[phase]?.locked" class="space-y-2">
                                    <div class="flex items-center space-x-2">
                                        <div class="w-2.5 h-2.5 bg-gray-400 rounded-full"></div>
                                        <span class="text-lg font-bold text-gray-400 dark:text-gray-500">Locked</span>
                                    </div>
                                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">
                                        Complete Phase {{ phase - 1 }} first
                                    </p>
                                </div>
                                
                                <!-- Ready to Start -->
                                <div v-else class="space-y-2">
                                    <div class="flex items-center space-x-2">
                                        <div class="w-2.5 h-2.5 bg-blue-500 rounded-full"></div>
                                        <span class="text-lg font-bold text-blue-600 dark:text-blue-400">Ready</span>
                                    </div>
                                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">
                                        Begin assessment
                                    </p>
                                </div>
                            </div>
                            
                            <!-- Action Button -->
                            <div class="space-y-2">
                                <!-- Completed: Review Button -->
                                <Link
                                    v-if="phases[phase]?.completed"
                                    :href="route('assessments.diagnostics.review', phases[phase].selected_attempt.id)"
                                    class="w-full inline-flex justify-center items-center px-5 py-3 bg-gray-100 hover:bg-gray-150 dark:bg-gray-700 dark:hover:bg-gray-650 text-gray-700 dark:text-gray-300 font-semibold rounded-xl transition-all duration-200 hover:scale-[1.02] active:scale-98 text-sm"
                                >
                                    <span>Review Results</span>
                                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </Link>
                                
                                <!-- In Progress: Continue Button -->
                                <Link 
                                    v-else-if="phases[phase]?.attempts?.length > 0"
                                    :href="route('assessments.diagnostics.show', phases[phase].attempts[0].id)"
                                    class="w-full inline-flex justify-center items-center px-5 py-3 bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 text-white font-semibold rounded-xl transition-all duration-200 hover:scale-[1.02] active:scale-98 shadow-sm hover:shadow-md text-sm"
                                >
                                    <span>Continue Assessment</span>
                                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h1m4 0h1m-6 4h8" />
                                    </svg>
                                </Link>
                                
                                <!-- Locked: Disabled Button -->
                                <button
                                    v-else-if="phases[phase]?.locked"
                                    disabled
                                    class="w-full px-5 py-3 bg-gray-200 dark:bg-gray-700 text-gray-400 font-semibold rounded-xl cursor-not-allowed opacity-60 text-sm"
                                >
                                    <LockIcon class="w-4 h-4 inline mr-2" />
                                    Locked
                                </button>
                                
                                <!-- Ready: Start Button -->
                                <form 
                                    v-else
                                    @submit.prevent="startPhase(phase)"
                                    class="w-full"
                                >
                                    <button
                                        type="submit"
                                        class="w-full inline-flex justify-center items-center px-5 py-3 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold rounded-xl transition-all duration-200 hover:scale-[1.02] active:scale-98 shadow-sm hover:shadow-md text-sm"
                                    >
                                        <RocketIcon class="w-4 h-4 mr-2" />
                                        Start Phase {{ phase }}
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Overall Progress Bar -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200/50 dark:border-gray-700/50 p-6 mb-8">
                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <h2 class="text-xl font-semibold text-gray-900 dark:text-gray-100">
                                Overall Progress
                            </h2>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                                Your cybersecurity assessment journey
                            </p>
                        </div>
                        <div class="text-right">
                            <div class="text-3xl font-bold text-gray-900 dark:text-gray-100">
                                {{ Math.round((completedPhasesCount / 4) * 100) }}%
                            </div>
                            <span class="text-sm font-medium text-gray-600 dark:text-gray-400">
                                {{ completedPhasesCount }}/4 Complete
                            </span>
                        </div>
                    </div>
                    
                    <!-- Enhanced Progress Bar -->
                    <div class="relative">
                        <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-3 overflow-hidden">
                            <div 
                                class="h-full bg-gradient-to-r from-blue-500 to-indigo-600 rounded-full transition-all duration-700 ease-out relative"
                                :style="{ width: `${(completedPhasesCount / 4) * 100}%` }"
                            >
                                <!-- Shimmer effect for completed sections -->
                                <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/20 to-transparent animate-pulse"></div>
                            </div>
                        </div>
                        
                        <!-- Phase Markers -->
                        <div class="flex justify-between mt-3">
                            <div v-for="phase in 4" :key="phase" class="flex flex-col items-center">
                                <div 
                                    class="w-3 h-3 rounded-full border-2 transition-all duration-300"
                                    :class="phases[phase]?.completed 
                                        ? 'bg-blue-500 border-blue-500' 
                                        : 'bg-gray-200 dark:bg-gray-700 border-gray-300 dark:border-gray-600'"
                                ></div>
                                <span class="text-xs font-medium text-gray-600 dark:text-gray-400 mt-1">
                                    P{{ phase }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Phase Results -->
                <div class="space-y-3 sm:space-y-6">
                    <div v-for="phase in 4" :key="phase" class="bg-white dark:bg-gray-800 rounded-lg shadow-xs overflow-hidden">
                        <!-- Phase Header -->
                        <div class="p-3 border-b border-gray-200 dark:border-gray-700 sm:p-6">
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
                                    <div class="flex items-end justify-end space-x-1 mb-1">
                                        <div class="text-2xl font-black tracking-tighter" :class="getScoreColorClass(phases[phase].score)">
                                            {{ phases[phase].score }}
                                        </div>
                                        <div class="text-lg font-bold text-gray-400 dark:text-gray-500 pb-0.5">%</div>
                                    </div>
                                    <div class="flex items-center justify-end space-x-1">
                                        <div class="w-1.5 h-1.5 rounded-full" :class="getScoreIndicatorClass(phases[phase].score)"></div>
                                        <p class="text-xs font-medium" :class="getScoreColorClass(phases[phase].score)">{{ getScoreLabel(phases[phase].score) }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Phase Content -->
                        <div class="p-3 sm:p-6">
                            <!-- Completed Phase -->
                            <div v-if="phases[phase] && phases[phase].attempts.length > 0">
                                <!-- Attempt Selector (if multiple) -->
                                <div v-if="phases[phase].attempts.length > 1" class="mb-3 sm:mb-6">
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
                                <div v-if="phases[phase].domain_performance.length > 0" class="space-y-3 sm:space-y-4">
                                    <h4 class="font-medium text-gray-900 dark:text-gray-100">Domain Performance</h4>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-2 sm:gap-4">
                                        <div 
                                            v-for="domain in phases[phase].domain_performance" 
                                            :key="domain.name"
                                            class="relative"
                                        >
                                            <div class="flex justify-between items-center mb-2">
                                                <span class="text-sm font-medium text-gray-700 dark:text-gray-300">
                                                    {{ domain.name }}
                                                </span>
                                                <div class="flex items-baseline space-x-0.5">
                                                    <span class="text-base font-black" :class="getScoreColorClass(domain.score)">
                                                        {{ domain.score }}
                                                    </span>
                                                    <span class="text-sm font-bold text-gray-400 dark:text-gray-500">%</span>
                                                </div>
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
                                <div class="grid grid-cols-3 gap-2 mt-3 sm:gap-4 sm:mt-6">
                                    <div class="text-center p-2 bg-gray-50 dark:bg-gray-700 rounded-lg sm:p-4">
                                        <div class="text-lg font-bold text-gray-900 dark:text-gray-100 sm:text-2xl">
                                            {{ phases[phase].selected_attempt.total_questions }}
                                        </div>
                                        <p class="text-xs text-gray-600 dark:text-gray-400 sm:text-sm">Questions</p>
                                    </div>
                                    <div class="text-center p-2 bg-gray-50 dark:bg-gray-700 rounded-lg sm:p-4">
                                        <div class="text-lg font-bold text-green-600 dark:text-green-400 sm:text-2xl">
                                            {{ phases[phase].selected_attempt.correct_count }}
                                        </div>
                                        <p class="text-xs text-gray-600 dark:text-gray-400 sm:text-sm">Correct</p>
                                    </div>
                                    <div class="text-center p-2 bg-gray-50 dark:bg-gray-700 rounded-lg sm:p-4">
                                        <div class="text-lg font-bold text-blue-600 dark:text-blue-400 sm:text-2xl">
                                            {{ formatDuration(phases[phase].selected_attempt.duration) }}
                                        </div>
                                        <p class="text-xs text-gray-600 dark:text-gray-400 sm:text-sm">Duration</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Not Started/Locked Phase -->
                            <div v-else class="text-center py-6 sm:py-12">
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
                                    <form 
                                        @submit.prevent="startPhase(phase)"
                                    >
                                        <button
                                            type="submit"
                                            class="inline-flex items-center px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg shadow-md transition-all duration-200 transform hover:scale-105"
                                        >
                                            <RocketIcon class="w-5 h-5 mr-2" />
                                            Start Phase {{ phase }}
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Subtopic Performance Analysis (when all phases completed) -->
                <div v-if="all_phases_completed && subtopic_analysis" class="mt-4 bg-white dark:bg-gray-800 rounded-lg shadow-xs p-3 sm:mt-8 sm:p-6">
                    <h2 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-3 sm:text-2xl sm:mb-6">
                        Detailed Knowledge Analysis
                    </h2>
                    
                    <!-- Overall Mastery -->
                    <div class="mb-4 text-center sm:mb-8">
                        <div class="inline-flex items-center justify-center w-24 h-24 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 text-white mb-3 sm:w-32 sm:h-32 sm:mb-4">
                            <span class="text-2xl font-bold sm:text-3xl">{{ subtopic_analysis.mastery_percentage }}%</span>
                        </div>
                        <p class="text-base text-gray-700 dark:text-gray-300 sm:text-lg">Overall Knowledge Mastery</p>
                    </div>

                    <!-- Statistics Overview -->
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-2 mb-4 sm:gap-4 sm:mb-8">
                        <div class="text-center p-2 bg-green-50 dark:bg-green-900/20 rounded-lg sm:p-4">
                            <div class="text-lg font-bold text-green-600 dark:text-green-400 sm:text-2xl">
                                {{ subtopic_analysis.overall_stats.mastered_subtopics }}
                            </div>
                            <p class="text-xs text-green-700 dark:text-green-300 sm:text-sm">Mastered</p>
                        </div>
                        <div class="text-center p-2 bg-yellow-50 dark:bg-yellow-900/20 rounded-lg sm:p-4">
                            <div class="text-lg font-bold text-yellow-600 dark:text-yellow-400 sm:text-2xl">
                                {{ subtopic_analysis.overall_stats.developing_subtopics }}
                            </div>
                            <p class="text-xs text-yellow-700 dark:text-yellow-300 sm:text-sm">Developing</p>
                        </div>
                        <div class="text-center p-2 bg-red-50 dark:bg-red-900/20 rounded-lg sm:p-4">
                            <div class="text-lg font-bold text-red-600 dark:text-red-400 sm:text-2xl">
                                {{ subtopic_analysis.overall_stats.needs_improvement_subtopics }}
                            </div>
                            <p class="text-xs text-red-700 dark:text-red-300 sm:text-sm">Needs Work</p>
                        </div>
                        <div class="text-center p-2 bg-blue-50 dark:bg-blue-900/20 rounded-lg sm:p-4">
                            <div class="text-lg font-bold text-blue-600 dark:text-blue-400 sm:text-2xl">
                                {{ subtopic_analysis.overall_stats.total_subtopics }}
                            </div>
                            <p class="text-xs text-blue-700 dark:text-blue-300 sm:text-sm">Total Topics</p>
                        </div>
                    </div>

                    <!-- Top Strengths & Areas for Improvement -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3 mb-4 sm:gap-6 sm:mb-8">
                        <div>
                            <h3 class="font-semibold text-gray-900 dark:text-gray-100 mb-2 sm:mb-4">
                                🏆 Top Strengths
                            </h3>
                            <div class="space-y-3">
                                <div 
                                    v-for="subtopic in subtopic_analysis.top_strengths" 
                                    :key="subtopic.id"
                                    class="p-2 bg-green-50 dark:bg-green-900/20 rounded-lg border-l-4 border-green-500 sm:p-3"
                                >
                                    <div class="flex justify-between items-start mb-1">
                                        <h4 class="font-medium text-gray-900 dark:text-gray-100">{{ subtopic.name }}</h4>
                                        <span class="text-sm font-bold text-green-600 dark:text-green-400">{{ subtopic.accuracy }}%</span>
                                    </div>
                                    <p class="text-xs text-gray-600 dark:text-gray-400">{{ subtopic.domain_name }} • {{ subtopic.topic_name }}</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">{{ subtopic.total_questions }} questions • Bloom Level {{ subtopic.avg_bloom_level }}</p>
                                </div>
                            </div>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-900 dark:text-gray-100 mb-2 sm:mb-4">
                                📈 Focus Areas  
                            </h3>
                            <div class="space-y-3">
                                <div 
                                    v-for="subtopic in subtopic_analysis.improvement_areas" 
                                    :key="subtopic.id"
                                    class="p-2 bg-red-50 dark:bg-red-900/20 rounded-lg border-l-4 border-red-500 sm:p-3"
                                >
                                    <div class="flex justify-between items-start mb-1">
                                        <h4 class="font-medium text-gray-900 dark:text-gray-100">{{ subtopic.name }}</h4>
                                        <span class="text-sm font-bold text-red-600 dark:text-red-400">{{ subtopic.accuracy }}%</span>
                                    </div>
                                    <p class="text-xs text-gray-600 dark:text-gray-400">{{ subtopic.domain_name }} • {{ subtopic.topic_name }}</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">{{ subtopic.total_questions }} questions • Bloom Level {{ subtopic.avg_bloom_level }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Detailed Subtopic Performance Table -->
                    <div class="mt-3 pt-3 border-t border-gray-200 dark:border-gray-700 sm:mt-6 sm:pt-6">
                        <h3 class="font-semibold text-gray-900 dark:text-gray-100 mb-2 sm:mb-4">
                            Complete Performance Breakdown
                        </h3>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-50 dark:bg-gray-700">
                                    <tr>
                                        <th class="px-2 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider sm:px-4 sm:py-3">Subtopic</th>
                                        <th class="px-2 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider sm:px-4 sm:py-3">Domain</th>
                                        <th class="px-2 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider sm:px-4 sm:py-3">Accuracy</th>
                                        <th class="px-2 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider sm:px-4 sm:py-3">Questions</th>
                                        <th class="px-2 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider sm:px-4 sm:py-3">Level</th>
                                        <th class="px-2 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider sm:px-4 sm:py-3">Proficiency</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                    <tr 
                                        v-for="subtopic in displayedSubtopics" 
                                        :key="subtopic.id"
                                        class="hover:bg-gray-50 dark:hover:bg-gray-700"
                                    >
                                        <td class="px-2 py-2 sm:px-4 sm:py-3">
                                            <div class="text-xs font-medium text-gray-900 dark:text-gray-100 sm:text-sm">{{ subtopic.name }}</div>
                                            <div class="text-xs text-gray-500 dark:text-gray-400">{{ subtopic.topic_name }}</div>
                                        </td>
                                        <td class="px-2 py-2 text-xs text-gray-700 dark:text-gray-300 sm:px-4 sm:py-3 sm:text-sm">{{ subtopic.domain_name }}</td>
                                        <td class="px-2 py-2 sm:px-4 sm:py-3">
                                            <span 
                                                class="text-xs font-medium sm:text-sm"
                                                :class="{
                                                    'text-green-600 dark:text-green-400': subtopic.accuracy >= 80,
                                                    'text-yellow-600 dark:text-yellow-400': subtopic.accuracy >= 60 && subtopic.accuracy < 80,
                                                    'text-red-600 dark:text-red-400': subtopic.accuracy < 60
                                                }"
                                            >
                                                {{ subtopic.accuracy }}%
                                            </span>
                                        </td>
                                        <td class="px-2 py-2 text-xs text-gray-700 dark:text-gray-300 sm:px-4 sm:py-3 sm:text-sm">{{ subtopic.correct_answers }}/{{ subtopic.total_questions }}</td>
                                        <td class="px-2 py-2 text-xs text-gray-700 dark:text-gray-300 sm:px-4 sm:py-3 sm:text-sm">{{ subtopic.avg_bloom_level }}</td>
                                        <td class="px-2 py-2 sm:px-4 sm:py-3">
                                            <span 
                                                class="px-2 py-1 text-xs font-medium rounded-full"
                                                :class="{
                                                    'bg-green-100 dark:bg-green-900/20 text-green-700 dark:text-green-300': subtopic.proficiency_level === 'Mastered',
                                                    'bg-yellow-100 dark:bg-yellow-900/20 text-yellow-700 dark:text-yellow-300': subtopic.proficiency_level === 'Developing',
                                                    'bg-red-100 dark:bg-red-900/20 text-red-700 dark:text-red-300': subtopic.proficiency_level === 'Needs Improvement'
                                                }"
                                            >
                                                {{ subtopic.proficiency_level }}
                                            </span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div v-if="subtopic_analysis.subtopic_performance.length > 20" class="mt-4 text-center">
                            <p class="text-sm text-gray-500 dark:text-gray-400 mb-3">
                                {{ showAllSubtopics 
                                    ? `Showing all ${subtopic_analysis.subtopic_performance.length} subtopics` 
                                    : `Showing top 20 of ${subtopic_analysis.subtopic_performance.length} subtopics` 
                                }}
                            </p>
                            <button 
                                @click="showAllSubtopics = !showAllSubtopics"
                                class="inline-flex items-center px-4 py-2 text-sm font-medium rounded-lg transition-colors"
                                :class="isDark 
                                    ? 'bg-gray-700 hover:bg-gray-600 text-gray-300 border border-gray-600' 
                                    : 'bg-gray-100 hover:bg-gray-200 text-gray-700 border border-gray-300'"
                            >
                                <svg v-if="!showAllSubtopics" class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                                <svg v-else class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
                                </svg>
                                {{ showAllSubtopics 
                                    ? 'Show Top 20 Only' 
                                    : `Show All ${subtopic_analysis.subtopic_performance.length} Subtopics` 
                                }}
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Knowledge Analysis Placeholder (incomplete) -->
                <div v-else-if="!all_phases_completed" class="mt-4 bg-gray-100 dark:bg-gray-800 rounded-lg p-4 text-center sm:mt-8 sm:p-8">
                    <GraduationCapIcon class="w-16 h-16 text-gray-400 dark:text-gray-600 mx-auto mb-4" />
                    <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-2">
                        Detailed Knowledge Analysis Locked
                    </h3>
                    <p class="text-gray-600 dark:text-gray-400">
                        Complete all four assessment phases to unlock detailed knowledge analysis and performance insights
                    </p>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup lang="ts">
import { computed, ref } from 'vue';
import { Link, router } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import { 
    CheckIcon, 
    LockIcon, 
    RocketIcon,
    CheckCircleIcon,
    GraduationCapIcon
} from 'lucide-vue-next';

const props = defineProps({
    phases: Object,
    all_phases_completed: Boolean,
    subtopic_analysis: Object
});


// Track selected attempts for each phase
const selectedAttempts = ref({});

// Track whether to show all subtopics or just the first 20
const showAllSubtopics = ref(false);


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
if (props.phases) {
    Object.keys(props.phases).forEach(phaseNum => {
        const phase = props.phases?.[phaseNum];
        if (phase?.attempts?.length > 0) {
            selectedAttempts.value[phaseNum] = phase.attempts.find(a => a.is_latest)?.id || phase.attempts[0].id;
        }
    });
}

// Computed property for completed phases count
const completedPhasesCount = computed(() => {
    if (!props.phases) return 0;
    return Object.values(props.phases).filter(phase => phase?.completed).length;
});

// Computed property for displayed subtopics
const displayedSubtopics = computed(() => {
    if (!props.subtopic_analysis?.subtopic_performance) return [];
    return showAllSubtopics.value 
        ? props.subtopic_analysis.subtopic_performance 
        : props.subtopic_analysis.subtopic_performance.slice(0, 20);
});

// Check if current theme is dark
const isDark = computed(() => {
    return document.documentElement.classList.contains('dark') ||
           window.matchMedia?.('(prefers-color-scheme: dark)').matches;
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
    if (score >= 60) return 'text-amber-600 dark:text-amber-400';
    return 'text-red-600 dark:text-red-400';
};

const getScoreIndicatorClass = (score) => {
    if (score >= 80) return 'bg-green-500';
    if (score >= 60) return 'bg-amber-500';
    return 'bg-red-500';
};

const getScoreLabel = (score) => {
    if (score >= 90) return 'Excellent';
    if (score >= 80) return 'Good';
    if (score >= 70) return 'Fair';
    if (score >= 60) return 'Needs Work';
    return 'Critical';
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

const startPhase = (phase) => {
    router.post(route('assessments.diagnostics.start'), {
        phase: phase
    });
};
</script>