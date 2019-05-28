<template>
    <span>
        <v-toolbar color="primary" class="ml-3">
            <v-avatar size="52px" @click.stop="profileDrawer =! profileDrawer">
                <img :src=userAvatar alt="avatar">
            </v-avatar>
            <v-toolbar-title>Channels</v-toolbar-title>
            <v-spacer></v-spacer>
            <v-tooltip bottom>
                <v-btn icon slot="activator">
                    <v-icon>channel</v-icon>
                </v-btn>
                <span>Nova conversació</span>
            </v-tooltip>
            <v-tooltip bottom>
                <v-btn icon slot="activator">
                    <v-icon>more_vert</v-icon>
                </v-btn>
                <span>Menú</span>
            </v-tooltip>
        </v-toolbar>

        <v-container fluid text-xs-center class="ma-0 pa-0">
          <v-layout row wrap>
                          <profile-drawer v-model="profileDrawer"></profile-drawer>

            <v-flex xs12 style="height: 64px;">
              <v-card dark color="cyan" style="height: 64px;">
                <v-card-text class="px-0">TODO activar notificacions d'escriptori</v-card-text>
              </v-card>
            </v-flex>
            <v-flex xs12>
              <v-card dark style="height: 64px;">
                  search here
              </v-card>
            </v-flex>
            <v-flex xs12 class="scroll-y" style="max-height: calc(100vh - 64px - 64px - 64px - 64px)">
                <v-list class="ml-4" subheader>
                    <v-subheader>Recent channels</v-subheader>
                    <v-list-tile
                            v-for="channel in dataChannels"
                            :key="channel.id"
                            avatar
                            @click=""
                    >
                      <v-list-tile-avatar>
                        <img :src="channel.avatar">
                      </v-list-tile-avatar>

                      <v-list-tile-content>
                        <v-list-tile-title v-html="channel.name"></v-list-tile-title>
                      </v-list-tile-content>

                      <v-list-tile-action>
                        <v-icon color="primary">chat_bubble</v-icon>
                      </v-list-tile-action>
                    </v-list-tile>
                  </v-list>
            </v-flex>
          </v-layout>
        </v-container>
    </span>
</template>

<script>
import ProfileDrawer from './ProfileDrawer'
export default {
  name: 'ChatChannels',
  components: { ProfileDrawer },
  data () {
    return {
      showMenu: false,
      profileDrawer: false,
      userAvatar: window.laravel_user.gravatar,
      dataChannels:
          [
            {
              id: 1,
              name: 'Channel 1',
              avatar: 'http://i.pravatar.cc/300'
            },
            {
              id: 2,
              name: 'Channel 2',
              avatar: 'http://i.pravatar.cc/300?sadsda'
            },
            {
              id: 3,
              name: 'Channel 3',
              avatar: 'http://i.pravatar.cc/300?sadsdasadsad'
            },
            {
              id: 4,
              name: 'Channel 2',
              avatar: 'http://i.pravatar.cc/300?sadsda'
            },
            {
              id: 5,
              name: 'Channel 3',
              avatar: 'http://i.pravatar.cc/300?sadsdasadsad'
            },
            {
              id: 6,
              name: 'Channel 3',
              avatar: 'http://i.pravatar.cc/300?sadsdasadsad'
            },
            {
              id: 7,
              name: 'Channel 3',
              avatar: 'http://i.pravatar.cc/300?sadsdasadsad'
            },
            {
              id: 8,
              name: 'Channel 3',
              avatar: 'http://i.pravatar.cc/300?sadsdasadsad'
            },
            {
              id: 9,
              name: 'Channel 3',
              avatar: 'http://i.pravatar.cc/300?sadsdasadsad'
            },
            {
              id: 10,
              name: 'Channel 3',
              avatar: 'http://i.pravatar.cc/300?sadsdasadsad'
            },
            {
              id: 11,
              name: 'Channel 3',
              avatar: 'http://i.pravatar.cc/300?sadsdasadsad'
            },
            {
              id: 12,
              name: 'Channel 3',
              avatar: 'http://i.pravatar.cc/300?sadsdasadsad'
            },
            {
              id: 13,
              name: 'Channel 3',
              avatar: 'http://i.pravatar.cc/300?sadsdasadsad'
            },
            {
              id: 14,
              name: 'Channel 3',
              avatar: 'http://i.pravatar.cc/300?sadsdasadsad'
            },
            {
              id: 15,
              name: 'Channel 3',
              avatar: 'http://i.pravatar.cc/300?sadsdasadsad'
            },
            {
              id: 16,
              name: 'Channel 3',
              avatar: 'http://i.pravatar.cc/300?sadsdasadsad'
            },
            {
              id: 17,
              name: 'Channel 3',
              avatar: 'http://i.pravatar.cc/300?sadsdasadsad'
            },
            {
              id: 18,
              name: 'Channel 3',
              avatar: 'http://i.pravatar.cc/300?sadsdasadsad'
            },
            {
              id: 19,
              name: 'Channel 3',
              avatar: 'http://i.pravatar.cc/300?sadsdasadsad'
            },
            {
              id: 20,
              name: 'Channel 3',
              avatar: 'http://i.pravatar.cc/300?sadsdasadsad'
            },
            {
              id: 21,
              name: 'Channel 3',
              avatar: 'http://i.pravatar.cc/300?sadsdasadsad'
            },
            {
              id: 22,
              name: 'Channel 3',
              avatar: 'http://i.pravatar.cc/300?sadsdasadsad'
            }
          ]
    }
  },
  props: {
    channels: {
      type: Array,
      required: true
    }
  },
  created () {
    this.user = window.laravel_user
  }
}
</script>
