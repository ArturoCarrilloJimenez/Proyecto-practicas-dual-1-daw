import { defineStore } from 'pinia';
import { ref } from 'vue'

export const useGetData = defineStore('getData', () => {
  const data = ref(null);
  const loading = ref(false);

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

  return { data, loading, getData };
});
