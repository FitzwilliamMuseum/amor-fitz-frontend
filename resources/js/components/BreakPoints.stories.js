import BreakPoints from "./BreakPoints.vue";
import "../css/reset.css";
import "../css/global-styles.scss";

export default { title: "BreakPoints" };

export const regular = () => ({
  components: { BreakPoints },
  data: function() {
    return {};
  },
  template: `
    <div class="pa3">
      <BreakPoints/>
    </div>
    `
});
