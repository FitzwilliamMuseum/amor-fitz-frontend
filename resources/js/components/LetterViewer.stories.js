import LetterViewer from "./LetterViewer.vue";
import "../css/reset.css";
import "../css/global-styles.scss";
import Vue from "vue";

import letterImage1 from "../images/letter-page-1.jpg";
import letterImage2 from "../images/letter-page-2.jpg";
import letterImage3 from "../images/letter-page-3.jpg";
import letterImage4 from "../images/letter-page-4.jpg";

import DemoLetterTranscript from "./_mocks/DemoLetterTranscript";
import DemoAnnotationPage from "./_mocks/DemoAnnotationPage";

export default { title: "LetterViewer" };

Vue.component("LetterTranscriptFull", {
  components: {
    DemoLetterTranscript
  },
  template: "<DemoLetterTranscript/>"
});

Vue.component("TranscriptPage1", {
  components: {
    DemoAnnotationPage
  },
  template: "<DemoAnnotationPage/>"
});

Vue.component("TranscriptPage2", {
  template: `<div><p>possibly, fix on any Plan of Conduct towards you, that would entirely tranquillize my Mind. This I should not so much regard, were it not for very particular Circumstances.</p>
  <p>I have still so much of my original Heroic spirit, that I would not shrink from any Inquietude or Pain, by which I could contribute to your Health or Comfort, if such Inquietude &amp; Pain would not necessarily produce Consequences that You, (I am sure) of all persons living, would most wish to prevent – I mean those of injuring materially my unsettled Health, &amp; involving me in various distresses.</p>
  <p>To explain this, I must enter a little into my literary History, woeful as it is – It will not surprise you to hear, that I have made repeated attempts to reinforce my petty Exchequer with dramatic supplies¸&amp; with my antient Success – This long series of disappointments has involved me in some debt &amp; still more anxiety of spirits, both which I hope, in some degree, to remedy by devoting the next year to as much calm &amp; retired study in this my favourite Retreat, as my Brains will bear; &amp; the more so, as I have promised to execute, by the beginning of the Winter, a new Life of Milton, for a splendid Edition of the divine Bard, which is to appear as a Companion to the Boydelian Shakespeare.—</p>
  <p>Now I confess to you very frankly, that I could not execute a page of this Work, were you to pass the Time you mention, or even arrive, this Summer in Sussex; I will only say on this subject in the Words of your acquaintance the old Lion, “Sensation is Sensation”</p></div>`
});

Vue.component("TranscriptPage3", {
  template: `<div><p>you may reply, that it is hard, you should be deprived of the pleasure you expect in visiting southern Friends, by My Singularities – so it is, my dear Eliza, &amp; I am so little disposed to impose any hardship on you, that if you yourself, on deliberate Reflection, think I ought rather to banish myself from hence, rather than prevent your Visit to a County, which you used to detest, I will (however inconvenient it may be to me) fly to France, or seek some remote Retirement before your arrival. assuredly I will not be at Eartham (tho having a number of Books already sent to me here for the work I have mentioned, it would be most singularly inconvenient to me to desert my own study this Summer) yet I repeat, I will not be at Eartham when you are in Sussex –</p>
  <p>Heaven does not seem to have allotted Felicity in this world to any one; &amp; it has rendered it particularly impossible for us to form the Happiness of each other by living together; but it is still in our Power, my dear Eliza, to consult our mutual Tranquillity at a distance, by a kind &amp; meritorious attention to the Wishes of each other. If you greatly wish to visit the persons of this County, when you mention (tho' between ourselves they are so very weak in Understanding, that you would be sick to death of their Society) yet if such is your wish, I will, as I have said, at any Time contrive to leave this part of the World, rather than prevent you accepting offers of civility, that you desire to cultivate. – In return, I may reasonably expect, that you will have the Goodness to consult my convenience &amp; comfort a little, as to the Time of your unexpected visit to a county, that you have so often declared you hoped never to see again – your passing part of the summer after this with the old Countess, if you continue to wish it, we can easily contrive in such a manner, as you shall desire; &amp; I shall then have time to chuse at Leisure the place of my own Residence, during the months, you</p></div>`
});

Vue.component("TranscriptPage4", {
  template: `<div><p>remain in Sussex. But I must frankly say, your arrival here this Summer would harrass my Heart &amp; Soul beyond Expression, &amp; rob me of that Quiet, which is so necessary for the studies I wish to pursue, &amp; which indeed is the only blessing of human Life, that I can \\have/ much hope to possess, or anxiety to preserve; for as to Health, Opulence &amp; Pleasure, the two last were never Idols of mine &amp; the first has so frequently deserted me, that I have learnt to be contented without her –</p>
  <p>I am going in a few days to visit a new literary Friend on the other side of London, &amp; to pass a week or two with Him in conferences on the work I have undertaken. Pray let me find a Letter from you, as I pass thro London, directed to me at Romneys, &amp; be so kind as to let it arrive there on Saturday next, as I do not mean to be above two or three days in Town. – Mary must attend me, as the only valet I have; &amp; I mean to station Tom with a Friend, that I can make Free with, while I myself visit a Stranger, who, tho I have not yet seen Him has shewn a disposition to treat me with infinite Kindness.</p>
  <p>The Time of my return to Sussex must depend on the Answer I receive from you, &amp; think me not severe, my dear Eliza, when I say, that nothing but a kind &amp; friendly assurance from you, that you will not surprize &amp; distress me by any hasty excursion to this County, can enable me to come home to my favourite Solitude with that tranquillity [sic] of Spirit, which is so necessary for all literary Labour, &amp; especially to a person, whose body &amp; mind have been shattered like mine –</p>
  <p>God almighty bless you, &amp; give you tranquill [sic] &amp; placid Spirits! –</p>
  <p>If you think there is any degree of Harshness or Cruelty in this Letter, pray shew it to your excellent Friend M<sup>rs</sup> Nicholas, &amp; she will assure you, if your own Heart can want any such assurance, that it is the Letter of a Man, who, tho' Heaven allows him not the power of making you happy, is ever solicitous for your Good, ever kind to you in Reality, when He least appears so, &amp; ever entitled to your affection, Esteem, &amp; Obedience.</p>
  <p>Farewell &amp; believe me<br />Ever your affectionate<br />H</p>
  <p>Eartham<br />Sunday<br />May 6 1792</p></div>`
});

export const paginatedTranscript = () => ({
  components: { LetterViewer, DemoAnnotationPage },
  data: function() {
    return {
      manuscriptPageImages: [
        letterImage1,
        letterImage2,
        letterImage3,
        letterImage4
      ],
      transcriptPageComponents: [
        "TranscriptPage1",
        "TranscriptPage2",
        "TranscriptPage3",
        "TranscriptPage4"
      ]
    };
  },
  template:
    "<LetterViewer :manuscriptPageImages=manuscriptPageImages :transcriptPageComponents='transcriptPageComponents'></LetterViewer>"
});

export const fullTranscript = () => ({
  components: { LetterViewer },
  data: function() {
    return {
      manuscriptPageImages: [
        letterImage1,
        letterImage2,
        letterImage3,
        letterImage4
      ],
      transcriptComponent: "LetterTranscriptFull"
    };
  },
  template:
    "<LetterViewer :manuscriptPageImages=manuscriptPageImages :transcriptComponent='transcriptComponent'></LetterViewer>"
});
