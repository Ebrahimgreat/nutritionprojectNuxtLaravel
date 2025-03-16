

    <script setup lang="ts">


        import {Bar} from 'vue-chartjs';
        import {Line} from 'vue-chartjs'

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
                type:Object,
                required: true,
            },


            options:{
                type:Object,
                legend:{
                    labels:{

                        fontSize:18
                    }

                },

                required:false,
                hover:{
                    mode:"nearest",
                    intersect:true,
                },
                default:()=>({
                    responsive:true,
                    maintainAspectRatio: false,


                }),
                plugins:{
                    title:{
                        display:true,
                        text:'Custom chart',
                        padding: {
                            top: 10,
                            bottom: 30
                        },
                        color:"white"

                    },
                    legend:{
                        labels:{
                            color:"white"
                        }
                    }
                     },
                animations: {
                    tension: {
                        duration: 1000,
                        easing: 'linear',
                        from: 1,
                        to: 0,
                        loop: true
                    }
                },
                scales:{
                    y:{
                      ticks:{color:"white"}
                    }
                }



            },





        });
    </script>

    <template>

        <body class="">
        <div class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded">
            <div class="rounded-t mb-9 px-4 py-3 bg-transparent">

                <h2 class="uppercase text-white mb-1 text-xs font-semibold">
                    Insights and data  <slot>

                </slot>
                </h2>
                <h3 class="text-center text-white">
                    <slot>

                    </slot>
                </h3>

                <div class="p-4 flex-auto">


                    <Line :data="data" :options="options"/>
                </div>
            </div>
        </div>


        </body>
    </template>

    <style scoped>


    </style>



<style scoped>

</style>
