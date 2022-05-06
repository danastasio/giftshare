const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    darkMode: 'class',
	content: [
    './public/**/*.html',
    './src/**/*.{js,jsx,ts,tsx,vue}',
	'./resources/views/*.blade.php'
	],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
        },
    },


    plugins: [
		require('@tailwindcss/forms'), 
		require('@tailwindcss/typography')
	],
};
