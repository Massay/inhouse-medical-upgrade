<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link, useForm } from '@inertiajs/vue3';


defineProps({
    policies: {
        type: Array
    },
    errors: Object
})


const form = useForm({
    name: '',
    max_credit_limit: null,
    start_date: null,
    end_date: null,
    policy_id: null,
    perPerson: false
})

</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>

            <div class="flex items-center">
                <Link :href="route('settings.index')">
                Settings
                </Link>

                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                </svg>
                <Link :href="route('settings.treatment.config')">
                <h2>Treatment Config</h2>
                </Link>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                </svg>
                <h2 class="font-semibold leading-tight">Create</h2>
            </div>

        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                    <form @submit.prevent="form.post(route('settings.treatment.store'))" class="w-full flex flex-col space-y-4">
                        <div>
                            <input type="text" placeholder="Name" class="w-full" v-model="form.name">
                            <div v-if="errors.name">
                               {{  errors.name }}
                            </div>
                        </div>
                        <div>
                            <input type="number" min="0" max="99999999999" placeholder="Max Amount" class="w-full"
                                v-model="form.max_credit_limit">
                                <div v-if="errors.max_credit_limit">
                               {{  errors.max_credit_limit }}
                            </div>
                        </div>
                        <div>
                            <select name="" id="" class="w-full" v-model="form.policy_id">
                                <option value="null" disabled>Select Policy</option>
                                <option :value="policy.id" v-for="(policy, index) in policies" :key="index">
                                    {{ policy.name }}
                                </option>
                            </select>
                            <div v-if="errors.policy_id">
                               {{  errors.policy_id }}
                            </div>
                        </div>

                        <div>
                            <input type="date" placeholder="Max Amount" class="w-full" v-model="form.start_date">
                            <div v-if="errors.start_date">
                               {{  errors.start_date }}
                            </div>
                        </div>

                        <div>
                            <input type="date" placeholder="Max Amount" class="w-full" v-model="form.end_date">
                            <div v-if="errors.end_date">
                               {{  errors.end_date }}
                            </div>
                        </div>

                        <div class="w-full flex justify-end py-2">
                            <label for="isPersonal">
                                <div class="flex items-center space-x-3">
                                    <div>
                                        <span v-if="form.max_credit_limit" class="font-semibold">
                                        {{ form.max_credit_limit }}
                                    </span>

                                    Amount is <span v-if="form.perPerson">Per Person</span> <span v-else>Per Family</span>
                                    </div>
                                    <input type="checkbox" id="isPersonal" v-model="form.perPerson">
                                </div>

                            </label>
                        </div>
                        <div>
                            <button class="border bg-blue-700 text-gray-50 rounded-md w-full font-bold p-3">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
