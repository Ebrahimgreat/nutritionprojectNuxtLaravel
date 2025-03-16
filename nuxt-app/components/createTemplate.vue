<script setup lang="ts">
import './modal.vue'
import ex = CSS.ex;
import ButtonCustom from "~/components/UI/buttonCustom.vue";
import {Dialog,DialogTrigger,Button} from '#components';



const showModal=ref(false);

let newTemplate=ref([
])
let exerciseName=ref('')

const emit=defineEmits(['updateTemplate','update:showModal'])



let props=defineProps({
    exercises:Object,
    template:Object,
    showModal:Boolean

});
function addExercise()
{
    newTemplate.value.push({
        exerciseName:exerciseName.value,
        weight:weight.value,
        rpe:rpe.value,

    })
    props.template.push({
       name:exerciseName.value,
        weight:weight.value,
        rpe:rpe.value

    })



}
const name=ref('')
const weight=ref(0)
const reps=ref(0)
const rpe=ref(0)
const exercise=ref([])

async function getExercises()
{
     try{

    exercise.value=await $fetch('http://127.0.0.1:8000/api/exercises',{
        method:'GET'

    })


}
catch (error){
         console.log(error)
     }
}
onMounted(()=>{
    getExercises()
})
</script>

<template>

    <Dialog :open="showModal">


    <DialogTrigger as-child>


    <Button @click="$emit('update:showModal',true)">
        Create Template
    </Button>
    </DialogTrigger>
              
    <DialogContent>
        <h1 class="text-center">
                   Create Your Template
               </h1>
              

                <div class=" flex items-center justify-center">
                    <h2 class="text-white text-center">
                     Name of Workout
                    </h2>
                    <input type="text" class="bg-primary text-white shadow appearance-none border rounded-full" v-model="name">
                    <create-exercise>
                        Create Exercise
                    </create-exercise>
                </div>


                <div class="flex flex-row gap-x-2.5">

                    <div class="flex-1">
                        <h1 class="text-white">
                            Exercise
                        </h1>
                        <select v-model="exerciseName" class="bg-primary appearance-none   border-2 border-gray-200 rounded w-20 py-2 px-4 text-white leading-tight focus:outline-none">
                            <option v-for="item in props.exercises" class="text-black" :value="item.name" :key="item.id">
                                {{item.name}}
                            </option>


                        </select>
                    </div>


                    <div class="flex-1">


                    <h2 class="text-white">
                        Weight
                    </h2>

                    <input type="number" v-model="weight" class="bg-primary appearance-none border-2 border-gray-200 rounded py-2 px-4 text-white leading-tight focus:outline-none" >
                    </div>
                    <div class="flex-1">

                    <h3 class="text-white">
                        Reps
                    </h3>
                    <input type="number" value="10" class="bg-primary appearance-none border-2 border-gray-200 rounded py-2 px-4 text-white leading-tight focus:outline-none">
                    </div>

                    <div class="flex-1">

                    <h4 class="text-white">
                        RPE
                    </h4>

                    <input type="number" v-model="rpe" class="bg-primary appearance-none border-2 border-gray-200 rounded py-2 px-4 text-white leading-tight focus:outline-none">
                    </div>


                </div>
                <button-custom @click="addExercise">

                </button-custom>







                <div class=" bg-primary border mt-6 flex flex-col text-white w-full">

                    <div v-if="newTemplate.length>0">

                       <p class="text-center font-bold">

                      Workout Name:{{name}}
                       </p>
                        <div class="max-h-32 overflow-y-auto border border-gray-500 p-2">



                        <div v-for="item in newTemplate" class="flex flex-row">


                          <div class="flex-1">
                              Exercise

                           <select v-model="item.exerciseName" class="bg-primary border-2">
                               <option v-for="exerciseName in exercise" :value="exerciseName.name" >
                                   {{exerciseName.name}}
                               </option>
                           </select>
                          </div>
  <div class="flex-1">


                            Weight
                            <input type="number" :value="item.weight" class="bg-primary border-2">
  </div>
                            <div class="flex-1">


                           Reps

                            <input type="number" :value="item.reps" class="bg-primary border-2">
                            </div>
                            <div class="flex-1">


                            RPE
                            <input type="number" :value="item.rpe" class="bg-primary border-2">

                            </div>


                        </div>

                    </div>
                    </div>
                    <div v-else class="text-center">
                        Add Exercise to your template
                    </div>

               Save
                </div>
                

</DialogContent>
</Dialog>
</template>





<style scoped>

</style>
