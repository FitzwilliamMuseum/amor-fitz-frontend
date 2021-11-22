<template>
  <div class="bg-white shadow-4 mw6 pa3">
    <h1 class="serif f2 mb3">{{ title }}</h1>
    <p class="sans-serif mb3">{{ content }}</p>
    <ButtonLink :link="buttonLink"
      >{{ buttonText }}<span class="sans-serif ml2 mt-2">&#9758;</span></ButtonLink
    >
  </div>
</template>

<script>
import ButtonLink from "./ButtonLink";

export default {
  name: "CTACard",
  props: {
    title: String,
    content: String,
    buttonText: { type: String, default: "Explore" },
    buttonLink: { type: String, default: "#" }
  },
  components: {
    ButtonLink: ButtonLink
  }
};
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped></style>
