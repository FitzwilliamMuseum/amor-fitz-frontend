<template>
  <div class="correspondence-card bg-white mw6 pa3 tc helevtica shadow-4">
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
    <div v-for="(name, index) in names" :key="name" class="helvetica f4">
    <div v-if="index != names.length - 1">{{ name }} &#9758;</div>
    <div v-if="index == names.length - 1">{{ name }}</div>
    </div>

    <div class="mt3">
      <span v-if="numberletters > 0"><NumberBullet :number="numberletters" class="mr2" />letters</span>
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
  name: "CorrespondenceCard",
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
