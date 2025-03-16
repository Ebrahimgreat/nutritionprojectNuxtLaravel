<script setup lang="ts">

import{Table,TableHead,TableBody,TableHeader,Card,CardContent,CardHeader,CardTitle, UTable, UCard, UButton} from "#components";
import { useAddWorkout } from "#imports";

import AddExercise from "~/components/addExercise.vue";
const{newWorkout,workoutData}=useAddWorkout();
let workout=ref([])
let token=useCookie('token')

let openWorkoutDetailModal=ref(false)
let workoutExercises=ref([])
let showWorkoutModal=ref<boolean>(false)


let currentPage=ref(0)
let total=ref(0);


const{data:information}=await useAsyncData('workouts',()=>
$fetch('http://127.0.0.1:8000/api/workout',{
    method:'GET',
    headers:{
        'Authorization': `Bearer ${token.value}`
    }
}))
workoutExercises.value=information
currentPage.value=information.value.current_page;
total.value=information.value.total;



workout.value=information.value
let indiviudalExercises=[];
let indivualArray=[];

let filteredExercises=[]
workout.value.data.flatMap((item)=>item.workout_detail).map((value)=>value.name).forEach((value1)=>{
    if(!indiviudalExercises.includes(value1)){
        indiviudalExercises.push(value1)
    }
})
indiviudalExercises.forEach((value1)=>{
indivualArray.push(workout.value.data.flatMap((item)=>item.workout_detail).filter((value)=>value.name===value1))
});








   
const weightData=computed(()=>{
    return{
        labels:[
            workout.value.map((item)=>item.date)
        ],
        datasets:[
            {
                label:['weight'],
                data:workout.value.map((item)=>item.weight),
                backgroundColor:'#A020F0'
            }
        ]
    }
})
const chartOptions = {
    responsive: true,
    maintainAspectRatio: false
}
let newWorkoutValue=ref([])
const workoutChart=computed(()=>{
   
        return{
        labels:[
        workout.value.map((item)=>item.date),

        ],
        datasets:[
            {
                label:['Average RPE'],
                data:averageRPE.map((item)=>item),
                backgroundColor:'#A020F0',
                borderColor: "#bae755",

            },
            
            {
                label:['Average Reps'],
                data:averageReps.map((item)=>item),
                backgroundColor:'white',
            }


        ]
        }
 
  


})


let fields=[{label:'name',key:'name'},{label:'weight',key:'weight'},{label:'reps',key:'reps'},{label:'set',key:'set'},{label:'actions',key:'actions'}]

let workoutFields=[{label:'Date',key:'date'}]

async function addExercise(workoutDetail)
{
    console.log(workoutDetail)
 
  await newWorkout(dateSelected.value,workoutDetail)
 
    

}

async function next()
{
    currentPage.value++;
    const{data:information}=await useFetch(`http://127.0.0.1:8000/api/workout?page=${currentPage.value}`,{
        method:'GET',
        headers:{
            'Authorization' :`Bearer ${token.value}`
        }
    })
    workout.value=information.value
   


}
async function previous()
{
    currentPage.value--;
    const{data:information}=await useFetch(`http://127.0.0.1:8000/api/workout?page=${currentPage.value}`,{
        method:'GET',
        headers:{
            'Authorization' :`Bearer ${token.value}`
        }
    })
    workout.value=information.value
   


}


let dateSelected=ref('')
</script>

<template>

   


  <div class="flex flex-col">
    
<div class="flex items-center justify-center">
    <AddExercise :showModal="showWorkoutModal" @update:showModal="showWorkoutModal=$event" v-model:date="dateSelected" @update:Date="dateSelected=$event" @updateWorkoutDetails="addExercise">

</AddExercise>

</div>
  





  
<div class="grid grid-cols-2 gap-x-3">
<div v-for="(item,count) in workout.data">
    <UCard class="w-[500px] h-[400px]">
        <template #header>
            {{ item.date }}
        </template>
        <div class="max-h-[200px] overflow-y-auto">

       
        <UTable  :rows="item.workout_detail" :columns="fields">

            
        </UTable>
        </div>
    </UCard>
 
  
   
   

    
</div>



</div>


   <UPagination v-model="currentPage" :total="total">
    <template #prev >
        <UButton @click="previous" icon="i-heroicons-arrow-small-left-20-solid">

        </UButton>
    </template>
    <template #next >
        <UButton @click="next" icon="i-heroicons-arrow-small-right-20-solid">

        </UButton>
    </template>


   </UPagination>


</div>



</template>

<style scoped>

</style>
