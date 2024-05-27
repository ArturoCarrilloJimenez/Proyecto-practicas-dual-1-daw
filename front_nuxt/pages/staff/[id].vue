<script setup lang="ts">
import { useRoute } from 'vue-router';
import { onMounted, computed } from 'vue';
import { useGetData } from '#imports';
import SpinnerCharge from '~/components/SpinnerCharge.vue';

const useGetDataPinia = useGetData();

const route = useRoute();
const id = route.params.id;


onMounted(() => {
    useGetDataPinia.getData(`http://127.0.0.1:8000/api/staff/${id}`);
    console.log(useGetDataPinia.data);
});

</script>

<template>
    <SpinnerCharge v-if="useGetDataPinia.loading" />
    <div v-else class="m-6">
        <div class="text-center mb-6">
            <h1 class="text-3xl font-bold mb-2">{{ useGetDataPinia.data?.name }}</h1>
            <p class="text-lg text-gray-600">{{ useGetDataPinia.data?.house }}</p>
        </div>
        <div class="flex justify-center mb-6">
            <img :src="useGetDataPinia.data?.image || 'https://via.placeholder.com/600x800'" alt="Student Image"
            class="rounded-lg w-60 h-auto max-h-80 shadow-lg">
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="p-4 bg-gray-100 rounded-md">
                <h2 class="text-xl font-semibold mb-2">Información Básica</h2>
                <p><strong>Especie:</strong> {{ useGetDataPinia.data?.species }}</p>
                <p><strong>Género:</strong> {{ useGetDataPinia.data?.gender }}</p>
                <p><strong>Mago:</strong> {{ useGetDataPinia.data?.wizard ? 'Sí' : 'No' }}</p>
            </div>
            <div class="p-4 bg-gray-100 rounded-md">
                <h2 class="text-xl font-semibold mb-2">Información Adicional</h2>
                <p><strong>Vivo:</strong> {{ useGetDataPinia.data?.alive ? 'Sí' : 'No' }}</p>
                <p><strong>Actor:</strong> {{ useGetDataPinia.data?.actor }}</p>
                <p><strong>Fecha de Nacimiento:</strong> {{ useGetDataPinia.data?.dateOfBirth }}</p>
                <p><strong>Año de Nacimiento:</strong> {{ useGetDataPinia.data?.yearOfBirth }}</p>
            </div>
        </div>
    </div>
</template>