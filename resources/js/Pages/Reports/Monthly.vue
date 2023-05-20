<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { useForm } from '@inertiajs/vue3';
import moment from 'moment';
import { computed } from 'vue'
import CurrencyFormat from '@/Components/CurrencyFormat.vue';
import printJS from 'print-js'

const props = defineProps({
    clinics: Array,
    filters: Object,
    visits: {
        type: Array,
        default: () => []
    }
})

const form = useForm({
    year_id: props.filters.year_id || null,
    month_id: props.filters.month_id || null,
    clinic_id: props.filters.clinic_id || null
})


let years = [
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


const totalAMount = computed(() => {
    return _.sumBy(props.visits, function (item) { return item.amount })
})

const totalCompanyAmount = computed(() => {
    return _.sumBy(props.visits, function (item) { return item.company_amount })
})


const totalEmployeeAmount = computed(() => {
    return _.sumBy(props.visits, function (item) { return item.employee_amount })
})

function submit() {
    form.get(route('reports.monthly'), {
        preserveScroll: true,
        preserveState: true
    });
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
                                    {{ year }}
                                </option>
                            </select>
                        </div>
                        <div class="flex-1">
                            <select name="" id="" class="w-full rounded-md" v-model="form.month_id">
                                <option value="null" disabled>Select Month</option>
                                <option :value="(i + 1)" v-for="(m, i) in moment.months()" :key="i">
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
                        <button type="submit"
                            class="px-8 py-2 bg-blue-400 rounded-md font-extrabold text-gray-50">Search</button>
                    </div>
                </form>


                <div class="my-2">


                    <button @click.prevent="printJS({printable: 'MonthlyReport', type:'html', printCSS:'https://cdn.tailwindcss.com', title:'Monthly Report' })"
                        class="bg-blue-700 px-8 py-2 rounded-md flex items-center space-x-2 text-gray-50">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                            <path fill-rule="evenodd"
                                d="M7.875 1.5C6.839 1.5 6 2.34 6 3.375v2.99c-.426.053-.851.11-1.274.174-1.454.218-2.476 1.483-2.476 2.917v6.294a3 3 0 003 3h.27l-.155 1.705A1.875 1.875 0 007.232 22.5h9.536a1.875 1.875 0 001.867-2.045l-.155-1.705h.27a3 3 0 003-3V9.456c0-1.434-1.022-2.7-2.476-2.917A48.716 48.716 0 0018 6.366V3.375c0-1.036-.84-1.875-1.875-1.875h-8.25zM16.5 6.205v-2.83A.375.375 0 0016.125 3h-8.25a.375.375 0 00-.375.375v2.83a49.353 49.353 0 019 0zm-.217 8.265c.178.018.317.16.333.337l.526 5.784a.375.375 0 01-.374.409H7.232a.375.375 0 01-.374-.409l.526-5.784a.373.373 0 01.333-.337 41.741 41.741 0 018.566 0zm.967-3.97a.75.75 0 01.75-.75h.008a.75.75 0 01.75.75v.008a.75.75 0 01-.75.75H18a.75.75 0 01-.75-.75V10.5zM15 9.75a.75.75 0 00-.75.75v.008c0 .414.336.75.75.75h.008a.75.75 0 00.75-.75V10.5a.75.75 0 00-.75-.75H15z"
                                clip-rule="evenodd" />
                        </svg>
                        <span>Print</span></button>
                </div>
                <div id="MonthlyReport"  class="w-full">
                <h1 class="hidden print:block print:text-center">Monthly Report</h1>
                    <table class="w-full">
                        <thead class="border text-center bg-slate-700 text-gray-50">
                            <th class="p-2 border">Date</th>
                            <th class="p-2 border">Clinic</th>
                            <th class="p-2 border">Employee</th>
                            <th class="p-2 border">Patient</th>
                            <th class="p-2 border">Visit Type</th>
                            <th class="p-2 border">Beneficairy</th>
                            <th class="p-2 border">Amount</th>
                            <th class="p-2 border">Company Amount</th>
                            <th class="p-2 border">Emp Amount</th>
                        </thead>
                        <tbody class="text-center">
                            <tr v-for="(visit, index) in visits" :key="index">
                                <td class="border p-2">

                                    {{ moment(visit.date).format("DD/MMMM/YYYY") }}
                                </td>
                                <td class="border">{{ visit.clinic.name }}</td>
                                <td class="border">{{ visit.employee.firstname }} {{ visit.employee.middlename }} {{
                                    visit.employee.lastname }}</td>
                                <td class="border">{{ visit.patient_name }}</td>
                                <td class="border">{{ (visit.is_employee_visit == 1) ? 'PHV' : 'BV' }}</td>
                                <td class="border">{{ (visit.relative) ? visit.relative.name : '-' }}</td>
                                <td class="border">

                                    <CurrencyFormat :value="visit.amount" />
                                </td>
                                <td class="border">
                                    <CurrencyFormat :value="visit.company_amount" />
                                </td>
                                <td class="border">
                                    <CurrencyFormat :value="visit.employee_amount" />
                                </td>

                            </tr>

                            <tr>
                                <td colspan="6" class="border p-2 font-extrabold uppercase bg-slate-800 text-gray-50">Total
                                </td>
                                <td class="border bg-yellow-400">
                                    <CurrencyFormat :value="totalAMount" class="font-extrabold" />
                                </td>
                                <td class="border  bg-yellow-700">
                                    <CurrencyFormat :value="totalCompanyAmount" class="font-extrabold" />
                                </td>
                                <td class="border  bg-green-700 text-gray-50">
                                    <CurrencyFormat :value="totalEmployeeAmount" class="font-extrabold" />
                                </td>

                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </AppLayout>
</template>
