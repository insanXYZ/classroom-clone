<template>
  <Modal>
    <form @submit.prevent="store" class="bg-white  w-[550px] p-4 rounded-lg flex flex-col gap-6">
      <div class="text-lg font-semibold">
        Buat kelas
      </div>
      <Input placeholder="Nama kelas(Wajib)"></Input>
      <Input placeholder="Bagian"></Input>
      <Input placeholder="Mata pelajaran"></Input>
      <Input placeholder="Ruang"></Input>
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

export default {
  components : {
    Modal,
    Input
  },
  emits: ["close"],
  methods: {
    close(){
      this.$emit("close")
    },
    store(){
      
    }
  }
}
</script>
