<template>
    <ModalCreateClass @close="setModalCreateClass" v-if="ModalCreateClass" />
    <div class="w-full h-screen overflow-hidden">
        <!-- topbar -->
        <div class="w-full h-16 bg-white border-b-[1px] border-blue-200 flex items-center justify-between px-6">
            <div class="flex items-center gap-7">
                <img @click="setSelect(1)" src="src/assets/svg/3line.svg" class="w-10 p-2 hover:bg-slate-100 rounded-full">
                <div class="flex items-center gap-3">
                    <img src="src/assets/img/classroom.png" class="w-6">
                    <span class="text-xl text-abu">Classroom</span>
                </div>
            </div>
            <div class="flex items-center gap-4">
              <div class="relative">
                <img @click="setSelect(0)" class="w-9 p-2 hover:bg-slate-100 rounded-full" src="src/assets/svg/plus.svg" alt="">
                <Transition name="slide-fade">
                  <div v-if="select[0]" class="absolute py-5 bg-white flex flex-col gap-1 -left-36 shadow-2xl border border-zinc-100">
                    <div class="px-5 py-2 hover:bg-zinc-50 cursor-pointer">Gabung kelas</div>
                    <div @click="setModalCreateClass" class="px-5 py-2 hover:bg-zinc-50 cursor-pointer">Buat kelas</div>
                  </div>
                </Transition>
              </div>
              <div class="w-9 p-2 hover:bg-slate-100 rounded-full">
                  <img class="w-9" src="src/assets/svg/dot.svg" alt="">
              </div> 
              <img class="w-9 p-2 hover:bg-slate-100 rounded-full" src="src/assets/svg/user.svg">
            </div>
        </div>
        <div class="flex h-[calc(100%-64px)]">

          <!-- leftbar -->
          <div class=" h-full flex flex-col border-r-[1px] border-blue-200" :class="{'w-[300px]' : select[1] }">
            <div class="py-4 ">
              <List img="home.svg"><span v-if="select[1]">Beranda</span></List>
            </div>
            <div v-if="menu[1] && menu[1].length > 0">
              <hr>
              <div class="py-4">
                <List @click="setTeacherList" :mode="select[1]" img="teacher.svg" class="select-none"><span v-if="select[1]">Mengajar</span>
                  <img v-if="teacherList" src="src/assets/svg/right.svg" class=" absolute select-none w-3 left-3 transform -translate-x-1/2 top-1/2 -translate-y-1/2">
                  <img v-else src="src/assets/svg/down.svg" class=" absolute select-none w-3 left-3 transform -translate-x-1/2 top-1/2 -translate-y-1/2">
                </List>
                <div v-if="teacherList" v-for="item in menu[1]">
                  <ListClass :mode="select[1]" :color="item.color_list" :section="item.section" :letter="item.name.charAt(0)">
                    <span v-if="select[1]">{{ item.name }}</span>
                  </ListClass>
                </div>
              </div>
              <hr>
            </div>
            <div v-if="menu[0] && menu[0].length > 0">
              <hr>
              <div class="py-4">
                <List img="academic.svg">Terdaftar</List>
              </div>
              <hr>
            </div>
          </div>
          <!-- rightbar -->
          <div class="w-full h-full ">
            <slot></slot>
          </div>
        </div>
    </div>
</template>
<script>
import List from '../Bar/List.vue';
import { getMenu } from '../../methods/class/Class';
import ListClass from '../Bar/leftbar/ListClass.vue';
import ModalCreateClass from '../Bar/CreateClass/ModalCreateClass.vue';

export default {
  data(){
    return{
      select: [false , true],
      teacherList: false,
      menu: "",
      ModalCreateClass: false
    }
  },
  components: {
    List,
    ModalCreateClass,
    ListClass
  },
  created() {
    this.getMenu()
  },  
  methods: {
    setModalCreateClass(){
      this.ModalCreateClass = ! this.ModalCreateClass
    },
    getMenu(){
      getMenu().then(response => {
        this.menu = response.data.menu
      }).catch(error => {
        console.log(error.response.data);
      })
    },
    setTeacherList(){
      this.teacherList = !this.teacherList
    },
    setSelect(no){
      this.select[no] = !this.select[no]
    }
  }
}
</script>
<style>
.slide-fade-enter-active {
  transition: all 0.1s ease-out;
}

.slide-fade-leave-active {
  transition: all 0.1s cubic-bezier(1, 0.5, 0.8, 1);
}

.slide-fade-enter-from,
.slide-fade-leave-to {
  transform: translateX(20px);
  opacity: 0;
}
</style>
