<template>
  <ModalTemplate>
    <form @submit.prevent="store" class="bg-white w-[550px] p-4 rounded-lg flex flex-col gap-4">
      <div class="text-lg font-semibold">
        Masukkan kode kelas
      </div>
      <input type="text" v-model="input" class="px-1 py-2 border-2">
      <div class="w-full flex gap-7 items-center justify-end">
        <div @click="this.$emit('close')" class="font-semibold p-2 hover:bg-slate-50 cursor-pointer text-abu">Batal</div>
        <button class="font-semibold p-2 hover:bg-slate-50 cursor-pointer text-blue-400">Gabung</button>
      </div>
    </form> 
  </ModalTemplate>
</template>
<script>
import ModalTemplate from "../templates/Modal.vue"
import {useMenuStore} from "../../../store/menu"
import {joinClass} from "../../../methods/class/Class"

export default {
  data(){
    return{
      input : "",
    }
  },
  emits: ["close"],
  components: {
    ModalTemplate,
  },
  methods: {
    store(){
      let store = useMenuStore()

      let data = {
        "code": this.input,
        "id": store.user.id
      }

      joinClass(data).then(response => {
        console.log(response.data);
      }).catch(error => {
        console.log(error.response);
      })
    }
  }
}
</script>