
<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';
import { computed } from 'vue'
import UserRoleComponent from './UserRoleComponent.vue';

const props = defineProps({
    user: Object,
    roles: Array,
    allRoles: Array
})


// const fullname = computed(() => {
//     get: () => {
//          return "Hello World";
//     }
//     set: () => {}
// })

// const fullname = computed(() => {
//      return props.user.name +' '+ ((props.user.middle_name)?props.user.middle_name: '') +' '+ (props.user.last_name)
// })


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
                    <span>Details</span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                    </svg>
                    <span class="font-extrabold">
                        <span class="font-extrabold text-gray-50  rounded-md bg-slate-600 p-1">{{ user.name }}</span>
                    </span>
                    <!-- {{ user }} -->
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
                <div>
                        <h1 class="font-extrabold text-lg">Current Roles</h1>

                        <div v-if="roles.length <= 0">
                           <p class="text-center text-red-600 text-lg">This User does not have any Role assigned to him/her</p>
                        </div>

                        <ul>
                            <li v-for="(role,index) in roles" :key="index">
                                    {{  role }}
                            </li>
                        </ul>
                </div>



                    <UserRoleComponent :user="user" :all-roles="allRoles"/>



        </div>
    </AppLayout>
</template>
