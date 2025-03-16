<script setup>

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import TextInput from "@/Components/TextInput.vue";
import {reactive, ref, watch} from "vue";
import {router} from "@inertiajs/vue3";
import _ from 'lodash'
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";












const form=reactive({
    foodId:1,
    quantity:null,
    date:null,
    numbers:Array,



})


let quantity=0



watch(quantity,(value1=>{
    if(value1!=0)
    {
        console.log('value1 is not 0');
    }
    else{
        console.log('value1 is 0');
    }

}))





function store(food)
{
   let quantity= prompt("Enter quantiy")
    router.post('/nutrition.store',[food,form.foodId,quantity])

}
</script>


<style>
.v-enter-active,
.v-leave-active{
    transition:opacity 0.5s ease;
}
</style>



<template>

    <authenticated-layout>






        <input id="search" type="text" v-model="term" @keyup="search">

        <table>
            <th> Food Name</th>



            <tr v-for="(food, index) in foods.data" :class="{'bg-gray:300': index%2===0}">


                <td> <SecondaryButton @click="store(food)" v-model="quantity">{{food.name}}


                </SecondaryButton>
                </td>


            </tr>


        </table>









    </authenticated-layout>

</template>

<style scoped>

</style>

<script>

export default{
    data() {
        return{
            term: ''
        }
    },
    props:{
        foods:Object,
        dateValue:String,

    },
    methods:{
        search() {
            console.log(this.dateValue)


            this.$inertia.get(`/nutrition.show/${this.dateValue}/addFood`,{term:this.term},
                {
                    preserveState: true,
                    preserveScroll:true

                }
        )



        },
    }







}

</script>
