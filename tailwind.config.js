/** @type {import('tailwindcss').Config} */
module.exports = {
    corePlugins: {
        preflight: false
    },
    darkMode: 'class',
    content: ['**/*.php'],
    theme: {
        extend: {},
        container: {
            center: true,
        }
    }
}