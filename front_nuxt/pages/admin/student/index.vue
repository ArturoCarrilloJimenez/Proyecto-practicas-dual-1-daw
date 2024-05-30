<script setup>
import { ref } from 'vue';
import CardAdmin from '~/components/CardAdmin.vue';
import { onMounted, computed } from 'vue';
import { useApi } from '~/composables/getData';
import SpinnerCharge from '~/components/SpinnerCharge.vue';
import AddIcon from '~/components/icon/AddIcon.vue';

const {data, getData, loading} = useApi();

onMounted(() => {
    getData('http://127.0.0.1:8000/api/student');
    console.log(data);
});

const activeBack = computed(() => {
    return data.value?.prev_page_url == null;
});

const activeNext = computed(() => {
    return data.value?.next_page_url == null;
});


const addStudent = ref(false);

function changeAdd() {
    if (addStudent.value == false) addStudent.value = true
    else addStudent.value = false
};

</script>

<template>
    <main class="container mx-auto mt-10 p-4">
        <SpinnerCharge v-if="loading" class="col-span-3" />
        <section v-else class="text-center">
            <div class="flex items-center justify-center">
                <h2 class="text-3xl font-bold">¡Administra los estudiantes!</h2>
                <button @click="changeAdd()" class="ml-3">
                    <AddIcon />
                </button>
            </div>
            <div v-if="addStudent" class="mx-auto bg-white shadow-md rounded-lg p-6 mt-8">
                <FormAddPerson tipo="addStudent"/>
            </div>
            <div>
                <div v-for="{ name, image, house, id } in data?.data" :key="id" class="w-full">
                    <CardAdmin :name="name" :img="image" :house="house" :id="id" ruta="student" />
                </div>
            </div>
            <PaginateComponent :activeNext="activeNext" :activeBack="activeBack"
                @next="getData(data?.next_page_url)"
                @back="getData(data?.prev_page_url)" />
        </section>
    </main>
</template>