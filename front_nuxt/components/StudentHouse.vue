<script setup lang="ts">
import CardStudent from './CardStudent.vue';
import { onMounted, computed } from 'vue';
import { 
useApi } from '#imports';
import SpinnerCharge from '~/components/SpinnerCharge.vue';

const 
useApiPinia = 
useApi();

onMounted(() => {
    
useApiPinia.getData('http://127.0.0.1:8000/api/student');
    console.log(
useApiPinia.data);
});

const activeBack = computed(() => {
    return 
useApiPinia.data?.prev_page_url == null;
});

const activeNext = computed(() => {
    return 
useApiPinia.data?.next_page_url == null;
});
</script>

<template>
    <main class="container mx-auto mt-10 p-4">
        <SpinnerCharge v-if="
useApiPinia.loading" class="col-span-3" />
        <section v-else class="text-center">
            <h2 class="text-3xl font-bold mb-10">¡Bienvenidos al apartado de casas!</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 justify-items-center">
                <div v-for="{ name, image, house, id } in 
useApiPinia.data?.data" :key="id"
                    class="max-w-sm rounded overflow-hidden shadow-lg">
                    <CardStudent :name="name" :img="image" house="&nbsp;" :id="id" ruta="student />
                </div>
            </div>
            <PaginateComponent :activeNext="activeNext" :activeBack="activeBack"
                @next="
useApiPinia.getData(
useApiPinia.data?.next_page_url)"
                @back="
useApiPinia.getData(
useApiPinia.data?.prev_page_url)" />
        </section>
    </main>
</template>
