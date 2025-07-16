<template>
    <div class="space-y-4">
        <!-- Difficulty Level Indicator -->
        <div v-if="difficultyLevel" class="space-y-2">
            <div class="flex items-center justify-between">
                <label class="text-sm font-medium text-gray-600 dark:text-gray-400">
                    Difficulty Level
                </label>
                <Badge :variant="getDifficultyVariant(difficultyLevel.name)">
                    {{ difficultyLevel.name }}
                </Badge>
            </div>
            
            <!-- Difficulty Visual Indicator -->
            <div class="flex items-center space-x-2">
                <div class="flex-1">
                    <Progress 
                        :model-value="getDifficultyPercentage(difficultyLevel.difficulty_score || getDifficultyScore(difficultyLevel.name))" 
                        :class="getDifficultyProgressClass(difficultyLevel.name)"
                        class="h-2"
                    />
                </div>
                <span class="text-xs font-medium text-gray-500 dark:text-gray-400 min-w-[3rem]">
                    {{ difficultyLevel.difficulty_score || getDifficultyScore(difficultyLevel.name) }}/5
                </span>
            </div>
            
            <!-- Difficulty Steps Visualization (Alternative) -->
            <div v-if="showSteps" class="flex items-center space-x-1">
                <div 
                    v-for="step in 5" 
                    :key="'diff-' + step"
                    :class="[
                        'w-6 h-6 rounded-full border-2 flex items-center justify-center text-xs font-bold transition-all',
                        step <= (difficultyLevel.difficulty_score || getDifficultyScore(difficultyLevel.name))
                            ? getDifficultyStepActiveClass(difficultyLevel.name)
                            : 'border-gray-300 dark:border-gray-600 text-gray-400 dark:text-gray-500'
                    ]"
                >
                    {{ step }}
                </div>
            </div>
        </div>

        <!-- Bloom Level Indicator -->
        <div v-if="bloomLevel" class="space-y-2">
            <div class="flex items-center justify-between">
                <label class="text-sm font-medium text-gray-600 dark:text-gray-400">
                    Bloom's Taxonomy Level
                </label>
                <Badge :variant="getBloomVariant(bloomLevel.level)">
                    {{ bloomLevel.level }}
                </Badge>
            </div>
            
            <!-- Bloom Visual Indicator -->
            <div class="flex items-center space-x-2">
                <div class="flex-1">
                    <Progress 
                        :model-value="getBloomPercentage(bloomLevel.level)" 
                        :class="getBloomProgressClass(bloomLevel.level)"
                        class="h-2"
                    />
                </div>
                <span class="text-xs font-medium text-gray-500 dark:text-gray-400 min-w-[3rem]">
                    {{ getBloomScore(bloomLevel.level) }}/6
                </span>
            </div>
            
            <!-- Bloom Steps Visualization -->
            <div v-if="showSteps" class="grid grid-cols-6 gap-1">
                <div 
                    v-for="(level, index) in bloomLevels" 
                    :key="'bloom-' + index"
                    :class="[
                        'px-2 py-1 rounded text-xs font-medium text-center transition-all',
                        index < getBloomScore(bloomLevel.level)
                            ? getBloomStepActiveClass(bloomLevel.level)
                            : 'bg-gray-100 dark:bg-gray-700 text-gray-500 dark:text-gray-400'
                    ]"
                    :title="level.description"
                >
                    {{ level.short }}
                </div>
            </div>
            
            <!-- Bloom Description -->
            <p v-if="showDescription" class="text-xs text-gray-600 dark:text-gray-400 italic">
                {{ getBloomDescription(bloomLevel.level) }}
            </p>
        </div>

        <!-- Combined Circular Indicator (Alternative Layout) -->
        <div v-if="showCircular && (difficultyLevel || bloomLevel)" class="flex items-center justify-center space-x-8 py-4">
            <!-- Difficulty Circle -->
            <div v-if="difficultyLevel" class="flex flex-col items-center space-y-2">
                <div class="relative w-16 h-16">
                    <svg class="w-16 h-16 transform -rotate-90" viewBox="0 0 64 64">
                        <!-- Background circle -->
                        <circle 
                            cx="32" 
                            cy="32" 
                            r="28" 
                            stroke="currentColor" 
                            stroke-width="4"
                            fill="none"
                            class="text-gray-200 dark:text-gray-700"
                        />
                        <!-- Progress circle -->
                        <circle 
                            cx="32" 
                            cy="32" 
                            r="28" 
                            stroke="currentColor" 
                            stroke-width="4"
                            fill="none"
                            :stroke-dasharray="175.93"
                            :stroke-dashoffset="175.93 - (175.93 * getDifficultyPercentage(difficultyLevel.difficulty_score || getDifficultyScore(difficultyLevel.name)) / 100)"
                            :class="getDifficultyCircleClass(difficultyLevel.name)"
                            class="transition-all duration-500"
                        />
                    </svg>
                    <div class="absolute inset-0 flex items-center justify-center">
                        <span class="text-sm font-bold text-gray-800 dark:text-gray-200">
                            {{ difficultyLevel.difficulty_score || getDifficultyScore(difficultyLevel.name) }}/5
                        </span>
                    </div>
                </div>
                <div class="text-center">
                    <div class="text-xs font-medium text-gray-600 dark:text-gray-400">Difficulty</div>
                    <div class="text-sm font-semibold" :class="getDifficultyTextClass(difficultyLevel.name)">
                        {{ difficultyLevel.name }}
                    </div>
                </div>
            </div>

            <!-- Bloom Circle -->
            <div v-if="bloomLevel" class="flex flex-col items-center space-y-2">
                <div class="relative w-16 h-16">
                    <svg class="w-16 h-16 transform -rotate-90" viewBox="0 0 64 64">
                        <!-- Background circle -->
                        <circle 
                            cx="32" 
                            cy="32" 
                            r="28" 
                            stroke="currentColor" 
                            stroke-width="4"
                            fill="none"
                            class="text-gray-200 dark:text-gray-700"
                        />
                        <!-- Progress circle -->
                        <circle 
                            cx="32" 
                            cy="32" 
                            r="28" 
                            stroke="currentColor" 
                            stroke-width="4"
                            fill="none"
                            :stroke-dasharray="175.93"
                            :stroke-dashoffset="175.93 - (175.93 * getBloomPercentage(bloomLevel.level) / 100)"
                            :class="getBloomCircleClass(bloomLevel.level)"
                            class="transition-all duration-500"
                        />
                    </svg>
                    <div class="absolute inset-0 flex items-center justify-center">
                        <span class="text-sm font-bold text-gray-800 dark:text-gray-200">
                            {{ getBloomScore(bloomLevel.level) }}/6
                        </span>
                    </div>
                </div>
                <div class="text-center">
                    <div class="text-xs font-medium text-gray-600 dark:text-gray-400">Bloom's</div>
                    <div class="text-sm font-semibold" :class="getBloomTextClass(bloomLevel.level)">
                        {{ bloomLevel.level }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { computed } from 'vue';
import Badge from '@/Components/shadcn/ui/badge/Badge.vue';
import Progress from '@/Components/shadcn/ui/progress/Progress.vue';

    difficultyLevel: {
        type: Object,
        default: null
    },
    bloomLevel: {
        type: Object,
        default: null
    },
    showSteps: {
        type: Boolean,
        default: false
    },
    showCircular: {
        type: Boolean,
        default: false
    },
    showDescription: {
        type: Boolean,
        default: false
    }
});

