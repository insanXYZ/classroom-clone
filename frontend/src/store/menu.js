import { defineStore } from 'pinia'

export const useMenuStore = defineStore('menu', {
  state: () => ({ 
    menu : null,
    user : null
  }),
  getters: {
    getMenu: (state)=> state.menu,
    getUser: (state)=> state.user,
  },
  actions: {
    setMenu(data){
      this.menu = data
    },
    setUser(data){
      this.user = data
    }
  },
})