<script setup lang="ts">
let props=defineProps({
    workoutValue:Array

})


const chartValue=computed(()=>{
    return{
        labels:[
            props.workoutValue.created_at
        ],
        datasets:[
            {
                label:'Reps',
            
                data:props.workoutValue.reps,
                backgroundColor:'#A020F0'
            },
            {
                label:'Set',
                data:props.workoutValue.set
            },
            {
                label:'Weight',
                data:props.workoutValue.weight
            }
        ]
    }
})


const chartOptions = {
    responsive: true,
    maintainAspectRatio: false
}

</script>
<template>



  

</template>