const plugin = require('tailwindcss/plugin');

/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ['./wp-content/themes/socialbrothers/**/*.{php,ts,svelte,twig}'],
  theme: {
    extend: {
      container: {
        center: true,
        padding: '16px',
        screens: {
          sm: '100%',
          md: '100%',
          lg: '1024px',
          xl: '1148px',
          '2xl': '1148px',
        },
      },
      fontFamily: {
        heading: ['"Roboto"'],
        body: ['"Lato"'],
        icon: ['"Material Icons"'],
        iconRound: ['"Material Symbols Rounded"'],
      },
      fontSize: {
        display: ['4rem', { lineHeight: '5rem', fontWeight: 700 }],
        mdisplay: [
          '2.5rem',
          {
            lineHeight: '3.375rem',
            fontWeight: 700,
          },
        ],
        subtitle: ['1rem', { lineHeight: '1.5rem', fontWeight: 700 }],
        h1: ['3rem', { lineHeight: '4rem', fontWeight: 700 }],
        h1m: [
          '2rem',
          {
            lineHeight: '2.5rem',
            fontWeight: 700,
          },
        ],
        h2: ['2.5rem', { lineHeight: '3rem', fontWeight: 700 }],
        h2m: [
          '1.75rem',
          {
            lineHeight: '2.5rem',
            fontWeight: 700,
          },
        ],
        h3: ['1.875rem', { lineHeight: '2.5rem', fontWeight: 700 }],
        h3m: ['1.5rem', { lineHeight: '2rem', fontWeight: 700 }],
        h4: ['1.5rem', { lineHeight: '1.5rem', fontWeight: 700 }],
        h5: ['1.25rem', { lineHeight: '1.5rem', fontWeight: 700 }],
        h6: ['1rem', { lineHeight: '1.5rem', fontWeight: 700 }],
        p: [
          '1rem',
          { lineHeight: '1.5rem', letterSpacing: '0.2px', fontWeight: 400 },
        ],
        pbig: ['1.25rem', { lineHeight: '2rem', fontWeight: 400 }],
        psmall: [
          '0.875rem',
          { lineHeight: '1.5rem', letterSpacing: '0.2px', fontWeight: 400 },
        ],
        caption: [
          '0.75rem',
          { lineHeight: '1rem', letterSpacing: '0.2px', fontWeight: 700 },
        ],
      },
      colors: {
        primary: {
          light: '#a1cbb0',
          DEFAULT: '#009636',
          dark: '#27603c',
        },
        secondary: {
          light: '#ededed',
          DEFAULT: '#5b6770',
          dark: '#2f3234',
        },
        font: {
          DEFAULT: '#000000',
          link: '#009636',
        },
        message: {
          DEFAULT: '#1966d3',
          2: '#dae7f8',
        },
        succes: {
          DEFAULT: '#3ca355',
          2: '#e0f0e4',
        },
        warning: {
          DEFAULT: '#f4a525',
          2: '#fdf1dc',
        },
        error: {
          DEFAULT: '#c84041',
          2: '#f6e0e1',
        },
        neutral: {
          0: '#fff',
          5: '#f5f5f5',
          25: '#eeeeee',
          50: '#c2c8cf',
          75: '#686c73',
          100: '#353c45',
        },
        offwhite: '#fafafa',
        supporting: {
          DEFAULT: '#7900ff',
          2: '#00ff45',
          3: '#00c6ff',
          4: '#f9f9f9',
        },
        overlay: {
          10: 'rgba(0, 0, 0, 0.1)',
          20: 'rgba(0, 0, 0, 0.2)',
          30: 'rgba(0, 0, 0, 0.3)',
          DEFAULT: 'rgba(0, 0, 0, 0.35)',
          40: 'rgba(0, 0, 0, 0.4)',
          50: 'rgba(0, 0, 0, 0.5)',
          60: 'rgba(0, 0, 0, 0.6)',
          70: 'rgba(0, 0, 0, 0.7)',
          80: 'rgba(0, 0, 0, 0.8)',
          90: 'rgba(0, 0, 0, 0.9)',
        },
      },
      boxShadow: {
        menu: '0 2px 4px 0 rgba(0, 0, 0, 0.24)',
        card: '16px 32px 40px 0 rgba(0, 0, 0, 0.16)',
        input:
          '0 0 0 0.5px #ff6900, inset 0 0 0 0.5px #ff6900, 0 0 0 4px #ffefe4;',
        contentcard: '4px 4px 16px 0 rgba(0, 0, 0, 0.1);'
      },
      backgroundImage: {
        highlight:
          'linear-gradient(to bottom, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0) 50%, rgba(0,0,0,1) 100%)',
      },
      aspectRatio: {
        '4/3': '4 / 3',
        '3/4': '3 / 4',
      },
      keyframes: {
        wiggle: {
          '0%, 100%': { transform: 'rotate(-3deg)' },
          '50%': { transform: 'rotate(3deg)' },
        },
      },
      animation: {
        wiggle: 'wiggle 4s ease-in-out infinite',
      },
    },
  },
  plugins: [
    plugin(function ({ addVariant }) {
      addVariant('active', '.active &');
    }),
  ],
};
