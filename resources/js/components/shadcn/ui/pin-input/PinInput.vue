<script setup lang="ts">
import { cn } from '@/lib/utils';
import { PinInputRoot, useForwardPropsEmits } from 'radix-vue';
import { computed } from 'vue';

const props = defineProps({
  modelValue: { type: Array, required: false, default: () => [] },
  defaultValue: { type: Array, required: false },
  placeholder: { type: String, required: false },
  mask: { type: Boolean, required: false },
  otp: { type: Boolean, required: false },
  type: { type: String, required: false },
  dir: { type: String, required: false },
  name: { type: String, required: false },
  disabled: { type: Boolean, required: false },
  required: { type: Boolean, required: false },
  id: { type: String, required: false },
  asChild: { type: Boolean, required: false },
  as: { type: null, required: false },
  class: { type: null, required: false },
});
const emits = defineEmits(['update:modelValue', 'complete']);

const delegatedProps = computed(() => {
  const { ...delegated } = props;
  return delegated;
});

const forwarded = useForwardPropsEmits(delegatedProps, emits);
</script>

<template>
  <PinInputRoot
    v-bind="forwarded"
    :class="cn('flex gap-2 items-center', props.class)"
  >
    <slot />
  </PinInputRoot>
</template>
