import EntityHeader from "./EntityHeader.vue";
import "../css/reset.css";
import "../css/global-styles.scss";

import imageFlaxman from "../images/flaxman.jpg";
import imageSussex from "../images/sussex-place.jpg";

export default { title: "EntityHeader" };

export const person = () => ({
  components: {
    EntityHeader
  },
  data: function() {
    return {
      type: "person",
      title: "Flaxman, John (Jnr)",
      firstName: "John",
      lastName: "Flaxman",
      titleAristocrats: "Sir",
      birthDate: "1755-07-06",
      deathDate: "1826-12-07",
      birthPlace: "Amsterdam",
      deathPlace: "NYC",
      occupation: "sculptor",
      nickname: "The Flax",
      biographicalText:
        "John Flaxman RA (6 July 1755 – 7 December 1826) was a British sculptor and draughtsman, and a leading figure in British and European Neoclassicism. Early in his career he worked as a modeller for Josiah Wedgwood's pottery. He spent several years in Rome, where he produced his first book illustrations. He was a prolific maker of funerary monuments.",
      bibliography: "Example Bibliography",
      relationToHayley: "Friend of",
      numberLetters: 7
    };
  },
  template: `<EntityHeader 
      :type='type' 
      :title='title' 
      :metadataHead='{
        "Birth Date": birthDate,
        "Death Date": deathDate,
        "Birth Place": birthPlace,
        "Death Place": deathPlace,
        "Occupation": occupation,
        "Nickname": nickname,
        "Relation To Hayley": relationToHayley,
      }' 
      :metadataTail='{
        "First Name": firstName,
        "Last Name": lastName,
        "Title Aristocrats": titleAristocrats,
        "Bibliography": bibliography,
      }'
      :numberLetters='numberLetters' 
      :bodyText='biographicalText'
    />`
});

export const place = () => ({
  components: {
    EntityHeader
  },
  data: function() {
    return {
      type: "place",
      title: "Buxton, Derbyshire",
      latitude: "53.259082",
      longitude: "-1.91483",
      addressToday: "Buxton, Derbyshire SK17, UK",
      description: "Town in Derbyshire. Home to Mrs Gladwin",
      numberLetters: 3
    };
  },
  template: `<EntityHeader 
      :type='type' 
      :title='title' 
      :metadataHead='{
        "Latitude": latitude,
        "Longitude": longitude,
        "Address Today": addressToday,
      }' 
      :metadataTail='{}'
      :numberLetters='numberLetters' 
      :bodyText='description'
    />`
});
