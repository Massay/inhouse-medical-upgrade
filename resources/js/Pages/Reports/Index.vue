<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';
const reports = [
    {
        name:'Monthly Reports',
        icon: '/images/svg/pie-chart-fill.svg',
        route:'reports.monthly'
    },
    {
        name:'Custom Date Reports',
        icon: '/images/svg/reports.svg',
        route:'reports.custom_date'
    },
    {
        name:'Treatment Type Reports',
        icon: '/images/svg/activity.svg',
        route:'reports.treatment_type'
    },
    {
        name: 'Family Report',
        icon: '/images/svg/bar-chart-2.svg',
        route:'reports.family'
    }
]

</script>

<template>
    <AppLayout title="Reports">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Reports
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden sm:rounded-lg grid grid-cols-4 gap-4 p-2  ">
                        <Link :href="route(report.route)" v-for="(report, index) in reports" :key="index" class="bg-slate-300 text-gray-500 border flex flex-col items-center justify-center space-y-2 border-gray-400 shadow-md h-36 rounded-md p-2">
                                <h1 class="text-center font-semibold border-b-2 border-b-green-500">{{  report.name  }}</h1>
                                <img :src="report.icon" class="h-16 w-auto" alt="">
                        </Link>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
