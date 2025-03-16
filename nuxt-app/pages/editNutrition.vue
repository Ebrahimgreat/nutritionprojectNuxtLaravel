<script setup lang="ts">

import{usenutritionstore} from "~/stores/nutritionRecords";
import {ca} from "cronstrue/dist/i18n/locales/ca";
let nutritionStore=usenutritionstore()

let calories=nutritionStore.calories
let protein=nutritionStore.protein
let carbs=nutritionStore.carbs
let fats=nutritionStore.fats

</script>

<template>
    {{calories}}

    Edit nutrition

    <label class="block text-gray-500 font-bold mb-1:mb-0 pr-4">
        Date
    </label>
    <label class="block text-gray-500 font-bold mb-1:mb-0 pr-4">
        Calories
    </label>

    <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">

    <label class="block text-gray-500 font-bold mb-1:mb-0 pr-4">
        Protein
    </label>
    <input v-model="protein" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">

    <label class="block text-gray-500 font-bold mb-1:mb-0 pr-4">
        Carbs
    </label>
    <input v-model="carbs" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">


    <label class="block text-gray-500 font-bold mb-1:mb-0 pr-4">
        Fats
    </label>
    <input v-model="fats" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">

    <label class="block text-gray-500 font-bold mb-1:mb-0 pr-4">
        foodName
    </label>
    <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">
    <button-custom>
        Submit
    </button-custom>
</template>

<style scoped>

</style>
