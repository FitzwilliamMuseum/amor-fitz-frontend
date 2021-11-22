<template>
  <div
    :class="[
      isRound ? 'br-100' : '',
      small ? 'avatar-item--small' : '',
      'bg-ink avatar-item ',
      bgClasses
    ]"
    :style="{ backgroundImage: backgroundProp }"
  ></div>
</template>

<script>
export default {
  name: "AvatarItem",
  props: {
    type: { type: String, default: "Other" },
    small: { type: Boolean, default: false },
    backgroundId: { type: String },
    bgImageSrc: { type: String }
  },
  computed: {
    isRound: function() {
      return this.type === "Person";
    },
    backgroundProp: function() {
      return this.bgImageSrc ? "url('" + this.bgImageSrc + "')" : undefined;
    },
    bgClasses: function() {
      const prefix = "avatar-item__";
      const backgroundIdClass = this.backgroundId
        ? prefix + "bg-" + this.backgroundId
        : "";
      const backgroundTypeClass = prefix + "bg-" + this.type.toLowerCase();
      return backgroundIdClass + " " + backgroundTypeClass;
    }
  }
};
</script>

<style scoped>
.avatar-item {
  width: 150px;
  height: 150px;
  background-size: cover;
  background-position: center center;
}

.avatar-item--small {
  width: 64px;
  height: 64px;
}

/* background classes for different entity types */
.avatar-item__bg-person {
  background-image: url("../images/avatar-placeholder-person.png");
}

.avatar-item__bg-place {
  background-image: url("../images/avatar-placeholder-place.png");
}

/* Specific people. Classes being generated based on backgroundId prop  */
.avatar-item__bg-hayley {
  background-image: url("../images/hayley.jpg");
}

.avatar-item__bg-flaxman {
  background-image: url("../images/flaxman.jpg");
}

.avatar-item__bg-blake {
  background-image: url("../images/blake.jpg");
}
</style>
