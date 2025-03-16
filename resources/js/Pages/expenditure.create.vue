<script setup>

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import TextInput from "@/Components/TextInput.vue";
import {router} from "@inertiajs/vue3";
import {reactive} from "vue";
import InputLabel from "@/Components/InputLabel.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";





const props=defineProps({
    userProfile:Array,
})
const form=reactive({

    name:null,
    weight:null,
    height:props.userProfile.height,
    sex:props.userProfile.Sex,
    activityLevel:null,
    age:null,
    name:props.name



})
const min=1.0
const max=2.0


function submit(){
    router.post('/storeexpenditure',form)



}

</script>

<template>
    <authenticated-layout>




        <h1> Calculating energy expenditure</h1>

        <form @submit.prevent="submit">

            <label for="Name"> Name</label>
            <br>
            <input id="name" v-model="form.name"/>
            <br>
            <label for="height"> Height</label>
            <br>

            <input id="height" v-model="form.height"/>
            <br>
            <label for="Sex"> Sex</label>
            <br>
            <input id="sex" v-model="form.sex"/>
            <br>
            <label for="weight"> Weight</label>
            <br>
            <InputNumber> Weight</InputNumber>
            <input id="weight" v-model="form.weight"/>
            <br>




            Age: <input id="age" v-model="form.age"/>
            <br>



            <label for="activityLevel">ActivityLevel</label>
            <br>
            <input  type="range" step="0.15"  v-model="form.activityLevel" min="0" max="2"/>



           <SecondaryButton type="submit"> Submit</SecondaryButton>


        </form>
        {{form.activityLevel}}




    </authenticated-layout>
</template>
