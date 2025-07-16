<template>
    <div class="space-y-8 p-6">
        <div class="text-center">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">
                Level Indicators Component Examples
            </h2>
            <p class="text-gray-600 dark:text-gray-400">
                Reusable components for displaying difficulty and Bloom's taxonomy levels
            </p>
        </div>

        <!-- Example Data -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Full Level Visualization -->
            <Card>
                <CardHeader>
                    <CardTitle>Full Level Visualization</CardTitle>
                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        Complete view with progress bars and steps
                    </p>
                </CardHeader>
                <CardContent>
                    <LevelVisualization 
                        :difficulty-level="exampleDifficulty"
                        :bloom-level="exampleBloom"
                        :show-steps="true"
                        :show-description="true"
                    />
                </CardContent>
            </Card>

            <!-- Circular Indicators -->
            <Card>
                <CardHeader>
                    <CardTitle>Circular Level Indicators</CardTitle>
                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        Perfect for dashboards and overview pages
                    </p>
                </CardHeader>
                <CardContent>
                    <CircularLevelIndicator 
                        :difficulty-level="exampleDifficulty"
                        :bloom-level="exampleBloom"
                        :show-summary="true"
                    />
                </CardContent>
            </Card>

            <!-- Bar Chart Indicators -->
            <Card>
                <CardHeader>
                    <CardTitle>Bar Chart Level Indicators</CardTitle>
                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        Visual bar charts with increasing heights and text labels
                    </p>
                </CardHeader>
                <CardContent>
                    <BarChartLevelIndicator 
                        :difficulty-level="exampleDifficulty"
                        :bloom-level="exampleBloom"
                    />
                </CardContent>
            </Card>

            <!-- Compact Indicators -->
            <Card>
                <CardHeader>
                    <CardTitle>Compact Level Indicators</CardTitle>
                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        Space-efficient design for cards and lists
                    </p>
                </CardHeader>
                <CardContent>
                    <div class="space-y-4">
                        <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-4">
                            <div class="flex items-center justify-between mb-2">
                                <h4 class="font-medium text-gray-900 dark:text-white">
                                    Sample Question: Network Security Fundamentals
                                </h4>
                            </div>
                            <CompactLevelIndicator 
                                :difficulty-level="exampleDifficulty"
                                :bloom-level="exampleBloom"
                            />
                        </div>
                        
                        <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-4">
                            <div class="flex items-center justify-between mb-2">
                                <h4 class="font-medium text-gray-900 dark:text-white">
                                    Sample Question: Advanced Cryptography Analysis
                                </h4>
                            </div>
                            <CompactLevelIndicator 
                                :difficulty-level="hardDifficulty"
                                :bloom-level="advancedBloom"
                            />
                        </div>
                    </div>
                </CardContent>
            </Card>

            <!-- Different Variations -->
            <Card class="lg:col-span-2">
                <CardHeader>
                    <CardTitle>Different Level Combinations</CardTitle>
                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        Examples showing various difficulty and Bloom level combinations
                    </p>
                </CardHeader>
                <CardContent>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Easy Remember -->
                        <div class="text-center p-4 border border-gray-200 dark:border-gray-700 rounded-lg">
                            <h5 class="font-medium mb-3 text-gray-900 dark:text-white">Beginner Level</h5>
                            <CircularLevelIndicator 
                                :difficulty-level="{ name: 'Easy', difficulty_score: 2 }"
                                :bloom-level="{ level: 'Remember' }"
                            />
                        </div>

                        <!-- Medium Apply -->
                        <div class="text-center p-4 border border-gray-200 dark:border-gray-700 rounded-lg">
                            <h5 class="font-medium mb-3 text-gray-900 dark:text-white">Intermediate Level</h5>
                            <CircularLevelIndicator 
                                :difficulty-level="{ name: 'Medium', difficulty_score: 3 }"
                                :bloom-level="{ level: 'Apply' }"
                            />
                        </div>

                        <!-- Very Hard Create -->
                        <div class="text-center p-4 border border-gray-200 dark:border-gray-700 rounded-lg">
                            <h5 class="font-medium mb-3 text-gray-900 dark:text-white">Expert Level</h5>
                            <CircularLevelIndicator 
                                :difficulty-level="{ name: 'Very Hard', difficulty_score: 5 }"
                                :bloom-level="{ level: 'Create' }"
                            />
                        </div>
                    </div>
                </CardContent>
            </Card>
        </div>

        <!-- Usage Instructions -->
        <Card>
            <CardHeader>
                <CardTitle>Component Usage</CardTitle>
            </CardHeader>
            <CardContent>
                <div class="space-y-4 text-sm">
                    <div>
                        <h4 class="font-semibold text-gray-900 dark:text-white mb-2">LevelVisualization</h4>
                        <code class="block bg-gray-100 dark:bg-gray-800 p-3 rounded text-xs">
&lt;LevelVisualization 
    :difficulty-level="question.difficulty"
    :bloom-level="question.bloom"
    :show-steps="true"
    :show-description="true"
/&gt;
                        </code>
                    </div>
                    
                    <div>
                        <h4 class="font-semibold text-gray-900 dark:text-white mb-2">CircularLevelIndicator</h4>
                        <code class="block bg-gray-100 dark:bg-gray-800 p-3 rounded text-xs">
&lt;CircularLevelIndicator 
    :difficulty-level="question.difficulty"
    :bloom-level="question.bloom"
    :show-summary="true"
/&gt;
                        </code>
                    </div>
                    
                    <div>
                        <h4 class="font-semibold text-gray-900 dark:text-white mb-2">BarChartLevelIndicator</h4>
                        <code class="block bg-gray-100 dark:bg-gray-800 p-3 rounded text-xs">
&lt;BarChartLevelIndicator 
    :difficulty-level="question.difficulty"
    :bloom-level="question.bloom"
/&gt;
                        </code>
                    </div>
                    
                    <div>
                        <h4 class="font-semibold text-gray-900 dark:text-white mb-2">CompactLevelIndicator</h4>
                        <code class="block bg-gray-100 dark:bg-gray-800 p-3 rounded text-xs">
&lt;CompactLevelIndicator 
    :difficulty-level="question.difficulty"
    :bloom-level="question.bloom"
/&gt;
                        </code>
                    </div>
                </div>
            </CardContent>
        </Card>
    </div>
</template>

<script setup lang="ts">
import { Card, CardContent, CardHeader, CardTitle } from '@/Components/shadcn/ui/card';
import LevelVisualization from './LevelVisualization.vue';
import CircularLevelIndicator from './CircularLevelIndicator.vue';
import CompactLevelIndicator from './CompactLevelIndicator.vue';
import BarChartLevelIndicator from './BarChartLevelIndicator.vue';

// Example data
const exampleDifficulty = {
    name: 'Medium',
    difficulty_score: 3,
    description: 'These questions require a good understanding of the subject matter and the ability to apply knowledge to typical scenarios.'
};

const exampleBloom = {
    level: 'Apply',
    description: 'Use information in new situations'
};

const hardDifficulty = {
    name: 'Very Hard',
    difficulty_score: 5,
    description: 'These questions are very challenging and require advanced knowledge and experience.'
};

const advancedBloom = {
    level: 'Evaluate',
    description: 'Justify a stand or decision'
};
</script>