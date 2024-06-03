<script setup lang="ts">
import { onMounted, ref } from 'vue';
import { useApi } from '~/composables/getData';
import SpinnerCharge from './SpinnerCharge.vue';
import Swal from "sweetalert2";

const { data, getData, loading } = useApi();

const props = defineProps({
    tipo: {
        type: String,
        required: true
    }
});

const formData = ref({
    name: '',
    puntos: null,
    image: '',
    errores: []
});

async function submitForm() {
    loading.value = true;
    formData.value.errores = [];

    formData.value.name = clearString(formData.value.name);
    formData.value.image = clearString(formData.value.image);

    if (formData.value.name) {

        await getData(`http://127.0.0.1:8000/api/houseName/${formData.value.name}`);

        if (data.value && data.value.length !== 0) {
            formData.value.errores.push('La casa ya existe');
        }
    }

    if (formData.value.errores.length == 0) {
        const { sendData } = useApi();
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
        title: 'Casa Añadida!',
        text: '¡La casa ha sido introducida correctamente!',
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
                <label for="nameHouse" class="block text-gray-700 font-bold mb-2">Nombre<span
                        class="text-red-700">*</span></label>
                <input type="text" name="name" id="nameHouse" placeholder="Nombre" v-model="formData.name" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>
            <div class="mb-4">
                <label for="puntosHouse" class="block text-gray-700 font-bold mb-2">Puntos<span
                        class="text-red-700">*</span></label>
                <input type="number" name="puntos" id="puntosHouse" placeholder="Puntos" v-model="formData.puntos" min="0" step="1" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>
            <div class="mb-4">
                <label for="urlStudent" class="block text-gray-700 font-bold mb-2">Imagen</label>
                <input type="text" name="image" id="urlStudent" placeholder="URL de la imagen" v-model="formData.image"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" />
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