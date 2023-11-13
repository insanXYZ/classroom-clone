<template >
  <ModalTemplate >
      <form @submit.prevent="store" class="w-[500px] p-5 bg-white flex flex-col gap-5">
        <textarea v-model="inputForm" class="p-5 bg-slate-50 w-full outline-none hover:bg-slate-100 border-b-[1px] border-black focus:border-b-2 transition-all" rows="5" placeholder="Perbarui pengumuman"></textarea>
        <div v-if="input.file.length != 0" v-for="(item , i) in input.file"  :key="i" class="flex justify-between items-center w-full rounded-lg border border-blue-100">
          {{ i }}
          <div class="flex gap-3">
            <img class="w-12 h-16 object-cover border-r border-blue-100" v-if="isImage(item.filename)" :src="item.url">
            <img class="w-12 h-16 p-2 border-r border-blue-100" v-else src="/src/assets/svg/doc.svg">
            <div class="flex flex-col justify-center">
              <div>{{ item.filename }}</div>
              <div class="text-abu text-sm truncate" v-if="isImage(item.filename)">
                Gambar
              </div>
              <div class="text-abu text-sm truncate" v-else>
                Dokumen
              </div>
            </div>
          </div>
          <img @click="deleteFile(item.id ,i)" src="/src/assets/svg/trash.svg" class="w-9 hover:bg-slate-100 p-2 mr-5 rounded-full">
        </div>

        
        <div v-if="file.length != 0" v-for="(item , i) in file"  :key="i" class="flex justify-between items-center w-full rounded-lg border border-blue-100">
          <div class="flex gap-3">
            <img class="w-12 h-16 object-cover border-r border-blue-100" v-if="isImage(item.name)" :src="getImageUrl(item)">
            <img class="w-12 h-16 p-2 border-r border-blue-100" v-else src="/src/assets/svg/doc.svg">
            <div class="flex flex-col justify-center">
              <div>{{ item.name }}</div>
              <div class="text-abu text-sm truncate" v-if="isImage(item.name)">
                Gambar
              </div>
              <div class="text-abu text-sm truncate" v-else>
                Dokumen
              </div>
            </div>
          </div>
          <img @click="deleteFileLocal(i)" src="/src/assets/svg/trash.svg" class="w-9 hover:bg-slate-100 p-2 mr-5 rounded-full">
        </div>


        <div class="flex justify-between items-center">
          <div class="flex items-center">
            <label for="file">
              <img src="/src/assets/svg/upload.svg" class="w-8 hover:bg-slate-100 p-1">
            </label>
            <input @change="fileInput" ref="file" type="file" class="hidden" id="file" multiple>
          </div>
          <div class="flex items-center gap-7">
            <div @click="$emit('setUpdate')" class="py-1 px-3  hover:bg-slate-100 text-abu font-semibold cursor-pointer rounded-md">Batal</div>
            <button type="submit" class=" py-1 px-3 font-semibold outline-none rounded-md transition-all"
            :class="{'bg-stone-300 , text-stone-400 , cursor-default' : inputForm.length < 1 , 'bg-black , text-white' : inputForm.length > 0}"
            >Perbarui</button>
          </div>
        </div>
      </form>
  </ModalTemplate>
</template>
<script>
import ModalTemplate from "./ModalTemplate.vue"
import isImage from "../../helpers/isImage";
import getImageUrl from "../../helpers/getImage";
import {deleteFile , updateAnnouncement} from "../../methods/class/Class"
export default {
  data(){
    return {
      inputForm: this.input.desc,
      file: []
    }
  },
  components: {
    ModalTemplate,
  },
  props: ["input"],
  emits: ["setUpdate","refresh"],
  methods: {
    isImage,
    store(){
      let data = {
        desc : this.inputForm
      }
      updateAnnouncement(data , this.input.id)
      .then(response => {
        this.$emit("refresh")
        this.$emit("setUpdate")
      }).catch(error => {
        console.log(error.response);
      })
    },
    deleteFile(id , i){
      this.input.file.splice(i,1);
      console.log(this.input.file);

      deleteFile(id).then(response => {
        console.log(response.data);
      }).catch(error => {
        console.log(error.response.data);
      })
    },
    fileInput(){
      let file = this.$refs.file.files
      this.file = file
      console.log(this.file);
    },
    getImageUrl,
    deleteFileLocal(i){
      this.file.splice(i ,1)
    }
  }
}
</script>
