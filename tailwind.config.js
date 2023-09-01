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
        xl: "4rem",
        "2xl": "6rem",
      },
    },
    extend: {
      fontFamily: {
        hindi: ["Hind Siliguri", 'sans-serif'],
        kaushan: ["Kaushan Script", "cursive"],
        great: ["Great Vibes", "cursive"],
        philosopher: ["Philosopher", 'sans-serif']
      },
    },
  },
  daisyui: {
    themes: ["luxury", "dark", "light", "corporate"],
    base: true, // applies background color and foreground color for root element by default
    styled: true, // include daisyUI colors and design decisions for all components
    utils: true, // adds responsive and modifier utility classes
    rtl: false, // rotate style direction from left-to-right to right-to-left. You also need to add dir="rtl" to your html tag and install `tailwindcss-flip` plugin for Tailwind CSS.
    prefix: "", // prefix for daisyUI classnames (components, modifiers and responsive class names. Not colors)
    logs: true,
  },
  plugins: [require("daisyui")],
};
