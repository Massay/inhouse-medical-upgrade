
<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { router, useForm } from '@inertiajs/vue3'
import { Link } from '@inertiajs/vue3';


const props = defineProps({
    errors: Object,
    user: Object
})



const form = useForm({
    password: null,
    password_confirmation: null
})

</script>

<template>
    <AppLayout title="Create Users">
        <template #header>
            <div class="flex justify-between items-center">

                <h2 class="font-semibold text-xl text-gray-800 leading-tight flex">

                    <span class="font-light">Users</span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                    </svg>
                    <span class="bg-slate-600 rounded-md text-gray-50 grid place-content-center px-2">{{ user.name  }}</span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                    </svg>
                    <span class="font-extrabold">Change Password</span>

                </h2>
                <Link method="get" class="bg-blue-600 text-white rounded-md px-4 py-2 flex" :href="route('users.index')">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>


                User List</Link>
            </div>
        </template>

        <div class="pt-12 max-w-7xl mx-auto p-2 rounded-md">


            {{  errors }}

            <form @submit.prevent="form.put(route('users.update.password', user))" class="bg-gray-200 rounded-lg p-4 space-y-2">
                <div>
                    <input v-model="form.password" class="w-full rounded-md" type="password" placeholder="Password">
                </div>
                <div>
                    <input v-model="form.password_confirmation" class="w-full rounded-md" type="password" placeholder="Confirm Password">
                </div>


                <div class="flex justify-end">
                    <button class="px-12 bg-blue-600 rounded-md  text-gray-50 font-bold p-2">Update Password</button>
                </div>
            </form>

        </div>
    </AppLayout>
</template>
