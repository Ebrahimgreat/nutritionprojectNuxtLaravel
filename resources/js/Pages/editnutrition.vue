<script setup>

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {router} from "@inertiajs/vue3";
import {Calendar, DatePicker} from "v-calendar";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import {computed, ref, watch} from "vue";

const props=defineProps({
        data:Array,
    foodData:Array,


    }
)





 function submit(data)
{
    router.post('/nutrition.show/{date}/post{id}',data)

}
function cancel()
{
    router.get('/nutrition')
}

let quantity=computed(()=>{
    let index=0
    let totalQuantity=0

    props.foodData.forEach(item=>{
        console.log('hi');

    item.Calories=(item.quantity*item.defaultCalories)/item.defaultQuantity;
    item.protein=(item.quantity*item.defaultProtein)/item.defaultQuantity;
    item.carbs=(item.quantity*item.defaultCarbs)/item.defaultQuantity;
    item.fats=(item.quantity*item.defaultFats/item.defaultQuantity)




    })




})



</script>



<template>
    {{quantity}}

    <authenticated-layout>


        <div v-for="(foods,index) in foodData">


           <input-label> Name</input-label>
            <text-input v-model="foodData[index].name" disabled>

            </text-input>
            <input-label> Protein</input-label>
                <text-input v-model="foodData[index].protein" disabled>

                </text-input>


            <input-label> Carbs</input-label>
            <text-input v-model="foodData[index].carbs" disabled>

            </text-input>
            <input-label> Fats</input-label>

            <text-input v-model="foodData[index].fats" disabled>

            </text-input>

            <input-label> Quantity</input-label>
            <text-input v-model="foodData[index].quantity">

            </text-input>



            <primary-button @click="submit(foodData)" type="submit">
                Submit

            </primary-button>

            <PrimaryButton @click="cancel"> Cancel</PrimaryButton>


        </div>






    </authenticated-layout>
</template>

<style scoped>



</style>


