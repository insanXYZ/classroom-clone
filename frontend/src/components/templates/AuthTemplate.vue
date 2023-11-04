<template>
  <div class="w-screen h-screen flex justify-center items-center bg-white">
    <div class="border border-blue-100 rounded-md shadow-sm p-10 flex flex-col gap-6 items-center w-[400px]">
      <img src="src/assets/img/classroom.png" class="w-24">
      <form @submit.prevent="store" class="flex flex-col gap-3 w-full">
        <slot></slot>
      </form>
    </div>
  </div>
</template>
<script>
export default {
  emits: ["form"],
  methods: {
    store(){
      this.$emit("form")
    }
  }
}
</script>
