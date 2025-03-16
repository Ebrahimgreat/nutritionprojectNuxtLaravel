<script setup lang="ts">



import{Table,TableHeader,TableHead,TableBody,TableRow,TableCaption,TableCell} from "#components";
function dashboard()
{
    navigateTo('home');
}

const token=useCookie('token');

let showExpenditure=ref(false)

let expenditures=ref([])
let filteredExpenditure=ref([])

const{data:information}=await useAsyncData('expenditure',()=>(
    $fetch('http://127.0.0.1:8000/api/expenditure',{
        method:'GET',
        headers:{
            'Authorization':`Bearer ${token.value}`
          
        }
    }

)))
expenditures.value=information.value;

const  expenditureGraph=computed(()=>{
    return{
        labels:
            expenditures.value.map((item)=>item.date),
        datasets:[

                {
                    label:'Expenditure',
                    data:expenditures.value.map((item)=>item.expenditure),
                    backgroundColor: '#A020F0',
                    borderColor: "#bae755",



                }
                ]




    }
})


function resetExpenditure()
{
    navigateTo('expenditure.create')
}
</script>

<template>

 


    

<UCard>
    <template #header>
        Overview
    </template>


    <ChartLine :data="expenditureGraph"/>
    </UCard>



    <div class=" overflow-y-auto  text-gray-700  shadow-md rounded-xl ">

        <Table class="text-white">
            <TableHeader>
                
                    <TableRow>
                        <TableHead>
                            Date
                        </TableHead>
                        <TableHead>
                            Expenditure
                        </TableHead>
                    </TableRow>
             
            </TableHeader>
            <TableBody>
                <TableRow v-for="item in expenditures">
                    <TableCell>
                        {{ item.date }}
                    </TableCell>
                    <TableCell>
                        {{ item.expenditure }}
                    </TableCell>


                </TableRow>

            </TableBody>
          

        </Table>
        
        <div class="flex items-center justify-center">


        <NewExpenditure :showModal="showExpenditure" @update:showModal="showExpenditure=$event">

        </NewExpenditure>
        </div>



      




    </div>




</template>

<style scoped>

</style>
