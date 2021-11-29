<template>
  <div class="correspondence-card bg-white mw6 pa3 tc sans-serif shadow-4">
    <div class="center flex flex-row-reverse justify-center">
      <AvatarItem
        type="Person"
        backgroundId="hayley"
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

    <h2 v-for="name in names" :key="name" class="helvetica f2 fw4">
      {{ name }}
    </h2>
    <div class="mt3">
      <NumberBullet :number="numberletters" class="mr2" /> records
    </div>
    <p class="sans-serif mt3">{{ curatorialStatement }}</p>
    <ButtonLink class="mt4" :link="buttonLink"
      >{{ buttonText }}<span class="sans-serif ml2 mt-2">&#9758;</span></ButtonLink
    >
  </div>
</template>

<script>
import ButtonLink from "./ButtonLink";
import NumberBullet from "./NumberBullet";
import AvatarItem from "./AvatarItem";

export default {
  name: "EntityListCard",
  props: {
    names: { type: Array, default: () => [] },
    backgrounds: { type: Array, default: () => [] },
    numberletters: { type: Number },
    curatorialStatement: { type: String, default: "" },
    buttonText: { type: String, default: "Explore" },
    buttonLink: { type: String, default: "#" }
  },
  computed: {
    avatars: function() {
      /* Need to reverse the order here because avatars will appear in a reversed flex direction for layering reasons */
      return this.backgrounds.slice().reverse();
    }
  },
  components: {
    ButtonLink,
    NumberBullet,
    AvatarItem
  }
};
</script>

<style>
.correspondence-card__avatar-item:not(:last-of-type) {
  margin-left: -50px;
}
</style>
