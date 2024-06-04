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
      const response = await fetch(url, {
        method: method,
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(postData.value)

      });

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

  return {
    clearString,
    showAlert
  }
}