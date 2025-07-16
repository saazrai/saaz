<template>
    <div class="compact-level-indicator">
        <div class="level-bar" :style="{ width: levelWidth }">
            <span class="level-text">{{ level }}</span>
        </div>
    </div>
</template>

<script lang="ts">
export default {
    name: 'CompactLevelIndicator',
    props: {
        level: {
            type: Number,
            required: true,
            validator: (value) => value >= 1 && value <= 6
        }
    },
    computed: {
        levelWidth() {
            return `${(this.level / 6) * 100}%`;
        }
    }
};
</script>

<style scoped>
.compact-level-indicator {
    width: 100%;
    height: 24px;
    background-color: #e0e0e0;
    border-radius: 12px;
    overflow: hidden;
    position: relative;
}

.level-bar {
    height: 100%;
    background: linear-gradient(to right, #4caf50, #2196f3);
    transition: width 0.3s ease;
    display: flex;
    align-items: center;
    padding: 0 10px;
}

.level-text {
    color: white;
    font-weight: bold;
    font-size: 14px;
}
</style>
