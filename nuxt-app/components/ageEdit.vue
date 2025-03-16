<script setup lang="ts">
import { EditButton } from '#components';
import modal from './modal.vue';
import ButtonCustom from './UI/buttonCustom.vue';
import buttonCustom from './UI/buttonCustom.vue';
defineProps({
    showModal:Boolean,
    age:Number
    
})
const emit=defineEmits(['update:showModal','update:Age'])

</script>

<template>
    <EditButton @click="emit('update:showModal',true)">
        Edit


    </EditButton>
    <teleport to="body">

      


    <modal :show="showModal" @close="emit('update:showModal',false)">
        <template #header>
            Age
        </template>

        <template #body>


        <label class="text-white font-bold">
            Age

        </label>

        <input type="number" :value="age" class="bg-primary text-white w-full" @input="emit('update:Age',$event.target.value)">

</template>
    </modal>
    
    </teleport>


</template>