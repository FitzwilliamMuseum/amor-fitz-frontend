import LetterList from "./LetterList.vue";
import "../css/reset.css";
import "../css/global-styles.scss";

export default { title: "LetterList" };

export const regular = () => ({
  components: { LetterList },
  data: function() {
    return {
      letters: [
        {
          title: "William Hayley to Anna Seward: letter",
          date: "1782-06-11",
          author: { name: "William Hayley", link: "#" },
          recipient: { name: "Anna Seward", link: "#" },
          entityCount: {
            people: 1,
            places: 4,
            events: 6
          },
          link: "#"
        },
        {
          title: "Anna Seward to William Hayley: letter",
          date: "1782-06-12",
          author: { name: "Anna Seward", link: "#" },
          recipient: { name: "William Hayley", link: "#" },
          entityCount: {
            people: 5,
            places: 3,
            events: 7
          },
          link: "#"
        },
        {
          title: "William Hayley to Anna Seward: letter",
          date: "1782-06-13",
          author: { name: "William Hayley", link: "#" },
          recipient: { name: "Anna Seward", link: "#" },
          entityCount: {
            people: 3,
            places: 2,
            events: 1
          },
          link: "#"
        }
      ]
    };
  },
  template: `
    <div class="pa3">
      <LetterList 
        :letters='letters'
      />
    </div>
    `
});
