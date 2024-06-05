<script setup>
import CardAdmin from '~/components/CardAdmin.vue';
import { useApi, useActivador } from '~/composables/getData';
import SpinnerCharge from '~/components/SpinnerCharge.vue';
import AddIcon from '~/components/icon/AddIcon.vue';
import FormAddPerson from '~/components/FormAddPerson.vue';
import { functionForm } from '~/composables/getData';

const { data, getData, sendData, loading } = useApi();
const { formVisibility, toggleFormVisibility } = useActivador();
const { alertConfirm } = functionForm();

onMounted(() => {
    getData('http://127.0.0.1:8000/api/student');
});

const activeBack = computed(() => data.value?.prev_page_url === null);
const activeNext = computed(() => data.value?.next_page_url === null);

const deleteStudent = async (id) => {
    const confirm = await alertConfirm('Eliminar estudiante', 'Deseas eliminar el estudiante, esta funcion lo elimina permanentemente', 'Eliminar', 'Estudiante eliminado', 'El estudiante ha sido eliminado correctamente');

    if (confirm) {
        sendData(`http://127.0.0.1:8000/api/deletePerson/${id}`, '', 'DELETE');
    }
}

</script>

<template>
    <main class="container mx-auto mt-10 p-4">
        <SpinnerCharge v-if="loading" />
        <section v-else class="text-center">
            <div class="flex items-center justify-center">
                <h2 class="text-3xl font-bold">¡Administra los profesores!</h2>
                <button @click="toggleFormVisibility('new')" class="ml-3">
                    <AddIcon />
                </button>
            </div>
            <div v-if="formVisibility['new']" class="mx-auto bg-white shadow-md rounded-lg p-6 mt-8">
                <FormAddPerson :tipoStudent='true' />
            </div>
            <div>
                <div v-for="{ name, image, house, id } in data?.data" :key="id" class="w-full">
                    <CardAdmin :name="name" :img="image" :house="house" :id="id" @edit="toggleFormVisibility(id)"
                        @delete="deleteStudent(id)" />
                    <FormAddPerson v-if="formVisibility[id]" :tipoStudent="true" :id="id" />
                </div>
            </div>
            <PaginateComponent :activeNext="activeNext" :activeBack="activeBack" @next="getData(data?.next_page_url)"
                @back="getData(data?.prev_page_url)" />
        </section>
    </main>
</template>
