<template>
  <Button>
    <a :href="link" class="no-underline white fw3"><slot /></a>
  </Button>
</template>

<script>
import Button from "./Button";

export default {
  name: "ButtonLink",
  props: { link: { type: String, default: "#" } },
  components: {
    Button: Button
  }
};
</script>
