import {defineStore} from "pinia";
export const useWeightStore=defineStore('weight',{
    state:()=>({
        scaleWeight:null,
        date:null,
    }),
    actions:{
        async setScaleWeight(scaleWeight)
        {
            this.scaleWeight=scaleWeight;
        },
        async setDate(date)
        {
            this.date=date;
        }
    }

})
