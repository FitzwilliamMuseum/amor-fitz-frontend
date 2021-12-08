<template>
  <div class="mb3 mt3 tc w-100">
    <ButtonLink :link="buttonLink"
      >{{ buttonText }}<span class="sans-serif ml2 mt-2">&#9758;</span></ButtonLink
    >
  </div>
</template>

<script>
import ButtonLink from "./ButtonLink";

export default {
  name: "SimpleButton",
  props: {
    buttonText: { type: String, default: "Explore" },
    buttonLink: { type: String, default: "#" }
  },
  components: {
    ButtonLink: ButtonLink
  }
};
</script>
