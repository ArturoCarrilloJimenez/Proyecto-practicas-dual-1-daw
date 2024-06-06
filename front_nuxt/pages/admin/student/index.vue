<script setup>
import CardAdmin from '~/components/card/CardAdmin.vue';
import { getRutePinia } from '~/stores/getRutePinia';
import { useApi, useActivador } from '~/composables/getData';
import SpinnerCharge from '~/components/SpinnerCharge.vue';
import AddIcon from '~/components/icon/AddIcon.vue';
import FormAddPerson from '~/components/form/FormAddPerson.vue';
import { functionForm } from '~/composables/getData';

const getRoute = getRutePinia();
const { data, getData, sendData, loading } = useApi();
const { formVisibility, toggleFormVisibility } = useActivador();
const { alertConfirm } = functionForm();

onMounted(() => {
    getRoute.updateUrl();
    getData('student');
});


const activeBack = computed(() => data.value?.prev_page_url === null);
const activeNext = computed(() => data.value?.next_page_url === null);

const getPage = computed(() => data.value?.current_page);

const refrescPage = () => {
    getData(`student?page=${getPage.value}`)
}

const deleteStudent = async (id) => {
    const confirm = await alertConfirm('Eliminar estudiante', 'Deseas eliminar el estudiante, esta funcion lo elimina permanentemente', 'Eliminar', 'Estudiante eliminado', 'El estudiante ha sido eliminado correctamente');

    if (confirm) {
        await sendData(`deletePerson/${id}`, '', 'DELETE');
        refrescPage();
    }
}

</script>

<template>
    <main class="container mx-auto mt-10 p-4">
        <SpinnerCharge v-if="loading" />
        <section v-else class="text-center">
            <div class="flex items-center justify-center">
                <h2 class="text-3xl font-bold">¡Administra los estudiantes!</h2>
                <button @click="toggleFormVisibility('new')" class="ml-3">
                    <AddIcon />
                </button>
            </div>
            <div v-if="formVisibility['new']" class="mx-auto bg-white shadow-md rounded-lg p-6 mt-8">
                <FormAddPerson :tipoStudent='true' @refresc="refrescPage()" />
            </div>
            <div>
                <div v-for="{ name, image, house, id } in data?.data" :key="id" class="w-full">
                    <CardAdmin :name="name" :img="image" :house="house" :id="id" @edit="toggleFormVisibility(id)"
                        @delete="deleteStudent(id)" />
                    <FormAddPerson v-if="formVisibility[id]" :tipoStudent="true" :id="id" @refresc="refrescPage()" />
                </div>
            </div>
            <PaginateComponent :activeNext="activeNext" :activeBack="activeBack" @next="getData(data?.next_page_url)"
                @back="getData(data?.prev_page_url)" />
        </section>
    </main>
</template>
