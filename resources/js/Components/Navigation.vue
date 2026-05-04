<template>
  <nav class="bg-white border-b border-slate-200 shadow-sm">
    <div class="max-w-6xl mx-auto px-6 py-3 flex items-center justify-between">
      <!-- Logo / Brand -->
      <div class="flex items-center gap-3">
        <div class="w-9 h-9 rounded-xl bg-indigo-600 text-white flex items-center justify-center font-bold">
          KM
        </div>
        <span class="font-semibold text-slate-800">
          <Link :href="route('index.index')">
            KM Training
          </Link>
        </span>
      </div>

      <!-- Navigation Links -->
      <div class="hidden md:flex items-center gap-6 text-sm font-medium">
        <a href="#" class="text-slate-600 hover:text-indigo-600 transition">Dashboard</a>
        <a href="#" class="text-slate-600 hover:text-indigo-600 transition">Courses</a>
        <a href="#" class="text-slate-600 hover:text-indigo-600 transition">Assessments</a>
        <a href="#" class="text-slate-600 hover:text-indigo-600 transition">Reports</a>
      </div>

      <!-- Right Section -->
      <div class="flex items-center gap-4">
        <!-- Quick Action -->
        <button
          class="hidden md:block px-4 py-2 rounded-xl text-white text-sm
                     bg-gradient-to-r from-indigo-600 to-indigo-500
                     hover:from-indigo-700 hover:to-indigo-600 transition"
        >
          Start Quiz
        </button>

        <!-- Avatar -->
        <div class="w-9 h-9 rounded-full bg-slate-300" />
      </div>
    </div>
  </nav>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'

// purely presentational for now
</script>
