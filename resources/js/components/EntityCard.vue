<template>
  <div class="entity-card bg-white pa3 sans-serif shadow-4">
    <div class="flex items-center">
      <AvatarItem :type="type" small :bgImageSrc="bgImageSrc" class="mr3" />
      <div>
        <h2 class="helvetica f3 fw4">{{ title }}</h2>
        <span v-if="role">
        <h3 class="f6 lh-copy">{{ role }}</h3>
        </span>
        <a :href="linkPath">{{ linkText }}</a>
      </div>
    </div>
  </div>
</template>

<script>
import AvatarItem from "./AvatarItem";

export default {
  name: "EntityCard",
  props: {
    type: { type: String },
    title: { type: String },
    role: { type: String},
    linkText: {
      type: String,
      default: "Read more"
    },
    linkPath: {
      type: String,
      default: "#"
    },
    bgImageSrc: {
      type: String
    }
  },
  components: { AvatarItem }
};
</script>

<style scoped>
.entity-card {
  max-width: 590px;
}
</style>
