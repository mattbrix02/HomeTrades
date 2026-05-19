<template>
  <Main>
    <div class="flex items-center justify-between gap-4">
      <h1 class="text-3xl font-bold text-slate-900">Projects</h1>
    </div>


    <ProjectList :projects="projects" :user="user" />
  </Main>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
import Main from '@/Components/UI/Main.vue'
import ProjectList from '@/Pages/Project/Components/ProjectList.vue'

defineProps({
  user: { type: Object, default: null },
  projects: { type: Object, default: null },
})


const route = (name, params = {}) => window.route(name, params)
</script>

