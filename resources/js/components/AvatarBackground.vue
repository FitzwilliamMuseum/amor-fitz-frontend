<template>
  <div class="absolute w-100 h-100 bg-creme overflow-hidden z--1">
    <div
      v-if="showExclusionZone"
      class="absolute ba b--red b--dashed o-50"
      :style="{
        left: `${excludeZone.minX}px`,
        right: `${clientWidth - excludeZone.maxX}px`,
        top: `${excludeZone.minY}px`,
        bottom: `${clientHeight - excludeZone.maxY}px`
      }"
    ></div>
    <AvatarItem
      v-for="(avatar, index) in avatarsHydrated"
      :key="index"
      :type="avatar.type"
      :bgImageSrc="avatar.bgImageSrc"
      :style="avatar.style"
      class="absolute filter-lowcontrast"
      :small="$mq === 's'"
    />
  </div>
</template>

<script>
import AvatarItem from "./AvatarItem";
import Vue from "vue";
import VueMq from "vue-mq";

Vue.use(VueMq, {
  breakpoints: {
    s: 480,
    m: 960,
    l: Infinity
  },
  defaultBreakpoint: "s"
});

export default {
  name: "AvatarBackground",
  components: {
    AvatarItem
  },
  data: function() {
    return {
      avatarsHydrated: [],
      // separationFactor: how much to separate individual avatars?
      separationFactor: 2
    };
  },
  props: {
    avatars: { type: Array, default: () => [] },
    excludeZoneRatios: { type: Object },
    showExclusionZone: { type: Boolean, default: false }
  },
  computed: {
    avatarSize() {
      return this.$mq !== "s" ? 150 : 64;
    },
    clientWidth() {
      return document.body.clientWidth || document.documentElement.clientWidth;
    },
    clientHeight() {
      return (
        document.body.clientHeight || document.documentElement.clientHeight
      );
    },
    excludeZone() {
      return {
        minX: this.excludeZoneRatios.minX * this.clientWidth,
        maxX: this.excludeZoneRatios.maxX * this.clientWidth,
        minY: this.excludeZoneRatios.minY * this.clientHeight,
        maxY: this.excludeZoneRatios.maxY * this.clientHeight
      };
    }
  },
  methods: {
    randomPos() {
      return {
        x: Math.random() * this.clientWidth,
        y: Math.random() * this.clientHeight
      };
    },
    randomPosExclusive() {
      let randomPos = this.randomPos();
      return this.overlaps(randomPos, this.excludeZone)
        ? this.randomPosExclusive()
        : randomPos;
    },
    getStyleForPos(pos) {
      return {
        left: pos.x - 0.5 * this.avatarSize + "px",
        top: pos.y - 0.5 * this.avatarSize + "px"
      };
    },
    overlaps(pos, excludeArea) {
      return (
        pos.x > excludeArea.minX &&
        pos.x < excludeArea.maxX &&
        pos.y > excludeArea.minY &&
        pos.y < excludeArea.maxY
      );
    },
    overlapsPositions(candidatePos, existingPositions) {
      return existingPositions.some(pos => {
        return this.overlaps(
          candidatePos,
          this.getAreaForPos(pos, this.avatarSize)
        );
      });
    },
    getAreaForPos(pos, size) {
      return {
        minX: pos.x - this.separationFactor * size,
        maxX: pos.x + this.separationFactor * size,
        minY: pos.y - this.separationFactor * size,
        maxY: pos.y + this.separationFactor * size
      };
    },
    hydrateOneAvatar(avatar, iterations) {
      if (iterations > 4) {
        return;
      } // prevent too much recursion
      let candidatePos = this.randomPosExclusive();
      let existingPositions = this.avatarsHydrated.map(a => a.pos);
      if (!this.overlapsPositions(candidatePos, existingPositions)) {
        this.avatarsHydrated.push({
          type: avatar.type,
          bgImageSrc: avatar.bgImageSrc,
          style: this.getStyleForPos(candidatePos),
          pos: candidatePos
        });
      } else {
        this.hydrateOneAvatar(avatar, iterations + 1);
      }
    },
    hydrateAvatars() {
      this.avatars.forEach(avatar => {
        this.hydrateOneAvatar(avatar, 0);
      });
    }
  },
  created() {
    this.hydrateAvatars();
  }
};
</script>

<style scoped>
.z--1 {
  z-index: -1;
}
.filter-lowcontrast {
  filter: contrast(40%) brightness(150%) saturate(75%);
}
</style>
