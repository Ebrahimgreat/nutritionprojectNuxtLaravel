<script setup>

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {router} from "@inertiajs/vue3";
import VueApexCharts from "vue3-apexcharts";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { Bootstrap5Pagination } from 'laravel-vue-pagination';
import {computed, onMounted, ref, watch} from "vue";
import DataTable from "primevue/datatable";
import Column from 'primevue/column';
import {isNumber} from "chart.js/helpers";
import NavLink from "@/Components/NavLink.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import Paginator from 'primevue/paginator';
import ConfirmDialog from 'primevue/confirmdialog';
import Button from "primevue/button";
import 'primeicons/primeicons.css'
import Chart from 'primevue/chart';
import Toolbar from "primevue/toolbar";

import Toast from 'primevue/toast';
import{TresCanvas} from "@tresjs/core";

import Menubar from 'primevue/menubar';
import InputLabel from "@/Components/InputLabel.vue";

import ToggleButton from 'primevue/togglebutton';
import Popover from 'primevue/popover';
import { useToast } from "primevue/usetoast";


const props=defineProps({
    avg: isNumber,
    weights: Object,


});


const checked=ref()

const toast=useToast();


const selectedProduct=ref()
const weight=Array(props.weights)

function create()
{
router.get('/weight.create')
}



function edit(weight)
{

    router.get(`/weight/edit/${weight.id}`,weight);

}

function view(weight)
{
    router.get(`/weight/view/${weight.view}`,weight)
}




function back()
{
    router.get('/dashboard');
}


let data=ref([])

function destroyingMultipleRecords(value)
{
    router.post('/weight.destroy',value)
}



function copyingMultipleRecords(value)
{

}
function destroy(weight)
{
    let result;
    result=prompt('Are you sure you want to delete this weight?')
    if(result=='yes') {
       toast.add({severity:'info',summary:'Weight',detail:'Deleted Successfully'})
    }
}


const show=()=>{
    toast.add({severity:'info',summary:'Weight',detail:'Deleted Successfully'})
}


const message=computed(()=>{
    if($page.props.message!==null)
    {
        toast.add({severity:'info',summary:'Weight',detail:'Added Successfully'})


    }

})




</script>









<template>




    <authenticated-layout>



     <Toast>

     </Toast>

        <Button @click="show"> Click</Button>

        <div v-if="$page.props.flash.message">
              {{$page.props.flash.message}}

        </div>

        <PrimaryButton @click="back"> Back</PrimaryButton>






        <DataTable v-model:selection="selectedProduct" :value="weights.data" table-style="">


          <Toolbar>
              <template #start>


                  <Input-label>
                      Add
                  </Input-label>
                  <Button @click="create" icon="pi pi-plus" class="mr-2" severity="secondary" text />
                  <ToggleButton @click="converter(checked)" class="mr-2" v-model="checked" on-label="Pounds" off-label="Kilogram"></ToggleButton>


              </template>

          </Toolbar>



            <Column selection-mode="multiple" header="Select All"></Column>

            <Column header="Delete">

                <template #body="{data}">
                   <Button @click="destroy(data)" icon="pi pi-trash" class="mr-2" severity="secondary" text>

                   </Button>

                </template>

            </Column>
            <Column field="date" header="Date">

            </Column>
            <Column field="ScaleWeight" header="Scale Weight">

            </Column>
            <Column field="trendWeight" header="Trend Weight">

            </Column>
        </DataTable>



        <div class="mt-6">
            <nav-link v-for="link in weights.links"  :href="link.url" v-html="link.label"/>
        </div>


    </authenticated-layout>
</template>





<script>
import {useToast} from "primevue/usetoast";

export default{

    data(){

        return{
            term:"yes",
            chartData:null,


        }

    },
    mounted() {
        const toast=useToast()
        if(this.$page.props.flash.message)
        {
            toast.add({severity:'info',summary:'Weight',detail:'Added Successfully'})

        }

    },
    methods:{
         converter(checked)
         {

                 this.$inertia.get('/weight', {term: checked})



},
setChartData(){
             return{
                 labels:['January','Febuary']
             }

}
    }
}


</script>

