import{ref,onMounted} from "vue";
export function useNutrientAdd()
{
    let nutrientData=ref([]);

    async function addNutrient(token,date,protein,calories,carbs,fat,foodName)
    {
        try{
            const response=await $fetch('http://127.0.0.1:8000/api/storeFood',{
                method:'POST',
                headers:{
                    'Authorization':`Bearer ${token}`
                },
                body:{
                    date:date,
                    protein:protein,
                    carbs:carbs,
                    calories:calories,
                    fat:fat,
                    foodName:null,
                 
                }
            })
            nutrientData.value=response

        }
        catch(error)
        {
            console.log(error)
        }

    }
    return{addNutrient,nutrientData}
}
