<script setup lang="ts">

let days=['m','t','w','t','f','s','s']
</script>

<template>


   <h1 class="text-center text-black">
       Weekly Tracking
   </h1>


    <div class="flex flex-row  justify-between bg-white border-4">


        <div class="border rounded-full flex-2 bg-black text-white hover:bg-yellow-500 cursor-pointer" v-for="(item,index) in days">
            <h1 class="text-center m-4  ">
                <Icon :name="`tabler:circle-letter-${item} filled`">

                </Icon>

            </h1>

        </div>
    </div>


</template>

<style scoped>

</style>
