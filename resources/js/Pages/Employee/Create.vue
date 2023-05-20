<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <AppLayout title="Create Employees">
        <template #header>
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Employees
                </h2>
                <Link :href="route('employees.index')" class="border px-8 py-2 flex items-center">

                <span>List of  Employees</span></Link>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                        <form action="">
                                <input type="text" placeholder="name">
                                <input type="text" placeholder="name">
                                <input type="text" placeholder="name">
                                <input type="text" placeholder="name">
                                <input type="text" placeholder="name">
                                <input type="text" placeholder="name">
                                <input type="text" placeholder="name">
                                <input type="text" placeholder="name">
                                <input type="text" placeholder="name">
                                <input type="text" placeholder="name">

                                <div>
                                        <button>Cerate Employee</button>
                                </div>
                        </form>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
