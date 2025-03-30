/** @type {import('tailwindcss').Config} */
export default {
  darkMode: 'class', // or 'media' for automatic detection
  content: [
    './storage/framework/views/*.php',
    './resources/views/**/*.blade.php',
    './resources/js/**/*.vue',
  ],
  theme: {
    extend: {},
  },
  plugins: [
    require('@tailwindcss/forms'),
  ],
}

