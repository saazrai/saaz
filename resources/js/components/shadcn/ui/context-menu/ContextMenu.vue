<script setup lang="ts">
import { ContextMenuRoot, useForwardPropsEmits } from 'radix-vue';

const props = defineProps({
  dir: { type: String, required: false },
  modal: { type: Boolean, required: false },
});
const emits = defineEmits(['update:open']);

const forwarded = useForwardPropsEmits(props, emits);
</script>

<template>
  <ContextMenuRoot v-bind="forwarded">
    <slot />
  </ContextMenuRoot>
</template>
