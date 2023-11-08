<template>
  <div class="flex items-center hover:bg-slate-100 pl-6 py-2 select-none rounded-r-full cursor-pointer gap-5 relative" :class="{'w-[calc(100%-20px)]': mode} ">
    <div class="w-6 h-6 rounded-full flex justify-center items-center text-white" :style="{ backgroundColor: color }" >
      {{ letter }}
    </div>
    <div class="flex flex-col justify-center gap-2">
      <span class="text-sm font-medium text-abu truncate"><slot></slot></span>
      <span class="text-sm font-medium text-abu truncate" v-if="mode">{{ section }}</span>
    </div>
  </div>    
</template>
<script>
export default {
  props: [ "section" , "letter" , "color" ,"mode"],
  data(){
    return {
    }
  }
}
</script>