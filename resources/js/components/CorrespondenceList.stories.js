import CorrespondenceList from "./CorrespondenceList.vue";
import "../css/reset.css";
import "../css/global-styles.scss";

export default { title: "CorrespondenceList" };

export const regular = () => ({
  components: { CorrespondenceList },
  data: function() {
    return {
      correspondences: [
        {
          names: ["William Blake"],
          backgroundIds: ["blake"],
          numberLetters: 5,
          curatorialStatement:
            "A brief curatorial statement, describing the correspondent(s), the relationship they had with Hayley and what this correspondence reveals about Hayleys character."
        },
        {
          names: ["William Blake", "John Flaxman"],
          backgroundIds: ["blake", "flaxman"],
          numberLetters: 13,
          curatorialStatement:
            "A brief curatorial statement, describing the correspondent(s), the relationship they had with Hayley and what this correspondence reveals about Hayleys character."
        },
        {
          names: ["John Flaxman"],
          backgroundIds: ["flaxman"],
          numberLetters: 7,
          curatorialStatement:
            "A brief curatorial statement, describing the correspondent(s), the relationship they had with Hayley and what this correspondence reveals about Hayleys character."
        }
      ]
    };
  },
  template: `
    <CorrespondenceList 
      :correspondences='correspondences'
    />
    `
});
