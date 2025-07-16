<template>
    <div :class="containerClass">
        <div class="flex items-end space-x-0.5">
            <div 
                v-for="index in totalBars" 
                :key="`bar-${index}`"
                :class="[
                    'rounded-t transition-all duration-300',
                    getBarClasses(index)
                ]"
                :style="getBarStyle(index)"
            />
        </div>
    </div>
</template>

<script setup lang="ts">
const props = defineProps({
    totalBars: {
        type: Number,
        required: true
    },
    filledBars: {
        type: Number,
        required: true
    },
    containerClass: {
        type: String,
        default: ''
    },
    baseHeight: {
        type: Number,
        default: 12
    },
    heightIncrement: {
        type: Number,
        default: 6
    },
    activeColor: {
        type: String,
        default: 'bg-green-500'
    },
    inactiveColor: {
        type: String,
        default: 'bg-gray-200 dark:bg-gray-700'
    },
    barWidth: {
        type: String,
        default: 'w-2'
    }
});

const getBarClasses = (index: number): string => {
    const isActive = index <= props.filledBars;
    return [
        props.barWidth,
        isActive ? props.activeColor : props.inactiveColor
    ].join(' ');
};

const getBarStyle = (index: number): { height: string } => {
    const height = props.baseHeight + ((index - 1) * props.heightIncrement);
    return { height: `${height}px` };
};
</script>