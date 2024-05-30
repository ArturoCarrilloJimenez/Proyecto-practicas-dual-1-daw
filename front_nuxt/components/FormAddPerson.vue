<script setup lang="ts">
import { onMounted, ref } from 'vue';
import { useApi } from '~/composables/getData';
import SpinnerCharge from './SpinnerCharge.vue';
import Swal from "sweetalert2";

const props = defineProps({
    tipo: {
        type: String,
        required: true
    }
});

const { data, getData, loading } = useApi();

onMounted(() => {
    getData('http://127.0.0.1:8000/api/allHouses');
    console.log(data);
});

const formData = ref({
    name: '',
    alternate_names: [], // Se añadira despues
    houseId: '',
    species: '',
    gender: '',
    dateOfBirth: '',
    yearOfBirth: null,
    wand: { // Varita, esto se añade al editar la persona
        wood: '',
        core: '',
        length: null
    },
    actor: '',
    alternate_actors: [], // Lista para actores alternativos, esto se añade al editar la persona
    image: '',
    alive: true, // Por defecto al añadir el estudiante esta vivo
    wizard: false,
    errores: []
});

async function submitForm() {
    loading.value = true;
    formData.value.errores = [];

    formData.value.name = clearString(formData.value.name);
    formData.value.actor = clearString(formData.value.actor);
    formData.value.image = clearString(formData.value.image);

    if (formData.value.name) {
        const { data, getData } = useApi();

        await getData(`http://127.0.0.1:8000/api/person/${formData.value.name}`);

        if (data.value && data.value.length !== 0) {
            formData.value.errores.push('La persona ya existe');
        }
    }

    if (formData.value.dateOfBirth) {
        const dateParts = formData.value.dateOfBirth.split('-');
        formData.value.dateOfBirth = dateParts[2] + '-' + dateParts[1] + '-' + dateParts[0];
        formData.value.yearOfBirth = dateParts.length > 0 ? dateParts[0] : null;
    }


    if (formData.value.errores.length == 0) {
        const { data, sendData } = useApi();
        const result = await sendData(`http://127.0.0.1:8000/api/${props.tipo}`, formData);
        showAlert()
        loading.value = false;
    } else {
        console.log("Errores en el formulario:", formData.value.errores);
    }
    loading.value = false;
}


function clearString(text: string) {
    text = text.trim().replace(/\s+/g, " "); // Elimina espacios iniciales y finales, y reemplaza espacios seguidos con un solo espacio
    const parser = new DOMParser();
    const doc = parser.parseFromString(text, "text/html");
    text = doc.body.textContent || text; // Elimina el código HTML
    return text;
}

function showAlert() {
    Swal.fire({
        title: 'Persona Añadida!',
        text: '¡La persona ha sido introducida correctamente!',
        icon: 'success',
        confirmButtonText: 'Volver'
    });
}
</script>

<template>
    <SpinnerCharge v-if="loading" />
    <div v-else>
        <form @submit.prevent="submitForm()">
            <div class="mb-4">
                <label for="nameStudent" class="block text-gray-700 font-bold mb-2">Nombre Completo<span
                        class="text-red-700">*</span></label>
                <input type="text" name="name" id="nameStudent" placeholder="Nombre" v-model="formData.name" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>
            <div class="mb-4">
                <label for="houseIdStudent" class="block text-gray-700 font-bold mb-2">Casa</label>
                <select name="houseId" id="houseIdStudent" v-model="formData.houseId"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Sin casa</option>
                    <option v-for="{ name, id } in data" :key="id" :value="id">{{ name }}</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="speciesStudent" class="block text-gray-700 font-bold mb-2">Especie<span
                        class="text-red-700">*</span></label>
                <select name="species" id="speciesStudent" required v-model="formData.species"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="" selected disabled>Seleciona una especie</option>
                    <option value="human">Humano</option>
                    <option value="half-giant">Semi-gigante</option>
                    <option value="ghost">Fantasma</option>
                    <option value="centaur">Centauro</option>
                    <option value="cat">Gato</option>
                    <option value="werewolf">Hombre lobo</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="genderStudent" class="block text-gray-700 font-bold mb-2">Sexo<span
                        class="text-red-700">*</span></label>
                <select name="gender" id="genderStudent" required v-model="formData.gender"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="" selected disabled>Seleciona una sexo</option>
                    <option value="male">Hombre</option>
                    <option value="female">Mujer</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="dateOfBirthStudent" class="block text-gray-700 font-bold mb-2">Fecha de
                    nacimiento</label>
                <input type="date" name="dateOfBirth" id="dateOfBirthStudent" v-model="formData.dateOfBirth"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>
            <div class="mb-4">
                <label for="actorStudent" class="block text-gray-700 font-bold mb-2">Actor</label>
                <input type="text" name="actor" id="actorStudent" placeholder="Actor" v-model="formData.actor"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>
            <div class="mb-4">
                <label for="urlStudent" class="block text-gray-700 font-bold mb-2">Imagen</label>
                <input type="text" name="image" id="urlStudent" placeholder="URL de la imagen" v-model="formData.image"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>
            <div class="mb-4 flex items-center">
                <input type="checkbox" name="wizard" id="wizardStudent" v-model="formData.wizard"
                    class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500 mr-2">
                <label for="wizardStudent" class="text-gray-700 font-bold">Mago</label>
            </div>
            <button type="submit"
                class="w-full bg-blue-600 text-white font-bold py-2 px-4 rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                Añadir
            </button>
        </form>
        <div class="bg-red-500 mt-2 rounded-lg text-white">
            <p v-for="error in formData.errores">{{ error }}</p>
        </div>
    </div>
</template>