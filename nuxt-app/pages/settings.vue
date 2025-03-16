<script setup lang="ts">


import{useauthStore} from "~/stores/auth";
const authStore=useauthStore();

const token=useCookie('token');

async function logut()
{
    try{
        await authStore.logout();
    }
    catch(error){
        console.log(error)
    }
}



</script>

<template>
    <div class="bg-primary">


    <div class="flex  flex-col h-screen  bg-primary">

        <Card class=" text-black ml-16 mr-16 mt-16 bg-white">
            <CardHeader>


        <CardTitle>
            General
        </CardTitle>
            </CardHeader>
        <CardContent class="border bg-primary text-white rounded-lg">
            <NuxtLink to="/account">
                <div class="flex  justify-center ">


                    <span class="">
           Account
       </span>
                </div>
            </NuxtLink>


            <div class="flex  justify-center">

                <span class="">


       </span>
            </div>
            <NuxtLink to="/units">
            <div class="flex  items-center justify-center">
                Units
            </div>
            </NuxtLink>


        </CardContent>
            </Card>
        <Card class="text-black ml-16 mr-16 mt-16 bg-white">
            <CardHeader>


        <CardTitle>
            Data Management
        </CardTitle>
            </CardHeader>
        <CardContent class="border rounded-lg bg-primary text-white">
            <div class="flex   justify-center">

                <span class="">
            Data Export

        </span>
            </div>
            <div class="flex space-x-5 justify-center">

                <span class="">
            Data Deletion
        </span>
            </div>


        </CardContent>





    </Card>


</div>
    </div>


</template>

<style scoped>

</style>
