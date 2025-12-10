<script setup>
import { ref, computed } from 'vue';

const props = defineProps({
    company: {
        type: Object,
        required: true,
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
    <div class="relative h-96 bg-gradient-to-br from-gray-900 to-black border-2 border-gray-300 rounded-3xl overflow-hidden shadow-xl">

        <div v-if="companyImages.length > 0" class="absolute inset-0">
            <img
                :src="companyImages[currentImageIndex]"
                :alt="`${company.name} image ${currentImageIndex + 1}`"
                class="w-full h-full object-cover"
            />
            <div class="absolute inset-0 bg-black/40"></div>
        </div>

        <button 
            v-if="companyImages.length > 1"
            @click="prevImage"
            class="absolute left-6 top-1/2 transform -translate-y-1/2 bg-white/20 hover:bg-white/30 text-white rounded-full p-3 backdrop-blur-sm transition-all z-10"
        >
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
        </button>
        <button 
            v-if="companyImages.length > 1"
            @click="nextImage"
            class="absolute right-6 top-1/2 transform -translate-y-1/2 bg-white/20 hover:bg-white/30 text-white rounded-full p-3 backdrop-blur-sm transition-all z-10"
        >
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
        </button>

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

        <div v-if="companyImages.length > 1" class="absolute bottom-20 left-1/2 transform -translate-x-1/2 flex gap-2 z-10">
            <button 
                v-for="(image, index) in companyImages" 
                :key="index"
                @click="goToImage(index)"
                :class="[
                    'h-2 rounded-full transition-all',
                    currentImageIndex === index ? 'bg-white w-8' : 'bg-white/50 hover:bg-white/75 w-2'
                ]"
            ></button>
        </div>
    </div>
</template>
