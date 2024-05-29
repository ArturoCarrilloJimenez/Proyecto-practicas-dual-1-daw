<script setup lang="ts">
import CardStudent from '../../components/CardStudent.vue';
import { onMounted, computed } from 'vue';
import { useGetData } from '~/composables/getData';
import SpinnerCharge from '~/components/SpinnerCharge.vue';

const {data, getData, loading} = useGetData();

onMounted(() => {
    getData('http://127.0.0.1:8000/api/houses');
    console.log(data);
});

const activeBack = computed(() => {
    return data?.prev_page_url == null;
});

const activeNext = computed(() => {
    return data?.next_page_url == null;
});
</script>

<template>
    <main class="container mx-auto mt-10 p-4">
        <SpinnerCharge v-if="loading" class="col-span-3" />
        <section v-else class="text-center">
            <h2 class="text-3xl font-bold mb-10">¡Bienvenidos al apartado de casas!</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 justify-items-center">
                <div v-for="{ name, image, id } in data?.data" :key="id"
                    class="max-w-sm rounded overflow-hidden shadow-lg">
                    <CardStudent :name="name" :img="image" house="&nbsp;" :id="id" ruta="house" />
                </div>
            </div>
            <PaginateComponent :activeNext="activeNext" :activeBack="activeBack"
                @next="getData(data?.next_page_url)"
                @back="getData(data?.prev_page_url)" />
        </section>
    </main>
</template>
