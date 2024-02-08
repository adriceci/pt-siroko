/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./index.html",
        "./**/*.{vue,js,ts,jsx,tsx}",
    ],
    theme: {
        colors: {
            'black': '#000000',
            'white': '#fffffc',
        },
        extend: {},
    },
    plugins: [],
}
