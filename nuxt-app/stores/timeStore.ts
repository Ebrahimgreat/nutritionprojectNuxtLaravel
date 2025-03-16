import{defineStore} from "pinia";

export const usetimeStore=defineStore('time',{
    state:()=>({
        time:null,

    }),
    actions:{
        async setTime(time)
        {
            this.time=time;

        }
    }

})
