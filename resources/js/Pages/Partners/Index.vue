<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';
defineProps({
    clinics: {
        type: Object,
        required: true
    }
})

</script>

<template>
    <AppLayout title="Partners">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Partners
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="flex w-full p-2">
                        <input type="text" class="w-full rounded-lg" placeholder="Search by name, address or phone number">
                    </div>
                    <div class="p-2">
                        <table class="w-full">
                            <thead class="border">
                                <th class="p-2">Name</th>
                                <th>Address</th>
                                <th>Contact</th>
                                <th>
                                    Action
                                </th>

                            </thead>

                            <tbody class="">

                                <tr v-for="(clinic, index) in clinics.data" :key="index">
                                    <td class="border p-2">{{ clinic.name }}</td>
                                    <td class="border p-2">{{ clinic.address }}</td>
                                    <td class="border p-2">{{ clinic.contact }}</td>
                                    <td class="flex justify-between border p-2">
                                        <Link as="button">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                            class="w-6 h-6">
                                            <path d="M12 15a3 3 0 100-6 3 3 0 000 6z" />
                                            <path fill-rule="evenodd"
                                                d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 010-1.113zM17.25 12a5.25 5.25 0 11-10.5 0 5.25 5.25 0 0110.5 0z"
                                                clip-rule="evenodd" />
                                        </svg>


                                        </Link>
                                        <Link as="button">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                            class="w-6 h-6">
                                            <path
                                                d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32L19.513 8.2z" />
                                        </svg>

                                        </Link>

                                        <Link>
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
                    </div>
                    <div class="flex justify-center space-x-4 py-4">

                        <template v-for="(link, index) in clinics.links" :key="index">
                            <Link :href="link.url" v-if="link.url" :class="{ 'bg-slate-900 text-gray-50': link.active }"
                                class="bg-slate-400 text-gray-50 p-2 rounded-full h-10 w-auto" v-html="link.label" />
                            <span v-else v-html="link.label" class="p-2 cursor-not-allowed rounded-full bg-gray-200" />
                        </template>

                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