// Bloom levels data
const bloomLevels = [
    { level: 'Remember', short: 'Rem', description: 'Recall facts and basic concepts' },
    { level: 'Understand', short: 'Und', description: 'Explain ideas or concepts' },
    { level: 'Apply', short: 'App', description: 'Use information in new situations' },
    { level: 'Analyze', short: 'Ana', description: 'Draw connections among ideas' },
    { level: 'Evaluate', short: 'Eva', description: 'Justify a stand or decision' },
    { level: 'Create', short: 'Cre', description: 'Produce new or original work' }
];

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

const getDifficultyProgressClass = (difficulty) => {
    switch (difficulty?.toLowerCase()) {
        case 'very easy': return 'text-green-600';
        case 'easy': return 'text-green-500';
        case 'medium': return 'text-yellow-500';
        case 'hard': return 'text-red-500';
        case 'very hard': return 'text-red-600';
        default: return 'text-gray-500';
    }
};

const getDifficultyStepActiveClass = (difficulty) => {
    switch (difficulty?.toLowerCase()) {
        case 'very easy': return 'border-green-600 bg-green-600 text-white';
        case 'easy': return 'border-green-500 bg-green-500 text-white';
        case 'medium': return 'border-yellow-500 bg-yellow-500 text-white';
        case 'hard': return 'border-red-500 bg-red-500 text-white';
        case 'very hard': return 'border-red-600 bg-red-600 text-white';
        default: return 'border-gray-500 bg-gray-500 text-white';
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

const getDifficultyTextClass = (difficulty) => {
    switch (difficulty?.toLowerCase()) {
        case 'very easy': return 'text-green-700 dark:text-green-400';
        case 'easy': return 'text-green-600 dark:text-green-400';
        case 'medium': return 'text-yellow-600 dark:text-yellow-400';
        case 'hard': return 'text-red-600 dark:text-red-400';
        case 'very hard': return 'text-red-700 dark:text-red-400';
        default: return 'text-gray-600 dark:text-gray-400';
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

const getBloomProgressClass = (bloomLevel) => {
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

const getBloomStepActiveClass = (bloomLevel) => {
    switch (bloomLevel?.toLowerCase()) {
        case 'remember': return 'bg-gray-500 text-white';
        case 'understand': return 'bg-blue-500 text-white';
        case 'apply': return 'bg-yellow-500 text-white';
        case 'analyze': return 'bg-purple-500 text-white';
        case 'evaluate': return 'bg-red-500 text-white';
        case 'create': return 'bg-green-500 text-white';
        default: return 'bg-gray-500 text-white';
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

const getBloomTextClass = (bloomLevel) => {
    switch (bloomLevel?.toLowerCase()) {
        case 'remember': return 'text-gray-600 dark:text-gray-400';
        case 'understand': return 'text-blue-600 dark:text-blue-400';
        case 'apply': return 'text-yellow-600 dark:text-yellow-400';
        case 'analyze': return 'text-purple-600 dark:text-purple-400';
        case 'evaluate': return 'text-red-600 dark:text-red-400';
        case 'create': return 'text-green-600 dark:text-green-400';
        default: return 'text-gray-600 dark:text-gray-400';
    }
};

const getBloomDescription = (bloomLevel) => {
    const level = bloomLevels.find(l => l.level === bloomLevel);
    return level ? level.description : '';
};
</script>