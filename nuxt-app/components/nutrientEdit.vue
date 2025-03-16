<script setup lang="ts">

import './modal.vue';
let showModal=ref(false)

const props=defineProps({
    nutrition:{
        type:Object
    }
})
</script>

<template>

    <button @click="showModal=true" class="inline-flex items-center rounded-md border border-transparent bg-gray-800 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white transition duration-150 ease-in-out hover:bg-gray-700 focus:bg-gray-700 focus:outline-none focus:ring-2">
        Edit Nutrition
    </button>
    <teleport to="body">
    <modal :show="showModal" @close="showModal=false">

        <template #header>
            {{showModal}}
            Editing Nutrition

        </template>
        <template #body>
{{nutrition}}
            <label class="block text-gray-500 font-bold mb-1:mb-0 pr-4">
                Date
            </label>
            <input type="date" v-model="nutrition.date">
            <label class="block text-gray-500 font-bold mb-1:mb-0 pr-4">
                Calories
            </label>

            <input v-model="nutrition.Calories" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">

            <label class="block text-gray-500 font-bold mb-1:mb-0 pr-4">
                Protein
            </label>
            <input v-model="nutrition.Protein" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">

            <label class="block text-gray-500 font-bold mb-1:mb-0 pr-4">
                Carbs
            </label>
            <input v-model="nutrition.Carbs" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">



        </template>

    </modal>
    </teleport>



</template>

<style scoped>

</style>
