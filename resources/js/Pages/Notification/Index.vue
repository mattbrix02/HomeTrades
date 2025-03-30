<template>
  <h1 class="text-3xl mb-4">Your Notifications</h1>

  <div class="min-h-[600px]">
    <section v-if="notifications.data.length" class="text-gray-700 dark:text-gray-400">
      <div v-for="notification in notifications.data" :key="notification.id" class="border border-gray-200 dark:border-gray-800 py-4 flex justify-between items-center pl-4 pr-4">
        <div>
          <span v-if="notification.type === 'App\\Notifications\\OfferMade'">
            An Offer of <Price :price="notification.data.amount" /> was made on your
            <Link
              :href="route('realtor.listing.show', {listing:notification.data.listing_id})"
              class="text-indigo-600 dark:text-indigo-400"
            >listing</Link>!
          </span>
        </div>
        <div>
          <Link
            v-if="!notification.read_at"
            :href="route('notification.seen', {notification:notification.id})"
            class="btn-outline text-xs font-medium uppercase"
            as="button"
            method="put"
          >
            Mark as read
          </Link>
        </div>
      </div>
    </section>

    <EmptyState v-else>No notifcations yet!</EmptyState>
  </div>
  <section v-if="notifications.data.length" class="w-full flex justify-center mt-8 mb-8">
    <Pagination :links="notifications.links" />
  </section>
</template>

<script setup>
import Price from '@/Components/Price.vue'
import EmptyState from '@/Components/UI/EmptyState.vue'
import Pagination from '@/Components/UI/Pagination.vue'
import { Link } from '@inertiajs/vue3'

defineProps({
  'notifications' : Object,
})
</script>