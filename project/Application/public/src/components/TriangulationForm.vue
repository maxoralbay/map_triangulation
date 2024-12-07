<template>
  <div class="container mt-4">
    <h1 class="text-center mb-4">Triangulation</h1>

    <!-- Google Map -->
    <GmapMap
        :center="center"
        :zoom="4"
        style="width: 100%; height: 400px"
        @click="addMarker"
    >
      <!-- Reference Points -->
      <GmapMarker
          v-for="(marker, index) in referencePoints"
          :key="index"
          :position="marker"
          :label="`P${index + 1}`"
      />
      <!-- Result Marker -->
      <GmapMarker
          v-if="result"
          :position="result"
          icon="http://maps.google.com/mapfiles/ms/icons/green-dot.png"
      />
    </GmapMap>

    <!-- Form Fields -->
    <form @submit.prevent="submitForm" class="needs-validation mt-4">
      <div class="mb-3">
        <label for="distance1" class="form-label">Distance to Point 1</label>
        <input
            type="number"
            v-model.number="distances.distance1"
            id="distance1"
            class="form-control"
            required
        />
      </div>
      <div class="mb-3">
        <label for="distance2" class="form-label">Distance to Point 2</label>
        <input
            type="number"
            v-model.number="distances.distance2"
            id="distance2"
            class="form-control"
            required
        />
      </div>
      <div class="mb-3">
        <label for="distance3" class="form-label">Distance to Point 3</label>
        <input
            type="number"
            v-model.number="distances.distance3"
            id="distance3"
            class="form-control"
            required
        />
      </div>
      <button type="submit" class="btn btn-primary w-100">Calculate</button>
    </form>

    <!-- Result Display -->
    <div v-if="result" class="alert alert-success mt-4" role="alert">
      <strong>Calculated Coordinates:</strong><br/>
      Latitude: {{ result.lat.toFixed(6) }}, Longitude: {{ result.lng.toFixed(6) }}
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      distances: {
        distance1: null,
        distance2: null,
        distance3: null,
      },
      referencePoints: [
        {lat: 50.110889, lng: 8.682139},
        {lat: 39.048111, lng: -77.472806},
        {lat: 45.8491, lng: -119.714},
      ],
      center: {lat: 45.0, lng: -20.0}, // Map center
      result: null,
    };
  },
  methods: {
    async submitForm() {
      try {
        const payload = {
          distance1: this.distances.distance1,
          distance2: this.distances.distance2,
          distance3: this.distances.distance3,
        };

        const response = await fetch('http://localhost/api/calculate', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify(payload),
        });

        if (!response.ok) throw new Error('Failed to fetch results');
        const data = await response.json();
        this.result = {lat: data.lat, lng: data.lon};
      } catch (error) {
        console.error(error);
        alert('Error calculating triangulation');
      }
    },
  },
};
</script>

<style scoped>
.container {
  max-width: 600px;
  margin: auto;
}
</style>
