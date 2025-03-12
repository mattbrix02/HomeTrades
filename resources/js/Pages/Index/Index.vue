<template>
  <section>
    <div class="MainPage">
      The message is {{ message }}
    </div>
  </section>
</template>

<script setup>

defineProps({
  'message' : String,
})
</script>