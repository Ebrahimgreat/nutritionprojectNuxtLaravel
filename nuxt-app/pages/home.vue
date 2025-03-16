<script setup lang="ts">




import {useWeight} from "~/composables/useWeight";
import moment from "moment";
import{useNutrientAdd} from "~/composables/addNewNutrient";
import { Card,CardContent,CardDescription } from "#components";
const {dateValue,weightData,addWeight}=useWeight();
const token=useCookie('token')
import { useUpdateWeight } from "#imports";
const{editedWeight,editedUpdatedWeight}=useUpdateWeight();
const{nutrientData,addNutrient}=useNutrientAdd();
import { Amphora,Apple,Egg,Donut } from "lucide-vue-next";


async function storeCustomFood()
{
    await $fetch('/api/nutrition/create',{
        method:'POST',
        body:{
            calories:50,
            protein:50,
            fat:50,
            carbs:10,
            user_id:1
        }
    })
}
let weightColumns=ref([{label:'Date',key:'date'},{label:'Scale Weight',key:'ScaleWeight'},{label:'Trend Weight',key:'trendWeight'}])

let newWeight=ref(30)
let editWeightId=ref(0)
let editWeightDate=ref('')
let editWeightvalue=ref(0)

function selectEditedWeight(item)
{
    console.log(item)
    editWeightId.value=item.id
    editWeightDate.value=item.date,
 editWeightvalue.value=item.ScaleWeight

}
async function updateWeight()
{
    await editedUpdatedWeight(editWeightId.value,editWeightvalue.value)

}
let showEditWeightModal=ref(false)
let time=ref('')

interface WeightCreation{
    date:string,
    scaleWeight:Number
}
const weightCreation=reactive<WeightCreation>({
    date:'',
    scaleWeight:0
})

interface Macros{
    calories:number,
    protein:number,
    carbs:number,
    fat:number
}

const macros=reactive<Macros>({
    calories:0,
    protein:0,
    carbs:0,
    fat:0
})

let showFoodModal=ref(false)
let showExerciseModal=ref(false)
import {useauthStore} from "~/stores/auth";
import chartMaker from "~/components/chartMaker.vue";


const store=useauthStore();
let authenticated=store.authenticated;
let date=moment();
let hour=date.hour();
let min=date.minute();
let currentTime=computed(()=>{
    return hour+ ':'+min
})

let currentDate=ref(date.format('YYYY-MM-DD'));
let currentDay=computed(()=>{
    if(date.day()==2){
        return "Tuesday"
    }
})
let expenditure=ref([])
let filteredExpenditure=ref([])
let nutrients=ref([])
let weights=ref([])
let units=ref([])

let showWeightModal=ref(false)
let nutrientPage=ref(0)
let nutrientTotal=ref(0)


let dateToSend=ref(currentDate.value)
let avgCalories=ref(0)

let goals=ref([])

// Example: Fetching Data
let weightsCopy=ref([])
let workout=ref([])
let workoutDetail=ref([])
let filteredWeights=ref([])
let filteredTrendWeight=ref([])
let filteredCalories=ref([])
let filteredMacros=ref([])

let currentPage=ref(0)
let weightTotal=ref(0)
let lastWeightPage=ref(0)





const{data:information}=await useAsyncData('information',()=>
$fetch('http://127.0.0.1:8000/api/dashboard',{
    method:'GET'

})
)

     nutrients.value=information.value.nutrients
     units.value=information.value.units
    expenditure.value=information.value.expenditure;

    weights.value=information.value.Weight

currentPage.value=information.value.Weight.current_page;
weightTotal.value=information.value.Weight.total;
nutrientPage.value=information.value.nutrients.current_page;
nutrientTotal.value=information.value.nutrients.total
lastWeightPage.value=information.value.Weight.last_page;


    goals.value=information.value.goals
    workout.value=information.value.workout
    workoutDetail.value=workout.value.map((item)=>({
        date:item.date,
        workoutDetail:item


    }))
    let sum=0;


let dateNutrient=ref('')

async function addNewNutrient()
{
   await addNutrient(token.value,dateNutrient.value,macros.protein,macros.calories,macros.carbs,macros.fat)

}


