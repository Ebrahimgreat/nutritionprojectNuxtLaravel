<script setup lang="ts">

import {document} from "postcss";
import{useWeightStore} from "~/stores/weight";
import {stringifyJSON} from "confbox";
let weightStore=useWeightStore()
let date=ref(weightStore.date)
let scaleWeight=ref(weightStore.scaleWeight)
defineProps({
    weight:{
        type:Object,
    }
})

function back()
{
    navigateTo('/weight')
}
let editWeight=ref()
async function editingWeight()
{
     await $fetch('http://127.0.0.1:8000/api/updateWeight',{
         method:'POST',
        headers:{
            'token':localStorage.getItem('token'),
        },
         body:stringifyJSON({
            'date':date.value,
             'scaleWeight':scaleWeight.value


         })


});
}

</script>

<template>



<back-button @click="back">
    Back
</back-button>
    <label class="block text-gray-500 font-bold mb-1:mb-0 pr-4">
        Date
    </label>
    <input  v-model="date" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" id="inline-full-name" type="date">


    <label class="block text-gray-500 font-bold mb-1:mb-0 pr-4">
        Scale Weight
    </label>

    <input v-model="scaleWeight" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" id="inline-full-name" type="number">

    <button @click="editingWeight" class="shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline-none text-white font-bold py-2 px-4 rounded" type="button">
        Update

    </button>


</template>

<style scoped>

</style>
