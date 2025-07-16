<template>
    <div class="flex items-center space-x-4">
        <!-- Difficulty Indicator -->
        <div v-if="difficultyLevel" class="flex items-center space-x-2">
            <div class="flex items-center space-x-1">
                <BarChart3Icon class="w-4 h-4 text-gray-500" />
                <span class="text-xs font-medium text-gray-600 dark:text-gray-400">Difficulty:</span>
            </div>
            <div class="flex items-center space-x-1">
                <div 
                    v-for="level in 5" 
                    :key="'diff-' + level"
                    :class="[
                        'w-2 h-4 rounded-sm',
                        level <= (difficultyLevel.difficulty_score || getDifficultyScore(difficultyLevel.name))
                            ? getDifficultyBarClass(difficultyLevel.name)
                            : 'bg-gray-200 dark:bg-gray-700'
                    ]"
                />
            </div>
            <Badge 
                :variant="getDifficultyVariant(difficultyLevel.name)" 
                class="text-xs px-2 py-0.5"
            >
                {{ difficultyLevel.name }}
            </Badge>
        </div>

        <!-- Bloom Indicator -->
        <div v-if="bloomLevel" class="flex items-center space-x-2">
            <div class="flex items-center space-x-1">
                <GraduationCapIcon class="w-4 h-4 text-gray-500" />
                <span class="text-xs font-medium text-gray-600 dark:text-gray-400">Bloom's:</span>
            </div>
            <div class="flex items-center space-x-1">
                <div 
                    v-for="level in 6" 
                    :key="'bloom-' + level"
                    :class="[
                        'w-2 h-4 rounded-sm',
                        level <= getBloomScore(bloomLevel.level)
                            ? getBloomBarClass(bloomLevel.level)
                            : 'bg-gray-200 dark:bg-gray-700'
                    ]"
                />
            </div>
            <Badge 
                :variant="getBloomVariant(bloomLevel.level)" 
                class="text-xs px-2 py-0.5"
            >
                {{ bloomLevel.level }}
            </Badge>
        </div>
    </div>
</template>

<script setup>
import Badge from '@/Components/shadcn/ui/badge/Badge.vue';
import { BarChart3Icon, GraduationCapIcon } from 'lucide-vue-next';

    difficultyLevel: {
        type: Object,
        default: null
    },
    bloomLevel: {
        type: Object,
        default: null
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

const getDifficultyBarClass = (difficulty) => {
    switch (difficulty?.toLowerCase()) {
        case 'very easy': return 'bg-green-600';
        case 'easy': return 'bg-green-500';
        case 'medium': return 'bg-yellow-500';
        case 'hard': return 'bg-red-500';
        case 'very hard': return 'bg-red-600';
        default: return 'bg-gray-500';
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

const getBloomBarClass = (bloomLevel) => {
    switch (bloomLevel?.toLowerCase()) {
        case 'remember': return 'bg-gray-500';
        case 'understand': return 'bg-blue-500';
        case 'apply': return 'bg-yellow-500';
        case 'analyze': return 'bg-purple-500';
        case 'evaluate': return 'bg-red-500';
        case 'create': return 'bg-green-500';
        default: return 'bg-gray-500';
    }
};
</script>