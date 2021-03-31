<template>
    <div class="flex flex-row container leading-10">
        <h2 class="h-14 leading-10"><router-link :to="{ path : '/' }">子非影人</router-link></h2>
        <ul class="ml-10 flex flex-row">
            <li class="mx-1 px-1 md:mx-3 md:px-3"><a>TEST1</a></li>
            <li class="mx-1 px-1 md:mx-3 md:px-3"><a>TEST2</a></li>
            <li class="mx-1 px-1 md:mx-3 md:px-3"><a>TEST3</a></li>
        </ul>
    </div>
</template>

<script>
export default {
    name: 'navigation'
}
</script>

<style scoped>

</style>