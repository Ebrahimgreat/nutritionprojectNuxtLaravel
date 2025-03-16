<script setup>

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { reactive } from 'vue'
import {router} from "@inertiajs/vue3";
import {isDate} from "rollup-plugin-node-builtins/src/es6/util.js";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";



const props=defineProps({

    foods:Array,
    date:String,


});


const form = reactive({
    Protein:null,
    Carbs:null,
    Fat:null,
    Calories:null,
    date:null,
    food_name:null,
    foodId:null,
    quantity:null,

})


var date=props.date
let indicator=2
function submit(){
    router.post('/nutrition.show/storeCustomFood',form)
}
function back()
{
    router.get('/nutrition')

}






</script>



<template>
    <authenticated-layout>


        <PrimaryButton @click="back">
            Back
        </PrimaryButton>





        <form @submit.prevent="submit">
            <input-label> Food Name</input-label>
            <input type="text" v-model="form.food_name">
            <br>
            <input-label> Default Serving</input-label>
            <input type="number" v-model="form.quantity">


            <input-label>Default Protein</input-label>
            <input type="text" id="Protein" v-model="form.Protein"/>


           <input-label>  Default Carbs </input-label> <input type="text"  v-model="form.Carbs" name="Carbs">

            <input-label>
                Default Calories
            </input-label>
             <input type="text" v-model="form.Calories">


            <input-label>Default Fats</input-label>

            <input type="text" v-model="form.Fat">
            <input-label>
            Date
            </input-label>
            <input type="datetime-local" v-model="form.date">
            <br>
            <br>





           <PrimaryButton> Submit</PrimaryButton>
        </form>





    </authenticated-layout>
</template>

<style scoped>

</style>
