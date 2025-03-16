<script setup lang="ts">

import{usetimeStore} from "~/stores/timeStore";
let timeStore=usetimeStore()
import{usenutritionstore} from "~/stores/nutritionRecords";
import{useRoute} from "#vue-router"
import moment from "moment";
import {parseDate} from "@internationalized/date";
let date=ref()
import{Table,TableHeader,TableBody,TableRow,TableCaption,TableCell} from '#components';

let currentDate = ref(moment())
import { Card,CardHeader,CardTitle,CardFooter } from "#components";

let nowDate=currentDate.value.format('YYYY-MM-DD')

let consumedCalories=ref(0)
import {useNutritionStore} from "~/stores/nutritionStore";
const nutritionStore=useNutritionStore();

let showNutrientModel=ref(false)


const statNutrition=['Consumed']

let nutrientData=ref([
    {time:'12',Calories:0,Protein:0, Carbs:0, Fat:0},
    {time:'01',Calories:0, Protein:0, Carbs:0, Fat:0},
    {time:'02',Calories:0, Protein:0, Carbs:0, Fat:0},
    {time:'03',Calories:0,},
    {time:'04',Calories:0,},
    {time:'05',Calories:0,},
    {time:'06',Calories:0,},
    {time:'07',Calories:0,},
    {time:'08',Calories:0,},
    {time:'09',Calories:0,},
    {time: '10',Calories:0},
    {time: '11',Calories:0},
    {time: '13',Calories:0},
    {time: '14',Calories:0},
    {time: '15',Calories:0},
    {time: '16',Calories:0,Protein:0,Carbs:0,Fat:0},
    {time: '17',Calories:0},
    {time: '18',Calories:0},
    {time: '19',Calories:0},
    {time:'20','Calories':0},
    {time:'21',Calories:0},
    {time:'22',Calories:0},
    {time:'23',Calories:0},





]);

let foodName=ref('Hello')
let calories=ref(0);
let protein=ref(0);
let fat=ref(0);
let carbs=ref(0)



let consumedFat=ref(0)
let consumedCarbs=ref(0)
let previousVal=ref(false)
let consumedProtein=ref(0)




const{data:nutritionRecords}=await useAsyncData('nutritionRecords',()=>
    $fetch('http://127.0.0.1:8000/api/nutritionRecords',{
        method:'GET',
        query:{date:date.value}
    })
)


         consumedCalories.value+=nutritionRecords.value.reduce((sum,item)=>
           sum+item.Calories,0
         )
         consumedFat.value+=nutritionRecords.value.reduce((sum,item)=>
         sum+item.Fat,0)
        consumedCarbs.value+=nutritionRecords.value.reduce((sum,item)=>
        sum+item.Carbs,0);
         consumedProtein.value+=nutritionRecords.value.reduce((sum,item)=>
         sum+item.Protein,0)


        containsElement()


function back()
{
    navigateTo('/home')
}

function containsElement(){
    var x=nutritionRecords.value.length;
    var y=nutrientData.value.length;
    for(let i=0; i<x; i++)
    {
        for(let j=0; j<y; j++)
        {
            if(nutrientData.value[j].time===nutritionRecords.value[i].time)
            {
               nutrientData.value[j].Calories=nutritionRecords.value[i].Calories;
                nutrientData.value[j].Carbs=nutritionRecords.value[i].Carbs;
                nutrientData.value[j].Fat=nutritionRecords.value[i].Fat;
                nutrientData.value[j].Protein=nutritionRecords.value[i].Protein;


            }

        }

    }


}

function addNewFood()
{

    console.log(timeValue.value)

    
    let foundIndex=nutrientData.value.findIndex(item=>item.time===timeValue.value);
    console.log(foundIndex)
 nutrientData.value[foundIndex]={
    ...nutrientData.value[foundIndex],
    Calories:calories.value,
    Protein:protein.value,
    Carbs:carbs.value,
    Fat:fat.value
 }

    

    

}


function previousDate()
{
    previousVal.value=true;

  currentDate.value=currentDate.value.subtract(1,'days');
  console.log(currentDate.value.format('YYYY-MM-DD'))
  navigateTo({
      path:'/nutrition/nutrition.show',
      query:{date:currentDate.value.format('YYYY-MM-DD')},

  })
    previousVal.value=false;

}

function nextDate()
{

    currentDate.value=currentDate.value.add(1,'days');
    console.log(currentDate.value.format('YYYY-MM-DD'))
    navigateTo({
        path:'/nutrition/nutrition.show',
        query:{date:currentDate.value.format('YYYY-MM-DD')}
    })

}


let dateNow=moment();

let hour=dateNow.hour();
let selectTime=ref(hour+':'+ '00')

function selectFoodToBeAdded(item)
{
    console.log('You clicked me')
    selectTime.value = String(item.time) + ':00';
    console.log(selectTime.value)


}







let timeValue=ref('')
 function updateTime(time:string)
{
    timeValue.value=time;

}




function openFoodModal(){
    showNutrientModel.value=true;
}

const days=['1','2','3','4','5','6','7']
const daysName=['M','T','W','T','Fri','S','S']




</script>

<template>
        

<div class="flex flex-col ">


  <h1 class="text-white">

  </h1>


  <UCard>
    <template #header>
        
      <h1 class="text-center">

       Today
       </h1>
    </template>
  

    
       
        <h2 class="text-center text-white">
       Calories: {{ consumedCalories }}

            </h2>




        <div v-for="(item) in statNutrition" class=" text-white">

            <div class="flex flex-col">
                <div class="flex-1">

                  Protein:{{consumedProtein}}
                </div>
                <div class="flex-1">

                   Carbs:  {{consumedCarbs}}
                </div>
                <div class="flex-1">
               Fat:  {{consumedFat}}
                </div>

            </div>





  
    </div>
    </UCard>




<div class=" overflow-y-auto max-h-96">
    


  

    <Table>
        <TableHeader>
            <TableRow>


            <TableHead>
      

            </TableHead>
            </TableRow>

        </TableHeader>
        <TableBody v-for="item in nutrientData">

            <TableRow>
                <TableCell @click="openFoodModal">
                
             <UButton>

          {{ item.time }}
          </UButton>
        

                </TableCell>

            </TableRow>
        </TableBody>
    </Table>

    <nutrient-add :showModal="showNutrientModel" @update:showModal="showNutrientModel=$event" @storeFood="addNewFood">
{{ item.time }}
         </nutrient-add>



        <table class=" w-full text-left">
        <thead>


        <tr>
        <th class="px-4 py-2 border-blue-gray-100 bg-blue-gray-50 text-white"> Time</th>
        </tr>
        </thead>





<tbody>


<tr class=" text-black text-sm font bold    items-center" v-for="item in nutrientData">


    <td  class="text-white px-3 py-2" @click="selectFoodToBeAdded(item)">







        <div v-if="item.Calories!=0" class="">
            <Card class="mt-5">
                <CardHeader>
                    <CardTitle>
                        Food Name
                    </CardTitle>

                </CardHeader>
                <CardContent>
                    Calories: {{item.Calories}}
                    Protein: {{item.Protein}}
                    Fat:{{item.Fat}}
                    Carbs:{{item.Carbs}}
                </CardContent>
            </Card>

        </div>

    </td>

    </tr>
</tbody>
        </table>
</div>







</div>


</template>

<style scoped>
.next{
    float:right;
    color:white;
}
.prev{
    color:white;
}
.page-enter-active,
.page-leave-active {
    transition: all 0.4s;
}
.page-enter-from,
.page-leave-to {
    opacity: 0;
    filter: blur(1rem);
}

</style>
