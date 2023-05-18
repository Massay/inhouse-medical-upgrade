<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';
defineProps({
    users: {
        type: Object
    }
})
</script>

<template>
    <AppLayout title="Users">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Users
            </h2>
        </template>

        <div class="py-12">
            <div class="pt-12 max-w-7xl mx-auto p-2">
                <table class="w-full">
                    <thead class="border">
                        <th class="border p-2 bg-slate-600 text-gray-50">Id</th>
                        <th class="border p-2 bg-slate-600 text-gray-50">Name</th>
                        <th class="border p-2 bg-slate-600 text-gray-50">Email</th>
                        <th class="border p-2 bg-slate-600 text-gray-50">Created At</th>
                        <th class="border p-2 bg-slate-600 text-gray-50">Actions</th>
                    </thead>
                    <tbody>
                        <tr v-for="(user, index) in users.data" class="text-center" :key="index">
                            <td class="border">{{ user.id }}</td>
                            <td class="border"><span class="font-extrabold">{{ user.name }}</span></td>
                            <td class="border bg-slate-600 text-gray-50"><span class="font-bold">{{ user.email }}</span>
                            </td>
                            <td class="border">{{ user.created_at }}</td>
                            <td class="border flex justify-between items-center p-2">
                                <Link as="button" class="" :href="route('users.show', user)" title="User Roles & Details">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                    class="w-5 h-5">
                                    <path
                                        d="M11 5a3 3 0 11-6 0 3 3 0 016 0zM2.615 16.428a1.224 1.224 0 01-.569-1.175 6.002 6.002 0 0111.908 0c.058.467-.172.92-.57 1.174A9.953 9.953 0 018 18a9.953 9.953 0 01-5.385-1.572zM16.25 5.75a.75.75 0 00-1.5 0v2h-2a.75.75 0 000 1.5h2v2a.75.75 0 001.5 0v-2h2a.75.75 0 000-1.5h-2v-2z" />
                                </svg>


                                </Link>
                                <Link as="button" method="get" :href="route('users.update.password', user)"
                                    class="rounded-md text-yellow-900" title="Change Password">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                    class="w-5 h-5">
                                    <path fill-rule="evenodd"
                                        d="M8 7a5 5 0 113.61 4.804l-1.903 1.903A1 1 0 019 14H8v1a1 1 0 01-1 1H6v1a1 1 0 01-1 1H3a1 1 0 01-1-1v-2a1 1 0 01.293-.707L8.196 8.39A5.002 5.002 0 018 7zm5-3a.75.75 0 000 1.5A1.5 1.5 0 0114.5 7 .75.75 0 0016 7a3 3 0 00-3-3z"
                                        clip-rule="evenodd" />
                                </svg>


                                </Link>
                                <Link as="button" method="get" :href="route('users.edit', user)"
                                    class="rounded-md text-green-700" title="Edit User">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                    class="w-5 h-5">
                                    <path
                                        d="M2.695 14.763l-1.262 3.154a.5.5 0 00.65.65l3.155-1.262a4 4 0 001.343-.885L17.5 5.5a2.121 2.121 0 00-3-3L3.58 13.42a4 4 0 00-.885 1.343z" />
                                </svg>



                                </Link>

                                <Link as="button" method="get" class="rounded-md text-red-600" title="Delete User">
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

                    <template v-for="(link, index) in users.links" :key="index">
                        <Link :href="link.url" v-if="link.url" :class="{ 'bg-slate-900 text-gray-50': link.active }"
                            class="bg-slate-400 text-gray-50 p-2 rounded-full h-10 w-auto" v-html="link.label" />
                        <span v-else v-html="link.label" class="p-2 cursor-not-allowed rounded-full bg-gray-200" />
                    </template>

                </div>


            </div>
        </div>
    </AppLayout>
</template>
