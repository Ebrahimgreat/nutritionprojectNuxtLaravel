<script setup lang="ts">
import {definePageMeta} from "#imports";
import moment from "moment";

definePageMeta({
    layout:'default'
})



import{ref,watch} from 'vue';

let borders=ref(Array(31).fill('none'));
let currentIndex=ref(10);
const months=['January','Febuary','March','April','May','June','July','Aughust','September','October','November','December'];

const days=[31,28,31,30,31,30,31,31,30,31,30,31]

let habits=ref([])
async function getData()
{
    try{
        habits.value=await $fetch('http://127.0.0.1:8000/api/habits',{
            method:"GET"
        })
    }
    catch (error)
    {
        console.log(error)
    }


}
function dashboard()
{
    navigateTo('/home');
}
function navigateBack()
{
    if(currentIndex.value<=0)
    {
        currentIndex.value=11;
    }
    else {
        currentIndex.value--;
    }

}
function navigateForward()
{
    if(currentIndex.value>=11)
    {
        currentIndex.value=0;
    }
    else {
        currentIndex.value++;
    }
}
const information=computed(()=>{
   selectedDays.value.forEach(item=>{
      if(item==true)
      {
          return 'Hello';
      }
   })

})
let colors=ref(Array(31).fill('black'));

let selectedDays=ref(Array(31).fill(false))
function dateValue(value)
{

   colors.value[value]=colors.value[value]=='black'?'Blue':'black';
   borders.value[value]=borders.value[value]==='none'?'2px solid black':'none';
console.log(borders.value[value])

    console.log('You clicked me');
}
async function borderColor()
{



}



function toggleDay(index){
    console.log(index);
    selectedDays.value[index]= !selectedDays.value[index];
}
onMounted(()=>{
    getData()
    borderColor()
})
</script>


<template>
    {{currentIndex}}

    <button-custom @click="dashboard">
Dashboard

    </button-custom>

   <div class="month">
       <ul>


          <li> <button @click="navigateBack" class="prev">&#10094;

           </button>
          </li>
           <li> <button @click="navigateForward" class="next">&#10095;
           </button></li>
           <li>
               <span style="font-size:18px">
                   {{months[currentIndex]}}
               </span>

           </li>


      </ul>
       <ul></ul>

   </div>

<div class="h-screen">
    <ul class="weekdays">
        <li> Mon</li>
        <li> Tue</li>
        <li> Wed</li>
        <li> Thur</li>
        <li> Fri</li>
        <li> Sat</li>
        <li> Sun</li>
    </ul>
    <ul class="days">
        <li v-for="count in days[currentIndex]">
        <button :class="{'button-selected':selectedDays[count]}">
            {{count}}
            </button>
        </li>
    </ul>

    {{information}}

</div>
</template>


<style scoped>

.button-selected{
    background-color:pink;
    border:2px solid green;
    border-radius:20px;
}

.month{
    padding:30px 25px;
    height:100%;
   background-color:black;
    text-align: center;
}
.month ul{
    margin:0;
    padding:0;

}
.month ul li{
    color:white;
    font-size:20px;
    text-transform:upperCase;
    letter-spacing:3px;
}
.month .prev{
    float:left;
    padding-top:10px;
}
.month .next{
    float:right;
    padding-top:10px;
}
.weekdays{
    margin:0;
    padding:10px 0;
    background-color:black;
    border:1px;
}
.weekdays li{
    display:inline-block;
    width:13.6%;
    color:#666;
    text-align:center;
}
.days{
    background:black;
    color:white;
    margin:0;

}
.days li{
    list-style-type:none;
    display:inline-block;
    width:13.6%;
    text-align:center;
    margin-bottom:5px;
    color:#777;
    font-size:12px;
}
@media screen and (max-width:720px) {
    .weekdays li, .days li{width:13.1%;}

}
@media screen and(max-width:420px) {
    .weekdays li, .days li{width:12.5%;}

}
@media  screen and (max-width:290px) {
    .weekdays li, .days li{width:12.2%;}


}
.yellow{
    background-color:#bbb;
    border-radius:100%;





}




</style>
