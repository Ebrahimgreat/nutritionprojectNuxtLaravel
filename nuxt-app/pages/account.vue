<script setup lang="ts">

import { BirthdayEdit,Input,Button } from "#components";
import AgeEdit from "~/components/ageEdit.vue";
import emailEdit from "~/components/emailEdit.vue";
import HeightEdit from "~/components/heightEdit.vue";
import nameEdit from "~/components/nameEdit.vue";
import SexEdit from "~/components/sexEdit.vue";
import{useauthStore} from "~/stores/auth";
const authStore=useauthStore();
let userProfile=ref([])
import{Card,CardHeader,CardTitle,Label,CardFooter} from "#components"
import { RadioGroup,RadioGroupItem } from "~/components/ui/radio-group";
import { useUpdateAccount } from "~/composables/updateAccount";
const{accountInformation,updateAccountInformation}=useUpdateAccount();

async function updateAccountDetails()
{
    await updateAccountInformation(name.value,email.value,age.value,sex.value)
}

let showNameModal=ref(false)
let showSexModal=ref(false)
let showEmailModal=ref(false)
let showHeightModal=ref(false)
let birthdayModal=ref(false)


let name=ref(authStore.name)
let email=ref(authStore.email)
const token=useCookie('token')

const message=computed(()=>{
    if(name.value.length<2){
       return('Name must be above 4 Letters')
    }
})
async function updateName()
{
    try{
        authStore.setName(name.value)

    }
    catch(error)
    {
        console.log(error)
    }


}
async function getProfileInformation()
{
    try{
        userProfile.value=await $fetch('http://127.0.0.1:8000/api/userProfile',{
            method:'GET',
            headers:{
                'Authorization': `Bearer ${token.value}`
            }
        })
        console.log(userProfile.value)
        name.value=userProfile.value.name

    }
    catch(error)
    {
        console.log(error)
    }
}


const{data:information}=await useAsyncData('account',()=>
$fetch('http://127.0.0.1:8000/api/getAccountDetails',{
    method:'GET',
})
)



let sex=ref(information.value.Sex)
let age=ref(information.value.age)
let height=ref(information.value.height)


async function logout()
{
    await authStore.logout();
}

</script>

<template >



<UCard  class=" h-screen">
   <template #header>
    Account
    </template>




        <Label>
            Name
        </Label>
        <Input v-model="name" type="text" />
       
       <span class="text-red font-bold">

       {{ message }}
       </span>

        <Label>
            Email
        </Label>
        <Input v-model="email" type="text"/>

      <Label>
        Age
      </Label>

      <Input v-model="age" type="number"/>
      <Label>
        Sex
      </Label>
      <Input v-model="sex"/>
      <Label>
        Height
      </Label>


      <Input v-model="height"/>
      <UButton>
        Update
      </UButton>
    </UCard>

 





</template>

<style scoped>

</style>
