<script setup lang="ts">
import { cn } from '@/lib/utils';
import { ComboboxRoot, useForwardPropsEmits } from 'radix-vue';
import { computed } from 'vue';

const props = defineProps({
  modelValue: { type: null, required: false, default: '' },
  defaultValue: { type: null, required: false },
  open: { type: Boolean, required: false, default: true },
  defaultOpen: { type: Boolean, required: false },
  searchTerm: { type: String, required: false },
  selectedValue: { type: null, required: false },
  multiple: { type: Boolean, required: false },
  disabled: { type: Boolean, required: false },
  name: { type: String, required: false },
  dir: { type: String, required: false },
  filterFunction: { type: Function, required: false },
  displayValue: { type: Function, required: false },
  resetSearchTermOnBlur: { type: Boolean, required: false },
  asChild: { type: Boolean, required: false },
  as: { type: null, required: false },
  class: { type: null, required: false },
});

const emits = defineEmits([
  'update:modelValue',
  'update:open',
  'update:searchTerm',
  'update:selectedValue',
]);

const delegatedProps = computed(() => {
  const { ...delegated } = props;

  return delegated;
});

const forwarded = useForwardPropsEmits(delegatedProps, emits);
</script>

<template>
  <ComboboxRoot
    v-bind="forwarded"
    :class="
      cn(
        'flex h-full w-full flex-col overflow-hidden rounded-md bg-popover text-popover-foreground',
        props.class,
      )
    "
  >
    <slot />
  </ComboboxRoot>
</template>
