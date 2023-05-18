<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import DetailReportCard from './DetailReportCard.vue';
import moment from 'moment';
defineProps({
    type: Object,
    data: Object
})

</script>

<template>
    <AppLayout title="Reports">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Treatment Type Report
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div>
                    <h1 class="uppercase font-extrabold"> {{ type.name }}</h1>
                    <h1 class="text-lg"> <span>Max Amount: <span v-if="type.perPerson">Per Person </span> <span v-else>Per Family </span>  </span>
                      <span class="font-extrabold">
                        {{ new Intl.NumberFormat('en-IN', {
                        maximumSignificantDigits: 3, style: 'currency', currency: 'GMD'
                    }).format(type.max_credit_limit) }}
                      </span>

                    </h1>
                    <h1> <span class="uppercase">policy: </span><span class="font-extrabold"> {{ type.policy.name }}</span></h1>
                </div>
                <div class="overflow-hidden shadow-xl sm:rounded-lg">


                    <div v-for="(item, index) in data" :key="index" class="w-full p-2">
                        <h1 class="font-semibold text-center">Staff ID: {{ index }}</h1>
                        <div class="w-full p-3">
                            <DetailReportCard :data="item" :key="index" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
