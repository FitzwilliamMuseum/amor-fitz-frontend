<template>
    <a class="f6 link dim ph3 pv2 mb2 dib white bg-berry mr1" :href=url>
     {{ text }}
    </a>
</template>

<script>
export default {
  name: "Tag",
  props: {
  text: { type: String },
  url: { type: String }
  }
};
</script>
