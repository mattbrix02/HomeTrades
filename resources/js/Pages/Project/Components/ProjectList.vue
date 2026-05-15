<template>
  <Box>
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-1">
      <div>
        <div class="text-gray-500 font-medium mb-1">Courses</div>
      </div>
      <Link
        v-if="user?.role === 'admin'"
        class="btn_main"
        :href="route('courses.create')"
      >
        <div>+ Course </div>
      </Link>
    </div>

    <div>
      <div v-if="props.courses.data.length" class="space-y-2">
        <CourseRow
          v-for="course in courses.data"
          :key="course.id"
        >
          <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-4">
            <div class>
              <h3 class="font-semibold text-slate-900">{{ course.title }}</h3>
            </div>
            <div>
              <div class="flex flex-wrap gap-2 opacity-0 group-hover:opacity-100 transition justify-end">
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
          <div>
            <p 
              class="text-slate-700" 
              v-html="course.short_description || '<i>No short description provided yet.</i>'"
            />


            <p v-if="course.created_at" class="text-sm text-slate-600">
              {{ formatCreatedAt(course.created_at) }}
            </p>
          </div>
        </CourseRow>
        <Pagination :links="courses.links" />
      </div>

      <p v-else class="text-sm text-slate-500 text-center py-4">
        No courses available. Create your first course!
      </p>
    </div>
  </Box>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
import Pagination from '@/Components/UI/Pagination.vue'
import Box from '@/Components/UI/Box.vue'
import CourseRow from '@/Components/UI/CourseRow.vue'

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

// UPDATED: Helper function to format time and date
const formatCreatedAt = (timestamp) => {
  if (!timestamp) return ''
  const date = new Date(timestamp)
  const time = date.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })
  const dateString = date.toDateString() // Returns full date name
  return `${time} | ${dateString}`
}
</script>