<script setup>
import {Calendar, DatePicker, setupCalendar} from 'v-calendar';
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import NavLink from "@/Components/NavLink.vue";
import {router} from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import HabitBar from "@/Components/habitBar.vue";
import HabitComponent from "@/Components/habitComponent.vue";
import {isDate} from "rollup-plugin-node-builtins/src/es6/util.js";

// Use calendar defaults (optional)



const props=defineProps({
    date:isDate,
    nutritionInformation:Array,
    url:String,

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



       <habit-component :date="props.date" :dates-tracked="nutritionInformation" :url="props.url">


       </habit-component>




    </authenticated-layout>
</template>
