<script setup lang="ts">
import { cn } from '@/lib/utils';
import { MoreHorizontal } from 'lucide-vue-next';
import { PaginationEllipsis } from 'radix-vue';
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
</script>

<template>
  <PaginationEllipsis
    v-bind="delegatedProps"
    :class="cn('w-9 h-9 flex items-center justify-center', props.class)"
  >
    <slot>
      <MoreHorizontal />
    </slot>
  </PaginationEllipsis>
</template>
