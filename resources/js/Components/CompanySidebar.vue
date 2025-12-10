<script setup lang="ts">
import CompanyDetailSlider from '@/Components/CompanyDetailSlider.vue';
import type { Company } from '@/types';

const props = withDefaults(defineProps<{
    company?: Company | null;
    isOpen?: boolean;
}>(), {
    company: null,
    isOpen: false,
});

const emit = defineEmits<{
    close: [];
}>();

const closeSidebar = (): void => {
    emit('close');
};
</script>

<template>

    <Transition name="fade">
        <div
            v-if="isOpen"
            class="fixed inset-0 bg-black bg-opacity-50 z-40 transition-opacity"
            @click="closeSidebar"
        ></div>
    </Transition>

    <Transition name="slide">
        <div
            v-if="isOpen && company"
            class="fixed top-0 right-0 h-full w-full sm:w-96 md:w-[32rem] bg-white shadow-2xl z-50 overflow-y-auto"
        >

            <div class="sticky top-0 bg-white border-b border-gray-200 px-6 py-4 flex items-center justify-between z-10">
                <h2 class="text-2xl font-bold text-gray-900">Company Details</h2>
                <button
                    @click="closeSidebar"
                    class="text-gray-400 hover:text-gray-900 transition-colors"
                    aria-label="Close sidebar"
                >
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <div class="px-4 sm:px-6 py-4">
                <CompanyDetailSlider :company="company" />
            </div>
        </div>
    </Transition>
</template>

<style scoped>

.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.3s ease;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}

.slide-enter-active,
.slide-leave-active {
    transition: transform 0.3s ease;
}

.slide-enter-from,
.slide-leave-to {
    transform: translateX(100%);
}
</style>
