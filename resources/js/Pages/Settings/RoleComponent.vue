<template>
    <div class="flex justify-between items-center">
        <span class="font-extrabold">{{ permission.name }}</span>
        <div class="flex space-x-2">
            <Link as="button" @click="addItem" v-if="type == 'add'">Add</Link>
            <Link as="button" @click="deleteItem" v-if="type == 'delete'">Remove</Link>
        </div>
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3';
defineProps({
    permission: Object,
    type: String
})

function deleteItem() {
    router.put('',{

    })
    router.reload();
}


function addItem() {
    router.reload();
}
</script>
