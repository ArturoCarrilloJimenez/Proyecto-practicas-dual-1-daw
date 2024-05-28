<script setup>
import { ref } from 'vue';
import CardAdmin from '~/components/CardAdmin.vue';
import { onMounted, computed } from 'vue';
import { useGetData } from '#imports';
import SpinnerCharge from '~/components/SpinnerCharge.vue';
import AddIcon from '~/components/icon/AddIcon.vue';

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

const addStudent = ref(false);

function changeAdd() {
    if (addStudent.value == false) addStudent.value = true
    else addStudent.value = false
}
</script>

<template>
    <main class="container mx-auto mt-10 p-4">
        <SpinnerCharge v-if="useGetDataPinia.loading" class="col-span-3" />
        <section v-else class="text-center">
            <div class="flex items-center justify-center">
                <h2 class="text-3xl font-bold">¡Administra los estudiantes!</h2>
                <button @click="changeAdd()" class="ml-3">
                    <AddIcon />
                </button>
            </div>

            <div v-if="addStudent" class="mx-auto bg-white shadow-md rounded-lg p-6 mt-8">
                <form action="">
                    <div class="mb-4">
                        <label for="nameStudent" class="block text-gray-700 font-bold mb-2">Nombre Completo</label>
                        <input type="text" name="name" id="nameStudent" placeholder="Nombre"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" />
                    </div>
                    <div class="mb-4">
                        <label for="speciesStudent" class="block text-gray-700 font-bold mb-2">Especie</label>
                        <select name="species" id="speciesStudent"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="human">Humano</option>
                            <option value="half-giant">Semi-gigante</option>
                            <option value="ghost">Fantasma</option>
                            <option value="centaur">Centauro</option>
                            <option value="cat">Gato</option>
                            <option value="werewolf">Hombre lobo</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="genderStudent" class="block text-gray-700 font-bold mb-2">Sexo</label>
                        <select name="gender" id="genderStudent"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="male">Hombre</option>
                            <option value="female">Mujer</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="dateOfBirthStudent" class="block text-gray-700 font-bold mb-2">Fecha de
                            nacimiento</label>
                        <input type="text" name="dateOfBirth" id="dateOfBirthStudent"
                            placeholder="Fecha de nacimiento DD-MM-YYYY"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" />
                    </div>
                    <div class="mb-4">
                        <label for="actorStudent" class="block text-gray-700 font-bold mb-2">Actor</label>
                        <input type="text" name="actor" id="actorStudent" placeholder="Actor"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" />
                    </div>
                    <div class="mb-4">
                        <label for="urlStudent" class="block text-gray-700 font-bold mb-2">Imagen</label>
                        <input type="text" name="image" id="urlStudent" placeholder="URL de la imagen"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" />
                    </div>
                    <div class="mb-4 flex items-center">
                        <input type="checkbox" name="wizard" id="wizardStudent"
                            class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500 mr-2">
                        <label for="wizardStudent" class="text-gray-700 font-bold">Mago</label>
                    </div>
                    <button type="submit"
                        class="w-full bg-blue-600 text-white font-bold py-2 px-4 rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        Añadir
                    </button>
                </form>
            </div>
            <div>
                <div v-for="{ name, image, house, id } in useGetDataPinia.data?.data" :key="id" class="w-full">
                    <CardAdmin :name="name" :img="image" :house="house" :id="id" ruta="student" />
                </div>
            </div>
            <PaginateComponent :activeNext="activeNext" :activeBack="activeBack"
                @next="useGetDataPinia.getData(useGetDataPinia.data?.next_page_url)"
                @back="useGetDataPinia.getData(useGetDataPinia.data?.prev_page_url)" />
        </section>
    </main>
</template>