<script setup lang="ts">
import { DialogClose } from 'radix-vue';

const props = defineProps();
</script>

<template>
  <DialogClose v-bind="props">
    <slot />
  </DialogClose>
</template>
