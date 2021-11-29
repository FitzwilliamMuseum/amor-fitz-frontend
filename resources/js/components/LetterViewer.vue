<template>
  <div class="bg-white sans-serif pv3 letter-viewer">
    <div v-if="$mq !== 'l'" class="w-100 mb4">
      <agile
        ref="carousel"
        :options="agileOptions"
        @afterChange="currentIndex = $event.currentSlide"
        class="agile mh2 mh4-ns mb3"
      >
        <div
          v-for="(slide, index) in manuscriptPageImages"
          :key="index"
          :class="`slide--${index}`"
          class="slide"
        >
          <img class="mw-100" :src="slide" />
        </div>
      </agile>
      <div
        v-if="transcriptPageComponents || $mq !== 'l'"
        class="flex justify-center"
      >
        <Pagination
          :currentIndex="indexForNonNerds"
          :totalPages="totalPages"
          :onClickForward="handleClickForward"
          :onClickBackward="handleClickBackward"
          :onClickFirst="handleClickFirst"
          :onClickLast="handleClickLast"
        />
      </div>
    </div>
    <div class="w-100 flex justify-center">
      <div v-if="$mq === 'l'" class="mr2 letter-viewer__side">
        <div class="letter-viewer__manuscript-container">
          <div
            class="letter-viewer__manuscript-container__inner"
            :style="{
              backgroundImage: getBackgroundProp(
                manuscriptPageImages[currentIndex]
              )
            }"
          ></div>
        </div>
        <div
          v-if="transcriptPageComponents || $mq === 'l'"
          class="flex justify-center mt4"
        >
          <Pagination
            :currentIndex="indexForNonNerds"
            :totalPages="totalPages"
            :onClickForward="handleClickForward"
            :onClickBackward="handleClickBackward"
            :onClickFirst="handleClickFirst"
            :onClickLast="handleClickLast"
          />
        </div>
      </div>
      <div
        class="ml2 bg-white f-copy ba b--black-20 letter-viewer__side letter-viewer__transcript-container"
        :class="$mq !== 'l' ? 'vh-75' : ''"
      >
        <div class="pa4 letter-viewer__transcript-container__inner">
          <span v-html="transcription"></span>

          <component
            v-if="transcriptPageComponents"
            v-bind:is="transcriptPageComponents[currentIndex]"
          ></component>
          <div
            v-else-if="transcriptComponent"
            v-bind:is="transcriptComponent"
          ></div>

        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Vue from "vue";
import { VTooltip } from "v-tooltip";
import Pagination from "./Pagination";
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
  name: "LetterViewer",
  props: {
    manuscriptPageImages: { type: Array },
    transcriptPageComponents: { type: Array },
    transcriptComponent: { type: String },
    transcription: { type: String }
  },
  components: {
    Pagination,
    agile: VueAgile
  },
  data: function() {
    return {
      currentIndex: 0,
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
    },
    totalPages: function() {
      return Math.max(
        this.manuscriptPageImages.length,
        this.transcriptPageComponents ? this.transcriptPageComponents.length : 0
      );
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

<style>
.letter-viewer {
  position: relative;
}

.letter-viewer__side {
  width: 590px;
}

.letter-viewer__manuscript-container {
  margin-left: auto;
}
.letter-viewer__manuscript-container__inner {
  width: 100%;
  padding-bottom: 120%; /* Aspect ratio of image scans */
  background-color: black;
  background-size: contain;
  background-repeat: no-repeat;
  margin-left: auto;
}

.letter-viewer__transcript-container {
  position: relative;
  line-height: 170%;
}

.letter-viewer__transcript-container__inner {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  overflow: auto;
}

.agile .slide {
  align-items: center;
  box-sizing: border-box;
  color: #fff;
  display: flex;
  height: 75vh;
  justify-content: center;
}

.agile .slide img {
  height: 100%;
  object-fit: contain;
  object-position: center;
  width: 100%;
}
</style>
