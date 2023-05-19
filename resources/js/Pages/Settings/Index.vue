<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';
const menu = [
    {
         name:'Roles and Permissions',
         route: 'settings.role_and_permissions',
    },
    {
        name: 'Treatment Config',
        route: 'settings.treatment.config',
    },
    {
        name:'applications settings',
        route: 'settings.treatment.config',
    },
    {
        name:'relative settings',
        route: 'settings.treatment.config',
    }
]

</script>

<template>
    <AppLayout title="Settings">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Settings
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden h-screen shadow-xl sm:rounded-lg">
                        <div class="grid grid-cols-4 gap-4 p-2" >

                          <Link as="button" :href="route(menuItem.route)" v-for="(menuItem, index) in menu " :key="index" class="border shadow-lg rounded-md h-[100px] w-auto grid place-content-center">
                              <span class="font-extrabold capitalize">{{  menuItem.name }}</span>
                          </Link>

                        </div>

                </div>
            </div>
        </div>
    </AppLayout>
</template>
