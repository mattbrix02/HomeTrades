<template>
  <Main>
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
      <div>
        <h1 class="text-3xl font-bold text-slate-900">{{ course.title }}</h1>
      </div>
      <Link

        class="btn_cancel"
        :href="route('courses.index')"
      >
        Back to courses
      </Link>
    </div>

    <Box class="bg-white rounded-2xl shadow-md border border-slate-200 p-6 space-y-6">
      <template #header>
        Course details
      </template>

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
        <SubBox>
          <template #header>
            Author
          </template>
          <p class="mt-2 text-slate-900">{{ course.createdby.first_name + ' ' + course.createdby.last_name || 'No instructor assigned yet.' }}</p>
        </SubBox>
        <SubBox>
          <template #header>
            Last updated
          </template>

          <p class="mt-2 text-slate-900">{{ postedTime || 'N/A' }}</p>
          <p class="mt-2 text-slate-900">{{ postedDate || 'N/A' }}</p>
        </SubBox>
      </div>
    </Box>

    <Box>
      <template #header>
        Lessons
      </template>

      <CourseRow>
        test
      </CourseRow>

      <CourseRow>
        test
      </CourseRow>

      <CourseRow>
        test
      </CourseRow>
    </Box>
  </Main>
</template>

<script setup>
import Box from '@/Components/UI/Box.vue'
import CourseRow from '@/Components/UI/CourseRow.vue'
import Main from '@/Components/UI/Main.vue'
import SubBox from '@/Components/UI/SubBox.vue'
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
