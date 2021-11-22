import CTACard from "./CTACard.vue";
import "../css/reset.css";
import "../css/global-styles.scss";

export default { title: "CTACard" };

export const regular = () => ({
  components: { "cta-card": CTACard },
  template: `
      <div class="pa3">
        <cta-card 
          title="Correspondences" 
          content="A sentence explaining what’s interesting about correspondences." 
          buttonText="Start reading" 
          buttonLink="/another-page"
        />
      </div>
    `
});
