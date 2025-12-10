<script setup lang="ts">
import { computed } from 'vue';
import type { Company } from '@/types';

const props = defineProps<{
    company: Company;
    responsive?: boolean;
}>();

const companyImage = computed<string | null>(() => {
    if (props.company.images && Array.isArray(props.company.images) && props.company.images.length > 0) {
        return props.company.images[0];
    }
    return null;
});
</script>

<template>
    <div class="space-y-6">
        <!-- Hero Section with Single Image -->
        <div 
            :class="[
                'relative bg-red-200 rounded-3xl overflow-visible',
                responsive ? 'min-h-[280px]' : 'min-h-[400px]'
            ]"
        >
            <!-- Background Image -->
            <div v-if="companyImage" class="absolute inset-0 rounded-3xl overflow-hidden">
                <img
                    :src="companyImage"
                    :alt="`${company.name} image`"
                    class="w-full h-full object-cover"
                />
            </div>

            <!-- Logo - Half in hero, half out (fully visible) - Only for non-responsive -->
            <div v-if="!responsive" class="absolute -bottom-12 left-6 z-20">
                <div class="bg-white rounded-full shadow-xl p-4">
                    <div v-if="company.logo" class="w-24 h-24 flex items-center justify-center">
                        <img
                            :src="company.logo"
                            :alt="`${company.name} logo`"
                            class="max-w-full max-h-full object-contain"
                        />
                    </div>
                    <div v-else class="w-24 h-24 flex items-center justify-center bg-gray-200 rounded">
                        <span class="text-gray-400 text-xs text-center">Logo</span>
                    </div>
                </div>
            </div>

            <!-- Logo - Responsive version (half in/out like full page) -->
            <div v-if="responsive" class="absolute -bottom-6 left-3 z-20">
                <div class="bg-white rounded-full shadow-lg p-2">
                    <div v-if="company.logo" class="w-14 h-14 flex items-center justify-center">
                        <img
                            :src="company.logo"
                            :alt="`${company.name} logo`"
                            class="max-w-full max-h-full object-contain"
                        />
                    </div>
                    <div v-else class="w-14 h-14 flex items-center justify-center bg-gray-200 rounded">
                        <span class="text-gray-400 text-xs text-center">Logo</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Badges - Below Hero Section -->
        <div class="flex flex-wrap gap-2 justify-center -mt-6 relative z-30">
            <div v-if="company.industry" class="bg-gray-800 text-white px-3 py-1 sm:px-4 sm:py-2 rounded-lg text-xs sm:text-sm font-semibold">
                {{ company.industry }}
            </div>
            <div v-if="company.employee_count" class="bg-gray-800 text-white px-3 py-1 sm:px-4 sm:py-2 rounded-lg text-xs sm:text-sm font-semibold">
                {{ company.employee_count >= 10000 ? '10k+' : company.employee_count.toLocaleString() }} employees
            </div>
            <div class="bg-gray-800 text-white px-3 py-1 sm:px-4 sm:py-2 rounded-lg text-xs sm:text-sm font-semibold">
                50+ revenue
            </div>
            <div v-if="company.founded_year" class="bg-gray-800 text-white px-3 py-1 sm:px-4 sm:py-2 rounded-lg text-xs sm:text-sm font-semibold">
                Founded {{ company.founded_year }}
            </div>
        </div>
    </div>
</template>
