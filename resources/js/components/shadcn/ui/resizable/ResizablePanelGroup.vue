<script setup lang="ts">
import { cn } from '@/lib/utils';
import { SplitterGroup, useForwardPropsEmits } from 'radix-vue';
import { computed } from 'vue';

const props = defineProps({
  id: { type: [String, null], required: false },
  autoSaveId: { type: [String, null], required: false },
  direction: { type: String, required: true },
  keyboardResizeBy: { type: [Number, null], required: false },
  storage: { type: Object, required: false },
  asChild: { type: Boolean, required: false },
  as: { type: null, required: false },
  class: { type: null, required: false },
});
const emits = defineEmits(['layout']);

const delegatedProps = computed(() => {
  const { ...delegated } = props;
  return delegated;
});

const forwarded = useForwardPropsEmits(delegatedProps, emits);
</script>

<template>
  <SplitterGroup
    v-bind="forwarded"
    :class="
      cn(
        'flex h-full w-full data-[panel-group-direction=vertical]:flex-col',
        props.class,
      )
    "
  >
    <slot />
  </SplitterGroup>
</template>
