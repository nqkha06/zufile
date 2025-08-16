/** @type {import('tailwindcss').Config} */
export default {
 darkMode: 'class', // nếu muốn tự bật bằng .dark
  content: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue',
    './app/**/*.php',
    './storage/framework/views/*.php',
  ],
  safelist: [
    'modal-backdrop',
    'modal-backdrop.fade',
    'modal-backdrop.show',
    'bg-green-600'
  ],
  theme: {
    extend: {
      fontFamily: {
        'poppins': ['Poppins', 'sans-serif'],
      },
    },
  },
  plugins: [
    require('@tailwindcss/forms'),
    require('@tailwindcss/typography'),
  ],
}

