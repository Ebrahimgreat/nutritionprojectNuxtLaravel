<script setup lang="ts">


import {my} from "cronstrue/dist/i18n/locales/my";

function dashboard()
{
    navigateTo('/home');
}
let myfoods=ref([]);
async function getCustomFoods()
{
    myfoods.value=await $fetch('http://127.0.1:8000/api/customFoods')

}
let quantity=ref(0)
async function storeCustomFood(value)
{
    foodSelected.value=value.id
    quantity.value=1


    try{
        await $fetch('http://127.0.0.1:8000/api/addCustomFood',{
            method:'POST',
            body:{
                'food':foodSelected.value,
                'quantity':quantity.value
            }
        })
    }
    catch (error)
    {
        console.log(error);
    }

}

let foodSelected=ref('')

function selectFood(value)
{

}
onMounted(()=>{
    getCustomFoods()
})
</script>

<template>
    <button-custom @click="dashboard">
Dashboard
    </button-custom>


    <table class="relative flex flex-col w-full h-full overflow-scroll text-gray-700 bg-white shadow-md rounded-xl">
            <th class="px-4 py-2 border-blue gray-100 bg-blue gray-50"> Your Foods</th>



        <tr v-for="food in myfoods">
            {{food.name}}
           Calories: {{food.defaultCalories}}
            Fats:{{food.defaultFats}}
            Carbs:{{food.defaultCarbs}}
            Quantity{{food.defaultQuantity}}
            <button-custom @click="storeCustomFood(food)">
                +
            </button-custom>
        </tr>
    </table>


</template>

<style scoped>

</style>
