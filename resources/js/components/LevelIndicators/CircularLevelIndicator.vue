<template>
    <div class="flex items-center justify-center space-x-6">
        <!-- Difficulty Circle -->
        <div v-if="difficultyLevel" class="flex flex-col items-center space-y-2">
            <div class="relative">
                <svg class="w-20 h-20 transform -rotate-90" viewBox="0 0 80 80">
                    <!-- Background circle -->
                    <circle 
                        cx="40" 
                        cy="40" 
                        r="32" 
                        stroke="currentColor" 
                        stroke-width="6"
                        fill="none"
                        class="text-gray-200 dark:text-gray-700"
                    />
                    <!-- Progress circle -->
                    <circle 
                        cx="40" 
                        cy="40" 
                        r="32" 
                        stroke="currentColor" 
                        stroke-width="6"
                        fill="none"
                        stroke-linecap="round"
                        :stroke-dasharray="201.06"
                        :stroke-dashoffset="201.06 - (201.06 * getDifficultyPercentage(difficultyLevel.difficulty_score || getDifficultyScore(difficultyLevel.name)) / 100)"
                        :class="getDifficultyCircleClass(difficultyLevel.name)"
                        class="transition-all duration-1000 ease-out"
                    />
                </svg>
                <div class="absolute inset-0 flex flex-col items-center justify-center">
                    <span class="text-lg font-bold text-gray-800 dark:text-gray-200">
                        {{ difficultyLevel.difficulty_score || getDifficultyScore(difficultyLevel.name) }}
                    </span>
                    <span class="text-xs text-gray-500 dark:text-gray-400">/5</span>
                </div>
            </div>
            <div class="text-center">
                <div class="text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">
                    Difficulty Level
                </div>
                <Badge 
                    :variant="getDifficultyVariant(difficultyLevel.name)"
                    class="text-xs"
                >
                    {{ difficultyLevel.name }}
                </Badge>
            </div>
        </div>

        <!-- Bloom Circle -->
        <div v-if="bloomLevel" class="flex flex-col items-center space-y-2">
            <div class="relative">
                <svg class="w-20 h-20 transform -rotate-90" viewBox="0 0 80 80">
                    <!-- Background circle -->
                    <circle 
                        cx="40" 
                        cy="40" 
                        r="32" 
                        stroke="currentColor" 
                        stroke-width="6"
                        fill="none"
                        class="text-gray-200 dark:text-gray-700"
                    />
                    <!-- Progress circle -->
                    <circle 
                        cx="40" 
                        cy="40" 
                        r="32" 
                        stroke="currentColor" 
                        stroke-width="6"
                        fill="none"
                        stroke-linecap="round"
                        :stroke-dasharray="201.06"
                        :stroke-dashoffset="201.06 - (201.06 * getBloomPercentage(bloomLevel.level) / 100)"
                        :class="getBloomCircleClass(bloomLevel.level)"
                        class="transition-all duration-1000 ease-out"
                    />
                </svg>
                <div class="absolute inset-0 flex flex-col items-center justify-center">
                    <span class="text-lg font-bold text-gray-800 dark:text-gray-200">
                        {{ getBloomScore(bloomLevel.level) }}
                    </span>
                    <span class="text-xs text-gray-500 dark:text-gray-400">/6</span>
                </div>
            </div>
            <div class="text-center">
                <div class="text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">
                    Bloom's Taxonomy
                </div>
                <Badge 
                    :variant="getBloomVariant(bloomLevel.level)"
                    class="text-xs"
                >
                    {{ bloomLevel.level }}
                </Badge>
            </div>
        </div>

        <!-- Combined Summary (when both are present) -->
        <div v-if="difficultyLevel && bloomLevel && showSummary" class="flex flex-col items-center space-y-2 border-l border-gray-200 dark:border-gray-700 pl-6">
            <div class="text-center">
                <div class="text-sm font-semibold text-gray-800 dark:text-gray-200">
                    Overall Complexity
                </div>
                <div class="text-xs text-gray-600 dark:text-gray-400 mt-1">
                    {{ getComplexityDescription() }}
                </div>
            </div>
            <div class="flex items-center space-x-2 mt-2">
                <div class="flex space-x-1">
                    <div 
                        v-for="star in 5" 
                        :key="star"
                        :class="[
                            'w-3 h-3 rounded-full',
                            star <= getOverallComplexity()
                                ? 'bg-gradient-to-r from-yellow-400 to-yellow-600'
                                : 'bg-gray-200 dark:bg-gray-700'
                        ]"
                    />
                </div>
                <span class="text-xs text-gray-600 dark:text-gray-400">
                    {{ getOverallComplexity() }}/5
                </span>
            </div>
        </div>
    </div>
