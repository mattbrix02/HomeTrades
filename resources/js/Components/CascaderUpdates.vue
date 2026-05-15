<template>
  <Box>
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-1">
      <div>
        <div class="text-gray-500 font-medium mb-2">Cascader Updates</div>
      </div>
    </div>

    <div v-if="updates.length" class="space-y-2">
      <CourseRow
        v-for="update in updates"
        :key="update.id"
      >
        <span class="text-xs text-amber-600 font-medium">
          [{{ update.category }}] {{ update.date }}
        </span>
        <div class="text-slate-800">
          {{ update.title }}
        </div>
      </CourseRow>
    </div>

    <p v-else class="text-sm text-slate-500">
      No updates available.
    </p>
  </Box>
</template>

<script setup>
import { computed } from 'vue'
import Box from './UI/Box.vue'
import CourseRow from './UI/CourseRow.vue'

const props = defineProps({
  updates: Object,

})



</script>
