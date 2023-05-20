<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import BarChart from '../Components/Charts/BarChart.vue';
import PieChart from '@/Components/Charts/PieChart.vue'
import LineChart from '@/Components/Charts/LineChart.vue'
import { ref, watch } from 'vue'
import { router } from '@inertiajs/vue3'
const props = defineProps({
    chart_data: Array,
    filters: Object
})

const reportType = ref(props.filters.reportType || 1);


watch(reportType, (reportType, prevReportType) => {
    console.log('reportType')
    router.get('/dashboard', {
        reportType: reportType
    })
})


// watch(
//     () => reportType,
//     (reportType) => {

//     })


</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-[90%]  mx-auto sm:px-6 lg:px-8">

                <div class="flex justify-end my-4">
                    <select name="" id="" class="rounded-md" v-model="reportType">
                        <option value="null" disabled>Report Type</option>
                        <option :value="item.id"
                            v-for="(item) in [{ id: 1, name: 'Monthly Spending' }, { id: 2, name: 'Yearly Spending By Clinic' }]">
                            {{ item.name }}
                        </option>
                    </select>
                </div>



                <div class="max-w-7xl mx-auto">

                    <div class="grid grid-cols-1 sm:grid-cols-2  md:grid-cols-2 gap-4">

                        <div class="w-[80%]">
                            <PieChart :data="chart_data.chart_data" />
                        </div>
                        <div class="flex flex-col">
                            <div>
                                <BarChart :data="chart_data.chart_data" />
                            </div>

                            <div>
                                <LineChart :data="chart_data.chart_data" />
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
