<template>
  <div class="bg-white p-6 rounded-2xl shadow-md border border-slate-200">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-5">
      <div>
        <h2 class="text-lg font-semibold text-slate-800"><Link :href="route('courses.index')">Courses</Link></h2>
        <p class="text-sm text-slate-500">View courses here</p>
      </div>
      <Link
        v-if="user?.role === 'admin'"
        class="btn_main"
        :href="route('courses.create')"
      >
        <div>+ Course </div>
      </Link>
    </div>

    <div class="space-y-3">
      <div v-if="props.courses.data.length" class="space-y-2">
        <div
          v-for="course in courses.data"
          :key="course.id"
          class="course_row group"
        >
          <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-4">
            <div class="flex-1">
              <h3 class="font-semibold text-slate-900">{{ course.title }}</h3>
              <p v-if="course.createdby" class="text-sm text-slate-600">
                Instructor: {{ course.createdby.first_name + " " + course.createdby.last_name }}
              </p>
              
              <p 
                class="text-slate-700" 
                v-html="course.short_description || '<i>No short description provided yet.</i>'"
              />
            </div>



            <div class="flex flex-wrap gap-2 opacity-0 group-hover:opacity-100 transition">
              <Link

                class="btn_view"
                :href="route('courses.show', course)"
              >
                View
              </Link>
              <Link
                v-if="user?.role === 'admin' || user?.id === course.created_by"
                class="btn_edit"
                :href="route('courses.edit', course)"
              >
                Edit
              </Link>
              <Link
                v-if="user?.role === 'admin' || user?.id === course.created_by"
                class="btn_delete"
                :href="route('courses.destroy', course)"
                method="DELETE"
              >
                Delete
              </Link>
            </div>
          </div>
        </div>
        <Pagination :links="courses.links" />
      </div>

      <p v-else class="text-sm text-slate-500 text-center py-4">
        No courses available. Create your first course!
      </p>
    </div>
  </div>
</template>

<script setup>

import { Link } from '@inertiajs/vue3'
import Pagination from '@/Components/UI/Pagination.vue'

const props = defineProps({

  user :{
    type: Object,
    default: null,
  },

  courses: {
    type: Object,
    default: null,
  },
})


</script>
