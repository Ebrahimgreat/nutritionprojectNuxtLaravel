<script setup lang="ts">
import './modal.vue'
import ButtonCustom from "~/components/UI/buttonCustom.vue";




let props=defineProps({
    modelValue:String,
    exercise:Array

})

 function createExercise()
{
    emit('updateExercise',props.modelValue)

  //This should then make a call to the database and store in the custom exercise table

}


const emit=defineEmits(['update:modelValue','updateExercise'])
let showModal=ref(false)



</script>

<template>

    
<div @click="showModal=true" class=" w-32">

    <slot>
    </slot>

</div>
    <teleport to="body">


    <modal :show="showModal" @close="showModal=false" @add="createExercise">
            <template #header>
                New Exercise
            </template>
            <template #body>
                <input type="text" :value="modelValue" class="bg-primary border text-white text-white" placeholder="Enter Exercise Name" @input="emit('update:modelValue',$event.target.value)">




            </template>


    </modal>
    </teleport>
</template>

<style scoped>

</style>
