<template>
  <div>
    Listing was posted at <strong>{{ postedDate+" "+postedTime }}</strong>
  </div>
</template>


<script setup>
import { computed } from 'vue'

const props = defineProps({
  listing:Object,
})

const postedDate = computed(
  () => new Date(props.listing.created_at).toDateString(),
)


const postedTime = computed(
  () => new Date(props.listing.created_at).toLocaleTimeString(),
)


</script>
