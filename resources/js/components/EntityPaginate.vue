<template>
  <div class=" sans-serif pv5 letter-viewer">
    <div class="w-100 mb4">
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
      </div>
    </div>
</template>

<script>
import Vue from "vue";
import { VTooltip } from "v-tooltip";
import VueMq from "vue-mq";
import { VueAgile } from "vue-agile";

import "../../css/tooltips.css";

Vue.use(VueMq, {
  breakpoints: {
    s: 480,
    m: 960,
    l: Infinity
  },
  defaultBreakpoint: "s"
});

Vue.directive("tooltip", VTooltip);
VTooltip.options.defaultClass = "fitz-tooltip";

export default {
  name: "EntityPaginate",
  props: {
    totalPages: { type: Number },
    currentPage: { type: Number },
    currentIndex: { type: Number },
  },
  components: {
    agile: VueAgile
  },
  data: function() {
    return {
      agileOptions: {
        dots: false,
        fade: true,
        navButtons: false,
        infinite: false
      }
    };
  },
  computed: {
    indexForNonNerds: function() {
      return this.currentIndex + 1;
    }
  },
  methods: {
    getBackgroundProp(srcPath) {
      return "url('" + srcPath + "')";
    },
    handleClickBackward() {
      if (this.currentIndex === 0) {
        return;
      }
      this.currentIndex = this.currentIndex - 1;
      if (this.$refs.carousel) {
        this.$refs.carousel.goToPrev();
      }
    },
    handleClickForward() {
      if (this.currentIndex === this.totalPages - 1) {
        return;
      }
      this.currentIndex = this.currentIndex + 1;
      if (this.$refs.carousel) {
        this.$refs.carousel.goToNext();
      }
    },
    handleClickFirst() {
      this.currentIndex = 0;
      if (this.$refs.carousel) {
        this.$refs.carousel.goTo(0);
      }
    },
    handleClickLast() {
      this.currentIndex = this.totalPages - 1;
      if (this.$refs.carousel) {
        this.$refs.carousel.goTo(this.totalPages - 1);
      }
    }
  }
};
</script>
