<template>
    <ModalCreateClass @close="setModalCreateClass" v-if="ModalCreateClass" />
    <div class="w-full h-screen overflow-hidden">
        <!-- topbar -->
        <div class="w-full h-16 bg-white border-b-[1px] border-blue-200 flex items-center justify-between px-6">
            <div class="flex items-center gap-7">
                <img src="src/assets/svg/3line.svg" class="w-10 p-2 hover:bg-slate-100 rounded-full">
                <div class="flex items-center gap-3">
                    <img src="src/assets/img/classroom.png" class="w-6">
                    <span class="text-xl text-abu">Classroom</span>
                </div>
            </div>
            <div class="flex items-center gap-4">
                <img @click="setModalCreateClass" class="w-9 p-2 hover:bg-slate-100 rounded-full" src="src/assets/svg/plus.svg" alt="">
                <div class="w-9 p-2 hover:bg-slate-100 rounded-full">
                    <img class="w-9" src="src/assets/svg/dot.svg" alt="">
                </div> 
                <img class="w-9 p-2 hover:bg-slate-100 rounded-full" src="src/assets/svg/user.svg">
            </div>
        </div>
        <div class="flex h-[calc(100%-64px)]">
          <!-- leftbar -->
          <div class="w-[300px] h-full flex flex-col border-r-[1px] border-blue-200">
            <div class="py-4">
              <List img="home.svg">Beranda</List>
            </div>
            <hr>
            <div class="py-4">
              <List img="academic.svg">Terdaftar</List>
            </div>
            <hr>
          </div>
        </div>
       
    </div>
</template>
<script>
import List from '../Bar/List.vue';
import ModalCreateClass from '../Bar/CreateClass/ModalCreateClass.vue';

export default {
  data(){
    return{
      ModalCreateClass: false
    }
  },
  components: {
    List,
    ModalCreateClass
  },
  methods: {
    setModalCreateClass(){
      this.ModalCreateClass = ! this.ModalCreateClass
    }
  }
}
</script>
<style>

</style>
