<template>
  <main class="min-h-screen mx-auto my-10 p-6 max-w-6xl">
    <div class="rounded-3xl border border-slate-200 bg-white p-8 shadow-sm">
      <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div>
          <h1 class="text-4xl font-bold text-slate-900">Admin Dashboard</h1>
          <p class="mt-2 text-slate-600">Admin-only dashboard. Manage Projects with CRUD + archive.</p>
        </div>
      </div>

      <div class="mt-8 grid gap-4 lg:grid-cols-2">
        <div class="rounded-3xl border border-slate-200 bg-slate-50 p-6">
          <h2 class="text-xl font-semibold text-slate-900">Projects</h2>
          <p class="mt-2 text-slate-600">Create, edit, and archive projects.</p>

          <div class="mt-4 flex items-center justify-between">
            <Link v-if="user?.role === 'admin'" :href="route('projects.create')" class="btn_main">
              + Project
            </Link>
          </div>

          <div v-if="projects?.data?.length" class="mt-4 space-y-3">
            <div v-for="project in projects.data" :key="project.id" class="p-4 rounded-xl border border-slate-200 bg-white">
              <div class="flex items-start justify-between gap-4">
                <div>
                  <div class="font-semibold text-slate-900">{{ project.title }}</div>
                </div>
                <div class="flex items-center gap-3">
                  <Link v-if="user?.role === 'admin'" :href="route('projects.edit', project.id)" class="btn_edit">
                    Edit
                  </Link>
                  <Link
                    v-if="user?.role === 'admin'"
                    :href="route('projects.destroy', project.id)"
                    class="btn_delete"
                    method="DELETE"
                  >
                    Archive
                  </Link>
                </div>
              </div>
            </div>
          </div>

          <p v-else class="mt-4 text-sm text-slate-500">No projects available.</p>
        </div>

        <div class="rounded-3xl border border-slate-200 bg-slate-50 p-6">
          <h2 class="text-xl font-semibold text-slate-900">Admin Controls</h2>
          <p class="mt-2 text-slate-600">Manage users, review reports, and configure system settings here.</p>
        </div>
      </div>
    </div>
  </main>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
import { computed } from 'vue'
import { usePage } from '@inertiajs/vue3'

defineProps({
  projects: { type: Object, default: null },
})

const page = usePage()

const user = computed(() => page.props.user)

const route = (name, params = {}) => window.route(name, params)
</script>

