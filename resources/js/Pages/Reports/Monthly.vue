<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { useForm } from '@inertiajs/vue3';
import moment from 'moment';
const form = useForm({
        year_id: null,
        month_id: null
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
</script>

<template>
    <AppLayout title="Monthly">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Monthly
            </h2>
        </template>

        <div class="py-12">
            {{  form  }}
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
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
                </div>
            </div>
        </div>
    </AppLayout>
</template>
