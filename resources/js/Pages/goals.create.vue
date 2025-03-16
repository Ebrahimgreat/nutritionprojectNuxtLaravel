<script setup>


import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {computed, reactive, ref, unref, watch} from "vue";
import {router} from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import Dropdown from "@/Components/Dropdown.vue";
import {isDate} from "rollup-plugin-node-builtins/src/es6/util.js";
import {FormWizard, TabContent} from 'vue3-form-wizard'
import 'vue3-form-wizard/dist/style.css'
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import {isArray, isNumber} from "chart.js/helpers";
import {Calendar, DatePicker} from "v-calendar";
import SelectButton from 'primevue/selectbutton';
import {holdNextTicks} from "alpinejs/src/nextTick.js";


//component code




let value=ref(55)
const options=ref(['Weight Gain', 'Weight Loss', 'Weight Maintain'])



function creating()
{
    router.post('/goals/store',[data])


}

const props=defineProps({
    date:String,
    currentWeight:isNumber,
    currentExpenditure:isNumber,

})




const carbs=computed(()=>{
    if(form.approach==='High Carb'){

        return (0.65*form.targetCalories)/4


    }
    else if(form.approach==='Low Carb'){

        return(0.20*form.targetCalories)/4
    }
    else if(form.approach==='Custom'){

        return((form.carbs/100)*form.targetCalories)/4
    }




})


const protein=computed(()=>{
    if(form.approach==='High Carb'){
        return(0.20*form.targetCalories)/4
    }
    else if(form.approach==='Low Carb'){
        return(0.20*form.targetCalories)/4
    }
    else if(form.approach==='Custom'){

        return((form.protein/100)*form.targetCalories)/4

    }

})

const fats=computed(()=>{
    if(form.approach==='Low Carb'){

        return(0.65*form.targetCalories)/9
    }
    else if(form.approach==='High Carb'){


        return(0.15*form.targetCalories)/9
    }
    else if(form.approach==='Custom' && form.fats!=null)
    {

        return((form.fats/100)*form.targetCalories)/9
    }




})





const targetCalories=ref();
const form=reactive({
    goalName: '',
    targetCalories:props.currentExpenditure,
    goalRate: 0.15,
    targetWeight: props.currentWeight,
    checkDay: 'Sunday',
    approach: 'High Carb',
    startedDate: props.date,
    protein: ref(0),
    carbs: ref(0),
    fats: ref(0),
    plan: ref('Evenly Distributed'),
    defaultFats:ref(fats),
    defaultProtein:ref(protein),
    defaultCarbs:ref(carbs),
    days:[{day:'Monday',},

        {day:'Tuesday', calories:0,},
        {day:'Wednesday', calories:0},
        {day:'Thursday', calories:0},
        {day:'Friday', calories:0},
        {day:'Saturday', calories:0},
        {day:'Sunday', calories:0}
    ],
    Monday:ref(0.33*targetCalories),
    Tuesday:ref(),
    Wednesday:ref(),
    Thursday:ref(),
    Friday:ref(),
    Saturday:ref(),
    Sunday:ref(),



});

watch(
    ()=>form.days[0].calories,
    ()=>{
        if(form.plan==='Custom')
        {
            form.days[0].calories=((form.targetCalories*7)/7)/(form.targetCalories*7)*100
        }

    },
    {once:true}
)





watch(
    ()=>form.days[1].calories,
    ()=>{
        if(form.plan==='Custom')
        {
            form.days[1].calories=((form.targetCalories*7)/7)/(form.targetCalories*7)*100
        }

    },
    {once:true}
)
watch(
    ()=>form.days[2].calories,
    ()=>{
        if(form.plan==='Custom')
        {
            form.days[2].calories=((form.targetCalories*7)/7)/(form.targetCalories*7)*100
        }

    },
    {once:true}
)
watch(
    ()=>form.days[3].calories,
    ()=>{
        if(form.plan==='Custom')
        {
            form.days[3].calories=((form.targetCalories*7)/7)/(form.targetCalories*7)*100
        }

    },
    {once:true}
)

