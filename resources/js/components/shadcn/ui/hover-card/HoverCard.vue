<script setup lang="ts">
import { HoverCardRoot, useForwardPropsEmits } from 'radix-vue';

const props = defineProps({
  defaultOpen: { type: Boolean, required: false },
  open: { type: Boolean, required: false },
  openDelay: { type: Number, required: false },
  closeDelay: { type: Number, required: false },
});
const emits = defineEmits(['update:open']);

const forwarded = useForwardPropsEmits(props, emits);
</script>

<template>
  <HoverCardRoot v-bind="forwarded">
    <slot />
  </HoverCardRoot>
</template>
