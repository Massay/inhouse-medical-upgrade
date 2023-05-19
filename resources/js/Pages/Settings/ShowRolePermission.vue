<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';

defineProps({
    role: Object
})
</script>

<template>
    <AppLayout title="Show Role">
        <template #header>
            <div class="flex items-center">
                <Link :href="route('settings.role_and_permissions')">Roles</Link>
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                    </svg>

                </span>
                <h2 class="font-semibold text-gray-800 leading-tight">
                    Show Role
                </h2>
                <span><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                    </svg>
                </span>
                <span>
                    {{  role.name }}
                </span>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <div class="y-4">
                    <ul class="flex flex-col space-y-4 p-1">
                            <li v-for="(permission, index) in role.permissions" :key="index" class="bg-yellow-700 text-gray-100 p-2">
                               <span class="font-extrabold">{{  permission.name }}</span>
                            </li>
                    </ul>
                </div>

            </div>
        </div>
    </AppLayout>
</template>
