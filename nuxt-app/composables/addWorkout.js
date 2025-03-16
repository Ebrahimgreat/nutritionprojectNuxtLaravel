import { ref } from "vue";
export function useAddWorkout(){
    let workoutData=ref([]);
    const token=useCookie('token')
    async function newWorkout(date,workoutItem){
        try{
            const data=await $fetch('http://127.0.0.1:8000/api/storeWorkout',{
                headers:{
                    'Authorization': `Bearer ${token.value}`
                },
                method:'POST',
                body:{
                    date:date,
                    workoutDetail:workoutItem,
                   
                }
            })
            workoutData.value=data;
        }
        catch(error){
            console.log(error)
        }

    }
    return{
        workoutData,
        newWorkout
    }
    
}