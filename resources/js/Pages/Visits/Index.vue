<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';
import moment from "moment";

defineProps({
    visits: {
        type: Array,
        required: true
    }
})


</script>

<template>
    <AppLayout title="Visits">
        <template #header>

            <div class="flex justify-between">
                <div class="flex items-center">
                    <h1>
                        Visits
                    </h1>


                </div>
                <Link class="border p-1" as="button" :href="route('visits.create')">Add Visit Entry</Link>
            </div>

        </template>

        <div class="py-12">
            <div class="max-w-[90%] mx-auto  sm:px-6 lg:px-8">


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
                        <th class="p-2 border">Action</th>
                    </thead>
                    <tbody class="text-center">
                        <tr v-for="(visit, index) in visits.data" :key="index">
                            <td class="border p-2">

                                {{ moment(visit.date).format("DD/MMMM/YYYY") }}
                            </td>
                            <td class="border">{{ visit.clinic.name }}</td>
                            <td class="border">{{ visit.employee.firstname }} {{ visit.employee.middlename }} {{
                                visit.employee.lastname }}</td>
                            <td class="border">{{ visit.patient_name }}</td>
                            <td class="border">{{ (visit.is_employee_visit == 1) ? 'PHV' : 'BV' }}</td>
                            <td class="border">{{ (visit.relative) ? visit.relative.name : '-' }}</td>
                            <td class="border">{{ visit.amount }}</td>
                            <td class="border">{{ visit.company_amount }}</td>
                            <td class="border">{{ visit.employee_amount }}</td>
                            <td class="border flex items-center justify-between">
                                <Link as="button" class="text-yellow-600" :href="route('visits.show', visit.id)">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="w-6 h-6">
                                    <path
                                        d="M6 3a3 3 0 00-3 3v1.5a.75.75 0 001.5 0V6A1.5 1.5 0 016 4.5h1.5a.75.75 0 000-1.5H6zM16.5 3a.75.75 0 000 1.5H18A1.5 1.5 0 0119.5 6v1.5a.75.75 0 001.5 0V6a3 3 0 00-3-3h-1.5zM12 8.25a3.75 3.75 0 100 7.5 3.75 3.75 0 000-7.5zM4.5 16.5a.75.75 0 00-1.5 0V18a3 3 0 003 3h1.5a.75.75 0 000-1.5H6A1.5 1.5 0 014.5 18v-1.5zM21 16.5a.75.75 0 00-1.5 0V18a1.5 1.5 0 01-1.5 1.5h-1.5a.75.75 0 000 1.5H18a3 3 0 003-3v-1.5z" />
                                </svg>
                                </Link>
                                <Link as="button" class="text-green-600" :href="route('visits.edit', visit.id)"
                                    title="Edit Visit Entry">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="w-6 h-6">
                                    <path
                                        d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32l8.4-8.4z" />
                                    <path
                                        d="M5.25 5.25a3 3 0 00-3 3v10.5a3 3 0 003 3h10.5a3 3 0 003-3V13.5a.75.75 0 00-1.5 0v5.25a1.5 1.5 0 01-1.5 1.5H5.25a1.5 1.5 0 01-1.5-1.5V8.25a1.5 1.5 0 011.5-1.5h5.25a.75.75 0 000-1.5H5.25z" />
                                </svg>

                                </Link>
                                <Link as="button" class="text-red-600" :href="route('visits.show', visit.id)">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="w-6 h-6">
                                    <path fill-rule="evenodd"
                                        d="M16.5 4.478v.227a48.816 48.816 0 013.878.512.75.75 0 11-.256 1.478l-.209-.035-1.005 13.07a3 3 0 01-2.991 2.77H8.084a3 3 0 01-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 01-.256-1.478A48.567 48.567 0 017.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 013.369 0c1.603.051 2.815 1.387 2.815 2.951zm-6.136-1.452a51.196 51.196 0 013.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 00-6 0v-.113c0-.794.609-1.428 1.364-1.452zm-.355 5.945a.75.75 0 10-1.5.058l.347 9a.75.75 0 101.499-.058l-.346-9zm5.48.058a.75.75 0 10-1.498-.058l-.347 9a.75.75 0 001.5.058l.345-9z"
                                        clip-rule="evenodd" />
                                </svg>

                                </Link>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <div class="flex justify-center space-x-4 py-4">
                    <!-- {{ clinics.links }} -->

                    <template v-for="(link, index) in visits.links" :key="index">
                        <Link :href="link.url" v-if="link.url" :class="{ 'bg-slate-900 text-gray-50': link.active }"
                            class="bg-slate-400 text-gray-50 p-2 rounded-full h-10 w-auto" v-html="link.label" />
                        <span v-else v-html="link.label" class="p-2 cursor-not-allowed rounded-full bg-gray-200" />
                    </template>

                </div>
            </div>
        </div>
    </AppLayout>
</template>
