

<script setup lang="ts">


import {Doughnut} from 'vue-chartjs'
import {
    Chart as ChartJs,
    Title,
    Tooltip,
    Legend,
    LineElement,

    BarElement, CategoryScale, LinearScale, PointElement

} from "chart.js";
ChartJs.register(Title,Tooltip,Legend,BarElement,CategoryScale,LinearScale,
    LineElement,PointElement)

defineProps({
    data: {
        Object,
        required: true,
    },


    options:{
        type:Object,

        required:false,
        hover:{
            mode:"nearest",
            intersect:true,
        },
        default:()=>({
            responsive:true,


        }),
        events:['mousemove','mouseout','click','touchstart','touchmove'],
        plugins:{
            tooltip:{
                events:['click'],


            },
            beforeEvent(chart,args,pluginOptions)
            {
                const event=args.event;
                if(event.type=='click')
                {
                    console.log('click')
                }
            }


        }


    }



});
</script>

<template>

    <body class="text-blue-700 antialiased">
    <div class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded">
        <div class="rounded-t mb-9 px-4 py-3 bg-transparent">

            <h2 class="uppercase text-blueGray-400 mb-1 text-xs font-semibold">
                Overview
            </h2>
            <h3 class="text-center text-white">
                <slot>

                </slot>
            </h3>

            <div class="p-4 flex-auto">


                <Doughnut :data="data" :options="options"/>
            </div>
        </div>
    </div>


    </body>
</template>

<style scoped>


</style>



<style scoped>

</style>
