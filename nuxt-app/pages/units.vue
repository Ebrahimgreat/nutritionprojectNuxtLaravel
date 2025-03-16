<script setup lang="ts">

let token=useCookie('token')

let unitsData=ref([])

async function getUnits()
{
    try{
    unitsData.value=await $fetch('http://127.0.0.1:8000/api/units',{
        method:'GET',
        headers:{
            'Authorization': `Bearer ${token.value}`
        }

    })
    }
    catch(error)
    {
        console.log(error)
    }
}
onMounted(()=>{
    getUnits();
})
</script>

<template>
    <div class="flex flex-col bg-primary">

  
       <Card  class=" ml-16 mr-16 mt-16 mb-16 h-screen">
    <CardHeader>
        <CardTitle>
         Units
        </CardTitle>
        <CardDescription>
            Weight Units
        </CardDescription>
        </CardHeader>
        <CardContent class="flex flex-row bg-primary text-white">
            <label class="flex-1">
                Weight Unit :    {{ unitsData.WeightUnit }}
            </label>
            <div class=" border rounded-full flex items-center justify-center  w-20">

           
            </div>

        </CardContent>
        <CardContent class="flex flex-row bg-primary text-white rounded-lg mt-3 ">
            <label class="flex-1">
                Height Unit: {{ unitsData.heightUnit }}
            </label>


        </CardContent>
        <CardContent class="flex flex-row bg-primary text-white rounded-lg mt-3 ">
            <label class="flex-1">
              Workout Unit
            </label>
            

        </CardContent>
        

        


</Card>
</div>

</template>

<style scoped>

</style>
