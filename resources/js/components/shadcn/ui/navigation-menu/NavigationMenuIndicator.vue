<script setup lang="ts">
import { cn } from '@/lib/utils';
import { NavigationMenuIndicator, useForwardProps } from 'radix-vue';
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

const forwardedProps = useForwardProps(delegatedProps);
</script>

<template>
  <NavigationMenuIndicator
    v-bind="forwardedProps"
    :class="
      cn(
        'top-full z-1 flex h-1.5 items-end justify-center overflow-hidden data-[state=visible]:animate-in data-[state=hidden]:animate-out data-[state=hidden]:fade-out data-[state=visible]:fade-in',
        props.class,
      )
    "
  >
    <div
      class="relative top-[60%] h-2 w-2 rotate-45 rounded-tl-sm bg-border shadow-md"
    />
  </NavigationMenuIndicator>
</template>
