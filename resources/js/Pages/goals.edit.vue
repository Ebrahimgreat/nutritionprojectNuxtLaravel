<script setup>

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";


const props=defineProps({
    goal:Array,
})
</script>


<template>
<authenticated-layout>



<tr v-for="(goals,index) in goal">

    <select v-model="goal.checkDay">
        <option> Sunday</option>
        <option> Monday</option>
    </select>

</tr>



</authenticated-layout>
</template>

<style scoped>

</style>
