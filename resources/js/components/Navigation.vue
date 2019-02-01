<template>
    <v-navigation-drawer
            v-model="dataDrawer"
            fixed
            app
            clipped
    >
        <v-list dense>
            <template v-for="item in items">
                <v-layout
                        v-if="item.heading"
                        :key="item.heading"
                        row
                        align-center
                >
                    <v-flex xs6>
                        <v-subheader v-if="item.heading">
                            {{ item.heading }}
                        </v-subheader>
                    </v-flex>
                    <v-flex xs6 class="text-xs-center">
                        <a href="#!" class="body-2 black--text">EDIT</a>
                    </v-flex>
                </v-layout>
                <v-list-group
                        v-else-if="item.children"
                        v-model="item.model"
                        :key="item.text"
                        :prepend-icon="item.model ? item.icon : item['icon-alt']"
                        append-icon=""
                >
                    <v-list-tile slot="activator" :href="item.url">
                        <v-list-tile-content>
                            <v-list-tile-title>
                                {{ item.text }}
                            </v-list-tile-title>
                        </v-list-tile-content>
                    </v-list-tile>
                    <v-list-tile
                            v-for="(child, i) in item.children"
                            :key="i"
                            :href="child.url"
                    >
                        <v-list-tile-action v-if="child.icon">
                            <v-icon>{{ child.icon }}</v-icon>
                        </v-list-tile-action>
                        <v-list-tile-content>
                            <v-list-tile-title>
                                {{ child.text }}
                            </v-list-tile-title>
                        </v-list-tile-content>
                    </v-list-tile>
                </v-list-group>
                <v-list-tile v-else :href="item.url" :target="item.target"
                             :style="selectedStyle(item)">
                    <v-list-tile-action>
                        <v-icon>{{ item.icon }}</v-icon>
                    </v-list-tile-action>
                    <v-list-tile-content>
                        <v-list-tile-title v-text="item.text"></v-list-tile-title>
                    </v-list-tile-content>
                </v-list-tile>
            </template>
        </v-list>
    </v-navigation-drawer>
</template>

<script>
import colors from 'vuetify/es5/util/colors'
export default {
  name: 'Navigation',
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
            { icon: 'description', text: 'Tasques', url: '/tasques' }
          ]
        },
        { icon: 'account_box', text: 'About', url: '/about' },
        { icon: 'person', text: 'Contacte', url: '/contact' },
        { icon: 'description', text: 'Tags', url: '/tags' },
        { icon: 'person', text: 'Perfil', url: '/profile' },
        { icon: 'settings', text: 'Changelog', url: '/changelog' }
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
    setSelectedItem () {
      const currentPath = window.location.pathname
      const selected = this.items.indexOf(this.items.find(item => item.url === currentPath))
      this.items[selected].selected = true
    },
    selectedStyle (item) {
      if (item.selected) {
        return {
          'border-right': '5px solid #F0B429',
          'background-color': '#F0F4F8',
          'font-size': '1em'
        }
      }
    }
  },
  created () {
    this.setSelectedItem()
  }
}
</script>
