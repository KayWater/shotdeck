<template>
    <div class="flex flex-row h-full min-h-screen">
        <div class="aside">
            <slot name="aside"></slot>
        </div>
        <div class="flex-grow main">
            <slot >tst</slot>
        </div>
    </div>
</template>

<script>
export default {
    name: 'AdministratorLayout'
}
</script>

<style scoped>
</style>