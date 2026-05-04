<template>
  <div class="bg-white p-5 rounded-2xl shadow-md border border-slate-200">
    <h2 class="text-lg font-semibold mb-4 text-slate-800">
      Cascader Updates
    </h2>

    <div v-if="filteredUpdates.length">
      <div
        v-for="update in filteredUpdates"
        :key="update.id"
        class="p-3 mb-2 rounded-lg cursor-pointer
                 hover:bg-indigo-50 transition"
      >
        <span class="text-xs text-amber-600 font-medium">
          [{{ update.category }}] {{ update.date }}
        </span>
        <div class="text-slate-800">
          {{ update.title }}
        </div>
      </div>
    </div>

    <p v-else class="text-sm text-slate-500">
      No updates available.
    </p>
  </div>
</template>

<script setup>
import { computed } from 'vue'

const props = defineProps({
  updates: Object,
  search: String,
})



// Filtering for Updates
const filteredUpdates = computed(() =>
  props.updates.filter(u =>
    u.title.toLowerCase().includes(props.search.toLowerCase()),
  ),
)


</script>
