<!-- Formulario para añadir y actualizar casas -->
<script setup lang="ts">
import { useApi, functionForm } from '~/composables/getData';
import SpinnerCharge from './SpinnerCharge.vue';
import { onMounted } from 'vue';

const { data, getData, loading } = useApi();

const props = defineProps({
    tipo: {
        type: String,
        required: true
    },
    id: {
        type: String,
        default: null
    }
});

let namexId = {}; // Se usa solo en caso de que se le alla pasado un id

// En caso de aver pasado id cargo los datos del registro
onMounted(async () => {
    if (props.id !== null) {
        const { data, getData } = useApi();
        await getData(`http://127.0.0.1:8000/api/house/${props.id}`);
        formData.value = data.value.data[0];
        namexId.value = data.value.data[0].name;
    }
});

// Datos que necesitamos y modificaremos
const formData = ref({
    name: '',
    puntos: null,
    image: '',
    errores: []
});

// Metodo para enviar o actualizar un registro
async function submitForm() {
    const { clearString, showAlert } = functionForm();
    loading.value = true;
    formData.value.errores = [];

    // Limpiamos el texto de posibles errores y codigo html
    formData.value.name = clearString(formData.value.name);
    formData.value.image = clearString(formData.value.image);

    // Comprobamos que el nombre no exista anteriormente
    if (formData.value.name) {

        await getData(`http://127.0.0.1:8000/api/houseName/${formData.value.name}`);

        if (data.value && data.value.length !== 0) {
            if ((namexId.value == null) || (formData.value.name !== namexId.value)) {
                formData.value.errores.push('La casa ya existe');
            }
        }
    }

    // Si no hay errores lo mandamos a la api
    if (formData.value.errores.length == 0) {
        const { sendData } = useApi();
        let result = null;

        if (props.id !== null) { // Actalizar
            result = await sendData(`http://127.0.0.1:8000/api/${props.tipo}/${props.id}`, formData, 'PUT');
            showAlert('Casa Actualizada', '¡La casa ha sido actaulizada correctamente!');
        } else { // Añadir
            result = await sendData(`http://127.0.0.1:8000/api/${props.tipo}`, formData, 'POST');
            showAlert('Casa Añadida', '¡La casa ha sido introducida correctamente!');
        }
        loading.value = false;
    }
    loading.value = false;
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
                <input type="number" name="puntos" id="puntosHouse" placeholder="Puntos" v-model="formData.puntos"
                    min="0" step="1" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>
            <div class="mb-4">
                <label for="urlStudent" class="block text-gray-700 font-bold mb-2">Imagen</label>
                <input type="text" name="image" id="urlStudent" placeholder="URL de la imagen" v-model="formData.image"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>
            <button type="submit"
                class="w-full bg-blue-600 text-white font-bold py-2 px-4 rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                {{ (props.id !== null) ? 'Actualizar' : 'Añadir' }}
            </button>
        </form>
        <div class="bg-red-500 mt-2 rounded-lg text-white">
            <p v-for="error in formData.errores">{{ error }}</p>
        </div>
    </div>
</template>