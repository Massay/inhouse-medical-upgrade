<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';
import { useForm } from 'laravel-precognition-vue-inertia';



const form = useForm('post', '/employees', {
    firstname: '',
    middlename: '',
    lastname: '',
    no: '',
    job_title: '',
    department: '',
    email:'',
    address: ''
});


const submit = () => form.submit({
    preserveScroll: true,
    onSuccess: () => form.reset(),
});


</script>

<template>
    <AppLayout title="Create Employees">
        <template #header>
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Employees
                </h2>
                <Link :href="route('employees.index')" class="border px-8 py-2 flex items-center">

                <span>List of Employees</span></Link>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <form @submit.prevent="submit" class="flex flex-col space-y-4 p-4">
                        <div class="flex space-x-2">

                            <div class="flex flex-col flex-1">
                                <label for="">Firstname</label>
                                <input type="text"  @change="form.validate('firstname')" v-model="form.firstname" placeholder="firstname" class="w-full">
                                <div  class="text-red-600" v-if="form.invalid('firstname')">{{ form.errors.firstname }}</div>
                            </div>


                            <div class="flex flex-col flex-1">
                                <label for="">Middlename</label>
                                <input type="text" v-model="form.middlename" placeholder="middlename" class="w-full">

                            </div>

                            <div class="flex flex-col flex-1">
                                <label for="">Lastname</label>
                                <input @change="form.validate('lastname')" type="text" placeholder="lastname" v-model="form.lastname" class="w-full">
                                <div  class="text-red-600" v-if="form.invalid('lastname')">{{ form.errors.lastname }}</div>
                            </div>


                        </div>

                        <div class="flex space-x-2">
                            <div class="flex flex-col flex-1">
                                <label for="">Employee #</label>
                                <input @change="form.validate('no')" type="text" placeholder="employee number" v-model="form.no">
                                <div  class="text-red-600" v-if="form.errors.no">{{ form.errors.no }}</div>

                            </div>

                            <div class="flex flex-col flex-1">
                                <label for="">Job title</label>
                                <input @change="form.validate('job_title')" type="text" placeholder="job title" v-model="form.job_title">
                                <div  class="text-red-600" v-if="form.invalid('job_title')">{{ form.errors.job_title }}</div>
                            </div>
                        </div>
                        <div class="flex space-x-2">
                            <div class="flex flex-col flex-1">
                                <label for="">Department</label>
                                <input @change="form.validate('department')" type="text" placeholder="department" v-model="form.department">
                                <div  class="text-red-600" v-if="form.invalid('department')">{{ form.errors.department }}</div>
                            </div>

                            <div class="flex flex-col flex-1">
                                <label for="">Email</label>
                                <input @change="form.validate('email')" type="text" placeholder="email" v-model="form.email">
                                <div class="text-red-600" v-if="form.invalid('email')">{{ form.errors.email }}</div>
                            </div>

                            <div class="flex flex-col flex-1">
                                <label for="">Address</label>
                                <input type="text" placeholder="address" v-model="form.address">
                                <div  class="text-red-600" v-if="form.invalid('address')">{{ form.errors.address }}</div>
                            </div>


                        </div>


                        <div class="flex justify-end">
                            <button class="px-8 py-2 font-semibold text-gray-50 rounded-md bg-blue-500">Create Employee</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
