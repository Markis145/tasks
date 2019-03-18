import Vue from 'vue'
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'
import 'material-design-icons-iconfont/dist/material-design-icons.css'
import './bootstrap'
import AppComponent from './components/App.vue'
import 'typeface-montserrat/index.css'
import 'typeface-roboto/index.css'
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
import ServiceWorker from './components/ServiceWorker.vue'
import Navigation from './components/Navigation.vue'
import NotificationsWidget from './components/notifications/NotificationsWidget.vue'
import Notifications from './components/notifications/Notifications'
import ShareFab from './components/ShareFab.vue'
import ImgWebp from './components/ui/ImgWebp.vue'
import VParallaxWebp from './components/ui/VParallaxWebp.vue'
import Vibrate from './components/MobileFeatures/Vibrate.vue'
import Geolocation from './components/MobileFeatures/Geolocation.vue'
import Battery from './components/MobileFeatures/Battery.vue'
import OnlineStatus from './components/MobileFeatures/OnlineStatus.vue'
import Network from './components/MobileFeatures/Network.vue'
import Memory from './components/MobileFeatures/Memory.vue'
import ScreenOrientation from './components/MobileFeatures/ScreenOrientation.vue'
import MainToolbar from './components/MainToolbar.vue'
import NewsLetterSubscriptionCard from './components/NewsLetterSubscriptionCard.vue'
import Newsletters from './components/newsletters/Newsletters'
import NavigationRight from './components/NavigationRight.vue'
import Clock from './components/ui/Clock.vue'
import ShowOneTask from './components/ShowOneTask.vue'

import '../../resources/img/branding.png'
import '../../resources/img/branding.webp'
import '../../resources/img/inici.webp'
import '../../resources/img/inici.jpg'
import '../../resources/img/inici2.jpg'
import '../../resources/img/inici2.webp'
import '../../resources/img/github.webp'
import '../../resources/img/github.png'

window.Vue = Vue
window.Vuetify = Vuetify

const PRIMARY_COLOR_KEY = 'PRIMARY_COLOR_KEY'
const SECONDARY_COLOR_KEY = 'SECONDARY_COLOR_KEY'

const primaryColor = window.localStorage.getItem(PRIMARY_COLOR_KEY) || '#8719E0'
const secondaryColor = window.localStorage.getItem(SECONDARY_COLOR_KEY) || '#616E7C'

