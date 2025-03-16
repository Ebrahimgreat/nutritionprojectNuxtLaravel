import{ref,onMounted} from "vue";
export function useUpdateAccount()
{
    let accountInformation=ref([])
    const token=useCookie('token');
    async function updateAccountInformation(name,email,age,sex,height)
    {
        try{
            const data=await $fetch('http://127.0.0.1:8000/api/updateAccountInformation',{
                method:'POST',
                headers:{
                    'Authorization': `Bearer ${token.value}`
                    
                },
                body:{
                    name:name,
                    email:email,
                    age:age,
                    sex:sex,
                    height:height
                }
            })
            accountInformation.value=data;
            
        }
        catch(error)
        {
            console.log(error)
        }
    }
    return{
        accountInformation,
        updateAccountInformation
    }
}