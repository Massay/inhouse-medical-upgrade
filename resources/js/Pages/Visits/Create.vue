<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link, useForm } from '@inertiajs/vue3';
import VueMultiselect from 'vue-multiselect'


import { ref, watch, computed } from 'vue'




const props = defineProps({
    clinics: {
        type: Array,
        required: true
    },
    employees: {
        type: Array,
        required: true
    },
    treatment_types: {
        type: Array,
        required: true
    },
    errors: Object
})


const treatment_type = ref(null)

const form = useForm({
    clinic_id: null,
    date: null,
    employee_id: null,
    invoice_no: null,
    amount: null,
    visit_type_id: null,
    relative_id: null
})

let visit_types = [
    {
        id: 1,
        name: 'Policy Holder'
    },
    {
        id: 2,
        name: 'Relative'
    }
]
let selectedType = null
let currentTypePolicy = null
let companyAmount = 0
let employeeAmount = 0
let selectedEmployee = null;




let selected = null;


const options = ['list', 'of', 'options']

let selectedRelative = null;


watch(treatment_type, ((newVal, oldVal) => {
    console.log("new Value", newVal)
    console.log("old Value", oldVal)
    selectedType = props.treatment_types.find((item) => item.id == newVal)

    currentTypePolicy = selectedType.policy
    console.log("selectedType: ", selectedType)

    if (currentTypePolicy != null) {
        if (currentTypePolicy.name.includes('90')) {
            companyAmount = form.amount * 0.9
            employeeAmount = form.amount * 0.1
        } else {
            companyAmount = form.amount
            employeeAmount = 0
        }
    }
}))



watch(
    () => form.amount, // use a getter like this
    (amount) => {
        console.log('amount changed', amount);
        console.log('currentTypePolicy', currentTypePolicy)
        if (currentTypePolicy != null) {
            if (currentTypePolicy.name.includes('90')) {
                companyAmount = amount * 0.9
                employeeAmount = amount * 0.1
            } else {
                companyAmount = amount
                employeeAmount = 0
            }
        }

    }
)



watch(
    () => form.employee_id, // use a getter like this
    (employee_id) => {

        selectedEmployee = props.employees.find((item) => item.id == employee_id.id)
        form.relative_id = null //
    }
)


watch(
    () => form.visit_type_id, // use a getter like this
    () => {
        selectedRelative = null
        form.relative_id = null
    }
)


watch(
    () => form.relative_id, // use a getter like this
    (relative_id) => {
        selectedRelative = selectedEmployee.relatives.find((item) => item.id == relative_id)
    }
)


//form.relative_id
function submit() {
    form
        .transform((data) => ({
            ...data,
            policy_id: (currentTypePolicy) ? currentTypePolicy.id : null,
            employee_id: form.employee_id.id,
            clinic_id: form.clinic_id.id,
            company_amount: companyAmount,
            employee_amount: employeeAmount,
            is_employee_visit: (form.visit_type_id == 1) ? 1 : 0,
            treatment_type_id: treatment_type.value,
            exceeded_amount: (selectedType) ? (form.amount > selectedType.max_credit_limit) ? form.amount - selectedType.max_credit_limit : null : null,
            patient_name: (form.visit_type_id == 1) ? ((selectedEmployee) ? selectedEmployee.firstname + ' ' + ((selectedEmployee.middlename) ? selectedEmployee.middlename : '') + ' ' + selectedEmployee.lastname : '') : (selectedRelative) ? selectedRelative.name : ''

        }))
        .post(route('visits.store'))
}

</script>

<style src="vue-multiselect/dist/vue-multiselect.css"></style>

