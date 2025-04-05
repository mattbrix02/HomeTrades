<template>
  <Box>
    <Link :href="route('listings.show',{listing:listing.id})">
      <div class="flex item-center gap-1">
        <Price :price="listing.price" class="text-2xl font-bold text-indigo-700 dark:text-indigo-400" />
        <div class="text-xs text-gray-500 text-center">
          <Price :price="monthlyPayment" />pm
        </div>
      </div>

      <ListingSpace :listing="listing" class="text-lg" />
      <ListingAddress :listing="listing" class="text-gray-500" />
      <ListingPostedOn :listing="listing" class="text-gray-500 mt-2 text-xs" />
    </Link>
  </Box>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
import ListingAddress from '@/Components/ListingAddress.vue'
import ListingSpace from '@/Components/ListingSpace.vue'
import ListingPostedOn from '@/Components/ListingPostedOn.vue'

import Price from '@/Components/Price.vue'
import Box from '@/Components/UI/Box.vue'

import {useMonthlyPayment} from '@/Composables/useMonthlyPayment'

const props = defineProps({
  listing:Object,
})

const {monthlyPayment} = useMonthlyPayment(props.listing.price, 2.5, 25)
</script>
