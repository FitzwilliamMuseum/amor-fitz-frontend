<template>
  <section class="letter-list">
    <div class="w-100 tr mb3">
      <DropdownSelector
        v-if="sortObjects"
        :options="sortOrders"
        :label="'sorted'"
        v-on:index-change="onSortOrderIndexChange"
      />
      <DropdownSelector
        v-if="sortObjects"
        :options="sortOptions"
        :label="'by'"
        v-on:index-change="onSortOptionIndexChange"
      />
    </div>
    <LetterPreviewCard
      v-for="(letter, index) in lettersSorted"
      :key="index"
      :title="letter.title"
      :date="letter.date"
      :author="letter.author"
      :recipient="letter.recipient"
      :entityCount="letter.entityCount"
      :link="letter.link"
      class="mb3"
    />
  </section>
</template>

<script>
import LetterPreviewCard from "./LetterPreviewCard";
import DropdownSelector from "./DropdownSelector";
import { orderBy } from "lodash";
export default {
  name: "LetterList",
  data: () => {
    return {
      sortOrders: ["asc", "desc"],
      sortOrderIndex: 0,
      sortObjects: [
        {
          name: "title",
          path: "title"
        },
        {
          name: "date",
          path: "date"
        },
        {
          name: "author",
          path: "author.name"
        },
        {
          name: "recipient",
          path: "recipient.name"
        }
      ],
      sortOptionIndex: 0
    };
  },
  components: {
    LetterPreviewCard,
    DropdownSelector
  },
  props: {
    letters: { type: Array, default: () => [] }
  },
  computed: {
    lettersSorted() {
      return orderBy(
        this.letters,
        [this.sortObjects[this.sortOptionIndex].path],
        [this.sortOrders[this.sortOrderIndex]]
      );
    },
    sortOptions() {
      return this.sortObjects.map(sortObject => sortObject.name);
    }
  },
  methods: {
    onSortOrderIndexChange(newIndex) {
      this.sortOrderIndex = newIndex;
    },
    onSortOptionIndexChange(newIndex) {
      this.sortOptionIndex = newIndex;
    }
  }
};
</script>
