<script setup lang="ts">
import {
  Accordion,
  AccordionContent,
  AccordionItem,
  AccordionTrigger,
} from '@/components/shadcn/ui/accordion';
import { FormItem } from '@/components/shadcn/ui/form';
import { FieldContextKey, useField } from 'vee-validate';
import { computed, provide } from 'vue';
import AutoFormField from './AutoFormField.vue';
import AutoFormLabel from './AutoFormLabel.vue';
import {
  beautifyObjectName,
  getBaseSchema,
  getBaseType,
  getDefaultValueInZodStack,
} from './utils';

const props = defineProps({
  fieldName: { type: String, required: true },
  required: { type: Boolean, required: false },
  config: { type: null, required: false },
  schema: { type: Object, required: false },
  disabled: { type: Boolean, required: false },
});

const shapes = computed(() => {
  const val = {};

  if (!props.schema) return;
  const shape = getBaseSchema(props.schema)?.shape;
  if (!shape) return;
  Object.keys(shape).forEach((name) => {
    const item = shape[name];
    const baseItem = getBaseSchema(item);
    let options =
      baseItem && 'values' in baseItem._def ? baseItem._def.values : undefined;
    if (!Array.isArray(options) && typeof options === 'object')
      options = Object.values(options);

    val[name] = {
      type: getBaseType(item),
      default: getDefaultValueInZodStack(item),
      options,
      required: !['ZodOptional', 'ZodNullable'].includes(item._def.typeName),
      schema: item,
    };
  });
  return val;
});

const fieldContext = useField(props.fieldName);
provide(FieldContextKey, fieldContext);
</script>

<template>
  <section>
    <slot v-bind="props">
      <Accordion
        type="single"
        as-child
        class="w-full"
        collapsible
        :disabled="disabled"
      >
        <FormItem>
          <AccordionItem :value="fieldName" class="border-none">
            <AccordionTrigger>
              <AutoFormLabel class="text-base" :required="required">
                {{ schema?.description || beautifyObjectName(fieldName) }}
              </AutoFormLabel>
            </AccordionTrigger>
            <AccordionContent class="p-1 space-y-5">
              <template v-for="(shape, key) in shapes" :key="key">
                <AutoFormField
                  :config="config?.[key]"
                  :field-name="`${fieldName}.${key.toString()}`"
                  :label="key.toString()"
                  :shape="shape"
                />
              </template>
            </AccordionContent>
          </AccordionItem>
        </FormItem>
      </Accordion>
    </slot>
  </section>
</template>
