<script setup lang="ts">
import { useRouter } from 'vue-router';

const router=useRouter();

function goBack()
{
    router.back();
}
</script>

<template>


    <button  @click="goBack"  type="button">
        <Transition name="fade">

        <img src="/icons/back.svg">

    </Transition>
    </button>


</template>

<style scoped>

button{
 
    border:none;
    padding:10px 20px;
    cursor:pointer;
    left:0px;
    top:0px;

    border-radius:5px;
    position:absolute;
}

.show-enter-active,
.show-leave-enter {
    transform: translateX(0);
    transition: all .3s linear;
}
.show-enter,
.show-leave-to {
    transform: translateX(100%);
}

</style>
