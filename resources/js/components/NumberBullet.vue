<template>
  <div class="dib">
    <div
      class="bg-berry br-100 flex white justify-center items-center sans-serif number-bullet"
    >
      <span>{{ number || "" }}</span>
    </div>
  </div>
</template>

<script>
export default {
  name: "NumberBullet",
  props: { number: { type: Number } }
};
</script>

<style scoped>
.number-bullet {
  width: 36px;
  height: 36px;
}
</style>
