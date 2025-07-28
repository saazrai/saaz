<template>
  <Link :href="href" class="flex items-center px-3 py-2 rounded hover:bg-blue-50 transition-colors" :class="{ 'bg-blue-100 font-bold': isActive }">
    <span v-if="icon" :class="`mdi ${icon} text-xl mr-3`"></span>
    <span>{{ label }}</span>
  </Link>
</template>

<script setup>
import { Link, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
const props = defineProps({
  href: String,
  icon: String,
  label: String,
});
const page = usePage();
const isActive = computed(() => page.url.startsWith(props.href));
</script>
