<script setup lang="ts">
import { useRoute } from 'vue-router';
import { onMounted, computed } from 'vue';
import { getRutePinia } from '~/stores/getRutePinia';
import { useApi } from '~/composables/getData';
import SpinnerCharge from '~/components/SpinnerCharge.vue';

const getRoute = getRutePinia();
const {data, getData, loading} = useApi();

const route = useRoute();
const id = route.params.id;

onMounted(() => {
    getRoute.updateUrl();
    getData(`house/${id}`);
});

const activeBack = computed(() => {
    return data.value?.prev_page_url == null;
});

const activeNext = computed(() => {
    return data.value?.next_page_url == null;
});


</script>

<template>
    <SpinnerCharge v-if="loading" />
    <div v-else-if="data?.Message == undefined" class="m-6">
        <div class="text-center">
            <h1 class="text-2xl font-bold">{{ data?.data[0].name }}</h1>
            <p class="text-lg text-gray-600">Puntos: {{ data?.data[0].puntos }}</p>
        </div>
        <div class="flex justify-center mb-6">
            <img :src="data?.data[0].image || 'https://via.placeholder.com/600x800'" alt="Student Image"
                class="rounded-lg w-60 h-auto max-h-80 shadow-lg">
        </div>
        <div class="text-center" v-if="data?.data[0].student !== null">
            <h3 class="text-2xl font-bold mb-10">Miembros</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 justify-items-center">
                <div v-for="{ student, studentImg, studentId, isStudent } in data?.data" :key="id"
                    class="max-w-sm rounded overflow-hidden shadow-lg">
                    <CardStudent :name="student" :img="studentImg" house="&nbsp;" :id="studentId" :ruta="isStudent ? 'student' : 'staff'" />
                </div>
            </div>
            <PaginateComponent :activeNext="activeNext" :activeBack="activeBack"
                @next="getData(data?.next_page_url)"
                @back="getData(data?.prev_page_url)" />
        </div>
    </div>
    <Error404 v-else />
</template>