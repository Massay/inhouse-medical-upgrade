<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link, useForm } from '@inertiajs/vue3';


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

let selectedRelative = null


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

        selectedEmployee = props.employees.find((item) => item.id == employee_id)
        form.relative_id = null //
    }
)


watch(
    () => form.visit_type_id, // use a getter like this
    () => {
        selectedRelative = null
        // selectedEmployee = props.employees.find((item) => item.id == employee_id)
        // form.relative_id = null //
    }
)


watch(
    () => form.relative_id, // use a getter like this
    (relative_id) => {
        selectedRelative = selectedEmployee.relatives.find((item) => item.id == relative_id)
    }
)


// const patientName = computed( () => {
//      return (form.visit_type_id == 1 ) ? (selectedEmployee)?selectedEmployee.firstname + ' '+ selectedEmployee.middlename +' ' + selectedEmployee.lastname  : '' : (selectedRelative) ? selectedRelative.name : ''
// })


//form.relative_id
function submit(){
    form
    .transform((data)=>({
           ...data,
          policy_id: (currentTypePolicy) ? currentTypePolicy.id : null,
          company_amount: companyAmount,
          employee_amount: employeeAmount,
          is_employee_visit: (form.visit_type_id == 1) ? 1 : 0,
          patient_name: (form.visit_type_id == 1) ? ((selectedEmployee) ? selectedEmployee.firstname + ' ' + ( (selectedEmployee.middlename) ? selectedEmployee.middlename : '' ) + ' '+ selectedEmployee.lastname : ''  ): (selectedRelative) ? selectedRelative.name : ''

    }))
    .post(route('visits.store'))
}

</script>

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

                                <select name="" id="" class="w-full" v-model="form.clinic_id">
                                    <option value="null" disabled>Select a Clinic</option>

                                    <option :value="clinic.id" v-for="(clinic, index) in clinics" :key="index">
                                        {{ clinic.name }}
                                    </option>
                                </select>
                            </div>
                            <div class="flex-1">
                                <input class="w-full" type="date" placeholder="date" v-model="form.date">
                            </div>
                        </div>
                        <div class="flex">
                            <select name="" id="" class="w-full" v-model="form.employee_id">
                                <option value="null" disabled>Select Employee</option>

                                <option :value="employee.id" v-for="(employee, index) in employees" :key="index">
                                    {{ employee.firstname }} {{ employee.middlename }} {{ employee.lastname }} - {{
                                        employee.no
                                    }}
                                </option>
                            </select>
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
                            <button class="bg-slate-800 text-gray-50 font-semibold px-8 py-3 rounded-2xl" type="submit">Add Patient Record</button>
                        </div>
                    </form>
                </div>

                <div>
                    <h1 class="text-center font-semibold">Display Data</h1>
                    <!-- {{  selectedType  }} -->
                    {{  errors  }}

                    <div v-if="selectedType">
                        Treatment Type: <span class="capitalize font-semibold">{{ selectedType.name }}</span>
                    </div>

                    <div v-if="selectedType" class="flex space-x-2">
                        <span>Max Amount:</span> <span class="font-semibold">{{ selectedType.max_credit_limit }}</span>
                        <span v-if="selectedType.perPerson">Per Person</span>
                        <span v-else>Per Family</span>
                    </div>
                    <div v-if="currentTypePolicy">
                        <span>Policy Type:</span> <span class="font-semibold">{{ currentTypePolicy.name }}</span>
                    </div>
                    <h1>Amount: <span class="font-semibold">{{ form.amount }}</span></h1>
                    <h1>Company Amount: <span class="font-semibold">{{ companyAmount }}</span></h1>
                    <h1>Employee Amount: <span class="font-semibold">{{ employeeAmount }}</span></h1>

                    <div v-if="selectedEmployee">
                        {{  selectedEmployee.firstname  }} {{  selectedEmployee.middlename  }} {{  selectedEmployee.lastname  }}
                    </div>

                    <div v-if="selectedRelative">
                            <span>{{ selectedRelative.name  }}</span>
                    </div>



                </div>
            </div>
        </div>
    </AppLayout>
</template>
