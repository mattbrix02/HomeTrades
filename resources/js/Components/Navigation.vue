<template>
  <header class="border-b border-gray-200 bg-white w-full dark:border-gray-700 dark:bg-gray-800">
    <div class="container mx-auto">
      <nav class="p-4 items-center md:flex md:justify-between">
        <div class="text-xl text-indigo-600 font-bold text-center dark:text-indigo-300">
          <Link href="/">HomeTrades</Link>
        </div>
        <div class="text-sm md:text-lg text-center">
          <Link class="nav-link" href="/hello">Contact us</Link>
        </div>
        <div class="text-sm md:text-lg text-center">
          <Link class="nav-link" :href="route('listings.index')">Listings</Link>
        </div>
        <div v-if="props.user" class="text-sm md:text-lg text-center">
          <Link class="nav-link" :href="route('realtor.listing.index')">
            My Realtor
          </Link>
        </div>




        <div class="flex justify-between gap-4">
          <label
            class="theme_switch
          dark:shadow-[0px_2px_1px_rgba(221,_221,_221,_1),_0_5px_10px_rgba(204,_204,_204,_1)]
          shadow-[0px_2px_1px_rgba(255,_207,_72,_1),_0_5px_10px_rgba(255,_207,_72,_1)]
          "
          >
            <input id="checkbox" checked="true" type="checkbox" @click="toggleDarkMode" />
            <span class="slider">
              <div class="star star_1" />
              <div class="star star_2" />
              <div class="star star_3" />
              <svg viewBox="0 0 16 16" class="cloud_1 cloud">
                <path
                  transform="matrix(.77976 0 0 .78395-299.99-418.63)"
                  fill="#fff"
                  d="m391.84 540.91c-.421-.329-.949-.524-1.523-.524-1.351 0-2.451 1.084-2.485 2.435-1.395.526-2.388 1.88-2.388 3.466 0 1.874 1.385 3.423 3.182 3.667v.034h12.73v-.006c1.775-.104 3.182-1.584 3.182-3.395 0-1.747-1.309-3.186-2.994-3.379.007-.106.011-.214.011-.322 0-2.707-2.271-4.901-5.072-4.901-2.073 0-3.856 1.202-4.643 2.925"
                />
              </svg>
            </span>
          </label>




          <div v-if="props.user" class="flex items-center gap-4">
            <div class="text-gray-500 relative pr-2 py-2 text-lg">
              <Link :href="route('notification.index')">
                🔔
                <div v-if="props.user.notificationCount" class="absolute right-0 top-0 w-5 h-5 bg-red-700 dark:bg-red-400 text-white font-medium border border-white dark:border-gray-900 rounded-full text-xs text-center">
                  {{ props.user.notificationCount }}
                </div>
              </Link>
            </div>

            <div class="relative inline-block text-left">
              <!-- Dropdown Button -->
              <button class="bg-indigo-600 p-2 text-slate-100 font-bold text-sm hover:bg-indigo-400 dark:text-gray-200 rounded-lg" @click="toggleDropdown">
                . . .
              </button>

              <!-- Dropdown Menu -->
              <div v-if="isOpen" ref="dropdownMenu" class="absolute mt-2 w-48 border text-slate-800 border-gray-300 rounded-lg shadow-lg bg-slate-200 dark:bg-slate-100 z-40 -left-40 md:left-0">
                <div class="text-sm font-bold rounded-lg">
                  <div class="p-2 text-sm">
                    Signed in as <u>{{ props.user.name }}</u>
                  </div>
                  <hr class="h-1 mx-2 bg-gray-400 dark:bg-gray-700" />
                  <div class="flex items-center pt-2 pb-2">
                    <Link class="w-full" :href="route('logout')" method="DELETE" as="button">Logout</Link>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div v-else class="flex items-center gap-4">
            <Link :href="route('login')">Sign in</Link>

            <Link :href="route('user-account.create')">Register</Link>
          </div>
        </div>
      </nav>
    </div>
  </header>
</template>


<script setup>
import { defineProps,ref, onMounted  } from 'vue'
import { Link } from '@inertiajs/vue3'
import { onClickOutside } from '@vueuse/core'

const isDark = ref(localStorage.getItem('theme') === 'light')

const toggleDarkMode = () => {
  isDark.value = !isDark.value
  document.documentElement.classList.toggle('dark', isDark.value)
  localStorage.setItem('theme', isDark.value ? 'dark' : 'light')
}

onMounted(() => {
  if (isDark.value) document.documentElement.classList.add('dark')
})



const props = defineProps({
  user: Object,
})



const isOpen = ref(false)

// Toggle dropdown
const toggleDropdown = () => {
  isOpen.value = !isOpen.value
}

// Close dropdown when clicking outside
const dropdownMenu = ref(null)
onClickOutside(dropdownMenu, () => {
  isOpen.value = false
})


</script>


<style scoped>

/* Theme Switch */
/* The switch - the box around the slider */
.theme_switch {

    font-size: 17px;
    position: relative;
    display: inline-block;
    width: 4em;
    height: 2.2em;
    border-radius: 30px;
    /*box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);*/
  }

  /* Hide default HTML checkbox */
  .theme_switch input {
    opacity: 0;
    width: 0;
    height: 0;
  }

  /* The slider */
  .slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #2a2a2a;
    transition: 0.4s;
    border-radius: 30px;
    overflow: hidden;
  }

  .slider:before {
    position: absolute;
    content: "";
    height: 1.2em;
    width: 1.2em;
    border-radius: 20px;
    left: 0.5em;
    bottom: 0.5em;
    transition: 0.4s;
    transition-timing-function: cubic-bezier(0.81, -0.04, 0.38, 1.5);
    box-shadow: inset 8px -4px 0px 0px #fff;
  }

  .theme_switch input:checked + .slider {
    background-color: #00a6ff;
  }

  .theme_switch input:checked + .slider:before {
    transform: translateX(1.8em);
    box-shadow: inset 15px -4px 0px 15px #ffcf48;
  }

  .star {
    background-color: #fff;
    border-radius: 50%;
    position: absolute;
    width: 5px;
    transition: all 0.4s;
    height: 5px;
  }

  .star_1 {
    left: 2.5em;
    top: 0.5em;
  }

  .star_2 {
    left: 2.2em;
    top: 1.2em;
  }

  .star_3 {
    left: 3em;
    top: 0.9em;
  }

  .theme_switch input:checked ~ .slider .star {
    opacity: 0;
  }

  .cloud {
    width: 3.5em;
    position: absolute;
    bottom: -1.4em;
    left: -1.1em;
    opacity: 0;
    transition: all 0.4s;
  }

  .theme_switch input:checked ~ .slider .cloud {
    opacity: 1;
  }

</style>
