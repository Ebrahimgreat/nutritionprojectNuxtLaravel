<script setup>




import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";


import {reactive, ref, watch} from 'vue';
import {router} from "@inertiajs/vue3";
import DangerButton from "@/Components/DangerButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import {isNumber} from "chart.js/helpers";
import {Calendar, DatePicker} from "v-calendar";
import {isDate} from "rollup-plugin-node-builtins/src/es6/util.js";
import {data} from "autoprefixer";
import HabitBar from "@/Components/habitBar.vue";
import HabitComponent from "@/Components/habitComponent.vue";




const props=defineProps({

    date:isDate,
    weightInformation:Array,


})

 function back()
{
    router.get('/habits')


}






</script>

<template>

    <authenticated-layout>




        <PrimaryButton @click="back">
            Back
        </PrimaryButton>

        <habit-bar> </habit-bar>



        <habit-component :date="props.date" :dates-tracked="weightInformation" :url="props.url">

        </habit-component>





    </authenticated-layout>



</template>

<style scoped>

</style>
