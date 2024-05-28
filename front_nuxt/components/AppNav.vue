<script setup lang="ts">

</script>

<template>
    <header class="bg-blue-900 text-white py-4">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-2xl font-bold">Harry Potter Web App</h1>
            <nav>
                <ul class="flex space-x-4">
                    <NuxtLink
                        class="transition duration-300 ease-in-out transform hover:scale-105 hover:text-yellow-400"
                        to="/">
                        Inicio
                    </NuxtLink>
                    <NuxtLink
                        class="transition duration-300 ease-in-out transform hover:scale-105 hover:text-yellow-400"
                        to="/student">
                        Estudiantes
                    </NuxtLink>
                    <NuxtLink
                        class="transition duration-300 ease-in-out transform hover:scale-105 hover:text-yellow-400"
                        to="/staff">
                        Profesores
                    </NuxtLink>
                    <NuxtLink
                        class="transition duration-300 ease-in-out transform hover:scale-105 hover:text-yellow-400"
                        to="/house">
                        Casas
                    </NuxtLink>
                    <NuxtLink
                        class="transition duration-300 ease-in-out transform hover:scale-105 hover:text-yellow-400"
                        to="/admin">
                        Administracion
                    </NuxtLink>
                </ul>
            </nav>
        </div>
    </header>
</template>
