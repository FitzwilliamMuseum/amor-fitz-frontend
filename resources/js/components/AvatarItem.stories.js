import AvatarItem from "./AvatarItem.vue";
import "../css/reset.css";
import "../css/global-styles.scss";

import imageFlaxman from "../images/flaxman.jpg";
import imageSussex from "../images/sussex-place.jpg";

export default { title: "AvatarItem" };

export const personWithImage = () => ({
  components: {
    AvatarItem
  },
  data: function() {
    return {
      type: "Person",
      bgImageSrc: imageFlaxman
    };
  },
  template: `
    <AvatarItem 
      :type='type'
      :bgImageSrc='bgImageSrc'
    />
    `
});

export const personWithImageId = () => ({
  components: {
    AvatarItem
  },
  data: function() {
    return {
      type: "Person",
      backgroundId: "blake"
    };
  },
  template: `
    <AvatarItem 
      :type='type'
      :backgroundId='backgroundId'
    />
    `
});

export const personWithoutImage = () => ({
  components: {
    AvatarItem
  },
  data: function() {
    return {
      type: "Person"
    };
  },
  template: `
    <AvatarItem 
      :type='type'
    />
    `
});

export const placeWithImage = () => ({
  components: {
    AvatarItem
  },
  data: function() {
    return {
      type: "Place",
      bgImageSrc: imageSussex
    };
  },
  template: `
    <AvatarItem 
      :type='type'
      :bgImageSrc='bgImageSrc'
    />
    `
});

export const placeWithoutImage = () => ({
  components: {
    AvatarItem
  },
  data: function() {
    return {
      type: "Place"
    };
  },
  template: `
    <AvatarItem 
      :type='type'
    />
    `
});

export const personSmall = () => ({
  components: {
    AvatarItem
  },
  data: function() {
    return {
      type: "Person"
    };
  },
  template: `
    <AvatarItem 
      :type='type'
      small
    />
    `
});

export const placeSmall = () => ({
  components: {
    AvatarItem
  },
  data: function() {
    return {
      type: "Place"
    };
  },
  template: `
    <AvatarItem 
      :type='type'
      small
    />
    `
});
