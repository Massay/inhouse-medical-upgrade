
<script setup>
import { useForm } from '@inertiajs/vue3';

        defineProps({
            user: {
                 required: true,
                 type: Object
            },
            allRoles: Array
        })

        const form = useForm({
            selectedRoles: []
        })
</script>

<template>

    <form @submit.prevent="form.transform((data) => ({
         'updated_roles': allRoles
    }) ).post(route('users.assigned.role', user.id))" class="border p-2 max-w-2xl mx-auto rounded-xl">
        <div class="flex flex-col space-x-1  p-3">
                  <label :for="role.name" v-for="(role, index) in allRoles" :key="index" class="p-2 flex items-center space-x-1">
                       <span class="capitalize"> {{  role.name }}</span>
                       <input type="checkbox" :id="role.name" :value="role.name" :checked="role.assigned" v-model="role.assigned">
                  </label>
        </div>
        <button type="submit" class="bg-blue-600 text-gray-50 font-bold px-8 py-3 rounded-lg w-full">Save</button>
    </form>
<!-- Load all the Roles and Assign to The User (Passed In)-->

</template>
