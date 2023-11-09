<template >
  <BaseTemplate>
    <div class="w-full p-10 grid xl:grid-cols-3 md:grid-cols-2 gap-10">
      <div v-if="classList.length > 1" v-for="(item, i) in classList" :key="i">
        <!-- <img :src="item.banner_img" alt=""> -->
        <CardClass :id="item.id" :img="item.banner_img" :section="item.section">
          {{ item.name }}
        </CardClass>
      </div>
    </div>
  </BaseTemplate>
</template>
<script>
import BaseTemplate from '../components/templates/BaseTemplate.vue';
import {getClasses} from "../methods/class/Class"
import CardClass from '../components/Home/CardClass.vue';
import { useClassStore } from '../store/class';

export default {
  data(){
    return {
      classList : ""
    }
  },
  props: ["tes"],
  components: {
    BaseTemplate,
    CardClass
  },
  created(){
    this.getClass()
  },
  methods: {
    getClass(){
      const classStore = useClassStore()
      if(classStore.class === null){
        getClasses().then(response => {
          classStore.class = response.data.data
          this.classList = classStore.getClass
        }).catch(error => {
          console.log(error.response);
        })
      } else {
        this.classList = classStore.getClass
      }
    }
  }
}
</script>
<style >
  
</style>