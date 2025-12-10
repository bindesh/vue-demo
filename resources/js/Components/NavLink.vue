<script setup lang="ts">
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = withDefaults(defineProps<{
    href: string;
    active?: boolean;
    icon?: string;
}>(), {
    active: false,
    icon: '',
});

const classes = computed<string>(() =>
    props.active
        ? 'flex items-center px-4 py-3 text-sm font-medium text-white bg-indigo-600 rounded-lg transition duration-150 ease-in-out'
        : 'flex items-center px-4 py-3 text-sm font-medium text-gray-700 hover:bg-gray-100 hover:text-indigo-600 rounded-lg transition duration-150 ease-in-out',
);
</script>

<template>
    <Link :href="href" :class="classes">
        <span v-if="icon" v-html="icon" class="w-5 h-5 mr-3"></span>
        <slot />
    </Link>
</template>
