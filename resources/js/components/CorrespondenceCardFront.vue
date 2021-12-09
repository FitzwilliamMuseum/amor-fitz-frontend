<template>
  <div class="correspondence-card w-100 pa3 tc helvetica">
    <div class="center flex flex-row-reverse justify-center">
      <AvatarItem
        type="Person"
        backgroundId="william-hayley"
        class="mb4 w4 correspondence-card__avatar-item"
      />
      <AvatarItem
        v-for="backgroundId in backgrounds"
        :key="backgroundId"
        type="Person"
        :backgroundId="backgroundId"
        class="mb4 w4 correspondence-card__avatar-item"
      />
    </div>
  </div>
</template>

<script>
import AvatarItem from "./AvatarItem";

export default {
  name: "CorrespondenceCardFront",
  props: {
    backgrounds: { type: Array, default: () => [] }
  },
  computed: {
    avatars: function() {
      /* Need to reverse the order here because avatars will appear in a reversed flex direction for layering reasons */
      return this.backgrounds.slice().reverse();
    }
  },
  components: {
    AvatarItem
  }
};
</script>

<style>
.correspondence-card__avatar-item:not(:last-of-type) {
  margin-left: -50px;
}
</style>