window.axios.interceptors.response.use((response) => {
  return response
}, function (error) {
  if (window.disableInterceptor) return Promise.reject(error)
  if (error && error.response) {
    // Refresh CSRF TOKEN
    // dAMpDXBRrjVJ2TKewouYHgOeozZmW72EiAt5K1jY
    if (error.response.status === 419) {
      console.log('419 error intercepted!!!!!')
      return window.helpers.getCsrfToken().then((token) => {
        console.log('TOKEN OBTAINED:')
        console.log(token)
        window.helpers.updateCsrfToken(token)
        console.log('csrf token updated!')
        error.config.headers['X-CSRF-TOKEN'] = token
        console.log('resend request!!!')
        return window.axios.request(error.config)
      }).catch(e => {
        console.log("NO s'ha pogut obtenir el CSRFTOKEN")
        console.log(e)
      })
    }
    console.log('1')
    if (error.response.status === 401) {
      window.Vue.prototype.$snackbar.showError("No heu entrat al sistema o ha caducat la sessió. Renviant-vos a l'entrada del sistema")
      const loginUrl = location.pathname ? '/login?back=' + location.pathname : '/login'
      console.log('Waiting to redirect to:')
      console.log(loginUrl)
      setTimeout(function () { window.location = loginUrl }, 3000)
      // Break the promise chain -> https://github.com/axios/axios/issues/715
      return new Promise(() => {})
    }
    if (error.response.status === 403) {
      window.Vue.prototype.$snackbar.showSnackBar(
        'Error 403!',
        'error',
        'No teniu permisos per realitzar aquesta acció.',
        'center'
      )
    }
    console.log('2')
    if (error.response.status === 422) {
      console.log('%%%%%%%%%%%%%%%%% ERROR DE VALIDACIó %%%%%%%%%%%%%%%')
      console.log(error.response)
      console.log(error.response.data)
      console.log(error.response.data.message)
      console.log(error.response.data.errors)
      window.Vue.prototype.$snackbar.showSnackBar(
        error.response.data.message,
        'error',
        window.helpers.printObject(error.response.data.errors),
        'center'
      )
    }
    console.log('3')
    if (error.response.status === 404) {
      console.log('%%%%%%%%%%%%%%%%% NOT FOUND ERROR %%%%%%%%%%%%%%%')
      console.log(error.response)
      console.log(error.response.data)
      console.log(error.response.data.message)
      console.log(error.response.data.errors)
      window.Vue.prototype.$snackbar.showSnackBar(
        'Error 404!',
        'error',
        "No s'ha pogut trobar al servidor el recurs que demaneu.",
        'center'
      )
    }
    if (error.response.status === 405) {
      console.log('%%%%%%%%%%%%%%%%% METHOD NOT ALLOWED FOUND ERROR %%%%%%%%%%%%%%%')
      console.log(error.response)
      console.log(error.response.data)
      console.log(error.response.data.message)
      console.log(error.response.data.errors)
      window.Vue.prototype.$snackbar.showSnackBar(
        'Error 405!',
        'error',
        'Tipus de petició HTTP incorrecte.',
        'center'
      )
    }
    if (error.response.status === 500) {
      console.log('%%%%%%%%%%%%%%%%% SERVER ERROR %%%%%%%%%%%%%%%')
      console.log(error.response)
      console.log(error.response.data)
      console.log(error.response.data.message)
      console.log(error.response.data.errors)
      window.Vue.prototype.$snackbar.showSnackBar(
        'Error 500!',
        'error',
        'Error inesperat al servidor',
        'center'
      )
    }
    return Promise.reject(error)
  }
  if (error.request) {
    window.Vue.prototype.$snackbar.showError("Error de xarxa! No s'ha obtingut cap resposta a la vostra petició. Consulteu l'estat de la xarxa.")
    window.Vue.prototype.$snackbar.showSnackBar('Error de xarxa!', 'error', "No s'ha obtingut cap resposta a la vostra petició. Consulteu l'estat de la xarxa.")
    return Promise.reject(error)
  }
})

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
      base: '#1CD4D4',
      lighten1: '#3AE7E1',
      lighten2: '#62F4EB',
      lighten3: '#92FDF2',
      lighten4: '#C1FEF6',
      lighten5: '#E1FCF8',
      darken1: '#0FB5BA',
      darken2: '#099AA4',
      darken3: '#07818F',
      darken4: '#05606E'
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
window.Vue.component('service-worker', ServiceWorker)
window.Vue.component('navigation', Navigation)
window.Vue.component('notificationswidget', NotificationsWidget)
window.Vue.component('notifications', Notifications)
window.Vue.component('share-fab', ShareFab)
window.Vue.component('img-webp', ImgWebp)
window.Vue.component('v-parallax-webp', VParallaxWebp)
window.Vue.component('vibrate', Vibrate)
window.Vue.component('geolocation', Geolocation)
window.Vue.component('battery', Battery)
window.Vue.component('online-status', OnlineStatus)
window.Vue.component('network', Network)
window.Vue.component('memory', Memory)
window.Vue.component('screen-orientation', ScreenOrientation)
window.Vue.component('main-toolbar', MainToolbar)
window.Vue.component('newsletter-subscription-card', NewsLetterSubscriptionCard)
window.Vue.component('navigation-right', NavigationRight)
window.Vue.component('newsletters', Newsletters)
window.Vue.component('clock', Clock)
window.Vue.component('show-one-task', ShowOneTask)


const app = new window.Vue(AppComponent)
