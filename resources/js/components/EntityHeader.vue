<template>
  <div class="correspondence-header sans-serif">
    <div class="flex flex-row-reverse justify-end mb3">
      <AvatarItem :type="type" :bgImageSrc="bgImageSrc" class="w4" />
    </div>
    <div>
      <h2 class="helvetica f2 mb2 fw3">
        {{ title }}<span v-if="subtitle" class="f3">: {{ subtitle }}</span>
      </h2>
      <div v-if="type === 'Person'">
        <div v-if="metadataHead['Nickname'] != ''" class="f3 mb2">
          {{ metadataHead["Nickname"] }}
        </div>
        <div class="mb2" >
          <span v-if="metadataHead['Birth Date'] != ''" class="mr3">
            ✶ {{ metadataHead["Birth Date"] | moment }}
            {{ metadataHead["Birth Place"] }}
          </span>
          <span v-if="metadataHead['Death Date'] != ''" class="mr3">
            † {{ metadataHead["Death Date"] | moment }}
            {{ metadataHead["Death Place"] }}
          </span>
        </div>
        <div v-if="metadataHead['Occupation'] != ''" class="mb2">
          {{ metadataHead["Occupation"] }}
          {{ metadataHead["Relation To Hayley"] }}
        </div>
        <div v-if="metadataHead['Relation To Hayley'] != ''" class="mb2">
          {{ metadataHead["Relation To Hayley"] }}
        </div>
      </div>
      <div v-else>
        <div v-for="(value, key) in metadataHead" class="mb2">
          <span class="dib w4">{{ key }}</span>
          <span class="fw3">{{ value }}</span>
        </div>
      </div>
      <div class="mb2">
          <span v-html="bodyText"></span>
      </div>
      <div class="mb2">
          <span v-html="biographicalText"></span>
      </div>
      <NumberBullet v-if="numberLetters != 0" :number="numberLetters" class="mb2 mr2" /> <span v-if="numberLetters != 0">references</span>
      <AccordionLink
        v-if="Object.entries(metadataTail).length !== 0"
        showText="Show additional metadata ▾"
        hideText="Hide additional metadata ▴"
        :isExpanded="false"
      >
        <div v-for="(value, key) in metadataTail" class="mb2">
          <span class="dib w4">{{ key }}</span>
          <span class="fw4">{{ value }}</span>
        </div>

      </AccordionLink>
      <div class="mb2">
          <span v-html="text"></span>
      </div>
    </div>
  </div>
</template>

<script>
import NumberBullet from "./NumberBullet";
import AccordionLink from "./AccordionLink";
import AvatarItem from "./AvatarItem";
import moment from 'moment';

export default {
  name: "EntityHeader",
  props: {
    type: { type: String, default: "" },
    title: { type: String, default: "" },
    subtitle: { type: String, default: "" },
    metadataHead: { type: Object, default() {
            return {}
        }},
    metadataTail: { type: Object, default() {
            return {}
        } },
    numberLetters: { type: Number, default: 0 },
    biographicalText: { type: String, default: "" },
    bgImageSrc: { type: String },
    bodyText: { type: String , default: ""},
    text: { type: String , default: ""},
  },
  components: {
    NumberBullet,
    AccordionLink,
    AvatarItem
  },
  filters: {
    moment: function (date) {
      return moment(date).format('MMMM Do YYYY');
    }
  }
};
</script>
