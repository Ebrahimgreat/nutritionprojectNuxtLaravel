<script setup>

import NavLink from "@/Components/NavLink.vue";
</script>

<template>




    <NavLink :href="route('habits.weights')" :active="route().current('habits.weights') ">Habits Weight</NavLink>
    <NavLink :href="route('habits.nutrition')" :active="route().current('habits.nutrition')"> Habits nutrition</NavLink>


</template>

<style scoped>

</style>
