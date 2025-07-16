<script setup lang="ts">
import { FormLabel } from '@/components/shadcn/ui/form';

defineProps({
  required: { type: Boolean, required: false },
});
</script>

<template>
  <FormLabel>
    <slot />
    <span v-if="required" class="text-destructive"> *</span>
  </FormLabel>
</template>
