<script setup lang="ts">
import {
  FormControl,
  FormDescription,
  FormField,
  FormItem,
  FormMessage,
} from '@/components/shadcn/ui/form';
import { Input } from '@/components/shadcn/ui/input';
import AutoFormLabel from './AutoFormLabel.vue';
import { beautifyObjectName } from './utils';

defineOptions({
  inheritAttrs: false,
});

defineProps({
  fieldName: { type: String, required: true },
  label: { type: String, required: false },
  required: { type: Boolean, required: false },
  config: { type: Object, required: false },
  disabled: { type: Boolean, required: false },
});
</script>

<template>
  <FormField v-slot="slotProps" :name="fieldName">
    <FormItem>
      <AutoFormLabel v-if="!config?.hideLabel" :required="required">
        {{ config?.label || beautifyObjectName(label ?? fieldName) }}
      </AutoFormLabel>
      <FormControl>
        <slot v-bind="slotProps">
          <Input
            type="number"
            v-bind="{ ...slotProps.componentField, ...config?.inputProps }"
            :disabled="disabled"
          />
        </slot>
      </FormControl>
      <FormDescription v-if="config?.description">
        {{ config.description }}
      </FormDescription>
      <FormMessage />
    </FormItem>
  </FormField>
</template>
