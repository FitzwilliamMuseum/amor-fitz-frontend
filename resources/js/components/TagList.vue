<template>
  <section class="tag-list">
  <Tag
    v-for="(tag, index) in tags"
    :text="tag.text"
    :url="tag.url"
    :key="index"
  />
  </section>
</template>
<script>
import Tag from "./Tag";
export default {
  name: "TagList",
  data: () => {
    return {};
  },
  components: {
    Tag
  },
  props: {
    tags: { type: Array, default: () => [] }
  }
};
</script>
