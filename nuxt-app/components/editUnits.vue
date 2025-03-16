<script setup lang="ts">
import { Dialog,DialogTitle,DialogTrigger,Button,DialogHeader,Input,DialogFooter, UButton } from '#components';
let props=defineProps({
    showModal:Boolean,
    weightUnit:Number,
    heightUnit:Number
})
let emit=defineEmits(['update:showModal'])

const weightOptions=[{
    value:'kilograms',
    label:'Kilograms'
},
{value:'Pounds',label:'pounds'}
]
const heightOptions=[{
    value:'inch',
    label:'inch'
},{value:'meters',label:'meters'}]

</script>

<template>
    

  <UButton label="units" @click="emit('update:showModal',true)" >
  
    </UButton>

    <UModal :model-value="showModal" prevent-close>
        <UCard>
            <template #header>
            {{ heightUnit }}


<URadioGroup legend="Weight Units" :options="weightOptions">
    </URadioGroup>
          
           
            <URadioGroup legend="Height Units" :options="heightOptions"/>
        
</template>
<template #footer>
    <UButton>
      Update
    </UButton>
</template>
        </UCard>
    </UModal>
    

</template>