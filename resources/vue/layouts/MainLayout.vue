<template>
    <div class="main-layout">
        <div class="active-user-box">
            <div class="icon"></div>
            <div class="username">
                <span>User name</span>
            </div>
        </div>
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
        position: relative;
        display: flex;
        height: 100%;

        .active-user-box {
            position: absolute;
            top: 0;
            right: 0;
            padding: 15px 120px 15px 10px;
            display: flex;
            align-items: center;
            gap: 10px;
            .icon {
                width: 30px;
                height: 30px;
                background-color: #969CF4;
                border-radius: 999px;
            }

            .username {
                span {
                    font-family: Montserrat, sans-serif;
                    font-weight: 600;
                    font-size: 14px;
                }
            }
        }
    }
</style>
