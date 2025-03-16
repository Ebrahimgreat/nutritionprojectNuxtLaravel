<script setup lang="ts">
import './modal.vue'
import ButtonCustom from "~/components/UI/buttonCustom.vue";

const props=defineProps({
    name:String,
    showModal:Boolean
})
const emit=defineEmits(['update:showModal','update:name'])

</script>

<template>
    <button class="border rounded-full flex items-center justify-center  w-20" @click="emit('update:showModal',true)">
        Edit
    </button>



        <teleport to="body">
    <modal :show="showModal" @close="emit('update:showModal',false)">
        <template #header>
            
        </template>
        <template #body>

            <label class="text-white font-bold">
                Name

            </label>

        <input type="text" class="bg-primary   text-white w-full rounded" :value="name" @input="emit('update:name',$event.target.value)">
        </template>
    </modal>
    </teleport>


</template>

<style scoped>

</style>
