<template>
  <nav
    :class="wide ? 'pv5' : 'dt-l ph5-l'"
    class="db w-100 border-box pa3  bg-green creme"
  >
    <h1
      :class="wide ? 'mb4 f2-m f1-l' : 'dtc-l w-40-l tl-l mb0-l f2-ns'"
      class="db v-mid link w-100 tc mb2 helvetica f3"
    >
    <a class="link dim creme fw3" href="/" title="Home"
      >Most Sacred Things</a>
    </h1>
    <div
      :class="wide ? '' : 'dtc-l w-60-l tr-l'"
      class="db v-mid w-100 tc sans-serif"
    >
      <a class="link dim creme f6 f5-ns dib mr3 mr4-l" href="/" title="Home"
        >Home</a
      >
      <a
        class="link dim creme f6 f5-ns dib mr3 mr4-l"
        href="/correspondences"
        title="Correspondences"
        >Correspondences</a
      >
      <a
        class="link dim creme f6 f5-ns dib mr3 mr4-l"
        href="/entities"
        title="Entities"
        >Entities</a
      >
      <a class="link dim creme f6 f5-ns dib mr3 mr4-l" href="/about" title="About"
        >About</a
      >

    </div>
  </nav>
</template>

<script>
export default {
  name: "TheHeader",
  props: {
    wide: { type: Boolean, default: false }
  }
};
</script>
