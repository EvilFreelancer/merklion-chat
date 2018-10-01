<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-8">
                <router-view></router-view>
            </div>
        </div>
    </div>
</template>

<style>
    .fade-enter-active, .fade-leave-active {
        transition: opacity .5s
    }

    .fade-enter, .fade-leave-active {
        opacity: 0
    }
</style>

<script>
    export default {}
</script>
