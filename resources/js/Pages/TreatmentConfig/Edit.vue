<template>
    <AppLayout title="Dashboard">
        <template #header>
            <div class="flex items-center">
                <Link :href="route('settings.treatment.config')" class="text-gray-800 ">
                    Treatment Config
                </Link>
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                        <path fill-rule="evenodd"
                            d="M16.28 11.47a.75.75 0 010 1.06l-7.5 7.5a.75.75 0 01-1.06-1.06L14.69 12 7.72 5.03a.75.75 0 011.06-1.06l7.5 7.5z"
                            clip-rule="evenodd" />
                    </svg>
                </span>
                <h2>Edit </h2>
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                        <path fill-rule="evenodd"
                            d="M16.28 11.47a.75.75 0 010 1.06l-7.5 7.5a.75.75 0 01-1.06-1.06L14.69 12 7.72 5.03a.75.75 0 011.06-1.06l7.5 7.5z"
                            clip-rule="evenodd" />
                    </svg>
                </span>
                <h2 class="font-semibold leading-tight">{{ type.name }}</h2>
            </div>

        </template>

        <div class="py-12">
            <div class="max-w-[40%] mx-auto">
                <form @submit.prevent="form.put(route('settings.treatment.update', type))" class="w-full flex flex-col space-y-4">
                    <div>
                        <input type="text" placeholder="Name" class="w-full" v-model="form.name">
                        <div v-if="errors.name">
                            {{ errors.name }}
                        </div>
                    </div>
                    <div>
                        <input type="number" min="0" max="99999999999" placeholder="Max Amount" class="w-full"
                            v-model="form.max_credit_limit">
                        <div v-if="errors.max_credit_limit">
                            {{ errors.max_credit_limit }}
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
                            {{ errors.policy_id }}
                        </div>
                    </div>

                    <div>
                        <input type="date" placeholder="Max Amount" class="w-full" v-model="form.start_date">
                        <div v-if="errors.start_date">
                            {{ errors.start_date }}
                        </div>
                    </div>

                    <div>
                        <input type="date" placeholder="Max Amount" class="w-full" v-model="form.end_date">
                        <div v-if="errors.end_date">
                            {{ errors.end_date }}
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
                        <button class="border bg-blue-700 text-gray-50 rounded-md w-full font-bold p-3">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </AppLayout>
</template>


<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link, useForm } from '@inertiajs/vue3';
const props = defineProps({
    type: Object,
    policies: {
        type: Array
    },
    errors: Object
})

const form = useForm(props.type)

</script>
