<template>
  <div class="flex flex-col gap-2 w-full">
    <label :for="inputFor" class="font-semibold"><slot></slot></label>
    <input v-model="input" :type="type" :id="inputFor" class="border rounded-sm p-1" :min="min" required>
  </div>
</template>
<script>
export default {
  data() {
    return {
      input: ""
    }
  },
  props: ["inputFor", "type" , "min"],
  emits: ["input"],
  watch: {
    input() {
      this.$emit("input", this.input)
    }
  }
}
</script>
