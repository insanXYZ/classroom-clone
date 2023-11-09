import { defineStore } from 'pinia'

export const useMenuStore = defineStore('menu', {
  state: () => ({ 
    menu : null
  }),
  getters: {
    getMenu: (state)=> state.menu
  },
  actions: {
    setMenu(data){
      this.menu = data
    }
  },
})