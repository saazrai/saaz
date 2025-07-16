<script setup lang="ts">
import { toggleVariants } from '@/components/shadcn/ui/toggle';
import { cn } from '@/lib/utils';
import { ToggleGroupItem, useForwardProps } from 'radix-vue';
import { computed } from 'vue';

const props = defineProps<{
  value: string;
  defaultValue?: boolean;
  pressed?: boolean;
  disabled?: boolean;
  asChild?: boolean;
  as?: any;
  class?: any;
  variant?: 'default' | 'outline' | null | undefined;
  size?: 'default' | 'sm' | 'lg' | null | undefined;
}>();

const delegatedProps = computed(() => ({ ...props }));

const forwardedProps = useForwardProps(delegatedProps);
</script>

<template>
  <ToggleGroupItem
    v-bind="forwardedProps"
    :class="
      cn(
        toggleVariants({
          variant: props.variant,
          size: props.size,
        }),
        props.class,
      )
    "
  >
    <slot />
  </ToggleGroupItem>
</template>
