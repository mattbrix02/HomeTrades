<template>
  <Navigation :user="user" />
  <main class="container mx-auto p-2 w-full">
    <div v-if="flashsuccess" class="mb-4 border rounded-md shadow-sm border-green-200 dark:boreder-green-800 bg-green-50 dark:bg-green-900 p-2">
      {{ flashsuccess }}
    </div>

    <div v-if="flasherror" class="mb-4 border rounded-md shadow-sm border-red-200 dark:boreder-green-800 bg-red-50 dark:bg-red-900 p-2">
      {{ flasherror }}
    </div>

    <slot />
  </main>
  <Footer />
</template>

<script setup>
import {computed} from 'vue'
import { usePage } from '@inertiajs/vue3'
import Navigation from '@/Components/Navigation.vue'
import Footer from '@/Components/Footer.vue'


const page = usePage()
const flashsuccess = computed(
  ()=> page.props.flash.success,
)

const flasherror = computed(
  ()=> page.props.flash.error,
)

const user = computed(
  () => page.props.user,
)



</script>
