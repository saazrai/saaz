<script setup lang="ts">
import { DropdownMenuTrigger, useForwardProps } from 'radix-vue';

const props = defineProps({
  disabled: { type: Boolean, required: false },
  asChild: { type: Boolean, required: false },
  as: { type: null, required: false },
});

const forwardedProps = useForwardProps(props);
</script>

<template>
  <DropdownMenuTrigger class="outline-hidden" v-bind="forwardedProps">
    <slot />
  </DropdownMenuTrigger>
</template>
