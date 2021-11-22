import Button from "./Button.vue";
import "../css/reset.css";
import "../css/global-styles.scss";

export default { title: "Button" };

export const regular = () => ({
  components: { Button },
  data: function() {
    return {
      handleClick: function() {
        alert("You clicked the button");
      }
    };
  },
  template: `
    <Button :onClick="handleClick">Button text</Button>
    `
});

export const square = () => ({
  components: { Button },
  data: function() {
    return {
      handleClick: function() {
        alert("You clicked the button");
      }
    };
  },
  template: `
    <Button square :onClick="handleClick">+</Button>
    `
});
