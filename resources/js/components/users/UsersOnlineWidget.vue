<template>
    <span>
        <v-badge slot="activator" left overlap color="error" class="ml-3 mr-2">
            <span slot="badge" v-text="amount"></span>
            <v-btn icon color="white" :loading="loading" :disabled="loading">
                <v-icon :large="large" color="primary">notifications</v-icon>
            </v-btn>
        </v-badge>

        <v-list>
            <v-list-tile v-if="dataNotifications.length > 0">
                <v-list-tile-title>
                    <span v-if="dataNotifications.length === 1">
                        Teniu {{ dataNotifications.length }} notificació pendent:
                    </span>
                    <span v-else>
                        Teniu {{ dataNotifications.length }} notificacions pendents:
                    </span>
                </v-list-tile-title>
            </v-list-tile>
            <v-divider v-if="dataNotifications.length > 0"></v-divider>
            <v-list-tile v-if="dataNotifications.length > 0"
                         v-for="(notification, index) in dataNotifications"
                         :key="index"
                         @click="markAsReaded(notification)"
                         :href="notification.data.url"
                         target="_blank"
            >
                <v-list-tile-content>
                    <v-list-tile-title style="max-width: 450px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                        <v-icon v-if="notification.data.icon" :color="notification.data.iconColor">{{ notification.data.icon }}</v-icon>
                        <v-tooltip bottom>
                            <span slot="activator">{{ notification.data.title }}</span>
                            <span>{{ notification.data.title }}</span>
                        </v-tooltip>
                    </v-list-tile-title>
                </v-list-tile-content>
            </v-list-tile>
            <v-list-tile v-if="dataNotifications.length === 0">
                <v-list-tile-title>No hi ha cap notificació pendent de llegir</v-list-tile-title>
            </v-list-tile>
            <v-divider></v-divider>
            <v-list-tile>
                <v-list-tile-title class="caption">
                    <a href="/notifications">Veure totes</a> | <span v-if="dataNotifications.length > 0"> <a href="#" @click="markAllAsReaded">Marcar totes com a llegides</a> | </span><a href="#" @click="refresh(true)">Actualitzar</a>
                </v-list-tile-title>
            </v-list-tile>
        </v-list>
    </span>

</template>

<script>
export default {
  name: 'UsersOnlineWidget',
  data () {
    return {
      loading: false,
      counter: 0,
      users: []
    }
  },
  created () {
    
  }
}
</script>

<style scoped>

</style>
