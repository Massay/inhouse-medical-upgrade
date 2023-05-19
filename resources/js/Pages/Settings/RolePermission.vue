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
                <h2 class="font-semibold text-gray-800 leading-tight">
                    Roles
                </h2>

                <Link class="border p-2" :href="route('settings.role_and_permissions.add')">Add Role</Link>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-[90%]  mx-auto sm:px-6 lg:px-8">


                <div class="max-w-7xl mx-auto flex flex-col space-y-4">

                    <div v-for="(role, index) in roles" :key="index">
                        <div class="flex justify-between border rounded-md bg-gray-200 p-2">
                            <p class="capitalize font-semibold">{{ role.name }}</p>

                            <div class="flex space-x-2">
                                <Link :href="route('settings.role_and_permissions.show', role.id)">View</Link>
                                <Link :href="route('settings.role_and_permissions.edit', role)">Edit</Link>
                                <Link>Delete</Link>
                            </div>
                        </div>

                    </div>


                </div>
            </div>
        </div>
    </AppLayout>
</template>
