<script setup>
import {computed} from 'vue'
import moment from 'moment';
const props = defineProps({
    data: Array
})

const totalAMount =  computed(() => {
     return  _.sumBy(props.data, function(item) { return item.amount})
})

const totalCompanyAmount =  computed(() => {
     return  _.sumBy(props.data, function(item) { return item.company_amount})
})


const totalEmployeeAmount =  computed(() => {
     return  _.sumBy(props.data, function(item) { return item.employee_amount})
})
</script>

<template>
    <div class="p-2">

        <table class="w-full">
            <thead class="border text-center bg-blue-900 text-gray-50">
                <th class="border p-2">Date</th>
                <th class="border">Patient Name</th>
                <th class="border">Clinic</th>
                <th class="border">Amount</th>
                <th class="border">Patient fee</th>
                <th class="border">Company fee</th>
            </thead>
            <tbody>
                <tr v-for="(row, innerKey) in data" :key="innerKey" class="text-center">
                    <td class="border p-2">{{ moment(row.date ).format("DD/MMMM/YYYY") }}</td>
                    <td class="border"> {{ row.patient_name }}</td>
                    <td class="border"><span class="bg-yellow-400 rounded-md p-1 font-extrabold">  {{ row.clinic.name }} </span></td>
                    <td class="border"> {{  new Intl.NumberFormat('en-IN', { maximumSignificantDigits: 3, style: 'currency', currency: 'GMD' }).format(row.amount)  }}</td>
                    <td class="border"> {{  new Intl.NumberFormat('en-IN', { maximumSignificantDigits: 3, style: 'currency', currency: 'GMD' }).format(row.employee_amount)  }}</td>
                    <td class="border"> {{  new Intl.NumberFormat('en-IN', { maximumSignificantDigits: 3, style: 'currency', currency: 'GMD' }).format(row.company_amount)  }}</td>
                </tr>
                <tr>
                    <td colspan="3" class="text-left border p-2 text-gray-50">Total</td>
                    <td class="border text-center  bg-blue-400 text-gray-50">
                        <span class="font-extrabold">{{  new Intl.NumberFormat('en-IN', { maximumSignificantDigits: 3, style: 'currency', currency: 'GMD' }).format(totalAMount)  }}</span>
                    </td>
                    <td class="border text-center bg-gray-500 text-white">
                        <span class="font-extrabold">{{  new Intl.NumberFormat('en-IN', { maximumSignificantDigits: 3, style: 'currency', currency: 'GMD' }).format(totalEmployeeAmount)  }}</span>
                    </td>
                    <td class="border text-center bg-green-500 text-gray-50">
                        <span class="font-extrabold">{{  new Intl.NumberFormat('en-IN', { maximumSignificantDigits: 3, style: 'currency', currency: 'GMD' }).format(totalCompanyAmount)  }}</span>
                    </td>
                </tr>
            </tbody>
        </table>

    </div>
</template>
