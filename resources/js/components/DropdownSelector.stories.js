import DropdownSelector from "./DropdownSelector.vue";
import "../css/reset.css";
import "../css/global-styles.scss";

export default { title: "DropdownSelector" };

export const regular = () => ({
  components: { DropdownSelector },
  data: function() {
    return {
      options: ["title", "date", "author", "recipient"],
      label: "sorted by"
    };
  },
  template: `
    <div class="pa4">
      <DropdownSelector 
        :options='options' 
        :label='label' 
      />
    </div>
    `
});
