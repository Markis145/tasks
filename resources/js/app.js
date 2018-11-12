import Vue from 'vue'
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'
import 'material-design-icons-iconfont/dist/material-design-icons.css'
import './bootstrap'
import AppComponent from './components/App.vue'
import ExampleComponent from './components/ExampleComponent.vue'
import Tasks from './components/Tasks'
import Tasques from './components/Tasques'
import LoginForm from './components/LoginForm.vue'
import RegisterForm from './components/RegisterForm.vue'
window.Vue = Vue
window.Vue.use(Vuetify)

// eslint-disable-next-line no-undef
window.Vue.component('example-component', ExampleComponent)
window.Vue.component('tasks', Tasks)
window.Vue.component('tasques', Tasques)
window.Vue.component('login-form', LoginForm)
window.Vue.component('register-form', RegisterForm)

const app = new window.Vue(AppComponent)
