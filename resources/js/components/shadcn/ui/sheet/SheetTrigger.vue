<script setup lang="ts">
import { DialogTrigger } from 'radix-vue';

interface Props {
  [key: string]: any;
}

const props = defineProps<Props>();
</script>

<template>
  <DialogTrigger v-bind="props">
    <slot />
  </DialogTrigger>
</template>
