<script setup>
import { ref, computed } from 'vue';

const props = defineProps({
    company: {
        type: Object,
        required: true,
    },
    responsive: {
        type: Boolean,
        default: false,
    },
});

const currentImageIndex = ref(0);

const companyImages = computed(() => {
    if (props.company.images && Array.isArray(props.company.images)) {
        return props.company.images;
    }
    return [];
});

const nextImage = () => {
    if (companyImages.value.length > 0) {
        currentImageIndex.value = (currentImageIndex.value + 1) % companyImages.value.length;
    }
};

const prevImage = () => {
    if (companyImages.value.length > 0) {
        currentImageIndex.value = currentImageIndex.value === 0 
            ? companyImages.value.length - 1 
            : currentImageIndex.value - 1;
    }
};

const goToImage = (index) => {
    currentImageIndex.value = index;
};
</script>

<template>
    <div class="space-y-6">
        <!-- Hero Section with Image Slider -->
        <div 
            :class="[
                'relative bg-red-200 rounded-3xl overflow-visible',
                responsive ? 'min-h-[280px]' : 'min-h-[400px]'
            ]"
        >
            <!-- Background Image -->
            <div v-if="companyImages.length > 0" class="absolute inset-0 rounded-3xl overflow-hidden">
                <img
                    :src="companyImages[currentImageIndex]"
                    :alt="`${company.name} image ${currentImageIndex + 1}`"
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

            <!-- Navigation Arrows -->
            <button 
                v-if="companyImages.length > 1"
                @click="prevImage"
                class="absolute left-2 top-1/2 transform -translate-y-1/2 bg-white hover:bg-gray-100 text-gray-800 rounded-full p-2 shadow-lg transition-all z-20"
                :class="responsive ? 'p-2' : 'sm:left-8 p-3'"
            >
                <svg class="w-4 h-4 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>
            <button 
                v-if="companyImages.length > 1"
                @click="nextImage"
                class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-white hover:bg-gray-100 text-gray-800 rounded-full p-2 shadow-lg transition-all z-20"
                :class="responsive ? 'p-2' : 'sm:right-8 p-3'"
            >
                <svg class="w-4 h-4 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>

            <!-- Image Indicators -->
            <div v-if="companyImages.length > 1" class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex gap-2 z-10">
                <button 
                    v-for="(image, index) in companyImages" 
                    :key="index"
                    @click="goToImage(index)"
                    :class="[
                        'h-1 sm:h-2 rounded-full transition-all',
                        currentImageIndex === index ? 'bg-gray-800 w-6 sm:w-8' : 'bg-gray-400 hover:bg-gray-600 w-1 sm:w-2'
                    ]"
                ></button>
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
