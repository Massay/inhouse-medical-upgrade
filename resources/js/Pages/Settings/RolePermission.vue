<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';

defineProps({
    roles: Array
})

</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Roles & Permissions
                </h2>

                <Link class="border p-2" :href="route('settings.role_and_permissions.add')">Add Role</Link>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-[90%]  mx-auto sm:px-6 lg:px-8">

                <div class="flex justify-end my-4">

                </div>



                <div class="max-w-7xl mx-auto">

                    <div v-for="(role, index) in roles" :key="index">
                        <p>{{ role.name }}</p>

                        <Link>Edit</Link>
                        <Link>Delete</Link>

                    </div>


                </div>
            </div>
        </div>
    </AppLayout>
</template>
