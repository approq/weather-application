<template>
  <CityCards :cities="cities" />
</template>

<script>
import CityCards from '@/components/CityCards.vue';

export default {
  components: {CityCards},
  data() {
    return {
      cities: ['London', 'Birmingham', 'Leeds', 'Glasgow', 'Sheffield', 'Bradford',
        'Manchester', 'Edinburgh', 'Liverpool', 'Bristol', 'Cardiff', 'Belfast',
        'Nottingham', 'Southampton', 'Leicester', 'Newcastle', 'Brighton',
        'Bournemouth', 'Cambridge', 'Oxford'],
    };
  },
};
</script>