<template>
  <div class="sans-serif relative dib">
    {{ label }}
    <span
      @click="isExpanded = !isExpanded"
      v-click-outside="onClickOutside"
      class="green pointer"
    >
      {{ options[activeIndex] }} ▾
    </span>
    <div
      class="absolute z-1 right-0 shadow-4 mt1 bg-white"
      :class="isExpanded ? 'db' : 'dn'"
    >
      <span
        v-for="(sortOption, index) in options"
        :key="index"
        @click="onOptionClick(index)"
        class="ph3 pv1 db hover-bg-light-green"
      >
        {{ sortOption }}
      </span>
    </div>
  </div>
</template>

<script>
export default {
  name: "DropdownSelector",
  data: function() {
    return {
      isExpanded: false,
      activeIndex: 0
    };
  },
  props: {
    label: { type: String, default: "sorted by" },
    options: { type: Array }
  },
  methods: {
    onOptionClick(index) {
      this.activeIndex = index;
      this.isExpanded = false;
      this.$emit("index-change", index);
    },
    onClickOutside() {
      this.isExpanded = false;
    }
  },
  directives: {
    // https://stackoverflow.com/a/42389266
    "click-outside": {
      bind: function(el, binding, vnode) {
        el.clickOutsideEvent = function(event) {
          // here I check that click was outside the el and his childrens
          if (!(el == event.target || el.contains(event.target))) {
            // and if it did, call method provided in attribute value
            vnode.context[binding.expression](event);
          }
        };
        document.body.addEventListener("click", el.clickOutsideEvent);
      },
      unbind: function(el) {
        document.body.removeEventListener("click", el.clickOutsideEvent);
      }
    }
  }
};
</script>
