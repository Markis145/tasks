<template>
    <v-toolbar color="primary" dark fixed app clipped-right clipped-left>
        <v-toolbar-side-icon @click.stop="$emit('toggle-left')"></v-toolbar-side-icon>
        <v-toolbar-title v-if="$vuetify.breakpoint.smAndUp">Menú</v-toolbar-title>
        <span v-role="'SuperAdmin'" style="margin-left: 2%">
            <git-info class="hidden-xs-only" ></git-info></span>
        <v-spacer></v-spacer>
        <notificationswidget></notificationswidget>
        <h4 class="white-text mb-3 font-italic text-center hidden-sm-and-down" style="margin-top: 1%">{{ user('email') }}&nbsp;&nbsp;&nbsp;&nbsp;</h4>
        <v-avatar  @click="$emit('toggle-right')"  :title="user('email')">
            <img v-if="user('online')" style="border: lawngreen 2px solid; margin: 20px;" :src=userAvatar alt="avatar">
            <img v-else style="border: red 2px solid; margin: 20px;" :src=userAvatar alt="avatar">
        </v-avatar>
        <v-form action="logout" method="POST">
            <v-btn color="error" type="submit">Logout</v-btn>
        </v-form>
    </v-toolbar>
</template>

<script>
import NotificationsWidget from './notifications/NotificationsWidget'
import GitInfoComponent from './git/GitInfoComponent'
export default {
  name: 'MainToolbar',
  components: {
    'notifications-widget': NotificationsWidget,
    'git-info': GitInfoComponent
  },
  data () {
    return {
      userAvatar: window.laravel_user.gravatar
    }
  },
  methods: {
    user (prop) {
      return window.laravel_user[prop]
    },
    created () {
      this.user = window.laravel_user
    }
  }
}
</script>
