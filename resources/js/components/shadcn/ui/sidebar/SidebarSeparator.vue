<script setup lang="ts">
import Separator from '@/components/shadcn/ui/separator/Separator.vue'
import { cn } from '@/lib/utils'

const props = defineProps({
  class: { type: null, required: false }
})
</script>

<template>
  <Separator
    data-sidebar="separator"
    :class="cn('mx-2 w-auto bg-sidebar-border', props.class)"
  >
    <slot />
  </Separator>
</template>
