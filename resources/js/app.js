import Vue from 'vue'
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'
import 'material-design-icons-iconfont/dist/material-design-icons.css'
import './bootstrap'
import AppComponent from './components/App.vue'
import ExampleComponent from './components/ExampleComponent.vue'
import Tasks from './components/Tasks'
import Tasques from './components/Tasques'
import Tags from './components/Tags'
import LoginForm from './components/LoginForm.vue'
import RegisterForm from './components/RegisterForm.vue'
import UserList from './components/UserList'
import UserSelect from './components/UserSelect'
import Impersonate from './components/Impersonate'
import permissions from './plugins/permissions'
import snackbar from './plugins/snackbar'
import confirm from './plugins/confirm'
import GitInfo from './components/git/GitInfoComponent'
import Color from './components/ColorPicker'
import Profile from './components/Profile'
import TreeView from 'vue-json-tree-view'
import VueTimeago from 'vue-timeago'
import Changelog from './components/changelog/ChangelogComponent.vue'

window.Vue = Vue
window.Vuetify = Vuetify

const PRIMARY_COLOR_KEY = 'PRIMARY_COLOR_KEY'
const SECONDARY_COLOR_KEY = 'SECONDARY_COLOR_KEY'

const primaryColor = window.localStorage.getItem(PRIMARY_COLOR_KEY) || '#8719E0'
const secondaryColor = window.localStorage.getItem(SECONDARY_COLOR_KEY) || '#616E7C'

window.Vue.use(window.Vuetify, {
  theme: {
    primary: {
      base: primaryColor,
      lighten1: '#9446ED',
      lighten2: '#A368FC',
      lighten3: '#B990FF',
      lighten4: '#DAC4FF',
      lighten5: '#F2EBFE',
      darken1: '#7A0ECC',
      darken2: '#690CB0',
      darken3: '#580A94',
      darken4: '#44056E'
    },
    secondary: {
      base: secondaryColor,
      lighten1: '#7B8794',
      lighten2: '#9AA5B1',
      lighten3: '#CBD2D9',
      lighten4: '#E4E7EB',
      lighten5: '#F5F7FA',
      darken1: '#52606D',
      darken2: '#3E4C59',
      darken3: '#323F4B',
      darken4: '#1F2933'
    },
    accent: {
      base: '#8719E0',
      lighten1: '#9446ED',
      lighten2: '#A368FC',
      lighten3: '#B990FF',
      lighten4: '#DAC4FF',
      lighten5: '#F2EBFE',
      darken1: '#7A0ECC',
      darken2: '#690CB0',
      darken3: '#580A94',
      darken4: '#44056E'
    },
    error: {
      base: '#E12D39',
      lighten1: '#EF4E4E',
      lighten2: '#F86A6A',
      lighten3: '#FF9B9B',
      lighten4: '#FFBDBD',
      lighten5: '#FFE3E3',
      darken1: '#CF1124',
      darken2: '#AB091E',
      darken3: '#8A041A',
      darken4: '#610316'
    },
    // Taken from palete 3
    success: {
      base: '#27AB83',
      lighten1: '#3EBD93',
      lighten2: '#65D6AD',
      lighten3: '#8EEDC7',
      lighten4: '#C6F7E2',
      lighten5: '#EFFCF6',
      darken1: '#199473',
      darken2: '#147D64',
      darken3: '#0C6B58',
      darken4: '#014D40'
    },
    grey: {
      base: '#627D98',
      lighten1: '#829AB1',
      lighten2: '#9FB3C8',
      lighten3: '#BCCCDC',
      lighten4: '#D9E2EC',
      lighten5: '#F0F4F8',
      darken1: '#486581',
      darken2: '#334E68',
      darken3: '#243B53',
      darken4: '#102A43'
    }
  }
})

window.Vue.use(permissions)
window.Vue.use(snackbar)
window.Vue.use(confirm)
window.Vue.use(TreeView)
window.Vue.use(VueTimeago, {
  locale: 'ca', // Default locale
  locales: {
    'ca': require('date-fns/locale/ca')
  }
})

window.Vue.use(TreeView)

// window.Vue.use(Snackbar)

// eslint-disable-next-line no-undef
window.Vue.component('example-component', ExampleComponent)
window.Vue.component('tasks', Tasks)
window.Vue.component('tasques', Tasques)
window.Vue.component('tags', Tags)
window.Vue.component('login-form', LoginForm)
window.Vue.component('register-form', RegisterForm)
window.Vue.component('user-list', UserList)
window.Vue.component('user-select', UserSelect)
window.Vue.component('impersonate', Impersonate)
window.Vue.component('git-info', GitInfo)
window.Vue.component('color', Color)
window.Vue.component('profile', Profile)
window.Vue.component('changelog', Changelog)

const app = new window.Vue(AppComponent)