watch(
    ()=>form.days[4].calories,
    ()=>{
        if(form.plan==='Custom')
        {
            form.days[4].calories=((form.targetCalories*7)/7)/(form.targetCalories*7)*100
        }

    },
    {once:true}
)

watch(
    ()=>form.days[5].calories,
    ()=>{
        if(form.plan==='Custom')
        {
            form.days[5].calories=((form.targetCalories*7)/7)/(form.targetCalories*7)*100
        }

    },
    {once:true}
)


watch(
    ()=>form.days[6].calories,
    ()=>{
        if(form.plan==='Custom')
        {
            form.days[6].calories=((form.targetCalories*7)/7)/(form.targetCalories*7)*100
        }

    },
    {once:true}
)






















const message='The ratios must add to 100%'
const fatMessage="Minimum 10% fat is required"
const errorCaloriePlanner="The ratios should add up to 100%"


const Monday=computed(()=>{
    if(form.days[0].calories!=null)
    {

        return (form.days[0].calories/100)*(form.targetCalories*7)
    }
})
const Tuesday=computed(()=>{
    if(form.days[1].calories!=null)
    {
        return (form.days[1].calories/100)*form.targetCalories*7
    }
})
const Wednesday=computed(()=>{
    if(form.days[0].calories!=null)
    {
        return (form.days[2].calories/100)*form.targetCalories*7
    }
})
const Thursday=computed(()=>{
    if(form.days[0].calories!=null)
    {
        return (form.days[3].calories/100)*form.targetCalories*7
    }
})
const Friday=computed(()=>{
    if(form.days[4].calories!=null)
    {
        form.Friday=Friday
        return (form.days[4].calories/100)*form.targetCalories*7
    }
})
const Saturday=computed(()=>{
    if(form.days[5].calories!=null)
    {
        form.Saturday=Saturday
        return (form.days[5].calories/100)*form.targetCalories*7
    }
})
const Sunday=computed(()=>{
    if(form.days[6].calories!=null)
    {
        form.Sunday=Sunday
        return (form.days[6].calories/100)*form.targetCalories*7
    }
})

const caloriePlanner=computed(()=>{
    if(form.plan==='Evenly Distributed')
    {

        return [{day:'Monday',calories:form.targetCalories},
            {day:'Tuesday',calories:form.targetCalories},
            {day:'Wednesday',calories:form.targetCalories},
            {day:'Thursday',calories:form.targetCalories},
            {day:'Friday',calories:form.targetCalories},
            {day:'Saturday',calories:form.targetCalories},
            {day:'Sunday',calories:form.targetCalories},


        ]

    }
    else if(form.plan==='Weekend Bliss'){

       return [{day:'Monday',calories:form.targetCalories*0.95},
            {day:'Tuesday',calories:form.targetCalories*0.95},
            {day:'Wednesday',calories:form.targetCalories*0.95},
            {day:'Thursday',calories:form.targetCalories*0.95},
            {day:'Friday',calories:form.targetCalories*0.95},
            {day:'Saturday',calories:((form.targetCalories*7)-(form.targetCalories*0.95*5))/2},
           {day:'Sunday',calories:((form.targetCalories*7)-(form.targetCalories*0.95*5))/2},


        ]

    }

})






const lowMessage='This is too low, please enter a greater weight'
const highMessage='This is too high please select a reasonable weight'




watch(
    ()=>form.goalRate,

    (newValue,oldValue)=>{
       if(oldValue!=newValue)
       {
           if(form.goalName==='Weight Gain')
           {
               console.log(newValue)
               form.targetCalories=(props.currentExpenditure+(7000*newValue)/30)
               form.weeklyTarget=form.targetCalories*7

           }

       }


    }


)



function back()
{
    router.get('/goals')
}





</script>





