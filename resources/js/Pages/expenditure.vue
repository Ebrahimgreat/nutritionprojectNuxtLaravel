<script setup lang="ts">
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import TextInput from "@/Components/TextInput.vue";
import {router} from "@inertiajs/vue3";
import {reactive} from "vue";
import { defineProps } from "vue";
import ex = CSS.ex;
import PrimaryButton from "@/Components/PrimaryButton.vue";
import DataTable from "primevue/datatable";
import Column from 'primevue/column';
import NavLink from "@/Components/NavLink.vue";
import Paginator from 'primevue/paginator';
import Toolbar from 'primevue/toolbar';

import Button from 'primevue/button';
import InputLabel from "@/Components/InputLabel.vue";



const props=defineProps({
    expenditures:Object,

});

function back()
{
    router.get('/dashboard')

}

</script>




<template>
    <authenticated-layout>


        <primary-button @click="back"> Back</primary-button>

        <DataTable :value="expenditures.data" table-style="min-width: 50rem">
            <template #header>
              <Input-label> Expenditure </Input-label>
            </template>

            <Column field="date" header="date">

            </Column>
            <Column field="number" header="Expenditure">

            </Column>

        </DataTable>














        <div v-if="$page.props.flash.message">
            {{$page.props.flash.message}}
        </div>










        <div class="mt-6">
            <nav-link v-for="link in expenditures.links"  :href="link.url" v-html="link.label"/>
        </div>



    </authenticated-layout>

</template>


