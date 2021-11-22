<template>
  <div class="correspondence-header sans-serif">
    <div class="flex flex-row-reverse justify-end mb3">
      <AvatarItem
        type="Person"
        backgroundId="hayley"
        class="w4 correspondence-header__avatar-item"
      />
      <AvatarItem
        v-for="correspondent in correspondents"
        :key="correspondent.backgroundId"
        type="Person"
        :backgroundId="correspondent.backgroundId"
        class="w4 correspondence-header__avatar-item"
      />
    </div>
    <div>
      <h3 class="serif f4 mb2">Hayley's correspondence with</h3>
      <div
        v-for="correspondent in correspondents"
        :key="correspondent.name"
        class="mb2"
      >
        <h2 class="serif f2">
          {{ correspondent.name }}
        </h2>
        <div>
          <span v-if="correspondent.birthDate" class="mr3">
            {{ correspondent.birthDate | moment }}
          </span>
          <span v-if="correspondent.occupation" class="mr3">
            {{ correspondent.occupation }}
          </span>
          <span v-if="correspondent.relationToHayley" class="mr3">
            {{ correspondent.relationToHayley }}
          </span>
        </div>
      </div>
      <div class="mt3">
        <NumberBullet :number="numberLetters" class="mr2" />letters
      </div>
    </div>
  </div>
</template>

<script>
import NumberBullet from "./NumberBullet";
import AvatarItem from "./AvatarItem";
import moment from 'moment';

export default {
  name: "CorrespondenceHeader",
  props: {
    correspondents: { type: Array, default: () => [] },
    numberLetters: { type: Number },
    curatorialStatement: { type: String, default: "" }
  },
  computed: {
    avatars: function() {
      /* Need to reverse the order here because avatars will appear in a reversed flex direction for layering reasons */
      return this.backgroundIds.slice().reverse();
    }
  },
  components: {
    NumberBullet,
    AvatarItem
  },
  filters: {
    moment: function (date) {
      return moment(date).format('MMMM Do YYYY');
    }
  }
};

</script>

<style>
.correspondence-header__avatar-item:not(:last-of-type) {
  margin-left: -50px;
}
</style>
