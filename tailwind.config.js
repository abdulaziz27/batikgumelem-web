import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";
import typography from "@tailwindcss/typography";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Nunito", "Poppins", ...defaultTheme.fontFamily.sans],
                poppins: [
                    "Poppins",
                    "Poppins Bold",
                    ...defaultTheme.fontFamily.sans,
                ],
            },
            colors: {
                button: "#533529",
                brown: {
                    400: "#533529",
                },
            },
        },
    },

    plugins: [forms, typography],
};
