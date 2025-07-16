<script setup lang="ts">
import { DialogClose } from 'radix-vue';

const props = defineProps<Record<string, any>>();
</script>

<template>
  <DialogClose v-bind="props">
    <slot />
  </DialogClose>
</template>
