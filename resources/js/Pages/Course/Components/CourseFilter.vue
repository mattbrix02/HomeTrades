<template>
  <form @submit.prevent="filter">
    <div class="mb-8 mt-4 flex flex-wrap gap-2">
      <div class="flex flex-nowrap items-center">
        <input v-model="filterForm.search" type="text" placeholder="Search" class="field w-56" />
      </div>

      <div class="flex flex-nowrap items-center">
        <select v-model="filterForm.instructor" class="field field-select w-48 input-filter-r">
          <option class="text-slate-300" :value="null">Filter instructor</option>
          <option v-for="instructor in props.instructors" :key="instructor.id" :value="instructor.id">
            {{ instructor.first_name }} {{ instructor.last_name }}
          </option>
        </select>
      </div>

      <div class="flex flex-nowrap items-center">
        <select v-model="filterForm.author" class="field field-select w-40 input-filter-l">
          <option class="text-slate-300" :value="null">Filter author</option>
          <option v-for="author in props.authors" :key="author.id" :value="author.id">
            {{ author.first_name }} {{ author.last_name }}
          </option>
        </select>
      </div>

      <div class="flex flex-nowrap items-center">
        <select v-model="filterForm.category" class="field field-select w-40 input-filter-l">
          <option class="text-slate-300" :value="null">Category</option>
          <!-- Add categories dynamically here -->
        </select>
      </div>

      <!-- Show Deleted Checkbox Container -->
      <div class="flex items-center space-x-2 h-10 px-2 select-none">
        <input 
          id="show-deleted"
          v-model="filterForm.showDeleted" 
          type="checkbox" 
          class="field-checkbox cursor-pointer"
        />
        <label for="show-deleted" class="text-gray-400 text-xs font-medium cursor-pointer">
          Show Deleted
        </label>
      </div>

      <div class="flex justify-end space-x-3 mydiv ml-auto items-center">
        <button type="submit" class="btn-normal btn_main">Filter</button>
        <button type="reset" class="btn-normal btn_cancel" @click="clear">Clear</button>
      </div>
    </div>
  </form>
</template>
  
<script setup>
import { useForm } from '@inertiajs/vue3'


const props = defineProps({
  filters: Object,
  instructors: {
    type: Array,
    default: () => [],
  },
  authors: {
    type: Array,
    default: () => [],
  },
})
  
const filterForm = useForm({
  search: props.filters?.search || null,
  author: props.filters?.author || null,
  category: props.filters?.category || null,
  instructor: props.filters?.instructor || null,
  showDeleted: props.filters?.showDeleted || false,
})
  
const filter = () => {
  filterForm.get(
    route('courses.index'),
    { preserveState: true, preserveScroll: true },
  )
}
  
const clear = () => {
  filterForm.search = null
  filterForm.author = null
  filterForm.category = null
  filterForm.instructor = null
  filterForm.showDeleted = null
  filter()
}
</script>
  



