import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                seagreen: "#15B6A4",
                nblue: "#101827",
            },
            backgroundImage: {
                'dashboard': "url('public/dashboard.png')",
                'dashboardw': "url('../../dashboardw.png')",
            }
        },
    },

    plugins: [forms],
    darkMode: 'class' // Just add this line at the bottom.
};
