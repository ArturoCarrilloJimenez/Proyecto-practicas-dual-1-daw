<script setup lang="ts">
import CardStudent from './CardStudent.vue';
import { onMounted, computed } from 'vue';
import { useGetData } from '#imports';
import SpinnerCharge from '~/components/SpinnerCharge.vue';

const useGetDataPinia = useGetData();

onMounted(() => {
    useGetDataPinia.getData('http://127.0.0.1:8000/api/student');
    console.log(useGetDataPinia.data);
});

const activeBack = computed(() => {
    return useGetDataPinia.data?.prev_page_url == null;
});

const activeNext = computed(() => {
    return useGetDataPinia.data?.next_page_url == null;
});
</script>

<template>
    <main class="container mx-auto mt-10 p-4">
        <SpinnerCharge v-if="useGetDataPinia.loading" class="col-span-3" />
        <section v-else class="text-center">
            <h2 class="text-3xl font-bold mb-10">¡Bienvenidos al apartado de casas!</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 justify-items-center">
                <div v-for="{ name, image, house, id } in useGetDataPinia.data?.data" :key="id"
                    class="max-w-sm rounded overflow-hidden shadow-lg">
                    <CardStudent :name="name" :img="image" house="&nbsp;" :id="id" ruta="student />
                </div>
            </div>
            <PaginateComponent :activeNext="activeNext" :activeBack="activeBack"
                @next="useGetDataPinia.getData(useGetDataPinia.data?.next_page_url)"
                @back="useGetDataPinia.getData(useGetDataPinia.data?.prev_page_url)" />
        </section>
    </main>
</template>
