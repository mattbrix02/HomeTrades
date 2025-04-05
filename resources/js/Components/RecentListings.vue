<template>
  <h2 class="text-gray-500 semi-bold">Recent Posted Listings</h2>
  <Vue3Marquee :pause-on-hover="true" :duration="50">
    <div class="flex flex-wrap gap-3 ml-3">
      <Listing v-for="listing in listings" :key="listing.id" :listing="listing" />
    </div>
  </Vue3Marquee>
</template>


<script setup>
import { Vue3Marquee } from 'vue3-marquee'
import Listing from '@/Pages/Listing/Index/Components/Listing.vue'


defineProps({
  listings: Object,
})


</script>