</template>

<script setup>
import Badge from '@/Components/shadcn/ui/badge/Badge.vue';

const props = defineProps({
    difficultyLevel: {
        type: Object,
        default: null
    },
    bloomLevel: {
        type: Object,
        default: null
    },
    showSummary: {
        type: Boolean,
        default: false
    }
});

// Difficulty Level Methods
const getDifficultyScore = (difficultyName) => {
    const scores = {
        'Very Easy': 1,
        'Easy': 2,
        'Medium': 3,
        'Hard': 4,
        'Very Hard': 5
    };
    return scores[difficultyName] || 1;
};

const getDifficultyPercentage = (score) => {
    return (score / 5) * 100;
};

const getDifficultyVariant = (difficulty) => {
    switch (difficulty?.toLowerCase()) {
        case 'very easy': return 'success';
        case 'easy': return 'success';
        case 'medium': return 'warning';
        case 'hard': return 'destructive';
        case 'very hard': return 'destructive';
        default: return 'default';
    }
};

const getDifficultyCircleClass = (difficulty) => {
    switch (difficulty?.toLowerCase()) {
        case 'very easy': return 'text-green-600';
        case 'easy': return 'text-green-500';
        case 'medium': return 'text-yellow-500';
        case 'hard': return 'text-red-500';
        case 'very hard': return 'text-red-600';
        default: return 'text-gray-500';
    }
};

// Bloom Level Methods
const getBloomScore = (bloomLevel) => {
    const scores = {
        'Remember': 1,
        'Understand': 2,
        'Apply': 3,
        'Analyze': 4,
        'Evaluate': 5,
        'Create': 6
    };
    return scores[bloomLevel] || 1;
};

const getBloomPercentage = (bloomLevel) => {
    return (getBloomScore(bloomLevel) / 6) * 100;
};

const getBloomVariant = (bloomLevel) => {
    switch (bloomLevel?.toLowerCase()) {
        case 'remember': return 'secondary';
        case 'understand': return 'default';
        case 'apply': return 'warning';
        case 'analyze': return 'info';
        case 'evaluate': return 'destructive';
        case 'create': return 'success';
        default: return 'default';
    }
};

const getBloomCircleClass = (bloomLevel) => {
    switch (bloomLevel?.toLowerCase()) {
        case 'remember': return 'text-gray-500';
        case 'understand': return 'text-blue-500';
        case 'apply': return 'text-yellow-500';
        case 'analyze': return 'text-purple-500';
        case 'evaluate': return 'text-red-500';
        case 'create': return 'text-green-500';
        default: return 'text-gray-500';
    }
};

// Combined Methods
const getOverallComplexity = () => {
    if (!props.difficultyLevel && !props.bloomLevel) return 0;
    
    const diffScore = props.difficultyLevel ? (getDifficultyScore(props.difficultyLevel.name) / 5) : 0;
    const bloomScore = props.bloomLevel ? (getBloomScore(props.bloomLevel.level) / 6) : 0;
    
    // Weight both equally and scale to 1-5
    const combined = ((diffScore + bloomScore) / 2) * 5;
    return Math.round(combined);
};

const getComplexityDescription = () => {
    const score = getOverallComplexity();
    switch (score) {
        case 1: return 'Very Simple';
        case 2: return 'Simple';
        case 3: return 'Moderate';
        case 4: return 'Complex';
        case 5: return 'Very Complex';
        default: return 'Unknown';
    }
};
</script>