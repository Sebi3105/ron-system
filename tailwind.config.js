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
                'navy-blue': '#1a3d5e',
                'dark-bg': '#1e293b',
                'dark-text': '#d1d5db', 
            },
            screens:{
                'xs':'480px',
            }
        },
    },
    darkMode: 'class',
    plugins: [forms],
};
