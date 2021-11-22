<template>
  <div class="dib">
    <span class="green dib mr3 underline pointer" @click="onClickFirst"
      >first</span
    >
    <Button square class="dib mr3" :onClick="onClickBackward"
      ><span class="flip-h">➺</span></Button
    >
    <span class="dib mr2">page</span>
    <NumberBullet :number="currentIndex" class="dib mr2" />
    <span class="dib mr3">of {{ totalPages }}</span>
    <Button square class="dib mr3" :onClick="onClickForward">➻</Button>
    <span class="green dib underline pointer" @click="onClickLast">last</span>
  </div>
</template>

<script>
import NumberBullet from "./NumberBullet";
import Button from "./Button";
export default {
  name: "Pagination",
  props: {
    currentIndex: { type: Number },
    totalPages: { type: Number },
    onClickForward: { type: Function },
    onClickBackward: { type: Function },
    onClickFirst: { type: Function },
    onClickLast: { type: Function }
  },
  components: { NumberBullet, Button }
};
</script>

<style>
.flip-h {
  transform: scale(-1, 1);
}
</style>
