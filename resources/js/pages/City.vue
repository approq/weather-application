<template>
  <div v-if="isLoading">Loading...</div>
  <div v-else-if="error">
    <div class="bg-red-500 text-white p-4 rounded-md mt-4">
      <h2 class="text-lg mb-2">Sorry, we can't get weather conditions for {{ cityName }}</h2>
    </div>
    <div class="mt-8">
      <h1 class="text-xl font-bold mb-4">Check weather conditions in these cities instead:</h1>
    </div>
    <CityCards :cities="cities" />
  </div>

  <div v-else class="flex">
    <div class="w-1/2">
      <img :src="`https://picsum.photos/1200/600?random=${slugify(weatherData.name)}`" alt="City Image" class="h-full w-full object-cover" />
    </div>

    <div class="w-1/2 p-4">
      <h1 class="text-2xl font-bold mb-4">Weather for {{ weatherData.name }}, United Kingdom</h1>
      <p class="mb-2"><strong>Current weather conditions:</strong> {{ weatherData.weather[0].main }} ({{ weatherData.weather[0].description }})</p>
      <p class="mb-2"><strong>The current temperature:</strong> {{ Math.round(weatherData.main.temp) }}°C</p>
      <p class="mb-2"><strong>'Feels like' temperature:</strong> {{ Math.round(weatherData.main.feels_like) }}°C</p>
      <p class="mb-2"><strong>Humidity:</strong> {{ weatherData.main.humidity }}%</p>
      <p class="mb-2"><strong>Minimum temperature:</strong> {{ Math.round(weatherData.main.temp_min) }}°C</p>
      <p class="mb-2"><strong>Maximum temperature:</strong> {{ Math.round(weatherData.main.temp_max) }}°C</p>
      <p class="mb-2"><strong>Wind speed:</strong> {{ (weatherData.wind.speed * 2.237).toFixed(1) }} mph</p>
      <p class="mb-2" v-if="weatherData.rain"><strong>Rain volume for the last hour:</strong> {{ weatherData.rain['1h'] }} mm</p>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import CityCards from '@/components/CityCards.vue';

export default {
  components: {CityCards},
  data() {
    return {
      weatherData: null,
      error: false,
      isLoading: false,
      cities: ['London', 'Birmingham', 'Leeds', 'Glasgow'],
      cityName: null
    };
  },
  methods: {
    slugify(string) {
      return string.toString().toLowerCase().trim()
          .replace(/\s+/g, '-')
          .replace(/[^\w\-]+/g, '')
          .replace(/\-\-+/g, '-')
          .replace(/^-+/, '')
          .replace(/-+$/, '');
    },
    async getWeatherData(city) {
      this.isLoading = true;

      try {
        const response = await axios.get(`/api/weather/${city}`);
        this.weatherData = JSON.parse(response.data);
        this.error = false;

      } catch (error) {
        this.error = true;
      }

      this.isLoading = false;
    },
  },
  created() {
    this.cityName = this.$route.params.name;
    this.getWeatherData(this.cityName);
  },
  watch: {
    '$route.params.name': function(newCityName, oldCityName) {
      if (newCityName !== oldCityName) {
        this.getWeatherData(newCityName);
      }
    }
  },
};
</script>
