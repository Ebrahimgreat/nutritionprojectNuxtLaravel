<script setup lang="ts">







import { definePageMeta } from "#imports";
import { useWeightStore } from "~/stores/weight";
import modal from "~/components/modal.vue";
import weightEdit from "~/components/editWeight.vue";
import { BarChart,Table,TableBody,TableHeader,TableCell,TableRow,Card,CardHeader, CreateWeight } from "#components";
import { ChartMaker } from "#components";
let weightDeleteModal = ref(false)
const token = useCookie('token');



let weights = ref([])
let weightStore = useWeightStore()

import { onMounted } from "vue";
import moment, { months } from "moment";
import type { RefSymbol } from "@vue/reactivity";

let defaultMonth = ref(moment().month());

let count = ref(defaultMonth.value);
let currentMonth = ref(defaultMonth.value);


async function destroyweight(weight) {
    const message = confirm('Are you sure you want to delete it')
    console.log(message)
    if (message == true) {




        await $fetch('http://127.0.0.1:8000/api/destroyweight', {
            method: 'POST',
            headers: {
                'token': localStorage.getItem('token')

            },
            body: {
                'weight': weight['id']
            }
        }
        )
        weights.value = weights.value.filter(w => w.id !== weight.id);

    }
}

const chartData = computed(() => ({
    labels:
        weights.value.map((item) => item.date),

    datasets: [
        {
            label: 'ScaleWeight',
            data: weights.value.map((item) => item.ScaleWeight),
            backgroundColor: '#A020F0',
            borderColor: "#bae755",

        },{
            label:'Trend Weight',
            data:weights.value.map((item)=>item.trendWeight)
        }
    ]
}));

const trendWeightGraph = computed(() => ({
    labels:
        weights.value.map((item) => item.date),
    datasets: [
        {
            label: 'TrendWeight',
            data: weights.value.map((item) => item.trendWeight),
            backgroundColor: '#A020F0',
            borderColor: "#bae755",

        }
    ],
    chartOptions:{
        scales:{
            xAxes:[{
                gridLines:{
                    display:false
                }
            }]
        }
    }
}));




const chartOptions = {
    responsive: true,
    maintainAspectRatio: false
}

async function editWeight() {
    try {
        await $fetch('http://127.0.0.1:8000/api/editWeight', {
            method: 'POST',
            headers: {
                'Authorization':`Bearer ${token.value}`
            },
            body: {
                ScaleWeight: selectedWeight.value,
                date: selectedDate.value
            }
        })
    }
    catch (error) {
        console.log(error)
    }
}

function dashboard() {
    navigateTo('/home');
}


let weightTracking = ref([])

let filteredWeights = ref([])

let pageCurrent=ref(0)

let totalWeights=ref()


const{data:information}=await useAsyncData('weights',()=>
    $fetch('http://127.0.0.1:8000/api/weights',{
        method:'GET',
        headers:{
            'Authorization': `Bearer ${token.value}`
        }
    })
)
weights.value=information.value
pageCurrent.value=information.value.weightPaginate.current_page
let newPage=ref(pageCurrent.value)
totalWeights.value=information.value.weightPaginate.total



let selectedDate = ref('')
function weightClicked(weight) {
    selectedWeight.value = weight.ScaleWeight
    selectedDate.value = weight.date
    console.log(selectedDate.value)

}

let selected = ref(null)

let editWeightModel = ref(false)
function toggleSelected(count) {
    selected.value = count;
}


let selectedWeight = ref(0)

function updateParentWeight() {
    console.log('you clicked me')

}



function nextMonth() {
    count.value++;
    currentMonth.value++;


}
function previous() {
    count.value--;




}
let arrowClicked=ref(false)
let previousOption=ref(false)





async function onClick()
{
    arrowClicked.value=true
    
    pageCurrent.value++;
   const data=await $fetch(`http://127.0.0.1:8000/api/weights?page=${pageCurrent.value}`,{
    method:'GET',
    headers:{
        'Authorization': `Bearer ${token.value}`
    },


   })
   weights.value=data
   arrowClicked.value=false;
   newPage.value=pageCurrent.value


}

async function getPage()
{
    const{data:information}=await useFetch(`http://127.0.0.1:8000/api/weights?page=${pageCurrent.value}`,{
        method:'GET',
        headers:{
            'Authorization' :`Bearer ${token.value}`
        }
    })
    weights.value=information.value
    arrowClicked.value=false;

}

async function previousPage()
{
    pageCurrent.value--;
    arrowClicked.value=true;
    const{data:information}=await useFetch(`http://127.0.0.1:8000/api/weights?page=${pageCurrent.value}`,{
        method:'GET',
        headers:{
            'Authorization' :`Bearer ${token.value}`
        }
    })
    weights.value=information.value
    arrowClicked.value=false;
}


watch(pageCurrent,(newValue,oldValue)=>{
    if(newValue!=oldValue && arrowClicked.value==false)
{
    getPage();
   
}
})




let weightFields=[{label:'Date',key:'date'},{label:'Scale Weight',key:'ScaleWeight'},{label:'Trend Weight',key:'trendWeight'}]

const showModal = ref(false)
</script>

<template>


<div class="flex flex-col">
   

    




       
                
         


<UCard>
    <template #header>
        Weight
    </template>
    {{ pageCurrent }}


       
    <UTable :columns="weightFields" :rows="weights.weightPaginate.data">
        <template #caption>
            <caption>

      
            <CreateWeight :showModal="showModal" @update:showModal="showModal=$event">


            </CreateWeight>
            </caption>
        </template>
        

    </UTable>

    <div class="flex items-center justify-center">



    <UPagination :active-button="{variant:'outline'}" :inactive-button="{color:'gray'}" v-model="pageCurrent"  :pageCount="2" :total="totalWeights" >
        <template #next>
            <UTooltip text="Next Page">
            <UButton @click="onClick" icon="i-heroicons-arrow-small-right-20-solid">
                </UButton>
                </UTooltip>
        </template>
        <template #prev>
            <UTooltip text="previousPage">
            <UButton @click="previousPage" icon="i-heroicons-arrow-small-right-20-solid">
                </UButton>
                </UTooltip>
        </template>

    </UPagination>
    </div>

       
</UCard>

    </div>





</template>


<style scoped>
.chart-container {
    height: 200px;
    position: relative
}
</style>
