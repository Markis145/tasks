import Vue from 'vue'
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'
import 'material-design-icons-iconfont/dist/material-design-icons.css'
import './bootstrap'
import AppComponent from './components/App.vue'
import ExampleComponent from './components/ExampleComponent.vue'
import Tasks from './components/Tasks'
window.Vue = Vue
window.Vue.use(Vuetify)

// eslint-disable-next-line no-undef
window.Vue.component('example-component', ExampleComponent)
window.Vue.component('tasks', Tasks)

const app = new window.Vue(AppComponent)
