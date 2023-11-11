<template >
  <BaseTemplate @me="item => userImage = item.image">
      <div class="w-full h-12 border-b-[1px] border-blue-200 flex items-center gap-5 px-8 sticky top-0 bg-white">
        <Nav>Forum</Nav>
        <Nav>Orang</Nav>
      </div>
      <div v-if="classes !== null" class="w-10/12 mx-auto flex flex-col my-7 gap-7">
        <div class="w-full h-56 rounded-xl bg-cover bg-bottom flex flex-col justify-end gap-1 p-8" :style="{ backgroundImage: `url('${classes.banner_img}')` }">
          <div class="text-white text-3xl font-semibold">{{ classes.name }}</div>
          <div class="text-white text-xl">{{ classes.section }}</div>
        </div>
        <div class="flex gap-5 w-full">
          <div class="bg-white w-[180px] h-[86px] border border-blue-100 flex flex-col gap-2 p-3 shadow-md rounded-lg">
            <div class="font-semibold text-abu">Kode kelas</div>
            <div class="text-xl font-semibold">{{ classes.code }}</div>
          </div>
          <div class="w-full flex flex-col gap-5">
            <div v-if="post" @click="setPost" class="p-5 flex justify-between border border-blue-100 items-center shadow-md rounded-lg cursor-pointer hover:bg-slate-50 group">
              <div class="flex items-center gap-5">
                <img :src="userImage" class="w-9 rounded-full">
                <span class=" text-sm text-slate-400 group-hover:text-slate-700">Umumkan sesuatu ke kelas anda</span>
              </div>
            </div>
            <form v-else @submit.prevent="store" class="p-5 flex flex-col border gap-5 border-blue-100 shadow-md rounded-lg " enctype="multipart/form-data">
              <textarea autofocus class="p-5 bg-slate-50 w-full outline-none hover:bg-slate-100 border-b-[1px] border-black focus:border-b-2 transition-all" rows="5" v-model="inputPost" placeholder="Umumkan sesuatu ke kelas anda"></textarea>
              <div v-if="file.length > 0" class="flex flex-col gap-5">
                <div v-for="(item, i) in file" class="w-full flex items-center gap-5 border border-blue-200">
                  <div class="w-28 h-16 overflow-hidden border-r border-blue-200">
                    <img v-if="isImage(item.name) == true" :src="getImageUrl(file[i])" class="w-full h-full object-cover">
                    <img v-else src="/src/assets/svg/doc.svg" class="w-full h-full object-fill p-2">
                  </div>
                  <div class="w-full flex flex-col ">
                    <div class="font-semibold">{{ item.name }}</div>
                    <div v-if="isImage(item.name) == true" class="text-abu text-sm">Gambar</div>
                    <div v-else class="text-abu text-sm">document</div>
                  </div>
                </div>
              </div>
              <div class="flex justify-between items-center">
                <label for="file">
                  <img src="/src/assets/svg/upload.svg" class="w-8 hover:bg-slate-100 p-1">
                </label>
                <input @change="fileInput" ref="file" type="file" class="hidden" id="file" multiple>
                <div class="flex items-center gap-7">
                  <div @click="setPost" class="py-1 px-3  hover:bg-slate-100 text-abu font-semibold cursor-pointer rounded-md">Batal</div>
                  <button type="submit" class=" py-1 px-3 font-semibold outline-none rounded-md transition-all" :class="{'bg-stone-300 , text-stone-400 , cursor-default' : inputPost.length < 1 ,'bg-black , text-white , cursor-pointer': inputPost.length > 0 }">Posting</button>
                </div>
              </div>
            </form>

            <div v-if="classes.announcement.length > 0" v-for="(item , i) in classes.announcement" class="flex flex-col p-5 gap-3 w-full shadow-md rounded-lg border-blue-100">
              <div class="flex gap-3 items-center">
                <img :src="item.created_by.image" alt="" class="w-9 rounded-full">
                <div class="flex flex-col justify-center">
                  <span class="text-sm font-semibold">{{ item.created_by.name }}</span>
                  <span class="text-sm text-abu">{{ item.created_at }}</span>
                </div>
              </div>
              <span style="white-space: pre;" class="w-full">{{ item.desc }}</span>
            </div>
          </div>
        </div>
      </div>
  </BaseTemplate>
</template>
<script>
import BaseTemplate from '../components/templates/BaseTemplate.vue';
import {getClass} from "../methods/class/Class"
import Nav from "../components/Class/Nav.vue"
import {inputAnnouncement} from "../methods/class/Class"

export default {
  data(){
    return{
      classes: null,
      userImage : null,
      post: true,
      inputPost : "",
      file: [],
    }
  },
  components:{
    BaseTemplate,
    Nav,
  },
  created(){
    this.getClass()
  },
  methods:{
    getClass(){
      getClass(this.$route.params.id)
      .then(response => {
        console.log(response.data.classes);
        this.classes = response.data.classes
      }).catch(error => {
        this.$router.push("/")
      })
    },
    setPost(){
      this.post = ! this.post
    },
    store(){
      if(this.inputPost != ""){
        let hasFile = false
        let formData = new FormData()
        let file = this.$refs.file
        if(file.files.length > 0){  
          hasFile = true
          for(let i = 0; i < file.files.length ; i++){
            formData.append("file[]",file.files[i])
          }
        }
        formData.append("input", this.inputPost)
        formData.append("id", this.$route.params.id)

        inputAnnouncement(formData)
        .then(response => {
          console.log(response.data);
        }).catch(error => {
          console.log(error.response);
        })
      }
    },
    fileInput(){
      let file = this.$refs.file.files
      this.file = file
    },
    getImageUrl(file){
      return URL.createObjectURL(file)
    },
    isImage(filename){
      let validImage = ['png', 'jpg', 'jpeg', 'gif', 'bmp']

      let nameSplit = filename.split(".")

      return validImage.includes(nameSplit[nameSplit.length - 1])
      
    },

  }
}
</script>