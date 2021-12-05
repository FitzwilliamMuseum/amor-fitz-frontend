<template>
 <l-map
   :options="{scrollWheelZoom: false}"
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
   >
   </l-tile-layer>
   <l-circle-marker :lat-lng="
    [
      lat ,
      lng
    ]"
    :draggable=false
    :radius="circle.radius"
    :color="circle.color"
    />
   </l-map>
</template>

<script>
import { LMap, LTileLayer, LCircleMarker} from 'vue2-leaflet';

export default {
name: "Map",
 components: {
   LMap,
   LTileLayer,
   LCircleMarker,
 },
 props: {
   lat: { type: String },
   lng: { type: String },
   defaultLocation: {
    type: Object,
    default: () => ({
      lat: 50.87468000,
      lng: -0.66679001
    })
   },
 },
 data () {
   return {
     placeLocation: {},
     url: 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
     attribution: '&copy; OSM',
     zoom: 18,
     circle: {
        radius: 9,
        color: 'black'
      },
   }
 },
 methods: {
   zoomUpdated (Zoom) {
     this.Zoom = Zoom;
     console.log(this.markers)
   },
   centerUpdated (Center) {
     this.center = Center;
   }
 }
}
</script>

<style>
 .map {
   position: relative;
   width: 100%;
   height: 500px !important;
   overflow :hidden
 }

  @import "https://unpkg.com/leaflet@1.7.1/dist/leaflet.css";
</style>
