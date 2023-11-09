import { defineStore } from 'pinia'

export const useClassStore = defineStore('class', {
  state: () => ({ 
    class : null
  }),
  getters: {
    getClass: (state)=> state.class
  },
  actions: {
    setClass(data){
      this.class = data
    }
  },
})