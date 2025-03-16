<script setup lang="ts">

import {integer} from "vscode-languageserver-types";
import {ca} from "cronstrue/dist/i18n/locales/ca";

const props=defineProps({
    modelValue:String,
    carbs:{
        type:Number
    },
    protein:{
        type:Number
    },
    fats:{
        type:Number
    },
    calories:{
        type:Number
    }

})
const emit=defineEmits([
    'update:protein',
    'update:carbs',
    'update:fats',
    'update:calories'
]);


</script>

<template>
    <form>
        <label class="block text-white text-sm font-bold mb-2">
            Protein
        </label>
        <input type="number"  placeholder="Carbs" class="shadow appearance-none border bg-primary rounded w-full py-2 px-3 text-white leading-tight focus:outline-none" :value="protein" @input="$emit('update:protein',$event.target.value)">
        <label class="block text-white text-sm font-bold mb-2">
          Carbs
        </label>
        <input type="number" :value="carbs" @input="$emit('update:carbs',$event.target.value)" placeholder="Carbs" class="shadow appearance-none bg-primary  border rounded w-full py-2 px-3 text-white leading-tight focus:outline-none">

        <label class="block text-white text-sm font-bold mb-2">
            Fat
        </label>

        <input type="number" :value="fats" @input="$emit('update:fats',$event.target.value)" placeholder="Calories" class=" shadow appearance-none border  bg-primary rounded w-full py-2 px-3 text-white leading-tight focus:outline-none">
        <label class="block text-white text-sm font-bold mb-2">
            Calories
        </label>
        <input type="number" :value="calories" @input="$emit('update:calories',$event.target.value)" placeholder="Calories" class="shadow appearance-none bg-primary border rounded w-full py-2 px-3 text-white leading-tight focus:outline-none">


    </form>

</template>

<style scoped>

</style>
