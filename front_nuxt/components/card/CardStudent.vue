<!-- Componente que mustra los datos de un registro en el menu de visualizacion -->
<script setup>

defineProps({
    id: String,
    ruta: String,
    name: String,
    img: String,
    house: String
});

</script>

<template>
    <div
        class="max-w-sm rounded-lg overflow-hidden shadow-xl hover:shadow-2xl transition-shadow duration-300 ease-in-out">
        <img :src="img || 'https://via.placeholder.com/600x800'" :alt="`Imagen de ${name}`"
            class="h-80 w-96 object-cover">
        <div class="px-6 py-4 bg-white">
            <h3 class="font-bold text-xl mb-2">{{ name }}</h3>
            <p class="text-gray-800 text-base">{{ house || 'Sin Casa' }}</p>
        </div>
        <div class="mb-4">
            <NuxtLink class="bg-blue-900 text-white px-4 py-2 rounded hover:bg-blue-700" :to="'/' + ruta + '/' + id">Ver detalles</NuxtLink>
        </div>
    </div>
</template>