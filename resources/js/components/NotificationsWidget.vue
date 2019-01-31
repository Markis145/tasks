<template>
    <v-menu offset-y>
        <v-badge slot="activator" left color="accent" overlap>
            <span slot="badge" >6</span>
            <v-btn color="primary">
                <v-icon>notifications_none</v-icon>
            </v-btn>
        </v-badge>
        <v-list>
            <v-list-tile>
                <v-list-tile-title @click="notify">
                    Notify
                </v-list-tile-title>
            </v-list-tile>
            <v-list-tile>
                <v-list-tile-title>Notification 2</v-list-tile-title>
            </v-list-tile>
            <v-list-tile>
                <v-list-tile-title>Notification 3</v-list-tile-title>
            </v-list-tile>
            <v-list-tile>
                <v-list-tile-title>Notification 4</v-list-tile-title>
            </v-list-tile>
        </v-list>
    </v-menu>
</template>

<script>
export default {
  name: 'NotificationsWidget',
  methods: {
    notify () {
      if (!('Notification' in window)) {
        this.$snackbar.showError('This browser does not support desktop notification')
      } else {
        if (Notification.permission === 'default') {
          Notification.requestPermission().then(function (result) {
            console.log(result)
            new Notification('Hi there!')
          })
        }
        console.log(Notification.permission)
        if (Notification.permission === 'granted') {
          var not = new Notification('Hi there!')
          not.onclick = function () { window.open('https://tasks.test') }
        }
      }
    }
  }
}
</script>
