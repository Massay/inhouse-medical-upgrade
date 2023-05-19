<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { useForm } from '@inertiajs/vue3';
import moment from 'moment';
const form = useForm({
        year_id: null,
        month_id: null,
        clinic_id: null
})

defineProps({
    clinics: Array,
    filters: Object
})

let  years = [
        2018,
        2019,
        2020,
        2021,
        2022,
        2023,
        2024,
        2025,
        2026
    ]

    function submit(){


        console.log('submit')

        form.get(route('reports.monthly'));
    }
</script>

<template>
    <AppLayout title="Monthly">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Monthly
            </h2>
        </template>

        <div class="py-12">

            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <form @submit.prevent="submit">
                    <div class="flex justify-between sm:rounded-lg space-x-2">
                       <div class="flex-1">
                             <select name="" id="" v-model="form.year_id" class="w-full rounded-md">
                                    <option :value="null" disabled>Select Year</option>
                                    <option :value="year" v-for="(year) in years">
                                            {{  year }}
                                    </option>
                             </select>
                       </div>
                       <div class="flex-1">
                             <select name="" id="" class="w-full rounded-md" v-model="form.month_id">
                                    <option value="null" disabled>Select Month</option>
                                    <option :value="m" v-for="(m, i) in moment.months()" :key="i">
                                        {{ m }}
                                    </option>
                             </select>
                       </div>
                       <div class="flex-1">
                             <select name="" id="" class="w-full rounded-md" v-model="form.clinic_id">
                                    <option value="null" disabled>Select Clinic</option>
                                    <option :value="clinic.id" v-for="(clinic, i) in clinics" :key="i">
                                        {{ clinic.name }}
                                    </option>
                             </select>
                       </div>
                </div>
                <div class="flex justify-end mt-4">
                        <button type="submit"  class="px-8 py-2 bg-blue-400 rounded-md font-extrabold text-gray-50">Search</button>
                </div>
                </form>
            </div>
        </div>
    </AppLayout>
</template>
