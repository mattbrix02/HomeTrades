<template>
  <main class="min-h-screen flex items-center justify-center px-4 py-10">
    <div class="w-full max-w-lg bg-white rounded-3xl shadow-xl border border-slate-200 p-8">
      <div class="text-center mb-8">
        <h1 class="text-3xl font-bold text-slate-900">Create an Account</h1>
        <p class="mt-2 text-slate-600">Register with your email to access training content.</p>
      </div>

      <form class="space-y-5" @submit.prevent="submit">
        <div class="grid gap-5 sm:grid-cols-2">
          <div>
            <label class="block text-sm font-medium text-slate-700 mb-2">First name</label>
            <input
              v-model="form.first_name"
              type="text"
              required
              placeholder="First name"
              class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 outline-none transition"
            />
            <div v-if="form.errors.first_name" class="mt-2 text-sm text-red-600">
              {{ form.errors.first_name }}
            </div>
          </div>

          <div>
            <label class="block text-sm font-medium text-slate-700 mb-2">Last name</label>
            <input
              v-model="form.last_name"
              type="text"
              required
              placeholder="Last name"
              class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 outline-none transition"
            />
            <div v-if="form.errors.last_name" class="mt-2 text-sm text-red-600">
              {{ form.errors.last_name }}
            </div>
          </div>
        </div>

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

        <div class="grid gap-5 sm:grid-cols-2">
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

          <div>
            <label class="block text-sm font-medium text-slate-700 mb-2">Confirm password</label>
            <input
              v-model="form.password_confirmation"
              type="password"
              required
              placeholder="••••••••"
              class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 outline-none transition"
            />
            <div v-if="form.errors.password_confirmation" class="mt-2 text-sm text-red-600">
              {{ form.errors.password_confirmation }}
            </div>
          </div>
        </div>


        <div>
          <label class="block text-sm font-medium text-slate-700 mb-2">Country</label>
          <input
            v-model="form.country"
            type="text"
            required
            placeholder="Choose Country"
            class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 outline-none transition"
          />
          <div v-if="form.errors.country" class="mt-2 text-sm text-red-600">
            {{ form.errors.country }}
          </div>
        </div>


        <button
          type="submit"
          class="w-full rounded-2xl bg-indigo-600 px-4 py-3 text-white font-semibold hover:bg-indigo-700 transition"
        >
          Register
        </button>
      </form>

      <div class="mt-6 text-center text-sm text-slate-600">
        Already have an account?
        <a :href="route('auth.create')" class="text-indigo-600 font-semibold hover:text-indigo-700">Sign in</a>
      </div>
    </div>
  </main>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3'

const form = useForm({
  first_name: '',
  last_name: '',
  email: '',
  password: '',
  password_confirmation: '',
  country: '',
})

const submit = () => {
  form.post(route('register.index'))
}
</script>
