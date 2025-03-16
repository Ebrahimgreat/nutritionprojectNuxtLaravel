import {ref,onMounted} from "vue";



export function useWeight(){

    let weightData=ref(0)
    let dateValue=ref('')


    async function addWeight(newDate,weightValue,token)
    {
        try{

            const response=await $fetch('http://127.0.0.1:8000/api/storeweight',{
                method:'POST',
                headers:{
                    'Authorization': `Bearer ${token}`
                },
                body:{
                    weight:weightValue,
                    date:newDate
                }
            })

            weightData.value=response
            dateValue.value=newDate

        }
        catch(error){
            console.log(error)
        }


    }
    return{
        weightData,
        addWeight,
        dateValue
    }

}
