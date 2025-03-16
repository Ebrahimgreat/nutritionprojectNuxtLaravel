<script setup>

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {reactive} from "vue";
import {router} from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import messages from "rollup-plugin-node-builtins/src/es6/zlib-lib/messages.js";
import InputNumber from 'primevue/inputnumber';
import InputLabel from "@/Components/InputLabel.vue";
import {Calendar, DatePicker} from "v-calendar";




const date=new Date()
const form=reactive({
    date: date,
    ScaleWeight:65,


})

function back()
{
    router.get('/weight')
}
 function dispatch(){
    router.post('/weight.store',form)





}

</script>

<template>

<AuthenticatedLayout>


    <div v-if="$page.props.flash.message">
        {{ $page.props.flash.message }}

    </div>



    <PrimaryButton @click="back">
        Back
    </PrimaryButton>



    <form @submit.prevent="dispatch">



        <input type="date" v-model="form.date" >



        <InputLabel> Scale Weight</InputLabel>
        <input type="text" min="35" max="120"  v-model="form.ScaleWeight">
        <br>
        <br>
        <PrimaryButton> Submit</PrimaryButton>


    </form>

</AuthenticatedLayout>


</template>

<style scoped>

</style>
