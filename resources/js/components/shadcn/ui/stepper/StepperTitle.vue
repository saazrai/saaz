<script setup lang="ts">
import { cn } from '@/lib/utils';
import { StepperTitle, useForwardProps } from 'radix-vue';

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
  <StepperTitle
    v-bind="forwarded"
    :class="cn('text-md font-semibold whitespace-nowrap', props.class)"
  >
    <slot />
  </StepperTitle>
</template>
