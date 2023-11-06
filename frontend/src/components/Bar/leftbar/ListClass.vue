<template>
  <div class="flex items-center w-[calc(100%-20px)] hover:bg-slate-100 pl-6 py-2 rounded-r-full cursor-pointer gap-5 relative">
    <div class="w-5 h-5 rounded-full text-center bg-blue-200">
      P
    </div>
    <div class="flex flex-col justify-center gap-2">
      <span class="text-sm font-medium text-abu truncate"><slot></slot></span>
      <span class="text-sm font-medium text-abu truncate">{{ section }}</span>

    </div>
  </div>    
</template>
<script>
export default {
  props: [ "section"]
}
</script>