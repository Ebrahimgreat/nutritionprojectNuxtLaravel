<script setup>

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

import {Head, router} from '@inertiajs/vue3';
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import DataTable from "primevue/datatable";
import Column from "primevue/column";





const props=defineProps({
    goals:Array,
    goalCheckins:Array,
});

function create()
{
    router.get('/goals/create')
}

function view(goal)
{
    console.log(goal)
    router.get(`goals/show/${goal.id}`);
}

function destroy(goal)
{

    const result=prompt('Are you sure you want to delete this')
    if(result==='yes') {
        router.post('/goals/destroy', goal)
    }
}

function back()
{
    router.get('/dashboard');
}


</script>





<template>

    <authenticated-layout>






        <PrimaryButton @click="back"> Back</PrimaryButton>




            <div v-if="$page.props.flash.message">
                {{$page.props.flash.message}}
            </div>





            <DataTable :value="goals">
                <template #header>
                  <PrimaryButton @click="create">
                      Add
                  </PrimaryButton>
                </template>

                <Column header="View Goal">

                </Column>
                <Column heder="Goal Name" field="name">

                </Column>
                <Column header="Goal Rate" field="goalRate">

                </Column>
                <Column header="Goal Weight">

                </Column>
                <Column header="Goal Status">

                </Column>
                <Column header="Calorie Distribution">

                </Column>
                <Column header="Approach">

                </Column>
                <Column header="started Date">

                </Column>


            </DataTable>


<br>

                  <SecondaryButton @click="destroy(goal)"> Delete</SecondaryButton>


        <PrimaryButton @click="create">
            Create new Goal
        </PrimaryButton>

    </authenticated-layout>



</template>

<style scoped>

</style>