<template>

    <authenticated-layout>


        <PrimaryButton @click="back">
            Back

        </PrimaryButton>



        <div v-if="$page.props.flash.message">
            {{ $page.props.flash.message }}

        </div>

        <div class="flex">
     <FormWizard @on-complete="onComplete(form)">

            <tab-content title="Lets set up a new Goal!" v-model="form.goalName">







                <input-label> Goal Name</input-label>


                <input-label> Set Target</input-label>
                <input-label> Plan Calories</input-label>
                <input-label> Check In Day</input-label>
                <input-label> Goal Summary</input-label>

            </tab-content>


           <tab-content title="Goal Name">

            <select v-model="form.goalName"  size="3" class="w-80 h-60 text-xl p-4" required>



                <option> Weight Loss</option>
                <option> Weight Gain </option>
                <option> Weight Maintain</option>
            </select>


            <div> Selected Option:  {{form.goalName}}</div>

           </tab-content>


          <tab-content title="Set Target">

              <InputLabel> Current Weight:{{currentWeight}}</InputLabel>
              <InputLabel> Current Expenditure: <br>
                  {{currentExpenditure.toFixed(0)}}</InputLabel>
              <br>



              <div v-if="form.goalName==='Weight Gain'">

                  <InputLabel>Target Calories {{form.targetCalories}}
                  </InputLabel>
              </div>
              <div v-else-if="form.goalName==='Weight Loss'">
                  <InputLabel> Target Calories: {{form.targetCalories}}</InputLabel>

              </div>

              <div v-else>
                  <InputLabel> Target calories. {{currentExpenditure}}</InputLabel>
              </div>


              <InputLabel> Goal Rate</InputLabel>
              <div v-if="form.goalName==='Weight Maintain'">
                  <input type="range" disabled v-model="form.goalRate" step="0.05" min="0.02" max="1.0">
              </div>
              <div v-else>
              <input type="range" v-model="form.goalRate" step="0.05" min="0.02" max="1.0">
              </div>

              {{form.goalRate}} per week

              <InputLabel> Target Weight</InputLabel>
              <input type="range" v-model="form.targetWeight">

              {{form.targetWeight}}
              <br>




              <select v-model="form.approach">
                  {{form.approach}}

                  <option> High Carb</option>
                  <option>Low Carb</option>
                  <option>Custom</option>








</select>

              <div v-if="form.approach==='Custom'">



                <input-label>
                    Protein

                    <input type="range" v-model="form.protein" min="0" max="100">
                    {{form.protein}} percentage
                    <br>

                    {{protein}} G
                </input-label>
                  <input-label>

                      Carbs
                      <input type="range" v-model="form.carbs" min="0" max="100">
                      {{form.carbs}} percentage
                      <br>
                      {{carbs}}grams

                  </input-label>

                  <input-label>
                      Fats
                      <input type="range" v-model="form.fats" min="0" max="100">
                      {{form.fats}} percentage
                      <br>
                    {{fats}}G

                  </input-label>



                  <div v-if="form.protein+form.carbs+form.fats!==100">

                      <input-error :message="message"></input-error>
                      <div v-if="form.fats<10">
                          <input-error :message="fatMessage">

                          </input-error>

                      </div>

                  </div>


         </div>

          </tab-content>


