<template>
  <Main>
    <div class="flex items-center justify-between gap-4">
      <h1 class="text-3xl font-bold text-slate-900">Projects</h1>

      <Link
        v-if="user?.role === 'admin'"
        :href="route('projects.create')"
        class="btn_main"
      >
        + Project
      </Link>
    </div>

    <div class="mt-6 rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
      <div v-if="projects?.data?.length" class="space-y-3">
        <div v-for="project in projects.data" :key="project.id" class="p-4 rounded-xl border border-slate-200">
          <div class="flex items-start justify-between gap-4">
            <div>
              <div class="font-semibold text-slate-900">{{ project.title }}</div>
            </div>

            <div class="flex items-center gap-3">
              <Link v-if="user?.role === 'admin'" class="btn_edit" :href="route('projects.edit', project.id)">
                Edit
              </Link>

              <Link
                v-if="user?.role === 'admin'"
                class="btn_delete"
                :href="route('projects.destroy', project.id)"
                method="DELETE"
              >
                Archive
              </Link>
            </div>
          </div>
        </div>
      </div>

      <p v-else class="text-sm text-slate-500 text-center py-4">No projects available.</p>

      <div v-if="projects?.links" class="mt-6">
        <Pagination :links="projects.links" />
      </div>
    </div>
  </Main>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
import Pagination from '@/Components/UI/Pagination.vue'
import Main from '@/Components/UI/Main.vue'

defineProps({
  user: { type: Object, default: null },
  projects: { type: Object, default: null },
})


const route = (name, params = {}) => window.route(name, params)
</script>

