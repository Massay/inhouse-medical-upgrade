<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';
import RoleComponent from './RoleComponent.vue';
defineProps({
    role: Object,
    permissionsBelongingToRole: Object,
    permissionsNotBelongingToRole: Array
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
                    Edit Role
                </h2>
                <span><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                    </svg>
                </span>
                <span>
                    {{ role.name }}
                </span>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <div class="y-4">
                    <ul class="flex flex-col space-y-4 p-1">

                        <li v-for="(permission, index) in permissionsBelongingToRole" :key="index"
                            class="bg-green-700 text-gray-100 p-2">
                            <RoleComponent :permission="permission" :type="'delete'"/>

                        </li>
                    </ul>
                    <ul class="flex flex-col space-y-4 p-1">
                        <li v-for="(permission, index) in permissionsNotBelongingToRole" :key="index"
                            class="bg-yellow-700 text-gray-100 p-2">
                            <RoleComponent :permission="permission" :type="'add'"/>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
