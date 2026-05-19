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
        <ProjectList :projects="projects" :user="user" />

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
import ProjectList from '@/Pages/Project/Components/ProjectList.vue'


defineProps({
  projects: { type: Object, default: null },
})

const page = usePage()

const user = computed(() => page.props.user)

const route = (name, params = {}) => window.route(name, params)
</script>

