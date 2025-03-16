<script setup lang="ts">





import {ca} from "cronstrue/dist/i18n/locales/ca";

let protein=ref(0)
let carbs =ref(0)
let foodName=ref('')
let fats=ref(0)
let calories=ref(0)
let quantity=ref(0)

function back()
{
    navigateTo('/nutrition')
}
async function addFood()
{
    try{
        await $fetch('http://127.0.1:8000/api/createCustomFood',{
            method:'POST',
            body:{
                'protein':protein.value,
                'carbs':carbs.value,
                'fats':fats.value,
                'quantity':quantity.value,
                'calories':calories.value,
                'foodName':foodName.value

            }
        })
        navigateTo('/nutrition')
    }
    catch(e){

    }


}

</script>

<template>
    <button-custom @click="back">
        Dashboard
    </button-custom>

    <label class="block text-gray-700 text-sm font-bold mb-2">
        food Name
    </label>
    <input  v-model="foodName" type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus-outline-none">


    <label class="block text-gray-700 text-sm font-bold mb-2">
Calories
    </label>
    <input v-model="calories" type="number" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus-outline-none">


    <label class="block text-gray-700 text-sm font-bold mb-2">
        Protein
    </label>

    <input v-model="protein"type="number" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none">



    <label class="block text-gray-700 text-sm font-bold mb-2">
        Fat
    </label>
    <input v-model="fats" type="number" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus-outline-none">

    <label class="block text-gray-700 text-sm font-bold mb-2">
        Carbs
    </label>

    <input v-model="carbs" type="number" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus-outline-none">
    <label class="block text-gray-700 text-sm font-bold mb-2">
        Default Quantity
    </label>

    <input  v-model="quantity" type="number" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus-outline-none">


    <button-custom @click="addFood">
Add Food
    </button-custom>

</template>

<style scoped>

</style>
