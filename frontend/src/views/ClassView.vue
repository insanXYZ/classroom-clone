<template >
  <BaseTemplate>
      <div class="w-full h-12 border-b-[1px] border-blue-200 flex items-center gap-8 px-8 sticky top-0 bg-white">
        <Nav>Forum</Nav>
        <Nav>Tugas kelas</Nav>
        <Nav>Orang</Nav>
      </div>
      <div v-if="classes !== null" class="w-4/5 mx-auto flex flex-col my-7 gap-7">
        <div class="w-full h-56 rounded-xl bg-cover bg-bottom flex flex-col justify-end gap-1 p-8" :style="{ backgroundImage: `url('${classes.banner_img}')` }">
          <div class="text-white text-3xl font-semibold">{{ classes.name }}</div>
          <div class="text-white text-xl">{{ classes.section }}</div>
        </div>
        <div class="flex gap-5 w-full">
          <div class="bg-white w-[180px] h-[86px] border border-blue-200 flex flex-col gap-2 p-3 shadow-lg rounded-lg">
            <div class="font-semibold text-abu">Kode kelas</div>
            <div class="text-xl font-semibold">{{ classes.code }}</div>
          </div>
          <div class="w-full h-52 bg-blue-200">

          </div>
        </div>
      </div>
  </BaseTemplate>
</template>
<script>
import BaseTemplate from '../components/templates/BaseTemplate.vue';
import {getClass} from "../methods/class/Class"
import Nav from "../components/Class/Nav.vue"

export default {
  data(){
    return{
      classes: null
    }
  },
  components:{
    BaseTemplate,
    Nav
  },
  created(){
    this.getClass()
  },
  methods:{
    getClass(){
      getClass(this.$route.params.id)
      .then(response => {
        this.classes = response.data.data
        console.log(response.data.data);
      }).catch(error => {
        console.log(error.response.data);
      })
    }  
  }
}
</script>