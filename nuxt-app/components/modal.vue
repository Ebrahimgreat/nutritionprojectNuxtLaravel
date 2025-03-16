<script setup lang="ts">

defineProps({
    show:Boolean
})

const emit=defineEmits(['close','add','update:show'])

function add()
{
 emit('add')
    emit('close')
}

function closeModal()
{
    emit('update:show',false)
}

</script>



<template>


        <div v-if="show" class="modal-mask">

    <div class="modal-container">
        <div class="modal-header">
            <button @click="emit('close')" style=".btn-close">
                X

            </button>
            <div class="flex items-center justify-center font-bold text-3xl">





            <slot name="header" class="text-center">


            </slot>

            </div>
        </div>
        <div class="modal-body">


            <slot name="body"> Body

            </slot>
        </div>
            <div class="modal-footer">
            <slot name="footer">

                <div class="flex flex-row">


                    <button @click="add" class=" w-full bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                   Save
                </button>
                </div>
            </slot>


        </div>
        </div>
        </div>

</template>

<style scoped>

.modal-mask{
    position: fixed;
    z-index: 9998;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    display: flex;
    transition: opacity 0.3s ease;

}
.modal-container{
    width: 800px;
    margin: auto;
    padding: 20px 30px;
    background-color: black;
    border-radius: 2px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.33);
    transition: all 0.3s ease;
}



.modal-header h3{
    margin-top:0;
    color:#42b983
}
.modal-footer {
    padding: 15px;
    display: flex;
}

.modal-header {
    position: relative;
    border-bottom: 1px solid #eeeeee;
    color: white;
    justify-content: space-between;
}

.modal-footer {
    border-top: 1px solid #eeeeee;
    flex-direction: column;
    justify-content: flex-end;
}

.modal-body {
    position: relative;
    padding: 20px 10px;
}

.modal-default-Button{
    float:right;
}

.btn-close {
    position: absolute;
    top: 0;
    right: 0;
    border: none;
    font-size: 20px;
    padding: 10px;
    cursor: pointer;
    font-weight: bold;
    color: #4AAE9B;
    background: transparent;
}

.btn-green {
    color: white;
    background: #4AAE9B;
    border: 1px solid #4AAE9B;
    border-radius: 2px;
}

</style>
