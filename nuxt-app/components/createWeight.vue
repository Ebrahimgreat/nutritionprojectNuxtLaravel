<script setup lang="ts">


import moment from "moment";
let scaleWeight=ref(0);
let currentDate = ref(moment().format('YYYY-MM-DD'));
import'./modal.vue'
import ButtonCustom from "~/components/UI/buttonCustom.vue";
import {Dialog,DialogTrigger,Button,Input,DialogTitle,DialogContent} from "#components";



// Use ref to make it reactive

const token=useCookie('token');


let props=defineProps({
    showModal:Boolean,
    newWeight:Number,
    date:String
})
function back()
{
    navigateTo('/weight')
}

function createWeight()
{
    emit('createNewWeight')
    emit('update:showModal',false)

}


let weight=ref()


const emit=defineEmits(['update:showModal','update:newWeight','createNewWeight','update:Date'])
</script>

<template>

    <UButton label="+" @click="emit('update:showModal',true)">

        
    </UButton>
    <UModal :model-value="showModal">
        <UCard>
            <template #header>
                <UButton color="gray" variant="ghost" icon="i-heroicons-x-mark-20-solid" class="-my-1" @click="emit('update:showModal',false)"/>

                <label>
                    Date
                </label>
               <UInput type="date" :model-value="date">
                </UInput>

               Scale Weight
                <UInput type="text" :model-value="newWeight" @input="emit('update:newWeight',$event.target.value)"/>
                <UButton @click="createWeight">
                    Submit
                </UButton>
            </template>
         
        </UCard>

       
    </UModal>

   

</template>

<style scoped>

</style>
