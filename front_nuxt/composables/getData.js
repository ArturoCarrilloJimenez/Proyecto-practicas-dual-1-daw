import { ref } from "vue"

export const useApi = () => {
    const data = ref(null);
    const loading = ref(false);

    // Funcion para optener datos
    const getData = async (url) => {
      loading.value = true;
      try {
        const response = await fetch(url);
        data.value = await response.json();
        console.log(data);
      } catch (e) {
        console.error(e);
      } finally {
        loading.value = false;
      }
    }

    // Función para enviar datos a la API
    const sendData = async (url, postData) => {
      loading.value = true;
      try {
        const response = await fetch(url, {
          method: 'POST',
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