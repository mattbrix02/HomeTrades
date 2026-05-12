<template>
  <main class="min-h-screen mx-auto my-10 p-6 max-w-4xl">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
      <div>
        <h1 class="text-3xl font-bold text-slate-900">Edit Course</h1>
        <p class="mt-2 text-slate-600">Update course details and save changes.</p>
      </div>
      <Link
        :href="route('courses.index')"
        class="inline-flex items-center justify-center px-4 py-2 rounded-xl bg-slate-100 text-slate-800 hover:bg-slate-200 transition"
      >
        Back to courses
      </Link>
    </div>

    <div class="bg-white rounded-2xl shadow-md border border-slate-200 p-6">
      <form class="space-y-6" @submit.prevent="update">
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
          <label class="block text-sm font-medium text-slate-700 mb-2">Short Description</label>

          <Tiptap
            v-model="form.short_description" class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 outline-none transition"
            placeholder="Short description..."
          />

          <div v-if="form.errors.short_description" class="input-error">
            {{ form.errors.short_description }}
          </div>
        </div>


        <div>
          <label class="block text-sm font-medium text-slate-700 mb-2">Description</label>

          <Tiptap
            v-model="form.description" rows="5" class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 outline-none transition"
            placeholder="Course description..."
          />

          <div v-if="form.errors.description" class="input-error">
            {{ form.errors.description }}
          </div>
        </div>




        <div class="flex flex-col sm:flex-row gap-3">
          <div>
            <label class="block text-sm font-medium text-slate-700 mb-2">Publish date</label>
            <input
              v-model="form.publish_date"
              type="datetime-local"
              required
              class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 outline-none transition"
              placeholder="mm/dd/yyyy"
            />
            <div v-if="form.errors.publish_date" class="input-error">
              {{ form.errors.publish_date }}
            </div>
          </div>

          <div>
            <label class="block text-sm font-medium text-slate-700 mb-2">Expiration date</label>
            <input
              v-model="form.expiration_date"
              type="datetime-local"
              required
              class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 outline-none transition"
              placeholder="mm/dd/yyyy"
            />
            <div v-if="form.errors.expiration_date" class="input-error">
              {{ form.errors.expiration_date }}
            </div>
          </div>

          <div>
            <label class="block text-sm font-medium text-slate-700 mb-2">Instructor</label>


            <select v-model="form.instructor" class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 outline-none transition">
              <option value="" disabled>Select an Instructor</option>
              <option v-for="instructor in props.instructors" :key="instructor.id" :value="instructor.id">
                {{ instructor.name }}
              </option>
            </select>

            <div v-if="form.errors.instructor" class="input-error">
              {{ form.errors.instructor }}
            </div>
          </div>
        </div>


        <div class="flex justify-between">
          <Link
            type="button"
            class="btn_cancel"
            :href="route('courses.index')"
          >
            Cancel
          </Link>
          <button
            type="submit"
            label="Submit"
            class="btn_main"
          >
            Update Course
          </button>
        </div>
      </form>
    </div>
  </main>
</template>

<script setup>

import Tiptap from '@/Components/vendor/tiptap.vue'
import { Link } from '@inertiajs/vue3'
import { useForm } from '@inertiajs/vue3'


const props = defineProps({
  course:Object,
  instructors: {
    type: Array,
    default: () => [],
  },
})

const form = useForm({
  id: props.course.id || '',
  title: props.course.title || '',
  instructor: props.course.instructor || '',
  description: props.course.description || '',
  short_description: props.course.short_description || '',

  publish_date: props.course.publish_date || '',
  expiration_date: props.course.expiration_date || '',

})


const update = () => form.put(route('courses.update', props.course.id))
</script>
