<template>
  <div>
    <a class="db mb2" href="#0" @click.prevent="isExpanded = !isExpanded">{{
      isExpanded ? hideText : showText
    }}</a>
    <slot v-if="isExpanded"></slot>
  </div>
</template>

<script>
export default {
  name: "AccordionLink",
  props: {
    showText: { type: String },
    hideText: { type: String },
  },
  data() {
    return {
      isExpanded: false,
    };
  },
  computed: {
    reversedList() {
      // Check if we need to reverse the list
      if (this.isExpanded) {
        return true;
      } else {
        // If not, return the plain list passed in
        return this.isExpanded;
      }
    }
  }
};
</script>
