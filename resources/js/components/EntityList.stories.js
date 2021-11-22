import EntityList from "./EntityList.vue";
import "../css/reset.css";
import "../css/global-styles.scss";

import imageFlaxman from "../images/flaxman.jpg";
import imageSussex from "../images/sussex-place.jpg";

export default { title: "EntityList" };

export const regular = () => ({
  components: { EntityList },
  data: function() {
    return {
      bgImagePerson: imageFlaxman,
      bgImagePlace: imageSussex,
      entities: [
        {
          type: "Person",
          title: "Firstname Lastname",
          linkPath: "#",
          bgImageSrc: imageFlaxman
        },
        {
          type: "Person",
          title: "Firstname Lastname",
          linkPath: "#"
        },
        {
          type: "Person",
          title: "Firstname Lastname",
          linkPath: "#",
          bgImageSrc: imageFlaxman
        },
        {
          type: "Person",
          title: "Firstname Lastname",
          linkPath: "#"
        },
        {
          type: "Place",
          title: "Place Name",
          linkPath: "#",
          bgImageSrc: imageSussex
        },
        {
          type: "Place",
          title: "Place Name",
          linkPath: "#"
        },
        {
          type: "Place",
          title: "Place Name",
          linkPath: "#",
          bgImageSrc: imageSussex
        },
        {
          type: "Place",
          title: "Place Name",
          linkPath: "#"
        }
      ]
    };
  },
  template: `
    <div class="pa3">
      <EntityList 
        :entities='entities'
      />
    </div>
    `
});

export const filtered = () => ({
  components: { EntityList },
  data: function() {
    return {
      typeFilter: "Person",
      bgImagePerson: imageFlaxman,
      bgImagePlace: imageSussex,
      entities: [
        {
          type: "Person",
          title: "Firstname Lastname",
          linkPath: "#",
          bgImageSrc: imageFlaxman
        },
        {
          type: "Person",
          title: "Firstname Lastname",
          linkPath: "#"
        },
        {
          type: "Person",
          title: "Firstname Lastname",
          linkPath: "#",
          bgImageSrc: imageFlaxman
        },
        {
          type: "Person",
          title: "Firstname Lastname",
          linkPath: "#"
        },
        {
          type: "Place",
          title: "Place Name",
          linkPath: "#",
          bgImageSrc: imageSussex
        },
        {
          type: "Place",
          title: "Place Name",
          linkPath: "#"
        },
        {
          type: "Place",
          title: "Place Name",
          linkPath: "#",
          bgImageSrc: imageSussex
        },
        {
          type: "Place",
          title: "Place Name",
          linkPath: "#"
        }
      ]
    };
  },
  template: `
    <div class="pa3">
      <EntityList 
        :entities='entities'
        :typeFilter='typeFilter'
      />
    </div>
    `
});
