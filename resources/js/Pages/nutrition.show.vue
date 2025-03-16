<script setup>

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {isDate} from "rollup-plugin-node-builtins/src/es6/util.js";
import {router} from "@inertiajs/vue3";
import {Calendar, DatePicker} from "v-calendar";
import {onMounted, onUnmounted, reactive, ref, render, watch} from "vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import {isNumber} from "chart.js/helpers";
import InputLabel from "@/Components/InputLabel.vue";
import DangerButton from "@/Components/DangerButton.vue";
import TextInput from "@/Components/TextInput.vue";
import DataTable from "primevue/datatable";
import Column from "primevue/column";

import Button from "primevue/button";


const props=defineProps({
    nutrients: Object,
    allNutrients:Array,
    previous:isDate,
    next:isDate,
    dater:String,
    foods:Array,
    value:String,
    pathDate:String,
    targetCalories:isNumber,
    targetProtein:isNumber,
    targetCarbs:isNumber,
    timeSlots:Array






});




const newDate=ref(props.nutrients.date)





watch(newDate,(oldValue,newValue)=>{
    if(newValue!=oldValue)
    {

        const formattedOldDate = new Date(oldValue).toISOString().split('T')[0];
        console.log(formattedOldDate);
        // Converts to 'YYYY-MM-DD' format
        router.get(`/nutrition.show/${formattedOldDate}`)



    }

})




function clicker()
{

    router.get('/dashboard');
}



function edit(food)
{
    router.get('/nutrition.show/{date}/edit{id}',food)



}


function select(food)
{
   let quantity=prompt('Enter quantity')

    router.post('/nutrition.store',[food,quantity,props.pathDate])



}


function create(date){
    router.get('/nutrition.create',date)

}

function destroy(nutrient)
{

        router.post('/nutrition.destroy', nutrient)


}


function addFood(time)
{
    router.get(`/nutrition.show/${props.pathDate}/addnewFood`,{time})

}

function quickLog()
{
    router.get(`/nutrition.show/${props.pathDate}/quickLog`)
}



function createFood()
{
    router.get(`/nutrition.show/${props.pathDate}/createFood`)

}

function yourFoods()
{
    router.get('/nutrition/yourFoods')

}






function dateChange()
{
    console.log('I have been clicked');
    router.get('/dashboard',);
}




function Back()
{
    router.get('/nutrition')
}
function openForm()
{
    router.get(`/nutrition.show/${props.nutrients.date}/addFood`)
}
const query=ref()





</script>






<template>


    <authenticated-layout>



        <PrimaryButton @click="Back"> Back
        </PrimaryButton>




        <DatePicker transparent view="weekly" expanded v-model="newDate">



        </DatePicker>


        <div v-if="$page.props.flash.message">
            {{$page.props.flash.message}}
        </div>


        <DataTable :value="timeSlots">
            <Column header="">
                <template #header>

                   <div class="border px-4 py-2">Total Calories {{nutrients.Calories}}
                   </div>
                    <div class="border px-4 py-2">Total Protein {{nutrients.Protein}}
                    </div>

                    <div class="border px-4 py-2">Total Fats {{nutrients.Carbs}}
                    </div>
                    <Button icon="pi pi-plus" severity="secondary" text @click="addFood(time)"></Button>

                    <PrimaryButton @click="quickLog">Quick Log</PrimaryButton>

                    <PrimaryButton @click="createFood">
                        Create a Food
                    </PrimaryButton>





                </template>
                <template #body="{data}">
                    <SecondaryButton @click="addNewFood(newDate,data.time)">
                        {{data.time}}

                    </SecondaryButton>
                </template>

            </Column>
            <Column header="">
                <template #body="{data,index}">

                    <div v-if="data.Calories!==null">


                        <div v-for="(item,key) in timeSlots[index].food_name">
                            {{item}}

                               {{timeSlots[index].Calories[key]}} Calories
                            {{timeSlots[index].Protein[key]}} Protein
                            {{timeSlots[index].quantity[key]}} grams


                        </div>
                        Total  {{timeSlots[index].totalCalories}} kcal
                        {{timeSlots[index].totalProtein}} P
                        {{timeSlots[index].totalCarbs}} C




                  </div>





                </template>

            </Column>

        </DataTable>


        <input-label>
          Notes

      </input-label>

        <TextInput>

        </TextInput>
        <PrimaryButton>
            Add
        </PrimaryButton>










    </authenticated-layout>








</template>








<style scoped>






</style>

<script>
import {isDate} from "rollup-plugin-node-builtins/src/es6/util.js";
import {router} from "@inertiajs/vue3";


export default{
    data(){



        return{


        }

    },
    methods:{
        addNewFood(date,time){
            this.$inertia.get(`/nutrition.show/${date}/addnewFood`,{time:time},{preserveState:true})
        }
    }
}


</script>



