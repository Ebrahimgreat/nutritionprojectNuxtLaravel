<script setup lang="ts">
const props=defineProps({
    modelValue:String,

})

</script>
    <template>

        <input type="text" :value="modelValue" @input="$emit('update:modelValue',$event.target.value); $emit('getFilteredCustomFoods')" @click="$emit('getCustomFoods')" placeholder="Search For food" class="w-full px-4 py-2 rounded full bg-primary border text-white">

    </template>

    <style scoped>

    </style>



<style scoped>

</style>
