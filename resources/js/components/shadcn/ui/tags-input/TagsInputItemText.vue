<script setup lang="ts">
import { cn } from '@/lib/utils';
import { TagsInputItemText, useForwardProps } from 'radix-vue';
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

const forwardedProps = useForwardProps(delegatedProps);
</script>

<template>
  <TagsInputItemText
    v-bind="forwardedProps"
    :class="cn('py-1 px-2 text-sm rounded bg-transparent', props.class)"
  />
</template>
