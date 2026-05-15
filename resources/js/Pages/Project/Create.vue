<template>
  <Main>
    <div class="flex items-center justify-between gap-4">
      <h1 class="text-3xl font-bold text-slate-900">Create Project</h1>
      <Link :href="route('projects.index')" class="btn_main">Back</Link>
    </div>

    <div class="mt-6 rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
      <form @submit.prevent="submit">
        <div class="mb-4">
          <label class="block text-sm font-medium text-slate-700">Title</label>
          <input
            v-model="form.title"
            type="text"
            class="mt-1 w-full rounded-lg border-slate-300"
            placeholder="Project title"
          />
          <div v-if="form.errors.title" class="mt-2 text-sm text-red-600">
            {{ form.errors.title }}
          </div>
        </div>

        <div class="flex items-center gap-3">
          <button
            type="submit"
            class="btn_main"
            :disabled="form.processing"
          >
            {{ form.processing ? 'Saving...' : 'Save' }}
          </button>
        </div>
      </form>
    </div>
  </Main>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3'
import { Link } from '@inertiajs/vue3'
import Main from '@/Components/UI/Main.vue'

const route = (name, params = {}) => window.route(name, params)


const form = useForm({
  title: '',
})

const submit = () => {
  form.post(route('projects.store'))
}
</script>

