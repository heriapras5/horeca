import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                cafe: {
                    50: '#faf6f3',
                    100: '#f0e6dd',
                    200: '#e0ccbc',
                    300: '#d0b29b',
                    400: '#a87d5e',
                    500: '#8B5A3A',
                    600: '#6B3A2A',
                    700: '#5a2e22',
                    800: '#4a251b',
                    900: '#3a1d14',
                },
                cream: {
                    50: '#FEFCF8',
                    100: '#FDF6EC',
                    200: '#FBF0E0',
                    300: '#F5E8D0',
                    400: '#EDE0C0',
                    500: '#E5D8B0',
                },
                terracotta: {
                    50: '#fdf6f3',
                    100: '#f9e8df',
                    200: '#f2d0be',
                    300: '#e8b89d',
                    400: '#d89a7a',
                    500: '#C77D5E',
                    600: '#b0684a',
                    700: '#8a533c',
                    800: '#6b3f2e',
                    900: '#4c2d20',
                },
                wood: {
                    50: '#faf6f1',
                    100: '#f0e4d6',
                    200: '#e0c9ad',
                    300: '#d0ae84',
                    400: '#b8895a',
                    500: '#9A6B45',
                    600: '#7A5235',
                    700: '#5f3f29',
                    800: '#4a3120',
                    900: '#352317',
                },
            },
        },
    },
    plugins: [],
};
