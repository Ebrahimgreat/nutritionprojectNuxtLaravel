<script setup lang="ts">
import './modal.vue'
import ButtonCustom from "~/components/UI/buttonCustom.vue";
import{useNutritionStore} from "~/stores/nutritionStore";
const nutritionStore=useNutritionStore();

const props=defineProps({
    showModal:Boolean,
   foodName:String,
    calories:Number,
    protein:Number,
    fat:Number,
    carbs:Number,
    quantity:Number,


})
const emit=defineEmits(['update:showModal','update:Quantity','update:Protein'])

 function splitString()
{
    const splitArray=props.food.split("")
    console.log(splitArray)

}

function addNewFood()
{
   nutritionStore.setData('2025-02-17',props.protein)
}

</script>

<template>
   <button-custom @click="emit('update:showModal',true)">

   </button-custom>
    <teleport to="body">


    <modal :show="showModal" @close="emit('update:showModal')" @add="addNewFood">
       <template #header>

            <CardHeader>
                <CardTitle>
                    Food:{{foodName}}
                </CardTitle>
            </CardHeader>


       </template>
        <template #body>


       <div class="flex flex-row text-white gap-x-10">
           <label class="block text-white text-sm font-bold mb-2">
               Calories  {{calories}}
           </label>
           <label class="block text-white text-sm font-bold mb-2">
              Protein: {{protein}}
           </label>
           <label class="block text-white text-sm font-bold">
               Carbs : {{carbs}}
           </label>
           <label class="block text-white text-sm font-bold">
               Fat : {{fat}}
           </label>

       </div>
            <div class="flex flex-row space-x-5">


                <input type="number" :value="quantity" placeholder="quantity" class="bg-primary rounded w-full py-2 px-3 text-white" @input="emit('update:Quantity',$event.target.value)">

                <h2 class="text-white">
                    g  {{quantity}}
                </h2>
            </div>


        </template>
        <template #footer>

        </template>

    </modal>
    </teleport>
</template>

<style scoped>

</style>
