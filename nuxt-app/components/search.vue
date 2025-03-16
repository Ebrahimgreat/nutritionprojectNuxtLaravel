<script setup lang="ts">


const props=defineProps({
    search:String
})
const emit=defineEmits(['update:search'])

</script>

<template>

    <input type="text" :value="search" @input="emit('update:search',$event.target.value)" placeholder="Search For food" class="w-full px-4 py-2  full bg-primary rounded border text-white">
</template>

<style scoped>

</style>
