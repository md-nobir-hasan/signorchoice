/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/livewire/**/*.blade.php",
        "./node_modules/tw-elements/dist/js/**/*.js"
    ],
    plugins: [require("tw-elements/dist/plugin.cjs")],
    darkMode: "class",
    theme: {
        extend: {
            colors: {
                primary: "#ab8e66",
                secondary: "#888",
                hard: "#666",
                tertiary: "#f3f3f3"
            }
        },
        fontFamily: {
            // alkalami: ['Alkalami', serif],
            // comme: ['Comme', sans-serif],
            jost: ["jost", "sans-serif"]
            // lato: ['Lato', sans-serif],
        }
    }
};
