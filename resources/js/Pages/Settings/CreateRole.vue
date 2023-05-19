<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link, useForm } from '@inertiajs/vue3';

defineProps({
    permissions: Array
})

const form = useForm({
    name:'',
    selectedPermissions: []
})
function submit(){
        form.post(route('settings.role_and_permissions.store'))
}
</script>

<template>
    <AppLayout title="Create Role">
        <template #header>
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Roles
                </h2>
                <Link :href="route('settings.role_and_permissions')" class="border p-2">List of Role</Link>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-[90%]  mx-auto sm:px-6 lg:px-8">

                <div class="flex justify-end my-4">

                </div>



                <div class="max-w-2xl  border mx-auto p-2">

                    <form @submit.prevent="submit">

                        <div class="w-full">
                            <input type="text" v-model="form.name" class="w-full" placeholder="Role Name">
                        </div>
                        <div class=" p-2">
                            <label :for="permission.name" v-for="(permission, index) in permissions" :key="index"
                                class="w-full flex items-center space-x-2">
                                <span class="w-40">{{ permission.name }}</span>
                                <input type="checkbox" :value="permission.name"  v-model="form.selectedPermissions" :id="permission.name">
                            </label>
                        </div>
                        <div class="flex justify-end">
                            <button class="border px-8 py-2 rounded-lg font-bold text-gray-50 bg-blue-500">Create
                                Role</button>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </AppLayout>
</template>
