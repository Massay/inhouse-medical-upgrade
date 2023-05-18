<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';
defineProps({
    treatment_types: Array
})
</script>

<template>
    <AppLayout title="Treatment Type Reports">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Treatment Type Reports
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden sm:rounded-lg grid grid-cols-4 sm:grid-cols-2 gap-4 p-2">



                        <Link :href="route('reports.showTreatmentTypeDetailsByID', type.id)" v-for="(type, index) in treatment_types" :key="index" class="border grid place-content-center border-gray-300 rounded-md p-2 shadow-sm bg-gray-50 h-24 w-auto">
                           <span class="font-extrabold capitalize  p-2 rounded-md">{{  type.name  }}</span>
                        </Link>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
