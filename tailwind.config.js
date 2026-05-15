/** @type {import('tailwindcss').Config} */
export default {
  content: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.jsx',
    './resources/**/*.ts',
    './resources/**/*.tsx',
  ],
  theme: {
    extend: {
      colors: {
        maroon: {
          50: '#f5f3f3',
          100: '#ebe7e7',
          200: '#d6cfcf',
          300: '#c2b7b7',
          400: '#ad9f9f',
          500: '#800000',
          600: '#660000',
          700: '#4d0000',
          800: '#330000',
          900: '#1a0000',
        },
        beige: '#F5F5DC',
        gold: {
          50: '#fffef5',
          100: '#fffce5',
          200: '#fff9cc',
          300: '#fff6b2',
          400: '#fff399',
          500: '#ffd700',
          600: '#ffca00',
          700: '#ff9500',
          800: '#cc7700',
          900: '#995500',
        },
      },
      fontFamily: {
        display: ['Playfair Display', 'serif'],
        sans: ['Inter', 'system-ui', 'sans-serif'],
      },
      fontSize: {
        xs: ['0.75rem', { lineHeight: '1rem' }],
        sm: ['0.875rem', { lineHeight: '1.25rem' }],
        base: ['1rem', { lineHeight: '1.5rem' }],
        lg: ['1.125rem', { lineHeight: '1.75rem' }],
        xl: ['1.25rem', { lineHeight: '1.75rem' }],
        '2xl': ['1.5rem', { lineHeight: '2rem' }],
        '3xl': ['1.875rem', { lineHeight: '2.25rem' }],
        '4xl': ['2.25rem', { lineHeight: '2.5rem' }],
        '5xl': ['3rem', { lineHeight: '1' }],
        '6xl': ['3.75rem', { lineHeight: '1' }],
      },
      spacing: {
        '128': '32rem',
      },
      borderRadius: {
        '2xl': '1rem',
      },
      boxShadow: {
        'luxury': '0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04)',
      },
    },
  },
  plugins: [
    require('@tailwindcss/forms'),
    require('@tailwindcss/typography'),
  ],
}
