<script>
export default {
  el: '#app',
  name: 'App',
  data: () => ({
    drawer: null,
    drawerRight: false,
    items: [
      {
        icon: 'keyboard_arrow_up',
        'icon-alt': 'keyboard_arrow_down',
        text: 'Tasques',
        model: false,
        children: [
          { icon: 'description', text: 'Tasques en PHP', url: '/tasks' },
          { icon: 'description', text: 'Tasques tailwind', url: '/tasks_vue' },
          { icon: 'description', text: 'Tasques', url: '/tasques' }
        ]
      },
      { icon: 'account_box', text: 'About', url: '/about' },
      { icon: 'person', text: 'Contacte', url: '/contact' },
      { icon: 'description', text: 'Tags', url: '/tags' },
      { icon: 'person', text: 'Perfil', url: '/profile' },
      { icon: 'input', text: 'Changelog', url: '/changelog' }
    ]
  }),
  methods: {},
  props: {
    source: String
  },
  created () {
    if (window.localStorage.getItem('PRIMARY_COLOR_KEY')) this.$vuetify.theme.primary = window.localStorage.getItem('PRIMARY_COLOR_KEY')
  }
}
</script>
