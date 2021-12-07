<template>
  <article class="mw6 center bg-white br3 pa3 pa4-ns mv3 ">
    <div class="center">
    <AvatarItem
      :bgImageSrc="bgImageSrc"
      class="mr3 br-100 mb4 w4"
    />
      <h1 class="f4">
        {{ name }}
      </h1>
      <hr class="mw3 bb bw1 b--black-10">
    </div>
    <accordion-link
    showText="Show biography"
    hideText="Hide biography"
    >
    <span v-html="biography"></span>
  </accordion-link>
  <p v-if="role" class="lh-copy measure f6 berry">{{role}}</p>
  </article>

</template>

<script>
import AvatarItem from "./AvatarItem";
import AccordionLink from "./AccordionLink";

export default {
  name: "TeamProfileCard",
  props: {
    name: { type: String, default: ""  },
    role: { type: String, default: ""  },
    bgImageSrc: { type: String, default: "" },
    biography: { type: String, default: "" }
  },
  computed: {

  },
  components: {
    AccordionLink,
    AvatarItem
  }
};
</script>
