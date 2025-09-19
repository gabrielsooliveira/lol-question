<script setup>
import Navbar from '@/js/Components/Navbar.vue';
</script>

<template>
    <div class="bg-primary bg-gradient">
        <Navbar></Navbar>
        <div class="min-vh-100">
            <slot></slot>
        </div>
    </div>
</template>
