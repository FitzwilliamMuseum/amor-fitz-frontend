import CorrespondenceHeader from "./CorrespondenceHeader.vue";
import "../css/reset.css";
import "../css/global-styles.scss";

export default { title: "CorrespondenceHeader" };

export const single = () => ({
  components: {
    CorrespondenceHeader
  },
  data: function() {
    return {
      correspondents: [
        {
          name: "John Flaxman",
          backgroundId: "flaxman",
          birthDate: "1755-07-06",
          occupation: "sculptor",
          relationToHayley: "Friend of"
        }
      ],
      numberLetters: 7,
      curatorialStatement:
        "A brief curatorial statement, describing the correspondent(s), the relationship they had with Hayley and what this correspondence reveals about Hayleys character."
    };
  },
  template: `
    <CorrespondenceHeader 
      :correspondents='correspondents' 
      :numberLetters='numberLetters' 
      :curatorialStatement='curatorialStatement'
    />
    `
});

export const multi = () => ({
  components: {
    CorrespondenceHeader
  },
  data: function() {
    return {
      correspondents: [
        {
          name: "John Flaxman",
          backgroundId: "flaxman",
          birthDate: "1755-07-06",
          occupation: "sculptor",
          relationToHayley: "Friend of"
        },
        {
          name: "William Blake",
          backgroundId: "blake",
          relationToHayley: "Friend"
        }
      ],
      numberLetters: 7,
      curatorialStatement:
        "A brief curatorial statement, describing the correspondent(s), the relationship they had with Hayley and what this correspondence reveals about Hayleys character."
    };
  },
  template: `
    <CorrespondenceHeader 
      :correspondents='correspondents' 
      :numberLetters='numberLetters' 
      :curatorialStatement='curatorialStatement'
    />
    `
});
