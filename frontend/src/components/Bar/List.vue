<template>
  <div class="flex items-center w-[calc(100%-20px)] hover:bg-slate-100 pl-6 py-2 rounded-r-full cursor-pointer gap-5 relative">
    <img class="w-6" :src="'src/assets/svg/'+ img" >
    <span class="font-medium text-abu truncate"><slot></slot></span>
  </div>    
</template>
<script>
export default {
  props: ["img"]
}
</script>