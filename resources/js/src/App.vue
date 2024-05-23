<script setup>
import HeaderComponent from "@component/HeaderComponent.vue";
import FooterComponent from "@component/FooterComponent.vue";
</script>

<template>
    <HeaderComponent />
    <main class="main">
        <router-view/>
    </main>
    <FooterComponent/>
</template>

<style scoped>

</style>
