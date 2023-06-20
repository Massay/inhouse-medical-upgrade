<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link, useForm } from '@inertiajs/vue3';
import moment from "moment";
import CurrencyFormat from '@/Components/CurrencyFormat.vue'
defineProps({
    employee: Object
})

const form = useForm({
    reportType: null,
    start_date: null,
    end_date: null,
})

function getRecords() {
    console.log("getRecords");
       form.get(route('employees.get.data'))
}
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

        <div class="py-12 grid grid-cols-1 md:grid-cols-4 md:px-8 gap-1 px-2 md:gap-2">
            <div class="border p-2">
                <h1 class="text-lg block p-2 text-center">Summary About <span
                        class="capitalize block text-2xl font-extrabold md:text-lg">{{ employee.firstname }} {{
                            employee.middlename }} {{ employee.lastname }}</span></h1>
                <div>
                    <table class="w-full">
                        <thead class="bg-orange-400">
                            <th class="border p-2"># of Relatives</th>
                            <th class="border">Employee Number</th>
                        </thead>
                        <tbody>
                            <tr class="border text-center">
                                <td class="border p-2">
                                    <div class="bg-slate-900 p-2 text-gray-50 md:text-2xl">
                                        {{ employee.relatives.length }}
                                    </div>
                                </td>
                                <td class="border p-2">
                                    <div class="border p-2 font-extrabold bg-green-500 text-gray-50">
                                        {{ employee.no }}
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="border">
                <div class="font-extrabold text-center text-lg bg-slate-800 flex justify-between px-4 py-2">
                    <h1 class=" text-gray-50">Relatives</h1>
                    <button title="Add new Relative"
                        class="text-gray-50 border rounded-full bg-orange-900 font-extrabold"><svg
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                    </button>
                </div>

                <p class="text-center text-red-600 font-bold" v-if="employee.relatives.length <= 0">No Relatives</p>
                <ul class="p-2 flex flex-col space-y-2">
                    <li v-for="(r, index) in employee.relatives" :key="index" class="border p-2">

                        <div class="flex justify-between">
                            <span class="flex-1"> {{ r.name }}</span>
                            <div class="flex space-x-1">
                                <button class="border rounded-full"><svg xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                        <path
                                            d="M2.695 14.763l-1.262 3.154a.5.5 0 00.65.65l3.155-1.262a4 4 0 001.343-.885L17.5 5.5a2.121 2.121 0 00-3-3L3.58 13.42a4 4 0 00-.885 1.343z" />
                                    </svg>

                                </button>
                                <button class="border rounded-full"><svg xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                        <path fill-rule="evenodd"
                                            d="M8.75 1A2.75 2.75 0 006 3.75v.443c-.795.077-1.584.176-2.365.298a.75.75 0 10.23 1.482l.149-.022.841 10.518A2.75 2.75 0 007.596 19h4.807a2.75 2.75 0 002.742-2.53l.841-10.52.149.023a.75.75 0 00.23-1.482A41.03 41.03 0 0014 4.193V3.75A2.75 2.75 0 0011.25 1h-2.5zM10 4c.84 0 1.673.025 2.5.075V3.75c0-.69-.56-1.25-1.25-1.25h-2.5c-.69 0-1.25.56-1.25 1.25v.325C8.327 4.025 9.16 4 10 4zM8.58 7.72a.75.75 0 00-1.5.06l.3 7.5a.75.75 0 101.5-.06l-.3-7.5zm4.34.06a.75.75 0 10-1.5-.06l-.3 7.5a.75.75 0 101.5.06l.3-7.5z"
                                            clip-rule="evenodd" />
                                    </svg>

                                </button>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="border col-span-1 md:col-span-2">
                <h1 class="text-center bg-slate-700 text-gray-50 font-extrabold text-lg">Last 10 Visits</h1>
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

                                <CurrencyFormat :value="v.amount" />
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

        <section class="w-full bg-slate-200 p-4">
            <div>
                <form @submit.prevent="getRecords" class="flex max-w-7xl mx-auto px-4 space-x-2 p-2">
                    <div class="w-full">
                        <select name="" id="" class="rounded-md w-full">
                            <option value="null" disabled>Select Report Type</option>
                            <option value="">Custom</option>
                            <option value="">Monthly</option>
                            <option value="">Yearly</option>
                        </select>
                    </div>
                    <div class="w-full">
                        <input type="date" placeholder="Start Date" class="w-full rounded-md">
                    </div>
                    <div class="w-full">
                        <input type="date" placeholder="End Date" class="w-full rounded-md">
                    </div>
                    <div>
                        <button type="submit" class="border px-4 py-2 bg-blue-500 text-gray-50 rounded-md">Search</button>
                    </div>
                </form>
            </div>

            <div class="max-w-7xl mx-auto  bg-gray-50 rounded-lg">
                <table class="w-full rounded-md">
                    <thead class="text-center bg-slate-800  text-gray-50 rounded-md">
                        <th class="border p-1">Date</th>
                        <th class="border">Clinic</th>
                        <th class="border">Patient</th>
                        <th class="border">Visit Type</th>
                        <th class="border">Beneficiary</th>
                        <th class="border">Amount</th>
                        <th class="border">Company Amount</th>
                        <th class="border">My Amount</th>
                    </thead>
                    <tbody class="text-center">
                        <tr class="border">
                            <td class="border">1</td>
                            <td class="border">2</td>
                            <td class="border">3</td>
                            <td class="border">4</td>
                            <td class="border">5</td>
                            <td class="border">6</td>
                            <td class="border">7</td>
                            <td class="border">8</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>



    </AppLayout>
</template>
