<script setup lang="ts">
import {
  Collapsible,
  CollapsibleContent,
  CollapsibleTrigger,
} from '@/components/ui/collapsible'
import {
  SidebarGroup,
  SidebarGroupLabel,
  SidebarMenu,
  SidebarMenuButton,
  SidebarMenuItem,
  SidebarMenuSub,
  SidebarMenuSubButton,
  SidebarMenuSubItem,
  SidebarTrigger
} from '@/components/ui/sidebar'
import { item } from '@unovis/ts/components/bullet-legend/style';
import { ChevronRight, type LucideIcon } from 'lucide-vue-next'


let showModal=ref(false)
defineProps<{
  items: {
    title: string
    url: string
    icon?: LucideIcon
    isActive?: boolean
    items?: {
      title: string
      url: string
    }[]
  }[]
}>()
</script>

<template>
  <SidebarGroup>
    <SidebarGroupLabel>Platform</SidebarGroupLabel>

  <SidebarGroupContent>




    <SidebarMenu>
      
      <SidebarMenuItem
        v-for="item in items"
        :key="item.title"
     
     
     
      >

            <SidebarMenuButton :tooltip="item.title" asChild>
              <NuxtLink :to="item.url">

           
        

     

  
              <component :is="item.icon"/>
              <span>{{item.title}}</span>
           
           

            </NuxtLink>
             
          

    
            </SidebarMenuButton>
        

        </SidebarMenuItem>
    </SidebarMenu>
    </SidebarGroupContent>
  </SidebarGroup>
</template>
