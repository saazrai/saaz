<script setup lang="ts">
import { cn } from '@/lib/utils';
import { DrawerOverlay } from 'vaul-vue';
import { computed } from 'vue';

const props = defineProps({
  forceMount: { type: Boolean, required: false },
  asChild: { type: Boolean, required: false },
  as: { type: null, required: false },
  class: { type: null, required: false },
});

const delegatedProps = computed(() => {
  const { ...delegated } = props;

  return delegated;
});
</script>

<template>
  <DrawerOverlay
    v-bind="delegatedProps"
    :class="cn('fixed inset-0 z-50 bg-black/80', props.class)"
  />
</template>
