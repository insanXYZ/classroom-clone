<template>
  <div class="flex items-center hover:bg-slate-100 py-2 rounded-r-full cursor-pointer relative" :class="{'w-[calc(100%-20px)] , gap-5 , pl-6':mode , 'px-8':mode ==false}">
    <img class="w-6" :src="'/src/assets/svg/'+ img"  >
    <span class="font-medium text-abu truncate select-none"><slot></slot></span>
  </div>    
</template>
<script>
export default {
  props: ["img","mode"]
}
</script>