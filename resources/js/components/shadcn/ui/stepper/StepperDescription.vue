<script setup lang="ts">
import { cn } from '@/lib/utils';
import { StepperDescription, useForwardProps } from 'radix-vue';

import { computed } from 'vue';

const props = defineProps({
  asChild: { type: Boolean, required: false },
  as: { type: null, required: false },
  class: { type: null, required: false },
});

const delegatedProps = computed(() => {
  const { ...delegated } = props;

  return delegated;
});

const forwarded = useForwardProps(delegatedProps);
</script>

<template>
  <StepperDescription
    v-slot="slotProps"
    v-bind="forwarded"
    :class="cn('text-xs text-muted-foreground', props.class)"
  >
    <slot v-bind="slotProps" />
  </StepperDescription>
</template>
