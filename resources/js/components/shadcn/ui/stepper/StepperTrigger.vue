<script setup lang="ts">
import { cn } from '@/lib/utils';
import { StepperTrigger, useForwardProps } from 'radix-vue';

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
  <StepperTrigger
    v-bind="forwarded"
    :class="
      cn(
        'p-2 flex flex-col items-center text-center gap-2 rounded-md',
        props.class,
      )
    "
  >
    <slot />
  </StepperTrigger>
</template>
