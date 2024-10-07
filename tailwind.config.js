/** @type {import('tailwindcss').Config} */
export default {
    content: ["./resources/**/*.blade.php", "./node_modules/flowbite/**/*.js"],
    darkMode: "class",
    theme: {
        extend: {},
    },
    plugins: [
        require("@tailwindcss/forms"),
        require('flowbite/plugin')({
            charts: true,
            datatables: true,
        }),
    ],
};
