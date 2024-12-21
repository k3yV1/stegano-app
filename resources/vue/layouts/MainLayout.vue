<template>
    <div class="main-layout">
        <SideBar />
        <router-view />
    </div>
</template>

<script>
import SideBar from "../components/sidebar/SideBar.vue";
export default {
    name: "MainLayout",
    components: {
        SideBar
    }
}
</script>

<style scoped>
    .main-layout {
        display: flex;
        height: 100%;
    }
</style>
