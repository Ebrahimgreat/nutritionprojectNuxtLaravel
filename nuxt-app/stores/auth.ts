import{defineStore} from "pinia";
import Interceptors from "undici-types/interceptors";
export const useauthStore=defineStore('auth', {
    state: () => ({
        id: '',
        name: '',
        email: '',
        api_token:'',
        authenticated:false
    }),
    actions: {
        async login(email:Object, password:Object) {
            try {


                const result = await $fetch('http://127.0.0.1:8000/api/login', {
                        credentials: 'include',
                        method: 'POST',
                        body: JSON.stringify({
                            email: email,
                            password: password,
                        })


                    },
                );
                console.log("Login Result", result)

                localStorage.setItem('name', result.name)
                localStorage.setItem('token',result.token)
                this.api_token = result.token
                const token=useCookie('token')
                token.value=this.api_token;
                this.name = result.name
                this.email = result.email
                this.authenticated=true;
                navigateTo('/home');

            } catch (error) {
                console.error("login failed")
            }
        },


        async logout() {
            try {
                const token=useCookie('token');
      

                await $fetch('http://127.0.0.1:8000/api/logout',{
                    method:'POST',
                    headers:{
                       'Authorization':`Bearer ${token.value}`

                    }
                })
                token.value=null
      

       
                this.name=''
                this.authenticated=false
                navigateTo('/login')

            } catch (error) {

            }


        },
        async setName(name:str)
        {
            this.name=name;
        },
        async setEmail(email:str){
            this.email=email;
        }
    }

})

