<script setup lang="ts">
import { EditButton } from '#components';
import './modal.vue'
import ButtonCustom from "~/components/UI/buttonCustom.vue";

const props=defineProps({
    email:String,
    showModal:Boolean
})
const emit=defineEmits(['update:showModal','update:Email',])

</script>
<template>
    <EditButton @click="emit('update:showModal',true)">
        Edit me
    </EditButton>

    <teleport to="body">


    <modal :show="showModal" @close="emit('update:showModal',false)">
        <template #body>
            <label class="text-white font-bold">
                Email

            </label>
            <input type="text" :value="email" class="bg-primary w-full text-white rounded " @input="emit('update:Email',$event.target.value)">
        </template>


    </modal>
    </teleport>

</template>
