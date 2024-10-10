import forms from "@tailwindcss/forms";
import typography from "@tailwindcss/typography";

/* @type {import('tailwindcss').Config} */
export default {
    darkMode: "class",
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./vendor/protonemedia/laravel-splade/lib/**/*.vue",
        "./vendor/protonemedia/laravel-splade/resources/views/**/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./resources/js/**/*.vue",
    ],

    theme: {
        scale: {
            '100': '1',
            '125': '1.25',
            '150': '1.5',
            '175': '1.75',
            '200': '2',
            '225': '2.25',
            // ... 其他已有的 scale 值
        },
        extend: {
        },
    },

    plugins: [
        forms,
        typography
    ],
};
