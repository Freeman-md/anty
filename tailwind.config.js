const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    purge: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            backgroundColor: {
                'primary': '#2D6DDD',
                'light': '#FBFDFE'
            },
            borderColor: {
                'primary': '#2D6DDD',
                'light': '#FBFDFE'
            },
            textColor: {
                'primary': '#2D6DDD',
                'light': '#FBFDFE'
            },
            rotate: {
                '270': '270deg',
                '360': '360deg',
                '-270': '-270deg',
                '-360': '-360deg',
            }
        },
    },

    variants: {
        extend: {
            opacity: ['disabled'],
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
