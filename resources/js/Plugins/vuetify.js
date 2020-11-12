import Vue from "vue";
import Vuetify from "vuetify";
import colors from 'vuetify/lib/util/colors'
Vue.use(Vuetify);

const vuetify = new Vuetify({
    theme: {
      themes: {
        light: {
          primary: '#000000',
          secondary: '#b0bec5',
          accent: '#26A69A',
          error: '#b71c1c',
          info: '#29B6F6',
          success: '#43A047',
          warning: '#F57C00',
        },
      },
    },
  })
export default vuetify
