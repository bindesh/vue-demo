<script setup lang="ts">
import { computed } from 'vue';
import type { Company } from '@/types';

const props = defineProps<{
    company: Company;
}>();

const companyImage = computed<string | null>(() => {
    if (props.company.images && Array.isArray(props.company.images) && props.company.images.length > 0) {
        return props.company.images[0];
    }
    return null;
});
</script>

<template>
    <div class="relative h-96 bg-gradient-to-br from-gray-900 to-black border-2 border-gray-300 rounded-3xl overflow-hidden shadow-xl">

        <div v-if="companyImage" class="absolute inset-0">
            <img
                :src="companyImage"
                :alt="`${company.name} image`"
                class="w-full h-full object-cover"
            />
            <div class="absolute inset-0 bg-black/40"></div>
        </div>

        <div class="absolute top-6 right-6 z-10">
            <div class="text-red-400 text-sm font-medium">
                Short Facts: [Company_{{ company.industry }}, #{{ company.employee_count }}]
            </div>
        </div>

        <div class="absolute bottom-6 left-6 z-10">
            <div v-if="company.logo" class="bg-white p-4 rounded-2xl shadow-lg">
                <img
                    :src="company.logo"
                    :alt="`${company.name} logo`"
                    class="w-20 h-20 object-contain"
                />
            </div>
        </div>

        <div class="absolute bottom-6 left-1/2 transform -translate-x-1/2 flex gap-2 z-10">
            <span v-if="company.industry" class="px-4 py-2 bg-gray-900/70 backdrop-blur text-white rounded-lg text-sm font-medium border border-gray-700">
                {{ company.industry }}
            </span>
            <span v-if="company.employee_count" class="px-4 py-2 bg-gray-900/70 backdrop-blur text-white rounded-lg text-sm font-medium border border-gray-700">
                {{ company.employee_count >= 10000 ? '10k+' : company.employee_count.toLocaleString() }} employees
            </span>
            <span class="px-4 py-2 bg-gray-900/70 backdrop-blur text-white rounded-lg text-sm font-medium border border-gray-700">
                50+ revenue
            </span>
            <span v-if="company.founded_year" class="px-4 py-2 bg-gray-900/70 backdrop-blur text-white rounded-lg text-sm font-medium border border-gray-700">
                Founded {{ company.founded_year }}
            </span>
        </div>
    </div>
</template>
