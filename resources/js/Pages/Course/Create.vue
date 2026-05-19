<template>
  <main class="min-h-screen mx-auto my-10 p-6 max-w-4xl">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
      <div>
        <h1 class="text-3xl font-bold text-slate-900">Create Course</h1>
        <p class="mt-2 text-slate-500">Add a new course to the system.</p>
      </div>
      <Link
        class="shrink-0 inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-slate-100 text-slate-700 font-medium text-sm hover:bg-slate-200 transition"
        :href="route('courses.index')"
      >
        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <polyline points="15 18 9 12 15 6" />
        </svg>
        Back
      </Link>
    </div>

    <!-- Form card -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
      <form class="divide-y divide-slate-100" @submit.prevent="create">
        <!-- Title -->
        <div class="p-6">
          <label class="form-label">Course Title <span class="text-red-500">*</span></label>
          <input
            v-model="form.title"
            type="text"
            required
            class="form-input"
            placeholder="e.g. Laravel Basics"
          />
          <p v-if="form.errors.title" class="form-error">{{ form.errors.title }}</p>
        </div>

        <!-- Short Description -->
        <div class="p-6">
          <label class="form-label">Short Description</label>
          <quill-editor
            v-model="form.short_description"
            placeholder="Brief summary shown in course listings..."
          />
          <p v-if="form.errors.short_description" class="form-error">{{ form.errors.short_description }}</p>
        </div>

        <!-- Description -->
        <div class="p-6">
          <label class="form-label">Description</label>
          <quill-editor
            v-model="form.description"
            placeholder="Detailed course description..."
          />
          <p v-if="form.errors.description" class="form-error">{{ form.errors.description }}</p>
        </div>

        <!-- Author & Project -->
        <div class="p-6">
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
              <label class="form-label">Author</label>
              <select v-model="form.instructor" class="form-input">
                <option value="" disabled>Select an Instructor</option>
                <option v-for="instructor in props.instructors" :key="instructor.id" :value="instructor.id">
                  {{ instructor.name }}
                </option>
              </select>
              <p v-if="form.errors.instructor" class="form-error">{{ form.errors.instructor }}</p>
            </div>
            <div>
              <label class="form-label">Project</label>
              <select v-model="form.project_id" class="form-input">
                <option value="" disabled>Link to a project</option>
                <option v-for="project in props.projects" :key="project.id" :value="project.id">
                  {{ project.title }}
                </option>
              </select>
              <p v-if="form.errors.project" class="form-error">{{ form.errors.project }}</p>
            </div>
          </div>
        </div>

        <!-- Dates -->
        <div class="p-6">
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
              <label class="form-label">Publish Date <span class="text-red-500">*</span></label>
              <input
                v-model="form.publish_date"
                type="datetime-local"
                required
                class="form-input"
              />
              <p v-if="form.errors.publish_date" class="form-error">{{ form.errors.publish_date }}</p>
            </div>
            <div>
              <label class="form-label">Expiration Date <span class="text-red-500">*</span></label>
              <input
                v-model="form.expiration_date"
                type="datetime-local"
                required
                class="form-input"
              />
              <p v-if="form.errors.expiration_date" class="form-error">{{ form.errors.expiration_date }}</p>
            </div>
          </div>
        </div>

        <!-- Actions -->
        <div class="px-6 py-5 flex items-center justify-end gap-3 bg-slate-50">
          <Link
            type="button"
            class="btn-secondary"
            :href="route('courses.index')"
          >
            Cancel
          </Link>
          <button
            type="submit"
            class="btn-primary"
          >
            Create Course
          </button>
        </div>
      </form>
    </div>
  </main>
</template>

<script setup>
import quillEditor from '@/Components/vendor/quill-editor.vue'
import { Link, usePage } from '@inertiajs/vue3'
import { useForm } from '@inertiajs/vue3'

const props = defineProps({
  instructors: { type: Object, default: null },
  projects: { type: Object, default: null },
  project: { type: Object, default: null },
})

const { user } = usePage().props

const form = useForm({
  title: null,
  instructor: user.id,
  description: null,
  short_description: null,
  publish_date: null,
  expiration_date: null,
  project_id: props.project?.id,
})

const create = () => form.post(route('courses.store'))
</script>

<style scoped>
.form-label {
  display: block;
  font-size: 0.8125rem;
  font-weight: 600;
  color: #475569;
  margin-bottom: 0.5rem;
  letter-spacing: 0.01em;
}

.form-input {
  width: 100%;
  border-radius: 10px;
  border: 1.5px solid #e2e8f0;
  padding: 0.625rem 0.875rem;
  font-size: 0.9375rem;
  color: #1e293b;
  background: #fff;
  transition: border-color 0.2s, box-shadow 0.2s;
  outline: none;
}
.form-input::placeholder { color: #94a3b8; }
.form-input:focus {
  border-color: #818cf8;
  box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.12);
}

.form-error {
  margin-top: 0.375rem;
  font-size: 0.8125rem;
  color: #ef4444;
}

.btn-primary {
  display: inline-flex;
  align-items: center;
  gap: 0.375rem;
  padding: 0.625rem 1.25rem;
  border-radius: 10px;
  background: #6366f1;
  color: #fff;
  font-weight: 600;
  font-size: 0.9375rem;
  transition: background 0.2s, box-shadow 0.2s;
  border: none;
  cursor: pointer;
}
.btn-primary:hover { background: #4f46e5; }

.btn-secondary {
  display: inline-flex;
  align-items: center;
  gap: 0.375rem;
  padding: 0.625rem 1.125rem;
  border-radius: 10px;
  background: #fff;
  color: #64748b;
  font-weight: 500;
  font-size: 0.9375rem;
  border: 1.5px solid #e2e8f0;
  transition: border-color 0.2s, background 0.2s, color 0.2s;
  cursor: pointer;
}
.btn-secondary:hover { border-color: #cbd5e1; background: #f8fafc; color: #475569; }
</style>
