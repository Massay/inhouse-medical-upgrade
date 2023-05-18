<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import BarChart from '../Components/Charts/BarChart.vue';
import PieChart from '@/Components/Charts/PieChart.vue'
import LineChart from '@/Components/Charts/LineChart.vue'

defineProps({
    chart_data: Array
})
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
                    <select name="" id="" class="rounded-md">
                        <option value="null" disabled>Report Type</option>
                        <option value=""
                            v-for="(item) in [{ id: 1, name: 'Monthly Report' }, { id: 2, name: 'Yearly Report' }]">
                            {{ item.name }}
                        </option>
                    </select>
                </div>



                <div class="max-w-7xl mx-auto">


                        <div>
                                

                        </div>



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