<tab-content title="Plan Calories">
    <select v-model="form.plan">

        <option> Evenly Distributed</option>
        <option> Weekend Bliss</option>
        <option> Custom</option>

    </select>
    <div v-for="allowance in caloriePlanner">

       <InputLabel> {{allowance.day}}
        {{allowance.calories}}
       </InputLabel>
    </div>

    <div v-if="form.plan==='Custom'">

        <div v-for="days in form.days">
            <input-label>{{days.day}}
                <input type="number" v-model="days.calories" max="200">
            </input-label>
            {{days.calories}}


            <br>
        </div>
    </div>

    <input-label><b>Weekly Calories: {{form.targetCalories*7}}
    </b>
    </input-label>

    <input-label>
    Monday: {{Monday}} Calories
    </input-label>
    <input-label>
    Tuesday:{{Tuesday}} Calories
    </input-label>

    <input-label>
    Wednesday:{{Wednesday}} Calories
    </input-label>

    <input-label>
    Thursday:{{Thursday}} Calories
    </input-label>
    <input-label>
    Friday:{{Friday}} calories
    </input-label>
    <input-label>
    Saturday:{{Saturday}} calories
    </input-label>
    <input-label>
    Sunday:{{Sunday}} calories
    </input-label>

    <input-label>Total Calories so far:
    {{Monday+Tuesday+Wednesday+Thursday+Friday+Saturday+Sunday}}
    </input-label>

    <div v-if="Monday+Tuesday+Wednesday+Thursday+Friday+Saturday+Sunday!==form.targetCalories*7">
        <input-error :message="errorCaloriePlanner">

        </input-error>
    </div>








</tab-content>



            <tab-content title="Check in Day">


            <select v-model="form.checkDay" class="w-80 h-60 text-xl p-4">
                <option> Monday</option>
                <option> Tuesday</option>
                <option> Wednesday</option>
                <option> Thursday</option>
                <option> Friday</option>
                <option> Saturday</option>
                <option> Sunday</option>
            </select>
   Selected: {{form.checkDay}}
            </tab-content>


            <tab-content title="Goal Summary">

                <ul>
                    Current Expenditure: {{ currentExpenditure.toFixed(0) }}

                    <li><input-label> Current Weight: {{currentWeight}}</input-label></li>
                    <li> <input-label> Goal Name: {{form.goalName}}</input-label></li>
                    <li> <input-label> Diet Preference: {{form.approach}}</input-label></li>
                    <li> <input-label> Target Weight: {{form.targetWeight}} KG</input-label></li>
                    <li> <input-label> Goal Rate: {{form.goalRate}} per week </input-label></li>

                    <li> <input-label> Calorie Planner:{{form.plan}}


                        <div v-if="form.plan==='Evenly Distributed' || form.plan==='Weekend bliss'">

                            <div v-for="days in caloriePlanner">
                                {{days.day}}
                                {{days.calories}}
                            </div>
                        </div>
                        <div v-else>


                         <input-label>Monday {{form.Monday}}
                         </input-label>

                           <input-label> Tuesday {{form.Tuesday}}
                           </input-label>

                            <input-label> Wednesday{{form.Wednesday}}
                            </input-label>

                            <input-label> Thursday{{form.Thursday}}
                            </input-label>
                            <input-label>
                                Friday
                            {{form.Friday}}
                            </input-label>
                            <input-label>
                                Saturday
                            {{form.Saturday}}
                            </input-label>
                            <input-label>
                                Sunday
                            {{form.Sunday}}
                            </input-label>

                        </div>

                    </input-label></li>
                    <li> <input-label> Check In Day: {{form.checkDay}}</input-label></li>
                    <li> <input-label> Target Calories: {{form.targetCalories}}</input-label></li>
                    <li> <input-label> Estimated Macros</input-label>


                        <br>


                        <input-label> Protein {{protein}} grams</input-label>
                        <input-label> Carbs {{carbs}} grams </input-label>


                        <input-label> Fats {{fats}} grams </input-label>





                    </li>

                    <br>
                    <input-label> Submit to get Started!</input-label>
                </ul>

            </tab-content>









     </FormWizard>
        </div>





    </authenticated-layout>



</template>




<style scoped>

</style>

<script>
import {FormWizard,TabContent} from "vue3-form-wizard";
import 'vue3-form-wizard/dist/style.css'
import {router} from "@inertiajs/vue3";


const handleValidation=(isValid, tabIndex)=>{
    console.log("Tab: " +tabIndex+ "valid" +isValid)

}
export default {
    components:{
        FormWizard,
        TabContent,
    },

    methods:{

        onComplete(form){

            alert("Completed")



            router.post('/goals/store',form)

        }

    }
}
</script>


