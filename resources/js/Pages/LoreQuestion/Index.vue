<script setup>
import { Link } from '@inertiajs/vue3';

</script>

<template>
    <div>
        Modos de game

        <Link :href="route('lorequestion.roleplay')" class="btn btn-sm btn-danger me-5">Roleplay</Link>
        <Link :href="route('lorequestion.competitive')" class="btn btn-sm btn-dark" disabled>Competitivo</Link>
    </div>
</template>

