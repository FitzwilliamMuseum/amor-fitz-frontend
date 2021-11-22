<template>
  <div>
    <span v-for="(crumb, index) in crumbs" :key="crumb.path">
      <a :href="crumb.path" class="mr2 v-mid sans-serif f6">{{ crumb.text }}</a>
      <span v-if="index !== crumbs.length - 1" class="mr2 v-mid">➺</span>
    </span>
  </div>
</template>

<script>
export default {
  name: "TheBreadcrumbs",
  data: function() {
    return {};
  },
  props: {
    pathList: { type: Array, default: () => undefined }
  },
  computed: {
    crumbs() {
      return [{ text: "Home", path: "./" }].concat(
        this.pathList ||
          window.location.pathname
            .split("/")
            .slice(1)
            .map((path, index, paths) => {
              return {
                text: this.capitalise(path.split(".")[0]),
                path: paths.slice(0, index + 1).join("/")
              };
            })
      );
    }
  },
  methods: {
    capitalise(string) {
      return typeof string !== "string"
        ? ""
        : string.charAt(0).toUpperCase() + string.slice(1);
    }
  }
};
</script>
