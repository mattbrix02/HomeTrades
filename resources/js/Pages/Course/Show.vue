<template>
  <main class="min-h-screen mx-auto my-10 p-6 max-w-4xl">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
      <div>
        <h1 class="text-3xl font-bold text-slate-900">{{ course.title }}</h1>
        <p class="mt-2 text-slate-600">Review course details</p>
      </div>
      <Link

        class="inline-flex items-center justify-center px-4 py-2 rounded-xl bg-slate-100 text-slate-800 hover:bg-slate-200 transition"
        :href="route('courses.index')"
      >
        Back to courses
      </Link>
    </div>

    <div class="bg-white rounded-2xl shadow-md border border-slate-200 p-6 space-y-6">
      <div class="space-y-2">
        <h2 class="text-xl font-semibold text-slate-900">Instructor</h2>
        <p class="text-slate-700">{{ course.instructor || 'No instructor assigned yet.' }}</p>
      </div>

      <div class="space-y-2">
        <h2 class="text-xl font-semibold text-slate-900">Short Description</h2>
        <p 
          class="text-slate-700" 
          v-html="course.short_description || '<i>No short description provided yet.</i>'"
        />
      </div>

      <div class="space-y-2">
        <h2 class="text-xl font-semibold text-slate-900">Description</h2>
        <p 
          class="text-slate-700" 
          v-html="course.description || '<i>No description provided yet.</i>'"
        />
      </div>

      <div class="grid gap-4 md:grid-cols-2">
        <div class="sub_label">
          <h3 class="text-sm font-semibold text-slate-700 uppercase tracking-[0.2em]">Course ID</h3>
          <p class="mt-2 text-slate-900">{{ course.id }}</p>
        </div>
        <div class="sub_label">
          <h3 class="text-sm font-semibold text-slate-700 uppercase tracking-[0.2em]">Last updated</h3>
          <p class="mt-2 text-slate-900">{{ postedTime || 'N/A' }}</p>
          <p class="mt-2 text-slate-900">{{ postedDate || 'N/A' }}</p>
        </div>
      </div>
    </div>
  </main>
</template>

<script setup>
import { usePage, Link } from '@inertiajs/vue3'
import { computed } from 'vue'

const page = usePage()
const course = page.props.course || {}


const postedTime = computed(
  () => new Date(course.created_at).toLocaleTimeString(),
)

const postedDate = computed(
  () => new Date(course.created_at).toDateString(),
)


</script>
