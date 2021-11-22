import AvatarBackground from "./AvatarBackground.vue";
import "../css/reset.css";
import "../css/global-styles.scss";

import imageFlaxman from "../images/flaxman.jpg";
import imageHayley from "../images/hayley.jpg";
import imageBlake from "../images/blake.jpg";
import imageSussex from "../images/sussex-place.jpg";

export default { title: "AvatarBackground" };

export const regular = () => ({
  components: { AvatarBackground },
  data: function() {
    return {
      avatars: [
        {
          type: "Person",
          bgImageSrc: imageHayley
        },
        {
          type: "Person",
          bgImageSrc: imageFlaxman
        },
        {
          type: "Person",
          bgImageSrc: imageBlake
        },
        {
          type: "Place",
          bgImageSrc: imageSussex
        },
        {
          type: "Person",
          bgImageSrc: imageHayley
        },
        {
          type: "Person",
          bgImageSrc: imageFlaxman
        },
        {
          type: "Person",
          bgImageSrc: imageBlake
        },
        {
          type: "Place",
          bgImageSrc: imageSussex
        }
      ],
      excludeZoneRatios: {
        minX: 0.2,
        maxX: 0.8,
        minY: 0.2,
        maxY: 0.8
      }
    };
  },
  template: `
    <AvatarBackground 
      :avatars='avatars'
      :excludeZoneRatios='excludeZoneRatios'
    />
    `
});

export const showExclusionZone = () => ({
  components: { AvatarBackground },
  data: function() {
    return {
      avatars: [
        {
          type: "Person",
          bgImageSrc: imageHayley
        },
        {
          type: "Person",
          bgImageSrc: imageFlaxman
        },
        {
          type: "Person",
          bgImageSrc: imageBlake
        },
        {
          type: "Place",
          bgImageSrc: imageSussex
        },
        {
          type: "Person",
          bgImageSrc: imageHayley
        },
        {
          type: "Person",
          bgImageSrc: imageFlaxman
        },
        {
          type: "Person",
          bgImageSrc: imageBlake
        },
        {
          type: "Place",
          bgImageSrc: imageSussex
        }
      ],
      excludeZoneRatios: {
        minX: 0.2,
        maxX: 0.8,
        minY: 0.2,
        maxY: 0.8
      },
      showExclusionZone: true
    };
  },
  template: `
    <AvatarBackground 
      :avatars='avatars'
      :excludeZoneRatios='excludeZoneRatios'
      :showExclusionZone='showExclusionZone'
    />
    `
});
