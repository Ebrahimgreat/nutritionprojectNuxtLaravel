import{defineStore} from "pinia";

export type TTtoastStatus='success'|'warning'|'error';
interface IToast{
    text:string;
    status:TTtoastStatus;
    id:number;
}
type ToastPayLoad={timeout?: number; text:string}
const defaultTimeout=2000;
const createToast=(text:string, status:TTtoastStatus):IToast=>({
    text,
    status,
    id:Math.random()*1000
})

export const useToasterStore=defineStore('toaster-store',{

    state:():{toasts:IToast[]}=>({
        toasts:[],


    }),
    actions:{
        updateState(payload:ToastPayLoad,status:TTtoastStatus){
            const{text,timeout}=payload;
            const toast=createToast(text, status)
        },
        success(payload:ToastPayLoad){
            this.updateState(payload,'success')
        },
        warning(payload:ToastPayLoad){
            this.updateState(payload,'warning')
        },
        error(payload:ToastPayLoad){
            this.updateState(payload,'error')
        }


    }

})
