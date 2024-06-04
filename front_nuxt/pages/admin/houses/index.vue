<script setup>
import { ref } from 'vue';
import CardAdmin from '~/components/CardAdmin.vue';
import { onMounted, computed } from 'vue';
import { useApi } from '~/composables/getData';
import SpinnerCharge from '~/components/SpinnerCharge.vue';
import AddIcon from '~/components/icon/AddIcon.vue';
import FormAddHouse from '~/components/FormAddHouse.vue';

const {data, getData, loading} = useApi();

onMounted(() => {
    getData('http://127.0.0.1:8000/api/houses');
});

const activeBack = computed(() => {
    return data.value?.prev_page_url == null;
});

const activeNext = computed(() => {
    return data.value?.next_page_url == null;
});


const addHouse = ref(false);

function changeAdd() {
    if (addHouse.value == false) addHouse.value = true
    else addHouse.value = false
};

</script>

<template>
    <main class="container mx-auto mt-10 p-4">
        <SpinnerCharge v-if="loading" class="col-span-3" />
        <section v-else class="text-center">
            <div class="flex items-center justify-center">
                <h2 class="text-3xl font-bold">¡Administra las Casas!</h2>
                <button @click="changeAdd()" class="ml-3">
                    <AddIcon />
                </button>
            </div>
            <div v-if="addHouse" class="mx-auto bg-white shadow-md rounded-lg p-6 mt-8">
                <FormAddHouse tipoStudent="addHouse"/>
            </div>
            <div>
                <div v-for="{ name, image,  id } in data?.data" :key="id" class="w-full">
                    <CardAdmin :name="name" :img="image" house="&nbsp;" :id="id" ruta="house" />
                </div>
            </div>
            <PaginateComponent :activeNext="activeNext" :activeBack="activeBack"
                @next="getData(data?.next_page_url)"
                @back="getData(data?.prev_page_url)" />
        </section>
    </main>
</template>