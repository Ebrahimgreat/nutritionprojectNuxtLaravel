<script setup>

import {DatePicker} from "v-calendar";
import {isDate} from "rollup-plugin-node-builtins/src/es6/util.js";
import {computed, ref, watch} from "vue";
import {router} from "@inertiajs/vue3";


const props=defineProps({
    date:isDate,
    datesTracked:Object,
    url:String,
});





const date=ref(props.date)


const information=computed(()=>{

    const trackedDate=[]

    let result=''

    props.datesTracked.forEach(item=> {

         trackedDate.push(new Date(item.date))

    })
    trackedDate.forEach((item,key,value)=>{

        if(item.getTime()===new Date(date.value).getTime())
        {

           result=(props.datesTracked[key])

        }

    })
    return result





})




const attrs=ref([
    {

        dates:
            props.datesTracked.map(function (item) {
                return new Date(item.date)

            }),

        dot: true,
        popover:{
           label:
           information,
            visibility:'click',
        },

    }


])






</script>

<template>






    <DatePicker expanded v-model="date" :attributes="attrs">
    </DatePicker>






    {{datesTracked[25]}}

</template>

<style scoped>
dark .my-datepicker {
    background-color: #2d3748; /* dark background */
    color: #f7fafc; /* light text color */
    border-color: #4a5568; /* dark border */
}


</style>

<script>

</script>

