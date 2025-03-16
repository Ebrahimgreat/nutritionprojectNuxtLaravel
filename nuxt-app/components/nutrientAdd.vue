<script setup lang="ts">



const apiKey='FX0Z6ppCjFIdMUmnKyMe7dpheVGv0U3jykMJl9rr'


let foodSearchItem=ref([])
let foodName=ref([])
let foodKey=ref('')

async function searching()
{
    try{
        const data=await $fetch( `https://api.nal.usda.gov/fdc/v1/foods/search?query=${foodKey.value}&api_key=${apiKey}`)
 
        foodName.value=data.foods.map((item)=>item.description)
        foodSearchItem.value=data.foods[0].foodNutrients.filter(item=>item.nutrientName==='Protein' || item.nutrientName==='Energy').map((item)=>({
            nutrientName:item.nutrientName,
            value:item.value
        }))
        console.log("Food Search Item:",foodSearchItem.value)
    }

  
    catch(error)
    {
        console.log(error)
    }
}


let headers=[{label:'Search',key:'search'},{label:'CustomFood',key:'custom'},{label:'Manual',key:'manual'}]

import{useNutritionStore} from "~/stores/nutritionStore";
const nutritionStore=useNutritionStore();
let showNewFoodModal=ref(false)

let props=defineProps({
    dateValue:String,
    timeValue:String,
    showModal:Boolean,
    totalCalories:Number,
    totalProtein:Number,
    calories:Number,
    foodName:String,
    carbs:Number,
    protein:Number,
    fat:Number



});


const totalProtein=computed(()=>{
    return(proteinComputed+props.proteinValue)
})

const emit=defineEmits(['update:Protein', 'update:Fat', 'update:showModal','update:DateValue','update:timeValue','update:ProteinValue','update:Carbs','update:totalCalories','update:foodName','update:Calories','storeFood'])


let searchValues=ref([])




let customFood=ref([])
let searchInput=ref('')
async function getCustomFoods()
{
    console.log("Event starting");
    try{
        customFood.value=await $fetch('http://127.0.1:8000/api/customFoods')
        searchValues.value=customFood.value;
    }
    catch(e){
        console.log(e);
    }


}
const token=useCookie('token');
async function storeManualFood()
{

    emit('storeFood')
    emit('update:showModal',false)
   
            
}


function getFilteredCustomFoods(){



    console.log(searchInput.value)
    return searchValues.value=customFood.value.filter((item)=>{
        return item.name.toLowerCase().includes(searchInput.value.toLowerCase())
    })


}




let searchItems=ref([])
let searchItem=ref()
async function searchFood()
{
    searchItems.value=await  $fetch('http://127.0.1:8000/api/addNewFood',{
        method:'GET',

        headers:{
            'search':searchItem.value
        },
    })

}





function selectFood(item)
{
    const foodItem=item.food_description.split("|");
    const foodQuantity=foodItem.toString();
    const foodQuantitySplit=foodQuantity.split('-');

    quantity.value = foodQuantitySplit[0].match(/\d+/)[0];
    defaultQuantity=foodQuantitySplit[0].match(/\d+/)[0];
const macros=foodQuantitySplit[1].toString();

const macrosSplit=macros.split(",")

    calories.value=macrosSplit[0].match(/\d+/)[0];
protein.value=macrosSplit[3].match(/\d+/)[0];
fat.value=macrosSplit[1].match(/\d+/)[0];
carbs.value=macrosSplit[2].match(/\d+/)[0];


    selectNewFood.value=item.food_name







}
const carbsComputed=computed(()=>{
    return(carbs.value*quantity.value/defaultQuantity)


})

const fatComputed=computed(()=>{
    return(fat.value*quantity.value/defaultQuantity)
})
const calorieComputed=computed(()=>{
    return(calories.value*quantity.value/defaultQuantity)
})
const totalCaloriesComputed=computed(()=>{
    return(calories.value*quantity.value/defaultQuantity)+props.totalCalories

})
const proteinComputed=computed(()=>{
    return(protein.value*quantity.value/defaultQuantity)
})

const totalProteinComputed=computed(()=>{
    return(protein.value*quantity.value/defaultQuantity)+(props.totalProtein||0);
})


let newFoodAdded=ref(false)




function selectedVal(count)
{
    selected.value=count;

}

let values=computed(()=>{
    if(newFoodAdded.value==true){
        return carbsComputed;
    }
})


let tabs=[{label:'Search'},{label:'Food'}]

async function storeCustomFood()
{
    console.log('custom')
    nutritionStore.setData('2025-01-17',protein.value,carbs.value,fat.value,'chicken')

}
function addingFood()
{
    console.log("Function executing")
    emit('update:totalCalories',totalCaloriesComputed.value);
    emit('update:totalProtein',totalProteinComputed.value);

}
onMounted(()=>{



})






</script>

<template>
    

    <UButton label="Add" @click="emit('update:showModal',true)">
       

    </UButton>
    <UModal :model-value="showModal" :overlay=false prevent-close>
        <UCard :ui="{ ring: '', divide: 'divide-y divide-gray-100 dark:divide-gray-800' }">

            <template #header>

                <UTabs :default-index="1" :items="headers">

                    <template #item="{ item }">
    
                        <div v-if="item.key==='manual'">

                        
                                    Date
                        
                                <UInput type="date" :model-value="dateValue" @input="emit('update:DateValue',$event.target.value)"/>
                               
                                    Time
                               
                                <UInput type="time" :model-value="timeValue" @input="emit('update:timeValue',$event.target.value)"/>

                                
                                    Calories
                               
                                <UInput :model-value="calories" @input="emit('update:Calories',$event.target.value)"/>

                               
                                    Protein

                                
                                <UInput type="number" :model-value="protein" @input="emit('update:Protein',$event.target.value)"/>
                         
                                Carbs

                                
                                <UInput type="number" :model-value="carbs" @input="emit('update:Carbs',$event.target.value)"/>

                              
                              Fat
                              </div>


                              {{foodName }}
                              <div v-if="item.key==='search'">
                                <UInput v-model:model-value="foodKey" @input="searching" >
                                    </UInput>


                                    <div v-for="item in foodSearchItem">
                                        {{ item.nutrientName}}
                                        {{ item }}
                                    </div>
                                
                              </div>


</template>
                             </UTabs>
 
            </template>      
            <template #footer>
                 
                <UButton @click="storeManualFood">
               Submit

                </UButton>

                <UButton label="cancel" @click="emit('update:showModal',false)">

                </UButton>
             

             
            </template>

            
            

                 
</UCard>


                          
</UModal>
        



</template>

<style scoped>

</style>

