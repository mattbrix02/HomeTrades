<template>
  <nav class="bg-white border-b border-slate-200 shadow-sm">
    <div class="max-w-6xl mx-auto px-6 py-3 flex items-center justify-between">
      <!-- Logo / Brand -->
      <div class="flex items-center gap-3">
        <div class="rounded-xl bg-indigo-600 text-white flex items-center justify-center font-bold" style="width:70px; height: 70px;">
          <img class="rounded-lg opacity-10 md:opacity-100 z-50" src="/storage/images/SFA.png" alt="SFA" />
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
          v-if="user"
          class="btn_main"
        >
          Start Quiz
        </button>

        <!-- Auth Section -->
        <div v-if="user" class="flex items-center gap-3">
          <!-- Avatar & User Info -->
          <div class="flex items-center gap-2">
            <div class="w-9 h-9 rounded-full bg-indigo-600 text-white flex items-center justify-center text-sm font-semibold">
              {{ userInitials }}
            </div>
            <div class="hidden sm:flex flex-col">
              <span class="text-sm font-medium text-slate-900">{{ user.first_name + ' ' + user.last_name + ' - ' + user.role }}</span>
              <span class="text-xs text-slate-500">Logged in</span>
            </div>
          </div>

          <!-- Logout Button -->
          <form class="inline" @submit.prevent="handleLogout">
            <button
              type="submit"
              class="px-3 py-2 rounded-lg text-sm font-medium text-slate-700 hover:bg-slate-100 transition"
            >
              Logout
            </button>
          </form>
        </div>

        <!-- Guest Section -->
        <div v-else class="flex items-center gap-3">
          <div class="hidden sm:flex items-center gap-1 text-slate-600 text-sm font-medium">
            <div class="w-9 h-9 rounded-full bg-slate-300" />
            <span>Guest</span>
          </div>

          <!-- Sign In / Register -->
          <Link
            :href="route('register.index')"
            class="px-4 py-2 rounded-lg text-sm font-medium text-slate-700 hover:bg-slate-100 transition"
          >
            Register
          </Link>
          <Link
            :href="route('auth.create')"
            class="px-4 py-2 rounded-lg text-sm font-medium text-indigo-600 hover:bg-indigo-50 transition"
          >
            Log in
          </Link>
        </div>
      </div>
    </div>
  </nav>
</template>

<script setup>
import { computed } from 'vue'
import { Link, usePage, router } from '@inertiajs/vue3'

const page = usePage()
const user = computed(() => page.props.user)

const userInitials = computed(() => {

  if (!user.value || (user.value.first_name.charAt(0).toUpperCase() + user.value.last_name.charAt(0).toUpperCase()).trim() == '') return ''

  return user.value.first_name.charAt(0).toUpperCase() + user.value.last_name.charAt(0).toUpperCase()
})

const handleLogout = () => {
  router.delete(route('auth.destroy'))
}
</script>
