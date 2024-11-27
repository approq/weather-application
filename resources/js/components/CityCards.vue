<template>
  <section class="grid grid-cols-4 gap-6">
    <div
        v-for="(city, index) in cities"
        :key="city"
        class="city-card shadow rounded overflow-hidden dark:bg-gray-800">
      <img :src="`https://picsum.photos/600/400?random=${index}`" alt="City Image" class="object-cover w-full h-32">
      <div class="p-4">
        <h2 class="text-xl font-bold">{{ city }}</h2>
        <router-link :to="`/city/${city.toLowerCase()}`"
                     class="bg-blue-500 text-white rounded px-4 py-2 mt-4 inline-block"
        >Weather Details</router-link>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  name: 'CityCards',
  props: {
    cities: {
      type: Array,
      required: true
    }
  },
}
</script>