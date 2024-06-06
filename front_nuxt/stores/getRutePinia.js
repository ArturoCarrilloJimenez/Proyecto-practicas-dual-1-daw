import { defineStore } from 'pinia'
import { useRouter } from 'vue-router'
import { ref } from 'vue'

export const getRutePinia = defineStore('getRutePinia', {
  state: () => ({
    url: ref('')
  }),
  actions: {
    updateUrl() {
      const router = useRouter()
      this.url = router.currentRoute.value.path
    }
  }
})