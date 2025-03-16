<script setup>

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

import {Calendar, DatePicker} from "v-calendar";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import {router} from "@inertiajs/vue3";
import Modal from "@/Components/Modal.vue";
import TextInput from "@/Components/TextInput.vue";
import {isDate} from "rollup-plugin-node-builtins/src/es6/util.js";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import {isNumber} from "chart.js/helpers";
import {ref, warn} from "vue";
import InputLabel from "@/Components/InputLabel.vue";
import DataTable from "primevue/datatable";
import Column from "primevue/column";

const props=defineProps({
    goalName:String,
    nextCheckDate:isDate,
    checkIns:Array,
    today:isDate,
    goal:Array,
    goalId:isNumber,
    startingWeek:String,
    endingWeek:String,

});











let message=""


function back()
{
    router.get('/goals');
}

function edit(goal)
{
    router.get('/goals/show/15/edit',goal);
}

const attrs=ref([
    {
        dates:props.nextCheckDate,
        highlight:'red',
        popover:{
            label:"Evaluation Day"
        }
    },



])






const disabled= ref(false)




function destroy()
{
    router.post(`/goal/${props.goal.id}`,props.goal);
}
function search(variable)
{
    router.post('/search',variable)
}
</script>



<style>


</style>







<template>













  <authenticated-layout>






      <PrimaryButton @click="back"> Back</PrimaryButton>







      <DatePicker view="weekly" expanded v-model="props.today" :attributes="attrs" > </DatePicker>

      <center><h1 class="font-semibold" >GOAL SUMMARY</h1></center>



      <DataTable :value="checkIns">
       <Column field="date" header="Configure" >

       </Column>
          <Column  field="name" header="name">

          </Column>

          <Column header="targetCalories">

          </Column>
          <Column header="targetProtein">

          </Column>
          <Column header="targetCalories">

          </Column>
          <Column  field="checkDay" header="CheckDay">

          </Column>

      </DataTable>



      <table class="table-auto">
          <tr>



          <th class="w-1/2 px-4 py-2"> Configure</th>
          <th class="w-1/2 px-4 py-2"> Goal Name</th>

          <th class="w-1/2 px-4 py-2"> Target Calories</th>
              <th class="w-1/2 px-4 py-2"> Target Protein</th>
              <th class="w-1/2 px-4 py-2"> Target Carbs</th>
              <th class="w-1/2 px-4 py-2"> Target Fats</th>
              <th class="w-1/2 px-4 py-2"> CheckDay</th>
          </tr>




              <td class="border px-4 py-2">
                  <tr v-for="checkin in checkIns">
                 <PrimaryButton @click="edit(checkIns)">
                     CheckIn
                 </PrimaryButton>
                  </tr>
              </td>
             <td class="border px-4 py-2">
                 <tr>{{goalName}}
                 </tr>



             </td>

              <td class="border px-4 py-2">
                  <tr v-for="checkin in checkIns">
                  {{checkin.targetCalories}}
                  </tr>
              </td>
          <td class=" px-4 py-2">
              <tr  v-for="checkin in checkIns">
                  {{checkin.targetProtein}}
              </tr>


          </td>
          <td class="px-4 py-2">
              <tr  v-for="checkin in checkIns">
                  {{checkin.targetCarbs}}
              </tr>


          </td>
          <td class="px-4 py-2">
              <tr  v-for="checkin in checkIns">
                  {{checkin.fatsTarget}}
              </tr>


          </td>


          <td class="px-4 py-2">
              <tr v-for="checkin in checkIns">
                  {{checkin.checkDay}}
              </tr>
          </td>



      </table>



      <div v-if="props.date===props.nextCheckDate">
      <PrimaryButton @click="evaluation(props.goal)"> Evaluation</PrimaryButton>

      <div v-if="$page.props.macros">


          <InputLabel> New Calories: {{$page.props.macros[0].calories}}
          </InputLabel>

             <InputLabel> New Protein: {{$page.props.macros[0].Protein}}
             </InputLabel>

         <InputLabel> New Fats:  {{$page.props.macros[0].Fats}}
         </InputLabel>

           <InputLabel> New Carbs:  {{$page.props.macros[0].Carbs}}
           </InputLabel>



          <table>

          <th class="px-4 py-2">
              <PrimaryButton> Decline</PrimaryButton>
          </th>
          <th class=" px-4 py-2">
              <PrimaryButton @click="acceptingTarget"> Accept</PrimaryButton>

          </th>
          </table>


      </div>
      </div>



  </authenticated-layout>


</template>

<style scoped>




</style>


<script>
import {isDate} from "rollup-plugin-node-builtins/src/es6/util.js";

export default{
    data(){
        return{
            term:'Yes',



        }
    },
   props:{
       macros:Array,
       compliance:Object,
   },
    methods:{
        evaluation(goal){
            this.$inertia.get('/getNewTargetCalories',{goal:goal,term:this.term},{preserveState:true})



        },
        acceptingTarget()
        {
            this.$inertia.get('/updatedTarget',{term:this.term})
        }
    }

}

</script>


