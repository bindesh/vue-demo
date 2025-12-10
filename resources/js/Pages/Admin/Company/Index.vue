<script setup lang="ts">
import { ref } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import CompanySidebar from '@/Components/CompanySidebar.vue';
import { Head, Link } from '@inertiajs/vue3';
import type { Company, Pagination } from '@/types';

const props = withDefaults(defineProps<{
    companies?: Company[];
    pagination?: Pagination;
}>(), {
    companies: () => [],
    pagination: () => ({
        current_page: 1,
        last_page: 1,
        per_page: 10,
        total: 0,
        from: null,
        to: null,
        links: [],
    }),
});

const isSidebarOpen = ref<boolean>(false);
const selectedCompany = ref<Company | null>(null);

const openSidebar = (company: Company): void => {
    selectedCompany.value = company;
    isSidebarOpen.value = true;
};

const closeSidebar = (): void => {
    isSidebarOpen.value = false;
    setTimeout(() => {
        selectedCompany.value = null;
    }, 300);
};
</script>

<template>
    <Head title="Admin - Companies" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Admin Panel - Companies Management
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Company Name
                                        </th>
                                        <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Industry
                                        </th>
                                        <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Location
                                        </th>
                                        <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-24">
                                            Employees
                                        </th>
                                        <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <tr v-for="company in companies" :key="company.id" class="hover:bg-gray-50">
                                        <td class="px-3 py-3 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ company.name }}
                                            </div>
                                            <div class="text-xs text-gray-500">
                                                Founded: {{ company.founded_year || 'N/A' }}
                                            </div>
                                        </td>
                                        <td class="px-3 py-3 whitespace-nowrap">
                                            <span class="px-2 py-1 inline-flex text-xs leading-4 font-semibold rounded-full bg-blue-100 text-blue-800">
                                                {{ company.industry || 'N/A' }}
                                            </span>
                                        </td>
                                        <td class="px-3 py-3 whitespace-nowrap text-sm text-gray-500">
                                            {{ company.location || 'N/A' }}
                                        </td>
                                        <td class="px-3 py-3 whitespace-nowrap text-sm text-gray-500">
                                            {{ company.employee_count ? company.employee_count.toLocaleString() : 'N/A' }}
                                        </td>
                                        <td class="px-3 py-3 whitespace-nowrap text-sm font-medium">
                                            <div class="flex flex-wrap gap-1">
                                                <button
                                                    @click="openSidebar(company)"
                                                    class="inline-flex items-center px-2 py-1 bg-purple-600 border border-transparent rounded text-xs text-white hover:bg-purple-700 transition"
                                                    title="View Details"
                                                >
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                                    </svg>
                                                </button>
                                                <Link
                                                    :href="route('admin.companies.show', { company: company.id })"
                                                    class="inline-flex items-center px-2 py-1 bg-green-600 border border-transparent rounded text-xs text-white hover:bg-green-700 transition"
                                                    title="View Full Page"
                                                >
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                    </svg>
                                                </Link>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div v-if="companies.length === 0" class="text-center py-12">
                            <p class="text-gray-500">No companies found.</p>
                        </div>

                        <!-- Pagination -->
                        <div v-if="pagination && pagination.last_page > 1" class="mt-6 flex flex-col sm:flex-row items-center justify-between gap-4">
                            <div class="text-sm text-gray-700">
                                Showing
                                <span class="font-medium">{{ pagination.from }}</span>
                                to
                                <span class="font-medium">{{ pagination.to }}</span>
                                of
                                <span class="font-medium">{{ pagination.total }}</span>
                                results
                            </div>
                            <div class="flex flex-wrap gap-2 items-center">
                                <template v-for="(link, index) in pagination.links" :key="index">
                                    <Link
                                        v-if="link.url"
                                        :href="link.url"
                                        preserve-state
                                        :class="[
                                            'px-4 py-2 text-sm font-medium rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition',
                                            link.active
                                                ? 'bg-blue-600 text-white cursor-default'
                                                : 'text-gray-700 bg-white border border-gray-300 hover:bg-gray-50'
                                        ]"
                                        v-html="link.label"
                                    />
                                    <span
                                        v-else
                                        class="px-4 py-2 text-sm font-medium text-gray-400 cursor-default"
                                        v-html="link.label"
                                    />
                                </template>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <CompanySidebar
            :company="selectedCompany"
            :isOpen="isSidebarOpen"
            @close="closeSidebar"
        />
    </AuthenticatedLayout>
</template>
