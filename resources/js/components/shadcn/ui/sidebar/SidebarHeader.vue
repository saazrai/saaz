<script setup lang="ts">
import { cn } from '@/lib/utils'

const props = defineProps({
  class: { type: null, required: false }
})
</script>

<template>
  <div
    data-sidebar="header"
    :class="cn('flex flex-col gap-2 p-2', props.class)"
  >
    <slot />
  </div>
</template>
