import LetterPreviewCard from "./LetterPreviewCard.vue";
import "../css/reset.css";
import "../css/global-styles.scss";

import imageLetter2 from "../images/letter-page-2.jpg";

export default { title: "LetterPreviewCard" };

export const regular = () => ({
  components: { LetterPreviewCard },
  data: function() {
    return {
      title: "William Hayley to Anna Seward: letter",
      date: "1782-06-11",
      author: { name: "Firstname Lastname", link: "#" },
      recipient: { name: "Firstname Lastname", link: "#" },
      entityCount: {
        people: 5,
        places: 3,
        events: 7
      },
      link: "/another-page"
    };
  },
  template: `
    <div class="pa3">
      <LetterPreviewCard 
        :title='title' 
        :date='date'
        :author='author' 
        :recipient='recipient' 
        :entityCount='entityCount' 
        :link='link'
      />
    </div>
    `
});

export const withCustomLetterBg = () => ({
  components: { LetterPreviewCard },
  data: function() {
    return {
      title: "William Hayley to Anna Seward: letter",
      date: "1782-06-11",
      author: { name: "Firstname Lastname", link: "#" },
      recipient: { name: "Firstname Lastname", link: "#" },
      entityCount: {
        people: 5,
        places: 3,
        events: 7
      },
      link: "/another-page",
      letterBgSrc: imageLetter2
    };
  },
  template: `
    <div class="pa3">
      <LetterPreviewCard 
        :title='title' 
        :date='date'
        :author='author' 
        :recipient='recipient' 
        :entityCount='entityCount' 
        :link='link'
        :letterBgSrc='letterBgSrc'
      />
    </div>
    `
});

export const withManyEntityTypes = () => ({
  components: { LetterPreviewCard },
  data: function() {
    return {
      title: "William Hayley to Anna Seward: letter",
      date: "1782-06-11",
      author: { name: "Firstname Lastname", link: "#" },
      recipient: { name: "Firstname Lastname", link: "#" },
      entityCount: {
        people: 2,
        places: 2,
        events: 3,
        families: 1,
        artworks: 3
      },
      link: "/another-page"
    };
  },
  template: `
    <div class="pa3">
      <LetterPreviewCard 
        :title='title' 
        :date='date'
        :author='author' 
        :recipient='recipient' 
        :entityCount='entityCount' 
        :link='link'
      />
    </div>
    `
});

export const withoutEntityTypes = () => ({
  components: { LetterPreviewCard },
  data: function() {
    return {
      title: "William Hayley to Anna Seward: letter",
      date: "1782-06-11",
      author: { name: "Firstname Lastname", link: "#" },
      recipient: { name: "Firstname Lastname", link: "#" },
      link: "/another-page"
    };
  },
  template: `
    <div class="pa3">
      <LetterPreviewCard 
        :title='title' 
        :date='date'
        :author='author' 
        :recipient='recipient' 
        :link='link'
      />
    </div>
    `
});
