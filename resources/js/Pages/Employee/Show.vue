<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';
import moment from "moment";
import CurrencyFormat from '@/Components/CurrencyFormat.vue'
defineProps({
    employee: Object
})






</script>

<template>
    <AppLayout title="View Employee Information">
        <template #header>
            <div class="flex justify-between">
                <h2 class=" text-xl text-gray-800 leading-tight">
                    Showing <span class="font-semibold"> {{ employee.firstname }} {{ employee.middlename }} {{
                        employee.lastname }}</span> Info
                </h2>
                <Link :href="route('employees.index')" class="border px-8 py-2 flex items-center">

                <span>List of Employees</span></Link>
            </div>
        </template>

        <div class="py-12 grid grid-cols-4 px-2 gap-2">
            <div class="border">
                <h1>Summary About <span class="capitalize font-extrabold md:text-lg">{{ employee.firstname }} {{
                    employee.middlename }} {{ employee.lastname }}</span></h1>
                <div>
                    <table>
                        <thead class="bg-orange-400">
                            <th class="border"># of Relatives</th>
                            <th class="border">Employee Number</th>
                        </thead>
                        <tbody>
                            <tr class="border text-center">
                                <td class="border">
                                    <div class="bg-slate-900 text-gray-50 md:text-2xl">
                                        {{ employee.relatives.length }}
                                    </div>
                                </td>
                                <td class="border">{{ employee.no }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="border">
                <h1 class="font-extrabold text-center text-lg bg-slate-600 text-gray-50">Relatives</h1>
                <ul class="border p-2 flex space-x-2">
                    <li v-for="(r, index) in employee.relatives" :key="index" class="border p-2">
                        {{ r.name }}
                    </li>
                </ul>
            </div>
            <div class="border col-span-2">
                <h1 class="text-center bg-slate-700 text-gray-50 font-extrabold text-lg">Last 10 Visits Summary</h1>
                <table class="w-full p-2">
                    <thead class="bg-yellow-800 text-gray-50">
                        <th class="border">Clinic</th>
                        <th class="border">Amount</th>
                        <th class="border">Patient Name</th>
                        <th class="border">Date</th>
                    </thead>
                    <tbody class="text-center">
                        <tr v-for="(v, i) in employee.visits_top_10" :key="i">
                            <td class="border font-ex">
                               <span class="font-extrabold"> {{ v.clinic.name }}</span>
                            </td>
                            <td class="border">

                                <CurrencyFormat :value="v.amount"/>
                            </td>
                            <td class="border">
                                {{ v.patient_name }}
                            </td>
                            <td class="border">
                                {{ moment(v.date).format("DD/MMMM/YYYY") }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </AppLayout>
</template>
