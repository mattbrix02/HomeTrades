<template>
  <Main>
    <!-- Header -->
    <div class="flex items-center justify-between">
      <h1 class="text-3xl font-bold text-slate-900">
        Knowledge Management & Training system
      </h1>
    </div>



    <!-- Hero Section -->
    <div class="grid md:grid-cols-2 gap-6">
      <!-- Info Card -->
      <div class="relative rounded-2xl overflow-hidden shadow-lg">
        <div class="absolute inset-0 bg-indigo-900/70" />
        <img
          src="https://via.placeholder.com/800x400"
          class="w-full h-full object-cover"
        />
        <div class="absolute inset-0 p-6 text-white flex items-center">
          <p class="text-sm leading-relaxed">
            Empowering employees through structured knowledge sharing,
            continuous learning, and accessible training solutions.
          </p>
        </div>
      </div>

      <!-- Carousel -->
      <div class="relative rounded-2xl overflow-hidden shadow-lg bg-white">
        <div
          class="flex transition-transform duration-500"
          :style="{ transform: `translateX(-${activeSlide * 100}%)` }"
        >
          <div
            v-for="(slide, index) in slides"
            :key="index"
            class="w-full flex-shrink-0 flex items-center justify-center h-64
                 bg-gradient-to-r from-indigo-100 to-indigo-50
                 text-indigo-700 text-xl font-semibold"
          >
            {{ slide }}
          </div>
        </div>

        <button
          class="absolute left-2 top-1/2 -translate-y-1/2
               bg-white/80 hover:bg-white text-indigo-600
               px-3 py-1 rounded-lg shadow"
          @click="prevSlide"
        >
          ←
        </button>

        <button
          class="absolute right-2 top-1/2 -translate-y-1/2
               bg-white/80 hover:bg-white text-indigo-600
               px-3 py-1 rounded-lg shadow"
          @click="nextSlide"
        >
          →
        </button>
      </div>
    </div>


    <!-- Content Grid -->
    <div class="grid md:grid-cols-2 gap-6">
      <Course
        :courses="courses"
        :user="user"
      />

      <CascaderUpdates :updates="updates" />
    </div>
  </Main>
</template>

<script setup>
import { ref } from 'vue'

import Course from '@/Pages/Course/Components/CourseList.vue'
import CascaderUpdates from '@/Components/CascaderUpdates.vue'
import Main from '@/Components/UI/Main.vue'


// Search

// Carousel
const activeSlide = ref(0)
const slides = ['Slide 1', 'Slide 2', 'Slide 3']

const nextSlide = () => {
  activeSlide.value = (activeSlide.value + 1) % slides.length
}

const prevSlide = () => {
  activeSlide.value =
    activeSlide.value === 0 ? slides.length - 1 : activeSlide.value - 1
}


defineProps({
  user: {
    type: Object,
    default: null,
  },
  courses: {
    type: Object,
    default: null,
  },
  filters: {
    type: Object,
    default: () => ({}),
  },
})

// Mock Data for Updates
const updates = ref([
  { id: 1, title: 'New Training Module Released', category: 'Global', date: 'Apr 28' },
  { id: 2, title: 'System Maintenance Notice', category: 'IT', date: 'Apr 25' },
  { id: 3, title: 'Policy Update', category: 'HR', date: 'Apr 20' },
])

</script>
