const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],
  theme: {
    extend: {
      colors: {
        'fondo': '#FDF4E4',
        'verdefuerte' : '#1cc14e',
      },
    }
  },

    theme: {
        extend: {
            keyframes: {
                wave: {
                  '0%': { transform: 'rotate(0.0deg)' },
                  '10%': { transform: 'rotate(14deg)' },
                  '20%': { transform: 'rotate(-8deg)' },
                  '30%': { transform: 'rotate(14deg)' },
                  '40%': { transform: 'rotate(-4deg)' },
                  '50%': { transform: 'rotate(10.0deg)' },
                  '60%': { transform: 'rotate(0.0deg)' },
                  '100%': { transform: 'rotate(0.0deg)' },
                },
              },
              animation: {
                'waving': 'wave 2s linear infinite',
              },
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
