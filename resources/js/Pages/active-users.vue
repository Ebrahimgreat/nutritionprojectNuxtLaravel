<script setup>

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

const props=defineProps({
    users:Array
})

</script>

<template>


    <authenticated-layout>
    Hello
    <div v-for="user in users">
        {{user.name}}
    </div>

    </authenticated-layout>

</template>

<style scoped>

</style>
