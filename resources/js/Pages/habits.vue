<script setup>
import {Calendar, DatePicker, setupCalendar} from 'v-calendar';
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import NavLink from "@/Components/NavLink.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import {router} from "@inertiajs/vue3";
import HabitBar from "@/Components/habitBar.vue";
import {isDate} from "rollup-plugin-node-builtins/src/es6/util.js";
import {ref} from "vue";

// Use calendar defaults (optional)


const props=defineProps({
    date:isDate,
   weightTrackingInformation:Array,
    nutritionInformation:Array,




})

const attrs=ref([
    {
        dates: props.weightTrackingInformation.map(function(item){
            return new Date(item.date)
        }),
        popover: {
            label:props.weightTrackingInformation.map(function(item){
             return "ScaleWeight "+ item.scaleWeight+ " Trend Weight"+ item.trendWeight
            })



        },
        highlight:{
            color:'purple',
        }

    },



    {
        dates: props.nutritionInformation.map(function(item){
            return new Date(item.date)
        }),
        popover: {
            label:props.nutritionInformation.map(function(item){
                return "Protein " +item.protein+ " Carbs "+item.fats
            })



        },
        highlight:{
            color:'red',
        }



    },
    {
    }



])

const date=ref(props.date)



function back()
{
    router.get('/dashboard')
}
</script>

<template>
    <authenticated-layout>






        <PrimaryButton @click="back"> Back</PrimaryButton>

        <habit-bar></habit-bar>

        <DatePicker expanded v-model="date" :attributes="attrs"> </DatePicker>









    </authenticated-layout>




</template>

<style scoped>

</style>
