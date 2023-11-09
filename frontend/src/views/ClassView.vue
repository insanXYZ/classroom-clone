<template >
  <BaseTemplate>
      <div class="w-full h-12 border-b-[1px] border-blue-200 flex items-center gap-8 px-8 sticky top-0 bg-white">
        <Nav>Forum</Nav>
        <Nav>Tugas kelas</Nav>
        <Nav>Orang</Nav>
      </div>
      <div>
        
      </div>
  </BaseTemplate>
</template>
<script>
import BaseTemplate from '../components/templates/BaseTemplate.vue';
import {getClass} from "../methods/class/Class"
import Nav from "../components/Class/Nav.vue"

export default {
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
        console.log(response.data);
      }).catch(error => {
        console.log(error.response.data);
      })
    }  
  }
}
</script>