function viewNutrients()
{
    navigateTo('/nutrition')
}
function viewWeights()
{
    navigateTo('/weight')
}
function viewHabits()
{
    navigateTo('/habits')
}
function viewGoal()
{
    navigateTo('/goals')
}
let name=ref('')

onMounted(()=>{

    name.value=store.name

})
function navigateToNutrition()
{
    navigateTo('/nutrition')

}
function navigateToExercise()
{
    navigateTo('/workout')
}
function navigateToWeight()
{
    navigateTo('/weight')
}
function navigateToExpenditure()
{
    navigateTo('/expenditure')
}

async function createNewWeight()
{


    let data=await addWeight(currentDate.value,newWeight.value,token.value);
    console.log(data);
}


let visible=ref(false)

let authStore=useauthStore();

let currentTrendWeight=computed(()=>{
    return weights.value.data.dfind((item)=>item.date===currentDate.value)?.trendWeight|| 'Ready To Log Your Weight'
})

let currentWeight=computed(()=>{
    return weights.value.data.find((item)=>item.date===currentDate.value)?.ScaleWeight|| 'Ready To Log Your Weight ?'
})

let currentCalories=computed(()=>{

    return nutrients.value.data.filter((item)=>item.date===currentDate.value).reduce((sum,value)=>sum+(value.Calories)||0,0);

})
let currentProtein=computed(()=>{

return nutrients.value.data.filter((item)=>item.date===currentDate.value).reduce((sum,value)=>sum+(value.Protein)||0,0);

})
let currentFat=computed(()=>{

return nutrients.value.data.filter((item)=>item.date===currentDate.value).reduce((sum,value)=>sum+(value.Fat)||0,0);

})
let currentCarbs=computed(()=>{

return nutrients.value.data.filter((item)=>item.date===currentDate.value).reduce((sum,value)=>sum+(value.Fat)||0,0);

})


async function storeNutrientData()
{
    try{
    await $fetch('http://localhost:3001/nutrition',{
        method:'POST',
        body:{
            protein:150,
            carbs:160,
            fat:170
        }
    })
}
catch(error)
{
    console.log(erro)
}
}
let data=ref([])
async function getData()
{

    try{
        await $fetch('/api/nutrition/create',{
        method:'POST',
        body:{
            protein:100,
            fat:500,
            carbs:300,
            calories:200,
            user_id:1
        }
    })
}
    catch(error)
    {
        console.log(error)
    }

}

let tabs=[{label:'Nutrition',content:'Hello',key:'nutrition'},{label:'Weight',key:'weight'},{label:'Workout'},{label:'Expenditure'}]



const chartData = computed(() => ({
    labels:
        weights.value.data.map((item) => item.date),

    datasets: [
        {
            label: 'ScaleWeight',
            data: weights.value.data.map((item) => item.ScaleWeight),
            backgroundColor: '#A020F0',
            borderColor: "#bae755",

        },{
            label:'Trend Weight',
            data:weights.value.data.map((item)=>item.TrendWeight)
        }
    ]
}));

const nutrientChart=computed(()=>({
    labels:
        nutrients.value.data.map((item) => item.date),

    datasets: [
        {
            label: 'Calories',
            data: nutrients.value.data.map((item) => item.Calories),
            backgroundColor: '#A020F0',
            borderColor: "#bae755",

        },{
            label:'Protein',
            data:nutrients.value.data.map((item)=>item.Protein),
            borderColor: "red",

        }
    ]

}))


let nutrientFields=[{label:'Date',key:'date'},{label:'Calories',key:'Calories'},{label:'Protein',key:'Protein'},{label:'Carbs',key:'Carbs'}]


async function getNextPage()
{
    if(currentPage.value==lastWeightPage.value)
{

}
    currentPage.value++;
    const data=await $fetch(`http://127.0.0.1:8000/api/dashboard?weights=${currentPage.value}`)
    weights.value=data.Weight;

}



watch(weightData,(newValue)=>{
    weights.value.push(newValue)

}),{deep:true}

watch(nutrientData,(newValue)=>{
    if(newValue){


   let index=nutrients.value.data.findIndex((item)=>item.date===newValue.date);
   if(index!=-1)
   {

   nutrients.value.data[index]={
    Calories:newValue.Calories,
    Protein:newValue.Protein,
    date:newValue.date,
   };
}
else{
    console.log('true')

    nutrients.value.data.push(newValue)
    }
}


}),{deep:true}





