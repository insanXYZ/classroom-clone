<template>
  <router-link :to="'/c/'+ id" class="w-full h-[280px] flex flex-col rounded-lg bg-white border border-zinc-200 shadow-sm cursor-pointer">
    <div :style="{ backgroundImage: `url('${img}')` }" class="w-full h-1/3 bg-cover bg-bottom rounded-t-lg flex flex-col gap-[2px] p-4 text-white">
      <span class="text-2xl font-semibold"><slot></slot></span>
      <span>{{ section }}</span>
    </div>

  </router-link>
</template>
<script>
export default {
  props: ["img", "section" , "id"]
}
</script>