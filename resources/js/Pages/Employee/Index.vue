<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';
import moment from 'moment';
// import { computed } from 'vue'

// const page = usePage()

// const can = computed(() => page.props.can)
defineProps({
    employees: Array,
    can: Object
})
</script>

<template>
    <AppLayout title="Employees">
        <template #header>
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Employees
                </h2>
                <Link v-if="can.create.employees" :href="route('employees.create')" class="border px-8 py-2 flex items-center">
                <span><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                        <path fill-rule="evenodd"
                            d="M12 3.75a.75.75 0 01.75.75v6.75h6.75a.75.75 0 010 1.5h-6.75v6.75a.75.75 0 01-1.5 0v-6.75H4.5a.75.75 0 010-1.5h6.75V4.5a.75.75 0 01.75-.75z"
                            clip-rule="evenodd" />
                    </svg>
                </span>
                <span>Add Employee</span></Link>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                    <table class="w-full">
                        <thead class="border text-center bg-slate-700 text-gray-50">
                            <th class="p-2 border">#</th>
                            <th class="p-2 border">Created Date</th>

                            <th class="p-2 border">Fullname</th>
                            <th class="p-2 border">Position</th>
                            <th class="p-2 border">Official Email</th>
                            <th class="p-2 border">Department</th>
                            <th class="p-2 border">Action</th>
                        </thead>
                        <tbody class="text-center">
                            <tr v-for="(employee, index) in employees.data" :key="index">
                                <td class="border">{{ employee.id }}</td>
                                <td class="border p-2">

                                    {{ moment(employee.created_at).format("DD/MMMM/YYYY") }}
                                </td>

                                <td class="border">{{ employee.firstname }} {{ employee.middlename }} {{
                                    employee.lastname }}</td>
                                <td class="border">{{ employee.job_title }}</td>
                                <td class="border">{{ employee.company_email }}</td>
                                <td class="border">{{ employee.department }}</td>
                                <td class="border flex items-center justify-between">
                                    <Link class="text-yellow-600" :href="route('employees.show', employee)">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                        class="w-6 h-6">
                                        <path d="M12 15a3 3 0 100-6 3 3 0 000 6z" />
                                        <path fill-rule="evenodd"
                                            d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 010-1.113zM17.25 12a5.25 5.25 0 11-10.5 0 5.25 5.25 0 0110.5 0z"
                                            clip-rule="evenodd" />
                                    </svg>

                                    </Link>
                                    <Link class="text-green-600" :href="route('employees.edit', employee)"
                                        title="Edit Visit Entry">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                        class="w-6 h-6">
                                        <path
                                            d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32l8.4-8.4z" />
                                        <path
                                            d="M5.25 5.25a3 3 0 00-3 3v10.5a3 3 0 003 3h10.5a3 3 0 003-3V13.5a.75.75 0 00-1.5 0v5.25a1.5 1.5 0 01-1.5 1.5H5.25a1.5 1.5 0 01-1.5-1.5V8.25a1.5 1.5 0 011.5-1.5h5.25a.75.75 0 000-1.5H5.25z" />
                                    </svg>

                                    </Link>
                                    <Link class="text-blue-600" :href="route('employees.relative.index', employee)">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                        class="w-6 h-6">
                                        <path fill-rule="evenodd"
                                            d="M8.25 6.75a3.75 3.75 0 117.5 0 3.75 3.75 0 01-7.5 0zM15.75 9.75a3 3 0 116 0 3 3 0 01-6 0zM2.25 9.75a3 3 0 116 0 3 3 0 01-6 0zM6.31 15.117A6.745 6.745 0 0112 12a6.745 6.745 0 016.709 7.498.75.75 0 01-.372.568A12.696 12.696 0 0112 21.75c-2.305 0-4.47-.612-6.337-1.684a.75.75 0 01-.372-.568 6.787 6.787 0 011.019-4.38z"
                                            clip-rule="evenodd" />
                                        <path
                                            d="M5.082 14.254a8.287 8.287 0 00-1.308 5.135 9.687 9.687 0 01-1.764-.44l-.115-.04a.563.563 0 01-.373-.487l-.01-.121a3.75 3.75 0 013.57-4.047zM20.226 19.389a8.287 8.287 0 00-1.308-5.135 3.75 3.75 0 013.57 4.047l-.01.121a.563.563 0 01-.373.486l-.115.04c-.567.2-1.156.349-1.764.441z" />
                                    </svg>


                                    </Link>
                                    <Link as="button" method="delete"
                                        :title="'delete ' + employee.firstname + ' ' + employee.lastname"
                                        class="text-red-600" :href="route('employees.delete', employee)">
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
                        <template v-for="(link, index) in employees.links" :key="index">
                            <Link :href="link.url" v-if="link.url" :class="{ 'bg-slate-900 text-gray-50': link.active }"
                                class="bg-slate-400 text-gray-50 p-2 rounded-full h-10 w-auto" v-html="link.label" />
                            <span v-else v-html="link.label" class="p-2 cursor-not-allowed rounded-full bg-gray-200" />
                        </template>

                    </div>
                </div>
            </div>
        </div>
    </AppLayout></template>
