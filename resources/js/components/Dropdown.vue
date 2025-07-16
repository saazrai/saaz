<script setup lang="ts">
import { computed, onMounted, onUnmounted, ref, watch, nextTick } from 'vue';

const props = defineProps({
    align: {
        type: String,
        default: 'right',
    },
    width: {
        type: String,
        default: '48',
    },
    contentClasses: {
        type: String,
        default: 'py-1 bg-white',
    },
});

const closeOnEscape = (e) => {
    if (open.value && e.key === 'Escape') {
        open.value = false;
    }
};

onMounted(() => document.addEventListener('keydown', closeOnEscape));
onUnmounted(() => document.removeEventListener('keydown', closeOnEscape));

const alignmentClasses = computed(() => {
    if (props.align === 'left') {
        return 'ltr:origin-top-left rtl:origin-top-right start-0';
    } else if (props.align === 'right') {
        return 'ltr:origin-top-right rtl:origin-top-left end-0';
    } else {
        return 'origin-top';
    }
});

const open = ref(false);
const triggerEl = ref(null);
const dropdownEl = ref(null);

defineExpose({
    triggerEl,
    dropdownEl
});

// Set dropdown width to match trigger width when opened
const matchTriggerWidth = () => {
    if (open.value && triggerEl.value && dropdownEl.value) {
        const triggerWidth = triggerEl.value.offsetWidth;
        // Ensure minimum width for dropdown to prevent text wrapping
        const minWidth = 200; // Minimum width in pixels
        dropdownEl.value.style.width = `${Math.max(triggerWidth, minWidth)}px`;
    }
};

// Watch for when dropdown opens to adjust width
watch(open, (isOpen) => {
    if (isOpen) {
        nextTick(() => {
            matchTriggerWidth();
        });
    }
});
</script>

<template>
    <div class="relative">
        <div @click="open = !open" ref="triggerEl">
            <slot name="trigger" />
        </div>

        <!-- Full Screen Dropdown Overlay -->
        <div
            v-show="open"
            class="fixed inset-0 z-40"
            @click="open = false"
        ></div>

        <Transition
            enter-active-class="transition ease-out duration-200"
            enter-from-class="opacity-0 scale-95"
            enter-to-class="opacity-100 scale-100"
            leave-active-class="transition ease-in duration-75"
            leave-from-class="opacity-100 scale-100"
            leave-to-class="opacity-0 scale-95"
        >
            <div
                v-show="open"
                class="absolute z-50 mt-2 rounded-md shadow-lg"
                :class="[alignmentClasses]"
                style="display: none"
                @click="open = false"
                ref="dropdownEl"
            >
                <div
                    class="rounded-md ring-1 ring-black ring-opacity-5"
                    :class="contentClasses"
                >
                    <slot name="content" />
                </div>
            </div>
        </Transition>
    </div>
</template>
