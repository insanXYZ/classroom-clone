<template>
  <div class="w-full h-[280px] flex flex-col rounded-lg bg-white border border-zinc-200 shadow-sm">
    <div :style="{ backgroundImage: `url('${img}')` }" class="w-full h-1/3 bg-cover bg-bottom rounded-t-lg flex flex-col gap-[2px] p-4 text-white">
      <span class="text-xl font-semibold"><slot></slot></span>
      <span>{{ section }}</span>
    </div>

  </div>
</template>
<script>
export default {
  props: ["img", "section"]
}
</script>