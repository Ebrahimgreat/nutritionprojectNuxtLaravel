<script setup lang="ts">

import {definePageMeta} from "#imports";

definePageMeta({
    layout:'default'
})

const settings=['General','App Settings','Policies','Community and Support']
const fields=['profile','privacy','subscription','password','Units','Height','Clock']

let name=ref()
function back()
{
    navigateTo('/home')
}
onMounted(()=>{
    name.value=localStorage.getItem('name')
    console.log(name)

})
</script>

<template>
    <back-button @click="back">

    </back-button>

   <div class="hidden space-y-6 pb-10 pb-15 md:block bg-white">
       <div class="space-y-0.5">
           <h2 class="text-2xl font-bold tracking-tight">
               Hello {{name}}
           </h2>
           <p class="text-muted foreground">
               Manage your account settings
           </p>
       </div>
       <div class="shrink-0 border h-[1px] w-full">
           <div class="flex flex-col space-y-8 lg:flex-row lg:space-x-12 lg:space-y-0">
               <nav class="flex space-x-2 lg:flex-col lg:space-x-0 lg:space-y-1">



                   <NuxtLink to="/community" class="inline-flex items-center rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 hover:text-accent-foreground h-9 px-4 py-2 hover:bg-transparent hover:underline justify-start">
                       Community and Support
                   </NuxtLink>
               </nav>
               <slot>

               </slot>
           </div>
       </div>
   </div>



</template>

<style scoped>

</style>
