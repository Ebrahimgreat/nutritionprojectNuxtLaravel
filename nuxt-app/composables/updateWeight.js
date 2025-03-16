import{ref,onMounted} from "vue";
export function useUpdateWeight()
{
    let editedWeight=ref([])
    async function editedUpdatedWeight(id,scaleWeight)
    {
        try{
            const data=await $fetch('http://127.0.0.1:8000/api/editWeight',{
                method:'POST',
                body:{
                    id:id,
                    scaleWeight:scaleWeight
                }
            })
            editedWeight.value=data;
        }
        catch(error)
        {
            console.log(error)
        }

    }
    return{
        editedWeight,
        editedUpdatedWeight

    }
}