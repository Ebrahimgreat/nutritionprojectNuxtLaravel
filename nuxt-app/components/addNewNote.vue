<script setup lang="ts">


import './modal.vue'
let showModal=ref(false);






</script>

<template>


    <button @click="showModal=true">
       Notes
    </button>
    <teleport to="body">
        <modal :show="showModal" @close="showModal=false" >




            <template #header>
                Add new Note
            </template>
            <template #body>


                    <button-custom>
                        Add Food
                    </button-custom>

            </template>

        </modal>
    </teleport>

</template>

<style scoped>
.custom-modal{
    width:90%;

}

</style>

