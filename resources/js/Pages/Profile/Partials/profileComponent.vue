<script setup>


import {reactive, ref} from "vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import {router} from "@inertiajs/vue3";


const props=defineProps({
    height:null,
    Sex:null,
    activityLevel:null,
    age:null,
    expenditure:null,


});
const form=reactive({
    height:props.height,
    Sex:props.Sex,
    activityLevel:props.activityLevel,
    age:props.age,





});







function save()
{
    router.post('/userProfile.update',form)
}

</script>

<template>

    <section>
        <header>

            <h2 class="text-lg font-medium text-gray-900">Dynamic Data</h2>

            <p class="mt-1 text-sm text-gray-600">
                Your Profile information and dynamic Data that is always changing
            </p>
        </header>

        <form @submit.prevent="save" class="mt-6 space-y-6">

            Height
             <input type="number"  v-model="form.height" class="mt-1 block w-full">

            <br>

           Activity Level <select class="mt-1 block w-full" v-model="form.activityLevel">
            <option> Little Active</option>
            <option> Moderately Active</option>
            <option> Very Active</option>
        </select>
            <br>
            Sex<select class="mt-1 block w-full" v-model="form.Sex"> <option> male
        </option>





        <option> Female</option>
        <option> Other</option></select>



            Expenditure <input type="text" class="mt-1 block w-full" disabled v-model="props.expenditure">
            <br>
            age <input type="number" class="mt-1 block w-full" v-model="form.age">


            <div class="flex items-center gap-4">
               <PrimaryButton :disabled="form.processing">Save</PrimaryButton>
            </div>

        </form>

    </section>

</template>

<style scoped>

</style>
