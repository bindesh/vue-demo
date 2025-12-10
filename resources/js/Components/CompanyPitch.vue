<script setup>
import { ref } from 'vue';

defineProps({
    company: {
        type: Object,
        required: true,
    },
});

const showExtendedPitch = ref(false);
</script>

<template>
    <div class="space-y-4">

        <div class="flex items-start gap-2">
            <span class="text-xl">🚀</span>
            <p class="text-gray-800 text-base leading-relaxed">
                <span class="font-semibold">{{ company.name }}:</span>
                {{ company.description ? company.description.split('.')[0] + '.' : 'Boost your revenue with superior B2B leads and intelligent AI sales automation.' }}
            </p>
        </div>

        <div class="space-y-4">
            <div class="flex items-center gap-2 cursor-pointer" @click="showExtendedPitch = !showExtendedPitch">
                <h3 class="text-gray-800 text-base font-semibold">Extended Pitch</h3>
                <button class="text-gray-600 hover:text-gray-800 transition-colors">
                    <svg 
                        class="w-5 h-5 transition-transform duration-200" 
                        :class="{ 'rotate-180': showExtendedPitch }"
                        fill="none" 
                        stroke="currentColor" 
                        viewBox="0 0 24 24"
                    >
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
            </div>
            
            <transition name="fade">
                <div v-if="showExtendedPitch" class="bg-white border border-gray-300 rounded-2xl p-6 shadow-md">
                    <p class="text-gray-700 leading-relaxed">
                        {{ company.description || 'We build awesome software that helps businesses scale and succeed in the digital age.' }}
                    </p>
                </div>
            </transition>
        </div>
    </div>
</template>

<style scoped>
.fade-enter-active, .fade-leave-active {
    transition: all 0.3s ease;
}
.fade-enter-from {
    opacity: 0;
    transform: translateY(-10px);
}
.fade-leave-to {
    opacity: 0;
    transform: translateY(-10px);
}
</style>
