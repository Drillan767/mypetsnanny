const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    purge: ['./storage/framework/views/*.php', './resources/views/**/*.blade.php', './resources/js/**/*.vue'],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },

            height: {
                "10v": "10vh",
                "20v": "20vh",
                "25v": "25vh",
                "30v": "30vh",
                "40v": "40vh",
                "50v": "50vh",
                "60v": "60vh",
                "70v": "70vh",
                "75v": "75vh",
                "80v": "80vh",
                "90v": "90vh",
                "100v": "100vh",
                "full": "100%",
            },
        },
    },

    variants: {
        opacity: ['responsive', 'hover', 'focus', 'disabled'],
    },

    plugins: [
        require('@tailwindcss/ui'),
        require('@tailwindcss/custom-forms'),
    ],
};
