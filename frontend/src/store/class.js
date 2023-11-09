import { defineStore } from 'pinia'

export const useClassStore = defineStore('class', {
  state: () => ({ 
    class : null
  }),
  getters: {
    getMenu: (state)=> state.class
  },
  actions: {
    setMenu(data){
      this.class = data
    }
  },
})