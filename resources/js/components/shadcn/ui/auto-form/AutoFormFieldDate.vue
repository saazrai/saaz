<script setup lang="ts">
import { Button } from '@/components/shadcn/ui/button';
import { Calendar } from '@/components/shadcn/ui/calendar';
import {
  FormControl,
  FormDescription,
  FormField,
  FormItem,
  FormMessage,
} from '@/components/shadcn/ui/form';
import {
  Popover,
  PopoverContent,
  PopoverTrigger,
} from '@/components/shadcn/ui/popover';
import { cn } from '@/lib/utils';

import { DateFormatter, getLocalTimeZone } from '@internationalized/date';
import { CalendarIcon } from 'lucide-vue-next';
import AutoFormLabel from './AutoFormLabel.vue';
import { beautifyObjectName } from './utils';

defineProps({
  fieldName: { type: String, required: true },
  label: { type: String, required: false },
  required: { type: Boolean, required: false },
  config: { type: Object, required: false },
  disabled: { type: Boolean, required: false },
});

const df = new DateFormatter('en-US', {
  dateStyle: 'long',
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
          <div>
            <Popover>
              <PopoverTrigger as-child :disabled="disabled">
                <Button
                  variant="outline"
                  :class="
                    cn(
                      'w-full justify-start text-left font-normal',
                      !slotProps.componentField.modelValue &&
                        'text-muted-foreground',
                    )
                  "
                >
                  <CalendarIcon class="mr-2 h-4 w-4" :size="16" />
                  {{
                    slotProps.componentField.modelValue
                      ? df.format(
                          slotProps.componentField.modelValue.toDate(
                            getLocalTimeZone(),
                          ),
                        )
                      : "Pick a date"
                  }}
                </Button>
              </PopoverTrigger>
              <PopoverContent class="w-auto p-0">
                <Calendar initial-focus v-bind="slotProps.componentField" />
              </PopoverContent>
            </Popover>
          </div>
        </slot>
      </FormControl>

      <FormDescription v-if="config?.description">
        {{ config.description }}
      </FormDescription>
      <FormMessage />
    </FormItem>
  </FormField>
</template>
