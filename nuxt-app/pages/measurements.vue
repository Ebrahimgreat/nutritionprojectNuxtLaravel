<script setup lang="ts">

import router from "#app/plugins/router";

async function back()
{
    navigateTo('/home');

}

</script>

<template>
<button-custom @click="back">
    Dashboard
</button-custom>
</template>

<style scoped>

</style>
