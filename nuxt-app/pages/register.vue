<script setup lang="ts">

import {useauthStore} from "~/stores/auth";


const form=ref([
    'name','email','height','sex','password'

])
let confirmPassword=ref('')
async function register()
{
    await $fetch('http://127.0.0.1:8000/api/register', {
        method:'POST',
        body: {
            email: 'EEEE@GMAIL.COM',
            name:'erer',
            password: 'erereskmckmsc'


        }
    })


}
let auth=''
onMounted(()=>{
     auth=localStorage.getItem('user')
})



</script>



<template>
    <div class="bg-yellow-400 dark:bg-gray-800 h-screen overflow-hidden flex items-center justify-center">

    <form class="bg-pink shadow-md rounded px-8 pt-6 p-8 mb-4 w-full" >
        <h1 class="text-center text-white font-bold"> Register now</h1>

        <label class="block text-white text-sm font-bold mb-2">
            First Name

        </label>
        <input type="text" v-model="form.name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight">
        {{form.name}}


        <label class="block text-white text-sm font-bold mb-2">
Email
        </label>

        <input type="email" v-model="form.email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight">
        <label class="block text-white text-sm font-bold mb-2">
            Password
        </label>
        <input type="password" v-model="form.pasword" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight">
        <label class="block text-white text-sm font-bold mb-2">
            Confirm password
        </label>
        <input type="password" v-model="confirmPassword" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight">



        <h1 class="text-center" >
        <button-custom @click="register">
         Submit
        </button-custom>
        </h1>
    </form>
    </div>

</template>

<style scoped>

</style>
