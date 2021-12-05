<template>
  <div>

    <l-map :options="{scrollWheelZoom: false}"
    :center="
     [
       lat || defaultLocation.lat,
       lng || defaultLocation.lng
     ]"
    :zoom="zoom"
    class="map"
    ref="map"
    @update:Zoom="zoomUpdated"
    @update:Center="centerUpdated"
    >
    <l-tile-layer
    :url="url"
    :attribution="attribution"
    />
    <l-geo-json
    :geojson="geojson"
    :options="options"
    />


    </l-map>
  </div>
</template>

<script>
import {LMap, LMarker, LTileLayer, LGeoJson, LCircleMarker} from 'vue2-leaflet';

export default {
  name: "GeoJsonMap",
  components: {
    LMap,
    LTileLayer,
    LMarker,
    LCircleMarker,
    LGeoJson
  },
  props: {
    lat: { type: String },
    lng: { type: String },
    path: { type: String },
    defaultLocation: {
     type: Object,
     default: () => ({
       lat: 51.5131,
       lng:  -0.1221
     })
    },
  },
  data () {
    return {
      show: true,
      url: 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
      attribution: '&copy; OSM',
      zoom: 6,
      center: [52.92277, -1.47663],
      geojson: null
    };

  },
  computed: {
    options() {
      return {
        onEachFeature: this.onEachFeatureFunction,
        pointToLayer: function (feature, coordinates) {
         return L.circleMarker(coordinates, {
             fillColor: '#000',
             weight: 1,
             radius: 9,
             color: 'black'
           })

       }
      };
    },
    onEachFeatureFunction() {
      return (feature, layer) => {
        layer.bindPopup(
          '<div><a href="' +  feature.geometry.properties.url + '" class="link dim purple"><h2 class="f4 helvetica fw3 purple">' +
            feature.geometry.properties.title +
            '</h2></a><p>' + feature.geometry.properties.description + '</p></div>',
          { permanent: false, sticky: false }
        );
        L.circleMarker(feature.geometry.coordinates,{
    radius: 8,
    fillColor: "#ff7800",
    color: "#000",
    weight: 1,
    opacity: 1,
    fillOpacity: 0.8
    });
      };
    }
  },
  methods: {
    zoomUpdated (Zoom) {
      this.Zoom = Zoom;
    },
    centerUpdated (Center) {
      this.center = Center;
    },
    jsonPath : function() {
      return this.path;
    },
  },
  async created () {
    const response = await fetch(this.path);
    this.geojson = await response.json();
  }
}
</script>
