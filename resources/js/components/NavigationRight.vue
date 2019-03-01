<template>
    <v-navigation-drawer
            v-model="drawerRight"
            fixed
            right
            clipped
            app
    >
        <v-card>
            <v-card-title class="secondary darken3 white--text"><h4>Perfil</h4></v-card-title>
            <v-layout row wrap>
                <v-flex xs12>
                    <p>Nom: {{ Auth::user()->name }}</p>
                    <p>Email: {{ Auth::user()->email }}</p>
                    @if(Auth::user()->admin)
                    Super Administrador
                    @else
                    Usuari
                    @endif
                    <p></p>
                    <p>Rols: {{ implode(',',Auth::user()->map()['roles']) }}</p>
                    <p>Permissos: {{ implode(', ',Auth::user()->map()['permissions']) }}</p>
                    <h3>Colors del tema</h3>
                    <color></color>
                </v-flex>
            </v-layout>
        </v-card>
        <v-card>
            <v-card-title class="secondary darken3 white--text"><h4>Opcions administrador</h4></v-card-title>

            <v-layout row wrap>
                @impersonating
                <v-flex xs12>
                    <v-avatar title="{{ Auth::user()->impersonatedBy()->name }} ( {{ Auth::user()->email }} )">
                        <img src="https://www.gravatar.com/avatar/{{ md5(Auth::user()->impersonatedBy()->email) }}" alt="avatar">
                    </v-avatar>
                </v-flex>
                @endImpersonating
                <v-flex xs12>
                    @canImpersonate
                    <impersonate label="Entrar com..." url="/api/v1/regular_users"></impersonate>
                    @endCanImpersonate
                    @impersonating
                    {{ Auth::user()->impersonatedBy()->name }} està suplantant {{ Auth::user()->name }}
                    <a href="impersonate/leave">Abandonar la suplantació</a>
                    @endImpersonating
                </v-flex>
            </v-layout>
        </v-card>
    </v-navigation-drawer>
</template>

<script>
import colors from 'vuetify/es5/util/colors'
export default {
  name: 'NavigationRight',
  data () {
    return {
      dataDrawer: this.drawer,
      items: [
        {
          icon: 'keyboard_arrow_up',
          'icon-alt': 'keyboard_arrow_down',
          text: 'Tasques',
          model: false,
          children: [
            { icon: 'description', text: 'Tasques en PHP', url: '/tasks' },
            { icon: 'description', text: 'Tasques tailwind', url: '/tasks_vue' },
            { icon: 'description', text: 'Tasques', url: '/tasques' }]
        },
        { icon: 'account_box', text: 'About', url: '/about' },
        { icon: 'person', text: 'Contacte', url: '/contact' },
        { icon: 'description', text: 'Tags', url: '/tags' },
        { icon: 'person', text: 'Perfil', url: '/profile' },
        { icon: 'settings', text: 'Changelog', url: '/changelog' },
        { icon: 'notifications', text: 'Notifications', url: '/notifications' },
        { icon: 'settings', text: 'Features', url: '/features' }
      ]
    }
  },
  props: {
    drawer: {
      Type: Boolean,
      default: false
    }
  },
  watch: {
    dataDrawer (drawer) {
      this.$emit('input', drawer)
    },
    drawer (drawer) {
      this.dataDrawer = drawer
    }
  },
  model: {
    prop: 'drawer',
    event: 'input'
  },
  methods: {
    setSelectedItem (item) {
      const currentPath = window.location.pathname
      return currentPath === item.url
      // const selected = this.items.indexOf(this.items.find(item => item.url === currentPath))
      // this.items[selected].selected = true
    },
    selectedStyle (item) {
      if (this.setSelectedItem(item)) {
        return {
          'border-right': '5px solid #F0B429',
          'background-color': '#F0F4F8',
          'font-size': '1em'
        }
      }
    }
  }
  // created () {
  //   this.setSelectedItem()
  // }
}
</script>
