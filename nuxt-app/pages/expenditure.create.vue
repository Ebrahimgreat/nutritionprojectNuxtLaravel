<script setup lang="ts">
import{Input,Label} from "#components";


import ButtonCustom from "~/components/UI/buttonCustom.vue";
import { Stepper,StepperDescription,StepperIndicator,StepperItem,StepperTitle } from "#components";

const activityLevel=[
    'sedentary','moderate','active','extremely High Active'
    ];

let weight=ref(50)
let sex=ref([
    'male','female'
]);

let min=ref(30);
let max=ref(150);


let unit=ref(0)
let name=ref('')

watch(unit,(value)=>{
    if(value=='pounds')
    {
        weight.value=(2.2*weight.value).toFixed(1);
        min.value=2.2*min.value;
        max.value=2.2*min.value;



    }
    else{
        weight.value=50;
        min.value=30;
        max.value=150;
    }
})

async function getExpenditure()
{

}


const token=useCookie('token');
const height=ref(1.6)
onMounted(()=>{
    name=localStorage.getItem('name')
})

function back()
{
    navigateTo('/expenditure');
}
</script>

<template>

    <div class="flex items-center justify-center">


    <Stepper>
        <StepperItem :step="1">
            <StepperIndicator>
                
            
            </StepperIndicator>
            <StepperTitle>
                Ready To Reset up Your Expenditure

            </StepperTitle>
            </StepperItem>
        
    </Stepper>
    </div>




    <form class="bg-pink shadow-md rounded px-8 pt-6 pb-8 mb-4 w-full">
        <h1 class="text-center text-3xl text-white font-bold block mb:1:mb:0 pr-4"> New Expenditure</h1>


        <Label>
            Name
        </Label>



        <input disabled v-model="name" class="block text-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">
    <label class="black text-gray-500 font-bold mb-1:mb-0 pr-4">
        Height
    </label>
        <input v-model="height" type="range" min="1" max="2.5" step="0.1" >
        {{height}}
        <label class="block text-gray-500 font-bold mb-1:mb-0 pr-4">
            Weight
        </label>
        <input v-model="weight" :min="min" :max="max" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 focus:outline-none focus:bg-white focus:border-purple-500" type="range">
        {{weight}}
       <input type="radio" name="radio" v-model="unit" value="kilogram">
        Kilograms
        <input type="radio" name="radio" v-model="unit" value="pounds">
        Pounds

        <label class="block text-gray-500 font-bold mb-1:mb-0 pr-4">
            Activity
        </label>
        <select class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 focus:outline-none focus:bg-white focus:border-purple-500">

            <option v-for="item in activityLevel"  :value="item">
                {{item}}
            </option>

        </select>

        <label class="block text-gray-500 font-bold mb-1:mb-0 pr-4">
            Sex
        </label>
        <select class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 focus:outline-none focus:bg-white focus:border-purple-500">

            <option v-for="item in sex"  :value="item">
                {{item}}
            </option>
        </select>

        <h1 class="text-center"><button-custom>
            Submit


        </button-custom>
        </h1>




    </form>



</template>

<style scoped>

</style>
