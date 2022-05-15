const { createGlobPatternsForDependencies } = require('@nrwl/angular/tailwind');
const { join } = require('path');

module.exports = {
  content: [
    join(__dirname, 'src/**/!(*.stories|*.spec).{ts,html}'),
    ...createGlobPatternsForDependencies(__dirname),
  ],
  darkMode: 'media',
  theme: {
    extend: {
      colors: {
        pm: {
          900: '#225E61',
          800: '#2B786B',
          700: '#358E6D',
          600: '#40A469',
          500: '#4BBA61',
          400: '#61C563',
          300: '#87CF78',
          200: '#AAD990',
          100: '#C8E2A8',
        },
      }
    },
    fontFamily: {
      "cousine": ['"Cousine"', 'sans-serif'],
      "sans": ['"Work Sans"', 'sans-serif'],
      "roboto": ['"Roboto"', 'sans-serif']
    }
  },
  plugins: [],
};
