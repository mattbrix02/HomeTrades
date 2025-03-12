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

          <label class="theme_switch">
            <input id="checkbox" checked="true" type="checkbox" />
            <span class="slider">
              <div class="star star_1" />
              <div class="star star_2" />
              <div class="star star_3" />
              <svg viewBox="0 0 16 16" class="cloud_1 cloud">
                <path
                  transform="matrix(.77976 0 0 .78395-299.99-418.63)"
                  fill="#fff"
                  d="m391.84 540.91c-.421-.329-.949-.524-1.523-.524-1.351 0-2.451 1.084-2.485 2.435-1.395.526-2.388 1.88-2.388 3.466 0 1.874 1.385 3.423 3.182 3.667v.034h12.73v-.006c1.775-.104 3.182-1.584 3.182-3.395 0-1.747-1.309-3.186-2.994-3.379.007-.106.011-.214.011-.322 0-2.707-2.271-4.901-5.072-4.901-2.073 0-3.856 1.202-4.643 2.925"
                />
              </svg>
            </span>
          </label>

          <Link class="text-gray-500 text-sm dark:text-gray-200" :href="route('realtor.listing.index')">
            {{ props.user.name }}
          </Link>

          <div class="text-gray-500 text-sm font-bold dark:text-gray-200">
            <div>
              <Link :href="route('logout')" method="DELETE" as="button">Logout</Link>
            </div>
          </div>
        </div>
        <div v-else class="flex items-center gap-4">
          <Link :href="route('login')">Sign in</Link>

          <Link :href="route('user-account.create')">Register</Link>
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
