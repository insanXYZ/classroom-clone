<template >
  <ModalTemplate >
      <div class="w-[500px] p-5 bg-white flex flex-col gap-5">
        <textarea class="p-5 bg-slate-50 w-full outline-none hover:bg-slate-100 border-b-[1px] border-black focus:border-b-2 transition-all" rows="5" placeholder="Perbarui pengumuman"></textarea>
        <div class="flex justify-between items-center">
          <div class="flex items-center gap-7">
            <div @click="setPost" class="py-1 px-3  hover:bg-slate-100 text-abu font-semibold cursor-pointer rounded-md">Batal</div>
            <button type="submit" class=" py-1 px-3 font-semibold outline-none rounded-md transition-all" :class="{'bg-stone-300 , text-stone-400 , cursor-default' : inputPost.length < 1 ,'bg-black , text-white , cursor-pointer': inputPost.length > 0 }">Posting</button>
          </div>
        </div>
      </div>
  </ModalTemplate>
</template>
<script>
import ModalTemplate from "./ModalTemplate.vue"
export default {
  components: {
    ModalTemplate
  }
}
</script>