<template>
    <AppLayout title="Create Visits">
        <template #header>

            <div class="flex justify-between">
                <div class="flex items-center">
                    <Link :href="route('visits.index')">
                    Visits
                    </Link>

                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                    </svg>


                    <h2 class="font-semibold leading-tight">Create</h2>
                </div>
                <!-- <Link as="button" :href="route('visits.create')">Add Visit Entry</Link> -->
            </div>

        </template>

        <div class="py-12 px-4">
            <div class="grid grid-cols-2 gap-2">
                <div class="">
                    {{ errors }}





                    <form @submit.prevent="submit" class="flex flex-col space-y-2">





                        <div class="flex space-x-2">
                            <div class="flex-1">

                                <!-- <select name="" id="" class="w-full" v-model="form.clinic_id">
                                    <option value="null" disabled>Select a Clinic</option>

                                    <option :value="clinic.id" v-for="(clinic, index) in clinics" :key="index">
                                        {{ clinic.name }}
                                    </option>
                                </select> -->
                                <VueMultiselect v-model="form.clinic_id" label="name" track-by="id"
                                placeholder="Select a Clinic" :options="clinics"
                                class="border border-gray-600 rounded-md">
                            </VueMultiselect>
                            </div>
                            <div class="flex-1">
                                <input class="w-full" type="date" placeholder="date" v-model="form.date">
                            </div>
                        </div>
                        <div class="flex">
                            <!-- <select name="" id="" class="w-full" v-model="form.employee_id">
                                <option value="null" disabled>Select Employee</option>

                                <option :value="employee.id" v-for="(employee, index) in employees" :key="index">
                                    {{ employee.firstname }} {{ employee.middlename }} {{ employee.lastname }} - {{
                                        employee.no
                                    }}
                                </option>
                            </select> -->

                            <VueMultiselect v-model="form.employee_id" label="full_name" track-by="id"
                                placeholder="Select Employee" :options="employees"
                                class="border border-gray-600 rounded-md">
                            </VueMultiselect>
                        </div>

                        <div class="flex space-x-2">
                            <div class="flex-1">
                                <input class="w-full" type="text" placeholder="Invoice #" v-model="form.invoice_no">
                            </div>
                            <div class="flex-1">
                                <input class="w-full" type="number" min="0" placeholder="Amount for Treatment"
                                    v-model="form.amount">
                            </div>
                        </div>

                        <div class="flex">
                            <select name="" id="" class="w-full capitalize" v-model="treatment_type">
                                <option value="null" disabled>Select a Treatment Type</option>

                                <option :value="treatment_type.id" v-for="(treatment_type, index) in treatment_types"
                                    :key="index">
                                    {{ treatment_type.name }}
                                </option>
                            </select>
                        </div>

                        <div class="flex py-2 items-center space-x-4">
                            <select name="" id="" v-model="form.visit_type_id" class="w-full">
                                <option value="null" disabled>Who Made the Visit</option>
                                <option :value="visitType.id" v-for="(visitType, index) in visit_types" :key="index">
                                    {{ visitType.name }}
                                </option>
                            </select>
                        </div>

                        <div class="flex py-2 items-center space-x-4" v-if="selectedEmployee && form.visit_type_id == 2">
                            <select name="" id="" v-model="form.relative_id" class="w-full">
                                <option value="null" disabled>Select Relative</option>
                                <option :value="relative.id" v-for="(relative, index) in selectedEmployee.relatives"
                                    :key="index">
                                    {{ relative.name }}
                                </option>
                            </select>




                        </div>

                        <div class="flex justify-end">
                            <!-- <Link  method="post"  >Add
                            Patient Record</Link> -->
                            <button :disabled="form.processing"
                                class="bg-slate-800 text-gray-50 font-semibold px-8 py-3 rounded-2xl" type="submit">Add
                                Patient Record</button>
                        </div>
                    </form>
                </div>

                <div class="text-xl rounded-xl p-2">
                    <h1 class="text-center font-semibold">Display Data</h1>
                    <span v-if="selectedType && (form.amount > selectedType.max_credit_limit)"
                        class="flex flex-col items-center justify-center border my-2 border-red-600 bg-red-100 p-2 rounded-md">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                            class="w-6 h-6 text-red-700">
                            <path fill-rule="evenodd"
                                d="M9.401 3.003c1.155-2 4.043-2 5.197 0l7.355 12.748c1.154 2-.29 4.5-2.599 4.5H4.645c-2.309 0-3.752-2.5-2.598-4.5L9.4 3.003zM12 8.25a.75.75 0 01.75.75v3.75a.75.75 0 01-1.5 0V9a.75.75 0 01.75-.75zm0 8.25a.75.75 0 100-1.5.75.75 0 000 1.5z"
                                clip-rule="evenodd" />
                        </svg>
                        <p class="font-semibold overflow-hidden  w-full  text-gray-800 text-center  ">
                            Amount exceeded by <span class="font-extrabold bg-slate-950 text-gray-50 p-1 ">{{ form.amount -
                                selectedType.max_credit_limit }}</span>
                        </p>
                    </span>

                    <div class="border border-gray-500 rounded-3xl grid grid-cols-2 gap-3 p-4">
                        <div class="border border-gray-500 rounded-3xl grid place-content-center">
                            <div v-if="selectedType" class="flex flex-col items-center justify-center">
                                <img src="/images/svg/admissions.svg" alt="">
                                Treatment Type: <span class="capitalize font-semibold">{{ selectedType.name }}</span>
                            </div>

                        </div>
                        <div class="border border-gray-400 rounded-3xl grid place-content-center">

                            <div v-if="selectedType" class="flex space-x-2 flex-col items-center">
                                <img src="/images/svg/bills.svg" alt="">
                                <span>Max Amount:</span> <span class="font-semibold">{{ selectedType.max_credit_limit
                                }}</span>
                                <span v-if="selectedType.perPerson">Per Person</span>
                                <span v-else>Per Family</span>
                            </div>
                        </div>
                        <div class="border border-gray-300 rounded-3xl grid place-content-center bg-blue-950 py-2">
                            <div v-if="currentTypePolicy"
                                class="flex flex-col text-gray-50 items-center bg-red-800 rounded-xl p-2">
                                <img src="/images/svg/mobile_clinic.svg" class="bg-white rounded-full p-1" alt="">
                                <span>Policy Type:</span> <span class="font-extrabold">{{ currentTypePolicy.name }}</span>
                            </div>
                        </div>
                        <div class="border border-gray-400 rounded-3xl grid place-content-center">
                            <div class="flex flex-col items-center">
                                <img src="/images/svg/money_bag.svg" alt="">
                                <h1>Amount: <span class="font-semibold">{{ form.amount }}</span></h1>

                            </div>

                        </div>
                        <div class="border border-gray-400 rounded-3xl grid place-content-center">

                            <div v-if="selectedEmployee" class="flex flex-col items-center">
                                <img src="/images/svg/admissions.svg" alt="">
                                <span class="font-semibold">{{ selectedEmployee.firstname }} {{ selectedEmployee.middlename
                                }} {{
    selectedEmployee.lastname }}</span>
                            </div>
                        </div>
                        <div v-if="selectedRelative" class="border border-gray-400 rounded-3xl grid place-content-center">
                            <div class="flex flex-col items-center">
                                <img src="/images/svg/outpatient.svg" alt="">
                                <span class="font-semibold">{{ selectedRelative.name }}</span>
                            </div>
                        </div>

                        <div class="col-span-2  rounded-xl p-2 grid grid-cols-2 gap-4">
                            <h1
                                class="font-extrabold p-1 font-mono bg-yellow-200 overflow-hidden flex justify-between items-center">
                                Company Amount <span class="font-semibold bg-slate-700 p-2 text-gray-50">{{ companyAmount
                                }}</span></h1>
                            <h1
                                class="font-extrabold p-1 font-mono overflow-hidden bg-orange-400 flex justify-between items-center">
                                Employee Amount <span class="font-semibold bg-slate-700 p-2 text-gray-50">{{ employeeAmount
                                }}</span></h1>
                        </div>
                    </div>









                </div>
            </div>
        </div>
    </AppLayout>
</template>
