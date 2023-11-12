<template>
  <div class="w-screen h-screen flex justify-center items-center bg-white relative">
    
    <div class="border border-blue-100 rounded-md shadow-sm p-10 flex flex-col gap-6 items-center w-[400px] relative">
      <div v-if="loading == true" class="absolute w-full h-full top-0 left-0 flex z-20 justify-center items-center bg-opacity-10 backdrop-blur-sm">
        <img src="/src/assets/svg/loading.svg" alt="" class="w-32">
      </div>
      <img src="src/assets/img/classroom.png" class="w-24">
      <form @submit.prevent="store" class="flex flex-col z-10 gap-3 w-full relative">
        <slot></slot>
      </form>
    </div>
  </div>
</template>
<script>
export default {
  emits: ["form"],
  props: ["loading"],
  methods: {
    store(){
      this.$emit("form")
    }
  }
}
</script>
