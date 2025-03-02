<template>
  <header class="border-b border-gray-200 bg-white w-full dark:border-gray-700 dark:bg-gray-800">
    <div class="container mx-auto">
      <nav class="p-4 flex items-center justify-between">
        <div class="text-xl text-indigo-600 font-bold text-center dark:text-indigo-300 ">
          <Link href="/">HomeTrades</Link>
        </div>
        <div class="text-lg">
          <Link href="/hello">hello</Link>
        </div>
        <div class="text-lg">
          <Link :href="route('listings.index')">Listings</Link>
        </div>

        <div v-if="props.user" class="flex items-center gap-4">
          <div class="text-lg">
            <Link :href="route('listings.create')" class="btn-primary">+ New Listing</Link>
          </div>
          <div class="text-gray-500 text-sm dark:text-gray-200">
            <div>{{ props.user.name }}</div>
          </div>

          <div class="text-gray-500 text-sm font-bold dark:text-gray-200">
            <div>
              <Link :href="route('logout')" method="DELETE" as="button">Logout</Link>
            </div>
          </div>
        </div>
        <div v-else class="flex items-center gap-4">
          <Link :href="route('login')">Sign in</Link>
        </div>
      </nav>
    </div>
  </header>
</template>


<script setup>
import { defineProps } from 'vue'
import { Link } from '@inertiajs/vue3'

const props = defineProps({
  user: Object,
})
</script>
