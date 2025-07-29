<script setup lang="ts">
import { DialogClose } from 'radix-vue';

interface Props {
  [key: string]: any;
}

const props = defineProps<Props>();
</script>

<template>
  <DialogClose v-bind="props">
    <slot />
  </DialogClose>
</template>
