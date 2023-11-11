import { defineStore } from 'pinia'

export const useClassDetailStore = defineStore('classDetail', {
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