<template>
  <main class="min-h-screen mx-auto my-10 p-6 max-w-6xl">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
      <div>
        <h1 class="text-3xl font-bold text-slate-900">Courses</h1>
        <p class="mt-2 text-slate-600">Manage all courses here.</p>
      </div>
    </div>

    <div class="mb-4">
      <input
        v-model="search"
        type="search"
        placeholder="Search courses..."
        class="w-full p-3 rounded-xl border border-slate-300 bg-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition"
      />
    </div>

    <Course :courses="courses" :search-query="search" />
  </main>
</template>

<script setup>
import Course from '@/Components/Course.vue'

defineProps({
  courses: {
    type: Array,
    default: () => [],
  },
})


</script>
