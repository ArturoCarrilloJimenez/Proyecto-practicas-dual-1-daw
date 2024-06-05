import { ref } from "vue"
import Swal from "sweetalert2";

export const useApi = () => {
  const data = ref(null);
  const loading = ref(false);

  // Funcion para optener datos
  const getData = async (url) => {
    loading.value = true;
    try {
      const response = await fetch(url);
      data.value = await response.json();
    } catch (e) {
      console.error(e);
    } finally {
      loading.value = false;
    }
  }

  // Función para enviar datos a la API
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
  
      const response = await fetch(url, options);
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

export const functionForm = () => {
  function clearString(text) {
    if (text !== null) {
      text = text.trim().replace(/\s+/g, " "); // Elimina espacios iniciales y finales, y reemplaza espacios seguidos con un solo espacio
      const parser = new DOMParser();
      const doc = parser.parseFromString(text, "text/html");
      text = doc.body.textContent || text; // Elimina el código HTML
    }
    return text;
  }

  function showAlert(title, text) {
    Swal.fire({
      title: title,
      text: text,
      icon: 'success',
      confirmButtonText: 'Volver'
    });
  }

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
          Swal.fire({
            title: title2,
            text: text2,
            icon: "success"
          });
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

export const useActivador = () => {
  const formVisibility = ref({});

  function toggleFormVisibility(id) {
    if (formVisibility.value[id]) {
      formVisibility.value[id] = false;
    } else {
      formVisibility.value[id] = true;
    }
  }

  return {
    formVisibility,
    toggleFormVisibility
  }
}