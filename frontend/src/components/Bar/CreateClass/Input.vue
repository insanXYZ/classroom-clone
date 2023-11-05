<template >
  <input v-model="input" type="text" :placeholder="placeholder" class="p-2 border-b-[1px] border-b-black bg-slate-100 outline-none focus:border-b-blue-600">
</template>
<script>
export default {
  data(){
    return {
      input: ""
    }
  },
  emits: ["input"],
  props: ["placeholder"],
  watch: {
    input(){
      this.$emit("input", this.input)
    }
  },
}
</script>