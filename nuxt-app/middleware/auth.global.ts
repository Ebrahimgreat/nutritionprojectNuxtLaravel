import {storeToRefs} from "pinia";
import {useauthStore} from "~/stores/auth";


export default defineNuxtRouteMiddleware(async (to, from) => {
    const authStore=useauthStore();

    console.log('From auth middleware')
    const {authenticated} = storeToRefs(useauthStore());

    const token = useCookie('token')
    console.log('middleware running')
    if (token.value) {
        try {
            const data=await $fetch('http://127.0.0.1:8000/api/user',{
                method:'GET',
                headers:{
                    'Accept': 'application/json',
                    'Authorization': `Bearer ${token.value}`
                }
            })
            await authStore.setName(data.name);
            await authStore.setEmail(data.email);
            setPageLayout('dashboard')
            console.log('data',data)
            authenticated.value = true

        }
        catch (error)
        {
            console.log("Error",error);
            token.value=null;
        }
     
    }
    

    if (token.value == null && to.path != '/login') {

        console.log('No tokens')
        return navigateTo('/login')
    } else if (token.value && to?.name === 'login') {
        return navigateTo('/home')
    }

})
