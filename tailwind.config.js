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
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                // Custom navy-blue color
                'navy-blue': '#3b5374',
                // Optional: You can extend other colors for dark mode if necessary
                'custom-green': '#199945',
                'dark-bg': '#121212', 
                'dark-text': '#e5e5e5', 
            },

            // Adding dark mode support
            // screens: {
            //     'dark': {'raw': '(prefers-color-scheme: dark)'},
            // },

            fontFamily: {
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
            },

            // Optional: Customizing dark mode hover effects 
            // extend: {
            //     colors: {
            //         'dark-hover': '#333', // Dark mode hover effect color
            //     },
            // }
        },
    },

    plugins: [forms],
};
