<template>
  <div
    class="letter-preview-card bg-white w-100 sans-serif f5 shadow-4 flex  flex-column-reverse flex-row-l"
  >
    <div class="letter-preview-card__left-side pa3 w-40-l">
      <h2 class="f3 serif mb2">{{ title }}</h2>
      <h3 class="f4 mb2">{{ date | moment }}</h3>
      <div class="mb3">
        <p v-if="author">
          From <a :href="author.link" class="berry dim">{{ author.name }}</a>
        </p>
        <p v-if="recipient">
          To
          <a :href="recipient.link" class="berry dim">{{ recipient.name }}</a>
        </p>
      </div>
      <div v-if="Object.keys(entityCount).length" class="mb2">
        <span
          class="mr3 mb2 dib"
          v-for="entityKey in Object.keys(entityCount)"
          :key="entityKey"
          ><span v-if="entityCount[entityKey] > 0"><NumberBullet :number="entityCount[entityKey]" />
          <span class="ml2">{{ entityKey }}</span></span>
        </span>
      </div>
      <div class="db">
        <ButtonLink :link="link"
          >Read letter<span class="sans-serif ml2 mt-2">&#9758;</span></ButtonLink
        >
      </div>
    </div>
    <div
      class="letter-preview-card__right-side h4 h5-m h-auto-l"
      :style="{ backgroundImage: `url(${letterBgSrc})` }"
    >
      <a class="db w-100 h-100" :href="link"></a>
    </div>
  </div>
</template>

<script>
import moment from 'moment';
import NumberBullet from "./NumberBullet";
import ButtonLink from "./ButtonLink";
import imageLetterDefault from "../images/letter-page-1.jpg";
export default {
  name: "LetterPreviewCard",
  components: {
    NumberBullet,
    ButtonLink
  },
  props: {
    title: { type: String, default: "" },
    date: { type: String, default: "" },
    author: { type: Object },
    recipient: { type: Object },
    entityCount: { type: Object, default: () => ({}) },
    link: { type: String },
    letterBgSrc: { type: String, default: imageLetterDefault }
  },
  filters: {
    moment: function (date) {
      return moment(date).format('MMMM Do YYYY');
    }
  }
};
</script>

<style scoped>
.letter-preview-card {
  max-width: 900px;
}

.letter-preview-card__right-side {
  /* Cutting away the black border around the letter */
  background-position: -60px -50px;
  background-size: calc(100% + 200px);
  background-repeat: no-repeat;
  flex-grow: 1;
}
</style>
