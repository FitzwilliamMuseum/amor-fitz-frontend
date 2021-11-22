import ButtonLink from "./ButtonLink.vue";
import "../css/reset.css";
import "../css/global-styles.scss";

export default { title: "ButtonLink" };

export const regular = () => ({
  components: { ButtonLink },
  data: function() {
    return {
      link: "https://en.wikipedia.org/wiki/William_Hayley"
    };
  },
  template: `
    <ButtonLink :link="link">Discover the letters</ButtonLink>
    `
});
