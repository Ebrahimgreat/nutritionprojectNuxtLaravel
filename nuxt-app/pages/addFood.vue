<script setup lang="ts">



import{usetimeStore} from "~/stores/timeStore";
let time=usetimeStore()
let searchItem=ref();
let searchItems=ref([]);

let foodName=ref('');
let quantity=ref(0);
let description=ref();
let showSearch=ref(true);

async function search()
{
   searchItems.value=await  $fetch('http://127.0.1:8000/api/addNewFood',{
       method:'GET',

     headers:{
           'search':searchItem.value
     },
    })
}
function back()
{
    navigateTo('/nutrition.show')
}

let showModal=ref(false)

let foodId=ref()
function modelTrue(name:String,food_id,describe)
{
    foodId.value=food_id
    description.value=describe;

    showModal.value=true;
    foodName.value=name;

}

function customFood()
{
    navigateTo('/customFood')
}
function addCustomFood()
{
    navigateTo('/addCustomFood')
}
async  function storeFood()
{
    try{
        await $fetch('http://127.0.0.1:8000/api/storefood',{
            method:'POST',
            headers:{'foodName':'yes'},
            body:{
                foodName:foodName.value,
                quantity:quantity.value,
                food_id:foodId.value,
                description:description.value
            }

        })
    }
    catch (e)
    {

    }
}



function showDialog()
{}
</script>


<template>



    <back-button @click="back">


    </back-button>


    <div class="bg-gray-600 flex items-center justify-center h-screen">
    <div class="relative w-60">


        <div class="mb-6">
        <button-custom @click="customFood"> Create Custom Food</button-custom>
        </div>

        <button-custom @click="addCustomFood"> AddCustomFood</button-custom>


        <div class="mb-6">
        <label class="block text-gray-700 text-sm font-bold mb-2"> Time</label>

        <input type="text" v-model="time.time"  class="w-full px-4 py-2 rounded-full focus:outline-none" @keyup="search">
        </div>
        <label class="block text-gray-700 text-sm font-bold mb-2"> Search For Food</label>

        <input type="text" v-model="searchItem" placeholder="Enter Food" class="w-full px-4 py-2 rounded-full focus:outline-none" @keyup="search">






</div>
        <div class="relative w-60">



            <div v-if="showModal==true">
                <div class="bg-pink shadow-md rounded px-8 pt-6 pb-8 mb-4 w-full">


                        <button class="shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline-none text-white font-bold py-2 px-4 rounded" @click="showModal=false">
                            Close
                        </button>
                        <label class="block text-gray-500 font-bold mb-1 mb:mb-0 pr-4"> Quantity</label>
                        <input v-model="quantity" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none dark:focus:bg-white focus:border-purple-500" type="number">

                        <label class="block text-gray-500 font-bold mb-1 mb:mb-0 pr-4">
                            Food Name
                        </label>
                        <input disabled v-model="foodName" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none dark:focus:bg-white focus:border-purple-500" type="text">

                        <button @click="storeFood" type="submit" class="shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline-none text-white font-bold py-2 px-4 rounded"> Submit</button>

                </div>
            </div>

        </div>
    </div>



    <table class="table-fixed w-full text-left">
        <thead>
        <tr>
            <th class="px-4 py-2 border-blue-gray-100 bg-blue-gray-50"> Food Name</th>
            <th class="px-4 py-2 border-blue-gray-100 bg-blue-gray-50"  >
                Description
            </th>
        </tr>
        </thead>
        <tbody>
        <tr class="px-4 py-2" v-for="items in searchItems">
            <td  class="px-4 py-2">{{items.food_name}}
                <button  @click=modelTrue(items.food_name,items.food_id,items.description)>+</button>
            </td>
            <td class="px-4 py-2"> {{items.description}}</td>
        </tr>
        </tbody>


    </table>






</template>

<style scoped>
.v-enter-from{
    opacity: 0;
    translate:-100px;

}
.v-enter-from{
    opacity:1;
    translate:0 0;
}
.v-leave-to{
    opacity:1;
    translate:100px 0;
}


</style>
