<template>
  <main class="min-h-screen mx-auto my-10 p-6 max-w-4xl">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
      <div>
        <h1 class="text-3xl font-bold text-slate-900">{{ course.title }}</h1>
        <p class="mt-2 text-slate-600">Review course details in the same clean course style.</p>
      </div>
      <Link

        class="inline-flex items-center justify-center px-4 py-2 rounded-xl bg-slate-100 text-slate-800 hover:bg-slate-200 transition"
        :href="route('index.index')"
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
        <h2 class="text-xl font-semibold text-slate-900">Description</h2>
        <p class="text-slate-700">{{ course.description || 'No description provided yet.' }}</p>
      </div>

      <div class="grid gap-4 md:grid-cols-2">
        <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
          <h3 class="text-sm font-semibold text-slate-700 uppercase tracking-[0.2em]">Course ID</h3>
          <p class="mt-2 text-slate-900">{{ course.id }}</p>
        </div>
        <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
          <h3 class="text-sm font-semibold text-slate-700 uppercase tracking-[0.2em]">Last updated</h3>
          <p class="mt-2 text-slate-900">{{ course.updated_at || 'N/A' }}</p>
        </div>
      </div>
    </div>
  </main>
</template>

<script setup>
import { usePage, Link } from '@inertiajs/vue3'

const page = usePage()
const course = page.props.course || {}

const goBack = () => {
  window.location.href = route('courses.index')
}
</script>
