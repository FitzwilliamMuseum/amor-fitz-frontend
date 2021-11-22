import EntityCard from "./EntityCard";
import "../css/reset.css";
import "../css/global-styles.scss";

import imageFlaxman from "../images/flaxman.jpg";
import imageSussex from "../images/sussex-place.jpg";

export default {
  title: "EntityCard"
};

export const person = () => ({
  components: { "entity-card": EntityCard },
  data: function() {
    return {
      bgImage: imageFlaxman
    };
  },
  template: `
    <div class="pa3">
      <entity-card 
        type="Person" 
        title="Firstname Lastname" 
        :bgImageSrc="bgImage"
      />
    </div>
    `
});

export const personWithoutImage = () => ({
  components: { "entity-card": EntityCard },
  template: `
    <div class="pa3">
      <entity-card 
        type="Person" 
        title="Firstname Lastname" 
      />
    </div>
    `
});

export const place = () => ({
  components: { "entity-card": EntityCard },
  data: function() {
    return {
      bgImage: imageSussex
    };
  },
  template: `
    <div class="pa3">
      <entity-card 
        type="Place" 
        title="Location Name" 
        :bgImageSrc="bgImage"
      />
    </div>
    `
});

export const placeWithoutImage = () => ({
  components: { "entity-card": EntityCard },
  template: `
    <div class="pa3">
      <entity-card 
        type="Place" 
        title="Location Name" 
      />
    </div>
    `
});
