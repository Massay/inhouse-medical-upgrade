<template>
    <span>
        {{  new Intl.NumberFormat('en-GB', { maximumSignificantDigits: 3,  style: 'currency', currency: 'GMD' }).format(value)  }}
    </span>
</template>


<script setup>

defineProps({
    value: {
         type: Number,
         required: true
    }
})
</script>
