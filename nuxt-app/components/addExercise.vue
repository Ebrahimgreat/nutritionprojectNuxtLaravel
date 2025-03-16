<script setup lang="ts">





let props=defineProps({
  
    showModal:Boolean,
    date:String,
  

})

const emit=defineEmits(['updateWorkoutDetails','update:showModal','update:Date','update:Set'])

import './modal.vue';
import CreateExercise from "~/components/createExercise.vue";
import {Tabs, TabsContent, TabsTrigger,TabsList} from "~/components/UI/tabs";
import SelectValue from "./ui/select/SelectValue.vue";


let showTemplateModal=ref(false)



let exerciseSelected=ref('')
let template=ref([])
let customExercises=ref([])
let headers=['My Template','Add Exercise']

let selected=ref(0)
let exercises=ref([])



let workoutArray=ref([])

function addExercise()
{
   
    
   workoutArray.value.push({name:'BenchPress',set:5,reps:5,weight:10,rpe:0})

 
  

}


let exerciseName=ref('')
function select(count)
{
    selected.value=count;

}

function selectExercisesFromTemplate(item)
{

    console.log(item.exercise.name)
    let newExercise={
        name:item.exercise.name
    }
    workout.value.push({
        workout:newExercise.name,
        reps:0,
        weight:0,
        rpe:0



    })
    selected.value=1;
}


async function createNewExercise(exerciseName)
{
    try{
        await $fetch('http://127.0.0.1:8000/api/storeCustomExercise',{
            method:'POST',
            body:{
                name:exerciseName
            }
        })
        exercises.value.push({
            name:exerciseName
        })

    }
    catch(error)
    {
        console.log(error)
    }
}



let newTemplate=ref([])

function addTemplate()
{
    console.log(template.value)

}
function addNewExercise()
{
    let newExercise={
        name:exerciseName.value
    }
    console.log('You clicked me')
    exercises.value.push(newExercise);
    console.log(exercises.value)
}

let exercisesModifed=ref([])

async function getExercises()
{
    try{
        exercises.value=await $fetch('http://127.0.0.1:8000/api/exercises',{
            method:'GET'
       
    

        })
        exercisesModifed.value=exercises.value.map(item=>({
            label:item.name,
            value:item.name
        }))
    }
    
    catch(error)
    {
        console.log(error)
    }
}

let templatesToBeDisplayed=ref([])
async  function getTemplate()
{
    try{
       template.value=await $fetch('http://127.0.0.1:8000/api/myTemplate',{
            method:'GET'

        })
        templatesToBeDisplayed.value=template.value.map((item)=>{

        })

    }
    catch(error){
        console.log(error)
    }

}

const totalVolume = computed(() => {
    return workout.value.reduce((total, item) => {
        return total + (item.reps * item.weight);
    }, 0);
});


onMounted(()=>{
    getTemplate()
    getExercises()
})

function deleteExercise(item)
{
    console.log(item)
   workoutArray.value.splice(item,1);
}






function finalizeExercise()
{
    
    
   emit('updateWorkoutDetails',workoutArray.value.flatMap(item=>({
   
           name:item.name,
           set:item.set,
           weight:item.weight,
           reps:item.reps,
           rpe:item.rpe
           
          

       


   })))

}


async function componentUpdate(row)
{
    console.log(row)

}

let columns=[{label:'Confirm',key:'confirm'},{label:'name',key:'name'},{label:'Set',key:'set'},{label:'Reps',key:'reps'},{label:'Weights',key:'weight'},{label:'Action',key:'action'},{label:'RPE',key:'rpe'}]

</script>



<template>

    <div class="flex flex-col">





<UButton @click="emit('update:showModal',true)">
    Add

</UButton>
<UModal :model-value="showModal" prevent-close>

    <UCard class="min-w-[900px] max-w-[900px] flex flex-col overflow-hidden">
        <template #header>
           
           <h1 class="text-center">
            Add Exercise
           </h1>
        </template>
        <UButton color="gray" variant="ghost" icon="i-heroicons-x-mark-20-solid" class="-my-1" @click="emit('update:showModal',false)">
        </UButton>

        <label>
            Date
        </label>
        <UInput type="date" :model-value="date" @input="emit('update:Date',$event.target.value)"/>
 

        
       

   
    <div class="">

        {{ workoutArray }}
  
    
    <UTable  :columns="columns" :rows="workoutArray">

        
        
       
        

        <template #name-data="{row}">
         <USelect class="w-32"  v-model="row.name" :options="exercisesModifed">
            </USelect>

        </template>
        <template #set-data="{row}">
         <UInput class="w-32" v-model:model-value="row.set" type="number">
            </UInput>

        </template>

        <template #reps-data="{row}">
         <UInput  class="w-32" v-model="row.reps" type="number">
            </UInput>

        </template>
        <template #weight-data="{row}">
         <UInput class="w-32" v-model="row.weight" type="number">
            </UInput>

        </template>
        <template #rpe-data="{row}">
         <UInput v-model="row.rpe" type="number">
            </UInput>

        </template>
        <template #action-data="{row}">
         <UButton label="delete" @click="deleteExercise(row)">

         </UButton>
        

        </template>



        <template #caption>
            <caption>
                <UButton @click="addExercise">
                    Add
                </UButton>
            </caption>
        </template>
  
    </UTable>
    <UButton @click="finalizeExercise" label="submit">
        </UButton>
    </div>
    </UCard>
    
    
</UModal>


</div>

</template>

<style scoped>

</style>
