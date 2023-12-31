/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],

  theme: {
    boxShadow: {
      'all': ['1px 1px 8px -3px rgba(0, 0, 0, 0.3)']
    }
    ,
    fontFamily: {
      // para titulo, contenido, subtitulos, filtros etc
      "poppins": ['Poppins', 'sans-serif'],
      // roboto texto para las graficas
      "roboto": ['Roboto', 'sans-serif'],
    },
    fontSize: {
      // fontsize, lineHeight
      'sm': ['12px', '18px'],
      'base': ['16px', '24px'],
      'text-grafica': ['14px', '16.4px'],
      'text-input': ['20px', '30px'],
      // 'text-input' : ['18px', '27px'],
      'subtitle': ['24px', '36px'],
      'section-subtitle': ['20px', '30px'],
      'title': ['32px', '48px']
    },
    fontWeight: {
      "bold": '700',
      "semi-bold": '600',
      "medium": '500',
      "regular": '400',
      "light": '300',
    },
    colors: {
      // #01245A
      // #320083
      // #110042
      // #716EF9 -> icon editar
      // #FF0000 -> icon trash
      // #4B68FF -> border de los inputs
      // #FFDC25 -> mensaje de informacion advertencia
      // #7C7C7C
      // #7D7D7D
      // #737373
      'white': '#FEFEFE',
      // 'black': '#050203',
      'black': '#151213',
      'primary': '#01245A',
      'primary-light': '#3D52D5',
      'secondary': '',
      'light': '',
      'input': '#012966',
      'input-buscador': '#023E7D',
      'nav': '#001028',
      'nav-hover': '#012966',
      'success': '#B2FFBE',
      'information': '#FFDC25',
      'completed': '#00E809',
      'incompleted': '#F40C0C',
      'gray': '#8D8D8D',
      'gray-light': '#F3F3F3',
      'gray-light-brigthness': '#737373',
      'btn-primary': '#023e7d',
      'btn-primary-light': '#023e7d89',
      'th-table': '#01245A',
      'th-table-text' : '#F3F3F3'
    },
    extend: {
      spacing: {
        '0px': '1px',
      }

    },
  },
  plugins: [
    require('flowbite/plugin')
  ],
}

// 16,24
// 12,18