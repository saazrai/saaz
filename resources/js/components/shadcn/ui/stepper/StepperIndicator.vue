<script setup lang="ts">
import { cn } from '@/lib/utils';
import { StepperIndicator, useForwardProps } from 'radix-vue';

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
  <StepperIndicator
    v-bind="forwarded"
    :class="
      cn(
        'inline-flex items-center justify-center rounded-full text-muted-foreground/50 w-10 h-10',
        // Disabled
        'group-data-disabled:text-muted-foreground group-data-disabled:opacity-50',
        // Active
        'group-data-[state=active]:bg-primary group-data-[state=active]:text-primary-foreground',
        // Completed
        'group-data-[state=completed]:bg-accent group-data-[state=completed]:text-accent-foreground',
        props.class,
      )
    "
  >
    <slot />
  </StepperIndicator>
</template>
