<script setup lang="ts">
import { Dialog,DialogHeader,DialogContent,Button,Table,TableHeader,TableCell,TableBody,TableCaption } from '#components';
let props=defineProps({
    showModal:Boolean,
    workoutDetails:Array
})
let emit=defineEmits(['update:showModal'])
</script>
<template>
    <Dialog :open="showModal">
        <DialogTrigger as-child>
            <Button @click="emit('update:showModal',true)">
                <img src="/icons/view.svg"/>
                
            </Button>

        </DialogTrigger>
        <DialogContent class="bg-black text-white">
 
            <Table>
                <TableCaption>
                    All Weights are in Kilograms
                </TableCaption>
         
                <TableHeader>
                    <TableRow>
                        <TableHead>
                            Exercise
                        </TableHead>
                      
                        <TableHead>
                          Weight
                        </TableHead>
                        <TableHead>
                         Set
                        </TableHead>
                        <TableHead>
                         Reps
                        </TableHead>
                        <TableHead>
                         Reps
                        </TableHead>
                        
                    </TableRow>
                </TableHeader>
                
                <TableBody>
                    <TableRow v-for="(item,count) in workoutDetails">
                        <TableCell>
                            {{ item.name}}
                        </TableCell>
                        <TableCell>
                            {{ item.weight }}
                        </TableCell>
                        <TableCell>
                            {{ item.set }}
                        </TableCell>
                        <TableCell>
                            {{ item.reps }}
                        </TableCell>
                        <TableCell>
                            {{ item.rpe }}
                        </TableCell>
                    </TableRow>

                </TableBody>
            </Table>
            <DialogFooter>
                <Button @click="emit('update:showModal',false)" >
                    Cancel

                </Button>
            </DialogFooter>
          
        </DialogContent>

    </Dialog>
</template>