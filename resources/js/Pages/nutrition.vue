<script setup>

    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import {Head, router} from '@inertiajs/vue3';
    import {isDate} from "rollup-plugin-node-builtins/src/es6/util.js";
    import {reactive, ref, watch} from "vue";
    import {stringify} from "postcss";
    import PrimaryButton from "@/Components/PrimaryButton.vue";
    import {isNumber} from "chart.js/helpers";
    import NavLink from "@/Components/NavLink.vue";
    import SecondaryButton from "@/Components/SecondaryButton.vue";
    import InputLabel from "@/Components/InputLabel.vue";
    import DataTable from "primevue/datatable";
    import Column from "primevue/column";
    import DatePicker from 'primevue/datepicker';
import Button from "primevue/button";








    const props=defineProps({
        nutrients: Object,
        todayDate:String,
    newGoal:Array,
    targetCalories:isNumber,



    }
);

    const  selectedProduct=ref()
const date=ref(props.todayDate)



    watch(date,(newValue,oldValue)=>{

        if(newValue!=oldValue)
        {
            router.get(`/nutrition.show/${newValue}`)
        }
    })

function create()
{
    router.get('/nutrition.create')

}
function back()
{
    router.get('/dashboard')
}

function goToday()
{
    router.get(`/nutrition.show/${props.todayDate}`)
}



function goToDate()
{



    console.log('hello');


}
function goals(goal)
{
    router.get(`/goals/show/${goal.id}`)


}




    function show(nutrition){
        router.get(`/nutrition.show/${nutrition.date}`)

    }

</script>

<template>
    <AuthenticatedLayout>







        <primary-button @click="back"> Back</primary-button>





           <primary-button @click="goToday"> Today</primary-button>



        <input-label>
            Date
        </input-label>
          <DatePicker v-model="date">

          </DatePicker>







        <div v-if="$page.props.flash.message">
            {{ $page.props.flash.message }}

        </div>

      <div v-if="newGoal!=null">
          <SecondaryButton @click="goals(newGoal)">

              Goal:{{newGoal.name}}<br>
              Goal: {{newGoal.goalStatus}} <br>
              Goal Weight {{newGoal.goalWeight}}<br>
              Target Calories {{targetCalories}}


          </SecondaryButton>
      </div>




        <DataTable v-model:selection="selectedProduct" :value="nutrients" class="">
            <Column selection-mode="multiple">

            </Column>
            <Column header="Delete">
                <template #body>
                    <Button @click="destroy" icon="pi pi-trash" severity="secondary" text>

                    </Button>
                </template>
            </Column>
            <Column header="view">
                <template #body="{data}">
                    <PrimaryButton @click="show(data)">
                        View
                    </PrimaryButton>

                </template>
             <Button>

             </Button>

            </Column>

            <Column field="date" header="date">


            </Column>
            <Column field="Carbs" header="Carbs">

            </Column>
            <Column field="Fat" header="fats">

            </Column>
            <Column field="Protein" header="Protein" >

            </Column>
            <Column field="Calories" header="Calories" >

            </Column>


        </DataTable>





    </AuthenticatedLayout>
</template>


