import { ref } from "vue"
import Swal from "sweetalert2";

const URL_API = 'http://127.0.0.1:8000/api/';

// Funciones para usar la api
export const useApi = () => {
  const data = ref(null);
  const loading = ref(false);

  // Funcion para optener datos (Solo vale para optener datos)
  const getData = async (url) => {

    // Elimina la url fija en caso de que aparezca en el texto
    url = url.replace(new RegExp(URL_API, 'g'), '');

    loading.value = true;
    try {
      const response = await fetch(URL_API + url);
      data.value = await response.json();
    } catch (e) {
      console.error(e);
    } finally {
      loading.value = false;
    }
  }

  // Función para enviar datos a la API (Este vale para todos los metodos)
  const sendData = async (url, postData, method) => {
    loading.value = true;
    try {
      const options = {
        method: method,
        headers: {
          'Content-Type': 'application/json'
        }
      };
  
      // Añade el cuerpo solo si el método es POST o PUT
      if (method === 'POST' || method === 'PUT') {
        options.body = JSON.stringify(postData.value);
      }
  
      const response = await fetch(URL_API + url, options);
      const responseData = await response.json();
      return responseData;
    } catch (e) {
      console.error("Error sending data:", e);
    } finally {
      loading.value = false;
    }
  };
  

  return {
    loading,
    getData,
    sendData,
    data
  }
}

// Funciones relacionadas con formularios y alertas
export const functionForm = () => {
  // Limpia el texto de posibles errores y de codigo html
  function clearString(text) {
    if (text !== null) {
      text = text.trim().replace(/\s+/g, " "); // Elimina espacios iniciales y finales, y reemplaza espacios seguidos con un solo espacio
      const parser = new DOMParser();
      const doc = parser.parseFromString(text, "text/html");
      text = doc.body.textContent || text; // Elimina el código HTML
    }
    return text;
  }

  // Alerta de confirmacion
  function showAlert(title, text) {
    Swal.fire({
      title: title,
      text: text,
      icon: 'success',
      confirmButtonText: 'Volver'
    });
  }

  // Alerta de confirmacion
  const alertConfirm = (title, text, button, title2, text2) => {
    return new Promise((resolve) => {
      Swal.fire({
        title: title,
        text: text,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: button
      }).then((result) => {
        if (result.isConfirmed) {
          showAlert(title2, text2)
          resolve(true);
        } else {
          resolve(false);
        }
      });
    });
  };

  return {
    clearString,
    showAlert,
    alertConfirm,
  }
}

// Activadores
export const useActivador = () => {
  const formVisibility = ref({});

  // Busca la variable con el id y la activa o desactiva
  function toggleFormVisibility(id) {
    // Guarda el estado del que contiene el id
    const wasVisible = formVisibility.value[id];

    for (let key in formVisibility.value) {
      formVisibility.value[key] = false;
    }

    // Alterna el estado del que queremos activar o no
    formVisibility.value[id] = !wasVisible;
  }

  return {
    formVisibility,
    toggleFormVisibility
  }
}