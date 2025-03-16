<script  setup lang="ts">

import modal from './modal.vue';
defineProps({
    showModal:Boolean,
    Sex:String

})
const emit=defineEmits(['update:showModal','update:Sex'])

</script>

<template>
      <EditButton @click="emit('update:showModal',true)">

</EditButton>
    
    <teleport to="body">
        <modal :show="showModal" @close="emit('update:showModal',false)">
            <template #header>
                Sex

            </template>
            <template #body>
                <div class="flex flex-row">

                    <div class="flex-1">

              
     
                <label class="font-bold text-white ">
                    male

                </label>
        


       
                <input type="radio" name="sex" class="bg-primary text-white">
</div>           <div class="flex-1">



                <label class="font-bold text-white">
                 female

                </label>
                <input type="radio" name="sex">
                </div>
                <div class="flex-1">

   
       
                <label class="font-bold text-white">
                 other

                </label>
                <input type="radio" name="sex" :value="Sex" @input="emit('update:Sex',true)">
                </div>
       
                </div>


            </template>
        </modal>

 
  
    </teleport>

</template>