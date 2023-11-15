<template>
  <ModalJoinClass @refresh="$emit('refresh') , getNewMenu" v-if="ModalJoinClass" @close="setJoinClass"></ModalJoinClass>
<ModalCreateClass @refresh="$emit('refresh')" @close="setModalCreateClass" v-if="ModalCreateClass" />
    <div class="w-full h-screen overflow-hidden">
        <!-- topbar -->
        <div class="w-full h-16 bg-white border-b-[1px] border-blue-200 flex items-center justify-between px-6">
            <div class="flex items-center gap-7">
                <img @click="setSelect(1)" src="/src/assets/svg/3line.svg" class="w-10 p-2 hover:bg-slate-100 rounded-full">
                <div class="flex items-center gap-3">
                    <img src="/src/assets/img/classroom.png" class="w-6">
                    <span class="text-xl text-abu">Classroom</span>
                </div>
            </div>
            <div class="flex items-center gap-4">
              <div class="relative">
                <img @click="setSelect(0)" class="w-10 p-3 hover:bg-slate-100 rounded-full" src="/src/assets/svg/plus.svg" alt="">
                <Transition name="slide-fade">
                  <div v-if="select[0]" class="absolute py-3 z-10 bg-white flex flex-col gap-1 -left-36 shadow-2xl border border-zinc-100">
                    <div @click="setJoinClass" class="px-5 py-2 hover:bg-zinc-50 cursor-pointer">Gabung kelas</div>
                    <div @click="setModalCreateClass" class="px-5 py-2 hover:bg-zinc-50 cursor-pointer">Buat kelas</div>
                  </div>
                </Transition>
              </div>
              <div class="w-10 p-3 hover:bg-slate-100 rounded-full cursor-pointer">
                  <img class="w-9" src="/src/assets/svg/dot.svg" alt="">
              </div> 
              <div class="relative">
                <img @click="setUser" class="w-10 p-1 hover:bg-slate-100 rounded-full cursor-pointer" :src="user.image">
                <Transition name="slide-fade">
                  <div v-if="modalUser" class="absolute flex flex-col gap-4 z-10 -left-52 p-5 w-56 bg-white border border-blue-100 shadow-xl rounded-lg">
                    <div class="flex items-center gap-3">
                      <img class="w-10 rounded-full" :src="user.image" >
                      <div class="w-full truncate text text-lg font-semibold">{{ user.name }}</div>
                    </div>
                    <hr>
                    <div @click="logout" class="flex items-center gap-1 bg-red-500 rounded-lg cursor-pointer py-[2px]">
                      <img src="/src/assets/svg/exit.svg" class="w-9" alt="">
                      <span class="text-white font-semibold">Keluar</span>
                    </div>
                  </div>
                </Transition>
              </div>
            </div>
        </div>
        <div class="flex h-[calc(100%-64px)]">

          <!-- leftbar -->
          <div class=" h-full flex flex-col border-r-[1px] border-blue-200" :class="{'w-[300px]' : select[1] }">
            <router-link to="/" class="py-4 ">
              <List img="home.svg" :mode="select[1]"><span v-if="select[1]">Beranda</span></List>
            </router-link>
            <div v-if="menu[1] && menu[1].length > 0">
              <hr>
              <div class="py-4">
                <List @click="setTeacherList" :mode="select[1]" img="teacher.svg" class="select-none"><span v-if="select[1]">Mengajar</span>
                  <img v-if="teacherList" src="/src/assets/svg/down.svg" class=" absolute select-none w-3 left-3 transform -translate-x-1/2 top-1/2 -translate-y-1/2">
                  <img v-else src="/src/assets/svg/right.svg" class=" absolute select-none w-3 left-3 transform -translate-x-1/2 top-1/2 -translate-y-1/2">
                </List>
                <div v-if="teacherList" v-for="item in menu[1]">
                  <router-link :to="'/c/'+item.id">
                    <ListClass :mode="select[1]" :color="item.color_list" :section="item.section" :letter="item.name.charAt(0)">
                      <span v-if="select[1]">{{ item.name }}</span>
                    </ListClass>
                  </router-link>
                </div>
              </div>
              <hr>
            </div>

            <div v-if="menu[0] && menu[0].length > 0">
              <hr>
              <div class="py-4">
                <List @click="setStudentList" :mode="select[1]" img="academic.svg" class="select-none"><span v-if="select[1]">Terdaftar</span>
                  <img v-if="studentList" src="/src/assets/svg/down.svg" class=" absolute select-none w-3 left-3 transform -translate-x-1/2 top-1/2 -translate-y-1/2">
                  <img v-else src="/src/assets/svg/right.svg" class=" absolute select-none w-3 left-3 transform -translate-x-1/2 top-1/2 -translate-y-1/2">
                </List>
                <div v-if="studentList" v-for="item in menu[0]">
                  <router-link :to="'/c/'+item.id">
                    <ListClass :mode="select[1]" :color="item.color_list" :section="item.section" :letter="item.name.charAt(0)">
                      <span v-if="select[1]">{{ item.name }}</span>
                    </ListClass>
                  </router-link>
                </div>
              </div>
              <hr>
            </div>
          </div>


          <!-- rightbar -->
          <div class="w-full h-full overflow-y-auto relative">
            <slot></slot>
          </div>
        </div>
    </div>
</template>
<script>
import List from '../Bar/List.vue';
import {useMenuStore} from "../../store/menu.js";
import { getMenu , me , logout} from '../../methods/class/Class';
import ListClass from '../Bar/leftbar/ListClass.vue';
import ModalCreateClass from '../Bar/CreateClass/ModalCreateClass.vue';
import ModalJoinClass from '../Bar/JoinClass/ModalJoinClass.vue';
import Cookies from "js-cookie"

export default {
  data(){
    return{
      select: [false , true ],
      teacherList: false,
      studentList: false , 
      menu: "",
      ModalCreateClass: false,
      user : "",
      ModalJoinClass : false,
      modalUser: false
    }
  },
  components: {
    List,
    ModalCreateClass,
    ListClass,
    ModalJoinClass
  },
  emits:["refresh","me"],
  created() {
    this.getMenu()
  },  
  methods: {
    setModalCreateClass(){
      this.ModalCreateClass = ! this.ModalCreateClass 
    },
    getNewMenu(){
      const menuStore = useMenuStore();
        getMenu().then(response => {
          menuStore.setMenu(response.data.menu);
          this.menu = menuStore.getMenu
      })
    },
    getMenu(){
      const menuStore = useMenuStore();
      if(menuStore.menu === null) {
        me().then(response => {
          menuStore.setUser(response.data.me)
          this.user = menuStore.getUser
          this.$emit("me", menuStore.getUser)
        })
        getMenu().then(response => {
          menuStore.setMenu(response.data.menu);
          this.menu = menuStore.getMenu
        }).catch(error => {
          console.log(error.response.data);
        })
      } else {
        this.menu = menuStore.getMenu        
        this.user = menuStore.getUser 
        this.$emit("me", menuStore.getUser)
      }
    },
    setTeacherList(){
      this.teacherList = !this.teacherList
    },
    setStudentList(){
      this.studentList = !this.studentList
    },
    setSelect(no){
      this.select[no] = !this.select[no]
    },
    setJoinClass(){
      this.ModalJoinClass = ! this.ModalJoinClass
    },
    setUser(){
      this.modalUser = !this.modalUser
    },
    logout(){
      logout().then(response => {
        Cookies.remove("token")
        this.$router.push("/login")
      }).catch(error => {
        console.log(error);
      })
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
