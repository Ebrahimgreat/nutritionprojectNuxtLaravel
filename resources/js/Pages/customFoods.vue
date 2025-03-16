<script setup>

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import {router} from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";



const props=defineProps({
    date:String,
})


let indicator=0
let date=props.date
function submit(food)
{
    let quantity=prompt('Enter quantity')

    router.post('/nutrition.store',[food,quantity,date,this.indicator])

}
function back()
{
    router.get('/nutrition')
}


</script>




<template>





    <authenticated-layout>
        <PrimaryButton @click="back">
            Back</PrimaryButton>

        <input-label> Quick Log</input-label>
        <input type="text" v-model="term" @keyup="search">

        <table>
            <th> Foods Name</th>



            <tr>
            <td><div v-if="$page.props.foods">
              <div v-for="foods in $page.props.foods">

                 <button @click="submit(foods)">

             {{foods.name}}


                 </button>
              </div>
           </div>
</td>
            </tr>



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
        foods:Object,

    },
    methods:{
        search(){
            this.$inertia.get(`/nutrition.show/${this.date}/quickLog`,{term:this.term},{preserveState:true})

        }

    }

}

</script>
