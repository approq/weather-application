<template>
  <header class="shadow py-3 dark:bg-gray-800 dark:text-white">
    <div class="container mx-auto flex justify-between items-center px-4">
      <div class="logo">
        <router-link to="/">
          <h1 class="text-2xl">WeatherApp</h1>
        </router-link>
      </div>
      <div class="search-bar">
        <input
            type="text"
            class="p-2 rounded dark:text-gray-950"
            v-model="cityName"
            @keyup.enter="searchCity"
            placeholder="Search city in UK..."
        >
      </div>
    </div>
  </header>

  <main class="container mx-auto mt-3 py-4 px-4 dark:text-white flex-grow">
    <router-view v-slot="{ Component, route }">
      <div :key="route.name">
        <Component :is="Component" />
      </div>
    </router-view>
  </main>

  <footer class="py-2 mt-5 dark:bg-gray-800 dark:text-white">
    <div class="container mx-auto text-center">
      <p class="text">&copy; 2024 WeatherApp</p>
    </div>
  </footer>
</template>

<script>
export default {
  data() {
    return {
      cityName: '',
    };
  },
  methods: {
    searchCity() {
      let slugifiedCity = this.slugify(this.cityName);
      this.$router.push(`/city/${slugifiedCity}`);
    },
    slugify(string) {
      return string.toString().toLowerCase().trim()
          .replace(/\s+/g, '-')
          .replace(/[^\w\-]+/g, '')
          .replace(/\-\-+/g, '-')
          .replace(/^-+/, '')
          .replace(/-+$/, '');
    }
  }
};
</script>