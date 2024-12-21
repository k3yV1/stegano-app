<template>
    <div class="app">
        <transition name="component-fade" mode="out-in">
            <router-view />
        </transition>
    </div>
</template>
<script>
export default {
    name: "App"
}
</script>

<style lang="scss">
* {
    margin: 0;
}

.app {
    width: 100%;
    height: 100vh;
}

.component-fade-enter-active, .component-fade-leave-active {
    transition: opacity 0.5s;
}
.component-fade-enter, .component-fade-leave-to {
    opacity: 0;
}
</style>
