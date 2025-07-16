<template>
    <div class="level-visualization">
        <div class="level-display">
            <h3>{{ title }}</h3>
            <div class="level-number">{{ level }}</div>
            <p class="level-description">{{ description }}</p>
        </div>
    </div>
</template>

<script lang="ts">
export default {
    name: 'LevelVisualization',
    props: {
        level: {
            type: Number,
            required: true
        },
        title: {
            type: String,
            default: 'Current Level'
        },
        description: {
            type: String,
            default: ''
        }
    }
};
</script>

<style scoped>
.level-visualization {
    text-align: center;
    padding: 20px;
    border: 2px solid #e0e0e0;
    border-radius: 10px;
    background-color: #f5f5f5;
}

.level-display h3 {
    margin: 0 0 10px 0;
    color: #333;
}

.level-number {
    font-size: 48px;
    font-weight: bold;
    color: #2196f3;
    margin: 10px 0;
}

.level-description {
    color: #666;
    margin: 10px 0 0 0;
}
</style>
