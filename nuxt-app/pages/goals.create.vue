<script setup lang="ts">
import {reactive} from "vue";
import type {Integer} from "type-fest";
import {Stepper,StepperIndicator,StepperTrigger,StepperItem} from "~/components/ui/stepper";
import { Card,CardTitle,CardHeader,Select,SelectContent,SelectItem } from "#components";
import StepperSeparator from "~/components/UI/stepper/StepperSeparator.vue";



let questions=[['Weight Gain','Weight Loss','Weight Maintain'],[{goalWeight:'Goal Weight',goalRate:'Goal Weight'}],[{protein:['Moderate Protein','High Protein'],preference:['Low Carb','Low Fat','Balanced','Custom']}],['Summary']]



let form=reactive({
    plan:ref()
})

const currentExpenditure=ref()
const names=['Weight Gain','Weight Loss', 'Weight Maintainence']
const approach=['low Carb','Low Fat','Balanced','Custom']

const goalWeight=ref(65)
const goalRate=ref(0.5);


let ratios=ref(['30','30','30'])
let index=ref(0);
let selectedValue=ref(questions[index])
const min=30;
const max=130;
const minRate=0.1;
const maxRate=1.5;

const token=useCookie('token')

const userMessage=computed(()=>{
    if(goalRate.value==0.5)
    {
        return "Recommended Approach";
    }
    else{
        return "";
    }
})


function selectValue(count)
{
    selected.value=count;

}

let currentWeight=ref()



async function getLatestExpenditure()
{
    try{
        const data=await $fetch('http://127.0.0.1:8000/api/latestExpenditure',{
            method:'GET',
            headers:{
                'Authorization':`Bearer ${token.value}`
            }
        })
        currentExpenditure.value=data;
    }
    catch(error){
        console.log(error)
    }
}
async function getCurrentWait()
{
    try{
        const data= await $fetch('http://127.0.0.1:8000/api/getCurrentWeight',{
            method:'GET',
            headers:{
                'Authorization':`Bearer ${token.value}`
            }
        })
        currentWeight.value=data;

    }
    catch (error){
        console.log(error)
    }
}
function toggleValue()
{


    index.value++;





}
let preference=ref(0);
let proteinIntake=ref(0);
function selectProtein(count)
{
    proteinIntake.value=count;
}
function selectPreference(count)
{
    preference.value=count;



}
function back()
{
    console.log("back")
   if(index.value>0){
       index.value--;
   }
    selectedValue.value=questions[index.value];

}


let stepValue=ref(0)


const planning=ref(['Balanced','Weekend Bliss','Custom'])

watch(()=>planning,
    ()=>
    {
        if(value==='Balanced')
        {
            console.log('balance')
        }





})

let selected=ref(false);

