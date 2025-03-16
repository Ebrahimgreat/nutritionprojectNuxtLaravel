<script setup>

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {reactive} from "vue";
import {router} from "@inertiajs/vue3";
import TextInput from "@/Components/TextInput.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";



const form= reactive({
    ScaleWeight:null,
    date:null,

})
defineProps({
    weight:Array
})




function updateWeight(weight)
{
    router.post('/weight/update',weight)


}

function cancel()
{
    router.get('/weight');
}

</script>


<template>
    <authenticated-layout>






        Weight <TextInput v-model="weight.ScaleWeight"></TextInput>
        <br>
        Date
        <br><input type="date" :value="weight.date">


        <br>
        <PrimaryButton @click="cancel"> Cancel</PrimaryButton>
        <PrimaryButton @click="updateWeight(weight)"> Update</PrimaryButton>




</authenticated-layout>



</template>

<style scoped>

</style>
