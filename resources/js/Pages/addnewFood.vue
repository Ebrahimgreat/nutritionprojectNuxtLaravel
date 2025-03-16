<script setup>

import TextInput from "@/Components/TextInput.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {reactive, ref, watch} from "vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import {isDate} from "rollup-plugin-node-builtins/src/es6/util.js";
import InputLabel from "@/Components/InputLabel.vue";

import InputText from 'primevue/inputtext';


const indicator=1


const props=defineProps({
    date:String,
    path:String,
    time:String,

})

const date=props.date
const time=props.time


function back()
{
    router.get('/nutrition')
}
</script>

<template>

<authenticated-layout>



    <h1> Add Food</h1>


   <InputLabel>{{time}}
   </InputLabel>


    <PrimaryButton @click="back"> Back</PrimaryButton>
    <InputText v-model="term" @keyup="search"></InputText>



        <div v-if="$page.props.databaseFoods">
            <div v-for="foods in $page.props.databaseFoods">


            <button @click="submit(foods,date,1,time)">




              <Label style="color:black;">{{foods.food_name}}

                {{foods.description}}
              </Label>


                </button>

            </div>
        </div>



            <div v-if="submit">
                <form>

                </form>
            </div>







</authenticated-layout>

</template>

<style scoped>

</style>

<script>
import {router} from "@inertiajs/vue3";
import {throttle} from "alpinejs/src/utils/throttle.js";

export default{
    data()
    {
        return{
            term:''

        }
    },
    props:{
        databaseFoods:Object,


    },
    methods:{
        search:throttle(function()

        {
            this.$inertia.get(`/nutrition.show/${this.date}/addnewFood`,{term:this.term},{preserveState:true}
            );


        },500),
        submit(food,date,indicator,time){
            var quantity=prompt('Enter quantity')
            router.post('/nutrition.store',[food,date,quantity,indicator,time])

        }
}
};


</script>