const days = computed(() => {

    // Split the goalRate across 7 days
 // Split expenditure across 7 days

    if(proteinIntake.value===0 && preference.value==1) {

        const dailyRate = goalRate.value / 7;
        const dailyCalories=dailyRate+currentExpenditure.value
        const dailyProtein=1.6*currentWeight.value;
        const proteinCalories=dailyProtein*4;
        const remainingCalories=dailyCalories-proteinCalories;
        const dailyCarbs=(0.80*remainingCalories)/4;
        const dailyFat=(0.20*remainingCalories)/9;
        return [
            {
                day: 'Monday',
                calories: dailyCalories,
                protein: dailyProtein,
                carbs:dailyFat,

            },
            {day: 'Tuesday', calories: dailyCalories, protein: dailyProtein,carbs:dailyCarbs,fat:dailyFat},
            {day: 'Wednesday', calories: dailyCalories, protein: dailyProtein,carbs:dailyCarbs,fat:dailyFat},
            {day: 'Thursday', calories: dailyRate + currentExpenditure.value, protein:dailyProtein,carbs:dailyCarbs,fat:dailyFat},
            {day: 'Friday', calories: dailyRate + currentExpenditure.value, protein: dailyProtein,carbs:dailyCarbs,fat:dailyFat},
            {day: 'Saturday', calories: dailyRate + currentExpenditure.value, protein: dailyProtein,carbs:dailyCarbs,fat:dailyFat},
            {day: 'Sunday', calories: dailyCalories,protein:dailyProtein,carbs:dailyCarbs,fat:dailyCarbs},
        ];
    }
   else  if(proteinIntake.value===1 && preference.value==1) {
        const dailyRate = goalRate.value / 7;
        const dailyCalories=dailyRate+currentExpenditure.value;
        const dailyProtein=2.2*currentWeight.value;
        const proteinCalories=dailyProtein*4;
        const remainingCalories=dailyCalories-proteinCalories;
        const dailyCarbs=0.80*remainingCalories/4;
        const dailyFat=0.20*remainingCalories/9;

        return [

            {
                day: 'Monday',
                calories: dailyCalories,
                protein: dailyProtein,
                carbs:dailyCarbs,
                fat: dailyFat
            },
            {day: 'Tuesday', calories: dailyCalories, protein: dailyProtein,carbs:dailyCarbs,fat:dailyFat},
            {day: 'Wednesday', calories: dailyCalories, protein: dailyProtein,carbs:dailyCarbs,fat:dailyFat},
            {day: 'Thursday', calories: dailyRate + currentExpenditure.value, protein:dailyProtein,carbs:dailyCarbs,fat:dailyFat},
            {day: 'Friday', calories: dailyRate + currentExpenditure.value, protein: dailyProtein,carbs:dailyCarbs,fat:dailyFat},
            {day: 'Saturday', calories: dailyRate + currentExpenditure.value, protein: dailyProtein,carbs:dailyCarbs,fat:dailyFat},
            {day: 'Sunday', calories: dailyCalories,protein:dailyProtein,carbs:dailyCarbs,fat:dailyCarbs},
        ];
    }
    else  if(proteinIntake.value===1 && preference.value==0) {
        const dailyRate = goalRate.value / 7;
        const dailyCalories=dailyRate+currentExpenditure.value;
        const dailyProtein=2.2*currentWeight.value;
        const proteinCalories=dailyProtein*4;
        const remainingCalories=dailyCalories-proteinCalories;
        const dailyCarbs=0.20*remainingCalories/4;
        const dailyFat=0.80*remainingCalories/9;

        return [

            {
                day: 'Monday',
                calories: dailyCalories,
                protein: dailyProtein,
                carbs:dailyCarbs,
                fat: dailyFat
            },
            {day: 'Tuesday', calories: dailyCalories, protein: dailyProtein,carbs:dailyCarbs,fat:dailyFat},
            {day: 'Wednesday', calories: dailyCalories, protein: dailyProtein,carbs:dailyCarbs,fat:dailyFat},
            {day: 'Thursday', calories: dailyRate + currentExpenditure.value, protein:dailyProtein,carbs:dailyCarbs,fat:dailyFat},
            {day: 'Friday', calories: dailyRate + currentExpenditure.value, protein: dailyProtein,carbs:dailyCarbs,fat:dailyFat},
            {day: 'Saturday', calories: dailyRate + currentExpenditure.value, protein: dailyProtein,carbs:dailyCarbs,fat:dailyFat},
            {day: 'Sunday', calories: dailyCalories,protein:dailyProtein,carbs:dailyCarbs,fat:dailyCarbs},
        ];
    }

    else  if(proteinIntake.value===0 && preference.value==0) {
        const dailyRate = goalRate.value / 7;
        const dailyCalories=dailyRate+currentExpenditure.value;
        const dailyProtein=1.6*currentWeight.value;
        const proteinCalories=dailyProtein*4;
        const remainingCalories=dailyCalories-proteinCalories;
        const dailyCarbs=0.20*remainingCalories/4;
        const dailyFat=0.80*remainingCalories/9;

        return [

            {
                day: 'Monday',
                calories: dailyCalories,
                protein: dailyProtein,
                carbs:dailyCarbs,
                fat: dailyFat
            },
            {day: 'Tuesday', calories: dailyCalories, protein: dailyProtein,carbs:dailyCarbs,fat:dailyFat},
            {day: 'Wednesday', calories: dailyCalories, protein: dailyProtein,carbs:dailyCarbs,fat:dailyFat},
            {day: 'Thursday', calories: dailyRate + currentExpenditure.value, protein:dailyProtein,carbs:dailyCarbs,fat:dailyFat},
            {day: 'Friday', calories: dailyRate + currentExpenditure.value, protein: dailyProtein,carbs:dailyCarbs,fat:dailyFat},
            {day: 'Saturday', calories: dailyRate + currentExpenditure.value, protein: dailyProtein,carbs:dailyCarbs,fat:dailyFat},
            {day: 'Sunday', calories: dailyCalories,protein:dailyProtein,carbs:dailyCarbs,fat:dailyCarbs},
        ];
    }
   else  if(proteinIntake.value===0 && preference.value==2) {

        const dailyRate = goalRate.value / 7;
        const dailyCalories=dailyRate+currentExpenditure.value
        const dailyProtein=1.6*currentWeight.value;
        const proteinCalories=dailyProtein*4;
        const remainingCalories=dailyCalories-proteinCalories;
        const dailyCarbs=(0.65*remainingCalories)/4;
        const dailyFat=(0.35*remainingCalories)/9;
        return [
            {
                day: 'Monday',
                calories: dailyCalories.toFixed(0),
                protein: dailyProtein,
                carbs:dailyFat,

            },
            {day: 'Tuesday', calories: dailyCalories, protein: dailyProtein,carbs:dailyCarbs,fat:dailyFat},
            {day: 'Wednesday', calories: dailyCalories, protein: dailyProtein,carbs:dailyCarbs,fat:dailyFat},
            {day: 'Thursday', calories: dailyRate + currentExpenditure.value, protein:dailyProtein,carbs:dailyCarbs,fat:dailyFat},
            {day: 'Friday', calories: dailyRate + currentExpenditure.value, protein: dailyProtein,carbs:dailyCarbs,fat:dailyFat},
            {day: 'Saturday', calories: dailyRate + currentExpenditure.value, protein: dailyProtein,carbs:dailyCarbs,fat:dailyFat},
            {day: 'Sunday', calories: dailyCalories,protein:dailyProtein,carbs:dailyCarbs,fat:dailyCarbs},
        ];
    }
    else  if(proteinIntake.value===1 && preference.value==2) {

        const dailyRate = goalRate.value / 7;
        const dailyCalories=dailyRate+currentExpenditure.value
        const dailyProtein=2.2*currentWeight.value;
        const proteinCalories=dailyProtein*4;
        const remainingCalories=dailyCalories-proteinCalories;
        const dailyCarbs=(0.65*remainingCalories)/4;
        const dailyFat=(0.35*remainingCalories)/9;
        return [
            {
                day: 'Monday',
                calories: dailyCalories,
                protein: dailyProtein,
                carbs:dailyFat,

            },
            {day: 'Tuesday', calories: dailyCalories, protein: dailyProtein,carbs:dailyCarbs,fat:dailyFat},
            {day: 'Wednesday', calories: dailyCalories, protein: dailyProtein,carbs:dailyCarbs,fat:dailyFat},
            {day: 'Thursday', calories: dailyRate + currentExpenditure.value, protein:dailyProtein,carbs:dailyCarbs,fat:dailyFat},
            {day: 'Friday', calories: dailyRate + currentExpenditure.value, protein: dailyProtein,carbs:dailyCarbs,fat:dailyFat},
            {day: 'Saturday', calories: dailyRate + currentExpenditure.value, protein: dailyProtein,carbs:dailyCarbs,fat:dailyFat},
            {day: 'Sunday', calories: dailyCalories,protein:dailyProtein,carbs:dailyCarbs,fat:dailyCarbs},
        ];
    }


});


