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
  min-width: 150px;
  max-width: 150px;
  background-size: cover;
  background-position: center center;
}
/* ensure  responsive square aspect ratio */
.avatar-item::before {
  content: '';
  padding-top: 100%;
  display: block;
}

.avatar-item--small {
  min-width: 64px;
  max-width: 64px;
}

/* background classes for different entity types */
.avatar-item__bg-person {
  background-image: url("../images/avatar-placeholder-person.png");
}

.avatar-item__bg-place {
  background-image: url("../images/avatar-placeholder-place.png");
}
.avatar-item__bg-family {
  background-image: url("../images/blake-family.jpg");
}
/* Specific people. Classes being generated based on backgroundId prop  */
.avatar-item__bg-william-hayley {
  background-image: url("../images/hayley.jpg");
}
.avatar-item__bg-john-flaxman {
  background-image: url("../images/flaxman.jpg");
}
.avatar-item__bg-blake {
  background-image: url("../images/blake.jpg");
}
.avatar-item__bg-thomas-alphonso-hayley {
  background-image: url("../images/alphonso.jpg");
}
.avatar-item__bg-anna-seward {
  background-image: url("../images/seward.jpg");
}
.avatar-item__bg-anne-nancy-flaxman {
  background-image: url("../images/anne-flaxman.jpg");
}
.avatar-item__bg-eliza-hayley {
  background-image: url("../images/eliza-hayley.jpg");
}
.avatar-item__bg-event {
  background-image: url("../images/blake-flaxman.jpeg");
}
.avatar-item__bg-still-image {
  background-image: url("../images/blake-flaxman.jpeg");
}
.avatar-item__bg-text {
  background-image: url("../images/letter-page-1.jpg");
}
</style>
