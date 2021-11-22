<template>
  <div class="sans-serif">
    <h1 class="mt3">Tachyons classes</h1>

    <h2 class="mt2">display</h2>
    <div class="db">all (small and up)</div>
    <div class="db dn-ns">small only</div>
    <div class="dn db-m">medium only</div>
    <div class="dn db-l">large only</div>
    <div class="dn db-ns">not small (medium and up)</div>

    <h2 class="mt2">text-decoration</h2>
    <div class="underline">all (small and up)</div>
    <div class="underline no-underline-ns">small only</div>
    <div class="no-underline underline-m">medium only</div>
    <div class="no-underline underline-l">large only</div>
    <div class="no-underline underline-ns ">not small (medium and up)</div>

    <h2 class="mt2">font-weight</h2>
    <div class="fw9">all (small and up)</div>
    <div class="fw9 fw1-ns">small only</div>
    <div class="fw1 fw9-m">medium only</div>
    <div class="fw1 fw9-l">large only</div>
    <div class="fw1 fw9-ns ">not small (medium and up)</div>

    <h1 class="mt3">Vue MQ JS module</h1>
    <span
      >current breakpoint: <span class="f2">{{ $mq }}</span></span
    >
    <h2 class="mt2">display</h2>
    <div v-show="true">all (small and up)</div>
    <div v-show="$mq === 's'">small only</div>
    <div v-show="$mq === 'm'">medium only</div>
    <div v-show="$mq === 'l'">large only</div>
    <div v-show="$mq !== 's'">not small (medium and up)</div>
  </div>
</template>

<script>
import Vue from "vue";
import VueMq from "vue-mq";

Vue.use(VueMq, {
  breakpoints: {
    s: 480,
    m: 960,
    l: Infinity
  },
  defaultBreakpoint: "s"
});

export default {
  name: "BreakPoints"
};
</script>
