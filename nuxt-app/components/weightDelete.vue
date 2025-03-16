<script setup lang="ts">
import './modal.vue'
import ButtonCustom from "~/components/UI/buttonCustom.vue";

let props=defineProps({
    showModal:Boolean,
    weight:Number,
    dateValue:String,
})
const emit=defineEmits(['update:showModal','update:weight','update:dateValue'])
</script>

<template>
    <ButtonCustom @click="emit('update:showModal',true)">
     <img src="/icons/delete.svg">

    </ButtonCustom>
    <teleport to="body">


    <modal :show="showModal" @close="emit('update:showModal',false)">
        <template #header>
            Delete Weight
        </template>
        <template #body>


        <p class="text-white">
            Are You sure You want to delete this weight?
        </p>
            <input type="date" class="w-full px-4 py-2 full bg-primary rounded border text-white mb-5" :value="dateValue" @input="emit('update:dateValue')">
            <input type="number" :value="weight" class="w-full px-4 py-2 full bg-primary border text-white mb-5" @input="emit('update:weight')">
        </template>

    </modal>
    </teleport>


</template>

<style scoped>

</style>
