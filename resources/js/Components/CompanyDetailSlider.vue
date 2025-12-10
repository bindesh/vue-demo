<script setup lang="ts">
import { ref } from 'vue';
import CompanyDetailHero from '@/Components/CompanyDetailHero.vue';
import CompanyPitch from '@/Components/CompanyPitch.vue';
import CompanyTabs from '@/Components/CompanyTabs.vue';
import CompanySocials from '@/Components/CompanySocials.vue';
import type { Company, TabType } from '@/types';

defineProps<{
    company: Company;
}>();

const activeTab = ref<TabType>('about');
</script>

<template>
    <div class="space-y-4 sm:space-y-6">
        <CompanyDetailHero :company="company" responsive />

        <CompanyPitch :company="company" />

        <div>
            <CompanyTabs :active-tab="activeTab" @update:activeTab="activeTab = $event" />

            <div class="bg-white border border-gray-300 rounded-2xl p-8 shadow-md mt-4">
                <div v-if="activeTab === 'about'" class="space-y-4">
                    <h3 class="text-gray-800 text-xl font-bold mb-3">About</h3>
                    <p class="text-gray-700 leading-relaxed">
                        {{ company.description || 'No description available.' }}
                    </p>
                </div>

                <div v-if="activeTab === 'offer'" class="space-y-4">
                    <h3 class="text-gray-800 text-xl font-bold mb-3">What We Offer</h3>
                    <p class="text-gray-700 leading-relaxed">
                        Information about products and services will be displayed here.
                    </p>
                </div>

                <div v-if="activeTab === 'works'" class="space-y-4">
                    <h3 class="text-gray-800 text-xl font-bold mb-3">What Works For Us</h3>
                    <p class="text-gray-700 leading-relaxed">
                        Success stories and proven strategies will be displayed here.
                    </p>
                </div>

                <div v-if="activeTab === 'challenges'" class="space-y-4">
                    <h3 class="text-gray-800 text-xl font-bold mb-3">Current Challenges</h3>
                    <p class="text-gray-700 leading-relaxed">
                        Challenges and areas for improvement will be displayed here.
                    </p>
                </div>

                <div v-if="activeTab === 'goals'" class="space-y-4">
                    <h3 class="text-gray-800 text-xl font-bold mb-3">Our Goals</h3>
                    <p class="text-gray-700 leading-relaxed">
                        Future goals and objectives will be displayed here.
                    </p>
                </div>
            </div>
        </div>

        <CompanySocials :company="company" />
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