</script>
<template>


<div class="grid grid-cols-4 gap-x-3">


        <UCard class=" ">
            <template #header>


                <div class="flex items-center justify-center">
                    <Donut>
                    </Donut>


                    <div class="flex flex-col">


               <span class="text-lg font-semibold">
                {{currentCalories}}
               </span>
               <span class="text-sm">Calories</span>
               </div>


            </div>

            </template>

        </UCard>
        <UCard class="">
            <template #header>

                <div class="flex items-center justify-center">
                    <Apple>
                    </Apple>
               <div class="flex flex-col">

               <span class="text-lg font-semibold">
                {{currentCarbs}}
               </span>
               <span class="text-sm">Carbs</span>

               </div>
            </div>

            </template>

        </UCard>
        <UCard class="">
            <template #header>

                <div class="flex items-center justify-center">
                  <Egg>

                  </Egg>
               <div class="flex flex-col">

               <span class="text-lg font-semibold">
                {{currentCalories}}
               </span>
               <span class="text-sm">Protein</span>

               </div>
            </div>

            </template>

        </UCard>
        <UCard class="">
            <template #header>

                <div class="flex items-center justify-center">
                    <Amphora>
                    </Amphora>
                                   <div class="flex flex-col">

               <span class="text-lg font-semibold">
                {{currentFat}}
               </span>
               <span class="text-sm">Fat</span>

               </div>
            </div>

            </template>

        </UCard>

    </div>




    <div class="flex flex-col  h-screen">


        <div class="grid grid-cols-2 gap-x-3">


        <UCard>
            <template #header>
                <ChartMaker :data="nutrientChart"/>
            </template>
        </UCard>
        <UCard class="w-full">
            <template #header>

                Nutrition
                </template>
                <UTable :columns="nutrientFields" :rows="nutrients.data">
                    <template #caption>
                        <caption>
                            <NutrientAdd v-model:dateValue="dateNutrient" @update:DateValue="dateNutrient=$event" v-model:calories="macros.calories" v-model:protein="macros.protein" v-model:carbs="macros.carbs" v-model:fat="macros.fat" @update:Carbs="macros.carbs=$event" @update:Fat="macros.fat=$event" @update:Protein="macros.protein=$event" @update:calories="macros.calories=$event"       :show-modal="showFoodModal" @update:showModal="showFoodModal=$event" @storeFood="addNewNutrient">

                            </NutrientAdd>
                        </caption>
                    </template>
                    </UTable>
                    <UPagination v-model:model-value="nutrientPage" :total="nutrientTotal">

                    </UPagination>



        </UCard>


    </div>

    <div class="grid grid-cols-2 gap-x-3 mt-10">
        <UCard class="w-full h-full">
            <template #header>
     <div class="flex flex-col">
       <span class="w-full">

    Scale Weight
      </span>
        {{ currentWeight }}

     </div>

            </template>


        </UCard>
        <UCard class="w-full h-full">
            <template #header>
                Trend Weight
            </template>

        </UCard>
    </div>


    <div class="grid grid-cols-2 gap-x-3 mt-10 ">
        <UCard class="">
            <template #header>

                <ChartLine :data="chartData"/>



            </template>

        </UCard>
        <UCard class="">

            <UTable :rows="weights.data" :columns="weightColumns">
                <template #caption>
                    <caption>
                        <CreateWeight :showModal="showWeightModal" :date="weightCreation.date" :newWeight="weightCreation.scaleWeight" @update:Date="weightCreation.date=$event" @update:newWeight="weightCreation.scaleWeight=$event"  @update:showModal="showWeightModal=$event" @createNewWeight="createNewWeight">

                        </CreateWeight>
                    </caption>
                </template>


            </UTable>
            <UPagination  v-model:model-value="currentPage" :total="weightTotal">
                <template #next>
                    <UButton @click="getNextPage" icon="i-heroicons-arrow-small-right-20-solid">

                    </UButton>
                </template>
                <template #prev>
                    <UButton icon="i-heroicons-arrow-small-right-20-solid">

</UButton>
                </template>

            </UPagination>

        </UCard>


    </div>



    </div>













</template>

<style scoped>

</style>
