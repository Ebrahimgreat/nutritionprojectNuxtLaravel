<script setup lang="ts">
import {SidebarInput, SidebarInset, SidebarProvider, SidebarTrigger} from "~/components/ui/sidebar";


let links=[{label:'Home',to:"/home"},{label:'Nutrition',to:'nutrition'},{label:'Weight',to:'/weight'},{label:'workout',key:'/workout'}]
</script>
<template>

<div class="container mx-auto px-6">


    <UHorizontalNavigation :links="links">
        
    </UHorizontalNavigation>






            <slot/>
      </div>
    
</template>
<style>
</style>