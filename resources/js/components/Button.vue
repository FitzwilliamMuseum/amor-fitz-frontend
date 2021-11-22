<template>
  <div class="dib" @click="onClick">
    <div
      :class="[
        square ? 'button--square' : '',
        'serif flex justify-center items-center bg-green creme f4 fw7 pa2 button dim'
      ]"
    >
      <slot />
    </div>
  </div>
</template>

<script>
export default {
  name: "Button",
  props: {
    square: { type: Boolean, default: false },
    onClick: { type: Function, default: () => {} }
  }
};
</script>

<style scoped>
.button {
  height: 36px;
  cursor: pointer;
}

.button--square {
  width: 36px;
}
</style>
