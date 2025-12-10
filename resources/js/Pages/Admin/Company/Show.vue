<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import CompanyDetailPage from '@/Components/CompanyDetailPage.vue';
import { Head, Link } from '@inertiajs/vue3';
import type { Company } from '@/types';

defineProps<{
    company: Company;
}>();
</script>

<template>
    <Head :title="`${company.name} - Company Details`" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        Company Details
                    </h2>
                    <p class="text-sm text-gray-600 mt-1">View detailed information about {{ company.name }}</p>
                </div>
                <Link
                    :href="route('admin.companies.index')"
                    class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-lg"
                >
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Back to Companies List
                </Link>
            </div>
        </template>

        <div class="py-8">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <CompanyDetailPage :company="company" />
            </div>
        </div>
    </AuthenticatedLayout>
</template>
