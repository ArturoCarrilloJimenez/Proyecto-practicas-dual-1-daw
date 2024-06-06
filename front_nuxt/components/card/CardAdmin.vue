<!-- Componente que mustra los datos de un registro en el menu de administracion -->
<script setup>
import DeleteIcon from '../icon/DeleteIcon.vue';
import EditIcon from '../icon/EditIcon.vue';


defineProps({
  id: String,
  ruta: String,
  name: String,
  img: String,
  house: String
});

const emit = defineEmits(['edit', 'delete']);
</script>

<template>
  <div class="container mx-auto my-8 p-4 bg-white border border-gray-200 rounded-lg shadow-lg">
    <div class="flex items-center justify-between p-4 border-b border-gray-200">
      <div class="flex items-center">
        <img :src="img || 'https://via.placeholder.com/600x800'" :alt="`Imagen de ${name}`"
          class="h-20 w-20 object-cover rounded-lg mr-4">
        <div>
          <h3 class="font-bold text-lg">{{ name }}</h3>
          <p class="text-gray-600">{{ house || 'Sin Casa' }}</p>
        </div>
      </div>
      <div class="flex items-center space-x-4">
        <button @click="emit('edit')">
          <EditIcon />
        </button>
        <button @click="emit('delete')">
          <DeleteIcon />
        </button>
      </div>
    </div>
  </div>
</template>