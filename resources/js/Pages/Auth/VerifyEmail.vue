<template>
  <div>You need to be verified first!</div>
  <div>
    <Link :href="route('verification.send')" method="POST" as="Button" class="text-indigo-600 dark:text-indigo-400">Resend Verification E-mail</Link>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'


</script>