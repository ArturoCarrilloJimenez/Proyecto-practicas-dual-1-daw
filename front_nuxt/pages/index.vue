<script setup lang="ts">
import { getRutePinia } from '~/stores/getRutePinia';
import { onMounted } from 'vue'

const getRoute = getRutePinia();

onMounted(() => {
    getRoute.updateUrl()
});

</script>

<template>
    <!-- Main Content -->
    <main class="container mx-auto mt-10 p-4">
        <section class="text-center">
            <h2 class="text-3xl font-bold mb-4">¡Bienvenidos a la Harry Potter Web App!</h2>
            <p class="text-gray-700 mb-6">
                Explora el mágico mundo de Harry Potter gestionando estudiantes, profesores y casas de Hogwarts.
            </p>
            <img src="https://cdn.sortiraparis.com/images/80/66131/855789-harry-potter-hogwarts-legacy-se-devoile-dans-sa-bande-annonce-de-lancement.jpg"
                alt="Hogwarts" class="mx-auto mb-6">
            <NuxtLink class="bg-blue-900 text-white px-4 py-2 rounded hover:bg-blue-700" to="/student">Explora el mundo
                de Hogwarts</NuxtLink>
        </section>
    </main>
</template>

<style>
/* Additional custom styles if needed */
</style>
