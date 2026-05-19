<template>
  <Main>
    <div class="flex items-center justify-between gap-4">
      <h1 class="text-3xl font-bold text-slate-900">Project</h1>

      <Link :href="route('projects.index')" class="btn_main">Back</Link>
    </div>

    <div class="mt-6 rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
      <div class="mb-4">
        <div class="text-sm text-slate-500">Title</div>
        <div class="text-2xl font-semibold text-slate-900">{{ project?.title || '-' }}</div>
      </div>

      <div class="mt-6 grid gap-4 lg:grid-cols-2">
        <div class="rounded-2xl border border-slate-200 bg-slate-50 p-5">
          <h2 class="text-lg font-semibold text-slate-900">Project Details</h2>
          <p class="mt-2 text-slate-600">
            Placeholder box for future project fields. Currently only <span class="font-medium">title</span> exists.
          </p>
        </div>

        <div class="rounded-2xl border border-slate-200 bg-slate-50 p-5">
          <h2 class="text-lg font-semibold text-slate-900">Courses under this Project</h2>
          <p class="mt-2 text-slate-600">
            Below is the list of courses linked to this project.
          </p>
        </div>
      </div>

      <div class="mt-6 flex items-center gap-3">
        <Link
          v-if="user?.role === 'admin'"
          :href="route('projects.edit', project?.id)"
          class="btn_edit"
        >
          Edit
        </Link>

        <Link
          v-if="user?.role === 'admin'"
          :href="route('projects.destroy', project?.id)"
          class="btn_delete"
          method="DELETE"
        >
          Archive
        </Link>
      </div>
    </div>

    <!-- Courses list under project -->

    <CourseList
      :courses="courses"
      :user="user"
      :project="project"
    />
  </Main>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
import Main from '@/Components/UI/Main.vue'
import CourseList from '@/Pages/Course/Components/CourseList.vue'


defineProps({
  project: { type: Object, default: null },
  user: { type: Object, default: null },
  courses: { type: Object, default: null },
})

const route = (name, params = {}) => window.route(name, params)
</script>


