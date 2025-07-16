<script setup lang="ts">
import { Head, router } from '@inertiajs/vue3'
import Layout from '@/layouts/AppLayout.vue'
import Button from '@/components/shadcn/ui/button/Button.vue'
import { ref, computed, onMounted } from 'vue'

const props = defineProps({
    assessment: Object,
    isAuthenticated: Boolean,
})

// Mock questions for demo
const questions = ref([
    {
        id: 1,
        text: "Which of the following is a fundamental principle of information security?",
        options: [
            { id: 'a', text: "Confidentiality, Integrity, and Availability" },
            { id: 'b', text: "Speed, Efficiency, and Cost" },
            { id: 'c', text: "Simplicity, Clarity, and Brevity" },
            { id: 'd', text: "Complexity, Redundancy, and Overhead" }
        ],
        correct: 'a'
    },
    {
        id: 2,
        text: "What does the 'principle of least privilege' mean?",
        options: [
            { id: 'a', text: "Give users maximum access for convenience" },
            { id: 'b', text: "Grant only the minimum access necessary for job functions" },
            { id: 'c', text: "Restrict access only to senior employees" },
            { id: 'd', text: "Allow access based on seniority level" }
        ],
        correct: 'b'
    },
    {
        id: 3,
        text: "Which authentication factor represents 'something you know'?",
        options: [
            { id: 'a', text: "Fingerprint" },
            { id: 'b', text: "Smart card" },
            { id: 'c', text: "Password" },
            { id: 'd', text: "Retina scan" }
        ],
        correct: 'c'
    },
    {
        id: 4,
        text: "What is the primary purpose of data classification?",
        options: [
            { id: 'a', text: "To organize files alphabetically" },
            { id: 'b', text: "To determine appropriate security controls" },
            { id: 'c', text: "To reduce storage costs" },
            { id: 'd', text: "To improve system performance" }
        ],
        correct: 'b'
    },
    {
        id: 5,
        text: "Which of the following best describes risk assessment?",
        options: [
            { id: 'a', text: "Eliminating all security risks" },
            { id: 'b', text: "Identifying, analyzing, and evaluating risks" },
            { id: 'c', text: "Purchasing insurance policies" },
            { id: 'd', text: "Installing security software" }
        ],
        correct: 'b'
    }
])

// Assessment state
const currentQuestion = ref(0)
const responses = ref({})
const startTime = ref(Date.now())
const isSubmitting = ref(false)

// Computed properties
const progress = computed(() => Math.round(((currentQuestion.value + 1) / questions.value.length) * 100))
const isLastQuestion = computed(() => currentQuestion.value >= questions.value.length - 1)
const currentQ = computed(() => questions.value[currentQuestion.value])
const canProceed = computed(() => responses.value[currentQ.value.id])

// Methods
const selectAnswer = (optionId) => {
    responses.value[currentQ.value.id] = optionId
}

const nextQuestion = () => {
    if (currentQuestion.value < questions.value.length - 1) {
        currentQuestion.value++
    }
}

const previousQuestion = () => {
    if (currentQuestion.value > 0) {
        currentQuestion.value--
    }
}

const submitAssessment = () => {
    isSubmitting.value = true
    
    // Calculate score
    let correctAnswers = 0
    questions.value.forEach(q => {
        if (responses.value[q.id] === q.correct) {
            correctAnswers++
        }
    })
    
    const responseData = {
        responses: questions.value.map(q => ({
            question_id: q.id,
            answer: responses.value[q.id],
            is_correct: responses.value[q.id] === q.correct
        })),
        time_taken: Math.round((Date.now() - startTime.value) / 1000)
    }
    
    // Submit to backend
    router.post(route('assessments.diagnostics.submit', props.assessment.id), responseData, {
        onFinish: () => {
            isSubmitting.value = false
        }
    })
}

onMounted(() => {
    startTime.value = Date.now()
})
</script>

<template>
    <Head title="SecureStart™ Assessment" />
    
    <div class="min-h-screen bg-gray-50 py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 mb-8">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">SecureStart™ Assessment</h1>
                        <p class="text-gray-600">Question {{ currentQuestion + 1 }} of {{ questions.length }}</p>
                    </div>
                    <div class="text-right">
                        <div class="text-sm text-gray-600 mb-1">Progress</div>
                        <div class="text-2xl font-bold text-blue-600">{{ progress }}%</div>
                    </div>
                </div>
                
                <!-- Progress Bar -->
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-gradient-to-r from-blue-600 to-purple-600 h-2 rounded-full transition-all duration-500"
                         :style="`width: ${progress}%`"></div>
                </div>
            </div>

            <!-- Question Card -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-8 mb-8">
                <div class="mb-8">
                    <h2 class="text-xl font-semibold text-gray-900 mb-6">
                        {{ currentQ.text }}
                    </h2>
                    
                    <!-- Answer Options -->
                    <div class="space-y-4">
                        <div v-for="option in currentQ.options" :key="option.id"
                             @click="selectAnswer(option.id)"
                             :class="[
                                'p-4 border-2 rounded-xl cursor-pointer transition-all duration-200',
                                responses[currentQ.id] === option.id 
                                    ? 'border-blue-500 bg-blue-50 text-blue-900' 
                                    : 'border-gray-200 hover:border-gray-300 hover:bg-gray-50'
                             ]">
                            <div class="flex items-center">
                                <div :class="[
                                    'w-5 h-5 rounded-full border-2 mr-4 flex items-center justify-center',
                                    responses[currentQ.id] === option.id 
                                        ? 'border-blue-500 bg-blue-500' 
                                        : 'border-gray-300'
                                ]">
                                    <div v-if="responses[currentQ.id] === option.id" 
                                         class="w-2 h-2 bg-white rounded-full"></div>
                                </div>
                                <span class="text-lg">{{ option.text }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Navigation -->
            <div class="flex justify-between items-center">
                <Button v-if="currentQuestion > 0" 
                        @click="previousQuestion"
                        variant="outline"
                        class="px-6 py-3">
                    ← Previous
                </Button>
                <div v-else></div>
                
                <div class="flex space-x-4">
                    <Button v-if="!isLastQuestion" 
                            @click="nextQuestion"
                            :disabled="!canProceed"
                            class="px-6 py-3">
                        Next →
                    </Button>
                    
                    <Button v-else 
                            @click="submitAssessment"
                            :disabled="!canProceed || isSubmitting"
                            class="px-8 py-3 bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700">
                        <span v-if="isSubmitting">Submitting...</span>
                        <span v-else>Complete Assessment</span>
                    </Button>
                </div>
            </div>

            <!-- Guest Notice -->
            <div v-if="!isAuthenticated" class="mt-8 p-6 bg-blue-50 border border-blue-200 rounded-xl">
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-blue-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <div>
                        <h3 class="font-semibold text-blue-900">Taking assessment as guest</h3>
                        <p class="text-blue-700 text-sm mt-1">
                            You'll be prompted to create an account after completion to view your detailed results.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script lang="ts">
export default {
    layout: Layout
}
</script>