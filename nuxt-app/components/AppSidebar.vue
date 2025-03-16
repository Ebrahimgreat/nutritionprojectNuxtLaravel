<script setup lang="ts">
import type { SidebarProps } from '@/components/ui/sidebar'
import { Calendar, Home, Inbox, Search, Settings,Apple,Weight,Dumbbell,Zap} from "lucide-vue-next"

import { useauthStore } from '#imports'
const authStore=useauthStore();


import {
  Sidebar,
  SidebarContent,
  SidebarFooter,
  SidebarHeader,
  SidebarRail,
} from '@/components/ui/sidebar'

import {
  AudioWaveform,
  BookOpen,
  Bot,
  Command,
  Frame,
  GalleryVerticalEnd,
  Map,
  PieChart,
  Settings2,
  SquareTerminal,
} from 'lucide-vue-next'
import CreateWeight from './createWeight.vue';
import NutrientAdd from './nutrientAdd.vue';
import CreateExercise from './createExercise.vue';
import AddExercise from './addExercise.vue';

const props = withDefaults(defineProps<SidebarProps>(), {
  collapsible: 'icon',
})

// This is sample data.

const navItems=[
{title:'Home',url:'/Home',icon:Home
},
  {title:'Nutrition',url:'/nutrition',icon:Apple
},
  
  {title:'Weight',url:'weight',icon:Weight, items:[
    {title:'Show Weights',url:'/weight'},
   

  ]},
  {title:'Expenditure',url:'/expenditure',icon:Zap, items:[

   

  ]},
  {title:'Workout',url:'workout',icon:Dumbbell,items:[
    {title:'Show Exercises',url:'/workout'},
  

  ]},
 
]
const userData=[
  {name:authStore.name}
]
 

async function logout()
{
  await authStore.logout();
}
    
</script>

<template>
  <Sidebar  v-bind="props">
   
    <SidebarContent>
      <NavMain :items="navItems" />

 

    </SidebarContent>
    <SidebarFooter>
      <NavUser :user="userData" />
    </SidebarFooter>
    <SidebarRail />
  </Sidebar>
</template>
