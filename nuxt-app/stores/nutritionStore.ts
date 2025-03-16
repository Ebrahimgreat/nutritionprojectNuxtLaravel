import {defineStore} from "pinia";
export const useNutritionStore=defineStore('nutritionStore',{
    state:()=>({
        proteinValue:0,
  dateProtein:{} as Record<string,{protein:number; carbs:number; fat:number; foodName:string}[]>

}),
    actions:{
        setData(date:string,protein:number,carbs:number,fat:number,foodName:string){
            if(!this.dateProtein[date]){
                this.dateProtein[date]=[];
            }
            this.dateProtein[date].push({protein,carbs,fat,foodName})

        },
        setProteinValue(proteinValue:number)
        {
            this.proteinValue=proteinValue
        },
        getData(date:string){
            return this.dateProtein[date] ||0

        },



    }
})
