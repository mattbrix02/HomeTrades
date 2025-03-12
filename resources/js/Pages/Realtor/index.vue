<template>
  <h1 class="text-3xl mb-4">Your Listings</h1>

  <section>
    <RealtorFilter :filters="filters" />
  </section>

  <section class="grid grid-cols-1 lg:grid-cols-2 gap-2">
    <Box v-for="listing in listings.data" :key="listing.id">
      <div class="flex flex-col md:flex-row gap-2 md:items-center justify-between">
        <div>
          <div class="xl:flex items-center gap-2">
            <Price :price="listing.price" class="text-2xl font-medium" />
            <ListingSpace :listing="listing" />
          </div>
          <ListingAddress :listing="listing" class="text-gray-500" />
        </div>
        <div class="flex items-center gap-1 text-gray-600 dark:text-gray-300">
          <Link class="btn-outline text-xs font-medium">Preview</Link>
          <Link class="btn-outline text-xs font-medium">Edit</Link>

          <Link v-if="!listing.deleted_at" class="btn-outline text-xs font-medium" :href="route('realtor.listing.destroy', {listing:listing.id})" as="button" method="DELETE">Delete</Link>
          <span v-if="listing.deleted_at" class="btn-outline text-xs font-medium text-red-700 cursor-not-allowed">DELETED</span>
        </div>
      </div>
    </Box>
  </section>

  <section v-if="listings.data.length" class="w-full flex justify-center mt-4 mb-4">
    <Pagination :links="listings.links" />
  </section>
</template>

<script setup>
import ListingAddress from '@/Components/ListingAddress.vue'
import ListingSpace from '@/Components/ListingSpace.vue'
import RealtorFilter from '@/Pages/Realtor/Index/Components/realtorFilter.vue'
import Pagination from '@/Components/UI/Pagination.vue'
import Price from '@/Components/Price.vue'
import Box from '@/Components/UI/Box.vue'
import { Link } from '@inertiajs/vue3'



defineProps({
  listings:Object,
  filters:Object,
})

</script>
