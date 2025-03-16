<script setup lang="ts">

import {definePageMeta} from "#imports";
import{useNutritionStore} from "~/stores/nutritionStore";
import chartMaker from "~/components/chartMaker.vue"
import moment from "moment";
import WeeklyCompliance from "~/components/weeklyCompliance.vue";


const nutrientStore=useNutritionStore()
const token=useCookie('token')
let calories=ref([])
let macros=ref([])
let nutritionStore=usenutritionstore()
definePageMeta({
    layout:'default'
})
let nutrients=ref<{nutrientName:string; value:Number}[]>([]);
let currentPage=ref()
let total=ref(0)
let lastPage=ref(0)

const{data:information}=await useAsyncData('nutrients',()=>
$fetch('/api/nutrition/show',{
    method:'GET'
}))
nutrients.value=information.value
currentPage.value=information.value.current_page
total.value=information.value.total
lastPage.value=information.value.last_page



function dashboard()
{
    navigateTo('/home')
}
let graphValue=ref('day')
function show(nutrient)
{
    nutrientStore.setData(nutrient.date,nutrient.Protein,nutrient.Carbs,nutrient.fat)
    nutrientStore.setProteinValue(nutrient.Protein)
    navigateTo({
            path: '/nutrition/nutrition.show',
            query: {date: nutrient.date}
        }
    )

}

const vitaminChart=computed(()=>{
    return{
        labels:[10,20,30,40

        ],
        datasets:{



        }
    }
})



let currentDate = ref(moment().format('YYYY-MM-DD'));
const calorieChart=computed(()=> {
    if (graphValue.value === 'day') {
        return {
            labels:

                nutrients.value.map((item) => item.date),
            datasets:
                [

                    {
                        label:
                            'Calories',
                        backgroundColor: '#A020F0',
                        data:
                            nutrients.value.map((item) => item.Calories),

                    },


                ]
        }
    } else {
       if(graphValue.value=='averageValue')
       {
           return{
               labels:'avg',

               datasets:[
                   {
                       label: 'Calories',
                       data:[averageCalories.value],
                       backgroundColor: '#A020F0',


                   },
                   {
                       label:'Carbs',
                       data:[averageCarbs.value],
                       backgroundColor: '#a665cc',

                   },
                   {
                       label:'Fats',
                       data:[averageFats.value],
                       backgroundColor: '#51da88',


                   },
                   {
                       label:'Protein',
                       data:[averageProtein.value],


                   }
               ],

           }
       }


    }



})
const macroChart=computed(()=> {
    return {
        labels:

            nutrients.data.value.map((item) => item.date),
        datasets:
            [

                {
                    label:
                        'Protein',
                    backgroundColor: '#9e1228',
                    data:
                        nutrients.data.value.map((item) => item.Protein),

                },
                {
                    label:
                        'Carbs',
                    backgroundColor: '#51da88',
                    data:
                        nutrients.data.value.map((item) => item.Carbs),

                },
                {
                    label:
                    'Fats',
                    backgroundColor: '#FFC0CB',
                    data:
                        nutrients.data.value.map((item) => item.Fat),
                    backgroundColor: '#25653f',


                }



            ]
    }
});


        function goToday()
{
    navigateTo({
        path: '/nutrition/nutrition.show',
        query:{date:currentDate.value}
    })
}

async function next()
{
    if(currentPage.value==lastPage.value)
{
    return;
}
    currentPage.value++;
   const{data:information}=await useFetch(`http://127.0.0.1:8000/api/nutrients?page=${currentPage.value}`,{
        method:'GET',
        headers:{
            'Authorization':`Bearer ${token.value}`
        }
    })
    nutrients.value=information.value
}
async function previous()
{
    if(currentPage.value==1)
{
    return;
}
    currentPage.value--;
   const{data:information}=await useFetch(`http://127.0.0.1:8000/api/nutrients?page=${currentPage.value}`,{
        method:'GET',
        headers:{
            'Authorization':`Bearer ${token.value}`
        }
    })
    nutrients.value=information.value
}





let nutrientFields=[{label:'date',key:'date'},{label:'Calories',key:'Calories'},{label:'Carbs',key:'Carbs'},{label:'Protein',key:'Protein'},{label:'Carbs',key:'Carbs'},{label:'Fat',key:'Fat'},{label:'actions',key:'actions'}]

</script>


<template>

    <div class="flex flex-col">


        <div class="flex items-center justify-center">
            <nutrientAdd>
                
            </nutrientAdd>

        </div>


       

  <UCard>


        
    <UTable :rows="nutrients.data" :columns="nutrientFields">
        <template #actions-data="{row}">
            <UButton @click="show(row)" >
                Show
            </UButton>
        </template>
        
    </UTable>
    <UPagination :active-button="{variant:'outline'}" v-model="currentPage" :total="total">

        <template #prev>
            <UButton @click="previous" icon="i-heroicons-arrow-small-left-20-solid">

            </UButton>

        </template>
        
        <template #next>
            <UButton @click="next" icon="i-heroicons-arrow-small-right-20-solid">

            </UButton>

        </template>
        
        
    </UPagination>
    </UCard>
    </div>

     




</template>

<style scoped>



</style>
