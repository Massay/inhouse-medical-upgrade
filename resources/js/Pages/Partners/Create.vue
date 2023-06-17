<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link, useForm } from '@inertiajs/vue3';
defineProps({
    clinics: {
        type: Object,
        required: true
    }
})


const form = useForm({
     name: null,
     address: null,
     contact: null
})

</script>

<template>
    <AppLayout title="Partners">
        <template #header>
            <div class="flex justify-between">
                <h2 class="font-bold text-xl text-gray-800 leading-tight">
                    Create Partner
                </h2>
                <Link :href="route('partners.index')" class="px-8 py-2  font-extrabold">List Partner</Link>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                    <form @submit.prevent=" form.post(route('partners.store')) " class="max-w-6xl mx-auto p-4 flex flex-col space-y-2">
                        <div class="w-full">
                            <label for="">Name</label>
                            <input v-model="form.name" type="text" placeholder="Name" class="w-full">
                        </div>

                        <div class="w-full">
                            <label for="">Address</label>
                            <input v-model="form.address" type="text" placeholder="Address" class="w-full">
                        </div>

                        <div class="w-full">
                            <label for="">Contact</label>
                            <input v-model="form.contact" type="text" placeholder="Contact" class="w-full">
                        </div>
                        <div class="flex justify-end">
                                <button type="submit" class="px-6 py-2 border font-extrabold hover:bg-slate-900 hover:text-gray-50">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
