<script setup lang="ts">
import CardStudent from '../../components/CardStudent.vue';
import { onMounted } from 'vue';
import { useGetData } from '#imports';
import SpinnerCharge from '~/components/SpinnerCharge.vue';


const useGetDataPinia = useGetData();

onMounted(() => {
    useGetDataPinia.getData('http://127.0.0.1:8000/api/student');
});

</script>

<template>
    <main class="container mx-auto mt-10 p-4">
    <section class="text-center">
        <h2 class="text-3xl font-bold mb-10">¡Bienvenidos al apartado de estudiantes!</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 justify-items-center">
            <SpinnerCharge v-if="useGetDataPinia.loading" class="col-span-3"/>
            <div v-else v-for="{ name, image, house, id } in useGetDataPinia.data?.data" :key="id"
                class="max-w-sm rounded overflow-hidden shadow-lg">
                <CardStudent :name="name" :img="image" :house="house" :id="id" />
            </div>
        </div>
    </section>
</main>

</template>