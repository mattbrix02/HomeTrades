<template>
  <Box>
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-1">
      <div>
        <div class="text-gray-500 font-medium mb-1">Projects</div>
      </div>
      <Link
        v-if="user?.role === 'admin'"
        class="btn_main"
        :href="route('projects.create')"
      >
        <div>+ Project</div>
      </Link>
    </div>

    <div>
      <div v-if="props.projects?.data?.length" class="space-y-3">
        <div v-for="project in projects.data" :key="project.id" class="p-4 rounded-xl border border-slate-200">
          <div class="flex items-start justify-between gap-4">
            <div>
              <div class="font-semibold text-slate-900">{{ project.title }}</div>
            </div>

            <div class="flex items-center gap-3">
              <Link
                class="btn_view"
                :href="route('projects.show', project.id)"
              >
                View
              </Link>


              <Link
                v-if="user?.role === 'admin'"
                class="btn_edit"
                :href="route('projects.edit', project.id)"
              >
                Edit
              </Link>


              <button
                v-if="user?.role === 'admin' || user?.id === project.created_by"
                class="btn_delete"
                @click="confirmDelete(project)"
              >
                Delete
              </button>
            </div>
          </div>
        </div>

        <Pagination :links="projects.links" />
      </div>

      <p v-else class="text-sm text-slate-500 text-center py-4">
        No projects available.
      </p>
    </div>
  </Box>
</template>

<script setup>
import { Link, router } from '@inertiajs/vue3'
import Pagination from '@/Components/UI/Pagination.vue'
import Box from '@/Components/UI/Box.vue'
import Swal from 'sweetalert2'


const props = defineProps({
  user: {
    type: Object,
    default: null,
  },
  projects: {
    type: Object,
    default: null,
  },
})



const confirmDelete = async (project) => {
  const result = await Swal.fire({
    title: 'Delete Project?',
    text: `"${project.title}" will be permanently deleted.`,
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Delete',
    cancelButtonText: 'Cancel',
    confirmButtonColor: '#d33',
  })

  if (!result.isConfirmed) {
    return
  }

  router.delete(route('projects.destroy', project), {
    preserveScroll: true,
  })
}
</script>

