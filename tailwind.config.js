/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/views/**/*.blade.php",
    "./resources/views/*.blade.php",
    "./resources/js/**/*.jsx",
    "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
    "./storage/framework/views/*.php"
  ],
  theme: {
    container: {
      center: true,
      padding: {
        DEFAULT: "1rem",
        sm: "2rem",
        lg: "4rem",
        xl: "6rem",
        "2xl": "6rem",
      },
    },
    extend: {
      fontFamily: {
        hindi: ["Hind Siliguri", 'sans-serif'],
        kaushan: ["Kaushan Script", "cursive"],
        great: ["Great Vibes", "cursive"],
      },
    },
  },
  daisyui: {
    themes: ["luxury", "dark", "light", "corporate"],
  },
  plugins: [require("daisyui")],
};
