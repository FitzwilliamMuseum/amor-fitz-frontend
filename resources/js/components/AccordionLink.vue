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
    isExpanded: { type: Boolean }
  }
};
</script>
