<script setup lang="ts">
import { cn } from '@/lib/utils';

const props = defineProps({
  class: { type: null, required: false },
});
</script>

<template>
  <div
    :class="
      cn(
        'rounded-lg border bg-card text-card-foreground shadow-xs',
        props.class,
      )
    "
  >
    <slot />
  </div>
</template>
