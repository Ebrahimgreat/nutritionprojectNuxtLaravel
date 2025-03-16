<script setup lang="ts">

import {integer} from "vscode-languageserver-types";

import { Dialog,DialogTitle,DialogTrigger,Button,Label,Input,DialogClose,DialogContent,DialogFooter } from "#components";
import { Pencil } from "lucide-vue-next";

let pencil=Pencil;
const token=useCookie('token');
const props=defineProps({
   weight:Number,
    showModal:Boolean,
    dateValue:String,
    id:Number


})
const emit=defineEmits(['update:showModal','update:weight','update:date','editWeight'])






    import{useWeightStore} from "~/stores/weight";
    import {stringifyJSON} from "confbox";
    let weightStore=useWeightStore()
    let date=ref(weightStore.date)
    let scaleWeight=ref(weightStore.scaleWeight)

    function back()
    {
    navigateTo('/weight')
    }
    let editWeight=ref()
    

    function updateWeight()
    {
        emit('editWeight')
    }

    </script>

    <template>
        

        <Dialog  :open="showModal">
            <DialogTrigger as-child>

           <Button @click="emit('update:showModal',true)">
            <Pencil>

            </Pencil>
            
          
           </Button>
           </DialogTrigger>
           <DialogContent class="bg-black text-white">


           <Label>
            Date
           </Label>
           <Input :model-value="dateValue" disabled/>
           <Label>
            Scale Weight
           </Label>

           <Input type="number" :model-value="weight"/>
           <DialogFooter>
            <Button @click="updateWeight">
                Update

            </Button>
            <Button @click="emit('update:showModal',false)">
                Cancel
            </Button>
           </DialogFooter>
           </DialogContent>
          
           </Dialog>



</template>

<style scoped>

</style>
