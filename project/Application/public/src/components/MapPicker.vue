<template>
  <div class="container mt-5">
    <h2 class="mb-3">Pick Coordinates on Google Maps</h2>

    <GmapMap
        :center="center"
        :zoom="4"
        style="width: 100%; height: 500px"
        @click="addMarker"
    >
      <GmapMarker
          v-for="(marker, index) in markers"
          :key="index"
          :position="marker"
      />
    </GmapMap>

    <div class="mt-3">
      <h4>Picked Coordinates:</h4>
      <ul class="list-group">
        <li
            v-for="(marker, index) in markers"
            :key="index"
            class="list-group-item"
        >
          Lat: {{ marker.lat.toFixed(6) }}, Lon: {{ marker.lng.toFixed(6) }}
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      center: {lat: 39.8283, lng: -98.5795}, // Default center (USA)
      markers: [
        {lat: 50.110889, lng: 8.682139},
        {lat: 39.048111, lng: -77.472806},
        {lat: 45.8491, lng: -119.714},
      ],
    };
  },
  methods: {
    addMarker(event) {
      const {latLng} = event;
      this.markers.push({
        lat: latLng.lat(),
        lng: latLng.lng(),
      });
    },
  },
};
</script>

<style scoped>
.container {
  max-width: 800px;
}
</style>
