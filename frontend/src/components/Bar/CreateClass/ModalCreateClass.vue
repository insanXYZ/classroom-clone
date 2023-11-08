<template>
  <Modal>
    <form @submit.prevent="store" class="bg-white  w-[550px] p-4 rounded-lg flex flex-col gap-6">
      <div class="text-lg font-semibold">
        Buat kelas
      </div>
      <Input @input="item => name = item" placeholder="Nama kelas(Wajib)"></Input>
      <Input @input="item => section = item" placeholder="Bagian"></Input>
      <Input @input="item => subject = item" placeholder="Mata pelajaran"></Input>
      <Input @input="item => room = item" placeholder="Ruang"></Input>
      <div class="w-full flex gap-7 items-center justify-end">
        <div @click="close" class="font-semibold p-2 hover:bg-slate-50 cursor-pointer text-abu">Batal</div>
        <button class="font-semibold p-2 hover:bg-slate-50 cursor-pointer text-blue-400">Buat</button>
      </div>
    </form>
  </Modal>
</template>
<script>
import Modal from '../templates/Modal.vue';
import Input from './input.vue';
import {createClass} from "../../../methods/class/Class"


export default {
  components : {
    Modal,
    Input
  },
  data(){
    return {
      name : "",
      section : "",
      subject : "",
      room : ""
    }
  },
  emits: ["close"],
  methods: {
    close(){
      this.$emit("close")
    },
    store(){
      let data = {
        name : this.name,
        section : this.section,
        subject : this.subject,
        room : this.room
      }
      createClass(data)
      .then(response => {
        this.close()
      }).catch(error => {
        this.close()
      })

    }
  }
}
</script>
