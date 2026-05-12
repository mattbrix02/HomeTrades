<template>
  <form @submit.prevent="filter">
    <div class="mb-8 mt-4 flex flex-wrap gap-2">
      <div class="flex flex-nowrap items-center">
        <input v-model="filterForm.search" type="text" placeholder="search" class="input-filter-l w-56" />
      </div>

      <div class="flex flex-nowrap items-center">
        <select v-model="filterForm.instructor" class="input-filter-r w-48">
          <option class="!text-slate-300" :value="null">Filter instructor</option>
          <option value="programming">Programming</option>
          <option value="design">Design</option>
          <option value="business">Business</option>
        </select>
      </div>

      <div class="flex flex-nowrap items-center">
        <select v-model="filterForm.level" class="input-filter-l  w-40">
          <option class="!text-slate-300" :value="null">Level</option>
          <option value="beginner">Beginner</option>
          <option value="intermediate">Intermediate</option>
          <option value="advanced">Advanced</option>
        </select>
      </div>

      <div class="flex flex-nowrap items-center">
        <select v-model="filterForm.category" class="input-filter-r w-40">
          <option class="!text-slate-300" :value="null">Category</option>
          <option value="programming">Programming</option>
          <option value="design">Design</option>
          <option value="business">Business</option>
        </select>
      </div>
  

  
      <button type="submit" class="btn-normal btn_main">Filter</button>
      <button type="reset" class="btn-normal btn_cancel" @click="clear">Clear</button>
    </div>
  </form>
</template>
  
<script setup>
import { useForm } from '@inertiajs/vue3'
  
const props = defineProps({
  filters: Object,
  
})
  
  
const filterForm = useForm({
  search:props.filters.search ?? null,
  level:props.filters.level ?? null,
  category:props.filters.category ?? null,
  instructor:props.filters.instructor ?? null,
})
  
const filter = () => {
  filterForm.get(
    route('courses.index'),
    {preserveState:true,
      preserveScroll:true,
    },
  )
}
  
const clear = () => {
  filterForm.search = null
  filterForm.level = null
  filterForm.category = null
  filterForm.instructor = null

  filter()
}
</script>
  