import ColourPalette from "./ColourPalette.vue";
import "../css/reset.css";
import "../css/global-styles.scss";

export default { title: "ColourPalette" };

export const regular = () => ({
  components: { ColourPalette },
  template: `
    <div class="pa3">
      <ColourPalette/>
    </div>
    `
});
