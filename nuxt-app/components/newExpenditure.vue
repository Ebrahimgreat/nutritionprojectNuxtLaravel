<script lang setup="ts">

const props=defineProps({
    showModal:Boolean
})
const emit=defineEmits(['update:showModal'])
import { Stepper,StepperIndicator,StepperItem } from '#components';
import { Dialog,DialogTrigger,Button,Label,DialogFooter,Select,SelectItem,SelectTrigger,SelectLabel } from '#components';

</script>
<template>
    <Dialog :open="showModal">
        <DialogTrigger>

            <Button @click="emit('update:showModal',true)">
                Reset Expenditure

            </Button>
        </DialogTrigger>
        <DialogContent class="bg-black text-white">

            <Label>
                Height
            </Label>
            <Input/>
            <Label>
                Weight
            </Label>
            <Input type="number"/>
            <Select>
                <SelectTrigger>
                    <SelectContent>
                        <SelectItem>
                            No Exercise
                        </SelectItem>
                        <SelectItem>
                          Little Exercise
                        </SelectItem>
                        <SelectItem>
                          Moderate Exercise
                        </SelectItem>
                        <SelectItem>
                          Intense Exercise
                        </SelectItem>
                    </SelectContent>

                </SelectTrigger>
                
            </Select>

            <DialogFooter>
                <Button>
                    Update
                </Button>
                <Button @click="emit('update:showModal',false)">
                    Cancel
                </Button>

            </DialogFooter>
            
        </DialogContent>
    </Dialog>
</template>