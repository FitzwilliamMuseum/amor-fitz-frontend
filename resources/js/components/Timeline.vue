
<template>
    <div id="timeline"></div>
</template>

<script>
import { Timeline } from '@knight-lab/timelinejs'
import '@knight-lab/timelinejs/dist/css/timeline.css'
export default {
  title: "Timeline",
  props: {
    docId: String
  },
  data () {
    return {
      timeline: {},
      timelineLoaded: false
    }
  },
  mounted() {
    this.timeline = new Timeline('timeline', this.docId)
  },
  methods: {

    changeSlide (pos_id) {
      this.timeline.goToId(pos_id)
    }
  }
}
</script>
<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
h3 {
  margin: 40px 0 0;
}
ul {
  list-style-type: none;
  padding: 0;
}
li {
  display: inline-block;
  margin: 0 10px;
}
a {
  color: #42b983;
}
.hello {
  height: 100%;
}
#timeline {
  height: 500px;
  min-height: 500px;
  width: 100%;
}

</style>
