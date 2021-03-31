<template>
    <div class="flex flex-col h-full min-h-screen">
        <header>
            <slot name="header"></slot>
        </header>
        <main class="flex-grow">
            <slot ></slot>
        </main>
        <footer class="footer-container">
        </footer>
    </div>
</template>

<script>
export default {
    name: 'AppLayout'
}
</script>

<style scoped>
</style>