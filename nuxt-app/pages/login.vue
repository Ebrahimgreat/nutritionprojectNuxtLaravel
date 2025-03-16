<script setup lang="ts">


import Card from "primevue/card";
import Message from 'primevue/message';

import {useauthStore} from "~/stores/auth";
const auth=useauthStore()
const credentials=ref({
    email: '',
    password:'',
})

async function login()
{
    try {
        await $fetch('http://127.0.0.1:8000/sanctum/csrf-cookie', {

            credentials: 'include'
        });
       await auth.login(credentials.value.email,credentials.value.password)


    }



    catch(error){
    }
}
async function testing ()
{
    await $fetch('http://localhost:3001/api/login',{
        method:'POST',
        body:{
            email:'ebrahimgreat@gmail.com',
            password:'ebrahim123'

        }
    })

}


</script>

<template>
    <button @click="testing">
        Hello
    </button>


    <div class="flex items-center justify-center h-screen">

        <UCard class="w-[350px]">
            <template #header>
                Scope Nutrition
            </template>


            <form class="bg-pink shadow-md rounded mb-4 w-full">


                    <label class="block  text-sm font-bold mb-2">
                        Email
                    </label>
                    <UInput v-model="credentials.email"/>

                    <div class="mb-6">
                        <label class="block text-sm font-bold mb-2" for="password">
                            Password
                        </label>
                        <UInput v-model="credentials.password" type="password" placeholder="******************"/>
                    </div>

                    <UButton @click="login" type="button">
                        Sign in
                    </UButton>



            </form>



        </UCard>


    </div>




</template>

<style scoped>


</style>
