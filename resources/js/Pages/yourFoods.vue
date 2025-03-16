<script setup>

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";


</script>



<template>
<authenticated-layout>

    <input type="text" v-model="term" @keyup="search">

    <table class="fixed">


        <th> Food Name</th>
        <br>

        <div v-if="$page.props.customFoods">
            <div v-for="foods in $page.props.customFoods">
                <td>
                    <tr>
                {{foods.name}}
                    </tr>
                </td>
            </div>
        </div>


    </table>
</authenticated-layout>
</template>

<style scoped>

</style>

<script>
export default{
    data(){
        return{
            term:''
        }
    },
    props:{
        customFoods:Object,
    },
    methods:{
        search(){
            this.$inertia.get('/nutrition/yourFoods',{term:this.term},{preserveState:true})
        }
    }


}
</script>
