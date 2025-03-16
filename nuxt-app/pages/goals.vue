<script setup lang="ts">

import ButtonCustom from "~/components/UI/buttonCustom.vue";

let goals=ref([])
let currentGoal=ref()
let goalWeight=ref()
let goalRate=ref()
const days=['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday']
const macros=['Protein','Carbs','Fats'];
const goalFields=['name','goalStarted','goalStatus','approach','goalWeight']

let goalMacros=[{day:'Monday',calories:0,protein:0,fat:0,carbs:0},{
    day:'Tuesday',calories:0,protein:0,fat:0,carbs:0

},
    {
        day:'Wednesday',calories:0,protein:0,fat:0,carbs:0

    },
    {
       day:'Thursday', calories:0,protein:0,fat:0,carbs:0

    },
    {
        day:'Friday',calories:0,protein:0,fat:0,carbs:0

    },
    {
        day:'Saturday',calories:0,protein:0,fat:0,carbs:0

    },

]
function back()
{
    navigateTo('/home');
}
function createGoal()
{
    navigateTo('/goals.create')
}
async function goalsFunc()
{
    try{
        goals.value=await $fetch('http://127.0.0.1:8000/api/goals',{
            method:'GET',

        });

        currentGoal.value=goals.value[0].name
        goalRate.value=goals.value[0].goalRate
        goalWeight.value=goals.value[0].goalWeight


    }
    catch(error)
    {
        console.log(error)
    }
}
onMounted(()=>{
goalsFunc()
})
</script>

<template>




    <div class="flex flex-col h-screen">
        <div class="flex flex-row text-white">
            <div class="flex flex-1">


           <button-custom @click="createGoal">

               New Goal
           </button-custom>

            </div>
            <div class="flex flex-1">


           <button-custom>

     Edit Goal
           </button-custom>
            </div>
            <div class="flex flex-1">
               <button-custom>
                   Delete Goal
               </button-custom>

            </div>
        </div>

        <div class="text-3xl  font-thin text-white text-center p-16 border-2 w-full ">
            Goal: <b>{{currentGoal}}</b>
        </div>

        <div class="  w-full text-center text-gray-200 ">




<div class="flex flex-row">

    <div v-for="item in goalMacros" class="flex-1">
        {{item.day}}




        <div class="flex flex-col gap-y-3.5">


            <div class="flex-1">

               Calories: {{item.calories}}

            </div>



            <div class="flex-1">

              Protein:  {{item.protein}}


            </div>
<div class="flex-1">

  Carbs:  {{item.carbs}}

</div>
            <div class="flex-1">

             Fat:   {{item.fat}}


        </div>
        </div>

</div>
</div>
        </div>





   <div class="text-gray-700  shadow-md rounded-xl flex-auto">

     <h2 class="text-center text-white text-3xl">
         Goal History

     </h2>


    <table class="table-auto  text-white w-full text-left">
       <tr>
           <th class="px-4 py-2 border-blue gray-100" v-for="item in goalFields">
               {{item}}
           </th>

        </tr>



            <tr v-for="item in goals">
                <td class="px-4 py-2">{{item.name}}</td>
                <td class="px-4 py-2">{{item.approach}}</td>
                <td class="px-4 py-2">{{item.goalWeight}}</td>


            </tr>

    </table>

   </div>
    </div>

</template>


<style scoped>

</style>
