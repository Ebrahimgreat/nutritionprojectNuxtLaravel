<script setup lang="ts">
import modal from './modal.vue';
defineProps({
    showModal:Boolean,
    height:Number
})
const emit=defineEmits(['update:showModal','update:Height'])
</script>
<template>
    <EditButton @click="emit('update:showModal',true)">
        </EditButton>

        
        <teleport to="body">


        <modal :show="showModal" @close="emit('update:showModal',false)">
            <template #header>
                Height
            </template>

            <template #body>
                <label class="block font-bold text-white">
                    Height
                </label>
                <input type="number" class="w-full bg-primary text-white" :value="height" @input="emit('update:Height',$event.target.value)" >

            </template>
            
            
        </modal>
        </teleport>

</template>