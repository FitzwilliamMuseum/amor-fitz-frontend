import CorrespondenceCard from "./CorrespondenceCard.vue";
import "../css/reset.css";
import "../css/global-styles.scss";

export default { title: "CorrespondenceCard" };

export const single = () => ({
  components: {
    CorrespondenceCard
  },
  data: function() {
    return {
      names: ["John Flaxman"],
      backgroundIds: ["flaxman"],
      numberLetters: 7,
      curatorialStatement:
        "A brief curatorial statement, describing the correspondent(s), the relationship they had with Hayley and what this correspondence reveals about Hayleys character.",
      buttonText: "Explore",
      buttonLink: "/another-page"
    };
  },
  template: `
    <div class="pa3">
      <CorrespondenceCard 
        :names='names' 
        :backgroundIds='backgroundIds' 
        :numberLetters='numberLetters' 
        :curatorialStatement='curatorialStatement' 
        :buttonText='buttonText' 
        :buttonLink='buttonLink'
      />
    </div>
    `
});

export const multi = () => ({
  components: {
    CorrespondenceCard
  },
  data: function() {
    return {
      names: ["William Blake", "John Flaxman"],
      backgroundIds: ["blake", "flaxman"],
      numberLetters: 7,
      curatorialStatement:
        "A brief curatorial statement, describing the correspondent(s), the relationship they had with Hayley and what this correspondence reveals about Hayleys character.",
      buttonText: "Explore",
      buttonLink: "/another-page"
    };
  },
  template: `
    <div class="pa3">
      <CorrespondenceCard 
        :names='names' 
        :backgroundIds='backgroundIds' 
        :numberLetters='numberLetters' 
        :curatorialStatement='curatorialStatement'
        :buttonText='buttonText' 
        :buttonLink='buttonLink'
      />
    </div>
    `
});