let message=computed(()=>{
    if(stepValue.value==1)
{
    return "What is Your Goal"
}
})

getCurrentWait();
getLatestExpenditure()
</script>

<template>
    



    <div class=" text-gray-700 bg-black text-white  shadow-md   h-screen  items-center justify-center">

        <Stepper v-model="stepValue" class="bg text-white">
            {{ stepValue }}
            <StepperItem :step="1">
                <StepperTrigger>

                    <StepperIndicator>
                        1

                    </StepperIndicator>
                    <StepperTitle>
                        Step1
                    </StepperTitle>
                    <StepperDescription>

                  


                    </StepperDescription>
                
            
                </StepperTrigger>
           
                <StepperSeparator/>


            </StepperItem>
            <StepperItem  :step="2">
                <StepperTrigger>

                <StepperIndicator>
                    2
                </StepperIndicator>
                <StepperDescription>
                    
                </StepperDescription>
                </StepperTrigger>
            </StepperItem>
        </Stepper>

        <div class="flex items-center justify-center">
            <div v-if="stepValue==1">
            <Card class="bg-white">
                <CardHeader>

      
                <CardTitle>
                   What is Your Goal
                </CardTitle>
                </CardHeader>
                <CardContent>
                    <Select>
                       <SelectTrigger>
                        </SelectTrigger>
                    </Select>
                </CardContent>
                
            </Card>
         
        </div>
        <div v-if="stepValue==2">
            <Card>
                <CardHeader>
                    <CardTitle>
                    What is Your Goal Weight
                    </CardTitle>
                </CardHeader>
            </Card>
            
        </div>
        </div>

       

</div>










</template>

<style scoped>

</style>
