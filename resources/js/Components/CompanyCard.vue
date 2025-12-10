<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    company: {
        type: Object,
        required: true,
    },
});
</script>

<template>
    <Link
        :href="route('company.show', company.id)"
        class="bg-white border border-gray-200 rounded-lg shadow hover:shadow-lg transition duration-200 overflow-hidden"
    >
        <div class="p-6">
            <div class="flex items-center space-x-4 mb-4">
                <img
                    v-if="company.logo"
                    :src="company.logo"
                    :alt="`${company.name} logo`"
                    class="w-12 h-12 object-contain"
                />
                <div>
                    <h3 class="text-xl font-bold text-gray-900">
                        {{ company.name }}
                    </h3>
                    <p v-if="company.industry" class="text-sm text-gray-600">
                        {{ company.industry }}
                    </p>
                </div>
            </div>

            <p class="text-gray-700 text-sm line-clamp-3 mb-4">
                {{ company.description }}
            </p>

            <div class="flex items-center text-sm text-gray-500">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                </svg>
                {{ company.location }}
            </div>
        </div>
    </Link>
</template>

<style scoped>
.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
