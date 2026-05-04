<template>
  <main class="min-h-screen mx-auto my-10 p-6 max-w-4xl">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
      <div>
        <h1 class="text-3xl font-bold text-slate-900">Create Course</h1>
        <p class="mt-2 text-slate-600">Add a new course to the system.</p>
      </div>
      <Link
        class="inline-flex items-center justify-center px-4 py-2 rounded-xl bg-slate-100 text-slate-800 hover:bg-slate-200 transition"
        :href="route('courses.index')"
      >
        Back to courses
      </Link>
    </div>

    <div class="bg-white rounded-2xl shadow-md border border-slate-200 p-6">
      <form class="space-y-6" @submit.prevent="create">
        <div>
          <label class="block text-sm font-medium text-slate-700 mb-2">Course Title *</label>
          <input
            v-model="form.title"
            type="text"
            required
            class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 outline-none transition"
            placeholder="e.g. Laravel Basics"
          />
          <div v-if="form.errors.title" class="input-error">
            {{ form.errors.title }}
          </div>
        </div>

        <div>
          <label class="block text-sm font-medium text-slate-700 mb-2">Instructor</label>
          <input
            v-model="form.instructor"
            type="text"
            class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 outline-none transition"
            placeholder="e.g. Jane Doe"
          />
          <div v-if="form.errors.instructor" class="input-error">
            {{ form.errors.instructor }}
          </div>
        </div>

        <div>
          <label class="block text-sm font-medium text-slate-700 mb-2">Description</label>
          <textarea
            v-model="form.description"
            rows="4"
            class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 outline-none transition"
            placeholder="Course description..."
          />
          <div v-if="form.errors.description" class="input-error">
            {{ form.errors.description }}
          </div>
        </div>

        <div class="flex flex-col sm:flex-row gap-3">
          <Link
            type="button"
            class="w-full sm:w-auto px-5 py-3 rounded-xl border border-slate-300 text-slate-700 hover:bg-slate-50 transition"
            :href="route('courses.index')"
          >
            Cancel
          </Link>
          <Button
            type="submit"
            class="w-full sm:w-auto px-5 py-3 rounded-xl bg-indigo-600 text-white hover:bg-indigo-700 disabled:opacity-50 transition"
          >
            Create Course
          </Button>
        </div>
      </form>
    </div>
  </main>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
import { useForm } from '@inertiajs/vue3'

const form = useForm({
  title: null,
  instructor: null,
  description: null,
})

const create = () => form.post(route('courses.store'))


</script>
