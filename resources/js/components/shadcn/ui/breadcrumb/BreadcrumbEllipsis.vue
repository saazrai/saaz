<script setup lang="ts">
import { cn } from '@/lib/utils';
import { MoreHorizontal } from 'lucide-vue-next';

const props = defineProps({
  class: { type: null, required: false },
});
</script>

<template>
  <span
    role="presentation"
    aria-hidden="true"
    :class="cn('flex h-9 w-9 items-center justify-center', props.class)"
  >
    <slot>
      <MoreHorizontal class="h-4 w-4" />
    </slot>
    <span class="sr-only">More</span>
  </span>
</template>
