<script setup lang="ts">


import {Bar} from 'vue-chartjs';
import {Line} from 'vue-chartjs'
import {
    Chart as ChartJs,
    Title,
    Tooltip,
    Legend,
    LineElement,
    CategoryScale,

    BarElement, LinearScale

} from "chart.js";
ChartJs.register(Title,CategoryScale,Tooltip,Legend,BarElement,LinearScale,
    LineElement)


   defineProps({
       data: {
           Object,
           required: true,
       },


       options: {
           type: Object,

           required: false,
           hover: {
               mode: "nearest",
               intersect: true,
           },
           default: () => ({
               responsive: true,
               maintainAspectRatio: false,


           }),
           events: ['mousemove', 'mouseout', 'click', 'touchstart', 'touchmove'],
           plugins: {
               tooltip: {
                   events: ['click'],


               },
               beforeEvent(chart, args, pluginOptions) {
                   const event = args.event;
                   if (event.type == 'click') {
                       console.log('click')
                   }
               }
           }

       }
   }
   )



</script>

<template>

    <div class="text-blue-700 antialiased">
    <div class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded">
    <div class="rounded-t mb-9 px-4 py-3 bg-transparent">

        <h2 class="uppercase text-white mb-1 text-xs font-semibold">
          Insights and Data
        </h2>
        <h3 class="text-center text-white">
            <slot>

            </slot>
        </h3>

    <div class="p-4 flex-auto te" >


    <Bar :data="data" :options="options"/>
        </div>
    </div>
    </div>


    </div>
</template>

<style scoped>


</style>
