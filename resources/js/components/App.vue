<script>
export default {
  el: '#app',
  name: 'App',
  data: () => ({
    drawer: null,
    items: [
      {
        icon: 'keyboard_arrow_up',
        'icon-alt': 'keyboard_arrow_down',
        text: 'Tasques',
        model: false,
        children: [
          { icon: 'description', text: 'Tasques en PHP', url: '/tasks' },
          { icon: 'description', text: 'Tasques en Vue', url: '/tasks_vue' }
        ]
      },
      { icon: 'account_box', text: 'About', url: '/about' },
      { icon: 'person', text: 'Contacte', url: '/contact' }
    ]
  }),
  props: {
    source: String
  }
}
</script>