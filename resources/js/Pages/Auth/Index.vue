<template>
  <main class="min-h-screen flex items-center justify-center px-4 py-10">
    <div class="w-full max-w-md bg-white rounded-3xl shadow-xl border border-slate-200 p-8">
      <div class="text-center mb-8">
        <h1 class="text-3xl font-bold text-slate-900">User Login</h1>
        <p class="mt-2 text-slate-600">Sign in with your email and password.</p>
      </div>

      <form class="space-y-5" @submit.prevent="submit">
        <div>
          <label class="block text-sm font-medium text-slate-700 mb-2">Email</label>
          <input
            v-model="form.email"
            type="email"
            required
            placeholder="you@example.com"
            class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 outline-none transition"
          />
          <div v-if="form.errors.email" class="mt-2 text-sm text-red-600">
            {{ form.errors.email }}
          </div>
        </div>

        <div>
          <label class="block text-sm font-medium text-slate-700 mb-2">Password</label>
          <input
            v-model="form.password"
            type="password"
            required
            placeholder="••••••••"
            class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 outline-none transition"
          />
          <div v-if="form.errors.password" class="mt-2 text-sm text-red-600">
            {{ form.errors.password }}
          </div>
        </div>

        <div class="flex items-center justify-between gap-3 text-sm text-slate-600">
          <label class="inline-flex items-center gap-2">
            <input
              v-model="form.remember"
              type="checkbox"
              class="h-4 w-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500"
            />
            Remember me
          </label>
          <span class="text-slate-500">Password is <span class="font-semibold">password</span> for seeded users.</span>
        </div>

        <div v-if="flashError" class="rounded-2xl border border-red-200 bg-red-50 p-3 text-sm text-red-700">
          {{ flashError }}
        </div>

        <button
          type="submit"
          class="w-full rounded-2xl bg-indigo-600 px-4 py-3 text-white font-semibold hover:bg-indigo-700 transition"
        >
          Login
        </button>
      </form>

      <div class="mt-6 text-center text-sm text-slate-600">
        Don’t have an account?
        <a :href="route('register.index')" class="text-indigo-600 font-semibold hover:text-indigo-700">Register here</a>
      </div>
    </div>
  </main>
</template>

<script setup>
import { computed } from 'vue'
import { useForm, usePage } from '@inertiajs/vue3'

const page = usePage()
const flashError = computed(() => page.props.flash.error)

const form = useForm({
  email: '',
  password: '',
  remember: false,
})

const submit = () => {
  form.post(route('auth.store'))
}
</script>
