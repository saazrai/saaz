<script setup lang="ts">
import Tooltip from '@/components/shadcn/ui/tooltip/Tooltip.vue'
import TooltipContent from '@/components/shadcn/ui/tooltip/TooltipContent.vue'
import TooltipTrigger from '@/components/shadcn/ui/tooltip/TooltipTrigger.vue'
import { computed } from 'vue'
import SidebarMenuButtonChild from './SidebarMenuButtonChild.vue'
import { useSidebar } from './utils'

defineOptions({
  inheritAttrs: false,
})

const props = defineProps({
  as: { type: String, default: 'button' },
  variant: { type: String, default: 'default' },
  size: { type: String, default: 'default' },
  tooltip: { type: [String, Object], default: undefined }
})

const { isMobile, state } = useSidebar()

const delegatedProps = computed(() => {
  const { ...delegated } = props
  return delegated
})
</script>

<template>
  <SidebarMenuButtonChild v-if="!tooltip" v-bind="{ ...delegatedProps, ...$attrs }">
    <slot />
  </SidebarMenuButtonChild>

  <Tooltip v-else>
    <TooltipTrigger as-child>
      <SidebarMenuButtonChild v-bind="{ ...delegatedProps, ...$attrs }">
        <slot />
      </SidebarMenuButtonChild>
    </TooltipTrigger>
    <TooltipContent
      side="right"
      align="center"
      :hidden="state !== 'collapsed' || isMobile"
    >
      <template v-if="typeof tooltip === 'string'">
        {{ tooltip }}
      </template>
      <component :is="tooltip" v-else />
    </TooltipContent>
  </Tooltip>
</template>
