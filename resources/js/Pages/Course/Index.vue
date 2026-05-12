<template>
  <main class="min-h-screen mx-auto my-10 p-6 max-w-6xl">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
      <div>
        <h1 class="text-3xl font-bold text-slate-900">Courses</h1>
        <p class="mt-2 text-slate-600">Manage all courses here.</p>
      </div>
    </div>

    <div class="mb-4">
      <CourseFilter :filters="filters" />
    </div>

    <Course :courses="courses" :user="user" />
  </main>
</template>

<script setup>
import Course from '@/Components/Course.vue'
import CourseFilter from './Components/CourseFilter.vue'

defineProps({
  user: {
    type: Object,
    default: null,
  },
  courses: {
    type: Object,
    default: null,
  },
  filters: {
    type: Object,
    default: () => ({}),
  },
})


</script>
