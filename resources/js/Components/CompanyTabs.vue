<script setup lang="ts">
import type { TabType } from '@/types';

const props = withDefaults(defineProps<{
    activeTab?: TabType;
}>(), {
    activeTab: 'about',
});

const emit = defineEmits<{
    'update:activeTab': [value: TabType];
}>();

const setActiveTab = (tab: TabType): void => {
    emit('update:activeTab', tab);
};
</script>

<template>
    <nav class="flex gap-2 flex-wrap">
        <button
            @click="setActiveTab('about')"
            :class="[
                'px-5 py-2 rounded-lg font-medium text-sm transition-all duration-200 border',
                props.activeTab === 'about' 
                    ? 'bg-green-700 text-white border-green-600' 
                    : 'bg-gray-800 text-gray-300 border-gray-700 hover:bg-gray-700'
            ]"
        >
            About
        </button>
        <button
            @click="setActiveTab('offer')"
            :class="[
                'px-5 py-2 rounded-lg font-medium text-sm transition-all duration-200 border',
                props.activeTab === 'offer' 
                    ? 'bg-green-700 text-white border-green-600' 
                    : 'bg-gray-800 text-gray-300 border-gray-700 hover:bg-gray-700'
            ]"
        >
            Our Offer
        </button>
        <button
            @click="setActiveTab('works')"
            :class="[
                'px-5 py-2 rounded-lg font-medium text-sm transition-all duration-200 border',
                props.activeTab === 'works' 
                    ? 'bg-green-700 text-white border-green-600' 
                    : 'bg-gray-800 text-gray-300 border-gray-700 hover:bg-gray-700'
            ]"
        >
            What works
        </button>
        <button
            @click="setActiveTab('challenges')"
            :class="[
                'px-5 py-2 rounded-lg font-medium text-sm transition-all duration-200 border',
                props.activeTab === 'challenges' 
                    ? 'bg-red-800 text-white border-red-700' 
                    : 'bg-gray-800 text-gray-300 border-gray-700 hover:bg-gray-700'
            ]"
        >
            Challenges
        </button>
        <button
            @click="setActiveTab('goals')"
            :class="[
                'px-5 py-2 rounded-lg font-medium text-sm transition-all duration-200 border',
                props.activeTab === 'goals' 
                    ? 'bg-red-900 text-white border-red-800' 
                    : 'bg-gray-800 text-gray-300 border-gray-700 hover:bg-gray-700'
            ]"
        >
            Goals
        </button>
    </nav>
</template>
