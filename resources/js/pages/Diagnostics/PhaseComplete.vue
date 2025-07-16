<template>
    <div class="min-h-screen flex flex-col bg-gray-50 dark:bg-gray-900">
        <!-- Header -->
        <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-xl border-b border-gray-200/50 dark:border-gray-700/50">
            <div class="px-6 py-4">
                <div class="flex items-center justify-between">
                    <div class="flex-1">
                        <h1 class="text-lg font-semibold text-gray-900 dark:text-white">
                            Diagnostic Assessment
                        </h1>
                        <div class="flex items-center gap-2 mt-1">
                            <span class="text-sm text-gray-500 dark:text-gray-400">
                                Phase {{ completedPhase }} Complete
                            </span>
                            <span class="text-gray-300 dark:text-gray-600">•</span>
                            <span class="text-sm font-medium text-green-600 dark:text-green-400">
                                {{ overallProgress }}% Complete
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex items-center justify-center px-6 py-8">
            <div class="max-w-2xl mx-auto text-center">
                <!-- Celebration Animation -->
                <div class="mb-8">
                    <div class="relative inline-flex items-center justify-center w-32 h-32 mx-auto">
                        <!-- Progress Ring -->
                        <svg class="w-32 h-32 transform -rotate-90" viewBox="0 0 120 120">
                            <!-- Background ring -->
                            <circle
                                cx="60"
                                cy="60"
                                r="54"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="8"
                                class="text-gray-200 dark:text-gray-700"
                            />
                            <!-- Progress ring -->
                            <circle
                                cx="60"
                                cy="60"
                                r="54"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="8"
                                stroke-linecap="round"
                                class="text-green-500 transition-all duration-1000 ease-out"
                                :stroke-dasharray="circumference"
                                :stroke-dashoffset="circumference - (overallProgress / 100) * circumference"
                            />
                        </svg>
                        
                        <!-- Checkmark -->
                        <div class="absolute inset-0 flex items-center justify-center">
                            <div class="w-16 h-16 bg-green-500 rounded-full flex items-center justify-center animate-bounce">
                                <CheckIcon class="w-8 h-8 text-white" />
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Phase Complete Message -->
                <div class="mb-8">
                    <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">
                        {{ phaseData.name }} Complete!
                    </h2>
                    <p class="text-lg text-gray-600 dark:text-gray-400 mb-4">
                        You've successfully completed all 5 domains in this phase
                    </p>
                    <div class="inline-flex items-center gap-2 px-4 py-2 bg-green-100 dark:bg-green-900/20 text-green-700 dark:text-green-400 rounded-full text-sm font-medium">
                        <span>{{ overallProgress }}% of Assessment Complete</span>
                    </div>
                </div>

                <!-- Phase Summary -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200/50 dark:border-gray-700/50 p-6 mb-8">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                        Phase Summary
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div v-for="domain in completedDomains" :key="domain.id" class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-700/50 rounded-lg">
                            <div class="flex items-center gap-3">
                                <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                                <span class="text-sm font-medium text-gray-900 dark:text-white">
                                    {{ domain.name }}
                                </span>
                            </div>
                            <div class="text-sm text-green-600 dark:text-green-400 font-medium">
                                {{ domain.confidence }}%
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Next Phase Preview (if not final phase) -->
                <div v-if="!isFinalPhase" class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200/50 dark:border-gray-700/50 p-6 mb-8">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                        Next: {{ nextPhaseData.name }}
                    </h3>
                    <p class="text-gray-600 dark:text-gray-400 mb-4">
                        {{ nextPhaseData.description }}
                    </p>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                        <div v-for="domain in nextPhaseDomains" :key="domain.id" class="flex items-center gap-3 p-2 text-sm">
                            <div class="w-1.5 h-1.5 bg-gray-400 rounded-full"></div>
                            <span class="text-gray-600 dark:text-gray-400">{{ domain.name }}</span>
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex gap-4 justify-center">
                    <button
                        @click="viewPhaseResults"
                        class="px-6 py-3 text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-gray-100 transition-colors"
                    >
                        View Phase Results
                    </button>
                    <button
                        v-if="!isFinalPhase"
                        @click="continueToNextPhase"
                        class="px-8 py-3 rounded-full font-medium bg-blue-600 hover:bg-blue-700 text-white shadow-lg hover:shadow-xl transition-all transform active:scale-95"
                    >
                        Continue to Next Phase
                    </button>
                    <button
                        v-else
                        @click="viewFinalResults"
                        class="px-8 py-3 rounded-full font-medium bg-green-600 hover:bg-green-700 text-white shadow-lg hover:shadow-xl transition-all transform active:scale-95"
                    >
                        View Final Results
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script lang="ts">
import { CheckIcon } from '@heroicons/vue/24/outline'
import { router } from '@inertiajs/vue3'

export default {
    components: {
        CheckIcon
    },
    props: {
        diagnostic: Object,
        completedPhase: Number,
        completedDomains: Array,
        nextPhaseDomains: Array,
        overallProgress: Number
    },
    setup(props) {
        const circumference = 2 * Math.PI * 54 // radius = 54
        
        const phaseData = computed(() => {
            const phases = {
                1: {
                    name: 'Foundation & Governance',
                    description: 'Core security concepts and organizational frameworks'
                },
                2: {
                    name: 'Technical Controls',
                    description: 'Security assessments and technical safeguards'
                },
                3: {
                    name: 'Infrastructure & Applications',
                    description: 'Network, application, and system security'
                },
                4: {
                    name: 'Operations & Response',
                    description: 'Security operations and incident management'
                }
            }
            return phases[props.completedPhase] || phases[1]
        })
        
        const nextPhaseData = computed(() => {
            const phases = {
                2: {
                    name: 'Technical Controls',
                    description: 'Security assessments and technical safeguards'
                },
                3: {
                    name: 'Infrastructure & Applications',
                    description: 'Network, application, and system security'
                },
                4: {
                    name: 'Operations & Response',
                    description: 'Security operations and incident management'
                }
            }
            return phases[props.completedPhase + 1] || null
        })
        
        const isFinalPhase = computed(() => {
            return props.completedPhase === 4
        })
        
        const continueToNextPhase = () => {
            router.visit(route('assessments.diagnostics.continue-phase', {
                diagnostic: props.diagnostic.id,
                phase: props.completedPhase + 1
            }))
        }
        
        const viewPhaseResults = () => {
            router.visit(route('assessments.diagnostics.phase-results', {
                diagnostic: props.diagnostic.id,
                phase: props.completedPhase
            }))
        }
        
        const viewFinalResults = () => {
            router.visit(route('assessments.diagnostics.results', props.diagnostic.id))
        }
        
        return {
            circumference,
            phaseData,
            nextPhaseData,
            isFinalPhase,
            continueToNextPhase,
            viewPhaseResults,
            viewFinalResults
        }
    }
}
</script>