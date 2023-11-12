<template >
  <ModalTemplate >
      <form @submit.prevent="store" class="w-[500px] p-5 bg-white flex flex-col gap-5">
        <textarea class="p-5 bg-slate-50 w-full outline-none hover:bg-slate-100 border-b-[1px] border-black focus:border-b-2 transition-all" rows="5" placeholder="Perbarui pengumuman">{{ input.desc }}</textarea>
        <div class="flex justify-end items-center">
          <div class="flex items-center gap-7">
            <div @click="$emit('setUpdate')" class="py-1 px-3  hover:bg-slate-100 text-abu font-semibold cursor-pointer rounded-md">Batal</div>
            <button type="submit" class=" py-1 px-3 font-semibold outline-none rounded-md transition-all" >Posting</button>
          </div>
        </div>
      </form>
  </ModalTemplate>
</template>
<script>
import ModalTemplate from "./ModalTemplate.vue"
export default {
  components: {
    ModalTemplate
  },
  props: ["input"],
  emits: ["setUpdate"],
  methods: {
    store(){
      
    }
  }
}
</script>
