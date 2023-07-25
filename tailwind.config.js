/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
    "./storage/framework/views/*.php",
    "./resources/views/**/*.blade.php",
    "./resources/js/**/*.jsx",
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
        // sans: ["Carlito", ...defaultTheme.fontFamily.sans],
      },
    },
  },
  daisyui: {
    themes: ["luxury"],
  },
  plugins: [require("daisyui")],
};
