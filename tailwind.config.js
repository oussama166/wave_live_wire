/** @type {import('tailwindcss').Config} */

export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./node_modules/flowbite/**/*.js",
    ],
    theme: {
        extend: {
            fontFamily: {
                Roboto: ["Roboto", "sans-serif"],
                Inter: ["Inter", "sans-serif"],
                Mulish:["Mulish", "sans-serif"],
            },
            colors: {
                wave: {
                    primary: "#2b3674",
                    secondary: "#aab4d4",
                    disable: "#707eae",
                    "primary-hover": "#415fcf",
                    "secondary-hover": "#000000",
                    "primary-active": "#000000",
                    "secondary-active": "#000000",
                    "primary-bg": "#f4f7fe",
                },
                primary: {
                    50: "#e6f0fa",
                    100: "#cce3f3",
                    200: "#99b9e3",
                    300: "#6694d2",
                    400: "#336fc0",
                    500: "#2b3674", // Primary color
                    600: "#2540a0",
                    700: "#22356c",
                    800: "#192e4f",
                    900: "#111c33",
                },
                info: {
                    50: "#ebf8ff",
                    100: "#cfe9fc",
                    200: "#9fcdf5",
                    300: "#70b2ee",
                    400: "#4299e1",
                    500: "#3a89ca",
                    600: "#347bb5",
                    700: "#2e6da0",
                    800: "#29618e",
                    900: "#23547a",
                },
                danger: {
                    50: "#ffebeb",
                    100: "#fcd0d0",
                    200: "#f59f9f",
                    300: "#ee7070",
                    400: "#e14242",
                    500: "#ca3a3a",
                    600: "#b53434",
                    700: "#a02e2e",
                    800: "#8e2929",
                    900: "#7a2323",
                },
                white: "#ffffff",
                black: "#000000",
            },
            container: {
                center: true, // Center align the container
                padding: "2rem", // Set default padding,
                screens: {
                    sm: "640px",
                    md: "768px",
                    lg: "1024px",
                    xl: "1280px",
                    "2xl": "1536px",
                },
            },
        },
    },
    plugins: [
        require('flowbite/plugin')
    ],
    darkMode: "false"
  }
