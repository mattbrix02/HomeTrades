<template>
  <div class="bg-white p-6 rounded-2xl shadow-md border border-slate-200">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-5">
      <div>
        <h2 class="text-lg font-semibold text-slate-800"><Link :href="route('courses.index')">Courses</Link></h2>
        <p class="text-sm text-slate-500">View courses, open edit pages, and delete entries safely.</p>
      </div>
      <Link
        class="inline-flex items-center justify-center px-4 py-2 rounded-xl text-white font-medium
               bg-gradient-to-r from-indigo-600 to-indigo-500 hover:from-indigo-700 hover:to-indigo-600
               shadow-md transition"
        :href="route('courses.create')"
      >
        <div>+ Course</div>
      </Link>
    </div>

    <div class="space-y-3">
      <div v-if="courses.length" class="space-y-2">
        <div
          v-for="course in courses"
          :key="course.id"
          class="p-4 rounded-lg border border-slate-200 bg-white hover:shadow-md transition group"
        >
          <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-4">
            <div class="flex-1">
              <h3 class="font-semibold text-slate-900">{{ course.title }}</h3>
              <p v-if="course.instructor" class="text-sm text-slate-600">
                Instructor: {{ course.instructor }}
              </p>
              <p v-if="course.description" class="text-sm text-slate-700 mt-2">
                {{ course.description }}
              </p>
            </div>

            <div class="flex flex-wrap gap-2 opacity-0 group-hover:opacity-100 transition">
              <Link
                class="px-3 py-1 text-sm rounded-lg bg-slate-100 text-slate-700 hover:bg-slate-200 transition"
                :href="route('courses.show', course)"
              >
                View
              </Link>
              <Link
                class="px-3 py-1 text-sm rounded-lg bg-blue-100 text-blue-700 hover:bg-blue-200 transition"
                :href="route('courses.edit', course)"
              >
                Edit
              </Link>
              <Link
                class="px-3 py-1 text-sm rounded-lg bg-red-100 text-red-700 hover:bg-red-200 transition"
                :href="route('courses.destroy', course)"
                method="DELETE"
              >
                Delete
              </Link>
            </div>
          </div>
        </div>
      </div>

      <p v-else class="text-sm text-slate-500 text-center py-4">
        No courses available. Create your first course!
      </p>
    </div>
  </div>
</template>

<script setup>

import { Link } from '@inertiajs/vue3'

defineProps({
  courses: {
    type: Array,
    default: () => [],
  },
  searchQuery: {
    type: String,
    default: '',
  },
})

</script>
