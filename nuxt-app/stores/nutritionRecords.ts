import{defineStore} from "pinia";
export const usenutritionstore=defineStore('nutrition',{
    state:()=>({
        date:null,
        protein:null,
        fats:null,
        carbs:null,
        id:null,
        calories:null


    }),
   actions:{
        async setDate(date)
        {
            this.date=date;
        },
       async setProtein(protein)
       {
           this.protein=protein
       },
       async setFats(fats)
       {
           this.fats=fats;

       },
       async setCarbs(carbs)
       {
           this.carbs=carbs
       },
       async setId(id)
       {
           this.id=id;
       },
       async setCalories(calories)
       {
           this.calories=calories
       }
   }
})
