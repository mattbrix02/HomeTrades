<template>
  <main class="min-h-screen mx-auto my-10 p-6 max-w-6xl">
    <div class="rounded-3xl border border-slate-200 bg-white p-8 shadow-sm">
      <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div>
          <h1 class="text-4xl font-bold text-slate-900">Admin Dashboard</h1>
          <p class="mt-2 text-slate-600">This is a placeholder admin page. Only administrators are redirected here after login.</p>
        </div>
      </div>

      <div class="mt-8 grid gap-4 sm:grid-cols-2">
        <div class="rounded-3xl border border-slate-200 bg-slate-50 p-6">
          <h2 class="text-xl font-semibold text-slate-900">Admin Controls</h2>
          <p class="mt-2 text-slate-600">Manage users, review reports, and configure system settings here.</p>
        </div>

        <div class="rounded-3xl border border-slate-200 bg-slate-50 p-6">
          <h2 class="text-xl font-semibold text-slate-900">Placeholder Content</h2>
          <p class="mt-2 text-slate-600">Use this area to wire up the real admin experience.</p>
        </div>
      </div>
    </div>
  </main>
</template>

<script setup>
</script>
