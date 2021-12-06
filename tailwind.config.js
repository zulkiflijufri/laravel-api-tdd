const colors = require('tailwindcss/colors');

module.exports = {
  purge: [
    './resources/**/*.blade.php',
  ],
  mode: 'jit',
  darkMode: false, // or 'media' or 'class'
  theme: {
    colors: {
        transparent: 'transparent',
        current: 'currentColor',
        black: colors.black,
        white: colors.white,
        rose: colors.rose,
        pink: colors.pink,
        fuchsia: colors.fuchsia,
        purple: colors.purple,
        violet: colors.violet,
        indigo: colors.indigo,
        blue: colors.blue,
        sky: colors.sky, // As of Tailwind CSS v2.2, `lightBlue` has been renamed to `sky`
        cyan: colors.cyan,
        teal: colors.teal,
        emerald: colors.emerald,
        green: colors.green,
        lime: colors.lime,
        yellow: colors.yellow,
        amber: colors.amber,
        orange: colors.orange,
        red: colors.red,
        warmGray: colors.warmGray,
        trueGray: colors.trueGray,
        gray: colors.gray,
        blueGray: colors.blueGray,
        coolGray: colors.coolGray,
    },
    variants: {},
    plugins: [],
},
  variants: {
    extend: {},
  },
  plugins: [],
}
