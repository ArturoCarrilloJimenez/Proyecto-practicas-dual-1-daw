<script setup>
import { onMounted, computed } from 'vue';
import { getRutePinia } from '~/stores/getRutePinia';
import { useApi, functionForm } from '~/composables/getData';
import CardAdmin from '~/components/card/CardAdmin.vue';
import SpinnerCharge from '~/components/SpinnerCharge.vue';
import AddIcon from '~/components/icon/AddIcon.vue';
import FormAddHouse from '~/components/form/FormAddHouse.vue';

const getRoute = getRutePinia();
const {data, getData, loading, sendData} = useApi();
const {formVisibility, toggleFormVisibility} = useActivador();
const {alertConfirm} = functionForm()

onMounted(() => {
    getRoute.updateUrl();
    getData('houses');
});

const activeBack = computed(() => data.value?.prev_page_url == null);

const activeNext = computed(() => data.value?.next_page_url == null);

const getPage = computed(() => data.value?.current_page);

const refrescPage = () => {
    getData(`houses?page=${getPage.value}`)
}

const deleteHouse = async (id) => {
    const confirm = await alertConfirm('Eliminar casa', 'Deseas eliminarla casa, esta funcion lo elimina permanentemente', 'Eliminar', 'Casa eliminado', 'La casa ha sido eliminado correctamente');

    if (confirm) {
        await sendData(`deleteHouse/${id}`, '', 'DELETE');
        refrescPage();
    }
}

</script>

<template>
    <main class="container mx-auto mt-10 p-4">
        <SpinnerCharge v-if="loading" class="col-span-3" />
        <section v-else class="text-center">
            <div class="flex items-center justify-center">
                <h2 class="text-3xl font-bold">¡Administra las Casas!</h2>
                <button @click="toggleFormVisibility('new')" class="ml-3">
                    <AddIcon />
                </button>
            </div>
            <div v-if="formVisibility['new']" class="mx-auto bg-white shadow-md rounded-lg p-6 mt-8">
                <FormAddHouse tipo="addHouse" @refresc="refrescPage()"/>
            </div>
            <div>
                <div v-for="{ name, image,  id } in data?.data" :key="id" class="w-full">
                    <CardAdmin :name="name" :img="image" house="&nbsp;" :id="id" ruta="house" @edit="toggleFormVisibility(id)" @delete="deleteHouse(id)" />
                    <FormAddHouse v-if="formVisibility[id]"tipo="updateHouse" :id="id" @refresc="refrescPage()" />
                </div>
            </div>
            <PaginateComponent :activeNext="activeNext" :activeBack="activeBack"
                @next="getData(data?.next_page_url)"
                @back="getData(data?.prev_page_url)" />
        </section>
    </main>
</template>